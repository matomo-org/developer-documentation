<small>Piwik</small>

Filesystem
==========

Class Filesystem


Methods
-------

The class defines the following methods:

- [`deleteAllCacheOnUpdate()`](#deleteAllCacheOnUpdate) &mdash; Called on Core install, update, plugin enable/disable Will clear all cache that could be affected by the change in configuration being made
- [`getPathToPiwikRoot()`](#getPathToPiwikRoot) &mdash; ending WITHOUT slash
- [`createHtAccess()`](#createHtAccess) &mdash; Create .htaccess file in specified directory
- [`isValidFilename()`](#isValidFilename) &mdash; Returns true if the string is a valid filename File names that start with a-Z or 0-9 and contain a-Z, 0-9, underscore(_), dash(-), and dot(.) will be accepted.
- [`realpath()`](#realpath) &mdash; Get canonicalized absolute path See http://php.net/realpath
- [`mkdir()`](#mkdir) &mdash; Create directory if permitted
- [`checkIfFileSystemIsNFS()`](#checkIfFileSystemIsNFS) &mdash; Checks if the filesystem Piwik stores sessions in is NFS or not.
- [`globr()`](#globr) &mdash; Recursively find pathnames that match a pattern
- [`unlinkRecursive()`](#unlinkRecursive) &mdash; Recursively delete a directory
- [`copy()`](#copy) &mdash; Copy individual file from $source to $target.
- [`copyRecursive()`](#copyRecursive) &mdash; Copy recursively from $source to $target.

### `deleteAllCacheOnUpdate()` <a name="deleteAllCacheOnUpdate"></a>

Called on Core install, update, plugin enable/disable Will clear all cache that could be affected by the change in configuration being made

#### Signature

- It is a **public static** method.
- It does not return anything.

### `getPathToPiwikRoot()` <a name="getPathToPiwikRoot"></a>

ending WITHOUT slash

#### Signature

- It is a **public static** method.
- It returns a(n) `string` value.

### `createHtAccess()` <a name="createHtAccess"></a>

Create .htaccess file in specified directory

#### Description

Apache-specific; for IIS @see web.config

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$path`
    - `$overwrite`
    - `$content`
- It does not return anything.

### `isValidFilename()` <a name="isValidFilename"></a>

Returns true if the string is a valid filename File names that start with a-Z or 0-9 and contain a-Z, 0-9, underscore(_), dash(-), and dot(.) will be accepted.

#### Description

File names beginning with anything but a-Z or 0-9 will be rejected (including .htaccess for example).
File names containing anything other than above mentioned will also be rejected (file names with spaces won&#039;t be accepted).

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$filename`
- It returns a(n) `bool` value.

### `realpath()` <a name="realpath"></a>

Get canonicalized absolute path See http://php.net/realpath

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$path`
- _Returns:_ canonicalized absolute path
    - `string`

### `mkdir()` <a name="mkdir"></a>

Create directory if permitted

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$path`
    - `$denyAccess`
- It does not return anything.

### `checkIfFileSystemIsNFS()` <a name="checkIfFileSystemIsNFS"></a>

Checks if the filesystem Piwik stores sessions in is NFS or not.

#### Description

This
check is done in order to avoid using file based sessions on NFS system,
since on such a filesystem file locking can make file based sessions
incredibly slow.

Note: In order to figure this out, we try to run the &#039;df&#039; program. If
the &#039;exec&#039; or &#039;shell_exec&#039; functions are not available, we can&#039;t do
the check.

#### Signature

- It is a **public static** method.
- _Returns:_ True if on an NFS filesystem, false if otherwise or if we can&#039;t use shell_exec or exec.
    - `bool`

### `globr()` <a name="globr"></a>

Recursively find pathnames that match a pattern

#### See Also

- `glob()`

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$sDir`
    - `$sPattern`
    - `$nFlags`
- It returns a(n) `array` value.

### `unlinkRecursive()` <a name="unlinkRecursive"></a>

Recursively delete a directory

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$dir`
    - `$deleteRootToo`
    - `$beforeUnlink` (`Piwik\Closure`)
- It does not return anything.

### `copy()` <a name="copy"></a>

Copy individual file from $source to $target.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$source`
    - `$dest`
    - `$excludePhp`
- It returns a(n) `bool` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

### `copyRecursive()` <a name="copyRecursive"></a>

Copy recursively from $source to $target.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$source`
    - `$target`
    - `$excludePhp`
- It does not return anything.

