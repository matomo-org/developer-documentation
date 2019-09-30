<small>Piwik\Plugin\</small>

ViewDataTable
=============

The base class of all report visualizations.

ViewDataTable instances load analytics data via Piwik's Reporting API and then output some
type of visualization of that data.

Visualizations can be in any format. HTML-based visualizations should extend
[Visualization](/api-reference/Piwik/Plugin/Visualization). Visualizations that use other formats, such as visualizations
that output an image, should extend ViewDataTable directly.

### Creating ViewDataTables

ViewDataTable instances are not created via the new operator, instead the [Factory](/api-reference/Piwik/ViewDataTable/Factory)
class is used.

The specific subclass to create is determined, first, by the **viewDataTable** query paramater.
If this parameter is not set, then the default visualization type for the report being
displayed is used.

### Configuring ViewDataTables

**Display properties**

ViewDataTable output can be customized by setting one of many available display
properties. Display properties are stored as fields in [Config](/api-reference/Piwik/ViewDataTable/Config) objects.
ViewDataTables store a [Config](/api-reference/Piwik/ViewDataTable/Config) object in the [$config](/api-reference/Piwik/Plugin/ViewDataTable#$config) field.

Display properties can be set at any time before rendering.

**Request properties**

Request properties are similar to display properties in the way they are set. They are,
however, not used to customize ViewDataTable instances, but in the request to Piwik's
API when loading analytics data.

Request properties are set by setting the fields of a [RequestConfig](/api-reference/Piwik/ViewDataTable/RequestConfig) object stored in
the [$requestConfig](/api-reference/Piwik/Plugin/ViewDataTable#$requestconfig) field. They can be set at any time before rendering.
Setting them after data is loaded will have no effect.

**Customizing how reports are displayed**

Each individual report should be rendered in its own controller method. There are two
ways to render a report within its controller method. You can either:

1. manually create and configure a ViewDataTable instance
2. invoke Piwik\Plugin\Controller::renderReport and configure the ViewDataTable instance
   in the [ViewDataTable.configure](/api-reference/events#viewdatatableconfigure) event.

ViewDataTable instances are configured by setting and modifying display properties and request
properties.

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

Then the event handler for the [ViewDataTable.configure](/api-reference/events#viewdatatableconfigure) event:

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

- [`$config`](#$config) &mdash; Contains display properties for this visualization.
- [`$requestConfig`](#$requestconfig) &mdash; Contains request properties for this visualization.

<a name="$config" id="$config"></a>
<a name="config" id="config"></a>
### `$config`

Contains display properties for this visualization.

#### Signature

- It is a [`Config`](../../Piwik/ViewDataTable/Config.md) value.

<a name="$requestconfig" id="$requestconfig"></a>
<a name="requestConfig" id="requestConfig"></a>
### `$requestConfig`

Contains request properties for this visualization.

#### Signature

- It is a [`RequestConfig`](../../Piwik/ViewDataTable/RequestConfig.md) value.

Methods
-------

The abstract class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`getDefaultConfig()`](#getdefaultconfig) &mdash; Returns the default config instance.
- [`getDefaultRequestConfig()`](#getdefaultrequestconfig) &mdash; Returns the default request config instance.
- [`getViewDataTableId()`](#getviewdatatableid) &mdash; Returns the viewDataTable ID for this DataTable visualization.
- [`isViewDataTableId()`](#isviewdatatableid) &mdash; Returns `true` if this instance's or any of its ancestors' viewDataTable IDs equals the supplied ID, `false` if otherwise.
- [`getDataTable()`](#getdatatable) &mdash; Returns the DataTable loaded from the API.
- [`setDataTable()`](#setdatatable) &mdash; To prevent calling an API multiple times, the DataTable can be set directly.
- [`render()`](#render) &mdash; Requests all needed data and renders the view.
- [`isRequestingSingleDataTable()`](#isrequestingsingledatatable) &mdash; Returns `true` if this instance will request a single DataTable, `false` if requesting more than one.
- [`canDisplayViewDataTable()`](#candisplayviewdatatable) &mdash; Returns `true` if this visualization can display some type of data or not.
- [`throwWhenSettingNonOverridableParameter()`](#throwwhensettingnonoverridableparameter) &mdash; Display a meaningful error message when any invalid parameter is being set.
- [`getNonOverridableParams()`](#getnonoverridableparams)
- [`isComparing()`](#iscomparing) &mdash; Returns true if both this current visualization supports comparison, and if comparison query parameters are present in the URL.
- [`supportsComparison()`](#supportscomparison) &mdash; Implementations should override this method if they support a special comparison view.
- [`getRequestArray()`](#getrequestarray)

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

Initializes display and request properties to their default values.
Posts the [ViewDataTable.configure](/api-reference/events#viewdatatableconfigure) event which plugins can use to configure the
way reports are displayed.

#### Signature

-  It accepts the following parameter(s):
    - `$controllerAction`
      
    - `$apiMethodToRequestDataTable`
      
    - `$overrideParams`
      

<a name="getdefaultconfig" id="getdefaultconfig"></a>
<a name="getDefaultConfig" id="getDefaultConfig"></a>
### `getDefaultConfig()`

Returns the default config instance.

Visualizations that define their own display properties should override this method and
return an instance of their new [Config](/api-reference/Piwik/ViewDataTable/Config) descendant.

See the last example [here](/api-reference/Piwik/Plugin/ViewDataTable) for more information.

#### Signature

- It returns a [`Config`](../../Piwik/ViewDataTable/Config.md) value.

<a name="getdefaultrequestconfig" id="getdefaultrequestconfig"></a>
<a name="getDefaultRequestConfig" id="getDefaultRequestConfig"></a>
### `getDefaultRequestConfig()`

Returns the default request config instance.

Visualizations that define their own request properties should override this method and
return an instance of their new [RequestConfig](/api-reference/Piwik/ViewDataTable/RequestConfig) descendant.

See the last example [here](/api-reference/Piwik/Plugin/ViewDataTable) for more information.

#### Signature

- It returns a [`RequestConfig`](../../Piwik/ViewDataTable/RequestConfig.md) value.

<a name="getviewdatatableid" id="getviewdatatableid"></a>
<a name="getViewDataTableId" id="getViewDataTableId"></a>
### `getViewDataTableId()`

Returns the viewDataTable ID for this DataTable visualization.

Derived classes should not override this method. They should instead declare a const ID field
with the viewDataTable ID.

#### Signature

- It returns a `string` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

<a name="isviewdatatableid" id="isviewdatatableid"></a>
<a name="isViewDataTableId" id="isViewDataTableId"></a>
### `isViewDataTableId()`

Returns `true` if this instance's or any of its ancestors' viewDataTable IDs equals the supplied ID, `false` if otherwise.

Can be used to test whether a ViewDataTable object is an instance of a certain visualization or not,
without having to know where that visualization is.

#### Signature

-  It accepts the following parameter(s):
    - `$viewDataTableId` (`string`) &mdash;
       The viewDataTable ID to check for, eg, `'table'`.
- It returns a `bool` value.

<a name="getdatatable" id="getdatatable"></a>
<a name="getDataTable" id="getDataTable"></a>
### `getDataTable()`

Returns the DataTable loaded from the API.

#### Signature

- It returns a [`DataTable`](../../Piwik/DataTable.md) value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if not yet loaded.

<a name="setdatatable" id="setdatatable"></a>
<a name="setDataTable" id="setDataTable"></a>
### `setDataTable()`

To prevent calling an API multiple times, the DataTable can be set directly.

It won't be loaded from the API in this case.

#### Signature

-  It accepts the following parameter(s):
    - `$dataTable` ([`DataTable`](../../Piwik/DataTable.md)) &mdash;
       The DataTable to use.
- It returns a `void` value.

<a name="render" id="render"></a>
<a name="render" id="render"></a>
### `render()`

Requests all needed data and renders the view.

#### Signature


- *Returns:*  `string` &mdash;
    The result of rendering.

<a name="isrequestingsingledatatable" id="isrequestingsingledatatable"></a>
<a name="isRequestingSingleDataTable" id="isRequestingSingleDataTable"></a>
### `isRequestingSingleDataTable()`

Returns `true` if this instance will request a single DataTable, `false` if requesting more than one.

#### Signature

- It returns a `bool` value.

<a name="candisplayviewdatatable" id="candisplayviewdatatable"></a>
<a name="canDisplayViewDataTable" id="canDisplayViewDataTable"></a>
### `canDisplayViewDataTable()`

Returns `true` if this visualization can display some type of data or not.

New visualization classes should override this method if they can only visualize certain
types of data. The evolution graph visualization, for example, can only visualize
sets of DataTables. If the API method used results in a single DataTable, the evolution
graph footer icon should not be displayed.

#### Signature

-  It accepts the following parameter(s):
    - `$view` ([`ViewDataTable`](../../Piwik/Plugin/ViewDataTable.md)) &mdash;
       Contains the API request being checked.
- It returns a `bool` value.

<a name="throwwhensettingnonoverridableparameter" id="throwwhensettingnonoverridableparameter"></a>
<a name="throwWhenSettingNonOverridableParameter" id="throwWhenSettingNonOverridableParameter"></a>
### `throwWhenSettingNonOverridableParameter()`

Display a meaningful error message when any invalid parameter is being set.

#### Signature

-  It accepts the following parameter(s):
    - `$overrideParams` (`Piwik\Plugin\$overrideParams`) &mdash;
      
- It does not return anything.

<a name="getnonoverridableparams" id="getnonoverridableparams"></a>
<a name="getNonOverridableParams" id="getNonOverridableParams"></a>
### `getNonOverridableParams()`

#### Signature

-  It accepts the following parameter(s):
    - `$overrideParams` (`Piwik\Plugin\$overrideParams`) &mdash;
      
- It returns a `array` value.

<a name="iscomparing" id="iscomparing"></a>
<a name="isComparing" id="isComparing"></a>
### `isComparing()`

Returns true if both this current visualization supports comparison, and if comparison query parameters are present in the URL.

#### Signature

- It returns a `bool` value.

<a name="supportscomparison" id="supportscomparison"></a>
<a name="supportsComparison" id="supportsComparison"></a>
### `supportsComparison()`

Implementations should override this method if they support a special comparison view.

By
default, it is assumed visualizations do not support comparison.

#### Signature

- It returns a `bool` value.

<a name="getrequestarray" id="getrequestarray"></a>
<a name="getRequestArray" id="getRequestArray"></a>
### `getRequestArray()`

#### Signature

- It does not return anything.

