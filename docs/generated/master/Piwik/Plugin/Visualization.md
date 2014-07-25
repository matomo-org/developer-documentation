<small>Piwik\Plugin\</small>

Visualization
=============

The base class for report visualizations that output HTML and use JavaScript.

Report visualizations that extend from this class will be displayed like all others in
the Piwik UI. The following extra UI controls will be displayed around the visualization
itself:

- report documentation,
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

- [`TEMPLATE_FILE`](#template_file) &mdash; The Twig template file to use when rendering, eg, `"@MyPlugin/_myVisualization.twig"`.
<a name="template_file" id="template_file"></a>
<a name="TEMPLATE_FILE" id="TEMPLATE_FILE"></a>
### `TEMPLATE_FILE`

Must be defined by classes that extend Visualization.

Methods
-------

The class defines the following methods:

- [`assignTemplateVar()`](#assigntemplatevar) &mdash; Assigns a template variable making it available in the Twig template specified by `[TEMPLATE_FILE](/api-reference/Piwik/Plugin/Visualization#piwik\plugin\visualization::template_file)`.
- [`isThereDataToDisplay()`](#istheredatatodisplay) &mdash; Returns `true` if there is data to display, `false` if otherwise.
- [`beforeLoadDataTable()`](#beforeloaddatatable) &mdash; Hook that is called before loading report data from the API.
- [`beforeGenericFiltersAreAppliedToLoadedDataTable()`](#beforegenericfiltersareappliedtoloadeddatatable) &mdash; Hook that is executed before generic filters are applied.
- [`afterGenericFiltersAreAppliedToLoadedDataTable()`](#aftergenericfiltersareappliedtoloadeddatatable) &mdash; Hook that is executed after generic filters are applied.
- [`afterAllFiltersAreApplied()`](#afterallfiltersareapplied) &mdash; Hook that is executed after the report data is loaded and after all filters have been applied.
- [`beforeRender()`](#beforerender) &mdash; Hook that is executed directly before rendering.

<a name="assigntemplatevar" id="assigntemplatevar"></a>
<a name="assignTemplateVar" id="assignTemplateVar"></a>
### `assignTemplateVar()`

Assigns a template variable making it available in the Twig template specified by `[TEMPLATE_FILE](/api-reference/Piwik/Plugin/Visualization#piwik\plugin\visualization::template_file)`.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$vars` (`array`|`string`) &mdash;

      <div markdown="1" class="param-desc"> One or more variable names to set.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$value` (`mixed`) &mdash;

      <div markdown="1" class="param-desc"> The value to set each variable to.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="istheredatatodisplay" id="istheredatatodisplay"></a>
<a name="isThereDataToDisplay" id="isThereDataToDisplay"></a>
### `isThereDataToDisplay()`

Returns `true` if there is data to display, `false` if otherwise.

Derived classes should override this method if they change the amount of data that is loaded.

#### Signature

- It does not return anything.

<a name="beforeloaddatatable" id="beforeloaddatatable"></a>
<a name="beforeLoadDataTable" id="beforeLoadDataTable"></a>
### `beforeLoadDataTable()`

Hook that is called before loading report data from the API.

Use this method to change the request parameters that is sent to the API when requesting
data.

#### Signature

- It does not return anything.

<a name="beforegenericfiltersareappliedtoloadeddatatable" id="beforegenericfiltersareappliedtoloadeddatatable"></a>
<a name="beforeGenericFiltersAreAppliedToLoadedDataTable" id="beforeGenericFiltersAreAppliedToLoadedDataTable"></a>
### `beforeGenericFiltersAreAppliedToLoadedDataTable()`

Hook that is executed before generic filters are applied.

Use this method if you need access to the entire dataset (since generic filters will
limit and truncate reports).

#### Signature

- It does not return anything.

<a name="aftergenericfiltersareappliedtoloadeddatatable" id="aftergenericfiltersareappliedtoloadeddatatable"></a>
<a name="afterGenericFiltersAreAppliedToLoadedDataTable" id="afterGenericFiltersAreAppliedToLoadedDataTable"></a>
### `afterGenericFiltersAreAppliedToLoadedDataTable()`

Hook that is executed after generic filters are applied.

#### Signature

- It does not return anything.

<a name="afterallfiltersareapplied" id="afterallfiltersareapplied"></a>
<a name="afterAllFiltersAreApplied" id="afterAllFiltersAreApplied"></a>
### `afterAllFiltersAreApplied()`

Hook that is executed after the report data is loaded and after all filters have been applied.

Use this method to format the report data before the view is rendered.

#### Signature

- It does not return anything.

<a name="beforerender" id="beforerender"></a>
<a name="beforeRender" id="beforeRender"></a>
### `beforeRender()`

Hook that is executed directly before rendering.

Use this hook to force display properties to
be a certain value, despite changes from plugins and query parameters.

#### Signature

- It does not return anything.

