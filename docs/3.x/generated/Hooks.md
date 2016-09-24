Events
==========

This is a complete list of available hooks. If you are not familiar with this read our [Guide about events](/guides/events).

## Actions

- [Actions.Archiving.addActionMetrics](#actionsarchivingaddactionmetrics)

### Actions.Archiving.addActionMetrics

*Defined in [Piwik/Plugins/Actions/Metrics](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Actions/Metrics.php) in line [91](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Actions/Metrics.php#L91)*



Callback Signature:
<pre><code>function(&amp;$metricsConfig)</code></pre>

## API

- [API.$pluginName.$methodName](#apipluginnamemethodname)
- [API.$pluginName.$methodName.end](#apipluginnamemethodnameend)
- [API.DocumentationGenerator.$token](#apidocumentationgeneratortoken)
- [API.getReportMetadata.end](#apigetreportmetadataend)
- [API.Request.authenticate](#apirequestauthenticate)
- [API.Request.dispatch](#apirequestdispatch)
- [API.Request.dispatch.end](#apirequestdispatchend)

### API.$pluginName.$methodName

*Defined in [Piwik/API/Proxy](https://github.com/piwik/piwik/blob/3.x-dev/core/API/Proxy.php) in line [205](https://github.com/piwik/piwik/blob/3.x-dev/core/API/Proxy.php#L205)*

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

*Defined in [Piwik/API/Proxy](https://github.com/piwik/piwik/blob/3.x-dev/core/API/Proxy.php) in line [255](https://github.com/piwik/piwik/blob/3.x-dev/core/API/Proxy.php#L255)*

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

*Defined in [Piwik/API/Proxy](https://github.com/piwik/piwik/blob/3.x-dev/core/API/Proxy.php) in line [500](https://github.com/piwik/piwik/blob/3.x-dev/core/API/Proxy.php#L500)*

This event exists for checking whether a Plugin API class or a Plugin API method tagged with a `@hideXYZ` should be hidden in the API listing.

Callback Signature:
<pre><code>function(&amp;$hide)</code></pre>

- bool `&$hide` whether to hide APIs tagged with $token should be displayed.


### API.getReportMetadata.end

*Defined in [Piwik/Plugins/API/ProcessedReport](https://github.com/piwik/piwik/blob/3.x-dev/plugins/API/ProcessedReport.php) in line [206](https://github.com/piwik/piwik/blob/3.x-dev/plugins/API/ProcessedReport.php#L206)*

Triggered after all available reports are collected. This event can be used to modify the report metadata of reports in other plugins. You
could, for example, add custom metrics to every report or remove reports from the list
of available reports.

Callback Signature:
<pre><code>function(&amp;$availableReports, $parameters)</code></pre>

- array `&$availableReports` List of all report metadata. Read the [API.getReportMetadata](/api-reference/events#apigetreportmetadata) docs to see what this array contains.

- array `$parameters` Contains the values of the sites and period we are getting reports for. Some report depend on this data. For example, Goals reports depend on the site IDs being request. Contains the following information: - **idSites**: The array of site IDs we are getting reports for. - **period**: The period type, eg, `'day'`, `'week'`, `'month'`, `'year'`, `'range'`. - **date**: A string date within the period or a date range, eg, `'2013-01-01'` or `'2012-01-01,2013-01-01'`.

Usages:

[Goals::getReportMetadataEnd](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Goals/Goals.php#L149)


### API.Request.authenticate

*Defined in [Piwik/API/Request](https://github.com/piwik/piwik/blob/3.x-dev/core/API/Request.php) in line [333](https://github.com/piwik/piwik/blob/3.x-dev/core/API/Request.php#L333)*

Triggered when authenticating an API request, but only if the **token_auth** query parameter is found in the request. Plugins that provide authentication capabilities should subscribe to this event
and make sure the global authentication object (the object returned by `StaticContainer::get('Piwik\Auth')`)
is setup to use `$token_auth` when its `authenticate()` method is executed.

Callback Signature:
<pre><code>function($tokenAuth)</code></pre>

- string `$token_auth` The value of the **token_auth** query parameter.

Usages:

[Login::ApiRequestAuthenticate](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Login/Login.php#L71)


### API.Request.dispatch

*Defined in [Piwik/API/Proxy](https://github.com/piwik/piwik/blob/3.x-dev/core/API/Proxy.php) in line [185](https://github.com/piwik/piwik/blob/3.x-dev/core/API/Proxy.php#L185)*

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

[CustomAlerts::checkApiPermission](https://github.com/piwik/piwik/blob/3.x-dev/plugins/CustomAlerts/CustomAlerts.php#L38)


### API.Request.dispatch.end

*Defined in [Piwik/API/Proxy](https://github.com/piwik/piwik/blob/3.x-dev/core/API/Proxy.php) in line [295](https://github.com/piwik/piwik/blob/3.x-dev/core/API/Proxy.php#L295)*

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

*Defined in [Piwik/ArchiveProcessor/Parameters](https://github.com/piwik/piwik/blob/3.x-dev/core/ArchiveProcessor/Parameters.php) in line [109](https://github.com/piwik/piwik/blob/3.x-dev/core/ArchiveProcessor/Parameters.php#L109)*



Callback Signature:
<pre><code>function(&amp;$idSites, $this-&gt;getPeriod())</code></pre>

## Archiving

- [Archiving.getIdSitesToArchiveWhenNoVisits](#archivinggetidsitestoarchivewhennovisits)

### Archiving.getIdSitesToArchiveWhenNoVisits

*Defined in [Piwik/ArchiveProcessor/Loader](https://github.com/piwik/piwik/blob/3.x-dev/core/ArchiveProcessor/Loader.php) in line [246](https://github.com/piwik/piwik/blob/3.x-dev/core/ArchiveProcessor/Loader.php#L246)*



Callback Signature:
<pre><code>function(&amp;$idSites)</code></pre>

## AssetManager

- [AssetManager.filterMergedJavaScripts](#assetmanagerfiltermergedjavascripts)
- [AssetManager.filterMergedJavaScripts](#assetmanagerfiltermergedjavascripts)
- [AssetManager.filterMergedJavaScripts](#assetmanagerfiltermergedjavascripts)
- [AssetManager.filterMergedStylesheets](#assetmanagerfiltermergedstylesheets)
- [AssetManager.getJavaScriptFiles](#assetmanagergetjavascriptfiles)
- [AssetManager.getStylesheetFiles](#assetmanagergetstylesheetfiles)

### AssetManager.filterMergedJavaScripts

*Defined in [Piwik/Plugins/CoreHome/tests/Integration/CoreHomeTest](https://github.com/piwik/piwik/blob/3.x-dev/plugins/CoreHome/tests/Integration/CoreHomeTest.php) in line [25](https://github.com/piwik/piwik/blob/3.x-dev/plugins/CoreHome/tests/Integration/CoreHomeTest.php#L25)*



Callback Signature:
<pre><code>function(&amp;$content)</code></pre>

Usages:

[CoreHome::filterMergedJavaScripts](https://github.com/piwik/piwik/blob/3.x-dev/plugins/CoreHome/CoreHome.php#L37)


### AssetManager.filterMergedJavaScripts

*Defined in [Piwik/Plugins/CoreHome/tests/Integration/CoreHomeTest](https://github.com/piwik/piwik/blob/3.x-dev/plugins/CoreHome/tests/Integration/CoreHomeTest.php) in line [33](https://github.com/piwik/piwik/blob/3.x-dev/plugins/CoreHome/tests/Integration/CoreHomeTest.php#L33)*



Callback Signature:
<pre><code>function(&amp;$content)</code></pre>

Usages:

[CoreHome::filterMergedJavaScripts](https://github.com/piwik/piwik/blob/3.x-dev/plugins/CoreHome/CoreHome.php#L37)


### AssetManager.filterMergedJavaScripts

*Defined in [Piwik/AssetManager/UIAssetMerger/JScriptUIAssetMerger](https://github.com/piwik/piwik/blob/3.x-dev/core/AssetManager/UIAssetMerger/JScriptUIAssetMerger.php) in line [69](https://github.com/piwik/piwik/blob/3.x-dev/core/AssetManager/UIAssetMerger/JScriptUIAssetMerger.php#L69)*

Triggered after all the JavaScript files Piwik uses are minified and merged into a single file, but before the merged JavaScript is written to disk. Plugins can use this event to modify merged JavaScript or do something else
with it.

Callback Signature:
<pre><code>function(&amp;$mergedContent)</code></pre>

- string `&$mergedContent` The minified and merged JavaScript.

Usages:

[CoreHome::filterMergedJavaScripts](https://github.com/piwik/piwik/blob/3.x-dev/plugins/CoreHome/CoreHome.php#L37)


### AssetManager.filterMergedStylesheets

*Defined in [Piwik/AssetManager/UIAssetMerger/StylesheetUIAssetMerger](https://github.com/piwik/piwik/blob/3.x-dev/core/AssetManager/UIAssetMerger/StylesheetUIAssetMerger.php) in line [125](https://github.com/piwik/piwik/blob/3.x-dev/core/AssetManager/UIAssetMerger/StylesheetUIAssetMerger.php#L125)*

Triggered after all less stylesheets are compiled to CSS, minified and merged into one file, but before the generated CSS is written to disk. This event can be used to modify merged CSS.

Callback Signature:
<pre><code>function(&amp;$mergedContent)</code></pre>

- string `&$mergedContent` The merged and minified CSS.


### AssetManager.getJavaScriptFiles

*Defined in [Piwik/AssetManager/UIAssetFetcher/JScriptUIAssetFetcher](https://github.com/piwik/piwik/blob/3.x-dev/core/AssetManager/UIAssetFetcher/JScriptUIAssetFetcher.php) in line [45](https://github.com/piwik/piwik/blob/3.x-dev/core/AssetManager/UIAssetFetcher/JScriptUIAssetFetcher.php#L45)*

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

[Actions::getJsFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Actions/Actions.php#L99), [Annotations::getJsFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Annotations/Annotations.php#L46), [Contents::getJsFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Contents/Contents.php#L34), [CoreAdminHome::getJsFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/CoreAdminHome/CoreAdminHome.php#L50), [CoreHome::getJsFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/CoreHome/CoreHome.php#L95), [CorePluginsAdmin::getJsFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/CorePluginsAdmin/CorePluginsAdmin.php#L47), [CoreVisualizations::getJsFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/CoreVisualizations/CoreVisualizations.php#L46), [CustomAlerts::getJavaScriptFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/CustomAlerts/CustomAlerts.php#L73), [CustomVariables::getJsFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/CustomVariables/CustomVariables.php#L132), [Dashboard::getJsFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Dashboard/Dashboard.php#L267), [Feedback::getJsFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Feedback/Feedback.php#L35), [Goals::getJsFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Goals/Goals.php#L247), [Insights::getJsFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Insights/Insights.php#L31), [LanguagesManager::getJsFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/LanguagesManager/LanguagesManager.php#L47), [Live::getJsFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Live/Live.php#L37), [Login::getJsFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Login/Login.php#L40), [MobileMessaging::getJsFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/MobileMessaging/MobileMessaging.php#L88), [MultiSites::getJsFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/MultiSites/MultiSites.php#L71), [Overlay::getJsFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Overlay/Overlay.php#L29), [PrivacyManager::getJsFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/PrivacyManager/PrivacyManager.php#L159), [ScheduledReports::getJsFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/ScheduledReports/ScheduledReports.php#L129), [SegmentEditor::getJsFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/SegmentEditor/SegmentEditor.php#L68), [SitesManager::getJsFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/SitesManager/SitesManager.php#L91), [Transitions::getJsFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Transitions/Transitions.php#L33), [TreemapVisualization::getJsFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/TreemapVisualization/TreemapVisualization.php#L61), [UserCountry::getJsFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/UserCountry/UserCountry.php#L76), [UserCountryMap::getJsFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/UserCountryMap/UserCountryMap.php#L39), [UserId::getJavaScriptFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/UserId/UserId.php#L39), [UsersManager::getJsFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/UsersManager/UsersManager.php#L92), [Widgetize::getJsFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Widgetize/Widgetize.php#L27)


### AssetManager.getStylesheetFiles

*Defined in [Piwik/AssetManager/UIAssetFetcher/StylesheetUIAssetFetcher](https://github.com/piwik/piwik/blob/3.x-dev/core/AssetManager/UIAssetFetcher/StylesheetUIAssetFetcher.php) in line [68](https://github.com/piwik/piwik/blob/3.x-dev/core/AssetManager/UIAssetFetcher/StylesheetUIAssetFetcher.php#L68)*

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

[Plugin::getStylesheetFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/API/API.php#L730), [Annotations::getStylesheetFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Annotations/Annotations.php#L38), [CoreAdminHome::getStylesheetFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/CoreAdminHome/CoreAdminHome.php#L42), [CoreHome::getStylesheetFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/CoreHome/CoreHome.php#L61), [CorePluginsAdmin::getStylesheetFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/CorePluginsAdmin/CorePluginsAdmin.php#L28), [CoreVisualizations::getStylesheetFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/CoreVisualizations/CoreVisualizations.php#L40), [CustomAlerts::getStylesheetFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/CustomAlerts/CustomAlerts.php#L78), [CustomVariables::getStylesheetFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/CustomVariables/CustomVariables.php#L127), [Dashboard::getStylesheetFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Dashboard/Dashboard.php#L278), [Diagnostics::getStylesheetFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Diagnostics/Diagnostics.php#L25), [Events::getStylesheetFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Events/Events.php#L264), [Feedback::getStylesheetFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Feedback/Feedback.php#L29), [Goals::getStylesheetFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Goals/Goals.php#L253), [Insights::getStylesheetFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Insights/Insights.php#L26), [Installation::getStylesheetFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Installation/Installation.php#L117), [Live::getStylesheetFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Live/Live.php#L31), [Login::getStylesheetFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Login/Login.php#L45), [MobileMessaging::getStylesheetFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/MobileMessaging/MobileMessaging.php#L95), [MultiSites::getStylesheetFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/MultiSites/MultiSites.php#L80), [ProfessionalServices::getStylesheetFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/ProfessionalServices/ProfessionalServices.php#L24), [RssWidget::getStylesheetFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/RssWidget/RssWidget.php#L27), [ScheduledReports::getStylesheetFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/ScheduledReports/ScheduledReports.php#L135), [SecurityInfo::getStylesheetFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/SecurityInfo/SecurityInfo.php#L28), [SegmentEditor::getStylesheetFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/SegmentEditor/SegmentEditor.php#L73), [SitesManager::getStylesheetFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/SitesManager/SitesManager.php#L83), [Transitions::getStylesheetFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Transitions/Transitions.php#L28), [TreemapVisualization::getStylesheetFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/TreemapVisualization/TreemapVisualization.php#L55), [UserCountry::getStylesheetFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/UserCountry/UserCountry.php#L71), [UserCountryMap::getStylesheetFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/UserCountryMap/UserCountryMap.php#L50), [UsersManager::getStylesheetFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/UsersManager/UsersManager.php#L105), [VisitsSummary::getStylesheetFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/VisitsSummary/VisitsSummary.php#L68), [Widgetize::getStylesheetFiles](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Widgetize/Widgetize.php#L38)

## Category

- [Category.addSubcategories](#categoryaddsubcategories)

### Category.addSubcategories

*Defined in [Piwik/Plugin/Categories](https://github.com/piwik/piwik/blob/3.x-dev/core/Plugin/Categories.php) in line [61](https://github.com/piwik/piwik/blob/3.x-dev/core/Plugin/Categories.php#L61)*

Triggered to add custom subcategories. **Example**

    public function addSubcategories(&$subcategories)
    {
        $subcategory = new Subcategory();
        $subcategory->setId('General_Overview');
        $subcategory->setCategoryId('General_Visits');
        $subcategory->setOrder(5);
        $subcategories[] = $subcategory;
    }

Callback Signature:
<pre><code>function(&amp;$subcategories)</code></pre>

- array `&$subcategories` An array containing a list of subcategories.

Usages:

[Dashboard::addSubcategories](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Dashboard/Dashboard.php#L74), [Goals::addSubcategories](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Goals/Goals.php#L85)

## Config

- [Config.badConfigurationFile](#configbadconfigurationfile)
- [Config.NoConfigurationFile](#confignoconfigurationfile)

### Config.badConfigurationFile

*Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/3.x-dev/core/FrontController.php) in line [291](https://github.com/piwik/piwik/blob/3.x-dev/core/FrontController.php#L291)*

Triggered when Piwik cannot access database data. This event can be used to start the installation process or to display a custom error
message.

Callback Signature:
<pre><code>function($exception)</code></pre>

- [Exception](http://php.net/class.Exception) `$exception` The exception thrown from trying to get an option value.

Usages:

[Installation::dispatch](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Installation/Installation.php#L95)


### Config.NoConfigurationFile

*Defined in [Piwik/Application/Kernel/EnvironmentValidator](https://github.com/piwik/piwik/blob/3.x-dev/core/Application/Kernel/EnvironmentValidator.php) in line [102](https://github.com/piwik/piwik/blob/3.x-dev/core/Application/Kernel/EnvironmentValidator.php#L102)*

Triggered when the configuration file cannot be found or read, which usually means Piwik is not installed yet. This event can be used to start the installation process or to display a custom error message.

Callback Signature:
<pre><code>function($exception)</code></pre>

- [\Exception](http://php.net/class.\Exception) `$exception` The exception that was thrown by `Config::getInstance()`.

Usages:

[Installation::dispatch](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Installation/Installation.php#L95), [LanguagesManager::initLanguage](https://github.com/piwik/piwik/blob/3.x-dev/plugins/LanguagesManager/LanguagesManager.php#L93)

## Console

- [Console.filterCommands](#consolefiltercommands)

### Console.filterCommands

*Defined in [Piwik/Console](https://github.com/piwik/piwik/blob/3.x-dev/core/Console.php) in line [128](https://github.com/piwik/piwik/blob/3.x-dev/core/Console.php#L128)*

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

*Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/3.x-dev/core/FrontController.php) in line [515](https://github.com/piwik/piwik/blob/3.x-dev/core/FrontController.php#L515)*

Triggered directly before controller actions are dispatched. This event exists for convenience and is triggered directly after the [Request.dispatch](/api-reference/events#requestdispatch)
event is triggered.

It can be used to do the same things as the [Request.dispatch](/api-reference/events#requestdispatch) event, but for one controller
action only. Using this event will result in a little less code than [Request.dispatch](/api-reference/events#requestdispatch).

Callback Signature:
<pre><code>function(&amp;$parameters)</code></pre>

- array `&$parameters` The arguments passed to the controller action.


### Controller.$module.$action.end

*Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/3.x-dev/core/FrontController.php) in line [532](https://github.com/piwik/piwik/blob/3.x-dev/core/FrontController.php#L532)*

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

*Defined in [Piwik/Updater](https://github.com/piwik/piwik/blob/3.x-dev/core/Updater.php) in line [479](https://github.com/piwik/piwik/blob/3.x-dev/core/Updater.php#L479)*

Triggered after Piwik has been updated.

Usages:

[CustomPiwikJs::updateTracker](https://github.com/piwik/piwik/blob/3.x-dev/plugins/CustomPiwikJs/CustomPiwikJs.php#L29)

## CronArchive

- [CronArchive.archiveSingleSite.finish](#cronarchivearchivesinglesitefinish)
- [CronArchive.archiveSingleSite.start](#cronarchivearchivesinglesitestart)
- [CronArchive.end](#cronarchiveend)
- [CronArchive.filterWebsiteIds](#cronarchivefilterwebsiteids)
- [CronArchive.getIdSitesNotUsingTracker](#cronarchivegetidsitesnotusingtracker)
- [CronArchive.init.finish](#cronarchiveinitfinish)
- [CronArchive.init.start](#cronarchiveinitstart)

### CronArchive.archiveSingleSite.finish

*Defined in [Piwik/CronArchive](https://github.com/piwik/piwik/blob/3.x-dev/core/CronArchive.php) in line [422](https://github.com/piwik/piwik/blob/3.x-dev/core/CronArchive.php#L422)*

This event is triggered immediately after the cron archiving process starts archiving data for a single site.

Callback Signature:
<pre><code>function($idSite, $completed)</code></pre>

- int `$idSite` The ID of the site we're archiving data for.


### CronArchive.archiveSingleSite.start

*Defined in [Piwik/CronArchive](https://github.com/piwik/piwik/blob/3.x-dev/core/CronArchive.php) in line [412](https://github.com/piwik/piwik/blob/3.x-dev/core/CronArchive.php#L412)*

This event is triggered before the cron archiving process starts archiving data for a single site.

Callback Signature:
<pre><code>function($idSite)</code></pre>

- int `$idSite` The ID of the site we're archiving data for.


### CronArchive.end

*Defined in [Piwik/CronArchive](https://github.com/piwik/piwik/blob/3.x-dev/core/CronArchive.php) in line [474](https://github.com/piwik/piwik/blob/3.x-dev/core/CronArchive.php#L474)*

This event is triggered after archiving.

Callback Signature:
<pre><code>function($this)</code></pre>

- CronArchive `$this` 

Usages:

[CustomPiwikJs::updateTracker](https://github.com/piwik/piwik/blob/3.x-dev/plugins/CustomPiwikJs/CustomPiwikJs.php#L29)


### CronArchive.filterWebsiteIds

*Defined in [Piwik/CronArchive](https://github.com/piwik/piwik/blob/3.x-dev/core/CronArchive.php) in line [1075](https://github.com/piwik/piwik/blob/3.x-dev/core/CronArchive.php#L1075)*

Triggered by the **core:archive** console command so plugins can modify the list of websites that the archiving process will be launched for. Plugins can use this hook to add websites to archive, remove websites to archive, or change
the order in which websites will be archived.

Callback Signature:
<pre><code>function(&amp;$websiteIds)</code></pre>

- array `&$websiteIds` The list of website IDs to launch the archiving process for.


### CronArchive.getIdSitesNotUsingTracker

*Defined in [Piwik/CronArchive](https://github.com/piwik/piwik/blob/3.x-dev/core/CronArchive.php) in line [1463](https://github.com/piwik/piwik/blob/3.x-dev/core/CronArchive.php#L1463)*

This event is triggered when detecting whether there are sites that do not use the tracker. By default we only archive a site when there was actually any visit since the last archiving.
However, some plugins do import data from another source instead of using the tracker and therefore
will never have any visits for this site. To make sure we still archive data for such a site when
archiving for this site is requested, you can listen to this event and add the idSite to the list of
sites that do not use the tracker.

Callback Signature:
<pre><code>function(&amp;$this-&gt;idSitesNotUsingTracker)</code></pre>

- bool `$idSitesNotUsingTracker` The list of idSites that rather import data instead of using the tracker


### CronArchive.init.finish

*Defined in [Piwik/CronArchive](https://github.com/piwik/piwik/blob/3.x-dev/core/CronArchive.php) in line [344](https://github.com/piwik/piwik/blob/3.x-dev/core/CronArchive.php#L344)*

This event is triggered after a CronArchive instance is initialized.

Callback Signature:
<pre><code>function($this-&gt;websites-&gt;getInitialSiteIds())</code></pre>

- array `$websiteIds` The list of website IDs this CronArchive instance is processing. This will be the entire list of IDs regardless of whether some have already been processed.


### CronArchive.init.start

*Defined in [Piwik/CronArchive](https://github.com/piwik/piwik/blob/3.x-dev/core/CronArchive.php) in line [302](https://github.com/piwik/piwik/blob/3.x-dev/core/CronArchive.php#L302)*

This event is triggered during initializing archiving.

Callback Signature:
<pre><code>function($this)</code></pre>

- CronArchive `$this` 

## Dashboard

- [Dashboard.changeDefaultDashboardLayout](#dashboardchangedefaultdashboardlayout)

### Dashboard.changeDefaultDashboardLayout

*Defined in [Piwik/Plugins/Dashboard/Dashboard](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Dashboard/Dashboard.php) in line [183](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Dashboard/Dashboard.php#L183)*

Allows other plugins to modify the default dashboard layout.

Callback Signature:
<pre><code>function(&amp;$defaultLayout)</code></pre>

- string `&$defaultLayout` JSON encoded string of the default dashboard layout. Contains an array of columns where each column is an array of widgets. Each widget is an associative array w/ the following elements: * **uniqueId**: The widget's unique ID. * **parameters**: The array of query parameters that should be used to get this widget's report.

## Db

- [Db.cannotConnectToDb](#dbcannotconnecttodb)
- [Db.getDatabaseConfig](#dbgetdatabaseconfig)

### Db.cannotConnectToDb

*Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/3.x-dev/core/FrontController.php) in line [268](https://github.com/piwik/piwik/blob/3.x-dev/core/FrontController.php#L268)*

Triggered when Piwik cannot connect to the database. This event can be used to start the installation process or to display a custom error
message.

Callback Signature:
<pre><code>function($exception)</code></pre>

- [Exception](http://php.net/class.Exception) `$exception` The exception thrown from creating and testing the database connection.

Usages:

[Installation::displayDbConnectionMessage](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Installation/Installation.php#L41)


### Db.getDatabaseConfig

*Defined in [Piwik/Db](https://github.com/piwik/piwik/blob/3.x-dev/core/Db.php) in line [92](https://github.com/piwik/piwik/blob/3.x-dev/core/Db.php#L92)*

Triggered before a database connection is established. This event can be used to change the settings used to establish a connection.

Callback Signature:
<pre><code>function(&amp;$dbConfig)</code></pre>

- array

## Dimension

- [Dimension.addDimensions](#dimensionadddimensions)
- [Dimension.filterDimensions](#dimensionfilterdimensions)

### Dimension.addDimensions

*Defined in [Piwik/Columns/Dimension](https://github.com/piwik/piwik/blob/3.x-dev/core/Columns/Dimension.php) in line [201](https://github.com/piwik/piwik/blob/3.x-dev/core/Columns/Dimension.php#L201)*

Triggered to add new dimensions that cannot be picked up automatically by the platform. This is useful if the plugin allows a user to create reports / dimensions dynamically. For example
CustomDimensions or CustomVariables. There are a variable number of dimensions in this case and it
wouldn't be really possible to create a report file for one of these dimensions as it is not known
how many Custom Dimensions will exist.

**Example**

    public function addDimension(&$dimensions)
    {
        $dimensions[] = new MyCustomDimension();
    }

Callback Signature:
<pre><code>function(&amp;$instances)</code></pre>

- [Dimension](/api-reference/Piwik/Columns/Dimension) `$reports` An array of dimensions


### Dimension.filterDimensions

*Defined in [Piwik/Columns/Dimension](https://github.com/piwik/piwik/blob/3.x-dev/core/Columns/Dimension.php) in line [225](https://github.com/piwik/piwik/blob/3.x-dev/core/Columns/Dimension.php#L225)*

Triggered to filter / restrict dimensions. **Example**

    public function filterDimensions(&$dimensions)
    {
        foreach ($dimensions as $index => $dimension) {
             if ($dimension->getName() === 'Page URL') {}
                 unset($dimensions[$index]); // remove this dimension
             }
        }
    }

Callback Signature:
<pre><code>function(&amp;$instances)</code></pre>

- [Dimension](/api-reference/Piwik/Columns/Dimension) `$dimensions` An array of dimensions

## Environment

- [Environment.bootstrapped](#environmentbootstrapped)

### Environment.bootstrapped

*Defined in [Piwik/Application/Environment](https://github.com/piwik/piwik/blob/3.x-dev/core/Application/Environment.php) in line [98](https://github.com/piwik/piwik/blob/3.x-dev/core/Application/Environment.php#L98)*



## FrontController

- [FrontController.modifyErrorPage](#frontcontrollermodifyerrorpage)

### FrontController.modifyErrorPage

*Defined in [Piwik/ExceptionHandler](https://github.com/piwik/piwik/blob/3.x-dev/core/ExceptionHandler.php) in line [123](https://github.com/piwik/piwik/blob/3.x-dev/core/ExceptionHandler.php#L123)*

Triggered before a Piwik error page is displayed to the user. This event can be used to modify the content of the error page that is displayed when
an exception is caught.

Callback Signature:
<pre><code>function(&amp;$result, $ex)</code></pre>

- string `&$result` The HTML of the error page.

- [Exception](http://php.net/class.Exception) `$ex` The Exception displayed in the error page.

## Goals

- [Goals.getReportsWithGoalMetrics](#goalsgetreportswithgoalmetrics)

### Goals.getReportsWithGoalMetrics

*Defined in [Piwik/Plugins/Goals/Goals](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Goals/Goals.php) in line [242](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Goals/Goals.php#L242)*

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

## Insights

- [Insights.addReportToOverview](#insightsaddreporttooverview)

### Insights.addReportToOverview

*Defined in [Piwik/Plugins/Insights/API](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Insights/API.php) in line [67](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Insights/API.php#L67)*

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

[Actions::addReportToInsightsOverview](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Actions/Actions.php#L92), [Referrers::addReportToInsightsOverview](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Referrers/Referrers.php#L68), [UserCountry::addReportToInsightsOverview](https://github.com/piwik/piwik/blob/3.x-dev/plugins/UserCountry/UserCountry.php#L61)

## Installation

- [Installation.defaultSettingsForm.init](#installationdefaultsettingsforminit)
- [Installation.defaultSettingsForm.submit](#installationdefaultsettingsformsubmit)

### Installation.defaultSettingsForm.init

*Defined in [Piwik/Plugins/Installation/Controller](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Installation/Controller.php) in line [407](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Installation/Controller.php#L407)*

Triggered on initialization of the form to customize default Piwik settings (at the end of the installation process).

Callback Signature:
<pre><code>function($form)</code></pre>

- \Piwik\Plugins\Installation\FormDefaultSettings `$form` 

Usages:

[PrivacyManager::installationFormInit](https://github.com/piwik/piwik/blob/3.x-dev/plugins/PrivacyManager/PrivacyManager.php#L174)


### Installation.defaultSettingsForm.submit

*Defined in [Piwik/Plugins/Installation/Controller](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Installation/Controller.php) in line [418](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Installation/Controller.php#L418)*

Triggered on submission of the form to customize default Piwik settings (at the end of the installation process).

Callback Signature:
<pre><code>function($form)</code></pre>

- \Piwik\Plugins\Installation\FormDefaultSettings `$form` 

Usages:

[PrivacyManager::installationFormSubmit](https://github.com/piwik/piwik/blob/3.x-dev/plugins/PrivacyManager/PrivacyManager.php#L197)

## LanguageManager

- [LanguageManager.getAvailableLanguages](#languagemanagergetavailablelanguages)

### LanguageManager.getAvailableLanguages

*Defined in [Piwik/Plugins/LanguagesManager/API](https://github.com/piwik/piwik/blob/3.x-dev/plugins/LanguagesManager/API.php) in line [80](https://github.com/piwik/piwik/blob/3.x-dev/plugins/LanguagesManager/API.php#L80)*

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

*Defined in [Piwik/Plugins/Live/Model](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Live/Model.php) in line [300](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Live/Model.php#L300)*



Callback Signature:
<pre><code>function(&amp;$idSites)</code></pre>


### Live.getAllVisitorDetails

*Defined in [Piwik/Plugins/Live/Visitor](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Live/Visitor.php) in line [74](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Live/Visitor.php#L74)*

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

[Actions::extendVisitorDetails](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Actions/Actions.php#L43), [CoreHome::extendVisitorDetails](https://github.com/piwik/piwik/blob/3.x-dev/plugins/CoreHome/CoreHome.php#L42), [CustomVariables::extendVisitorDetails](https://github.com/piwik/piwik/blob/3.x-dev/plugins/CustomVariables/CustomVariables.php#L40), [DevicePlugins::extendVisitorDetails](https://github.com/piwik/piwik/blob/3.x-dev/plugins/DevicePlugins/DevicePlugins.php#L32), [DevicesDetection::extendVisitorDetails](https://github.com/piwik/piwik/blob/3.x-dev/plugins/DevicesDetection/DevicesDetection.php#L30), [Events::extendVisitorDetails](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Events/Events.php#L35), [Provider::extendVisitorDetails](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Provider/Provider.php#L45), [Referrers::extendVisitorDetails](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Referrers/Referrers.php#L54), [Resolution::extendVisitorDetails](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Resolution/Resolution.php#L30), [UserCountry::extendVisitorDetails](https://github.com/piwik/piwik/blob/3.x-dev/plugins/UserCountry/UserCountry.php#L44), [UserLanguage::extendVisitorDetails](https://github.com/piwik/piwik/blob/3.x-dev/plugins/UserLanguage/UserLanguage.php#L30), [VisitTime::extendVisitorDetails](https://github.com/piwik/piwik/blob/3.x-dev/plugins/VisitTime/VisitTime.php#L24), [VisitorInterest::extendVisitorDetails](https://github.com/piwik/piwik/blob/3.x-dev/plugins/VisitorInterest/VisitorInterest.php#L41)


### Live.getExtraVisitorDetails

*Defined in [Piwik/Plugins/Live/API](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Live/API.php) in line [247](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Live/API.php#L247)*

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

*Defined in [Piwik/Plugins/Live/VisitorFactory](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Live/VisitorFactory.php) in line [39](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Live/VisitorFactory.php#L39)*

Triggered while visit is filtering in live plugin. Subscribers to this
event can force the use of a custom visitor object that extends from
Piwik\Plugins\Live\VisitorInterface.

Callback Signature:
<pre><code>function(&amp;$visitor, $visitorRawData)</code></pre>

- \Piwik\Plugins\Live\VisitorInterface `&$visitor` Initialized to null, but can be set to a new visitor object. If it isn't modified Piwik uses the default class.

- array `$visitorRawData` Raw data using in Visitor object constructor.

## MeasurableSettings

- [MeasurableSettings.updated](#measurablesettingsupdated)

### MeasurableSettings.updated

*Defined in [Piwik/Settings/Measurable/MeasurableSettings](https://github.com/piwik/piwik/blob/3.x-dev/core/Settings/Measurable/MeasurableSettings.php) in line [139](https://github.com/piwik/piwik/blob/3.x-dev/core/Settings/Measurable/MeasurableSettings.php#L139)*

Triggered after a plugin settings have been updated. **Example**

    Piwik::addAction('MeasurableSettings.updated', function (MeasurableSettings $settings) {
        $value = $settings->someSetting->getValue();
        // Do something with the new setting value
    });

Callback Signature:
<pre><code>function($this, $this-&gt;idSite)</code></pre>

- Settings `$settings` The plugin settings object.

## Metrics

- [Metrics.getDefaultMetricDocumentationTranslations](#metricsgetdefaultmetricdocumentationtranslations)
- [Metrics.getDefaultMetricTranslations](#metricsgetdefaultmetrictranslations)

### Metrics.getDefaultMetricDocumentationTranslations

*Defined in [Piwik/Metrics](https://github.com/piwik/piwik/blob/3.x-dev/core/Metrics.php) in line [417](https://github.com/piwik/piwik/blob/3.x-dev/core/Metrics.php#L417)*

Use this event to register translations for metrics documentation processed by your plugin.

Callback Signature:
<pre><code>function(&amp;$translations)</code></pre>

- string `&$translations` The array mapping of column_name => Plugin_TranslationForColumnDocumentation

Usages:

[Actions::addMetricDocumentationTranslations](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Actions/Actions.php#L72), [Contents::addMetricDocumentationTranslations](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Contents/Contents.php#L39), [Events::addMetricDocumentationTranslations](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Events/Events.php#L45)


### Metrics.getDefaultMetricTranslations

*Defined in [Piwik/Metrics](https://github.com/piwik/piwik/blob/3.x-dev/core/Metrics.php) in line [305](https://github.com/piwik/piwik/blob/3.x-dev/core/Metrics.php#L305)*

Use this event to register translations for metrics processed by your plugin.

Callback Signature:
<pre><code>function(&amp;$translations)</code></pre>

- string `&$translations` The array mapping of column_name => Plugin_TranslationForColumn

Usages:

[Actions::addMetricTranslations](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Actions/Actions.php#L49), [Contents::addMetricTranslations](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Contents/Contents.php#L27), [DevicePlugins::addMetricTranslations](https://github.com/piwik/piwik/blob/3.x-dev/plugins/DevicePlugins/DevicePlugins.php#L40), [Events::addMetricTranslations](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Events/Events.php#L40), [Goals::addMetricTranslations](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Goals/Goals.php#L112), [MultiSites::addMetricTranslations](https://github.com/piwik/piwik/blob/3.x-dev/plugins/MultiSites/MultiSites.php#L28), [VisitFrequency::addMetricTranslations](https://github.com/piwik/piwik/blob/3.x-dev/plugins/VisitFrequency/VisitFrequency.php#L26)

## MobileMessaging

- [MobileMessaging.deletePhoneNumber](#mobilemessagingdeletephonenumber)

### MobileMessaging.deletePhoneNumber

*Defined in [Piwik/Plugins/MobileMessaging/API](https://github.com/piwik/piwik/blob/3.x-dev/plugins/MobileMessaging/API.php) in line [211](https://github.com/piwik/piwik/blob/3.x-dev/plugins/MobileMessaging/API.php#L211)*

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

[CustomAlerts::removePhoneNumberFromAllAlerts](https://github.com/piwik/piwik/blob/3.x-dev/plugins/CustomAlerts/CustomAlerts.php#L114), [ScheduledReports::deletePhoneNumber](https://github.com/piwik/piwik/blob/3.x-dev/plugins/ScheduledReports/ScheduledReports.php#L446)

## Piwik

- [Piwik.getJavascriptCode](#piwikgetjavascriptcode)

### Piwik.getJavascriptCode

*Defined in [Piwik/Tracker/TrackerCodeGenerator](https://github.com/piwik/piwik/blob/3.x-dev/core/Tracker/TrackerCodeGenerator.php) in line [149](https://github.com/piwik/piwik/blob/3.x-dev/core/Tracker/TrackerCodeGenerator.php#L149)*

Triggered when generating JavaScript tracking code server side. Plugins can use
this event to customise the JavaScript tracking code that is displayed to the
user.

Callback Signature:
<pre><code>function(&amp;$codeImpl, $parameters)</code></pre>

- array `&$codeImpl` An array containing snippets of code that the event handler can modify. Will contain the following elements: - **idSite**: The ID of the site being tracked. - **piwikUrl**: The tracker URL to use. - **options**: A string of JavaScript code that customises the JavaScript tracker. - **optionsBeforeTrackerUrl**: A string of JavaScript code that customises the JavaScript tracker inside of anonymous function before adding setTrackerUrl into paq. - **protocol**: Piwik url protocol. The **httpsPiwikUrl** element can be set if the HTTPS domain is different from the normal domain.

- array `$parameters` The parameters supplied to `TrackerCodeGenerator::generate()`.

## Platform

- [Platform.initialized](#platforminitialized)
- [Platform.initialized](#platforminitialized)

### Platform.initialized

*Defined in [Piwik/Plugins/Widgetize/tests/Integration/WidgetTest](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Widgetize/tests/System/WidgetTest.php) in line [64](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Widgetize/tests/System/WidgetTest.php#L64)*



Usages:

[CoreUpdater::updateCheck](https://github.com/piwik/piwik/blob/3.x-dev/plugins/CoreUpdater/CoreUpdater.php#L93), [LanguagesManager::initLanguage](https://github.com/piwik/piwik/blob/3.x-dev/plugins/LanguagesManager/LanguagesManager.php#L93), [UsersManager::onPlatformInitialized](https://github.com/piwik/piwik/blob/3.x-dev/plugins/UsersManager/UsersManager.php#L41)


### Platform.initialized

*Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/3.x-dev/core/FrontController.php) in line [366](https://github.com/piwik/piwik/blob/3.x-dev/core/FrontController.php#L366)*

Triggered after the platform is initialized and after the user has been authenticated, but before the platform has handled the request. Piwik uses this event to check for updates to Piwik.

Usages:

[CoreUpdater::updateCheck](https://github.com/piwik/piwik/blob/3.x-dev/plugins/CoreUpdater/CoreUpdater.php#L93), [LanguagesManager::initLanguage](https://github.com/piwik/piwik/blob/3.x-dev/plugins/LanguagesManager/LanguagesManager.php#L93), [UsersManager::onPlatformInitialized](https://github.com/piwik/piwik/blob/3.x-dev/plugins/UsersManager/UsersManager.php#L41)

## PluginManager

- [PluginManager.pluginActivated](#pluginmanagerpluginactivated)
- [PluginManager.pluginDeactivated](#pluginmanagerplugindeactivated)
- [PluginManager.pluginInstalled](#pluginmanagerplugininstalled)
- [PluginManager.pluginUninstalled](#pluginmanagerpluginuninstalled)

### PluginManager.pluginActivated

*Defined in [Piwik/Plugin/Manager](https://github.com/piwik/piwik/blob/3.x-dev/core/Plugin/Manager.php) in line [501](https://github.com/piwik/piwik/blob/3.x-dev/core/Plugin/Manager.php#L501)*

Event triggered after a plugin has been activated.

Callback Signature:
<pre><code>function($pluginName)</code></pre>

- string `$pluginName` The plugin that has been activated.

Usages:

[CustomPiwikJs::updateTracker](https://github.com/piwik/piwik/blob/3.x-dev/plugins/CustomPiwikJs/CustomPiwikJs.php#L29)


### PluginManager.pluginDeactivated

*Defined in [Piwik/Plugin/Manager](https://github.com/piwik/piwik/blob/3.x-dev/core/Plugin/Manager.php) in line [338](https://github.com/piwik/piwik/blob/3.x-dev/core/Plugin/Manager.php#L338)*

Event triggered after a plugin has been deactivated.

Callback Signature:
<pre><code>function($pluginName)</code></pre>

- string `$pluginName` The plugin that has been deactivated.

Usages:

[CustomPiwikJs::updateTracker](https://github.com/piwik/piwik/blob/3.x-dev/plugins/CustomPiwikJs/CustomPiwikJs.php#L29)


### PluginManager.pluginInstalled

*Defined in [Piwik/Plugin/Manager](https://github.com/piwik/piwik/blob/3.x-dev/core/Plugin/Manager.php) in line [1099](https://github.com/piwik/piwik/blob/3.x-dev/core/Plugin/Manager.php#L1099)*

Event triggered after a new plugin has been installed. Note: Might be triggered more than once if the config file is not writable

Callback Signature:
<pre><code>function($pluginName)</code></pre>

- string `$pluginName` The plugin that has been installed.

Usages:

[CustomPiwikJs::updateTracker](https://github.com/piwik/piwik/blob/3.x-dev/plugins/CustomPiwikJs/CustomPiwikJs.php#L29)


### PluginManager.pluginUninstalled

*Defined in [Piwik/Plugin/Manager](https://github.com/piwik/piwik/blob/3.x-dev/core/Plugin/Manager.php) in line [427](https://github.com/piwik/piwik/blob/3.x-dev/core/Plugin/Manager.php#L427)*

Event triggered after a plugin has been uninstalled.

Callback Signature:
<pre><code>function($pluginName)</code></pre>

- string `$pluginName` The plugin that has been uninstalled.

Usages:

[CustomPiwikJs::updateTracker](https://github.com/piwik/piwik/blob/3.x-dev/plugins/CustomPiwikJs/CustomPiwikJs.php#L29)

## Provider

- [Provider.getCleanHostname](#providergetcleanhostname)

### Provider.getCleanHostname

*Defined in [Piwik/Plugins/Provider/Provider](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Provider/Provider.php) in line [113](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Provider/Provider.php#L113)*

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

*Defined in [Piwik/Plugins/Referrers/SearchEngine](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Referrers/SearchEngine.php) in line [66](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Referrers/SearchEngine.php#L66)*



Callback Signature:
<pre><code>function(&amp;$this-&gt;definitionList)</code></pre>


### Referrer.addSocialUrls

*Defined in [Piwik/Plugins/Referrers/Social](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Referrers/Social.php) in line [63](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Referrers/Social.php#L63)*



Callback Signature:
<pre><code>function(&amp;$this-&gt;definitionList)</code></pre>

## Report

- [Report.addReports](#reportaddreports)
- [Report.filterReports](#reportfilterreports)

### Report.addReports

*Defined in [Piwik/Plugin/ReportsProvider](https://github.com/piwik/piwik/blob/3.x-dev/core/Plugin/ReportsProvider.php) in line [106](https://github.com/piwik/piwik/blob/3.x-dev/core/Plugin/ReportsProvider.php#L106)*

Triggered to add new reports that cannot be picked up automatically by the platform. This is useful if the plugin allows a user to create reports / dimensions dynamically. For example
CustomDimensions or CustomVariables. There are a variable number of dimensions in this case and it
wouldn't be really possible to create a report file for one of these dimensions as it is not known
how many Custom Dimensions will exist.

**Example**

    public function addReport(&$reports)
    {
        $reports[] = new MyCustomReport();
    }

Callback Signature:
<pre><code>function(&amp;$instances)</code></pre>

- [Report](/api-reference/Piwik/Plugin/Report) `$reports` An array of reports


### Report.filterReports

*Defined in [Piwik/Plugin/ReportsProvider](https://github.com/piwik/piwik/blob/3.x-dev/core/Plugin/ReportsProvider.php) in line [128](https://github.com/piwik/piwik/blob/3.x-dev/core/Plugin/ReportsProvider.php#L128)*

Triggered to filter / restrict reports. **Example**

    public function filterReports(&$reports)
    {
        foreach ($reports as $index => $report) {
             if ($report->getCategory() === 'Actions') {}
                 unset($reports[$index]); // remove all reports having this action
             }
        }
    }

Callback Signature:
<pre><code>function(&amp;$instances)</code></pre>

- [Report](/api-reference/Piwik/Plugin/Report) `$reports` An array of reports

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

*Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/3.x-dev/core/FrontController.php) in line [497](https://github.com/piwik/piwik/blob/3.x-dev/core/FrontController.php#L497)*

Triggered directly before controller actions are dispatched. This event can be used to modify the parameters passed to one or more controller actions
and can be used to change the controller action being dispatched to.

Callback Signature:
<pre><code>function(&amp;$module, &amp;$action, &amp;$parameters)</code></pre>

- string `&$module` The name of the plugin being dispatched to.

- string `&$action` The name of the controller method being dispatched to.

- array `&$parameters` The arguments passed to the controller action.

Usages:

[CustomAlerts::checkControllerPermission](https://github.com/piwik/piwik/blob/3.x-dev/plugins/CustomAlerts/CustomAlerts.php#L45), [Installation::dispatchIfNotInstalledYet](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Installation/Installation.php#L61), [LanguagesManager::initLanguage](https://github.com/piwik/piwik/blob/3.x-dev/plugins/LanguagesManager/LanguagesManager.php#L93), [SitesManager::redirectDashboardToWelcomePage](https://github.com/piwik/piwik/blob/3.x-dev/plugins/SitesManager/SitesManager.php#L45)


### Request.dispatch.end

*Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/3.x-dev/core/FrontController.php) in line [542](https://github.com/piwik/piwik/blob/3.x-dev/core/FrontController.php#L542)*

Triggered after a controller action is successfully called. This event can be used to modify controller action output (if any) before the output is returned.

Callback Signature:
<pre><code>function(&amp;$result, $module, $action, $parameters)</code></pre>

- mixed `&$result` The controller action result.

- array `$parameters` The arguments passed to the controller action.


### Request.dispatchCoreAndPluginUpdatesScreen

*Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/3.x-dev/core/FrontController.php) in line [306](https://github.com/piwik/piwik/blob/3.x-dev/core/FrontController.php#L306)*

Triggered just after the platform is initialized and plugins are loaded. This event can be used to do early initialization.

_Note: At this point the user is not authenticated yet._

Usages:

[CoreUpdater::dispatch](https://github.com/piwik/piwik/blob/3.x-dev/plugins/CoreUpdater/CoreUpdater.php#L53), [LanguagesManager::initLanguage](https://github.com/piwik/piwik/blob/3.x-dev/plugins/LanguagesManager/LanguagesManager.php#L93)


### Request.getRenamedModuleAndAction

*Defined in [Piwik/API/Request](https://github.com/piwik/piwik/blob/3.x-dev/core/API/Request.php) in line [159](https://github.com/piwik/piwik/blob/3.x-dev/core/API/Request.php#L159)*

This event is posted in the Request dispatcher and can be used to overwrite the Module and Action to dispatch. This is useful when some Controller methods or API methods have been renamed or moved to another plugin.

Callback Signature:
<pre><code>function(&amp;$module, &amp;$action)</code></pre>

- $module

- $action

Usages:

[DevicePlugins::renameUserSettingsModuleAndAction](https://github.com/piwik/piwik/blob/3.x-dev/plugins/DevicePlugins/DevicePlugins.php#L49), [DevicesDetection::renameUserSettingsModuleAndAction](https://github.com/piwik/piwik/blob/3.x-dev/plugins/DevicesDetection/DevicesDetection.php#L52), [ProfessionalServices::renameProfessionalServicesModule](https://github.com/piwik/piwik/blob/3.x-dev/plugins/ProfessionalServices/ProfessionalServices.php#L34), [Referrers::renameDeprecatedModuleAndAction](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Referrers/Referrers.php#L47), [Resolution::renameUserSettingsModuleAndAction](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Resolution/Resolution.php#L37), [RssWidget::renameExampleRssWidgetModule](https://github.com/piwik/piwik/blob/3.x-dev/plugins/RssWidget/RssWidget.php#L32), [ScheduledReports::renameDeprecatedModuleAndAction](https://github.com/piwik/piwik/blob/3.x-dev/plugins/ScheduledReports/ScheduledReports.php#L103), [UserLanguage::renameUserSettingsModuleAndAction](https://github.com/piwik/piwik/blob/3.x-dev/plugins/UserLanguage/UserLanguage.php#L49)


### Request.initAuthenticationObject

*Defined in [Piwik/Plugins/API/tests/Integration/APITest](https://github.com/piwik/piwik/blob/3.x-dev/plugins/API/tests/Integration/APITest.php) in line [87](https://github.com/piwik/piwik/blob/3.x-dev/plugins/API/tests/Integration/APITest.php#L87)*



Usages:

[Login::initAuthenticationObject](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Login/Login.php#L89)


### Request.initAuthenticationObject

*Defined in [Piwik/Plugins/BulkTracking/Tracker/Handler](https://github.com/piwik/piwik/blob/3.x-dev/plugins/BulkTracking/Tracker/Handler.php) in line [116](https://github.com/piwik/piwik/blob/3.x-dev/plugins/BulkTracking/Tracker/Handler.php#L116)*



Usages:

[Login::initAuthenticationObject](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Login/Login.php#L89)


### Request.initAuthenticationObject

*Defined in [Piwik/Plugins/Overlay/API](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Overlay/API.php) in line [126](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Overlay/API.php#L126)*

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

[Login::initAuthenticationObject](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Login/Login.php#L89)


### Request.initAuthenticationObject

*Defined in [Piwik/Tracker/Request](https://github.com/piwik/piwik/blob/3.x-dev/core/Tracker/Request.php) in line [175](https://github.com/piwik/piwik/blob/3.x-dev/core/Tracker/Request.php#L175)*



Usages:

[Login::initAuthenticationObject](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Login/Login.php#L89)


### Request.initAuthenticationObject

*Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/3.x-dev/core/FrontController.php) in line [335](https://github.com/piwik/piwik/blob/3.x-dev/core/FrontController.php#L335)*

Triggered before the user is authenticated, when the global authentication object should be created. Plugins that provide their own authentication implementation should use this event
to set the global authentication object (which must derive from [Auth](/api-reference/Piwik/Auth)).

**Example**

    Piwik::addAction('Request.initAuthenticationObject', function() {
        StaticContainer::getContainer()->set('Piwik\Auth', new MyAuthImplementation());
    });

Usages:

[Login::initAuthenticationObject](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Login/Login.php#L89)

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

*Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/3.x-dev/plugins/ScheduledReports/API.php) in line [829](https://github.com/piwik/piwik/blob/3.x-dev/plugins/ScheduledReports/API.php#L829)*

Triggered when we're determining if a scheduled report transport medium can handle sending multiple Piwik reports in one scheduled report or not. Plugins that provide their own transport mediums should use this
event to specify whether their backend can send more than one Piwik report
at a time.

Callback Signature:
<pre><code>function(&amp;$allowMultipleReports, $reportType)</code></pre>

- bool `&$allowMultipleReports` Whether the backend type can handle multiple Piwik reports or not.

- string `$reportType` A string ID describing how the report is sent, eg, `'sms'` or `'email'`.

Usages:

[MobileMessaging::allowMultipleReports](https://github.com/piwik/piwik/blob/3.x-dev/plugins/MobileMessaging/MobileMessaging.php#L176), [ScheduledReports::allowMultipleReports](https://github.com/piwik/piwik/blob/3.x-dev/plugins/ScheduledReports/ScheduledReports.php#L283)


### ScheduledReports.getRendererInstance

*Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/3.x-dev/plugins/ScheduledReports/API.php) in line [462](https://github.com/piwik/piwik/blob/3.x-dev/plugins/ScheduledReports/API.php#L462)*

Triggered when obtaining a renderer instance based on the scheduled report output format. Plugins that provide new scheduled report output formats should use this event to
handle their new report formats.

Callback Signature:
<pre><code>function(&amp;$reportRenderer, $reportType, $outputType, $report)</code></pre>

- ReportRenderer `&$reportRenderer` This variable should be set to an instance that extends Piwik\ReportRenderer by one of the event subscribers.

- string `$reportType` A string ID describing how the report is sent, eg, `'sms'` or `'email'`.

- string `$outputType` The output format of the report, eg, `'html'`, `'pdf'`, etc.

- array `&$report` An array describing the scheduled report that is being generated.

Usages:

[MobileMessaging::getRendererInstance](https://github.com/piwik/piwik/blob/3.x-dev/plugins/MobileMessaging/MobileMessaging.php#L163), [ScheduledReports::getRendererInstance](https://github.com/piwik/piwik/blob/3.x-dev/plugins/ScheduledReports/ScheduledReports.php#L268)


### ScheduledReports.getReportFormats

*Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/3.x-dev/plugins/ScheduledReports/API.php) in line [876](https://github.com/piwik/piwik/blob/3.x-dev/plugins/ScheduledReports/API.php#L876)*

Triggered when gathering all available scheduled report formats. Plugins that provide their own scheduled report format should use
this event to make their format available.

Callback Signature:
<pre><code>function(&amp;$reportFormats, $reportType)</code></pre>

- array `&$reportFormats` An array mapping string IDs for each available scheduled report format with icon paths for those formats. Add your new format's ID to this array.

- string `$reportType` A string ID describing how the report is sent, eg, `'sms'` or `'email'`.

Usages:

[MobileMessaging::getReportFormats](https://github.com/piwik/piwik/blob/3.x-dev/plugins/MobileMessaging/MobileMessaging.php#L149), [ScheduledReports::getReportFormats](https://github.com/piwik/piwik/blob/3.x-dev/plugins/ScheduledReports/ScheduledReports.php#L213)


### ScheduledReports.getReportMetadata

*Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/3.x-dev/plugins/ScheduledReports/API.php) in line [801](https://github.com/piwik/piwik/blob/3.x-dev/plugins/ScheduledReports/API.php#L801)*

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

[MobileMessaging::getReportMetadata](https://github.com/piwik/piwik/blob/3.x-dev/plugins/MobileMessaging/MobileMessaging.php#L126), [ScheduledReports::getReportMetadata](https://github.com/piwik/piwik/blob/3.x-dev/plugins/ScheduledReports/ScheduledReports.php#L184)


### ScheduledReports.getReportParameters

*Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/3.x-dev/plugins/ScheduledReports/API.php) in line [655](https://github.com/piwik/piwik/blob/3.x-dev/plugins/ScheduledReports/API.php#L655)*

Triggered when gathering the available parameters for a scheduled report type. Plugins that provide their own scheduled report transport mediums should use this
event to list the available report parameters for their transport medium.

Callback Signature:
<pre><code>function(&amp;$availableParameters, $reportType)</code></pre>

- array `&$availableParameters` The list of available parameters for this report type. This is an array that maps paramater IDs with a boolean that indicates whether the parameter is mandatory or not.

- string `$reportType` A string ID describing how the report is sent, eg, `'sms'` or `'email'`.

Usages:

[MobileMessaging::getReportParameters](https://github.com/piwik/piwik/blob/3.x-dev/plugins/MobileMessaging/MobileMessaging.php#L156), [ScheduledReports::getReportParameters](https://github.com/piwik/piwik/blob/3.x-dev/plugins/ScheduledReports/ScheduledReports.php#L220)


### ScheduledReports.getReportRecipients

*Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/3.x-dev/plugins/ScheduledReports/API.php) in line [907](https://github.com/piwik/piwik/blob/3.x-dev/plugins/ScheduledReports/API.php#L907)*

Triggered when getting the list of recipients of a scheduled report. Plugins that provide their own scheduled report transport medium should use this event
to extract the list of recipients their backend's specific scheduled report
format.

Callback Signature:
<pre><code>function(&amp;$recipients, $report[&#039;type&#039;], $report)</code></pre>

- array `&$recipients` An array of strings describing each of the scheduled reports recipients. Can be, for example, a list of email addresses or phone numbers or whatever else your plugin uses.

- string `$reportType` A string ID describing how the report is sent, eg, `'sms'` or `'email'`.

- array `$report` An array describing the scheduled report that is being generated.

Usages:

[MobileMessaging::getReportRecipients](https://github.com/piwik/piwik/blob/3.x-dev/plugins/MobileMessaging/MobileMessaging.php#L183), [ScheduledReports::getReportRecipients](https://github.com/piwik/piwik/blob/3.x-dev/plugins/ScheduledReports/ScheduledReports.php#L488)


### ScheduledReports.getReportTypes

*Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/3.x-dev/plugins/ScheduledReports/API.php) in line [852](https://github.com/piwik/piwik/blob/3.x-dev/plugins/ScheduledReports/API.php#L852)*

Triggered when gathering all available transport mediums. Plugins that provide their own transport mediums should use this
event to make their medium available.

Callback Signature:
<pre><code>function(&amp;$reportTypes)</code></pre>

- array `&$reportTypes` An array mapping transport medium IDs with the paths to those mediums' icons. Add your new backend's ID to this array.

Usages:

[MobileMessaging::getReportTypes](https://github.com/piwik/piwik/blob/3.x-dev/plugins/MobileMessaging/MobileMessaging.php#L144), [ScheduledReports::getReportTypes](https://github.com/piwik/piwik/blob/3.x-dev/plugins/ScheduledReports/ScheduledReports.php#L208)


### ScheduledReports.processReports

*Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/3.x-dev/plugins/ScheduledReports/API.php) in line [440](https://github.com/piwik/piwik/blob/3.x-dev/plugins/ScheduledReports/API.php#L440)*

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

[ScheduledReports::processReports](https://github.com/piwik/piwik/blob/3.x-dev/plugins/ScheduledReports/ScheduledReports.php#L227)


### ScheduledReports.sendReport

*Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/3.x-dev/plugins/ScheduledReports/API.php) in line [591](https://github.com/piwik/piwik/blob/3.x-dev/plugins/ScheduledReports/API.php#L591)*

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

[MobileMessaging::sendReport](https://github.com/piwik/piwik/blob/3.x-dev/plugins/MobileMessaging/MobileMessaging.php#L190), [ScheduledReports::sendReport](https://github.com/piwik/piwik/blob/3.x-dev/plugins/ScheduledReports/ScheduledReports.php#L290)


### ScheduledReports.validateReportParameters

*Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/3.x-dev/plugins/ScheduledReports/API.php) in line [682](https://github.com/piwik/piwik/blob/3.x-dev/plugins/ScheduledReports/API.php#L682)*

Triggered when validating the parameters for a scheduled report. Plugins that provide their own scheduled reports backend should use this
event to validate the custom parameters defined with ScheduledReports::getReportParameters().

Callback Signature:
<pre><code>function(&amp;$parameters, $reportType)</code></pre>

- array `&$parameters` The list of parameters for the scheduled report.

- string `$reportType` A string ID describing how the report is sent, eg, `'sms'` or `'email'`.

Usages:

[MobileMessaging::validateReportParameters](https://github.com/piwik/piwik/blob/3.x-dev/plugins/MobileMessaging/MobileMessaging.php#L107), [ScheduledReports::validateReportParameters](https://github.com/piwik/piwik/blob/3.x-dev/plugins/ScheduledReports/ScheduledReports.php#L140)

## SegmentEditor

- [SegmentEditor.deactivate](#segmenteditordeactivate)
- [SegmentEditor.update](#segmenteditorupdate)

### SegmentEditor.deactivate

*Defined in [Piwik/Plugins/SegmentEditor/API](https://github.com/piwik/piwik/blob/3.x-dev/plugins/SegmentEditor/API.php) in line [205](https://github.com/piwik/piwik/blob/3.x-dev/plugins/SegmentEditor/API.php#L205)*

Triggered before a segment is deleted or made invisible. This event can be used by plugins to throw an exception
or do something else.

Callback Signature:
<pre><code>function($idSegment)</code></pre>

- int `$idSegment` The ID of the segment being deleted.

Usages:

[ScheduledReports::segmentDeactivation](https://github.com/piwik/piwik/blob/3.x-dev/plugins/ScheduledReports/ScheduledReports.php#L557)


### SegmentEditor.update

*Defined in [Piwik/Plugins/SegmentEditor/API](https://github.com/piwik/piwik/blob/3.x-dev/plugins/SegmentEditor/API.php) in line [257](https://github.com/piwik/piwik/blob/3.x-dev/plugins/SegmentEditor/API.php#L257)*

Triggered before a segment is modified. This event can be used by plugins to throw an exception
or do something else.

Callback Signature:
<pre><code>function($idSegment, $bind)</code></pre>

- int `$idSegment` The ID of the segment which visibility is reduced.

Usages:

[ScheduledReports::segmentUpdated](https://github.com/piwik/piwik/blob/3.x-dev/plugins/ScheduledReports/ScheduledReports.php#L524)

## Segments

- [Segments.getKnownSegmentsToArchiveAllSites](#segmentsgetknownsegmentstoarchiveallsites)
- [Segments.getKnownSegmentsToArchiveForSite](#segmentsgetknownsegmentstoarchiveforsite)

### Segments.getKnownSegmentsToArchiveAllSites

*Defined in [Piwik/SettingsPiwik](https://github.com/piwik/piwik/blob/3.x-dev/core/SettingsPiwik.php) in line [89](https://github.com/piwik/piwik/blob/3.x-dev/core/SettingsPiwik.php#L89)*

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

[SegmentEditor::getKnownSegmentsToArchiveAllSites](https://github.com/piwik/piwik/blob/3.x-dev/plugins/SegmentEditor/SegmentEditor.php#L39)


### Segments.getKnownSegmentsToArchiveForSite

*Defined in [Piwik/SettingsPiwik](https://github.com/piwik/piwik/blob/3.x-dev/core/SettingsPiwik.php) in line [139](https://github.com/piwik/piwik/blob/3.x-dev/core/SettingsPiwik.php#L139)*

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

[SegmentEditor::getKnownSegmentsToArchiveForSite](https://github.com/piwik/piwik/blob/3.x-dev/plugins/SegmentEditor/SegmentEditor.php#L51)

## SEO

- [SEO.getMetricsProviders](#seogetmetricsproviders)

### SEO.getMetricsProviders

*Defined in [Piwik/Plugins/SEO/Metric/Aggregator](https://github.com/piwik/piwik/blob/3.x-dev/plugins/SEO/Metric/Aggregator.php) in line [61](https://github.com/piwik/piwik/blob/3.x-dev/plugins/SEO/Metric/Aggregator.php#L61)*

Use this event to register new SEO metrics providers.

Callback Signature:
<pre><code>function(&amp;$providers)</code></pre>

- array `&$providers` Contains an array of Piwik\Plugins\SEO\Metric\MetricsProvider instances.

## SitesManager

- [SitesManager.addSite.end](#sitesmanageraddsiteend)
- [SitesManager.deleteSite.end](#sitesmanagerdeletesiteend)
- [SitesManager.getImageTrackingCode](#sitesmanagergetimagetrackingcode)

### SitesManager.addSite.end

*Defined in [Piwik/Plugins/SitesManager/API](https://github.com/piwik/piwik/blob/3.x-dev/plugins/SitesManager/API.php) in line [654](https://github.com/piwik/piwik/blob/3.x-dev/plugins/SitesManager/API.php#L654)*

Triggered after a site has been added.

Callback Signature:
<pre><code>function($idSite)</code></pre>

- int `$idSite` The ID of the site that was added.


### SitesManager.deleteSite.end

*Defined in [Piwik/Plugins/SitesManager/API](https://github.com/piwik/piwik/blob/3.x-dev/plugins/SitesManager/API.php) in line [754](https://github.com/piwik/piwik/blob/3.x-dev/plugins/SitesManager/API.php#L754)*

Triggered after a site has been deleted. Plugins can use this event to remove site specific values or settings, such as removing all
goals that belong to a specific website. If you store any data related to a website you
should clean up that information here.

Callback Signature:
<pre><code>function($idSite)</code></pre>

- int `$idSite` The ID of the site being deleted.

Usages:

[CustomAlerts::deleteAlertsForSite](https://github.com/piwik/piwik/blob/3.x-dev/plugins/CustomAlerts/CustomAlerts.php#L95), [Goals::deleteSiteGoals](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Goals/Goals.php#L136), [ScheduledReports::deleteSiteReport](https://github.com/piwik/piwik/blob/3.x-dev/plugins/ScheduledReports/ScheduledReports.php#L119), [SitesManager::onSiteDeleted](https://github.com/piwik/piwik/blob/3.x-dev/plugins/SitesManager/SitesManager.php#L69), [UsersManager::deleteSite](https://github.com/piwik/piwik/blob/3.x-dev/plugins/UsersManager/UsersManager.php#L82)


### SitesManager.getImageTrackingCode

*Defined in [Piwik/Plugins/SitesManager/API](https://github.com/piwik/piwik/blob/3.x-dev/plugins/SitesManager/API.php) in line [162](https://github.com/piwik/piwik/blob/3.x-dev/plugins/SitesManager/API.php#L162)*

Triggered when generating image link tracking code server side. Plugins can use
this event to customise the image tracking code that is displayed to the
user.

Callback Signature:
<pre><code>function(&amp;$piwikUrl, &amp;$urlParams)</code></pre>

- string `$piwikHost` The domain and URL path to the Piwik installation, eg, `'examplepiwik.com/path/to/piwik'`.

- array `&$urlParams` The query parameters used in the <img> element's src URL. See Piwik's image tracking docs for more info.

## SystemSettings

- [SystemSettings.updated](#systemsettingsupdated)

### SystemSettings.updated

*Defined in [Piwik/Settings/Plugin/SystemSettings](https://github.com/piwik/piwik/blob/3.x-dev/core/Settings/Plugin/SystemSettings.php) in line [108](https://github.com/piwik/piwik/blob/3.x-dev/core/Settings/Plugin/SystemSettings.php#L108)*

Triggered after system settings have been updated. **Example**

    Piwik::addAction('SystemSettings.updated', function (SystemSettings $settings) {
        if ($settings->getPluginName() === 'PluginName') {
            $value = $settings->someSetting->getValue();
            // Do something with the new setting value
        }
    });

Callback Signature:
<pre><code>function($this)</code></pre>

- Settings `$settings` The plugin settings object.

## Tracker

- [Tracker.Cache.getSiteAttributes](#trackercachegetsiteattributes)
- [Tracker.detectReferrerSearchEngine](#trackerdetectreferrersearchengine)
- [Tracker.end](#trackerend)
- [Tracker.end](#trackerend)
- [Tracker.getDatabaseConfig](#trackergetdatabaseconfig)
- [Tracker.isExcludedVisit](#trackerisexcludedvisit)
- [Tracker.makeNewVisitObject](#trackermakenewvisitobject)
- [Tracker.newConversionInformation](#trackernewconversioninformation)
- [Tracker.PageUrl.getQueryParametersToExclude](#trackerpageurlgetqueryparameterstoexclude)
- [Tracker.Request.getIdSite](#trackerrequestgetidsite)
- [Tracker.setTrackerCacheGeneral](#trackersettrackercachegeneral)

### Tracker.Cache.getSiteAttributes

*Defined in [Piwik/Tracker/Cache](https://github.com/piwik/piwik/blob/3.x-dev/core/Tracker/Cache.php) in line [98](https://github.com/piwik/piwik/blob/3.x-dev/core/Tracker/Cache.php#L98)*

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

[Goals::fetchGoalsFromDb](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Goals/Goals.php#L258), [SitesManager::recordWebsiteDataInCache](https://github.com/piwik/piwik/blob/3.x-dev/plugins/SitesManager/SitesManager.php#L112), [UsersManager::recordAdminUsersInCache](https://github.com/piwik/piwik/blob/3.x-dev/plugins/UsersManager/UsersManager.php#L56)


### Tracker.detectReferrerSearchEngine

*Defined in [Piwik/Plugins/Referrers/Columns/Base](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Referrers/Columns/Base.php) in line [166](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Referrers/Columns/Base.php#L166)*

Triggered when detecting the search engine of a referrer URL. Plugins can use this event to provide custom search engine detection
logic.

Callback Signature:
<pre><code>function(&amp;$searchEngineInformation, $this-&gt;referrerUrl)</code></pre>

- array `&$searchEngineInformation` An array with the following information: - **name**: The search engine name. - **keywords**: The search keywords used. This parameter is initialized to the results of Piwik's default search engine detection logic.

- string


### Tracker.end

*Defined in [Piwik/Plugins/QueuedTracking/Commands/Process](https://github.com/piwik/piwik/blob/3.x-dev/plugins/QueuedTracking/Commands/Process.php) in line [92](https://github.com/piwik/piwik/blob/3.x-dev/plugins/QueuedTracking/Commands/Process.php#L92)*




### Tracker.end

*Defined in [Piwik/Tracker](https://github.com/piwik/piwik/blob/3.x-dev/core/Tracker.php) in line [102](https://github.com/piwik/piwik/blob/3.x-dev/core/Tracker.php#L102)*




### Tracker.getDatabaseConfig

*Defined in [Piwik/Tracker/Db](https://github.com/piwik/piwik/blob/3.x-dev/core/Tracker/Db.php) in line [262](https://github.com/piwik/piwik/blob/3.x-dev/core/Tracker/Db.php#L262)*

Triggered before a connection to the database is established by the Tracker. This event can be used to change the database connection settings used by the Tracker.

Callback Signature:
<pre><code>function(&amp;$configDb)</code></pre>

- array `$dbInfos` Reference to an array containing database connection info, including: - **host**: The host name or IP address to the MySQL database. - **username**: The username to use when connecting to the database. - **password**: The password to use when connecting to the database. - **dbname**: The name of the Piwik MySQL database. - **port**: The MySQL database port to use. - **adapter**: either `'PDO\MYSQL'` or `'MYSQLI'` - **type**: The MySQL engine to use, for instance 'InnoDB'


### Tracker.isExcludedVisit

*Defined in [Piwik/Tracker/VisitExcluded](https://github.com/piwik/piwik/blob/3.x-dev/core/Tracker/VisitExcluded.php) in line [93](https://github.com/piwik/piwik/blob/3.x-dev/core/Tracker/VisitExcluded.php#L93)*

Triggered on every tracking request. This event can be used to tell the Tracker not to record this particular action or visit.

Callback Signature:
<pre><code>function(&amp;$excluded)</code></pre>

- bool `&$excluded` Whether the request should be excluded or not. Initialized to `false`. Event subscribers should set it to `true` in order to exclude the request.


### Tracker.makeNewVisitObject

*Defined in [Piwik/Tracker/Visit/Factory](https://github.com/piwik/piwik/blob/3.x-dev/core/Tracker/Visit/Factory.php) in line [38](https://github.com/piwik/piwik/blob/3.x-dev/core/Tracker/Visit/Factory.php#L38)*

Triggered before a new **visit tracking object** is created. Subscribers to this
event can force the use of a custom visit tracking object that extends from
Piwik\Tracker\VisitInterface.

Callback Signature:
<pre><code>function(&amp;$visit)</code></pre>

- \Piwik\Tracker\VisitInterface `&$visit` Initialized to null, but can be set to a new visit object. If it isn't modified Piwik uses the default class.


### Tracker.newConversionInformation

*Defined in [Piwik/Tracker/GoalManager](https://github.com/piwik/piwik/blob/3.x-dev/core/Tracker/GoalManager.php) in line [707](https://github.com/piwik/piwik/blob/3.x-dev/core/Tracker/GoalManager.php#L707)*

Triggered before persisting a new [conversion entity](/guides/persistence-and-the-mysql-backend#conversions). This event can be used to modify conversion information or to add new information to be persisted.

This event is deprecated, use [Dimensions](http://developer.piwik.org/guides/dimensions) instead.

Callback Signature:
<pre><code>function(&amp;$conversion, $visitInformation, $request)</code></pre>

- array `&$conversion` The conversion entity. Read [this](/guides/persistence-and-the-mysql-backend#conversions) to see what it contains.

- array `$visitInformation` The visit entity that we are tracking a conversion for. See what information it contains [here](/guides/persistence-and-the-mysql-backend#visits).

- \Piwik\Tracker\Request `$request` An object describing the tracking request being processed.


### Tracker.PageUrl.getQueryParametersToExclude

*Defined in [Piwik/Tracker/PageUrl](https://github.com/piwik/piwik/blob/3.x-dev/core/Tracker/PageUrl.php) in line [95](https://github.com/piwik/piwik/blob/3.x-dev/core/Tracker/PageUrl.php#L95)*

Triggered before setting the action url in Piwik\Tracker\Action so plugins can register parameters to be excluded from the tracking URL (e.g. campaign parameters).

Callback Signature:
<pre><code>function(&amp;$parametersToExclude)</code></pre>

- array `&$parametersToExclude` An array of parameters to exclude from the tracking url.


### Tracker.Request.getIdSite

*Defined in [Piwik/Tracker/Request](https://github.com/piwik/piwik/blob/3.x-dev/core/Tracker/Request.php) in line [517](https://github.com/piwik/piwik/blob/3.x-dev/core/Tracker/Request.php#L517)*

Triggered when obtaining the ID of the site we are tracking a visit for. This event can be used to change the site ID so data is tracked for a different
website.

Callback Signature:
<pre><code>function(&amp;$idSite, $this-&gt;params)</code></pre>

- int `&$idSite` Initialized to the value of the **idsite** query parameter. If a subscriber sets this variable, the value it uses must be greater than 0.

- array `$params` The entire array of request parameters in the current tracking request.


### Tracker.setTrackerCacheGeneral

*Defined in [Piwik/Tracker/Cache](https://github.com/piwik/piwik/blob/3.x-dev/core/Tracker/Cache.php) in line [162](https://github.com/piwik/piwik/blob/3.x-dev/core/Tracker/Cache.php#L162)*

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

[PrivacyManager::setTrackerCacheGeneral](https://github.com/piwik/piwik/blob/3.x-dev/plugins/PrivacyManager/PrivacyManager.php#L153), [Referrers::setTrackerCacheGeneral](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Referrers/Referrers.php#L39), [UserCountry::setTrackerCacheGeneral](https://github.com/piwik/piwik/blob/3.x-dev/plugins/UserCountry/UserCountry.php#L66)

## Translate

- [Translate.getClientSideTranslationKeys](#translategetclientsidetranslationkeys)

### Translate.getClientSideTranslationKeys

*Defined in [Piwik/Translation/Translator](https://github.com/piwik/piwik/blob/3.x-dev/core/Translation/Translator.php) in line [167](https://github.com/piwik/piwik/blob/3.x-dev/core/Translation/Translator.php#L167)*

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

[Annotations::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Annotations/Annotations.php#L30), [CoreAdminHome::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/3.x-dev/plugins/CoreAdminHome/CoreAdminHome.php#L79), [CoreHome::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/3.x-dev/plugins/CoreHome/CoreHome.php#L249), [CorePluginsAdmin::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/3.x-dev/plugins/CorePluginsAdmin/CorePluginsAdmin.php#L53), [CoreVisualizations::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/3.x-dev/plugins/CoreVisualizations/CoreVisualizations.php#L55), [CustomAlerts::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/3.x-dev/plugins/CustomAlerts/CustomAlerts.php#L163), [CustomVariables::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/3.x-dev/plugins/CustomVariables/CustomVariables.php#L108), [Dashboard::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Dashboard/Dashboard.php#L300), [Feedback::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Feedback/Feedback.php#L42), [Goals::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Goals/Goals.php#L264), [Live::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Live/Live.php#L47), [MobileMessaging::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/3.x-dev/plugins/MobileMessaging/MobileMessaging.php#L100), [MultiSites::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/3.x-dev/plugins/MultiSites/MultiSites.php#L44), [Overlay::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Overlay/Overlay.php#L35), [PrivacyManager::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/3.x-dev/plugins/PrivacyManager/PrivacyManager.php#L148), [ScheduledReports::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/3.x-dev/plugins/ScheduledReports/ScheduledReports.php#L110), [SegmentEditor::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/3.x-dev/plugins/SegmentEditor/SegmentEditor.php#L88), [SitesManager::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/3.x-dev/plugins/SitesManager/SitesManager.php#L269), [Transitions::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Transitions/Transitions.php#L38), [UserCountry::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/3.x-dev/plugins/UserCountry/UserCountry.php#L120), [UserCountryMap::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/3.x-dev/plugins/UserCountryMap/UserCountryMap.php#L56), [UserId::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/3.x-dev/plugins/UserId/UserId.php#L49), [UsersManager::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/3.x-dev/plugins/UsersManager/UsersManager.php#L176), [Widgetize::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Widgetize/Widgetize.php#L47)

## Updater

- [Updater.componentUpdated](#updatercomponentupdated)

### Updater.componentUpdated

*Defined in [Piwik/Updater](https://github.com/piwik/piwik/blob/3.x-dev/core/Updater.php) in line [309](https://github.com/piwik/piwik/blob/3.x-dev/core/Updater.php#L309)*

Event triggered after a component has been updated. Can be used to handle stuff that should be done after a component was updated

**Example**

    Piwik::addAction('Updater.componentUpdated', function ($componentName, $updatedVersion, $warningMessages) {
         $mail = new Mail();
         $mail->setDefaultFromPiwik();
         $mail->addTo('test@example.org');
         $mail->setSubject('Component was updated);
         $message = sprintf(
             'Component %1$s has been updated to version %2$s',
             $componentName, $updatedVersion
         );
         if (!empty($warningMessages)) {
             $message .= "Some warnings occured:\n" . implode("\n", $warningMessages);
         }
         $mail->setBodyText($message);
         $mail->send();
    });

Callback Signature:
<pre><code>function($componentName, $updatedVersion, $warningMessages)</code></pre>

- string `$componentName` 'core', or plugin name

- string `$updatedVersion` version updated to

- array `$warningMessages` warnings occurred during update

Usages:

[CustomPiwikJs::updateTracker](https://github.com/piwik/piwik/blob/3.x-dev/plugins/CustomPiwikJs/CustomPiwikJs.php#L29)

## User

- [User.isNotAuthorized](#userisnotauthorized)

### User.isNotAuthorized

*Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/3.x-dev/core/FrontController.php) in line [134](https://github.com/piwik/piwik/blob/3.x-dev/core/FrontController.php#L134)*

Triggered when a user with insufficient access permissions tries to view some resource. This event can be used to customize the error that occurs when a user is denied access
(for example, displaying an error message, redirecting to a page other than login, etc.).

Callback Signature:
<pre><code>function($exception)</code></pre>

- [NoAccessException](/api-reference/Piwik/NoAccessException) `$exception` The exception that was caught.

Usages:

[Login::noAccess](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Login/Login.php#L55)

## UserSettings

- [UserSettings.updated](#usersettingsupdated)

### UserSettings.updated

*Defined in [Piwik/Settings/Plugin/UserSettings](https://github.com/piwik/piwik/blob/3.x-dev/core/Settings/Plugin/UserSettings.php) in line [91](https://github.com/piwik/piwik/blob/3.x-dev/core/Settings/Plugin/UserSettings.php#L91)*

Triggered after user settings have been updated. **Example**

    Piwik::addAction('UserSettings.updated', function (UserSettings $settings) {
        if ($settings->getPluginName() === 'PluginName') {
            $value = $settings->someSetting->getValue();
            // Do something with the new setting value
        }
    });

Callback Signature:
<pre><code>function($this)</code></pre>

- Settings `$settings` The plugin settings object.

## UsersManager

- [UsersManager.addUser.end](#usersmanageradduserend)
- [UsersManager.checkPassword](#usersmanagercheckpassword)
- [UsersManager.deleteUser](#usersmanagerdeleteuser)
- [UsersManager.getDefaultDates](#usersmanagergetdefaultdates)
- [UsersManager.removeSiteAccess](#usersmanagerremovesiteaccess)
- [UsersManager.removeSiteAccess](#usersmanagerremovesiteaccess)
- [UsersManager.updateUser.end](#usersmanagerupdateuserend)

### UsersManager.addUser.end

*Defined in [Piwik/Plugins/UsersManager/API](https://github.com/piwik/piwik/blob/3.x-dev/plugins/UsersManager/API.php) in line [454](https://github.com/piwik/piwik/blob/3.x-dev/plugins/UsersManager/API.php#L454)*

Triggered after a new user is created.

Callback Signature:
<pre><code>function($userLogin, $email, $password, $alias)</code></pre>

- string `$userLogin` The new user's login handle.


### UsersManager.checkPassword

*Defined in [Piwik/Plugins/UsersManager/UsersManager](https://github.com/piwik/piwik/blob/3.x-dev/plugins/UsersManager/UsersManager.php) in line [147](https://github.com/piwik/piwik/blob/3.x-dev/plugins/UsersManager/UsersManager.php#L147)*

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

*Defined in [Piwik/Plugins/UsersManager/Model](https://github.com/piwik/piwik/blob/3.x-dev/plugins/UsersManager/Model.php) in line [293](https://github.com/piwik/piwik/blob/3.x-dev/plugins/UsersManager/Model.php#L293)*

Triggered after a user has been deleted. This event should be used to clean up any data that is related to the now deleted user.
The **Dashboard** plugin, for example, uses this event to remove the user's dashboards.

Callback Signature:
<pre><code>function($userLogin)</code></pre>

- string `$userLogin` The login handle of the deleted user.

Usages:

[CoreAdminHome::cleanupUser](https://github.com/piwik/piwik/blob/3.x-dev/plugins/CoreAdminHome/CoreAdminHome.php#L37), [CoreVisualizations::deleteUser](https://github.com/piwik/piwik/blob/3.x-dev/plugins/CoreVisualizations/CoreVisualizations.php#L35), [CustomAlerts::deleteAlertsForLogin](https://github.com/piwik/piwik/blob/3.x-dev/plugins/CustomAlerts/CustomAlerts.php#L83), [Dashboard::deleteDashboardLayout](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Dashboard/Dashboard.php#L285), [LanguagesManager::deleteUserLanguage](https://github.com/piwik/piwik/blob/3.x-dev/plugins/LanguagesManager/LanguagesManager.php#L113), [ScheduledReports::deleteUserReport](https://github.com/piwik/piwik/blob/3.x-dev/plugins/ScheduledReports/ScheduledReports.php#L584)


### UsersManager.getDefaultDates

*Defined in [Piwik/Plugins/UsersManager/Controller](https://github.com/piwik/piwik/blob/3.x-dev/plugins/UsersManager/Controller.php) in line [225](https://github.com/piwik/piwik/blob/3.x-dev/plugins/UsersManager/Controller.php#L225)*

Triggered when the list of available dates is requested, for example for the User Settings > Report date to load by default.

Callback Signature:
<pre><code>function(&amp;$dates)</code></pre>

- array `&$dates` Array of (date => translation)


### UsersManager.removeSiteAccess

*Defined in [Piwik/Plugins/ScheduledReports/tests/ScheduledReportsTest](https://github.com/piwik/piwik/blob/3.x-dev/plugins/ScheduledReports/tests/Integration/ScheduledReportsTest.php) in line [96](https://github.com/piwik/piwik/blob/3.x-dev/plugins/ScheduledReports/tests/Integration/ScheduledReportsTest.php#L96)*



Callback Signature:
<pre><code>function(&#039;userLogin&#039;, function(1, 2))</code></pre>

Usages:

[ScheduledReports::deleteUserReportForSites](https://github.com/piwik/piwik/blob/3.x-dev/plugins/ScheduledReports/ScheduledReports.php#L589)


### UsersManager.removeSiteAccess

*Defined in [Piwik/Plugins/UsersManager/API](https://github.com/piwik/piwik/blob/3.x-dev/plugins/UsersManager/API.php) in line [715](https://github.com/piwik/piwik/blob/3.x-dev/plugins/UsersManager/API.php#L715)*



Callback Signature:
<pre><code>function($userLogin, $idSites)</code></pre>

Usages:

[ScheduledReports::deleteUserReportForSites](https://github.com/piwik/piwik/blob/3.x-dev/plugins/ScheduledReports/ScheduledReports.php#L589)


### UsersManager.updateUser.end

*Defined in [Piwik/Plugins/UsersManager/API](https://github.com/piwik/piwik/blob/3.x-dev/plugins/UsersManager/API.php) in line [569](https://github.com/piwik/piwik/blob/3.x-dev/plugins/UsersManager/API.php#L569)*

Triggered after an existing user has been updated. Event notify about password change.

Callback Signature:
<pre><code>function($userLogin, $passwordHasBeenUpdated, $email, $password, $alias)</code></pre>

- string `$userLogin` The user's login handle.

- boolean `$passwordHasBeenUpdated` Flag containing information about password change.

## ViewDataTable

- [ViewDataTable.configure](#viewdatatableconfigure)
- [ViewDataTable.filterViewDataTable](#viewdatatablefilterviewdatatable)

### ViewDataTable.configure

*Defined in [Piwik/Plugin/ViewDataTable](https://github.com/piwik/piwik/blob/3.x-dev/core/Plugin/ViewDataTable.php) in line [258](https://github.com/piwik/piwik/blob/3.x-dev/core/Plugin/ViewDataTable.php#L258)*

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

[Actions::configureViewDataTable](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Actions/Actions.php#L138), [Events::configureViewDataTable](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Events/Events.php#L135)


### ViewDataTable.filterViewDataTable

*Defined in [Piwik/ViewDataTable/Manager](https://github.com/piwik/piwik/blob/3.x-dev/core/ViewDataTable/Manager.php) in line [117](https://github.com/piwik/piwik/blob/3.x-dev/core/ViewDataTable/Manager.php#L117)*

Triggered to filter available DataTable visualizations. Plugins that want to disable certain visualizations should subscribe to
this event and remove visualizations from the incoming array.

**Example**

    public function filterViewDataTable(&$visualizations)
    {
        unset($visualizations[HtmlTable::ID]);
    }

Callback Signature:
<pre><code>function(&amp;$result)</code></pre>

- array `$visualizations` An array of all available visualizations indexed by visualization ID.

Usages:

[TreemapVisualization::removeTreemapVisualizationIfFlattenIsUsed](https://github.com/piwik/piwik/blob/3.x-dev/plugins/TreemapVisualization/TreemapVisualization.php#L47)

## Widget

- [Widget.addWidgetConfigs](#widgetaddwidgetconfigs)
- [Widget.filterWidgets](#widgetfilterwidgets)

### Widget.addWidgetConfigs

*Defined in [Piwik/Plugin/WidgetsProvider](https://github.com/piwik/piwik/blob/3.x-dev/core/Plugin/WidgetsProvider.php) in line [63](https://github.com/piwik/piwik/blob/3.x-dev/core/Plugin/WidgetsProvider.php#L63)*

Triggered to add custom widget configs. To filder widgets have a look at the [Widget.filterWidgets](/api-reference/events#widgetfilterwidgets)
event.

**Example**

    public function addWidgetConfigs(&$configs)
    {
        $config = new WidgetConfig();
        $config->setModule('PluginName');
        $config->setAction('renderDashboard');
        $config->setCategoryId('Dashboard_Dashboard');
        $config->setSubcategoryId('dashboardId');
        $configs[] = $config;
    }

Callback Signature:
<pre><code>function(&amp;$configs)</code></pre>

- array `&$configs` An array containing a list of widget config entries.

Usages:

[Dashboard::addWidgetConfigs](https://github.com/piwik/piwik/blob/3.x-dev/plugins/Dashboard/Dashboard.php#L38)


### Widget.filterWidgets

*Defined in [Piwik/Widget/WidgetsList](https://github.com/piwik/piwik/blob/3.x-dev/core/Widget/WidgetsList.php) in line [215](https://github.com/piwik/piwik/blob/3.x-dev/core/Widget/WidgetsList.php#L215)*

Triggered to filter widgets. **Example**

    public function removeWidgetConfigs(Piwik\Widget\WidgetsList $list)
    {
        $list->remove($category='General_Visits'); // remove all widgets having this category
    }

Callback Signature:
<pre><code>function($list)</code></pre>

- [WidgetsList](/api-reference/Piwik/Widget/WidgetsList) `$list` An instance of the WidgetsList. You can change the list of widgets this way.

