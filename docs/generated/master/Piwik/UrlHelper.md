<small>Piwik</small>

UrlHelper
=========

Contains less commonly needed URL helper methods.


Methods
-------

The class defines the following methods:

- [`getQueryStringWithExcludedParameters()`](#getQueryStringWithExcludedParameters) &mdash; Converts an array of query parameter name/value mappings into a query string.
- [`getParseUrlReverse()`](#getParseUrlReverse) &mdash; Returns a URL created from the result of the [parse_url](http://php.net/manual/en/function.parse-url.php) function.
- [`getArrayFromQueryString()`](#getArrayFromQueryString) &mdash; Returns a URL query string as an array.
- [`getParameterFromQueryString()`](#getParameterFromQueryString) &mdash; Returns the value of a single query parameter from the supplied query string.
- [`getPathAndQueryFromUrl()`](#getPathAndQueryFromUrl) &mdash; Returns the path and query string of a URL.

<a name="getquerystringwithexcludedparameters" id="getquerystringwithexcludedparameters"></a>
### `getQueryStringWithExcludedParameters()`

Converts an array of query parameter name/value mappings into a query string.

#### Description

Parameters that are in `$parametersToExclude` will not appear in the result
query string.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$queryParameters`
    - `$parametersToExclude`
- _Returns:_ A query string, eg, `&quot;?site=0&quot;`.
    - `string`

<a name="getparseurlreverse" id="getparseurlreverse"></a>
### `getParseUrlReverse()`

Returns a URL created from the result of the [parse_url](http://php.net/manual/en/function.parse-url.php) function.

#### Description

Copied from the PHP comments at http://php.net/parse_url

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$parsed`
- _Returns:_ The URL or `false` if `$parsed` isn&#039;t an array.
    - `Piwik\false`
    - `string`

<a name="getarrayfromquerystring" id="getarrayfromquerystring"></a>
### `getArrayFromQueryString()`

Returns a URL query string as an array.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$urlQuery`
- _Returns:_ eg, `array(&#039;param1&#039; =&gt; &#039;value1&#039;, &#039;param2&#039; =&gt; &#039;value2&#039;)`
    - `array`

<a name="getparameterfromquerystring" id="getparameterfromquerystring"></a>
### `getParameterFromQueryString()`

Returns the value of a single query parameter from the supplied query string.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$urlQuery`
    - `$parameter`
- _Returns:_ Parameter value if found (can be the empty string!), null if not found.
    - `string`
    - `null`

<a name="getpathandqueryfromurl" id="getpathandqueryfromurl"></a>
### `getPathAndQueryFromUrl()`

Returns the path and query string of a URL.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$url`
- _Returns:_ eg, `/test/index.php?module=CoreHome` if `$url` is `http://piwik.org/test/index.php?module=CoreHome`.
    - `string`

