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
- [Installation](#installation)
- [Live::GET_EXTRA_VISITOR_DETAILS_EVENT](#live::get_extra_visitor_details_event)
- [Log](#log)
- [LogDataPurger](#logdatapurger)
- [Login](#login)
- [Menu](#menu)
- [PDFReports](#pdfreports)
- [Provider](#provider)
- [Reporting](#reporting)
- [Request](#request)
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
_Defined in [Piwik/API/Proxy](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php) in line [188](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php#L188)_



Callback Signature:
<pre><code>function(&amp;$finalParameters)</code></pre>


#### API.$pluginName.$methodName.end
_Defined in [Piwik/API/Proxy](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php) in line [200](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php#L200)_



Callback Signature:
<pre><code>$endHookParams</code></pre>


#### API.getReportMetadata
_Defined in [Piwik/Plugins/API/ProcessedReport](https://github.com/piwik/piwik/blob/master/plugins/API/ProcessedReport.php) in line [87](https://github.com/piwik/piwik/blob/master/plugins/API/ProcessedReport.php#L87)_



Callback Signature:
<pre><code>function(&amp;$availableReports, $parameters)</code></pre>


#### API.getReportMetadata.end
_Defined in [Piwik/Plugins/API/ProcessedReport](https://github.com/piwik/piwik/blob/master/plugins/API/ProcessedReport.php) in line [106](https://github.com/piwik/piwik/blob/master/plugins/API/ProcessedReport.php#L106)_



Callback Signature:
<pre><code>function(&amp;$availableReports, $parameters)</code></pre>


#### API.getSegmentsMetadata
_Defined in [Piwik/Plugins/API/API](https://github.com/piwik/piwik/blob/master/plugins/API/API.php) in line [97](https://github.com/piwik/piwik/blob/master/plugins/API/API.php#L97)_



Callback Signature:
<pre><code>function(&amp;$segments, $idSites)</code></pre>


#### API.Request.authenticate
_Defined in [Piwik/API/Request](https://github.com/piwik/piwik/blob/master/core/API/Request.php) in line [182](https://github.com/piwik/piwik/blob/master/core/API/Request.php#L182)_



Callback Signature:
<pre><code>function($token_auth)</code></pre>


#### API.Request.dispatch
_Defined in [Piwik/API/Proxy](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php) in line [187](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php#L187)_



Callback Signature:
<pre><code>function(&amp;$finalParameters)</code></pre>


#### API.Request.dispatch.end
_Defined in [Piwik/API/Proxy](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php) in line [201](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php#L201)_



Callback Signature:
<pre><code>$endHookParams</code></pre>

## ArchiveProcessor

#### ArchiveProcessor.Day.compute
_Defined in [Piwik/ArchiveProcessor/Day](https://github.com/piwik/piwik/blob/master/core/ArchiveProcessor/Day.php) in line [105](https://github.com/piwik/piwik/blob/master/core/ArchiveProcessor/Day.php#L105)_



Callback Signature:
<pre><code>function(&amp;$this)</code></pre>


#### ArchiveProcessor.Period.compute
_Defined in [Piwik/ArchiveProcessor/Period](https://github.com/piwik/piwik/blob/master/core/ArchiveProcessor/Period.php) in line [187](https://github.com/piwik/piwik/blob/master/core/ArchiveProcessor/Period.php#L187)_



Callback Signature:
<pre><code>function(&amp;$this)</code></pre>

## AssetManager

#### AssetManager.filterMergedJavaScripts
_Defined in [Piwik/AssetManager](https://github.com/piwik/piwik/blob/master/core/AssetManager.php) in line [357](https://github.com/piwik/piwik/blob/master/core/AssetManager.php#L357)_



Callback Signature:
<pre><code>function(&amp;$mergedContent)</code></pre>


#### AssetManager.filterMergedStylesheets
_Defined in [Piwik/AssetManager](https://github.com/piwik/piwik/blob/master/core/AssetManager.php) in line [163](https://github.com/piwik/piwik/blob/master/core/AssetManager.php#L163)_



Callback Signature:
<pre><code>function(&amp;$mergedContent)</code></pre>


#### AssetManager.getJavaScriptFiles
_Defined in [Piwik/AssetManager](https://github.com/piwik/piwik/blob/master/core/AssetManager.php) in line [387](https://github.com/piwik/piwik/blob/master/core/AssetManager.php#L387)_



Callback Signature:
<pre><code>function(&amp;$jsFiles)</code></pre>


#### AssetManager.getStylesheetFiles
_Defined in [Piwik/AssetManager](https://github.com/piwik/piwik/blob/master/core/AssetManager.php) in line [282](https://github.com/piwik/piwik/blob/master/core/AssetManager.php#L282)_



Callback Signature:
<pre><code>function(&amp;$stylesheets)</code></pre>

## Config

#### Config.badConfigurationFile
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [274](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L274)_



Callback Signature:
<pre><code>function($e)</code></pre>


#### Config.NoConfigurationFile
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [207](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L207)_



Callback Signature:
<pre><code>function($e)</code></pre>

## Controller

#### Controller.$module.$action
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [123](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L123)_



Callback Signature:
<pre><code>function($parameters)</code></pre>


#### Controller.$module.$action.end
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [127](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L127)_



Callback Signature:
<pre><code>function(&amp;$result, $parameters)</code></pre>

## Goals

#### Goals.getReportsWithGoalMetrics
_Defined in [Piwik/Plugins/Goals/Goals](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php) in line [39](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L39)_



Callback Signature:
<pre><code>function(&amp;$dimensions)</code></pre>


#### Goals.getReportsWithGoalMetrics
_Defined in [Piwik/Plugins/Goals/Goals](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php) in line [343](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L343)_



Callback Signature:
<pre><code>function(&amp;$reportsWithGoals)</code></pre>

## Installation

#### Installation.startInstallation
_Defined in [Piwik/Plugins/Installation/Installation](https://github.com/piwik/piwik/blob/master/plugins/Installation/Installation.php) in line [62](https://github.com/piwik/piwik/blob/master/plugins/Installation/Installation.php#L62)_



Callback Signature:
<pre><code>function($this)</code></pre>

## Live::GET_EXTRA_VISITOR_DETAILS_EVENT

#### Live::GET_EXTRA_VISITOR_DETAILS_EVENT
_Defined in [Piwik/Plugins/Live/API](https://github.com/piwik/piwik/blob/master/plugins/Live/API.php) in line [360](https://github.com/piwik/piwik/blob/master/plugins/Live/API.php#L360)_



Callback Signature:
<pre><code>function(&amp;$result)</code></pre>

## Log

#### Log.formatDatabaseMessage
_Defined in [Piwik/Log](https://github.com/piwik/piwik/blob/master/core/Log.php) in line [361](https://github.com/piwik/piwik/blob/master/core/Log.php#L361)_



Callback Signature:
<pre><code>function(&amp;$message, $level, $tag, $datetime, $this)</code></pre>


#### Log.formatFileMessage
_Defined in [Piwik/Log](https://github.com/piwik/piwik/blob/master/core/Log.php) in line [316](https://github.com/piwik/piwik/blob/master/core/Log.php#L316)_



Callback Signature:
<pre><code>function(&amp;$message, $level, $tag, $datetime, $this)</code></pre>


#### Log.formatScreenMessage
_Defined in [Piwik/Log](https://github.com/piwik/piwik/blob/master/core/Log.php) in line [346](https://github.com/piwik/piwik/blob/master/core/Log.php#L346)_



Callback Signature:
<pre><code>function(&amp;$message, $level, $tag, $datetime, $this)</code></pre>

## LogDataPurger

#### LogDataPurger.ActionsToKeepInserted.newerThan
_Defined in [Piwik/Plugins/PrivacyManager/LogDataPurger](https://github.com/piwik/piwik/blob/master/plugins/PrivacyManager/LogDataPurger.php) in line [231](https://github.com/piwik/piwik/blob/master/plugins/PrivacyManager/LogDataPurger.php#L231)_




#### LogDataPurger.ActionsToKeepInserted.olderThan
_Defined in [Piwik/Plugins/PrivacyManager/LogDataPurger](https://github.com/piwik/piwik/blob/master/plugins/PrivacyManager/LogDataPurger.php) in line [229](https://github.com/piwik/piwik/blob/master/plugins/PrivacyManager/LogDataPurger.php#L229)_



## Login

#### Login.initSession
_Defined in [Piwik/Plugins/Login/Controller](https://github.com/piwik/piwik/blob/master/plugins/Login/Controller.php) in line [172](https://github.com/piwik/piwik/blob/master/plugins/Login/Controller.php#L172)_



Callback Signature:
<pre><code>function(&amp;$info)</code></pre>


#### Login.initSession
_Defined in [Piwik/Plugins/UsersManager/Controller](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/Controller.php) in line [325](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/Controller.php#L325)_



Callback Signature:
<pre><code>function($info)</code></pre>

## Menu

#### Menu.Admin.addItems
_Defined in [Piwik/Menu/Admin](https://github.com/piwik/piwik/blob/master/core/Menu/Admin.php) in line [42](https://github.com/piwik/piwik/blob/master/core/Menu/Admin.php#L42)_




#### Menu.Reporting.addItems
_Defined in [Piwik/Menu/Main](https://github.com/piwik/piwik/blob/master/core/Menu/Main.php) in line [62](https://github.com/piwik/piwik/blob/master/core/Menu/Main.php#L62)_




#### Menu.Top.addItems
_Defined in [Piwik/Menu/Top](https://github.com/piwik/piwik/blob/master/core/Menu/Top.php) in line [62](https://github.com/piwik/piwik/blob/master/core/Menu/Top.php#L62)_



## PDFReports

#### PDFReports.allowMultipleReports
_Defined in [Piwik/Plugins/PDFReports/API](https://github.com/piwik/piwik/blob/master/plugins/PDFReports/API.php) in line [728](https://github.com/piwik/piwik/blob/master/plugins/PDFReports/API.php#L728)_



Callback Signature:
<pre><code>function(&amp;$allowMultipleReports, $notificationInfo = function(self::REPORT_TYPE_INFO_KEY =&gt; $reportType))</code></pre>


#### PDFReports.getRendererInstance
_Defined in [Piwik/Plugins/PDFReports/API](https://github.com/piwik/piwik/blob/master/plugins/PDFReports/API.php) in line [423](https://github.com/piwik/piwik/blob/master/plugins/PDFReports/API.php#L423)_



Callback Signature:
<pre><code>function(&amp;$reportRenderer, $notificationInfo)</code></pre>


#### PDFReports.getReportFormats
_Defined in [Piwik/Plugins/PDFReports/API](https://github.com/piwik/piwik/blob/master/plugins/PDFReports/API.php) in line [758](https://github.com/piwik/piwik/blob/master/plugins/PDFReports/API.php#L758)_



Callback Signature:
<pre><code>function(&amp;$reportFormats, $notificationInfo = function(self::REPORT_TYPE_INFO_KEY =&gt; $reportType))</code></pre>


#### PDFReports.getReportMetadata
_Defined in [Piwik/Plugins/PDFReports/API](https://github.com/piwik/piwik/blob/master/plugins/PDFReports/API.php) in line [714](https://github.com/piwik/piwik/blob/master/plugins/PDFReports/API.php#L714)_



Callback Signature:
<pre><code>function(&amp;$availableReportMetadata, $notificationInfo)</code></pre>


#### PDFReports.getReportParameters
_Defined in [Piwik/Plugins/PDFReports/API](https://github.com/piwik/piwik/blob/master/plugins/PDFReports/API.php) in line [586](https://github.com/piwik/piwik/blob/master/plugins/PDFReports/API.php#L586)_



Callback Signature:
<pre><code>function(&amp;$availableParameters, $notificationInfo)</code></pre>


#### PDFReports.getReportRecipients
_Defined in [Piwik/Plugins/PDFReports/API](https://github.com/piwik/piwik/blob/master/plugins/PDFReports/API.php) in line [783](https://github.com/piwik/piwik/blob/master/plugins/PDFReports/API.php#L783)_



Callback Signature:
<pre><code>function(&amp;$recipients, $notificationInfo)</code></pre>


#### PDFReports.getReportTypes
_Defined in [Piwik/Plugins/PDFReports/API](https://github.com/piwik/piwik/blob/master/plugins/PDFReports/API.php) in line [746](https://github.com/piwik/piwik/blob/master/plugins/PDFReports/API.php#L746)_



Callback Signature:
<pre><code>function(&amp;$reportTypes)</code></pre>


#### PDFReports.processReports
_Defined in [Piwik/Plugins/PDFReports/API](https://github.com/piwik/piwik/blob/master/plugins/PDFReports/API.php) in line [416](https://github.com/piwik/piwik/blob/master/plugins/PDFReports/API.php#L416)_



Callback Signature:
<pre><code>function(&amp;$processedReports, $notificationInfo)</code></pre>


#### PDFReports.sendReport
_Defined in [Piwik/Plugins/PDFReports/API](https://github.com/piwik/piwik/blob/master/plugins/PDFReports/API.php) in line [534](https://github.com/piwik/piwik/blob/master/plugins/PDFReports/API.php#L534)_



Callback Signature:
<pre><code>function($notificationInfo = function(self::REPORT_TYPE_INFO_KEY =&gt; $report[&#039;type&#039;], self::REPORT_KEY =&gt; $report, self::REPORT_CONTENT_KEY =&gt; $contents, self::FILENAME_KEY =&gt; $filename, self::PRETTY_DATE_KEY =&gt; $prettyDate, self::REPORT_SUBJECT_KEY =&gt; $reportSubject, self::REPORT_TITLE_KEY =&gt; $reportTitle, self::ADDITIONAL_FILES_KEY =&gt; $additionalFiles))</code></pre>


#### PDFReports.validateReportParameters
_Defined in [Piwik/Plugins/PDFReports/API](https://github.com/piwik/piwik/blob/master/plugins/PDFReports/API.php) in line [604](https://github.com/piwik/piwik/blob/master/plugins/PDFReports/API.php#L604)_



Callback Signature:
<pre><code>function(&amp;$parameters, $notificationInfo)</code></pre>

## Provider

#### Provider.getCleanHostname
_Defined in [Piwik/Plugins/Provider/Provider](https://github.com/piwik/piwik/blob/master/plugins/Provider/Provider.php) in line [165](https://github.com/piwik/piwik/blob/master/plugins/Provider/Provider.php#L165)_



Callback Signature:
<pre><code>function(&amp;$cleanHostname, $hostname)</code></pre>

## Reporting

#### Reporting.createDatabase
_Defined in [Piwik/Db](https://github.com/piwik/piwik/blob/master/core/Db.php) in line [62](https://github.com/piwik/piwik/blob/master/core/Db.php#L62)_



Callback Signature:
<pre><code>function(&amp;$db)</code></pre>


#### Reporting.getDatabaseConfig
_Defined in [Piwik/Db](https://github.com/piwik/piwik/blob/master/core/Db.php) in line [57](https://github.com/piwik/piwik/blob/master/core/Db.php#L57)_



Callback Signature:
<pre><code>function(&amp;$dbInfos)</code></pre>

## Request

#### Request.dispatch
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [122](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L122)_



Callback Signature:
<pre><code>$params</code></pre>


#### Request.dispatch.end
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [128](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L128)_



Callback Signature:
<pre><code>function(&amp;$result, $parameters)</code></pre>


#### Request.dispatchCoreAndPluginUpdatesScreen
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [281](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L281)_




#### Request.initAuthenticationObject
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [290](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L290)_




#### Request.initAuthenticationObject
_Defined in [Piwik/Plugins/Overlay/API](https://github.com/piwik/piwik/blob/master/plugins/Overlay/API.php) in line [120](https://github.com/piwik/piwik/blob/master/plugins/Overlay/API.php#L120)_



Callback Signature:
<pre><code>function($allowCookieAuthentication = true)</code></pre>

## Schema

#### Schema.loadSchema
_Defined in [Piwik/Db/Schema](https://github.com/piwik/piwik/blob/master/core/Db/Schema.php) in line [134](https://github.com/piwik/piwik/blob/master/core/Db/Schema.php#L134)_



Callback Signature:
<pre><code>function(&amp;$schema)</code></pre>

## SegmentEditor

#### SegmentEditor.deactivate
_Defined in [Piwik/Plugins/SegmentEditor/API](https://github.com/piwik/piwik/blob/master/plugins/SegmentEditor/API.php) in line [313](https://github.com/piwik/piwik/blob/master/plugins/SegmentEditor/API.php#L313)_



Callback Signature:
<pre><code>function(&amp;$idSegment)</code></pre>

## Segments

#### Segments.getKnownSegmentsToArchiveAllSites
_Defined in [Piwik/SettingsPiwik](https://github.com/piwik/piwik/blob/master/core/SettingsPiwik.php) in line [59](https://github.com/piwik/piwik/blob/master/core/SettingsPiwik.php#L59)_



Callback Signature:
<pre><code>function(&amp;$cachedResult)</code></pre>


#### Segments.getKnownSegmentsToArchiveForSite
_Defined in [Piwik/SettingsPiwik](https://github.com/piwik/piwik/blob/master/core/SettingsPiwik.php) in line [71](https://github.com/piwik/piwik/blob/master/core/SettingsPiwik.php#L71)_



Callback Signature:
<pre><code>function(&amp;$segments, $idSite)</code></pre>

## Site

#### Site.getSiteAttributes
_Defined in [Piwik/Tracker/Cache](https://github.com/piwik/piwik/blob/master/core/Tracker/Cache.php) in line [64](https://github.com/piwik/piwik/blob/master/core/Tracker/Cache.php#L64)_



Callback Signature:
<pre><code>function(&amp;$content, $idSite)</code></pre>

## SitesManager

#### SitesManager.deleteSite.end
_Defined in [Piwik/Plugins/SitesManager/API](https://github.com/piwik/piwik/blob/master/plugins/SitesManager/API.php) in line [596](https://github.com/piwik/piwik/blob/master/plugins/SitesManager/API.php#L596)_



Callback Signature:
<pre><code>function($idSite)</code></pre>

## TaskScheduler

#### TaskScheduler.getScheduledTasks
_Defined in [Piwik/TaskScheduler](https://github.com/piwik/piwik/blob/master/core/TaskScheduler.php) in line [50](https://github.com/piwik/piwik/blob/master/core/TaskScheduler.php#L50)_



Callback Signature:
<pre><code>function(&amp;$tasks)</code></pre>

## Tracker

#### Tracker.createDatabase
_Defined in [Piwik/Tracker](https://github.com/piwik/piwik/blob/master/core/Tracker.php) in line [573](https://github.com/piwik/piwik/blob/master/core/Tracker.php#L573)_



Callback Signature:
<pre><code>function(&amp;$db)</code></pre>


#### Tracker.detectRefererSearchEngine
_Defined in [Piwik/Tracker/Referrer](https://github.com/piwik/piwik/blob/master/core/Tracker/Referrer.php) in line [130](https://github.com/piwik/piwik/blob/master/core/Tracker/Referrer.php#L130)_



Callback Signature:
<pre><code>function(&amp;$searchEngineInformation, $this-&gt;refererUrl)</code></pre>


#### Tracker.getDatabaseConfig
_Defined in [Piwik/Tracker](https://github.com/piwik/piwik/blob/master/core/Tracker.php) in line [557](https://github.com/piwik/piwik/blob/master/core/Tracker.php#L557)_



Callback Signature:
<pre><code>function(&amp;$configDb)</code></pre>


#### Tracker.getNewVisitObject
_Defined in [Piwik/Tracker](https://github.com/piwik/piwik/blob/master/core/Tracker.php) in line [609](https://github.com/piwik/piwik/blob/master/core/Tracker.php#L609)_



Callback Signature:
<pre><code>function(&amp;$visit)</code></pre>


#### Tracker.isExcludedVisit
_Defined in [Piwik/Tracker/VisitExcluded](https://github.com/piwik/piwik/blob/master/core/Tracker/VisitExcluded.php) in line [78](https://github.com/piwik/piwik/blob/master/core/Tracker/VisitExcluded.php#L78)_



Callback Signature:
<pre><code>function(&amp;$excluded)</code></pre>


#### Tracker.knownVisitorInformation
_Defined in [Piwik/Tracker/Visit](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php) in line [369](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php#L369)_



Callback Signature:
<pre><code>function(&amp;$this-&gt;visitorInfo)</code></pre>


#### Tracker.knownVisitorUpdate
_Defined in [Piwik/Tracker/Visit](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php) in line [328](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php#L328)_



Callback Signature:
<pre><code>function(&amp;$valuesToUpdate)</code></pre>


#### Tracker.newVisitorInformation
_Defined in [Piwik/Tracker/Visit](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php) in line [485](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php#L485)_



Callback Signature:
<pre><code>function(&amp;$this-&gt;visitorInfo, $extraInfo)</code></pre>


#### Tracker.recordAction
_Defined in [Piwik/Tracker/Action](https://github.com/piwik/piwik/blob/master/core/Tracker/Action.php) in line [645](https://github.com/piwik/piwik/blob/master/core/Tracker/Action.php#L645)_



Callback Signature:
<pre><code>function($this, $info)</code></pre>


#### Tracker.recordEcommerceGoal
_Defined in [Piwik/Tracker/GoalManager](https://github.com/piwik/piwik/blob/master/core/Tracker/GoalManager.php) in line [412](https://github.com/piwik/piwik/blob/master/core/Tracker/GoalManager.php#L412)_



Callback Signature:
<pre><code>function($goal)</code></pre>


#### Tracker.recordStandardGoals
_Defined in [Piwik/Tracker/GoalManager](https://github.com/piwik/piwik/blob/master/core/Tracker/GoalManager.php) in line [773](https://github.com/piwik/piwik/blob/master/core/Tracker/GoalManager.php#L773)_



Callback Signature:
<pre><code>function($newGoal)</code></pre>


#### Tracker.setSiteId
_Defined in [Piwik/Tracker/Request](https://github.com/piwik/piwik/blob/master/core/Tracker/Request.php) in line [295](https://github.com/piwik/piwik/blob/master/core/Tracker/Request.php#L295)_



Callback Signature:
<pre><code>function(&amp;$idSite, $this-&gt;params)</code></pre>


#### Tracker.setTrackerCacheGeneral
_Defined in [Piwik/Tracker/Cache](https://github.com/piwik/piwik/blob/master/core/Tracker/Cache.php) in line [107](https://github.com/piwik/piwik/blob/master/core/Tracker/Cache.php#L107)_



Callback Signature:
<pre><code>function(&amp;$cacheContent)</code></pre>


#### Tracker.setVisitorIp
_Defined in [Piwik/Tracker/Visit](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php) in line [117](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php#L117)_



Callback Signature:
<pre><code>function(&amp;$this-&gt;visitorInfo[&#039;location_ip&#039;])</code></pre>


#### Tracker.visitorInformation
_Defined in [Piwik/Tracker/Visit](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php) in line [516](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php#L516)_



Callback Signature:
<pre><code>function(&amp;$this-&gt;visitorInfo)</code></pre>

## Translate

#### Translate.getClientSideTranslationKeys
_Defined in [Piwik/Translate](https://github.com/piwik/piwik/blob/master/core/Translate.php) in line [187](https://github.com/piwik/piwik/blob/master/core/Translate.php#L187)_



Callback Signature:
<pre><code>function(&amp;$result)</code></pre>

## Updater

#### Updater.checkForUpdates
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [311](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L311)_



## User

#### User.getLanguage
_Defined in [Piwik/Translate](https://github.com/piwik/piwik/blob/master/core/Translate.php) in line [133](https://github.com/piwik/piwik/blob/master/core/Translate.php#L133)_



Callback Signature:
<pre><code>function(&amp;$lang)</code></pre>


#### User.isNotAuthorized
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [133](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L133)_



Callback Signature:
<pre><code>function($e)</code></pre>

## UsersManager

#### UsersManager.addUser
_Defined in [Piwik/Plugins/UsersManager/API](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/API.php) in line [402](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/API.php#L402)_



Callback Signature:
<pre><code>function($userLogin)</code></pre>


#### UsersManager.deleteUser
_Defined in [Piwik/Plugins/UsersManager/API](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/API.php) in line [645](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/API.php#L645)_



Callback Signature:
<pre><code>function($userLogin)</code></pre>


#### UsersManager.updateUser
_Defined in [Piwik/Plugins/UsersManager/API](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/API.php) in line [459](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/API.php#L459)_



Callback Signature:
<pre><code>function($userLogin)</code></pre>

## Visualization

#### Visualization.addVisualizations
_Defined in [Piwik/ViewDataTable/Visualization](https://github.com/piwik/piwik/blob/master/core/ViewDataTable/Visualization.php) in line [157](https://github.com/piwik/piwik/blob/master/core/ViewDataTable/Visualization.php#L157)_



Callback Signature:
<pre><code>function(&amp;$visualizations)</code></pre>


#### Visualization.configureFooterIcons
_Defined in [Piwik/ViewDataTable](https://github.com/piwik/piwik/blob/master/core/ViewDataTable.php) in line [1228](https://github.com/piwik/piwik/blob/master/core/ViewDataTable.php#L1228)_



Callback Signature:
<pre><code>function(&amp;$result, $this)</code></pre>


#### Visualization.getReportDisplayProperties
_Defined in [Piwik/ViewDataTable](https://github.com/piwik/piwik/blob/master/core/ViewDataTable.php) in line [407](https://github.com/piwik/piwik/blob/master/core/ViewDataTable.php#L407)_



Callback Signature:
<pre><code>function(&amp;self::$reportPropertiesCache)</code></pre>


#### Visualization.initView
_Defined in [Piwik/ViewDataTable](https://github.com/piwik/piwik/blob/master/core/ViewDataTable.php) in line [1062](https://github.com/piwik/piwik/blob/master/core/ViewDataTable.php#L1062)_



Callback Signature:
<pre><code>function($this)</code></pre>

## WidgetsList

#### WidgetsList.addWidgets
_Defined in [Piwik/WidgetsList](https://github.com/piwik/piwik/blob/master/core/WidgetsList.php) in line [59](https://github.com/piwik/piwik/blob/master/core/WidgetsList.php#L59)_




#### WidgetsList.getWidgets
_Defined in [Piwik/WidgetsList](https://github.com/piwik/piwik/blob/master/core/WidgetsList.php) in line [41](https://github.com/piwik/piwik/blob/master/core/WidgetsList.php#L41)_



