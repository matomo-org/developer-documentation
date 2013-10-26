Hooks
==========

On this page you will learn how to use as well as how to trigger hooks. All already existing hooks are listed below.

## Usage

#### Register an action for a given hook
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

#### Add a new hook
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

- [API](#api)
- [ArchiveProcessor](#archiveprocessor)
- [AssetManager](#assetmanager)
- [Config](#config)
- [Controller](#controller)
- [Goals](#goals)
- [Live](#live)
- [Log](#log)
- [Login](#login)
- [Menu](#menu)
- [Provider](#provider)
- [Reporting](#reporting)
- [Request](#request)
- [ScheduledReports](#scheduledreports)
- [SegmentEditor](#segmenteditor)
- [Segments](#segments)
- [Site](#site)
- [SitesManager](#sitesmanager)
- [TaskScheduler](#taskscheduler)
- [Tracker](#tracker)
- [Translate](#translate)
- [Updater](#updater)
- [User](#user)
- [UsersManager](#usersmanager)
- [ViewDataTable](#viewdatatable)
- [WidgetsList](#widgetslist)

## API

- [API.$pluginName.$methodName](#apipluginnamemethodname)
- [API.$pluginName.$methodName.end](#apipluginnamemethodnameend)
- [API.getReportMetadata](#apigetreportmetadata)
- [API.getReportMetadata.end](#apigetreportmetadataend)
- [API.getSegmentsMetadata](#apigetsegmentsmetadata)
- [API.Request.authenticate](#apirequestauthenticate)
- [API.Request.dispatch](#apirequestdispatch)
- [API.Request.dispatch.end](#apirequestdispatchend)

#### API.$pluginName.$methodName
_Defined in [Piwik/API/Proxy](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php) in line [194](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php#L194)_

This event exists for convenience and is triggered directly after the [API.Request.dispatch](#) event is triggered. It can be used to modify the input that is passed to a single API method. This is also
possible with the [API.Request.dispatch](#) event, however that event requires event handlers
check if the plugin name and method name are correct before modifying the parameters.

**Example**

    Piwik::addAction('API.Actions.getPageUrls', function (&$parameters) {
        // ...
    });

Callback Signature:
<pre><code>function(&amp;$finalParameters)</code></pre>


#### API.$pluginName.$methodName.end
_Defined in [Piwik/API/Proxy](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php) in line [229](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php#L229)_

This event exists for convenience and is triggered immediately before the [API.Request.dispatch.end](#) event. It can be used to modify the output of a single API method. This is also possible with
the [API.Request.dispatch.end](#) event, however that event requires event handlers
check if the plugin name and method name are correct before modifying the output.

Callback Signature:
<pre><code>$endHookParams</code></pre>


#### API.getReportMetadata
_Defined in [Piwik/Plugins/API/ProcessedReport](https://github.com/piwik/piwik/blob/master/plugins/API/ProcessedReport.php) in line [93](https://github.com/piwik/piwik/blob/master/plugins/API/ProcessedReport.php#L93)_

This event is triggered to get all available reports. Your plugin can use this event to add one or
multiple reports. By doing that the report will be for instance available in ScheduledReports as well as
in the Piwik Mobile App.

Callback Signature:
<pre><code>function(&amp;$availableReports, $parameters)</code></pre>

Usages:

[Actions::getReportMetadata](https://github.com/piwik/piwik/blob/master/plugins/Actions/Actions.php#L215), [CustomVariables::getReportMetadata](https://github.com/piwik/piwik/blob/master/plugins/CustomVariables/CustomVariables.php#L63), [DevicesDetection::getReportMetadata](https://github.com/piwik/piwik/blob/master/plugins/DevicesDetection/DevicesDetection.php#L203), [MultiSites::getReportMetadata](https://github.com/piwik/piwik/blob/master/plugins/MultiSites/MultiSites.php#L43), [Provider::getReportMetadata](https://github.com/piwik/piwik/blob/master/plugins/Provider/Provider.php#L49), [Referrers::getReportMetadata](https://github.com/piwik/piwik/blob/master/plugins/Referrers/Referrers.php#L53), [UserCountry::getReportMetadata](https://github.com/piwik/piwik/blob/master/plugins/UserCountry/UserCountry.php#L259), [UserSettings::getReportMetadata](https://github.com/piwik/piwik/blob/master/plugins/UserSettings/UserSettings.php#L394), [VisitFrequency::getReportMetadata](https://github.com/piwik/piwik/blob/master/plugins/VisitFrequency/VisitFrequency.php#L36), [VisitTime::getReportMetadata](https://github.com/piwik/piwik/blob/master/plugins/VisitTime/VisitTime.php#L51), [VisitorInterest::getReportMetadata](https://github.com/piwik/piwik/blob/master/plugins/VisitorInterest/VisitorInterest.php#L47), [VisitsSummary::getReportMetadata](https://github.com/piwik/piwik/blob/master/plugins/VisitsSummary/VisitsSummary.php#L39)


#### API.getReportMetadata.end
_Defined in [Piwik/Plugins/API/ProcessedReport](https://github.com/piwik/piwik/blob/master/plugins/API/ProcessedReport.php) in line [115](https://github.com/piwik/piwik/blob/master/plugins/API/ProcessedReport.php#L115)_

This event is triggered after all available reports are collected. Plugins can add custom metrics to
other reports or remove reports from the list of all available reports.

Callback Signature:
<pre><code>function(&amp;$availableReports, $parameters)</code></pre>

Usages:

[Goals::getReportMetadata](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L130)


#### API.getSegmentsMetadata
_Defined in [Piwik/Plugins/API/API](https://github.com/piwik/piwik/blob/master/plugins/API/API.php) in line [90](https://github.com/piwik/piwik/blob/master/plugins/API/API.php#L90)_

This event is triggered to get all available segments. Your plugin can use this event to add one or
multiple new segments.

Callback Signature:
<pre><code>function(&amp;$segments, $idSites)</code></pre>

Usages:

[Actions::getSegmentsMetadata](https://github.com/piwik/piwik/blob/master/plugins/Actions/Actions.php#L84), [CustomVariables::getSegmentsMetadata](https://github.com/piwik/piwik/blob/master/plugins/CustomVariables/CustomVariables.php#L87), [DevicesDetection::getSegmentsMetadata](https://github.com/piwik/piwik/blob/master/plugins/DevicesDetection/DevicesDetection.php#L183), [Goals::getSegmentsMetadata](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L410), [Provider::getSegmentsMetadata](https://github.com/piwik/piwik/blob/master/plugins/Provider/Provider.php#L62), [Referrers::getSegmentsMetadata](https://github.com/piwik/piwik/blob/master/plugins/Referrers/Referrers.php#L180), [UserCountry::getSegmentsMetadata](https://github.com/piwik/piwik/blob/master/plugins/UserCountry/UserCountry.php#L206), [UserSettings::getSegmentsMetadata](https://github.com/piwik/piwik/blob/master/plugins/UserSettings/UserSettings.php#L434), [VisitTime::getSegmentsMetadata](https://github.com/piwik/piwik/blob/master/plugins/VisitTime/VisitTime.php#L108)


#### API.Request.authenticate
_Defined in [Piwik/API/Request](https://github.com/piwik/piwik/blob/master/core/API/Request.php) in line [251](https://github.com/piwik/piwik/blob/master/core/API/Request.php#L251)_

Triggered when authenticating an API request. Only triggered if the **token_auth**
query parameter is found in the request.

Plugins that provide authentication capabilities should subscribe to this event
and make sure the authentication object (the object returned by `Registry::get('auth')`)
is setup to use `$token_auth` when its `authenticate()` method is executed.

Callback Signature:
<pre><code>function($token_auth)</code></pre>

Usages:

[Login::ApiRequestAuthenticate](https://github.com/piwik/piwik/blob/master/plugins/Login/Login.php#L59)


#### API.Request.dispatch
_Defined in [Piwik/API/Proxy](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php) in line [176](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php#L176)_

Triggered before an API request is dispatched. This event can be used to modify the input that is passed to every API method or just
one.

Callback Signature:
<pre><code>function(&amp;$finalParameters)</code></pre>


#### API.Request.dispatch.end
_Defined in [Piwik/API/Proxy](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php) in line [250](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php#L250)_

Triggered directly after an API request is dispatched. This event can be used to modify the output of any API method.

Callback Signature:
<pre><code>$endHookParams</code></pre>

## ArchiveProcessor

- [ArchiveProcessor.Day.compute](#archiveprocessordaycompute)
- [ArchiveProcessor.Period.compute](#archiveprocessorperiodcompute)

#### ArchiveProcessor.Day.compute
_Defined in [Piwik/ArchiveProcessor/Day](https://github.com/piwik/piwik/blob/master/core/ArchiveProcessor/Day.php) in line [135](https://github.com/piwik/piwik/blob/master/core/ArchiveProcessor/Day.php#L135)_

Triggered when the archiving process is initiated for a day period. Plugins that compute analytics data should subscribe to this event. The
actual archiving logic, however, should not be in the event handler, but
in a class that descends from [Archiver](#).

To learn more about single day archiving, see the [ArchiveProcessor\Day](#)
class.

**Example**

    public function archivePeriod(ArchiveProcessor\Day $archiveProcessor)
    {
        $archiving = new MyArchiver($archiveProcessor);
        if ($archiving->shouldArchive()) {
            $archiving->archiveDay();
        }
    }

Callback Signature:
<pre><code>function(&amp;$this)</code></pre>

Usages:

[Actions::archiveDay](https://github.com/piwik/piwik/blob/master/plugins/Actions/Actions.php#L599), [CustomVariables::archiveDay](https://github.com/piwik/piwik/blob/master/plugins/CustomVariables/CustomVariables.php#L140), [DevicesDetection::archiveDay](https://github.com/piwik/piwik/blob/master/plugins/DevicesDetection/DevicesDetection.php#L276), [Goals::archiveDay](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L508), [Provider::archiveDay](https://github.com/piwik/piwik/blob/master/plugins/Provider/Provider.php#L223), [Referrers::archiveDay](https://github.com/piwik/piwik/blob/master/plugins/Referrers/Referrers.php#L283), [UserCountry::archiveDay](https://github.com/piwik/piwik/blob/master/plugins/UserCountry/UserCountry.php#L340), [UserSettings::archiveDay](https://github.com/piwik/piwik/blob/master/plugins/UserSettings/UserSettings.php#L477), [VisitTime::archiveDay](https://github.com/piwik/piwik/blob/master/plugins/VisitTime/VisitTime.php#L207), [VisitorInterest::archiveDay](https://github.com/piwik/piwik/blob/master/plugins/VisitorInterest/VisitorInterest.php#L136)


#### ArchiveProcessor.Period.compute
_Defined in [Piwik/ArchiveProcessor/Period](https://github.com/piwik/piwik/blob/master/core/ArchiveProcessor/Period.php) in line [246](https://github.com/piwik/piwik/blob/master/core/ArchiveProcessor/Period.php#L246)_

Triggered when the archiving process is initiated for a non-day period. Plugins that compute analytics data should subscribe to this event. The
actual archiving logic, however, should not be in the event handler, but
in a class that descends from [Archiver](#).

To learn more about non-day period archiving, see the [ArchiveProcessor\Period](#)
class.

**Example**

    public function archivePeriod(ArchiveProcessor\Period $archiveProcessor)
    {
        $archiving = new MyArchiver($archiveProcessor);
        if ($archiving->shouldArchive()) {
            $archiving->archivePeriod();
        }
    }

Callback Signature:
<pre><code>function(&amp;$this)</code></pre>

Usages:

[Actions::archivePeriod](https://github.com/piwik/piwik/blob/master/plugins/Actions/Actions.php#L607), [CustomVariables::archivePeriod](https://github.com/piwik/piwik/blob/master/plugins/CustomVariables/CustomVariables.php#L148), [DevicesDetection::archivePeriod](https://github.com/piwik/piwik/blob/master/plugins/DevicesDetection/DevicesDetection.php#L284), [Goals::archivePeriod](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L520), [Provider::archivePeriod](https://github.com/piwik/piwik/blob/master/plugins/Provider/Provider.php#L231), [Referrers::archivePeriod](https://github.com/piwik/piwik/blob/master/plugins/Referrers/Referrers.php#L295), [UserCountry::archivePeriod](https://github.com/piwik/piwik/blob/master/plugins/UserCountry/UserCountry.php#L332), [UserSettings::archivePeriod](https://github.com/piwik/piwik/blob/master/plugins/UserSettings/UserSettings.php#L488), [VisitTime::archivePeriod](https://github.com/piwik/piwik/blob/master/plugins/VisitTime/VisitTime.php#L199), [VisitorInterest::archivePeriod](https://github.com/piwik/piwik/blob/master/plugins/VisitorInterest/VisitorInterest.php#L128)

## AssetManager

- [AssetManager.filterMergedJavaScripts](#assetmanagerfiltermergedjavascripts)
- [AssetManager.filterMergedStylesheets](#assetmanagerfiltermergedstylesheets)
- [AssetManager.getJavaScriptFiles](#assetmanagergetjavascriptfiles)
- [AssetManager.getStylesheetFiles](#assetmanagergetstylesheetfiles)

#### AssetManager.filterMergedJavaScripts
_Defined in [Piwik/AssetManager](https://github.com/piwik/piwik/blob/master/core/AssetManager.php) in line [393](https://github.com/piwik/piwik/blob/master/core/AssetManager.php#L393)_

Triggered after all JavaScript files Piwik uses are minified and merged into a single file, but before the merged JavaScript is written to disk. Plugins can use this event to modify merged JavaScript or do something else
with it.

Callback Signature:
<pre><code>function(&amp;$mergedContent)</code></pre>


#### AssetManager.filterMergedStylesheets
_Defined in [Piwik/AssetManager](https://github.com/piwik/piwik/blob/master/core/AssetManager.php) in line [168](https://github.com/piwik/piwik/blob/master/core/AssetManager.php#L168)_

Triggered after all less stylesheets are compiled to CSS, minified and merged into one file, but before the generated CSS is written to disk. This event can be used to modify merged CSS.

Callback Signature:
<pre><code>function(&amp;$mergedContent)</code></pre>


#### AssetManager.getJavaScriptFiles
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

Usages:

[Actions::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/Actions/Actions.php#L79), [Annotations::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/Annotations/Annotations.php#L43), [CoreAdminHome::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/CoreAdminHome/CoreAdminHome.php#L77), [CoreHome::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/CoreHome/CoreHome.php#L62), [CorePluginsAdmin::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/CorePluginsAdmin/CorePluginsAdmin.php#L101), [CoreVisualizations::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/CoreVisualizations/CoreVisualizations.php#L55), [Dashboard::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/Dashboard/Dashboard.php#L233), [ExamplePluginTemplate::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/ExamplePluginTemplate/ExamplePluginTemplate.php#L30), [Feedback::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/Feedback/Feedback.php#L53), [Goals::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L422), [LanguagesManager::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/LanguagesManager/LanguagesManager.php#L51), [Live::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/Live/Live.php#L49), [MobileMessaging::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/MobileMessaging/MobileMessaging.php#L100), [MultiSites::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/MultiSites/MultiSites.php#L85), [Overlay::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/Overlay/Overlay.php#L40), [PrivacyManager::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/PrivacyManager/PrivacyManager.php#L154), [ScheduledReports::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/ScheduledReports.php#L115), [SegmentEditor::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/SegmentEditor/SegmentEditor.php#L100), [SitesManager::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/SitesManager/SitesManager.php#L60), [Transitions::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/Transitions/Transitions.php#L36), [UserCountry::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/UserCountry/UserCountry.php#L79), [UserCountryMap::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/UserCountryMap/UserCountryMap.php#L67), [UsersManager::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/UsersManager.php#L78), [Widgetize::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/Widgetize/Widgetize.php#L44)


#### AssetManager.getStylesheetFiles
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

Usages:

[Plugin::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/API/API.php#L674), [Actions::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/Actions/Actions.php#L74), [Annotations::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/Annotations/Annotations.php#L35), [CoreAdminHome::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/CoreAdminHome/CoreAdminHome.php#L68), [CoreHome::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/CoreHome/CoreHome.php#L43), [CorePluginsAdmin::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/CorePluginsAdmin/CorePluginsAdmin.php#L53), [CoreVisualizations::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/CoreVisualizations/CoreVisualizations.php#L49), [DBStats::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/DBStats/DBStats.php#L86), [Dashboard::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/Dashboard/Dashboard.php#L242), [ExampleRssWidget::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/ExampleRssWidget/ExampleRssWidget.php#L32), [Feedback::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/Feedback/Feedback.php#L48), [Goals::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L427), [Installation::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/Installation/Installation.php#L91), [LanguagesManager::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/LanguagesManager/LanguagesManager.php#L46), [Live::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/Live/Live.php#L43), [MobileMessaging::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/MobileMessaging/MobileMessaging.php#L105), [MultiSites::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/MultiSites/MultiSites.php#L90), [SegmentEditor::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/SegmentEditor/SegmentEditor.php#L105), [SitesManager::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/SitesManager/SitesManager.php#L51), [Transitions::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/Transitions/Transitions.php#L31), [UserCountry::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/UserCountry/UserCountry.php#L74), [UserCountryMap::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/UserCountryMap/UserCountryMap.php#L77), [UsersManager::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/UsersManager.php#L87), [Widgetize::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/Widgetize/Widgetize.php#L54)

## Config

- [Config.badConfigurationFile](#configbadconfigurationfile)
- [Config.NoConfigurationFile](#confignoconfigurationfile)

#### Config.badConfigurationFile
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [312](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L312)_

Triggered if the INI config file has the incorrect format or if certain required configuration options are absent. This event can be used to start the installation process or to display a
custom error message.

Callback Signature:
<pre><code>function($exception)</code></pre>

Usages:

[Installation::dispatch](https://github.com/piwik/piwik/blob/master/plugins/Installation/Installation.php#L53)


#### Config.NoConfigurationFile
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [236](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L236)_

Triggered when the configuration file cannot be found or read. This usually
means Piwik is not installed yet. This event can be used to start the
installation process or to display a custom error message.

Callback Signature:
<pre><code>function($exception)</code></pre>

Usages:

[Installation::dispatch](https://github.com/piwik/piwik/blob/master/plugins/Installation/Installation.php#L53)

## Controller

- [Controller.$module.$action](#controllermoduleaction)
- [Controller.$module.$action.end](#controllermoduleactionend)

#### Controller.$module.$action
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [111](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L111)_

This event exists for convenience and is triggered directly after the [Request.dispatch](#) event is triggered. It can be used to do the same things as the [Request.dispatch](#) event, but for one controller
action only. Using this event will result in a little less code than [Request.dispatch](#).

Callback Signature:
<pre><code>function(&amp;$parameters)</code></pre>


#### Controller.$module.$action.end
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [127](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L127)_

This event exists for convenience and is triggered immediately before the [Request.dispatch.end](#) event is triggered. It can be used to do the same things as the [Request.dispatch.end](#) event, but for one
controller action only. Using this event will result in a little less code than
[Request.dispatch.end](#).

Callback Signature:
<pre><code>function(&amp;$result, $parameters)</code></pre>

## Goals

- [Goals.getReportsWithGoalMetrics](#goalsgetreportswithgoalmetrics)

#### Goals.getReportsWithGoalMetrics
_Defined in [Piwik/Plugins/Goals/Goals](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php) in line [370](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L370)_



Callback Signature:
<pre><code>function(&amp;$reportsWithGoals)</code></pre>

Usages:

[CustomVariables::getReportsWithGoalMetrics](https://github.com/piwik/piwik/blob/master/plugins/CustomVariables/CustomVariables.php#L128), [Goals::getActualReportsWithGoalMetrics](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L393), [Referrers::getReportsWithGoalMetrics](https://github.com/piwik/piwik/blob/master/plugins/Referrers/Referrers.php#L249), [UserCountry::getReportsWithGoalMetrics](https://github.com/piwik/piwik/blob/master/plugins/UserCountry/UserCountry.php#L308), [VisitTime::getReportsWithGoalMetrics](https://github.com/piwik/piwik/blob/master/plugins/VisitTime/VisitTime.php#L99)

## Live

- [Live.getExtraVisitorDetails](#livegetextravisitordetails)

#### Live.getExtraVisitorDetails
_Defined in [Piwik/Plugins/Live/API](https://github.com/piwik/piwik/blob/master/plugins/Live/API.php) in line [360](https://github.com/piwik/piwik/blob/master/plugins/Live/API.php#L360)_

This event is called in the Live.getVisitorProfile API method. Plugins can use this event
to discover and add extra data to visitor profiles.

For example, if an email address is found in a custom variable, a plugin could load the
gravatar for the email and add it to the visitor profile so it will display in the
visitor profile popup.

The following visitor profile elements can be set to augment the visitor profile popup:
- visitorAvatar: A URL to an image to display in the top left corner of the popup.
- visitorDescription: Text to be used as the tooltip of the avatar image.

Callback Signature:
<pre><code>function(&amp;$result)</code></pre>

## Log

- [Log.formatDatabaseMessage](#logformatdatabasemessage)
- [Log.formatFileMessage](#logformatfilemessage)
- [Log.formatScreenMessage](#logformatscreenmessage)
- [Log.getAvailableWriters](#loggetavailablewriters)

#### Log.formatDatabaseMessage
_Defined in [Piwik/Log](https://github.com/piwik/piwik/blob/master/core/Log.php) in line [432](https://github.com/piwik/piwik/blob/master/core/Log.php#L432)_

This event is called when trying to log an object to a database table. Plugins can use
this event to convert objects to strings before they are logged.

Callback Signature:
<pre><code>function(&amp;$message, $level, $tag, $datetime, $logger)</code></pre>


#### Log.formatFileMessage
_Defined in [Piwik/Log](https://github.com/piwik/piwik/blob/master/core/Log.php) in line [353](https://github.com/piwik/piwik/blob/master/core/Log.php#L353)_

This event is called when trying to log an object to a file. Plugins can use
this event to convert objects to strings before they are logged.

Callback Signature:
<pre><code>function(&amp;$message, $level, $tag, $datetime, $logger)</code></pre>


#### Log.formatScreenMessage
_Defined in [Piwik/Log](https://github.com/piwik/piwik/blob/master/core/Log.php) in line [402](https://github.com/piwik/piwik/blob/master/core/Log.php#L402)_

This event is called when trying to log an object to the screen. Plugins can use
this event to convert objects to strings before they are logged.

The result of this callback can be HTML so no sanitization is done on the result.
This means YOU MUST SANITIZE THE MESSAGE YOURSELF if you use this event.

Callback Signature:
<pre><code>function(&amp;$message, $level, $tag, $datetime, $logger)</code></pre>


#### Log.getAvailableWriters
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

## Login

- [Login.initSession](#logininitsession)
- [Login.initSession](#logininitsession)

#### Login.initSession
_Defined in [Piwik/Plugins/Login/Controller](https://github.com/piwik/piwik/blob/master/plugins/Login/Controller.php) in line [187](https://github.com/piwik/piwik/blob/master/plugins/Login/Controller.php#L187)_

This event is triggered to initialize a user session. You can use this event to authenticate user against
third party systems.

Example:
```
public function initSession($info)
{
    $login = $info['login'];
    $md5Password = $info['md5Password'];
    $rememberMe = $info['rememberMe'];
}
```

Callback Signature:
<pre><code>function(&amp;$info)</code></pre>

Usages:

[Login::initSession](https://github.com/piwik/piwik/blob/master/plugins/Login/Login.php#L102)


#### Login.initSession
_Defined in [Piwik/Plugins/UsersManager/Controller](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/Controller.php) in line [340](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/Controller.php#L340)_

This event is triggered to initialize a user session. You can use this event to authenticate user against
third party systems.

Example:
```
public function initSession($info)
{
    $login = $info['login'];
    $md5Password = $info['md5Password'];
    $rememberMe = $info['rememberMe'];
}
```

Callback Signature:
<pre><code>function($info)</code></pre>

Usages:

[Login::initSession](https://github.com/piwik/piwik/blob/master/plugins/Login/Login.php#L102)

## Menu

- [Menu.Admin.addItems](#menuadminadditems)
- [Menu.Reporting.addItems](#menureportingadditems)
- [Menu.Top.addItems](#menutopadditems)

#### Menu.Admin.addItems
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


#### Menu.Reporting.addItems
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

[Actions::addMenus](https://github.com/piwik/piwik/blob/master/plugins/Actions/Actions.php#L569), [CustomVariables::addMenus](https://github.com/piwik/piwik/blob/master/plugins/CustomVariables/CustomVariables.php#L55), [Dashboard::addMenus](https://github.com/piwik/piwik/blob/master/plugins/Dashboard/Dashboard.php#L201), [DevicesDetection::addMenu](https://github.com/piwik/piwik/blob/master/plugins/DevicesDetection/DevicesDetection.php#L292), [ExampleUI::addMenus](https://github.com/piwik/piwik/blob/master/plugins/ExampleUI/ExampleUI.php#L30), [Goals::addMenus](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L462), [Live::addMenu](https://github.com/piwik/piwik/blob/master/plugins/Live/Live.php#L56), [Provider::addMenu](https://github.com/piwik/piwik/blob/master/plugins/Provider/Provider.php#L101), [Referrers::addMenus](https://github.com/piwik/piwik/blob/master/plugins/Referrers/Referrers.php#L237), [UserCountry::addMenu](https://github.com/piwik/piwik/blob/master/plugins/UserCountry/UserCountry.php#L190), [UserCountryMap::addMenu](https://github.com/piwik/piwik/blob/master/plugins/UserCountryMap/UserCountryMap.php#L62), [UserSettings::addMenu](https://github.com/piwik/piwik/blob/master/plugins/UserSettings/UserSettings.php#L467), [VisitFrequency::addMenu](https://github.com/piwik/piwik/blob/master/plugins/VisitFrequency/VisitFrequency.php#L67), [VisitTime::addMenu](https://github.com/piwik/piwik/blob/master/plugins/VisitTime/VisitTime.php#L94), [VisitorInterest::addMenu](https://github.com/piwik/piwik/blob/master/plugins/VisitorInterest/VisitorInterest.php#L116), [VisitsSummary::addMenu](https://github.com/piwik/piwik/blob/master/plugins/VisitsSummary/VisitsSummary.php#L70)


#### Menu.Top.addItems
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

[Plugin::addTopMenu](https://github.com/piwik/piwik/blob/master/plugins/API/API.php#L652), [Dashboard::addTopMenu](https://github.com/piwik/piwik/blob/master/plugins/Dashboard/Dashboard.php#L219), [Feedback::addTopMenu](https://github.com/piwik/piwik/blob/master/plugins/Feedback/Feedback.php#L36), [LanguagesManager::showLanguagesSelector](https://github.com/piwik/piwik/blob/master/plugins/LanguagesManager/LanguagesManager.php#L56), [MultiSites::addTopMenu](https://github.com/piwik/piwik/blob/master/plugins/MultiSites/MultiSites.php#L78), [ScheduledReports::addTopMenu](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/ScheduledReports.php#L472), [Widgetize::addTopMenu](https://github.com/piwik/piwik/blob/master/plugins/Widgetize/Widgetize.php#L36)

## Provider

- [Provider.getCleanHostname](#providergetcleanhostname)

#### Provider.getCleanHostname
_Defined in [Piwik/Plugins/Provider/Provider](https://github.com/piwik/piwik/blob/master/plugins/Provider/Provider.php) in line [184](https://github.com/piwik/piwik/blob/master/plugins/Provider/Provider.php#L184)_

This event is triggered to get a clean hostname depending on a given hostname. For instance it is used
to return `site.co.jp` in `fvae.VARG.ceaga.site.co.jp`. Use this event to customize the way a hostname
is cleaned.

Example:
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

#### Reporting.getDatabaseConfig
_Defined in [Piwik/Db](https://github.com/piwik/piwik/blob/master/core/Db.php) in line [93](https://github.com/piwik/piwik/blob/master/core/Db.php#L93)_

Triggered before a connection to the database is established. This event can be used to dynamically change the settings used to connect to the
database.

Callback Signature:
<pre><code>function(&amp;$dbInfos)</code></pre>

## Request

- [Request.dispatch](#requestdispatch)
- [Request.dispatch.end](#requestdispatchend)
- [Request.dispatchCoreAndPluginUpdatesScreen](#requestdispatchcoreandpluginupdatesscreen)
- [Request.initAuthenticationObject](#requestinitauthenticationobject)
- [Request.initAuthenticationObject](#requestinitauthenticationobject)

#### Request.dispatch
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [100](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L100)_

Triggered directly before controller actions are dispatched. This event can be used to modify the parameters passed to one or more controller actions
and can be used to change the plugin and action that is being dispatched to.

Callback Signature:
<pre><code>function(&amp;$module, &amp;$action, &amp;$parameters)</code></pre>


#### Request.dispatch.end
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [138](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L138)_

Triggered after a controller action is successfully called. This event can be used to modify controller action output (if there was any) before
the output is returned.

Callback Signature:
<pre><code>function(&amp;$result, $parameters)</code></pre>


#### Request.dispatchCoreAndPluginUpdatesScreen
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [324](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L324)_

Triggered just after the platform is initialized and plugins are loaded. This event can be used to do early initialization. Note: At this point the user
is not authenticated yet.

Usages:

[CoreUpdater::dispatch](https://github.com/piwik/piwik/blob/master/plugins/CoreUpdater/CoreUpdater.php#L56)


#### Request.initAuthenticationObject
_Defined in [Piwik/Plugins/Overlay/API](https://github.com/piwik/piwik/blob/master/plugins/Overlay/API.php) in line [109](https://github.com/piwik/piwik/blob/master/plugins/Overlay/API.php#L109)_

This event is triggered shortly before the user is authenticated. Use it to create your own
authentication object instead of the Piwik authentication. Make sure to implement the `Piwik\Auth`
interface in case you want to define your own authentication.

Callback Signature:
<pre><code>function($allowCookieAuthentication = true)</code></pre>

Usages:

[Login::initAuthenticationObject](https://github.com/piwik/piwik/blob/master/plugins/Login/Login.php#L69)


#### Request.initAuthenticationObject
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [338](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L338)_

Triggered before the user is authenticated. You can use it to create your own
authentication object which implements the [Piwik\Auth](#) interface and overrides
the default authentication logic.

Usages:

[Login::initAuthenticationObject](https://github.com/piwik/piwik/blob/master/plugins/Login/Login.php#L69)

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

#### ScheduledReports.allowMultipleReports
_Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php) in line [756](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php#L756)_

This event is triggered when - generating the scheduled report creation/modification form - validating the creation or the modification of a scheduled report Use it to specify whether your scheduled reports can contain more than one kind of Piwik report.

Callback Signature:
<pre><code>function(&amp;$allowMultipleReports, $notificationInfo = function(self::REPORT_TYPE_INFO_KEY =&gt; $reportType))</code></pre>

Usages:

[MobileMessaging::allowMultipleReports](https://github.com/piwik/piwik/blob/master/plugins/MobileMessaging/MobileMessaging.php#L181), [ScheduledReports::allowMultipleReports](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/ScheduledReports.php#L258)


#### ScheduledReports.getRendererInstance
_Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php) in line [418](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php#L418)_

Use this event to provide the [Report Renderer](https://github.com/piwik/piwik/blob/master/core/ReportRenderer.php) to use when generating the scheduled report content.

Callback Signature:
<pre><code>function(&amp;$reportRenderer, $notificationInfo)</code></pre>

Usages:

[MobileMessaging::getRendererInstance](https://github.com/piwik/piwik/blob/master/plugins/MobileMessaging/MobileMessaging.php#L168), [ScheduledReports::getRendererInstance](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/ScheduledReports.php#L244)


#### ScheduledReports.getReportFormats
_Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php) in line [801](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php#L801)_

This event is triggered when - generating the scheduled report creation/modification form - validating the creation or the modification of a scheduled report Use it to specify which report format(s) are supported (HTML, PDF, SMS, ..).

Callback Signature:
<pre><code>function(&amp;$reportFormats, $notificationInfo = function(self::REPORT_TYPE_INFO_KEY =&gt; $reportType))</code></pre>

Usages:

[MobileMessaging::getReportFormats](https://github.com/piwik/piwik/blob/master/plugins/MobileMessaging/MobileMessaging.php#L154), [ScheduledReports::getReportFormats](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/ScheduledReports.php#L189)


#### ScheduledReports.getReportMetadata
_Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php) in line [734](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php#L734)_

This event is triggered when - generating the scheduled report creation/modification form - validating the creation or the modification of a scheduled report Use it to specify the list of supported Piwik reports (Referers, Country, ..).

Callback Signature:
<pre><code>function(&amp;$availableReportMetadata, $notificationInfo)</code></pre>

Usages:

[MobileMessaging::getReportMetadata](https://github.com/piwik/piwik/blob/master/plugins/MobileMessaging/MobileMessaging.php#L129), [ScheduledReports::getReportMetadata](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/ScheduledReports.php#L162)


#### ScheduledReports.getReportParameters
_Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php) in line [593](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php#L593)_

This event is triggered when - generating the scheduled report creation/modification form - validating the creation or the modification of a scheduled report If needed, use it to specify a list of custom parameters for the scheduled reports.

Callback Signature:
<pre><code>function(&amp;$availableParameters, $notificationInfo)</code></pre>

Usages:

[MobileMessaging::getReportParameters](https://github.com/piwik/piwik/blob/master/plugins/MobileMessaging/MobileMessaging.php#L161), [ScheduledReports::getReportParameters](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/ScheduledReports.php#L196)


#### ScheduledReports.getReportRecipients
_Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php) in line [831](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php#L831)_

This event is triggered when generating the scheduled report modification form. Use it to specify the list of recipients.

Callback Signature:
<pre><code>function(&amp;$recipients, $notificationInfo)</code></pre>

Usages:

[MobileMessaging::getReportRecipients](https://github.com/piwik/piwik/blob/master/plugins/MobileMessaging/MobileMessaging.php#L188), [ScheduledReports::getReportRecipients](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/ScheduledReports.php#L388)


#### ScheduledReports.getReportTypes
_Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php) in line [782](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php#L782)_

This event is triggered when - generating the scheduled report creation/modification form - validating the creation or the modification of a scheduled report Use it to add a new type of report (e-mail, mobile, FTP, ..).

Callback Signature:
<pre><code>function(&amp;$reportTypes)</code></pre>

Usages:

[MobileMessaging::getReportTypes](https://github.com/piwik/piwik/blob/master/plugins/MobileMessaging/MobileMessaging.php#L149), [ScheduledReports::getReportTypes](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/ScheduledReports.php#L184)


#### ScheduledReports.processReports
_Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php) in line [407](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php#L407)_

This event is triggered when generating the content of scheduled reports. If needed, use it to alter the content of reports.

Callback Signature:
<pre><code>function(&amp;$processedReports, $notificationInfo)</code></pre>

Usages:

[ScheduledReports::processReports](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/ScheduledReports.php#L203)


#### ScheduledReports.sendReport
_Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php) in line [534](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php#L534)_

This event is triggered when sending scheduled reports. Use it to provide the code that will send the report.

Callback Signature:
<pre><code>function($notificationInfo = function(self::REPORT_TYPE_INFO_KEY =&gt; $report[&#039;type&#039;], self::REPORT_KEY =&gt; $report, self::REPORT_CONTENT_KEY =&gt; $contents, self::FILENAME_KEY =&gt; $filename, self::PRETTY_DATE_KEY =&gt; $prettyDate, self::REPORT_SUBJECT_KEY =&gt; $reportSubject, self::REPORT_TITLE_KEY =&gt; $reportTitle, self::ADDITIONAL_FILES_KEY =&gt; $additionalFiles))</code></pre>

Usages:

[MobileMessaging::sendReport](https://github.com/piwik/piwik/blob/master/plugins/MobileMessaging/MobileMessaging.php#L196), [ScheduledReports::sendReport](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/ScheduledReports.php#L265)


#### ScheduledReports.validateReportParameters
_Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php) in line [617](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php#L617)_

This event is triggered when - validating the creation or the modification of a scheduled report - generating the content of scheduled reports with custom parameters provided as URL parameters Use it to validate custom parameters defined with [ScheduledReports.getReportParameters](#ScheduledReports.getReportParameters).

Callback Signature:
<pre><code>function(&amp;$parameters, $notificationInfo)</code></pre>

Usages:

[MobileMessaging::validateReportParameters](https://github.com/piwik/piwik/blob/master/plugins/MobileMessaging/MobileMessaging.php#L110), [ScheduledReports::validateReportParameters](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/ScheduledReports.php#L120)

## SegmentEditor

- [SegmentEditor.deactivate](#segmenteditordeactivate)

#### SegmentEditor.deactivate
_Defined in [Piwik/Plugins/SegmentEditor/API](https://github.com/piwik/piwik/blob/master/plugins/SegmentEditor/API.php) in line [304](https://github.com/piwik/piwik/blob/master/plugins/SegmentEditor/API.php#L304)_

This event is triggered when a segment is deleted or made invisible. It allows plugins to throw an exception
or to propagate the action.

Callback Signature:
<pre><code>function(&amp;$idSegment)</code></pre>

Usages:

[ScheduledReports::segmentDeactivation](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/ScheduledReports.php#L454)

## Segments

- [Segments.getKnownSegmentsToArchiveAllSites](#segmentsgetknownsegmentstoarchiveallsites)
- [Segments.getKnownSegmentsToArchiveForSite](#segmentsgetknownsegmentstoarchiveforsite)

#### Segments.getKnownSegmentsToArchiveAllSites
_Defined in [Piwik/SettingsPiwik](https://github.com/piwik/piwik/blob/master/core/SettingsPiwik.php) in line [86](https://github.com/piwik/piwik/blob/master/core/SettingsPiwik.php#L86)_

Triggered during the cron archiving process to collect segments that should be pre-processed for all websites. The archiving process will be launched
for each of these segments when archiving data for each site.

This event can be used to add segments to be pre-processed. This can be provide
enhanced performance if your plugin depends on data from a specific segment.

Note: If you just want to add a segment that is managed by the user, you should use the
SegmentEditor API.

Callback Signature:
<pre><code>function(&amp;$segmentsToProcess)</code></pre>

Usages:

[SegmentEditor::getKnownSegmentsToArchiveAllSites](https://github.com/piwik/piwik/blob/master/plugins/SegmentEditor/SegmentEditor.php#L56)


#### Segments.getKnownSegmentsToArchiveForSite
_Defined in [Piwik/SettingsPiwik](https://github.com/piwik/piwik/blob/master/core/SettingsPiwik.php) in line [127](https://github.com/piwik/piwik/blob/master/core/SettingsPiwik.php#L127)_

Triggered during the cron archiving process to collect segments that should be pre-processed for one specific site. The archiving process will be launched
for each of these segments when archiving data for that one site.

This event can be used to add segments to be pre-processed. This can be provide
enhanced performance if your plugin depends on data from a specific segment.

Note: If you just want to add a segment that is managed by the user, you should use the
SegmentEditor API.

Callback Signature:
<pre><code>function(&amp;$segments, $idSite)</code></pre>

Usages:

[SegmentEditor::getKnownSegmentsToArchiveForSite](https://github.com/piwik/piwik/blob/master/plugins/SegmentEditor/SegmentEditor.php#L64)

## Site

- [Site.getSiteAttributes](#sitegetsiteattributes)

#### Site.getSiteAttributes
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

Usages:

[Goals::fetchGoalsFromDb](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L432), [SitesManager::recordWebsiteDataInCache](https://github.com/piwik/piwik/blob/master/plugins/SitesManager/SitesManager.php#L73), [UsersManager::recordAdminUsersInCache](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/UsersManager.php#L53)

## SitesManager

- [SitesManager.deleteSite.end](#sitesmanagerdeletesiteend)

#### SitesManager.deleteSite.end
_Defined in [Piwik/Plugins/SitesManager/API](https://github.com/piwik/piwik/blob/master/plugins/SitesManager/API.php) in line [591](https://github.com/piwik/piwik/blob/master/plugins/SitesManager/API.php#L591)_

This event is triggered after a site has been deleted. Plugins can use this event to remove site specific
values or settings. For instance removing all goals that belong to a specific website. If you store any data
related to a website you may want to clean up that information.

Callback Signature:
<pre><code>function($idSite)</code></pre>

Usages:

[Goals::deleteSiteGoals](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L118), [ScheduledReports::deleteSiteReport](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/ScheduledReports.php#L105), [UsersManager::deleteSite](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/UsersManager.php#L68)

## TaskScheduler

- [TaskScheduler.getScheduledTasks](#taskschedulergetscheduledtasks)

#### TaskScheduler.getScheduledTasks
_Defined in [Piwik/TaskScheduler](https://github.com/piwik/piwik/blob/master/core/TaskScheduler.php) in line [81](https://github.com/piwik/piwik/blob/master/core/TaskScheduler.php#L81)_

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

Usages:

[CoreAdminHome::getScheduledTasks](https://github.com/piwik/piwik/blob/master/plugins/CoreAdminHome/CoreAdminHome.php#L49), [CorePluginsAdmin::getScheduledTasks](https://github.com/piwik/piwik/blob/master/plugins/CorePluginsAdmin/CorePluginsAdmin.php#L42), [DBStats::getScheduledTasks](https://github.com/piwik/piwik/blob/master/plugins/DBStats/DBStats.php#L60), [PrivacyManager::getScheduledTasks](https://github.com/piwik/piwik/blob/master/plugins/PrivacyManager/PrivacyManager.php#L138), [ScheduledReports::getScheduledTasks](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/ScheduledReports.php#L427), [UserCountry::getScheduledTasks](https://github.com/piwik/piwik/blob/master/plugins/UserCountry/UserCountry.php#L68)

## Tracker

- [Tracker.detectReferrerSearchEngine](#trackerdetectreferrersearchengine)
- [Tracker.getDatabaseConfig](#trackergetdatabaseconfig)
- [Tracker.isExcludedVisit](#trackerisexcludedvisit)
- [Tracker.knownVisitorInformation](#trackerknownvisitorinformation)
- [Tracker.knownVisitorUpdate](#trackerknownvisitorupdate)
- [Tracker.makeNewVisitObject](#trackermakenewvisitobject)
- [Tracker.newVisitorInformation](#trackernewvisitorinformation)
- [Tracker.recordAction](#trackerrecordaction)
- [Tracker.recordEcommerceGoal](#trackerrecordecommercegoal)
- [Tracker.recordStandardGoals](#trackerrecordstandardgoals)
- [Tracker.Request.getIdSite](#trackerrequestgetidsite)
- [Tracker.setTrackerCacheGeneral](#trackersettrackercachegeneral)
- [Tracker.setVisitorIp](#trackersetvisitorip)

#### Tracker.detectReferrerSearchEngine
_Defined in [Piwik/Tracker/Referrer](https://github.com/piwik/piwik/blob/master/core/Tracker/Referrer.php) in line [148](https://github.com/piwik/piwik/blob/master/core/Tracker/Referrer.php#L148)_

Triggered when detecting the search engine of a referrer URL. Plugins can use this event to provide custom search engine detection
logic.

Callback Signature:
<pre><code>function(&amp;$searchEngineInformation, $this-&gt;referrerUrl)</code></pre>


#### Tracker.getDatabaseConfig
_Defined in [Piwik/Tracker](https://github.com/piwik/piwik/blob/master/core/Tracker.php) in line [576](https://github.com/piwik/piwik/blob/master/core/Tracker.php#L576)_

Triggered before a connection to the database is established in the Tracker. This event can be used to dynamically change the settings used to connect to the
database.

Callback Signature:
<pre><code>function(&amp;$configDb)</code></pre>


#### Tracker.isExcludedVisit
_Defined in [Piwik/Tracker/VisitExcluded](https://github.com/piwik/piwik/blob/master/core/Tracker/VisitExcluded.php) in line [84](https://github.com/piwik/piwik/blob/master/core/Tracker/VisitExcluded.php#L84)_

Triggered on every pageview of a visitor. This event can be used to tell the Tracker not to record this particular pageview.

Callback Signature:
<pre><code>function(&amp;$excluded)</code></pre>

Usages:

[DoNotTrack::checkHeader](https://github.com/piwik/piwik/blob/master/plugins/DoNotTrack/DoNotTrack.php#L36)


#### Tracker.knownVisitorInformation
_Defined in [Piwik/Tracker/Visit](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php) in line [370](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php#L370)_

Triggered after a visit from a known visitor is successfully logged. TODO: Describe what information is available in $visit

Callback Signature:
<pre><code>function(&amp;$this-&gt;visitorInfo)</code></pre>


#### Tracker.knownVisitorUpdate
_Defined in [Piwik/Tracker/Visit](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php) in line [322](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php#L322)_

Triggered before logging the visit from a known visitor. Event subscribers may modify the visitor information before it is saved.

TODO: describe exactly what information can be added to $visitInfo

Callback Signature:
<pre><code>function(&amp;$valuesToUpdate)</code></pre>


#### Tracker.makeNewVisitObject
_Defined in [Piwik/Tracker](https://github.com/piwik/piwik/blob/master/core/Tracker.php) in line [633](https://github.com/piwik/piwik/blob/master/core/Tracker.php#L633)_

Triggered before a new `Piwik\Tracker\Visit` object is created. Subscribers to this
event can force the use of a custom visit object that extends from
[Piwik\Tracker\VisitInterface](#).

Callback Signature:
<pre><code>function(&amp;$visit)</code></pre>


#### Tracker.newVisitorInformation
_Defined in [Piwik/Tracker/Visit](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php) in line [504](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php#L504)_

Triggered before a visit from a new visitor is logged. This event can be used to determine and set new visit information before the visit is
logged. The UserCountry plugin, for example, uses this event to inject location information
into the visit log table.

TODO: list exactly what information is available in $visitInfo

Callback Signature:
<pre><code>function(&amp;$this-&gt;visitorInfo, $extraInfo)</code></pre>

Usages:

[DevicesDetection::parseMobileVisitData](https://github.com/piwik/piwik/blob/master/plugins/DevicesDetection/DevicesDetection.php#L253), [Provider::logProviderInfo](https://github.com/piwik/piwik/blob/master/plugins/Provider/Provider.php#L115), [UserCountry::getVisitorLocation](https://github.com/piwik/piwik/blob/master/plugins/UserCountry/UserCountry.php#L84)


#### Tracker.recordAction
_Defined in [Piwik/Tracker/Action](https://github.com/piwik/piwik/blob/master/core/Tracker/Action.php) in line [662](https://github.com/piwik/piwik/blob/master/core/Tracker/Action.php#L662)_

Triggered after successfully logging an action for a visit.

Callback Signature:
<pre><code>function($trackerAction = $this, $info)</code></pre>


#### Tracker.recordEcommerceGoal
_Defined in [Piwik/Tracker/GoalManager](https://github.com/piwik/piwik/blob/master/core/Tracker/GoalManager.php) in line [417](https://github.com/piwik/piwik/blob/master/core/Tracker/GoalManager.php#L417)_

Triggered after successfully recording an ecommerce goal conversion. TODO: figure out what exactly is in $goal and $items

Callback Signature:
<pre><code>function($goal, $items)</code></pre>


#### Tracker.recordStandardGoals
_Defined in [Piwik/Tracker/GoalManager](https://github.com/piwik/piwik/blob/master/core/Tracker/GoalManager.php) in line [786](https://github.com/piwik/piwik/blob/master/core/Tracker/GoalManager.php#L786)_

Triggered after successfully recording a standard goal (meaning non-ecommerce related) conversion. TODO: list what information is in $newGoal

Callback Signature:
<pre><code>function($newGoal)</code></pre>


#### Tracker.Request.getIdSite
_Defined in [Piwik/Tracker/Request](https://github.com/piwik/piwik/blob/master/core/Tracker/Request.php) in line [308](https://github.com/piwik/piwik/blob/master/core/Tracker/Request.php#L308)_

Triggered when obtaining the ID of the site that is currently being tracked. This event can be used to modify the site ID from what is specified by the **idsite**
query parameter.

Callback Signature:
<pre><code>function(&amp;$idSite, $this-&gt;params)</code></pre>


#### Tracker.setTrackerCacheGeneral
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

Usages:

[UserCountry::setTrackerCacheGeneral](https://github.com/piwik/piwik/blob/master/plugins/UserCountry/UserCountry.php#L63)


#### Tracker.setVisitorIp
_Defined in [Piwik/Tracker/Visit](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php) in line [103](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php#L103)_

Triggered after the IP address of the visitor is determined. Event subscribers can modify the IP address before it is persisted, for example,
to anonymize it.

Callback Signature:
<pre><code>function(&amp;$this-&gt;visitorInfo[&#039;location_ip&#039;])</code></pre>

Usages:

[AnonymizeIP::setVisitorIpAddress](https://github.com/piwik/piwik/blob/master/plugins/AnonymizeIP/AnonymizeIP.php#L83)

## Translate

- [Translate.getClientSideTranslationKeys](#translategetclientsidetranslationkeys)

#### Translate.getClientSideTranslationKeys
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

Usages:

[CoreHome::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/master/plugins/CoreHome/CoreHome.php#L96), [CorePluginsAdmin::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/master/plugins/CorePluginsAdmin/CorePluginsAdmin.php#L109), [CoreVisualizations::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/master/plugins/CoreVisualizations/CoreVisualizations.php#L64), [Dashboard::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/master/plugins/Dashboard/Dashboard.php#L279), [Feedback::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/master/plugins/Feedback/Feedback.php#L58), [Goals::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L663), [Live::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/master/plugins/Live/Live.php#L69), [Overlay::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/master/plugins/Overlay/Overlay.php#L46), [SitesManager::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/master/plugins/SitesManager/SitesManager.php#L212), [Transitions::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/master/plugins/Transitions/Transitions.php#L41), [UserCountry::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/master/plugins/UserCountry/UserCountry.php#L495), [UsersManager::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/UsersManager.php#L139), [Widgetize::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/master/plugins/Widgetize/Widgetize.php#L63)

## Updater

- [Updater.checkForUpdates](#updatercheckforupdates)

#### Updater.checkForUpdates
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [365](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L365)_

Triggered after the platform is initialized and after the user has been authenticated, but before the platform dispatched the request. Piwik uses this event to check for updates to Piwik.

Usages:

[CoreUpdater::updateCheck](https://github.com/piwik/piwik/blob/master/plugins/CoreUpdater/CoreUpdater.php#L83)

## User

- [User.getLanguage](#usergetlanguage)
- [User.isNotAuthorized](#userisnotauthorized)

#### User.getLanguage
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

Usages:

[LanguagesManager::getLanguageToLoad](https://github.com/piwik/piwik/blob/master/plugins/LanguagesManager/LanguagesManager.php#L88)


#### User.isNotAuthorized
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [152](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L152)_

Triggered when a user with insufficient access permissions tries to view some resource. This event can be used to customize the error that occurs when a user is denied access
(for example, displaying an error message, redirecting to a page other than login, etc.).

Callback Signature:
<pre><code>function($exception)</code></pre>

Usages:

[Login::noAccess](https://github.com/piwik/piwik/blob/master/plugins/Login/Login.php#L47)

## UsersManager

- [UsersManager.addUser.end](#usersmanageradduserend)
- [UsersManager.deleteUser](#usersmanagerdeleteuser)
- [UsersManager.updateUser.end](#usersmanagerupdateuserend)

#### UsersManager.addUser.end
_Defined in [Piwik/Plugins/UsersManager/API](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/API.php) in line [405](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/API.php#L405)_

This event is triggered after a new user is created and saved in the database. `$userLogin` contains all
relevant user information like login name, alias, email and transformed password.

Callback Signature:
<pre><code>function($userLogin)</code></pre>


#### UsersManager.deleteUser
_Defined in [Piwik/Plugins/UsersManager/API](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/API.php) in line [656](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/API.php#L656)_

This event is triggered after a user has been deleted. Plugins can use this event to remove user specific
values or settings. For instance removing all created dashboards that belong to a specific user.
If you store any data related to a user, you may want to clean up that information.

Callback Signature:
<pre><code>function($userLogin)</code></pre>

Usages:

[CoreAdminHome::cleanupUser](https://github.com/piwik/piwik/blob/master/plugins/CoreAdminHome/CoreAdminHome.php#L44), [Dashboard::deleteDashboardLayout](https://github.com/piwik/piwik/blob/master/plugins/Dashboard/Dashboard.php#L248), [LanguagesManager::deleteUserLanguage](https://github.com/piwik/piwik/blob/master/plugins/LanguagesManager/LanguagesManager.php#L98), [ScheduledReports::deleteUserReport](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/ScheduledReports.php#L523)


#### UsersManager.updateUser.end
_Defined in [Piwik/Plugins/UsersManager/API](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/API.php) in line [466](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/API.php#L466)_

This event is triggered after an existing user has been updated. `$userLogin` contains the updated user
information like login name, alias and email.

Callback Signature:
<pre><code>function($userLogin)</code></pre>

## ViewDataTable

- [ViewDataTable.addViewDataTable](#viewdatatableaddviewdatatable)
- [ViewDataTable.configure](#viewdatatableconfigure)
- [ViewDataTable.getDefaultType](#viewdatatablegetdefaulttype)

#### ViewDataTable.addViewDataTable
_Defined in [Piwik/ViewDataTable/Manager](https://github.com/piwik/piwik/blob/master/core/ViewDataTable/Manager.php) in line [86](https://github.com/piwik/piwik/blob/master/core/ViewDataTable/Manager.php#L86)_

Triggered when gathering all available DataTable visualizations. Plugins that want to expose new DataTable visualizations should subscribe to
this event and add visualization class names to the incoming array.

**Example**

    public function addViewDataTable(&$visualizations)
    {
        $visualizations[] = 'Piwik\\Plugins\\MyPlugin\\MyVisualization';
    }

Callback Signature:
<pre><code>function(&amp;$visualizations)</code></pre>

Usages:

[CoreVisualizations::getAvailableDataTableVisualizations](https://github.com/piwik/piwik/blob/master/plugins/CoreVisualizations/CoreVisualizations.php#L38), [ExampleVisualization::getAvailableVisualizations](https://github.com/piwik/piwik/blob/master/plugins/ExampleVisualization/ExampleVisualization.php#L30), [Goals::getAvailableDataTableVisualizations](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L110)


#### ViewDataTable.configure
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

Usages:

[Actions::configureViewDataTable](https://github.com/piwik/piwik/blob/master/plugins/Actions/Actions.php#L648), [CustomVariables::configureViewDataTable](https://github.com/piwik/piwik/blob/master/plugins/CustomVariables/CustomVariables.php#L156), [DBStats::configureViewDataTable](https://github.com/piwik/piwik/blob/master/plugins/DBStats/DBStats.php#L110), [DevicesDetection::configureViewDataTable](https://github.com/piwik/piwik/blob/master/plugins/DevicesDetection/DevicesDetection.php#L297), [Goals::configureViewDataTable](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L528), [Provider::configureViewDataTable](https://github.com/piwik/piwik/blob/master/plugins/Provider/Provider.php#L239), [Referrers::configureViewDataTable](https://github.com/piwik/piwik/blob/master/plugins/Referrers/Referrers.php#L309), [UserCountry::configureViewDataTable](https://github.com/piwik/piwik/blob/master/plugins/UserCountry/UserCountry.php#L367), [UserSettings::configureViewDataTable](https://github.com/piwik/piwik/blob/master/plugins/UserSettings/UserSettings.php#L189), [VisitTime::configureViewDataTable](https://github.com/piwik/piwik/blob/master/plugins/VisitTime/VisitTime.php#L136), [VisitorInterest::configureViewDataTable](https://github.com/piwik/piwik/blob/master/plugins/VisitorInterest/VisitorInterest.php#L164)


#### ViewDataTable.getDefaultType
_Defined in [Piwik/ViewDataTable/Factory](https://github.com/piwik/piwik/blob/master/core/ViewDataTable/Factory.php) in line [156](https://github.com/piwik/piwik/blob/master/core/ViewDataTable/Factory.php#L156)_

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

Usages:

[DBStats::getDefaultTypeViewDataTable](https://github.com/piwik/piwik/blob/master/plugins/DBStats/DBStats.php#L97), [Live::getDefaultTypeViewDataTable](https://github.com/piwik/piwik/blob/master/plugins/Live/Live.php#L78), [Referrers::getDefaultTypeViewDataTable](https://github.com/piwik/piwik/blob/master/plugins/Referrers/Referrers.php#L303), [UserSettings::getDefaultTypeViewDataTable](https://github.com/piwik/piwik/blob/master/plugins/UserSettings/UserSettings.php#L184), [VisitTime::getDefaultTypeViewDataTable](https://github.com/piwik/piwik/blob/master/plugins/VisitTime/VisitTime.php#L129), [VisitorInterest::getDefaultTypeViewDataTable](https://github.com/piwik/piwik/blob/master/plugins/VisitorInterest/VisitorInterest.php#L158)

## WidgetsList

- [WidgetsList.addWidgets](#widgetslistaddwidgets)

#### WidgetsList.addWidgets
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

[Actions::addWidgets](https://github.com/piwik/piwik/blob/master/plugins/Actions/Actions.php#L546), [CoreHome::addWidgets](https://github.com/piwik/piwik/blob/master/plugins/CoreHome/CoreHome.php#L37), [CustomVariables::addWidgets](https://github.com/piwik/piwik/blob/master/plugins/CustomVariables/CustomVariables.php#L50), [DevicesDetection::addWidgets](https://github.com/piwik/piwik/blob/master/plugins/DevicesDetection/DevicesDetection.php#L170), [ExamplePlugin::addWidgets](https://github.com/piwik/piwik/blob/master/plugins/ExamplePlugin/ExamplePlugin.php#L52), [ExampleRssWidget::addWidgets](https://github.com/piwik/piwik/blob/master/plugins/ExampleRssWidget/ExampleRssWidget.php#L37), [Goals::addWidgets](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L438), [Live::addWidget](https://github.com/piwik/piwik/blob/master/plugins/Live/Live.php#L61), [Provider::addWidget](https://github.com/piwik/piwik/blob/master/plugins/Provider/Provider.php#L96), [Referrers::addWidgets](https://github.com/piwik/piwik/blob/master/plugins/Referrers/Referrers.php#L220), [SEO::addWidgets](https://github.com/piwik/piwik/blob/master/plugins/SEO/SEO.php#L43), [UserCountry::addWidgets](https://github.com/piwik/piwik/blob/master/plugins/UserCountry/UserCountry.php#L173), [UserSettings::addWidgets](https://github.com/piwik/piwik/blob/master/plugins/UserSettings/UserSettings.php#L454), [VisitFrequency::addWidgets](https://github.com/piwik/piwik/blob/master/plugins/VisitFrequency/VisitFrequency.php#L61), [VisitTime::addWidgets](https://github.com/piwik/piwik/blob/master/plugins/VisitTime/VisitTime.php#L87), [VisitorInterest::addWidgets](https://github.com/piwik/piwik/blob/master/plugins/VisitorInterest/VisitorInterest.php#L108), [VisitsSummary::addWidgets](https://github.com/piwik/piwik/blob/master/plugins/VisitsSummary/VisitsSummary.php#L63)

