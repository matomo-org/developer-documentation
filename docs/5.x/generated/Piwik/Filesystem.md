<small>Piwik\</small>

Filesystem
==========

Contains helper functions that deal with the filesystem.

Methods
-------

The class defines the following methods:

- [`mkdir()`](#mkdir) &mdash; Attempts to create a new directory.
- [`globr()`](#globr) &mdash; Recursively find pathnames that match a pattern.
- [`unlinkRecursive()`](#unlinkrecursive) &mdash; Recursively deletes a directory.
- [`copy()`](#copy) &mdash; Copies a file from `$source` to `$dest`.
- [`copyRecursive()`](#copyrecursive) &mdash; Copies the contents of a directory recursively from `$source` to `$target`.
- [`deleteFileIfExists()`](#deletefileifexists) &mdash; Deletes the given file if it exists.

<a name="mkdir" id="mkdir"></a>
<a name="mkdir" id="mkdir"></a>
### `mkdir()`

Attempts to create a new directory. All errors are silenced.

_Note: This function does **not** create directories recursively._

#### Signature

-  It accepts the following parameter(s):
    - `$path` (`string`) &mdash;
       The path of the directory to create.
- It does not return anything or a mixed result.

<a name="globr" id="globr"></a>
<a name="globr" id="globr"></a>
### `globr()`

Recursively find pathnames that match a pattern.

See [glob](http://php.net/manual/en/function.glob.php) for more info.

#### Signature

-  It accepts the following parameter(s):
    - `$sDir` (`string`) &mdash;
       directory The directory to glob in.
    - `$sPattern` (`string`) &mdash;
       pattern The pattern to match paths against.
    - `$nFlags` (`int`) &mdash;
       `glob()` . See [glob()](http://php.net/manual/en/function.glob.php).

- *Returns:*  `array` &mdash;
    The list of paths that match the pattern.

<a name="unlinkrecursive" id="unlinkrecursive"></a>
<a name="unlinkRecursive" id="unlinkRecursive"></a>
### `unlinkRecursive()`

Recursively deletes a directory.

#### Signature

-  It accepts the following parameter(s):
    - `$dir` (`string`) &mdash;
       Path of the directory to delete.
    - `$deleteRootToo` (`boolean`) &mdash;
       If true, `$dir` is deleted, otherwise just its contents.
    - `$beforeUnlink` ([`Closure`](http://php.net/class.Closure)|`null`) &mdash;
       An optional closure to execute on a file path before unlinking.
- It does not return anything or a mixed result.

<a name="copy" id="copy"></a>
<a name="copy" id="copy"></a>
### `copy()`

Copies a file from `$source` to `$dest`.

#### Signature

-  It accepts the following parameter(s):
    - `$source` (`string`) &mdash;
       A path to a file, eg. './tmp/latest/index.php'. The file must exist.
    - `$dest` (`string`) &mdash;
       A path to a file, eg. './index.php'. The file does not have to exist.
    - `$excludePhp` (`bool`) &mdash;
       Whether to avoid copying files if the file is related to PHP (includes .php, .tpl, .twig files).
- It returns a `true` value.
- It throws one of the following exceptions:
    - `Piwik\Exception\Exception` &mdash; If the file cannot be copied.

<a name="copyrecursive" id="copyrecursive"></a>
<a name="copyRecursive" id="copyRecursive"></a>
### `copyRecursive()`

Copies the contents of a directory recursively from `$source` to `$target`.

#### Signature

-  It accepts the following parameter(s):
    - `$source` (`string`) &mdash;
       A directory or file to copy, eg. './tmp/latest'.
    - `$target` (`string`) &mdash;
       A directory to copy to, eg. '.'.
    - `$excludePhp` (`bool`) &mdash;
       Whether to avoid copying files if the file is related to PHP (includes .php, .tpl, .twig files).
- It does not return anything or a mixed result.
- It throws one of the following exceptions:
    - `Piwik\Exception\Exception` &mdash; If a file cannot be copied.

<a name="deletefileifexists" id="deletefileifexists"></a>
<a name="deleteFileIfExists" id="deleteFileIfExists"></a>
### `deleteFileIfExists()`

Deletes the given file if it exists.

#### Signature

-  It accepts the following parameter(s):
    - `$pathToFile` (`string`) &mdash;
      

- *Returns:*  `bool` &mdash;
    true in case of success or if file does not exist, false otherwise. It might fail in case the
               file is not writeable.

