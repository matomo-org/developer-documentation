<small>Piwik</small>

Filesystem
==========

Contains helper functions that involve the filesystem.

Methods
-------

The class defines the following methods:

- [`mkdir()`](#mkdir) &mdash; Attempts to create a new directory.
- [`globr()`](#globr) &mdash; Recursively find pathnames that match a pattern.
- [`unlinkRecursive()`](#unlinkrecursive) &mdash; Recursively deletes a directory.
- [`copy()`](#copy) &mdash; Copies a file from `$source` to `$dest`.
- [`copyRecursive()`](#copyrecursive) &mdash; Copies the contents of a directory recursively from `$source` to `$target`.

<a name="mkdir" id="mkdir"></a>
<a name="mkdir" id="mkdir"></a>
### `mkdir()`

Attempts to create a new directory.

#### Description

All errors are silenced.

Note: This function does not create directories recursively.

#### Signature

- It accepts the following parameter(s):
    - `$path` (`string`) &mdash; The path of the directory to create.
    - `$denyAccess` (`bool`) &mdash; Whether to deny browser access to this new folder by creating a .htaccess file.
- It does not return anything.

<a name="globr" id="globr"></a>
<a name="globr" id="globr"></a>
### `globr()`

Recursively find pathnames that match a pattern.

#### Description

See [glob](http://php.net/manual/en/function.glob.php) for more info.

#### Signature

- It accepts the following parameter(s):
    - `$sDir` (`string`) &mdash; directory The directory to glob in.
    - `$sPattern` (`string`) &mdash; pattern The pattern to match paths against.
    - `$nFlags` (`int`) &mdash; `glob()` flags. See [http://php.net/manual/en/function.glob.php](http://php.net/manual/en/function.glob.php).
- _Returns:_ The list of paths that match the pattern.
    - `array`

<a name="unlinkrecursive" id="unlinkrecursive"></a>
<a name="unlinkRecursive" id="unlinkRecursive"></a>
### `unlinkRecursive()`

Recursively deletes a directory.

#### Signature

- It accepts the following parameter(s):
    - `$dir` (`string`) &mdash; Path of the directory to delete.
    - `$deleteRootToo` (`boolean`) &mdash; Whether to delete `$dir` or just its contents.
    - `$beforeUnlink` (`Piwik\Closure`) &mdash; An optional closure to execute on a file path before unlinking.
- It does not return anything.

<a name="copy" id="copy"></a>
<a name="copy" id="copy"></a>
### `copy()`

Copies a file from `$source` to `$dest`.

#### Signature

- It accepts the following parameter(s):
    - `$source` (`string`) &mdash; A path to a file, eg. './tmp/latest/index.php'. The file must exist.
    - `$dest` (`string`) &mdash; A path to a file, eg. './index.php'. The file does not have to exist.
    - `$excludePhp` (`bool`) &mdash; Whether to avoid copying files if the file is related to PHP (includes .php, .tpl, .twig files).
- It returns a `bool` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If the file cannot be copied.

<a name="copyrecursive" id="copyrecursive"></a>
<a name="copyRecursive" id="copyRecursive"></a>
### `copyRecursive()`

Copies the contents of a directory recursively from `$source` to `$target`.

#### Signature

- It accepts the following parameter(s):
    - `$source` (`string`) &mdash; A directory or file to copy, eg. './tmp/latest'.
    - `$target` (`string`) &mdash; A directory to copy to, eg. '.'.
    - `$excludePhp` (`bool`) &mdash; Whether to avoid copying files if the file is related to PHP (includes .php, .tpl, .twig files).
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If a file cannot be copied.

