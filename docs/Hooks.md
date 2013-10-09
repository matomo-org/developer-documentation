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
- [Schema](#schema)
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

#### API.$pluginName.$methodName
_Defined in [Piwik/API/Proxy](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php) in line [197](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php#L197)_

This event is similar to the `API.Request.dispatch` event. It distinguishes the possibility to subscribe
only to a specific API method instead of all API methods. You can use it for example to modify any input
parameters or to execute any other logic before the actual API method is called.

Callback Signature:
<pre><code>function(&amp;$finalParameters)</code></pre>


#### API.$pluginName.$methodName.end
_Defined in [Piwik/API/Proxy](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php) in line [226](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php#L226)_

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

[Actions::getReportMetadata](https://github.com/piwik/piwik/blob/master/plugins/Actions/Actions.php#L211), [CustomVariables::getReportMetadata](https://github.com/piwik/piwik/blob/master/plugins/CustomVariables/CustomVariables.php#L60), [DevicesDetection::getReportMetadata](https://github.com/piwik/piwik/blob/master/plugins/DevicesDetection/DevicesDetection.php#L201), [MultiSites::getReportMetadata](https://github.com/piwik/piwik/blob/master/plugins/MultiSites/MultiSites.php#L41), [Provider::getReportMetadata](https://github.com/piwik/piwik/blob/master/plugins/Provider/Provider.php#L46), [Referrers::getReportMetadata](https://github.com/piwik/piwik/blob/master/plugins/Referrers/Referrers.php#L46), [UserCountry::getReportMetadata](https://github.com/piwik/piwik/blob/master/plugins/UserCountry/UserCountry.php#L256), [UserSettings::getReportMetadata](https://github.com/piwik/piwik/blob/master/plugins/UserSettings/UserSettings.php#L355), [VisitFrequency::getReportMetadata](https://github.com/piwik/piwik/blob/master/plugins/VisitFrequency/VisitFrequency.php#L34), [VisitTime::getReportMetadata](https://github.com/piwik/piwik/blob/master/plugins/VisitTime/VisitTime.php#L45), [VisitorInterest::getReportMetadata](https://github.com/piwik/piwik/blob/master/plugins/VisitorInterest/VisitorInterest.php#L41), [VisitsSummary::getReportMetadata](https://github.com/piwik/piwik/blob/master/plugins/VisitsSummary/VisitsSummary.php#L37)


#### API.getReportMetadata.end
_Defined in [Piwik/Plugins/API/ProcessedReport](https://github.com/piwik/piwik/blob/master/plugins/API/ProcessedReport.php) in line [115](https://github.com/piwik/piwik/blob/master/plugins/API/ProcessedReport.php#L115)_

This event is triggered after all available reports are collected. Plugins can add custom metrics to
other reports or remove reports from the list of all available reports.

Callback Signature:
<pre><code>function(&amp;$availableReports, $parameters)</code></pre>

Usages:

[Goals::getReportMetadata](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L122)


#### API.getSegmentsMetadata
_Defined in [Piwik/Plugins/API/API](https://github.com/piwik/piwik/blob/master/plugins/API/API.php) in line [102](https://github.com/piwik/piwik/blob/master/plugins/API/API.php#L102)_

This event is triggered to get all available segments. Your plugin can use this event to add one or
multiple new segments.

Callback Signature:
<pre><code>function(&amp;$segments, $idSites)</code></pre>

Usages:

[Actions::getSegmentsMetadata](https://github.com/piwik/piwik/blob/master/plugins/Actions/Actions.php#L80), [CustomVariables::getSegmentsMetadata](https://github.com/piwik/piwik/blob/master/plugins/CustomVariables/CustomVariables.php#L84), [DevicesDetection::getSegmentsMetadata](https://github.com/piwik/piwik/blob/master/plugins/DevicesDetection/DevicesDetection.php#L181), [Goals::getSegmentsMetadata](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L401), [Provider::getSegmentsMetadata](https://github.com/piwik/piwik/blob/master/plugins/Provider/Provider.php#L59), [Referrers::getSegmentsMetadata](https://github.com/piwik/piwik/blob/master/plugins/Referrers/Referrers.php#L173), [UserCountry::getSegmentsMetadata](https://github.com/piwik/piwik/blob/master/plugins/UserCountry/UserCountry.php#L203), [UserSettings::getSegmentsMetadata](https://github.com/piwik/piwik/blob/master/plugins/UserSettings/UserSettings.php#L395), [VisitTime::getSegmentsMetadata](https://github.com/piwik/piwik/blob/master/plugins/VisitTime/VisitTime.php#L102)


#### API.Request.authenticate
_Defined in [Piwik/API/Request](https://github.com/piwik/piwik/blob/master/core/API/Request.php) in line [191](https://github.com/piwik/piwik/blob/master/core/API/Request.php#L191)_

This event will be triggered if the token_auth is found in the $request parameter. In this case the
current session will be authenticated using this token_auth. It will overwrite the previous `Auth`
object.

Callback Signature:
<pre><code>function($token_auth)</code></pre>

Usages:

[Login::ApiRequestAuthenticate](https://github.com/piwik/piwik/blob/master/plugins/Login/Login.php#L59)


#### API.Request.dispatch
_Defined in [Piwik/API/Proxy](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php) in line [190](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php#L190)_

Generic hook that plugins can use to modify any input to any API method. You could also use this to build
an enhanced permission system. The event is triggered shortly before any API method is executed.

The `$fnalParameters` contains all paramteres that will be passed to the actual API method.

Callback Signature:
<pre><code>function(&amp;$finalParameters)</code></pre>


#### API.Request.dispatch.end
_Defined in [Piwik/API/Proxy](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php) in line [243](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php#L243)_

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

#### ArchiveProcessor.Day.compute
_Defined in [Piwik/ArchiveProcessor/Day](https://github.com/piwik/piwik/blob/master/core/ArchiveProcessor/Day.php) in line [123](https://github.com/piwik/piwik/blob/master/core/ArchiveProcessor/Day.php#L123)_

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

[Actions::archiveDay](https://github.com/piwik/piwik/blob/master/plugins/Actions/Actions.php#L595), [CustomVariables::archiveDay](https://github.com/piwik/piwik/blob/master/plugins/CustomVariables/CustomVariables.php#L139), [DevicesDetection::archiveDay](https://github.com/piwik/piwik/blob/master/plugins/DevicesDetection/DevicesDetection.php#L274), [Goals::archiveDay](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L499), [Provider::archiveDay](https://github.com/piwik/piwik/blob/master/plugins/Provider/Provider.php#L220), [Referrers::archiveDay](https://github.com/piwik/piwik/blob/master/plugins/Referrers/Referrers.php#L276), [UserCountry::archiveDay](https://github.com/piwik/piwik/blob/master/plugins/UserCountry/UserCountry.php#L337), [UserSettings::archiveDay](https://github.com/piwik/piwik/blob/master/plugins/UserSettings/UserSettings.php#L438), [VisitTime::archiveDay](https://github.com/piwik/piwik/blob/master/plugins/VisitTime/VisitTime.php#L189), [VisitorInterest::archiveDay](https://github.com/piwik/piwik/blob/master/plugins/VisitorInterest/VisitorInterest.php#L130)


#### ArchiveProcessor.Period.compute
_Defined in [Piwik/ArchiveProcessor/Period](https://github.com/piwik/piwik/blob/master/core/ArchiveProcessor/Period.php) in line [204](https://github.com/piwik/piwik/blob/master/core/ArchiveProcessor/Period.php#L204)_

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

[Actions::archivePeriod](https://github.com/piwik/piwik/blob/master/plugins/Actions/Actions.php#L603), [CustomVariables::archivePeriod](https://github.com/piwik/piwik/blob/master/plugins/CustomVariables/CustomVariables.php#L147), [DevicesDetection::archivePeriod](https://github.com/piwik/piwik/blob/master/plugins/DevicesDetection/DevicesDetection.php#L282), [Goals::archivePeriod](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L511), [Provider::archivePeriod](https://github.com/piwik/piwik/blob/master/plugins/Provider/Provider.php#L228), [Referrers::archivePeriod](https://github.com/piwik/piwik/blob/master/plugins/Referrers/Referrers.php#L288), [UserCountry::archivePeriod](https://github.com/piwik/piwik/blob/master/plugins/UserCountry/UserCountry.php#L329), [UserSettings::archivePeriod](https://github.com/piwik/piwik/blob/master/plugins/UserSettings/UserSettings.php#L449), [VisitTime::archivePeriod](https://github.com/piwik/piwik/blob/master/plugins/VisitTime/VisitTime.php#L181), [VisitorInterest::archivePeriod](https://github.com/piwik/piwik/blob/master/plugins/VisitorInterest/VisitorInterest.php#L122)

## AssetManager

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

[Actions::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/Actions/Actions.php#L75), [Annotations::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/Annotations/Annotations.php#L43), [CoreAdminHome::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/CoreAdminHome/CoreAdminHome.php#L67), [CoreHome::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/CoreHome/CoreHome.php#L61), [CorePluginsAdmin::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/CorePluginsAdmin/CorePluginsAdmin.php#L89), [CoreVisualizations::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/CoreVisualizations/CoreVisualizations.php#L55), [Dashboard::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/Dashboard/Dashboard.php#L231), [Feedback::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/Feedback/Feedback.php#L51), [Goals::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L413), [LanguagesManager::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/LanguagesManager/LanguagesManager.php#L50), [Live::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/Live/Live.php#L45), [MobileMessaging::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/MobileMessaging/MobileMessaging.php#L98), [MultiSites::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/MultiSites/MultiSites.php#L83), [Overlay::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/Overlay/Overlay.php#L40), [PrivacyManager::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/PrivacyManager/PrivacyManager.php#L92), [ScheduledReports::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/ScheduledReports.php#L114), [SegmentEditor::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/SegmentEditor/SegmentEditor.php#L100), [SitesManager::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/SitesManager/SitesManager.php#L59), [Transitions::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/Transitions/Transitions.php#L36), [UserCountry::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/UserCountry/UserCountry.php#L76), [UserCountryMap::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/UserCountryMap/UserCountryMap.php#L69), [UsersManager::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/UsersManager.php#L77), [Widgetize::getJsFiles](https://github.com/piwik/piwik/blob/master/plugins/Widgetize/Widgetize.php#L42)


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

[Plugin::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/API/API.php#L685), [Actions::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/Actions/Actions.php#L70), [Annotations::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/Annotations/Annotations.php#L35), [CoreAdminHome::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/CoreAdminHome/CoreAdminHome.php#L59), [CoreHome::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/CoreHome/CoreHome.php#L43), [CorePluginsAdmin::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/CorePluginsAdmin/CorePluginsAdmin.php#L51), [CoreVisualizations::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/CoreVisualizations/CoreVisualizations.php#L49), [DBStats::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/DBStats/DBStats.php#L78), [Dashboard::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/Dashboard/Dashboard.php#L240), [ExampleRssWidget::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/ExampleRssWidget/ExampleRssWidget.php#L32), [Feedback::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/Feedback/Feedback.php#L46), [Goals::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L418), [Installation::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/Installation/Installation.php#L90), [LanguagesManager::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/LanguagesManager/LanguagesManager.php#L45), [Live::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/Live/Live.php#L39), [MobileMessaging::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/MobileMessaging/MobileMessaging.php#L103), [MultiSites::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/MultiSites/MultiSites.php#L88), [SegmentEditor::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/SegmentEditor/SegmentEditor.php#L105), [SitesManager::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/SitesManager/SitesManager.php#L50), [Transitions::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/Transitions/Transitions.php#L31), [UserCountry::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/UserCountry/UserCountry.php#L71), [UserCountryMap::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/UserCountryMap/UserCountryMap.php#L79), [UsersManager::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/UsersManager.php#L86), [Widgetize::getStylesheetFiles](https://github.com/piwik/piwik/blob/master/plugins/Widgetize/Widgetize.php#L52)

## Config

#### Config.badConfigurationFile
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [321](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L321)_

This event is triggered in case a config file is not in the correct format or in case required values are missing. The event can be used to start the installation process or to display a custom error
message.

Callback Signature:
<pre><code>function($exception)</code></pre>

Usages:

[Installation::dispatch](https://github.com/piwik/piwik/blob/master/plugins/Installation/Installation.php#L52)


#### Config.NoConfigurationFile
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [248](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L248)_

This event is triggered in case no configuration file is available. This usually means Piwik is not
installed yet. The event can be used to start the installation process or to display a custom error
message.

Callback Signature:
<pre><code>function($exception)</code></pre>

Usages:

[Installation::dispatch](https://github.com/piwik/piwik/blob/master/plugins/Installation/Installation.php#L52)

## Controller

#### Controller.$module.$action
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [140](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L140)_

This event is similar to the `Request.dispatch` hook. It distinguishes the possibility to subscribe only to a
specific controller method instead of all controller methods. You can use it for example to modify any input
parameters or execute any other logic before the actual controller is called.

Callback Signature:
<pre><code>function($parameters)</code></pre>


#### Controller.$module.$action.end
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [150](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L150)_

This event is similar to the `Request.dispatch.end` hook. It distinguishes the possibility to subscribe
only to the end of a specific controller method instead of all controller methods. You can use it for
example to modify the response of a single controller method.

Callback Signature:
<pre><code>function(&amp;$result, $parameters)</code></pre>

## Goals

#### Goals.getReportsWithGoalMetrics
_Defined in [Piwik/Plugins/Goals/Goals](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php) in line [362](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L362)_



Callback Signature:
<pre><code>function(&amp;$reportsWithGoals)</code></pre>

Usages:

[CustomVariables::getReportsWithGoalMetrics](https://github.com/piwik/piwik/blob/master/plugins/CustomVariables/CustomVariables.php#L125), [Goals::getActualReportsWithGoalMetrics](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L385), [Referrers::getReportsWithGoalMetrics](https://github.com/piwik/piwik/blob/master/plugins/Referrers/Referrers.php#L242), [UserCountry::getReportsWithGoalMetrics](https://github.com/piwik/piwik/blob/master/plugins/UserCountry/UserCountry.php#L305), [VisitTime::getReportsWithGoalMetrics](https://github.com/piwik/piwik/blob/master/plugins/VisitTime/VisitTime.php#L93)

## Live

#### Live.getExtraVisitorDetails
_Defined in [Piwik/Plugins/Live/API](https://github.com/piwik/piwik/blob/master/plugins/Live/API.php) in line [373](https://github.com/piwik/piwik/blob/master/plugins/Live/API.php#L373)_

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

#### Log.formatDatabaseMessage
_Defined in [Piwik/Log](https://github.com/piwik/piwik/blob/master/core/Log.php) in line [394](https://github.com/piwik/piwik/blob/master/core/Log.php#L394)_

This event is called when trying to log an object to a database table. Plugins can use
this event to convert objects to strings before they are logged.

The $message parameter is the object that is being logged. Event handlers should
check if the object is of a certain type and if it is, set $message to the
string that should be logged.

Callback Signature:
<pre><code>function(&amp;$message, $level, $tag, $datetime, $logger)</code></pre>


#### Log.formatFileMessage
_Defined in [Piwik/Log](https://github.com/piwik/piwik/blob/master/core/Log.php) in line [325](https://github.com/piwik/piwik/blob/master/core/Log.php#L325)_

This event is called when trying to log an object to a file. Plugins can use
this event to convert objects to strings before they are logged.

The $message parameter is the object that is being logged. Event handlers should
check if the object is of a certain type and if it is, set $message to the
string that should be logged.

Callback Signature:
<pre><code>function(&amp;$message, $level, $tag, $datetime, $logger)</code></pre>


#### Log.formatScreenMessage
_Defined in [Piwik/Log](https://github.com/piwik/piwik/blob/master/core/Log.php) in line [369](https://github.com/piwik/piwik/blob/master/core/Log.php#L369)_

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
_Defined in [Piwik/Log](https://github.com/piwik/piwik/blob/master/core/Log.php) in line [302](https://github.com/piwik/piwik/blob/master/core/Log.php#L302)_

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
_Defined in [Piwik/Plugins/UsersManager/Controller](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/Controller.php) in line [341](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/Controller.php#L341)_

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

#### Menu.Admin.addItems
_Defined in [Piwik/Menu/Admin](https://github.com/piwik/piwik/blob/master/core/Menu/Admin.php) in line [62](https://github.com/piwik/piwik/blob/master/core/Menu/Admin.php#L62)_

This event is triggered to collect all available admin menu items. Subscribe to this event if you want
to add one or more items to the Piwik admin menu. Just define the name of your menu item as well as a
controller and an action that should be executed once a user selects your menu item. It is also possible
to display the item only for users having a specific role.

Example:
```
public function addMenuItems()
{
    Piwik_AddAdminSubMenu(
        'MenuName',
        'SubmenuName',
        array('module' => 'MyPlugin', 'action' => 'index'),
        Piwik::isUserIsSuperUser(),
        $order = 6
    );
}
```

Usages:

[CoreAdminHome::addMenu](https://github.com/piwik/piwik/blob/master/plugins/CoreAdminHome/CoreAdminHome.php#L81), [CorePluginsAdmin::addMenu](https://github.com/piwik/piwik/blob/master/plugins/CorePluginsAdmin/CorePluginsAdmin.php#L56), [DBStats::addMenu](https://github.com/piwik/piwik/blob/master/plugins/DBStats/DBStats.php#L41), [Installation::addMenu](https://github.com/piwik/piwik/blob/master/plugins/Installation/Installation.php#L79), [MobileMessaging::addMenu](https://github.com/piwik/piwik/blob/master/plugins/MobileMessaging/MobileMessaging.php#L86), [PrivacyManager::addMenu](https://github.com/piwik/piwik/blob/master/plugins/PrivacyManager/PrivacyManager.php#L97), [SitesManager::addMenu](https://github.com/piwik/piwik/blob/master/plugins/SitesManager/SitesManager.php#L39), [UserCountry::addAdminMenu](https://github.com/piwik/piwik/blob/master/plugins/UserCountry/UserCountry.php#L195), [UsersManager::addMenu](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/UsersManager.php#L94)


#### Menu.Reporting.addItems
_Defined in [Piwik/Menu/Main](https://github.com/piwik/piwik/blob/master/core/Menu/Main.php) in line [82](https://github.com/piwik/piwik/blob/master/core/Menu/Main.php#L82)_

This event is triggered to collect all available reporting menu items. Subscribe to this event if you
want to add one or more items to the Piwik reporting menu. Just define the name of your menu item as
well as a controller and an action that should be executed once a user selects your menu item. It is
also possible to display the item only for users having a specific role.

Example:
```
public function addMenuItems()
{
    Piwik_AddMenu(
        'CustomMenuName',
        'CustomSubmenuName',
        array('module' => 'MyPlugin', 'action' => 'index'),
        Piwik::isUserIsSuperUser(),
        $order = 6
    );
}
```

Usages:

[Actions::addMenus](https://github.com/piwik/piwik/blob/master/plugins/Actions/Actions.php#L565), [CustomVariables::addMenus](https://github.com/piwik/piwik/blob/master/plugins/CustomVariables/CustomVariables.php#L52), [Dashboard::addMenus](https://github.com/piwik/piwik/blob/master/plugins/Dashboard/Dashboard.php#L199), [DevicesDetection::addMenu](https://github.com/piwik/piwik/blob/master/plugins/DevicesDetection/DevicesDetection.php#L290), [ExampleUI::addMenus](https://github.com/piwik/piwik/blob/master/plugins/ExampleUI/ExampleUI.php#L29), [Goals::addMenus](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L453), [Live::addMenu](https://github.com/piwik/piwik/blob/master/plugins/Live/Live.php#L52), [Provider::addMenu](https://github.com/piwik/piwik/blob/master/plugins/Provider/Provider.php#L98), [Referrers::addMenus](https://github.com/piwik/piwik/blob/master/plugins/Referrers/Referrers.php#L230), [UserCountry::addMenu](https://github.com/piwik/piwik/blob/master/plugins/UserCountry/UserCountry.php#L187), [UserCountryMap::addMenu](https://github.com/piwik/piwik/blob/master/plugins/UserCountryMap/UserCountryMap.php#L64), [UserSettings::addMenu](https://github.com/piwik/piwik/blob/master/plugins/UserSettings/UserSettings.php#L428), [VisitFrequency::addMenu](https://github.com/piwik/piwik/blob/master/plugins/VisitFrequency/VisitFrequency.php#L65), [VisitTime::addMenu](https://github.com/piwik/piwik/blob/master/plugins/VisitTime/VisitTime.php#L88), [VisitorInterest::addMenu](https://github.com/piwik/piwik/blob/master/plugins/VisitorInterest/VisitorInterest.php#L110), [VisitsSummary::addMenu](https://github.com/piwik/piwik/blob/master/plugins/VisitsSummary/VisitsSummary.php#L68)


#### Menu.Top.addItems
_Defined in [Piwik/Menu/Top](https://github.com/piwik/piwik/blob/master/core/Menu/Top.php) in line [82](https://github.com/piwik/piwik/blob/master/core/Menu/Top.php#L82)_

This event is triggered to collect all available menu items that should be displayed on the very top next to login/logout, API and other menu items. Subscribe to this event if you want to add one or more items.
It's fairly easy. Just define the name of your menu item as well as a controller and an action that
should be executed once a user selects your menu item. It is also possible to display the item only for
users having a specific role.

Example:
```
public function addMenuItems()
{
    Piwik_AddTopMenu(
        'TopMenuName',
        array('module' => 'MyPlugin', 'action' => 'index'),
        Piwik::isUserIsSuperUser(),
        $order = 6
    );
}
```

Usages:

[Plugin::addTopMenu](https://github.com/piwik/piwik/blob/master/plugins/API/API.php#L663), [Dashboard::addTopMenu](https://github.com/piwik/piwik/blob/master/plugins/Dashboard/Dashboard.php#L217), [Feedback::addTopMenu](https://github.com/piwik/piwik/blob/master/plugins/Feedback/Feedback.php#L34), [LanguagesManager::showLanguagesSelector](https://github.com/piwik/piwik/blob/master/plugins/LanguagesManager/LanguagesManager.php#L55), [MultiSites::addTopMenu](https://github.com/piwik/piwik/blob/master/plugins/MultiSites/MultiSites.php#L76), [ScheduledReports::addTopMenu](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/ScheduledReports.php#L471), [Widgetize::addTopMenu](https://github.com/piwik/piwik/blob/master/plugins/Widgetize/Widgetize.php#L34)

## Provider

#### Provider.getCleanHostname
_Defined in [Piwik/Plugins/Provider/Provider](https://github.com/piwik/piwik/blob/master/plugins/Provider/Provider.php) in line [181](https://github.com/piwik/piwik/blob/master/plugins/Provider/Provider.php#L181)_

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

#### Reporting.getDatabaseConfig
_Defined in [Piwik/Db](https://github.com/piwik/piwik/blob/master/core/Db.php) in line [62](https://github.com/piwik/piwik/blob/master/core/Db.php#L62)_

This event is triggered before a connection to the database is established. Use it to dynamically change the
datatabase settings defined in the config. The reporting database config is used in case someone accesses
the Piwik UI.

Callback Signature:
<pre><code>function(&amp;$dbInfos)</code></pre>

## Request

#### Request.dispatch
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [133](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L133)_

Generic hook that plugins can use to modify any input to the function, or even change the plugin being called. You could also use this to build an enhanced permission system. The event is triggered before every
call to a controller method.

The `$params` array contains the following properties: `array($module, $action, $parameters, $controller)`

Callback Signature:
<pre><code>$params</code></pre>


#### Request.dispatch.end
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [157](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L157)_

Generic hook that plugins can use to modify any output of any controller method. The event is triggered
after a controller method is executed but before the result is send to the user. The parameters
originally passed to the method are available as well.

Callback Signature:
<pre><code>function(&amp;$result, $parameters)</code></pre>


#### Request.dispatchCoreAndPluginUpdatesScreen
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [333](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L333)_

This event is triggered after the platform is initialized and most plugins are loaded. The user is not
authenticated at this point though. You can use this event for instance to initialize your own plugin.

Usages:

[CoreUpdater::dispatch](https://github.com/piwik/piwik/blob/master/plugins/CoreUpdater/CoreUpdater.php#L56)


#### Request.initAuthenticationObject
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [348](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L348)_

This event is triggered shortly before the user is authenticated. Use it to create your own
authentication object instead of the Piwik authentication. Make sure to implement the `Piwik\Auth`
interface in case you want to define your own authentication.

Usages:

[Login::initAuthenticationObject](https://github.com/piwik/piwik/blob/master/plugins/Login/Login.php#L69)


#### Request.initAuthenticationObject
_Defined in [Piwik/Plugins/Overlay/API](https://github.com/piwik/piwik/blob/master/plugins/Overlay/API.php) in line [124](https://github.com/piwik/piwik/blob/master/plugins/Overlay/API.php#L124)_

This event is triggered shortly before the user is authenticated. Use it to create your own
authentication object instead of the Piwik authentication. Make sure to implement the `Piwik\Auth`
interface in case you want to define your own authentication.

Callback Signature:
<pre><code>function($allowCookieAuthentication = true)</code></pre>

Usages:

[Login::initAuthenticationObject](https://github.com/piwik/piwik/blob/master/plugins/Login/Login.php#L69)

## ScheduledReports

#### ScheduledReports.allowMultipleReports
_Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php) in line [736](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php#L736)_



Callback Signature:
<pre><code>function(&amp;$allowMultipleReports, $notificationInfo = function(self::REPORT_TYPE_INFO_KEY =&gt; $reportType))</code></pre>

Usages:

[MobileMessaging::allowMultipleReports](https://github.com/piwik/piwik/blob/master/plugins/MobileMessaging/MobileMessaging.php#L179), [ScheduledReports::allowMultipleReports](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/ScheduledReports.php#L257)


#### ScheduledReports.getRendererInstance
_Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php) in line [427](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php#L427)_



Callback Signature:
<pre><code>function(&amp;$reportRenderer, $notificationInfo)</code></pre>

Usages:

[MobileMessaging::getRendererInstance](https://github.com/piwik/piwik/blob/master/plugins/MobileMessaging/MobileMessaging.php#L166), [ScheduledReports::getRendererInstance](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/ScheduledReports.php#L243)


#### ScheduledReports.getReportFormats
_Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php) in line [766](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php#L766)_



Callback Signature:
<pre><code>function(&amp;$reportFormats, $notificationInfo = function(self::REPORT_TYPE_INFO_KEY =&gt; $reportType))</code></pre>

Usages:

[MobileMessaging::getReportFormats](https://github.com/piwik/piwik/blob/master/plugins/MobileMessaging/MobileMessaging.php#L152), [ScheduledReports::getReportFormats](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/ScheduledReports.php#L188)


#### ScheduledReports.getReportMetadata
_Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php) in line [722](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php#L722)_



Callback Signature:
<pre><code>function(&amp;$availableReportMetadata, $notificationInfo)</code></pre>

Usages:

[MobileMessaging::getReportMetadata](https://github.com/piwik/piwik/blob/master/plugins/MobileMessaging/MobileMessaging.php#L127), [ScheduledReports::getReportMetadata](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/ScheduledReports.php#L161)


#### ScheduledReports.getReportParameters
_Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php) in line [590](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php#L590)_



Callback Signature:
<pre><code>function(&amp;$availableParameters, $notificationInfo)</code></pre>

Usages:

[MobileMessaging::getReportParameters](https://github.com/piwik/piwik/blob/master/plugins/MobileMessaging/MobileMessaging.php#L159), [ScheduledReports::getReportParameters](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/ScheduledReports.php#L195)


#### ScheduledReports.getReportRecipients
_Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php) in line [793](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php#L793)_



Callback Signature:
<pre><code>function(&amp;$recipients, $notificationInfo)</code></pre>

Usages:

[MobileMessaging::getReportRecipients](https://github.com/piwik/piwik/blob/master/plugins/MobileMessaging/MobileMessaging.php#L186), [ScheduledReports::getReportRecipients](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/ScheduledReports.php#L387)


#### ScheduledReports.getReportTypes
_Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php) in line [754](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php#L754)_



Callback Signature:
<pre><code>function(&amp;$reportTypes)</code></pre>

Usages:

[MobileMessaging::getReportTypes](https://github.com/piwik/piwik/blob/master/plugins/MobileMessaging/MobileMessaging.php#L147), [ScheduledReports::getReportTypes](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/ScheduledReports.php#L183)


#### ScheduledReports.processReports
_Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php) in line [418](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php#L418)_

This event allows plugins to alter processed reports.

Callback Signature:
<pre><code>function(&amp;$processedReports, $notificationInfo)</code></pre>

Usages:

[ScheduledReports::processReports](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/ScheduledReports.php#L202)


#### ScheduledReports.sendReport
_Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php) in line [538](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php#L538)_



Callback Signature:
<pre><code>function($notificationInfo = function(self::REPORT_TYPE_INFO_KEY =&gt; $report[&#039;type&#039;], self::REPORT_KEY =&gt; $report, self::REPORT_CONTENT_KEY =&gt; $contents, self::FILENAME_KEY =&gt; $filename, self::PRETTY_DATE_KEY =&gt; $prettyDate, self::REPORT_SUBJECT_KEY =&gt; $reportSubject, self::REPORT_TITLE_KEY =&gt; $reportTitle, self::ADDITIONAL_FILES_KEY =&gt; $additionalFiles))</code></pre>

Usages:

[MobileMessaging::sendReport](https://github.com/piwik/piwik/blob/master/plugins/MobileMessaging/MobileMessaging.php#L194), [ScheduledReports::sendReport](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/ScheduledReports.php#L264)


#### ScheduledReports.validateReportParameters
_Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php) in line [610](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php#L610)_

This event is triggered to delegate report parameter validation.

Callback Signature:
<pre><code>function(&amp;$parameters, $notificationInfo)</code></pre>

Usages:

[MobileMessaging::validateReportParameters](https://github.com/piwik/piwik/blob/master/plugins/MobileMessaging/MobileMessaging.php#L108), [ScheduledReports::validateReportParameters](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/ScheduledReports.php#L119)

## Schema

#### Schema.loadSchema
_Defined in [Piwik/Db/Schema](https://github.com/piwik/piwik/blob/master/core/Db/Schema.php) in line [137](https://github.com/piwik/piwik/blob/master/core/Db/Schema.php#L137)_



Callback Signature:
<pre><code>function(&amp;$schema)</code></pre>

## SegmentEditor

#### SegmentEditor.deactivate
_Defined in [Piwik/Plugins/SegmentEditor/API](https://github.com/piwik/piwik/blob/master/plugins/SegmentEditor/API.php) in line [317](https://github.com/piwik/piwik/blob/master/plugins/SegmentEditor/API.php#L317)_

This event is triggered when a segment is deleted or made invisible. It allows plugins to throw an exception
or to propagate the action.

Callback Signature:
<pre><code>function(&amp;$idSegment)</code></pre>

Usages:

[ScheduledReports::segmentDeactivation](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/ScheduledReports.php#L453)

## Segments

#### Segments.getKnownSegmentsToArchiveAllSites
_Defined in [Piwik/SettingsPiwik](https://github.com/piwik/piwik/blob/master/core/SettingsPiwik.php) in line [68](https://github.com/piwik/piwik/blob/master/core/SettingsPiwik.php#L68)_



Callback Signature:
<pre><code>function(&amp;$cachedResult)</code></pre>

Usages:

[SegmentEditor::getKnownSegmentsToArchiveAllSites](https://github.com/piwik/piwik/blob/master/plugins/SegmentEditor/SegmentEditor.php#L56)


#### Segments.getKnownSegmentsToArchiveForSite
_Defined in [Piwik/SettingsPiwik](https://github.com/piwik/piwik/blob/master/core/SettingsPiwik.php) in line [84](https://github.com/piwik/piwik/blob/master/core/SettingsPiwik.php#L84)_



Callback Signature:
<pre><code>function(&amp;$segments, $idSite)</code></pre>

Usages:

[SegmentEditor::getKnownSegmentsToArchiveForSite](https://github.com/piwik/piwik/blob/master/plugins/SegmentEditor/SegmentEditor.php#L64)

## Site

#### Site.getSiteAttributes
_Defined in [Piwik/Tracker/Cache](https://github.com/piwik/piwik/blob/master/core/Tracker/Cache.php) in line [68](https://github.com/piwik/piwik/blob/master/core/Tracker/Cache.php#L68)_

This hook is called to get the details of a specific site depending on the id. You can use this to add any
custom attributes to the website.

Callback Signature:
<pre><code>function(&amp;$content, $idSite)</code></pre>

Usages:

[Goals::fetchGoalsFromDb](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L423), [SitesManager::recordWebsiteDataInCache](https://github.com/piwik/piwik/blob/master/plugins/SitesManager/SitesManager.php#L72), [UsersManager::recordAdminUsersInCache](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/UsersManager.php#L52)

## SitesManager

#### SitesManager.deleteSite.end
_Defined in [Piwik/Plugins/SitesManager/API](https://github.com/piwik/piwik/blob/master/plugins/SitesManager/API.php) in line [602](https://github.com/piwik/piwik/blob/master/plugins/SitesManager/API.php#L602)_

This event is triggered after a site has been deleted. Plugins can use this event to remove site specific
values or settings. For instance removing all goals that belong to a specific website. If you store any data
related to a website you may want to clean up that information.

Callback Signature:
<pre><code>function($idSite)</code></pre>

Usages:

[Goals::deleteSiteGoals](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L110), [ScheduledReports::deleteSiteReport](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/ScheduledReports.php#L104), [UsersManager::deleteSite](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/UsersManager.php#L67)

## TaskScheduler

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

[CoreAdminHome::getScheduledTasks](https://github.com/piwik/piwik/blob/master/plugins/CoreAdminHome/CoreAdminHome.php#L40), [CorePluginsAdmin::getScheduledTasks](https://github.com/piwik/piwik/blob/master/plugins/CorePluginsAdmin/CorePluginsAdmin.php#L40), [DBStats::getScheduledTasks](https://github.com/piwik/piwik/blob/master/plugins/DBStats/DBStats.php#L52), [PrivacyManager::getScheduledTasks](https://github.com/piwik/piwik/blob/master/plugins/PrivacyManager/PrivacyManager.php#L76), [ScheduledReports::getScheduledTasks](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/ScheduledReports.php#L426), [UserCountry::getScheduledTasks](https://github.com/piwik/piwik/blob/master/plugins/UserCountry/UserCountry.php#L65)

## Tracker

#### Tracker.detectReferrerSearchEngine
_Defined in [Piwik/Tracker/Referrer](https://github.com/piwik/piwik/blob/master/core/Tracker/Referrer.php) in line [135](https://github.com/piwik/piwik/blob/master/core/Tracker/Referrer.php#L135)_

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
_Defined in [Piwik/Tracker/VisitExcluded](https://github.com/piwik/piwik/blob/master/core/Tracker/VisitExcluded.php) in line [78](https://github.com/piwik/piwik/blob/master/core/Tracker/VisitExcluded.php#L78)_

At every page view, this event will be called. It is useful for plugins that want to exclude specific visits
(ie. IP excluding, Cookie excluding). If you set `$excluded` to `true`, the visit will be excluded.

Callback Signature:
<pre><code>function(&amp;$excluded)</code></pre>

Usages:

[DoNotTrack::checkHeader](https://github.com/piwik/piwik/blob/master/plugins/DoNotTrack/DoNotTrack.php#L36)


#### Tracker.knownVisitorInformation
_Defined in [Piwik/Tracker/Visit](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php) in line [357](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php#L357)_

After a known visitor is saved and updated by Piwik, this event is called. Useful for plugins that want to
register information about a returning visitor, or filter the existing information.

Callback Signature:
<pre><code>function(&amp;$this-&gt;visitorInfo)</code></pre>


#### Tracker.knownVisitorUpdate
_Defined in [Piwik/Tracker/Visit](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php) in line [312](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php#L312)_

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
_Defined in [Piwik/Tracker/Visit](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php) in line [479](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php#L479)_

Before a new visitor is saved by Piwik, this event is called. Useful for plugins that want to register
new information about a visitor, or filter the existing information. `$extraInfo` contains the UserAgent.
You can for instance change the user's location country depending on the User Agent.

Callback Signature:
<pre><code>function(&amp;$this-&gt;visitorInfo, $extraInfo)</code></pre>

Usages:

[DevicesDetection::parseMobileVisitData](https://github.com/piwik/piwik/blob/master/plugins/DevicesDetection/DevicesDetection.php#L251), [Provider::logProviderInfo](https://github.com/piwik/piwik/blob/master/plugins/Provider/Provider.php#L112), [UserCountry::getVisitorLocation](https://github.com/piwik/piwik/blob/master/plugins/UserCountry/UserCountry.php#L81)


#### Tracker.recordAction
_Defined in [Piwik/Tracker/Action](https://github.com/piwik/piwik/blob/master/core/Tracker/Action.php) in line [647](https://github.com/piwik/piwik/blob/master/core/Tracker/Action.php#L647)_

This hook is called after saving (and updating) visitor information. You can use it for instance to sync the
recorded action with third party systems.

Callback Signature:
<pre><code>function($trackerAction = $this, $info)</code></pre>


#### Tracker.recordEcommerceGoal
_Defined in [Piwik/Tracker/GoalManager](https://github.com/piwik/piwik/blob/master/core/Tracker/GoalManager.php) in line [412](https://github.com/piwik/piwik/blob/master/core/Tracker/GoalManager.php#L412)_

This hook is called after recording an ecommerce goal. You can use it for instance to sync the recorded goal
with third party systems. `$goal` contains all available information like `items` and `revenue`.

Callback Signature:
<pre><code>function($goal)</code></pre>


#### Tracker.recordStandardGoals
_Defined in [Piwik/Tracker/GoalManager](https://github.com/piwik/piwik/blob/master/core/Tracker/GoalManager.php) in line [777](https://github.com/piwik/piwik/blob/master/core/Tracker/GoalManager.php#L777)_

This hook is called after recording a standard goal. You can use it for instance to sync the recorded
goal with third party systems. `$goal` contains all available information like `url` and `revenue`.

Callback Signature:
<pre><code>function($newGoal)</code></pre>


#### Tracker.setSiteId
_Defined in [Piwik/Tracker/Request](https://github.com/piwik/piwik/blob/master/core/Tracker/Request.php) in line [300](https://github.com/piwik/piwik/blob/master/core/Tracker/Request.php#L300)_

This event allows a plugin to set/change the idsite in the tracking request. Note: A modified idSite has to
be higher than `0`, otherwise an exception will be triggered. By default the idSite is specified on the URL
parameter `idsite`.

Callback Signature:
<pre><code>function(&amp;$idSite, $this-&gt;params)</code></pre>


#### Tracker.setTrackerCacheGeneral
_Defined in [Piwik/Tracker/Cache](https://github.com/piwik/piwik/blob/master/core/Tracker/Cache.php) in line [116](https://github.com/piwik/piwik/blob/master/core/Tracker/Cache.php#L116)_

This event is triggered to add any custom content to the Tracker cache. You may want to cache any tracker
data that is expensive to re-calculate on each tracking request.

Callback Signature:
<pre><code>function(&amp;$cacheContent)</code></pre>

Usages:

[UserCountry::setTrackerCacheGeneral](https://github.com/piwik/piwik/blob/master/plugins/UserCountry/UserCountry.php#L60)


#### Tracker.setVisitorIp
_Defined in [Piwik/Tracker/Visit](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php) in line [98](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php#L98)_

This event can be used for instance to anonymize the IP (after testing for IP exclusion).

Callback Signature:
<pre><code>function(&amp;$this-&gt;visitorInfo[&#039;location_ip&#039;])</code></pre>

Usages:

[AnonymizeIP::setVisitorIpAddress](https://github.com/piwik/piwik/blob/master/plugins/AnonymizeIP/AnonymizeIP.php#L82)

## Translate

#### Translate.getClientSideTranslationKeys
_Defined in [Piwik/Translate](https://github.com/piwik/piwik/blob/master/core/Translate.php) in line [191](https://github.com/piwik/piwik/blob/master/core/Translate.php#L191)_

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

[CoreHome::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/master/plugins/CoreHome/CoreHome.php#L93), [CorePluginsAdmin::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/master/plugins/CorePluginsAdmin/CorePluginsAdmin.php#L97), [CoreVisualizations::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/master/plugins/CoreVisualizations/CoreVisualizations.php#L64), [Dashboard::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/master/plugins/Dashboard/Dashboard.php#L277), [Feedback::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/master/plugins/Feedback/Feedback.php#L56), [Goals::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L643), [Live::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/master/plugins/Live/Live.php#L65), [Overlay::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/master/plugins/Overlay/Overlay.php#L46), [SitesManager::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/master/plugins/SitesManager/SitesManager.php#L211), [Transitions::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/master/plugins/Transitions/Transitions.php#L41), [UserCountry::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/master/plugins/UserCountry/UserCountry.php#L491), [UsersManager::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/UsersManager.php#L138), [Widgetize::getClientSideTranslationKeys](https://github.com/piwik/piwik/blob/master/plugins/Widgetize/Widgetize.php#L61)

## Updater

#### Updater.checkForUpdates
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [374](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L374)_

This event is triggered to check for updates. It is triggered after the platform is initialized and after
the user is authenticated but before the platform is going to dispatch the actual request. You can use
it to check for any updates.

Usages:

[CoreUpdater::updateCheck](https://github.com/piwik/piwik/blob/master/plugins/CoreUpdater/CoreUpdater.php#L83)

## User

#### User.getLanguage
_Defined in [Piwik/Translate](https://github.com/piwik/piwik/blob/master/core/Translate.php) in line [122](https://github.com/piwik/piwik/blob/master/core/Translate.php#L122)_

This event is triggered to identify the language code, such as 'en', for the current user. You can use
it for instance to detect the users language by using a third party API such as a CMS. The language that
is set in the request URL is passed as an argument.

Callback Signature:
<pre><code>function(&amp;$lang)</code></pre>

Usages:

[LanguagesManager::getLanguageToLoad](https://github.com/piwik/piwik/blob/master/plugins/LanguagesManager/LanguagesManager.php#L87)


#### User.isNotAuthorized
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [168](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L168)_

This event is triggered in case the user wants to access anything in the Piwik UI but has not the required permissions to do this. You can subscribe to this event to display a custom error message or
to display a custom login form in such a case.

Callback Signature:
<pre><code>function($exception)</code></pre>

Usages:

[Login::noAccess](https://github.com/piwik/piwik/blob/master/plugins/Login/Login.php#L47)

## UsersManager

#### UsersManager.addUser.end
_Defined in [Piwik/Plugins/UsersManager/API](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/API.php) in line [405](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/API.php#L405)_

This event is triggered after a new user is created and saved in the database. `$userLogin` contains all
relevant user information like login name, alias, email and transformed password.

Callback Signature:
<pre><code>function($userLogin)</code></pre>


#### UsersManager.deleteUser
_Defined in [Piwik/Plugins/UsersManager/API](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/API.php) in line [657](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/API.php#L657)_

This event is triggered after a user has been deleted. Plugins can use this event to remove user specific
values or settings. For instance removing all created dashboards that belong to a specific user.
If you store any data related to a user, you may want to clean up that information.

Callback Signature:
<pre><code>function($userLogin)</code></pre>

Usages:

[Dashboard::deleteDashboardLayout](https://github.com/piwik/piwik/blob/master/plugins/Dashboard/Dashboard.php#L246), [LanguagesManager::deleteUserLanguage](https://github.com/piwik/piwik/blob/master/plugins/LanguagesManager/LanguagesManager.php#L97), [ScheduledReports::deleteUserReport](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/ScheduledReports.php#L522)


#### UsersManager.updateUser.end
_Defined in [Piwik/Plugins/UsersManager/API](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/API.php) in line [466](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/API.php#L466)_

This event is triggered after an existing user has been updated. `$userLogin` contains the updated user
information like login name, alias and email.

Callback Signature:
<pre><code>function($userLogin)</code></pre>

## Visualization

#### Visualization.addVisualizations
_Defined in [Piwik/ViewDataTable/Visualization](https://github.com/piwik/piwik/blob/master/core/ViewDataTable/Visualization.php) in line [157](https://github.com/piwik/piwik/blob/master/core/ViewDataTable/Visualization.php#L157)_

This event is used to gather all available DataTable visualizations. Callbacks should add visualization
class names to the incoming array.

Callback Signature:
<pre><code>function(&amp;$visualizations)</code></pre>

Usages:

[CoreVisualizations::getAvailableDataTableVisualizations](https://github.com/piwik/piwik/blob/master/plugins/CoreVisualizations/CoreVisualizations.php#L38)


#### Visualization.configureFooterIcons
_Defined in [Piwik/ViewDataTable](https://github.com/piwik/piwik/blob/master/core/ViewDataTable.php) in line [1302](https://github.com/piwik/piwik/blob/master/core/ViewDataTable.php#L1302)_

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
_Defined in [Piwik/ViewDataTable](https://github.com/piwik/piwik/blob/master/core/ViewDataTable.php) in line [444](https://github.com/piwik/piwik/blob/master/core/ViewDataTable.php#L444)_

This event is triggered to gather the report display properties for each available report. If you define
your own report, you want to subscribe to this event to define how your report shall be displayed in the
Piwik UI.

Example:
```
public function getReportDisplayProperties(&$properties)
{
    $properties['Provider.getProvider'] = array(
        'translations' => array('label' => Piwik_Translate('Provider_ColumnProvider')),
        'filter_limit' => 5
    )
}
```

Callback Signature:
<pre><code>function(&amp;self::$reportPropertiesCache)</code></pre>

Usages:

[Actions::getReportDisplayProperties](https://github.com/piwik/piwik/blob/master/plugins/Actions/Actions.php#L644), [CustomVariables::getReportDisplayProperties](https://github.com/piwik/piwik/blob/master/plugins/CustomVariables/CustomVariables.php#L155), [DBStats::getReportDisplayProperties](https://github.com/piwik/piwik/blob/master/plugins/DBStats/DBStats.php#L89), [DevicesDetection::getReportDisplayProperties](https://github.com/piwik/piwik/blob/master/plugins/DevicesDetection/DevicesDetection.php#L295), [Goals::getReportDisplayProperties](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L519), [Live::getReportDisplayProperties](https://github.com/piwik/piwik/blob/master/plugins/Live/Live.php#L74), [Provider::getReportDisplayProperties](https://github.com/piwik/piwik/blob/master/plugins/Provider/Provider.php#L236), [Referrers::getReportDisplayProperties](https://github.com/piwik/piwik/blob/master/plugins/Referrers/Referrers.php#L296), [UserCountry::getReportDisplayProperties](https://github.com/piwik/piwik/blob/master/plugins/UserCountry/UserCountry.php#L364), [UserSettings::getReportDisplayProperties](https://github.com/piwik/piwik/blob/master/plugins/UserSettings/UserSettings.php#L177), [VisitTime::getReportDisplayProperties](https://github.com/piwik/piwik/blob/master/plugins/VisitTime/VisitTime.php#L123), [VisitorInterest::getReportDisplayProperties](https://github.com/piwik/piwik/blob/master/plugins/VisitorInterest/VisitorInterest.php#L152)


#### Visualization.initView
_Defined in [Piwik/ViewDataTable](https://github.com/piwik/piwik/blob/master/core/ViewDataTable.php) in line [1109](https://github.com/piwik/piwik/blob/master/core/ViewDataTable.php#L1109)_

This event is called before a visualization is created. Plugins can use this event to
override view properties for individual reports or visualizations.

Themes can use this event to make sure reports look nice with their themes. Plugins
that provide new visualizations can use this event to make sure certain reports
are configured differently when viewed with the new visualization.

Callback Signature:
<pre><code>function($viewDataTable = $this)</code></pre>

## WidgetsList

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

[Actions::addWidgets](https://github.com/piwik/piwik/blob/master/plugins/Actions/Actions.php#L542), [CoreHome::addWidgets](https://github.com/piwik/piwik/blob/master/plugins/CoreHome/CoreHome.php#L37), [CustomVariables::addWidgets](https://github.com/piwik/piwik/blob/master/plugins/CustomVariables/CustomVariables.php#L47), [DevicesDetection::addWidgets](https://github.com/piwik/piwik/blob/master/plugins/DevicesDetection/DevicesDetection.php#L168), [ExamplePlugin::addWidgets](https://github.com/piwik/piwik/blob/master/plugins/ExamplePlugin/ExamplePlugin.php#L52), [ExampleRssWidget::addWidgets](https://github.com/piwik/piwik/blob/master/plugins/ExampleRssWidget/ExampleRssWidget.php#L37), [Goals::addWidgets](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L429), [Live::addWidget](https://github.com/piwik/piwik/blob/master/plugins/Live/Live.php#L57), [Provider::addWidget](https://github.com/piwik/piwik/blob/master/plugins/Provider/Provider.php#L93), [Referrers::addWidgets](https://github.com/piwik/piwik/blob/master/plugins/Referrers/Referrers.php#L213), [SEO::addWidgets](https://github.com/piwik/piwik/blob/master/plugins/SEO/SEO.php#L43), [UserCountry::addWidgets](https://github.com/piwik/piwik/blob/master/plugins/UserCountry/UserCountry.php#L170), [UserSettings::addWidgets](https://github.com/piwik/piwik/blob/master/plugins/UserSettings/UserSettings.php#L415), [VisitFrequency::addWidgets](https://github.com/piwik/piwik/blob/master/plugins/VisitFrequency/VisitFrequency.php#L59), [VisitTime::addWidgets](https://github.com/piwik/piwik/blob/master/plugins/VisitTime/VisitTime.php#L81), [VisitorInterest::addWidgets](https://github.com/piwik/piwik/blob/master/plugins/VisitorInterest/VisitorInterest.php#L102), [VisitsSummary::addWidgets](https://github.com/piwik/piwik/blob/master/plugins/VisitsSummary/VisitsSummary.php#L61)

