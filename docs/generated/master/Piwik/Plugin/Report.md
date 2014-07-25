<small>Piwik\Plugin\</small>

Report
======

Since Piwik 2.5.0

Defines a new report.

This class contains all information a report defines except the corresponding API method which
needs to be defined in the 'API.php'. You can define the name of the report, a documentation, the supported metrics,
how the report should be displayed, which features the report has (eg search) and much more.

You can create a new report using the console command `./console generate:report`. The generated report will guide
you through the creation of a report.

Properties
----------

This class defines the following properties:

- [`$name`](#$name) &mdash; The translated name of the report.
- [`$category`](#$category) &mdash; The translation key of the category the report belongs to.
- [`$widgetTitle`](#$widgettitle) &mdash; The translation key of the widget title.
- [`$widgetParams`](#$widgetparams) &mdash; Optional widget params that will be appended to the widget URL if a [$widgetTitle](/api-reference/Piwik/Plugin/Report#$widgettitle) is set.
- [`$menuTitle`](#$menutitle) &mdash; The translation key of the menu title.
- [`$metrics`](#$metrics) &mdash; An array of supported metrics.
- [`$processedMetrics`](#$processedmetrics) &mdash; The processed metrics this report supports, eg `avg_time_on_site` or `nb_actions_per_visit`.
- [`$hasGoalMetrics`](#$hasgoalmetrics) &mdash; Set this property to true in case your report supports goal metrics.
- [`$constantRowsCount`](#$constantrowscount) &mdash; Set it to boolean `true` if your report always returns a constant count of rows, for instance always 24 rows for 1-24 hours.
- [`$isSubtableReport`](#$issubtablereport) &mdash; Set it to boolean `true` if this report is a subtable report and won't be used as a standalone report.
- [`$parameters`](#$parameters) &mdash; Some reports may require additonal URL parameters that need to be sent when a report is requested.
- [`$actionToLoadSubTables`](#$actiontoloadsubtables) &mdash; The name of the API action to load a subtable if supported.
- [`$order`](#$order) &mdash; The order of the report.
- [`$orderOfReports`](#$orderofreports)

<a name="$name" id="$name"></a>
<a name="name" id="name"></a>
### `$name`

The translated name of the report.

The name will be used for instance in the mobile app or if another report
defines this report as a related report.

#### Signature

- It is a `string` value.

<a name="$category" id="$category"></a>
<a name="category" id="category"></a>
### `$category`

The translation key of the category the report belongs to.

#### Signature

- It is a `string` value.

<a name="$widgettitle" id="$widgettitle"></a>
<a name="widgetTitle" id="widgetTitle"></a>
### `$widgetTitle`

The translation key of the widget title.

If a widget title is set, the platform will automatically configure/add
a widget for this report. Alternatively, this behavior can be overwritten in [configureWidget()](/api-reference/Piwik/Plugin/Report#configurewidget).

#### Signature

- It is a `string` value.

<a name="$widgetparams" id="$widgetparams"></a>
<a name="widgetParams" id="widgetParams"></a>
### `$widgetParams`

Optional widget params that will be appended to the widget URL if a [$widgetTitle](/api-reference/Piwik/Plugin/Report#$widgettitle) is set.

#### Signature

- It is a `array` value.

<a name="$menutitle" id="$menutitle"></a>
<a name="menuTitle" id="menuTitle"></a>
### `$menuTitle`

The translation key of the menu title.

If a menu title is set, the platform will automatically add a menu item
to the reporting menu. Alternatively, this behavior can be overwritten in [configureReportingMenu()](/api-reference/Piwik/Plugin/Report#configurereportingmenu).

#### Signature

- It is a `string` value.

<a name="$metrics" id="$metrics"></a>
<a name="metrics" id="metrics"></a>
### `$metrics`

An array of supported metrics.

Eg `array('nb_visits', 'nb_actions', ...)`. Defaults to the platform default
metrics see Metrics::getDefaultProcessedMetrics().

#### Signature

- It is a `array` value.

<a name="$processedmetrics" id="$processedmetrics"></a>
<a name="processedMetrics" id="processedMetrics"></a>
### `$processedMetrics`

The processed metrics this report supports, eg `avg_time_on_site` or `nb_actions_per_visit`.

Defaults to the
platform default processed metrics, see Metrics::getDefaultProcessedMetrics(). Set it to boolean `false`
if your report does not support any processed metrics at all. Otherwise an array of metric names.
Eg `array('avg_time_on_site', 'nb_actions_per_visit', ...)`

#### Signature

- It can be one of the following types:
    - `array`
    - `Piwik\Plugin\false`

<a name="$hasgoalmetrics" id="$hasgoalmetrics"></a>
<a name="hasGoalMetrics" id="hasGoalMetrics"></a>
### `$hasGoalMetrics`

Set this property to true in case your report supports goal metrics.

In this case, the goal metrics will be
automatically added to the report metadata and the report will be displayed in the Goals UI.

#### Signature

- It is a `bool` value.

<a name="$constantrowscount" id="$constantrowscount"></a>
<a name="constantRowsCount" id="constantRowsCount"></a>
### `$constantRowsCount`

Set it to boolean `true` if your report always returns a constant count of rows, for instance always 24 rows for 1-24 hours.

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

Some reports may require additonal URL parameters that need to be sent when a report is requested.

For instance
a "goal" report might need a "goalId": `array('idgoal' => 5)`.

#### Signature

- It can be one of the following types:
    - `null`
    - `array`

<a name="$actiontoloadsubtables" id="$actiontoloadsubtables"></a>
<a name="actionToLoadSubTables" id="actionToLoadSubTables"></a>
### `$actionToLoadSubTables`

The name of the API action to load a subtable if supported.

The action has to be of the same module. For instance
a report "getKeywords" might support a subtable "getSearchEngines" which shows how often a keyword was searched
via a specific search engine.

#### Signature

- It is a `string` value.

<a name="$order" id="$order"></a>
<a name="order" id="order"></a>
### `$order`

The order of the report.

Depending on the order the report gets a different position in the list of widgets,
the menu and the mobile app.

#### Signature

- It is a `int` value.

<a name="$orderofreports" id="$orderofreports"></a>
<a name="orderOfReports" id="orderOfReports"></a>
### `$orderOfReports`

#### Signature

- It is a `array` value.

Methods
-------

The class defines the following methods:

- [`init()`](#init) &mdash; Here you can do any instance initialization and overwrite any default values.
- [`isEnabled()`](#isenabled) &mdash; Defines whether a report is enabled or not.
- [`checkIsEnabled()`](#checkisenabled) &mdash; This method checks whether the report is available, see {@isEnabled()}.
- [`getDefaultTypeViewDataTable()`](#getdefaulttypeviewdatatable) &mdash; Returns the id of the default visualization for this report.
- [`configureView()`](#configureview) &mdash; Here you can configure how your report should be displayed and which capabilities your report has.
- [`render()`](#render) &mdash; Renders a report depending on the configured ViewDataTable see [configureView()](/api-reference/Piwik/Plugin/Report#configureview) and [getDefaultTypeViewDataTable()](/api-reference/Piwik/Plugin/Report#getdefaulttypeviewdatatable).
- [`configureWidget()`](#configurewidget) &mdash; By default a widget will be configured for this report if a [$widgetTitle](/api-reference/Piwik/Plugin/Report#$widgettitle) is set.
- [`configureReportingMenu()`](#configurereportingmenu) &mdash; By default a menu item will be added to the reporting menu if a [$menuTitle](/api-reference/Piwik/Plugin/Report#$menutitle) is set.
- [`getMetrics()`](#getmetrics) &mdash; Returns an array of supported metrics and their corresponding translations.
- [`getProcessedMetrics()`](#getprocessedmetrics) &mdash; Returns an array of supported processed metrics and their corresponding translations.
- [`getMetricsDocumentation()`](#getmetricsdocumentation) &mdash; Returns an array of metric documentations and their corresponding translations.
- [`configureReportMetadata()`](#configurereportmetadata) &mdash; If the report is enabled the report metadata for this report will be built and added to the list of available reports.
- [`getRelatedReports()`](#getrelatedreports) &mdash; Get the list of related reports if there are any.
- [`factory()`](#factory) &mdash; Get an instance of a specific report belonging to the given module and having the given action.
- [`getAllReports()`](#getallreports) &mdash; Returns a list of all available reports.

<a name="init" id="init"></a>
<a name="init" id="init"></a>
### `init()`

Here you can do any instance initialization and overwrite any default values.

You should avoid doing time
consuming initialization here and if possible delay as long as possible. An instance of this report will be
created in most page requests.

#### Signature

- It does not return anything.

<a name="isenabled" id="isenabled"></a>
<a name="isEnabled" id="isEnabled"></a>
### `isEnabled()`

Defines whether a report is enabled or not.

For instance some reports might not be available to every user or
might depend on a setting (such as Ecommerce) of a site. In such a case you can perform any checks and then
return `true` or `false`. If your report is only available to users having super user access you can do the
following: `return Piwik::hasUserSuperUserAccess();`

#### Signature

- It returns a `bool` value.

<a name="checkisenabled" id="checkisenabled"></a>
<a name="checkIsEnabled" id="checkIsEnabled"></a>
### `checkIsEnabled()`

This method checks whether the report is available, see {@isEnabled()}.

If not, it triggers an exception
containing a message that will be displayed to the user. You can overwrite this message in case you want to
customize the error message. Eg.
```
    if (!$this->isEnabled()) {
        throw new Exception('Setting XYZ is not enabled or the user has not enough permission');
    }
```

#### Signature

- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

<a name="getdefaulttypeviewdatatable" id="getdefaulttypeviewdatatable"></a>
<a name="getDefaultTypeViewDataTable" id="getDefaultTypeViewDataTable"></a>
### `getDefaultTypeViewDataTable()`

Returns the id of the default visualization for this report.

Eg 'table' or 'pie'. Defaults to the HTML table.

#### Signature

- It returns a `string` value.

<a name="configureview" id="configureview"></a>
<a name="configureView" id="configureView"></a>
### `configureView()`

Here you can configure how your report should be displayed and which capabilities your report has.

For instance
whether your report supports a "search" or not. EG `$view->config->show_search = false`. You can also change the
default request config. For instance you can change how many rows are displayed by default:
`$view->requestConfig->filter_limit = 10;`. See [ViewDataTable](/api-reference/Piwik/Plugin/ViewDataTable) for more information.

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
- It does not return anything.

<a name="render" id="render"></a>
<a name="render" id="render"></a>
### `render()`

Renders a report depending on the configured ViewDataTable see [configureView()](/api-reference/Piwik/Plugin/Report#configureview) and [getDefaultTypeViewDataTable()](/api-reference/Piwik/Plugin/Report#getdefaulttypeviewdatatable).

If you want to customize the render process or just render any custom view
you can overwrite this method.

#### Signature

- It returns a `string` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; In case the given API action does not exist yet.

<a name="configurewidget" id="configurewidget"></a>
<a name="configureWidget" id="configureWidget"></a>
### `configureWidget()`

By default a widget will be configured for this report if a [$widgetTitle](/api-reference/Piwik/Plugin/Report#$widgettitle) is set.

If you want to customize
the way the widget is added or modify any other behavior you can overwrite this method.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$widget` (`Piwik\WidgetsList`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="configurereportingmenu" id="configurereportingmenu"></a>
<a name="configureReportingMenu" id="configureReportingMenu"></a>
### `configureReportingMenu()`

By default a menu item will be added to the reporting menu if a [$menuTitle](/api-reference/Piwik/Plugin/Report#$menutitle) is set.

If you want to
customize the way the item is added or modify any other behavior you can overwrite this method. For instance
in case you need to add additional url properties beside module and action which are added by default.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$menu` ([`MenuReporting`](../../Piwik/Menu/MenuReporting.md)) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="getmetrics" id="getmetrics"></a>
<a name="getMetrics" id="getMetrics"></a>
### `getMetrics()`

Returns an array of supported metrics and their corresponding translations.

Eg `array('nb_visits' => 'Visits')`.
By default the given [$metrics](/api-reference/Piwik/Plugin/Report#$metrics) are used and their corresponding translations are looked up automatically.
If a metric is not translated, you should add the default metric translation for this metric using
the [Metrics.getDefaultMetricTranslations](/api-reference/events#metricsgetdefaultmetrictranslations) event. If you want to overwrite any default metric translation
you should overwrite this method, call this parent method to get all default translations and overwrite any
custom metric translations.

#### Signature

- It returns a `array` value.

<a name="getprocessedmetrics" id="getprocessedmetrics"></a>
<a name="getProcessedMetrics" id="getProcessedMetrics"></a>
### `getProcessedMetrics()`

Returns an array of supported processed metrics and their corresponding translations.

Eg
`array('nb_visits' => 'Visits')`. By default the given [$processedMetrics](/api-reference/Piwik/Plugin/Report#$processedmetrics) are used and their
corresponding translations are looked up automatically. If a metric is not translated, you should add the
default metric translation for this metric using the [Metrics.getDefaultMetricTranslations](/api-reference/events#metricsgetdefaultmetrictranslations) event. If you
want to overwrite any default metric translation you should overwrite this method, call this parent method to
get all default translations and overwrite any custom metric translations.

#### Signature

- It returns a `array` value.

<a name="getmetricsdocumentation" id="getmetricsdocumentation"></a>
<a name="getMetricsDocumentation" id="getMetricsDocumentation"></a>
### `getMetricsDocumentation()`

Returns an array of metric documentations and their corresponding translations.

Eg
`array('nb_visits' => 'If a visitor comes to your website for the first time or if he visits a page more than 30 minutes after...')`.
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

If the report is enabled the report metadata for this report will be built and added to the list of available reports.

Overwrite this method and leave it empty in case you do not want your report to be added to the report
metadata. In this case your report won't be visible for instance in the mobile app and scheduled reports
generator. We recommend to change this behavior only if you are familiar with the Piwik core. `$infos` contains
the current requested date, period and site.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$availableReports` (`Piwik\Plugin\$availableReports`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$infos` (`Piwik\Plugin\$infos`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="getrelatedreports" id="getrelatedreports"></a>
<a name="getRelatedReports" id="getRelatedReports"></a>
### `getRelatedReports()`

Get the list of related reports if there are any.

They will be displayed for instance below a report as a
recommended related report.

#### Signature

- It returns a [`Report[]`](../../Piwik/Plugin/Report.md) value.

<a name="factory" id="factory"></a>
<a name="factory" id="factory"></a>
### `factory()`

Get an instance of a specific report belonging to the given module and having the given action.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$module` (`string`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$action` (`string`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`null`|[`Report`](../../Piwik/Plugin/Report.md)) &mdash;
    <div markdown="1" class="param-desc"></div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="getallreports" id="getallreports"></a>
<a name="getAllReports" id="getAllReports"></a>
### `getAllReports()`

Returns a list of all available reports.

Even not enabled reports will be returned. They will be already sorted
depending on the order and category of the report.

#### Signature

- It returns a [`Report[]`](../../Piwik/Plugin/Report.md) value.

