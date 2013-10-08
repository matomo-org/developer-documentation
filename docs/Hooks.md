Hooks
==========

This is a complete list of available hooks.

## Categories

- [$eventName](#$eventname)
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

## $eventName

#### $eventName
_Defined in [/](https://github.com/piwik/piwik/blob/master/core/functions.php) in line [53](https://github.com/piwik/piwik/blob/master/core/functions.php#L53)_


Arguments:
<pre><code>$params, $pending, $plugins</code></pre>


#### $eventName
_Defined in [Piwik/Twig](https://github.com/piwik/piwik/blob/master/core/Twig.php) in line [108](https://github.com/piwik/piwik/blob/master/core/Twig.php#L108)_


Arguments:
<pre><code>array(&amp;$str)</code></pre>

## API

#### API.$pluginName.$methodName
_Defined in [Piwik/API/Proxy](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php) in line [188](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php#L188)_


Arguments:
<pre><code>array(&amp;$finalParameters)</code></pre>


#### API.$pluginName.$methodName.end
_Defined in [Piwik/API/Proxy](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php) in line [200](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php#L200)_


Arguments:
<pre><code>$endHookParams</code></pre>


#### API.getReportMetadata
_Defined in [Piwik/Plugins/API/ProcessedReport](https://github.com/piwik/piwik/blob/master/plugins/API/ProcessedReport.php) in line [87](https://github.com/piwik/piwik/blob/master/plugins/API/ProcessedReport.php#L87)_


Arguments:
<pre><code>array(&amp;$availableReports, $parameters)</code></pre>


#### API.getReportMetadata.end
_Defined in [Piwik/Plugins/API/ProcessedReport](https://github.com/piwik/piwik/blob/master/plugins/API/ProcessedReport.php) in line [106](https://github.com/piwik/piwik/blob/master/plugins/API/ProcessedReport.php#L106)_


Arguments:
<pre><code>array(&amp;$availableReports, $parameters)</code></pre>


#### API.getSegmentsMetadata
_Defined in [Piwik/Plugins/API/API](https://github.com/piwik/piwik/blob/master/plugins/API/API.php) in line [97](https://github.com/piwik/piwik/blob/master/plugins/API/API.php#L97)_


Arguments:
<pre><code>array(&amp;$segments, $idSites)</code></pre>


#### API.Request.authenticate
_Defined in [Piwik/API/Request](https://github.com/piwik/piwik/blob/master/core/API/Request.php) in line [182](https://github.com/piwik/piwik/blob/master/core/API/Request.php#L182)_


Arguments:
<pre><code>array($token_auth)</code></pre>


#### API.Request.dispatch
_Defined in [Piwik/API/Proxy](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php) in line [187](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php#L187)_


Arguments:
<pre><code>array(&amp;$finalParameters)</code></pre>


#### API.Request.dispatch.end
_Defined in [Piwik/API/Proxy](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php) in line [201](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php#L201)_


Arguments:
<pre><code>$endHookParams</code></pre>

## ArchiveProcessor

#### ArchiveProcessor.Day.compute
_Defined in [Piwik/ArchiveProcessor/Day](https://github.com/piwik/piwik/blob/master/core/ArchiveProcessor/Day.php) in line [105](https://github.com/piwik/piwik/blob/master/core/ArchiveProcessor/Day.php#L105)_


Arguments:
<pre><code>array(&amp;$this)</code></pre>


#### ArchiveProcessor.Period.compute
_Defined in [Piwik/ArchiveProcessor/Period](https://github.com/piwik/piwik/blob/master/core/ArchiveProcessor/Period.php) in line [187](https://github.com/piwik/piwik/blob/master/core/ArchiveProcessor/Period.php#L187)_


Arguments:
<pre><code>array(&amp;$this)</code></pre>

## AssetManager

#### AssetManager.filterMergedJavaScripts
_Defined in [Piwik/AssetManager](https://github.com/piwik/piwik/blob/master/core/AssetManager.php) in line [357](https://github.com/piwik/piwik/blob/master/core/AssetManager.php#L357)_


Arguments:
<pre><code>array(&amp;$mergedContent)</code></pre>


#### AssetManager.filterMergedStylesheets
_Defined in [Piwik/AssetManager](https://github.com/piwik/piwik/blob/master/core/AssetManager.php) in line [163](https://github.com/piwik/piwik/blob/master/core/AssetManager.php#L163)_


Arguments:
<pre><code>array(&amp;$mergedContent)</code></pre>


#### AssetManager.getJavaScriptFiles
_Defined in [Piwik/AssetManager](https://github.com/piwik/piwik/blob/master/core/AssetManager.php) in line [387](https://github.com/piwik/piwik/blob/master/core/AssetManager.php#L387)_


Arguments:
<pre><code>array(&amp;$jsFiles)</code></pre>


#### AssetManager.getStylesheetFiles
_Defined in [Piwik/AssetManager](https://github.com/piwik/piwik/blob/master/core/AssetManager.php) in line [282](https://github.com/piwik/piwik/blob/master/core/AssetManager.php#L282)_


Arguments:
<pre><code>array(&amp;$stylesheets)</code></pre>

## Config

#### Config.badConfigurationFile
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [274](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L274)_


Arguments:
<pre><code>array($e), $pending = true</code></pre>


#### Config.NoConfigurationFile
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [207](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L207)_


Arguments:
<pre><code>array($e), $pending = true</code></pre>

## Controller

#### Controller.$module.$action
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [123](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L123)_


Arguments:
<pre><code>array($parameters)</code></pre>


#### Controller.$module.$action.end
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [127](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L127)_


Arguments:
<pre><code>array(&amp;$result, $parameters)</code></pre>

## Goals

#### Goals.getReportsWithGoalMetrics
_Defined in [Piwik/Plugins/Goals/Goals](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php) in line [39](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L39)_


Arguments:
<pre><code>array(&amp;$dimensions)</code></pre>


#### Goals.getReportsWithGoalMetrics
_Defined in [Piwik/Plugins/Goals/Goals](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php) in line [343](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L343)_


Arguments:
<pre><code>array(&amp;$reportsWithGoals)</code></pre>

## Installation

#### Installation.startInstallation
_Defined in [Piwik/Plugins/Installation/Installation](https://github.com/piwik/piwik/blob/master/plugins/Installation/Installation.php) in line [62](https://github.com/piwik/piwik/blob/master/plugins/Installation/Installation.php#L62)_


Arguments:
<pre><code>array($this)</code></pre>

## Live::GET_EXTRA_VISITOR_DETAILS_EVENT

#### Live::GET_EXTRA_VISITOR_DETAILS_EVENT
_Defined in [Piwik/Plugins/Live/API](https://github.com/piwik/piwik/blob/master/plugins/Live/API.php) in line [360](https://github.com/piwik/piwik/blob/master/plugins/Live/API.php#L360)_


Arguments:
<pre><code>array(&amp;$result)</code></pre>

## Log

#### Log.formatDatabaseMessage
_Defined in [Piwik/Log](https://github.com/piwik/piwik/blob/master/core/Log.php) in line [361](https://github.com/piwik/piwik/blob/master/core/Log.php#L361)_


Arguments:
<pre><code>array(&amp;$message, $level, $tag, $datetime, $this)</code></pre>


#### Log.formatFileMessage
_Defined in [Piwik/Log](https://github.com/piwik/piwik/blob/master/core/Log.php) in line [316](https://github.com/piwik/piwik/blob/master/core/Log.php#L316)_


Arguments:
<pre><code>array(&amp;$message, $level, $tag, $datetime, $this)</code></pre>


#### Log.formatScreenMessage
_Defined in [Piwik/Log](https://github.com/piwik/piwik/blob/master/core/Log.php) in line [346](https://github.com/piwik/piwik/blob/master/core/Log.php#L346)_


Arguments:
<pre><code>array(&amp;$message, $level, $tag, $datetime, $this)</code></pre>

## LogDataPurger

#### LogDataPurger.ActionsToKeepInserted.newerThan
_Defined in [Piwik/Plugins/PrivacyManager/LogDataPurger](https://github.com/piwik/piwik/blob/master/plugins/PrivacyManager/LogDataPurger.php) in line [231](https://github.com/piwik/piwik/blob/master/plugins/PrivacyManager/LogDataPurger.php#L231)_




#### LogDataPurger.ActionsToKeepInserted.olderThan
_Defined in [Piwik/Plugins/PrivacyManager/LogDataPurger](https://github.com/piwik/piwik/blob/master/plugins/PrivacyManager/LogDataPurger.php) in line [229](https://github.com/piwik/piwik/blob/master/plugins/PrivacyManager/LogDataPurger.php#L229)_



## Login

#### Login.initSession
_Defined in [Piwik/Plugins/UsersManager/Controller](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/Controller.php) in line [325](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/Controller.php#L325)_


Arguments:
<pre><code>array($info)</code></pre>


#### Login.initSession
_Defined in [Piwik/Plugins/Login/Controller](https://github.com/piwik/piwik/blob/master/plugins/Login/Controller.php) in line [172](https://github.com/piwik/piwik/blob/master/plugins/Login/Controller.php#L172)_


Arguments:
<pre><code>array(&amp;$info)</code></pre>

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


Arguments:
<pre><code>array(&amp;$allowMultipleReports, $notificationInfo = array(self::REPORT_TYPE_INFO_KEY =&gt; $reportType))</code></pre>


#### PDFReports.getRendererInstance
_Defined in [Piwik/Plugins/PDFReports/API](https://github.com/piwik/piwik/blob/master/plugins/PDFReports/API.php) in line [423](https://github.com/piwik/piwik/blob/master/plugins/PDFReports/API.php#L423)_


Arguments:
<pre><code>array(&amp;$reportRenderer, $notificationInfo)</code></pre>


#### PDFReports.getReportFormats
_Defined in [Piwik/Plugins/PDFReports/API](https://github.com/piwik/piwik/blob/master/plugins/PDFReports/API.php) in line [758](https://github.com/piwik/piwik/blob/master/plugins/PDFReports/API.php#L758)_


Arguments:
<pre><code>array(&amp;$reportFormats, $notificationInfo = array(self::REPORT_TYPE_INFO_KEY =&gt; $reportType))</code></pre>


#### PDFReports.getReportMetadata
_Defined in [Piwik/Plugins/PDFReports/API](https://github.com/piwik/piwik/blob/master/plugins/PDFReports/API.php) in line [714](https://github.com/piwik/piwik/blob/master/plugins/PDFReports/API.php#L714)_


Arguments:
<pre><code>array(&amp;$availableReportMetadata, $notificationInfo)</code></pre>


#### PDFReports.getReportParameters
_Defined in [Piwik/Plugins/PDFReports/API](https://github.com/piwik/piwik/blob/master/plugins/PDFReports/API.php) in line [586](https://github.com/piwik/piwik/blob/master/plugins/PDFReports/API.php#L586)_


Arguments:
<pre><code>array(&amp;$availableParameters, $notificationInfo)</code></pre>


#### PDFReports.getReportRecipients
_Defined in [Piwik/Plugins/PDFReports/API](https://github.com/piwik/piwik/blob/master/plugins/PDFReports/API.php) in line [783](https://github.com/piwik/piwik/blob/master/plugins/PDFReports/API.php#L783)_


Arguments:
<pre><code>array(&amp;$recipients, $notificationInfo)</code></pre>


#### PDFReports.getReportTypes
_Defined in [Piwik/Plugins/PDFReports/API](https://github.com/piwik/piwik/blob/master/plugins/PDFReports/API.php) in line [746](https://github.com/piwik/piwik/blob/master/plugins/PDFReports/API.php#L746)_


Arguments:
<pre><code>array(&amp;$reportTypes)</code></pre>


#### PDFReports.processReports
_Defined in [Piwik/Plugins/PDFReports/API](https://github.com/piwik/piwik/blob/master/plugins/PDFReports/API.php) in line [416](https://github.com/piwik/piwik/blob/master/plugins/PDFReports/API.php#L416)_


Arguments:
<pre><code>array(&amp;$processedReports, $notificationInfo)</code></pre>


#### PDFReports.sendReport
_Defined in [Piwik/Plugins/PDFReports/API](https://github.com/piwik/piwik/blob/master/plugins/PDFReports/API.php) in line [534](https://github.com/piwik/piwik/blob/master/plugins/PDFReports/API.php#L534)_


Arguments:
<pre><code>array($notificationInfo = array(self::REPORT_TYPE_INFO_KEY =&gt; $report[&#039;type&#039;], self::REPORT_KEY =&gt; $report, self::REPORT_CONTENT_KEY =&gt; $contents, self::FILENAME_KEY =&gt; $filename, self::PRETTY_DATE_KEY =&gt; $prettyDate, self::REPORT_SUBJECT_KEY =&gt; $reportSubject, self::REPORT_TITLE_KEY =&gt; $reportTitle, self::ADDITIONAL_FILES_KEY =&gt; $additionalFiles))</code></pre>


#### PDFReports.validateReportParameters
_Defined in [Piwik/Plugins/PDFReports/API](https://github.com/piwik/piwik/blob/master/plugins/PDFReports/API.php) in line [604](https://github.com/piwik/piwik/blob/master/plugins/PDFReports/API.php#L604)_


Arguments:
<pre><code>array(&amp;$parameters, $notificationInfo)</code></pre>

## Provider

#### Provider.getCleanHostname
_Defined in [Piwik/Plugins/Provider/Provider](https://github.com/piwik/piwik/blob/master/plugins/Provider/Provider.php) in line [165](https://github.com/piwik/piwik/blob/master/plugins/Provider/Provider.php#L165)_


Arguments:
<pre><code>array(&amp;$cleanHostname, $hostname)</code></pre>

## Reporting

#### Reporting.createDatabase
_Defined in [Piwik/Db](https://github.com/piwik/piwik/blob/master/core/Db.php) in line [62](https://github.com/piwik/piwik/blob/master/core/Db.php#L62)_


Arguments:
<pre><code>array(&amp;$db)</code></pre>


#### Reporting.getDatabaseConfig
_Defined in [Piwik/Db](https://github.com/piwik/piwik/blob/master/core/Db.php) in line [57](https://github.com/piwik/piwik/blob/master/core/Db.php#L57)_


Arguments:
<pre><code>array(&amp;$dbInfos)</code></pre>

## Request

#### Request.dispatch
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [122](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L122)_


Arguments:
<pre><code>$params</code></pre>


#### Request.dispatch.end
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [128](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L128)_


Arguments:
<pre><code>array(&amp;$result, $parameters)</code></pre>


#### Request.dispatchCoreAndPluginUpdatesScreen
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [281](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L281)_




#### Request.initAuthenticationObject
_Defined in [Piwik/Plugins/Overlay/API](https://github.com/piwik/piwik/blob/master/plugins/Overlay/API.php) in line [120](https://github.com/piwik/piwik/blob/master/plugins/Overlay/API.php#L120)_


Arguments:
<pre><code>array($allowCookieAuthentication = true)</code></pre>


#### Request.initAuthenticationObject
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [290](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L290)_



## Schema

#### Schema.loadSchema
_Defined in [Piwik/Db/Schema](https://github.com/piwik/piwik/blob/master/core/Db/Schema.php) in line [134](https://github.com/piwik/piwik/blob/master/core/Db/Schema.php#L134)_


Arguments:
<pre><code>array(&amp;$schema)</code></pre>

## SegmentEditor

#### SegmentEditor.deactivate
_Defined in [Piwik/Plugins/SegmentEditor/API](https://github.com/piwik/piwik/blob/master/plugins/SegmentEditor/API.php) in line [313](https://github.com/piwik/piwik/blob/master/plugins/SegmentEditor/API.php#L313)_


Arguments:
<pre><code>array(&amp;$idSegment)</code></pre>

## Segments

#### Segments.getKnownSegmentsToArchiveAllSites
_Defined in [Piwik/SettingsPiwik](https://github.com/piwik/piwik/blob/master/core/SettingsPiwik.php) in line [59](https://github.com/piwik/piwik/blob/master/core/SettingsPiwik.php#L59)_


Arguments:
<pre><code>array(&amp;$cachedResult)</code></pre>


#### Segments.getKnownSegmentsToArchiveForSite
_Defined in [Piwik/SettingsPiwik](https://github.com/piwik/piwik/blob/master/core/SettingsPiwik.php) in line [71](https://github.com/piwik/piwik/blob/master/core/SettingsPiwik.php#L71)_


Arguments:
<pre><code>array(&amp;$segments, $idSite)</code></pre>

## Site

#### Site.getSiteAttributes
_Defined in [Piwik/Tracker/Cache](https://github.com/piwik/piwik/blob/master/core/Tracker/Cache.php) in line [64](https://github.com/piwik/piwik/blob/master/core/Tracker/Cache.php#L64)_


Arguments:
<pre><code>array(&amp;$content, $idSite)</code></pre>

## SitesManager

#### SitesManager.deleteSite.end
_Defined in [Piwik/Plugins/SitesManager/API](https://github.com/piwik/piwik/blob/master/plugins/SitesManager/API.php) in line [596](https://github.com/piwik/piwik/blob/master/plugins/SitesManager/API.php#L596)_


Arguments:
<pre><code>array($idSite)</code></pre>

## TaskScheduler

#### TaskScheduler.getScheduledTasks
_Defined in [Piwik/TaskScheduler](https://github.com/piwik/piwik/blob/master/core/TaskScheduler.php) in line [50](https://github.com/piwik/piwik/blob/master/core/TaskScheduler.php#L50)_


Arguments:
<pre><code>array(&amp;$tasks)</code></pre>

## Tracker

#### Tracker.createDatabase
_Defined in [Piwik/Tracker](https://github.com/piwik/piwik/blob/master/core/Tracker.php) in line [573](https://github.com/piwik/piwik/blob/master/core/Tracker.php#L573)_


Arguments:
<pre><code>array(&amp;$db)</code></pre>


#### Tracker.detectRefererSearchEngine
_Defined in [Piwik/Tracker/Referrer](https://github.com/piwik/piwik/blob/master/core/Tracker/Referrer.php) in line [130](https://github.com/piwik/piwik/blob/master/core/Tracker/Referrer.php#L130)_


Arguments:
<pre><code>array(&amp;$searchEngineInformation, $this-&gt;refererUrl)</code></pre>


#### Tracker.getDatabaseConfig
_Defined in [Piwik/Tracker](https://github.com/piwik/piwik/blob/master/core/Tracker.php) in line [557](https://github.com/piwik/piwik/blob/master/core/Tracker.php#L557)_


Arguments:
<pre><code>array(&amp;$configDb)</code></pre>


#### Tracker.getNewVisitObject
_Defined in [Piwik/Tracker](https://github.com/piwik/piwik/blob/master/core/Tracker.php) in line [609](https://github.com/piwik/piwik/blob/master/core/Tracker.php#L609)_


Arguments:
<pre><code>array(&amp;$visit)</code></pre>


#### Tracker.isExcludedVisit
_Defined in [Piwik/Tracker/VisitExcluded](https://github.com/piwik/piwik/blob/master/core/Tracker/VisitExcluded.php) in line [78](https://github.com/piwik/piwik/blob/master/core/Tracker/VisitExcluded.php#L78)_


Arguments:
<pre><code>array(&amp;$excluded)</code></pre>


#### Tracker.knownVisitorInformation
_Defined in [Piwik/Tracker/Visit](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php) in line [369](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php#L369)_


Arguments:
<pre><code>array(&amp;$this-&gt;visitorInfo)</code></pre>


#### Tracker.knownVisitorUpdate
_Defined in [Piwik/Tracker/Visit](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php) in line [328](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php#L328)_


Arguments:
<pre><code>array(&amp;$valuesToUpdate)</code></pre>


#### Tracker.newVisitorInformation
_Defined in [Piwik/Tracker/Visit](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php) in line [485](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php#L485)_


Arguments:
<pre><code>array(&amp;$this-&gt;visitorInfo, $extraInfo)</code></pre>


#### Tracker.recordAction
_Defined in [Piwik/Tracker/Action](https://github.com/piwik/piwik/blob/master/core/Tracker/Action.php) in line [645](https://github.com/piwik/piwik/blob/master/core/Tracker/Action.php#L645)_


Arguments:
<pre><code>array($this, $info)</code></pre>


#### Tracker.recordEcommerceGoal
_Defined in [Piwik/Tracker/GoalManager](https://github.com/piwik/piwik/blob/master/core/Tracker/GoalManager.php) in line [412](https://github.com/piwik/piwik/blob/master/core/Tracker/GoalManager.php#L412)_


Arguments:
<pre><code>array($goal)</code></pre>


#### Tracker.recordStandardGoals
_Defined in [Piwik/Tracker/GoalManager](https://github.com/piwik/piwik/blob/master/core/Tracker/GoalManager.php) in line [773](https://github.com/piwik/piwik/blob/master/core/Tracker/GoalManager.php#L773)_


Arguments:
<pre><code>array($newGoal)</code></pre>


#### Tracker.setSiteId
_Defined in [Piwik/Tracker/Request](https://github.com/piwik/piwik/blob/master/core/Tracker/Request.php) in line [295](https://github.com/piwik/piwik/blob/master/core/Tracker/Request.php#L295)_


Arguments:
<pre><code>array(&amp;$idSite, $this-&gt;params)</code></pre>


#### Tracker.setTrackerCacheGeneral
_Defined in [Piwik/Tracker/Cache](https://github.com/piwik/piwik/blob/master/core/Tracker/Cache.php) in line [107](https://github.com/piwik/piwik/blob/master/core/Tracker/Cache.php#L107)_


Arguments:
<pre><code>array(&amp;$cacheContent)</code></pre>


#### Tracker.setVisitorIp
_Defined in [Piwik/Tracker/Visit](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php) in line [117](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php#L117)_


Arguments:
<pre><code>array(&amp;$this-&gt;visitorInfo[&#039;location_ip&#039;])</code></pre>


#### Tracker.visitorInformation
_Defined in [Piwik/Tracker/Visit](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php) in line [516](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php#L516)_


Arguments:
<pre><code>array(&amp;$this-&gt;visitorInfo)</code></pre>

## Translate

#### Translate.getClientSideTranslationKeys
_Defined in [Piwik/Translate](https://github.com/piwik/piwik/blob/master/core/Translate.php) in line [187](https://github.com/piwik/piwik/blob/master/core/Translate.php#L187)_


Arguments:
<pre><code>array(&amp;$result)</code></pre>

## Updater

#### Updater.checkForUpdates
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [311](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L311)_



## User

#### User.getLanguage
_Defined in [Piwik/Translate](https://github.com/piwik/piwik/blob/master/core/Translate.php) in line [133](https://github.com/piwik/piwik/blob/master/core/Translate.php#L133)_


Arguments:
<pre><code>array(&amp;$lang)</code></pre>


#### User.isNotAuthorized
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [133](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L133)_


Arguments:
<pre><code>array($e), $pending = true</code></pre>

## UsersManager

#### UsersManager.addUser
_Defined in [Piwik/Plugins/UsersManager/API](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/API.php) in line [402](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/API.php#L402)_


Arguments:
<pre><code>array($userLogin)</code></pre>


#### UsersManager.deleteUser
_Defined in [Piwik/Plugins/UsersManager/API](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/API.php) in line [645](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/API.php#L645)_


Arguments:
<pre><code>array($userLogin)</code></pre>


#### UsersManager.updateUser
_Defined in [Piwik/Plugins/UsersManager/API](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/API.php) in line [459](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/API.php#L459)_


Arguments:
<pre><code>array($userLogin)</code></pre>

## Visualization

#### Visualization.addVisualizations
_Defined in [Piwik/ViewDataTable/Visualization](https://github.com/piwik/piwik/blob/master/core/ViewDataTable/Visualization.php) in line [157](https://github.com/piwik/piwik/blob/master/core/ViewDataTable/Visualization.php#L157)_


Arguments:
<pre><code>array(&amp;$visualizations)</code></pre>


#### Visualization.configureFooterIcons
_Defined in [Piwik/ViewDataTable](https://github.com/piwik/piwik/blob/master/core/ViewDataTable.php) in line [1228](https://github.com/piwik/piwik/blob/master/core/ViewDataTable.php#L1228)_


Arguments:
<pre><code>array(&amp;$result, $this)</code></pre>


#### Visualization.getReportDisplayProperties
_Defined in [Piwik/ViewDataTable](https://github.com/piwik/piwik/blob/master/core/ViewDataTable.php) in line [407](https://github.com/piwik/piwik/blob/master/core/ViewDataTable.php#L407)_


Arguments:
<pre><code>array(&amp;self::$reportPropertiesCache)</code></pre>


#### Visualization.initView
_Defined in [Piwik/ViewDataTable](https://github.com/piwik/piwik/blob/master/core/ViewDataTable.php) in line [1062](https://github.com/piwik/piwik/blob/master/core/ViewDataTable.php#L1062)_


Arguments:
<pre><code>array($this)</code></pre>

## WidgetsList

#### WidgetsList.addWidgets
_Defined in [Piwik/WidgetsList](https://github.com/piwik/piwik/blob/master/core/WidgetsList.php) in line [62](https://github.com/piwik/piwik/blob/master/core/WidgetsList.php#L62)_




#### WidgetsList.getWidgets
_Defined in [Piwik/WidgetsList](https://github.com/piwik/piwik/blob/master/core/WidgetsList.php) in line [44](https://github.com/piwik/piwik/blob/master/core/WidgetsList.php#L44)_

the documentation for tihs widetlist

