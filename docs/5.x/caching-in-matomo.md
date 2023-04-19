---
category: DevelopInDepth
---
# Caching in Matomo

Like all software, Matomo uses caching to improve its performance. This document explains every type of cache used
by Matomo, and how core developers and plugin developers can make use of them.

## Transient Cache

The **Transient** cache is the simplest cache available in Matomo. It is an in-memory cache that stores values in
a PHP array. Data is cached only for the current request.

Use this cache in a request if you need to avoid invoking the same, expensive logic multiple times in a single
request. Examples of that might be to cache the result of an API call to get a list of entities. You might need that
list in multiple places in PHP, but only really need to issue a database query once.

See the {@see Matomo\Cache\Backend\Transient::class} class for more information.

## Lazy Cache

The **Lazy** cache is a cache that requests and reads cached data on demand. When you cache data in the Lazy cache,
it will be available across requests, for example, in a file backend, but will not be read until it is requested.

In the backend, the data will be stored in one entry per cache key (e.g., one php file per cache key).

This cache is most useful for caching that needs available across requests, but doesn't need to be accessed very
often. An example might be the result of an HTTP request, or a method that issues an HTTP request, that is done
in a Controller action. Issuing the HTTP request every time the controller action is invoked could make the controller
action seem slow, so we want to cache the result. We don't need it in any other context, however, so we want the
cache to be accessed only when we want the data. The Lazy cache is perfect for this.

See the {@see Matomo\Cache\Backend\Lazy::class} class for more information.

## Eager Cache

The **Eager** cache is a cache like the Lazy cache in that it will make cached data available across requests, but
every piece of cached data in the Eager cache is loaded at the start of each request.

In the backend, the eager cache data will all be stored in a single entry (so, e.g., all cached data is in a single php
file). This means there is just one redis query or file read to get all the cached data.

This cache is useful for data that needs to be cached across requests, and is used in every (or almost every) request.
An example of this might be the current Matomo version installed. Every request will check if the current installed version
is the same as the version of the installed code. If we used the Lazy cache, we'd have to read a cache entry on every request, which
would slow every Matomo request down a little. Using the Eager cache, we don't add any more load to the current request,
since we only ever do a single read to get all the data at once.

## Tracker Cache

The tracker cache is a special cache used by the Matomo tracker. The Matomo tracker is meant to be able to handle
many simultaneous requests with as much performance as possible. Since users can potentially track millions of actions per month or more,
we need to make every optimization we possibly can.

The Tracker cache is primarily used to avoid any sort of database query that doesn't have to do with inserting log data.
Option values and entity information (like site information) should all be stored in the tracker cache, so, ideally, we
never issue a database query to get it. (Eventually the cache data will become stale, and we may have to query it again,
but most requests will use cached data.)

See the {@see Piwik\Tracker\Cache} class for more information.

# Cache invalidation

When it is known that data in a cache is no longer valid, it must be invalidated. If, for example, a measurable setting is changed
for a site, and that setting is used during tracking, the `Tracker::deleteCacheWebsiteAttributes()` must be called.

Each individual cache type has a different way of doing that.

# Cache Backends

The cache types above all store data in the same place. This place is determined by the cache backend specified in INI configuration.
The `[Cache] backend` option determines where the data gets saved. The possible options are straightforward: cache to an **array**,
cache to a **file**, cache to **redis**.

There is also the **chained** cache which is worth a note. The chained cache allows using multiple backends. For example,
caching to an array, file and redis. Here, when requesting data, we'd first check if it's in the array backend, and if it is there, we use it.
If not, we'd check the file backend then the redis backend. Using this cache we make the less expensive checks first and save time.

## Cache Keys

The key you use to cache data must be unique to differentiate the data from other data that might get cached. If, for example, your
data is dependent on the currently loaded site, the cache ID must reflect this by including the idSite, for example `myData.1` where `1` is the
site ID. Otherwise, when the idSite changes will use or overwrite data for a different site.

Matomo includes a utility class that can be used to help with key creation: {@see Piwik\CacheId::class}. You can use the following
methods to easily create cache keys and avoid some subtle bugs that occur from creating keys manually:

* `languageAware()`: if your data depends on the currently loaded language, use this function.
* `pluginAware()`: if your data depends on what plugins are currently loaded, use this function.
* `siteAware()`: if your data depends on or more sites, or the currently requested sites (in other words, the idSite query parameter), use
    this function.

# Example Cache Usage

Below is an example of how to use the `Cache` classes.

```php
class Controller
{
    /**
     * @var Lazy
     */
    private Lazy $cache;
    
    public function __construct(Lazy $cache)
    {
        $this->cache = $cache;
        parent::__construct();
    }
    
    public function myExpensiveAction()
    {
        $idSite = Common::getRequestVar('idSite', $default = null, 'int');
        $cacheKey = \Piwik\CacheId::siteAware('myCacheData', $idSite);
        
        // NOTE: using this approach where we fetch first instead of using contains only works if `false` is not a valid cached value
        $data = $this->cache->fetch($cacheKey);
        if ($data === false) {
            $data = $this->doSomethingThatTakesALongTimeWithIdSite($idSite);
            $this->cache->save($cacheKey, $data, 24 * 60 * 60);
        }
        return $data;
    }
}
```

# Cache in development mode

When the development mode is enabled we avoid most caching to make sure code changes will be directly applied as some caches are
only invalidated after an update otherwise. Basically when development mode is on, we are using array cache, even if we setup something else.

```php
// config/environment/dev.php
'Matomo\Cache\Backend' => Piwik\DI::autowire('Matomo\Cache\Backend\ArrayCache'),
```

If we turn off development mode and setup filesystem cache in our local environment, we can see the cache files in the `tmp/cache` folder by default.

```
// config/config.ini.php
[Development]
enabled = 0
[Cache]
backend = file
```

# Clear cache

We can easily empty cache with a console command:

```
./console cache:clear
```
