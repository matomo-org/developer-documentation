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
- [Visualization](#visualization)
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
_Defined in [Piwik/API/Proxy](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php) in line [181](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php#L181)_

This event is similar to the `API.Request.dispatch` event. It distinguishes the possibility to subscribe
only to a specific API method instead of all API methods. You can use it for example to modify any input
parameters or to execute any other logic before the actual API method is called.

Callback Signature:
<pre><code>function(&amp;$finalParameters)</code></pre>


#### API.$pluginName.$methodName.end
_Defined in [Piwik/API/Proxy](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php) in line [210](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php#L210)_

This event is similar to the `API.Request.dispatch.end` event. It distinguishes the possibility to
subscribe only to the end of a specific API method instead of all API methods. You can use it for example
to modify the response. The passed parameters contains the returned value as well as some additional
meta information:

```
function (
    &$returnedValue,
    array('className'  => $className,
          'module'     => $pluginName,
          'action'     => $methodName,
          'parameters' => $finalParameters)
);
```

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

[Actions::getReportMetadata](https://github.com/piwik/piwik/blob/master/plugins/Actions/Actions.php#L213), [CustomVariables::getReportMetadata](https://github.com/piwik/piwik/blob/master/plugins/CustomVariables/CustomVariables.php#L62), [DevicesDetection::getReportMetadata](https://github.com/piwik/piwik/blob/master/plugins/DevicesDetection/DevicesDetection.php#L202), [MultiSites::getReportMetadata](https://github.com/piwik/piwik/blob/master/plugins/MultiSites/MultiSites.php#L43), [Provider::getReportMetadata](https://github.com/piwik/piwik/blob/master/plugins/Provider/Provider.php#L48), [Referrers::getReportMetadata](https://github.com/piwik/piwik/blob/master/plugins/Referrers/Referrers.php#L48), [UserCountry::getReportMetadata](https://github.com/piwik/piwik/blob/master/plugins/UserCountry/UserCountry.php#L258), [UserSettings::getReportMetadata](https://github.com/piwik/piwik/blob/master/plugins/UserSettings/UserSettings.php#L357), [VisitFrequency::getReportMetadata](https://github.com/piwik/piwik/blob/master/plugins/VisitFrequency/VisitFrequency.php#L36), [VisitTime::getReportMetadata](https://github.com/piwik/piwik/blob/master/plugins/VisitTime/VisitTime.php#L47), [VisitorInterest::getReportMetadata](https://github.com/piwik/piwik/blob/master/plugins/VisitorInterest/VisitorInterest.php#L43), [VisitsSummary::getReportMetadata](https://github.com/piwik/piwik/blob/master/plugins/VisitsSummary/VisitsSummary.php#L39)


#### API.getReportMetadata.end
_Defined in [Piwik/Plugins/API/ProcessedReport](https://github.com/piwik/piwik/blob/master/plugins/API/ProcessedReport.php) in line [115](https://github.com/piwik/piwik/blob/master/plugins/API/ProcessedReport.php#L115)_

This event is triggered after all available reports are collected. Plugins can add custom metrics to
other reports or remove reports from the list of all available reports.

Callback Signature:
<pre><code>function(&amp;$availableReports, $parameters)</code></pre>

Usages:

[Goals::getReportMetadata](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L123)


#### API.getSegmentsMetadata
_Defined in [Piwik/Plugins/API/API](https://github.com/piwik/piwik/blob/master/plugins/API/API.php) in line [90](https://github.com/piwik/piwik/blob/master/plugins/API/API.php#L90)_

This event is triggered to get all available segments. Your plugin can use this event to add one or
multiple new segments.

Callback Signature:
<pre><code>function(&amp;$segments, $idSites)</code></pre>

Usages:

[Actions::getSegmentsMetadata](https://github.com/piwik/piwik/blob/master/plugins/Actions/Actions.php#L82), [CustomVariables::getSegmentsMetadata](https://github.com/piwik/piwik/blob/master/plugins/CustomVariables/CustomVariables.php#L86), [DevicesDetection::getSegmentsMetadata](https://github.com/piwik/piwik/blob/master/plugins/DevicesDetection/DevicesDetection.php#L182), [Goals::getSegmentsMetadata](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L403), [Provider::getSegmentsMetadata](https://github.com/piwik/piwik/blob/master/plugins/Provider/Provider.php#L61), [Referrers::getSegmentsMetadata](https://github.com/piwik/piwik/blob/master/plugins/Referrers/Referrers.php#L175), [UserCountry::getSegmentsMetadata](https://github.com/piwik/piwik/blob/master/plugins/UserCountry/UserCountry.php#L205), [UserSettings::getSegmentsMetadata](https://github.com/piwik/piwik/blob/master/plugins/UserSettings/UserSettings.php#L397), [VisitTime::getSegmentsMetadata](https://github.com/piwik/piwik/blob/master/plugins/VisitTime/VisitTime.php#L104)


#### API.Request.authenticate
_Defined in [Piwik/API/Request](https://github.com/piwik/piwik/blob/master/core/API/Request.php) in line [190](https://github.com/piwik/piwik/blob/master/core/API/Request.php#L190)_

This event is triggered when authenticating the API call, only if the token_auth is found in the request. In this case the current session should authenticate using this token_auth.

Callback Signature:
<pre><code>function($token_auth)</code></pre>

Usages:

[Login::ApiRequestAuthenticate](https://github.com/piwik/piwik/blob/master/plugins/Login/Login.php#L59)


#### API.Request.dispatch
_Defined in [Piwik/API/Proxy](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php) in line [174](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php#L174)_

Generic hook that plugins can use to modify any input to any API method. You could also use this to build
an enhanced permission system. The event is triggered shortly before any API method is executed.

The `$fnalParameters` contains all paramteres that will be passed to the actual API method.

Callback Signature:
<pre><code>function(&amp;$finalParameters)</code></pre>


#### API.Request.dispatch.end
_Defined in [Piwik/API/Proxy](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php) in line [227](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php#L227)_

Generic hook that plugins can use to modify any output of any API method. The event is triggered after
any API method is executed but before the result is send to the user. The parameters originally
passed to the controller are available as well:

```
function (
    &$returnedValue,
    array('className'  => $className,
          'module'     => $pluginName,
          'action'     => $methodName,
          'parameters' => $finalParameters)
);
```

Callback Signature:
<pre><code>$endHookParams</code></pre>

## ArchiveProcessor

- [ArchiveProcessor.Day.compute](#archiveprocessordaycompute)
- [ArchiveProcessor.Period.compute](#archiveprocessorperiodcompute)

#### ArchiveProcessor.Day.compute
_Defined in [Piwik/ArchiveProcessor/Day](https://github.com/piwik/piwik/blob/master/core/ArchiveProcessor/Day.php) in line [124](https://github.com/piwik/piwik/blob/master/core/ArchiveProcessor/Day.php#L124)_

This event is triggered when the archiver wants to compute a new archive. Use this event to archive your
custom report data if needed.

Example:
```
public function archiveDay(ArchiveProcessor\Day $archiveProcessor)
{
    $archiving = new Archiver($archiveProcessor);
    if ($archiving->shouldArchive()) {
        $archiving->archiveDay();
    }
}
```

Callback Signature:
<pre><code>function(&amp;$this)</code></pre>

Usages:

[Actions::archiveDay](https://github.com/piwik/piwik/blob/master/plugins/Actions/Actions.php#L597), [CustomVariables::archiveDay](https://github.com/piwik/piwik/blob/master/plugins/CustomVariables/CustomVariables.php#L139), [DevicesDetection::archiveDay](https://github.com/piwik/piwik/blob/master/plugins/DevicesDetection/DevicesDetection.php#L275), [Goals::archiveDay](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L501), [Provider::archiveDay](https://github.com/piwik/piwik/blob/master/plugins/Provider/Provider.php#L222), [Referrers::archiveDay](https://github.com/piwik/piwik/blob/master/plugins/Referrers/Referrers.php#L278), [UserCountry::archiveDay](https://github.com/piwik/piwik/blob/master/plugins/UserCountry/UserCountry.php#L339), [UserSettings::archiveDay](https://github.com/piwik/piwik/blob/master/plugins/UserSettings/UserSettings.php#L440), [VisitTime::archiveDay](https://github.com/piwik/piwik/blob/master/plugins/VisitTime/VisitTime.php#L191), [VisitorInterest::archiveDay](https://github.com/piwik/piwik/blob/master/plugins/VisitorInterest/VisitorInterest.php#L132)


#### ArchiveProcessor.Period.compute
_Defined in [Piwik/ArchiveProcessor/Period](https://github.com/piwik/piwik/blob/master/core/ArchiveProcessor/Period.php) in line [205](https://github.com/piwik/piwik/blob/master/core/ArchiveProcessor/Period.php#L205)_

This event is triggered when the archiver wants to compute a new archive. Use this event to archive your
custom report data if needed.

Example:
```
public function archiveDay(ArchiveProcessor\Day $archiveProcessor)
{
    $archiving = new Archiver($archiveProcessor);
    if ($archiving->shouldArchive()) {
        $archiving->archivePeriod();
    }
}
```

Callback Signature:
<pre><code>function(&amp;$this)</code></pre>

Usages:

[Actions::archivePeriod](https://github.com/piwik/piwik/blob/master/plugins/Actions/Actions.php#L605), [CustomVariables::archivePeriod](https://github.com/piwik/piwik/blob/master/plugins/CustomVariables/CustomVariables.php#L147), [DevicesDetection::archivePeriod](https://github.com/piwik/piwik/blob/master/plugins/DevicesDetection/DevicesDetection.php#L283), [Goals::archivePeriod](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L513), [Provider::archivePeriod](https://github.com/piwik/piwik/blob/master/plugins/Provider/Provider.php#L230), [Referrers::archivePeriod](https://github.com/piwik/piwik/blob/master/plugins/Referrers/Referrers.php#L290), [UserCountry::archivePeriod](https://github.com/piwik/piwik/blob/master/plugins/UserCountry/UserCountry.php#L331), [UserSettings::archivePeriod](https://github.com/piwik/piwik/blob/master/plugins/UserSettings/UserSettings.php#L451), [VisitTime::archivePeriod](https://github.com/piwik/piwik/blob/master/plugins/VisitTime/VisitTime.php#L183), [VisitorInterest::archivePeriod](https://github.com/piwik/piwik/blob/master/plugins/VisitorInterest/VisitorInterest.php#L124)

## AssetManager

- [AssetManager.filterMergedJavaScripts](#assetmanagerfiltermergedjavascripts)
- [AssetManager.filterMergedStylesheets](#assetmanagerfiltermergedstylesheets)
- [AssetManager.getJavaScriptFiles](#assetmanagergetjavascriptfiles)
- [AssetManager.getStylesheetFiles](#assetmanagergetstylesheetfiles)

#### AssetManager.filterMergedJavaScripts
_Defined in [Piwik/AssetManager](https://github.com/piwik/piwik/blob/master/core/AssetManager.php) in line [385](https://github.com/piwik/piwik/blob/master/core/AssetManager.php#L385)_

This event is triggered after the JavaScript files are minified and merged to a single file but before the generated JS file is written to disk. It can be used to change the generated JavaScript to your needs,
like adding further scripts or storing the generated file somewhere else.

Callback Signature:
<pre><code>function(&amp;$mergedContent)</code></pre>


#### AssetManager.filterMergedStylesheets
_Defined in [Piwik/AssetManager](https://github.com/piwik/piwik/blob/master/core/AssetManager.php) in line [168](https://github.com/piwik/piwik/blob/master/core/AssetManager.php#L168)_

This event is triggered after the less stylesheets are compiled to CSS and after the CSS is minified and merged into one file but before the generated CSS is written to disk. It can be used to change the modify the
stylesheets to your needs, like replacing image paths or adding further custom stylesheets.

Callback Signature:
<pre><code>function(&amp;$mergedContent)</code></pre>


#### AssetManager.getJavaScriptFiles
_Defined in [Piwik/AssetManager](https://github.com/piwik/piwik/blob/master/core/AssetManager.php) in line [431](https://github.com/piwik/piwik/blob/master/core/AssetManager.php#L431)_

This event is triggered to gather a list of all JavaScript files. Use this event to add your own JavaScript
files. Note: In case you are in development you may enable the config setting `disable_merged_assets`.
Otherwise your custom JavaScript won't be loaded. It is best practice to place all your JavaScript files
within a `javascripts` folder.

Example:
```
public function getJsFiles(&jsFiles)
{
    jsFiles[] = "plugins/MyPlugin/javascripts/myfile.js";
    jsFiles[] = "plugins/MyPlugin/javascripts/anotherone.js";
}
```

Callback Signature:
<pre><code>function(&amp;$jsFiles)</code></pre>

Usages:

[Actions::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/Actions/Actions.php#L77), [Annotations::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/Annotations/Annotations.php#L43), [CoreAdminHome::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/CoreAdminHome/CoreAdminHome.php#L68), [CoreHome::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/CoreHome/CoreHome.php#L61), [CorePluginsAdmin::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/CorePluginsAdmin/CorePluginsAdmin.php#L90), [CoreVisualizations::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/CoreVisualizations/CoreVisualizations.php#L55), [Dashboard::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/Dashboard/Dashboard.php#L233), [Feedback::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/Feedback/Feedback.php#L53), [Goals::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L415), [LanguagesManager::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/LanguagesManager/LanguagesManager.php#L51), [Live::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/Live/Live.php#L47), [MobileMessaging::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/MobileMessaging/MobileMessaging.php#L100), [MultiSites::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/MultiSites/MultiSites.php#L85), [Overlay::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/Overlay/Overlay.php#L40), [PrivacyManager::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/PrivacyManager/PrivacyManager.php#L94), [ScheduledReports::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/ScheduledReports.php#L115), [SegmentEditor::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/SegmentEditor/SegmentEditor.php#L100), [SitesManager::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/SitesManager/SitesManager.php#L60), [Transitions::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/Transitions/Transitions.php#L36), [UserCountry::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/UserCountry/UserCountry.php#L78), [UserCountryMap::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/UserCountryMap/UserCountryMap.php#L67), [UsersManager::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/UsersManager.php#L78), [Widgetize::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/Widgetize/Widgetize.php#L44)


#### AssetManager.getStylesheetFiles
_Defined in [Piwik/AssetManager](https://github.com/piwik/piwik/blob/master/core/AssetManager.php) in line [303](https://github.com/piwik/piwik/blob/master/core/AssetManager.php#L303)_

This event is triggered to gather a list of all stylesheets (CSS and LESS). Use this event to add your own
stylesheets. Note: In case you are in development you may enable the config setting `disable_merged_assets`.
Otherwise your custom stylesheets won't be loaded. It is best practice to place stylesheets within a
`stylesheets` folder.

Example:
```
public function getStylesheetFiles(&$stylesheets)
{
    $stylesheets[] = "plugins/MyPlugin/stylesheets/myfile.less";
    $stylesheets[] = "plugins/MyPlugin/stylesheets/myfile.css";
}
```

Callback Signature:
<pre><code>function(&amp;$stylesheets)</code></pre>

Usages:

[Plugin::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/API/API.php#L674), [Actions::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/Actions/Actions.php#L72), [Annotations::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/Annotations/Annotations.php#L35), [CoreAdminHome::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/CoreAdminHome/CoreAdminHome.php#L60), [CoreHome::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/CoreHome/CoreHome.php#L43), [CorePluginsAdmin::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/CorePluginsAdmin/CorePluginsAdmin.php#L52), [CoreVisualizations::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/CoreVisualizations/CoreVisualizations.php#L49), [DBStats::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/DBStats/DBStats.php#L80), [Dashboard::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/Dashboard/Dashboard.php#L242), [ExampleRssWidget::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/ExampleRssWidget/ExampleRssWidget.php#L32), [Feedback::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/Feedback/Feedback.php#L48), [Goals::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L420), [Installation::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/Installation/Installation.php#L91), [LanguagesManager::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/LanguagesManager/LanguagesManager.php#L46), [Live::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/Live/Live.php#L41), [MobileMessaging::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/MobileMessaging/MobileMessaging.php#L105), [MultiSites::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/MultiSites/MultiSites.php#L90), [SegmentEditor::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/SegmentEditor/SegmentEditor.php#L105), [SitesManager::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/SitesManager/SitesManager.php#L51), [Transitions::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/Transitions/Transitions.php#L31), [UserCountry::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/UserCountry/UserCountry.php#L73), [UserCountryMap::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/UserCountryMap/UserCountryMap.php#L77), [UsersManager::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/UsersManager.php#L87), [Widgetize::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/Widgetize/Widgetize.php#L54)

## Config

- [Config.badConfigurationFile](#configbadconfigurationfile)
- [Config.NoConfigurationFile](#confignoconfigurationfile)

#### Config.badConfigurationFile
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [307](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L307)_

This event is triggered in case a config file is not in the correct format or in case required values are missing. The event can be used to start the installation process or to display a custom error
message.

Callback Signature:
<pre><code>function($exception)</code></pre>

Usages:

[Installation::dispatch](https://github.com/piwik/piwik/blob/master/plugins/Installation/Installation.php#L53)


#### Config.NoConfigurationFile
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [234](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L234)_

This event is triggered in case no configuration file is available. This usually means Piwik is not
installed yet. The event can be used to start the installation process or to display a custom error
message.

Callback Signature:
<pre><code>function($exception)</code></pre>

Usages:

[Installation::dispatch](https://github.com/piwik/piwik/blob/master/plugins/Installation/Installation.php#L53)

## Controller

- [Controller.$module.$action](#controllermoduleaction)
- [Controller.$module.$action.end](#controllermoduleactionend)

#### Controller.$module.$action
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [127](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L127)_

This event is similar to the `Request.dispatch` hook. It distinguishes the possibility to subscribe only to a
specific controller method instead of all controller methods. You can use it for example to modify any input
parameters or execute any other logic before the actual controller is called.

Callback Signature:
<pre><code>function($parameters)</code></pre>


#### Controller.$module.$action.end
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [137](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L137)_

This event is similar to the `Request.dispatch.end` hook. It distinguishes the possibility to subscribe
only to the end of a specific controller method instead of all controller methods. You can use it for
example to modify the response of a single controller method.

Callback Signature:
<pre><code>function(&amp;$result, $parameters)</code></pre>

## Goals

- [Goals.getReportsWithGoalMetrics](#goalsgetreportswithgoalmetrics)

#### Goals.getReportsWithGoalMetrics
_Defined in [Piwik/Plugins/Goals/Goals](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php) in line [363](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L363)_



Callback Signature:
<pre><code>function(&amp;$reportsWithGoals)</code></pre>

Usages:

[CustomVariables::getReportsWithGoalMetrics](https://github.com/piwik/piwik/blob/master/plugins/CustomVariables/CustomVariables.php#L127), [Goals::getActualReportsWithGoalMetrics](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L386), [Referrers::getReportsWithGoalMetrics](https://github.com/piwik/piwik/blob/master/plugins/Referrers/Referrers.php#L244), [UserCountry::getReportsWithGoalMetrics](https://github.com/piwik/piwik/blob/master/plugins/UserCountry/UserCountry.php#L307), [VisitTime::getReportsWithGoalMetrics](https://github.com/piwik/piwik/blob/master/plugins/VisitTime/VisitTime.php#L95)

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
_Defined in [Piwik/Log](https://github.com/piwik/piwik/blob/master/core/Log.php) in line [367](https://github.com/piwik/piwik/blob/master/core/Log.php#L367)_

This event is called when trying to log an object to a database table. Plugins can use
this event to convert objects to strings before they are logged.

The $message parameter is the object that is being logged. Event handlers should
check if the object is of a certain type and if it is, set $message to the
string that should be logged.

Callback Signature:
<pre><code>function(&amp;$message, $level, $tag, $datetime, $logger)</code></pre>


#### Log.formatFileMessage
_Defined in [Piwik/Log](https://github.com/piwik/piwik/blob/master/core/Log.php) in line [298](https://github.com/piwik/piwik/blob/master/core/Log.php#L298)_

This event is called when trying to log an object to a file. Plugins can use
this event to convert objects to strings before they are logged.

The $message parameter is the object that is being logged. Event handlers should
check if the object is of a certain type and if it is, set $message to the
string that should be logged.

Callback Signature:
<pre><code>function(&amp;$message, $level, $tag, $datetime, $logger)</code></pre>


#### Log.formatScreenMessage
_Defined in [Piwik/Log](https://github.com/piwik/piwik/blob/master/core/Log.php) in line [342](https://github.com/piwik/piwik/blob/master/core/Log.php#L342)_

This event is called when trying to log an object to the screen. Plugins can use
this event to convert objects to strings before they are logged.

The $message parameter is the object that is being logged. Event handlers should
check if the object is of a certain type and if it is, set $message to the
string that should be logged.

The result of this callback can be HTML so no sanitization is done on the result.
This means YOU MUST SANITIZE THE MESSAGE YOURSELF if you use this event.

Callback Signature:
<pre><code>function(&amp;$message, $level, $tag, $datetime, $logger)</code></pre>


#### Log.getAvailableWriters
_Defined in [Piwik/Log](https://github.com/piwik/piwik/blob/master/core/Log.php) in line [275](https://github.com/piwik/piwik/blob/master/core/Log.php#L275)_

This event is called when the Log instance is created. Plugins can use this event to
make new logging writers available.

A logging writer is a callback that takes the following arguments:
  int $level, string $tag, string $datetime, string $message

$level is the log level to use, $tag is the log tag used, $datetime is the date time
of the logging call and $message is the formatted log message.

Logging writers must be associated by name in the array passed to event handlers.

Example handler:
```
function (&$writers) {
    $writers['myloggername'] = function ($level, $tag, $datetime, $message) {
        ...
    }
}

// 'myloggername' can now be used in the log_writers config option.
```

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
_Defined in [Piwik/Menu/MenuAdmin](https://github.com/piwik/piwik/blob/master/core/Menu/MenuAdmin.php) in line [63](https://github.com/piwik/piwik/blob/master/core/Menu/MenuAdmin.php#L63)_

This event is triggered to collect all available admin menu items. Subscribe to this event if you want
to add one or more items to the Piwik admin menu. Just define the name of your menu item as well as a
controller and an action that should be executed once a user selects your menu item. It is also possible
to display the item only for users having a specific role.

Example:
```
public function addMenuItems()
{
    MenuAdmin::getInstance()->add(
        'MenuName',
        'SubmenuName',
        array('module' => 'MyPlugin', 'action' => 'index'),
        Piwik::isUserIsSuperUser(),
        $order = 6
    );
}
```

Usages:

[CoreAdminHome::addMenu](https://github.com/piwik/piwik/blob/master/plugins/CoreAdminHome/CoreAdminHome.php#L82), [CorePluginsAdmin::addMenu](https://github.com/piwik/piwik/blob/master/plugins/CorePluginsAdmin/CorePluginsAdmin.php#L57), [DBStats::addMenu](https://github.com/piwik/piwik/blob/master/plugins/DBStats/DBStats.php#L43), [Installation::addMenu](https://github.com/piwik/piwik/blob/master/plugins/Installation/Installation.php#L80), [MobileMessaging::addMenu](https://github.com/piwik/piwik/blob/master/plugins/MobileMessaging/MobileMessaging.php#L88), [PrivacyManager::addMenu](https://github.com/piwik/piwik/blob/master/plugins/PrivacyManager/PrivacyManager.php#L99), [SitesManager::addMenu](https://github.com/piwik/piwik/blob/master/plugins/SitesManager/SitesManager.php#L40), [UserCountry::addAdminMenu](https://github.com/piwik/piwik/blob/master/plugins/UserCountry/UserCountry.php#L197), [UsersManager::addMenu](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/UsersManager.php#L95)


#### Menu.Reporting.addItems
_Defined in [Piwik/Menu/MenuMain](https://github.com/piwik/piwik/blob/master/core/Menu/MenuMain.php) in line [70](https://github.com/piwik/piwik/blob/master/core/Menu/MenuMain.php#L70)_

This event is triggered to collect all available reporting menu items. Subscribe to this event if you
want to add one or more items to the Piwik reporting menu. Just define the name of your menu item as
well as a controller and an action that should be executed once a user selects your menu item. It is
also possible to display the item only for users having a specific role.

Example:
```
public function addMenuItems()
{
    \Piwik\Menu\Main::getInstance()->add(
        'CustomMenuName',
        'CustomSubmenuName',
        array('module' => 'MyPlugin', 'action' => 'index'),
        Piwik::isUserIsSuperUser(),
        $order = 6
    );
}
```

Usages:

[Actions::addMenus](https://github.com/piwik/piwik/blob/master/plugins/Actions/Actions.php#L567), [CustomVariables::addMenus](https://github.com/piwik/piwik/blob/master/plugins/CustomVariables/CustomVariables.php#L54), [Dashboard::addMenus](https://github.com/piwik/piwik/blob/master/plugins/Dashboard/Dashboard.php#L201), [DevicesDetection::addMenu](https://github.com/piwik/piwik/blob/master/plugins/DevicesDetection/DevicesDetection.php#L291), [ExampleUI::addMenus](https://github.com/piwik/piwik/blob/master/plugins/ExampleUI/ExampleUI.php#L30), [Goals::addMenus](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L455), [Live::addMenu](https://github.com/piwik/piwik/blob/master/plugins/Live/Live.php#L54), [Provider::addMenu](https://github.com/piwik/piwik/blob/master/plugins/Provider/Provider.php#L100), [Referrers::addMenus](https://github.com/piwik/piwik/blob/master/plugins/Referrers/Referrers.php#L232), [UserCountry::addMenu](https://github.com/piwik/piwik/blob/master/plugins/UserCountry/UserCountry.php#L189), [UserCountryMap::addMenu](https://github.com/piwik/piwik/blob/master/plugins/UserCountryMap/UserCountryMap.php#L62), [UserSettings::addMenu](https://github.com/piwik/piwik/blob/master/plugins/UserSettings/UserSettings.php#L430), [VisitFrequency::addMenu](https://github.com/piwik/piwik/blob/master/plugins/VisitFrequency/VisitFrequency.php#L67), [VisitTime::addMenu](https://github.com/piwik/piwik/blob/master/plugins/VisitTime/VisitTime.php#L90), [VisitorInterest::addMenu](https://github.com/piwik/piwik/blob/master/plugins/VisitorInterest/VisitorInterest.php#L112), [VisitsSummary::addMenu](https://github.com/piwik/piwik/blob/master/plugins/VisitsSummary/VisitsSummary.php#L70)


#### Menu.Top.addItems
_Defined in [Piwik/Menu/MenuTop](https://github.com/piwik/piwik/blob/master/core/Menu/MenuTop.php) in line [91](https://github.com/piwik/piwik/blob/master/core/Menu/MenuTop.php#L91)_

This event is triggered to collect all available menu items that should be displayed on the very top next to login/logout, API and other menu items. Subscribe to this event if you want to add one or more items.
It's fairly easy. Just define the name of your menu item as well as a controller and an action that
should be executed once a user selects your menu item. It is also possible to display the item only for
users having a specific role.

Example:
```
public function addMenuItems()
{
    MenuTop::addEntry(
        'TopMenuName',
        array('module' => 'MyPlugin', 'action' => 'index'),
        Piwik::isUserIsSuperUser(),
        $order = 6
    );
}
```

Usages:

[Plugin::addTopMenu](https://github.com/piwik/piwik/blob/master/plugins/API/API.php#L652), [Dashboard::addTopMenu](https://github.com/piwik/piwik/blob/master/plugins/Dashboard/Dashboard.php#L219), [Feedback::addTopMenu](https://github.com/piwik/piwik/blob/master/plugins/Feedback/Feedback.php#L36), [LanguagesManager::showLanguagesSelector](https://github.com/piwik/piwik/blob/master/plugins/LanguagesManager/LanguagesManager.php#L56), [MultiSites::addTopMenu](https://github.com/piwik/piwik/blob/master/plugins/MultiSites/MultiSites.php#L78), [ScheduledReports::addTopMenu](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/ScheduledReports.php#L472), [Widgetize::addTopMenu](https://github.com/piwik/piwik/blob/master/plugins/Widgetize/Widgetize.php#L36)

## Provider

- [Provider.getCleanHostname](#providergetcleanhostname)

#### Provider.getCleanHostname
_Defined in [Piwik/Plugins/Provider/Provider](https://github.com/piwik/piwik/blob/master/plugins/Provider/Provider.php) in line [183](https://github.com/piwik/piwik/blob/master/plugins/Provider/Provider.php#L183)_

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
_Defined in [Piwik/Db](https://github.com/piwik/piwik/blob/master/core/Db.php) in line [62](https://github.com/piwik/piwik/blob/master/core/Db.php#L62)_

This event is triggered before a connection to the database is established. Use it to dynamically change the
datatabase settings defined in the config. The reporting database config is used in case someone accesses
the Piwik UI.

Callback Signature:
<pre><code>function(&amp;$dbInfos)</code></pre>

## Request

- [Request.dispatch](#requestdispatch)
- [Request.dispatch.end](#requestdispatchend)
- [Request.dispatchCoreAndPluginUpdatesScreen](#requestdispatchcoreandpluginupdatesscreen)
- [Request.initAuthenticationObject](#requestinitauthenticationobject)
- [Request.initAuthenticationObject](#requestinitauthenticationobject)

#### Request.dispatch
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [120](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L120)_

Generic hook that plugins can use to modify any input to the function, or even change the plugin being called. You could also use this to build an enhanced permission system. The event is triggered before every
call to a controller method.

The `$params` array contains the following properties: `array($module, $action, $parameters, $controller)`

Callback Signature:
<pre><code>$params</code></pre>


#### Request.dispatch.end
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [144](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L144)_

Generic hook that plugins can use to modify any output of any controller method. The event is triggered
after a controller method is executed but before the result is send to the user. The parameters
originally passed to the method are available as well.

Callback Signature:
<pre><code>function(&amp;$result, $parameters)</code></pre>


#### Request.dispatchCoreAndPluginUpdatesScreen
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [318](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L318)_

This event is the first event triggered just after the platform is initialized and plugins are loaded. You can use this event to do early initialization. Note: the user is not authenticated yet.

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
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [331](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L331)_

This event is triggered before the user is authenticated. You can use it to create your own
authentication object which implements the `Piwik\Auth` interface, and override the default authentication logic.

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
_Defined in [Piwik/SettingsPiwik](https://github.com/piwik/piwik/blob/master/core/SettingsPiwik.php) in line [70](https://github.com/piwik/piwik/blob/master/core/SettingsPiwik.php#L70)_

This event is triggered when the automatic archiving runs. You can use it to add Segments to the list of segments to pre-process during archiving.
Segments specified in this array will be pre-processed for all websites.

Callback Signature:
<pre><code>function(&amp;$segmentsToProcess)</code></pre>

Usages:

[SegmentEditor::getKnownSegmentsToArchiveAllSites](https://github.com/piwik/piwik/blob/master/plugins/SegmentEditor/SegmentEditor.php#L56)


#### Segments.getKnownSegmentsToArchiveForSite
_Defined in [Piwik/SettingsPiwik](https://github.com/piwik/piwik/blob/master/core/SettingsPiwik.php) in line [88](https://github.com/piwik/piwik/blob/master/core/SettingsPiwik.php#L88)_

This event is triggered when the automatic archiving runs. You can use it to add Segments to the list of segments to pre-process during archiving,
for this particular website ID $idSite.

Callback Signature:
<pre><code>function(&amp;$segments, $idSite)</code></pre>

Usages:

[SegmentEditor::getKnownSegmentsToArchiveForSite](https://github.com/piwik/piwik/blob/master/plugins/SegmentEditor/SegmentEditor.php#L64)

## Site

- [Site.getSiteAttributes](#sitegetsiteattributes)

#### Site.getSiteAttributes
_Defined in [Piwik/Tracker/Cache](https://github.com/piwik/piwik/blob/master/core/Tracker/Cache.php) in line [69](https://github.com/piwik/piwik/blob/master/core/Tracker/Cache.php#L69)_

This hook is called to get the details of a specific site depending on the id. You can use this to add any
custom attributes to the website.

Callback Signature:
<pre><code>function(&amp;$content, $idSite)</code></pre>

Usages:

[Goals::fetchGoalsFromDb](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L425), [SitesManager::recordWebsiteDataInCache](https://github.com/piwik/piwik/blob/master/plugins/SitesManager/SitesManager.php#L73), [UsersManager::recordAdminUsersInCache](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/UsersManager.php#L53)

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

[Goals::deleteSiteGoals](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L111), [ScheduledReports::deleteSiteReport](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/ScheduledReports.php#L105), [UsersManager::deleteSite](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/UsersManager.php#L68)

## TaskScheduler

- [TaskScheduler.getScheduledTasks](#taskschedulergetscheduledtasks)

#### TaskScheduler.getScheduledTasks
_Defined in [Piwik/TaskScheduler](https://github.com/piwik/piwik/blob/master/core/TaskScheduler.php) in line [68](https://github.com/piwik/piwik/blob/master/core/TaskScheduler.php#L68)_

This event can be used to register any tasks that you may want to schedule on a regular basis. For instance
hourly, daily, weekly or monthly. It is comparable to a cronjob. The registered method will be executed
depending on the interval that you specify. See `Piwik\ScheduledTask` for more information.

Example:
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

[CoreAdminHome::getScheduledTasks](https://github.com/piwik/piwik/blob/master/plugins/CoreAdminHome/CoreAdminHome.php#L41), [CorePluginsAdmin::getScheduledTasks](https://github.com/piwik/piwik/blob/master/plugins/CorePluginsAdmin/CorePluginsAdmin.php#L41), [DBStats::getScheduledTasks](https://github.com/piwik/piwik/blob/master/plugins/DBStats/DBStats.php#L54), [PrivacyManager::getScheduledTasks](https://github.com/piwik/piwik/blob/master/plugins/PrivacyManager/PrivacyManager.php#L78), [ScheduledReports::getScheduledTasks](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/ScheduledReports.php#L427), [UserCountry::getScheduledTasks](https://github.com/piwik/piwik/blob/master/plugins/UserCountry/UserCountry.php#L67)

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
- [Tracker.setSiteId](#trackersetsiteid)
- [Tracker.setTrackerCacheGeneral](#trackersettrackercachegeneral)
- [Tracker.setVisitorIp](#trackersetvisitorip)

#### Tracker.detectReferrerSearchEngine
_Defined in [Piwik/Tracker/Referrer](https://github.com/piwik/piwik/blob/master/core/Tracker/Referrer.php) in line [136](https://github.com/piwik/piwik/blob/master/core/Tracker/Referrer.php#L136)_

This event is triggered after basic search engine detection has been attempted. A plugin can use this event
to modify or provide new results based on the passed referrer URL.

Callback Signature:
<pre><code>function(&amp;$searchEngineInformation, $this-&gt;referrerUrl)</code></pre>


#### Tracker.getDatabaseConfig
_Defined in [Piwik/Tracker](https://github.com/piwik/piwik/blob/master/core/Tracker.php) in line [564](https://github.com/piwik/piwik/blob/master/core/Tracker.php#L564)_

This event is triggered before a connection to the database is established. Use it to dynamically change the
datatabase settings defined in the config. The tracker database config is used in case a new pageview/visit
will be tracked.

Callback Signature:
<pre><code>function(&amp;$configDb)</code></pre>


#### Tracker.isExcludedVisit
_Defined in [Piwik/Tracker/VisitExcluded](https://github.com/piwik/piwik/blob/master/core/Tracker/VisitExcluded.php) in line [79](https://github.com/piwik/piwik/blob/master/core/Tracker/VisitExcluded.php#L79)_

At every page view, this event will be called. It is useful for plugins that want to exclude specific visits
(ie. IP excluding, Cookie excluding). If you set `$excluded` to `true`, the visit will be excluded.

Callback Signature:
<pre><code>function(&amp;$excluded)</code></pre>

Usages:

[DoNotTrack::checkHeader](https://github.com/piwik/piwik/blob/master/plugins/DoNotTrack/DoNotTrack.php#L36)


#### Tracker.knownVisitorInformation
_Defined in [Piwik/Tracker/Visit](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php) in line [358](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php#L358)_

After a known visitor is saved and updated by Piwik, this event is called. Useful for plugins that want to
register information about a returning visitor, or filter the existing information.

Callback Signature:
<pre><code>function(&amp;$this-&gt;visitorInfo)</code></pre>


#### Tracker.knownVisitorUpdate
_Defined in [Piwik/Tracker/Visit](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php) in line [313](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php#L313)_

This event is triggered before saving a known visitor. Use it to change any visitor information before
the visitor is saved.

Callback Signature:
<pre><code>function(&amp;$valuesToUpdate)</code></pre>


#### Tracker.makeNewVisitObject
_Defined in [Piwik/Tracker](https://github.com/piwik/piwik/blob/master/core/Tracker.php) in line [617](https://github.com/piwik/piwik/blob/master/core/Tracker.php#L617)_

This event is triggered once a new `Piwik\Tracker\Visit` object is requested. Use this event to force the
usage of your own or your extended visit object but make sure to implement the
`Piwik\Tracker\VisitInterface`.

Callback Signature:
<pre><code>function(&amp;$visit)</code></pre>


#### Tracker.newVisitorInformation
_Defined in [Piwik/Tracker/Visit](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php) in line [480](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php#L480)_

Before a new visitor is saved by Piwik, this event is called. Useful for plugins that want to register
new information about a visitor, or filter the existing information. `$extraInfo` contains the UserAgent.
You can for instance change the user's location country depending on the User Agent.

Callback Signature:
<pre><code>function(&amp;$this-&gt;visitorInfo, $extraInfo)</code></pre>

Usages:

[DevicesDetection::parseMobileVisitData](https://github.com/piwik/piwik/blob/master/plugins/DevicesDetection/DevicesDetection.php#L252), [Provider::logProviderInfo](https://github.com/piwik/piwik/blob/master/plugins/Provider/Provider.php#L114), [UserCountry::getVisitorLocation](https://github.com/piwik/piwik/blob/master/plugins/UserCountry/UserCountry.php#L83)


#### Tracker.recordAction
_Defined in [Piwik/Tracker/Action](https://github.com/piwik/piwik/blob/master/core/Tracker/Action.php) in line [648](https://github.com/piwik/piwik/blob/master/core/Tracker/Action.php#L648)_

This hook is called after saving (and updating) visitor information. You can use it for instance to sync the
recorded action with third party systems.

Callback Signature:
<pre><code>function($trackerAction = $this, $info)</code></pre>


#### Tracker.recordEcommerceGoal
_Defined in [Piwik/Tracker/GoalManager](https://github.com/piwik/piwik/blob/master/core/Tracker/GoalManager.php) in line [413](https://github.com/piwik/piwik/blob/master/core/Tracker/GoalManager.php#L413)_

This hook is called after recording an ecommerce goal. You can use it for instance to sync the recorded goal
with third party systems. `$goal` contains all available information like `items` and `revenue`.

Callback Signature:
<pre><code>function($goal)</code></pre>


#### Tracker.recordStandardGoals
_Defined in [Piwik/Tracker/GoalManager](https://github.com/piwik/piwik/blob/master/core/Tracker/GoalManager.php) in line [778](https://github.com/piwik/piwik/blob/master/core/Tracker/GoalManager.php#L778)_

This hook is called after recording a standard goal. You can use it for instance to sync the recorded
goal with third party systems. `$goal` contains all available information like `url` and `revenue`.

Callback Signature:
<pre><code>function($newGoal)</code></pre>


#### Tracker.setSiteId
_Defined in [Piwik/Tracker/Request](https://github.com/piwik/piwik/blob/master/core/Tracker/Request.php) in line [301](https://github.com/piwik/piwik/blob/master/core/Tracker/Request.php#L301)_

This event allows a plugin to set/change the idsite in the tracking request. Note: A modified idSite has to
be higher than `0`, otherwise an exception will be triggered. By default the idSite is specified on the URL
parameter `idsite`.

Callback Signature:
<pre><code>function(&amp;$idSite, $this-&gt;params)</code></pre>


#### Tracker.setTrackerCacheGeneral
_Defined in [Piwik/Tracker/Cache](https://github.com/piwik/piwik/blob/master/core/Tracker/Cache.php) in line [117](https://github.com/piwik/piwik/blob/master/core/Tracker/Cache.php#L117)_

This event is triggered to add any custom content to the Tracker cache. You may want to cache any tracker
data that is expensive to re-calculate on each tracking request.

Callback Signature:
<pre><code>function(&amp;$cacheContent)</code></pre>

Usages:

[UserCountry::setTrackerCacheGeneral](https://github.com/piwik/piwik/blob/master/plugins/UserCountry/UserCountry.php#L62)


#### Tracker.setVisitorIp
_Defined in [Piwik/Tracker/Visit](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php) in line [99](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php#L99)_

This event can be used for instance to anonymize the IP (after testing for IP exclusion).

Callback Signature:
<pre><code>function(&amp;$this-&gt;visitorInfo[&#039;location_ip&#039;])</code></pre>

Usages:

[AnonymizeIP::setVisitorIpAddress](https://github.com/piwik/piwik/blob/master/plugins/AnonymizeIP/AnonymizeIP.php#L83)

## Translate

- [Translate.getClientSideTranslationKeys](#translategetclientsidetranslationkeys)

#### Translate.getClientSideTranslationKeys
_Defined in [Piwik/Translate](https://github.com/piwik/piwik/blob/master/core/Translate.php) in line [177](https://github.com/piwik/piwik/blob/master/core/Translate.php#L177)_

This event is called before generating the JavaScript code that allows other JavaScript to access Piwik i18n strings. Plugins should handle this event to specify which translations
should be available to JavaScript code.

Event handlers should add whole translation keys, ie, keys that include the plugin name.
For example:

```
public function getClientSideTranslationKeys(&$result)
{
    $result[] = "MyPlugin_MyTranslation";
}
```

Callback Signature:
<pre><code>function(&amp;$result)</code></pre>

Usages:

[CoreHome::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/master/plugins/CoreHome/CoreHome.php#L93), [CorePluginsAdmin::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/master/plugins/CorePluginsAdmin/CorePluginsAdmin.php#L98), [CoreVisualizations::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/master/plugins/CoreVisualizations/CoreVisualizations.php#L64), [Dashboard::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/master/plugins/Dashboard/Dashboard.php#L279), [Feedback::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/master/plugins/Feedback/Feedback.php#L58), [Goals::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L645), [Live::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/master/plugins/Live/Live.php#L67), [Overlay::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/master/plugins/Overlay/Overlay.php#L46), [SitesManager::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/master/plugins/SitesManager/SitesManager.php#L212), [Transitions::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/master/plugins/Transitions/Transitions.php#L41), [UserCountry::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/master/plugins/UserCountry/UserCountry.php#L493), [UsersManager::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/UsersManager.php#L139), [Widgetize::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/master/plugins/Widgetize/Widgetize.php#L63)

## Updater

- [Updater.checkForUpdates](#updatercheckforupdates)

#### Updater.checkForUpdates
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [357](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L357)_

This event is triggered to check for updates. It is triggered after the platform is initialized and after
the user is authenticated but before the platform is going to dispatch the actual request. You can use
it to check for any updates.

Usages:

[CoreUpdater::updateCheck](https://github.com/piwik/piwik/blob/master/plugins/CoreUpdater/CoreUpdater.php#L83)

## User

- [User.getLanguage](#usergetlanguage)
- [User.isNotAuthorized](#userisnotauthorized)

#### User.getLanguage
_Defined in [Piwik/Translate](https://github.com/piwik/piwik/blob/master/core/Translate.php) in line [108](https://github.com/piwik/piwik/blob/master/core/Translate.php#L108)_

This event is triggered to identify the language code, such as 'en', for the current user. You can use
it for instance to detect the users language by using a third party API such as a CMS. The language that
is set in the request URL is passed as an argument.

Callback Signature:
<pre><code>function(&amp;$lang)</code></pre>

Usages:

[LanguagesManager::getLanguageToLoad](https://github.com/piwik/piwik/blob/master/plugins/LanguagesManager/LanguagesManager.php#L88)


#### User.isNotAuthorized
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [155](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L155)_

This event is triggered in case the user wants to access anything in the Piwik UI but has not the required permissions to do this. You can subscribe to this event to display a custom error message or
to display a custom login form in such a case.

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

[Dashboard::deleteDashboardLayout](https://github.com/piwik/piwik/blob/master/plugins/Dashboard/Dashboard.php#L248), [LanguagesManager::deleteUserLanguage](https://github.com/piwik/piwik/blob/master/plugins/LanguagesManager/LanguagesManager.php#L98), [ScheduledReports::deleteUserReport](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/ScheduledReports.php#L523)


#### UsersManager.updateUser.end
_Defined in [Piwik/Plugins/UsersManager/API](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/API.php) in line [466](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/API.php#L466)_

This event is triggered after an existing user has been updated. `$userLogin` contains the updated user
information like login name, alias and email.

Callback Signature:
<pre><code>function($userLogin)</code></pre>

## Visualization

- [Visualization.addVisualizations](#visualizationaddvisualizations)
- [Visualization.configureFooterIcons](#visualizationconfigurefootericons)
- [Visualization.getReportDisplayProperties](#visualizationgetreportdisplayproperties)
- [Visualization.initView](#visualizationinitview)

#### Visualization.addVisualizations
_Defined in [Piwik/ViewDataTable/Visualization](https://github.com/piwik/piwik/blob/master/core/ViewDataTable/Visualization.php) in line [220](https://github.com/piwik/piwik/blob/master/core/ViewDataTable/Visualization.php#L220)_

This event is used to gather all available DataTable visualizations. Callbacks should add visualization
class names to the incoming array.

Callback Signature:
<pre><code>function(&amp;$visualizations)</code></pre>

Usages:

[CoreVisualizations::getAvailableDataTableVisualizations](https://github.com/piwik/piwik/blob/master/plugins/CoreVisualizations/CoreVisualizations.php#L38), [ExampleVisualization::getAvailableVisualizations](https://github.com/piwik/piwik/blob/master/plugins/ExampleVisualization/ExampleVisualization.php#L30)


#### Visualization.configureFooterIcons
_Defined in [Piwik/ViewDataTable](https://github.com/piwik/piwik/blob/master/core/ViewDataTable.php) in line [1272](https://github.com/piwik/piwik/blob/master/core/ViewDataTable.php#L1272)_

This event is called when determining the default set of footer icons to display below a report. Plugins can use this event to modify the default set of footer icons. You can
add new icons or remove existing ones.

$result must have the following format:

```
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
    ),
    ...
)
```

Callback Signature:
<pre><code>function(&amp;$result, $viewDataTable = $this)</code></pre>


#### Visualization.getReportDisplayProperties
_Defined in [Piwik/ViewDataTable](https://github.com/piwik/piwik/blob/master/core/ViewDataTable.php) in line [387](https://github.com/piwik/piwik/blob/master/core/ViewDataTable.php#L387)_

This event is triggered to gather the report display properties for each available report. If you define
your own report, you want to subscribe to this event to define how your report shall be displayed in the
Piwik UI.

Example:
```
public function getReportDisplayProperties(&$properties)
{
    $properties['Provider.getProvider'] = array(
        'translations' => array('label' => Piwik::translate('Provider_ColumnProvider')),
        'filter_limit' => 5
    )
}
```

Callback Signature:
<pre><code>function(&amp;self::$reportPropertiesCache)</code></pre>

Usages:

[Actions::getReportDisplayProperties](https://github.com/piwik/piwik/blob/master/plugins/Actions/Actions.php#L646), [CustomVariables::getReportDisplayProperties](https://github.com/piwik/piwik/blob/master/plugins/CustomVariables/CustomVariables.php#L155), [DBStats::getReportDisplayProperties](https://github.com/piwik/piwik/blob/master/plugins/DBStats/DBStats.php#L91), [DevicesDetection::getReportDisplayProperties](https://github.com/piwik/piwik/blob/master/plugins/DevicesDetection/DevicesDetection.php#L296), [Goals::getReportDisplayProperties](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L521), [Live::getReportDisplayProperties](https://github.com/piwik/piwik/blob/master/plugins/Live/Live.php#L76), [Provider::getReportDisplayProperties](https://github.com/piwik/piwik/blob/master/plugins/Provider/Provider.php#L238), [Referrers::getReportDisplayProperties](https://github.com/piwik/piwik/blob/master/plugins/Referrers/Referrers.php#L298), [UserCountry::getReportDisplayProperties](https://github.com/piwik/piwik/blob/master/plugins/UserCountry/UserCountry.php#L366), [UserSettings::getReportDisplayProperties](https://github.com/piwik/piwik/blob/master/plugins/UserSettings/UserSettings.php#L179), [VisitTime::getReportDisplayProperties](https://github.com/piwik/piwik/blob/master/plugins/VisitTime/VisitTime.php#L125), [VisitorInterest::getReportDisplayProperties](https://github.com/piwik/piwik/blob/master/plugins/VisitorInterest/VisitorInterest.php#L154)


#### Visualization.initView
_Defined in [Piwik/ViewDataTable](https://github.com/piwik/piwik/blob/master/core/ViewDataTable.php) in line [1083](https://github.com/piwik/piwik/blob/master/core/ViewDataTable.php#L1083)_

This event is called after a visualization has been configured. Plugins can use this event to
override view properties for individual reports or visualizations.

Themes can use this event to make sure reports look nice with their themes. Plugins
that provide new visualizations can use this event to make sure certain reports
are configured differently when viewed with the new visualization.

Callback Signature:
<pre><code>function($viewDataTable = $this)</code></pre>

## WidgetsList

- [WidgetsList.addWidgets](#widgetslistaddwidgets)

#### WidgetsList.addWidgets
_Defined in [Piwik/WidgetsList](https://github.com/piwik/piwik/blob/master/core/WidgetsList.php) in line [72](https://github.com/piwik/piwik/blob/master/core/WidgetsList.php#L72)_

This event is triggered to collect all available widgets. Subscribe to this event if you want to create
one or more custom widgets. Just define the name of your widgets as well as a controller and an action
that should be executed once your widget is requested.

Example:
```
public function addWidgets()
{
    WidgetsList::add('General_Actions', 'General_Pages', 'Actions', 'getPageUrls');
}
```

Usages:

[Actions::addWidgets](https://github.com/piwik/piwik/blob/master/plugins/Actions/Actions.php#L544), [CoreHome::addWidgets](https://github.com/piwik/piwik/blob/master/plugins/CoreHome/CoreHome.php#L37), [CustomVariables::addWidgets](https://github.com/piwik/piwik/blob/master/plugins/CustomVariables/CustomVariables.php#L49), [DevicesDetection::addWidgets](https://github.com/piwik/piwik/blob/master/plugins/DevicesDetection/DevicesDetection.php#L169), [ExamplePlugin::addWidgets](https://github.com/piwik/piwik/blob/master/plugins/ExamplePlugin/ExamplePlugin.php#L52), [ExampleRssWidget::addWidgets](https://github.com/piwik/piwik/blob/master/plugins/ExampleRssWidget/ExampleRssWidget.php#L37), [Goals::addWidgets](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L431), [Live::addWidget](https://github.com/piwik/piwik/blob/master/plugins/Live/Live.php#L59), [Provider::addWidget](https://github.com/piwik/piwik/blob/master/plugins/Provider/Provider.php#L95), [Referrers::addWidgets](https://github.com/piwik/piwik/blob/master/plugins/Referrers/Referrers.php#L215), [SEO::addWidgets](https://github.com/piwik/piwik/blob/master/plugins/SEO/SEO.php#L43), [UserCountry::addWidgets](https://github.com/piwik/piwik/blob/master/plugins/UserCountry/UserCountry.php#L172), [UserSettings::addWidgets](https://github.com/piwik/piwik/blob/master/plugins/UserSettings/UserSettings.php#L417), [VisitFrequency::addWidgets](https://github.com/piwik/piwik/blob/master/plugins/VisitFrequency/VisitFrequency.php#L61), [VisitTime::addWidgets](https://github.com/piwik/piwik/blob/master/plugins/VisitTime/VisitTime.php#L83), [VisitorInterest::addWidgets](https://github.com/piwik/piwik/blob/master/plugins/VisitorInterest/VisitorInterest.php#L104), [VisitsSummary::addWidgets](https://github.com/piwik/piwik/blob/master/plugins/VisitsSummary/VisitsSummary.php#L63)

