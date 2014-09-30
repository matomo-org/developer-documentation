Piwik Developer Documentation
=============================

* http://piwik.org
* http://developer.piwik.org

### Documentations

 * [Index](docs/generated/master/Index.md)
 * [Classes](docs/generated/master/Classes.md)
 * [Namespaces](docs/generated/master/Namespaces.md)
 * [Hooks](docs/generated/master/Hooks.md)
 * [Guides](docs)

### License

GPLv3 or later

### Run locally

```
$ cd app/
$ composer install
$ cd public/
$ php -S 0.0.0.0:8000
```

To disable caching, create a `app/config/local.php` file with the following:

```php
<?php
define('CACHING_ENABLED', false);
```

### Automatic documentation generation (API-Reference)

 * Execute `./generate.sh`
 * Commit
 * Push

or just execute `./generateAndPush.sh`.

The documents will be generated into the [docs/generated](docs/generated) directory. It will always generated the documentations for the master as well as for the latest stable version.

### Manual documentation writing (Guides)

Just edit the `docs/*.md` files. Any change you make there should be available on the developer website within a minute.

#### Adding new guide

Edit the file [app/helpers/Guide.php](app/helpers/Guide.php) and add a new entry to the `menu` function. You need to define the following attributes:

 * `title` The name of the guide that will be displayed on the website
 * `file` The name of the file without the `.md` extension that should be loaded when a user opens the guide. The file has to be placed in the [docs](docs) directory. For instance a value `introduction` matches [docs/introduction.md](docs/introduction.md)
 * `description` The description of the guide. Will be usually displayed below the title on the guides site.
 * `url` The url under which the guide should be available. For instance a value.
 * `callToAction` This is an optional parameter and defines the title of the call to action button.

#### Adding a new API-Reference

Works similar as adding a new guide except that you have to make the changes in the file [app/helpers/ApiReference.php](app/helpers/ApiReference.php).

#### Adding a new teaser to the home page

Works similar as adding a new guide except that you have to make the changes in the file [app/helpers/Home.php](app/helpers/Home.php).
Please note it is currently not possible to define a file name here. So it is more or less only possible to change existing entries or to add new teasers to external links.

### Supported inline tags in comments

```
{@hook Request.dispatch}                    // link to Request.dispatch hook
{@hook Request.dispatch description text}   // link to Request.dispatch hook with different link text
{@hook # description}                       // link to hooks page
```

Note: In constrast to @link we do not check whether a hook with the given name exists.

```
{@link Map}                  // class within this namespace
{@link Piwik\DataTable\Map}  // full classname
{@link \Exception}           // php internal class
{@link serialize()}          // php internal function
{@link getKeyName()}         // method within this class
{@link $myproperty}          // property within this class
{@link INDEX_NB_UNIQ_VISITORS}  // constant within this class, note: a link will be only generated if the constant has a long description
{@link Map::getKeyName()}    // method from any class
{@link Map::$myproperty}     // property from any class
{@link Piwik\Metrics::INDEX_NB_UNIQ_VISITORS}  // constant from any class, note: a link will be only generated if the constant has a long description
{@link http://piwik.org}     // http link
{@link https://piwik.org}    // https link
{@link mailto:test}          // mailto link


{@link Map Description Text}                  // class within this namespace
{@link Piwik\DataTable\Map Description Text}  // full classname
{@link \Exception Description Text}           // php internal class
{@link getKeyName() Description Text}         // method within this class
{@link $myproperty Description Text}          // property within this class
{@link Map::getKeyName() Description Text}    // method from any class
{@link Map::$myproperty Description Text}     // property from any class
{@link http://piwik.org Description Text}     // http link
{@link https://piwik.org Description Text}    // https link
{@link mailto:test Description Text}          // mailto link
```
