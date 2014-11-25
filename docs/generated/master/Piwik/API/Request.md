<small>Piwik\API\</small>

Request
=======

Dispatches API requests to the appropriate API method.

The Request class is used throughout Piwik to call API methods. The difference
between using Request and calling API methods directly is that Request
will do more after calling the API including: applying generic filters, applying queued filters,
and handling the **flat** and **label** query parameters.

Additionally, the Request class will **forward current query parameters** to the request
which is more convenient than calling [Common::getRequestVar()](/api-reference/Piwik/Common#getrequestvar) many times over.

In most cases, using a Request object to query the API is the correct approach.

### Post-processing

The return value of API methods undergo some extra processing before being returned by Request.
To learn more about what happens to API results, read [this](/guides/piwiks-web-api#extra-report-processing).

### Output Formats

The value returned by Request will be serialized to a certain format before being returned.
To see the list of supported output formats, read [this](/guides/piwiks-web-api#output-formats).

### Examples

**Basic Usage**

    $request = new Request('method=UserSettings.getWideScreen&idSite=1&date=yesterday&period=week'
                         . '&format=xml&filter_limit=5&filter_offset=0')
    $result = $request->process();
    echo $result;

**Getting a unrendered DataTable**

    // use the convenience method 'processRequest'
    $dataTable = Request::processRequest('UserSettings.getWideScreen', array(
        'idSite' => 1,
        'date' => 'yesterday',
        'period' => 'week',
        'filter_limit' => 5,
        'filter_offset' => 0

        'format' => 'original', // this is the important bit
    ));
    echo "This DataTable has " . $dataTable->getRowsCount() . " rows.";

Methods
-------

The class defines the following methods:

- [`getRequestArrayFromString()`](#getrequestarrayfromstring) &mdash; Converts the supplied request string into an array of query paramater name/value mappings.
- [`__construct()`](#__construct) &mdash; Constructor.
- [`process()`](#process) &mdash; Dispatches the API request to the appropriate API method and returns the result after post-processing.
- [`getClassNameAPI()`](#getclassnameapi) &mdash; Returns the name of a plugin's API class by plugin name.
- [`processRequest()`](#processrequest) &mdash; Helper method that processes an API request in one line using the variables in `$_GET` and `$_POST`.
- [`getRequestParametersGET()`](#getrequestparametersget) &mdash; Returns the original request parameters in the current query string as an array mapping query parameter names with values.
- [`getBaseReportUrl()`](#getbasereporturl) &mdash; Returns the URL for the current requested report w/o any filter parameters.
- [`getCurrentUrlWithoutGenericFilters()`](#getcurrenturlwithoutgenericfilters) &mdash; Returns the current URL without generic filter query parameters.
- [`shouldLoadFlatten()`](#shouldloadflatten)
- [`getRawSegmentFromRequest()`](#getrawsegmentfromrequest) &mdash; Returns the segment query parameter from the original request, without modifications.

<a name="getrequestarrayfromstring" id="getrequestarrayfromstring"></a>
<a name="getRequestArrayFromString" id="getRequestArrayFromString"></a>
### `getRequestArrayFromString()`

Converts the supplied request string into an array of query paramater name/value mappings.

The current query parameters (everything in `$_GET` and `$_POST`) are
forwarded to request array before it is returned.

#### Signature

-  It accepts the following parameter(s):
    - `$request` (`string`|`array`) &mdash;
       The base request string or array, eg, `'module=UserSettings&action=getWidescreen'`.
- It returns a `array` value.

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

-  It accepts the following parameter(s):
    - `$request` (`string`|`array`) &mdash;
       Query string that defines the API call (must at least contain a **method** parameter), eg, `'method=UserSettings.getWideScreen&idSite=1&date=yesterday&period=week&format=xml'` If a request is not provided, then we use the values in the `$_GET` and `$_POST` superglobals.

<a name="process" id="process"></a>
<a name="process" id="process"></a>
### `process()`

Dispatches the API request to the appropriate API method and returns the result after post-processing.

Post-processing includes:

- flattening if **flat** is 0
- running generic filters unless **disable_generic_filters** is set to 1
- URL decoding label column values
- running queued filters unless **disable_queued_filters** is set to 1
- removing columns based on the values of the **hideColumns** and **showColumns** query parameters
- filtering rows if the **label** query parameter is set
- converting the result to the appropriate format (ie, XML, JSON, etc.)

If `'original'` is supplied for the output format, the result is returned as a PHP
object.

#### Signature


- *Returns:*  [`DataTable`](../../Piwik/DataTable.md)|`Piwik\API\Map`|`string` &mdash;
    The data resulting from the API call.
- It throws one of the following exceptions:
    - `PluginDeactivatedException` &mdash; if the module plugin is not activated.
    - [`Exception`](http://php.net/class.Exception) &mdash; if the requested API method cannot be called, if required parameters for the API method are missing or if the API method throws an exception and the **format** query parameter is **original**.

<a name="getclassnameapi" id="getclassnameapi"></a>
<a name="getClassNameAPI" id="getClassNameAPI"></a>
### `getClassNameAPI()`

Returns the name of a plugin's API class by plugin name.

#### Signature

-  It accepts the following parameter(s):
    - `$plugin` (`string`) &mdash;
       The plugin name, eg, `'Referrers'`.

- *Returns:*  `string` &mdash;
    The fully qualified API class name, eg, `'\Piwik\Plugins\Referrers\API'`.

<a name="processrequest" id="processrequest"></a>
<a name="processRequest" id="processRequest"></a>
### `processRequest()`

Helper method that processes an API request in one line using the variables in `$_GET` and `$_POST`.

#### Signature

-  It accepts the following parameter(s):
    - `$method` (`string`) &mdash;
       The API method to call, ie, `'Actions.getPageTitles'`.
    - `$paramOverride` (`array`) &mdash;
       The parameter name-value pairs to use instead of what's in `$_GET` & `$_POST`.

- *Returns:*  `mixed` &mdash;
    The result of the API request. See [process()](/api-reference/Piwik/API/Request#process).

<a name="getrequestparametersget" id="getrequestparametersget"></a>
<a name="getRequestParametersGET" id="getRequestParametersGET"></a>
### `getRequestParametersGET()`

Returns the original request parameters in the current query string as an array mapping query parameter names with values.

The result of this function will not be affected
by any modifications to `$_GET` and will not include parameters in `$_POST`.

#### Signature

- It returns a `array` value.

<a name="getbasereporturl" id="getbasereporturl"></a>
<a name="getBaseReportUrl" id="getBaseReportUrl"></a>
### `getBaseReportUrl()`

Returns the URL for the current requested report w/o any filter parameters.

#### Signature

-  It accepts the following parameter(s):
    - `$module` (`string`) &mdash;
       The API module.
    - `$action` (`string`) &mdash;
       The API action.
    - `$queryParams` (`array`) &mdash;
       Query parameter overrides.
- It returns a `string` value.

<a name="getcurrenturlwithoutgenericfilters" id="getcurrenturlwithoutgenericfilters"></a>
<a name="getCurrentUrlWithoutGenericFilters" id="getCurrentUrlWithoutGenericFilters"></a>
### `getCurrentUrlWithoutGenericFilters()`

Returns the current URL without generic filter query parameters.

#### Signature

-  It accepts the following parameter(s):
    - `$params` (`array`) &mdash;
       Query parameter values to override in the new URL.
- It returns a `string` value.

<a name="shouldloadflatten" id="shouldloadflatten"></a>
<a name="shouldLoadFlatten" id="shouldLoadFlatten"></a>
### `shouldLoadFlatten()`

#### Signature

- It returns a `bool` value.

<a name="getrawsegmentfromrequest" id="getrawsegmentfromrequest"></a>
<a name="getRawSegmentFromRequest" id="getRawSegmentFromRequest"></a>
### `getRawSegmentFromRequest()`

Returns the segment query parameter from the original request, without modifications.

#### Signature


- *Returns:*  `array`|`bool` &mdash;
    

