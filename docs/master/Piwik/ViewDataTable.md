<small>Piwik</small>

ViewDataTable
=============

This class is used to load (from the API) and customize the output of a given DataTable.

Description
-----------

The main() method will create an object implementing ViewInterface
You can customize the dataTable using the disable* methods.

You can also customize the dataTable rendering using row metadata:
- &#039;html_label_prefix&#039;: If this metadata is present on a row, it&#039;s contents will be prepended
                       the label in the HTML output.
- &#039;html_label_suffix&#039;: If this metadata is present on a row, it&#039;s contents will be appended
                       after the label in the HTML output.

Example:
In the Controller of the plugin VisitorInterest
&lt;pre&gt;
   function getNumberOfVisitsPerVisitDuration( $fetch = false)
 {
       $view = ViewDataTable::factory( &#039;cloud&#039; );
       $view-&gt;init( $this-&gt;pluginName,  __FUNCTION__, &#039;VisitorInterest.getNumberOfVisitsPerVisitDuration&#039; );
       $view-&gt;setColumnsToDisplay( array(&#039;label&#039;,&#039;nb_visits&#039;) );
       $view-&gt;disableSort();
       $view-&gt;disableExcludeLowPopulation();
       $view-&gt;disableOffsetInformation();

       return $this-&gt;renderView($view, $fetch);
   }
&lt;/pre&gt;


Constants
---------

This class defines the following constants:

- [`CONFIGURE_VIEW_EVENT`](#CONFIGURE_VIEW_EVENT)
- [`CONFIGURE_FOOTER_ICONS_EVENT`](#CONFIGURE_FOOTER_ICONS_EVENT)

Properties
----------

This class defines the following properties:

- [`$reportPropertiesCache`](#$reportPropertiesCache) &mdash; Cache for getAllReportDisplayProperties result.
- [`$efault_view_type`](#$efault_view_type) &mdash; stringdefault_view_type
- [`$atatable_css_class`](#$atatable_css_class) &mdash; stringdatatable_css_class
- [`$atatable_js_type`](#$atatable_js_type) &mdash; stringdatatable_js_type
- [`$how_visualization_only`](#$how_visualization_only) &mdash; stringshow_visualization_only
- [`$ooter_icons`](#$ooter_icons) &mdash; arrayfooter_icons
- [`$ide_annotations_view`](#$ide_annotations_view) &mdash; boolhide_annotations_view
- [`$how_goals`](#$how_goals) &mdash; boolshow_goals
- [`$how_exclude_low_population`](#$how_exclude_low_population) &mdash; boolshow_exclude_low_population
- [`$how_table`](#$how_table) &mdash; boolshow_table
- [`$how_table_all_columns`](#$how_table_all_columns) &mdash; boolshow_table_all_columns
- [`$how_footer`](#$how_footer) &mdash; boolshow_footer
- [`$how_footer_icons`](#$how_footer_icons) &mdash; boolshow_footer_icons
- [`$how_all_views_icons`](#$how_all_views_icons) &mdash; boolshow_all_views_icons
- [`$how_active_view_icon`](#$how_active_view_icon) &mdash; boolshow_active_view_icon
- [`$how_flatten_table`](#$how_flatten_table) &mdash; boolshow_flatten_table
- [`$how_limit_control`](#$how_limit_control) &mdash; boolshow_limit_control
- [`$how_bar_chart`](#$how_bar_chart) &mdash; boolshow_bar_chart
- [`$how_pie_chart`](#$how_pie_chart) &mdash; boolshow_pie_chart
- [`$how_tag_cloud`](#$how_tag_cloud) &mdash; boolshow_tag_cloud
- [`$how_export_as_rss_feed`](#$how_export_as_rss_feed) &mdash; boolshow_export_as_rss_feed
- [`$how_ecommerce`](#$how_ecommerce) &mdash; boolshow_ecommerce
- [`$how_footer_message`](#$how_footer_message) &mdash; boolshow_footer_message
- [`$how_export_as_image_icon`](#$how_export_as_image_icon) &mdash; boolshow_export_as_image_icon
- [`$how_non_core_visualizations`](#$how_non_core_visualizations) &mdash; boolshow_non_core_visualizations
- [`$how_search`](#$how_search) &mdash; boolshow_search
- [`$how_related_reports`](#$how_related_reports) &mdash; boolshow_related_reports
- [`$earch_recursive`](#$earch_recursive) &mdash; stringsearch_recursive
- [`$etrics_documentation`](#$etrics_documentation) &mdash; stringmetrics_documentation
- [`$ooltip_metadata_name`](#$ooltip_metadata_name) &mdash; stringtooltip_metadata_name
- [`$elf_url`](#$elf_url) &mdash; stringself_url
- [`$ilter_excludelowpop`](#$ilter_excludelowpop) &mdash; stringfilter_excludelowpop
- [`$ilter_excludelowpop_value`](#$ilter_excludelowpop_value) &mdash; stringfilter_excludelowpop_value
- [`$nable_sort`](#$nable_sort) &mdash; stringenable_sort
- [`$isable_generic_filters`](#$isable_generic_filters) &mdash; stringdisable_generic_filters
- [`$isable_queued_filters`](#$isable_queued_filters) &mdash; stringdisable_queued_filters
- [`$elated_reports`](#$elated_reports) &mdash; arrayrelated_reports
- [`$itle`](#$itle) &mdash; stringtitle
- [`$ocumentation`](#$ocumentation) &mdash; stringdocumentation
- [`$equest_parameters_to_modify`](#$equest_parameters_to_modify) &mdash; arrayrequest_parameters_to_modify
- [`$olumns_to_display`](#$olumns_to_display) &mdash; arraycolumns_to_display
- [`$ustom_parameters`](#$ustom_parameters) &mdash; arraycustom_parameters
- [`$ranslations`](#$ranslations) &mdash; stringtranslations
- [`$ilter_sort_column`](#$ilter_sort_column) &mdash; stringfilter_sort_column
- [`$ilter_sort_order`](#$ilter_sort_order) &mdash; stringfilter_sort_order
- [`$ilter_column`](#$ilter_column) &mdash; stringfilter_column
- [`$ilter_limit`](#$ilter_limit) &mdash; integerfilter_limit
- [`$ilter_offset`](#$ilter_offset) &mdash; integerfilter_offset
- [`$ilter_pattern`](#$ilter_pattern) &mdash; stringfilter_pattern
- [`$xport_limit`](#$xport_limit) &mdash; stringexport_limit
- [`$_axis_unit`](#$_axis_unit) &mdash; stringy_axis_unit
- [`$isualization_properties`](#$isualization_properties) &mdash; VisualizationPropertiesProxyvisualization_properties
- [`$ilters`](#$ilters) &mdash; arrayfilters
- [`$fter_data_loaded_functions`](#$fter_data_loaded_functions) &mdash; arrayafter_data_loaded_functions
- [`$ubtable_controller_action`](#$ubtable_controller_action) &mdash; arraysubtable_controller_action
- [`$how_pagination_control`](#$how_pagination_control) &mdash; stringshow_pagination_control
- [`$how_offset_information`](#$how_offset_information) &mdash; stringshow_offset_information

### `$reportPropertiesCache` <a name="reportPropertiesCache"></a>

Cache for getAllReportDisplayProperties result.

#### Signature

- It is a **public static** property.
- It is a(n) `array` value.

### `$efault_view_type` <a name="efault_view_type"></a>

stringdefault_view_type

#### Signature

- It is a **public** property.
- It is a(n) `string` value.

### `$atatable_css_class` <a name="atatable_css_class"></a>

stringdatatable_css_class

#### Signature

- It is a **public** property.
- It is a(n) `string` value.

### `$atatable_js_type` <a name="atatable_js_type"></a>

stringdatatable_js_type

#### Signature

- It is a **public** property.
- It is a(n) `string` value.

### `$how_visualization_only` <a name="how_visualization_only"></a>

stringshow_visualization_only

#### Signature

- It is a **public** property.
- It is a(n) `string` value.

### `$ooter_icons` <a name="ooter_icons"></a>

arrayfooter_icons

#### Signature

- It is a **public** property.
- It is a(n) `array` value.

### `$ide_annotations_view` <a name="ide_annotations_view"></a>

boolhide_annotations_view

#### Signature

- It is a **public** property.
- It is a(n) `bool` value.

### `$how_goals` <a name="how_goals"></a>

boolshow_goals

#### Signature

- It is a **public** property.
- It is a(n) `bool` value.

### `$how_exclude_low_population` <a name="how_exclude_low_population"></a>

boolshow_exclude_low_population

#### Signature

- It is a **public** property.
- It is a(n) `bool` value.

### `$how_table` <a name="how_table"></a>

boolshow_table

#### Signature

- It is a **public** property.
- It is a(n) `bool` value.

### `$how_table_all_columns` <a name="how_table_all_columns"></a>

boolshow_table_all_columns

#### Signature

- It is a **public** property.
- It is a(n) `bool` value.

### `$how_footer` <a name="how_footer"></a>

boolshow_footer

#### Signature

- It is a **public** property.
- It is a(n) `bool` value.

### `$how_footer_icons` <a name="how_footer_icons"></a>

boolshow_footer_icons

#### Signature

- It is a **public** property.
- It is a(n) `bool` value.

### `$how_all_views_icons` <a name="how_all_views_icons"></a>

boolshow_all_views_icons

#### Signature

- It is a **public** property.
- It is a(n) `bool` value.

### `$how_active_view_icon` <a name="how_active_view_icon"></a>

boolshow_active_view_icon

#### Signature

- It is a **public** property.
- It is a(n) `bool` value.

### `$how_flatten_table` <a name="how_flatten_table"></a>

boolshow_flatten_table

#### Signature

- It is a **public** property.
- It is a(n) `bool` value.

### `$how_limit_control` <a name="how_limit_control"></a>

boolshow_limit_control

#### Signature

- It is a **public** property.
- It is a(n) `bool` value.

### `$how_bar_chart` <a name="how_bar_chart"></a>

boolshow_bar_chart

#### Signature

- It is a **public** property.
- It is a(n) `bool` value.

### `$how_pie_chart` <a name="how_pie_chart"></a>

boolshow_pie_chart

#### Signature

- It is a **public** property.
- It is a(n) `bool` value.

### `$how_tag_cloud` <a name="how_tag_cloud"></a>

boolshow_tag_cloud

#### Signature

- It is a **public** property.
- It is a(n) `bool` value.

### `$how_export_as_rss_feed` <a name="how_export_as_rss_feed"></a>

boolshow_export_as_rss_feed

#### Signature

- It is a **public** property.
- It is a(n) `bool` value.

### `$how_ecommerce` <a name="how_ecommerce"></a>

boolshow_ecommerce

#### Signature

- It is a **public** property.
- It is a(n) `bool` value.

### `$how_footer_message` <a name="how_footer_message"></a>

boolshow_footer_message

#### Signature

- It is a **public** property.
- It is a(n) `bool` value.

### `$how_export_as_image_icon` <a name="how_export_as_image_icon"></a>

boolshow_export_as_image_icon

#### Signature

- It is a **public** property.
- It is a(n) `bool` value.

### `$how_non_core_visualizations` <a name="how_non_core_visualizations"></a>

boolshow_non_core_visualizations

#### Signature

- It is a **public** property.
- It is a(n) `bool` value.

### `$how_search` <a name="how_search"></a>

boolshow_search

#### Signature

- It is a **public** property.
- It is a(n) `bool` value.

### `$how_related_reports` <a name="how_related_reports"></a>

boolshow_related_reports

#### Signature

- It is a **public** property.
- It is a(n) `bool` value.

### `$earch_recursive` <a name="earch_recursive"></a>

stringsearch_recursive

#### Signature

- It is a **public** property.
- It is a(n) `string` value.

### `$etrics_documentation` <a name="etrics_documentation"></a>

stringmetrics_documentation

#### Signature

- It is a **public** property.
- It is a(n) `string` value.

### `$ooltip_metadata_name` <a name="ooltip_metadata_name"></a>

stringtooltip_metadata_name

#### Signature

- It is a **public** property.
- It is a(n) `string` value.

### `$elf_url` <a name="elf_url"></a>

stringself_url

#### Signature

- It is a **public** property.
- It is a(n) `string` value.

### `$ilter_excludelowpop` <a name="ilter_excludelowpop"></a>

stringfilter_excludelowpop

#### Signature

- It is a **public** property.
- It is a(n) `string` value.

### `$ilter_excludelowpop_value` <a name="ilter_excludelowpop_value"></a>

stringfilter_excludelowpop_value

#### Signature

- It is a **public** property.
- It is a(n) `string` value.

### `$nable_sort` <a name="nable_sort"></a>

stringenable_sort

#### Signature

- It is a **public** property.
- It is a(n) `string` value.

### `$isable_generic_filters` <a name="isable_generic_filters"></a>

stringdisable_generic_filters

#### Signature

- It is a **public** property.
- It is a(n) `string` value.

### `$isable_queued_filters` <a name="isable_queued_filters"></a>

stringdisable_queued_filters

#### Signature

- It is a **public** property.
- It is a(n) `string` value.

### `$elated_reports` <a name="elated_reports"></a>

arrayrelated_reports

#### Signature

- It is a **public** property.
- It is a(n) `array` value.

### `$itle` <a name="itle"></a>

stringtitle

#### Signature

- It is a **public** property.
- It is a(n) `string` value.

### `$ocumentation` <a name="ocumentation"></a>

stringdocumentation

#### Signature

- It is a **public** property.
- It is a(n) `string` value.

### `$equest_parameters_to_modify` <a name="equest_parameters_to_modify"></a>

arrayrequest_parameters_to_modify

#### Signature

- It is a **public** property.
- It is a(n) `array` value.

### `$olumns_to_display` <a name="olumns_to_display"></a>

arraycolumns_to_display

#### Signature

- It is a **public** property.
- It is a(n) `array` value.

### `$ustom_parameters` <a name="ustom_parameters"></a>

arraycustom_parameters

#### Signature

- It is a **public** property.
- It is a(n) `array` value.

### `$ranslations` <a name="ranslations"></a>

stringtranslations

#### Signature

- It is a **public** property.
- It is a(n) `string` value.

### `$ilter_sort_column` <a name="ilter_sort_column"></a>

stringfilter_sort_column

#### Signature

- It is a **public** property.
- It is a(n) `string` value.

### `$ilter_sort_order` <a name="ilter_sort_order"></a>

stringfilter_sort_order

#### Signature

- It is a **public** property.
- It is a(n) `string` value.

### `$ilter_column` <a name="ilter_column"></a>

stringfilter_column

#### Signature

- It is a **public** property.
- It is a(n) `string` value.

### `$ilter_limit` <a name="ilter_limit"></a>

integerfilter_limit

#### Signature

- It is a **public** property.
- It is a(n) `integer` value.

### `$ilter_offset` <a name="ilter_offset"></a>

integerfilter_offset

#### Signature

- It is a **public** property.
- It is a(n) `integer` value.

### `$ilter_pattern` <a name="ilter_pattern"></a>

stringfilter_pattern

#### Signature

- It is a **public** property.
- It is a(n) `string` value.

### `$xport_limit` <a name="xport_limit"></a>

stringexport_limit

#### Signature

- It is a **public** property.
- It is a(n) `string` value.

### `$_axis_unit` <a name="_axis_unit"></a>

stringy_axis_unit

#### Signature

- It is a **public** property.
- It is a(n) `string` value.

### `$isualization_properties` <a name="isualization_properties"></a>

VisualizationPropertiesProxyvisualization_properties

#### Signature

- It is a **public** property.
- It is a(n) `VisualizationPropertiesProxy` value.

### `$ilters` <a name="ilters"></a>

arrayfilters

#### Signature

- It is a **public** property.
- It is a(n) `array` value.

### `$fter_data_loaded_functions` <a name="fter_data_loaded_functions"></a>

arrayafter_data_loaded_functions

#### Signature

- It is a **public** property.
- It is a(n) `array` value.

### `$ubtable_controller_action` <a name="ubtable_controller_action"></a>

arraysubtable_controller_action

#### Signature

- It is a **public** property.
- It is a(n) `array` value.

### `$how_pagination_control` <a name="how_pagination_control"></a>

stringshow_pagination_control

#### Signature

- It is a **public** property.
- It is a(n) `string` value.

### `$how_offset_information` <a name="how_offset_information"></a>

stringshow_offset_information

#### Signature

- It is a **public** property.
- It is a(n) `string` value.

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Default constructor.
- [`getReportApiMethod()`](#getReportApiMethod) &mdash; Returns the API method that will be called to obatin the report data.
- [`getVisualizationClass()`](#getVisualizationClass) &mdash; Returns the view&#039;s associated visualization class name.
- [`__get()`](#__get) &mdash; Gets a view property by reference.
- [`__set()`](#__set) &mdash; Sets a view property.
- [`__call()`](#__call) &mdash; Hack to allow property access in Twig (w/ property name checking).
- [`getViewDataTableId()`](#getViewDataTableId) &mdash; Unique string ID that defines the format of the dataTable, eg.
- [`factory()`](#factory) &mdash; Returns a Piwik_ViewDataTable_* object.
- [`getClientSideProperties()`](#getClientSideProperties) &mdash; Returns the list of view properties that should be sent with the HTML response as JSON.
- [`getClientSideParameters()`](#getClientSideParameters) &mdash; Returns the list of view properties that should be sent with the HTML response and resent by the UI JavaScript in every subsequent AJAX request.
- [`getOverridableProperties()`](#getOverridableProperties) &mdash; Returns the list of view properties that can be overriden by query parameters.
- [`getCurrentControllerAction()`](#getCurrentControllerAction)
- [`getCurrentControllerName()`](#getCurrentControllerName)
- [`getDataTable()`](#getDataTable) &mdash; Returns the DataTable loaded from the API
- [`setDataTable()`](#setDataTable) &mdash; To prevent calling an API multiple times, the DataTable can be set directly.
- [`getRequestArray()`](#getRequestArray)
- [`hasReportBeenPurged()`](#hasReportBeenPurged) &mdash; Returns true if it is likely that the data for this report has been purged and if the user should be told about that.
- [`renderReport()`](#renderReport) &mdash; Convenience method that creates and renders a ViewDataTable for a API method.
- [`render()`](#render) &mdash; Convenience function.
- [`shouldLoadExpanded()`](#shouldLoadExpanded) &mdash; Returns whether the DataTable result will have to be expanded for the current request before rendering.
- [`getDefaultDataTableCssClass()`](#getDefaultDataTableCssClass)

### `__construct()` <a name="__construct"></a>

Default constructor.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$currentControllerAction`
    - `$apiMethodToRequestDataTable`
    - `$viewProperties`
    - `$visualizationId`
- It does not return anything.

### `getReportApiMethod()` <a name="getReportApiMethod"></a>

Returns the API method that will be called to obatin the report data.

#### Signature

- It is a **public** method.
- _Returns:_ e.g. &#039;Actions.getPageUrls&#039;
    - `string`

### `getVisualizationClass()` <a name="getVisualizationClass"></a>

Returns the view&#039;s associated visualization class name.

#### Signature

- It is a **public** method.
- It returns a(n) `string` value.

### `__get()` <a name="__get"></a>

Gets a view property by reference.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$name`
- It returns a(n) `mixed` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if the property name is invalid.

### `__set()` <a name="__set"></a>

Sets a view property.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$name`
    - `$value`
- _Returns:_ Returns $value.
    - `mixed`
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if the property name is invalid.

### `__call()` <a name="__call"></a>

Hack to allow property access in Twig (w/ property name checking).

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$name`
    - `$arguments`
- It does not return anything.

### `getViewDataTableId()` <a name="getViewDataTableId"></a>

Unique string ID that defines the format of the dataTable, eg.

#### Description

&quot;pieChart&quot;, &quot;table&quot;, etc.

#### Signature

- It is a **public** method.
- It returns a(n) `string` value.

### `factory()` <a name="factory"></a>

Returns a Piwik_ViewDataTable_* object.

#### Description

By default it will return a ViewDataTable_Html
If there is a viewDataTable parameter in the URL, a ViewDataTable of this &#039;viewDataTable&#039; type will be returned.
If defaultType is specified and if there is no &#039;viewDataTable&#039; in the URL, a ViewDataTable of this $defaultType will be returned.
If force is set to true, a ViewDataTable of the $defaultType will be returned in all cases.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$defaultType`
    - `$apiAction`
    - `$controllerAction`
    - `$forceDefault`
- It returns a(n) [`ViewDataTable`](../Piwik/ViewDataTable.md) value.

### `getClientSideProperties()` <a name="getClientSideProperties"></a>

Returns the list of view properties that should be sent with the HTML response as JSON.

#### Description

These properties are visible to the UI JavaScript, but are not passed
with every request.

#### Signature

- It is a **public** method.
- It returns a(n) `array` value.

### `getClientSideParameters()` <a name="getClientSideParameters"></a>

Returns the list of view properties that should be sent with the HTML response and resent by the UI JavaScript in every subsequent AJAX request.

#### Signature

- It is a **public** method.
- It returns a(n) `array` value.

### `getOverridableProperties()` <a name="getOverridableProperties"></a>

Returns the list of view properties that can be overriden by query parameters.

#### Signature

- It is a **public** method.
- It returns a(n) `array` value.

### `getCurrentControllerAction()` <a name="getCurrentControllerAction"></a>

#### Signature

- It is a **public** method.
- It does not return anything.

### `getCurrentControllerName()` <a name="getCurrentControllerName"></a>

#### Signature

- It is a **public** method.
- It does not return anything.

### `getDataTable()` <a name="getDataTable"></a>

Returns the DataTable loaded from the API

#### Signature

- It is a **public** method.
- It returns a(n) [`DataTable`](../Piwik/DataTable.md) value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if not yet defined

### `setDataTable()` <a name="setDataTable"></a>

To prevent calling an API multiple times, the DataTable can be set directly.

#### Description

It won&#039;t be loaded again from the API in this case

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$dataTable`
- _Returns:_ $dataTable DataTable
    - `void`

### `getRequestArray()` <a name="getRequestArray"></a>

#### Signature

- It is a **public** method.
- _Returns:_ URL to call the API, eg. &quot;method=Referrers.getKeywords&amp;period=day&amp;date=yesterday&quot;...
    - `string`

### `hasReportBeenPurged()` <a name="hasReportBeenPurged"></a>

Returns true if it is likely that the data for this report has been purged and if the user should be told about that.

#### Description

In order for this function to return true, the following must also be true:
- The data table for this report must either be empty or not have been fetched.
- The period of this report is not a multiple period.
- The date of this report must be older than the delete_reports_older_than config option.

#### Signature

- It is a **public** method.
- It returns a(n) `bool` value.

### `renderReport()` <a name="renderReport"></a>

Convenience method that creates and renders a ViewDataTable for a API method.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$pluginName`
    - `$apiAction`
    - `$fetch`
- _Returns:_ See $fetch.
    - `string`
    - `null`
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

### `render()` <a name="render"></a>

Convenience function.

#### Description

Calls main() &amp; renders the view that gets built.

#### Signature

- It is a **public** method.
- _Returns:_ The result of rendering.
    - `string`

### `shouldLoadExpanded()` <a name="shouldLoadExpanded"></a>

Returns whether the DataTable result will have to be expanded for the current request before rendering.

#### Signature

- It is a **public static** method.
- It returns a(n) `bool` value.

### `getDefaultDataTableCssClass()` <a name="getDefaultDataTableCssClass"></a>

#### Signature

- It is a **public** method.
- It does not return anything.

