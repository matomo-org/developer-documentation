Events
==========

This is a complete list of available hooks.

## Access

- [Access.createAccessSingleton](#accesscreateaccesssingleton)

### Access.createAccessSingleton
_Defined in [Piwik/Access](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Access.php) in line [52](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Access.php#L52)_



Callback Signature:
<pre><code>function(&amp;self::$instance)</code></pre>

## API

- [API.$pluginName.$methodName](#apipluginnamemethodname)
- [API.$pluginName.$methodName.end](#apipluginnamemethodnameend)
- [API.getReportMetadata](#apigetreportmetadata)
- [API.getReportMetadata.end](#apigetreportmetadataend)
- [API.getSegmentDimensionMetadata](#apigetsegmentdimensionmetadata)
- [API.Request.authenticate](#apirequestauthenticate)
- [API.Request.dispatch](#apirequestdispatch)
- [API.Request.dispatch.end](#apirequestdispatchend)

### API.$pluginName.$methodName
_Defined in [Piwik/API/Proxy](https://github.com/piwik/piwik/blob/2.1.1-b7/core/API/Proxy.php) in line [206](https://github.com/piwik/piwik/blob/2.1.1-b7/core/API/Proxy.php#L206)_

Triggered before an API request is dispatched. This event exists for convenience and is triggered directly after the [API.Request.dispatch](/api-reference/hooks#apirequestdispatch)
event is triggered. It can be used to modify the arguments passed to a **single** API method.

_Note: This is can be accomplished with the [API.Request.dispatch](/api-reference/hooks#apirequestdispatch) event as well, however
event handlers for that event will have to do more work._

**Example**

    Piwik::addAction('API.Actions.getPageUrls', function (&$parameters) {
        // force use of a single website. for some reason.
        $parameters['idSite'] = 1;
    });

Callback Signature:
<pre><code>function(&amp;$finalParameters)</code></pre>

- `array` `&$finalParameters` List of parameters that will be passed to the API method.


### API.$pluginName.$methodName.end
_Defined in [Piwik/API/Proxy](https://github.com/piwik/piwik/blob/2.1.1-b7/core/API/Proxy.php) in line [256](https://github.com/piwik/piwik/blob/2.1.1-b7/core/API/Proxy.php#L256)_

Triggered directly after an API request is dispatched. This event exists for convenience and is triggered immediately before the
[API.Request.dispatch.end](/api-reference/hooks#apirequestdispatchend) event. It can be used to modify the output of a **single**
API method.

_Note: This can be accomplished with the [API.Request.dispatch.end](/api-reference/hooks#apirequestdispatchend) event as well,
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

- `mixed` `$returnedValue` The API method's return value. Can be an object, such as a [DataTable](/api-reference/Piwik/DataTable) instance. could be a [DataTable](/api-reference/Piwik/DataTable).

- `array` `$extraInfo` An array holding information regarding the API request. Will contain the following data: - **className**: The namespace-d class name of the API instance that's being called. - **module**: The name of the plugin the API request was dispatched to. - **action**: The name of the API method that was executed. - **parameters**: The array of parameters passed to the API method.


### API.getReportMetadata
_Defined in [Piwik/Plugins/API/ProcessedReport](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/API/ProcessedReport.php) in line [200](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/API/ProcessedReport.php#L200)_

Triggered when gathering metadata for all available reports. Plugins that define new reports should use this event to make them available in via
the metadata API. By doing so, the report will become available in scheduled reports
as well as in the Piwik Mobile App. In fact, any third party app that uses the metadata
API will automatically have access to the new report.

Callback Signature:
<pre><code>function(&amp;$availableReports, $parameters)</code></pre>

- `string` `&$availableReports` The list of available reports. Append to this list to make a report available. Every element of this array must contain the following information: - **category**: A translated string describing the report's category. - **name**: The translated display title of the report. - **module**: The plugin of the report. - **action**: The API method that serves the report. The following information is optional: - **dimension**: The report's [dimension](/guides/all-about-analytics-data#dimensions) if any. - **metrics**: An array mapping metric names with their display names. - **metricsDocumentation**: An array mapping metric names with their translated documentation. - **processedMetrics**: The array of metrics in the report that are calculated using existing metrics. Can be set to `false` if the report contains no processed metrics. - **order**: The order of the report in the list of reports with the same category.

- `array` `$parameters` Contains the values of the sites and period we are getting reports for. Some reports depend on this data. For example, Goals reports depend on the site IDs being requested. Contains the following information: - **idSites**: The array of site IDs we are getting reports for. - **period**: The period type, eg, `'day'`, `'week'`, `'month'`, `'year'`, `'range'`. - **date**: A string date within the period or a date range, eg, `'2013-01-01'` or `'2012-01-01,2013-01-01'`. TODO: put dimensions section in all about analytics data

Usages:

[Actions::getReportMetadata](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Actions/Actions.php#L134), [CustomVariables::getReportMetadata](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/CustomVariables/CustomVariables.php#L58), [DevicesDetection::getReportMetadata](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/DevicesDetection/DevicesDetection.php#L213), [MultiSites::getReportMetadata](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/MultiSites/MultiSites.php#L61), [Provider::getReportMetadata](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Provider/Provider.php#L46), [Referrers::getReportMetadata](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Referrers/Referrers.php#L57), [UserCountry::getReportMetadata](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/UserCountry/UserCountry.php#L268), [UserSettings::getReportMetadata](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/UserSettings/UserSettings.php#L388), [VisitFrequency::getReportMetadata](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/VisitFrequency/VisitFrequency.php#L33), [VisitTime::getReportMetadata](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/VisitTime/VisitTime.php#L46), [VisitorInterest::getReportMetadata](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/VisitorInterest/VisitorInterest.php#L41), [VisitsSummary::getReportMetadata](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/VisitsSummary/VisitsSummary.php#L36)


### API.getReportMetadata.end
_Defined in [Piwik/Plugins/API/ProcessedReport](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/API/ProcessedReport.php) in line [238](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/API/ProcessedReport.php#L238)_

Triggered after all available reports are collected. This event can be used to modify the report metadata of reports in other plugins. You
could, for example, add custom metrics to every report or remove reports from the list
of available reports.

Callback Signature:
<pre><code>function(&amp;$availableReports, $parameters)</code></pre>

- `array` `&$availableReports` List of all report metadata. Read the [API.getReportMetadata](/api-reference/hooks#apigetreportmetadata) docs to see what this array contains.

- `array` `$parameters` Contains the values of the sites and period we are getting reports for. Some report depend on this data. For example, Goals reports depend on the site IDs being request. Contains the following information: - **idSites**: The array of site IDs we are getting reports for. - **period**: The period type, eg, `'day'`, `'week'`, `'month'`, `'year'`, `'range'`. - **date**: A string date within the period or a date range, eg, `'2013-01-01'` or `'2012-01-01,2013-01-01'`.

Usages:

[Goals::getReportMetadata](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Goals/Goals.php#L139)


### API.getSegmentDimensionMetadata
_Defined in [Piwik/Plugins/API/API](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/API/API.php) in line [130](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/API/API.php#L130)_

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

- `array` `$dimensions` The list of available segment dimensions. Append to this list to add new segments. Each element in this list must contain the following information: - **type**: Either `'metric'` or `'dimension'`. `'metric'` means the value is a numeric and `'dimension'` means it is a string. Also, `'metric'` values will be displayed under **Visit (metrics)** in the Segment Editor. - **category**: The segment category name. This can be an existing segment category visible in the segment editor. - **name**: The pretty name of the segment. Can be a translation token. - **segment**: The segment name, eg, `'visitIp'` or `'searches'`. - **acceptedValues**: A string describing one or two exacmple values, eg `'13.54.122.1, etc.'`. - **sqlSegment**: The table column this segment will segment by. For example, `'log_visit.location_ip'` for the **visitIp** segment. - **sqlFilter**: A PHP callback to apply to segment values before they are used in SQL. - **permission**: True if the current user has view access to this segment, false if otherwise.

- `array` `$idSites` The list of site IDs we're getting the available segments for. Some segments (such as Goal segments) depend on the site.

Usages:

[Actions::getSegmentsMetadata](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Actions/Actions.php#L68), [CustomVariables::getSegmentsMetadata](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/CustomVariables/CustomVariables.php#L82), [DevicesDetection::getSegmentsMetadata](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/DevicesDetection/DevicesDetection.php#L193), [Events::getSegmentsMetadata](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Events/Events.php#L27), [Goals::getSegmentsMetadata](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Goals/Goals.php#L446), [Provider::getSegmentsMetadata](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Provider/Provider.php#L59), [Referrers::getSegmentsMetadata](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Referrers/Referrers.php#L194), [UserCountry::getSegmentsMetadata](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/UserCountry/UserCountry.php#L215), [UserSettings::getSegmentsMetadata](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/UserSettings/UserSettings.php#L428), [VisitTime::getSegmentsMetadata](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/VisitTime/VisitTime.php#L104)


### API.Request.authenticate
_Defined in [Piwik/API/Request](https://github.com/piwik/piwik/blob/2.1.1-b7/core/API/Request.php) in line [260](https://github.com/piwik/piwik/blob/2.1.1-b7/core/API/Request.php#L260)_

Triggered when authenticating an API request, but only if the **token_auth** query parameter is found in the request. Plugins that provide authentication capabilities should subscribe to this event
and make sure the global authentication object (the object returned by `Registry::get('auth')`)
is setup to use `$token_auth` when its `authenticate()` method is executed.

Callback Signature:
<pre><code>function($token_auth)</code></pre>

- `string` `$token_auth` The value of the **token_auth** query parameter.

Usages:

[Login::ApiRequestAuthenticate](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Login/Login.php#L53)


### API.Request.dispatch
_Defined in [Piwik/API/Proxy](https://github.com/piwik/piwik/blob/2.1.1-b7/core/API/Proxy.php) in line [186](https://github.com/piwik/piwik/blob/2.1.1-b7/core/API/Proxy.php#L186)_

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

- `array` `&$finalParameters` List of parameters that will be passed to the API method.

- `string` `$pluginName` The name of the plugin the API method belongs to.

- `string` `$methodName` The name of the API method that will be called.


### API.Request.dispatch.end
_Defined in [Piwik/API/Proxy](https://github.com/piwik/piwik/blob/2.1.1-b7/core/API/Proxy.php) in line [296](https://github.com/piwik/piwik/blob/2.1.1-b7/core/API/Proxy.php#L296)_

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

- `mixed` `$returnedValue` The API method's return value. Can be an object, such as a [DataTable](/api-reference/Piwik/DataTable) instance.

- `array` `$extraInfo` An array holding information regarding the API request. Will contain the following data: - **className**: The namespace-d class name of the API instance that's being called. - **module**: The name of the plugin the API request was dispatched to. - **action**: The name of the API method that was executed. - **parameters**: The array of parameters passed to the API method.

## ArchiveProcessor

- [ArchiveProcessor.Parameters.getIdSites](#archiveprocessorparametersgetidsites)

### ArchiveProcessor.Parameters.getIdSites
_Defined in [Piwik/ArchiveProcessor/Parameters](https://github.com/piwik/piwik/blob/2.1.1-b7/core/ArchiveProcessor/Parameters.php) in line [110](https://github.com/piwik/piwik/blob/2.1.1-b7/core/ArchiveProcessor/Parameters.php#L110)_



Callback Signature:
<pre><code>function(&amp;$idSites, $this-&gt;getPeriod())</code></pre>

## AssetManager

- [AssetManager.filterMergedJavaScripts](#assetmanagerfiltermergedjavascripts)
- [AssetManager.filterMergedStylesheets](#assetmanagerfiltermergedstylesheets)
- [AssetManager.getJavaScriptFiles](#assetmanagergetjavascriptfiles)
- [AssetManager.getStylesheetFiles](#assetmanagergetstylesheetfiles)

### AssetManager.filterMergedJavaScripts
_Defined in [Piwik/AssetManager/UIAssetMerger/JScriptUIAssetMerger](https://github.com/piwik/piwik/blob/2.1.1-b7/core/AssetManager/UIAssetMerger/JScriptUIAssetMerger.php) in line [71](https://github.com/piwik/piwik/blob/2.1.1-b7/core/AssetManager/UIAssetMerger/JScriptUIAssetMerger.php#L71)_

Triggered after all the JavaScript files Piwik uses are minified and merged into a single file, but before the merged JavaScript is written to disk. Plugins can use this event to modify merged JavaScript or do something else
with it.

Callback Signature:
<pre><code>function(&amp;$mergedContent)</code></pre>

- `string` `&$mergedContent` The minified and merged JavaScript.


### AssetManager.filterMergedStylesheets
_Defined in [Piwik/AssetManager/UIAssetMerger/StylesheetUIAssetMerger](https://github.com/piwik/piwik/blob/2.1.1-b7/core/AssetManager/UIAssetMerger/StylesheetUIAssetMerger.php) in line [80](https://github.com/piwik/piwik/blob/2.1.1-b7/core/AssetManager/UIAssetMerger/StylesheetUIAssetMerger.php#L80)_

Triggered after all less stylesheets are compiled to CSS, minified and merged into one file, but before the generated CSS is written to disk. This event can be used to modify merged CSS.

Callback Signature:
<pre><code>function(&amp;$mergedContent)</code></pre>

- `string` `&$mergedContent` The merged and minified CSS.


### AssetManager.getJavaScriptFiles
_Defined in [Piwik/AssetManager/UIAssetFetcher/JScriptUIAssetFetcher](https://github.com/piwik/piwik/blob/2.1.1-b7/core/AssetManager/UIAssetFetcher/JScriptUIAssetFetcher.php) in line [47](https://github.com/piwik/piwik/blob/2.1.1-b7/core/AssetManager/UIAssetFetcher/JScriptUIAssetFetcher.php#L47)_

Triggered when gathering the list of all JavaScript files needed by Piwik and its plugins. Plugins that have their own JavaScript should use this event to make those
files load in the browser.

JavaScript files should be placed within a **javascripts** subdirectory in your
plugin's root directory.

_Note: While you are developing your plugin you should enable the config setting
`[Debug] disable_merged_assets` so JavaScript files will be reloaded immediately
after every change._

**Example**

    public function getJsFiles(&$jsFiles)
    {
        $jsFiles[] = "plugins/MyPlugin/javascripts/myfile.js";
        $jsFiles[] = "plugins/MyPlugin/javascripts/anotherone.js";
    }

Callback Signature:
<pre><code>function(&amp;$this-&gt;fileLocations)</code></pre>

- `string` `$jsFiles` The JavaScript files to load.

Usages:

[Actions::getJsFiles](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Actions/Actions.php#L63), [Annotations::getJsFiles](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Annotations/Annotations.php#L40), [CoreAdminHome::getJsFiles](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/CoreAdminHome/CoreAdminHome.php#L74), [CoreHome::getJsFiles](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/CoreHome/CoreHome.php#L60), [CorePluginsAdmin::getJsFiles](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/CorePluginsAdmin/CorePluginsAdmin.php#L121), [CoreVisualizations::getJsFiles](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/CoreVisualizations/CoreVisualizations.php#L53), [Dashboard::getJsFiles](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Dashboard/Dashboard.php#L230), [ExamplePlugin::getJsFiles](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/ExamplePlugin/ExamplePlugin.php#L25), [Feedback::getJsFiles](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Feedback/Feedback.php#L52), [Goals::getJsFiles](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Goals/Goals.php#L458), [Insights::getJsFiles](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Insights/Insights.php#L46), [LanguagesManager::getJsFiles](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/LanguagesManager/LanguagesManager.php#L61), [Live::getJsFiles](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Live/Live.php#L44), [MobileMessaging::getJsFiles](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/MobileMessaging/MobileMessaging.php#L97), [MultiSites::getJsFiles](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/MultiSites/MultiSites.php#L103), [Overlay::getJsFiles](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Overlay/Overlay.php#L38), [PrivacyManager::getJsFiles](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/PrivacyManager/PrivacyManager.php#L173), [ScheduledReports::getJsFiles](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/ScheduledReports/ScheduledReports.php#L122), [SegmentEditor::getJsFiles](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/SegmentEditor/SegmentEditor.php#L96), [SitesManager::getJsFiles](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/SitesManager/SitesManager.php#L57), [Transitions::getJsFiles](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Transitions/Transitions.php#L33), [UserCountry::getJsFiles](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/UserCountry/UserCountry.php#L84), [UserCountryMap::getJsFiles](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/UserCountryMap/UserCountryMap.php#L66), [UsersManager::getJsFiles](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/UsersManager/UsersManager.php#L83), [Widgetize::getJsFiles](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Widgetize/Widgetize.php#L41)


### AssetManager.getStylesheetFiles
_Defined in [Piwik/AssetManager/UIAssetFetcher/StylesheetUIAssetFetcher](https://github.com/piwik/piwik/blob/2.1.1-b7/core/AssetManager/UIAssetFetcher/StylesheetUIAssetFetcher.php) in line [51](https://github.com/piwik/piwik/blob/2.1.1-b7/core/AssetManager/UIAssetFetcher/StylesheetUIAssetFetcher.php#L51)_

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

- `string` `$stylesheets` The list of stylesheet paths.

Usages:

[Plugin::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/API/API.php#L716), [Actions::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Actions/Actions.php#L58), [Annotations::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Annotations/Annotations.php#L32), [CoreAdminHome::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/CoreAdminHome/CoreAdminHome.php#L65), [CoreHome::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/CoreHome/CoreHome.php#L40), [CorePluginsAdmin::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/CorePluginsAdmin/CorePluginsAdmin.php#L67), [CoreVisualizations::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/CoreVisualizations/CoreVisualizations.php#L47), [DBStats::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/DBStats/DBStats.php#L82), [Dashboard::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Dashboard/Dashboard.php#L239), [ExampleRssWidget::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/ExampleRssWidget/ExampleRssWidget.php#L29), [Feedback::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Feedback/Feedback.php#L45), [Goals::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Goals/Goals.php#L463), [Insights::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Insights/Insights.php#L41), [Installation::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Installation/Installation.php#L109), [LanguagesManager::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/LanguagesManager/LanguagesManager.php#L56), [Live::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Live/Live.php#L38), [MobileMessaging::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/MobileMessaging/MobileMessaging.php#L102), [MultiSites::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/MultiSites/MultiSites.php#L112), [SegmentEditor::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/SegmentEditor/SegmentEditor.php#L101), [SitesManager::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/SitesManager/SitesManager.php#L48), [Transitions::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Transitions/Transitions.php#L28), [UserCountry::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/UserCountry/UserCountry.php#L79), [UserCountryMap::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/UserCountryMap/UserCountryMap.php#L76), [UsersManager::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/UsersManager/UsersManager.php#L92), [Widgetize::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Widgetize/Widgetize.php#L51)

## Config

- [Config.badConfigurationFile](#configbadconfigurationfile)
- [Config.NoConfigurationFile](#confignoconfigurationfile)

### Config.badConfigurationFile
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/2.1.1-b7/core/FrontController.php) in line [309](https://github.com/piwik/piwik/blob/2.1.1-b7/core/FrontController.php#L309)_

Triggered if the INI config file has the incorrect format or if certain required configuration options are absent. This event can be used to start the installation process or to display a custom error message.

Callback Signature:
<pre><code>function($exception)</code></pre>

- `[Exception](http://php.net/class.Exception)` `$exception` The exception thrown from creating and testing the database connection.

Usages:

[Installation::dispatch](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Installation/Installation.php#L74)


### Config.NoConfigurationFile
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/2.1.1-b7/core/FrontController.php) in line [231](https://github.com/piwik/piwik/blob/2.1.1-b7/core/FrontController.php#L231)_

Triggered when the configuration file cannot be found or read, which usually means Piwik is not installed yet. This event can be used to start the installation process or to display a custom error message.

Callback Signature:
<pre><code>function($exception)</code></pre>

- `[Exception](http://php.net/class.Exception)` `$exception` The exception that was thrown by `Config::getInstance()`.

Usages:

[Installation::dispatch](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Installation/Installation.php#L74)

## Console

- [Console.addCommands](#consoleaddcommands)

### Console.addCommands
_Defined in [Piwik/Console](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Console.php) in line [83](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Console.php#L83)_

Triggered to gather all available console commands. Plugins that want to expose new console commands
should subscribe to this event and add commands to the incoming array.

**Example**

    public function addConsoleCommands(&$commands)
    {
        $commands[] = 'Piwik\Plugins\MyPlugin\Commands\MyCommand';
    }

Callback Signature:
<pre><code>function(&amp;$commands)</code></pre>

- `array` `&$commands` An array containing a list of command class names.

Usages:

[CoreConsole::addConsoleCommands](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/CoreConsole/CoreConsole.php#L25), [CoreUpdater::addConsoleCommands](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/CoreUpdater/CoreUpdater.php#L43), [ExampleCommand::addConsoleCommands](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/ExampleCommand/ExampleCommand.php#L25), [LanguagesManager::addConsoleCommands](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/LanguagesManager/LanguagesManager.php#L45)

## Controller

- [Controller.$module.$action](#controllermoduleaction)
- [Controller.$module.$action.end](#controllermoduleactionend)

### Controller.$module.$action
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/2.1.1-b7/core/FrontController.php) in line [503](https://github.com/piwik/piwik/blob/2.1.1-b7/core/FrontController.php#L503)_

Triggered directly before controller actions are dispatched. This event exists for convenience and is triggered directly after the [Request.dispatch](/api-reference/hooks#requestdispatch)
event is triggered.

It can be used to do the same things as the [Request.dispatch](/api-reference/hooks#requestdispatch) event, but for one controller
action only. Using this event will result in a little less code than [Request.dispatch](/api-reference/hooks#requestdispatch).

Callback Signature:
<pre><code>function(&amp;$parameters)</code></pre>

- `array` `&$parameters` The arguments passed to the controller action.


### Controller.$module.$action.end
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/2.1.1-b7/core/FrontController.php) in line [520](https://github.com/piwik/piwik/blob/2.1.1-b7/core/FrontController.php#L520)_

Triggered after a controller action is successfully called. This event exists for convenience and is triggered immediately before the [Request.dispatch.end](/api-reference/hooks#requestdispatchend)
event is triggered.

It can be used to do the same things as the [Request.dispatch.end](/api-reference/hooks#requestdispatchend) event, but for one
controller action only. Using this event will result in a little less code than
[Request.dispatch.end](/api-reference/hooks#requestdispatchend).

Callback Signature:
<pre><code>function(&amp;$result, $parameters)</code></pre>

- `mixed` `&$result` The result of the controller action.

- `array` `$parameters` The arguments passed to the controller action.

## CronArchive

- [CronArchive.archiveSingleSite.finish](#cronarchivearchivesinglesitefinish)
- [CronArchive.archiveSingleSite.start](#cronarchivearchivesinglesitestart)
- [CronArchive.filterWebsiteIds](#cronarchivefilterwebsiteids)

### CronArchive.archiveSingleSite.finish
_Defined in [Piwik/CronArchive](https://github.com/piwik/piwik/blob/2.1.1-b7/core/CronArchive.php) in line [186](https://github.com/piwik/piwik/blob/2.1.1-b7/core/CronArchive.php#L186)_



Callback Signature:
<pre><code>function($idsite, $completed)</code></pre>


### CronArchive.archiveSingleSite.start
_Defined in [Piwik/CronArchive](https://github.com/piwik/piwik/blob/2.1.1-b7/core/CronArchive.php) in line [182](https://github.com/piwik/piwik/blob/2.1.1-b7/core/CronArchive.php#L182)_



Callback Signature:
<pre><code>function($idsite)</code></pre>


### CronArchive.filterWebsiteIds
_Defined in [Piwik/CronArchive](https://github.com/piwik/piwik/blob/2.1.1-b7/core/CronArchive.php) in line [781](https://github.com/piwik/piwik/blob/2.1.1-b7/core/CronArchive.php#L781)_

Triggered by the **archive.php** cron script so plugins can modify the list of websites that the archiving process will be launched for. Plugins can use this hook to add websites to archive, remove websites to archive, or change
the order in which websites will be archived.

Callback Signature:
<pre><code>function(&amp;$websiteIds)</code></pre>

- `array` `&$websiteIds` The list of website IDs to launch the archiving process for.

## Db

- [Db.getDatabaseConfig](#dbgetdatabaseconfig)

### Db.getDatabaseConfig
_Defined in [Piwik/Db](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Db.php) in line [82](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Db.php#L82)_

Triggered before a database connection is established. This event can be used to change the settings used to establish a connection.

Callback Signature:
<pre><code>function(&amp;$dbConfig)</code></pre>

- `array`

## Goals

- [Goals.getReportsWithGoalMetrics](#goalsgetreportswithgoalmetrics)

### Goals.getReportsWithGoalMetrics
_Defined in [Piwik/Plugins/Goals/Goals](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Goals/Goals.php) in line [404](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Goals/Goals.php#L404)_

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

- `array` `&$reportsWithGoals` The list of arrays describing reports that have Goal metrics. Each element of this array must be an array with the following properties: - **category**: The report category. This should be a translated string. - **name**: The report's translated name. - **module**: The plugin the report is in, eg, `'UserCountry'`. - **action**: The API method of the report, eg, `'getCountry'`.

Usages:

[CustomVariables::getReportsWithGoalMetrics](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/CustomVariables/CustomVariables.php#L123), [Goals::getActualReportsWithGoalMetrics](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Goals/Goals.php#L427), [Referrers::getReportsWithGoalMetrics](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Referrers/Referrers.php#L263), [UserCountry::getReportsWithGoalMetrics](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/UserCountry/UserCountry.php#L317), [VisitTime::getReportsWithGoalMetrics](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/VisitTime/VisitTime.php#L95)

## Insights

- [Insights.addReportToOverview](#insightsaddreporttooverview)

### Insights.addReportToOverview
_Defined in [Piwik/Plugins/Insights/API](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Insights/API.php) in line [74](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Insights/API.php#L74)_

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

- `array` `&$reports` An array containing a report unique id as key and an array of API parameters as values.

Usages:

[Actions::addReportToInsightsOverview](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Actions/Actions.php#L51), [Referrers::addReportToInsightsOverview](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Referrers/Referrers.php#L49), [UserCountry::addReportToInsightsOverview](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/UserCountry/UserCountry.php#L61)

## Live

- [Live.API.getIdSitesString](#liveapigetidsitesstring)
- [Live.getExtraVisitorDetails](#livegetextravisitordetails)

### Live.API.getIdSitesString
_Defined in [Piwik/Plugins/Live/API](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Live/API.php) in line [693](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Live/API.php#L693)_



Callback Signature:
<pre><code>function(&amp;$idSites)</code></pre>


### Live.getExtraVisitorDetails
_Defined in [Piwik/Plugins/Live/API](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Live/API.php) in line [382](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Live/API.php#L382)_

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

- `array` `$visitorProfile` The unaugmented visitor profile info.

## Log

- [Log.formatDatabaseMessage](#logformatdatabasemessage)
- [Log.formatFileMessage](#logformatfilemessage)
- [Log.formatScreenMessage](#logformatscreenmessage)
- [Log.getAvailableWriters](#loggetavailablewriters)

### Log.formatDatabaseMessage
_Defined in [Piwik/Log](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Log.php) in line [490](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Log.php#L490)_

Triggered when trying to log an object to a database table. Plugins can use
this event to convert objects to strings before they are logged.

**Example**

    public function formatDatabaseMessage(&$message, $level, $tag, $datetime, $logger) {
        if ($message instanceof MyCustomDebugInfo) {
            $message = $message->formatForDatabase();
        }
    }

Callback Signature:
<pre><code>function(&amp;$message, $level, $tag, $datetime, $logger)</code></pre>

- `mixed` `&$message` The object that is being logged. Event handlers should check if the object is of a certain type and if it is, set `$message` to the string that should be logged.

- `int` `$level` The log level used with this log entry.

- `string` `$tag` The current plugin that started logging (or if no plugin, the current class).

- `string` `$datetime` Datetime of the logging call.

- `[Log](/api-reference/Piwik/Log)` `$logger` The Log singleton.


### Log.formatFileMessage
_Defined in [Piwik/Log](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Log.php) in line [391](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Log.php#L391)_

Triggered when trying to log an object to a file. Plugins can use
this event to convert objects to strings before they are logged.

**Example**

    public function formatFileMessage(&$message, $level, $tag, $datetime, $logger) {
        if ($message instanceof MyCustomDebugInfo) {
            $message = $message->formatForFile();
        }
    }

Callback Signature:
<pre><code>function(&amp;$message, $level, $tag, $datetime, $logger)</code></pre>

- `mixed` `&$message` The object that is being logged. Event handlers should check if the object is of a certain type and if it is, set `$message` to the string that should be logged.

- `int` `$level` The log level used with this log entry.

- `string` `$tag` The current plugin that started logging (or if no plugin, the current class).

- `string` `$datetime` Datetime of the logging call.

- `[Log](/api-reference/Piwik/Log)` `$logger` The Log singleton.


### Log.formatScreenMessage
_Defined in [Piwik/Log](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Log.php) in line [452](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Log.php#L452)_

Triggered when trying to log an object to the screen. Plugins can use
this event to convert objects to strings before they are logged.

The result of this callback can be HTML so no sanitization is done on the result.
This means **YOU MUST SANITIZE THE MESSAGE YOURSELF** if you use this event.

**Example**

    public function formatScreenMessage(&$message, $level, $tag, $datetime, $logger) {
        if ($message instanceof MyCustomDebugInfo) {
            $message = Common::sanitizeInputValue($message->formatForScreen());
        }
    }

Callback Signature:
<pre><code>function(&amp;$message, $level, $tag, $datetime, $logger)</code></pre>

- `mixed` `&$message` The object that is being logged. Event handlers should check if the object is of a certain type and if it is, set `$message` to the string that should be logged.

- `int` `$level` The log level used with this log entry.

- `string` `$tag` The current plugin that started logging (or if no plugin, the current class).

- `string` `$datetime` Datetime of the logging call.

- `[Log](/api-reference/Piwik/Log)` `$logger` The Log singleton.


### Log.getAvailableWriters
_Defined in [Piwik/Log](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Log.php) in line [350](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Log.php#L350)_

This event is called when the Log instance is created. Plugins can use this event to
make new logging writers available.

A logging writer is a callback with the following signature:

    function (int $level, string $tag, string $datetime, string $message)

`$level` is the log level to use, `$tag` is the log tag used, `$datetime` is the date time
of the logging call and `$message` is the formatted log message.

Logging writers must be associated by name in the array passed to event handlers. The
name specified can be used in Piwik's INI configuration.

**Example**

    public function getAvailableWriters(&$writers) {
        $writers['myloggername'] = function ($level, $tag, $datetime, $message) {
            // ...
        };
    }

    // 'myloggername' can now be used in the log_writers config option.

Callback Signature:
<pre><code>function(&amp;$writers)</code></pre>

- `array` `&$writers` Array mapping writer names with logging writers.

## Menu

- [Menu.Admin.addItems](#menuadminadditems)
- [Menu.Reporting.addItems](#menureportingadditems)
- [Menu.Top.addItems](#menutopadditems)

### Menu.Admin.addItems
_Defined in [Piwik/Menu/MenuAdmin](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Menu/MenuAdmin.php) in line [81](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Menu/MenuAdmin.php#L81)_

Triggered when collecting all available admin menu items. Subscribe to this event if you want
to add one or more items to the Piwik admin menu.

Menu items should be added via the [add()](/api-reference/Piwik/Menu/MenuAdmin#add) method.

**Example**

    use Piwik\Menu\MenuAdmin;

    public function addMenuItems()
    {
        MenuAdmin::getInstance()->add(
            'MenuName',
            'SubmenuName',
            array('module' => 'MyPlugin', 'action' => 'index'),
            $showOnlyIf = Piwik::hasUserSuperUserAccess(),
            $order = 6
        );
    }

Usages:

[CoreAdminHome::addMenu](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/CoreAdminHome/CoreAdminHome.php#L89), [CorePluginsAdmin::addMenu](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/CorePluginsAdmin/CorePluginsAdmin.php#L73), [DBStats::addMenu](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/DBStats/DBStats.php#L45), [DevicesDetection::addAdminMenu](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/DevicesDetection/DevicesDetection.php#L105), [Installation::addMenu](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Installation/Installation.php#L98), [MobileMessaging::addMenu](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/MobileMessaging/MobileMessaging.php#L85), [PrivacyManager::addMenu](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/PrivacyManager/PrivacyManager.php#L178), [SitesManager::addMenu](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/SitesManager/SitesManager.php#L37), [UserCountry::addAdminMenu](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/UserCountry/UserCountry.php#L205), [UsersManager::addMenu](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/UsersManager/UsersManager.php#L100)


### Menu.Reporting.addItems
_Defined in [Piwik/Menu/MenuMain](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Menu/MenuMain.php) in line [87](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Menu/MenuMain.php#L87)_

Triggered when collecting all available reporting menu items. Subscribe to this event if you
want to add one or more items to the Piwik reporting menu.

Menu items should be added via the [add()](/api-reference/Piwik/Menu/MenuMain#add) method.

**Example**

    use Piwik\Menu\Main;

    public function addMenuItems()
    {
        Main::getInstance()->add(
            'CustomMenuName',
            'CustomSubmenuName',
            array('module' => 'MyPlugin', 'action' => 'index'),
            $showOnlyIf = Piwik::hasUserSuperUserAccess(),
            $order = 6
        );
    }

Usages:

[Actions::addMenus](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Actions/Actions.php#L488), [CustomVariables::addMenus](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/CustomVariables/CustomVariables.php#L50), [Dashboard::addMenus](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Dashboard/Dashboard.php#L199), [DevicesDetection::addMenu](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/DevicesDetection/DevicesDetection.php#L278), [ExampleUI::addReportingMenuItems](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/ExampleUI/ExampleUI.php#L29), [Goals::addMenus](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Goals/Goals.php#L498), [Live::addMenu](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Live/Live.php#L51), [Provider::addMenu](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Provider/Provider.php#L98), [Referrers::addMenus](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Referrers/Referrers.php#L251), [UserCountry::addMenu](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/UserCountry/UserCountry.php#L197), [UserCountryMap::addMenu](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/UserCountryMap/UserCountryMap.php#L60), [UserSettings::addMenu](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/UserSettings/UserSettings.php#L460), [VisitFrequency::addMenu](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/VisitFrequency/VisitFrequency.php#L65), [VisitTime::addMenu](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/VisitTime/VisitTime.php#L89), [VisitorInterest::addMenu](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/VisitorInterest/VisitorInterest.php#L110), [VisitsSummary::addMenu](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/VisitsSummary/VisitsSummary.php#L67)


### Menu.Top.addItems
_Defined in [Piwik/Menu/MenuTop](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Menu/MenuTop.php) in line [117](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Menu/MenuTop.php#L117)_

Triggered when collecting all available menu items that are be displayed on the very top of every page, next to the login/logout links. Subscribe to this event if you want to add one or more items to the top menu.

Menu items should be added via the [addEntry()](/api-reference/Piwik/Menu/MenuTop#addentry) method.

**Example**

    use Piwik\Menu\MenuTop;

    public function addMenuItems()
    {
        MenuTop::addEntry(
            'TopMenuName',
            array('module' => 'MyPlugin', 'action' => 'index'),
            $showOnlyIf = Piwik::hasUserSuperUserAccess(),
            $order = 6
        );
    }

Usages:

[Plugin::addTopMenu](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/API/API.php#L692), [Dashboard::addTopMenu](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Dashboard/Dashboard.php#L216), [ExampleUI::addTopMenuItems](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/ExampleUI/ExampleUI.php#L45), [Feedback::addTopMenu](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Feedback/Feedback.php#L33), [LanguagesManager::showLanguagesSelector](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/LanguagesManager/LanguagesManager.php#L66), [MultiSites::addTopMenu](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/MultiSites/MultiSites.php#L96), [ScheduledReports::addTopMenu](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/ScheduledReports/ScheduledReports.php#L509), [Widgetize::addTopMenu](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Widgetize/Widgetize.php#L33)

## MobileMessaging

- [MobileMessaging.deletePhoneNumber](#mobilemessagingdeletephonenumber)

### MobileMessaging.deletePhoneNumber
_Defined in [Piwik/Plugins/MobileMessaging/API](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/MobileMessaging/API.php) in line [221](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/MobileMessaging/API.php#L221)_

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

- `string` `$phoneNumber` The phone number that was just deleted.

Usages:

[ScheduledReports::deletePhoneNumber](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/ScheduledReports/ScheduledReports.php#L396)

## Platform

- [Platform.initialized](#platforminitialized)

### Platform.initialized
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/2.1.1-b7/core/FrontController.php) in line [372](https://github.com/piwik/piwik/blob/2.1.1-b7/core/FrontController.php#L372)_

Triggered after the platform is initialized and after the user has been authenticated, but before the platform has handled the request. Piwik uses this event to check for updates to Piwik.

Usages:

[CoreUpdater::updateCheck](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/CoreUpdater/CoreUpdater.php#L162), [UsersManager::onPlatformInitialized](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/UsersManager/UsersManager.php#L43)

## Provider

- [Provider.getCleanHostname](#providergetcleanhostname)

### Provider.getCleanHostname
_Defined in [Piwik/Plugins/Provider/Provider](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Provider/Provider.php) in line [186](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Provider/Provider.php#L186)_

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

- `string` `&$cleanHostname` The hostname string to display. Set by the event handler.

- `string` `$hostname` The full hostname.

## Referrer

- [Referrer.addSearchEngineUrls](#referreraddsearchengineurls)
- [Referrer.addSocialUrls](#referreraddsocialurls)

### Referrer.addSearchEngineUrls
_Defined in [Piwik/Common](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Common.php) in line [753](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Common.php#L753)_



Callback Signature:
<pre><code>function(&amp;$searchEngines)</code></pre>


### Referrer.addSocialUrls
_Defined in [Piwik/Common](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Common.php) in line [792](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Common.php#L792)_



Callback Signature:
<pre><code>function(&amp;$socialUrls)</code></pre>

## Request

- [Request.dispatch](#requestdispatch)
- [Request.dispatch.end](#requestdispatchend)
- [Request.dispatchCoreAndPluginUpdatesScreen](#requestdispatchcoreandpluginupdatesscreen)
- [Request.initAuthenticationObject](#requestinitauthenticationobject)
- [Request.initAuthenticationObject](#requestinitauthenticationobject)
- [Request.initAuthenticationObject](#requestinitauthenticationobject)

### Request.dispatch
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/2.1.1-b7/core/FrontController.php) in line [488](https://github.com/piwik/piwik/blob/2.1.1-b7/core/FrontController.php#L488)_

Triggered directly before controller actions are dispatched. This event can be used to modify the parameters passed to one or more controller actions
and can be used to change the controller action being dispatched to.

Callback Signature:
<pre><code>function(&amp;$module, &amp;$action, &amp;$parameters)</code></pre>

- `string` `&$module` The name of the plugin being dispatched to.

- `string` `&$action` The name of the controller method being dispatched to.

- `array` `&$parameters` The arguments passed to the controller action.

Usages:

[Installation::dispatchIfNotInstalledYet](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Installation/Installation.php#L40)


### Request.dispatch.end
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/2.1.1-b7/core/FrontController.php) in line [530](https://github.com/piwik/piwik/blob/2.1.1-b7/core/FrontController.php#L530)_

Triggered after a controller action is successfully called. This event can be used to modify controller action output (if any) before the output is returned.

Callback Signature:
<pre><code>function(&amp;$result, $parameters)</code></pre>

- `mixed` `&$result` The controller action result.

- `array` `$parameters` The arguments passed to the controller action.


### Request.dispatchCoreAndPluginUpdatesScreen
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/2.1.1-b7/core/FrontController.php) in line [323](https://github.com/piwik/piwik/blob/2.1.1-b7/core/FrontController.php#L323)_

Triggered just after the platform is initialized and plugins are loaded. This event can be used to do early initialization.

_Note: At this point the user is not authenticated yet._

Usages:

[CoreUpdater::dispatch](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/CoreUpdater/CoreUpdater.php#L133)


### Request.initAuthenticationObject
_Defined in [Piwik/Tracker/Request](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Tracker/Request.php) in line [109](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Tracker/Request.php#L109)_



Usages:

[Login::initAuthenticationObject](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Login/Login.php#L69)


### Request.initAuthenticationObject
_Defined in [Piwik/Plugins/Overlay/API](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Overlay/API.php) in line [125](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Overlay/API.php#L125)_

Triggered immediately before the user is authenticated. This event can be used by plugins that provide their own authentication mechanism
to make that mechanism available. Subscribers should set the `'auth'` object in
the Piwik\Registry to an object that implements the Piwik\Auth interface.

**Example**

    use Piwik\Registry;

    public function initAuthenticationObject($activateCookieAuth)
    {
        Registry::set('auth', new LDAPAuth($activateCookieAuth));
    }

Callback Signature:
<pre><code>function($activateCookieAuth = true)</code></pre>

- `bool` `$activateCookieAuth` Whether authentication based on `$_COOKIE` values should be allowed.

Usages:

[Login::initAuthenticationObject](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Login/Login.php#L69)


### Request.initAuthenticationObject
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/2.1.1-b7/core/FrontController.php) in line [345](https://github.com/piwik/piwik/blob/2.1.1-b7/core/FrontController.php#L345)_

Triggered before the user is authenticated, when the global authentication object should be created. Plugins that provide their own authentication implementation should use this event
to set the global authentication object (which must derive from Piwik\Auth).

**Example**

    Piwik::addAction('Request.initAuthenticationObject', function() {
        Piwik\Registry::set('auth', new MyAuthImplementation());
    });

Usages:

[Login::initAuthenticationObject](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Login/Login.php#L69)

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
_Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/ScheduledReports/API.php) in line [778](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/ScheduledReports/API.php#L778)_

Triggered when we're determining if a scheduled report transport medium can handle sending multiple Piwik reports in one scheduled report or not. Plugins that provide their own transport mediums should use this
event to specify whether their backend can send more than one Piwik report
at a time.

Callback Signature:
<pre><code>function(&amp;$allowMultipleReports, $reportType)</code></pre>

- `bool` `&$allowMultipleReports` Whether the backend type can handle multiple Piwik reports or not.

- `string` `$reportType` A string ID describing how the report is sent, eg, `'sms'` or `'email'`.

Usages:

[MobileMessaging::allowMultipleReports](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/MobileMessaging/MobileMessaging.php#L176), [ScheduledReports::allowMultipleReports](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/ScheduledReports/ScheduledReports.php#L260)


### ScheduledReports.getRendererInstance
_Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/ScheduledReports/API.php) in line [427](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/ScheduledReports/API.php#L427)_

Triggered when obtaining a renderer instance based on the scheduled report output format. Plugins that provide new scheduled report output formats should use this event to
handle their new report formats.

Callback Signature:
<pre><code>function(&amp;$reportRenderer, $reportType, $outputType, $report)</code></pre>

- `ReportRenderer` `&$reportRenderer` This variable should be set to an instance that extends Piwik\ReportRenderer by one of the event subscribers.

- `string` `$reportType` A string ID describing how the report is sent, eg, `'sms'` or `'email'`.

- `string` `$outputType` The output format of the report, eg, `'html'`, `'pdf'`, etc.

- `array` `&$report` An array describing the scheduled report that is being generated.

Usages:

[MobileMessaging::getRendererInstance](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/MobileMessaging/MobileMessaging.php#L163), [ScheduledReports::getRendererInstance](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/ScheduledReports/ScheduledReports.php#L247)


### ScheduledReports.getReportFormats
_Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/ScheduledReports/API.php) in line [825](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/ScheduledReports/API.php#L825)_

Triggered when gathering all available scheduled report formats. Plugins that provide their own scheduled report format should use
this event to make their format available.

Callback Signature:
<pre><code>function(&amp;$reportFormats, $reportType)</code></pre>

- `array` `&$reportFormats` An array mapping string IDs for each available scheduled report format with icon paths for those formats. Add your new format's ID to this array.

- `string` `$reportType` A string ID describing how the report is sent, eg, `'sms'` or `'email'`.

Usages:

[MobileMessaging::getReportFormats](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/MobileMessaging/MobileMessaging.php#L149), [ScheduledReports::getReportFormats](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/ScheduledReports/ScheduledReports.php#L194)


### ScheduledReports.getReportMetadata
_Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/ScheduledReports/API.php) in line [750](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/ScheduledReports/API.php#L750)_

TODO: change this event so it returns a list of API methods instead of report metadata arrays. Triggered when gathering the list of Piwik reports that can be used with a certain
transport medium.

Plugins that provide their own transport mediums should use this
event to list the Piwik reports that their backend supports.

Callback Signature:
<pre><code>function(&amp;$availableReportMetadata, $reportType, $idSite)</code></pre>

- `array` `&$availableReportMetadata` An array containg report metadata for each supported report.

- `string` `$reportType` A string ID describing how the report is sent, eg, `'sms'` or `'email'`.

- `int` `$idSite` The ID of the site we're getting available reports for.

Usages:

[MobileMessaging::getReportMetadata](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/MobileMessaging/MobileMessaging.php#L126), [ScheduledReports::getReportMetadata](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/ScheduledReports/ScheduledReports.php#L169)


### ScheduledReports.getReportParameters
_Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/ScheduledReports/API.php) in line [604](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/ScheduledReports/API.php#L604)_

Triggered when gathering the available parameters for a scheduled report type. Plugins that provide their own scheduled report transport mediums should use this
event to list the available report parameters for their transport medium.

Callback Signature:
<pre><code>function(&amp;$availableParameters, $reportType)</code></pre>

- `array` `&$availableParameters` The list of available parameters for this report type. This is an array that maps paramater IDs with a boolean that indicates whether the parameter is mandatory or not.

- `string` `$reportType` A string ID describing how the report is sent, eg, `'sms'` or `'email'`.

Usages:

[MobileMessaging::getReportParameters](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/MobileMessaging/MobileMessaging.php#L156), [ScheduledReports::getReportParameters](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/ScheduledReports/ScheduledReports.php#L201)


### ScheduledReports.getReportRecipients
_Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/ScheduledReports/API.php) in line [856](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/ScheduledReports/API.php#L856)_

Triggered when getting the list of recipients of a scheduled report. Plugins that provide their own scheduled report transport medium should use this event
to extract the list of recipients their backend's specific scheduled report
format.

Callback Signature:
<pre><code>function(&amp;$recipients, $report[&#039;type&#039;], $report)</code></pre>

- `array` `&$recipients` An array of strings describing each of the scheduled reports recipients. Can be, for example, a list of email addresses or phone numbers or whatever else your plugin uses.

- `string` `$reportType` A string ID describing how the report is sent, eg, `'sms'` or `'email'`.

- `array` `$report` An array describing the scheduled report that is being generated.

Usages:

[MobileMessaging::getReportRecipients](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/MobileMessaging/MobileMessaging.php#L183), [ScheduledReports::getReportRecipients](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/ScheduledReports/ScheduledReports.php#L438)


### ScheduledReports.getReportTypes
_Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/ScheduledReports/API.php) in line [801](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/ScheduledReports/API.php#L801)_

Triggered when gathering all available transport mediums. Plugins that provide their own transport mediums should use this
event to make their medium available.

Callback Signature:
<pre><code>function(&amp;$reportTypes)</code></pre>

- `array` `&$reportTypes` An array mapping transport medium IDs with the paths to those mediums' icons. Add your new backend's ID to this array.

Usages:

[MobileMessaging::getReportTypes](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/MobileMessaging/MobileMessaging.php#L144), [ScheduledReports::getReportTypes](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/ScheduledReports/ScheduledReports.php#L189)


### ScheduledReports.processReports
_Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/ScheduledReports/API.php) in line [405](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/ScheduledReports/API.php#L405)_

Triggered when generating the content of scheduled reports. This event can be used to modify the report data or report metadata of one or more reports
in a scheduled report, before the scheduled report is rendered and delivered.

TODO: list data available in $report or make it a new class that can be documented (same for
      all other events that use a $report)

Callback Signature:
<pre><code>function(&amp;$processedReports, $reportType, $outputType, $report)</code></pre>

- `array` `&$processedReports` The list of processed reports in the scheduled report. Entries includes report data and metadata for each report.

- `string` `$reportType` A string ID describing how the scheduled report will be sent, eg, `'sms'` or `'email'`.

- `string` `$outputType` The output format of the report, eg, `'html'`, `'pdf'`, etc.

- `array` `$report` An array describing the scheduled report that is being generated.

Usages:

[ScheduledReports::processReports](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/ScheduledReports/ScheduledReports.php#L208)


### ScheduledReports.sendReport
_Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/ScheduledReports/API.php) in line [546](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/ScheduledReports/API.php#L546)_

Triggered when sending scheduled reports. Plugins that provide new scheduled report transport mediums should use this event to
send the scheduled report.

Callback Signature:
<pre><code>function($report[&#039;type&#039;], $report, $contents, $filename, $prettyDate, $reportSubject, $reportTitle, $additionalFiles)</code></pre>

- `string` `$reportType` A string ID describing how the report is sent, eg, `'sms'` or `'email'`.

- `array` `$report` An array describing the scheduled report that is being generated.

- `string` `$contents` The contents of the scheduled report that was generated and now should be sent.

- `string` `$filename` The path to the file where the scheduled report has been saved.

- `string` `$prettyDate` A prettified date string for the data within the scheduled report.

- `string` `$reportSubject` A string describing what's in the scheduled report.

- `string` `$reportTitle` The scheduled report's given title (given by a Piwik user).

- `array` `$additionalFiles` The list of additional files that should be sent with this report.

Usages:

[MobileMessaging::sendReport](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/MobileMessaging/MobileMessaging.php#L190), [ScheduledReports::sendReport](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/ScheduledReports/ScheduledReports.php#L267)


### ScheduledReports.validateReportParameters
_Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/ScheduledReports/API.php) in line [631](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/ScheduledReports/API.php#L631)_

Triggered when validating the parameters for a scheduled report. Plugins that provide their own scheduled reports backend should use this
event to validate the custom parameters defined with ScheduledReports::getReportParameters().

Callback Signature:
<pre><code>function(&amp;$parameters, $reportType)</code></pre>

- `array` `&$parameters` The list of parameters for the scheduled report.

- `string` `$reportType` A string ID describing how the report is sent, eg, `'sms'` or `'email'`.

Usages:

[MobileMessaging::validateReportParameters](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/MobileMessaging/MobileMessaging.php#L107), [ScheduledReports::validateReportParameters](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/ScheduledReports/ScheduledReports.php#L127)

## SegmentEditor

- [SegmentEditor.deactivate](#segmenteditordeactivate)

### SegmentEditor.deactivate
_Defined in [Piwik/Plugins/SegmentEditor/API](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/SegmentEditor/API.php) in line [302](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/SegmentEditor/API.php#L302)_

Triggered before a segment is deleted or made invisible. This event can be used by plugins to throw an exception
or do something else.

Callback Signature:
<pre><code>function($idSegment)</code></pre>

- `int` `$idSegment` The ID of the segment being deleted.

Usages:

[ScheduledReports::segmentDeactivation](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/ScheduledReports/ScheduledReports.php#L491)

## Segments

- [Segments.getKnownSegmentsToArchiveAllSites](#segmentsgetknownsegmentstoarchiveallsites)
- [Segments.getKnownSegmentsToArchiveForSite](#segmentsgetknownsegmentstoarchiveforsite)

### Segments.getKnownSegmentsToArchiveAllSites
_Defined in [Piwik/SettingsPiwik](https://github.com/piwik/piwik/blob/2.1.1-b7/core/SettingsPiwik.php) in line [88](https://github.com/piwik/piwik/blob/2.1.1-b7/core/SettingsPiwik.php#L88)_

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

- `array` `&$segmentsToProcess` List of segment definitions, eg, array( 'browserCode=ff;resolution=800x600', 'country=jp;city=Tokyo' ) Add segments to this array in your event handler.

Usages:

[SegmentEditor::getKnownSegmentsToArchiveAllSites](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/SegmentEditor/SegmentEditor.php#L56)


### Segments.getKnownSegmentsToArchiveForSite
_Defined in [Piwik/SettingsPiwik](https://github.com/piwik/piwik/blob/2.1.1-b7/core/SettingsPiwik.php) in line [133](https://github.com/piwik/piwik/blob/2.1.1-b7/core/SettingsPiwik.php#L133)_

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

- `array` `$segmentsToProcess` List of segment definitions, eg, array( 'browserCode=ff;resolution=800x600', 'country=JP;city=Tokyo' ) Add segments to this array in your event handler.

- `int` `$idSite` The ID of the site to get segments for.

Usages:

[SegmentEditor::getKnownSegmentsToArchiveForSite](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/SegmentEditor/SegmentEditor.php#L65)

## Site

- [Site.setSite](#sitesetsite)

### Site.setSite
_Defined in [Piwik/Site](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Site.php) in line [117](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Site.php#L117)_

Triggered so plugins can modify website entities without modifying the database. This event should **not** be used to add data that is expensive to compute. If you
need to make HTTP requests or query the database for more information, this is not
the place to do it.

**Example**

    Piwik::addAction('Site.setSite', function ($idSite, &$info) {
        $info['name'] .= " (original)";
    });

Callback Signature:
<pre><code>function($idSite, &amp;$infoSite)</code></pre>

- `int` `$idSite` The ID of the website entity that will be modified.

- `array` `&$infoSite` The website entity. [Learn more.](/guides/persistence-and-the-mysql-backend#websites-aka-sites)

## SitesManager

- [SitesManager.addSite.end](#sitesmanageraddsiteend)
- [SitesManager.deleteSite.end](#sitesmanagerdeletesiteend)

### SitesManager.addSite.end
_Defined in [Piwik/Plugins/SitesManager/API](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/SitesManager/API.php) in line [572](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/SitesManager/API.php#L572)_

Triggered after a site has been added.

Callback Signature:
<pre><code>function($idSite)</code></pre>

- `int` `$idSite` The ID of the site that was added.


### SitesManager.deleteSite.end
_Defined in [Piwik/Plugins/SitesManager/API](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/SitesManager/API.php) in line [627](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/SitesManager/API.php#L627)_

Triggered after a site has been deleted. Plugins can use this event to remove site specific values or settings, such as removing all
goals that belong to a specific website. If you store any data related to a website you
should clean up that information here.

Callback Signature:
<pre><code>function($idSite)</code></pre>

- `int` `$idSite` The ID of the site being deleted.

Usages:

[Goals::deleteSiteGoals](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Goals/Goals.php#L127), [ScheduledReports::deleteSiteReport](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/ScheduledReports/ScheduledReports.php#L112), [UsersManager::deleteSite](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/UsersManager/UsersManager.php#L73)

## TaskScheduler

- [TaskScheduler.getScheduledTasks](#taskschedulergetscheduledtasks)

### TaskScheduler.getScheduledTasks
_Defined in [Piwik/TaskScheduler](https://github.com/piwik/piwik/blob/2.1.1-b7/core/TaskScheduler.php) in line [110](https://github.com/piwik/piwik/blob/2.1.1-b7/core/TaskScheduler.php#L110)_

Triggered during scheduled task execution. Collects all the tasks to run.

Subscribe to this event to schedule code execution on an hourly, daily, weekly or monthly
basis.

**Example**

    public function getScheduledTasks(&$tasks)
    {
        $tasks[] = new ScheduledTask(
            'Piwik\Plugins\CorePluginsAdmin\MarketplaceApiClient',
            'clearAllCacheEntries',
            null,
            ScheduledTime::factory('daily'),
            ScheduledTask::LOWEST_PRIORITY
        );
    }

Callback Signature:
<pre><code>function(&amp;$tasks)</code></pre>

- `[ScheduledTask](/api-reference/Piwik/ScheduledTask)` `&$tasks` List of tasks to run periodically.

Usages:

[CoreAdminHome::getScheduledTasks](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/CoreAdminHome/CoreAdminHome.php#L46), [CorePluginsAdmin::getScheduledTasks](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/CorePluginsAdmin/CorePluginsAdmin.php#L39), [CoreUpdater::getScheduledTasks](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/CoreUpdater/CoreUpdater.php#L48), [DBStats::getScheduledTasks](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/DBStats/DBStats.php#L56), [PrivacyManager::getScheduledTasks](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/PrivacyManager/PrivacyManager.php#L157), [ScheduledReports::getScheduledTasks](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/ScheduledReports/ScheduledReports.php#L472), [UserCountry::getScheduledTasks](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/UserCountry/UserCountry.php#L71)

## Tracker

- [Tracker.Cache.getSiteAttributes](#trackercachegetsiteattributes)
- [Tracker.detectReferrerSearchEngine](#trackerdetectreferrersearchengine)
- [Tracker.existingVisitInformation](#trackerexistingvisitinformation)
- [Tracker.getDatabaseConfig](#trackergetdatabaseconfig)
- [Tracker.getVisitFieldsToPersist](#trackergetvisitfieldstopersist)
- [Tracker.isExcludedVisit](#trackerisexcludedvisit)
- [Tracker.makeNewVisitObject](#trackermakenewvisitobject)
- [Tracker.newConversionInformation](#trackernewconversioninformation)
- [Tracker.newVisitorInformation](#trackernewvisitorinformation)
- [Tracker.recordAction](#trackerrecordaction)
- [Tracker.recordEcommerceGoal](#trackerrecordecommercegoal)
- [Tracker.recordStandardGoals](#trackerrecordstandardgoals)
- [Tracker.Request.getIdSite](#trackerrequestgetidsite)
- [Tracker.setTrackerCacheGeneral](#trackersettrackercachegeneral)
- [Tracker.setVisitorIp](#trackersetvisitorip)

### Tracker.Cache.getSiteAttributes
_Defined in [Piwik/Tracker/Cache](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Tracker/Cache.php) in line [88](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Tracker/Cache.php#L88)_

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

- `array` `&$content` Array mapping of site attribute names with values.

- `int` `$idSite` The site ID to get attributes for.

Usages:

[Goals::fetchGoalsFromDb](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Goals/Goals.php#L468), [SitesManager::recordWebsiteDataInCache](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/SitesManager/SitesManager.php#L70), [UsersManager::recordAdminUsersInCache](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/UsersManager/UsersManager.php#L58)


### Tracker.detectReferrerSearchEngine
_Defined in [Piwik/Tracker/Referrer](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Tracker/Referrer.php) in line [139](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Tracker/Referrer.php#L139)_

Triggered when detecting the search engine of a referrer URL. Plugins can use this event to provide custom search engine detection
logic.

Callback Signature:
<pre><code>function(&amp;$searchEngineInformation, $this-&gt;referrerUrl)</code></pre>

- `array` `&$searchEngineInformation` An array with the following information: - **name**: The search engine name. - **keywords**: The search keywords used. This parameter is initialized to the results of Piwik's default search engine detection logic.

- `string`


### Tracker.existingVisitInformation
_Defined in [Piwik/Tracker/Visit](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Tracker/Visit.php) in line [254](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Tracker/Visit.php#L254)_

Triggered before a [visit entity](/guides/persistence-and-the-mysql-backend#visits) is updated when tracking an action for an existing visit. This event can be used to modify the visit properties that will be updated before the changes
are persisted.

Callback Signature:
<pre><code>function(&amp;$valuesToUpdate, $this-&gt;visitorInfo)</code></pre>

- `array` `&$valuesToUpdate` Visit entity properties that will be updated.

- `array` `$visit` The entire visit entity. Read [this](/guides/persistence-and-the-mysql-backend#visits) to see what it contains.


### Tracker.getDatabaseConfig
_Defined in [Piwik/Tracker](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Tracker.php) in line [535](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Tracker.php#L535)_

Triggered before a connection to the database is established by the Tracker. This event can be used to change the database connection settings used by the Tracker.

Callback Signature:
<pre><code>function(&amp;$configDb)</code></pre>

- `array` `$dbInfos` Reference to an array containing database connection info, including: - **host**: The host name or IP address to the MySQL database. - **username**: The username to use when connecting to the database. - **password**: The password to use when connecting to the database. - **dbname**: The name of the Piwik MySQL database. - **port**: The MySQL database port to use. - **adapter**: either `'PDO_MYSQL'` or `'MYSQLI'` - **type**: The MySQL engine to use, for instance 'InnoDB'


### Tracker.getVisitFieldsToPersist
_Defined in [Piwik/Tracker/Visit](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Tracker/Visit.php) in line [1003](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Tracker/Visit.php#L1003)_

Triggered when checking if the current action being tracked belongs to an existing visit. This event collects a list of [visit entity]() properties that should be loaded when reading
the existing visit. Properties that appear in this list will be available in other tracking
events such as [Tracker.newConversionInformation](/api-reference/hooks#trackernewconversioninformation) and [Tracker.newVisitorInformation](/api-reference/hooks#trackernewvisitorinformation).

Plugins can use this event to load additional visit entity properties for later use during tracking.
When you add fields to this $fields array, they will be later available in Tracker.newConversionInformation

**Example**

    Piwik::addAction('Tracker.getVisitFieldsToPersist', function (&$fields) {
        $fields[] = 'custom_visit_property';
    });

Callback Signature:
<pre><code>function(&amp;$fields)</code></pre>

- `array` `&$fields` The list of visit properties to load.


### Tracker.isExcludedVisit
_Defined in [Piwik/Tracker/VisitExcluded](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Tracker/VisitExcluded.php) in line [82](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Tracker/VisitExcluded.php#L82)_

Triggered on every tracking request. This event can be used to tell the Tracker not to record this particular action or visit.

Callback Signature:
<pre><code>function(&amp;$excluded)</code></pre>

- `bool` `&$excluded` Whether the request should be excluded or not. Initialized to `false`. Event subscribers should set it to `true` in order to exclude the request.


### Tracker.makeNewVisitObject
_Defined in [Piwik/Tracker](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Tracker.php) in line [617](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Tracker.php#L617)_

Triggered before a new **visit tracking object** is created. Subscribers to this
event can force the use of a custom visit tracking object that extends from
Piwik\Tracker\VisitInterface.

Callback Signature:
<pre><code>function(&amp;$visit)</code></pre>

- `\Piwik\Tracker\VisitInterface` `&$visit` Initialized to null, but can be set to a new visit object. If it isn't modified Piwik uses the default class.


### Tracker.newConversionInformation
_Defined in [Piwik/Tracker/GoalManager](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Tracker/GoalManager.php) in line [780](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Tracker/GoalManager.php#L780)_

Triggered before persisting a new [conversion entity](/guides/persistence-and-the-mysql-backend#conversions). This event can be used to modify conversion information or to add new information to be persisted.

Callback Signature:
<pre><code>function(&amp;$conversion, $visitInformation, $this-&gt;request)</code></pre>

- `array` `&$conversion` The conversion entity. Read [this](/guides/persistence-and-the-mysql-backend#conversions) to see what it contains.

- `array` `$visitInformation` The visit entity that we are tracking a conversion for. See what information it contains [here](/guides/persistence-and-the-mysql-backend#visits).

- `\Piwik\Tracker\Request` `$request` An object describing the tracking request being processed.


### Tracker.newVisitorInformation
_Defined in [Piwik/Tracker/Visit](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Tracker/Visit.php) in line [308](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Tracker/Visit.php#L308)_

Triggered before a new [visit entity](/guides/persistence-and-the-mysql-backend#visits) is persisted. This event can be used to modify the visit entity or add new information to it before it is persisted.
The UserCountry plugin, for example, uses this event to add location information for each visit.

Callback Signature:
<pre><code>function(&amp;$this-&gt;visitorInfo, $this-&gt;request)</code></pre>

- `array` `$visit` The visit entity. Read [this](/guides/persistence-and-the-mysql-backend#visits) to see what information it contains.

- `\Piwik\Tracker\Request` `$request` An object describing the tracking request being processed.

Usages:

[DevicesDetection::parseMobileVisitData](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/DevicesDetection/DevicesDetection.php#L258), [Provider::enrichVisitWithProviderInfo](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Provider/Provider.php#L112), [UserCountry::enrichVisitWithLocation](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/UserCountry/UserCountry.php#L89)


### Tracker.recordAction
_Defined in [Piwik/Tracker/Action](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Tracker/Action.php) in line [311](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Tracker/Action.php#L311)_

Triggered after successfully persisting a [visit action entity](/guides/persistence-and-the-mysql-backend#visit-actions).

Callback Signature:
<pre><code>function($trackerAction = $this, $visitAction)</code></pre>

- `Action` `$tracker` Action The Action tracker instance.

- `array` `$visitAction` The visit action entity that was persisted. Read [this](/guides/persistence-and-the-mysql-backend#visit-actions) to see what it contains.


### Tracker.recordEcommerceGoal
_Defined in [Piwik/Tracker/GoalManager](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Tracker/GoalManager.php) in line [386](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Tracker/GoalManager.php#L386)_

Triggered after successfully persisting an ecommerce conversion. _Note: Subscribers should be wary of doing any expensive computation here as it may slow
the tracker down._

Callback Signature:
<pre><code>function($conversion, $visitInformation)</code></pre>

- `array` `$conversion` The conversion entity that was just persisted. See what information it contains [here](/guides/persistence-and-the-mysql-backend#conversions).

- `array` `$visitInformation` The visit entity that we are tracking a conversion for. See what information it contains [here](/guides/persistence-and-the-mysql-backend#visits).


### Tracker.recordStandardGoals
_Defined in [Piwik/Tracker/GoalManager](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Tracker/GoalManager.php) in line [756](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Tracker/GoalManager.php#L756)_

Triggered after successfully recording a non-ecommerce conversion. _Note: Subscribers should be wary of doing any expensive computation here as it may slow
the tracker down._

Callback Signature:
<pre><code>function($conversion)</code></pre>

- `array` `$conversion` The conversion entity that was just persisted. See what information it contains [here](/guides/persistence-and-the-mysql-backend#conversions).


### Tracker.Request.getIdSite
_Defined in [Piwik/Tracker/Request](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Tracker/Request.php) in line [329](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Tracker/Request.php#L329)_

Triggered when obtaining the ID of the site we are tracking a visit for. This event can be used to change the site ID so data is tracked for a different
website.

Callback Signature:
<pre><code>function(&amp;$idSite, $this-&gt;params)</code></pre>

- `int` `&$idSite` Initialized to the value of the **idsite** query parameter. If a subscriber sets this variable, the value it uses must be greater than 0.

- `array` `$params` The entire array of request parameters in the current tracking request.


### Tracker.setTrackerCacheGeneral
_Defined in [Piwik/Tracker/Cache](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Tracker/Cache.php) in line [151](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Tracker/Cache.php#L151)_

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

- `array` `&$cacheContent` Array of cached data. Each piece of data must be mapped by name.

Usages:

[PrivacyManager::setTrackerCacheGeneral](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/PrivacyManager/PrivacyManager.php#L151), [UserCountry::setTrackerCacheGeneral](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/UserCountry/UserCountry.php#L66)


### Tracker.setVisitorIp
_Defined in [Piwik/Tracker/Visit](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Tracker/Visit.php) in line [97](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Tracker/Visit.php#L97)_

Triggered after visits are tested for exclusion so plugins can modify the IP address persisted with a visit. This event is primarily used by the **PrivacyManager** plugin to anonymize IP addresses.

Callback Signature:
<pre><code>function(&amp;$this-&gt;visitorInfo[&#039;location_ip&#039;])</code></pre>

- `string` `$ip` The visitor's IP address.

## Translate

- [Translate.getClientSideTranslationKeys](#translategetclientsidetranslationkeys)

### Translate.getClientSideTranslationKeys
_Defined in [Piwik/Translate](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Translate.php) in line [193](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Translate.php#L193)_

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

- `array` `&$result` The whole list of client side translation keys.

Usages:

[CoreHome::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/CoreHome/CoreHome.php#L125), [CorePluginsAdmin::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/CorePluginsAdmin/CorePluginsAdmin.php#L130), [CoreVisualizations::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/CoreVisualizations/CoreVisualizations.php#L62), [Dashboard::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Dashboard/Dashboard.php#L266), [Feedback::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Feedback/Feedback.php#L59), [Goals::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Goals/Goals.php#L674), [Live::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Live/Live.php#L64), [MultiSites::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/MultiSites/MultiSites.php#L40), [Overlay::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Overlay/Overlay.php#L44), [ScheduledReports::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/ScheduledReports/ScheduledReports.php#L103), [SitesManager::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/SitesManager/SitesManager.php#L209), [Transitions::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Transitions/Transitions.php#L38), [UserCountry::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/UserCountry/UserCountry.php#L488), [UsersManager::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/UsersManager/UsersManager.php#L144), [Widgetize::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Widgetize/Widgetize.php#L60)

## Url

- [Url.filterTrustedHosts](#urlfiltertrustedhosts)

### Url.filterTrustedHosts
_Defined in [Piwik/Url](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Url.php) in line [556](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Url.php#L556)_



Callback Signature:
<pre><code>function(&amp;$trustedHosts)</code></pre>

## User

- [User.getLanguage](#usergetlanguage)
- [User.isNotAuthorized](#userisnotauthorized)

### User.getLanguage
_Defined in [Piwik/Translate](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Translate.php) in line [124](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Translate.php#L124)_

Triggered when the current user's language is requested. By default the current language is determined by the **language** query
parameter. Plugins can override this logic by subscribing to this event.

**Example**

    public function getLanguage(&$lang)
    {
        $client = new My3rdPartyAPIClient();
        $thirdPartyLang = $client->getLanguageForUser(Piwik::getCurrentUserLogin());

        if (!empty($thirdPartyLang)) {
            $lang = $thirdPartyLang;
        }
    }

Callback Signature:
<pre><code>function(&amp;$lang)</code></pre>

- `string` `&$lang` The language that should be used for the current user. Will be initialized to the value of the **language** query parameter.

Usages:

[LanguagesManager::getLanguageToLoad](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/LanguagesManager/LanguagesManager.php#L98)


### User.isNotAuthorized
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/2.1.1-b7/core/FrontController.php) in line [97](https://github.com/piwik/piwik/blob/2.1.1-b7/core/FrontController.php#L97)_

Triggered when a user with insufficient access permissions tries to view some resource. This event can be used to customize the error that occurs when a user is denied access
(for example, displaying an error message, redirecting to a page other than login, etc.).

Callback Signature:
<pre><code>function($exception)</code></pre>

- `[NoAccessException](/api-reference/Piwik/NoAccessException)` `$exception` The exception that was caught.

Usages:

[Login::noAccess](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Login/Login.php#L42)

## UsersManager

- [UsersManager.addUser.end](#usersmanageradduserend)
- [UsersManager.deleteUser](#usersmanagerdeleteuser)
- [UsersManager.updateUser.end](#usersmanagerupdateuserend)

### UsersManager.addUser.end
_Defined in [Piwik/Plugins/UsersManager/API](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/UsersManager/API.php) in line [347](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/UsersManager/API.php#L347)_

Triggered after a new user is created.

Callback Signature:
<pre><code>function($userLogin)</code></pre>

- `string` `$userLogin` The new user's login handle.


### UsersManager.deleteUser
_Defined in [Piwik/Plugins/UsersManager/Model](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/UsersManager/Model.php) in line [255](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/UsersManager/Model.php#L255)_

Triggered after a user has been deleted. This event should be used to clean up any data that is related to the now deleted user.
The **Dashboard** plugin, for example, uses this event to remove the user's dashboards.

Callback Signature:
<pre><code>function($userLogin)</code></pre>

- `string` `$userLogin` The login handle of the deleted user.

Usages:

[CoreAdminHome::cleanupUser](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/CoreAdminHome/CoreAdminHome.php#L41), [Dashboard::deleteDashboardLayout](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Dashboard/Dashboard.php#L245), [LanguagesManager::deleteUserLanguage](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/LanguagesManager/LanguagesManager.php#L108), [ScheduledReports::deleteUserReport](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/ScheduledReports/ScheduledReports.php#L560)


### UsersManager.updateUser.end
_Defined in [Piwik/Plugins/UsersManager/API](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/UsersManager/API.php) in line [447](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/UsersManager/API.php#L447)_

Triggered after an existing user has been updated.

Callback Signature:
<pre><code>function($userLogin)</code></pre>

- `string` `$userLogin` The user's login handle.

## View

- [View.ReportsByDimension.render](#viewreportsbydimensionrender)

### View.ReportsByDimension.render
_Defined in [Piwik/View/ReportsByDimension](https://github.com/piwik/piwik/blob/2.1.1-b7/core/View/ReportsByDimension.php) in line [99](https://github.com/piwik/piwik/blob/2.1.1-b7/core/View/ReportsByDimension.php#L99)_

Triggered before rendering ReportsByDimension views. Plugins can use this event to configure ReportsByDimension instances by
adding or removing reports to display.

Callback Signature:
<pre><code>function($this)</code></pre>

- `ReportsByDimension` `$this` The view instance.

## ViewDataTable

- [ViewDataTable.addViewDataTable](#viewdatatableaddviewdatatable)
- [ViewDataTable.configure](#viewdatatableconfigure)
- [ViewDataTable.getDefaultType](#viewdatatablegetdefaulttype)

### ViewDataTable.addViewDataTable
_Defined in [Piwik/ViewDataTable/Manager](https://github.com/piwik/piwik/blob/2.1.1-b7/core/ViewDataTable/Manager.php) in line [81](https://github.com/piwik/piwik/blob/2.1.1-b7/core/ViewDataTable/Manager.php#L81)_

Triggered when gathering all available DataTable visualizations. Plugins that want to expose new DataTable visualizations should subscribe to
this event and add visualization class names to the incoming array.

**Example**

    public function addViewDataTable(&$visualizations)
    {
        $visualizations[] = 'Piwik\\Plugins\\MyPlugin\\MyVisualization';
    }

Callback Signature:
<pre><code>function(&amp;$visualizations)</code></pre>

- `array` `&$visualizations` The array of all available visualizations.

Usages:

[CoreVisualizations::getAvailableDataTableVisualizations](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/CoreVisualizations/CoreVisualizations.php#L36), [ExampleVisualization::getAvailableVisualizations](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/ExampleVisualization/ExampleVisualization.php#L25), [Goals::getAvailableDataTableVisualizations](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Goals/Goals.php#L119), [Insights::getAvailableVisualizations](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Insights/Insights.php#L30)


### ViewDataTable.configure
_Defined in [Piwik/Plugin/ViewDataTable](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Plugin/ViewDataTable.php) in line [216](https://github.com/piwik/piwik/blob/2.1.1-b7/core/Plugin/ViewDataTable.php#L216)_

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

- `[ViewDataTable](/api-reference/Piwik/Plugin/ViewDataTable)` `$view` The instance to configure.

Usages:

[Actions::configureViewDataTable](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Actions/Actions.php#L539), [CustomVariables::configureViewDataTable](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/CustomVariables/CustomVariables.php#L132), [DBStats::configureViewDataTable](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/DBStats/DBStats.php#L106), [DevicesDetection::configureViewDataTable](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/DevicesDetection/DevicesDetection.php#L283), [Goals::configureViewDataTable](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Goals/Goals.php#L539), [Provider::configureViewDataTable](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Provider/Provider.php#L222), [Referrers::configureViewDataTable](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Referrers/Referrers.php#L300), [UserCountry::configureViewDataTable](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/UserCountry/UserCountry.php#L360), [UserSettings::configureViewDataTable](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/UserSettings/UserSettings.php#L183), [VisitTime::configureViewDataTable](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/VisitTime/VisitTime.php#L132), [VisitorInterest::configureViewDataTable](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/VisitorInterest/VisitorInterest.php#L142)


### ViewDataTable.getDefaultType
_Defined in [Piwik/ViewDataTable/Factory](https://github.com/piwik/piwik/blob/2.1.1-b7/core/ViewDataTable/Factory.php) in line [169](https://github.com/piwik/piwik/blob/2.1.1-b7/core/ViewDataTable/Factory.php#L169)_

Triggered when gathering the default view types for all available reports. If you define your own report, you may want to subscribe to this event to
make sure the correct default Visualization is used (for example, a pie graph,
bar graph, or something else).

If there is no default type associated with a report, the **table** visualization
used.

**Example**

    public function getDefaultTypeViewDataTable(&$defaultViewTypes)
    {
        $defaultViewTypes['Referrers.getSocials']       = HtmlTable::ID;
        $defaultViewTypes['Referrers.getUrlsForSocial'] = Pie::ID;
    }

Callback Signature:
<pre><code>function(&amp;self::$defaultViewTypes)</code></pre>

- `array` `$defaultViewTypes` The array mapping report IDs with visualization IDs.

Usages:

[DBStats::getDefaultTypeViewDataTable](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/DBStats/DBStats.php#L93), [Live::getDefaultTypeViewDataTable](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Live/Live.php#L73), [Referrers::getDefaultTypeViewDataTable](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Referrers/Referrers.php#L294), [UserSettings::getDefaultTypeViewDataTable](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/UserSettings/UserSettings.php#L178), [VisitTime::getDefaultTypeViewDataTable](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/VisitTime/VisitTime.php#L125), [VisitorInterest::getDefaultTypeViewDataTable](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/VisitorInterest/VisitorInterest.php#L136)

## WidgetsList

- [WidgetsList.addWidgets](#widgetslistaddwidgets)

### WidgetsList.addWidgets
_Defined in [Piwik/WidgetsList](https://github.com/piwik/piwik/blob/2.1.1-b7/core/WidgetsList.php) in line [87](https://github.com/piwik/piwik/blob/2.1.1-b7/core/WidgetsList.php#L87)_

Used to collect all available dashboard widgets. Subscribe to this event to make your plugin's reports or other controller actions available
as dashboard widgets. Event handlers should call the [WidgetsList::add()](/api-reference/Piwik/WidgetsList#add) method for each
new dashboard widget.

**Example**

    public function addWidgets()
    {
        WidgetsList::add('General_Actions', 'General_Pages', 'Actions', 'getPageUrls');
    }

Usages:

[Actions::addWidgets](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Actions/Actions.php#L465), [CoreHome::addWidgets](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/CoreHome/CoreHome.php#L34), [CustomVariables::addWidgets](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/CustomVariables/CustomVariables.php#L45), [DevicesDetection::addWidgets](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/DevicesDetection/DevicesDetection.php#L180), [ExampleRssWidget::addWidgets](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/ExampleRssWidget/ExampleRssWidget.php#L34), [Goals::addWidgets](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Goals/Goals.php#L474), [Insights::addWidgets](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Insights/Insights.php#L35), [Live::addWidget](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Live/Live.php#L56), [Provider::addWidget](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Provider/Provider.php#L93), [Referrers::addWidgets](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/Referrers/Referrers.php#L234), [SEO::addWidgets](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/SEO/SEO.php#L41), [UserCountry::addWidgets](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/UserCountry/UserCountry.php#L180), [UserSettings::addWidgets](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/UserSettings/UserSettings.php#L447), [VisitFrequency::addWidgets](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/VisitFrequency/VisitFrequency.php#L58), [VisitTime::addWidgets](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/VisitTime/VisitTime.php#L82), [VisitorInterest::addWidgets](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/VisitorInterest/VisitorInterest.php#L102), [VisitsSummary::addWidgets](https://github.com/piwik/piwik/blob/2.1.1-b7/plugins/VisitsSummary/VisitsSummary.php#L60)

