Hooks
==========

This is a complete list of available hooks.

## Categories

- [API](#api)
- [ArchiveProcessor](#archiveprocessor)
- [AssetManager](#assetmanager)
- [Config](#config)
- [Controller](#controller)
- [Goals](#goals)
- [Installation](#installation)
- [Live](#live)
- [Log](#log)
- [LogDataPurger](#logdatapurger)
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
_Defined in [Piwik/API/Proxy](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php) in line [184](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php#L184)_



Callback Signature:
<pre><code>function(&amp;$finalParameters)</code></pre>


#### API.$pluginName.$methodName.end
_Defined in [Piwik/API/Proxy](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php) in line [196](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php#L196)_



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
_Defined in [Piwik/API/Request](https://github.com/piwik/piwik/blob/master/core/API/Request.php) in line [184](https://github.com/piwik/piwik/blob/master/core/API/Request.php#L184)_



Callback Signature:
<pre><code>function($token_auth)</code></pre>


#### API.Request.dispatch
_Defined in [Piwik/API/Proxy](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php) in line [183](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php#L183)_



Callback Signature:
<pre><code>function(&amp;$finalParameters)</code></pre>


#### API.Request.dispatch.end
_Defined in [Piwik/API/Proxy](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php) in line [197](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php#L197)_



Callback Signature:
<pre><code>$endHookParams</code></pre>

## ArchiveProcessor

#### ArchiveProcessor.Day.compute
_Defined in [Piwik/ArchiveProcessor/Day](https://github.com/piwik/piwik/blob/master/core/ArchiveProcessor/Day.php) in line [107](https://github.com/piwik/piwik/blob/master/core/ArchiveProcessor/Day.php#L107)_



Callback Signature:
<pre><code>function(&amp;$this)</code></pre>


#### ArchiveProcessor.Period.compute
_Defined in [Piwik/ArchiveProcessor/Period](https://github.com/piwik/piwik/blob/master/core/ArchiveProcessor/Period.php) in line [189](https://github.com/piwik/piwik/blob/master/core/ArchiveProcessor/Period.php#L189)_



Callback Signature:
<pre><code>function(&amp;$this)</code></pre>

## AssetManager

#### AssetManager.filterMergedJavaScripts
_Defined in [Piwik/AssetManager](https://github.com/piwik/piwik/blob/master/core/AssetManager.php) in line [359](https://github.com/piwik/piwik/blob/master/core/AssetManager.php#L359)_



Callback Signature:
<pre><code>function(&amp;$mergedContent)</code></pre>


#### AssetManager.filterMergedStylesheets
_Defined in [Piwik/AssetManager](https://github.com/piwik/piwik/blob/master/core/AssetManager.php) in line [163](https://github.com/piwik/piwik/blob/master/core/AssetManager.php#L163)_



Callback Signature:
<pre><code>function(&amp;$mergedContent)</code></pre>


#### AssetManager.getJavaScriptFiles
_Defined in [Piwik/AssetManager](https://github.com/piwik/piwik/blob/master/core/AssetManager.php) in line [389](https://github.com/piwik/piwik/blob/master/core/AssetManager.php#L389)_



Callback Signature:
<pre><code>function(&amp;$jsFiles)</code></pre>


#### AssetManager.getStylesheetFiles
_Defined in [Piwik/AssetManager](https://github.com/piwik/piwik/blob/master/core/AssetManager.php) in line [282](https://github.com/piwik/piwik/blob/master/core/AssetManager.php#L282)_



Callback Signature:
<pre><code>function(&amp;$stylesheets)</code></pre>

## Config

#### Config.badConfigurationFile
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [280](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L280)_



Callback Signature:
<pre><code>function($e)</code></pre>


#### Config.NoConfigurationFile
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [213](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L213)_



Callback Signature:
<pre><code>function($e)</code></pre>

## Controller

#### Controller.$module.$action
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [129](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L129)_



Callback Signature:
<pre><code>function($parameters)</code></pre>


#### Controller.$module.$action.end
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [133](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L133)_



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

## Live

#### Live.getExtraVisitorDetails
_Defined in [Piwik/Plugins/Live/API](https://github.com/piwik/piwik/blob/master/plugins/Live/API.php) in line [372](https://github.com/piwik/piwik/blob/master/plugins/Live/API.php#L372)_

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
_Defined in [Piwik/Log](https://github.com/piwik/piwik/blob/master/core/Log.php) in line [393](https://github.com/piwik/piwik/blob/master/core/Log.php#L393)_

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
_Defined in [Piwik/Log](https://github.com/piwik/piwik/blob/master/core/Log.php) in line [368](https://github.com/piwik/piwik/blob/master/core/Log.php#L368)_

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

## LogDataPurger

#### LogDataPurger.ActionsToKeepInserted.newerThan
_Defined in [Piwik/Plugins/PrivacyManager/LogDataPurger](https://github.com/piwik/piwik/blob/master/plugins/PrivacyManager/LogDataPurger.php) in line [232](https://github.com/piwik/piwik/blob/master/plugins/PrivacyManager/LogDataPurger.php#L232)_




#### LogDataPurger.ActionsToKeepInserted.olderThan
_Defined in [Piwik/Plugins/PrivacyManager/LogDataPurger](https://github.com/piwik/piwik/blob/master/plugins/PrivacyManager/LogDataPurger.php) in line [230](https://github.com/piwik/piwik/blob/master/plugins/PrivacyManager/LogDataPurger.php#L230)_



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



## Provider

#### Provider.getCleanHostname
_Defined in [Piwik/Plugins/Provider/Provider](https://github.com/piwik/piwik/blob/master/plugins/Provider/Provider.php) in line [165](https://github.com/piwik/piwik/blob/master/plugins/Provider/Provider.php#L165)_



Callback Signature:
<pre><code>function(&amp;$cleanHostname, $hostname)</code></pre>

## Reporting

#### Reporting.createDatabase
_Defined in [Piwik/Db](https://github.com/piwik/piwik/blob/master/core/Db.php) in line [63](https://github.com/piwik/piwik/blob/master/core/Db.php#L63)_



Callback Signature:
<pre><code>function(&amp;$db)</code></pre>


#### Reporting.getDatabaseConfig
_Defined in [Piwik/Db](https://github.com/piwik/piwik/blob/master/core/Db.php) in line [58](https://github.com/piwik/piwik/blob/master/core/Db.php#L58)_



Callback Signature:
<pre><code>function(&amp;$dbInfos)</code></pre>

## Request

#### Request.dispatch
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [128](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L128)_



Callback Signature:
<pre><code>$params</code></pre>


#### Request.dispatch.end
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [134](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L134)_



Callback Signature:
<pre><code>function(&amp;$result, $parameters)</code></pre>


#### Request.dispatchCoreAndPluginUpdatesScreen
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [287](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L287)_




#### Request.initAuthenticationObject
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [296](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L296)_




#### Request.initAuthenticationObject
_Defined in [Piwik/Plugins/Overlay/API](https://github.com/piwik/piwik/blob/master/plugins/Overlay/API.php) in line [120](https://github.com/piwik/piwik/blob/master/plugins/Overlay/API.php#L120)_



Callback Signature:
<pre><code>function($allowCookieAuthentication = true)</code></pre>

## ScheduledReports

#### ScheduledReports.allowMultipleReports
_Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php) in line [728](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php#L728)_



Callback Signature:
<pre><code>function(&amp;$allowMultipleReports, $notificationInfo = function(self::REPORT_TYPE_INFO_KEY =&gt; $reportType))</code></pre>


#### ScheduledReports.getRendererInstance
_Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php) in line [423](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php#L423)_



Callback Signature:
<pre><code>function(&amp;$reportRenderer, $notificationInfo)</code></pre>


#### ScheduledReports.getReportFormats
_Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php) in line [758](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php#L758)_



Callback Signature:
<pre><code>function(&amp;$reportFormats, $notificationInfo = function(self::REPORT_TYPE_INFO_KEY =&gt; $reportType))</code></pre>


#### ScheduledReports.getReportMetadata
_Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php) in line [714](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php#L714)_



Callback Signature:
<pre><code>function(&amp;$availableReportMetadata, $notificationInfo)</code></pre>


#### ScheduledReports.getReportParameters
_Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php) in line [586](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php#L586)_



Callback Signature:
<pre><code>function(&amp;$availableParameters, $notificationInfo)</code></pre>


#### ScheduledReports.getReportRecipients
_Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php) in line [783](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php#L783)_



Callback Signature:
<pre><code>function(&amp;$recipients, $notificationInfo)</code></pre>


#### ScheduledReports.getReportTypes
_Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php) in line [746](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php#L746)_



Callback Signature:
<pre><code>function(&amp;$reportTypes)</code></pre>


#### ScheduledReports.processReports
_Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php) in line [416](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php#L416)_



Callback Signature:
<pre><code>function(&amp;$processedReports, $notificationInfo)</code></pre>


#### ScheduledReports.sendReport
_Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php) in line [534](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php#L534)_



Callback Signature:
<pre><code>function($notificationInfo = function(self::REPORT_TYPE_INFO_KEY =&gt; $report[&#039;type&#039;], self::REPORT_KEY =&gt; $report, self::REPORT_CONTENT_KEY =&gt; $contents, self::FILENAME_KEY =&gt; $filename, self::PRETTY_DATE_KEY =&gt; $prettyDate, self::REPORT_SUBJECT_KEY =&gt; $reportSubject, self::REPORT_TITLE_KEY =&gt; $reportTitle, self::ADDITIONAL_FILES_KEY =&gt; $additionalFiles))</code></pre>


#### ScheduledReports.validateReportParameters
_Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php) in line [604](https://github.com/piwik/piwik/blob/master/plugins/ScheduledReports/API.php#L604)_



Callback Signature:
<pre><code>function(&amp;$parameters, $notificationInfo)</code></pre>

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
_Defined in [Piwik/SettingsPiwik](https://github.com/piwik/piwik/blob/master/core/SettingsPiwik.php) in line [65](https://github.com/piwik/piwik/blob/master/core/SettingsPiwik.php#L65)_



Callback Signature:
<pre><code>function(&amp;$cachedResult)</code></pre>


#### Segments.getKnownSegmentsToArchiveForSite
_Defined in [Piwik/SettingsPiwik](https://github.com/piwik/piwik/blob/master/core/SettingsPiwik.php) in line [77](https://github.com/piwik/piwik/blob/master/core/SettingsPiwik.php#L77)_



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


#### Tracker.detectReferrerSearchEngine
_Defined in [Piwik/Tracker/Referrer](https://github.com/piwik/piwik/blob/master/core/Tracker/Referrer.php) in line [130](https://github.com/piwik/piwik/blob/master/core/Tracker/Referrer.php#L130)_



Callback Signature:
<pre><code>function(&amp;$searchEngineInformation, $this-&gt;referrerUrl)</code></pre>


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
_Defined in [Piwik/Tracker/Visit](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php) in line [352](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php#L352)_



Callback Signature:
<pre><code>function(&amp;$this-&gt;visitorInfo)</code></pre>


#### Tracker.knownVisitorUpdate
_Defined in [Piwik/Tracker/Visit](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php) in line [311](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php#L311)_



Callback Signature:
<pre><code>function(&amp;$valuesToUpdate)</code></pre>


#### Tracker.newVisitorInformation
_Defined in [Piwik/Tracker/Visit](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php) in line [468](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php#L468)_



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
_Defined in [Piwik/Tracker/Visit](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php) in line [100](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php#L100)_



Callback Signature:
<pre><code>function(&amp;$this-&gt;visitorInfo[&#039;location_ip&#039;])</code></pre>


#### Tracker.visitorInformation
_Defined in [Piwik/Tracker/Visit](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php) in line [499](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php#L499)_



Callback Signature:
<pre><code>function(&amp;$this-&gt;visitorInfo)</code></pre>

## Translate

#### Translate.getClientSideTranslationKeys
_Defined in [Piwik/Translate](https://github.com/piwik/piwik/blob/master/core/Translate.php) in line [185](https://github.com/piwik/piwik/blob/master/core/Translate.php#L185)_

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

## Updater

#### Updater.checkForUpdates
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [317](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L317)_



## User

#### User.getLanguage
_Defined in [Piwik/Translate](https://github.com/piwik/piwik/blob/master/core/Translate.php) in line [116](https://github.com/piwik/piwik/blob/master/core/Translate.php#L116)_



Callback Signature:
<pre><code>function(&amp;$lang)</code></pre>


#### User.isNotAuthorized
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [139](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L139)_



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

This event is used to gather all available DataTable visualizations. Callbacks
should add visualization class names to the incoming array.

Callback Signature:
<pre><code>function(&amp;$visualizations)</code></pre>


#### Visualization.configureFooterIcons
_Defined in [Piwik/ViewDataTable](https://github.com/piwik/piwik/blob/master/core/ViewDataTable.php) in line [1285](https://github.com/piwik/piwik/blob/master/core/ViewDataTable.php#L1285)_

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
_Defined in [Piwik/ViewDataTable](https://github.com/piwik/piwik/blob/master/core/ViewDataTable.php) in line [428](https://github.com/piwik/piwik/blob/master/core/ViewDataTable.php#L428)_



Callback Signature:
<pre><code>function(&amp;self::$reportPropertiesCache)</code></pre>


#### Visualization.initView
_Defined in [Piwik/ViewDataTable](https://github.com/piwik/piwik/blob/master/core/ViewDataTable.php) in line [1092](https://github.com/piwik/piwik/blob/master/core/ViewDataTable.php#L1092)_

This event is called before a visualization is created. Plugins can use this event to
override view properties for individual reports or visualizations.

Themes can use this event to make sure reports look nice with their themes. Plugins
that provide new visualizations can use this event to make sure certain reports
are configured differently when viewed with the new visualization.

Callback Signature:
<pre><code>function($viewDataTable = $this)</code></pre>

## WidgetsList

#### WidgetsList.addWidgets
_Defined in [Piwik/WidgetsList](https://github.com/piwik/piwik/blob/master/core/WidgetsList.php) in line [59](https://github.com/piwik/piwik/blob/master/core/WidgetsList.php#L59)_




#### WidgetsList.getWidgets
_Defined in [Piwik/WidgetsList](https://github.com/piwik/piwik/blob/master/core/WidgetsList.php) in line [41](https://github.com/piwik/piwik/blob/master/core/WidgetsList.php#L41)_



