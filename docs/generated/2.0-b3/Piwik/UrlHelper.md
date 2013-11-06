<small>Piwik</small>

UrlHelper
=========

Contains less commonly needed URL helper methods.


Methods
-------

The class defines the following methods:

- [`getQueryStringWithExcludedParameters()`](#getquerystringwithexcludedparameters) &mdash; Converts an array of query parameter name/value mappings into a query string.
- [`getParseUrlReverse()`](#getparseurlreverse) &mdash; Returns a URL created from the result of the [parse_url](http://php.net/manual/en/function.parse-url.php) function.
- [`getArrayFromQueryString()`](#getarrayfromquerystring) &mdash; Returns a URL query string as an array.
- [`getParameterFromQueryString()`](#getparameterfromquerystring) &mdash; Returns the value of a single query parameter from the supplied query string.
- [`getPathAndQueryFromUrl()`](#getpathandqueryfromurl) &mdash; Returns the path and query string of a URL.

<a name="getquerystringwithexcludedparameters" id="getquerystringwithexcludedparameters"></a>
<a name="getQueryStringWithExcludedParameters" id="getQueryStringWithExcludedParameters"></a>
### `getQueryStringWithExcludedParameters()`

Converts an array of query parameter name/value mappings into a query string.

#### Description

Parameters that are in `$parametersToExclude` will not appear in the result
query string.

#### Signature

- It accepts the following parameter(s):
    - `$queryParameters`
    - `$parametersToExclude`
- _Returns:_ A query string, eg, `"?site=0"`.
    - `string`

<a name="getparseurlreverse" id="getparseurlreverse"></a>
<a name="getParseUrlReverse" id="getParseUrlReverse"></a>
### `getParseUrlReverse()`

Returns a URL created from the result of the [parse_url](http://php.net/manual/en/function.parse-url.php) function.

#### Description

Copied from the PHP comments at http://php.net/parse_url

#### Signature

- It accepts the following parameter(s):
    - `$parsed`
- _Returns:_ The URL or `false` if `$parsed` isn't an array.
    - `Piwik\false`
    - `string`

<a name="getarrayfromquerystring" id="getarrayfromquerystring"></a>
<a name="getArrayFromQueryString" id="getArrayFromQueryString"></a>
### `getArrayFromQueryString()`

Returns a URL query string as an array.

#### Signature

- It accepts the following parameter(s):
    - `$urlQuery`
- _Returns:_ eg, `array('param1' => 'value1', 'param2' => 'value2')`
    - `array`

<a name="getparameterfromquerystring" id="getparameterfromquerystring"></a>
<a name="getParameterFromQueryString" id="getParameterFromQueryString"></a>
### `getParameterFromQueryString()`

Returns the value of a single query parameter from the supplied query string.

#### Signature

- It accepts the following parameter(s):
    - `$urlQuery`
    - `$parameter`
- _Returns:_ Parameter value if found (can be the empty string!), null if not found.
    - `string`
    - `null`

<a name="getpathandqueryfromurl" id="getpathandqueryfromurl"></a>
<a name="getPathAndQueryFromUrl" id="getPathAndQueryFromUrl"></a>
### `getPathAndQueryFromUrl()`

Returns the path and query string of a URL.

#### Signature

- It accepts the following parameter(s):
    - `$url`
- _Returns:_ eg, `/test/index.php?module=CoreHome` if `$url` is `http://piwik.org/test/index.php?module=CoreHome`.
    - `string`

