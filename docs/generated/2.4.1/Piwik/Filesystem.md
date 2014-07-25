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
Attempts to create a new directory.

All errors are silenced.

_Note: This function does **not** create directories recursively._

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$path` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The path of the directory to create.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="globr" id="globr"></a>
<a name="globr" id="globr"></a>
### `globr()` 
Recursively find pathnames that match a pattern.

See [glob](http://php.net/manual/en/function.glob.php) for more info.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$sDir` (`string`) &mdash;

      <div markdown="1" class="param-desc"> directory The directory to glob in.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$sPattern` (`string`) &mdash;

      <div markdown="1" class="param-desc"> pattern The pattern to match paths against.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$nFlags` (`int`) &mdash;

      <div markdown="1" class="param-desc"> `glob()` . See [glob()](http://php.net/manual/en/function.glob.php).</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`array`) &mdash;
    <div markdown="1" class="param-desc">The list of paths that match the pattern.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="unlinkrecursive" id="unlinkrecursive"></a>
<a name="unlinkRecursive" id="unlinkRecursive"></a>
### `unlinkRecursive()` 
Recursively deletes a directory.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$dir` (`string`) &mdash;

      <div markdown="1" class="param-desc"> Path of the directory to delete.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$deleteRootToo` (`boolean`) &mdash;

      <div markdown="1" class="param-desc"> If true, `$dir` is deleted, otherwise just its contents.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$beforeUnlink` (`Piwik\Closure`) &mdash;

      <div markdown="1" class="param-desc"> An optional closure to execute on a file path before unlinking.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="copy" id="copy"></a>
<a name="copy" id="copy"></a>
### `copy()` 
Copies a file from `$source` to `$dest`.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$source` (`string`) &mdash;

      <div markdown="1" class="param-desc"> A path to a file, eg. './tmp/latest/index.php'. The file must exist.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$dest` (`string`) &mdash;

      <div markdown="1" class="param-desc"> A path to a file, eg. './index.php'. The file does not have to exist.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$excludePhp` (`bool`) &mdash;

      <div markdown="1" class="param-desc"> Whether to avoid copying files if the file is related to PHP (includes .php, .tpl, .twig files).</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It returns a `Piwik\true` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If the file cannot be copied.

<a name="copyrecursive" id="copyrecursive"></a>
<a name="copyRecursive" id="copyRecursive"></a>
### `copyRecursive()` 
Copies the contents of a directory recursively from `$source` to `$target`.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$source` (`string`) &mdash;

      <div markdown="1" class="param-desc"> A directory or file to copy, eg. './tmp/latest'.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$target` (`string`) &mdash;

      <div markdown="1" class="param-desc"> A directory to copy to, eg. '.'.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$excludePhp` (`bool`) &mdash;

      <div markdown="1" class="param-desc"> Whether to avoid copying files if the file is related to PHP (includes .php, .tpl, .twig files).</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If a file cannot be copied.

<a name="deletefileifexists" id="deletefileifexists"></a>
<a name="deleteFileIfExists" id="deleteFileIfExists"></a>
### `deleteFileIfExists()` 
Deletes the given file if it exists.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$pathToFile` (`string`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`bool`) &mdash;
    <div markdown="1" class="param-desc">true in case of success or if file does not exist, false otherwise. It might fail in case the file is not writeable.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

