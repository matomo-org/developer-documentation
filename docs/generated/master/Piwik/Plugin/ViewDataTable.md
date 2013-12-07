<small>Piwik\Plugin</small>

ViewDataTable
=============

The base class of all report visualizations.

Description
-----------

ViewDataTable instances load analytics data via Piwik's API and then output some
type of visualization of that data.

Visualizations can be in any format. HTML-based visualizations should extend
[Visualization](/api-reference/Piwik/Plugin/Visualization). Visualizations that use other formats, such as visualizations
that output an image, should extend ViewDataTable directly.

### Creating ViewDataTables

ViewDataTable instances are not created via the new operator, instead the [ViewDataTable\Factory](/api-reference/Piwik/ViewDataTable/Factory)
class is used.

The specific subclass to create is determined, first, by the **viewDataTable** query paramater.
If this parameter is not set, then the default visualization type for the report that is being
displayed is used.

### Configuring ViewDataTables

**Display properties**

ViewDataTable output can be customized by setting one of many available display
properties. Display properties are stored as fields in [ViewDataTable\Config](/api-reference/Piwik/ViewDataTable/Config) objects.
ViewDataTables store a [ViewDataTable\Config](/api-reference/Piwik/ViewDataTable/Config) object in the [$config](/api-reference/Piwik/Plugin/ViewDataTable#$config) field.

Display properties can be set at any time before rendering.

**Request parameters**

Request parameters are similar to display properties in the way they are set. They are,
however, not used to customize ViewDataTable instances, but in the request to Piwik's
API when loading analytics data.

Request parameters are set by setting the fields of a [ViewDataTable\RequestConfig](/api-reference/Piwik/ViewDataTable/RequestConfig) object stored in
the [$requestConfig](/api-reference/Piwik/Plugin/ViewDataTable#$requestconfig) field. They can be set at any time before rendering.
Setting them after data is loaded will have no effect.

**Customizing how reports are displayed**

Each individual report should be rendered in its own controller method. There are two
ways to render a report within its controller method. You can either:

1. manually create and configure a ViewDataTable instance
2. invoke Piwik\Plugin\Controller::renderReport and configure the ViewDataTable instance
   in the [ViewDataTable.configure](/api-reference/hooks#viewdatatableconfigure) event.

ViewDataTable instances are configured by setting and modifying display properties and request
parameters.

### Creating new visualizations

New visualizations can be created by extending the ViewDataTable class or one of its
descendants. To learn more [read our guide on creating new visualizations](/guides/visualizing-report-data#creating-new-visualizations).

### Examples

**Manually configuring a ViewDataTable**

    // a controller method that displays a single report
    public function myReport()
    {
        $view = \Piwik\ViewDataTable\Factory::build('table', 'MyPlugin.myReport');
        $view->config->show_limit_control = true;
        $view->config->translations['myFancyMetric'] = "My Fancy Metric";
        // ...
        return $view->render();
    }

**Using Piwik\Plugin\Controller::renderReport**

First, a controller method that displays a single report:

    public function myReport()
    {
        return $this->renderReport(__FUNCTION__);`
    }

Then the event handler for the [ViewDataTable.configure](/api-reference/hooks#viewdatatableconfigure) event:

    public function configureViewDataTable(ViewDataTable $view)
    {
        switch ($view->requestConfig->apiMethodToRequestDataTable) {
            case 'MyPlugin.myReport':
                $view->config->show_limit_control = true;
                $view->config->translations['myFancyMetric'] = "My Fancy Metric";
                // ...
                break;
        }
    }

**Using custom configuration objects in a new visualization**

    class MyVisualizationConfig extends Piwik\ViewDataTable\Config
    {
        public $my_new_property = true;
    }

    class MyVisualizationRequestConfig extends Piwik\ViewDataTable\RequestConfig
    {
        public $my_new_property = false;
    }

    class MyVisualization extends Piwik\Plugin\ViewDataTable
    {
        public static function getDefaultConfig()
        {
            return new MyVisualizationConfig();
        }

        public static function getDefaultRequestConfig()
        {
            return new MyVisualizationRequestConfig();
        }
    }

Properties
----------

This abstract class defines the following properties:

- [`$config`](#$config)
- [`$requestConfig`](#$requestconfig)

<a name="$config" id="$config"></a>
<a name="config" id="config"></a>
### `$config`

#### Signature

- It is a [`Config`](../../Piwik/ViewDataTable/Config.md) value.

<a name="$requestconfig" id="$requestconfig"></a>
<a name="requestConfig" id="requestConfig"></a>
### `$requestConfig`

#### Signature

- It is a [`RequestConfig`](../../Piwik/ViewDataTable/RequestConfig.md) value.

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

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$controllerAction`

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$apiMethodToRequestDataTable`

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<a name="getdefaultconfig" id="getdefaultconfig"></a>
<a name="getDefaultConfig" id="getDefaultConfig"></a>
### `getDefaultConfig()`

Returns the default config.

#### Description

Custom viewDataTables can change the default config to their needs by either
modifying this config or creating an own Config class that extends the default Config.

#### Signature

- It returns a [`Config`](../../Piwik/ViewDataTable/Config.md) value.

<a name="getdefaultrequestconfig" id="getdefaultrequestconfig"></a>
<a name="getDefaultRequestConfig" id="getDefaultRequestConfig"></a>
### `getDefaultRequestConfig()`

Returns the default request config.

#### Description

Custom viewDataTables can change the default config to their needs by either
modifying this config or creating an own RequestConfig class that extends the default RequestConfig.

#### Signature

- It returns a [`RequestConfig`](../../Piwik/ViewDataTable/RequestConfig.md) value.

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

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$viewDataTableId` (`string`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
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

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$dataTable` (`Piwik\Plugin\$dataTable`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
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

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$view` ([`ViewDataTable`](../../Piwik/Plugin/ViewDataTable.md)) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It returns a `bool` value.

