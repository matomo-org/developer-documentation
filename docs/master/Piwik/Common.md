<small>Piwik</small>

Common
======

Static class providing functions used by both the CORE of Piwik and the visitor Tracking engine.

Description
-----------

This is the only external class loaded by the /piwik.php file.
This class should contain only the functions that are used in
both the CORE and the piwik.php statistics logging engine.


Constants
---------

This class defines the following constants:

- [`REFERRER_TYPE_DIRECT_ENTRY`](#REFERRER_TYPE_DIRECT_ENTRY) &mdash; Const used to map the referer type to an integer in the log_visit table
- [`REFERRER_TYPE_SEARCH_ENGINE`](#REFERRER_TYPE_SEARCH_ENGINE)
- [`REFERRER_TYPE_WEBSITE`](#REFERRER_TYPE_WEBSITE)
- [`REFERRER_TYPE_CAMPAIGN`](#REFERRER_TYPE_CAMPAIGN)
- [`HTML_ENCODING_QUOTE_STYLE`](#HTML_ENCODING_QUOTE_STYLE) &mdash; Flag used with htmlspecialchar See php.net/htmlspecialchars

Methods
-------

The class defines the following methods:

- [`prefixTable()`](#prefixTable) &mdash; Returns the table name prefixed by the table prefix.
- [`unprefixTable()`](#unprefixTable) &mdash; Returns the table name, after removing the table prefix
- [`getRequestVar()`](#getRequestVar) &mdash; Returns a sanitized variable value from the $_GET and $_POST superglobal.
- [`json_encode()`](#json_encode) &mdash; JSON encode wrapper - missing or broken in some php 5.x versions
- [`json_decode()`](#json_decode) &mdash; JSON decode wrapper - missing or broken in some php 5.x versions
- [`getLanguagesList()`](#getLanguagesList) &mdash; Returns list of valid language codes
- [`getLanguageToCountryList()`](#getLanguageToCountryList) &mdash; Returns list of language to country mappings

### `prefixTable()` <a name="prefixTable"></a>

Returns the table name prefixed by the table prefix.

#### Description

Works in both Tracker and UI mode.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$table`
- _Returns:_ The table name prefixed, ie &quot;piwik-production_log_visit&quot;
    - `string`

### `unprefixTable()` <a name="unprefixTable"></a>

Returns the table name, after removing the table prefix

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$table`
- It returns a(n) `string` value.

### `getRequestVar()` <a name="getRequestVar"></a>

Returns a sanitized variable value from the $_GET and $_POST superglobal.

#### Description

If the variable doesn&#039;t have a value or an empty value, returns the defaultValue if specified.
If the variable doesn&#039;t have neither a value nor a default value provided, an exception is raised.

#### See Also

- `sanitizeInputValues()` &mdash; for the applied sanitization

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$varName`
    - `$varDefault`
    - `$varType`
    - `$requestArrayToUse`
- _Returns:_ The variable after cleaning
    - `mixed`
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if the variable type is not known or if the variable we want to read doesn&#039;t have neither a value nor a default value specified

### `json_encode()` <a name="json_encode"></a>

JSON encode wrapper - missing or broken in some php 5.x versions

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$value`
- It returns a(n) `string` value.

### `json_decode()` <a name="json_decode"></a>

JSON decode wrapper - missing or broken in some php 5.x versions

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$json`
    - `$assoc`
- It returns a(n) `mixed` value.

### `getLanguagesList()` <a name="getLanguagesList"></a>

Returns list of valid language codes

#### See Also

- `core/DataFiles/Languages.php`

#### Signature

- It is a **public static** method.
- _Returns:_ Array of 2 letter ISO codes =&gt; Language name (in English)
    - `array`

### `getLanguageToCountryList()` <a name="getLanguageToCountryList"></a>

Returns list of language to country mappings

#### See Also

- `core/DataFiles/LanguageToCountry.php`

#### Signature

- It is a **public static** method.
- _Returns:_ Array of ( 2 letter ISO language codes =&gt; 2 letter ISO country codes )
    - `array`

