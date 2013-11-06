<small>Piwik\Plugin</small>

ViewDataTable
=============

This class is used to load (from the API) and customize the output of a given DataTable.

Description
-----------

You can build your own ViewDataTable by extending this class and implementing the buildView() method which defines
which data should be loaded and which view should be rendered.

Example usage:
In the Controller of the plugin VisitorInterest
<pre>
   function getNumberOfVisitsPerVisitDuration( $fetch = false)
 {
       $view = ViewDataTable::factory( 'cloud' );
       $view->init( $this->pluginName,  __FUNCTION__, 'VisitorInterest.getNumberOfVisitsPerVisitDuration' );
       $view->setColumnsToDisplay( array('label','nb_visits') );
       $view->disableSort();
       $view->disableExcludeLowPopulation();
       $view->disableOffsetInformation();

       return $this->renderView($view, $fetch);
   }
</pre>


Constants
---------

This abstract class defines the following constants:

- `ID`

Properties
----------

This abstract class defines the following properties:

- [`$dataTable`](#$datatable) &mdash; DataTable loaded from the API for this ViewDataTable.
- [`$config`](#$config)
- [`$requestConfig`](#$requestconfig)
- [`$request`](#$request)

<a name="datatable" id="datatable"></a>
### `$dataTable`

DataTable loaded from the API for this ViewDataTable.

#### Signature

- It is a(n) [`DataTable`](../../Piwik/DataTable.md) value.

<a name="config" id="config"></a>
### `$config`

#### Signature

- It is a(n) `Piwik\ViewDataTable\Config` value.

<a name="requestconfig" id="requestconfig"></a>
### `$requestConfig`

#### Signature

- It is a(n) `Piwik\ViewDataTable\RequestConfig` value.

<a name="request" id="request"></a>
### `$request`

#### Signature

- It is a(n) `Piwik\ViewDataTable\Request` value.

Methods
-------

The abstract class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`getDefaultConfig()`](#getdefaultconfig) &mdash; Returns the default config.
- [`getDefaultRequestConfig()`](#getdefaultrequestconfig) &mdash; Returns the default request config.
- [`loadDataTableFromAPI()`](#loaddatatablefromapi)
- [`getViewDataTableId()`](#getviewdatatableid) &mdash; Returns the viewDataTable ID for this DataTable visualization.
- [`isViewDataTableId()`](#isviewdatatableid) &mdash; Detects whether the viewDataTable or one of its ancestors has the given id.
- [`getDataTable()`](#getdatatable) &mdash; Returns the DataTable loaded from the API
- [`setDataTable()`](#setdatatable) &mdash; To prevent calling an API multiple times, the DataTable can be set directly.
- [`checkStandardDataTable()`](#checkstandarddatatable) &mdash; Checks that the API returned a normal DataTable (as opposed to DataTable\Map)
- [`render()`](#render) &mdash; Requests all needed data and renders the view.
- [`buildView()`](#buildview)
- [`getDefaultDataTableCssClass()`](#getdefaultdatatablecssclass)
- [`getOverridableProperties()`](#getoverridableproperties) &mdash; Returns the list of view properties that can be overriden by query parameters.
- [`getPropertyFromQueryParam()`](#getpropertyfromqueryparam)
- [`isRequestingSingleDataTable()`](#isrequestingsingledatatable) &mdash; Determine if the view data table requests a single data table or not.
- [`canDisplayViewDataTable()`](#candisplayviewdatatable) &mdash; Here you can define whether your visualization can display a specific data table or not.

<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Description

Initializes the default config, requestConfig and the request itself. After configuring some
mandatory properties reports can modify the view by listening to the hook 'ViewDataTable.configure'.

#### Signature

- It accepts the following parameter(s):
    - `$controllerAction`
    - `$apiMethodToRequestDataTable`
- It does not return anything.

<a name="getdefaultconfig" id="getdefaultconfig"></a>
### `getDefaultConfig()`

Returns the default config.

#### Description

Custom viewDataTables can change the default config to their needs by either
modifying this config or creating an own Config class that extends the default Config.

#### Signature

- It returns a(n) `Piwik\ViewDataTable\Config` value.

<a name="getdefaultrequestconfig" id="getdefaultrequestconfig"></a>
### `getDefaultRequestConfig()`

Returns the default request config.

#### Description

Custom viewDataTables can change the default config to their needs by either
modifying this config or creating an own RequestConfig class that extends the default RequestConfig.

#### Signature

- It returns a(n) `Piwik\ViewDataTable\RequestConfig` value.

<a name="loaddatatablefromapi" id="loaddatatablefromapi"></a>
### `loadDataTableFromAPI()`

#### Signature

- It accepts the following parameter(s):
    - `$fixedRequestParams`
- It does not return anything.

<a name="getviewdatatableid" id="getviewdatatableid"></a>
### `getViewDataTableId()`

Returns the viewDataTable ID for this DataTable visualization.

#### Description

Derived classes  should declare a const ID field
with the viewDataTable ID.

#### Signature

- It returns a(n) `string` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

<a name="isviewdatatableid" id="isviewdatatableid"></a>
### `isViewDataTableId()`

Detects whether the viewDataTable or one of its ancestors has the given id.

#### Signature

- It accepts the following parameter(s):
    - `$viewDataTableId`
- It returns a(n) `bool` value.

<a name="getdatatable" id="getdatatable"></a>
### `getDataTable()`

Returns the DataTable loaded from the API

#### Signature

- It returns a(n) [`DataTable`](../../Piwik/DataTable.md) value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if not yet defined

<a name="setdatatable" id="setdatatable"></a>
### `setDataTable()`

To prevent calling an API multiple times, the DataTable can be set directly.

#### Description

It won't be loaded again from the API in this case

#### Signature

- It accepts the following parameter(s):
    - `$dataTable`
- _Returns:_ $dataTable DataTable
    - `void`

<a name="checkstandarddatatable" id="checkstandarddatatable"></a>
### `checkStandardDataTable()`

Checks that the API returned a normal DataTable (as opposed to DataTable\Map)

#### Signature

- It returns a(n) `void` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

<a name="render" id="render"></a>
### `render()`

Requests all needed data and renders the view.

#### Signature

- _Returns:_ The result of rendering.
    - `string`

<a name="buildview" id="buildview"></a>
### `buildView()`

#### Signature

- It does not return anything.

<a name="getdefaultdatatablecssclass" id="getdefaultdatatablecssclass"></a>
### `getDefaultDataTableCssClass()`

#### Signature

- It does not return anything.

<a name="getoverridableproperties" id="getoverridableproperties"></a>
### `getOverridableProperties()`

Returns the list of view properties that can be overriden by query parameters.

#### Signature

- It returns a(n) `array` value.

<a name="getpropertyfromqueryparam" id="getpropertyfromqueryparam"></a>
### `getPropertyFromQueryParam()`

#### Signature

- It accepts the following parameter(s):
    - `$name`
    - `$defaultValue`
- It does not return anything.

<a name="isrequestingsingledatatable" id="isrequestingsingledatatable"></a>
### `isRequestingSingleDataTable()`

Determine if the view data table requests a single data table or not.

#### Signature

- It returns a(n) `bool` value.

<a name="candisplayviewdatatable" id="candisplayviewdatatable"></a>
### `canDisplayViewDataTable()`

Here you can define whether your visualization can display a specific data table or not.

#### Description

For instance you may
only display your visualization in case a single data table is requested. If the method returns true, the footer
icon will be displayed.

#### Signature

- It accepts the following parameter(s):
    - `$view` ([`ViewDataTable`](../../Piwik/Plugin/ViewDataTable.md))
- It returns a(n) `bool` value.

