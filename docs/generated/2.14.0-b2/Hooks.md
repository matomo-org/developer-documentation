Events
==========

This is a complete list of available hooks. If you are not familiar with this read our [Guide about events](/guides/events).

## Actions

- [Actions.Archiving.addActionMetrics](#actionsarchivingaddactionmetrics)

### Actions.Archiving.addActionMetrics

*Defined in [Piwik/Plugins/Actions/Metrics](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Actions/Metrics.php) in line [81](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Actions/Metrics.php#L81)*



Callback Signature:
<pre><code>function(&amp;$metricsConfig)</code></pre>

## API

- [API.$pluginName.$methodName](#apipluginnamemethodname)
- [API.$pluginName.$methodName.end](#apipluginnamemethodnameend)
- [API.DocumentationGenerator.$token](#apidocumentationgeneratortoken)
- [API.getReportMetadata.end](#apigetreportmetadataend)
- [API.getSegmentDimensionMetadata](#apigetsegmentdimensionmetadata)
- [API.Request.authenticate](#apirequestauthenticate)
- [API.Request.dispatch](#apirequestdispatch)
- [API.Request.dispatch.end](#apirequestdispatchend)

### API.$pluginName.$methodName

*Defined in [Piwik/API/Proxy](https://github.com/piwik/piwik/blob/2.14.0-b2/core/API/Proxy.php) in line [208](https://github.com/piwik/piwik/blob/2.14.0-b2/core/API/Proxy.php#L208)*

Triggered before an API request is dispatched. This event exists for convenience and is triggered directly after the [API.Request.dispatch](/api-reference/events#apirequestdispatch)
event is triggered. It can be used to modify the arguments passed to a **single** API method.

_Note: This is can be accomplished with the [API.Request.dispatch](/api-reference/events#apirequestdispatch) event as well, however
event handlers for that event will have to do more work._

**Example**

    Piwik::addAction('API.Actions.getPageUrls', function (&$parameters) {
        // force use of a single website. for some reason.
        $parameters['idSite'] = 1;
    });

Callback Signature:
<pre><code>function(&amp;$finalParameters)</code></pre>

- array `&$finalParameters` List of parameters that will be passed to the API method.


### API.$pluginName.$methodName.end

*Defined in [Piwik/API/Proxy](https://github.com/piwik/piwik/blob/2.14.0-b2/core/API/Proxy.php) in line [258](https://github.com/piwik/piwik/blob/2.14.0-b2/core/API/Proxy.php#L258)*

Triggered directly after an API request is dispatched. This event exists for convenience and is triggered immediately before the
[API.Request.dispatch.end](/api-reference/events#apirequestdispatchend) event. It can be used to modify the output of a **single**
API method.

_Note: This can be accomplished with the [API.Request.dispatch.end](/api-reference/events#apirequestdispatchend) event as well,
however event handlers for that event will have to do more work._

**Example**

    // append (0 hits) to the end of row labels whose row has 0 hits
    Piwik::addAction('API.Actions.getPageUrls', function (&$returnValue, $info)) {
        $returnValue->filter('ColumnCallbackReplace', 'label', function ($label, $hits) {
            if ($hits === 0) {
                return $label . " (0 hits)";
            } else {
                return $label;
            }
        }, null, array('nb_hits'));
    }

Callback Signature:
<pre><code>$endHookParams</code></pre>

- mixed `$returnedValue` The API method's return value. Can be an object, such as a [DataTable](/api-reference/Piwik/DataTable) instance. could be a [DataTable](/api-reference/Piwik/DataTable).

- array `$extraInfo` An array holding information regarding the API request. Will contain the following data: - **className**: The namespace-d class name of the API instance that's being called. - **module**: The name of the plugin the API request was dispatched to. - **action**: The name of the API method that was executed. - **parameters**: The array of parameters passed to the API method.


### API.DocumentationGenerator.$token

*Defined in [Piwik/API/Proxy](https://github.com/piwik/piwik/blob/2.14.0-b2/core/API/Proxy.php) in line [503](https://github.com/piwik/piwik/blob/2.14.0-b2/core/API/Proxy.php#L503)*

This event exists for checking whether a Plugin API class or a Plugin API method tagged with a `@hideXYZ` should be hidden in the API listing.

Callback Signature:
<pre><code>function(&amp;$hide)</code></pre>

- bool `&$hide` whether to hide APIs tagged with $token should be displayed.


### API.getReportMetadata.end

*Defined in [Piwik/Plugins/API/ProcessedReport](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/API/ProcessedReport.php) in line [263](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/API/ProcessedReport.php#L263)*

Triggered after all available reports are collected. This event can be used to modify the report metadata of reports in other plugins. You
could, for example, add custom metrics to every report or remove reports from the list
of available reports.

Callback Signature:
<pre><code>function(&amp;$availableReports, $parameters)</code></pre>

- array `&$availableReports` List of all report metadata. Read the [API.getReportMetadata](/api-reference/events#apigetreportmetadata) docs to see what this array contains.

- array `$parameters` Contains the values of the sites and period we are getting reports for. Some report depend on this data. For example, Goals reports depend on the site IDs being request. Contains the following information: - **idSites**: The array of site IDs we are getting reports for. - **period**: The period type, eg, `'day'`, `'week'`, `'month'`, `'year'`, `'range'`. - **date**: A string date within the period or a date range, eg, `'2013-01-01'` or `'2012-01-01,2013-01-01'`.

Usages:

[Goals::getReportMetadataEnd](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Goals/Goals.php#L139)


### API.getSegmentDimensionMetadata

*Defined in [Piwik/Plugins/API/API](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/API/API.php) in line [153](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/API/API.php#L153)*

Triggered when gathering all available segment dimensions. This event can be used to make new segment dimensions available.

**Example**

    public function getSegmentsMetadata(&$segments, $idSites)
    {
        $segments[] = array(
            'type'           => 'dimension',
            'category'       => Piwik::translate('General_Visit'),
            'name'           => 'General_VisitorIP',
            'segment'        => 'visitIp',
            'acceptedValues' => '13.54.122.1, etc.',
            'sqlSegment'     => 'log_visit.location_ip',
            'sqlFilter'      => array('Piwik\IP', 'P2N'),
            'permission'     => $isAuthenticatedWithViewAccess,
        );
    }

Callback Signature:
<pre><code>function(&amp;$segments, $idSites)</code></pre>

- array `$dimensions` The list of available segment dimensions. Append to this list to add new segments. Each element in this list must contain the following information: - **type**: Either `'metric'` or `'dimension'`. `'metric'` means the value is a numeric and `'dimension'` means it is a string. Also, `'metric'` values will be displayed under **Visit (metrics)** in the Segment Editor. - **category**: The segment category name. This can be an existing segment category visible in the segment editor. - **name**: The pretty name of the segment. Can be a translation token. - **segment**: The segment name, eg, `'visitIp'` or `'searches'`. - **acceptedValues**: A string describing one or two exacmple values, eg `'13.54.122.1, etc.'`. - **sqlSegment**: The table column this segment will segment by. For example, `'log_visit.location_ip'` for the **visitIp** segment. - **sqlFilter**: A PHP callback to apply to segment values before they are used in SQL. - **permission**: True if the current user has view access to this segment, false if otherwise.

- array `$idSites` The list of site IDs we're getting the available segments for. Some segments (such as Goal segments) depend on the site.

Usages:

[CustomVariables::getSegmentsMetadata](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/CustomVariables/CustomVariables.php#L91)


### API.Request.authenticate

*Defined in [Piwik/API/Request](https://github.com/piwik/piwik/blob/2.14.0-b2/core/API/Request.php) in line [319](https://github.com/piwik/piwik/blob/2.14.0-b2/core/API/Request.php#L319)*

Triggered when authenticating an API request, but only if the **token_auth** query parameter is found in the request. Plugins that provide authentication capabilities should subscribe to this event
and make sure the global authentication object (the object returned by `StaticContainer::get('Piwik\Auth')`)
is setup to use `$token_auth` when its `authenticate()` method is executed.

Callback Signature:
<pre><code>function($tokenAuth)</code></pre>

- string `$token_auth` The value of the **token_auth** query parameter.

Usages:

[Login::ApiRequestAuthenticate](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Login/Login.php#L65)


### API.Request.dispatch

*Defined in [Piwik/API/Proxy](https://github.com/piwik/piwik/blob/2.14.0-b2/core/API/Proxy.php) in line [188](https://github.com/piwik/piwik/blob/2.14.0-b2/core/API/Proxy.php#L188)*

Triggered before an API request is dispatched. This event can be used to modify the arguments passed to one or more API methods.

**Example**

    Piwik::addAction('API.Request.dispatch', function (&$parameters, $pluginName, $methodName) {
        if ($pluginName == 'Actions') {
            if ($methodName == 'getPageUrls') {
                // ... do something ...
            } else {
                // ... do something else ...
            }
        }
    });

Callback Signature:
<pre><code>function(&amp;$finalParameters, $pluginName, $methodName)</code></pre>

- array `&$finalParameters` List of parameters that will be passed to the API method.

- string `$pluginName` The name of the plugin the API method belongs to.

- string `$methodName` The name of the API method that will be called.

Usages:

[CustomAlerts::checkApiPermission](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/CustomAlerts/CustomAlerts.php#L38)


### API.Request.dispatch.end

*Defined in [Piwik/API/Proxy](https://github.com/piwik/piwik/blob/2.14.0-b2/core/API/Proxy.php) in line [298](https://github.com/piwik/piwik/blob/2.14.0-b2/core/API/Proxy.php#L298)*

Triggered directly after an API request is dispatched. This event can be used to modify the output of any API method.

**Example**

    // append (0 hits) to the end of row labels whose row has 0 hits for any report that has the 'nb_hits' metric
    Piwik::addAction('API.Actions.getPageUrls', function (&$returnValue, $info)) {
        // don't process non-DataTable reports and reports that don't have the nb_hits column
        if (!($returnValue instanceof DataTableInterface)
            || in_array('nb_hits', $returnValue->getColumns())
        ) {
            return;
        }

        $returnValue->filter('ColumnCallbackReplace', 'label', function ($label, $hits) {
            if ($hits === 0) {
                return $label . " (0 hits)";
            } else {
                return $label;
            }
        }, null, array('nb_hits'));
    }

Callback Signature:
<pre><code>$endHookParams</code></pre>

- mixed `$returnedValue` The API method's return value. Can be an object, such as a [DataTable](/api-reference/Piwik/DataTable) instance.

- array `$extraInfo` An array holding information regarding the API request. Will contain the following data: - **className**: The namespace-d class name of the API instance that's being called. - **module**: The name of the plugin the API request was dispatched to. - **action**: The name of the API method that was executed. - **parameters**: The array of parameters passed to the API method.

## ArchiveProcessor

- [ArchiveProcessor.Parameters.getIdSites](#archiveprocessorparametersgetidsites)

### ArchiveProcessor.Parameters.getIdSites

*Defined in [Piwik/ArchiveProcessor/Parameters](https://github.com/piwik/piwik/blob/2.14.0-b2/core/ArchiveProcessor/Parameters.php) in line [109](https://github.com/piwik/piwik/blob/2.14.0-b2/core/ArchiveProcessor/Parameters.php#L109)*



Callback Signature:
<pre><code>function(&amp;$idSites, $this-&gt;getPeriod())</code></pre>

## AssetManager

- [AssetManager.filterMergedJavaScripts](#assetmanagerfiltermergedjavascripts)
- [AssetManager.filterMergedJavaScripts](#assetmanagerfiltermergedjavascripts)
- [AssetManager.filterMergedJavaScripts](#assetmanagerfiltermergedjavascripts)
- [AssetManager.filterMergedStylesheets](#assetmanagerfiltermergedstylesheets)
- [AssetManager.getJavaScriptFiles](#assetmanagergetjavascriptfiles)
- [AssetManager.getStylesheetFiles](#assetmanagergetstylesheetfiles)

### AssetManager.filterMergedJavaScripts

*Defined in [Piwik/Plugins/CoreHome/tests/Integration/CoreHomeTest](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/CoreHome/tests/Integration/CoreHomeTest.php) in line [26](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/CoreHome/tests/Integration/CoreHomeTest.php#L26)*



Callback Signature:
<pre><code>function(&amp;$content)</code></pre>

Usages:

[CoreHome::filterMergedJavaScripts](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/CoreHome/CoreHome.php#L30)


### AssetManager.filterMergedJavaScripts

*Defined in [Piwik/Plugins/CoreHome/tests/Integration/CoreHomeTest](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/CoreHome/tests/Integration/CoreHomeTest.php) in line [34](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/CoreHome/tests/Integration/CoreHomeTest.php#L34)*



Callback Signature:
<pre><code>function(&amp;$content)</code></pre>

Usages:

[CoreHome::filterMergedJavaScripts](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/CoreHome/CoreHome.php#L30)


### AssetManager.filterMergedJavaScripts

*Defined in [Piwik/AssetManager/UIAssetMerger/JScriptUIAssetMerger](https://github.com/piwik/piwik/blob/2.14.0-b2/core/AssetManager/UIAssetMerger/JScriptUIAssetMerger.php) in line [71](https://github.com/piwik/piwik/blob/2.14.0-b2/core/AssetManager/UIAssetMerger/JScriptUIAssetMerger.php#L71)*

Triggered after all the JavaScript files Piwik uses are minified and merged into a single file, but before the merged JavaScript is written to disk. Plugins can use this event to modify merged JavaScript or do something else
with it.

Callback Signature:
<pre><code>function(&amp;$mergedContent)</code></pre>

- string `&$mergedContent` The minified and merged JavaScript.

Usages:

[CoreHome::filterMergedJavaScripts](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/CoreHome/CoreHome.php#L30)


### AssetManager.filterMergedStylesheets

*Defined in [Piwik/AssetManager/UIAssetMerger/StylesheetUIAssetMerger](https://github.com/piwik/piwik/blob/2.14.0-b2/core/AssetManager/UIAssetMerger/StylesheetUIAssetMerger.php) in line [74](https://github.com/piwik/piwik/blob/2.14.0-b2/core/AssetManager/UIAssetMerger/StylesheetUIAssetMerger.php#L74)*

Triggered after all less stylesheets are compiled to CSS, minified and merged into one file, but before the generated CSS is written to disk. This event can be used to modify merged CSS.

Callback Signature:
<pre><code>function(&amp;$mergedContent)</code></pre>

- string `&$mergedContent` The merged and minified CSS.


### AssetManager.getJavaScriptFiles

*Defined in [Piwik/AssetManager/UIAssetFetcher/JScriptUIAssetFetcher](https://github.com/piwik/piwik/blob/2.14.0-b2/core/AssetManager/UIAssetFetcher/JScriptUIAssetFetcher.php) in line [45](https://github.com/piwik/piwik/blob/2.14.0-b2/core/AssetManager/UIAssetFetcher/JScriptUIAssetFetcher.php#L45)*

Triggered when gathering the list of all JavaScript files needed by Piwik and its plugins. Plugins that have their own JavaScript should use this event to make those
files load in the browser.

JavaScript files should be placed within a **javascripts** subdirectory in your
plugin's root directory.

_Note: While you are developing your plugin you should enable the config setting
`[Development] disable_merged_assets` so JavaScript files will be reloaded immediately
after every change._

**Example**

    public function getJsFiles(&$jsFiles)
    {
        $jsFiles[] = "plugins/MyPlugin/javascripts/myfile.js";
        $jsFiles[] = "plugins/MyPlugin/javascripts/anotherone.js";
    }

Callback Signature:
<pre><code>function(&amp;$this-&gt;fileLocations)</code></pre>

- string `$jsFiles` The JavaScript files to load.

Usages:

[Actions::getJsFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Actions/Actions.php#L105), [Annotations::getJsFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Annotations/Annotations.php#L46), [Contents::getJsFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Contents/Contents.php#L32), [CoreAdminHome::getJsFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/CoreAdminHome/CoreAdminHome.php#L47), [CoreHome::getJsFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/CoreHome/CoreHome.php#L80), [CorePluginsAdmin::getJsFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/CorePluginsAdmin/CorePluginsAdmin.php#L45), [CoreVisualizations::getJsFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/CoreVisualizations/CoreVisualizations.php#L65), [CustomAlerts::getJavaScriptFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/CustomAlerts/CustomAlerts.php#L73), [Dashboard::getJsFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Dashboard/Dashboard.php#L204), [Feedback::getJsFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Feedback/Feedback.php#L35), [Goals::getJsFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Goals/Goals.php#L245), [Insights::getJsFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Insights/Insights.php#L31), [LanguagesManager::getJsFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/LanguagesManager/LanguagesManager.php#L51), [Live::getJsFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Live/Live.php#L39), [Login::getJsFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Login/Login.php#L39), [MobileMessaging::getJsFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/MobileMessaging/MobileMessaging.php#L87), [MultiSites::getJsFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/MultiSites/MultiSites.php#L67), [Overlay::getJsFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Overlay/Overlay.php#L29), [PrivacyManager::getJsFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/PrivacyManager/PrivacyManager.php#L153), [ScheduledReports::getJsFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/ScheduledReports/ScheduledReports.php#L127), [SegmentEditor::getJsFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/SegmentEditor/SegmentEditor.php#L69), [SitesManager::getJsFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/SitesManager/SitesManager.php#L86), [Transitions::getJsFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Transitions/Transitions.php#L33), [TreemapVisualization::getJsFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/TreemapVisualization/TreemapVisualization.php#L48), [UserCountry::getJsFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/UserCountry/UserCountry.php#L77), [UserCountryMap::getJsFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/UserCountryMap/UserCountryMap.php#L54), [UsersManager::getJsFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/UsersManager/UsersManager.php#L93), [Widgetize::getJsFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Widgetize/Widgetize.php#L27), [ZenMode::getJsFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/ZenMode/ZenMode.php#L39)


### AssetManager.getStylesheetFiles

*Defined in [Piwik/AssetManager/UIAssetFetcher/StylesheetUIAssetFetcher](https://github.com/piwik/piwik/blob/2.14.0-b2/core/AssetManager/UIAssetFetcher/StylesheetUIAssetFetcher.php) in line [66](https://github.com/piwik/piwik/blob/2.14.0-b2/core/AssetManager/UIAssetFetcher/StylesheetUIAssetFetcher.php#L66)*

Triggered when gathering the list of all stylesheets (CSS and LESS) needed by Piwik and its plugins. Plugins that have stylesheets should use this event to make those stylesheets
load.

Stylesheets should be placed within a **stylesheets** subdirectory in your plugin's
root directory.

**Example**

    public function getStylesheetFiles(&$stylesheets)
    {
        $stylesheets[] = "plugins/MyPlugin/stylesheets/myfile.less";
        $stylesheets[] = "plugins/MyPlugin/stylesheets/myotherfile.css";
    }

Callback Signature:
<pre><code>function(&amp;$this-&gt;fileLocations)</code></pre>

- string `$stylesheets` The list of stylesheet paths.

Usages:

[Plugin::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/API/API.php#L645), [Actions::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Actions/Actions.php#L100), [Annotations::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Annotations/Annotations.php#L38), [Contents::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Contents/Contents.php#L37), [CoreAdminHome::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/CoreAdminHome/CoreAdminHome.php#L38), [CoreHome::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/CoreHome/CoreHome.php#L54), [CorePluginsAdmin::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/CorePluginsAdmin/CorePluginsAdmin.php#L28), [CoreVisualizations::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/CoreVisualizations/CoreVisualizations.php#L59), [CustomAlerts::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/CustomAlerts/CustomAlerts.php#L78), [DBStats::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/DBStats/DBStats.php#L30), [Dashboard::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Dashboard/Dashboard.php#L213), [ExampleRssWidget::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/ExampleRssWidget/ExampleRssWidget.php#L26), [Feedback::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Feedback/Feedback.php#L29), [Goals::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Goals/Goals.php#L250), [Insights::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Insights/Insights.php#L26), [Installation::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Installation/Installation.php#L108), [LanguagesManager::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/LanguagesManager/LanguagesManager.php#L46), [Live::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Live/Live.php#L33), [Login::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Login/Login.php#L44), [MobileMessaging::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/MobileMessaging/MobileMessaging.php#L92), [MultiSites::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/MultiSites/MultiSites.php#L76), [SegmentEditor::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/SegmentEditor/SegmentEditor.php#L74), [SitesManager::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/SitesManager/SitesManager.php#L77), [Transitions::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Transitions/Transitions.php#L28), [TreemapVisualization::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/TreemapVisualization/TreemapVisualization.php#L42), [UserCountry::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/UserCountry/UserCountry.php#L72), [UserCountryMap::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/UserCountryMap/UserCountryMap.php#L65), [UsersManager::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/UsersManager/UsersManager.php#L102), [VisitsSummary::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/VisitsSummary/VisitsSummary.php#L68), [Widgetize::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Widgetize/Widgetize.php#L39), [ZenMode::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/ZenMode/ZenMode.php#L46)

## Config

- [Config.badConfigurationFile](#configbadconfigurationfile)
- [Config.NoConfigurationFile](#confignoconfigurationfile)

### Config.badConfigurationFile

*Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/2.14.0-b2/core/FrontController.php) in line [269](https://github.com/piwik/piwik/blob/2.14.0-b2/core/FrontController.php#L269)*

Triggered when Piwik cannot access database data. This event can be used to start the installation process or to display a custom error
message.

Callback Signature:
<pre><code>function($exception)</code></pre>

- [Exception](http://php.net/class.Exception) `$exception` The exception thrown from trying to get an option value.

Usages:

[Installation::dispatch](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Installation/Installation.php#L86)


### Config.NoConfigurationFile

*Defined in [Piwik/Application/Kernel/EnvironmentValidator](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Application/Kernel/EnvironmentValidator.php) in line [75](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Application/Kernel/EnvironmentValidator.php#L75)*

Triggered when the configuration file cannot be found or read, which usually means Piwik is not installed yet. This event can be used to start the installation process or to display a custom error message.

Callback Signature:
<pre><code>function($exception)</code></pre>

- [\Exception](http://php.net/class.\Exception) `$exception` The exception that was thrown by `Config::getInstance()`.

Usages:

[Installation::dispatch](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Installation/Installation.php#L86), [LanguagesManager::initLanguage](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/LanguagesManager/LanguagesManager.php#L97)

## Console

- [Console.filterCommands](#consolefiltercommands)

### Console.filterCommands

*Defined in [Piwik/Console](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Console.php) in line [126](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Console.php#L126)*

Triggered to filter / restrict console commands. Plugins that want to restrict commands
should subscribe to this event and remove commands from the existing list.

**Example**

    public function filterConsoleCommands(&$commands)
    {
        $key = array_search('Piwik\Plugins\MyPlugin\Commands\MyCommand', $commands);
        if (false !== $key) {
            unset($commands[$key]);
        }
    }

Callback Signature:
<pre><code>function(&amp;$commands)</code></pre>

- array `&$commands` An array containing a list of command class names.

## Controller

- [Controller.$module.$action](#controllermoduleaction)
- [Controller.$module.$action.end](#controllermoduleactionend)

### Controller.$module.$action

*Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/2.14.0-b2/core/FrontController.php) in line [492](https://github.com/piwik/piwik/blob/2.14.0-b2/core/FrontController.php#L492)*

Triggered directly before controller actions are dispatched. This event exists for convenience and is triggered directly after the [Request.dispatch](/api-reference/events#requestdispatch)
event is triggered.

It can be used to do the same things as the [Request.dispatch](/api-reference/events#requestdispatch) event, but for one controller
action only. Using this event will result in a little less code than [Request.dispatch](/api-reference/events#requestdispatch).

Callback Signature:
<pre><code>function(&amp;$parameters)</code></pre>

- array `&$parameters` The arguments passed to the controller action.


### Controller.$module.$action.end

*Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/2.14.0-b2/core/FrontController.php) in line [509](https://github.com/piwik/piwik/blob/2.14.0-b2/core/FrontController.php#L509)*

Triggered after a controller action is successfully called. This event exists for convenience and is triggered immediately before the [Request.dispatch.end](/api-reference/events#requestdispatchend)
event is triggered.

It can be used to do the same things as the [Request.dispatch.end](/api-reference/events#requestdispatchend) event, but for one
controller action only. Using this event will result in a little less code than
[Request.dispatch.end](/api-reference/events#requestdispatchend).

Callback Signature:
<pre><code>function(&amp;$result, $parameters)</code></pre>

- mixed `&$result` The result of the controller action.

- array `$parameters` The arguments passed to the controller action.

## CoreUpdater

- [CoreUpdater.update.end](#coreupdaterupdateend)

### CoreUpdater.update.end

*Defined in [Piwik/Updater](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Updater.php) in line [428](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Updater.php#L428)*

Triggered after Piwik has been updated.

## CronArchive

- [CronArchive.archiveSingleSite.finish](#cronarchivearchivesinglesitefinish)
- [CronArchive.archiveSingleSite.start](#cronarchivearchivesinglesitestart)
- [CronArchive.filterWebsiteIds](#cronarchivefilterwebsiteids)
- [CronArchive.init.finish](#cronarchiveinitfinish)

### CronArchive.archiveSingleSite.finish

*Defined in [Piwik/CronArchive](https://github.com/piwik/piwik/blob/2.14.0-b2/core/CronArchive.php) in line [337](https://github.com/piwik/piwik/blob/2.14.0-b2/core/CronArchive.php#L337)*

This event is triggered immediately after the cron archiving process starts archiving data for a single site.

Callback Signature:
<pre><code>function($idSite, $completed)</code></pre>

- int `$idSite` The ID of the site we're archiving data for.


### CronArchive.archiveSingleSite.start

*Defined in [Piwik/CronArchive](https://github.com/piwik/piwik/blob/2.14.0-b2/core/CronArchive.php) in line [327](https://github.com/piwik/piwik/blob/2.14.0-b2/core/CronArchive.php#L327)*

This event is triggered before the cron archiving process starts archiving data for a single site.

Callback Signature:
<pre><code>function($idSite)</code></pre>

- int `$idSite` The ID of the site we're archiving data for.


### CronArchive.filterWebsiteIds

*Defined in [Piwik/CronArchive](https://github.com/piwik/piwik/blob/2.14.0-b2/core/CronArchive.php) in line [899](https://github.com/piwik/piwik/blob/2.14.0-b2/core/CronArchive.php#L899)*

Triggered by the **core:archive** console command so plugins can modify the list of websites that the archiving process will be launched for. Plugins can use this hook to add websites to archive, remove websites to archive, or change
the order in which websites will be archived.

Callback Signature:
<pre><code>function(&amp;$websiteIds)</code></pre>

- array `&$websiteIds` The list of website IDs to launch the archiving process for.


### CronArchive.init.finish

*Defined in [Piwik/CronArchive](https://github.com/piwik/piwik/blob/2.14.0-b2/core/CronArchive.php) in line [288](https://github.com/piwik/piwik/blob/2.14.0-b2/core/CronArchive.php#L288)*

This event is triggered after a CronArchive instance is initialized.

Callback Signature:
<pre><code>function($this-&gt;websites-&gt;getInitialSiteIds())</code></pre>

- array `$websiteIds` The list of website IDs this CronArchive instance is processing. This will be the entire list of IDs regardless of whether some have already been processed.

## Dashboard

- [Dashboard.changeDefaultDashboardLayout](#dashboardchangedefaultdashboardlayout)

### Dashboard.changeDefaultDashboardLayout

*Defined in [Piwik/Plugins/Dashboard/Dashboard](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Dashboard/Dashboard.php) in line [102](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Dashboard/Dashboard.php#L102)*

Allows other plugins to modify the default dashboard layout.

Callback Signature:
<pre><code>function(&amp;$defaultLayout)</code></pre>

- string `&$defaultLayout` JSON encoded string of the default dashboard layout. Contains an array of columns where each column is an array of widgets. Each widget is an associative array w/ the following elements: * **uniqueId**: The widget's unique ID. * **parameters**: The array of query parameters that should be used to get this widget's report.

## Db

- [Db.cannotConnectToDb](#dbcannotconnecttodb)
- [Db.getDatabaseConfig](#dbgetdatabaseconfig)

### Db.cannotConnectToDb

*Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/2.14.0-b2/core/FrontController.php) in line [246](https://github.com/piwik/piwik/blob/2.14.0-b2/core/FrontController.php#L246)*

Triggered when Piwik cannot connect to the database. This event can be used to start the installation process or to display a custom error
message.

Callback Signature:
<pre><code>function($exception)</code></pre>

- [Exception](http://php.net/class.Exception) `$exception` The exception thrown from creating and testing the database connection.

Usages:

[Installation::displayDbConnectionMessage](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Installation/Installation.php#L41)


### Db.getDatabaseConfig

*Defined in [Piwik/Db](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Db.php) in line [84](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Db.php#L84)*

Triggered before a database connection is established. This event can be used to change the settings used to establish a connection.

Callback Signature:
<pre><code>function(&amp;$dbConfig)</code></pre>

- array

## Environment

- [Environment.bootstrapped](#environmentbootstrapped)

### Environment.bootstrapped

*Defined in [Piwik/Application/Environment](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Application/Environment.php) in line [94](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Application/Environment.php#L94)*



## FrontController

- [FrontController.modifyErrorPage](#frontcontrollermodifyerrorpage)

### FrontController.modifyErrorPage

*Defined in [Piwik/ExceptionHandler](https://github.com/piwik/piwik/blob/2.14.0-b2/core/ExceptionHandler.php) in line [101](https://github.com/piwik/piwik/blob/2.14.0-b2/core/ExceptionHandler.php#L101)*

Triggered before a Piwik error page is displayed to the user. This event can be used to modify the content of the error page that is displayed when
an exception is caught.

Callback Signature:
<pre><code>function(&amp;$result, $ex)</code></pre>

- string `&$result` The HTML of the error page.

- [Exception](http://php.net/class.Exception) `$ex` The Exception displayed in the error page.

## Goals

- [Goals.getReportsWithGoalMetrics](#goalsgetreportswithgoalmetrics)

### Goals.getReportsWithGoalMetrics

*Defined in [Piwik/Plugins/Goals/Goals](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Goals/Goals.php) in line [216](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Goals/Goals.php#L216)*

Triggered when gathering all reports that contain Goal metrics. The list of reports
will be displayed on the left column of the bottom of every _Goals_ page.

If plugins define reports that contain goal metrics (such as **conversions** or **revenue**),
they can use this event to make sure their reports can be viewed on Goals pages.

**Example**

    public function getReportsWithGoalMetrics(&$reports)
    {
        $reports[] = array(
            'category' => Piwik::translate('MyPlugin_myReportCategory'),
            'name' => Piwik::translate('MyPlugin_myReportDimension'),
            'module' => 'MyPlugin',
            'action' => 'getMyReport'
        );
    }

Callback Signature:
<pre><code>function(&amp;$reportsWithGoals)</code></pre>

- array `&$reportsWithGoals` The list of arrays describing reports that have Goal metrics. Each element of this array must be an array with the following properties: - **category**: The report category. This should be a translated string. - **name**: The report's translated name. - **module**: The plugin the report is in, eg, `'UserCountry'`. - **action**: The API method of the report, eg, `'getCountry'`.

Usages:

[Goals::getActualReportsWithGoalMetrics](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Goals/Goals.php#L226)

## Insights

- [Insights.addReportToOverview](#insightsaddreporttooverview)

### Insights.addReportToOverview

*Defined in [Piwik/Plugins/Insights/API](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Insights/API.php) in line [67](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Insights/API.php#L67)*

Triggered to gather all reports to be displayed in the "Insight" and "Movers And Shakers" overview reports. Plugins that want to add new reports to the overview should subscribe to this event and add reports to the
incoming array. API parameters can be configured as an array optionally.

**Example**

    public function addReportToInsightsOverview(&$reports)
    {
        $reports['Actions_getPageUrls']  = array();
        $reports['Actions_getDownloads'] = array('flat' => 1, 'minGrowthPercent' => 60);
    }

Callback Signature:
<pre><code>function(&amp;$reports)</code></pre>

- array `&$reports` An array containing a report unique id as key and an array of API parameters as values.

Usages:

[Actions::addReportToInsightsOverview](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Actions/Actions.php#L93), [Referrers::addReportToInsightsOverview](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Referrers/Referrers.php#L58), [UserCountry::addReportToInsightsOverview](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/UserCountry/UserCountry.php#L62)

## Installation

- [Installation.defaultSettingsForm.init](#installationdefaultsettingsforminit)
- [Installation.defaultSettingsForm.submit](#installationdefaultsettingsformsubmit)

### Installation.defaultSettingsForm.init

*Defined in [Piwik/Plugins/Installation/Controller](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Installation/Controller.php) in line [404](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Installation/Controller.php#L404)*

Triggered on initialization of the form to customize default Piwik settings (at the end of the installation process).

Callback Signature:
<pre><code>function($form)</code></pre>

- \Piwik\Plugins\Installation\FormDefaultSettings `$form` 

Usages:

[PrivacyManager::installationFormInit](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/PrivacyManager/PrivacyManager.php#L163)


### Installation.defaultSettingsForm.submit

*Defined in [Piwik/Plugins/Installation/Controller](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Installation/Controller.php) in line [415](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Installation/Controller.php#L415)*

Triggered on submission of the form to customize default Piwik settings (at the end of the installation process).

Callback Signature:
<pre><code>function($form)</code></pre>

- \Piwik\Plugins\Installation\FormDefaultSettings `$form` 

Usages:

[PrivacyManager::installationFormSubmit](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/PrivacyManager/PrivacyManager.php#L188)

## LanguageManager

- [LanguageManager.getAvailableLanguages](#languagemanagergetavailablelanguages)

### LanguageManager.getAvailableLanguages

*Defined in [Piwik/Plugins/LanguagesManager/API](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/LanguagesManager/API.php) in line [80](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/LanguagesManager/API.php#L80)*

Hook called after loading available language files. Use this hook to customise the list of languagesPath available in Piwik.

Callback Signature:
<pre><code>function(&amp;$languages)</code></pre>

- array

## Live

- [Live.API.getIdSitesString](#liveapigetidsitesstring)
- [Live.getAllVisitorDetails](#livegetallvisitordetails)
- [Live.getExtraVisitorDetails](#livegetextravisitordetails)
- [Live.makeNewVisitorObject](#livemakenewvisitorobject)

### Live.API.getIdSitesString

*Defined in [Piwik/Plugins/Live/Model](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Live/Model.php) in line [300](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Live/Model.php#L300)*



Callback Signature:
<pre><code>function(&amp;$idSites)</code></pre>


### Live.getAllVisitorDetails

*Defined in [Piwik/Plugins/Live/Visitor](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Live/Visitor.php) in line [75](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Live/Visitor.php#L75)*

This event can be used to add any details to a visitor. The visitor's details are for instance used in
API requests like 'Live.getVisitorProfile' and 'Live.getLastVisitDetails'. This can be useful for instance
in case your plugin defines any visit dimensions and you want to add the value of your dimension to a user.
It can be also useful if you want to enrich a visitor with custom fields based on other fields or if you
want to change or remove any fields from the user.

**Example**

    Piwik::addAction('Live.getAllVisitorDetails', function (&visitor, $details) {
        $visitor['userPoints'] = $details['actions'] + $details['events'] + $details['searches'];
        unset($visitor['anyFieldYouWantToRemove']);
    });

Callback Signature:
<pre><code>function(&amp;$visitor, $this-&gt;details)</code></pre>

- array

- array `$details` The details array contains all visit dimensions (columns of log_visit table)

Usages:

[Actions::extendVisitorDetails](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Actions/Actions.php#L44), [CoreHome::extendVisitorDetails](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/CoreHome/CoreHome.php#L35), [CustomVariables::extendVisitorDetails](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/CustomVariables/CustomVariables.php#L39), [DevicePlugins::extendVisitorDetails](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/DevicePlugins/DevicePlugins.php#L31), [DevicesDetection::extendVisitorDetails](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/DevicesDetection/DevicesDetection.php#L30), [Events::extendVisitorDetails](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Events/Events.php#L31), [Provider::extendVisitorDetails](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Provider/Provider.php#L45), [Referrers::extendVisitorDetails](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Referrers/Referrers.php#L44), [Resolution::extendVisitorDetails](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Resolution/Resolution.php#L29), [UserCountry::extendVisitorDetails](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/UserCountry/UserCountry.php#L45), [VisitTime::extendVisitorDetails](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/VisitTime/VisitTime.php#L24), [VisitorInterest::extendVisitorDetails](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/VisitorInterest/VisitorInterest.php#L41)


### Live.getExtraVisitorDetails

*Defined in [Piwik/Plugins/Live/API](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Live/API.php) in line [240](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Live/API.php#L240)*

Triggered in the Live.getVisitorProfile API method. Plugins can use this event
to discover and add extra data to visitor profiles.

For example, if an email address is found in a custom variable, a plugin could load the
gravatar for the email and add it to the visitor profile, causing it to display in the
visitor profile popup.

The following visitor profile elements can be set to augment the visitor profile popup:

- **visitorAvatar**: A URL to an image to display in the top left corner of the popup.
- **visitorDescription**: Text to be used as the tooltip of the avatar image.

Callback Signature:
<pre><code>function(&amp;$result)</code></pre>

- array `$visitorProfile` The unaugmented visitor profile info.


### Live.makeNewVisitorObject

*Defined in [Piwik/Plugins/Live/VisitorFactory](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Live/VisitorFactory.php) in line [39](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Live/VisitorFactory.php#L39)*

Triggered while visit is filtering in live plugin. Subscribers to this
event can force the use of a custom visitor object that extends from
Piwik\Plugins\Live\VisitorInterface.

Callback Signature:
<pre><code>function(&amp;$visitor, $visitorRawData)</code></pre>

- \Piwik\Plugins\Live\VisitorInterface `&$visitor` Initialized to null, but can be set to a new visitor object. If it isn't modified Piwik uses the default class.

- array `$visitorRawData` Raw data using in Visitor object constructor.

## Login

- [Login.authenticate](#loginauthenticate)
- [Login.authenticate.successful](#loginauthenticatesuccessful)
- [Login.initSession.end](#logininitsessionend)

### Login.authenticate

*Defined in [Piwik/Plugins/Login/SessionInitializer](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Login/SessionInitializer.php) in line [154](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Login/SessionInitializer.php#L154)*



Callback Signature:
<pre><code>function($auth-&gt;getLogin(), $tokenAuth)</code></pre>


### Login.authenticate.successful

*Defined in [Piwik/Plugins/Login/SessionInitializer](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Login/SessionInitializer.php) in line [207](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Login/SessionInitializer.php#L207)*



Callback Signature:
<pre><code>function($authResult-&gt;getIdentity(), $authResult-&gt;getTokenAuth())</code></pre>


### Login.initSession.end

*Defined in [Piwik/Plugins/Login/SessionInitializer](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Login/SessionInitializer.php) in line [125](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Login/SessionInitializer.php#L125)*



## Menu

- [Menu.Admin.addItems](#menuadminadditems)
- [Menu.Reporting.addItems](#menureportingadditems)
- [Menu.Top.addItems](#menutopadditems)

### Menu.Admin.addItems

*Defined in [Piwik/Menu/MenuAdmin](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Menu/MenuAdmin.php) in line [118](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Menu/MenuAdmin.php#L118)*



Callback Signature:
<pre><code>function()</code></pre>


### Menu.Reporting.addItems

*Defined in [Piwik/Menu/MenuReporting](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Menu/MenuReporting.php) in line [128](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Menu/MenuReporting.php#L128)*



Callback Signature:
<pre><code>function()</code></pre>


### Menu.Top.addItems

*Defined in [Piwik/Menu/MenuTop](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Menu/MenuTop.php) in line [71](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Menu/MenuTop.php#L71)*



Callback Signature:
<pre><code>function()</code></pre>

## Metrics

- [Metrics.getDefaultMetricDocumentationTranslations](#metricsgetdefaultmetricdocumentationtranslations)
- [Metrics.getDefaultMetricTranslations](#metricsgetdefaultmetrictranslations)

### Metrics.getDefaultMetricDocumentationTranslations

*Defined in [Piwik/Metrics](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Metrics.php) in line [417](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Metrics.php#L417)*

Use this event to register translations for metrics documentation processed by your plugin.

Callback Signature:
<pre><code>function(&amp;$translations)</code></pre>

- string `&$translations` The array mapping of column_name => Plugin_TranslationForColumnDocumentation

Usages:

[Actions::addMetricDocumentationTranslations](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Actions/Actions.php#L73), [Events::addMetricDocumentationTranslations](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Events/Events.php#L41)


### Metrics.getDefaultMetricTranslations

*Defined in [Piwik/Metrics](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Metrics.php) in line [305](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Metrics.php#L305)*

Use this event to register translations for metrics processed by your plugin.

Callback Signature:
<pre><code>function(&amp;$translations)</code></pre>

- string `&$translations` The array mapping of column_name => Plugin_TranslationForColumn

Usages:

[Actions::addMetricTranslations](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Actions/Actions.php#L50), [Contents::addMetricTranslations](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Contents/Contents.php#L25), [DevicePlugins::addMetricTranslations](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/DevicePlugins/DevicePlugins.php#L39), [Events::addMetricTranslations](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Events/Events.php#L36), [Goals::addMetricTranslations](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Goals/Goals.php#L102), [MultiSites::addMetricTranslations](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/MultiSites/MultiSites.php#L28), [VisitFrequency::addMetricTranslations](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/VisitFrequency/VisitFrequency.php#L26)

## MobileMessaging

- [MobileMessaging.deletePhoneNumber](#mobilemessagingdeletephonenumber)

### MobileMessaging.deletePhoneNumber

*Defined in [Piwik/Plugins/MobileMessaging/API](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/MobileMessaging/API.php) in line [221](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/MobileMessaging/API.php#L221)*

Triggered after a phone number has been deleted. This event should be used to clean up any data that is
related to the now deleted phone number. The ScheduledReports plugin, for example, uses this event to remove
the phone number from all reports to make sure no text message will be sent to this phone number.

**Example**

    public function deletePhoneNumber($phoneNumber)
    {
        $this->unsubscribePhoneNumberFromScheduledReport($phoneNumber);
    }

Callback Signature:
<pre><code>function($phoneNumber)</code></pre>

- string `$phoneNumber` The phone number that was just deleted.

Usages:

[CustomAlerts::removePhoneNumberFromAllAlerts](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/CustomAlerts/CustomAlerts.php#L114), [ScheduledReports::deletePhoneNumber](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/ScheduledReports/ScheduledReports.php#L429)

## Piwik

- [Piwik.getJavascriptCode](#piwikgetjavascriptcode)

### Piwik.getJavascriptCode

*Defined in [Piwik/Tracker/TrackerCodeGenerator](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Tracker/TrackerCodeGenerator.php) in line [126](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Tracker/TrackerCodeGenerator.php#L126)*

Triggered when generating JavaScript tracking code server side. Plugins can use
this event to customise the JavaScript tracking code that is displayed to the
user.

Callback Signature:
<pre><code>function(&amp;$codeImpl, $parameters)</code></pre>

- array `&$codeImpl` An array containing snippets of code that the event handler can modify. Will contain the following elements: - **idSite**: The ID of the site being tracked. - **piwikUrl**: The tracker URL to use. - **options**: A string of JavaScript code that customises the JavaScript tracker. - **optionsBeforeTrackerUrl**: A string of Javascript code that customises the JavaScript tracker inside of anonymous function before adding setTrackerUrl into paq. - **protocol**: Piwik url protocol. The **httpsPiwikUrl** element can be set if the HTTPS domain is different from the normal domain.

- array `$parameters` The parameters supplied to `TrackerCodeGenerator::generate()`.

## Platform

- [Platform.initialized](#platforminitialized)

### Platform.initialized

*Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/2.14.0-b2/core/FrontController.php) in line [339](https://github.com/piwik/piwik/blob/2.14.0-b2/core/FrontController.php#L339)*

Triggered after the platform is initialized and after the user has been authenticated, but before the platform has handled the request. Piwik uses this event to check for updates to Piwik.

Usages:

[CoreUpdater::updateCheck](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/CoreUpdater/CoreUpdater.php#L82), [LanguagesManager::initLanguage](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/LanguagesManager/LanguagesManager.php#L97), [UsersManager::onPlatformInitialized](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/UsersManager/UsersManager.php#L42)

## PluginManager

- [PluginManager.pluginActivated](#pluginmanagerpluginactivated)
- [PluginManager.pluginDeactivated](#pluginmanagerplugindeactivated)

### PluginManager.pluginActivated

*Defined in [Piwik/Plugin/Manager](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Plugin/Manager.php) in line [515](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Plugin/Manager.php#L515)*

Event triggered after a plugin has been activated.

Callback Signature:
<pre><code>function($pluginName)</code></pre>

- string `$pluginName` The plugin that has been activated.


### PluginManager.pluginDeactivated

*Defined in [Piwik/Plugin/Manager](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Plugin/Manager.php) in line [355](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Plugin/Manager.php#L355)*

Event triggered after a plugin has been deactivated.

Callback Signature:
<pre><code>function($pluginName)</code></pre>

- string `$pluginName` The plugin that has been deactivated.

## Provider

- [Provider.getCleanHostname](#providergetcleanhostname)

### Provider.getCleanHostname

*Defined in [Piwik/Plugins/Provider/Provider](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Provider/Provider.php) in line [114](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Provider/Provider.php#L114)*

Triggered when prettifying a hostname string. This event can be used to customize the way a hostname is displayed in the
Providers report.

**Example**

    public function getCleanHostname(&$cleanHostname, $hostname)
    {
        if ('fvae.VARG.ceaga.site.co.jp' == $hostname) {
            $cleanHostname = 'site.co.jp';
        }
    }

Callback Signature:
<pre><code>function(&amp;$cleanHostname, $hostname)</code></pre>

- string `&$cleanHostname` The hostname string to display. Set by the event handler.

- string `$hostname` The full hostname.

## Referrer

- [Referrer.addSearchEngineUrls](#referreraddsearchengineurls)
- [Referrer.addSocialUrls](#referreraddsocialurls)

### Referrer.addSearchEngineUrls

*Defined in [Piwik/Common](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Common.php) in line [830](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Common.php#L830)*



Callback Signature:
<pre><code>function(&amp;$searchEngines)</code></pre>


### Referrer.addSocialUrls

*Defined in [Piwik/Common](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Common.php) in line [884](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Common.php#L884)*



Callback Signature:
<pre><code>function(&amp;$socialUrls)</code></pre>

## Request

- [Request.dispatch](#requestdispatch)
- [Request.dispatch.end](#requestdispatchend)
- [Request.dispatchCoreAndPluginUpdatesScreen](#requestdispatchcoreandpluginupdatesscreen)
- [Request.getRenamedModuleAndAction](#requestgetrenamedmoduleandaction)
- [Request.initAuthenticationObject](#requestinitauthenticationobject)
- [Request.initAuthenticationObject](#requestinitauthenticationobject)
- [Request.initAuthenticationObject](#requestinitauthenticationobject)
- [Request.initAuthenticationObject](#requestinitauthenticationobject)

### Request.dispatch

*Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/2.14.0-b2/core/FrontController.php) in line [474](https://github.com/piwik/piwik/blob/2.14.0-b2/core/FrontController.php#L474)*

Triggered directly before controller actions are dispatched. This event can be used to modify the parameters passed to one or more controller actions
and can be used to change the controller action being dispatched to.

Callback Signature:
<pre><code>function(&amp;$module, &amp;$action, &amp;$parameters)</code></pre>

- string `&$module` The name of the plugin being dispatched to.

- string `&$action` The name of the controller method being dispatched to.

- array `&$parameters` The arguments passed to the controller action.

Usages:

[CustomAlerts::checkControllerPermission](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/CustomAlerts/CustomAlerts.php#L45), [Installation::dispatchIfNotInstalledYet](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Installation/Installation.php#L52), [SitesManager::redirectDashboardToWelcomePage](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/SitesManager/SitesManager.php#L41)


### Request.dispatch.end

*Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/2.14.0-b2/core/FrontController.php) in line [519](https://github.com/piwik/piwik/blob/2.14.0-b2/core/FrontController.php#L519)*

Triggered after a controller action is successfully called. This event can be used to modify controller action output (if any) before the output is returned.

Callback Signature:
<pre><code>function(&amp;$result, $module, $action, $parameters)</code></pre>

- mixed `&$result` The controller action result.

- array `$parameters` The arguments passed to the controller action.


### Request.dispatchCoreAndPluginUpdatesScreen

*Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/2.14.0-b2/core/FrontController.php) in line [284](https://github.com/piwik/piwik/blob/2.14.0-b2/core/FrontController.php#L284)*

Triggered just after the platform is initialized and plugins are loaded. This event can be used to do early initialization.

_Note: At this point the user is not authenticated yet._

Usages:

[CoreUpdater::dispatch](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/CoreUpdater/CoreUpdater.php#L54), [LanguagesManager::initLanguage](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/LanguagesManager/LanguagesManager.php#L97)


### Request.getRenamedModuleAndAction

*Defined in [Piwik/API/Request](https://github.com/piwik/piwik/blob/2.14.0-b2/core/API/Request.php) in line [161](https://github.com/piwik/piwik/blob/2.14.0-b2/core/API/Request.php#L161)*

This event is posted in the Request dispatcher and can be used to overwrite the Module and Action to dispatch. This is useful when some Controller methods or API methods have been renamed or moved to another plugin.

Callback Signature:
<pre><code>function(&amp;$module, &amp;$action)</code></pre>

- $module

- $action

Usages:

[Referrers::renameDeprecatedModuleAndAction](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Referrers/Referrers.php#L37), [ScheduledReports::renameDeprecatedModuleAndAction](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/ScheduledReports/ScheduledReports.php#L101)


### Request.initAuthenticationObject

*Defined in [Piwik/Plugins/API/tests/Integration/APITest](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/API/tests/Integration/APITest.php) in line [85](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/API/tests/Integration/APITest.php#L85)*



Usages:

[Login::initAuthenticationObject](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Login/Login.php#L83)


### Request.initAuthenticationObject

*Defined in [Piwik/Plugins/Overlay/API](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Overlay/API.php) in line [126](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Overlay/API.php#L126)*

Triggered immediately before the user is authenticated. This event can be used by plugins that provide their own authentication mechanism
to make that mechanism available. Subscribers should set the `'Piwik\Auth'` object in
the container to an object that implements the [Auth](/api-reference/Piwik/Auth) interface.

**Example**

    use Piwik\Container\StaticContainer;

    public function initAuthenticationObject($activateCookieAuth)
    {
        StaticContainer::getContainer()->set('Piwik\Auth', new LDAPAuth($activateCookieAuth));
    }

Callback Signature:
<pre><code>function($activateCookieAuth = true)</code></pre>

- bool `$activateCookieAuth` Whether authentication based on `$_COOKIE` values should be allowed.

Usages:

[Login::initAuthenticationObject](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Login/Login.php#L83)


### Request.initAuthenticationObject

*Defined in [Piwik/Tracker/Request](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Tracker/Request.php) in line [157](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Tracker/Request.php#L157)*



Usages:

[Login::initAuthenticationObject](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Login/Login.php#L83)


### Request.initAuthenticationObject

*Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/2.14.0-b2/core/FrontController.php) in line [308](https://github.com/piwik/piwik/blob/2.14.0-b2/core/FrontController.php#L308)*

Triggered before the user is authenticated, when the global authentication object should be created. Plugins that provide their own authentication implementation should use this event
to set the global authentication object (which must derive from [Auth](/api-reference/Piwik/Auth)).

**Example**

    Piwik::addAction('Request.initAuthenticationObject', function() {
        StaticContainer::getContainer()->set('Piwik\Auth', new MyAuthImplementation());
    });

Usages:

[Login::initAuthenticationObject](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Login/Login.php#L83)

## ScheduledReports

- [ScheduledReports.allowMultipleReports](#scheduledreportsallowmultiplereports)
- [ScheduledReports.getRendererInstance](#scheduledreportsgetrendererinstance)
- [ScheduledReports.getReportFormats](#scheduledreportsgetreportformats)
- [ScheduledReports.getReportMetadata](#scheduledreportsgetreportmetadata)
- [ScheduledReports.getReportParameters](#scheduledreportsgetreportparameters)
- [ScheduledReports.getReportRecipients](#scheduledreportsgetreportrecipients)
- [ScheduledReports.getReportTypes](#scheduledreportsgetreporttypes)
- [ScheduledReports.processReports](#scheduledreportsprocessreports)
- [ScheduledReports.sendReport](#scheduledreportssendreport)
- [ScheduledReports.validateReportParameters](#scheduledreportsvalidatereportparameters)

### ScheduledReports.allowMultipleReports

*Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/ScheduledReports/API.php) in line [803](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/ScheduledReports/API.php#L803)*

Triggered when we're determining if a scheduled report transport medium can handle sending multiple Piwik reports in one scheduled report or not. Plugins that provide their own transport mediums should use this
event to specify whether their backend can send more than one Piwik report
at a time.

Callback Signature:
<pre><code>function(&amp;$allowMultipleReports, $reportType)</code></pre>

- bool `&$allowMultipleReports` Whether the backend type can handle multiple Piwik reports or not.

- string `$reportType` A string ID describing how the report is sent, eg, `'sms'` or `'email'`.

Usages:

[MobileMessaging::allowMultipleReports](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/MobileMessaging/MobileMessaging.php#L166), [ScheduledReports::allowMultipleReports](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/ScheduledReports/ScheduledReports.php#L275)


### ScheduledReports.getRendererInstance

*Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/ScheduledReports/API.php) in line [437](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/ScheduledReports/API.php#L437)*

Triggered when obtaining a renderer instance based on the scheduled report output format. Plugins that provide new scheduled report output formats should use this event to
handle their new report formats.

Callback Signature:
<pre><code>function(&amp;$reportRenderer, $reportType, $outputType, $report)</code></pre>

- ReportRenderer `&$reportRenderer` This variable should be set to an instance that extends Piwik\ReportRenderer by one of the event subscribers.

- string `$reportType` A string ID describing how the report is sent, eg, `'sms'` or `'email'`.

- string `$outputType` The output format of the report, eg, `'html'`, `'pdf'`, etc.

- array `&$report` An array describing the scheduled report that is being generated.

Usages:

[MobileMessaging::getRendererInstance](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/MobileMessaging/MobileMessaging.php#L153), [ScheduledReports::getRendererInstance](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/ScheduledReports/ScheduledReports.php#L260)


### ScheduledReports.getReportFormats

*Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/ScheduledReports/API.php) in line [850](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/ScheduledReports/API.php#L850)*

Triggered when gathering all available scheduled report formats. Plugins that provide their own scheduled report format should use
this event to make their format available.

Callback Signature:
<pre><code>function(&amp;$reportFormats, $reportType)</code></pre>

- array `&$reportFormats` An array mapping string IDs for each available scheduled report format with icon paths for those formats. Add your new format's ID to this array.

- string `$reportType` A string ID describing how the report is sent, eg, `'sms'` or `'email'`.

Usages:

[MobileMessaging::getReportFormats](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/MobileMessaging/MobileMessaging.php#L139), [ScheduledReports::getReportFormats](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/ScheduledReports/ScheduledReports.php#L205)


### ScheduledReports.getReportMetadata

*Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/ScheduledReports/API.php) in line [775](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/ScheduledReports/API.php#L775)*

TODO: change this event so it returns a list of API methods instead of report metadata arrays. Triggered when gathering the list of Piwik reports that can be used with a certain
transport medium.

Plugins that provide their own transport mediums should use this
event to list the Piwik reports that their backend supports.

Callback Signature:
<pre><code>function(&amp;$availableReportMetadata, $reportType, $idSite)</code></pre>

- array `&$availableReportMetadata` An array containg report metadata for each supported report.

- string `$reportType` A string ID describing how the report is sent, eg, `'sms'` or `'email'`.

- int `$idSite` The ID of the site we're getting available reports for.

Usages:

[MobileMessaging::getReportMetadata](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/MobileMessaging/MobileMessaging.php#L116), [ScheduledReports::getReportMetadata](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/ScheduledReports/ScheduledReports.php#L176)


### ScheduledReports.getReportParameters

*Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/ScheduledReports/API.php) in line [629](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/ScheduledReports/API.php#L629)*

Triggered when gathering the available parameters for a scheduled report type. Plugins that provide their own scheduled report transport mediums should use this
event to list the available report parameters for their transport medium.

Callback Signature:
<pre><code>function(&amp;$availableParameters, $reportType)</code></pre>

- array `&$availableParameters` The list of available parameters for this report type. This is an array that maps paramater IDs with a boolean that indicates whether the parameter is mandatory or not.

- string `$reportType` A string ID describing how the report is sent, eg, `'sms'` or `'email'`.

Usages:

[MobileMessaging::getReportParameters](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/MobileMessaging/MobileMessaging.php#L146), [ScheduledReports::getReportParameters](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/ScheduledReports/ScheduledReports.php#L212)


### ScheduledReports.getReportRecipients

*Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/ScheduledReports/API.php) in line [881](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/ScheduledReports/API.php#L881)*

Triggered when getting the list of recipients of a scheduled report. Plugins that provide their own scheduled report transport medium should use this event
to extract the list of recipients their backend's specific scheduled report
format.

Callback Signature:
<pre><code>function(&amp;$recipients, $report[&#039;type&#039;], $report)</code></pre>

- array `&$recipients` An array of strings describing each of the scheduled reports recipients. Can be, for example, a list of email addresses or phone numbers or whatever else your plugin uses.

- string `$reportType` A string ID describing how the report is sent, eg, `'sms'` or `'email'`.

- array `$report` An array describing the scheduled report that is being generated.

Usages:

[MobileMessaging::getReportRecipients](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/MobileMessaging/MobileMessaging.php#L173), [ScheduledReports::getReportRecipients](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/ScheduledReports/ScheduledReports.php#L471)


### ScheduledReports.getReportTypes

*Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/ScheduledReports/API.php) in line [826](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/ScheduledReports/API.php#L826)*

Triggered when gathering all available transport mediums. Plugins that provide their own transport mediums should use this
event to make their medium available.

Callback Signature:
<pre><code>function(&amp;$reportTypes)</code></pre>

- array `&$reportTypes` An array mapping transport medium IDs with the paths to those mediums' icons. Add your new backend's ID to this array.

Usages:

[MobileMessaging::getReportTypes](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/MobileMessaging/MobileMessaging.php#L134), [ScheduledReports::getReportTypes](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/ScheduledReports/ScheduledReports.php#L200)


### ScheduledReports.processReports

*Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/ScheduledReports/API.php) in line [415](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/ScheduledReports/API.php#L415)*

Triggered when generating the content of scheduled reports. This event can be used to modify the report data or report metadata of one or more reports
in a scheduled report, before the scheduled report is rendered and delivered.

TODO: list data available in $report or make it a new class that can be documented (same for
      all other events that use a $report)

Callback Signature:
<pre><code>function(&amp;$processedReports, $reportType, $outputType, $report)</code></pre>

- array `&$processedReports` The list of processed reports in the scheduled report. Entries includes report data and metadata for each report.

- string `$reportType` A string ID describing how the scheduled report will be sent, eg, `'sms'` or `'email'`.

- string `$outputType` The output format of the report, eg, `'html'`, `'pdf'`, etc.

- array `$report` An array describing the scheduled report that is being generated.

Usages:

[ScheduledReports::processReports](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/ScheduledReports/ScheduledReports.php#L219)


### ScheduledReports.sendReport

*Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/ScheduledReports/API.php) in line [565](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/ScheduledReports/API.php#L565)*

Triggered when sending scheduled reports. Plugins that provide new scheduled report transport mediums should use this event to
send the scheduled report.

Callback Signature:
<pre><code>function($report[&#039;type&#039;], $report, $contents, $filename = basename($outputFilename), $prettyDate, $reportSubject, $reportTitle, $additionalFiles, \Piwik\Period\Factory::build($report[&#039;period&#039;], $date), $force)</code></pre>

- string `$reportType` A string ID describing how the report is sent, eg, `'sms'` or `'email'`.

- array `$report` An array describing the scheduled report that is being generated.

- string `$contents` The contents of the scheduled report that was generated and now should be sent.

- string `$filename` The path to the file where the scheduled report has been saved.

- string `$prettyDate` A prettified date string for the data within the scheduled report.

- string `$reportSubject` A string describing what's in the scheduled report.

- string `$reportTitle` The scheduled report's given title (given by a Piwik user).

- array `$additionalFiles` The list of additional files that should be sent with this report.

- [Period](/api-reference/Piwik/Period) `$period` The period for which the report has been generated.

- boolean `$force` A report can only be sent once per period. Setting this to true will force to send the report even if it has already been sent.

Usages:

[MobileMessaging::sendReport](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/MobileMessaging/MobileMessaging.php#L180), [ScheduledReports::sendReport](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/ScheduledReports/ScheduledReports.php#L282)


### ScheduledReports.validateReportParameters

*Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/ScheduledReports/API.php) in line [656](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/ScheduledReports/API.php#L656)*

Triggered when validating the parameters for a scheduled report. Plugins that provide their own scheduled reports backend should use this
event to validate the custom parameters defined with ScheduledReports::getReportParameters().

Callback Signature:
<pre><code>function(&amp;$parameters, $reportType)</code></pre>

- array `&$parameters` The list of parameters for the scheduled report.

- string `$reportType` A string ID describing how the report is sent, eg, `'sms'` or `'email'`.

Usages:

[MobileMessaging::validateReportParameters](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/MobileMessaging/MobileMessaging.php#L97), [ScheduledReports::validateReportParameters](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/ScheduledReports/ScheduledReports.php#L132)

## SegmentEditor

- [SegmentEditor.deactivate](#segmenteditordeactivate)
- [SegmentEditor.update](#segmenteditorupdate)

### SegmentEditor.deactivate

*Defined in [Piwik/Plugins/SegmentEditor/API](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/SegmentEditor/API.php) in line [195](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/SegmentEditor/API.php#L195)*

Triggered before a segment is deleted or made invisible. This event can be used by plugins to throw an exception
or do something else.

Callback Signature:
<pre><code>function($idSegment)</code></pre>

- int `$idSegment` The ID of the segment being deleted.

Usages:

[ScheduledReports::segmentDeactivation](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/ScheduledReports/ScheduledReports.php#L540)


### SegmentEditor.update

*Defined in [Piwik/Plugins/SegmentEditor/API](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/SegmentEditor/API.php) in line [247](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/SegmentEditor/API.php#L247)*

Triggered before a segment is modified. This event can be used by plugins to throw an exception
or do something else.

Callback Signature:
<pre><code>function($idSegment, $bind)</code></pre>

- int `$idSegment` The ID of the segment which visibility is reduced.

Usages:

[ScheduledReports::segmentUpdated](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/ScheduledReports/ScheduledReports.php#L507)

## Segments

- [Segments.getKnownSegmentsToArchiveAllSites](#segmentsgetknownsegmentstoarchiveallsites)
- [Segments.getKnownSegmentsToArchiveForSite](#segmentsgetknownsegmentstoarchiveforsite)

### Segments.getKnownSegmentsToArchiveAllSites

*Defined in [Piwik/SettingsPiwik](https://github.com/piwik/piwik/blob/2.14.0-b2/core/SettingsPiwik.php) in line [89](https://github.com/piwik/piwik/blob/2.14.0-b2/core/SettingsPiwik.php#L89)*

Triggered during the cron archiving process to collect segments that should be pre-processed for all websites. The archiving process will be launched
for each of these segments when archiving data.

This event can be used to add segments to be pre-processed. If your plugin depends
on data from a specific segment, this event could be used to provide enhanced
performance.

_Note: If you just want to add a segment that is managed by the user, use the
SegmentEditor API._

**Example**

    Piwik::addAction('Segments.getKnownSegmentsToArchiveAllSites', function (&$segments) {
        $segments[] = 'country=jp;city=Tokyo';
    });

Callback Signature:
<pre><code>function(&amp;$segmentsToProcess)</code></pre>

- array `&$segmentsToProcess` List of segment definitions, eg, array( 'browserCode=ff;resolution=800x600', 'country=jp;city=Tokyo' ) Add segments to this array in your event handler.

Usages:

[SegmentEditor::getKnownSegmentsToArchiveAllSites](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/SegmentEditor/SegmentEditor.php#L40)


### Segments.getKnownSegmentsToArchiveForSite

*Defined in [Piwik/SettingsPiwik](https://github.com/piwik/piwik/blob/2.14.0-b2/core/SettingsPiwik.php) in line [139](https://github.com/piwik/piwik/blob/2.14.0-b2/core/SettingsPiwik.php#L139)*

Triggered during the cron archiving process to collect segments that should be pre-processed for one specific site. The archiving process will be launched
for each of these segments when archiving data for that one site.

This event can be used to add segments to be pre-processed for one site.

_Note: If you just want to add a segment that is managed by the user, you should use the
SegmentEditor API._

**Example**

    Piwik::addAction('Segments.getKnownSegmentsToArchiveForSite', function (&$segments, $idSite) {
        $segments[] = 'country=jp;city=Tokyo';
    });

Callback Signature:
<pre><code>function(&amp;$segments, $idSite)</code></pre>

- array `$segmentsToProcess` List of segment definitions, eg, array( 'browserCode=ff;resolution=800x600', 'country=JP;city=Tokyo' ) Add segments to this array in your event handler.

- int `$idSite` The ID of the site to get segments for.

Usages:

[SegmentEditor::getKnownSegmentsToArchiveForSite](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/SegmentEditor/SegmentEditor.php#L52)

## SEO

- [SEO.getMetricsProviders](#seogetmetricsproviders)

### SEO.getMetricsProviders

*Defined in [Piwik/Plugins/SEO/Metric/Aggregator](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/SEO/Metric/Aggregator.php) in line [62](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/SEO/Metric/Aggregator.php#L62)*

Use this event to register new SEO metrics providers.

Callback Signature:
<pre><code>function(&amp;$providers)</code></pre>

- array `&$providers` Contains an array of Piwik\Plugins\SEO\Metric\MetricsProvider instances.

## Settings

- [Settings.$this-&gt;pluginName.settingsUpdated](#settingsthispluginnamesettingsupdated)

### Settings.$this-&gt;pluginName.settingsUpdated

*Defined in [Piwik/Plugin/Settings](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Plugin/Settings.php) in line [223](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Plugin/Settings.php#L223)*

Triggered after a plugin settings have been updated. **Example**

    Piwik::addAction('Settings.MyPlugin.settingsUpdated', function (Settings $settings) {
        $value = $settings->someSetting->getValue();
        // Do something with the new setting value
    });

Callback Signature:
<pre><code>function($this)</code></pre>

- [Settings](/api-reference/Piwik/Plugin/Settings) `$settings` The plugin settings object.

## SitesManager

- [SitesManager.addSite.end](#sitesmanageraddsiteend)
- [SitesManager.deleteSite.end](#sitesmanagerdeletesiteend)
- [SitesManager.getImageTrackingCode](#sitesmanagergetimagetrackingcode)

### SitesManager.addSite.end

*Defined in [Piwik/Plugins/SitesManager/API](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/SitesManager/API.php) in line [580](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/SitesManager/API.php#L580)*

Triggered after a site has been added.

Callback Signature:
<pre><code>function($idSite)</code></pre>

- int `$idSite` The ID of the site that was added.


### SitesManager.deleteSite.end

*Defined in [Piwik/Plugins/SitesManager/API](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/SitesManager/API.php) in line [624](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/SitesManager/API.php#L624)*

Triggered after a site has been deleted. Plugins can use this event to remove site specific values or settings, such as removing all
goals that belong to a specific website. If you store any data related to a website you
should clean up that information here.

Callback Signature:
<pre><code>function($idSite)</code></pre>

- int `$idSite` The ID of the site being deleted.

Usages:

[CustomAlerts::deleteAlertsForSite](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/CustomAlerts/CustomAlerts.php#L95), [Goals::deleteSiteGoals](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Goals/Goals.php#L126), [ScheduledReports::deleteSiteReport](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/ScheduledReports/ScheduledReports.php#L117), [SitesManager::onSiteDeleted](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/SitesManager/SitesManager.php#L65), [UsersManager::deleteSite](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/UsersManager/UsersManager.php#L83)


### SitesManager.getImageTrackingCode

*Defined in [Piwik/Plugins/SitesManager/API](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/SitesManager/API.php) in line [132](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/SitesManager/API.php#L132)*

Triggered when generating image link tracking code server side. Plugins can use
this event to customise the image tracking code that is displayed to the
user.

Callback Signature:
<pre><code>function(&amp;$piwikUrl, &amp;$urlParams)</code></pre>

- string `$piwikHost` The domain and URL path to the Piwik installation, eg, `'examplepiwik.com/path/to/piwik'`.

- array `&$urlParams` The query parameters used in the <img> element's src URL. See Piwik's image tracking docs for more info.

## Tracker

- [Tracker.Cache.getSiteAttributes](#trackercachegetsiteattributes)
- [Tracker.detectReferrerSearchEngine](#trackerdetectreferrersearchengine)
- [Tracker.end](#trackerend)
- [Tracker.end](#trackerend)
- [Tracker.existingVisitInformation](#trackerexistingvisitinformation)
- [Tracker.getDatabaseConfig](#trackergetdatabaseconfig)
- [Tracker.getVisitFieldsToPersist](#trackergetvisitfieldstopersist)
- [Tracker.isExcludedVisit](#trackerisexcludedvisit)
- [Tracker.makeNewVisitObject](#trackermakenewvisitobject)
- [Tracker.newConversionInformation](#trackernewconversioninformation)
- [Tracker.newVisitorInformation](#trackernewvisitorinformation)
- [Tracker.PageUrl.getQueryParametersToExclude](#trackerpageurlgetqueryparameterstoexclude)
- [Tracker.recordAction](#trackerrecordaction)
- [Tracker.recordEcommerceGoal](#trackerrecordecommercegoal)
- [Tracker.recordStandardGoals](#trackerrecordstandardgoals)
- [Tracker.Request.getIdSite](#trackerrequestgetidsite)
- [Tracker.setTrackerCacheGeneral](#trackersettrackercachegeneral)
- [Tracker.setVisitorIp](#trackersetvisitorip)

### Tracker.Cache.getSiteAttributes

*Defined in [Piwik/Tracker/Cache](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Tracker/Cache.php) in line [98](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Tracker/Cache.php#L98)*

Triggered to get the attributes of a site entity that might be used by the Tracker. Plugins add new site attributes for use in other tracking events must
use this event to put those attributes in the Tracker Cache.

**Example**

    public function getSiteAttributes($content, $idSite)
    {
        $sql = "SELECT info FROM " . Common::prefixTable('myplugin_extra_site_info') . " WHERE idsite = ?";
        $content['myplugin_site_data'] = Db::fetchOne($sql, array($idSite));
    }

Callback Signature:
<pre><code>function(&amp;$content, $idSite)</code></pre>

- array `&$content` Array mapping of site attribute names with values.

- int `$idSite` The site ID to get attributes for.

Usages:

[Goals::fetchGoalsFromDb](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Goals/Goals.php#L255), [SitesManager::recordWebsiteDataInCache](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/SitesManager/SitesManager.php#L106), [UsersManager::recordAdminUsersInCache](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/UsersManager/UsersManager.php#L57)


### Tracker.detectReferrerSearchEngine

*Defined in [Piwik/Plugins/Referrers/Columns/Base](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Referrers/Columns/Base.php) in line [160](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Referrers/Columns/Base.php#L160)*

Triggered when detecting the search engine of a referrer URL. Plugins can use this event to provide custom search engine detection
logic.

Callback Signature:
<pre><code>function(&amp;$searchEngineInformation, $this-&gt;referrerUrl)</code></pre>

- array `&$searchEngineInformation` An array with the following information: - **name**: The search engine name. - **keywords**: The search keywords used. This parameter is initialized to the results of Piwik's default search engine detection logic.

- string


### Tracker.end

*Defined in [Piwik/Plugins/QueuedTracking/Commands/Process](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/QueuedTracking/Commands/Process.php) in line [85](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/QueuedTracking/Commands/Process.php#L85)*




### Tracker.end

*Defined in [Piwik/Tracker](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Tracker.php) in line [101](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Tracker.php#L101)*




### Tracker.existingVisitInformation

*Defined in [Piwik/Tracker/Visit](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Tracker/Visit.php) in line [265](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Tracker/Visit.php#L265)*

Triggered before a [visit entity](/guides/persistence-and-the-mysql-backend#visits) is updated when tracking an action for an existing visit. This event can be used to modify the visit properties that will be updated before the changes
are persisted.

Callback Signature:
<pre><code>function(&amp;$valuesToUpdate, $this-&gt;visitorInfo)</code></pre>

- array `&$valuesToUpdate` Visit entity properties that will be updated.

- array `$visit` The entire visit entity. Read [this](/guides/persistence-and-the-mysql-backend#visits) to see what it contains.


### Tracker.getDatabaseConfig

*Defined in [Piwik/Tracker/Db](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Tracker/Db.php) in line [262](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Tracker/Db.php#L262)*

Triggered before a connection to the database is established by the Tracker. This event can be used to change the database connection settings used by the Tracker.

Callback Signature:
<pre><code>function(&amp;$configDb)</code></pre>

- array `$dbInfos` Reference to an array containing database connection info, including: - **host**: The host name or IP address to the MySQL database. - **username**: The username to use when connecting to the database. - **password**: The password to use when connecting to the database. - **dbname**: The name of the Piwik MySQL database. - **port**: The MySQL database port to use. - **adapter**: either `'PDO\MYSQL'` or `'MYSQLI'` - **type**: The MySQL engine to use, for instance 'InnoDB'


### Tracker.getVisitFieldsToPersist

*Defined in [Piwik/Tracker/Visitor](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Tracker/Visitor.php) in line [222](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Tracker/Visitor.php#L222)*

This event collects a list of [visit entity](/guides/persistence-and-the-mysql-backend#visits) properties that should be loaded when reading the existing visit. Properties that appear in this list will be available in other tracking
events such as 'onExistingVisit'.

Plugins can use this event to load additional visit entity properties for later use during tracking.

Callback Signature:
<pre><code>function(&amp;$fields)</code></pre>


### Tracker.isExcludedVisit

*Defined in [Piwik/Tracker/VisitExcluded](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Tracker/VisitExcluded.php) in line [92](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Tracker/VisitExcluded.php#L92)*

Triggered on every tracking request. This event can be used to tell the Tracker not to record this particular action or visit.

Callback Signature:
<pre><code>function(&amp;$excluded)</code></pre>

- bool `&$excluded` Whether the request should be excluded or not. Initialized to `false`. Event subscribers should set it to `true` in order to exclude the request.


### Tracker.makeNewVisitObject

*Defined in [Piwik/Tracker/Visit/Factory](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Tracker/Visit/Factory.php) in line [39](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Tracker/Visit/Factory.php#L39)*

Triggered before a new **visit tracking object** is created. Subscribers to this
event can force the use of a custom visit tracking object that extends from
Piwik\Tracker\VisitInterface.

Callback Signature:
<pre><code>function(&amp;$visit)</code></pre>

- \Piwik\Tracker\VisitInterface `&$visit` Initialized to null, but can be set to a new visit object. If it isn't modified Piwik uses the default class.


### Tracker.newConversionInformation

*Defined in [Piwik/Tracker/GoalManager](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Tracker/GoalManager.php) in line [725](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Tracker/GoalManager.php#L725)*

Triggered before persisting a new [conversion entity](/guides/persistence-and-the-mysql-backend#conversions). This event can be used to modify conversion information or to add new information to be persisted.

Callback Signature:
<pre><code>function(&amp;$conversion, $visitInformation, $this-&gt;request)</code></pre>

- array `&$conversion` The conversion entity. Read [this](/guides/persistence-and-the-mysql-backend#conversions) to see what it contains.

- array `$visitInformation` The visit entity that we are tracking a conversion for. See what information it contains [here](/guides/persistence-and-the-mysql-backend#visits).

- \Piwik\Tracker\Request `$request` An object describing the tracking request being processed.


### Tracker.newVisitorInformation

*Defined in [Piwik/Tracker/Visit](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Tracker/Visit.php) in line [323](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Tracker/Visit.php#L323)*

Triggered before a new [visit entity](/guides/persistence-and-the-mysql-backend#visits) is persisted. This event can be used to modify the visit entity or add new information to it before it is persisted.
The UserCountry plugin, for example, uses this event to add location information for each visit.

Callback Signature:
<pre><code>function(&amp;$this-&gt;visitorInfo, $this-&gt;request)</code></pre>

- array `$visit` The visit entity. Read [this](/guides/persistence-and-the-mysql-backend#visits) to see what information it contains.

- \Piwik\Tracker\Request `$request` An object describing the tracking request being processed.


### Tracker.PageUrl.getQueryParametersToExclude

*Defined in [Piwik/Tracker/PageUrl](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Tracker/PageUrl.php) in line [99](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Tracker/PageUrl.php#L99)*

Triggered before setting the action url in Piwik\Tracker\Action so plugins can register parameters to be excluded from the tracking URL (e.g. campaign parameters).

Callback Signature:
<pre><code>function(&amp;$parametersToExclude)</code></pre>

- array `&$parametersToExclude` An array of parameters to exclude from the tracking url.


### Tracker.recordAction

*Defined in [Piwik/Tracker/Action](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Tracker/Action.php) in line [406](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Tracker/Action.php#L406)*

Triggered after successfully persisting a [visit action entity](/guides/persistence-and-the-mysql-backend#visit-actions).

Callback Signature:
<pre><code>function($trackerAction = $this, $visitAction)</code></pre>

- Action `$tracker` Action The Action tracker instance.

- array `$visitAction` The visit action entity that was persisted. Read [this](/guides/persistence-and-the-mysql-backend#visit-actions) to see what it contains.


### Tracker.recordEcommerceGoal

*Defined in [Piwik/Tracker/GoalManager](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Tracker/GoalManager.php) in line [358](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Tracker/GoalManager.php#L358)*

Triggered after successfully persisting an ecommerce conversion. _Note: Subscribers should be wary of doing any expensive computation here as it may slow
the tracker down._

Callback Signature:
<pre><code>function($conversion, $visitInformation)</code></pre>

- array `$conversion` The conversion entity that was just persisted. See what information it contains [here](/guides/persistence-and-the-mysql-backend#conversions).

- array `$visitInformation` The visit entity that we are tracking a conversion for. See what information it contains [here](/guides/persistence-and-the-mysql-backend#visits).


### Tracker.recordStandardGoals

*Defined in [Piwik/Tracker/GoalManager](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Tracker/GoalManager.php) in line [701](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Tracker/GoalManager.php#L701)*

Triggered after successfully recording a non-ecommerce conversion. _Note: Subscribers should be wary of doing any expensive computation here as it may slow
the tracker down._

Callback Signature:
<pre><code>function($conversion)</code></pre>

- array `$conversion` The conversion entity that was just persisted. See what information it contains [here](/guides/persistence-and-the-mysql-backend#conversions).


### Tracker.Request.getIdSite

*Defined in [Piwik/Tracker/Request](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Tracker/Request.php) in line [479](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Tracker/Request.php#L479)*

Triggered when obtaining the ID of the site we are tracking a visit for. This event can be used to change the site ID so data is tracked for a different
website.

Callback Signature:
<pre><code>function(&amp;$idSite, $this-&gt;params)</code></pre>

- int `&$idSite` Initialized to the value of the **idsite** query parameter. If a subscriber sets this variable, the value it uses must be greater than 0.

- array `$params` The entire array of request parameters in the current tracking request.


### Tracker.setTrackerCacheGeneral

*Defined in [Piwik/Tracker/Cache](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Tracker/Cache.php) in line [162](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Tracker/Cache.php#L162)*

Triggered before the [general tracker cache](/guides/all-about-tracking#the-tracker-cache) is saved to disk. This event can be used to add extra content to the cache.

Data that is used during tracking but is expensive to compute/query should be
cached to keep tracking efficient. One example of such data are options
that are stored in the piwik_option table. Querying data for each tracking
request means an extra unnecessary database query for each visitor action. Using
a cache solves this problem.

**Example**

    public function setTrackerCacheGeneral(&$cacheContent)
    {
        $cacheContent['MyPlugin.myCacheKey'] = Option::get('MyPlugin_myOption');
    }

Callback Signature:
<pre><code>function(&amp;$cacheContent)</code></pre>

- array `&$cacheContent` Array of cached data. Each piece of data must be mapped by name.

Usages:

[PrivacyManager::setTrackerCacheGeneral](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/PrivacyManager/PrivacyManager.php#L147), [UserCountry::setTrackerCacheGeneral](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/UserCountry/UserCountry.php#L67)


### Tracker.setVisitorIp

*Defined in [Piwik/Tracker/Visit](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Tracker/Visit.php) in line [105](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Tracker/Visit.php#L105)*

Triggered after visits are tested for exclusion so plugins can modify the IP address persisted with a visit. This event is primarily used by the **PrivacyManager** plugin to anonymize IP addresses.

Callback Signature:
<pre><code>function(&amp;$this-&gt;visitorInfo[&#039;location_ip&#039;])</code></pre>

- string `$ip` The visitor's IP address.

## Translate

- [Translate.getClientSideTranslationKeys](#translategetclientsidetranslationkeys)

### Translate.getClientSideTranslationKeys

*Defined in [Piwik/Translation/Translator](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Translation/Translator.php) in line [195](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Translation/Translator.php#L195)*

Triggered before generating the JavaScript code that allows i18n strings to be used in the browser. Plugins should subscribe to this event to specify which translations
should be available to JavaScript.

Event handlers should add whole translation keys, ie, keys that include the plugin name.

**Example**

    public function getClientSideTranslationKeys(&$result)
    {
        $result[] = "MyPlugin_MyTranslation";
    }

Callback Signature:
<pre><code>function(&amp;$result)</code></pre>

- array `&$result` The whole list of client side translation keys.

Usages:

[Annotations::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Annotations/Annotations.php#L30), [CoreHome::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/CoreHome/CoreHome.php#L168), [CorePluginsAdmin::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/CorePluginsAdmin/CorePluginsAdmin.php#L55), [CoreVisualizations::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/CoreVisualizations/CoreVisualizations.php#L74), [CustomAlerts::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/CustomAlerts/CustomAlerts.php#L163), [Dashboard::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Dashboard/Dashboard.php#L235), [Feedback::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Feedback/Feedback.php#L42), [Goals::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Goals/Goals.php#L261), [Live::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Live/Live.php#L48), [MultiSites::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/MultiSites/MultiSites.php#L44), [Overlay::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Overlay/Overlay.php#L35), [ScheduledReports::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/ScheduledReports/ScheduledReports.php#L108), [SitesManager::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/SitesManager/SitesManager.php#L259), [Transitions::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Transitions/Transitions.php#L38), [UserCountry::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/UserCountry/UserCountry.php#L117), [UserCountryMap::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/UserCountryMap/UserCountryMap.php#L71), [UsersManager::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/UsersManager/UsersManager.php#L159), [Widgetize::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Widgetize/Widgetize.php#L48), [ZenMode::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/ZenMode/ZenMode.php#L27)

## User

- [User.isNotAuthorized](#userisnotauthorized)

### User.isNotAuthorized

*Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/2.14.0-b2/core/FrontController.php) in line [107](https://github.com/piwik/piwik/blob/2.14.0-b2/core/FrontController.php#L107)*

Triggered when a user with insufficient access permissions tries to view some resource. This event can be used to customize the error that occurs when a user is denied access
(for example, displaying an error message, redirecting to a page other than login, etc.).

Callback Signature:
<pre><code>function($exception)</code></pre>

- [NoAccessException](/api-reference/Piwik/NoAccessException) `$exception` The exception that was caught.

Usages:

[Login::noAccess](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Login/Login.php#L54)

## UsersManager

- [UsersManager.addUser.end](#usersmanageradduserend)
- [UsersManager.checkPassword](#usersmanagercheckpassword)
- [UsersManager.deleteUser](#usersmanagerdeleteuser)
- [UsersManager.getDefaultDates](#usersmanagergetdefaultdates)
- [UsersManager.removeSiteAccess](#usersmanagerremovesiteaccess)
- [UsersManager.removeSiteAccess](#usersmanagerremovesiteaccess)
- [UsersManager.updateUser.end](#usersmanagerupdateuserend)

### UsersManager.addUser.end

*Defined in [Piwik/Plugins/UsersManager/API](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/UsersManager/API.php) in line [433](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/UsersManager/API.php#L433)*

Triggered after a new user is created.

Callback Signature:
<pre><code>function($userLogin, $email, $password, $alias)</code></pre>

- string `$userLogin` The new user's login handle.


### UsersManager.checkPassword

*Defined in [Piwik/Plugins/UsersManager/UsersManager](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/UsersManager/UsersManager.php) in line [144](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/UsersManager/UsersManager.php#L144)*

Triggered before core password validator check password. This event exists for enable option to create custom password validation rules.
It can be used to validate password (length, used chars etc) and to notify about checking password.

**Example**

    Piwik::addAction('UsersManager.checkPassword', function ($password) {
        if (strlen($password) < 10) {
            throw new Exception('Password is too short.');
        }
    });

Callback Signature:
<pre><code>function($password)</code></pre>

- string `$password` Checking password in plain text.


### UsersManager.deleteUser

*Defined in [Piwik/Plugins/UsersManager/Model](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/UsersManager/Model.php) in line [255](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/UsersManager/Model.php#L255)*

Triggered after a user has been deleted. This event should be used to clean up any data that is related to the now deleted user.
The **Dashboard** plugin, for example, uses this event to remove the user's dashboards.

Callback Signature:
<pre><code>function($userLogin)</code></pre>

- string `$userLogin` The login handle of the deleted user.

Usages:

[CoreAdminHome::cleanupUser](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/CoreAdminHome/CoreAdminHome.php#L33), [CoreVisualizations::deleteUser](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/CoreVisualizations/CoreVisualizations.php#L37), [CustomAlerts::deleteAlertsForLogin](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/CustomAlerts/CustomAlerts.php#L83), [Dashboard::deleteDashboardLayout](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Dashboard/Dashboard.php#L220), [LanguagesManager::deleteUserLanguage](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/LanguagesManager/LanguagesManager.php#L117), [ScheduledReports::deleteUserReport](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/ScheduledReports/ScheduledReports.php#L567)


### UsersManager.getDefaultDates

*Defined in [Piwik/Plugins/UsersManager/Controller](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/UsersManager/Controller.php) in line [216](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/UsersManager/Controller.php#L216)*

Triggered when the list of available dates is requested, for example for the User Settings > Report date to load by default.

Callback Signature:
<pre><code>function(&amp;$dates)</code></pre>

- array `&$dates` Array of (date => translation)


### UsersManager.removeSiteAccess

*Defined in [Piwik/Plugins/ScheduledReports/tests/ScheduledReportsTest](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/ScheduledReports/tests/Integration/ScheduledReportsTest.php) in line [96](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/ScheduledReports/tests/Integration/ScheduledReportsTest.php#L96)*



Callback Signature:
<pre><code>function(&#039;userLogin&#039;, function(1, 2))</code></pre>

Usages:

[ScheduledReports::deleteUserReportForSites](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/ScheduledReports/ScheduledReports.php#L572)


### UsersManager.removeSiteAccess

*Defined in [Piwik/Plugins/UsersManager/API](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/UsersManager/API.php) in line [669](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/UsersManager/API.php#L669)*



Callback Signature:
<pre><code>function($userLogin, $idSites)</code></pre>

Usages:

[ScheduledReports::deleteUserReportForSites](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/ScheduledReports/ScheduledReports.php#L572)


### UsersManager.updateUser.end

*Defined in [Piwik/Plugins/UsersManager/API](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/UsersManager/API.php) in line [545](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/UsersManager/API.php#L545)*

Triggered after an existing user has been updated. Event notify about password change.

Callback Signature:
<pre><code>function($userLogin, $passwordHasBeenUpdated, $email, $password, $alias)</code></pre>

- string `$userLogin` The user's login handle.

- boolean `$passwordHasBeenUpdated` Flag containing information about password change.

## View

- [View.ReportsByDimension.render](#viewreportsbydimensionrender)

### View.ReportsByDimension.render

*Defined in [Piwik/View/ReportsByDimension](https://github.com/piwik/piwik/blob/2.14.0-b2/core/View/ReportsByDimension.php) in line [99](https://github.com/piwik/piwik/blob/2.14.0-b2/core/View/ReportsByDimension.php#L99)*

Triggered before rendering ReportsByDimension views. Plugins can use this event to configure ReportsByDimension instances by
adding or removing reports to display.

Callback Signature:
<pre><code>function($this)</code></pre>

- ReportsByDimension `$this` The view instance.

## ViewDataTable

- [ViewDataTable.addViewDataTable](#viewdatatableaddviewdatatable)
- [ViewDataTable.configure](#viewdatatableconfigure)

### ViewDataTable.addViewDataTable

*Defined in [Piwik/ViewDataTable/Manager](https://github.com/piwik/piwik/blob/2.14.0-b2/core/ViewDataTable/Manager.php) in line [97](https://github.com/piwik/piwik/blob/2.14.0-b2/core/ViewDataTable/Manager.php#L97)*

Triggered when gathering all available DataTable visualizations. Plugins that want to expose new DataTable visualizations should subscribe to
this event and add visualization class names to the incoming array.

**Example**

    public function addViewDataTable(&$visualizations)
    {
        $visualizations[] = 'Piwik\\Plugins\\MyPlugin\\MyVisualization';
    }

Callback Signature:
<pre><code>function(&amp;$visualizations)</code></pre>

- array `&$visualizations` The array of all available visualizations.

Usages:

[CoreVisualizations::addViewDataTable](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/CoreVisualizations/CoreVisualizations.php#L42), [TreemapVisualization::getAvailableVisualizations](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/TreemapVisualization/TreemapVisualization.php#L34)


### ViewDataTable.configure

*Defined in [Piwik/Plugin/ViewDataTable](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Plugin/ViewDataTable.php) in line [256](https://github.com/piwik/piwik/blob/2.14.0-b2/core/Plugin/ViewDataTable.php#L256)*

Triggered during [ViewDataTable](/api-reference/Piwik/Plugin/ViewDataTable) construction. Subscribers should customize
the view based on the report that is being displayed.

Plugins that define their own reports must subscribe to this event in order to
specify how the Piwik UI should display the report.

**Example**

    // event handler
    public function configureViewDataTable(ViewDataTable $view)
    {
        switch ($view->requestConfig->apiMethodToRequestDataTable) {
            case 'VisitTime.getVisitInformationPerServerTime':
                $view->config->enable_sort = true;
                $view->requestConfig->filter_limit = 10;
                break;
        }
    }

Callback Signature:
<pre><code>function($this)</code></pre>

- [ViewDataTable](/api-reference/Piwik/Plugin/ViewDataTable) `$view` The instance to configure.

Usages:

[Actions::configureViewDataTable](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Actions/Actions.php#L143), [Events::configureViewDataTable](https://github.com/piwik/piwik/blob/2.14.0-b2/plugins/Events/Events.php#L154)

## WidgetsList

- [WidgetsList.addWidgets](#widgetslistaddwidgets)

### WidgetsList.addWidgets

*Defined in [Piwik/WidgetsList](https://github.com/piwik/piwik/blob/2.14.0-b2/core/WidgetsList.php) in line [103](https://github.com/piwik/piwik/blob/2.14.0-b2/core/WidgetsList.php#L103)*



