<small>Piwik\Plugin\</small>

Report
======

Since Matomo 2.5.0

Defines a new report.

You can create a new report using the console command `./console generate:report`. The generated report will guide
you through the creation of a report.

Properties
----------

This class defines the following properties:

- [`$name`](#$name) &mdash; The translated name of the report.
- [`$categoryId`](#$categoryid) &mdash; The translation key of the category the report belongs to.
- [`$subcategoryId`](#$subcategoryid) &mdash; The translation key of the subcategory the report belongs to.
- [`$metrics`](#$metrics) &mdash; An array of supported metrics.
- [`$processedMetrics`](#$processedmetrics) &mdash; The processed metrics this report supports, eg `avg_time_on_site` or `nb_actions_per_visit`.
- [`$hasGoalMetrics`](#$hasgoalmetrics) &mdash; Set this property to true in case your report supports goal metrics.
- [`$supportsFlatten`](#$supportsflatten) &mdash; Set this property to false in case your report can't/shouldn't be flattened.
- [`$constantRowsCount`](#$constantrowscount) &mdash; Set it to boolean `true` if your report always returns a constant count of rows, for instance always 24 rows for 1-24 hours.
- [`$isSubtableReport`](#$issubtablereport) &mdash; Set it to boolean `true` if this report is a subtable report and won't be used as a standalone report.
- [`$parameters`](#$parameters) &mdash; Some reports may require additional URL parameters that need to be sent when a report is requested.
- [`$actionToLoadSubTables`](#$actiontoloadsubtables) &mdash; The name of the API action to load a subtable if supported.
- [`$order`](#$order) &mdash; The order of the report.
- [`$recursiveLabelSeparator`](#$recursivelabelseparator) &mdash; Separator for building recursive labels (or paths)

<a name="$name" id="$name"></a>
<a name="name" id="name"></a>
### `$name`

The translated name of the report. The name will be used for instance in the mobile app or if another report
defines this report as a related report.

#### Signature

- It is a `string` value.

<a name="$categoryid" id="$categoryid"></a>
<a name="categoryId" id="categoryId"></a>
### `$categoryId`

The translation key of the category the report belongs to.

#### Signature

- It is a `string` value.

<a name="$subcategoryid" id="$subcategoryid"></a>
<a name="subcategoryId" id="subcategoryId"></a>
### `$subcategoryId`

The translation key of the subcategory the report belongs to.

#### Signature

- It is a `string` value.

<a name="$metrics" id="$metrics"></a>
<a name="metrics" id="metrics"></a>
### `$metrics`

An array of supported metrics. Eg `array('nb_visits', 'nb_actions', .

..)`. Defaults to the platform default
metrics see Metrics::getDefaultProcessedMetrics().

#### Signature

- It is a `array` value.

<a name="$processedmetrics" id="$processedmetrics"></a>
<a name="processedMetrics" id="processedMetrics"></a>
### `$processedMetrics`

The processed metrics this report supports, eg `avg_time_on_site` or `nb_actions_per_visit`. Defaults to the
platform default processed metrics, see Metrics::getDefaultProcessedMetrics(). Set it to boolean `false`
if your report does not support any processed metrics at all. Otherwise an array of metric names.

Eg `array('avg_time_on_site', 'nb_actions_per_visit', ...)`

#### Signature

- It is a `array` value.

<a name="$hasgoalmetrics" id="$hasgoalmetrics"></a>
<a name="hasGoalMetrics" id="hasGoalMetrics"></a>
### `$hasGoalMetrics`

Set this property to true in case your report supports goal metrics. In this case, the goal metrics will be
automatically added to the report metadata and the report will be displayed in the Goals UI.

#### Signature

- It is a `bool` value.

<a name="$supportsflatten" id="$supportsflatten"></a>
<a name="supportsFlatten" id="supportsFlatten"></a>
### `$supportsFlatten`

Set this property to false in case your report can't/shouldn't be flattened.

In this case, flattener won't be applied even if parameter is provided in a request

#### Signature

- It is a `bool` value.

<a name="$constantrowscount" id="$constantrowscount"></a>
<a name="constantRowsCount" id="constantRowsCount"></a>
### `$constantRowsCount`

Set it to boolean `true` if your report always returns a constant count of rows, for instance always 24 rows
for 1-24 hours.

#### Signature

- It is a `bool` value.

<a name="$issubtablereport" id="$issubtablereport"></a>
<a name="isSubtableReport" id="isSubtableReport"></a>
### `$isSubtableReport`

Set it to boolean `true` if this report is a subtable report and won't be used as a standalone report.

#### Signature

- It is a `bool` value.

<a name="$parameters" id="$parameters"></a>
<a name="parameters" id="parameters"></a>
### `$parameters`

Some reports may require additional URL parameters that need to be sent when a report is requested. For instance
a "goal" report might need a "goalId": `array('idgoal' => 5)`.

#### Signature

- It can be one of the following types:
    - `null`
    - `array`

<a name="$actiontoloadsubtables" id="$actiontoloadsubtables"></a>
<a name="actionToLoadSubTables" id="actionToLoadSubTables"></a>
### `$actionToLoadSubTables`

The name of the API action to load a subtable if supported. The action has to be of the same module. For instance
a report "getKeywords" might support a subtable "getSearchEngines" which shows how often a keyword was searched
via a specific search engine.

#### Signature

- It is a `string` value.

<a name="$order" id="$order"></a>
<a name="order" id="order"></a>
### `$order`

The order of the report. Depending on the order the report gets a different position in the list of widgets,
the menu and the mobile app.

#### Signature

- It is a `int` value.

<a name="$recursivelabelseparator" id="$recursivelabelseparator"></a>
<a name="recursiveLabelSeparator" id="recursiveLabelSeparator"></a>
### `$recursiveLabelSeparator`

Separator for building recursive labels (or paths)

#### Signature

- It is a `string` value.

Methods
-------

The class defines the following methods:

- [`init()`](#init) &mdash; Here you can do any instance initialization and overwrite any default values.
- [`isEnabled()`](#isenabled) &mdash; Defines whether a report is enabled or not.
- [`checkIsEnabled()`](#checkisenabled) &mdash; This method checks whether the report is available, see {@isEnabled()}.
- [`getDefaultTypeViewDataTable()`](#getdefaulttypeviewdatatable) &mdash; Returns the id of the default visualization for this report.
- [`alwaysUseDefaultViewDataTable()`](#alwaysusedefaultviewdatatable) &mdash; Returns if the default viewDataTable type should always be used.
- [`configureView()`](#configureview) &mdash; Here you can configure how your report should be displayed and which capabilities your report has.
- [`render()`](#render) &mdash; Renders a report depending on the configured ViewDataTable see [configureView()](/api-reference/Piwik/Plugin/Report#configureview) and [getDefaultTypeViewDataTable()](/api-reference/Piwik/Plugin/Report#getdefaulttypeviewdatatable).
- [`getId()`](#getid) &mdash; Processing a uniqueId for each report, can be used by UIs as a key to match a given report
- [`configureWidgets()`](#configurewidgets) &mdash; lets you add any amount of widgets for this report.
- [`getMetrics()`](#getmetrics) &mdash; Returns an array of supported metrics and their corresponding translations.
- [`getMetricsRequiredForReport()`](#getmetricsrequiredforreport) &mdash; Returns the list of metrics required at minimum for a report factoring in the columns requested by the report requester.
- [`getProcessedMetrics()`](#getprocessedmetrics) &mdash; Returns an array of supported processed metrics and their corresponding translations.
- [`getAllMetrics()`](#getallmetrics) &mdash; Returns the array of all metrics displayed by this report.
- [`getMetricNamesToProcessReportTotals()`](#getmetricnamestoprocessreporttotals) &mdash; Use this method to register metrics to process report totals.
- [`getMetricsDocumentation()`](#getmetricsdocumentation) &mdash; Returns an array of metric documentations and their corresponding translations.
- [`configureReportMetadata()`](#configurereportmetadata) &mdash; If the report is enabled the report metadata for this report will be built and added to the list of available reports.
- [`getDocumentation()`](#getdocumentation) &mdash; Get report documentation.
- [`getSecondarySortColumnCallback()`](#getsecondarysortcolumncallback) &mdash; Allows to define a callback that will be used to determine the secondary column to sort by
- [`getRelatedReports()`](#getrelatedreports) &mdash; Get the list of related reports if there are any.
- [`getParameters()`](#getparameters)
- [`getSubtableDimension()`](#getsubtabledimension) &mdash; Returns the Dimension instance of this report's subtable report.
- [`getThirdLeveltableDimension()`](#getthirdleveltabledimension) &mdash; Returns the Dimension instance of the subtable report of this report's subtable report.
- [`isSubtableReport()`](#issubtablereport) &mdash; Returns true if the report is for another report's subtable, false if otherwise.
- [`fetch()`](#fetch) &mdash; Fetches the report represented by this instance.
- [`fetchSubtable()`](#fetchsubtable) &mdash; Fetches a subtable for the report represented by this instance.
- [`getForDimension()`](#getfordimension) &mdash; Finds a top level report that provides stats for a specific Dimension.
- [`getProcessedMetricsById()`](#getprocessedmetricsbyid) &mdash; Returns an array mapping the ProcessedMetrics served by this report by their string names.
- [`getMetricsForTable()`](#getmetricsfortable) &mdash; Returns the Metrics that are displayed by a DataTable of a certain Report type.
- [`getProcessedMetricsForTable()`](#getprocessedmetricsfortable) &mdash; Returns the ProcessedMetrics that should be computed and formatted for a DataTable of a certain report.

<a name="init" id="init"></a>
<a name="init" id="init"></a>
### `init()`

Here you can do any instance initialization and overwrite any default values. You should avoid doing time
consuming initialization here and if possible delay as long as possible. An instance of this report will be
created in most page requests.

#### Signature

- It does not return anything or a mixed result.

<a name="isenabled" id="isenabled"></a>
<a name="isEnabled" id="isEnabled"></a>
### `isEnabled()`

Defines whether a report is enabled or not. For instance some reports might not be available to every user or
might depend on a setting (such as Ecommerce) of a site. In such a case you can perform any checks and then
return `true` or `false`. If your report is only available to users having super user access you can do the
following: `return Piwik::hasUserSuperUserAccess();`

#### Signature

- It returns a `bool` value.

<a name="checkisenabled" id="checkisenabled"></a>
<a name="checkIsEnabled" id="checkIsEnabled"></a>
### `checkIsEnabled()`

This method checks whether the report is available, see {@isEnabled()}. If not, it triggers an exception
containing a message that will be displayed to the user. You can overwrite this message in case you want to
customize the error message. Eg.

```
if (!$this->isEnabled()) {
throw new Exception('Setting XYZ is not enabled or the user has not enough permission');
}
```

#### Signature

- It does not return anything or a mixed result.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

<a name="getdefaulttypeviewdatatable" id="getdefaulttypeviewdatatable"></a>
<a name="getDefaultTypeViewDataTable" id="getDefaultTypeViewDataTable"></a>
### `getDefaultTypeViewDataTable()`

Returns the id of the default visualization for this report. Eg 'table' or 'pie'. Defaults to the HTML table.

#### Signature

- It returns a `string` value.

<a name="alwaysusedefaultviewdatatable" id="alwaysusedefaultviewdatatable"></a>
<a name="alwaysUseDefaultViewDataTable" id="alwaysUseDefaultViewDataTable"></a>
### `alwaysUseDefaultViewDataTable()`

Returns if the default viewDataTable type should always be used. e.g. the type won't be changeable through config or url params.

Defaults to false

#### Signature

- It returns a `bool` value.

<a name="configureview" id="configureview"></a>
<a name="configureView" id="configureView"></a>
### `configureView()`

Here you can configure how your report should be displayed and which capabilities your report has. For instance
whether your report supports a "search" or not. EG `$view->config->show_search = false`. You can also change the
default request config. For instance you can change how many rows are displayed by default:
`$view->requestConfig->filter_limit = 10;`. See [ViewDataTable](/api-reference/Piwik/Plugin/ViewDataTable) for more information.

#### Signature

-  It accepts the following parameter(s):
    - `$view` ([`ViewDataTable`](../../Piwik/Plugin/ViewDataTable.md)) &mdash;
      
- It does not return anything or a mixed result.

<a name="render" id="render"></a>
<a name="render" id="render"></a>
### `render()`

Renders a report depending on the configured ViewDataTable see [configureView()](/api-reference/Piwik/Plugin/Report#configureview) and
[getDefaultTypeViewDataTable()](/api-reference/Piwik/Plugin/Report#getdefaulttypeviewdatatable). If you want to customize the render process or just render any custom view
you can overwrite this method.

#### Signature

- It returns a `string` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; In case the given API action does not exist yet.

<a name="getid" id="getid"></a>
<a name="getId" id="getId"></a>
### `getId()`

Processing a uniqueId for each report, can be used by UIs as a key to match a given report

#### Signature

- It returns a `string` value.

<a name="configurewidgets" id="configurewidgets"></a>
<a name="configureWidgets" id="configureWidgets"></a>
### `configureWidgets()`

lets you add any amount of widgets for this report. If a report defines a [$categoryId](/api-reference/Piwik/Plugin/Report#$categoryid) and a
[$subcategoryId](/api-reference/Piwik/Plugin/Report#$subcategoryid) a widget will be generated automatically.

Example to add a widget manually by overwriting this method in your report:
$widgetsList->addWidgetConfig($factory->createWidget());

If you want to have the name and the order of the widget differently to the name and order of the report you can
do the following:
$widgetsList->addWidgetConfig($factory->createWidget()->setName('Custom')->setOrder(5));

If you want to add a widget to any container defined by your plugin or by another plugin you can do
this:
$widgetsList->addToContainerWidget($containerId = 'Products', $factory->createWidget());

#### Signature

-  It accepts the following parameter(s):
    - `$widgetsList` ([`WidgetsList`](../../Piwik/Widget/WidgetsList.md)) &mdash;
      
    - `$factory` ([`ReportWidgetFactory`](../../Piwik/Report/ReportWidgetFactory.md)) &mdash;
      
- It does not return anything or a mixed result.

<a name="getmetrics" id="getmetrics"></a>
<a name="getMetrics" id="getMetrics"></a>
### `getMetrics()`

Returns an array of supported metrics and their corresponding translations. Eg `array('nb_visits' => 'Visits')`.

By default the given [$metrics](/api-reference/Piwik/Plugin/Report#$metrics) are used and their corresponding translations are looked up automatically.
If a metric is not translated, you should add the default metric translation for this metric using
the [Metrics.getDefaultMetricTranslations](/api-reference/events#metricsgetdefaultmetrictranslations) event. If you want to overwrite any default metric translation
you should overwrite this method, call this parent method to get all default translations and overwrite any
custom metric translations.

#### Signature

- It returns a `array` value.

<a name="getmetricsrequiredforreport" id="getmetricsrequiredforreport"></a>
<a name="getMetricsRequiredForReport" id="getMetricsRequiredForReport"></a>
### `getMetricsRequiredForReport()`

Returns the list of metrics required at minimum for a report factoring in the columns requested by
the report requester.

This will return all the metrics requested (or all the metrics in the report if nothing is requested)
**plus** the metrics required to calculate the requested processed metrics.

This method should be used in **Plugin.get** API methods.

#### Signature

-  It accepts the following parameter(s):
    - `$allMetrics` (`string[]`|`null`) &mdash;
       The list of all available unprocessed metrics. Defaults to this report's metrics.
    - `$restrictToColumns` (`string[]`|`null`) &mdash;
       The requested columns.
- It returns a `string[]` value.

<a name="getprocessedmetrics" id="getprocessedmetrics"></a>
<a name="getProcessedMetrics" id="getProcessedMetrics"></a>
### `getProcessedMetrics()`

Returns an array of supported processed metrics and their corresponding translations. Eg
`array('nb_visits' => 'Visits')`. By default the given [$processedMetrics](/api-reference/Piwik/Plugin/Report#$processedmetrics) are used and their
corresponding translations are looked up automatically. If a metric is not translated, you should add the
default metric translation for this metric using the [Metrics.getDefaultMetricTranslations](/api-reference/events#metricsgetdefaultmetrictranslations) event. If you
want to overwrite any default metric translation you should overwrite this method, call this parent method to
get all default translations and overwrite any custom metric translations.

#### Signature


- *Returns:*  `array`|`mixed` &mdash;
    

<a name="getallmetrics" id="getallmetrics"></a>
<a name="getAllMetrics" id="getAllMetrics"></a>
### `getAllMetrics()`

Returns the array of all metrics displayed by this report.

#### Signature

- It returns a `array` value.

<a name="getmetricnamestoprocessreporttotals" id="getmetricnamestoprocessreporttotals"></a>
<a name="getMetricNamesToProcessReportTotals" id="getMetricNamesToProcessReportTotals"></a>
### `getMetricNamesToProcessReportTotals()`

Use this method to register metrics to process report totals.

When a metric is registered, it will process the report total values and as a result show percentage values
in the HTML Table reporting visualization.

#### Signature


- *Returns:*  `string[]` &mdash;
    metricId => metricColumn, if the report has only column names and no IDs, it should return
                  metricColumn => metricColumn, eg array('13' => 'nb_pageviews') or array('mymetric' => 'mymetric')

<a name="getmetricsdocumentation" id="getmetricsdocumentation"></a>
<a name="getMetricsDocumentation" id="getMetricsDocumentation"></a>
### `getMetricsDocumentation()`

Returns an array of metric documentations and their corresponding translations. Eg
`array('nb_visits' => 'If a visitor comes to your website for the first time or if they visit a page more than 30 minutes after.

..')`.
By default the given [$metrics](/api-reference/Piwik/Plugin/Report#$metrics) are used and their corresponding translations are looked up automatically.
If there is a metric documentation not found, you should add the default metric documentation translation for
this metric using the [Metrics.getDefaultMetricDocumentationTranslations](/api-reference/events#metricsgetdefaultmetricdocumentationtranslations) event. If you want to overwrite
any default metric translation you should overwrite this method, call this parent method to get all default
translations and overwrite any custom metric translations.

#### Signature

- It returns a `array` value.

<a name="configurereportmetadata" id="configurereportmetadata"></a>
<a name="configureReportMetadata" id="configureReportMetadata"></a>
### `configureReportMetadata()`

If the report is enabled the report metadata for this report will be built and added to the list of available
reports. Overwrite this method and leave it empty in case you do not want your report to be added to the report
metadata. In this case your report won't be visible for instance in the mobile app and scheduled reports
generator. We recommend to change this behavior only if you are familiar with the Piwik core. `$infos` contains
the current requested date, period and site.

#### Signature

-  It accepts the following parameter(s):
    - `$availableReports`
      
    - `$infos`
      
- It does not return anything or a mixed result.

<a name="getdocumentation" id="getdocumentation"></a>
<a name="getDocumentation" id="getDocumentation"></a>
### `getDocumentation()`

Get report documentation.

#### Signature

- It returns a `string` value.

<a name="getsecondarysortcolumncallback" id="getsecondarysortcolumncallback"></a>
<a name="getSecondarySortColumnCallback" id="getSecondarySortColumnCallback"></a>
### `getSecondarySortColumnCallback()`

Allows to define a callback that will be used to determine the secondary column to sort by

```
public function getSecondarySortColumnCallback()
{
    return function ($primaryColumn) {
        switch ($primaryColumn) {
            case Metrics::NB_CLICKS:
                return Metrics::NB_IMPRESSIONS;
            case 'label':
            default:
                return Metrics::NB_CLICKS;
        }
    };
}
```

#### Signature


- *Returns:*  `null`|`callable` &mdash;
    

<a name="getrelatedreports" id="getrelatedreports"></a>
<a name="getRelatedReports" id="getRelatedReports"></a>
### `getRelatedReports()`

Get the list of related reports if there are any. They will be displayed for instance below a report as a
recommended related report.

#### Signature

- It returns a [`Report[]`](../../Piwik/Plugin/Report.md) value.

<a name="getparameters" id="getparameters"></a>
<a name="getParameters" id="getParameters"></a>
### `getParameters()`

#### Signature

- It does not return anything or a mixed result.

<a name="getsubtabledimension" id="getsubtabledimension"></a>
<a name="getSubtableDimension" id="getSubtableDimension"></a>
### `getSubtableDimension()`

Returns the Dimension instance of this report's subtable report.

#### Signature


- *Returns:*  `Piwik\Plugin\Dimension`|`null` &mdash;
    The subtable report's dimension or null if there is subtable report or
                       no dimension for the subtable report.

<a name="getthirdleveltabledimension" id="getthirdleveltabledimension"></a>
<a name="getThirdLeveltableDimension" id="getThirdLeveltableDimension"></a>
### `getThirdLeveltableDimension()`

Returns the Dimension instance of the subtable report of this report's subtable report.

#### Signature


- *Returns:*  `Piwik\Plugin\Dimension`|`null` &mdash;
    The subtable report's dimension or null if there is no subtable report or
                       no dimension for the subtable report.

<a name="issubtablereport" id="issubtablereport"></a>
<a name="isSubtableReport" id="isSubtableReport"></a>
### `isSubtableReport()`

Returns true if the report is for another report's subtable, false if otherwise.

#### Signature

- It returns a `bool` value.

<a name="fetch" id="fetch"></a>
<a name="fetch" id="fetch"></a>
### `fetch()`

Fetches the report represented by this instance.

#### Signature

-  It accepts the following parameter(s):
    - `$paramOverride` (`array`) &mdash;
       Query parameter overrides.
- It returns a `Piwik\Plugin\DataTable` value.

<a name="fetchsubtable" id="fetchsubtable"></a>
<a name="fetchSubtable" id="fetchSubtable"></a>
### `fetchSubtable()`

Fetches a subtable for the report represented by this instance.

#### Signature

-  It accepts the following parameter(s):
    - `$idSubtable` (`int`) &mdash;
       The subtable ID.
    - `$paramOverride` (`array`) &mdash;
       Query parameter overrides.
- It returns a `Piwik\Plugin\DataTable` value.

<a name="getfordimension" id="getfordimension"></a>
<a name="getForDimension" id="getForDimension"></a>
### `getForDimension()`

Finds a top level report that provides stats for a specific Dimension.

#### Signature

-  It accepts the following parameter(s):
    - `$dimension` ([`Dimension`](../../Piwik/Columns/Dimension.md)) &mdash;
       The dimension whose report we're looking for.

- *Returns:*  [`Report`](../../Piwik/Plugin/Report.md)|`null` &mdash;
    The

<a name="getprocessedmetricsbyid" id="getprocessedmetricsbyid"></a>
<a name="getProcessedMetricsById" id="getProcessedMetricsById"></a>
### `getProcessedMetricsById()`

Returns an array mapping the ProcessedMetrics served by this report by their string names.

#### Signature

- It returns a [`ProcessedMetric[]`](../../Piwik/Plugin/ProcessedMetric.md) value.

<a name="getmetricsfortable" id="getmetricsfortable"></a>
<a name="getMetricsForTable" id="getMetricsForTable"></a>
### `getMetricsForTable()`

Returns the Metrics that are displayed by a DataTable of a certain Report type.

Includes ProcessedMetrics and Metrics.

#### Signature

-  It accepts the following parameter(s):
    - `$dataTable` ([`DataTable`](../../Piwik/DataTable.md)) &mdash;
      
    - `$report` ([`Report`](../../Piwik/Plugin/Report.md)) &mdash;
      
    - `$baseType` (`string`) &mdash;
       The base type each metric class needs to be of.
- It returns a [`Metric[]`](../../Piwik/Plugin/Metric.md) value.

<a name="getprocessedmetricsfortable" id="getprocessedmetricsfortable"></a>
<a name="getProcessedMetricsForTable" id="getProcessedMetricsForTable"></a>
### `getProcessedMetricsForTable()`

Returns the ProcessedMetrics that should be computed and formatted for a DataTable of a
certain report. The ProcessedMetrics returned are those specified by the Report metadata
as well as the DataTable metadata.

#### Signature

-  It accepts the following parameter(s):
    - `$dataTable` ([`DataTable`](../../Piwik/DataTable.md)) &mdash;
      
    - `$report` ([`Report`](../../Piwik/Plugin/Report.md)) &mdash;
      
- It returns a [`ProcessedMetric[]`](../../Piwik/Plugin/ProcessedMetric.md) value.

