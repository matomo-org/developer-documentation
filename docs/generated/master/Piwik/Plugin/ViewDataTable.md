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

- [`ID`](#ID)

Properties
----------

This abstract class defines the following properties:

- [`$config`](#$config)
- [`$requestConfig`](#$requestConfig)

### `$config` <a name="config"></a>

#### Signature

- It is a **public** property.
- It is a(n) `Piwik\ViewDataTable\Config` value.

### `$requestConfig` <a name="requestConfig"></a>

#### Signature

- It is a **public** property.
- It is a(n) `Piwik\ViewDataTable\RequestConfig` value.

Methods
-------

The abstract class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`getDefaultConfig()`](#getDefaultConfig) &mdash; Returns the default config.
- [`getDefaultRequestConfig()`](#getDefaultRequestConfig) &mdash; Returns the default request config.
- [`getViewDataTableId()`](#getViewDataTableId) &mdash; Returns the viewDataTable ID for this DataTable visualization.
- [`isViewDataTableId()`](#isViewDataTableId) &mdash; Detects whether the viewDataTable or one of its ancestors has the given id.
- [`getDataTable()`](#getDataTable) &mdash; Returns the DataTable loaded from the API
- [`setDataTable()`](#setDataTable) &mdash; To prevent calling an API multiple times, the DataTable can be set directly.
- [`render()`](#render) &mdash; Requests all needed data and renders the view.
- [`isRequestingSingleDataTable()`](#isRequestingSingleDataTable) &mdash; Determine if the view data table requests a single data table or not.
- [`canDisplayViewDataTable()`](#canDisplayViewDataTable) &mdash; Here you can define whether your visualization can display a specific data table or not.

### `__construct()` <a name="__construct"></a>

Constructor.

#### Description

Initializes the default config, requestConfig and the request itself. After configuring some
mandatory properties reports can modify the view by listening to the hook 'ViewDataTable.configure'.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$controllerAction`
    - `$apiMethodToRequestDataTable`
- It does not return anything.

### `getDefaultConfig()` <a name="getDefaultConfig"></a>

Returns the default config.

#### Description

Custom viewDataTables can change the default config to their needs by either
modifying this config or creating an own Config class that extends the default Config.

#### Signature

- It is a **public static** method.
- It returns a(n) `Piwik\ViewDataTable\Config` value.

### `getDefaultRequestConfig()` <a name="getDefaultRequestConfig"></a>

Returns the default request config.

#### Description

Custom viewDataTables can change the default config to their needs by either
modifying this config or creating an own RequestConfig class that extends the default RequestConfig.

#### Signature

- It is a **public static** method.
- It returns a(n) `Piwik\ViewDataTable\RequestConfig` value.

### `getViewDataTableId()` <a name="getViewDataTableId"></a>

Returns the viewDataTable ID for this DataTable visualization.

#### Description

Derived classes  should declare a const ID field
with the viewDataTable ID.

#### Signature

- It is a **public static** method.
- It returns a(n) `string` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

### `isViewDataTableId()` <a name="isViewDataTableId"></a>

Detects whether the viewDataTable or one of its ancestors has the given id.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$viewDataTableId`
- It returns a(n) `bool` value.

### `getDataTable()` <a name="getDataTable"></a>

Returns the DataTable loaded from the API

#### Signature

- It is a **public** method.
- It returns a(n) [`DataTable`](../../Piwik/DataTable.md) value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if not yet defined

### `setDataTable()` <a name="setDataTable"></a>

To prevent calling an API multiple times, the DataTable can be set directly.

#### Description

It won't be loaded again from the API in this case

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$dataTable`
- _Returns:_ $dataTable DataTable
    - `void`

### `render()` <a name="render"></a>

Requests all needed data and renders the view.

#### Signature

- It is a **public** method.
- _Returns:_ The result of rendering.
    - `string`

### `isRequestingSingleDataTable()` <a name="isRequestingSingleDataTable"></a>

Determine if the view data table requests a single data table or not.

#### Signature

- It is a **public** method.
- It returns a(n) `bool` value.

### `canDisplayViewDataTable()` <a name="canDisplayViewDataTable"></a>

Here you can define whether your visualization can display a specific data table or not.

#### Description

For instance you may
only display your visualization in case a single data table is requested. If the method returns true, the footer
icon will be displayed.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$view` ([`ViewDataTable`](../../Piwik/Plugin/ViewDataTable.md))
- It returns a(n) `bool` value.

