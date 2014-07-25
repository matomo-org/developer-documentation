<small>Piwik\</small>

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
- [`getQueryFromUrl()`](#getqueryfromurl) &mdash; Returns the query part from any valid url and adds additional parameters to the query part if needed.

<a name="getquerystringwithexcludedparameters" id="getquerystringwithexcludedparameters"></a>
<a name="getQueryStringWithExcludedParameters" id="getQueryStringWithExcludedParameters"></a>
### `getQueryStringWithExcludedParameters()` 
Converts an array of query parameter name/value mappings into a query string.

Parameters that are in `$parametersToExclude` will not appear in the result.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$queryParameters`

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$parametersToExclude`

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`string`) &mdash;
    <div markdown="1" class="param-desc">A query string, eg, `"?site=0"`.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="getparseurlreverse" id="getparseurlreverse"></a>
<a name="getParseUrlReverse" id="getParseUrlReverse"></a>
### `getParseUrlReverse()` 
Returns a URL created from the result of the [parse_url](http://php.net/manual/en/function.parse-url.php) function.

Copied from the PHP comments at [http://php.net/parse_url](http://php.net/parse_url).

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$parsed` (`array`) &mdash;

      <div markdown="1" class="param-desc"> Result of [parse_url](http://php.net/manual/en/function.parse-url.php).</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`Piwik\false`|`string`) &mdash;
    <div markdown="1" class="param-desc">The URL or `false` if `$parsed` isn't an array.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="getarrayfromquerystring" id="getarrayfromquerystring"></a>
<a name="getArrayFromQueryString" id="getArrayFromQueryString"></a>
### `getArrayFromQueryString()` 
Returns a URL query string as an array.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$urlQuery` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The query string, eg, `'?param1=value1&param2=value2'`.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`array`) &mdash;
    <div markdown="1" class="param-desc">eg, `array('param1' => 'value1', 'param2' => 'value2')`</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="getparameterfromquerystring" id="getparameterfromquerystring"></a>
<a name="getParameterFromQueryString" id="getParameterFromQueryString"></a>
### `getParameterFromQueryString()` 
Returns the value of a single query parameter from the supplied query string.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$urlQuery` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The query string.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$parameter` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The query parameter name to return.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`string`|`null`) &mdash;
    <div markdown="1" class="param-desc">Parameter value if found (can be the empty string!), null if not found.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="getpathandqueryfromurl" id="getpathandqueryfromurl"></a>
<a name="getPathAndQueryFromUrl" id="getPathAndQueryFromUrl"></a>
### `getPathAndQueryFromUrl()` 
Returns the path and query string of a URL.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$url` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The URL.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`string`) &mdash;
    <div markdown="1" class="param-desc">eg, `/test/index.php?module=CoreHome` if `$url` is `http://piwik.org/test/index.php?module=CoreHome`.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="getqueryfromurl" id="getqueryfromurl"></a>
<a name="getQueryFromUrl" id="getQueryFromUrl"></a>
### `getQueryFromUrl()` 
Returns the query part from any valid url and adds additional parameters to the query part if needed.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$url` (`string`) &mdash;

      <div markdown="1" class="param-desc"> Any url eg `"http://example.com/piwik/?foo=bar"`</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$additionalParamsToAdd` (`array`) &mdash;

      <div markdown="1" class="param-desc"> If not empty the given parameters will be added to the query.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`string`) &mdash;
    <div markdown="1" class="param-desc">eg. `"foo=bar&foo2=bar2"`</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

