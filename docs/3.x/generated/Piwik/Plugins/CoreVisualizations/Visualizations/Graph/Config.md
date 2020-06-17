<small>Piwik\Plugins\CoreVisualizations\Visualizations\Graph\</small>

Config
======

DataTable Visualization that derives from HtmlTable and sets show_extra_columns to true.

Properties
----------

This class defines the following properties:

- [`$clientSideProperties`](#$clientsideproperties) &mdash; The list of ViewDataTable properties that are 'Client Side Properties'. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$overridableProperties`](#$overridableproperties) &mdash; The list of ViewDataTable properties that can be overriden by query parameters. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$footer_icons`](#$footer_icons) &mdash; Controls what footer icons are displayed on the bottom left of the DataTable view. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$show_visualization_only`](#$show_visualization_only) &mdash; Controls whether the buttons and UI controls around the visualization or shown or if just the visualization alone is shown. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$show_goals`](#$show_goals) &mdash; Controls whether the goals footer icon is shown. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$show_insights`](#$show_insights) &mdash; Controls whether the 'insights' footer icon is shown. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$translations`](#$translations) &mdash; Array property mapping DataTable column names with their internationalized names. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$show_exclude_low_population`](#$show_exclude_low_population) &mdash; Controls whether the 'Exclude Low Population' option (visible in the popup that displays after clicking the 'cog' icon) is shown. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$show_flatten_table`](#$show_flatten_table) &mdash; Whether to show the 'Flatten' option (visible in the popup that displays after clicking the 'cog' icon). Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$show_pivot_by_subtable`](#$show_pivot_by_subtable) &mdash; Whether to show the 'Pivot by subtable' option (visible in the popup that displays after clicking the 'cog' icon). Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$pivot_by_dimension`](#$pivot_by_dimension) &mdash; The ID of the dimension to pivot by when the 'pivot by subtable' option is clicked. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$pivot_by_column`](#$pivot_by_column) &mdash; The column to display in pivot tables. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$pivot_dimension_name`](#$pivot_dimension_name) &mdash; The human readable name of the pivot dimension. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$show_table`](#$show_table) &mdash; Controls whether the footer icon that allows users to switch to the 'normal' DataTable view is shown. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$show_table_all_columns`](#$show_table_all_columns) &mdash; Controls whether the 'All Columns' footer icon is shown. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$show_footer`](#$show_footer) &mdash; Controls whether the entire view footer is shown. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$show_footer_icons`](#$show_footer_icons) &mdash; Controls whether the row that contains all footer icons & the limit selector is shown. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$columns_to_display`](#$columns_to_display) &mdash; Array property that determines which columns will be shown. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$show_all_views_icons`](#$show_all_views_icons) &mdash; Controls whether graph and non core viewDataTable footer icons are shown or not. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$related_reports`](#$related_reports) &mdash; Related reports are listed below a datatable view. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$related_reports_title`](#$related_reports_title) &mdash; "Related Reports" is displayed by default before listing the Related reports, The string can be changed. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$title`](#$title) &mdash; The report title. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$title_edit_entity_url`](#$title_edit_entity_url) &mdash; If a URL is set, the title of the report will be clickable. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$description`](#$description) &mdash; The report description. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$show_related_reports`](#$show_related_reports) &mdash; Controls whether a report's related reports are listed with the view or not. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$documentation`](#$documentation) &mdash; Contains the documentation for a report. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$onlineGuideUrl`](#$onlineguideurl) &mdash; URL linking to an online guide for this report (or plugin). Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$custom_parameters`](#$custom_parameters) &mdash; Array property containing custom data to be saved in JSON in the data-params HTML attribute of a data table div. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$show_limit_control`](#$show_limit_control) &mdash; Controls whether the limit dropdown (which allows users to change the number of data shown) is always shown or not. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$show_search`](#$show_search) &mdash; Controls whether the search box under the datatable is shown. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$show_periods`](#$show_periods) &mdash; Controls whether the period selector under the datatable is shown. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$selectable_periods`](#$selectable_periods) &mdash; Controls which periods can be selected when the period selector is enabled Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$show_export`](#$show_export) &mdash; Controls whether the export feature under the datatable is shown. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$enable_sort`](#$enable_sort) &mdash; Controls whether the user can sort DataTables by clicking on table column headings. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$show_bar_chart`](#$show_bar_chart) &mdash; Controls whether the footer icon that allows users to view data as a bar chart is shown. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$show_pie_chart`](#$show_pie_chart) &mdash; Controls whether the footer icon that allows users to view data as a pie chart is shown. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$show_tag_cloud`](#$show_tag_cloud) &mdash; Controls whether the footer icon that allows users to view data as a tag cloud is shown. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$show_as_content_block`](#$show_as_content_block) &mdash; If enabled, shows the visualization as a content block. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$show_title`](#$show_title) &mdash; If enabled shows the title of the report. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$show_export_as_rss_feed`](#$show_export_as_rss_feed) &mdash; Controls whether the user is allowed to export data as an RSS feed or not. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$show_ecommerce`](#$show_ecommerce) &mdash; Controls whether the 'Ecoommerce Orders'/'Abandoned Cart' footer icons are shown or not. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$show_header_message`](#$show_header_message) &mdash; Stores an HTML message (if any) to display above the datatable view. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$show_footer_message`](#$show_footer_message) &mdash; Stores an HTML message (if any) to display under the datatable view. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$metrics_documentation`](#$metrics_documentation) &mdash; Array property that stores documentation for individual metrics. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$tooltip_metadata_name`](#$tooltip_metadata_name) &mdash; Row metadata name that contains the tooltip for the specific row. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$self_url`](#$self_url) &mdash; The URL to the report the view is displaying. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$datatable_css_class`](#$datatable_css_class) &mdash; CSS class to use in the output HTML div. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$datatable_js_type`](#$datatable_js_type) &mdash; The JavaScript class to instantiate after the result HTML is obtained. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$search_recursive`](#$search_recursive) &mdash; If true, searching through the DataTable will search through all subtables. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$y_axis_unit`](#$y_axis_unit) &mdash; The unit of the displayed column. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$show_export_as_image_icon`](#$show_export_as_image_icon) &mdash; Controls whether to show the 'Export as Image' footer icon. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$filters`](#$filters) &mdash; Array of DataTable filters that should be run before displaying a DataTable. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$subtable_controller_action`](#$subtable_controller_action) &mdash; Contains the controller action to call when requesting subtables of the current report. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$show_pagination_control`](#$show_pagination_control) &mdash; Controls whether the 'prev'/'next' links are shown in the DataTable footer. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$show_offset_information`](#$show_offset_information) &mdash; Controls whether offset information (ie, '5-10 of 20') is shown under the datatable. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$hide_annotations_view`](#$hide_annotations_view) &mdash; Controls whether annotations are shown or not. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$disable_all_rows_filter_limit`](#$disable_all_rows_filter_limit) &mdash; Controls whether the 'all' row limit option is shown for the limit selector. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$max_export_filter_limit`](#$max_export_filter_limit) &mdash; Sets a limit for the maximum number of rows that can be exported. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$no_data_message`](#$no_data_message) &mdash; Message to show if not data is available for the report Defaults to `CoreHome_ThereIsNoDataForThisReport` if not set Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$datatable_actions`](#$datatable_actions) &mdash; List of extra actions to display as icons in the datatable footer. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$segmented_visitor_log_segment_suffix`](#$segmented_visitor_log_segment_suffix) Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$disable_comparison`](#$disable_comparison) &mdash; Disable comparison support for this specific usage of a ViewDataTable. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$report_id`](#$report_id) Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$controllerName`](#$controllername) Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`$controllerAction`](#$controlleraction) Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)

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

Controls whether the buttons and UI controls around the visualization or shown or
if just the visualization alone is shown.

#### Signature

- Its type is not specified.


<a name="$show_goals" id="$show_goals"></a>
<a name="show_goals" id="show_goals"></a>
### `$show_goals`

Controls whether the goals footer icon is shown.

#### Signature

- Its type is not specified.


<a name="$show_insights" id="$show_insights"></a>
<a name="show_insights" id="show_insights"></a>
### `$show_insights`

Controls whether the 'insights' footer icon is shown.

#### Signature

- Its type is not specified.


<a name="$translations" id="$translations"></a>
<a name="translations" id="translations"></a>
### `$translations`

Array property mapping DataTable column names with their internationalized names.

The default value for this property is set elsewhere. It will contain translations
of common metrics.

#### Signature

- Its type is not specified.


<a name="$show_exclude_low_population" id="$show_exclude_low_population"></a>
<a name="show_exclude_low_population" id="show_exclude_low_population"></a>
### `$show_exclude_low_population`

Controls whether the 'Exclude Low Population' option (visible in the popup that displays after
clicking the 'cog' icon) is shown.

#### Signature

- Its type is not specified.


<a name="$show_flatten_table" id="$show_flatten_table"></a>
<a name="show_flatten_table" id="show_flatten_table"></a>
### `$show_flatten_table`

Whether to show the 'Flatten' option (visible in the popup that displays after clicking the
'cog' icon).

#### Signature

- Its type is not specified.


<a name="$show_pivot_by_subtable" id="$show_pivot_by_subtable"></a>
<a name="show_pivot_by_subtable" id="show_pivot_by_subtable"></a>
### `$show_pivot_by_subtable`

Whether to show the 'Pivot by subtable' option (visible in the popup that displays after clicking
the 'cog' icon).

#### Signature

- Its type is not specified.


<a name="$pivot_by_dimension" id="$pivot_by_dimension"></a>
<a name="pivot_by_dimension" id="pivot_by_dimension"></a>
### `$pivot_by_dimension`

The ID of the dimension to pivot by when the 'pivot by subtable' option is clicked. Defaults
to the subtable dimension of the report being displayed.

#### Signature

- Its type is not specified.


<a name="$pivot_by_column" id="$pivot_by_column"></a>
<a name="pivot_by_column" id="pivot_by_column"></a>
### `$pivot_by_column`

The column to display in pivot tables. Defaults to the first non-label column if not specified.

#### Signature

- Its type is not specified.


<a name="$pivot_dimension_name" id="$pivot_dimension_name"></a>
<a name="pivot_dimension_name" id="pivot_dimension_name"></a>
### `$pivot_dimension_name`

The human readable name of the pivot dimension.

#### Signature

- Its type is not specified.


<a name="$show_table" id="$show_table"></a>
<a name="show_table" id="show_table"></a>
### `$show_table`

Controls whether the footer icon that allows users to switch to the 'normal' DataTable view
is shown.

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

Array property that determines which columns will be shown. Columns not in this array
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


<a name="$related_reports" id="$related_reports"></a>
<a name="related_reports" id="related_reports"></a>
### `$related_reports`

Related reports are listed below a datatable view. When clicked, the original report will
change to the clicked report and the list will change so the original report can be
navigated back to.

#### Signature

- Its type is not specified.


<a name="$related_reports_title" id="$related_reports_title"></a>
<a name="related_reports_title" id="related_reports_title"></a>
### `$related_reports_title`

"Related Reports" is displayed by default before listing the Related reports,
The string can be changed.

#### Signature

- Its type is not specified.


<a name="$title" id="$title"></a>
<a name="title" id="title"></a>
### `$title`

The report title. Used with related reports so report headings can be changed when switching
reports.

This must be set if related reports are added.

#### Signature

- Its type is not specified.


<a name="$title_edit_entity_url" id="$title_edit_entity_url"></a>
<a name="title_edit_entity_url" id="title_edit_entity_url"></a>
### `$title_edit_entity_url`

If a URL is set, the title of the report will be clickable. Is supposed to be set for entities that can be
configured (edited) such as goal. Eg when there is a goal report, and someone is allowed to edit the goal entity,
a link is supposed to be with a URL to the edit goal form.

#### Signature

- It is a `string` value.

<a name="$description" id="$description"></a>
<a name="description" id="description"></a>
### `$description`

The report description. eg like a goal description

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


<a name="$onlineguideurl" id="$onlineguideurl"></a>
<a name="onlineGuideUrl" id="onlineGuideUrl"></a>
### `$onlineGuideUrl`

URL linking to an online guide for this report (or plugin).

#### Signature

- It is a `string` value.

<a name="$custom_parameters" id="$custom_parameters"></a>
<a name="custom_parameters" id="custom_parameters"></a>
### `$custom_parameters`

Array property containing custom data to be saved in JSON in the data-params HTML attribute
of a data table div. This data can be used by JavaScript DataTable classes.

e.g. array('typeReferrer' => ...)

It can then be accessed in the twig templates by clientSideParameters.typeReferrer

#### Signature

- Its type is not specified.


<a name="$show_limit_control" id="$show_limit_control"></a>
<a name="show_limit_control" id="show_limit_control"></a>
### `$show_limit_control`

Controls whether the limit dropdown (which allows users to change the number of data shown)
is always shown or not.

Normally shown only if pagination is enabled.

#### Signature

- Its type is not specified.


<a name="$show_search" id="$show_search"></a>
<a name="show_search" id="show_search"></a>
### `$show_search`

Controls whether the search box under the datatable is shown.

#### Signature

- Its type is not specified.


<a name="$show_periods" id="$show_periods"></a>
<a name="show_periods" id="show_periods"></a>
### `$show_periods`

Controls whether the period selector under the datatable is shown.

#### Signature

- Its type is not specified.


<a name="$selectable_periods" id="$selectable_periods"></a>
<a name="selectable_periods" id="selectable_periods"></a>
### `$selectable_periods`

Controls which periods can be selected when the period selector is enabled

#### Signature

- Its type is not specified.


<a name="$show_export" id="$show_export"></a>
<a name="show_export" id="show_export"></a>
### `$show_export`

Controls whether the export feature under the datatable is shown.

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


<a name="$show_as_content_block" id="$show_as_content_block"></a>
<a name="show_as_content_block" id="show_as_content_block"></a>
### `$show_as_content_block`

If enabled, shows the visualization as a content block. This is similar to wrapping your visualization
with a `<div piwik-content-block></div>`

#### Signature

- It is a `bool` value.

<a name="$show_title" id="$show_title"></a>
<a name="show_title" id="show_title"></a>
### `$show_title`

If enabled shows the title of the report.

#### Signature

- It is a `bool` value.

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


<a name="$show_header_message" id="$show_header_message"></a>
<a name="show_header_message" id="show_header_message"></a>
### `$show_header_message`

Stores an HTML message (if any) to display above the datatable view.

Attention: Message will be printed raw. Don't forget to escape where needed!

#### Signature

- Its type is not specified.


<a name="$show_footer_message" id="$show_footer_message"></a>
<a name="show_footer_message" id="show_footer_message"></a>
### `$show_footer_message`

Stores an HTML message (if any) to display under the datatable view.

Attention: Message will be printed raw. Don't forget to escape where needed!

#### Signature

- Its type is not specified.


<a name="$metrics_documentation" id="$metrics_documentation"></a>
<a name="metrics_documentation" id="metrics_documentation"></a>
### `$metrics_documentation`

Array property that stores documentation for individual metrics.

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

The URL to the report the view is displaying. Modifying this means clicking back to this report
from a Related Report will go to a different URL. Can be used to load an entire page instead
of a single report when going back to the original report.

The URL used to request the report without generic filters.

#### Signature

- Its type is not specified.


<a name="$datatable_css_class" id="$datatable_css_class"></a>
<a name="datatable_css_class" id="datatable_css_class"></a>
### `$datatable_css_class`

CSS class to use in the output HTML div. This is added in addition to the visualization CSS
class.

#### Signature

- Its type is not specified.


<a name="$datatable_js_type" id="$datatable_js_type"></a>
<a name="datatable_js_type" id="datatable_js_type"></a>
### `$datatable_js_type`

The JavaScript class to instantiate after the result HTML is obtained. This class handles all
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

The unit of the displayed column. Valid if only one non-label column is displayed.

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

Array of DataTable filters that should be run before displaying a DataTable. Elements
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

By default, this is set to the controller action used to request the report.

#### Signature

- Its type is not specified.


<a name="$show_pagination_control" id="$show_pagination_control"></a>
<a name="show_pagination_control" id="show_pagination_control"></a>
### `$show_pagination_control`

Controls whether the 'prev'/'next' links are shown in the DataTable footer. These links
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


<a name="$disable_all_rows_filter_limit" id="$disable_all_rows_filter_limit"></a>
<a name="disable_all_rows_filter_limit" id="disable_all_rows_filter_limit"></a>
### `$disable_all_rows_filter_limit`

Controls whether the 'all' row limit option is shown for the limit selector.

#### Signature

- It is a `bool` value.

<a name="$max_export_filter_limit" id="$max_export_filter_limit"></a>
<a name="max_export_filter_limit" id="max_export_filter_limit"></a>
### `$max_export_filter_limit`

Sets a limit for the maximum number of rows that can be exported.

#### Signature

- It is a `int` value.

<a name="$no_data_message" id="$no_data_message"></a>
<a name="no_data_message" id="no_data_message"></a>
### `$no_data_message`

Message to show if not data is available for the report
Defaults to `CoreHome_ThereIsNoDataForThisReport` if not set

Attention: Message will be printed raw. Don't forget to escape where needed!

#### Signature

- It is a `string` value.

<a name="$datatable_actions" id="$datatable_actions"></a>
<a name="datatable_actions" id="datatable_actions"></a>
### `$datatable_actions`

List of extra actions to display as icons in the datatable footer.

Not API yet.

#### Signature

- It is a `array` value.

<a name="$segmented_visitor_log_segment_suffix" id="$segmented_visitor_log_segment_suffix"></a>
<a name="segmented_visitor_log_segment_suffix" id="segmented_visitor_log_segment_suffix"></a>
### `$segmented_visitor_log_segment_suffix`

#### Signature

- Its type is not specified.


<a name="$disable_comparison" id="$disable_comparison"></a>
<a name="disable_comparison" id="disable_comparison"></a>
### `$disable_comparison`

Disable comparison support for this specific usage of a ViewDataTable.

#### Signature

- It is a `bool` value.

<a name="$report_id" id="$report_id"></a>
<a name="report_id" id="report_id"></a>
### `$report_id`

#### Signature

- Its type is not specified.


<a name="$controllername" id="$controllername"></a>
<a name="controllerName" id="controllerName"></a>
### `$controllerName`

#### Signature

- Its type is not specified.


<a name="$controlleraction" id="$controlleraction"></a>
<a name="controllerAction" id="controllerAction"></a>
### `$controllerAction`

#### Signature

- Its type is not specified.


Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`addPropertiesThatShouldBeAvailableClientSide()`](#addpropertiesthatshouldbeavailableclientside) &mdash; Marks display properties as client side properties. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`addPropertiesThatCanBeOverwrittenByQueryParams()`](#addpropertiesthatcanbeoverwrittenbyqueryparams) &mdash; Marks display properties as overridable. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`getProperties()`](#getproperties) &mdash; Returns array of all property values in this config object. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`removeColumnToDisplay()`](#removecolumntodisplay) Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`getPriorityFilters()`](#getpriorityfilters) Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`getPresentationFilters()`](#getpresentationfilters) Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`addRelatedReport()`](#addrelatedreport) &mdash; Adds a related report to the [$related_reports](/api-reference/Piwik/Plugins/CoreVisualizations/Visualizations/Graph/Config#$related_reports) property. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`addRelatedReports()`](#addrelatedreports) &mdash; Adds several related reports to the [$related_reports](/api-reference/Piwik/Plugins/CoreVisualizations/Visualizations/Graph/Config#$related_reports) property. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`addTranslation()`](#addtranslation) &mdash; Associates internationalized text with a metric. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`addTranslations()`](#addtranslations) &mdash; Associates multiple translations with metrics. Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)
- [`disablePivotBySubtableIfTableHasNoSubtables()`](#disablepivotbysubtableiftablehasnosubtables) Inherited from [`Config`](../../../../../Piwik/ViewDataTable/Config.md)

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature


<a name="addpropertiesthatshouldbeavailableclientside" id="addpropertiesthatshouldbeavailableclientside"></a>
<a name="addPropertiesThatShouldBeAvailableClientSide" id="addPropertiesThatShouldBeAvailableClientSide"></a>
### `addPropertiesThatShouldBeAvailableClientSide()`

Marks display properties as client side properties. [Read this](#client-side-properties-desc)
to learn more.

#### Signature

-  It accepts the following parameter(s):
    - `$propertyNames` (`array`) &mdash;
       List of property names, eg, `array('show_limit_control', 'show_goals')`.
- It does not return anything.

<a name="addpropertiesthatcanbeoverwrittenbyqueryparams" id="addpropertiesthatcanbeoverwrittenbyqueryparams"></a>
<a name="addPropertiesThatCanBeOverwrittenByQueryParams" id="addPropertiesThatCanBeOverwrittenByQueryParams"></a>
### `addPropertiesThatCanBeOverwrittenByQueryParams()`

Marks display properties as overridable. [Read this](#overridable-properties-desc) to
learn more.

#### Signature

-  It accepts the following parameter(s):
    - `$propertyNames` (`array`) &mdash;
       List of property names, eg, `array('show_limit_control', 'show_goals')`.
- It does not return anything.

<a name="getproperties" id="getproperties"></a>
<a name="getProperties" id="getProperties"></a>
### `getProperties()`

Returns array of all property values in this config object. Property values are mapped
by name.

#### Signature


- *Returns:*  `array` &mdash;
    eg, `array('show_limit_control' => 0, 'show_goals' => 1, ...)`

<a name="removecolumntodisplay" id="removecolumntodisplay"></a>
<a name="removeColumnToDisplay" id="removeColumnToDisplay"></a>
### `removeColumnToDisplay()`

#### Signature

-  It accepts the following parameter(s):
    - `$columnToRemove`
      
- It does not return anything.

<a name="getpriorityfilters" id="getpriorityfilters"></a>
<a name="getPriorityFilters" id="getPriorityFilters"></a>
### `getPriorityFilters()`

#### Signature

- It does not return anything.

<a name="getpresentationfilters" id="getpresentationfilters"></a>
<a name="getPresentationFilters" id="getPresentationFilters"></a>
### `getPresentationFilters()`

#### Signature

- It does not return anything.

<a name="addrelatedreport" id="addrelatedreport"></a>
<a name="addRelatedReport" id="addRelatedReport"></a>
### `addRelatedReport()`

Adds a related report to the [$related_reports](/api-reference/Piwik/Plugins/CoreVisualizations/Visualizations/Graph/Config#$related_reports) property. If the report
references the one that is currently being displayed, it will not be added to the related
report list.

#### Signature

-  It accepts the following parameter(s):
    - `$relatedReport` (`string`) &mdash;
       The plugin and method of the report, eg, `'DevicesDetection.getBrowsers'`.
    - `$title` (`string`) &mdash;
       The report's display name, eg, `'Browsers'`.
    - `$queryParams` (`array`) &mdash;
       Any extra query parameters to set in releated report's URL, eg, `array('idGoal' => 'ecommerceOrder')`.
- It does not return anything.

<a name="addrelatedreports" id="addrelatedreports"></a>
<a name="addRelatedReports" id="addRelatedReports"></a>
### `addRelatedReports()`

Adds several related reports to the [$related_reports](/api-reference/Piwik/Plugins/CoreVisualizations/Visualizations/Graph/Config#$related_reports) property. If
any of the reports references the report that is currently being displayed, it will not
be added to the list. All other reports will still be added though.

If you need to make sure the related report URL has some extra query parameters,
use [addRelatedReport()](/api-reference/Piwik/Plugins/CoreVisualizations/Visualizations/Graph/Config#addrelatedreport).

#### Signature

-  It accepts the following parameter(s):
    - `$relatedReports` (`array`) &mdash;
       Array mapping report IDs with their internationalized display titles, eg, ``` array( 'DevicesDetection.getBrowsers' => 'Browsers', 'Resolution.getConfiguration' => 'Configurations' ) ```
- It does not return anything.

<a name="addtranslation" id="addtranslation"></a>
<a name="addTranslation" id="addTranslation"></a>
### `addTranslation()`

Associates internationalized text with a metric. Overwrites existing mappings.

See [$translations](/api-reference/Piwik/Plugins/CoreVisualizations/Visualizations/Graph/Config#$translations).

#### Signature

-  It accepts the following parameter(s):
    - `$columnName` (`string`) &mdash;
       The name of a column in the report data, eg, `'nb_visits'` or `'goal_1_nb_conversions'`.
    - `$translation` (`string`) &mdash;
       The internationalized text, eg, `'Visits'` or `"Conversions for 'My Goal'"`.
- It does not return anything.

<a name="addtranslations" id="addtranslations"></a>
<a name="addTranslations" id="addTranslations"></a>
### `addTranslations()`

Associates multiple translations with metrics.

See [$translations](/api-reference/Piwik/Plugins/CoreVisualizations/Visualizations/Graph/Config#$translations) and [addTranslation()](/api-reference/Piwik/Plugins/CoreVisualizations/Visualizations/Graph/Config#addtranslation).

#### Signature

-  It accepts the following parameter(s):
    - `$translations` (`array`) &mdash;
       An array of column name => text mappings, eg, ``` array( 'nb_visits' => 'Visits', 'goal_1_nb_conversions' => "Conversions for 'My Goal'" ) ```
- It does not return anything.

<a name="disablepivotbysubtableiftablehasnosubtables" id="disablepivotbysubtableiftablehasnosubtables"></a>
<a name="disablePivotBySubtableIfTableHasNoSubtables" id="disablePivotBySubtableIfTableHasNoSubtables"></a>
### `disablePivotBySubtableIfTableHasNoSubtables()`

#### Signature

-  It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../../../Piwik/DataTable.md)) &mdash;
      
- It does not return anything.

