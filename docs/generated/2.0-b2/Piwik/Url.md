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

- [`getCurrentUrl()`](#getCurrentUrl) &mdash; Returns the current URL.
- [`getCurrentUrlWithoutQueryString()`](#getCurrentUrlWithoutQueryString) &mdash; Returns the current URL without the query string.
- [`getCurrentUrlWithoutFileName()`](#getCurrentUrlWithoutFileName) &mdash; Returns the current URL without the query string and without the name of the file being executed.
- [`getCurrentScriptPath()`](#getCurrentScriptPath) &mdash; Returns the path to the script being executed.
- [`getCurrentScriptName()`](#getCurrentScriptName) &mdash; Returns the path to the script being executed.
- [`getCurrentScheme()`](#getCurrentScheme) &mdash; Returns the current URL's protocol.
- [`getCurrentHost()`](#getCurrentHost) &mdash; Returns the current host.
- [`getCurrentQueryString()`](#getCurrentQueryString) &mdash; Returns the query string of the current URL.
- [`getArrayFromCurrentQueryString()`](#getArrayFromCurrentQueryString) &mdash; Returns an array mapping query paramater names with query parameter values for the current URL.
- [`getQueryStringFromParameters()`](#getQueryStringFromParameters) &mdash; Converts an an array of parameters name => value mappings to a query string.
- [`redirectToReferrer()`](#redirectToReferrer) &mdash; Redirects the user to the referrer.
- [`redirectToUrl()`](#redirectToUrl) &mdash; Redirects the user to the specified URL.
- [`getReferrer()`](#getReferrer) &mdash; Returns the HTTP_REFERER header, or false if not found.
- [`isLocalUrl()`](#isLocalUrl) &mdash; Returns true if the URL points to something on the same host, false if otherwise.

<a name="getcurrenturl" id="getcurrenturl"></a>
### `getCurrentUrl()`

Returns the current URL.

#### Signature

- _Returns:_ eg, `"http://example.org/dir1/dir2/index.php?param1=value1&param2=value2"`
    - `string`

<a name="getcurrenturlwithoutquerystring" id="getcurrenturlwithoutquerystring"></a>
### `getCurrentUrlWithoutQueryString()`

Returns the current URL without the query string.

#### Signature

- It accepts the following parameter(s):
    - `$checkTrustedHost`
- _Returns:_ eg, `"http://example.org/dir1/dir2/index.php"` if the current URL is `"http://example.org/dir1/dir2/index.php?param1=value1&param2=value2"`.
    - `string`

<a name="getcurrenturlwithoutfilename" id="getcurrenturlwithoutfilename"></a>
### `getCurrentUrlWithoutFileName()`

Returns the current URL without the query string and without the name of the file being executed.

#### Signature

- _Returns:_ eg, `"http://example.org/dir1/dir2/"` if the current URL is `"http://example.org/dir1/dir2/index.php?param1=value1&param2=value2"`.
    - `string`

<a name="getcurrentscriptpath" id="getcurrentscriptpath"></a>
### `getCurrentScriptPath()`

Returns the path to the script being executed.

#### Description

The script file name is not included.

#### Signature

- _Returns:_ eg, `"/dir1/dir2/"` if the current URL is `"http://example.org/dir1/dir2/index.php?param1=value1&param2=value2"`
    - `string`

<a name="getcurrentscriptname" id="getcurrentscriptname"></a>
### `getCurrentScriptName()`

Returns the path to the script being executed.

#### Description

Includes the script file name.

#### Signature

- _Returns:_ eg, `"/dir1/dir2/index.php"` if the current URL is `"http://example.org/dir1/dir2/index.php?param1=value1&param2=value2"`
    - `string`

<a name="getcurrentscheme" id="getcurrentscheme"></a>
### `getCurrentScheme()`

Returns the current URL's protocol.

#### Signature

- _Returns:_ `'https'` or `'http'`
    - `string`

<a name="getcurrenthost" id="getcurrenthost"></a>
### `getCurrentHost()`

Returns the current host.

#### Signature

- It accepts the following parameter(s):
    - `$default`
    - `$checkTrustedHost`
- _Returns:_ eg, `"example.org"` if the current URL is `"http://example.org/dir1/dir2/index.php?param1=value1&param2=value2"`
    - `string`

<a name="getcurrentquerystring" id="getcurrentquerystring"></a>
### `getCurrentQueryString()`

Returns the query string of the current URL.

#### Signature

- _Returns:_ eg, `"?param1=value1&param2=value2"` if the current URL is `"http://example.org/dir1/dir2/index.php?param1=value1&param2=value2"`
    - `string`

<a name="getarrayfromcurrentquerystring" id="getarrayfromcurrentquerystring"></a>
### `getArrayFromCurrentQueryString()`

Returns an array mapping query paramater names with query parameter values for the current URL.

#### Signature

- _Returns:_ If current URL is `"http://example.org/dir1/dir2/index.php?param1=value1&param2=value2"` this will return: ``` array( 'param1' => string 'value1', 'param2' => string 'value2' ) ```
    - `array`

<a name="getquerystringfromparameters" id="getquerystringfromparameters"></a>
### `getQueryStringFromParameters()`

Converts an an array of parameters name => value mappings to a query string.

#### Signature

- It accepts the following parameter(s):
    - `$parameters`
- _Returns:_ eg. `"param1=10&param2[]=1&param2[]=2"`
    - `string`

<a name="redirecttoreferrer" id="redirecttoreferrer"></a>
### `redirectToReferrer()`

Redirects the user to the referrer.

#### Description

If no referrer exists, the user is redirected
to the current URL without query string.

#### Signature

- It does not return anything.

<a name="redirecttourl" id="redirecttourl"></a>
### `redirectToUrl()`

Redirects the user to the specified URL.

#### Signature

- It accepts the following parameter(s):
    - `$url`
- It does not return anything.

<a name="getreferrer" id="getreferrer"></a>
### `getReferrer()`

Returns the HTTP_REFERER header, or false if not found.

#### Signature

- It can return one of the following values:
    - `string`
    - `Piwik\false`

<a name="islocalurl" id="islocalurl"></a>
### `isLocalUrl()`

Returns true if the URL points to something on the same host, false if otherwise.

#### Signature

- It accepts the following parameter(s):
    - `$url`
- _Returns:_ True if local; false otherwise.
    - `bool`

