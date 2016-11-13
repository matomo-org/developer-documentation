Events
==========

This is a complete list of available hooks. If you are not familiar with this read our [Guide about events](/guides/events).

## Actions

- [Actions.Archiving.addActionMetrics](#actionsarchivingaddactionmetrics)

### Actions.Archiving.addActionMetrics

*Defined in [Piwik/Plugins/Actions/Metrics](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Actions/Metrics.php) in line [91](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Actions/Metrics.php#L91)*



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

*Defined in [Piwik/API/Proxy](https://github.com/piwik/piwik/blob/2.x-dev/core/API/Proxy.php) in line [208](https://github.com/piwik/piwik/blob/2.x-dev/core/API/Proxy.php#L208)*

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

*Defined in [Piwik/API/Proxy](https://github.com/piwik/piwik/blob/2.x-dev/core/API/Proxy.php) in line [258](https://github.com/piwik/piwik/blob/2.x-dev/core/API/Proxy.php#L258)*

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

*Defined in [Piwik/API/Proxy](https://github.com/piwik/piwik/blob/2.x-dev/core/API/Proxy.php) in line [503](https://github.com/piwik/piwik/blob/2.x-dev/core/API/Proxy.php#L503)*

This event exists for checking whether a Plugin API class or a Plugin API method tagged with a `@hideXYZ` should be hidden in the API listing.

Callback Signature:
<pre><code>function(&amp;$hide)</code></pre>

- bool `&$hide` whether to hide APIs tagged with $token should be displayed.


### API.getReportMetadata.end

*Defined in [Piwik/Plugins/API/ProcessedReport](https://github.com/piwik/piwik/blob/2.x-dev/plugins/API/ProcessedReport.php) in line [263](https://github.com/piwik/piwik/blob/2.x-dev/plugins/API/ProcessedReport.php#L263)*

Triggered after all available reports are collected. This event can be used to modify the report metadata of reports in other plugins. You
could, for example, add custom metrics to every report or remove reports from the list
of available reports.

Callback Signature:
<pre><code>function(&amp;$availableReports, $parameters)</code></pre>

- array `&$availableReports` List of all report metadata. Read the [API.getReportMetadata](/api-reference/events#apigetreportmetadata) docs to see what this array contains.

- array `$parameters` Contains the values of the sites and period we are getting reports for. Some report depend on this data. For example, Goals reports depend on the site IDs being request. Contains the following information: - **idSites**: The array of site IDs we are getting reports for. - **period**: The period type, eg, `'day'`, `'week'`, `'month'`, `'year'`, `'range'`. - **date**: A string date within the period or a date range, eg, `'2013-01-01'` or `'2012-01-01,2013-01-01'`.

Usages:

[Goals::getReportMetadataEnd](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Goals/Goals.php#L141)


### API.getSegmentDimensionMetadata

*Defined in [Piwik/Plugins/API/API](https://github.com/piwik/piwik/blob/2.x-dev/plugins/API/API.php) in line [191](https://github.com/piwik/piwik/blob/2.x-dev/plugins/API/API.php#L191)*

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

[CustomVariables::getSegmentsMetadata](https://github.com/piwik/piwik/blob/2.x-dev/plugins/CustomVariables/CustomVariables.php#L110)


### API.Request.authenticate

*Defined in [Piwik/API/Request](https://github.com/piwik/piwik/blob/2.x-dev/core/API/Request.php) in line [333](https://github.com/piwik/piwik/blob/2.x-dev/core/API/Request.php#L333)*

Triggered when authenticating an API request, but only if the **token_auth** query parameter is found in the request. Plugins that provide authentication capabilities should subscribe to this event
and make sure the global authentication object (the object returned by `StaticContainer::get('Piwik\Auth')`)
is setup to use `$token_auth` when its `authenticate()` method is executed.

Callback Signature:
<pre><code>function($tokenAuth)</code></pre>

- string `$token_auth` The value of the **token_auth** query parameter.

Usages:

[Login::ApiRequestAuthenticate](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Login/Login.php#L71)


### API.Request.dispatch

*Defined in [Piwik/API/Proxy](https://github.com/piwik/piwik/blob/2.x-dev/core/API/Proxy.php) in line [188](https://github.com/piwik/piwik/blob/2.x-dev/core/API/Proxy.php#L188)*

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

[CustomAlerts::checkApiPermission](https://github.com/piwik/piwik/blob/2.x-dev/plugins/CustomAlerts/CustomAlerts.php#L38)


### API.Request.dispatch.end

*Defined in [Piwik/API/Proxy](https://github.com/piwik/piwik/blob/2.x-dev/core/API/Proxy.php) in line [298](https://github.com/piwik/piwik/blob/2.x-dev/core/API/Proxy.php#L298)*

Triggered directly after an API request is dispatched. This event can be used to modify the output of any API method.

**Example**

    // append (0 hits) to the end of row labels whose row has 0 hits for any report that has the 'nb_hits' metric
    Piwik::addAction('API.Actions.getPageUrls.end', function (&$returnValue, $info)) {
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

*Defined in [Piwik/ArchiveProcessor/Parameters](https://github.com/piwik/piwik/blob/2.x-dev/core/ArchiveProcessor/Parameters.php) in line [109](https://github.com/piwik/piwik/blob/2.x-dev/core/ArchiveProcessor/Parameters.php#L109)*



Callback Signature:
<pre><code>function(&amp;$idSites, $this-&gt;getPeriod())</code></pre>

## Archiving

- [Archiving.getIdSitesToArchiveWhenNoVisits](#archivinggetidsitestoarchivewhennovisits)
- [Archiving.makeNewArchiverObject](#archivingmakenewarchiverobject)

### Archiving.getIdSitesToArchiveWhenNoVisits

*Defined in [Piwik/ArchiveProcessor/Loader](https://github.com/piwik/piwik/blob/2.x-dev/core/ArchiveProcessor/Loader.php) in line [246](https://github.com/piwik/piwik/blob/2.x-dev/core/ArchiveProcessor/Loader.php#L246)*



Callback Signature:
<pre><code>function(&amp;$idSites)</code></pre>


### Archiving.makeNewArchiverObject

*Defined in [Piwik/ArchiveProcessor/PluginsArchiver](https://github.com/piwik/piwik/blob/2.x-dev/core/ArchiveProcessor/PluginsArchiver.php) in line [261](https://github.com/piwik/piwik/blob/2.x-dev/core/ArchiveProcessor/PluginsArchiver.php#L261)*

Triggered right after a new **plugin archiver instance** is created. Subscribers to this event can configure the plugin archiver, for example prevent the archiving of a plugin's data
by calling `$archiver->disable()` method.

Callback Signature:
<pre><code>function($archiver, $pluginName, $this-&gt;params, $this-&gt;isTemporaryArchive)</code></pre>

- [Archiver](/api-reference/Piwik/Plugin/Archiver) `$archiver` The newly created plugin archiver instance.

- string `$pluginName` The name of plugin of which archiver instance was created.

- array `$this-&gt;params` Array containing archive parameters (Site, Period, Date and Segment)

- bool `$this-&gt;isTemporaryArchive` Flag indicating whether the archive being processed is temporary (ie. the period isn't finished yet) or final (the period is already finished and in the past).

## AssetManager

- [AssetManager.filterMergedJavaScripts](#assetmanagerfiltermergedjavascripts)
- [AssetManager.filterMergedJavaScripts](#assetmanagerfiltermergedjavascripts)
- [AssetManager.filterMergedJavaScripts](#assetmanagerfiltermergedjavascripts)
- [AssetManager.filterMergedStylesheets](#assetmanagerfiltermergedstylesheets)
- [AssetManager.getJavaScriptFiles](#assetmanagergetjavascriptfiles)
- [AssetManager.getStylesheetFiles](#assetmanagergetstylesheetfiles)

### AssetManager.filterMergedJavaScripts

*Defined in [Piwik/Plugins/CoreHome/tests/Integration/CoreHomeTest](https://github.com/piwik/piwik/blob/2.x-dev/plugins/CoreHome/tests/Integration/CoreHomeTest.php) in line [25](https://github.com/piwik/piwik/blob/2.x-dev/plugins/CoreHome/tests/Integration/CoreHomeTest.php#L25)*



Callback Signature:
<pre><code>function(&amp;$content)</code></pre>

Usages:

[CoreHome::filterMergedJavaScripts](https://github.com/piwik/piwik/blob/2.x-dev/plugins/CoreHome/CoreHome.php#L30)


### AssetManager.filterMergedJavaScripts

*Defined in [Piwik/Plugins/CoreHome/tests/Integration/CoreHomeTest](https://github.com/piwik/piwik/blob/2.x-dev/plugins/CoreHome/tests/Integration/CoreHomeTest.php) in line [33](https://github.com/piwik/piwik/blob/2.x-dev/plugins/CoreHome/tests/Integration/CoreHomeTest.php#L33)*



Callback Signature:
<pre><code>function(&amp;$content)</code></pre>

Usages:

[CoreHome::filterMergedJavaScripts](https://github.com/piwik/piwik/blob/2.x-dev/plugins/CoreHome/CoreHome.php#L30)


### AssetManager.filterMergedJavaScripts

*Defined in [Piwik/AssetManager/UIAssetMerger/JScriptUIAssetMerger](https://github.com/piwik/piwik/blob/2.x-dev/core/AssetManager/UIAssetMerger/JScriptUIAssetMerger.php) in line [69](https://github.com/piwik/piwik/blob/2.x-dev/core/AssetManager/UIAssetMerger/JScriptUIAssetMerger.php#L69)*

Triggered after all the JavaScript files Piwik uses are minified and merged into a single file, but before the merged JavaScript is written to disk. Plugins can use this event to modify merged JavaScript or do something else
with it.

Callback Signature:
<pre><code>function(&amp;$mergedContent)</code></pre>

- string `&$mergedContent` The minified and merged JavaScript.

Usages:

[CoreHome::filterMergedJavaScripts](https://github.com/piwik/piwik/blob/2.x-dev/plugins/CoreHome/CoreHome.php#L30)


### AssetManager.filterMergedStylesheets

*Defined in [Piwik/AssetManager/UIAssetMerger/StylesheetUIAssetMerger](https://github.com/piwik/piwik/blob/2.x-dev/core/AssetManager/UIAssetMerger/StylesheetUIAssetMerger.php) in line [74](https://github.com/piwik/piwik/blob/2.x-dev/core/AssetManager/UIAssetMerger/StylesheetUIAssetMerger.php#L74)*

Triggered after all less stylesheets are compiled to CSS, minified and merged into one file, but before the generated CSS is written to disk. This event can be used to modify merged CSS.

Callback Signature:
<pre><code>function(&amp;$mergedContent)</code></pre>

- string `&$mergedContent` The merged and minified CSS.


### AssetManager.getJavaScriptFiles

*Defined in [Piwik/AssetManager/UIAssetFetcher/JScriptUIAssetFetcher](https://github.com/piwik/piwik/blob/2.x-dev/core/AssetManager/UIAssetFetcher/JScriptUIAssetFetcher.php) in line [45](https://github.com/piwik/piwik/blob/2.x-dev/core/AssetManager/UIAssetFetcher/JScriptUIAssetFetcher.php#L45)*

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

[Actions::getJsFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Actions/Actions.php#L104), [Annotations::getJsFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Annotations/Annotations.php#L46), [Contents::getJsFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Contents/Contents.php#L35), [CoreAdminHome::getJsFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/CoreAdminHome/CoreAdminHome.php#L49), [CoreHome::getJsFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/CoreHome/CoreHome.php#L82), [CorePluginsAdmin::getJsFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/CorePluginsAdmin/CorePluginsAdmin.php#L38), [CoreVisualizations::getJsFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/CoreVisualizations/CoreVisualizations.php#L47), [CustomAlerts::getJavaScriptFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/CustomAlerts/CustomAlerts.php#L73), [CustomVariables::getJsFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/CustomVariables/CustomVariables.php#L174), [Dashboard::getJsFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Dashboard/Dashboard.php#L208), [Feedback::getJsFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Feedback/Feedback.php#L35), [Goals::getJsFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Goals/Goals.php#L247), [Insights::getJsFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Insights/Insights.php#L31), [LanguagesManager::getJsFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/LanguagesManager/LanguagesManager.php#L53), [Live::getJsFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Live/Live.php#L37), [Login::getJsFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Login/Login.php#L40), [Marketplace::getJsFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Marketplace/Marketplace.php#L33), [MobileMessaging::getJsFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/MobileMessaging/MobileMessaging.php#L87), [MultiSites::getJsFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/MultiSites/MultiSites.php#L71), [Overlay::getJsFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Overlay/Overlay.php#L29), [PrivacyManager::getJsFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/PrivacyManager/PrivacyManager.php#L153), [ScheduledReports::getJsFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/ScheduledReports/ScheduledReports.php#L129), [SegmentEditor::getJsFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/SegmentEditor/SegmentEditor.php#L68), [SitesManager::getJsFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/SitesManager/SitesManager.php#L92), [Transitions::getJsFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Transitions/Transitions.php#L33), [TreemapVisualization::getJsFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/TreemapVisualization/TreemapVisualization.php#L61), [UserCountry::getJsFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/UserCountry/UserCountry.php#L76), [UserCountryMap::getJsFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/UserCountryMap/UserCountryMap.php#L53), [UserId::getJavaScriptFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/UserId/UserId.php#L39), [UsersManager::getJsFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/UsersManager/UsersManager.php#L92), [Widgetize::getJsFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Widgetize/Widgetize.php#L27)


### AssetManager.getStylesheetFiles

*Defined in [Piwik/AssetManager/UIAssetFetcher/StylesheetUIAssetFetcher](https://github.com/piwik/piwik/blob/2.x-dev/core/AssetManager/UIAssetFetcher/StylesheetUIAssetFetcher.php) in line [66](https://github.com/piwik/piwik/blob/2.x-dev/core/AssetManager/UIAssetFetcher/StylesheetUIAssetFetcher.php#L66)*

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

[Plugin::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/API/API.php#L750), [Actions::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Actions/Actions.php#L99), [Annotations::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Annotations/Annotations.php#L38), [Contents::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Contents/Contents.php#L40), [CoreAdminHome::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/CoreAdminHome/CoreAdminHome.php#L41), [CoreHome::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/CoreHome/CoreHome.php#L54), [CorePluginsAdmin::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/CorePluginsAdmin/CorePluginsAdmin.php#L28), [CoreVisualizations::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/CoreVisualizations/CoreVisualizations.php#L41), [CustomAlerts::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/CustomAlerts/CustomAlerts.php#L78), [CustomVariables::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/CustomVariables/CustomVariables.php#L169), [DBStats::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/DBStats/DBStats.php#L31), [Dashboard::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Dashboard/Dashboard.php#L217), [Diagnostics::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Diagnostics/Diagnostics.php#L25), [Events::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Events/Events.php#L263), [ExampleRssWidget::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/ExampleRssWidget/ExampleRssWidget.php#L26), [Feedback::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Feedback/Feedback.php#L29), [Goals::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Goals/Goals.php#L252), [Insights::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Insights/Insights.php#L26), [Installation::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Installation/Installation.php#L117), [LanguagesManager::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/LanguagesManager/LanguagesManager.php#L48), [Live::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Live/Live.php#L31), [Login::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Login/Login.php#L45), [Marketplace::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Marketplace/Marketplace.php#L27), [MobileMessaging::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/MobileMessaging/MobileMessaging.php#L92), [MultiSites::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/MultiSites/MultiSites.php#L80), [ProfessionalServices::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/ProfessionalServices/ProfessionalServices.php#L24), [ScheduledReports::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/ScheduledReports/ScheduledReports.php#L134), [SegmentEditor::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/SegmentEditor/SegmentEditor.php#L73), [SitesManager::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/SitesManager/SitesManager.php#L83), [Transitions::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Transitions/Transitions.php#L28), [TreemapVisualization::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/TreemapVisualization/TreemapVisualization.php#L55), [UserCountry::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/UserCountry/UserCountry.php#L71), [UserCountryMap::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/UserCountryMap/UserCountryMap.php#L64), [UsersManager::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/UsersManager/UsersManager.php#L102), [VisitsSummary::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/VisitsSummary/VisitsSummary.php#L68), [Widgetize::getStylesheetFiles](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Widgetize/Widgetize.php#L39)

## Config

- [Config.badConfigurationFile](#configbadconfigurationfile)
- [Config.NoConfigurationFile](#confignoconfigurationfile)

### Config.badConfigurationFile

*Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/2.x-dev/core/FrontController.php) in line [291](https://github.com/piwik/piwik/blob/2.x-dev/core/FrontController.php#L291)*

Triggered when Piwik cannot access database data. This event can be used to start the installation process or to display a custom error
message.

Callback Signature:
<pre><code>function($exception)</code></pre>

- [Exception](http://php.net/class.Exception) `$exception` The exception thrown from trying to get an option value.

Usages:

[Installation::dispatch](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Installation/Installation.php#L95)


### Config.NoConfigurationFile

*Defined in [Piwik/Application/Kernel/EnvironmentValidator](https://github.com/piwik/piwik/blob/2.x-dev/core/Application/Kernel/EnvironmentValidator.php) in line [102](https://github.com/piwik/piwik/blob/2.x-dev/core/Application/Kernel/EnvironmentValidator.php#L102)*

Triggered when the configuration file cannot be found or read, which usually means Piwik is not installed yet. This event can be used to start the installation process or to display a custom error message.

Callback Signature:
<pre><code>function($exception)</code></pre>

- [\Exception](http://php.net/class.\Exception) `$exception` The exception that was thrown by `Config::getInstance()`.

Usages:

[Installation::dispatch](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Installation/Installation.php#L95), [LanguagesManager::initLanguage](https://github.com/piwik/piwik/blob/2.x-dev/plugins/LanguagesManager/LanguagesManager.php#L99)

## Console

- [Console.filterCommands](#consolefiltercommands)

### Console.filterCommands

*Defined in [Piwik/Console](https://github.com/piwik/piwik/blob/2.x-dev/core/Console.php) in line [128](https://github.com/piwik/piwik/blob/2.x-dev/core/Console.php#L128)*

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

*Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/2.x-dev/core/FrontController.php) in line [510](https://github.com/piwik/piwik/blob/2.x-dev/core/FrontController.php#L510)*

Triggered directly before controller actions are dispatched. This event exists for convenience and is triggered directly after the [Request.dispatch](/api-reference/events#requestdispatch)
event is triggered.

It can be used to do the same things as the [Request.dispatch](/api-reference/events#requestdispatch) event, but for one controller
action only. Using this event will result in a little less code than [Request.dispatch](/api-reference/events#requestdispatch).

Callback Signature:
<pre><code>function(&amp;$parameters)</code></pre>

- array `&$parameters` The arguments passed to the controller action.


### Controller.$module.$action.end

*Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/2.x-dev/core/FrontController.php) in line [527](https://github.com/piwik/piwik/blob/2.x-dev/core/FrontController.php#L527)*

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

*Defined in [Piwik/Updater](https://github.com/piwik/piwik/blob/2.x-dev/core/Updater.php) in line [489](https://github.com/piwik/piwik/blob/2.x-dev/core/Updater.php#L489)*

Triggered after Piwik has been updated.

Usages:

[CustomPiwikJs::updateTracker](https://github.com/piwik/piwik/blob/2.x-dev/plugins/CustomPiwikJs/CustomPiwikJs.php#L30)

## CronArchive

- [CronArchive.archiveSingleSite.finish](#cronarchivearchivesinglesitefinish)
- [CronArchive.archiveSingleSite.start](#cronarchivearchivesinglesitestart)
- [CronArchive.end](#cronarchiveend)
- [CronArchive.filterWebsiteIds](#cronarchivefilterwebsiteids)
- [CronArchive.getIdSitesNotUsingTracker](#cronarchivegetidsitesnotusingtracker)
- [CronArchive.init.finish](#cronarchiveinitfinish)
- [CronArchive.init.start](#cronarchiveinitstart)

### CronArchive.archiveSingleSite.finish

*Defined in [Piwik/CronArchive](https://github.com/piwik/piwik/blob/2.x-dev/core/CronArchive.php) in line [422](https://github.com/piwik/piwik/blob/2.x-dev/core/CronArchive.php#L422)*

This event is triggered immediately after the cron archiving process starts archiving data for a single site.

Callback Signature:
<pre><code>function($idSite, $completed)</code></pre>

- int `$idSite` The ID of the site we're archiving data for.


### CronArchive.archiveSingleSite.start

*Defined in [Piwik/CronArchive](https://github.com/piwik/piwik/blob/2.x-dev/core/CronArchive.php) in line [412](https://github.com/piwik/piwik/blob/2.x-dev/core/CronArchive.php#L412)*

This event is triggered before the cron archiving process starts archiving data for a single site.

Callback Signature:
<pre><code>function($idSite)</code></pre>

- int `$idSite` The ID of the site we're archiving data for.


### CronArchive.end

*Defined in [Piwik/CronArchive](https://github.com/piwik/piwik/blob/2.x-dev/core/CronArchive.php) in line [474](https://github.com/piwik/piwik/blob/2.x-dev/core/CronArchive.php#L474)*

This event is triggered after archiving.

Callback Signature:
<pre><code>function($this)</code></pre>

- CronArchive `$this` 

Usages:

[CustomPiwikJs::updateTracker](https://github.com/piwik/piwik/blob/2.x-dev/plugins/CustomPiwikJs/CustomPiwikJs.php#L30)


### CronArchive.filterWebsiteIds

*Defined in [Piwik/CronArchive](https://github.com/piwik/piwik/blob/2.x-dev/core/CronArchive.php) in line [1075](https://github.com/piwik/piwik/blob/2.x-dev/core/CronArchive.php#L1075)*

Triggered by the **core:archive** console command so plugins can modify the list of websites that the archiving process will be launched for. Plugins can use this hook to add websites to archive, remove websites to archive, or change
the order in which websites will be archived.

Callback Signature:
<pre><code>function(&amp;$websiteIds)</code></pre>

- array `&$websiteIds` The list of website IDs to launch the archiving process for.


### CronArchive.getIdSitesNotUsingTracker

*Defined in [Piwik/CronArchive](https://github.com/piwik/piwik/blob/2.x-dev/core/CronArchive.php) in line [1463](https://github.com/piwik/piwik/blob/2.x-dev/core/CronArchive.php#L1463)*

This event is triggered when detecting whether there are sites that do not use the tracker. By default we only archive a site when there was actually any visit since the last archiving.
However, some plugins do import data from another source instead of using the tracker and therefore
will never have any visits for this site. To make sure we still archive data for such a site when
archiving for this site is requested, you can listen to this event and add the idSite to the list of
sites that do not use the tracker.

Callback Signature:
<pre><code>function(&amp;$this-&gt;idSitesNotUsingTracker)</code></pre>

- bool `$idSitesNotUsingTracker` The list of idSites that rather import data instead of using the tracker


### CronArchive.init.finish

*Defined in [Piwik/CronArchive](https://github.com/piwik/piwik/blob/2.x-dev/core/CronArchive.php) in line [344](https://github.com/piwik/piwik/blob/2.x-dev/core/CronArchive.php#L344)*

This event is triggered after a CronArchive instance is initialized.

Callback Signature:
<pre><code>function($this-&gt;websites-&gt;getInitialSiteIds())</code></pre>

- array `$websiteIds` The list of website IDs this CronArchive instance is processing. This will be the entire list of IDs regardless of whether some have already been processed.


### CronArchive.init.start

*Defined in [Piwik/CronArchive](https://github.com/piwik/piwik/blob/2.x-dev/core/CronArchive.php) in line [302](https://github.com/piwik/piwik/blob/2.x-dev/core/CronArchive.php#L302)*

This event is triggered during initializing archiving.

Callback Signature:
<pre><code>function($this)</code></pre>

- CronArchive `$this` 

## Dashboard

- [Dashboard.changeDefaultDashboardLayout](#dashboardchangedefaultdashboardlayout)

### Dashboard.changeDefaultDashboardLayout

*Defined in [Piwik/Plugins/Dashboard/Dashboard](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Dashboard/Dashboard.php) in line [106](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Dashboard/Dashboard.php#L106)*

Allows other plugins to modify the default dashboard layout.

Callback Signature:
<pre><code>function(&amp;$defaultLayout)</code></pre>

- string `&$defaultLayout` JSON encoded string of the default dashboard layout. Contains an array of columns where each column is an array of widgets. Each widget is an associative array w/ the following elements: * **uniqueId**: The widget's unique ID. * **parameters**: The array of query parameters that should be used to get this widget's report.

## Db

- [Db.cannotConnectToDb](#dbcannotconnecttodb)
- [Db.getDatabaseConfig](#dbgetdatabaseconfig)

### Db.cannotConnectToDb

*Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/2.x-dev/core/FrontController.php) in line [268](https://github.com/piwik/piwik/blob/2.x-dev/core/FrontController.php#L268)*

Triggered when Piwik cannot connect to the database. This event can be used to start the installation process or to display a custom error
message.

Callback Signature:
<pre><code>function($exception)</code></pre>

- [Exception](http://php.net/class.Exception) `$exception` The exception thrown from creating and testing the database connection.

Usages:

[Installation::displayDbConnectionMessage](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Installation/Installation.php#L41)


### Db.getDatabaseConfig

*Defined in [Piwik/Db](https://github.com/piwik/piwik/blob/2.x-dev/core/Db.php) in line [92](https://github.com/piwik/piwik/blob/2.x-dev/core/Db.php#L92)*

Triggered before a database connection is established. This event can be used to change the settings used to establish a connection.

Callback Signature:
<pre><code>function(&amp;$dbConfig)</code></pre>

- array

## Environment

- [Environment.bootstrapped](#environmentbootstrapped)

### Environment.bootstrapped

*Defined in [Piwik/Application/Environment](https://github.com/piwik/piwik/blob/2.x-dev/core/Application/Environment.php) in line [98](https://github.com/piwik/piwik/blob/2.x-dev/core/Application/Environment.php#L98)*



## FrontController

- [FrontController.modifyErrorPage](#frontcontrollermodifyerrorpage)

### FrontController.modifyErrorPage

*Defined in [Piwik/ExceptionHandler](https://github.com/piwik/piwik/blob/2.x-dev/core/ExceptionHandler.php) in line [123](https://github.com/piwik/piwik/blob/2.x-dev/core/ExceptionHandler.php#L123)*

Triggered before a Piwik error page is displayed to the user. This event can be used to modify the content of the error page that is displayed when
an exception is caught.

Callback Signature:
<pre><code>function(&amp;$result, $ex)</code></pre>

- string `&$result` The HTML of the error page.

- [Exception](http://php.net/class.Exception) `$ex` The Exception displayed in the error page.

## Goals

- [Goals.getReportsWithGoalMetrics](#goalsgetreportswithgoalmetrics)

### Goals.getReportsWithGoalMetrics

*Defined in [Piwik/Plugins/Goals/Goals](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Goals/Goals.php) in line [218](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Goals/Goals.php#L218)*

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

[Goals::getActualReportsWithGoalMetrics](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Goals/Goals.php#L228)

## Insights

- [Insights.addReportToOverview](#insightsaddreporttooverview)

### Insights.addReportToOverview

*Defined in [Piwik/Plugins/Insights/API](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Insights/API.php) in line [67](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Insights/API.php#L67)*

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

[Actions::addReportToInsightsOverview](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Actions/Actions.php#L92), [Referrers::addReportToInsightsOverview](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Referrers/Referrers.php#L68), [UserCountry::addReportToInsightsOverview](https://github.com/piwik/piwik/blob/2.x-dev/plugins/UserCountry/UserCountry.php#L61)

## Installation

- [Installation.defaultSettingsForm.init](#installationdefaultsettingsforminit)
- [Installation.defaultSettingsForm.submit](#installationdefaultsettingsformsubmit)

### Installation.defaultSettingsForm.init

*Defined in [Piwik/Plugins/Installation/Controller](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Installation/Controller.php) in line [406](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Installation/Controller.php#L406)*

Triggered on initialization of the form to customize default Piwik settings (at the end of the installation process).

Callback Signature:
<pre><code>function($form)</code></pre>

- \Piwik\Plugins\Installation\FormDefaultSettings `$form` 

Usages:

[PrivacyManager::installationFormInit](https://github.com/piwik/piwik/blob/2.x-dev/plugins/PrivacyManager/PrivacyManager.php#L163)


### Installation.defaultSettingsForm.submit

*Defined in [Piwik/Plugins/Installation/Controller](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Installation/Controller.php) in line [417](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Installation/Controller.php#L417)*

Triggered on submission of the form to customize default Piwik settings (at the end of the installation process).

Callback Signature:
<pre><code>function($form)</code></pre>

- \Piwik\Plugins\Installation\FormDefaultSettings `$form` 

Usages:

[PrivacyManager::installationFormSubmit](https://github.com/piwik/piwik/blob/2.x-dev/plugins/PrivacyManager/PrivacyManager.php#L186)

## LanguageManager

- [LanguageManager.getAvailableLanguages](#languagemanagergetavailablelanguages)

### LanguageManager.getAvailableLanguages

*Defined in [Piwik/Plugins/LanguagesManager/API](https://github.com/piwik/piwik/blob/2.x-dev/plugins/LanguagesManager/API.php) in line [80](https://github.com/piwik/piwik/blob/2.x-dev/plugins/LanguagesManager/API.php#L80)*

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

*Defined in [Piwik/Plugins/Live/Model](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Live/Model.php) in line [300](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Live/Model.php#L300)*



Callback Signature:
<pre><code>function(&amp;$idSites)</code></pre>


### Live.getAllVisitorDetails

*Defined in [Piwik/Plugins/Live/Visitor](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Live/Visitor.php) in line [74](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Live/Visitor.php#L74)*

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

[Actions::extendVisitorDetails](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Actions/Actions.php#L43), [CoreHome::extendVisitorDetails](https://github.com/piwik/piwik/blob/2.x-dev/plugins/CoreHome/CoreHome.php#L35), [CustomVariables::extendVisitorDetails](https://github.com/piwik/piwik/blob/2.x-dev/plugins/CustomVariables/CustomVariables.php#L42), [DevicePlugins::extendVisitorDetails](https://github.com/piwik/piwik/blob/2.x-dev/plugins/DevicePlugins/DevicePlugins.php#L32), [DevicesDetection::extendVisitorDetails](https://github.com/piwik/piwik/blob/2.x-dev/plugins/DevicesDetection/DevicesDetection.php#L30), [Events::extendVisitorDetails](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Events/Events.php#L34), [Provider::extendVisitorDetails](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Provider/Provider.php#L45), [Referrers::extendVisitorDetails](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Referrers/Referrers.php#L54), [Resolution::extendVisitorDetails](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Resolution/Resolution.php#L30), [UserCountry::extendVisitorDetails](https://github.com/piwik/piwik/blob/2.x-dev/plugins/UserCountry/UserCountry.php#L44), [UserLanguage::extendVisitorDetails](https://github.com/piwik/piwik/blob/2.x-dev/plugins/UserLanguage/UserLanguage.php#L30), [VisitTime::extendVisitorDetails](https://github.com/piwik/piwik/blob/2.x-dev/plugins/VisitTime/VisitTime.php#L24), [VisitorInterest::extendVisitorDetails](https://github.com/piwik/piwik/blob/2.x-dev/plugins/VisitorInterest/VisitorInterest.php#L41)


### Live.getExtraVisitorDetails

*Defined in [Piwik/Plugins/Live/API](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Live/API.php) in line [247](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Live/API.php#L247)*

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

*Defined in [Piwik/Plugins/Live/VisitorFactory](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Live/VisitorFactory.php) in line [39](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Live/VisitorFactory.php#L39)*

Triggered while visit is filtering in live plugin. Subscribers to this
event can force the use of a custom visitor object that extends from
Piwik\Plugins\Live\VisitorInterface.

Callback Signature:
<pre><code>function(&amp;$visitor, $visitorRawData)</code></pre>

- \Piwik\Plugins\Live\VisitorInterface `&$visitor` Initialized to null, but can be set to a new visitor object. If it isn't modified Piwik uses the default class.

- array `$visitorRawData` Raw data using in Visitor object constructor.

## Login

- [Login.authenticate](#loginauthenticate)
- [Login.authenticate.failed](#loginauthenticatefailed)
- [Login.authenticate.successful](#loginauthenticatesuccessful)
- [Login.initSession.end](#logininitsessionend)
- [Login.logout](#loginlogout)

### Login.authenticate

*Defined in [Piwik/Plugins/Login/SessionInitializer](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Login/SessionInitializer.php) in line [157](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Login/SessionInitializer.php#L157)*



Callback Signature:
<pre><code>function($auth-&gt;getLogin(), $tokenAuth)</code></pre>


### Login.authenticate.failed

*Defined in [Piwik/Plugins/Login/SessionInitializer](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Login/SessionInitializer.php) in line [118](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Login/SessionInitializer.php#L118)*



Callback Signature:
<pre><code>function($auth-&gt;getLogin())</code></pre>


### Login.authenticate.successful

*Defined in [Piwik/Plugins/Login/SessionInitializer](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Login/SessionInitializer.php) in line [210](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Login/SessionInitializer.php#L210)*



Callback Signature:
<pre><code>function($authResult-&gt;getIdentity(), $authResult-&gt;getTokenAuth())</code></pre>


### Login.initSession.end

*Defined in [Piwik/Plugins/Login/SessionInitializer](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Login/SessionInitializer.php) in line [128](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Login/SessionInitializer.php#L128)*




### Login.logout

*Defined in [Piwik/Plugins/Login/Controller](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Login/Controller.php) in line [364](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Login/Controller.php#L364)*



Callback Signature:
<pre><code>function(Piwik::getCurrentUserLogin())</code></pre>

## Measurable

- [Measurable.beforeSaveSettings](#measurablebeforesavesettings)
- [Measurable.initMeasurableSettings](#measurableinitmeasurablesettings)

### Measurable.beforeSaveSettings

*Defined in [Piwik/Measurable/MeasurableSettings](https://github.com/piwik/piwik/blob/2.x-dev/core/Measurable/MeasurableSettings.php) in line [97](https://github.com/piwik/piwik/blob/2.x-dev/core/Measurable/MeasurableSettings.php#L97)*

Triggered just before Measurable settings are about to be saved. You can use this event for example
to validate not only one setting but multiple ssetting. For example whether username
and password matches.

Callback Signature:
<pre><code>function($this, $type, $this-&gt;idSite)</code></pre>

- MeasurableSettings `$this` 

- \Piwik\Measurable\Type `$type` 

- int `$idSite` 


### Measurable.initMeasurableSettings

*Defined in [Piwik/Measurable/MeasurableSettings](https://github.com/piwik/piwik/blob/2.x-dev/core/Measurable/MeasurableSettings.php) in line [66](https://github.com/piwik/piwik/blob/2.x-dev/core/Measurable/MeasurableSettings.php#L66)*

This event is posted when generating settings for a Measurable (website). You can add any Measurable settings
that you wish to be shown in the Measurable manager (websites manager). If you need to add settings only for
eg MobileApp measurables you can use eg `$type->getId() === Piwik\Plugins\MobileAppMeasurable\Type::ID` and
add only settings if the condition is true.

Callback Signature:
<pre><code>function($this, $type, $this-&gt;idSite)</code></pre>

- MeasurableSettings `$this` 

- \Piwik\Measurable\Type `$type` 

- int `$idSite` 

## Menu

- [Menu.Admin.addItems](#menuadminadditems)
- [Menu.Reporting.addItems](#menureportingadditems)
- [Menu.Top.addItems](#menutopadditems)

### Menu.Admin.addItems

*Defined in [Piwik/Menu/MenuAdmin](https://github.com/piwik/piwik/blob/2.x-dev/core/Menu/MenuAdmin.php) in line [118](https://github.com/piwik/piwik/blob/2.x-dev/core/Menu/MenuAdmin.php#L118)*



Callback Signature:
<pre><code>function()</code></pre>


### Menu.Reporting.addItems

*Defined in [Piwik/Menu/MenuReporting](https://github.com/piwik/piwik/blob/2.x-dev/core/Menu/MenuReporting.php) in line [128](https://github.com/piwik/piwik/blob/2.x-dev/core/Menu/MenuReporting.php#L128)*



Callback Signature:
<pre><code>function()</code></pre>


### Menu.Top.addItems

*Defined in [Piwik/Menu/MenuTop](https://github.com/piwik/piwik/blob/2.x-dev/core/Menu/MenuTop.php) in line [71](https://github.com/piwik/piwik/blob/2.x-dev/core/Menu/MenuTop.php#L71)*



Callback Signature:
<pre><code>function()</code></pre>

## Metrics

- [Metrics.getDefaultMetricDocumentationTranslations](#metricsgetdefaultmetricdocumentationtranslations)
- [Metrics.getDefaultMetricTranslations](#metricsgetdefaultmetrictranslations)

### Metrics.getDefaultMetricDocumentationTranslations

*Defined in [Piwik/Metrics](https://github.com/piwik/piwik/blob/2.x-dev/core/Metrics.php) in line [417](https://github.com/piwik/piwik/blob/2.x-dev/core/Metrics.php#L417)*

Use this event to register translations for metrics documentation processed by your plugin.

Callback Signature:
<pre><code>function(&amp;$translations)</code></pre>

- string `&$translations` The array mapping of column_name => Plugin_TranslationForColumnDocumentation

Usages:

[Actions::addMetricDocumentationTranslations](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Actions/Actions.php#L72), [Contents::addMetricDocumentationTranslations](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Contents/Contents.php#L45), [Events::addMetricDocumentationTranslations](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Events/Events.php#L44)


### Metrics.getDefaultMetricTranslations

*Defined in [Piwik/Metrics](https://github.com/piwik/piwik/blob/2.x-dev/core/Metrics.php) in line [305](https://github.com/piwik/piwik/blob/2.x-dev/core/Metrics.php#L305)*

Use this event to register translations for metrics processed by your plugin.

Callback Signature:
<pre><code>function(&amp;$translations)</code></pre>

- string `&$translations` The array mapping of column_name => Plugin_TranslationForColumn

Usages:

[Actions::addMetricTranslations](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Actions/Actions.php#L49), [Contents::addMetricTranslations](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Contents/Contents.php#L28), [DevicePlugins::addMetricTranslations](https://github.com/piwik/piwik/blob/2.x-dev/plugins/DevicePlugins/DevicePlugins.php#L40), [Events::addMetricTranslations](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Events/Events.php#L39), [Goals::addMetricTranslations](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Goals/Goals.php#L104), [MultiSites::addMetricTranslations](https://github.com/piwik/piwik/blob/2.x-dev/plugins/MultiSites/MultiSites.php#L28), [VisitFrequency::addMetricTranslations](https://github.com/piwik/piwik/blob/2.x-dev/plugins/VisitFrequency/VisitFrequency.php#L26)

## MobileMessaging

- [MobileMessaging.deletePhoneNumber](#mobilemessagingdeletephonenumber)

### MobileMessaging.deletePhoneNumber

*Defined in [Piwik/Plugins/MobileMessaging/API](https://github.com/piwik/piwik/blob/2.x-dev/plugins/MobileMessaging/API.php) in line [211](https://github.com/piwik/piwik/blob/2.x-dev/plugins/MobileMessaging/API.php#L211)*

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

[CustomAlerts::removePhoneNumberFromAllAlerts](https://github.com/piwik/piwik/blob/2.x-dev/plugins/CustomAlerts/CustomAlerts.php#L114), [ScheduledReports::deletePhoneNumber](https://github.com/piwik/piwik/blob/2.x-dev/plugins/ScheduledReports/ScheduledReports.php#L445)

## Piwik

- [Piwik.getJavascriptCode](#piwikgetjavascriptcode)

### Piwik.getJavascriptCode

*Defined in [Piwik/Tracker/TrackerCodeGenerator](https://github.com/piwik/piwik/blob/2.x-dev/core/Tracker/TrackerCodeGenerator.php) in line [151](https://github.com/piwik/piwik/blob/2.x-dev/core/Tracker/TrackerCodeGenerator.php#L151)*

Triggered when generating JavaScript tracking code server side. Plugins can use
this event to customise the JavaScript tracking code that is displayed to the
user.

Callback Signature:
<pre><code>function(&amp;$codeImpl, $parameters)</code></pre>

- array `&$codeImpl` An array containing snippets of code that the event handler can modify. Will contain the following elements: - **idSite**: The ID of the site being tracked. - **piwikUrl**: The tracker URL to use. - **options**: A string of JavaScript code that customises the JavaScript tracker. - **optionsBeforeTrackerUrl**: A string of Javascript code that customises the JavaScript tracker inside of anonymous function before adding setTrackerUrl into paq. - **protocol**: Piwik url protocol. - **loadAsync**: boolean whether piwik.js should be loaded syncronous or asynchronous The **httpsPiwikUrl** element can be set if the HTTPS domain is different from the normal domain.

- array `$parameters` The parameters supplied to `TrackerCodeGenerator::generate()`.

## Platform

- [Platform.initialized](#platforminitialized)
- [Platform.initialized](#platforminitialized)

### Platform.initialized

*Defined in [Piwik/Plugins/Widgetize/tests/Integration/WidgetTest](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Widgetize/tests/System/WidgetTest.php) in line [51](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Widgetize/tests/System/WidgetTest.php#L51)*



Usages:

[CoreUpdater::updateCheck](https://github.com/piwik/piwik/blob/2.x-dev/plugins/CoreUpdater/CoreUpdater.php#L90), [LanguagesManager::initLanguage](https://github.com/piwik/piwik/blob/2.x-dev/plugins/LanguagesManager/LanguagesManager.php#L99), [UsersManager::onPlatformInitialized](https://github.com/piwik/piwik/blob/2.x-dev/plugins/UsersManager/UsersManager.php#L41)


### Platform.initialized

*Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/2.x-dev/core/FrontController.php) in line [361](https://github.com/piwik/piwik/blob/2.x-dev/core/FrontController.php#L361)*

Triggered after the platform is initialized and after the user has been authenticated, but before the platform has handled the request. Piwik uses this event to check for updates to Piwik.

Usages:

[CoreUpdater::updateCheck](https://github.com/piwik/piwik/blob/2.x-dev/plugins/CoreUpdater/CoreUpdater.php#L90), [LanguagesManager::initLanguage](https://github.com/piwik/piwik/blob/2.x-dev/plugins/LanguagesManager/LanguagesManager.php#L99), [UsersManager::onPlatformInitialized](https://github.com/piwik/piwik/blob/2.x-dev/plugins/UsersManager/UsersManager.php#L41)

## PluginManager

- [PluginManager.pluginActivated](#pluginmanagerpluginactivated)
- [PluginManager.pluginDeactivated](#pluginmanagerplugindeactivated)
- [PluginManager.pluginInstalled](#pluginmanagerplugininstalled)
- [PluginManager.pluginUninstalled](#pluginmanagerpluginuninstalled)

### PluginManager.pluginActivated

*Defined in [Piwik/Plugin/Manager](https://github.com/piwik/piwik/blob/2.x-dev/core/Plugin/Manager.php) in line [498](https://github.com/piwik/piwik/blob/2.x-dev/core/Plugin/Manager.php#L498)*

Event triggered after a plugin has been activated.

Callback Signature:
<pre><code>function($pluginName)</code></pre>

- string `$pluginName` The plugin that has been activated.

Usages:

[CustomPiwikJs::updateTracker](https://github.com/piwik/piwik/blob/2.x-dev/plugins/CustomPiwikJs/CustomPiwikJs.php#L30)


### PluginManager.pluginDeactivated

*Defined in [Piwik/Plugin/Manager](https://github.com/piwik/piwik/blob/2.x-dev/core/Plugin/Manager.php) in line [336](https://github.com/piwik/piwik/blob/2.x-dev/core/Plugin/Manager.php#L336)*

Event triggered after a plugin has been deactivated.

Callback Signature:
<pre><code>function($pluginName)</code></pre>

- string `$pluginName` The plugin that has been deactivated.

Usages:

[CustomPiwikJs::updateTracker](https://github.com/piwik/piwik/blob/2.x-dev/plugins/CustomPiwikJs/CustomPiwikJs.php#L30)


### PluginManager.pluginInstalled

*Defined in [Piwik/Plugin/Manager](https://github.com/piwik/piwik/blob/2.x-dev/core/Plugin/Manager.php) in line [1100](https://github.com/piwik/piwik/blob/2.x-dev/core/Plugin/Manager.php#L1100)*

Event triggered after a new plugin has been installed. Note: Might be triggered more than once if the config file is not writable

Callback Signature:
<pre><code>function($pluginName)</code></pre>

- string `$pluginName` The plugin that has been installed.

Usages:

[CustomPiwikJs::updateTracker](https://github.com/piwik/piwik/blob/2.x-dev/plugins/CustomPiwikJs/CustomPiwikJs.php#L30)


### PluginManager.pluginUninstalled

*Defined in [Piwik/Plugin/Manager](https://github.com/piwik/piwik/blob/2.x-dev/core/Plugin/Manager.php) in line [424](https://github.com/piwik/piwik/blob/2.x-dev/core/Plugin/Manager.php#L424)*

Event triggered after a plugin has been uninstalled.

Callback Signature:
<pre><code>function($pluginName)</code></pre>

- string `$pluginName` The plugin that has been uninstalled.

Usages:

[CustomPiwikJs::updateTracker](https://github.com/piwik/piwik/blob/2.x-dev/plugins/CustomPiwikJs/CustomPiwikJs.php#L30)

## Provider

- [Provider.getCleanHostname](#providergetcleanhostname)

### Provider.getCleanHostname

*Defined in [Piwik/Plugins/Provider/Provider](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Provider/Provider.php) in line [113](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Provider/Provider.php#L113)*

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

*Defined in [Piwik/Plugins/Referrers/SearchEngine](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Referrers/SearchEngine.php) in line [66](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Referrers/SearchEngine.php#L66)*



Callback Signature:
<pre><code>function(&amp;$this-&gt;definitionList)</code></pre>


### Referrer.addSocialUrls

*Defined in [Piwik/Plugins/Referrers/Social](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Referrers/Social.php) in line [63](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Referrers/Social.php#L63)*



Callback Signature:
<pre><code>function(&amp;$this-&gt;definitionList)</code></pre>

## Request

- [Request.dispatch](#requestdispatch)
- [Request.dispatch.end](#requestdispatchend)
- [Request.dispatchCoreAndPluginUpdatesScreen](#requestdispatchcoreandpluginupdatesscreen)
- [Request.getRenamedModuleAndAction](#requestgetrenamedmoduleandaction)
- [Request.initAuthenticationObject](#requestinitauthenticationobject)
- [Request.initAuthenticationObject](#requestinitauthenticationobject)
- [Request.initAuthenticationObject](#requestinitauthenticationobject)
- [Request.initAuthenticationObject](#requestinitauthenticationobject)
- [Request.initAuthenticationObject](#requestinitauthenticationobject)

### Request.dispatch

*Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/2.x-dev/core/FrontController.php) in line [492](https://github.com/piwik/piwik/blob/2.x-dev/core/FrontController.php#L492)*

Triggered directly before controller actions are dispatched. This event can be used to modify the parameters passed to one or more controller actions
and can be used to change the controller action being dispatched to.

Callback Signature:
<pre><code>function(&amp;$module, &amp;$action, &amp;$parameters)</code></pre>

- string `&$module` The name of the plugin being dispatched to.

- string `&$action` The name of the controller method being dispatched to.

- array `&$parameters` The arguments passed to the controller action.

Usages:

[CustomAlerts::checkControllerPermission](https://github.com/piwik/piwik/blob/2.x-dev/plugins/CustomAlerts/CustomAlerts.php#L45), [Installation::dispatchIfNotInstalledYet](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Installation/Installation.php#L61), [LanguagesManager::initLanguage](https://github.com/piwik/piwik/blob/2.x-dev/plugins/LanguagesManager/LanguagesManager.php#L99), [SitesManager::redirectDashboardToWelcomePage](https://github.com/piwik/piwik/blob/2.x-dev/plugins/SitesManager/SitesManager.php#L44)


### Request.dispatch.end

*Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/2.x-dev/core/FrontController.php) in line [537](https://github.com/piwik/piwik/blob/2.x-dev/core/FrontController.php#L537)*

Triggered after a controller action is successfully called. This event can be used to modify controller action output (if any) before the output is returned.

Callback Signature:
<pre><code>function(&amp;$result, $module, $action, $parameters)</code></pre>

- mixed `&$result` The controller action result.

- array `$parameters` The arguments passed to the controller action.


### Request.dispatchCoreAndPluginUpdatesScreen

*Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/2.x-dev/core/FrontController.php) in line [306](https://github.com/piwik/piwik/blob/2.x-dev/core/FrontController.php#L306)*

Triggered just after the platform is initialized and plugins are loaded. This event can be used to do early initialization.

_Note: At this point the user is not authenticated yet._

Usages:

[CoreUpdater::dispatch](https://github.com/piwik/piwik/blob/2.x-dev/plugins/CoreUpdater/CoreUpdater.php#L53), [LanguagesManager::initLanguage](https://github.com/piwik/piwik/blob/2.x-dev/plugins/LanguagesManager/LanguagesManager.php#L99)


### Request.getRenamedModuleAndAction

*Defined in [Piwik/API/Request](https://github.com/piwik/piwik/blob/2.x-dev/core/API/Request.php) in line [159](https://github.com/piwik/piwik/blob/2.x-dev/core/API/Request.php#L159)*

This event is posted in the Request dispatcher and can be used to overwrite the Module and Action to dispatch. This is useful when some Controller methods or API methods have been renamed or moved to another plugin.

Callback Signature:
<pre><code>function(&amp;$module, &amp;$action)</code></pre>

- $module

- $action

Usages:

[DevicePlugins::renameUserSettingsModuleAndAction](https://github.com/piwik/piwik/blob/2.x-dev/plugins/DevicePlugins/DevicePlugins.php#L49), [DevicesDetection::renameUserSettingsModuleAndAction](https://github.com/piwik/piwik/blob/2.x-dev/plugins/DevicesDetection/DevicesDetection.php#L52), [ProfessionalServices::renameProfessionalServicesModule](https://github.com/piwik/piwik/blob/2.x-dev/plugins/ProfessionalServices/ProfessionalServices.php#L34), [Referrers::renameDeprecatedModuleAndAction](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Referrers/Referrers.php#L47), [Resolution::renameUserSettingsModuleAndAction](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Resolution/Resolution.php#L37), [ScheduledReports::renameDeprecatedModuleAndAction](https://github.com/piwik/piwik/blob/2.x-dev/plugins/ScheduledReports/ScheduledReports.php#L103), [UserLanguage::renameUserSettingsModuleAndAction](https://github.com/piwik/piwik/blob/2.x-dev/plugins/UserLanguage/UserLanguage.php#L49)


### Request.initAuthenticationObject

*Defined in [Piwik/Plugins/API/tests/Integration/APITest](https://github.com/piwik/piwik/blob/2.x-dev/plugins/API/tests/Integration/APITest.php) in line [87](https://github.com/piwik/piwik/blob/2.x-dev/plugins/API/tests/Integration/APITest.php#L87)*



Usages:

[Login::initAuthenticationObject](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Login/Login.php#L89)


### Request.initAuthenticationObject

*Defined in [Piwik/Plugins/BulkTracking/Tracker/Handler](https://github.com/piwik/piwik/blob/2.x-dev/plugins/BulkTracking/Tracker/Handler.php) in line [116](https://github.com/piwik/piwik/blob/2.x-dev/plugins/BulkTracking/Tracker/Handler.php#L116)*



Usages:

[Login::initAuthenticationObject](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Login/Login.php#L89)


### Request.initAuthenticationObject

*Defined in [Piwik/Plugins/Overlay/API](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Overlay/API.php) in line [126](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Overlay/API.php#L126)*

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

[Login::initAuthenticationObject](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Login/Login.php#L89)


### Request.initAuthenticationObject

*Defined in [Piwik/Tracker/Request](https://github.com/piwik/piwik/blob/2.x-dev/core/Tracker/Request.php) in line [175](https://github.com/piwik/piwik/blob/2.x-dev/core/Tracker/Request.php#L175)*



Usages:

[Login::initAuthenticationObject](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Login/Login.php#L89)


### Request.initAuthenticationObject

*Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/2.x-dev/core/FrontController.php) in line [330](https://github.com/piwik/piwik/blob/2.x-dev/core/FrontController.php#L330)*

Triggered before the user is authenticated, when the global authentication object should be created. Plugins that provide their own authentication implementation should use this event
to set the global authentication object (which must derive from [Auth](/api-reference/Piwik/Auth)).

**Example**

    Piwik::addAction('Request.initAuthenticationObject', function() {
        StaticContainer::getContainer()->set('Piwik\Auth', new MyAuthImplementation());
    });

Usages:

[Login::initAuthenticationObject](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Login/Login.php#L89)

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

*Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/2.x-dev/plugins/ScheduledReports/API.php) in line [828](https://github.com/piwik/piwik/blob/2.x-dev/plugins/ScheduledReports/API.php#L828)*

Triggered when we're determining if a scheduled report transport medium can handle sending multiple Piwik reports in one scheduled report or not. Plugins that provide their own transport mediums should use this
event to specify whether their backend can send more than one Piwik report
at a time.

Callback Signature:
<pre><code>function(&amp;$allowMultipleReports, $reportType)</code></pre>

- bool `&$allowMultipleReports` Whether the backend type can handle multiple Piwik reports or not.

- string `$reportType` A string ID describing how the report is sent, eg, `'sms'` or `'email'`.

Usages:

[MobileMessaging::allowMultipleReports](https://github.com/piwik/piwik/blob/2.x-dev/plugins/MobileMessaging/MobileMessaging.php#L166), [ScheduledReports::allowMultipleReports](https://github.com/piwik/piwik/blob/2.x-dev/plugins/ScheduledReports/ScheduledReports.php#L282)


### ScheduledReports.getRendererInstance

*Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/2.x-dev/plugins/ScheduledReports/API.php) in line [462](https://github.com/piwik/piwik/blob/2.x-dev/plugins/ScheduledReports/API.php#L462)*

Triggered when obtaining a renderer instance based on the scheduled report output format. Plugins that provide new scheduled report output formats should use this event to
handle their new report formats.

Callback Signature:
<pre><code>function(&amp;$reportRenderer, $reportType, $outputType, $report)</code></pre>

- ReportRenderer `&$reportRenderer` This variable should be set to an instance that extends Piwik\ReportRenderer by one of the event subscribers.

- string `$reportType` A string ID describing how the report is sent, eg, `'sms'` or `'email'`.

- string `$outputType` The output format of the report, eg, `'html'`, `'pdf'`, etc.

- array `&$report` An array describing the scheduled report that is being generated.

Usages:

[MobileMessaging::getRendererInstance](https://github.com/piwik/piwik/blob/2.x-dev/plugins/MobileMessaging/MobileMessaging.php#L153), [ScheduledReports::getRendererInstance](https://github.com/piwik/piwik/blob/2.x-dev/plugins/ScheduledReports/ScheduledReports.php#L267)


### ScheduledReports.getReportFormats

*Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/2.x-dev/plugins/ScheduledReports/API.php) in line [875](https://github.com/piwik/piwik/blob/2.x-dev/plugins/ScheduledReports/API.php#L875)*

Triggered when gathering all available scheduled report formats. Plugins that provide their own scheduled report format should use
this event to make their format available.

Callback Signature:
<pre><code>function(&amp;$reportFormats, $reportType)</code></pre>

- array `&$reportFormats` An array mapping string IDs for each available scheduled report format with icon paths for those formats. Add your new format's ID to this array.

- string `$reportType` A string ID describing how the report is sent, eg, `'sms'` or `'email'`.

Usages:

[MobileMessaging::getReportFormats](https://github.com/piwik/piwik/blob/2.x-dev/plugins/MobileMessaging/MobileMessaging.php#L139), [ScheduledReports::getReportFormats](https://github.com/piwik/piwik/blob/2.x-dev/plugins/ScheduledReports/ScheduledReports.php#L212)


### ScheduledReports.getReportMetadata

*Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/2.x-dev/plugins/ScheduledReports/API.php) in line [800](https://github.com/piwik/piwik/blob/2.x-dev/plugins/ScheduledReports/API.php#L800)*

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

[MobileMessaging::getReportMetadata](https://github.com/piwik/piwik/blob/2.x-dev/plugins/MobileMessaging/MobileMessaging.php#L116), [ScheduledReports::getReportMetadata](https://github.com/piwik/piwik/blob/2.x-dev/plugins/ScheduledReports/ScheduledReports.php#L183)


### ScheduledReports.getReportParameters

*Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/2.x-dev/plugins/ScheduledReports/API.php) in line [654](https://github.com/piwik/piwik/blob/2.x-dev/plugins/ScheduledReports/API.php#L654)*

Triggered when gathering the available parameters for a scheduled report type. Plugins that provide their own scheduled report transport mediums should use this
event to list the available report parameters for their transport medium.

Callback Signature:
<pre><code>function(&amp;$availableParameters, $reportType)</code></pre>

- array `&$availableParameters` The list of available parameters for this report type. This is an array that maps paramater IDs with a boolean that indicates whether the parameter is mandatory or not.

- string `$reportType` A string ID describing how the report is sent, eg, `'sms'` or `'email'`.

Usages:

[MobileMessaging::getReportParameters](https://github.com/piwik/piwik/blob/2.x-dev/plugins/MobileMessaging/MobileMessaging.php#L146), [ScheduledReports::getReportParameters](https://github.com/piwik/piwik/blob/2.x-dev/plugins/ScheduledReports/ScheduledReports.php#L219)


### ScheduledReports.getReportRecipients

*Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/2.x-dev/plugins/ScheduledReports/API.php) in line [906](https://github.com/piwik/piwik/blob/2.x-dev/plugins/ScheduledReports/API.php#L906)*

Triggered when getting the list of recipients of a scheduled report. Plugins that provide their own scheduled report transport medium should use this event
to extract the list of recipients their backend's specific scheduled report
format.

Callback Signature:
<pre><code>function(&amp;$recipients, $report[&#039;type&#039;], $report)</code></pre>

- array `&$recipients` An array of strings describing each of the scheduled reports recipients. Can be, for example, a list of email addresses or phone numbers or whatever else your plugin uses.

- string `$reportType` A string ID describing how the report is sent, eg, `'sms'` or `'email'`.

- array `$report` An array describing the scheduled report that is being generated.

Usages:

[MobileMessaging::getReportRecipients](https://github.com/piwik/piwik/blob/2.x-dev/plugins/MobileMessaging/MobileMessaging.php#L173), [ScheduledReports::getReportRecipients](https://github.com/piwik/piwik/blob/2.x-dev/plugins/ScheduledReports/ScheduledReports.php#L487)


### ScheduledReports.getReportTypes

*Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/2.x-dev/plugins/ScheduledReports/API.php) in line [851](https://github.com/piwik/piwik/blob/2.x-dev/plugins/ScheduledReports/API.php#L851)*

Triggered when gathering all available transport mediums. Plugins that provide their own transport mediums should use this
event to make their medium available.

Callback Signature:
<pre><code>function(&amp;$reportTypes)</code></pre>

- array `&$reportTypes` An array mapping transport medium IDs with the paths to those mediums' icons. Add your new backend's ID to this array.

Usages:

[MobileMessaging::getReportTypes](https://github.com/piwik/piwik/blob/2.x-dev/plugins/MobileMessaging/MobileMessaging.php#L134), [ScheduledReports::getReportTypes](https://github.com/piwik/piwik/blob/2.x-dev/plugins/ScheduledReports/ScheduledReports.php#L207)


### ScheduledReports.processReports

*Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/2.x-dev/plugins/ScheduledReports/API.php) in line [440](https://github.com/piwik/piwik/blob/2.x-dev/plugins/ScheduledReports/API.php#L440)*

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

[ScheduledReports::processReports](https://github.com/piwik/piwik/blob/2.x-dev/plugins/ScheduledReports/ScheduledReports.php#L226)


### ScheduledReports.sendReport

*Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/2.x-dev/plugins/ScheduledReports/API.php) in line [590](https://github.com/piwik/piwik/blob/2.x-dev/plugins/ScheduledReports/API.php#L590)*

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

[MobileMessaging::sendReport](https://github.com/piwik/piwik/blob/2.x-dev/plugins/MobileMessaging/MobileMessaging.php#L180), [ScheduledReports::sendReport](https://github.com/piwik/piwik/blob/2.x-dev/plugins/ScheduledReports/ScheduledReports.php#L289)


### ScheduledReports.validateReportParameters

*Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/2.x-dev/plugins/ScheduledReports/API.php) in line [681](https://github.com/piwik/piwik/blob/2.x-dev/plugins/ScheduledReports/API.php#L681)*

Triggered when validating the parameters for a scheduled report. Plugins that provide their own scheduled reports backend should use this
event to validate the custom parameters defined with ScheduledReports::getReportParameters().

Callback Signature:
<pre><code>function(&amp;$parameters, $reportType)</code></pre>

- array `&$parameters` The list of parameters for the scheduled report.

- string `$reportType` A string ID describing how the report is sent, eg, `'sms'` or `'email'`.

Usages:

[MobileMessaging::validateReportParameters](https://github.com/piwik/piwik/blob/2.x-dev/plugins/MobileMessaging/MobileMessaging.php#L97), [ScheduledReports::validateReportParameters](https://github.com/piwik/piwik/blob/2.x-dev/plugins/ScheduledReports/ScheduledReports.php#L139)

## SegmentEditor

- [SegmentEditor.deactivate](#segmenteditordeactivate)
- [SegmentEditor.update](#segmenteditorupdate)

### SegmentEditor.deactivate

*Defined in [Piwik/Plugins/SegmentEditor/API](https://github.com/piwik/piwik/blob/2.x-dev/plugins/SegmentEditor/API.php) in line [205](https://github.com/piwik/piwik/blob/2.x-dev/plugins/SegmentEditor/API.php#L205)*

Triggered before a segment is deleted or made invisible. This event can be used by plugins to throw an exception
or do something else.

Callback Signature:
<pre><code>function($idSegment)</code></pre>

- int `$idSegment` The ID of the segment being deleted.

Usages:

[ScheduledReports::segmentDeactivation](https://github.com/piwik/piwik/blob/2.x-dev/plugins/ScheduledReports/ScheduledReports.php#L556)


### SegmentEditor.update

*Defined in [Piwik/Plugins/SegmentEditor/API](https://github.com/piwik/piwik/blob/2.x-dev/plugins/SegmentEditor/API.php) in line [257](https://github.com/piwik/piwik/blob/2.x-dev/plugins/SegmentEditor/API.php#L257)*

Triggered before a segment is modified. This event can be used by plugins to throw an exception
or do something else.

Callback Signature:
<pre><code>function($idSegment, $bind)</code></pre>

- int `$idSegment` The ID of the segment which visibility is reduced.

Usages:

[ScheduledReports::segmentUpdated](https://github.com/piwik/piwik/blob/2.x-dev/plugins/ScheduledReports/ScheduledReports.php#L523)

## Segments

- [Segments.getKnownSegmentsToArchiveAllSites](#segmentsgetknownsegmentstoarchiveallsites)
- [Segments.getKnownSegmentsToArchiveForSite](#segmentsgetknownsegmentstoarchiveforsite)

### Segments.getKnownSegmentsToArchiveAllSites

*Defined in [Piwik/SettingsPiwik](https://github.com/piwik/piwik/blob/2.x-dev/core/SettingsPiwik.php) in line [89](https://github.com/piwik/piwik/blob/2.x-dev/core/SettingsPiwik.php#L89)*

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

[SegmentEditor::getKnownSegmentsToArchiveAllSites](https://github.com/piwik/piwik/blob/2.x-dev/plugins/SegmentEditor/SegmentEditor.php#L39)


### Segments.getKnownSegmentsToArchiveForSite

*Defined in [Piwik/SettingsPiwik](https://github.com/piwik/piwik/blob/2.x-dev/core/SettingsPiwik.php) in line [139](https://github.com/piwik/piwik/blob/2.x-dev/core/SettingsPiwik.php#L139)*

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

[SegmentEditor::getKnownSegmentsToArchiveForSite](https://github.com/piwik/piwik/blob/2.x-dev/plugins/SegmentEditor/SegmentEditor.php#L51)

## SEO

- [SEO.getMetricsProviders](#seogetmetricsproviders)

### SEO.getMetricsProviders

*Defined in [Piwik/Plugins/SEO/Metric/Aggregator](https://github.com/piwik/piwik/blob/2.x-dev/plugins/SEO/Metric/Aggregator.php) in line [61](https://github.com/piwik/piwik/blob/2.x-dev/plugins/SEO/Metric/Aggregator.php#L61)*

Use this event to register new SEO metrics providers.

Callback Signature:
<pre><code>function(&amp;$providers)</code></pre>

- array `&$providers` Contains an array of Piwik\Plugins\SEO\Metric\MetricsProvider instances.

## Settings

- [Settings.$this-&gt;pluginName.settingsUpdated](#settingsthispluginnamesettingsupdated)

### Settings.$this-&gt;pluginName.settingsUpdated

*Defined in [Piwik/Plugin/Settings](https://github.com/piwik/piwik/blob/2.x-dev/core/Plugin/Settings.php) in line [223](https://github.com/piwik/piwik/blob/2.x-dev/core/Plugin/Settings.php#L223)*

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

*Defined in [Piwik/Plugins/SitesManager/API](https://github.com/piwik/piwik/blob/2.x-dev/plugins/SitesManager/API.php) in line [610](https://github.com/piwik/piwik/blob/2.x-dev/plugins/SitesManager/API.php#L610)*

Triggered after a site has been added.

Callback Signature:
<pre><code>function($idSite)</code></pre>

- int `$idSite` The ID of the site that was added.


### SitesManager.deleteSite.end

*Defined in [Piwik/Plugins/SitesManager/API](https://github.com/piwik/piwik/blob/2.x-dev/plugins/SitesManager/API.php) in line [687](https://github.com/piwik/piwik/blob/2.x-dev/plugins/SitesManager/API.php#L687)*

Triggered after a site has been deleted. Plugins can use this event to remove site specific values or settings, such as removing all
goals that belong to a specific website. If you store any data related to a website you
should clean up that information here.

Callback Signature:
<pre><code>function($idSite)</code></pre>

- int `$idSite` The ID of the site being deleted.

Usages:

[CustomAlerts::deleteAlertsForSite](https://github.com/piwik/piwik/blob/2.x-dev/plugins/CustomAlerts/CustomAlerts.php#L95), [Goals::deleteSiteGoals](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Goals/Goals.php#L128), [ScheduledReports::deleteSiteReport](https://github.com/piwik/piwik/blob/2.x-dev/plugins/ScheduledReports/ScheduledReports.php#L119), [SitesManager::onSiteDeleted](https://github.com/piwik/piwik/blob/2.x-dev/plugins/SitesManager/SitesManager.php#L68), [UsersManager::deleteSite](https://github.com/piwik/piwik/blob/2.x-dev/plugins/UsersManager/UsersManager.php#L82)


### SitesManager.getImageTrackingCode

*Defined in [Piwik/Plugins/SitesManager/API](https://github.com/piwik/piwik/blob/2.x-dev/plugins/SitesManager/API.php) in line [142](https://github.com/piwik/piwik/blob/2.x-dev/plugins/SitesManager/API.php#L142)*

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

### Tracker.Cache.getSiteAttributes

*Defined in [Piwik/Tracker/Cache](https://github.com/piwik/piwik/blob/2.x-dev/core/Tracker/Cache.php) in line [98](https://github.com/piwik/piwik/blob/2.x-dev/core/Tracker/Cache.php#L98)*

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

[Goals::fetchGoalsFromDb](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Goals/Goals.php#L257), [SitesManager::recordWebsiteDataInCache](https://github.com/piwik/piwik/blob/2.x-dev/plugins/SitesManager/SitesManager.php#L113), [UsersManager::recordAdminUsersInCache](https://github.com/piwik/piwik/blob/2.x-dev/plugins/UsersManager/UsersManager.php#L56)


### Tracker.detectReferrerSearchEngine

*Defined in [Piwik/Plugins/Referrers/Columns/Base](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Referrers/Columns/Base.php) in line [166](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Referrers/Columns/Base.php#L166)*

Triggered when detecting the search engine of a referrer URL. Plugins can use this event to provide custom search engine detection
logic.

Callback Signature:
<pre><code>function(&amp;$searchEngineInformation, $this-&gt;referrerUrl)</code></pre>

- array `&$searchEngineInformation` An array with the following information: - **name**: The search engine name. - **keywords**: The search keywords used. This parameter is initialized to the results of Piwik's default search engine detection logic.

- string


### Tracker.end

*Defined in [Piwik/Plugins/QueuedTracking/Commands/Process](https://github.com/piwik/piwik/blob/2.x-dev/plugins/QueuedTracking/Commands/Process.php) in line [92](https://github.com/piwik/piwik/blob/2.x-dev/plugins/QueuedTracking/Commands/Process.php#L92)*




### Tracker.end

*Defined in [Piwik/Tracker](https://github.com/piwik/piwik/blob/2.x-dev/core/Tracker.php) in line [102](https://github.com/piwik/piwik/blob/2.x-dev/core/Tracker.php#L102)*




### Tracker.existingVisitInformation

*Defined in [Piwik/Tracker/Visit](https://github.com/piwik/piwik/blob/2.x-dev/core/Tracker/Visit.php) in line [228](https://github.com/piwik/piwik/blob/2.x-dev/core/Tracker/Visit.php#L228)*

Triggered before a [visit entity](/guides/persistence-and-the-mysql-backend#visits) is updated when tracking an action for an existing visit. This event can be used to modify the visit properties that will be updated before the changes
are persisted.

This event is deprecated, use [Dimensions](http://developer.piwik.org/guides/dimensions) instead.

Callback Signature:
<pre><code>function(&amp;$valuesToUpdate, $this-&gt;visitProperties-&gt;getProperties())</code></pre>

- array `&$valuesToUpdate` Visit entity properties that will be updated.

- array `$visit` The entire visit entity. Read [this](/guides/persistence-and-the-mysql-backend#visits) to see what it contains.


### Tracker.getDatabaseConfig

*Defined in [Piwik/Tracker/Db](https://github.com/piwik/piwik/blob/2.x-dev/core/Tracker/Db.php) in line [262](https://github.com/piwik/piwik/blob/2.x-dev/core/Tracker/Db.php#L262)*

Triggered before a connection to the database is established by the Tracker. This event can be used to change the database connection settings used by the Tracker.

Callback Signature:
<pre><code>function(&amp;$configDb)</code></pre>

- array `$dbInfos` Reference to an array containing database connection info, including: - **host**: The host name or IP address to the MySQL database. - **username**: The username to use when connecting to the database. - **password**: The password to use when connecting to the database. - **dbname**: The name of the Piwik MySQL database. - **port**: The MySQL database port to use. - **adapter**: either `'PDO\MYSQL'` or `'MYSQLI'` - **type**: The MySQL engine to use, for instance 'InnoDB'


### Tracker.isExcludedVisit

*Defined in [Piwik/Tracker/VisitExcluded](https://github.com/piwik/piwik/blob/2.x-dev/core/Tracker/VisitExcluded.php) in line [86](https://github.com/piwik/piwik/blob/2.x-dev/core/Tracker/VisitExcluded.php#L86)*

Triggered on every tracking request. This event can be used to tell the Tracker not to record this particular action or visit.

Callback Signature:
<pre><code>function(&amp;$excluded, $this-&gt;request)</code></pre>

- bool `&$excluded` Whether the request should be excluded or not. Initialized to `false`. Event subscribers should set it to `true` in order to exclude the request.

- Request `$request` The request object which contains all of the request's information


### Tracker.makeNewVisitObject

*Defined in [Piwik/Tracker/Visit/Factory](https://github.com/piwik/piwik/blob/2.x-dev/core/Tracker/Visit/Factory.php) in line [38](https://github.com/piwik/piwik/blob/2.x-dev/core/Tracker/Visit/Factory.php#L38)*

Triggered before a new **visit tracking object** is created. Subscribers to this
event can force the use of a custom visit tracking object that extends from
Piwik\Tracker\VisitInterface.

Callback Signature:
<pre><code>function(&amp;$visit)</code></pre>

- \Piwik\Tracker\VisitInterface `&$visit` Initialized to null, but can be set to a new visit object. If it isn't modified Piwik uses the default class.


### Tracker.newConversionInformation

*Defined in [Piwik/Tracker/GoalManager](https://github.com/piwik/piwik/blob/2.x-dev/core/Tracker/GoalManager.php) in line [736](https://github.com/piwik/piwik/blob/2.x-dev/core/Tracker/GoalManager.php#L736)*

Triggered before persisting a new [conversion entity](/guides/persistence-and-the-mysql-backend#conversions). This event can be used to modify conversion information or to add new information to be persisted.

This event is deprecated, use [Dimensions](http://developer.piwik.org/guides/dimensions) instead.

Callback Signature:
<pre><code>function(&amp;$conversion, $visitInformation, $request)</code></pre>

- array `&$conversion` The conversion entity. Read [this](/guides/persistence-and-the-mysql-backend#conversions) to see what it contains.

- array `$visitInformation` The visit entity that we are tracking a conversion for. See what information it contains [here](/guides/persistence-and-the-mysql-backend#visits).

- \Piwik\Tracker\Request `$request` An object describing the tracking request being processed.


### Tracker.newVisitorInformation

*Defined in [Piwik/Tracker/Visit](https://github.com/piwik/piwik/blob/2.x-dev/core/Tracker/Visit.php) in line [297](https://github.com/piwik/piwik/blob/2.x-dev/core/Tracker/Visit.php#L297)*

Triggered before a new [visit entity](/guides/persistence-and-the-mysql-backend#visits) is persisted. This event can be used to modify the visit entity or add new information to it before it is persisted.
The UserCountry plugin, for example, uses this event to add location information for each visit.

This event is deprecated, use [Dimensions](http://developer.piwik.org/guides/dimensions) instead.

Callback Signature:
<pre><code>function(&amp;$properties, $this-&gt;request)</code></pre>

- array `$visit` The visit entity. Read [this](/guides/persistence-and-the-mysql-backend#visits) to see what information it contains.

- \Piwik\Tracker\Request `$request` An object describing the tracking request being processed.


### Tracker.PageUrl.getQueryParametersToExclude

*Defined in [Piwik/Tracker/PageUrl](https://github.com/piwik/piwik/blob/2.x-dev/core/Tracker/PageUrl.php) in line [95](https://github.com/piwik/piwik/blob/2.x-dev/core/Tracker/PageUrl.php#L95)*

Triggered before setting the action url in Piwik\Tracker\Action so plugins can register parameters to be excluded from the tracking URL (e.g. campaign parameters).

Callback Signature:
<pre><code>function(&amp;$parametersToExclude)</code></pre>

- array `&$parametersToExclude` An array of parameters to exclude from the tracking url.


### Tracker.recordAction

*Defined in [Piwik/Tracker/Action](https://github.com/piwik/piwik/blob/2.x-dev/core/Tracker/Action.php) in line [414](https://github.com/piwik/piwik/blob/2.x-dev/core/Tracker/Action.php#L414)*

Triggered after successfully persisting a [visit action entity](/guides/persistence-and-the-mysql-backend#visit-actions). This event is deprecated, use [Dimensions](http://developer.piwik.org/guides/dimensions) instead.

Callback Signature:
<pre><code>function($trackerAction = $this, $visitAction)</code></pre>

- Action `$tracker` Action The Action tracker instance.

- array `$visitAction` The visit action entity that was persisted. Read [this](/guides/persistence-and-the-mysql-backend#visit-actions) to see what it contains.


### Tracker.recordEcommerceGoal

*Defined in [Piwik/Tracker/GoalManager](https://github.com/piwik/piwik/blob/2.x-dev/core/Tracker/GoalManager.php) in line [360](https://github.com/piwik/piwik/blob/2.x-dev/core/Tracker/GoalManager.php#L360)*

Triggered after successfully persisting an ecommerce conversion. _Note: Subscribers should be wary of doing any expensive computation here as it may slow
the tracker down._

This event is deprecated, use [Dimensions](http://developer.piwik.org/guides/dimensions) instead.

Callback Signature:
<pre><code>function($conversion, $visitProperties-&gt;getProperties())</code></pre>

- array `$conversion` The conversion entity that was just persisted. See what information it contains [here](/guides/persistence-and-the-mysql-backend#conversions).

- array `$visitInformation` The visit entity that we are tracking a conversion for. See what information it contains [here](/guides/persistence-and-the-mysql-backend#visits).


### Tracker.recordStandardGoals

*Defined in [Piwik/Tracker/GoalManager](https://github.com/piwik/piwik/blob/2.x-dev/core/Tracker/GoalManager.php) in line [709](https://github.com/piwik/piwik/blob/2.x-dev/core/Tracker/GoalManager.php#L709)*

Triggered after successfully recording a non-ecommerce conversion. _Note: Subscribers should be wary of doing any expensive computation here as it may slow
the tracker down._

This event is deprecated, use [Dimensions](http://developer.piwik.org/guides/dimensions) instead.

Callback Signature:
<pre><code>function($conversion)</code></pre>

- array `$conversion` The conversion entity that was just persisted. See what information it contains [here](/guides/persistence-and-the-mysql-backend#conversions).


### Tracker.Request.getIdSite

*Defined in [Piwik/Tracker/Request](https://github.com/piwik/piwik/blob/2.x-dev/core/Tracker/Request.php) in line [517](https://github.com/piwik/piwik/blob/2.x-dev/core/Tracker/Request.php#L517)*

Triggered when obtaining the ID of the site we are tracking a visit for. This event can be used to change the site ID so data is tracked for a different
website.

Callback Signature:
<pre><code>function(&amp;$idSite, $this-&gt;params)</code></pre>

- int `&$idSite` Initialized to the value of the **idsite** query parameter. If a subscriber sets this variable, the value it uses must be greater than 0.

- array `$params` The entire array of request parameters in the current tracking request.


### Tracker.setTrackerCacheGeneral

*Defined in [Piwik/Tracker/Cache](https://github.com/piwik/piwik/blob/2.x-dev/core/Tracker/Cache.php) in line [162](https://github.com/piwik/piwik/blob/2.x-dev/core/Tracker/Cache.php#L162)*

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

[PrivacyManager::setTrackerCacheGeneral](https://github.com/piwik/piwik/blob/2.x-dev/plugins/PrivacyManager/PrivacyManager.php#L147), [Referrers::setTrackerCacheGeneral](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Referrers/Referrers.php#L39), [UserCountry::setTrackerCacheGeneral](https://github.com/piwik/piwik/blob/2.x-dev/plugins/UserCountry/UserCountry.php#L66)

## Translate

- [Translate.getClientSideTranslationKeys](#translategetclientsidetranslationkeys)

### Translate.getClientSideTranslationKeys

*Defined in [Piwik/Translation/Translator](https://github.com/piwik/piwik/blob/2.x-dev/core/Translation/Translator.php) in line [167](https://github.com/piwik/piwik/blob/2.x-dev/core/Translation/Translator.php#L167)*

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

[Annotations::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Annotations/Annotations.php#L30), [CoreAdminHome::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/2.x-dev/plugins/CoreAdminHome/CoreAdminHome.php#L82), [CoreHome::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/2.x-dev/plugins/CoreHome/CoreHome.php#L179), [CorePluginsAdmin::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/2.x-dev/plugins/CorePluginsAdmin/CorePluginsAdmin.php#L47), [CoreVisualizations::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/2.x-dev/plugins/CoreVisualizations/CoreVisualizations.php#L56), [CustomAlerts::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/2.x-dev/plugins/CustomAlerts/CustomAlerts.php#L163), [CustomVariables::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/2.x-dev/plugins/CustomVariables/CustomVariables.php#L150), [Dashboard::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Dashboard/Dashboard.php#L239), [Feedback::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Feedback/Feedback.php#L42), [Goals::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Goals/Goals.php#L263), [Live::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Live/Live.php#L47), [Marketplace::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Marketplace/Marketplace.php#L41), [MultiSites::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/2.x-dev/plugins/MultiSites/MultiSites.php#L44), [Overlay::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Overlay/Overlay.php#L35), [ScheduledReports::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/2.x-dev/plugins/ScheduledReports/ScheduledReports.php#L110), [SegmentEditor::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/2.x-dev/plugins/SegmentEditor/SegmentEditor.php#L88), [SitesManager::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/2.x-dev/plugins/SitesManager/SitesManager.php#L270), [Transitions::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Transitions/Transitions.php#L38), [UserCountry::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/2.x-dev/plugins/UserCountry/UserCountry.php#L116), [UserCountryMap::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/2.x-dev/plugins/UserCountryMap/UserCountryMap.php#L70), [UserId::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/2.x-dev/plugins/UserId/UserId.php#L49), [UsersManager::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/2.x-dev/plugins/UsersManager/UsersManager.php#L173), [Widgetize::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Widgetize/Widgetize.php#L48)

## Updater

- [Updater.componentInstalled](#updatercomponentinstalled)
- [Updater.componentUninstalled](#updatercomponentuninstalled)
- [Updater.componentUpdated](#updatercomponentupdated)

### Updater.componentInstalled

*Defined in [Piwik/Updater](https://github.com/piwik/piwik/blob/2.x-dev/core/Updater.php) in line [101](https://github.com/piwik/piwik/blob/2.x-dev/core/Updater.php#L101)*

Event triggered after a new component has been installed.

Callback Signature:
<pre><code>function($name)</code></pre>

- string `$name` The component that has been installed.


### Updater.componentUninstalled

*Defined in [Piwik/Updater](https://github.com/piwik/piwik/blob/2.x-dev/core/Updater.php) in line [151](https://github.com/piwik/piwik/blob/2.x-dev/core/Updater.php#L151)*

Event triggered after a component has been uninstalled.

Callback Signature:
<pre><code>function($name)</code></pre>

- string `$name` The component that has been uninstalled.


### Updater.componentUpdated

*Defined in [Piwik/Updater](https://github.com/piwik/piwik/blob/2.x-dev/core/Updater.php) in line [129](https://github.com/piwik/piwik/blob/2.x-dev/core/Updater.php#L129)*

Event triggered after a component has been updated. Can be used to handle logic that should be done after a component was updated

**Example**

    Piwik::addAction('Updater.componentUpdated', function ($componentName, $updatedVersion) {
         $mail = new Mail();
         $mail->setDefaultFromPiwik();
         $mail->addTo('test@example.org');
         $mail->setSubject('Component was updated);
         $message = sprintf(
             'Component %1$s has been updated to version %2$s',
             $componentName, $updatedVersion
         );
         $mail->setBodyText($message);
         $mail->send();
    });

Callback Signature:
<pre><code>function($name, $version)</code></pre>

- string `$componentName` 'core', plugin name or dimension name

- string `$updatedVersion` version updated to

Usages:

[CustomPiwikJs::updateTracker](https://github.com/piwik/piwik/blob/2.x-dev/plugins/CustomPiwikJs/CustomPiwikJs.php#L30)

## User

- [User.isNotAuthorized](#userisnotauthorized)

### User.isNotAuthorized

*Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/2.x-dev/core/FrontController.php) in line [134](https://github.com/piwik/piwik/blob/2.x-dev/core/FrontController.php#L134)*

Triggered when a user with insufficient access permissions tries to view some resource. This event can be used to customize the error that occurs when a user is denied access
(for example, displaying an error message, redirecting to a page other than login, etc.).

Callback Signature:
<pre><code>function($exception)</code></pre>

- [NoAccessException](/api-reference/Piwik/NoAccessException) `$exception` The exception that was caught.

Usages:

[Login::noAccess](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Login/Login.php#L55)

## UsersManager

- [UsersManager.addUser.end](#usersmanageradduserend)
- [UsersManager.checkPassword](#usersmanagercheckpassword)
- [UsersManager.deleteUser](#usersmanagerdeleteuser)
- [UsersManager.getDefaultDates](#usersmanagergetdefaultdates)
- [UsersManager.removeSiteAccess](#usersmanagerremovesiteaccess)
- [UsersManager.removeSiteAccess](#usersmanagerremovesiteaccess)
- [UsersManager.updateUser.end](#usersmanagerupdateuserend)

### UsersManager.addUser.end

*Defined in [Piwik/Plugins/UsersManager/API](https://github.com/piwik/piwik/blob/2.x-dev/plugins/UsersManager/API.php) in line [454](https://github.com/piwik/piwik/blob/2.x-dev/plugins/UsersManager/API.php#L454)*

Triggered after a new user is created.

Callback Signature:
<pre><code>function($userLogin, $email, $password, $alias)</code></pre>

- string `$userLogin` The new user's login handle.


### UsersManager.checkPassword

*Defined in [Piwik/Plugins/UsersManager/UsersManager](https://github.com/piwik/piwik/blob/2.x-dev/plugins/UsersManager/UsersManager.php) in line [144](https://github.com/piwik/piwik/blob/2.x-dev/plugins/UsersManager/UsersManager.php#L144)*

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

*Defined in [Piwik/Plugins/UsersManager/Model](https://github.com/piwik/piwik/blob/2.x-dev/plugins/UsersManager/Model.php) in line [293](https://github.com/piwik/piwik/blob/2.x-dev/plugins/UsersManager/Model.php#L293)*

Triggered after a user has been deleted. This event should be used to clean up any data that is related to the now deleted user.
The **Dashboard** plugin, for example, uses this event to remove the user's dashboards.

Callback Signature:
<pre><code>function($userLogin)</code></pre>

- string `$userLogin` The login handle of the deleted user.

Usages:

[CoreAdminHome::cleanupUser](https://github.com/piwik/piwik/blob/2.x-dev/plugins/CoreAdminHome/CoreAdminHome.php#L36), [CoreVisualizations::deleteUser](https://github.com/piwik/piwik/blob/2.x-dev/plugins/CoreVisualizations/CoreVisualizations.php#L36), [CustomAlerts::deleteAlertsForLogin](https://github.com/piwik/piwik/blob/2.x-dev/plugins/CustomAlerts/CustomAlerts.php#L83), [Dashboard::deleteDashboardLayout](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Dashboard/Dashboard.php#L224), [LanguagesManager::deleteUserLanguage](https://github.com/piwik/piwik/blob/2.x-dev/plugins/LanguagesManager/LanguagesManager.php#L119), [ScheduledReports::deleteUserReport](https://github.com/piwik/piwik/blob/2.x-dev/plugins/ScheduledReports/ScheduledReports.php#L583)


### UsersManager.getDefaultDates

*Defined in [Piwik/Plugins/UsersManager/Controller](https://github.com/piwik/piwik/blob/2.x-dev/plugins/UsersManager/Controller.php) in line [225](https://github.com/piwik/piwik/blob/2.x-dev/plugins/UsersManager/Controller.php#L225)*

Triggered when the list of available dates is requested, for example for the User Settings > Report date to load by default.

Callback Signature:
<pre><code>function(&amp;$dates)</code></pre>

- array `&$dates` Array of (date => translation)


### UsersManager.removeSiteAccess

*Defined in [Piwik/Plugins/ScheduledReports/tests/ScheduledReportsTest](https://github.com/piwik/piwik/blob/2.x-dev/plugins/ScheduledReports/tests/Integration/ScheduledReportsTest.php) in line [96](https://github.com/piwik/piwik/blob/2.x-dev/plugins/ScheduledReports/tests/Integration/ScheduledReportsTest.php#L96)*



Callback Signature:
<pre><code>function(&#039;userLogin&#039;, function(1, 2))</code></pre>

Usages:

[ScheduledReports::deleteUserReportForSites](https://github.com/piwik/piwik/blob/2.x-dev/plugins/ScheduledReports/ScheduledReports.php#L588)


### UsersManager.removeSiteAccess

*Defined in [Piwik/Plugins/UsersManager/API](https://github.com/piwik/piwik/blob/2.x-dev/plugins/UsersManager/API.php) in line [715](https://github.com/piwik/piwik/blob/2.x-dev/plugins/UsersManager/API.php#L715)*



Callback Signature:
<pre><code>function($userLogin, $idSites)</code></pre>

Usages:

[ScheduledReports::deleteUserReportForSites](https://github.com/piwik/piwik/blob/2.x-dev/plugins/ScheduledReports/ScheduledReports.php#L588)


### UsersManager.updateUser.end

*Defined in [Piwik/Plugins/UsersManager/API](https://github.com/piwik/piwik/blob/2.x-dev/plugins/UsersManager/API.php) in line [569](https://github.com/piwik/piwik/blob/2.x-dev/plugins/UsersManager/API.php#L569)*

Triggered after an existing user has been updated. Event notify about password change.

Callback Signature:
<pre><code>function($userLogin, $passwordHasBeenUpdated, $email, $password, $alias)</code></pre>

- string `$userLogin` The user's login handle.

- boolean `$passwordHasBeenUpdated` Flag containing information about password change.

## View

- [View.ReportsByDimension.render](#viewreportsbydimensionrender)

### View.ReportsByDimension.render

*Defined in [Piwik/View/ReportsByDimension](https://github.com/piwik/piwik/blob/2.x-dev/core/View/ReportsByDimension.php) in line [99](https://github.com/piwik/piwik/blob/2.x-dev/core/View/ReportsByDimension.php#L99)*

Triggered before rendering ReportsByDimension views. Plugins can use this event to configure ReportsByDimension instances by
adding or removing reports to display.

Callback Signature:
<pre><code>function($this)</code></pre>

- ReportsByDimension `$this` The view instance.

## ViewDataTable

- [ViewDataTable.addViewDataTable](#viewdatatableaddviewdatatable)
- [ViewDataTable.configure](#viewdatatableconfigure)

### ViewDataTable.addViewDataTable

*Defined in [Piwik/ViewDataTable/Manager](https://github.com/piwik/piwik/blob/2.x-dev/core/ViewDataTable/Manager.php) in line [98](https://github.com/piwik/piwik/blob/2.x-dev/core/ViewDataTable/Manager.php#L98)*

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

[TreemapVisualization::getAvailableVisualizations](https://github.com/piwik/piwik/blob/2.x-dev/plugins/TreemapVisualization/TreemapVisualization.php#L36)


### ViewDataTable.configure

*Defined in [Piwik/Plugin/ViewDataTable](https://github.com/piwik/piwik/blob/2.x-dev/core/Plugin/ViewDataTable.php) in line [256](https://github.com/piwik/piwik/blob/2.x-dev/core/Plugin/ViewDataTable.php#L256)*

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

[Actions::configureViewDataTable](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Actions/Actions.php#L143), [Events::configureViewDataTable](https://github.com/piwik/piwik/blob/2.x-dev/plugins/Events/Events.php#L134)

## WidgetsList

- [WidgetsList.addWidgets](#widgetslistaddwidgets)

### WidgetsList.addWidgets

*Defined in [Piwik/WidgetsList](https://github.com/piwik/piwik/blob/2.x-dev/core/WidgetsList.php) in line [107](https://github.com/piwik/piwik/blob/2.x-dev/core/WidgetsList.php#L107)*



