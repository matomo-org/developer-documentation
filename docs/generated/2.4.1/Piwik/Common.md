<small>Piwik\</small>

Common
======

Contains helper methods used by both Piwik Core and the Piwik Tracking engine.

This is the only non-Tracker class loaded by the **\/piwik.php** file.

Methods
-------

The class defines the following methods:

- [`prefixTable()`](#prefixtable) &mdash; Returns a prefixed table name.
- [`unprefixTable()`](#unprefixtable) &mdash; Removes the prefix from a table name and returns the result.
- [`mb_substr()`](#mb_substr) &mdash; Multi-byte substr() - works with UTF-8.
- [`mb_strlen()`](#mb_strlen) &mdash; Multi-byte strlen() - works with UTF-8  Calls `mb_substr` if available and falls back to `substr` if not.
- [`mb_strtolower()`](#mb_strtolower) &mdash; Multi-byte strtolower() - works with UTF-8.
- [`sanitizeInputValues()`](#sanitizeinputvalues) &mdash; Sanitizes a string to help avoid XSS vulnerabilities.
- [`unsanitizeInputValues()`](#unsanitizeinputvalues) &mdash; Unsanitizes one or more values and returns the result.
- [`getRequestVar()`](#getrequestvar) &mdash; Gets a sanitized request parameter by name from the `$_GET` and `$_POST` superglobals.
- [`getLanguagesList()`](#getlanguageslist) &mdash; Returns the list of valid language codes.
- [`getLanguageToCountryList()`](#getlanguagetocountrylist) &mdash; Returns a list of language to country mappings.
- [`getSqlStringFieldsArray()`](#getsqlstringfieldsarray) &mdash; Returns a string with a comma separated list of placeholders for use in an SQL query.
- [`destroy()`](#destroy) &mdash; Marks an orphaned object for garbage collection.

<a name="prefixtable" id="prefixtable"></a>
<a name="prefixTable" id="prefixTable"></a>
### `prefixTable()` 
Returns a prefixed table name.

The table prefix is determined by the `[database] tables_prefix` INI config
option.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$table` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The table name to prefix, ie "log_visit"</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`string`) &mdash;
    <div markdown="1" class="param-desc">The prefixed name, ie "piwik-production_log_visit".</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="unprefixtable" id="unprefixtable"></a>
<a name="unprefixTable" id="unprefixTable"></a>
### `unprefixTable()` 
Removes the prefix from a table name and returns the result.

The table prefix is determined by the `[database] tables_prefix` INI config
option.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$table` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The prefixed table name, eg "piwik-production_log_visit".</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`string`) &mdash;
    <div markdown="1" class="param-desc">The unprefixed table name, eg "log_visit".</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="mb_substr" id="mb_substr"></a>
<a name="mb_substr" id="mb_substr"></a>
### `mb_substr()` 
Multi-byte substr() - works with UTF-8.

Calls `mb_substr` if available and falls back to `substr` if it's not.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$string`

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$start`

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It returns a `string` value.

<a name="mb_strlen" id="mb_strlen"></a>
<a name="mb_strlen" id="mb_strlen"></a>
### `mb_strlen()` 
Multi-byte strlen() - works with UTF-8  Calls `mb_substr` if available and falls back to `substr` if not.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$string` (`string`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It returns a `int` value.

<a name="mb_strtolower" id="mb_strtolower"></a>
<a name="mb_strtolower" id="mb_strtolower"></a>
### `mb_strtolower()` 
Multi-byte strtolower() - works with UTF-8.

Calls `mb_strtolower` if available and falls back to `strtolower` if not.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$string` (`string`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It returns a `string` value.

<a name="sanitizeinputvalues" id="sanitizeinputvalues"></a>
<a name="sanitizeInputValues" id="sanitizeInputValues"></a>
### `sanitizeInputValues()` 
Sanitizes a string to help avoid XSS vulnerabilities.

This function is automatically called when [getRequestVar()](/api-reference/Piwik/Common#getrequestvar) is called,
so you should not normally have to use it.

This function should be used when outputting data that isn't escaped and was
obtained from the user (for example when using the `|raw` twig filter on goal names).

_NOTE: Sanitized input should not be used directly in an SQL query; SQL placeholders
should still be used._

**Implementation Details**

- [htmlspecialchars](http://php.net/manual/en/function.htmlspecialchars.php) is used to escape text.
- Single quotes are not escaped so **Piwik's amazing community** will still be
  **Piwik's amazing community**.
- Use of the `magic_quotes` setting will not break this method.
- Boolean, numeric and null values are not modified.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$value` (`mixed`) &mdash;

      <div markdown="1" class="param-desc"> The variable to be sanitized. If an array is supplied, the contents of the array will be sanitized recursively. The keys of the array will also be sanitized.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$alreadyStripslashed` (`bool`) &mdash;

      <div markdown="1" class="param-desc"> Implementation detail, ignore.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`mixed`) &mdash;
    <div markdown="1" class="param-desc">The sanitized value.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If `$value` is of an incorrect type.

<a name="unsanitizeinputvalues" id="unsanitizeinputvalues"></a>
<a name="unsanitizeInputValues" id="unsanitizeInputValues"></a>
### `unsanitizeInputValues()` 
Unsanitizes one or more values and returns the result.

This method should be used when you need to unescape data that was obtained from
the user.

Some data in Piwik is stored sanitized (such as site name). In this case you may
have to use this method to unsanitize it in order to, for example, output it in JSON.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$value` (`string`|`array`) &mdash;

      <div markdown="1" class="param-desc"> The data to unsanitize. If an array is passed, the array is sanitized recursively. Key values are not unsanitized.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`string`|`array`) &mdash;
    <div markdown="1" class="param-desc">The unsanitized data.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="getrequestvar" id="getrequestvar"></a>
<a name="getRequestVar" id="getRequestVar"></a>
### `getRequestVar()` 
Gets a sanitized request parameter by name from the `$_GET` and `$_POST` superglobals.

Use this function to get request parameter values. **_NEVER use `$_GET` and `$_POST` directly._**

If the variable cannot be found, and a default value was not provided, an exception is raised.

_See [sanitizeInputValues()](/api-reference/Piwik/Common#sanitizeinputvalues) to learn more about sanitization._

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$varName` (`string`) &mdash;

      <div markdown="1" class="param-desc"> Name of the request parameter to get. By default, we look in `$_GET[$varName]` and `$_POST[$varName]` for the value.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$varDefault` (`string`|`null`) &mdash;

      <div markdown="1" class="param-desc"> The value to return if the request parameter cannot be found or has an empty value.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$varType` (`string`|`null`) &mdash;

      <div markdown="1" class="param-desc"> Expected type of the request variable. This parameters value must be one of the following: `'array'`, `'int'`, `'integer'`, `'string'`, `'json'`. If `'json'`, the string value will be `json_decode`-d and then sanitized.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$requestArrayToUse` (`array`|`null`) &mdash;

      <div markdown="1" class="param-desc"> The array to use instead of `$_GET` and `$_POST`.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`mixed`) &mdash;
    <div markdown="1" class="param-desc">The sanitized request parameter.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If the request parameter doesn&#039;t exist and there is no default value, or if the request parameter exists but has an incorrect type.

<a name="getlanguageslist" id="getlanguageslist"></a>
<a name="getLanguagesList" id="getLanguagesList"></a>
### `getLanguagesList()` 
Returns the list of valid language codes.

See [core/DataFiles/Languages.php](https://github.com/piwik/piwik/blob/master/core/DataFiles/Languages.php).

#### Signature


<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`array`) &mdash;
    <div markdown="1" class="param-desc">Array of two letter ISO codes mapped with their associated language names (in English). E.g. `array('en' => 'English', 'ja' => 'Japanese')`.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="getlanguagetocountrylist" id="getlanguagetocountrylist"></a>
<a name="getLanguageToCountryList" id="getLanguageToCountryList"></a>
### `getLanguageToCountryList()` 
Returns a list of language to country mappings.

See [core/DataFiles/LanguageToCountry.php](https://github.com/piwik/piwik/blob/master/core/DataFiles/LanguageToCountry.php).

#### Signature


<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`array`) &mdash;
    <div markdown="1" class="param-desc">Array of two letter ISO language codes mapped with two letter ISO country codes: `array('fr' => 'fr') // French => France`</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="getsqlstringfieldsarray" id="getsqlstringfieldsarray"></a>
<a name="getSqlStringFieldsArray" id="getSqlStringFieldsArray"></a>
### `getSqlStringFieldsArray()` 
Returns a string with a comma separated list of placeholders for use in an SQL query.

Used mainly
to fill the `IN (...)` part of a query.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$fields` (`array`|`string`) &mdash;

      <div markdown="1" class="param-desc"> The names of the mysql table fields to bind, e.g. `array(fieldName1, fieldName2, fieldName3)`. _Note: The content of the array isn't important, just its length._</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`string`) &mdash;
    <div markdown="1" class="param-desc">The placeholder string, e.g. `"?, ?, ?"`.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="destroy" id="destroy"></a>
<a name="destroy" id="destroy"></a>
### `destroy()` 
Marks an orphaned object for garbage collection.

For more information: [https://github.com/piwik/piwik/issues/374](https://github.com/piwik/piwik/issues/374)

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$var` (`Piwik\$var`) &mdash;

      <div markdown="1" class="param-desc"> The object to destroy.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

