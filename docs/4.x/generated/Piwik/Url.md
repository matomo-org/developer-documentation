<small>Piwik\</small>

Url
===

Provides URL related helper methods.

This class provides simple methods that can be used to parse and modify
the current URL. It is most useful when plugins need to redirect the current
request to a URL and when they need to link to other parts of Piwik in
HTML.

### Examples

**Redirect to a different controller action**

    public function myControllerAction()
    {
        $url = Url::getCurrentQueryStringWithParametersModified(array(
            'module' => 'DevicesDetection',
            'action' => 'index'
        ));
        Url::redirectToUrl($url);
    }

**Link to a different controller action in a template**

    public function myControllerAction()
    {
        $url = Url::getCurrentQueryStringWithParametersModified(array(
            'module' => 'UserCountryMap',
            'action' => 'realtimeMap',
            'changeVisitAlpha' => 0,
            'removeOldVisits' => 0
        ));
        $view = new View("@MyPlugin/myPopup");
        $view->realtimeMapUrl = $url;
        return $view->render();
    }

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
- [`getArrayFromCurrentQueryString()`](#getarrayfromcurrentquerystring) &mdash; Returns an array mapping query parameter names with query parameter values for the current URL.
- [`getCurrentQueryStringWithParametersModified()`](#getcurrentquerystringwithparametersmodified) &mdash; Modifies the current query string with the supplied parameters and returns the result.
- [`getQueryStringFromParameters()`](#getquerystringfromparameters) &mdash; Converts an array of parameters name => value mappings to a query string.
- [`redirectToReferrer()`](#redirecttoreferrer) &mdash; Redirects the user to the referrer.
- [`redirectToUrl()`](#redirecttourl) &mdash; Redirects the user to the specified URL.
- [`getReferrer()`](#getreferrer) &mdash; Returns the **HTTP_REFERER** `$_SERVER` variable, or `false` if not found.
- [`isLocalUrl()`](#islocalurl) &mdash; Returns `true` if the URL points to something on the same host, `false` if otherwise.

<a name="getcurrenturl" id="getcurrenturl"></a>
<a name="getCurrentUrl" id="getCurrentUrl"></a>
### `getCurrentUrl()`

Returns the current URL.

#### Signature


- *Returns:*  `string` &mdash;
    eg, `"http://example.org/dir1/dir2/index.php?param1=value1&param2=value2"`

<a name="getcurrenturlwithoutquerystring" id="getcurrenturlwithoutquerystring"></a>
<a name="getCurrentUrlWithoutQueryString" id="getCurrentUrlWithoutQueryString"></a>
### `getCurrentUrlWithoutQueryString()`

Returns the current URL without the query string.

#### Signature

-  It accepts the following parameter(s):
    - `$checkTrustedHost` (`bool`) &mdash;
       Whether to do trusted host check. Should ALWAYS be true, except in [Controller](/api-reference/Piwik/Plugin/Controller).

- *Returns:*  `string` &mdash;
    eg, `"http://example.org/dir1/dir2/index.php"` if the current URL is
               `"http://example.org/dir1/dir2/index.php?param1=value1&param2=value2"`.

<a name="getcurrenturlwithoutfilename" id="getcurrenturlwithoutfilename"></a>
<a name="getCurrentUrlWithoutFileName" id="getCurrentUrlWithoutFileName"></a>
### `getCurrentUrlWithoutFileName()`

Returns the current URL without the query string and without the name of the file
being executed.

#### Signature


- *Returns:*  `string` &mdash;
    eg, `"http://example.org/dir1/dir2/"` if the current URL is
               `"http://example.org/dir1/dir2/index.php?param1=value1&param2=value2"`.

<a name="getcurrentscriptpath" id="getcurrentscriptpath"></a>
<a name="getCurrentScriptPath" id="getCurrentScriptPath"></a>
### `getCurrentScriptPath()`

Returns the path to the script being executed. The script file name is not included.

#### Signature


- *Returns:*  `string` &mdash;
    eg, `"/dir1/dir2/"` if the current URL is
               `"http://example.org/dir1/dir2/index.php?param1=value1&param2=value2"`

<a name="getcurrentscriptname" id="getcurrentscriptname"></a>
<a name="getCurrentScriptName" id="getCurrentScriptName"></a>
### `getCurrentScriptName()`

Returns the path to the script being executed. Includes the script file name.

#### Signature

-  It accepts the following parameter(s):
    - `$removePathInfo` (`bool`) &mdash;
       If true (default value) then the PATH_INFO will be stripped.

- *Returns:*  `string` &mdash;
    eg, `"/dir1/dir2/index.php"` if the current URL is
               `"http://example.org/dir1/dir2/index.php?param1=value1&param2=value2"`

<a name="getcurrentscheme" id="getcurrentscheme"></a>
<a name="getCurrentScheme" id="getCurrentScheme"></a>
### `getCurrentScheme()`

Returns the current URL's protocol.

#### Signature


- *Returns:*  `string` &mdash;
    `'https'` or `'http'`

<a name="getcurrenthost" id="getcurrenthost"></a>
<a name="getCurrentHost" id="getCurrentHost"></a>
### `getCurrentHost()`

Returns the current host.

#### Signature

-  It accepts the following parameter(s):
    - `$default` (`string`) &mdash;
       Default value to return if host unknown
    - `$checkTrustedHost` (`bool`) &mdash;
       Whether to do trusted host check. Should ALWAYS be true, except in Controller.

- *Returns:*  `string` &mdash;
    eg, `"example.org"` if the current URL is
               `"http://example.org/dir1/dir2/index.php?param1=value1&param2=value2"`

<a name="getcurrentquerystring" id="getcurrentquerystring"></a>
<a name="getCurrentQueryString" id="getCurrentQueryString"></a>
### `getCurrentQueryString()`

Returns the query string of the current URL.

#### Signature


- *Returns:*  `string` &mdash;
    eg, `"?param1=value1&param2=value2"` if the current URL is
               `"http://example.org/dir1/dir2/index.php?param1=value1&param2=value2"`

<a name="getarrayfromcurrentquerystring" id="getarrayfromcurrentquerystring"></a>
<a name="getArrayFromCurrentQueryString" id="getArrayFromCurrentQueryString"></a>
### `getArrayFromCurrentQueryString()`

Returns an array mapping query parameter names with query parameter values for
the current URL.

#### Signature


- *Returns:*  `array` &mdash;
    If current URL is `"http://example.org/dir1/dir2/index.php?param1=value1&param2=value2"`
              this will return:

                  array(
                      'param1' => string 'value1',
                      'param2' => string 'value2'
                  )

<a name="getcurrentquerystringwithparametersmodified" id="getcurrentquerystringwithparametersmodified"></a>
<a name="getCurrentQueryStringWithParametersModified" id="getCurrentQueryStringWithParametersModified"></a>
### `getCurrentQueryStringWithParametersModified()`

Modifies the current query string with the supplied parameters and returns
the result. Parameters in the current URL will be overwritten with values
in `$params` and parameters absent from the current URL but present in `$params`
will be added to the result.

#### Signature

-  It accepts the following parameter(s):
    - `$params` (`array`) &mdash;
       set of parameters to modify/add in the current URL eg, `array('param3' => 'value3')`

- *Returns:*  `string` &mdash;
    eg, `"?param2=value2&param3=value3"`

<a name="getquerystringfromparameters" id="getquerystringfromparameters"></a>
<a name="getQueryStringFromParameters" id="getQueryStringFromParameters"></a>
### `getQueryStringFromParameters()`

Converts an array of parameters name => value mappings to a query
string. Values must already be URL encoded before you call this function.

#### Signature

-  It accepts the following parameter(s):
    - `$parameters` (`array`) &mdash;
       eg. `array('param1' => 10, 'param2' => array(1,2))`

- *Returns:*  `string` &mdash;
    eg. `"param1=10&param2[]=1&param2[]=2"`

<a name="redirecttoreferrer" id="redirecttoreferrer"></a>
<a name="redirectToReferrer" id="redirectToReferrer"></a>
### `redirectToReferrer()`

Redirects the user to the referrer. If no referrer exists, the user is redirected
to the current URL without query string.

#### Signature

- It does not return anything or a mixed result.

<a name="redirecttourl" id="redirecttourl"></a>
<a name="redirectToUrl" id="redirectToUrl"></a>
### `redirectToUrl()`

Redirects the user to the specified URL.

#### Signature

-  It accepts the following parameter(s):
    - `$url` (`string`) &mdash;
      
- It does not return anything or a mixed result.
- It throws one of the following exceptions:
    - `Stmt_Namespace\Exception`

<a name="getreferrer" id="getreferrer"></a>
<a name="getReferrer" id="getReferrer"></a>
### `getReferrer()`

Returns the **HTTP_REFERER** `$_SERVER` variable, or `false` if not found.

#### Signature


- *Returns:*  `string`|`false` &mdash;
    

<a name="islocalurl" id="islocalurl"></a>
<a name="isLocalUrl" id="isLocalUrl"></a>
### `isLocalUrl()`

Returns `true` if the URL points to something on the same host, `false` if otherwise.

#### Signature

-  It accepts the following parameter(s):
    - `$url` (`string`) &mdash;
      

- *Returns:*  `bool` &mdash;
    True if local; false otherwise.

