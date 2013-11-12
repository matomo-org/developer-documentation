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

Properties
----------

This abstract class defines the following properties:

- [`$config`](#$config)
- [`$requestConfig`](#$requestconfig)

<a name="$config" id="$config"></a>
<a name="config" id="config"></a>
### `$config`

#### Signature

- It is a `Piwik\ViewDataTable\Config` value.

<a name="$requestconfig" id="$requestconfig"></a>
<a name="requestConfig" id="requestConfig"></a>
### `$requestConfig`

#### Signature

- It is a `Piwik\ViewDataTable\RequestConfig` value.

Methods
-------

The abstract class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`getDefaultConfig()`](#getdefaultconfig) &mdash; Returns the default config.
- [`getDefaultRequestConfig()`](#getdefaultrequestconfig) &mdash; Returns the default request config.
- [`getViewDataTableId()`](#getviewdatatableid) &mdash; Returns the viewDataTable ID for this DataTable visualization.
- [`isViewDataTableId()`](#isviewdatatableid) &mdash; Detects whether the viewDataTable or one of its ancestors has the given id.
- [`getDataTable()`](#getdatatable) &mdash; Returns the DataTable loaded from the API
- [`setDataTable()`](#setdatatable) &mdash; To prevent calling an API multiple times, the DataTable can be set directly.
- [`render()`](#render) &mdash; Requests all needed data and renders the view.
- [`isRequestingSingleDataTable()`](#isrequestingsingledatatable) &mdash; Determine if the view data table requests a single data table or not.
- [`canDisplayViewDataTable()`](#candisplayviewdatatable) &mdash; Here you can define whether your visualization can display a specific data table or not.

<a name="__construct" id="__construct"></a>
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

<a name="getdefaultconfig" id="getdefaultconfig"></a>
<a name="getDefaultConfig" id="getDefaultConfig"></a>
### `getDefaultConfig()`

Returns the default config.

#### Description

Custom viewDataTables can change the default config to their needs by either
modifying this config or creating an own Config class that extends the default Config.

#### Signature

- It returns a `Piwik\ViewDataTable\Config` value.

<a name="getdefaultrequestconfig" id="getdefaultrequestconfig"></a>
<a name="getDefaultRequestConfig" id="getDefaultRequestConfig"></a>
### `getDefaultRequestConfig()`

Returns the default request config.

#### Description

Custom viewDataTables can change the default config to their needs by either
modifying this config or creating an own RequestConfig class that extends the default RequestConfig.

#### Signature

- It returns a `Piwik\ViewDataTable\RequestConfig` value.

<a name="getviewdatatableid" id="getviewdatatableid"></a>
<a name="getViewDataTableId" id="getViewDataTableId"></a>
### `getViewDataTableId()`

Returns the viewDataTable ID for this DataTable visualization.

#### Description

Derived classes  should declare a const ID field
with the viewDataTable ID.

#### Signature

- It returns a `string` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

<a name="isviewdatatableid" id="isviewdatatableid"></a>
<a name="isViewDataTableId" id="isViewDataTableId"></a>
### `isViewDataTableId()`

Detects whether the viewDataTable or one of its ancestors has the given id.

#### Signature

- It accepts the following parameter(s):
    - `$viewDataTableId` (`string`)
- It returns a `bool` value.

<a name="getdatatable" id="getdatatable"></a>
<a name="getDataTable" id="getDataTable"></a>
### `getDataTable()`

Returns the DataTable loaded from the API

#### Signature

- It returns a [`DataTable`](../../Piwik/DataTable.md) value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if not yet defined

<a name="setdatatable" id="setdatatable"></a>
<a name="setDataTable" id="setDataTable"></a>
### `setDataTable()`

To prevent calling an API multiple times, the DataTable can be set directly.

#### Description

It won't be loaded again from the API in this case

#### Signature

- It accepts the following parameter(s):
    - `$dataTable` (`Piwik\Plugin\$dataTable`)
- _Returns:_ $dataTable DataTable
    - `void`

<a name="render" id="render"></a>
<a name="render" id="render"></a>
### `render()`

Requests all needed data and renders the view.

#### Signature

- _Returns:_ The result of rendering.
    - `string`

<a name="isrequestingsingledatatable" id="isrequestingsingledatatable"></a>
<a name="isRequestingSingleDataTable" id="isRequestingSingleDataTable"></a>
### `isRequestingSingleDataTable()`

Determine if the view data table requests a single data table or not.

#### Signature

- It returns a `bool` value.

<a name="candisplayviewdatatable" id="candisplayviewdatatable"></a>
<a name="canDisplayViewDataTable" id="canDisplayViewDataTable"></a>
### `canDisplayViewDataTable()`

Here you can define whether your visualization can display a specific data table or not.

#### Description

For instance you may
only display your visualization in case a single data table is requested. If the method returns true, the footer
icon will be displayed.

#### Signature

- It accepts the following parameter(s):
    - `$view` ([`ViewDataTable`](../../Piwik/Plugin/ViewDataTable.md))
- It returns a `bool` value.

