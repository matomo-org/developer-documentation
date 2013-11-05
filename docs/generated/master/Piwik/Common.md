<small>Piwik</small>

Common
======

Contains helper methods used by both Piwik Core and the Piwik Tracking engine.

Description
-----------

This is the only external class loaded by the /piwik.php file.


Constants
---------

This class defines the following constants:

- [`REFERRER_TYPE_DIRECT_ENTRY`](#REFERRER_TYPE_DIRECT_ENTRY)
- [`REFERRER_TYPE_SEARCH_ENGINE`](#REFERRER_TYPE_SEARCH_ENGINE)
- [`REFERRER_TYPE_WEBSITE`](#REFERRER_TYPE_WEBSITE)
- [`REFERRER_TYPE_CAMPAIGN`](#REFERRER_TYPE_CAMPAIGN)
- [`HTML_ENCODING_QUOTE_STYLE`](#HTML_ENCODING_QUOTE_STYLE)

Methods
-------

The class defines the following methods:

- [`prefixTable()`](#prefixTable) &mdash; Returns a prefixed table name.
- [`unprefixTable()`](#unprefixTable) &mdash; Removes the prefix from a table name and returns the result.
- [`mb_substr()`](#mb_substr) &mdash; Multi-byte substr() - works with UTF-8.
- [`mb_strlen()`](#mb_strlen) &mdash; Multi-byte strlen() - works with UTF-8  Calls `mb_substr` if available and falls back to `substr` if not.
- [`mb_strtolower()`](#mb_strtolower) &mdash; Multi-byte strtolower() - works with UTF-8.
- [`sanitizeInputValues()`](#sanitizeInputValues) &mdash; Sanitizes a string to help avoid XSS vulnerabilities.
- [`unsanitizeInputValues()`](#unsanitizeInputValues) &mdash; Unsanitizes one or more values and returns the result.
- [`getRequestVar()`](#getRequestVar) &mdash; Gets a sanitized request parameter by name from the `$_GET` and `$_POST` superglobals.
- [`getLanguagesList()`](#getLanguagesList) &mdash; Returns the list of valid language codes.
- [`getLanguageToCountryList()`](#getLanguageToCountryList) &mdash; Returns list of language to country mappings.
- [`getSqlStringFieldsArray()`](#getSqlStringFieldsArray) &mdash; Returns a string with a comma separated list of placeholders for use in an SQL query based on the list of fields we're referencing.
- [`destroy()`](#destroy) &mdash; Mark orphaned object for garbage collection.

<a name="prefixtable" id="prefixtable"></a>
### `prefixTable()`

Returns a prefixed table name.

#### Description

The table prefix is determined by the `[database] tables_prefix` INI config
option.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$table`
- _Returns:_ The prefixed name, ie &quot;piwik-production_log_visit&quot;.
    - `string`

<a name="unprefixtable" id="unprefixtable"></a>
### `unprefixTable()`

Removes the prefix from a table name and returns the result.

#### Description

The table prefix is determined by the `[database] tables_prefix` INI config
option.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$table`
- _Returns:_ The unprefixed table name, eg &quot;log_visit&quot;.
    - `string`

<a name="mb_substr" id="mb_substr"></a>
### `mb_substr()`

Multi-byte substr() - works with UTF-8.

#### Description

Calls `mb_substr` if available and falls back to `substr` if it's not.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$string`
    - `$start`
- It returns a(n) `string` value.

<a name="mb_strlen" id="mb_strlen"></a>
### `mb_strlen()`

Multi-byte strlen() - works with UTF-8  Calls `mb_substr` if available and falls back to `substr` if not.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$string`
- It returns a(n) `int` value.

<a name="mb_strtolower" id="mb_strtolower"></a>
### `mb_strtolower()`

Multi-byte strtolower() - works with UTF-8.

#### Description

Calls `mb_strtolower` if available and falls back to `strtolower` if not.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$string`
- It returns a(n) `string` value.

<a name="sanitizeinputvalues" id="sanitizeinputvalues"></a>
### `sanitizeInputValues()`

Sanitizes a string to help avoid XSS vulnerabilities.

#### Description

This function is automatically called when [getRequestVar](#getRequestVar) is called,
so you should not normally have to use it.

You should used it when outputting data that isn't escaped and was
obtained from the user (for example when using the `|raw` twig filter on goal names).

NOTE: Sanitized input should not be used directly in an SQL query; SQL placeholders
      should still be used.

**Implementation Details**

- `htmlspecialchars` is used to escape text.
- Single quotes are not escaped so "Piwik's amazing community" will still be
  "Piwik's amazing community".
- Use of the `magic_quotes` setting will not break this method.
- Boolean, numeric and null values are simply returned.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$value`
    - `$alreadyStripslashed`
- _Returns:_ The sanitized value.
    - `mixed`
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If `$value` is of an incorrect type.

<a name="unsanitizeinputvalues" id="unsanitizeinputvalues"></a>
### `unsanitizeInputValues()`

Unsanitizes one or more values and returns the result.

#### Description

This method should be used when you need to unescape data that was obtained from
the user.

Some data in Piwik is stored sanitized (such as site name). In this case you may
have to use this method to unsanitize it after it is retrieved.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$value`
- _Returns:_ The unsanitized data.
    - `string`
    - `array`

<a name="getrequestvar" id="getrequestvar"></a>
### `getRequestVar()`

Gets a sanitized request parameter by name from the `$_GET` and `$_POST` superglobals.

#### Description

Use this function to get request parameter values. **_NEVER use `$_GET` and `$_POST` directly._**

If the variable doesn't have neither a value nor a default value provided, an exception is raised.

#### See Also

- `sanitizeInputValues()` &mdash; for the applied sanitization

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$varName`
    - `$varDefault`
    - `$varType`
    - `$requestArrayToUse`
- _Returns:_ The sanitized request parameter.
    - `mixed`
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If the request parameter doesn&#039;t exist and there is no default value or if the request parameter exists but has an incorrect type.

<a name="getlanguageslist" id="getlanguageslist"></a>
### `getLanguagesList()`

Returns the list of valid language codes.

#### See Also

- `core/DataFiles/Languages.php`

#### Signature

- It is a **public static** method.
- _Returns:_ Array of two letter ISO codes mapped with language name (in English). E.g. `array(&#039;en&#039; =&gt; &#039;English&#039;)`.
    - `array`

<a name="getlanguagetocountrylist" id="getlanguagetocountrylist"></a>
### `getLanguageToCountryList()`

Returns list of language to country mappings.

#### See Also

- `core/DataFiles/LanguageToCountry.php`

#### Signature

- It is a **public static** method.
- _Returns:_ Array of two letter ISO language codes mapped with two letter ISO country codes: `array(&#039;fr&#039; =&gt; &#039;fr&#039;), // French =&gt; France`
    - `array`

<a name="getsqlstringfieldsarray" id="getsqlstringfieldsarray"></a>
### `getSqlStringFieldsArray()`

Returns a string with a comma separated list of placeholders for use in an SQL query based on the list of fields we're referencing.

#### Description

Used mainly to fill the `IN (...)` part of a query.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$fields`
- _Returns:_ The placeholder string, e.g. `&quot;?, ?, ?&quot;`.
    - `string`

<a name="destroy" id="destroy"></a>
### `destroy()`

Mark orphaned object for garbage collection.

#### Description

For more information: @link http://dev.piwik.org/trac/ticket/374

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$var`
- It does not return anything.

