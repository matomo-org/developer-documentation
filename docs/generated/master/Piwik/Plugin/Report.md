<small>Piwik\Plugin\</small>

Report
======

Properties
----------

This class defines the following properties:

- [`$name`](#$name) &mdash; The translated name of the report.
- [`$category`](#$category) &mdash; The translation key of the category the report belongs to.
- [`$widgetTitle`](#$widgettitle) &mdash; The translation key of the widget title.
- [`$widgetParams`](#$widgetparams) &mdash; Optional widget params that will be appended to the widget URL if a [$widgetTitle](/api-reference/Piwik/Plugin/Report#$widgettitle) is set.
- [`$menuTitle`](#$menutitle) &mdash; The translation key of the menu title.
- [`$processedMetrics`](#$processedmetrics) &mdash; The processed metrics this report supports, eg "average time on site" or "actions per visit".
- [`$hasGoalMetrics`](#$hasgoalmetrics) &mdash; Set this property to true in case your report supports goal metrics.
- [`$metrics`](#$metrics) &mdash; An array of supported metrics.
- [`$constantRowsCount`](#$constantrowscount) &mdash; Set it to boolean `true` if your report always returns a constant count of rows, for instance always 24 rows for 1-24 hours.
- [`$isSubtableReport`](#$issubtablereport) &mdash; Set it to boolean `true` if this report is a subtable report and won't be used as a standalone report.
- [`$parameters`](#$parameters) &mdash; Some reports may require additonal URL parameters that need to be sent when a report is requested.
- [`$actionToLoadSubTables`](#$actiontoloadsubtables) &mdash; The name of the API action to load a subtable if supported.
- [`$order`](#$order) &mdash; The order of the report.

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
a widget for this report. Alternatively, this behavior can be overwritten in configureWidget().

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
to the reporting menu. Alternatively, this behavior can be overwritten in configureReportingMenu().

#### Signature

- It is a `string` value.

<a name="$processedmetrics" id="$processedmetrics"></a>
<a name="processedMetrics" id="processedMetrics"></a>
### `$processedMetrics`

The processed metrics this report supports, eg "average time on site" or "actions per visit".

Defaults to the
platform default processed metrics, see Metrics::getDefaultProcessedMetrics(). Set it to boolean `false`
if your report does not support any processed metrics at all. Otherwise an array of metric names and their
translations. Eg `array('avg_time_on_site' => "Average sime on site")`

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

<a name="$metrics" id="$metrics"></a>
<a name="metrics" id="metrics"></a>
### `$metrics`

An array of supported metrics.

Eg `array('nb_visits', 'nb_actions', ...)`. Defaults to the platform default
metrics see Metrics::getDefaultProcessedMetrics().

#### Signature

- It is a `array` value.

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

Methods
-------

The class defines the following methods:

- [`init()`](#init) &mdash; Here you can do any instance initialization and overwrite any default values.
- [`getMetricsDocumentation()`](#getmetricsdocumentation) &mdash; Returns an array of metric documentations and their corresponding translations.

<a name="init" id="init"></a>
<a name="init" id="init"></a>
### `init()`

Here you can do any instance initialization and overwrite any default values.

You should avoid doing time
consuming initialization here and if possible delay as long as possible. An instance of this report will be
created in most page requests.

#### Signature

- It does not return anything.

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

