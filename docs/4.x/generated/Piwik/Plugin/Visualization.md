<small>Piwik\Plugin\</small>

Visualization
=============

The base class for report visualizations that output HTML and use JavaScript.

Report visualizations that extend from this class will be displayed like all others in
the Piwik UI. The following extra UI controls will be displayed around the visualization
itself:

- report documentation,
- a header message (if [Config::$show_header_message](/api-reference/Piwik/ViewDataTable/Config#$show_header_message) is set),
- a footer message (if [Config::$show_footer_message](/api-reference/Piwik/ViewDataTable/Config#$show_footer_message) is set),
- a list of links to related reports (if [Config::$related_reports](/api-reference/Piwik/ViewDataTable/Config#$related_reports) is set),
- a button that allows users to switch visualizations,
- a control that allows users to export report data in different formats,
- a limit control that allows users to change the amount of rows displayed (if
  [Config::$show_limit_control](/api-reference/Piwik/ViewDataTable/Config#$show_limit_control) is true),
- and more depending on the visualization.

### Rendering Process

The following process is used to render reports:

- The report is loaded through Piwik's Reporting API.
- The display and request properties that require report data in order to determine a default
  value are defaulted. These properties are:

  - [Config::$columns_to_display](/api-reference/Piwik/ViewDataTable/Config#$columns_to_display)
  - [RequestConfig::$filter_sort_column](/api-reference/Piwik/ViewDataTable/RequestConfig#$filter_sort_column)
  - [RequestConfig::$filter_sort_order](/api-reference/Piwik/ViewDataTable/RequestConfig#$filter_sort_order)

- Priority filters are applied to the report (see [Config::$filters](/api-reference/Piwik/ViewDataTable/Config#$filters)).
- The filters that are applied to every report in the Reporting API (called **generic filters**)
  are applied. (see [Request](/api-reference/Piwik/API/Request))
- The report's queued filters are applied.
- A [View](/api-reference/Piwik/View) instance is created and rendered.

### Rendering Hooks

The Visualization class defines several overridable methods that are called at specific
points during the rendering process. Derived classes can override these methods change
the data that is displayed or set custom properties.

The overridable methods (called **rendering hooks**) are as follows:

- **beforeLoadDataTable**: Called at the start of the rendering process before any data
                           is loaded.
- **beforeGenericFiltersAreAppliedToLoadedDataTable**: Called after data is loaded and after priority
                                                       filters are called, but before other filters. This
                                                       method should be used if you need the report's
                                                       entire dataset.
- **afterGenericFiltersAreAppliedToLoadedDataTable**: Called after generic filters are applied, but before
                                                      queued filters are applied.
- **afterAllFiltersAreApplied**: Called after data is loaded and all filters are applied.
- **beforeRender**: Called immediately before a [View](/api-reference/Piwik/View) is created and rendered.
- **isThereDataToDisplay**: Called after a [View](/api-reference/Piwik/View) is created to determine if the report has
                            data or not. If not, a message is displayed to the user.

### The DataTable JavaScript class

In the UI, visualization behavior is provided by logic in the **DataTable** JavaScript class.
When creating new visualizations, the **DataTable** JavaScript class (or one of its existing
descendants) should be extended.

To learn more read the [Visualizing Report Data](/guides/visualizing-report-data#creating-new-visualizations)
guide.

### Examples

**Changing the data that is loaded**

    class MyVisualization extends Visualization
    {
        // load the previous period's data as well as the requested data. this will change
        // $this->dataTable from a DataTable instance to a DataTable\Map instance.
        public function beforeLoadDataTable()
        {
            $date = Common::getRequestVar('date');
            list($previousDate, $ignore) = Range::getLastDate($date, $period);

            $this->requestConfig->request_parameters_to_modify['date'] = $previousDate . ',' . $date;
        }

        // since we load the previous period's data too, we need to override the logic to
        // check if there is data or not.
        public function isThereDataToDisplay()
        {
            $tables = $this->dataTable->getDataTables()
            $requestedDataTable = end($tables);

            return $requestedDataTable->getRowsCount() != 0;
        }
    }

**Force properties to be set to certain values**

    class MyVisualization extends Visualization
    {
        // ensure that some properties are set to certain values before rendering.
        // this will overwrite any changes made by plugins that use this visualization.
        public function beforeRender()
        {
            $this->config->max_graph_elements = false;
            $this->config->datatable_js_type  = 'MyVisualization';
            $this->config->show_flatten_table = false;
            $this->config->show_pagination_control = false;
            $this->config->show_offset_information = false;
        }
    }

Constants
---------

This class defines the following constants:

- [`TEMPLATE_FILE`](#template_file) — The Twig template file to use when rendering, eg, `"@MyPlugin/_myVisualization.twig"`. Inherited from [`Visualization`](../../Piwik/Plugin/Visualization.md)
<a name="template_file" id="template_file"></a>
<a name="TEMPLATE_FILE" id="TEMPLATE_FILE"></a>
### `TEMPLATE_FILE`

Must be defined by classes that extend Visualization.

Properties
----------

This class defines the following properties:

- [`$config`](#$config) &mdash; Contains display properties for this visualization. Inherited from [`ViewDataTable`](../../Piwik/Plugin/ViewDataTable.md)
- [`$requestConfig`](#$requestconfig) &mdash; Contains request properties for this visualization. Inherited from [`ViewDataTable`](../../Piwik/Plugin/ViewDataTable.md)

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

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor. Inherited from [`ViewDataTable`](../../Piwik/Plugin/ViewDataTable.md)
- [`getDefaultConfig()`](#getdefaultconfig) &mdash; Returns the default config instance. Inherited from [`ViewDataTable`](../../Piwik/Plugin/ViewDataTable.md)
- [`getDefaultRequestConfig()`](#getdefaultrequestconfig) &mdash; Returns the default request config instance. Inherited from [`ViewDataTable`](../../Piwik/Plugin/ViewDataTable.md)
- [`getViewDataTableId()`](#getviewdatatableid) &mdash; Returns the viewDataTable ID for this DataTable visualization. Inherited from [`ViewDataTable`](../../Piwik/Plugin/ViewDataTable.md)
- [`isViewDataTableId()`](#isviewdatatableid) &mdash; Returns `true` if this instance's or any of its ancestors' viewDataTable IDs equals the supplied ID, `false` if otherwise. Inherited from [`ViewDataTable`](../../Piwik/Plugin/ViewDataTable.md)
- [`getDataTable()`](#getdatatable) &mdash; Returns the DataTable loaded from the API. Inherited from [`ViewDataTable`](../../Piwik/Plugin/ViewDataTable.md)
- [`setDataTable()`](#setdatatable) &mdash; To prevent calling an API multiple times, the DataTable can be set directly. Inherited from [`ViewDataTable`](../../Piwik/Plugin/ViewDataTable.md)
- [`render()`](#render) &mdash; Requests all needed data and renders the view. Inherited from [`ViewDataTable`](../../Piwik/Plugin/ViewDataTable.md)
- [`isRequestingSingleDataTable()`](#isrequestingsingledatatable) &mdash; Returns `true` if this instance will request a single DataTable, `false` if requesting more than one. Inherited from [`ViewDataTable`](../../Piwik/Plugin/ViewDataTable.md)
- [`canDisplayViewDataTable()`](#candisplayviewdatatable) &mdash; Returns `true` if this visualization can display some type of data or not. Inherited from [`ViewDataTable`](../../Piwik/Plugin/ViewDataTable.md)
- [`throwWhenSettingNonOverridableParameter()`](#throwwhensettingnonoverridableparameter) &mdash; Display a meaningful error message when any invalid parameter is being set. Inherited from [`ViewDataTable`](../../Piwik/Plugin/ViewDataTable.md)
- [`getNonOverridableParams()`](#getnonoverridableparams) Inherited from [`ViewDataTable`](../../Piwik/Plugin/ViewDataTable.md)
- [`isComparing()`](#iscomparing) &mdash; Returns true if both this current visualization supports comparison, and if comparison query parameters are present in the URL. Inherited from [`ViewDataTable`](../../Piwik/Plugin/ViewDataTable.md)
- [`supportsComparison()`](#supportscomparison) &mdash; Implementations should override this method if they support a special comparison view. Inherited from [`ViewDataTable`](../../Piwik/Plugin/ViewDataTable.md)
- [`getRequestArray()`](#getrequestarray) Inherited from [`ViewDataTable`](../../Piwik/Plugin/ViewDataTable.md)
- [`assignTemplateVar()`](#assigntemplatevar) &mdash; Assigns a template variable making it available in the Twig template specified by TEMPLATE\_FILE.
- [`isThereDataToDisplay()`](#istheredatatodisplay) &mdash; Returns `true` if there is data to display, `false` if otherwise.
- [`beforeLoadDataTable()`](#beforeloaddatatable) &mdash; Hook that is called before loading report data from the API.
- [`beforeGenericFiltersAreAppliedToLoadedDataTable()`](#beforegenericfiltersareappliedtoloadeddatatable) &mdash; Hook that is executed before generic filters are applied.
- [`afterGenericFiltersAreAppliedToLoadedDataTable()`](#aftergenericfiltersareappliedtoloadeddatatable) &mdash; Hook that is executed after generic filters are applied.
- [`afterAllFiltersAreApplied()`](#afterallfiltersareapplied) &mdash; Hook that is executed after the report data is loaded and after all filters have been applied.
- [`beforeRender()`](#beforerender) &mdash; Hook that is executed directly before rendering.

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor. Initializes display and request properties to their default values.

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

Returns `true` if this instance's or any of its ancestors' viewDataTable IDs equals the supplied ID,
`false` if otherwise.

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

- It returns a `Piwik\Plugin\DataTable` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if not yet loaded.

<a name="setdatatable" id="setdatatable"></a>
<a name="setDataTable" id="setDataTable"></a>
### `setDataTable()`

To prevent calling an API multiple times, the DataTable can be set directly.

It won't be loaded from the API in this case.

#### Signature

-  It accepts the following parameter(s):
    - `$dataTable` (`Piwik\Plugin\DataTable`) &mdash;
       The DataTable to use.
- It returns a `void` value.

<a name="render" id="render"></a>
<a name="render" id="render"></a>
### `render()`

Requests all needed data and renders the view.

#### Signature


- *Returns:*  `string` &mdash;
    Serialized data, eg, (image, array, html...).

<a name="isrequestingsingledatatable" id="isrequestingsingledatatable"></a>
<a name="isRequestingSingleDataTable" id="isRequestingSingleDataTable"></a>
### `isRequestingSingleDataTable()`

Returns `true` if this instance will request a single DataTable, `false` if requesting
more than one.

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
    - `$overrideParams`
      
- It does not return anything or a mixed result.
- It throws one of the following exceptions:
    - ``

<a name="getnonoverridableparams" id="getnonoverridableparams"></a>
<a name="getNonOverridableParams" id="getNonOverridableParams"></a>
### `getNonOverridableParams()`

#### Signature

-  It accepts the following parameter(s):
    - `$overrideParams`
      
- It returns a `array` value.

<a name="iscomparing" id="iscomparing"></a>
<a name="isComparing" id="isComparing"></a>
### `isComparing()`

Returns true if both this current visualization supports comparison, and if comparison query parameters
are present in the URL.

#### Signature

- It returns a `bool` value.

<a name="supportscomparison" id="supportscomparison"></a>
<a name="supportsComparison" id="supportsComparison"></a>
### `supportsComparison()`

Implementations should override this method if they support a special comparison view. By
default, it is assumed visualizations do not support comparison.

#### Signature

- It returns a `bool` value.

<a name="getrequestarray" id="getrequestarray"></a>
<a name="getRequestArray" id="getRequestArray"></a>
### `getRequestArray()`

#### Signature

- It does not return anything or a mixed result.

<a name="assigntemplatevar" id="assigntemplatevar"></a>
<a name="assignTemplateVar" id="assignTemplateVar"></a>
### `assignTemplateVar()`

Assigns a template variable making it available in the Twig template specified by
TEMPLATE\_FILE.

#### Signature

-  It accepts the following parameter(s):
    - `$vars` (`array`|`string`) &mdash;
       One or more variable names to set.
    - `$value` (`mixed`) &mdash;
       The value to set each variable to.
- It does not return anything or a mixed result.

<a name="istheredatatodisplay" id="istheredatatodisplay"></a>
<a name="isThereDataToDisplay" id="isThereDataToDisplay"></a>
### `isThereDataToDisplay()`

Returns `true` if there is data to display, `false` if otherwise.

Derived classes should override this method if they change the amount of data that is loaded.

#### Signature

- It does not return anything or a mixed result.

<a name="beforeloaddatatable" id="beforeloaddatatable"></a>
<a name="beforeLoadDataTable" id="beforeLoadDataTable"></a>
### `beforeLoadDataTable()`

Hook that is called before loading report data from the API.

Use this method to change the request parameters that is sent to the API when requesting
data.

#### Signature

- It does not return anything or a mixed result.

<a name="beforegenericfiltersareappliedtoloadeddatatable" id="beforegenericfiltersareappliedtoloadeddatatable"></a>
<a name="beforeGenericFiltersAreAppliedToLoadedDataTable" id="beforeGenericFiltersAreAppliedToLoadedDataTable"></a>
### `beforeGenericFiltersAreAppliedToLoadedDataTable()`

Hook that is executed before generic filters are applied.

Use this method if you need access to the entire dataset (since generic filters will
limit and truncate reports).

#### Signature

- It does not return anything or a mixed result.

<a name="aftergenericfiltersareappliedtoloadeddatatable" id="aftergenericfiltersareappliedtoloadeddatatable"></a>
<a name="afterGenericFiltersAreAppliedToLoadedDataTable" id="afterGenericFiltersAreAppliedToLoadedDataTable"></a>
### `afterGenericFiltersAreAppliedToLoadedDataTable()`

Hook that is executed after generic filters are applied.

#### Signature

- It does not return anything or a mixed result.

<a name="afterallfiltersareapplied" id="afterallfiltersareapplied"></a>
<a name="afterAllFiltersAreApplied" id="afterAllFiltersAreApplied"></a>
### `afterAllFiltersAreApplied()`

Hook that is executed after the report data is loaded and after all filters have been applied.

Use this method to format the report data before the view is rendered.

#### Signature

- It does not return anything or a mixed result.

<a name="beforerender" id="beforerender"></a>
<a name="beforeRender" id="beforeRender"></a>
### `beforeRender()`

Hook that is executed directly before rendering. Use this hook to force display properties to
be a certain value, despite changes from plugins and query parameters.

#### Signature

- It does not return anything or a mixed result.

