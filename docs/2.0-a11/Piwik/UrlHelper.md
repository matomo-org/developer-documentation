<small>Piwik</small>

UrlHelper
=========

Class UrlHelper


Methods
-------

The class defines the following methods:

- [`getQueryStringWithExcludedParameters()`](#getQueryStringWithExcludedParameters) &mdash; Returns a Query string, Given an array of input parameters, and an array of parameter names to exclude
- [`getLossyUrl()`](#getLossyUrl) &mdash; Reduce URL to more minimal form.
- [`isLookLikeUrl()`](#isLookLikeUrl) &mdash; Returns true if the string passed may be a URL.
- [`getParseUrlReverse()`](#getParseUrlReverse) &mdash; Builds a URL from the result of parse_url function Copied from the PHP comments at http://php.net/parse_url
- [`getArrayFromQueryString()`](#getArrayFromQueryString) &mdash; Returns an URL query string in an array format
- [`getParameterFromQueryString()`](#getParameterFromQueryString) &mdash; Returns the value of a GET parameter $parameter in an URL query $urlQuery
- [`getPathAndQueryFromUrl()`](#getPathAndQueryFromUrl) &mdash; Returns the path and query part from a URL.
- [`extractSearchEngineInformationFromUrl()`](#extractSearchEngineInformationFromUrl) &mdash; Extracts a keyword from a raw not encoded URL.

### `getQueryStringWithExcludedParameters()` <a name="getQueryStringWithExcludedParameters"></a>

Returns a Query string, Given an array of input parameters, and an array of parameter names to exclude

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$queryParameters`
    - `$parametersToExclude`
- It returns a(n) `string` value.

### `getLossyUrl()` <a name="getLossyUrl"></a>

Reduce URL to more minimal form.

#### Description

2 letter country codes are
replaced by &#039;{}&#039;, while other parts are simply removed.

Examples:
  www.example.com -&gt; example.com
  search.example.com -&gt; example.com
  m.example.com -&gt; example.com
  de.example.com -&gt; {}.example.com
  example.de -&gt; example.{}
  example.co.uk -&gt; example.{}

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$url`
- It returns a(n) `string` value.

### `isLookLikeUrl()` <a name="isLookLikeUrl"></a>

Returns true if the string passed may be a URL.

#### Description

We don&#039;t need a precise test here because the value comes from the website
tracked source code and the URLs may look very strange.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$url`
- It returns a(n) `bool` value.

### `getParseUrlReverse()` <a name="getParseUrlReverse"></a>

Builds a URL from the result of parse_url function Copied from the PHP comments at http://php.net/parse_url

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$parsed`
- It can return one of the following values:
    - `bool`
    - `string`

### `getArrayFromQueryString()` <a name="getArrayFromQueryString"></a>

Returns an URL query string in an array format

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$urlQuery`
- _Returns:_ array( param1=&gt; value1, param2=&gt;value2)
    - `array`

### `getParameterFromQueryString()` <a name="getParameterFromQueryString"></a>

Returns the value of a GET parameter $parameter in an URL query $urlQuery

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$urlQuery`
    - `$parameter`
- _Returns:_ Parameter value if found (can be the empty string!), null if not found
    - `string`
    - `bool`

### `getPathAndQueryFromUrl()` <a name="getPathAndQueryFromUrl"></a>

Returns the path and query part from a URL.

#### Description

Eg. http://piwik.org/test/index.php?module=CoreHome will return /test/index.php?module=CoreHome

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$url`
- It returns a(n) `string` value.

### `extractSearchEngineInformationFromUrl()` <a name="extractSearchEngineInformationFromUrl"></a>

Extracts a keyword from a raw not encoded URL.

#### Description

Will only extract keyword if a known search engine has been detected.
Returns the keyword:
- in UTF8: automatically converted from other charsets when applicable
- strtolowered: &quot;QUErY test!&quot; will return &quot;query test!&quot;
- trimmed: extra spaces before and after are removed

Lists of supported search engines can be found in /core/DataFiles/SearchEngines.php
The function returns false when a keyword couldn&#039;t be found.
    eg. if the url is &quot;http://www.google.com/partners.html&quot; this will return false,
      as the google keyword parameter couldn&#039;t be found.

#### See Also

- `unit` &mdash; tests in /tests/core/Common.test.php

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$referrerUrl`
- _Returns:_ false if a keyword couldn&#039;t be extracted, or array( &#039;name&#039; =&gt; &#039;Google&#039;, &#039;keywords&#039; =&gt; &#039;my searched keywords&#039;)
    - `array`
    - `bool`

