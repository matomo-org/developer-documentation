<small>Piwik</small>

Url
===

Provides URL related helper methods.

Description
-----------

This class provides simple methods that can be used to parse and modify
the current URL. It is most useful when plugins need to redirect the current
request to a URL and when they need to link to other parts of Piwik in
HTML.

### Examples

**Redirect to a different controller action**

    $url = Url::getCurrentQueryStringWithParametersModified(array(
        'module' => 'UserSettings',
        'action' => 'index'
    ));
    Url::redirectToUrl($url);

**Link to a different controller action in a template**

    $url = Url::getCurrentQueryStringWithParametersModified(array(
        'module' => 'UserCountryMap',
        'action' => 'realtimeMap',
        'changeVisitAlpha' => 0,
        'removeOldVisits' => 0
    ));
    $view = new View("@MyPlugin/myPopup");
    $view->realtimeMapUrl = $url;
    echo $view->render();

Methods
-------

The class defines the following methods:

- [`getCurrentUrl()`](#getcurrenturl) &mdash; Returns the current URL.
- [`getCurrentUrlWithoutQueryString()`](#getcurrenturlwithoutquerystring) &mdash; Returns the current URL without the query string.
- [`getCurrentUrlWithoutFileName()`](#getcurrenturlwithoutfilename) &mdash; Returns the current URL without the query string and without the name of the file being executed.
- [`getCurrentScriptPath()`](#getcurrentscriptpath) &mdash; Returns the path to the script being executed.
- [`getCurrentScriptName()`](#getcurrentscriptname) &mdash; Returns the path to the script being executed.
- [`getCurrentScheme()`](#getcurrentscheme) &mdash; Returns the current URL's protocol.
- [`getCurrentHost()`](#getcurrenthost) &mdash; Returns the current host.
- [`getCurrentQueryString()`](#getcurrentquerystring) &mdash; Returns the query string of the current URL.
- [`getArrayFromCurrentQueryString()`](#getarrayfromcurrentquerystring) &mdash; Returns an array mapping query paramater names with query parameter values for the current URL.
- [`getCurrentQueryStringWithParametersModified()`](#getcurrentquerystringwithparametersmodified) &mdash; Modifies the current query string with the supplied parameters and returns the result.
- [`getQueryStringFromParameters()`](#getquerystringfromparameters) &mdash; Converts an an array of parameters name => value mappings to a query string.
- [`redirectToReferrer()`](#redirecttoreferrer) &mdash; Redirects the user to the referrer.
- [`redirectToUrl()`](#redirecttourl) &mdash; Redirects the user to the specified URL.
- [`getReferrer()`](#getreferrer) &mdash; Returns the HTTP_REFERER header, or false if not found.
- [`isLocalUrl()`](#islocalurl) &mdash; Returns true if the URL points to something on the same host, false if otherwise.

<a name="getcurrenturl" id="getcurrenturl"></a>
<a name="getCurrentUrl" id="getCurrentUrl"></a>
### `getCurrentUrl()`

Returns the current URL.

#### Signature

- _Returns:_ eg, `"http://example.org/dir1/dir2/index.php?param1=value1&param2=value2"`
    - `string`

<a name="getcurrenturlwithoutquerystring" id="getcurrenturlwithoutquerystring"></a>
<a name="getCurrentUrlWithoutQueryString" id="getCurrentUrlWithoutQueryString"></a>
### `getCurrentUrlWithoutQueryString()`

Returns the current URL without the query string.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$checkTrustedHost` (`bool`) &mdash;

      <div markdown="1" class="param-desc"> Whether to do trusted host check. Should ALWAYS be true, except in Controller.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- _Returns:_ eg, `"http://example.org/dir1/dir2/index.php"` if the current URL is `"http://example.org/dir1/dir2/index.php?param1=value1&param2=value2"`.
    - `string`

<a name="getcurrenturlwithoutfilename" id="getcurrenturlwithoutfilename"></a>
<a name="getCurrentUrlWithoutFileName" id="getCurrentUrlWithoutFileName"></a>
### `getCurrentUrlWithoutFileName()`

Returns the current URL without the query string and without the name of the file being executed.

#### Signature

- _Returns:_ eg, `"http://example.org/dir1/dir2/"` if the current URL is `"http://example.org/dir1/dir2/index.php?param1=value1&param2=value2"`.
    - `string`

<a name="getcurrentscriptpath" id="getcurrentscriptpath"></a>
<a name="getCurrentScriptPath" id="getCurrentScriptPath"></a>
### `getCurrentScriptPath()`

Returns the path to the script being executed.

#### Description

The script file name is not included.

#### Signature

- _Returns:_ eg, `"/dir1/dir2/"` if the current URL is `"http://example.org/dir1/dir2/index.php?param1=value1&param2=value2"`
    - `string`

<a name="getcurrentscriptname" id="getcurrentscriptname"></a>
<a name="getCurrentScriptName" id="getCurrentScriptName"></a>
### `getCurrentScriptName()`

Returns the path to the script being executed.

#### Description

Includes the script file name.

#### Signature

- _Returns:_ eg, `"/dir1/dir2/index.php"` if the current URL is `"http://example.org/dir1/dir2/index.php?param1=value1&param2=value2"`
    - `string`

<a name="getcurrentscheme" id="getcurrentscheme"></a>
<a name="getCurrentScheme" id="getCurrentScheme"></a>
### `getCurrentScheme()`

Returns the current URL's protocol.

#### Signature

- _Returns:_ `'https'` or `'http'`
    - `string`

<a name="getcurrenthost" id="getcurrenthost"></a>
<a name="getCurrentHost" id="getCurrentHost"></a>
### `getCurrentHost()`

Returns the current host.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$default` (`string`) &mdash;

      <div markdown="1" class="param-desc"> Default value to return if host unknown</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$checkTrustedHost` (`bool`) &mdash;

      <div markdown="1" class="param-desc"> Whether to do trusted host check. Should ALWAYS be true, except in Controller.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- _Returns:_ eg, `"example.org"` if the current URL is `"http://example.org/dir1/dir2/index.php?param1=value1&param2=value2"`
    - `string`

<a name="getcurrentquerystring" id="getcurrentquerystring"></a>
<a name="getCurrentQueryString" id="getCurrentQueryString"></a>
### `getCurrentQueryString()`

Returns the query string of the current URL.

#### Signature

- _Returns:_ eg, `"?param1=value1&param2=value2"` if the current URL is `"http://example.org/dir1/dir2/index.php?param1=value1&param2=value2"`
    - `string`

<a name="getarrayfromcurrentquerystring" id="getarrayfromcurrentquerystring"></a>
<a name="getArrayFromCurrentQueryString" id="getArrayFromCurrentQueryString"></a>
### `getArrayFromCurrentQueryString()`

Returns an array mapping query paramater names with query parameter values for the current URL.

#### Signature

- _Returns:_ If current URL is `"http://example.org/dir1/dir2/index.php?param1=value1&param2=value2"` this will return: ``` array( 'param1' => string 'value1', 'param2' => string 'value2' ) ```
    - `array`

<a name="getcurrentquerystringwithparametersmodified" id="getcurrentquerystringwithparametersmodified"></a>
<a name="getCurrentQueryStringWithParametersModified" id="getCurrentQueryStringWithParametersModified"></a>
### `getCurrentQueryStringWithParametersModified()`

Modifies the current query string with the supplied parameters and returns the result.

#### Description

Parameters in the current URL will be overwritten with values
in `$params` and parameters absent from the current URL but present in `$params`
will be added to the result.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$params` (`array`) &mdash;

      <div markdown="1" class="param-desc"> set of parameters to modify/add in the current URL eg, `array('param3' => 'value3')`</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- _Returns:_ eg, `"?param2=value2&param3=value3"`
    - `string`

<a name="getquerystringfromparameters" id="getquerystringfromparameters"></a>
<a name="getQueryStringFromParameters" id="getQueryStringFromParameters"></a>
### `getQueryStringFromParameters()`

Converts an an array of parameters name => value mappings to a query string.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$parameters` (`array`) &mdash;

      <div markdown="1" class="param-desc"> eg. `array('param1' => 10, 'param2' => array(1,2))`</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- _Returns:_ eg. `"param1=10&param2[]=1&param2[]=2"`
    - `string`

<a name="redirecttoreferrer" id="redirecttoreferrer"></a>
<a name="redirectToReferrer" id="redirectToReferrer"></a>
### `redirectToReferrer()`

Redirects the user to the referrer.

#### Description

If no referrer exists, the user is redirected
to the current URL without query string.

#### Signature

- It does not return anything.

<a name="redirecttourl" id="redirecttourl"></a>
<a name="redirectToUrl" id="redirectToUrl"></a>
### `redirectToUrl()`

Redirects the user to the specified URL.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$url` (`string`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="getreferrer" id="getreferrer"></a>
<a name="getReferrer" id="getReferrer"></a>
### `getReferrer()`

Returns the HTTP_REFERER header, or false if not found.

#### Signature

- It can return one of the following values:
    - `string`
    - `Piwik\false`

<a name="islocalurl" id="islocalurl"></a>
<a name="isLocalUrl" id="isLocalUrl"></a>
### `isLocalUrl()`

Returns true if the URL points to something on the same host, false if otherwise.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$url` (`string`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- _Returns:_ True if local; false otherwise.
    - `bool`

