<small>Piwik</small>

CacheFile
=========

This class is used to cache data on the filesystem.

Description
-----------

It is for example used by the Tracker process to cache various settings and websites attributes in tmp/cache/tracker/*


Constants
---------

This class defines the following constants:

- [`MINIMUM_TTL`](#MINIMUM_TTL) &mdash; Minimum enforced TTL in seconds

Properties
----------

This class defines the following properties:

- [`$invalidateOpCacheBeforeRead`](#$invalidateOpCacheBeforeRead)

### `$invalidateOpCacheBeforeRead` <a name="invalidateOpCacheBeforeRead"></a>

#### Signature

- It is a **public static** property.
- Its type is not specified.


Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct)
- [`get()`](#get) &mdash; Function to fetch a cache entry
- [`set()`](#set) &mdash; A function to store content a cache entry.
- [`delete()`](#delete) &mdash; A function to delete a single cache entry
- [`deleteAll()`](#deleteAll) &mdash; A function to delete all cache entries in the directory
- [`opCacheInvalidate()`](#opCacheInvalidate)

### `__construct()` <a name="__construct"></a>

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$directory`
    - `$timeToLiveInSeconds`
- It does not return anything.

### `get()` <a name="get"></a>

Function to fetch a cache entry

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$id`
- _Returns:_ False on error, or array the cache content
    - `array`
    - `bool`

### `set()` <a name="set"></a>

A function to store content a cache entry.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$id`
    - `$content`
- _Returns:_ True if the entry was succesfully stored
    - `bool`
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

### `delete()` <a name="delete"></a>

A function to delete a single cache entry

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$id`
- _Returns:_ True if the entry was succesfully deleted
    - `bool`

### `deleteAll()` <a name="deleteAll"></a>

A function to delete all cache entries in the directory

#### Signature

- It is a **public** method.
- It does not return anything.

### `opCacheInvalidate()` <a name="opCacheInvalidate"></a>

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$filepath`
- It does not return anything.

