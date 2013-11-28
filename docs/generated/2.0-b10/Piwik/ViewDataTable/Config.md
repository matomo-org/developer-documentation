<small>Piwik\ViewDataTable</small>

Config
======

Contains base display properties for ViewDataTables.

Description
-----------

Manipulating these properties
in a ViewDataTable instance will change how its report will be displayed.

<a name="client-side-properties-desc"></a>
**Client Side Properties**

Client side properties are properties that should be passed on to the browser so
client side JavaScript can use them. Only affects ViewDataTables that output HTML.

**Overridable Properties**

Overridable properties are properties that can be set via the query string.
If a request has a query parameter that matches an overridable property, the property
will be set to the query parameter value.

**Defining new display properties**

If you are creating your own visualization and want to add new display properties for
it, extend this class and add your properties as fields.

Properties are marked as client side properties by calling the
[addPropertiesThatShouldBeAvailableClientSide](#addPropertiesThatShouldBeAvailableClientSide) method.

Properties are marked as overridable by calling the
[addPropertiesThatCanBeOverwrittenByQueryParams](#addPropertiesThatCanBeOverwrittenByQueryParams) method.

### Example

**Defining new display properties**

    class MyCustomVizConfig extends Config
    {
        /**
         * My custom property. It is overridable.
         *\/
        public $my_custom_property = false;

        /**
         * Another custom property. It is available client side.
         *\/
        public $another_custom_property = true;

        public function __construct()
        {
            parent::__construct();

            $this->addPropertiesThatShouldBeAvailableClientSide(array('another_custom_property'));
            $this->addPropertiesThatCanBeOverwrittenByQueryParams(array('my_custom_property'));
        }
    }

Properties
----------

This class defines the following properties:

- [`$clientSideProperties`](#$clientsideproperties) &mdash; The list of ViewDataTable properties that are 'Client Side Properties'.
- [`$overridableProperties`](#$overridableproperties) &mdash; The list of ViewDataTable properties that can be overriden by query parameters.
- [`$footer_icons`](#$footer_icons) &mdash; Controls what footer icons are displayed on the bottom left of the DataTable view.
- [`$show_visualization_only`](#$show_visualization_only) &mdash; Controls whether the buttons and UI controls around the visualization or shown or if just the visualization alone is shown.
- [`$show_goals`](#$show_goals) &mdash; Controls whether the goals footer icon is shown.
- [`$translations`](#$translations) &mdash; Array property mapping DataTable column names with their internationalized names.
- [`$show_exclude_low_population`](#$show_exclude_low_population) &mdash; Controls whether the 'Exclude Low Population' option (visible in the popup that displays after clicking the 'cog' icon) is shown.
- [`$show_flatten_table`](#$show_flatten_table) &mdash; Whether to show the 'Flatten' option (visible in the popup that displays after clicking the 'cog' icon).
- [`$show_table`](#$show_table) &mdash; Controls whether the footer icon that allows users to switch to the 'normal' DataTable view is shown.
- [`$show_table_all_columns`](#$show_table_all_columns) &mdash; Controls whether the 'All Columns' footer icon is shown.
- [`$show_footer`](#$show_footer) &mdash; Controls whether the entire view footer is shown.
- [`$show_footer_icons`](#$show_footer_icons) &mdash; Controls whether the row that contains all footer icons & the limit selector is shown.
- [`$columns_to_display`](#$columns_to_display) &mdash; Array property that determines which columns will be shown.
- [`$show_all_views_icons`](#$show_all_views_icons) &mdash; Controls whether graph and non core viewDataTable footer icons are shown or not.
- [`$show_active_view_icon`](#$show_active_view_icon) &mdash; Controls whether to display a tiny upside-down caret over the currently active view icon.
- [`$related_reports`](#$related_reports) &mdash; Related reports are listed below a datatable view.
- [`$title`](#$title) &mdash; The report title.
- [`$show_related_reports`](#$show_related_reports) &mdash; Controls whether a report's related reports are listed with the view or not.
- [`$documentation`](#$documentation) &mdash; Contains the documentation for a report.
- [`$custom_parameters`](#$custom_parameters) &mdash; Array property containing custom data to be saved in JSON in the data-params HTML attribute of a data table div.
- [`$show_limit_control`](#$show_limit_control) &mdash; Controls whether the limit dropdown (which allows users to change the number of data shown) is always shown or not.
- [`$show_search`](#$show_search) &mdash; Controls whether the search box under the datatable is shown.
- [`$enable_sort`](#$enable_sort) &mdash; Controls whether the user can sort DataTables by clicking on table column headings.
- [`$show_bar_chart`](#$show_bar_chart) &mdash; Controls whether the footer icon that allows users to view data as a bar chart is shown.
- [`$show_pie_chart`](#$show_pie_chart) &mdash; Controls whether the footer icon that allows users to view data as a pie chart is shown.
- [`$show_tag_cloud`](#$show_tag_cloud) &mdash; Controls whether the footer icon that allows users to view data as a tag cloud is shown.
- [`$show_export_as_rss_feed`](#$show_export_as_rss_feed) &mdash; Controls whether the user is allowed to export data as an RSS feed or not.
- [`$show_ecommerce`](#$show_ecommerce) &mdash; Controls whether the 'Ecoommerce Orders'/'Abandoned Cart' footer icons are shown or not.
- [`$show_footer_message`](#$show_footer_message) &mdash; Stores an HTML message (if any) to display under the datatable view.
- [`$metrics_documentation`](#$metrics_documentation) &mdash; Array property that stores documentation for individual metrics.
- [`$tooltip_metadata_name`](#$tooltip_metadata_name) &mdash; Row metadata name that contains the tooltip for the specific row.
- [`$self_url`](#$self_url) &mdash; The URL to the report the view is displaying.
- [`$datatable_css_class`](#$datatable_css_class) &mdash; CSS class to use in the output HTML div.
- [`$datatable_js_type`](#$datatable_js_type) &mdash; The JavaScript class to instantiate after the result HTML is obtained.
- [`$search_recursive`](#$search_recursive) &mdash; If true, searching through the DataTable will search through all subtables.
- [`$y_axis_unit`](#$y_axis_unit) &mdash; The unit of the displayed column.
- [`$show_export_as_image_icon`](#$show_export_as_image_icon) &mdash; Controls whether to show the 'Export as Image' footer icon.
- [`$filters`](#$filters) &mdash; Array of DataTable filters that should be run before displaying a DataTable.
- [`$subtable_controller_action`](#$subtable_controller_action) &mdash; Contains the controller action to call when requesting subtables of the current report.
- [`$show_pagination_control`](#$show_pagination_control) &mdash; Controls whether the 'prev'/'next' links are shown in the DataTable footer.
- [`$show_offset_information`](#$show_offset_information) &mdash; Controls whether offset information (ie, '5-10 of 20') is shown under the datatable.
- [`$hide_annotations_view`](#$hide_annotations_view) &mdash; Controls whether annotations are shown or not.
- [`$export_limit`](#$export_limit) &mdash; The filter_limit query parameter value to use in export links.
- [`$report_id`](#$report_id) &mdash; TODO
- [`$controllerName`](#$controllername) &mdash; TODO
- [`$controllerAction`](#$controlleraction) &mdash; TODO

<a name="$clientsideproperties" id="$clientsideproperties"></a>
<a name="clientSideProperties" id="clientSideProperties"></a>
### `$clientSideProperties`

The list of ViewDataTable properties that are 'Client Side Properties'.

#### Signature

- Its type is not specified.


<a name="$overridableproperties" id="$overridableproperties"></a>
<a name="overridableProperties" id="overridableProperties"></a>
### `$overridableProperties`

The list of ViewDataTable properties that can be overriden by query parameters.

#### Signature

- Its type is not specified.


<a name="$footer_icons" id="$footer_icons"></a>
<a name="footer_icons" id="footer_icons"></a>
### `$footer_icons`

Controls what footer icons are displayed on the bottom left of the DataTable view.

#### Description

The value of this property must be an array of footer icon groups. Footer icon groups
have set of properties, including an array of arrays describing footer icons. For
example:

    array(
        array( // footer icon group 1
            'class' => 'footerIconGroup1CssClass',
            'buttons' => array(
                'id' => 'myid',
                'title' => 'My Tooltip',
                'icon' => 'path/to/my/icon.png'
            )
        ),
        array( // footer icon group 2
            'class' => 'footerIconGroup2CssClass',
            'buttons' => array(...)
        )
    )

By default, when a user clicks on a footer icon, Piwik will assume the 'id' is
a viewDataTable ID and try to reload the DataTable w/ the new viewDataTable. You
can provide your own footer icon behavior by adding an appropriate handler via
DataTable.registerFooterIconHandler in your JavaScript code.

The default value of this property is not set here and will show the 'Normal Table'
icon, the 'All Columns' icon, the 'Goals Columns' icon and all jqPlot graph columns,
unless other properties tell the view to exclude them.

#### Signature

- Its type is not specified.


<a name="$show_visualization_only" id="$show_visualization_only"></a>
<a name="show_visualization_only" id="show_visualization_only"></a>
### `$show_visualization_only`

Controls whether the buttons and UI controls around the visualization or shown or if just the visualization alone is shown.

#### Signature

- Its type is not specified.


<a name="$show_goals" id="$show_goals"></a>
<a name="show_goals" id="show_goals"></a>
### `$show_goals`

Controls whether the goals footer icon is shown.

#### Signature

- Its type is not specified.


<a name="$translations" id="$translations"></a>
<a name="translations" id="translations"></a>
### `$translations`

Array property mapping DataTable column names with their internationalized names.

#### Description

The default value for this property is set elsewhere. It will contain translations
of common metrics.

#### Signature

- Its type is not specified.


<a name="$show_exclude_low_population" id="$show_exclude_low_population"></a>
<a name="show_exclude_low_population" id="show_exclude_low_population"></a>
### `$show_exclude_low_population`

Controls whether the 'Exclude Low Population' option (visible in the popup that displays after clicking the 'cog' icon) is shown.

#### Signature

- Its type is not specified.


<a name="$show_flatten_table" id="$show_flatten_table"></a>
<a name="show_flatten_table" id="show_flatten_table"></a>
### `$show_flatten_table`

Whether to show the 'Flatten' option (visible in the popup that displays after clicking the 'cog' icon).

#### Signature

- Its type is not specified.


<a name="$show_table" id="$show_table"></a>
<a name="show_table" id="show_table"></a>
### `$show_table`

Controls whether the footer icon that allows users to switch to the 'normal' DataTable view is shown.

#### Signature

- Its type is not specified.


<a name="$show_table_all_columns" id="$show_table_all_columns"></a>
<a name="show_table_all_columns" id="show_table_all_columns"></a>
### `$show_table_all_columns`

Controls whether the 'All Columns' footer icon is shown.

#### Signature

- Its type is not specified.


<a name="$show_footer" id="$show_footer"></a>
<a name="show_footer" id="show_footer"></a>
### `$show_footer`

Controls whether the entire view footer is shown.

#### Signature

- Its type is not specified.


<a name="$show_footer_icons" id="$show_footer_icons"></a>
<a name="show_footer_icons" id="show_footer_icons"></a>
### `$show_footer_icons`

Controls whether the row that contains all footer icons & the limit selector is shown.

#### Signature

- Its type is not specified.


<a name="$columns_to_display" id="$columns_to_display"></a>
<a name="columns_to_display" id="columns_to_display"></a>
### `$columns_to_display`

Array property that determines which columns will be shown.

#### Description

Columns not in this array
should not appear in ViewDataTable visualizations.

Example: `array('label', 'nb_visits', 'nb_uniq_visitors')`

If this value is empty it will be defaulted to `array('label', 'nb_visits')` or
`array('label', 'nb_uniq_visitors')` if the report contains a nb_uniq_visitors column
after data is loaded.

#### Signature

- Its type is not specified.


<a name="$show_all_views_icons" id="$show_all_views_icons"></a>
<a name="show_all_views_icons" id="show_all_views_icons"></a>
### `$show_all_views_icons`

Controls whether graph and non core viewDataTable footer icons are shown or not.

#### Signature

- Its type is not specified.


<a name="$show_active_view_icon" id="$show_active_view_icon"></a>
<a name="show_active_view_icon" id="show_active_view_icon"></a>
### `$show_active_view_icon`

Controls whether to display a tiny upside-down caret over the currently active view icon.

#### Signature

- Its type is not specified.


<a name="$related_reports" id="$related_reports"></a>
<a name="related_reports" id="related_reports"></a>
### `$related_reports`

Related reports are listed below a datatable view.

#### Description

When clicked, the original report will
change to the clicked report and the list will change so the original report can be
navigated back to.

#### Signature

- Its type is not specified.


<a name="$title" id="$title"></a>
<a name="title" id="title"></a>
### `$title`

The report title.

#### Description

Used with related reports so report headings can be changed when switching
reports.

This must be set if related reports are added.

#### Signature

- Its type is not specified.


<a name="$show_related_reports" id="$show_related_reports"></a>
<a name="show_related_reports" id="show_related_reports"></a>
### `$show_related_reports`

Controls whether a report's related reports are listed with the view or not.

#### Signature

- Its type is not specified.


<a name="$documentation" id="$documentation"></a>
<a name="documentation" id="documentation"></a>
### `$documentation`

Contains the documentation for a report.

#### Signature

- Its type is not specified.


<a name="$custom_parameters" id="$custom_parameters"></a>
<a name="custom_parameters" id="custom_parameters"></a>
### `$custom_parameters`

Array property containing custom data to be saved in JSON in the data-params HTML attribute of a data table div.

#### Description

This data can be used by JavaScript DataTable classes.

e.g. array('typeReferrer' => ...)

It can then be accessed in the twig templates by clientSideParameters.typeReferrer

#### Signature

- Its type is not specified.


<a name="$show_limit_control" id="$show_limit_control"></a>
<a name="show_limit_control" id="show_limit_control"></a>
### `$show_limit_control`

Controls whether the limit dropdown (which allows users to change the number of data shown) is always shown or not.

#### Description

Normally shown only if pagination is enabled.

#### Signature

- Its type is not specified.


<a name="$show_search" id="$show_search"></a>
<a name="show_search" id="show_search"></a>
### `$show_search`

Controls whether the search box under the datatable is shown.

#### Signature

- Its type is not specified.


<a name="$enable_sort" id="$enable_sort"></a>
<a name="enable_sort" id="enable_sort"></a>
### `$enable_sort`

Controls whether the user can sort DataTables by clicking on table column headings.

#### Signature

- Its type is not specified.


<a name="$show_bar_chart" id="$show_bar_chart"></a>
<a name="show_bar_chart" id="show_bar_chart"></a>
### `$show_bar_chart`

Controls whether the footer icon that allows users to view data as a bar chart is shown.

#### Signature

- Its type is not specified.


<a name="$show_pie_chart" id="$show_pie_chart"></a>
<a name="show_pie_chart" id="show_pie_chart"></a>
### `$show_pie_chart`

Controls whether the footer icon that allows users to view data as a pie chart is shown.

#### Signature

- Its type is not specified.


<a name="$show_tag_cloud" id="$show_tag_cloud"></a>
<a name="show_tag_cloud" id="show_tag_cloud"></a>
### `$show_tag_cloud`

Controls whether the footer icon that allows users to view data as a tag cloud is shown.

#### Signature

- Its type is not specified.


<a name="$show_export_as_rss_feed" id="$show_export_as_rss_feed"></a>
<a name="show_export_as_rss_feed" id="show_export_as_rss_feed"></a>
### `$show_export_as_rss_feed`

Controls whether the user is allowed to export data as an RSS feed or not.

#### Signature

- Its type is not specified.


<a name="$show_ecommerce" id="$show_ecommerce"></a>
<a name="show_ecommerce" id="show_ecommerce"></a>
### `$show_ecommerce`

Controls whether the 'Ecoommerce Orders'/'Abandoned Cart' footer icons are shown or not.

#### Signature

- Its type is not specified.


<a name="$show_footer_message" id="$show_footer_message"></a>
<a name="show_footer_message" id="show_footer_message"></a>
### `$show_footer_message`

Stores an HTML message (if any) to display under the datatable view.

#### Signature

- Its type is not specified.


<a name="$metrics_documentation" id="$metrics_documentation"></a>
<a name="metrics_documentation" id="metrics_documentation"></a>
### `$metrics_documentation`

Array property that stores documentation for individual metrics.

#### Description

E.g. `array('nb_visits' => '...', ...)`

By default this is set to values retrieved from report metadata (via API.getReportMetadata API method).

#### Signature

- Its type is not specified.


<a name="$tooltip_metadata_name" id="$tooltip_metadata_name"></a>
<a name="tooltip_metadata_name" id="tooltip_metadata_name"></a>
### `$tooltip_metadata_name`

Row metadata name that contains the tooltip for the specific row.

#### Signature

- Its type is not specified.


<a name="$self_url" id="$self_url"></a>
<a name="self_url" id="self_url"></a>
### `$self_url`

The URL to the report the view is displaying.

#### Description

Modifying this means clicking back to this report
from a Related Report will go to a different URL. Can be used to load an entire page instead
of a single report when going back to the original report.

The URL used to request the report without generic filters.

#### Signature

- Its type is not specified.


<a name="$datatable_css_class" id="$datatable_css_class"></a>
<a name="datatable_css_class" id="datatable_css_class"></a>
### `$datatable_css_class`

CSS class to use in the output HTML div.

#### Description

This is added in addition to the visualization CSS
class.

#### Signature

- Its type is not specified.


<a name="$datatable_js_type" id="$datatable_js_type"></a>
<a name="datatable_js_type" id="datatable_js_type"></a>
### `$datatable_js_type`

The JavaScript class to instantiate after the result HTML is obtained.

#### Description

This class handles all
interactive behavior for the DataTable view.

#### Signature

- Its type is not specified.


<a name="$search_recursive" id="$search_recursive"></a>
<a name="search_recursive" id="search_recursive"></a>
### `$search_recursive`

If true, searching through the DataTable will search through all subtables.

#### Signature

- Its type is not specified.


<a name="$y_axis_unit" id="$y_axis_unit"></a>
<a name="y_axis_unit" id="y_axis_unit"></a>
### `$y_axis_unit`

The unit of the displayed column.

#### Description

Valid if only one non-label column is displayed.

#### Signature

- Its type is not specified.


<a name="$show_export_as_image_icon" id="$show_export_as_image_icon"></a>
<a name="show_export_as_image_icon" id="show_export_as_image_icon"></a>
### `$show_export_as_image_icon`

Controls whether to show the 'Export as Image' footer icon.

#### Signature

- Its type is not specified.


<a name="$filters" id="$filters"></a>
<a name="filters" id="filters"></a>
### `$filters`

Array of DataTable filters that should be run before displaying a DataTable.

#### Description

Elements
of this array can either be a closure or an array with at most three elements, including:
- the filter name (or a closure)
- an array of filter parameters
- a boolean indicating if the filter is a priority filter or not

Priority filters are run before queued filters. These filters should be filters that
add/delete rows.

If a closure is used, the view is appended as a parameter.

#### Signature

- Its type is not specified.


<a name="$subtable_controller_action" id="$subtable_controller_action"></a>
<a name="subtable_controller_action" id="subtable_controller_action"></a>
### `$subtable_controller_action`

Contains the controller action to call when requesting subtables of the current report.

#### Description

By default, this is set to the controller action used to request the report.

#### Signature

- Its type is not specified.


<a name="$show_pagination_control" id="$show_pagination_control"></a>
<a name="show_pagination_control" id="show_pagination_control"></a>
### `$show_pagination_control`

Controls whether the 'prev'/'next' links are shown in the DataTable footer.

#### Description

These links
change the 'filter_offset' query parameter, thus allowing pagination.

#### Signature

- Its type is not specified.


<a name="$show_offset_information" id="$show_offset_information"></a>
<a name="show_offset_information" id="show_offset_information"></a>
### `$show_offset_information`

Controls whether offset information (ie, '5-10 of 20') is shown under the datatable.

#### Signature

- Its type is not specified.


<a name="$hide_annotations_view" id="$hide_annotations_view"></a>
<a name="hide_annotations_view" id="hide_annotations_view"></a>
### `$hide_annotations_view`

Controls whether annotations are shown or not.

#### Signature

- Its type is not specified.


<a name="$export_limit" id="$export_limit"></a>
<a name="export_limit" id="export_limit"></a>
### `$export_limit`

The filter_limit query parameter value to use in export links.

#### Description

Defaulted to the value of the `[General] API_datatable_default_limit` INI config option.

#### Signature

- Its type is not specified.


<a name="$report_id" id="$report_id"></a>
<a name="report_id" id="report_id"></a>
### `$report_id`

TODO

#### Signature

- Its type is not specified.


<a name="$controllername" id="$controllername"></a>
<a name="controllerName" id="controllerName"></a>
### `$controllerName`

TODO

#### Signature

- Its type is not specified.


<a name="$controlleraction" id="$controlleraction"></a>
<a name="controllerAction" id="controllerAction"></a>
### `$controllerAction`

TODO

#### Signature

- Its type is not specified.


Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`setController()`](#setcontroller) &mdash; TODO
- [`addPropertiesThatShouldBeAvailableClientSide()`](#addpropertiesthatshouldbeavailableclientside) &mdash; Marks display properties as client side properties.
- [`addPropertiesThatCanBeOverwrittenByQueryParams()`](#addpropertiesthatcanbeoverwrittenbyqueryparams) &mdash; Marks display properties as overridable.
- [`getProperties()`](#getproperties) &mdash; Returns array of all property values in this config object.
- [`addRelatedReport()`](#addrelatedreport) &mdash; Adds a related report to the [related_reports](#related_reports) property.
- [`addRelatedReports()`](#addrelatedreports) &mdash; Adds several related reports to the [related_reports](#related_reports) property.
- [`addTranslation()`](#addtranslation) &mdash; Associates internationalized text with a metric.
- [`addTranslations()`](#addtranslations) &mdash; Associates multiple translations with metrics.

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature


<a name="setcontroller" id="setcontroller"></a>
<a name="setController" id="setController"></a>
### `setController()`

TODO

#### Signature

- It accepts the following parameter(s):
    - `$controllerName`
    - `$controllerAction`
- It does not return anything.

<a name="addpropertiesthatshouldbeavailableclientside" id="addpropertiesthatshouldbeavailableclientside"></a>
<a name="addPropertiesThatShouldBeAvailableClientSide" id="addPropertiesThatShouldBeAvailableClientSide"></a>
### `addPropertiesThatShouldBeAvailableClientSide()`

Marks display properties as client side properties.

#### Description

[Read this](#client-side-properties-desc)
to learn more.

#### Signature

- It accepts the following parameter(s):
    - `$propertyNames` (`array`) &mdash; List of property names, eg, `array('show_limit_control', 'show_goals')`.
- It does not return anything.

<a name="addpropertiesthatcanbeoverwrittenbyqueryparams" id="addpropertiesthatcanbeoverwrittenbyqueryparams"></a>
<a name="addPropertiesThatCanBeOverwrittenByQueryParams" id="addPropertiesThatCanBeOverwrittenByQueryParams"></a>
### `addPropertiesThatCanBeOverwrittenByQueryParams()`

Marks display properties as overridable.

#### Description

[Read this](#overridable-properties-desc) to
learn more.

#### Signature

- It accepts the following parameter(s):
    - `$propertyNames` (`array`) &mdash; List of property names, eg, `array('show_limit_control', 'show_goals')`.
- It does not return anything.

<a name="getproperties" id="getproperties"></a>
<a name="getProperties" id="getProperties"></a>
### `getProperties()`

Returns array of all property values in this config object.

#### Description

Property values are mapped
by name.

#### Signature

- _Returns:_ eg, `array('show_limit_control' => 0, 'show_goals' => 1, ...)`
    - `array`

<a name="addrelatedreport" id="addrelatedreport"></a>
<a name="addRelatedReport" id="addRelatedReport"></a>
### `addRelatedReport()`

Adds a related report to the [related_reports](#related_reports) property.

#### Description

If the report
references the one that is currently being displayed, it will not be added to the related
report list.

#### Signature

- It accepts the following parameter(s):
    - `$relatedReport` (`string`) &mdash; The plugin and method of the report, eg, `'UserSettings.getBrowser'`.
    - `$title` (`string`) &mdash; The report's display name, eg, `'Browsers'`.
    - `$queryParams` (`array`) &mdash; Any extra query parameters to set in releated report's URL, eg, `array('idGoal' => 'ecommerceOrder')`.
- It does not return anything.

<a name="addrelatedreports" id="addrelatedreports"></a>
<a name="addRelatedReports" id="addRelatedReports"></a>
### `addRelatedReports()`

Adds several related reports to the [related_reports](#related_reports) property.

#### Description

If
any of the reports references the report that is currently being displayed, it will not
be added to the list. All other reports will still be added though.

If you need to make sure the related report URL has some extra query parameters,
use [addRelatedReport](#addRelatedReport).

#### Signature

- It accepts the following parameter(s):
    - `$relatedReports` (`array`) &mdash; Array mapping report IDs with their internationalized display titles, eg, ``` array( 'UserSettings.getBrowser' => 'Browsers', 'UserSettings.getConfiguration' => 'Configurations' ) ```
- It does not return anything.

<a name="addtranslation" id="addtranslation"></a>
<a name="addTranslation" id="addTranslation"></a>
### `addTranslation()`

Associates internationalized text with a metric.

#### Description

Overwrites existing mappings.

See [translations](#translations).

#### Signature

- It accepts the following parameter(s):
    - `$columnName` (`string`) &mdash; The name of a column in the report data, eg, `'nb_visits'` or `'goal_1_nb_conversions'`.
    - `$translation` (`string`) &mdash; The internationalized text, eg, `'Visits'` or `"Conversions for 'My Goal'"`.
- It does not return anything.

<a name="addtranslations" id="addtranslations"></a>
<a name="addTranslations" id="addTranslations"></a>
### `addTranslations()`

Associates multiple translations with metrics.

#### Description

See [translations](#translations) and [addTranslation](#addTranslation).

#### Signature

- It accepts the following parameter(s):
    - `$translations` (`array`) &mdash; An array of column name => text mappings, eg, ``` array( 'nb_visits' => 'Visits', 'goal_1_nb_conversions' => "Conversions for 'My Goal'" ) ```
- It does not return anything.

