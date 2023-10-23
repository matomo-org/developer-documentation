<small>Piwik\</small>

UrlHelper
=========

Contains less commonly needed URL helper methods.

Methods
-------

The class defines the following methods:

- [`getQueryStringWithExcludedParameters()`](#getquerystringwithexcludedparameters) &mdash; Converts an array of query parameter name/value mappings into a query string.
- [`isLookLikeUrl()`](#islooklikeurl) &mdash; Returns true if the string passed may be a URL ie.
- [`getParseUrlReverse()`](#getparseurlreverse) &mdash; Returns a URL created from the result of the [parse_url](http://php.net/manual/en/function.parse-url.php) function.
- [`getArrayFromQueryString()`](#getarrayfromquerystring) &mdash; Returns a URL query string as an array.
- [`getParameterFromQueryString()`](#getparameterfromquerystring) &mdash; Returns the value of a single query parameter from the supplied query string.
- [`getPathAndQueryFromUrl()`](#getpathandqueryfromurl) &mdash; Returns the path and query string of a URL.
- [`getQueryFromUrl()`](#getqueryfromurl) &mdash; Returns the query part from any valid url and adds additional parameters to the query part if needed.

<a name="getquerystringwithexcludedparameters" id="getquerystringwithexcludedparameters"></a>
<a name="getQueryStringWithExcludedParameters" id="getQueryStringWithExcludedParameters"></a>
### `getQueryStringWithExcludedParameters()`

Converts an array of query parameter name/value mappings into a query string.

Parameters that are in `$parametersToExclude` will not appear in the result.

#### Signature

-  It accepts the following parameter(s):
    - `$queryParameters`
       Array of query parameters, eg, `array('site' => '0', 'date' => '2012-01-01')`.
    - `$parametersToExclude`
       Array of query parameter names that shouldn't be in the result query string, eg, `array('date', 'period')`.

- *Returns:*  `string` &mdash;
    A query string, eg, `"?site=0"`.

<a name="islooklikeurl" id="islooklikeurl"></a>
<a name="isLookLikeUrl" id="isLookLikeUrl"></a>
### `isLookLikeUrl()`

Returns true if the string passed may be a URL ie. it starts with protocol://.

We don't need a precise test here because the value comes from the website
tracked source code and the URLs may look very strange.

#### Signature

-  It accepts the following parameter(s):
    - `$url` (`string`) &mdash;
      
- It returns a `bool` value.

<a name="getparseurlreverse" id="getparseurlreverse"></a>
<a name="getParseUrlReverse" id="getParseUrlReverse"></a>
### `getParseUrlReverse()`

Returns a URL created from the result of the [parse_url](http://php.net/manual/en/function.parse-url.php)
function.

Copied from the PHP comments at [http://php.net/parse_url](http://php.net/parse_url).

#### Signature

-  It accepts the following parameter(s):
    - `$parsed` (`array`) &mdash;
       Result of [parse_url](http://php.net/manual/en/function.parse-url.php).

- *Returns:*  `false`|`string` &mdash;
    The URL or `false` if `$parsed` isn't an array.

<a name="getarrayfromquerystring" id="getarrayfromquerystring"></a>
<a name="getArrayFromQueryString" id="getArrayFromQueryString"></a>
### `getArrayFromQueryString()`

Returns a URL query string as an array.

#### Signature

-  It accepts the following parameter(s):
    - `$urlQuery` (`string`) &mdash;
       The query string, eg, `'?param1=value1&param2=value2'`.

- *Returns:*  `array` &mdash;
    eg, `array('param1' => 'value1', 'param2' => 'value2')`

<a name="getparameterfromquerystring" id="getparameterfromquerystring"></a>
<a name="getParameterFromQueryString" id="getParameterFromQueryString"></a>
### `getParameterFromQueryString()`

Returns the value of a single query parameter from the supplied query string.

#### Signature

-  It accepts the following parameter(s):
    - `$urlQuery` (`string`) &mdash;
       The query string.
    - `$parameter` (`string`) &mdash;
       The query parameter name to return.

- *Returns:*  `string`|`null` &mdash;
    Parameter value if found (can be the empty string!), null if not found.

<a name="getpathandqueryfromurl" id="getpathandqueryfromurl"></a>
<a name="getPathAndQueryFromUrl" id="getPathAndQueryFromUrl"></a>
### `getPathAndQueryFromUrl()`

Returns the path and query string of a URL.

#### Signature

-  It accepts the following parameter(s):
    - `$url` (`string`) &mdash;
       The URL.
    - `$additionalParamsToAdd` (`array`) &mdash;
       If not empty the given parameters will be added to the query.
    - `$preserveAnchor` (`bool`) &mdash;
       If true then do not remove any #anchor from the url, default false

- *Returns:*  `string` &mdash;
    eg, `/test/index.php?module=CoreHome` if `$url` is `http://piwik.org/test/index.php?module=CoreHome`.

<a name="getqueryfromurl" id="getqueryfromurl"></a>
<a name="getQueryFromUrl" id="getQueryFromUrl"></a>
### `getQueryFromUrl()`

Returns the query part from any valid url and adds additional parameters to the query part if needed.

#### Signature

-  It accepts the following parameter(s):
    - `$url` (`string`) &mdash;
       Any url eg `"http://example.com/piwik/?foo=bar"`
    - `$additionalParamsToAdd` (`array`) &mdash;
       If not empty the given parameters will be added to the query.

- *Returns:*  `string` &mdash;
    eg. `"foo=bar&foo2=bar2"`

