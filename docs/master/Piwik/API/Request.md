<small>Piwik\API</small>

Request
=======

An API request is the object used to make a call to the API and get the result.

Description
-----------

The request has the format of a normal GET request, ie. parameter_1=X&amp;parameter_2=Y

You can use this object from anywhere in piwik (inside plugins for example).
You can even call it outside of piwik  using the REST API over http
or in a php script on the same server as piwik, by including piwik/index.php
(see examples in the documentation http://piwik.org/docs/analytics-api)

Example:
$request = new Request(&#039;
               method=UserSettings.getWideScreen
               &amp;idSite=1
           &amp;date=yesterday
               &amp;period=week
               &amp;format=xml
               &amp;filter_limit=5
               &amp;filter_offset=0
   &#039;);
   $result = $request-&gt;process();
 echo $result;


Methods
-------

The class defines the following methods:

- [`getRequestArrayFromString()`](#getRequestArrayFromString) &mdash; Returns the request array as string
- [`__construct()`](#__construct) &mdash; Constructs the request to the API, given the request url
- [`process()`](#process) &mdash; Handles the request to the API.
- [`getClassNameAPI()`](#getClassNameAPI)
- [`reloadAuthUsingTokenAuth()`](#reloadAuthUsingTokenAuth) &mdash; If the token_auth is found in the $request parameter, the current session will be authenticated using this token_auth.
- [`processRequest()`](#processRequest) &mdash; Helper method to process an API request using the variables in $_GET and $_POST.
- [`getRequestParametersGET()`](#getRequestParametersGET)
- [`getCurrentUrlWithoutGenericFilters()`](#getCurrentUrlWithoutGenericFilters) &mdash; Returns the current URL without generic filter query parameters.
- [`getRawSegmentFromRequest()`](#getRawSegmentFromRequest)

### `getRequestArrayFromString()` <a name="getRequestArrayFromString"></a>

Returns the request array as string

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$request`
- It can return one of the following values:
    - `array`
    - `null`

### `__construct()` <a name="__construct"></a>

Constructs the request to the API, given the request url

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$request`
- It does not return anything.

### `process()` <a name="process"></a>

Handles the request to the API.

#### Description

It first checks that the method called (parameter &#039;method&#039;) is available in the module (it means that the method exists and is public)
It then reads the parameters from the request string and throws an exception if there are missing parameters.
It then calls the API Proxy which will call the requested method.

#### Signature

- It is a **public** method.
- _Returns:_ The data resulting from the API call
    - [`DataTable`](../../Piwik/DataTable.md)
    - `mixed`
- It throws one of the following exceptions:
    - `PluginDeactivatedException`

### `getClassNameAPI()` <a name="getClassNameAPI"></a>

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$module`
- It does not return anything.

### `reloadAuthUsingTokenAuth()` <a name="reloadAuthUsingTokenAuth"></a>

If the token_auth is found in the $request parameter, the current session will be authenticated using this token_auth.

#### Description

It will overwrite the previous Auth object.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$request`
- It returns a(n) `void` value.

### `processRequest()` <a name="processRequest"></a>

Helper method to process an API request using the variables in $_GET and $_POST.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$method`
    - `$paramOverride`
- _Returns:_ The result of the API request.
    - `mixed`

### `getRequestParametersGET()` <a name="getRequestParametersGET"></a>

#### Signature

- It is a **public static** method.
- It returns a(n) `array` value.

### `getCurrentUrlWithoutGenericFilters()` <a name="getCurrentUrlWithoutGenericFilters"></a>

Returns the current URL without generic filter query parameters.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$params`
- It returns a(n) `string` value.

### `getRawSegmentFromRequest()` <a name="getRawSegmentFromRequest"></a>

#### Signature

- It is a **public static** method.
- It can return one of the following values:
    - `array`
    - `bool`

