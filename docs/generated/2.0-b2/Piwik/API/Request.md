<small>Piwik\API</small>

Request
=======

Dispatches API requests to the appropriate API method.

Description
-----------

The Request class is used throughout Piwik to call API methods. The difference
between using Request and calling API methods directly is that Request
will do more after calling the API including: apply generic filters, apply queued filters,
and handle the **flat** and **label** query parameters.

Additionally, the Request class will **forward current query parameters** to the request
which is more convenient than calling [Common::getRequestVar](#) many times over.

In most cases, using a Request object to query the API is the right way to go.

### Examples

**Basic Usage**

    $request = new Request('method=UserSettings.getWideScreen&idSite=1&date=yesterday&period=week'
                         . '&format=xml&filter_limit=5&filter_offset=0')
    $result = $request->process();
    echo $result;

**Getting a unrendered DataTable**

    // use convenience the convenience method 'processRequest'
    $dataTable = Request::processRequest('UserSettings.getWideScreen', array(
        'idSite' => 1,
        'date' => 'yesterday',
        'period' => 'week',
        'format' => 'original', // this is the important bit
        'filter_limit' => 5,
        'filter_offset' => 0
    ));
    echo "This DataTable has " . $dataTable->getRowsCount() . " rows.";


Methods
-------

The class defines the following methods:

- [`getRequestArrayFromString()`](#getRequestArrayFromString) &mdash; Converts the supplied request string into an array of query paramater name/value mappings.
- [`__construct()`](#__construct) &mdash; Constructor.
- [`renameModule()`](#renameModule) &mdash; For backward compatibility: Piwik API still works if module=Referers, we rewrite to correct renamed plugin: Referrers
- [`process()`](#process) &mdash; Dispatches the API request to the appropriate API method and returns the result after post-processing.
- [`getClassNameAPI()`](#getClassNameAPI) &mdash; Returns the class name of a plugin's API given the plugin name.
- [`reloadAuthUsingTokenAuth()`](#reloadAuthUsingTokenAuth) &mdash; If the token_auth is found in the $request parameter, the current session will be authenticated using this token_auth.
- [`processRequest()`](#processRequest) &mdash; Helper method that processes an API request in one line using the variables in `$_GET` and `$_POST`.
- [`getRequestParametersGET()`](#getRequestParametersGET) &mdash; Returns the original request parameters in the current query string as an array mapping query parameter names with values.
- [`getBaseReportUrl()`](#getBaseReportUrl) &mdash; Returns URL for the current requested report w/o any filter parameters.
- [`getCurrentUrlWithoutGenericFilters()`](#getCurrentUrlWithoutGenericFilters) &mdash; Returns the current URL without generic filter query parameters.
- [`shouldLoadExpanded()`](#shouldLoadExpanded) &mdash; Returns whether the DataTable result will have to be expanded for the current request before rendering.
- [`getRawSegmentFromRequest()`](#getRawSegmentFromRequest) &mdash; Returns the unmodified segment from the original request.

<a name="getrequestarrayfromstring" id="getrequestarrayfromstring"></a>
### `getRequestArrayFromString()`

Converts the supplied request string into an array of query paramater name/value mappings.

#### Description

The current query parameters (everything in `$_GET` and `$_POST`) are
forwarded to request array before it is returned.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$request`
- It returns a(n) `array` value.

<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$request`
- It does not return anything.

<a name="renamemodule" id="renamemodule"></a>
### `renameModule()`

For backward compatibility: Piwik API still works if module=Referers, we rewrite to correct renamed plugin: Referrers

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$module`
- It returns a(n) `string` value.

<a name="process" id="process"></a>
### `process()`

Dispatches the API request to the appropriate API method and returns the result after post-processing.

#### Description

Post-processing includes:

- flattening if **flat** is 0
- running generic filters unless **disable_generic_filters** is set to 1
- URL decoding label column values
- running queued filters unless **disable_queued_filters** is set to 1
- removes columns based on the values of the **hideColumns** and **showColumns** query parameters
- filters rows if the **label** query parameter is set

#### Signature

- It is a **public** method.
- _Returns:_ The data resulting from the API call.
    - [`DataTable`](../../Piwik/DataTable.md)
    - `Piwik\API\Map`
    - `string`
- It throws one of the following exceptions:
    - `PluginDeactivatedException` &mdash; if the module plugin is not activated.
    - [`Exception`](http://php.net/class.Exception) &mdash; if the requested API method cannot be called, if required parameters for the API method are missing or if the API method throws an exception and the **format** query parameter is **original**.

<a name="getclassnameapi" id="getclassnameapi"></a>
### `getClassNameAPI()`

Returns the class name of a plugin's API given the plugin name.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$plugin`
- It returns a(n) `string` value.

<a name="reloadauthusingtokenauth" id="reloadauthusingtokenauth"></a>
### `reloadAuthUsingTokenAuth()`

If the token_auth is found in the $request parameter, the current session will be authenticated using this token_auth.

#### Description

It will overwrite the previous Auth object.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$request`
- It returns a(n) `void` value.

<a name="processrequest" id="processrequest"></a>
### `processRequest()`

Helper method that processes an API request in one line using the variables in `$_GET` and `$_POST`.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$method`
    - `$paramOverride`
- _Returns:_ The result of the API request.
    - `mixed`

<a name="getrequestparametersget" id="getrequestparametersget"></a>
### `getRequestParametersGET()`

Returns the original request parameters in the current query string as an array mapping query parameter names with values.

#### Description

This result of this function will not be affected
by any modifications to `$_GET` and will not include parameters in `$_POST`.

#### Signature

- It is a **public static** method.
- It returns a(n) `array` value.

<a name="getbasereporturl" id="getbasereporturl"></a>
### `getBaseReportUrl()`

Returns URL for the current requested report w/o any filter parameters.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$module`
    - `$action`
    - `$queryParams`
- It returns a(n) `string` value.

<a name="getcurrenturlwithoutgenericfilters" id="getcurrenturlwithoutgenericfilters"></a>
### `getCurrentUrlWithoutGenericFilters()`

Returns the current URL without generic filter query parameters.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$params`
- It returns a(n) `string` value.

<a name="shouldloadexpanded" id="shouldloadexpanded"></a>
### `shouldLoadExpanded()`

Returns whether the DataTable result will have to be expanded for the current request before rendering.

#### Signature

- It is a **public static** method.
- It returns a(n) `bool` value.

<a name="getrawsegmentfromrequest" id="getrawsegmentfromrequest"></a>
### `getRawSegmentFromRequest()`

Returns the unmodified segment from the original request.

#### Signature

- It is a **public static** method.
- It can return one of the following values:
    - `array`
    - `bool`

