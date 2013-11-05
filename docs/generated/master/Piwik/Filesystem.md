<small>Piwik</small>

Filesystem
==========

Contains helper functions that involve the filesystem.


Methods
-------

The class defines the following methods:

- [`mkdir()`](#mkdir) &mdash; Attempts to create a new directory.
- [`globr()`](#globr) &mdash; Recursively find pathnames that match a pattern.
- [`unlinkRecursive()`](#unlinkRecursive) &mdash; Recursively deletes a directory.
- [`copy()`](#copy) &mdash; Copies a file from `$source` to `$dest`.
- [`copyRecursive()`](#copyRecursive) &mdash; Copies the contents of a directory recursively from `$source` to `$target`.

<a name="mkdir" id="mkdir"></a>
### `mkdir()`

Attempts to create a new directory.

#### Description

All errors are silenced.

Note: This function does not create directories recursively.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$path`
    - `$denyAccess`
- It does not return anything.

<a name="globr" id="globr"></a>
### `globr()`

Recursively find pathnames that match a pattern.

#### Description

See [glob](#http://php.net/manual/en/function.glob.php) for more info.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$sDir`
    - `$sPattern`
    - `$nFlags`
- _Returns:_ The list of paths that match the pattern.
    - `array`

<a name="unlinkrecursive" id="unlinkrecursive"></a>
### `unlinkRecursive()`

Recursively deletes a directory.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$dir`
    - `$deleteRootToo`
    - `$beforeUnlink` (`Piwik\Closure`)
- It does not return anything.

<a name="copy" id="copy"></a>
### `copy()`

Copies a file from `$source` to `$dest`.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$source`
    - `$dest`
    - `$excludePhp`
- It returns a(n) `bool` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If the file cannot be copied.

<a name="copyrecursive" id="copyrecursive"></a>
### `copyRecursive()`

Copies the contents of a directory recursively from `$source` to `$target`.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$source`
    - `$target`
    - `$excludePhp`
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If a file cannot be copied.

