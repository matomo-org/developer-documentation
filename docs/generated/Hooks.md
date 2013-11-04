Hooks
==========

On this page you will learn how to use as well as how to trigger hooks. All already existing hooks are listed below.

## Usage

### Register an action for a given hook
If you want to listen to a specific event, and trigger your own function when this event is posted, you have to define a method `getListHooksRegistered()` in your plugin class, that will return an array containing pair of (hook name, method to call).

For example if you want to execute your function `AddCityInformation()` when a new visitor is recorded by Piwik (hook `Tracker.newVisitorInformation`), in your class `MyPlugin` you would define a method:

```
function getListHooksRegistered()
{
    return array( 'Tracker.newVisitorInformation' => 'AddCityInformation' );
}
```

The hook `Tracker.newVisitorInformation` has an argument: an array containing the visitor’s information. You can add new elements to this array. Example:

```
function AddCityInformation( &$visitorInfo )
{
    // we modify the variable, adding the new city field
    $visitorInfo['city'] = 'Paris, France';
}
```

You can have a look at the [provider plugin](https://github.com/piwik/piwik/blob/master/plugins/Provider/Provider.php#L31) to see an example of a plugin registering actions for multiple hooks.

Piwik also provides a means of dynamic hook registration using `Piwik_AddAction($eventName, $callback)`.

### Add a new hook
Plugins can themselves post new events, the same way Piwik posts events. A common example is custom page headers and footers (on a per plugin basis).

```
Piwik_PostEvent( $eventName,  [ $object , [ $info ]])
```

or in Twig templates:

```
{{ postEvent($eventName) }}
```
By convention, the event name should be prefixed by the Plugin name.

## Categories of existing Hooks

This is a complete list of available hooks.

## API

- [API.$pluginName.$methodName](#apipluginnamemethodname)
- [API.$pluginName.$methodName.end](#apipluginnamemethodnameend)
- [API.getReportMetadata](#apigetreportmetadata)
- [API.getReportMetadata.end](#apigetreportmetadataend)
- [API.getSegmentsMetadata](#apigetsegmentsmetadata)
- [API.Request.authenticate](#apirequestauthenticate)
- [API.Request.dispatch](#apirequestdispatch)
- [API.Request.dispatch.end](#apirequestdispatchend)

### API.$pluginName.$methodName
_Defined in [Piwik/API/Proxy](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php) in line [196](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php#L196)_

This event exists for convenience and is triggered directly after the [API.Request.dispatch](#) event is triggered. It can be used to modify the input that is passed to a single API method. This is also
possible with the [API.Request.dispatch](#) event, however that event requires event handlers
check if the plugin name and method name are correct before modifying the parameters.

**Example**

    Piwik::addAction('API.Actions.getPageUrls', function (&$parameters) {
        // ...
    });

Callback Signature:
<pre><code>function(&amp;$finalParameters)</code></pre>
- `array` `$finalParameters` List of parameters that will be passed to the API method.


### API.$pluginName.$methodName.end
_Defined in [Piwik/API/Proxy](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php) in line [231](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php#L231)_

This event exists for convenience and is triggered immediately before the [API.Request.dispatch.end](#) event. It can be used to modify the output of a single API method. This is also possible with
the [API.Request.dispatch.end](#) event, however that event requires event handlers
check if the plugin name and method name are correct before modifying the output.

Callback Signature:
<pre><code>$endHookParams</code></pre>
- `mixed` `$returnedValue` The value returned from the API method. This will not be a rendered string, but an actual object. For example, it could be a [DataTable](#).
- `array` `$extraInfo` An array holding information regarding the API request. Will contain the following data: - **className**: The name of the namespace-d class name of the API instance that&#039;s being called. - **module**: The name of the plugin the API request was dispatched to. - **action**: The name of the API method that was executed. - **parameters**: The array of parameters passed to the API method.


### API.getReportMetadata
_Defined in [Piwik/Plugins/API/ProcessedReport](https://github.com/piwik/piwik/blob/master/plugins/API/ProcessedReport.php) in line [111](https://github.com/piwik/piwik/blob/master/plugins/API/ProcessedReport.php#L111)_

Triggered when gathering the metadata for all available reports. Plugins that define new reports should use this event to make them available in via
the metadata API. By doing so, the report will become available in scheduled reports
as well as in the Piwik Mobile App. In fact, any third party app that uses the metadata
API will automatically have access to the new report.

TODO: list all information that is required in $availableReports.

Callback Signature:
<pre><code>function(&amp;$availableReports, $parameters)</code></pre>
- `string` `$availableReports` The list of available reports. Append to this list to make a report available.
- `array` `$parameters` Contains the values of the sites and period we are getting reports for. Some report depend on this data. For example, Goals reports depend on the site IDs being request. Contains the following information: - **idSites**: The array of site IDs we are getting reports for. - **period**: The period type, eg, `&#039;day&#039;`, `&#039;week&#039;`, `&#039;month&#039;`, `&#039;year&#039;`, `&#039;range&#039;`. - **date**: A string date within the period or a date range, eg, `&#039;2013-01-01&#039;` or `&#039;2012-01-01,2013-01-01&#039;`.

Usages:

[Actions::getReportMetadata](https://github.com/piwik/piwik/blob/master/plugins/Actions/Actions.php#L131), [CustomVariables::getReportMetadata](https://github.com/piwik/piwik/blob/master/plugins/CustomVariables/CustomVariables.php#L63), [DevicesDetection::getReportMetadata](https://github.com/piwik/piwik/blob/master/plugins/DevicesDetection/DevicesDetection.php#L202), [MultiSites::getReportMetadata](https://github.com/piwik/piwik/blob/master/plugins/MultiSites/MultiSites.php#L43), [Provider::getReportMetadata](https://github.com/piwik/piwik/blob/master/plugins/Provider/Provider.php#L50), [Referrers::getReportMetadata](https://github.com/piwik/piwik/blob/master/plugins/Referrers/Referrers.php#L53), [UserCountry::getReportMetadata](https://github.com/piwik/piwik/blob/master/plugins/UserCountry/UserCountry.php#L259), [UserSettings::getReportMetadata](https://github.com/piwik/piwik/blob/master/plugins/UserSettings/UserSettings.php#L394), [VisitFrequency::getReportMetadata](https://github.com/piwik/piwik/blob/master/plugins/VisitFrequency/VisitFrequency.php#L36), [VisitTime::getReportMetadata](https://github.com/piwik/piwik/blob/master/plugins/VisitTime/VisitTime.php#L51), [VisitorInterest::getReportMetadata](https://github.com/piwik/piwik/blob/master/plugins/VisitorInterest/VisitorInterest.php#L47), [VisitsSummary::getReportMetadata](https://github.com/piwik/piwik/blob/master/plugins/VisitsSummary/VisitsSummary.php#L39)


### API.getReportMetadata.end
_Defined in [Piwik/Plugins/API/ProcessedReport](https://github.com/piwik/piwik/blob/master/plugins/API/ProcessedReport.php) in line [148](https://github.com/piwik/piwik/blob/master/plugins/API/ProcessedReport.php#L148)_

Triggered after all available reports are collected. This event can be used to modify the report metadata of reports in other plugins. You
could, for example, add custom metrics to every report or remove reports from the list
of available reports.

Callback Signature:
<pre><code>function(&amp;$availableReports, $parameters)</code></pre>
- `array` `$availableReports` List of all report metadata.
- `array` `$parameters` Contains the values of the sites and period we are getting reports for. Some report depend on this data. For example, Goals reports depend on the site IDs being request. Contains the following information: - **idSites**: The array of site IDs we are getting reports for. - **period**: The period type, eg, `&#039;day&#039;`, `&#039;week&#039;`, `&#039;month&#039;`, `&#039;year&#039;`, `&#039;range&#039;`. - **date**: A string date within the period or a date range, eg, `&#039;2013-01-01&#039;` or `&#039;2012-01-01,2013-01-01&#039;`.

Usages:

[Goals::getReportMetadata](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L130)


### API.getSegmentsMetadata
_Defined in [Piwik/Plugins/API/API](https://github.com/piwik/piwik/blob/master/plugins/API/API.php) in line [132](https://github.com/piwik/piwik/blob/master/plugins/API/API.php#L132)_

Triggered when gathering all available segments. This event can be used to make new segments available.

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
- `array` `$segments` The list of available segments. Append to this list to add new segments. Each element in this list must contain the following information: - **type**: Either `&#039;metric&#039;` or `&#039;dimension&#039;`. `&#039;metric&#039;` means the value is a numeric and `&#039;dimension&#039;` means it is a string. Also, `&#039;metric&#039;` values will be displayed **Visit (metrics)** in the Segment Editor. - **category**: The segment category name. This can be an existing segment category visible in the segment editor. - **name**: The pretty name of the segment. - **segment**: The segment name, eg, `&#039;visitIp&#039;` or `&#039;searches&#039;`. - **acceptedValues**: A string describing one or two exacmple values, eg `&#039;13.54.122.1, etc.&#039;`. - **sqlSegment**: The table column this segment will segment by. For example, `&#039;log_visit.location_ip&#039;` for the **visitIp** segment. - **sqlFilter**: A PHP callback to apply to segment values before they are used in SQL. - **permission**: True if the current user has view access to this segment, false if otherwise.
- `array` `$idSites` The list of site IDs we&#039;re getting the available segments for. Some segments (such as Goal segments) depend on the site.

Usages:

[Actions::getSegmentsMetadata](https://github.com/piwik/piwik/blob/master/plugins/Actions/Actions.php#L65), [CustomVariables::getSegmentsMetadata](https://github.com/piwik/piwik/blob/master/plugins/CustomVariables/CustomVariables.php#L87), [DevicesDetection::getSegmentsMetadata](https://github.com/piwik/piwik/blob/master/plugins/DevicesDetection/DevicesDetection.php#L183), [Events::getSegmentsMetadata](https://github.com/piwik/piwik/blob/master/plugins/Events/Events.php#L30), [Goals::getSegmentsMetadata](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L417), [Provider::getSegmentsMetadata](https://github.com/piwik/piwik/blob/master/plugins/Provider/Provider.php#L63), [Referrers::getSegmentsMetadata](https://github.com/piwik/piwik/blob/master/plugins/Referrers/Referrers.php#L180), [UserCountry::getSegmentsMetadata](https://github.com/piwik/piwik/blob/master/plugins/UserCountry/UserCountry.php#L206), [UserSettings::getSegmentsMetadata](https://github.com/piwik/piwik/blob/master/plugins/UserSettings/UserSettings.php#L434), [VisitTime::getSegmentsMetadata](https://github.com/piwik/piwik/blob/master/plugins/VisitTime/VisitTime.php#L108)


### API.Request.authenticate
_Defined in [Piwik/API/Request](https://github.com/piwik/piwik/blob/master/core/API/Request.php) in line [251](https://github.com/piwik/piwik/blob/master/core/API/Request.php#L251)_

Triggered when authenticating an API request. Only triggered if the **token_auth**
query parameter is found in the request.

Plugins that provide authentication capabilities should subscribe to this event
and make sure the authentication object (the object returned by `Registry::get('auth')`)
is setup to use `$token_auth` when its `authenticate()` method is executed.

Callback Signature:
<pre><code>function($token_auth)</code></pre>
- `string` `$token_auth` The value of the **token_auth** query parameter.

Usages:

[Login::ApiRequestAuthenticate](https://github.com/piwik/piwik/blob/master/plugins/Login/Login.php#L58)


### API.Request.dispatch
_Defined in [Piwik/API/Proxy](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php) in line [178](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php#L178)_

Triggered before an API request is dispatched. This event can be used to modify the input that is passed to every API method or just
one.

Callback Signature:
<pre><code>function(&amp;$finalParameters, $pluginName, $methodName)</code></pre>
- `array` `$finalParameters` List of parameters that will be passed to the API method.
- `string` `$pluginName` The name of the plugin being dispatched to.
- `string` `$methodName` The name of the API method that will be called.


### API.Request.dispatch.end
_Defined in [Piwik/API/Proxy](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php) in line [252](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php#L252)_

Triggered directly after an API request is dispatched. This event can be used to modify the output of any API method.

Callback Signature:
<pre><code>$endHookParams</code></pre>
- `mixed` `$returnedValue` The value returned from the API method. This will not be a rendered string, but an actual object. For example, it could be a [DataTable](#).
- `array` `$extraInfo` An array holding information regarding the API request. Will contain the following data: - **className**: The name of the namespace-d class name of the API instance that&#039;s being called. - **module**: The name of the plugin the API request was dispatched to. - **action**: The name of the API method that was executed. - **parameters**: The array of parameters passed to the API method.

## ArchiveProcessor

- [ArchiveProcessor.aggregateDayReport](#archiveprocessoraggregatedayreport)
- [ArchiveProcessor.aggregateMultipleReports](#archiveprocessoraggregatemultiplereports)

### ArchiveProcessor.aggregateDayReport
_Defined in [Piwik/ArchiveProcessor/Day](https://github.com/piwik/piwik/blob/master/core/ArchiveProcessor/Day.php) in line [114](https://github.com/piwik/piwik/blob/master/core/ArchiveProcessor/Day.php#L114)_

Triggered when the archiving process is initiated for a day period. Plugins that compute analytics data should subscribe to this event. The
actual archiving logic, however, should not be in the event handler, but
in a class that descends from [Archiver](#).

To learn more about single day archiving, see the [ArchiveProcessor\Day](#)
class.

**Example**

    public function aggregateDayReport(ArchiveProcessor\Day $archiveProcessor)
    {
        $archiving = new MyArchiver($archiveProcessor);
        if ($archiving->shouldArchive()) {
            $archiving->aggregateDayReport();
        }
    }

Callback Signature:
<pre><code>function(&amp;$this)</code></pre>
- `\Piwik\ArchiveProcessor\Day` `$archiveProcessor` The ArchiveProcessor that triggered the event.

Usages:

[Actions::aggregateDayReport](https://github.com/piwik/piwik/blob/master/plugins/Actions/Actions.php#L515), [CustomVariables::aggregateDayReport](https://github.com/piwik/piwik/blob/master/plugins/CustomVariables/CustomVariables.php#L140), [DevicesDetection::aggregateDayReport](https://github.com/piwik/piwik/blob/master/plugins/DevicesDetection/DevicesDetection.php#L275), [Goals::aggregateDayReport](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L515), [Provider::aggregateDayReport](https://github.com/piwik/piwik/blob/master/plugins/Provider/Provider.php#L226), [Referrers::aggregateDayReport](https://github.com/piwik/piwik/blob/master/plugins/Referrers/Referrers.php#L283), [UserCountry::aggregateDayReport](https://github.com/piwik/piwik/blob/master/plugins/UserCountry/UserCountry.php#L340), [UserSettings::aggregateDayReport](https://github.com/piwik/piwik/blob/master/plugins/UserSettings/UserSettings.php#L476), [VisitTime::aggregateDayReport](https://github.com/piwik/piwik/blob/master/plugins/VisitTime/VisitTime.php#L207), [VisitorInterest::aggregateDayReport](https://github.com/piwik/piwik/blob/master/plugins/VisitorInterest/VisitorInterest.php#L136)


### ArchiveProcessor.aggregateMultipleReports
_Defined in [Piwik/ArchiveProcessor/Period](https://github.com/piwik/piwik/blob/master/core/ArchiveProcessor/Period.php) in line [246](https://github.com/piwik/piwik/blob/master/core/ArchiveProcessor/Period.php#L246)_

Triggered when the archiving process is initiated for a non-day period. Plugins that compute analytics data should subscribe to this event. The
actual archiving logic, however, should not be in the event handler, but
in a class that descends from [Archiver](#).

To learn more about non-day period archiving, see the [ArchiveProcessor\Period](#)
class.

**Example**

    public function aggregateMultipleReports(ArchiveProcessor\Period $archiveProcessor)
    {
        $archiving = new MyArchiver($archiveProcessor);
        if ($archiving->shouldArchive()) {
            $archiving->aggregateMultipleReports();
        }
    }

Callback Signature:
<pre><code>function(&amp;$this)</code></pre>
- `\Piwik\ArchiveProcessor\Period` `$archiveProcessor` The ArchiveProcessor that triggered the event.

Usages:

[Actions::aggregateMultipleReports](https://github.com/piwik/piwik/blob/master/plugins/Actions/Actions.php#L523), [CustomVariables::aggregateMultipleReports](https://github.com/piwik/piwik/blob/master/plugins/CustomVariables/CustomVariables.php#L148), [DevicesDetection::aggregateMultipleReports](https://github.com/piwik/piwik/blob/master/plugins/DevicesDetection/DevicesDetection.php#L283), [Goals::aggregateMultipleReports](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L527), [Provider::aggregateMultipleReports](https://github.com/piwik/piwik/blob/master/plugins/Provider/Provider.php#L234), [Referrers::aggregateMultipleReports](https://github.com/piwik/piwik/blob/master/plugins/Referrers/Referrers.php#L295), [UserCountry::aggregateMultipleReports](https://github.com/piwik/piwik/blob/master/plugins/UserCountry/UserCountry.php#L332), [UserSettings::aggregateMultipleReports](https://github.com/piwik/piwik/blob/master/plugins/UserSettings/UserSettings.php#L487), [VisitTime::aggregateMultipleReports](https://github.com/piwik/piwik/blob/master/plugins/VisitTime/VisitTime.php#L199), [VisitorInterest::aggregateMultipleReports](https://github.com/piwik/piwik/blob/master/plugins/VisitorInterest/VisitorInterest.php#L128)

## AssetManager

- [AssetManager.filterMergedJavaScripts](#assetmanagerfiltermergedjavascripts)
- [AssetManager.filterMergedStylesheets](#assetmanagerfiltermergedstylesheets)
- [AssetManager.getJavaScriptFiles](#assetmanagergetjavascriptfiles)
- [AssetManager.getStylesheetFiles](#assetmanagergetstylesheetfiles)

### AssetManager.filterMergedJavaScripts
_Defined in [Piwik/AssetManager](https://github.com/piwik/piwik/blob/master/core/AssetManager.php) in line [393](https://github.com/piwik/piwik/blob/master/core/AssetManager.php#L393)_

Triggered after all JavaScript files Piwik uses are minified and merged into a single file, but before the merged JavaScript is written to disk. Plugins can use this event to modify merged JavaScript or do something else
with it.

Callback Signature:
<pre><code>function(&amp;$mergedContent)</code></pre>
- `string` `$mergedContent` The minified and merged JavaScript.


### AssetManager.filterMergedStylesheets
_Defined in [Piwik/AssetManager](https://github.com/piwik/piwik/blob/master/core/AssetManager.php) in line [168](https://github.com/piwik/piwik/blob/master/core/AssetManager.php#L168)_

Triggered after all less stylesheets are compiled to CSS, minified and merged into one file, but before the generated CSS is written to disk. This event can be used to modify merged CSS.

Callback Signature:
<pre><code>function(&amp;$mergedContent)</code></pre>
- `string` `$mergedContent` The merged an minified CSS.


### AssetManager.getJavaScriptFiles
_Defined in [Piwik/AssetManager](https://github.com/piwik/piwik/blob/master/core/AssetManager.php) in line [448](https://github.com/piwik/piwik/blob/master/core/AssetManager.php#L448)_

Triggered when gathering the list of all JavaScript files needed by Piwik and its plugins. Plugins that have their own JavaScript should use this event to make those
files load in the browser.

JavaScript files should be placed within a **javascripts** subfolder in your
plugin's root directory.

Note: In case you are developing your plugin you may enable the config setting
`[Debug] disable_merged_assets`. Otherwise your JavaScript won't be reloaded
immediately after a change.

**Example**

    public function getJsFiles(&jsFiles)
    {
        jsFiles[] = "plugins/MyPlugin/javascripts/myfile.js";
        jsFiles[] = "plugins/MyPlugin/javascripts/anotherone.js";
    }

Callback Signature:
<pre><code>function(&amp;$jsFiles)</code></pre>
- `string` `$jsFiles` The JavaScript files to load.

Usages:

[Actions::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/Actions/Actions.php#L60), [Annotations::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/Annotations/Annotations.php#L43), [CoreAdminHome::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/CoreAdminHome/CoreAdminHome.php#L77), [CoreHome::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/CoreHome/CoreHome.php#L62), [CorePluginsAdmin::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/CorePluginsAdmin/CorePluginsAdmin.php#L101), [CoreVisualizations::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/CoreVisualizations/CoreVisualizations.php#L55), [Dashboard::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/Dashboard/Dashboard.php#L233), [ExamplePlugin::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/ExamplePlugin/ExamplePlugin.php#L28), [Feedback::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/Feedback/Feedback.php#L53), [Goals::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L429), [LanguagesManager::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/LanguagesManager/LanguagesManager.php#L51), [Live::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/Live/Live.php#L45), [MobileMessaging::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/MobileMessaging/MobileMessaging.php#L100), [MultiSites::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/MultiSites/MultiSites.php#L85), [Overlay::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/Overlay/Overlay.php#L40), [PrivacyManager::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/PrivacyManager/PrivacyManager.php#L154), [ScheduledReports::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/ScheduledReports.php#L115), [SegmentEditor::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/SegmentEditor/SegmentEditor.php#L100), [SitesManager::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/SitesManager/SitesManager.php#L60), [Transitions::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/Transitions/Transitions.php#L36), [UserCountry::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/UserCountry/UserCountry.php#L80), [UserCountryMap::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/UserCountryMap/UserCountryMap.php#L67), [UsersManager::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/UsersManager.php#L78), [Widgetize::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/Widgetize/Widgetize.php#L44)


### AssetManager.getStylesheetFiles
_Defined in [Piwik/AssetManager](https://github.com/piwik/piwik/blob/master/core/AssetManager.php) in line [312](https://github.com/piwik/piwik/blob/master/core/AssetManager.php#L312)_

Triggered when gathering the list of all stylesheets (CSS and LESS) needed by Piwik and its plugins. Plugins that have stylesheets should use this event to make those stylesheets
load.

Stylesheets should be placed within a **stylesheets** subfolder in your plugin's
root directory.

Note: In case you are developing your plugin you may enable the config setting
`[Debug] disable_merged_assets`. Otherwise your custom stylesheets won't be
reloaded immediately after a change.

**Example**

    public function getStylesheetFiles(&$stylesheets)
    {
        $stylesheets[] = "plugins/MyPlugin/stylesheets/myfile.less";
        $stylesheets[] = "plugins/MyPlugin/stylesheets/myotherfile.css";
    }

Callback Signature:
<pre><code>function(&amp;$stylesheets)</code></pre>
- `string` `$stylesheets` The list of stylesheet paths.

Usages:

[Plugin::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/API/API.php#L719), [Actions::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/Actions/Actions.php#L55), [Annotations::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/Annotations/Annotations.php#L35), [CoreAdminHome::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/CoreAdminHome/CoreAdminHome.php#L68), [CoreHome::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/CoreHome/CoreHome.php#L43), [CorePluginsAdmin::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/CorePluginsAdmin/CorePluginsAdmin.php#L53), [CoreVisualizations::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/CoreVisualizations/CoreVisualizations.php#L49), [DBStats::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/DBStats/DBStats.php#L86), [Dashboard::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/Dashboard/Dashboard.php#L242), [ExampleRssWidget::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/ExampleRssWidget/ExampleRssWidget.php#L32), [Feedback::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/Feedback/Feedback.php#L48), [Goals::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L434), [Installation::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/Installation/Installation.php#L91), [LanguagesManager::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/LanguagesManager/LanguagesManager.php#L46), [Live::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/Live/Live.php#L39), [MobileMessaging::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/MobileMessaging/MobileMessaging.php#L105), [MultiSites::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/MultiSites/MultiSites.php#L90), [SegmentEditor::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/SegmentEditor/SegmentEditor.php#L105), [SitesManager::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/SitesManager/SitesManager.php#L51), [Transitions::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/Transitions/Transitions.php#L31), [UserCountry::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/UserCountry/UserCountry.php#L75), [UserCountryMap::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/UserCountryMap/UserCountryMap.php#L77), [UsersManager::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/UsersManager.php#L87), [Widgetize::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/Widgetize/Widgetize.php#L54)

## Config

- [Config.badConfigurationFile](#configbadconfigurationfile)
- [Config.NoConfigurationFile](#confignoconfigurationfile)

### Config.badConfigurationFile
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [312](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L312)_

Triggered if the INI config file has the incorrect format or if certain required configuration options are absent. This event can be used to start the installation process or to display a
custom error message.

Callback Signature:
<pre><code>function($exception)</code></pre>
- `$exception`

Usages:

[Installation::dispatch](https://github.com/piwik/piwik/blob/master/plugins/Installation/Installation.php#L53)


### Config.NoConfigurationFile
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [236](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L236)_

Triggered when the configuration file cannot be found or read. This usually
means Piwik is not installed yet. This event can be used to start the
installation process or to display a custom error message.

Callback Signature:
<pre><code>function($exception)</code></pre>
- `Exception` `$exception` The exception that was thrown by `Config::getInstance()`.

Usages:

[Installation::dispatch](https://github.com/piwik/piwik/blob/master/plugins/Installation/Installation.php#L53)

## Controller

- [Controller.$module.$action](#controllermoduleaction)
- [Controller.$module.$action.end](#controllermoduleactionend)

### Controller.$module.$action
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [111](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L111)_

This event exists for convenience and is triggered directly after the [Request.dispatch](#) event is triggered. It can be used to do the same things as the [Request.dispatch](#) event, but for one controller
action only. Using this event will result in a little less code than [Request.dispatch](#).

Callback Signature:
<pre><code>function(&amp;$parameters)</code></pre>
- `array` `$parameters` The arguments passed to the controller action.


### Controller.$module.$action.end
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [127](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L127)_

This event exists for convenience and is triggered immediately before the [Request.dispatch.end](#) event is triggered. It can be used to do the same things as the [Request.dispatch.end](#) event, but for one
controller action only. Using this event will result in a little less code than
[Request.dispatch.end](#).

Callback Signature:
<pre><code>function(&amp;$result, $parameters)</code></pre>
- `mixed` `$result` The result of the controller action.
- `array` `$parameters` The arguments passed to the controller action.

## Goals

- [Goals.getReportsWithGoalMetrics](#goalsgetreportswithgoalmetrics)

### Goals.getReportsWithGoalMetrics
_Defined in [Piwik/Plugins/Goals/Goals](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php) in line [377](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L377)_

Triggered when gathering all reports that contain Goal metrics. The list of reports
will be displayed on the left column of the bottom of the Goals Overview page and
each individual Goal page.

If plugins define reports that contain Goal metrics (such as conversions or revenue),
they can use this event to make sure their reports can be loaded on the relevant
Goals pages.

Callback Signature:
<pre><code>function(&amp;$reportsWithGoals)</code></pre>
- `array` `$reportsWithGoals` The list of reports that have Goal metrics.

Usages:

[CustomVariables::getReportsWithGoalMetrics](https://github.com/piwik/piwik/blob/master/plugins/CustomVariables/CustomVariables.php#L128), [Goals::getActualReportsWithGoalMetrics](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L400), [Referrers::getReportsWithGoalMetrics](https://github.com/piwik/piwik/blob/master/plugins/Referrers/Referrers.php#L249), [UserCountry::getReportsWithGoalMetrics](https://github.com/piwik/piwik/blob/master/plugins/UserCountry/UserCountry.php#L308), [VisitTime::getReportsWithGoalMetrics](https://github.com/piwik/piwik/blob/master/plugins/VisitTime/VisitTime.php#L99)

## Live

- [Live.getExtraVisitorDetails](#livegetextravisitordetails)

### Live.getExtraVisitorDetails
_Defined in [Piwik/Plugins/Live/API](https://github.com/piwik/piwik/blob/master/plugins/Live/API.php) in line [371](https://github.com/piwik/piwik/blob/master/plugins/Live/API.php#L371)_

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
- `array` `$visitorProfile` The normal visitor profile info.

## Log

- [Log.formatDatabaseMessage](#logformatdatabasemessage)
- [Log.formatFileMessage](#logformatfilemessage)
- [Log.formatScreenMessage](#logformatscreenmessage)
- [Log.getAvailableWriters](#loggetavailablewriters)

### Log.formatDatabaseMessage
_Defined in [Piwik/Log](https://github.com/piwik/piwik/blob/master/core/Log.php) in line [435](https://github.com/piwik/piwik/blob/master/core/Log.php#L435)_

This event is called when trying to log an object to a database table. Plugins can use
this event to convert objects to strings before they are logged.

Callback Signature:
<pre><code>function(&amp;$message, $level, $tag, $datetime, $logger)</code></pre>
- `mixed` `$message` The object that is being logged. Event handlers should check if the object is of a certain type and if it is, set $message to the string that should be logged.
- `int` `$level` The log level used with this log entry.
- `string` `$tag` The current plugin that started logging (or if no plugin, the current class).
- `string` `$datetime` Datetime of the logging call.
- `Log` `$logger` The Log singleton.


### Log.formatFileMessage
_Defined in [Piwik/Log](https://github.com/piwik/piwik/blob/master/core/Log.php) in line [353](https://github.com/piwik/piwik/blob/master/core/Log.php#L353)_

This event is called when trying to log an object to a file. Plugins can use
this event to convert objects to strings before they are logged.

Callback Signature:
<pre><code>function(&amp;$message, $level, $tag, $datetime, $logger)</code></pre>
- `mixed` `$message` The object that is being logged. Event handlers should check if the object is of a certain type and if it is, set $message to the string that should be logged.
- `int` `$level` The log level used with this log entry.
- `string` `$tag` The current plugin that started logging (or if no plugin, the current class).
- `string` `$datetime` Datetime of the logging call.
- `Log` `$logger` The Log singleton.


### Log.formatScreenMessage
_Defined in [Piwik/Log](https://github.com/piwik/piwik/blob/master/core/Log.php) in line [405](https://github.com/piwik/piwik/blob/master/core/Log.php#L405)_

This event is called when trying to log an object to the screen. Plugins can use
this event to convert objects to strings before they are logged.

The result of this callback can be HTML so no sanitization is done on the result.
This means YOU MUST SANITIZE THE MESSAGE YOURSELF if you use this event.

Callback Signature:
<pre><code>function(&amp;$message, $level, $tag, $datetime, $logger)</code></pre>
- `mixed` `$message` The object that is being logged. Event handlers should check if the object is of a certain type and if it is, set $message to the string that should be logged.
- `int` `$level` The log level used with this log entry.
- `string` `$tag` The current plugin that started logging (or if no plugin, the current class).
- `string` `$datetime` Datetime of the logging call.
- `Log` `$logger` The Log singleton.


### Log.getAvailableWriters
_Defined in [Piwik/Log](https://github.com/piwik/piwik/blob/master/core/Log.php) in line [325](https://github.com/piwik/piwik/blob/master/core/Log.php#L325)_

This event is called when the Log instance is created. Plugins can use this event to
make new logging writers available.

A logging writer is a callback that takes the following arguments:
  int $level, string $tag, string $datetime, string $message

$level is the log level to use, $tag is the log tag used, $datetime is the date time
of the logging call and $message is the formatted log message.

Logging writers must be associated by name in the array passed to event handlers.

***Example**

    function (&$writers) {
        $writers['myloggername'] = function ($level, $tag, $datetime, $message) {
            // ...
        };
    }

    // 'myloggername' can now be used in the log_writers config option.

Callback Signature:
<pre><code>function(&amp;$writers)</code></pre>
- `$`

## Menu

- [Menu.Admin.addItems](#menuadminadditems)
- [Menu.Reporting.addItems](#menureportingadditems)
- [Menu.Top.addItems](#menutopadditems)

### Menu.Admin.addItems
_Defined in [Piwik/Menu/MenuAdmin](https://github.com/piwik/piwik/blob/master/core/Menu/MenuAdmin.php) in line [83](https://github.com/piwik/piwik/blob/master/core/Menu/MenuAdmin.php#L83)_

Triggered when collecting all available admin menu items. Subscribe to this event if you want
to add one or more items to the Piwik admin menu.

Menu items should be added via the [Menu::add](#) method.

**Example**

    use Piwik\Menu\MenuAdmin;

    public function addMenuItems()
    {
        MenuAdmin::getInstance()->add(
            'MenuName',
            'SubmenuName',
            array('module' => 'MyPlugin', 'action' => 'index'),
            $showOnlyIf = Piwik::isUserIsSuperUser(),
            $order = 6
        );
    }

Usages:

[CoreAdminHome::addMenu](https://github.com/piwik/piwik/blob/master/plugins/CoreAdminHome/CoreAdminHome.php#L92), [CorePluginsAdmin::addMenu](https://github.com/piwik/piwik/blob/master/plugins/CorePluginsAdmin/CorePluginsAdmin.php#L58), [DBStats::addMenu](https://github.com/piwik/piwik/blob/master/plugins/DBStats/DBStats.php#L49), [Installation::addMenu](https://github.com/piwik/piwik/blob/master/plugins/Installation/Installation.php#L80), [MobileMessaging::addMenu](https://github.com/piwik/piwik/blob/master/plugins/MobileMessaging/MobileMessaging.php#L88), [PrivacyManager::addMenu](https://github.com/piwik/piwik/blob/master/plugins/PrivacyManager/PrivacyManager.php#L159), [SitesManager::addMenu](https://github.com/piwik/piwik/blob/master/plugins/SitesManager/SitesManager.php#L40), [UserCountry::addAdminMenu](https://github.com/piwik/piwik/blob/master/plugins/UserCountry/UserCountry.php#L198), [UsersManager::addMenu](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/UsersManager.php#L95)


### Menu.Reporting.addItems
_Defined in [Piwik/Menu/MenuMain](https://github.com/piwik/piwik/blob/master/core/Menu/MenuMain.php) in line [89](https://github.com/piwik/piwik/blob/master/core/Menu/MenuMain.php#L89)_

Triggered when collecting all available reporting menu items. Subscribe to this event if you
want to add one or more items to the Piwik reporting menu.

Menu items should be added via the [Menu::add](#) method.

**Example**

    use Piwik\Menu\Main;

    public function addMenuItems()
    {
        Main::getInstance()->add(
            'CustomMenuName',
            'CustomSubmenuName',
            array('module' => 'MyPlugin', 'action' => 'index'),
            $showOnlyIf = Piwik::isUserIsSuperUser(),
            $order = 6
        );
    }

Usages:

[Actions::addMenus](https://github.com/piwik/piwik/blob/master/plugins/Actions/Actions.php#L485), [CustomVariables::addMenus](https://github.com/piwik/piwik/blob/master/plugins/CustomVariables/CustomVariables.php#L55), [Dashboard::addMenus](https://github.com/piwik/piwik/blob/master/plugins/Dashboard/Dashboard.php#L201), [DevicesDetection::addMenu](https://github.com/piwik/piwik/blob/master/plugins/DevicesDetection/DevicesDetection.php#L291), [ExampleUI::addReportingMenuItems](https://github.com/piwik/piwik/blob/master/plugins/ExampleUI/ExampleUI.php#L32), [Goals::addMenus](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L469), [Live::addMenu](https://github.com/piwik/piwik/blob/master/plugins/Live/Live.php#L52), [Provider::addMenu](https://github.com/piwik/piwik/blob/master/plugins/Provider/Provider.php#L102), [Referrers::addMenus](https://github.com/piwik/piwik/blob/master/plugins/Referrers/Referrers.php#L237), [UserCountry::addMenu](https://github.com/piwik/piwik/blob/master/plugins/UserCountry/UserCountry.php#L190), [UserCountryMap::addMenu](https://github.com/piwik/piwik/blob/master/plugins/UserCountryMap/UserCountryMap.php#L62), [UserSettings::addMenu](https://github.com/piwik/piwik/blob/master/plugins/UserSettings/UserSettings.php#L466), [VisitFrequency::addMenu](https://github.com/piwik/piwik/blob/master/plugins/VisitFrequency/VisitFrequency.php#L67), [VisitTime::addMenu](https://github.com/piwik/piwik/blob/master/plugins/VisitTime/VisitTime.php#L94), [VisitorInterest::addMenu](https://github.com/piwik/piwik/blob/master/plugins/VisitorInterest/VisitorInterest.php#L116), [VisitsSummary::addMenu](https://github.com/piwik/piwik/blob/master/plugins/VisitsSummary/VisitsSummary.php#L70)


### Menu.Top.addItems
_Defined in [Piwik/Menu/MenuTop](https://github.com/piwik/piwik/blob/master/core/Menu/MenuTop.php) in line [113](https://github.com/piwik/piwik/blob/master/core/Menu/MenuTop.php#L113)_

Triggered when collecting all available menu items that are be displayed on the very top of every page, next to the login/logout links. Subscribe to this event if you want to add one or more items
to the top menu.

Menu items should be added via the [MenuTop::addEntry](#addEntry) method.

**Example**

    use Piwik\Menu\MenuTop;

    public function addMenuItems()
    {
        MenuTop::addEntry(
            'TopMenuName',
            array('module' => 'MyPlugin', 'action' => 'index'),
            $showOnlyIf = Piwik::isUserIsSuperUser(),
            $order = 6
        );
    }

Usages:

[Plugin::addTopMenu](https://github.com/piwik/piwik/blob/master/plugins/API/API.php#L697), [Dashboard::addTopMenu](https://github.com/piwik/piwik/blob/master/plugins/Dashboard/Dashboard.php#L219), [ExampleUI::addTopMenuItems](https://github.com/piwik/piwik/blob/master/plugins/ExampleUI/ExampleUI.php#L44), [Feedback::addTopMenu](https://github.com/piwik/piwik/blob/master/plugins/Feedback/Feedback.php#L36), [LanguagesManager::showLanguagesSelector](https://github.com/piwik/piwik/blob/master/plugins/LanguagesManager/LanguagesManager.php#L56), [MultiSites::addTopMenu](https://github.com/piwik/piwik/blob/master/plugins/MultiSites/MultiSites.php#L78), [ScheduledReports::addTopMenu](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/ScheduledReports.php#L457), [Widgetize::addTopMenu](https://github.com/piwik/piwik/blob/master/plugins/Widgetize/Widgetize.php#L36)

## Provider

- [Provider.getCleanHostname](#providergetcleanhostname)

### Provider.getCleanHostname
_Defined in [Piwik/Plugins/Provider/Provider](https://github.com/piwik/piwik/blob/master/plugins/Provider/Provider.php) in line [187](https://github.com/piwik/piwik/blob/master/plugins/Provider/Provider.php#L187)_

Triggered when prettifying a hostname string. depending on a given hostname.

This event can be used to customize the way a hostname is displayed in the 
Providers report.

**Example**

```
public function getCleanHostname(&$cleanHostname, $hostname)
{
    if ('fvae.VARG.ceaga.site.co.jp' == $hostname) {
        $cleanHostname = 'site.co.jp';
    }
}
```

Callback Signature:
<pre><code>function(&amp;$cleanHostname, $hostname)</code></pre>

## Reporting

- [Reporting.getDatabaseConfig](#reportinggetdatabaseconfig)

### Reporting.getDatabaseConfig
_Defined in [Piwik/Db](https://github.com/piwik/piwik/blob/master/core/Db.php) in line [93](https://github.com/piwik/piwik/blob/master/core/Db.php#L93)_

Triggered before a connection to the database is established. This event can be used to dynamically change the settings used to connect to the
database.

Callback Signature:
<pre><code>function(&amp;$dbInfos)</code></pre>
- `array` `$dbInfos` Reference to an array containing database connection info, including: - **host**: The host name or IP address to the MySQL database. - **username**: The username to use when connecting to the database. - **password**: The password to use when connecting to the database. - **dbname**: The name of the Piwik MySQL database. - **port**: The MySQL database port to use. - **adapter**: either `&#039;PDO_MYSQL&#039;` or `&#039;MYSQLI&#039;`

## Request

- [Request.dispatch](#requestdispatch)
- [Request.dispatch.end](#requestdispatchend)
- [Request.dispatchCoreAndPluginUpdatesScreen](#requestdispatchcoreandpluginupdatesscreen)
- [Request.initAuthenticationObject](#requestinitauthenticationobject)
- [Request.initAuthenticationObject](#requestinitauthenticationobject)

### Request.dispatch
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [100](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L100)_

Triggered directly before controller actions are dispatched. This event can be used to modify the parameters passed to one or more controller actions
and can be used to change the plugin and action that is being dispatched to.

Callback Signature:
<pre><code>function(&amp;$module, &amp;$action, &amp;$parameters)</code></pre>
- `string` `$module` The name of the plugin being dispatched to.
- `string` `$action` The name of the controller method being dispatched to.
- `array` `$parameters` The arguments passed to the controller action.


### Request.dispatch.end
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [138](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L138)_

Triggered after a controller action is successfully called. This event can be used to modify controller action output (if there was any) before
the output is returned.

Callback Signature:
<pre><code>function(&amp;$result, $parameters)</code></pre>
- `mixed` `$result` The result of the controller action.
- `array` `$parameters` The arguments passed to the controller action.


### Request.dispatchCoreAndPluginUpdatesScreen
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [324](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L324)_

Triggered just after the platform is initialized and plugins are loaded. This event can be used to do early initialization. Note: At this point the user
is not authenticated yet.

Usages:

[CoreUpdater::dispatch](https://github.com/piwik/piwik/blob/master/plugins/CoreUpdater/CoreUpdater.php#L56)


### Request.initAuthenticationObject
_Defined in [Piwik/Plugins/Overlay/API](https://github.com/piwik/piwik/blob/master/plugins/Overlay/API.php) in line [123](https://github.com/piwik/piwik/blob/master/plugins/Overlay/API.php#L123)_

Triggered shortly before the user is authenticated. This event can be used by plugins that provide their own authentication mechanism
to make that mechanism available. Subscribers should set the `'auth'` object in
the [Piwik\Registry](#) to an object that implements the [Auth](#) interface.

**Example**

    use Piwik\Registry;

    public function initAuthenticationObject($allowCookieAuthentication)
    {
        Registry::set('auth', new LDAPAuth($allowCookieAuthentication));
    }

Callback Signature:
<pre><code>function($allowCookieAuthentication = true)</code></pre>
- `bool` `$allowCookieAuthentication` Whether authentication based on $_COOKIE values should be allowed.

Usages:

[Login::initAuthenticationObject](https://github.com/piwik/piwik/blob/master/plugins/Login/Login.php#L68)


### Request.initAuthenticationObject
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [338](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L338)_

Triggered before the user is authenticated. You can use it to create your own
authentication object which implements the [Piwik\Auth](#) interface and overrides
the default authentication logic.

Usages:

[Login::initAuthenticationObject](https://github.com/piwik/piwik/blob/master/plugins/Login/Login.php#L68)

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
_Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php) in line [775](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php#L775)_

Triggered when we're determining if a scheduled report backend can handle sending multiple Piwik reports in one scheduled report or not. Plugins that provide their own scheduled reports backend should use this
event to specify whether their backend can send more than one Piwik report
at a time.

Callback Signature:
<pre><code>function(&amp;$allowMultipleReports, $reportType)</code></pre>
- `bool` `$allowMultipleReports` Whether the backend type can handle multiple Piwik reports or not.
- `string` `$reportType` A string ID describing how the report is sent, eg, `&#039;sms&#039;` or `&#039;email&#039;`.

Usages:

[MobileMessaging::allowMultipleReports](https://github.com/piwik/piwik/blob/master/plugins/MobileMessaging/MobileMessaging.php#L179), [ScheduledReports::allowMultipleReports](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/ScheduledReports.php#L253)


### ScheduledReports.getRendererInstance
_Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php) in line [425](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php#L425)_

Triggered when obtaining a renderer instance based on the scheduled report type. Plugins that provide new scheduled report backends should use this event to
handle their new report types.

Callback Signature:
<pre><code>function(&amp;$reportRenderer, $reportType, $outputType, $report)</code></pre>
- `ReportRenderer` `$reportRenderer` This variable should be set to an instance that extends [ReportRenderer](#) by one of the event subscribers.
- `string` `$reportType` A string ID describing how the report is sent, eg, `&#039;sms&#039;` or `&#039;email&#039;`.
- `string` `$outputType` The output format of the report, eg, `&#039;html&#039;`, `&#039;pdf&#039;`, etc.
- `array` `$report` An array describing the scheduled report that is being generated.

Usages:

[MobileMessaging::getRendererInstance](https://github.com/piwik/piwik/blob/master/plugins/MobileMessaging/MobileMessaging.php#L166), [ScheduledReports::getRendererInstance](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/ScheduledReports.php#L240)


### ScheduledReports.getReportFormats
_Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php) in line [821](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php#L821)_

Triggered when gathering all available scheduled report formats. Plugins that provide their own scheduled report format should use
this event to make their format available.

Callback Signature:
<pre><code>function(&amp;$reportFormats, $reportType)</code></pre>
- `array` `$reportFormats` An array mapping string IDs for each available scheduled report format with icon paths for those formats. Add your new format&#039;s ID to this array.

Usages:

[MobileMessaging::getReportFormats](https://github.com/piwik/piwik/blob/master/plugins/MobileMessaging/MobileMessaging.php#L152), [ScheduledReports::getReportFormats](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/ScheduledReports.php#L187)


### ScheduledReports.getReportMetadata
_Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php) in line [747](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php#L747)_

Triggered when gathering the list of Piwik reports that can be used with a certain scheduled reports backend. Plugins that provide their own scheduled reports backend should use this
event to list the Piwik reports that their backend supports.

Callback Signature:
<pre><code>function(&amp;$availableReportMetadata, $reportType, $idSite)</code></pre>
- `array` `$availableReportMetadata` 
- `string` `$reportType` A string ID describing how the report is sent, eg, `&#039;sms&#039;` or `&#039;email&#039;`.
- `int` `$idSite` The ID of the site we&#039;re getting available reports for.

Usages:

[MobileMessaging::getReportMetadata](https://github.com/piwik/piwik/blob/master/plugins/MobileMessaging/MobileMessaging.php#L129), [ScheduledReports::getReportMetadata](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/ScheduledReports.php#L162)


### ScheduledReports.getReportParameters
_Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php) in line [602](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php#L602)_

Triggered when gathering the available parameters for a scheduled report type. Plugins that provide their own scheduled reports backend should use this
event to list the available report parameters for their backend.

Callback Signature:
<pre><code>function(&amp;$availableParameters, $reportType)</code></pre>
- `array` `$availableParameters` The list of available parameters for this report type. This is an array that maps paramater IDs with a boolean that indicates whether the parameter is mandatory or not.
- `string` `$reportType` A string ID describing how the report is sent, eg, `&#039;sms&#039;` or `&#039;email&#039;`.

Usages:

[MobileMessaging::getReportParameters](https://github.com/piwik/piwik/blob/master/plugins/MobileMessaging/MobileMessaging.php#L159), [ScheduledReports::getReportParameters](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/ScheduledReports.php#L194)


### ScheduledReports.getReportRecipients
_Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php) in line [852](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php#L852)_

Triggered when getting the list of recipients of a scheduled report. Plugins that provide their own scheduled report backend should use this event
so the list of recipients can be extracted from their backend's specific report
format.

Callback Signature:
<pre><code>function(&amp;$recipients, $report[&#039;type&#039;], $report)</code></pre>
- `array` `$recipients` An array of strings describing each of the scheduled reports recipients. Can be, for example, a list of email addresses or phone numbers or whatever else your plugin uses.
- `string` `$reportType` A string ID describing how the report is sent, eg, `&#039;sms&#039;` or `&#039;email&#039;`.
- `array` `$report` An array describing the scheduled report that is being generated.

Usages:

[MobileMessaging::getReportRecipients](https://github.com/piwik/piwik/blob/master/plugins/MobileMessaging/MobileMessaging.php#L186), [ScheduledReports::getReportRecipients](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/ScheduledReports.php#L377)


### ScheduledReports.getReportTypes
_Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php) in line [799](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php#L799)_

Triggered when gathering all available scheduled report backend types. Plugins that provide their own scheduled reports backend should use this
event to make their backend available.

Callback Signature:
<pre><code>function(&amp;$reportTypes)</code></pre>
- `array` `$reportTypes` An array mapping string IDs for each available scheduled report backend with icon paths for those backends. Add your new backend&#039;s ID to this array.

Usages:

[MobileMessaging::getReportTypes](https://github.com/piwik/piwik/blob/master/plugins/MobileMessaging/MobileMessaging.php#L147), [ScheduledReports::getReportTypes](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/ScheduledReports.php#L182)


### ScheduledReports.processReports
_Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php) in line [403](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php#L403)_

Triggered when generating the content of scheduled reports. This event can be used to modify the content of processed report data or
metadata, either for one specific report/report type/output format or all
of them.

TODO: list data available in $report or make it a new class that can be documented (same for
      all other events that use a $report)

Callback Signature:
<pre><code>function(&amp;$processedReports, $reportType, $outputType, $report)</code></pre>
- `array` `$processedReports` The list of processed reports in the scheduled report. Includes report data and metadata.
- `string` `$reportType` A string ID describing how the report is sent, eg, `&#039;sms&#039;` or `&#039;email&#039;`.
- `string` `$outputType` The output format of the report, eg, `&#039;html&#039;`, `&#039;pdf&#039;`, etc.
- `array` `$report` An array describing the scheduled report that is being generated.

Usages:

[ScheduledReports::processReports](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/ScheduledReports.php#L201)


### ScheduledReports.sendReport
_Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php) in line [544](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php#L544)_

Triggered when sending scheduled reports. Plugins that provide new scheduled report backends should use this event to
send the scheduled report uses their backend.

Callback Signature:
<pre><code>function($report[&#039;type&#039;], $report, $contents, $filename, $prettyDate, $reportSubject, $reportTitle, $additionalFiles)</code></pre>
- `string` `$reportType` A string ID describing how the report is sent, eg, `&#039;sms&#039;` or `&#039;email&#039;`.
- `array` `$report` An array describing the scheduled report that is being generated.
- `string` `$contents` The contents of the scheduled report that was generated and now should be sent.
- `string` `$filename` The path to the file where the scheduled report has been saved.
- `string` `$prettyDate` A prettified date string for the data within the scheduled report.
- `string` `$reportSubject` A string describing what&#039;s in the scheduled report.
- `string` `$reportTitle` The scheduled report&#039;s given title.
- `array` `$additionalFiles` The list of additional files that should be sent with this report.

Usages:

[MobileMessaging::sendReport](https://github.com/piwik/piwik/blob/master/plugins/MobileMessaging/MobileMessaging.php#L193), [ScheduledReports::sendReport](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/ScheduledReports.php#L260)


### ScheduledReports.validateReportParameters
_Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php) in line [630](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php#L630)_

Triggered when validating the parameters for a scheduled report. Plugins that provide their own scheduled reports backend should use this
event to validate the custom parameters defined with
[ScheduledReports.getReportParameters](#ScheduledReports.getReportParameters).

Callback Signature:
<pre><code>function(&amp;$parameters, $reportType)</code></pre>
- `array` `$parameters` The list of parameters for the scheduled report.
- `string` `$reportType` A string ID describing how the report is sent, eg, `&#039;sms&#039;` or `&#039;email&#039;`.

Usages:

[MobileMessaging::validateReportParameters](https://github.com/piwik/piwik/blob/master/plugins/MobileMessaging/MobileMessaging.php#L110), [ScheduledReports::validateReportParameters](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/ScheduledReports.php#L120)

## SegmentEditor

- [SegmentEditor.deactivate](#segmenteditordeactivate)

### SegmentEditor.deactivate
_Defined in [Piwik/Plugins/SegmentEditor/API](https://github.com/piwik/piwik/blob/master/plugins/SegmentEditor/API.php) in line [308](https://github.com/piwik/piwik/blob/master/plugins/SegmentEditor/API.php#L308)_

Triggered before a segment is deleted or made invisible. This event can be used by plugins to throw an exception
or do something else.

Callback Signature:
<pre><code>function($idSegment)</code></pre>
- `int` `$idSegment` The ID of the segment being deleted.

Usages:

[ScheduledReports::segmentDeactivation](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/ScheduledReports.php#L439)

## Segments

- [Segments.getKnownSegmentsToArchiveAllSites](#segmentsgetknownsegmentstoarchiveallsites)
- [Segments.getKnownSegmentsToArchiveForSite](#segmentsgetknownsegmentstoarchiveforsite)

### Segments.getKnownSegmentsToArchiveAllSites
_Defined in [Piwik/SettingsPiwik](https://github.com/piwik/piwik/blob/master/core/SettingsPiwik.php) in line [86](https://github.com/piwik/piwik/blob/master/core/SettingsPiwik.php#L86)_

Triggered during the cron archiving process to collect segments that should be pre-processed for all websites. The archiving process will be launched
for each of these segments when archiving data for each site.

This event can be used to add segments to be pre-processed. This can be provide
enhanced performance if your plugin depends on data from a specific segment.

Note: If you just want to add a segment that is managed by the user, you should use the
SegmentEditor API.

Callback Signature:
<pre><code>function(&amp;$segmentsToProcess)</code></pre>
- `array` `$segmentsToProcess` List of segment definitions, eg, ``` array( &#039;browserCode=ff;resolution=800x600&#039;, &#039;country=JP;city=Tokyo&#039; ) ``` Add segments to process to this array in your event handler.

Usages:

[SegmentEditor::getKnownSegmentsToArchiveAllSites](https://github.com/piwik/piwik/blob/master/plugins/SegmentEditor/SegmentEditor.php#L56)


### Segments.getKnownSegmentsToArchiveForSite
_Defined in [Piwik/SettingsPiwik](https://github.com/piwik/piwik/blob/master/core/SettingsPiwik.php) in line [127](https://github.com/piwik/piwik/blob/master/core/SettingsPiwik.php#L127)_

Triggered during the cron archiving process to collect segments that should be pre-processed for one specific site. The archiving process will be launched
for each of these segments when archiving data for that one site.

This event can be used to add segments to be pre-processed. This can be provide
enhanced performance if your plugin depends on data from a specific segment.

Note: If you just want to add a segment that is managed by the user, you should use the
SegmentEditor API.

Callback Signature:
<pre><code>function(&amp;$segments, $idSite)</code></pre>
- `array` `$segmentsToProcess` List of segment definitions, eg, ``` array( &#039;browserCode=ff;resolution=800x600&#039;, &#039;country=JP;city=Tokyo&#039; ) ``` Add segments to process to this array in your event handler.
- `int` `$idSite` The ID of the site to get segments for.

Usages:

[SegmentEditor::getKnownSegmentsToArchiveForSite](https://github.com/piwik/piwik/blob/master/plugins/SegmentEditor/SegmentEditor.php#L64)

## Site

- [Site.getSiteAttributes](#sitegetsiteattributes)

### Site.getSiteAttributes
_Defined in [Piwik/Tracker/Cache](https://github.com/piwik/piwik/blob/master/core/Tracker/Cache.php) in line [81](https://github.com/piwik/piwik/blob/master/core/Tracker/Cache.php#L81)_

This event is called to get the details of a site by its ID. It can be used to
add custom attributes for the website to the Tracker cache.

**Example**

    public function getSiteAttributes($content, $idSite)
    {
        $sql = "SELECT info FROM " . Common::prefixTable('myplugin_extra_site_info') . " WHERE idsite = ?";
        $content['myplugin_site_data'] = Db::fetchOne($sql, array($idSite));
    }

Callback Signature:
<pre><code>function(&amp;$content, $idSite)</code></pre>
- `array` `$content` List of attributes.
- `int` `$idSite` The site ID.

Usages:

[Goals::fetchGoalsFromDb](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L439), [SitesManager::recordWebsiteDataInCache](https://github.com/piwik/piwik/blob/master/plugins/SitesManager/SitesManager.php#L73), [UsersManager::recordAdminUsersInCache](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/UsersManager.php#L53)

## SitesManager

- [SitesManager.deleteSite.end](#sitesmanagerdeletesiteend)

### SitesManager.deleteSite.end
_Defined in [Piwik/Plugins/SitesManager/API](https://github.com/piwik/piwik/blob/master/plugins/SitesManager/API.php) in line [600](https://github.com/piwik/piwik/blob/master/plugins/SitesManager/API.php#L600)_

Triggered after a site has been deleted. Plugins can use this event to remove site specific values or settings, such as removing all
goals that belong to a specific website. If you store any data related to a website you
should clean up that information here.

Callback Signature:
<pre><code>function($idSite)</code></pre>
- `int` `$idSite` The ID of the site being deleted.

Usages:

[Goals::deleteSiteGoals](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L118), [ScheduledReports::deleteSiteReport](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/ScheduledReports.php#L105), [UsersManager::deleteSite](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/UsersManager.php#L68)

## TaskScheduler

- [TaskScheduler.getScheduledTasks](#taskschedulergetscheduledtasks)

### TaskScheduler.getScheduledTasks
_Defined in [Piwik/TaskScheduler](https://github.com/piwik/piwik/blob/master/core/TaskScheduler.php) in line [95](https://github.com/piwik/piwik/blob/master/core/TaskScheduler.php#L95)_

Triggered when the TaskScheduler runs scheduled tasks. Collects all the tasks that
will be run.

Subscribe to this event to schedule code execution on an hourly, daily, weekly or monthly
basis.

**Example**

```
public function getScheduledTasks(&$tasks)
{
    $tasks[] = new ScheduledTask(
        'Piwik\Plugins\CorePluginsAdmin\MarketplaceApiClient',
        'clearAllCacheEntries',
        null,
        new Daily(),
        ScheduledTask::LOWEST_PRIORITY
    );
}
```

Callback Signature:
<pre><code>function(&amp;$tasks)</code></pre>
- `ScheduledTask` `$tasks` List of tasks to run periodically.

Usages:

[CoreAdminHome::getScheduledTasks](https://github.com/piwik/piwik/blob/master/plugins/CoreAdminHome/CoreAdminHome.php#L49), [CorePluginsAdmin::getScheduledTasks](https://github.com/piwik/piwik/blob/master/plugins/CorePluginsAdmin/CorePluginsAdmin.php#L42), [DBStats::getScheduledTasks](https://github.com/piwik/piwik/blob/master/plugins/DBStats/DBStats.php#L60), [PrivacyManager::getScheduledTasks](https://github.com/piwik/piwik/blob/master/plugins/PrivacyManager/PrivacyManager.php#L138), [ScheduledReports::getScheduledTasks](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/ScheduledReports.php#L412), [UserCountry::getScheduledTasks](https://github.com/piwik/piwik/blob/master/plugins/UserCountry/UserCountry.php#L69)

## Tracker

- [Tracker.detectReferrerSearchEngine](#trackerdetectreferrersearchengine)
- [Tracker.existingVisitInformation](#trackerexistingvisitinformation)
- [Tracker.getDatabaseConfig](#trackergetdatabaseconfig)
- [Tracker.isExcludedVisit](#trackerisexcludedvisit)
- [Tracker.makeNewVisitObject](#trackermakenewvisitobject)
- [Tracker.newVisitorInformation](#trackernewvisitorinformation)
- [Tracker.recordAction](#trackerrecordaction)
- [Tracker.recordEcommerceGoal](#trackerrecordecommercegoal)
- [Tracker.recordStandardGoals](#trackerrecordstandardgoals)
- [Tracker.Request.getIdSite](#trackerrequestgetidsite)
- [Tracker.setTrackerCacheGeneral](#trackersettrackercachegeneral)
- [Tracker.setVisitorIp](#trackersetvisitorip)

### Tracker.detectReferrerSearchEngine
_Defined in [Piwik/Tracker/Referrer](https://github.com/piwik/piwik/blob/master/core/Tracker/Referrer.php) in line [143](https://github.com/piwik/piwik/blob/master/core/Tracker/Referrer.php#L143)_

Triggered when detecting the search engine of a referrer URL. Plugins can use this event to provide custom search engine detection
logic.

Callback Signature:
<pre><code>function(&amp;$searchEngineInformation, $this-&gt;referrerUrl)</code></pre>
- `array` `$searchEngineInformation` An array with the following information: - **name**: The search engine name. - **keywords**: The search keywords used. This parameter will be defaulted to the results of Piwik&#039;s default search engine detection logic.
- `string`


### Tracker.existingVisitInformation
_Defined in [Piwik/Tracker/Visit](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php) in line [244](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php#L244)_

This event is triggered before updating an existing visit's row. Use it to change any visitor information before
the visitor is saved, or register information about an existing visitor.

Callback Signature:
<pre><code>function(&amp;$valuesToUpdate, $this-&gt;visitorInfo)</code></pre>


### Tracker.getDatabaseConfig
_Defined in [Piwik/Tracker](https://github.com/piwik/piwik/blob/master/core/Tracker.php) in line [542](https://github.com/piwik/piwik/blob/master/core/Tracker.php#L542)_

Triggered before a connection to the database is established in the Tracker. This event can be used to dynamically change the settings used to connect to the
database.

Callback Signature:
<pre><code>function(&amp;$configDb)</code></pre>
- `array` `$dbInfos` Reference to an array containing database connection info, including: - **host**: The host name or IP address to the MySQL database. - **username**: The username to use when connecting to the database. - **password**: The password to use when connecting to the database. - **dbname**: The name of the Piwik MySQL database. - **port**: The MySQL database port to use. - **adapter**: either `&#039;PDO_MYSQL&#039;` or `&#039;MYSQLI&#039;`


### Tracker.isExcludedVisit
_Defined in [Piwik/Tracker/VisitExcluded](https://github.com/piwik/piwik/blob/master/core/Tracker/VisitExcluded.php) in line [84](https://github.com/piwik/piwik/blob/master/core/Tracker/VisitExcluded.php#L84)_

Triggered on every pageview of a visitor. This event can be used to tell the Tracker not to record this particular pageview.

Callback Signature:
<pre><code>function(&amp;$excluded)</code></pre>
- `bool` `$excluded` Whether the pageview should be excluded or not. Initialized to `false`. Event subscribers should set it to `true` in order to exclude the pageview.

Usages:

[DoNotTrack::checkHeader](https://github.com/piwik/piwik/blob/master/plugins/DoNotTrack/DoNotTrack.php#L36)


### Tracker.makeNewVisitObject
_Defined in [Piwik/Tracker](https://github.com/piwik/piwik/blob/master/core/Tracker.php) in line [599](https://github.com/piwik/piwik/blob/master/core/Tracker.php#L599)_

Triggered before a new `Piwik\Tracker\Visit` object is created. Subscribers to this
event can force the use of a custom visit object that extends from
[Piwik\Tracker\VisitInterface](#).

Callback Signature:
<pre><code>function(&amp;$visit)</code></pre>
- `\Piwik\Tracker\VisitInterface` `$visit` Initialized to null, but can be set to a created Visit object. If it isn&#039;t modified Piwik uses the default class.


### Tracker.newVisitorInformation
_Defined in [Piwik/Tracker/Visit](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php) in line [298](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php#L298)_

This event can be used to determine and set new visit information before the visit is logged. The UserCountry plugin, for example, uses this event to inject location information
into the visit log table.

Callback Signature:
<pre><code>function(&amp;$this-&gt;visitorInfo, $this-&gt;request)</code></pre>
- `array` `$visitInfo` Information regarding the visit. This is information that persisted to the database.
- `\Piwik\Tracker\Request` `$request` Request object, contains many useful methods such as getUserAgent() or getIp() to get the original IP.

Usages:

[DevicesDetection::parseMobileVisitData](https://github.com/piwik/piwik/blob/master/plugins/DevicesDetection/DevicesDetection.php#L252), [Provider::enrichVisitWithProviderInfo](https://github.com/piwik/piwik/blob/master/plugins/Provider/Provider.php#L116), [UserCountry::getVisitorLocation](https://github.com/piwik/piwik/blob/master/plugins/UserCountry/UserCountry.php#L85)


### Tracker.recordAction
_Defined in [Piwik/Tracker/Action](https://github.com/piwik/piwik/blob/master/core/Tracker/Action.php) in line [333](https://github.com/piwik/piwik/blob/master/core/Tracker/Action.php#L333)_

Triggered after successfully logging an action for a visit.

Callback Signature:
<pre><code>function($trackerAction = $this, $info)</code></pre>
- `Action` `$trackerAction` The Action tracker instance.
- `array` `$info` An array describing the current visit action. Includes the following information: - **idSite**: The ID of the site that we are tracking. - **idLinkVisitAction**: The ID of the row that was inserted into the log_link_visit_action table. - **idVisit**: The visit ID. - **idReferrerActionUrl**: The ID referencing the row in the log_action table that holds the URL of the visitor&#039;s last action. - **idReferrerActionName**: The ID referencing the row in the log_action table that holds the name of the visitor&#039;s last action. - **timeSpentReferrerAction**: The number of seconds since the visitor&#039;s last action.


### Tracker.recordEcommerceGoal
_Defined in [Piwik/Tracker/GoalManager](https://github.com/piwik/piwik/blob/master/core/Tracker/GoalManager.php) in line [414](https://github.com/piwik/piwik/blob/master/core/Tracker/GoalManager.php#L414)_

This hook is called after recording an ecommerce goal. You can use it for instance to sync the recorded goal
with third party systems. `$goal` contains all available information like `items` and `revenue`.
`$visitor` contains the current known visit information.

Callback Signature:
<pre><code>function($goal, $visitorInformation)</code></pre>


### Tracker.recordStandardGoals
_Defined in [Piwik/Tracker/GoalManager](https://github.com/piwik/piwik/blob/master/core/Tracker/GoalManager.php) in line [779](https://github.com/piwik/piwik/blob/master/core/Tracker/GoalManager.php#L779)_

This hook is called after recording a standard goal. You can use it for instance to sync the recorded
goal with third party systems. `$goal` contains all available information like `url` and `revenue`.

Callback Signature:
<pre><code>function($newGoal)</code></pre>


### Tracker.Request.getIdSite
_Defined in [Piwik/Tracker/Request](https://github.com/piwik/piwik/blob/master/core/Tracker/Request.php) in line [314](https://github.com/piwik/piwik/blob/master/core/Tracker/Request.php#L314)_

Triggered when obtaining the ID of the site that is currently being tracked. This event can be used to modify the site ID from what is specified by the **idsite**
query parameter.

Callback Signature:
<pre><code>function(&amp;$idSite, $this-&gt;params)</code></pre>
- `int` `$idSite` Initialized to the value of the **idsite** query parameter. If a subscriber sets this variable, the value it uses must be greater than 0.
- `array` `$params` The entire array of request parameters passed with this tracking request.


### Tracker.setTrackerCacheGeneral
_Defined in [Piwik/Tracker/Cache](https://github.com/piwik/piwik/blob/master/core/Tracker/Cache.php) in line [144](https://github.com/piwik/piwik/blob/master/core/Tracker/Cache.php#L144)_

Triggered before the general tracker cache is saved to disk. This event can be
used to add extra content to the cace.

Data that is used during tracking but is expensive to compute/query should be
cached so as not to slow the tracker down. One example of such data are options
that are stored in the piwik_option table. Requesting data on each tracking
request means an extra unnecessary database query on each visitor action.

**Example**

    public function setTrackerCacheGeneral(&$cacheContent)
    {
        $cacheContent['MyPlugin.myCacheKey'] = Option::get('MyPlugin_myOption');
    }

Callback Signature:
<pre><code>function(&amp;$cacheContent)</code></pre>
- `array` `$cacheContent` Array of cached data. Each piece of data must be mapped by name.

Usages:

[UserCountry::setTrackerCacheGeneral](https://github.com/piwik/piwik/blob/master/plugins/UserCountry/UserCountry.php#L64)


### Tracker.setVisitorIp
_Defined in [Piwik/Tracker/Visit](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php) in line [96](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php#L96)_

This event can be used for instance to anonymize the IP (after testing for IP exclusion).

Callback Signature:
<pre><code>function(&amp;$this-&gt;visitorInfo[&#039;location_ip&#039;])</code></pre>

Usages:

[AnonymizeIP::setVisitorIpAddress](https://github.com/piwik/piwik/blob/master/plugins/AnonymizeIP/AnonymizeIP.php#L83)

## Translate

- [Translate.getClientSideTranslationKeys](#translategetclientsidetranslationkeys)

### Translate.getClientSideTranslationKeys
_Defined in [Piwik/Translate](https://github.com/piwik/piwik/blob/master/core/Translate.php) in line [194](https://github.com/piwik/piwik/blob/master/core/Translate.php#L194)_

Triggered before generating the JavaScript code that allows i18n strings to be used in the browser. Plugins should subscribe to this event to specify which translations
should be available in JavaScript code.

Event handlers should add whole translation keys, ie, keys that include the plugin name.

**Example**

    public function getClientSideTranslationKeys(&$result)
    {
        $result[] = "MyPlugin_MyTranslation";
    }

Callback Signature:
<pre><code>function(&amp;$result)</code></pre>
- `array` `$result` The whole list of client side translation keys.

Usages:

[CoreHome::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/master/plugins/CoreHome/CoreHome.php#L96), [CorePluginsAdmin::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/master/plugins/CorePluginsAdmin/CorePluginsAdmin.php#L109), [CoreVisualizations::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/master/plugins/CoreVisualizations/CoreVisualizations.php#L64), [Dashboard::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/master/plugins/Dashboard/Dashboard.php#L279), [Feedback::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/master/plugins/Feedback/Feedback.php#L58), [Goals::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L670), [Live::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/master/plugins/Live/Live.php#L65), [Overlay::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/master/plugins/Overlay/Overlay.php#L46), [SitesManager::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/master/plugins/SitesManager/SitesManager.php#L212), [Transitions::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/master/plugins/Transitions/Transitions.php#L41), [UserCountry::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/master/plugins/UserCountry/UserCountry.php#L495), [UsersManager::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/UsersManager.php#L139), [Widgetize::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/master/plugins/Widgetize/Widgetize.php#L63)

## Updater

- [Updater.checkForUpdates](#updatercheckforupdates)

### Updater.checkForUpdates
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [365](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L365)_

Triggered after the platform is initialized and after the user has been authenticated, but before the platform dispatched the request. Piwik uses this event to check for updates to Piwik.

Usages:

[CoreUpdater::updateCheck](https://github.com/piwik/piwik/blob/master/plugins/CoreUpdater/CoreUpdater.php#L83)

## User

- [User.getLanguage](#usergetlanguage)
- [User.isNotAuthorized](#userisnotauthorized)

### User.getLanguage
_Defined in [Piwik/Translate](https://github.com/piwik/piwik/blob/master/core/Translate.php) in line [124](https://github.com/piwik/piwik/blob/master/core/Translate.php#L124)_

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
- `string` `$lang` The language that should be used for the user. Will be initialized to the value of the **language** query parameter.

Usages:

[LanguagesManager::getLanguageToLoad](https://github.com/piwik/piwik/blob/master/plugins/LanguagesManager/LanguagesManager.php#L88)


### User.isNotAuthorized
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [152](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L152)_

Triggered when a user with insufficient access permissions tries to view some resource. This event can be used to customize the error that occurs when a user is denied access
(for example, displaying an error message, redirecting to a page other than login, etc.).

Callback Signature:
<pre><code>function($exception)</code></pre>
- `NoAccessException` `$exception` The exception that was caught.

Usages:

[Login::noAccess](https://github.com/piwik/piwik/blob/master/plugins/Login/Login.php#L46)

## UsersManager

- [UsersManager.addUser.end](#usersmanageradduserend)
- [UsersManager.deleteUser](#usersmanagerdeleteuser)
- [UsersManager.updateUser.end](#usersmanagerupdateuserend)

### UsersManager.addUser.end
_Defined in [Piwik/Plugins/UsersManager/API](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/API.php) in line [406](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/API.php#L406)_

Triggered after a new user is created.

Callback Signature:
<pre><code>function($userLogin)</code></pre>
- `string` `$userLogin` The new user&#039;s login handle.


### UsersManager.deleteUser
_Defined in [Piwik/Plugins/UsersManager/API](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/API.php) in line [661](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/API.php#L661)_

Triggered after a user has been deleted. This event should be used to clean up any data that is related to the user that was
deleted. For example, the Dashboard plugin uses this event to remove the user's dashboards.

Callback Signature:
<pre><code>function($userLogin)</code></pre>
- `string` `$userLogin` The login handle of the deleted user.

Usages:

[CoreAdminHome::cleanupUser](https://github.com/piwik/piwik/blob/master/plugins/CoreAdminHome/CoreAdminHome.php#L44), [Dashboard::deleteDashboardLayout](https://github.com/piwik/piwik/blob/master/plugins/Dashboard/Dashboard.php#L248), [LanguagesManager::deleteUserLanguage](https://github.com/piwik/piwik/blob/master/plugins/LanguagesManager/LanguagesManager.php#L98), [ScheduledReports::deleteUserReport](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/ScheduledReports.php#L508)


### UsersManager.updateUser.end
_Defined in [Piwik/Plugins/UsersManager/API](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/API.php) in line [468](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/API.php#L468)_

Triggered after an existing user has been updated.

Callback Signature:
<pre><code>function($userLogin)</code></pre>
- `string` `$userLogin` The user&#039;s login handle.

## ViewDataTable

- [ViewDataTable.addViewDataTable](#viewdatatableaddviewdatatable)
- [ViewDataTable.configure](#viewdatatableconfigure)
- [ViewDataTable.getDefaultType](#viewdatatablegetdefaulttype)

### ViewDataTable.addViewDataTable
_Defined in [Piwik/ViewDataTable/Manager](https://github.com/piwik/piwik/blob/master/core/ViewDataTable/Manager.php) in line [85](https://github.com/piwik/piwik/blob/master/core/ViewDataTable/Manager.php#L85)_

Triggered when gathering all available DataTable visualizations. Plugins that want to expose new DataTable visualizations should subscribe to
this event and add visualization class names to the incoming array.

**Example**

    public function addViewDataTable(&$visualizations)
    {
        $visualizations[] = 'Piwik\\Plugins\\MyPlugin\\MyVisualization';
    }

Callback Signature:
<pre><code>function(&amp;$visualizations)</code></pre>
- `array` `$visualizations` The array of all available visualizations.

Usages:

[CoreVisualizations::getAvailableDataTableVisualizations](https://github.com/piwik/piwik/blob/master/plugins/CoreVisualizations/CoreVisualizations.php#L38), [ExampleVisualization::getAvailableVisualizations](https://github.com/piwik/piwik/blob/master/plugins/ExampleVisualization/ExampleVisualization.php#L28), [Goals::getAvailableDataTableVisualizations](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L110)


### ViewDataTable.configure
_Defined in [Piwik/Plugin/ViewDataTable](https://github.com/piwik/piwik/blob/master/core/Plugin/ViewDataTable.php) in line [125](https://github.com/piwik/piwik/blob/master/core/Plugin/ViewDataTable.php#L125)_

Triggered during [ViewDataTable](#) is constructed. Subscribers should customize
the view based on the report that it is displaying.

Plugins that define their own reports must subscribe to this event in order to
customize how the Piwik UI will display and navigate the report.

**Example**

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
- `ViewDataTable` `$view` The instance to configure.

Usages:

[Actions::configureViewDataTable](https://github.com/piwik/piwik/blob/master/plugins/Actions/Actions.php#L544), [CustomVariables::configureViewDataTable](https://github.com/piwik/piwik/blob/master/plugins/CustomVariables/CustomVariables.php#L156), [DBStats::configureViewDataTable](https://github.com/piwik/piwik/blob/master/plugins/DBStats/DBStats.php#L110), [DevicesDetection::configureViewDataTable](https://github.com/piwik/piwik/blob/master/plugins/DevicesDetection/DevicesDetection.php#L296), [Goals::configureViewDataTable](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L535), [Provider::configureViewDataTable](https://github.com/piwik/piwik/blob/master/plugins/Provider/Provider.php#L242), [Referrers::configureViewDataTable](https://github.com/piwik/piwik/blob/master/plugins/Referrers/Referrers.php#L309), [UserCountry::configureViewDataTable](https://github.com/piwik/piwik/blob/master/plugins/UserCountry/UserCountry.php#L367), [UserSettings::configureViewDataTable](https://github.com/piwik/piwik/blob/master/plugins/UserSettings/UserSettings.php#L189), [VisitTime::configureViewDataTable](https://github.com/piwik/piwik/blob/master/plugins/VisitTime/VisitTime.php#L136), [VisitorInterest::configureViewDataTable](https://github.com/piwik/piwik/blob/master/plugins/VisitorInterest/VisitorInterest.php#L164)


### ViewDataTable.getDefaultType
_Defined in [Piwik/ViewDataTable/Factory](https://github.com/piwik/piwik/blob/master/core/ViewDataTable/Factory.php) in line [165](https://github.com/piwik/piwik/blob/master/core/ViewDataTable/Factory.php#L165)_

Triggered when gathering the default view types for all available reports. By default the HtmlTable
visualization is used. If you define your own report, you may want to subscribe to this event to
make sure another Visualization is used (for example, a pie graph, bar graph, or something else).

**Example**
```
public function getDefaultTypeViewDataTable(&$defaultViewTypes)
{
    $defaultViewTypes['Referrers.getSocials']       = HtmlTable::ID;
    $defaultViewTypes['Referrers.getUrlsForSocial'] = Pie::ID;
}
```

Callback Signature:
<pre><code>function(&amp;self::$defaultViewTypes)</code></pre>
- `array` `$defaultViewTypes` The array mapping report IDs with visualization IDs.

Usages:

[DBStats::getDefaultTypeViewDataTable](https://github.com/piwik/piwik/blob/master/plugins/DBStats/DBStats.php#L97), [Live::getDefaultTypeViewDataTable](https://github.com/piwik/piwik/blob/master/plugins/Live/Live.php#L74), [Referrers::getDefaultTypeViewDataTable](https://github.com/piwik/piwik/blob/master/plugins/Referrers/Referrers.php#L303), [UserSettings::getDefaultTypeViewDataTable](https://github.com/piwik/piwik/blob/master/plugins/UserSettings/UserSettings.php#L184), [VisitTime::getDefaultTypeViewDataTable](https://github.com/piwik/piwik/blob/master/plugins/VisitTime/VisitTime.php#L129), [VisitorInterest::getDefaultTypeViewDataTable](https://github.com/piwik/piwik/blob/master/plugins/VisitorInterest/VisitorInterest.php#L158)

## WidgetsList

- [WidgetsList.addWidgets](#widgetslistaddwidgets)

### WidgetsList.addWidgets
_Defined in [Piwik/WidgetsList](https://github.com/piwik/piwik/blob/master/core/WidgetsList.php) in line [92](https://github.com/piwik/piwik/blob/master/core/WidgetsList.php#L92)_

Triggered once when the widget list is first requested. Collects all available widgets.

Subscribe to this event to make your plugin's reports or other controller actions available
as dashboard widgets. Event handlers should call the WidgetsList::add method for each
new dashboard widget.

**Example**

```
public function addWidgets()
{
    WidgetsList::add('General_Actions', 'General_Pages', 'Actions', 'getPageUrls');
}
```

Usages:

[Actions::addWidgets](https://github.com/piwik/piwik/blob/master/plugins/Actions/Actions.php#L462), [CoreHome::addWidgets](https://github.com/piwik/piwik/blob/master/plugins/CoreHome/CoreHome.php#L37), [CustomVariables::addWidgets](https://github.com/piwik/piwik/blob/master/plugins/CustomVariables/CustomVariables.php#L50), [DevicesDetection::addWidgets](https://github.com/piwik/piwik/blob/master/plugins/DevicesDetection/DevicesDetection.php#L170), [ExampleRssWidget::addWidgets](https://github.com/piwik/piwik/blob/master/plugins/ExampleRssWidget/ExampleRssWidget.php#L37), [Goals::addWidgets](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L445), [Live::addWidget](https://github.com/piwik/piwik/blob/master/plugins/Live/Live.php#L57), [Provider::addWidget](https://github.com/piwik/piwik/blob/master/plugins/Provider/Provider.php#L97), [Referrers::addWidgets](https://github.com/piwik/piwik/blob/master/plugins/Referrers/Referrers.php#L220), [SEO::addWidgets](https://github.com/piwik/piwik/blob/master/plugins/SEO/SEO.php#L43), [UserCountry::addWidgets](https://github.com/piwik/piwik/blob/master/plugins/UserCountry/UserCountry.php#L173), [UserSettings::addWidgets](https://github.com/piwik/piwik/blob/master/plugins/UserSettings/UserSettings.php#L453), [VisitFrequency::addWidgets](https://github.com/piwik/piwik/blob/master/plugins/VisitFrequency/VisitFrequency.php#L61), [VisitTime::addWidgets](https://github.com/piwik/piwik/blob/master/plugins/VisitTime/VisitTime.php#L87), [VisitorInterest::addWidgets](https://github.com/piwik/piwik/blob/master/plugins/VisitorInterest/VisitorInterest.php#L108), [VisitsSummary::addWidgets](https://github.com/piwik/piwik/blob/master/plugins/VisitsSummary/VisitsSummary.php#L63)

