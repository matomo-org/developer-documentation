Hooks
==========

This is a complete list of available hooks:

### $eventName
_Defined in [Piwik/Twig](https://github.com/piwik/piwik/blob/master/core/Twig.php) in line [108](https://github.com/piwik/piwik/blob/master/core/Twig.php#L108)_


Arguments:
<pre><code>array(&amp;$str)</code></pre>

### $eventName
_Defined in [/](https://github.com/piwik/piwik/blob/master/core/functions.php) in line [53](https://github.com/piwik/piwik/blob/master/core/functions.php#L53)_


Arguments:
<pre><code>$params, $pending, $plugins</code></pre>

### API.Request.authenticate
_Defined in [Piwik/API/Request](https://github.com/piwik/piwik/blob/master/core/API/Request.php) in line [182](https://github.com/piwik/piwik/blob/master/core/API/Request.php#L182)_


Arguments:
<pre><code>array($token_auth)</code></pre>

### ArchiveProcessor.Day.compute
_Defined in [Piwik/ArchiveProcessor/Day](https://github.com/piwik/piwik/blob/master/core/ArchiveProcessor/Day.php) in line [105](https://github.com/piwik/piwik/blob/master/core/ArchiveProcessor/Day.php#L105)_


Arguments:
<pre><code>array(&amp;$this)</code></pre>

### ArchiveProcessor.Period.compute
_Defined in [Piwik/ArchiveProcessor/Period](https://github.com/piwik/piwik/blob/master/core/ArchiveProcessor/Period.php) in line [187](https://github.com/piwik/piwik/blob/master/core/ArchiveProcessor/Period.php#L187)_


Arguments:
<pre><code>array(&amp;$this)</code></pre>

### AssetManager.filterMergedJavaScripts
_Defined in [Piwik/AssetManager](https://github.com/piwik/piwik/blob/master/core/AssetManager.php) in line [357](https://github.com/piwik/piwik/blob/master/core/AssetManager.php#L357)_


Arguments:
<pre><code>array(&amp;$mergedContent)</code></pre>

### AssetManager.filterMergedStylesheets
_Defined in [Piwik/AssetManager](https://github.com/piwik/piwik/blob/master/core/AssetManager.php) in line [163](https://github.com/piwik/piwik/blob/master/core/AssetManager.php#L163)_


Arguments:
<pre><code>array(&amp;$mergedContent)</code></pre>

### AssetManager.getJavaScriptFiles
_Defined in [Piwik/AssetManager](https://github.com/piwik/piwik/blob/master/core/AssetManager.php) in line [387](https://github.com/piwik/piwik/blob/master/core/AssetManager.php#L387)_


Arguments:
<pre><code>array(&amp;$jsFiles)</code></pre>

### AssetManager.getStylesheetFiles
_Defined in [Piwik/AssetManager](https://github.com/piwik/piwik/blob/master/core/AssetManager.php) in line [282](https://github.com/piwik/piwik/blob/master/core/AssetManager.php#L282)_


Arguments:
<pre><code>array(&amp;$stylesheets)</code></pre>

### Config.NoConfigurationFile
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [207](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L207)_


Arguments:
<pre><code>array($e), $pending = true</code></pre>

### Config.badConfigurationFile
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [274](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L274)_


Arguments:
<pre><code>array($e), $pending = true</code></pre>

### Log.formatDatabaseMessage
_Defined in [Piwik/Log](https://github.com/piwik/piwik/blob/master/core/Log.php) in line [361](https://github.com/piwik/piwik/blob/master/core/Log.php#L361)_


Arguments:
<pre><code>array(&amp;$message, $level, $tag, $datetime, $this)</code></pre>

### Log.formatFileMessage
_Defined in [Piwik/Log](https://github.com/piwik/piwik/blob/master/core/Log.php) in line [316](https://github.com/piwik/piwik/blob/master/core/Log.php#L316)_


Arguments:
<pre><code>array(&amp;$message, $level, $tag, $datetime, $this)</code></pre>

### Log.formatScreenMessage
_Defined in [Piwik/Log](https://github.com/piwik/piwik/blob/master/core/Log.php) in line [346](https://github.com/piwik/piwik/blob/master/core/Log.php#L346)_


Arguments:
<pre><code>array(&amp;$message, $level, $tag, $datetime, $this)</code></pre>

### Menu.Admin.addItems
_Defined in [Piwik/Menu/Admin](https://github.com/piwik/piwik/blob/master/core/Menu/Admin.php) in line [42](https://github.com/piwik/piwik/blob/master/core/Menu/Admin.php#L42)_



### Menu.Reporting.addItems
_Defined in [Piwik/Menu/Main](https://github.com/piwik/piwik/blob/master/core/Menu/Main.php) in line [62](https://github.com/piwik/piwik/blob/master/core/Menu/Main.php#L62)_



### Menu.Top.addItems
_Defined in [Piwik/Menu/Top](https://github.com/piwik/piwik/blob/master/core/Menu/Top.php) in line [62](https://github.com/piwik/piwik/blob/master/core/Menu/Top.php#L62)_



### Reporting.createDatabase
_Defined in [Piwik/Db](https://github.com/piwik/piwik/blob/master/core/Db.php) in line [62](https://github.com/piwik/piwik/blob/master/core/Db.php#L62)_


Arguments:
<pre><code>array(&amp;$db)</code></pre>

### Reporting.getDatabaseConfig
_Defined in [Piwik/Db](https://github.com/piwik/piwik/blob/master/core/Db.php) in line [57](https://github.com/piwik/piwik/blob/master/core/Db.php#L57)_


Arguments:
<pre><code>array(&amp;$dbInfos)</code></pre>

### Request.dispatch
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [122](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L122)_


Arguments:
<pre><code>$params</code></pre>

### Request.dispatch.end
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [128](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L128)_


Arguments:
<pre><code>array(&amp;$result, $parameters)</code></pre>

### Request.dispatchCoreAndPluginUpdatesScreen
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [281](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L281)_



### Request.initAuthenticationObject
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [290](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L290)_



### Schema.loadSchema
_Defined in [Piwik/Db/Schema](https://github.com/piwik/piwik/blob/master/core/Db/Schema.php) in line [134](https://github.com/piwik/piwik/blob/master/core/Db/Schema.php#L134)_


Arguments:
<pre><code>array(&amp;$schema)</code></pre>

### Segments.getKnownSegmentsToArchiveAllSites
_Defined in [Piwik/SettingsPiwik](https://github.com/piwik/piwik/blob/master/core/SettingsPiwik.php) in line [59](https://github.com/piwik/piwik/blob/master/core/SettingsPiwik.php#L59)_


Arguments:
<pre><code>array(&amp;$cachedResult)</code></pre>

### Segments.getKnownSegmentsToArchiveForSite
_Defined in [Piwik/SettingsPiwik](https://github.com/piwik/piwik/blob/master/core/SettingsPiwik.php) in line [71](https://github.com/piwik/piwik/blob/master/core/SettingsPiwik.php#L71)_


Arguments:
<pre><code>array(&amp;$segments, $idSite)</code></pre>

### Site.getSiteAttributes
_Defined in [Piwik/Tracker/Cache](https://github.com/piwik/piwik/blob/master/core/Tracker/Cache.php) in line [64](https://github.com/piwik/piwik/blob/master/core/Tracker/Cache.php#L64)_


Arguments:
<pre><code>array(&amp;$content, $idSite)</code></pre>

### TaskScheduler.getScheduledTasks
_Defined in [Piwik/TaskScheduler](https://github.com/piwik/piwik/blob/master/core/TaskScheduler.php) in line [50](https://github.com/piwik/piwik/blob/master/core/TaskScheduler.php#L50)_


Arguments:
<pre><code>array(&amp;$tasks)</code></pre>

### Tracker.createDatabase
_Defined in [Piwik/Tracker](https://github.com/piwik/piwik/blob/master/core/Tracker.php) in line [573](https://github.com/piwik/piwik/blob/master/core/Tracker.php#L573)_


Arguments:
<pre><code>array(&amp;$db)</code></pre>

### Tracker.detectRefererSearchEngine
_Defined in [Piwik/Tracker/Referrer](https://github.com/piwik/piwik/blob/master/core/Tracker/Referrer.php) in line [130](https://github.com/piwik/piwik/blob/master/core/Tracker/Referrer.php#L130)_


Arguments:
<pre><code>array(&amp;$searchEngineInformation, $this-&gt;refererUrl)</code></pre>

### Tracker.getDatabaseConfig
_Defined in [Piwik/Tracker](https://github.com/piwik/piwik/blob/master/core/Tracker.php) in line [557](https://github.com/piwik/piwik/blob/master/core/Tracker.php#L557)_


Arguments:
<pre><code>array(&amp;$configDb)</code></pre>

### Tracker.getNewVisitObject
_Defined in [Piwik/Tracker](https://github.com/piwik/piwik/blob/master/core/Tracker.php) in line [609](https://github.com/piwik/piwik/blob/master/core/Tracker.php#L609)_


Arguments:
<pre><code>array(&amp;$visit)</code></pre>

### Tracker.isExcludedVisit
_Defined in [Piwik/Tracker/VisitExcluded](https://github.com/piwik/piwik/blob/master/core/Tracker/VisitExcluded.php) in line [78](https://github.com/piwik/piwik/blob/master/core/Tracker/VisitExcluded.php#L78)_


Arguments:
<pre><code>array(&amp;$excluded)</code></pre>

### Tracker.knownVisitorInformation
_Defined in [Piwik/Tracker/Visit](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php) in line [369](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php#L369)_


Arguments:
<pre><code>array(&amp;$this-&gt;visitorInfo)</code></pre>

### Tracker.knownVisitorUpdate
_Defined in [Piwik/Tracker/Visit](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php) in line [328](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php#L328)_


Arguments:
<pre><code>array(&amp;$valuesToUpdate)</code></pre>

### Tracker.newVisitorInformation
_Defined in [Piwik/Tracker/Visit](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php) in line [485](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php#L485)_


Arguments:
<pre><code>array(&amp;$this-&gt;visitorInfo, $extraInfo)</code></pre>

### Tracker.recordAction
_Defined in [Piwik/Tracker/Action](https://github.com/piwik/piwik/blob/master/core/Tracker/Action.php) in line [645](https://github.com/piwik/piwik/blob/master/core/Tracker/Action.php#L645)_


Arguments:
<pre><code>array($this, $info)</code></pre>

### Tracker.recordEcommerceGoal
_Defined in [Piwik/Tracker/GoalManager](https://github.com/piwik/piwik/blob/master/core/Tracker/GoalManager.php) in line [412](https://github.com/piwik/piwik/blob/master/core/Tracker/GoalManager.php#L412)_


Arguments:
<pre><code>array($goal)</code></pre>

### Tracker.recordStandardGoals
_Defined in [Piwik/Tracker/GoalManager](https://github.com/piwik/piwik/blob/master/core/Tracker/GoalManager.php) in line [773](https://github.com/piwik/piwik/blob/master/core/Tracker/GoalManager.php#L773)_


Arguments:
<pre><code>array($newGoal)</code></pre>

### Tracker.setSiteId
_Defined in [Piwik/Tracker/Request](https://github.com/piwik/piwik/blob/master/core/Tracker/Request.php) in line [295](https://github.com/piwik/piwik/blob/master/core/Tracker/Request.php#L295)_


Arguments:
<pre><code>array(&amp;$idSite, $this-&gt;params)</code></pre>

### Tracker.setTrackerCacheGeneral
_Defined in [Piwik/Tracker/Cache](https://github.com/piwik/piwik/blob/master/core/Tracker/Cache.php) in line [107](https://github.com/piwik/piwik/blob/master/core/Tracker/Cache.php#L107)_


Arguments:
<pre><code>array(&amp;$cacheContent)</code></pre>

### Tracker.setVisitorIp
_Defined in [Piwik/Tracker/Visit](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php) in line [117](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php#L117)_


Arguments:
<pre><code>array(&amp;$this-&gt;visitorInfo[&#039;location_ip&#039;])</code></pre>

### Tracker.visitorInformation
_Defined in [Piwik/Tracker/Visit](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php) in line [516](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php#L516)_


Arguments:
<pre><code>array(&amp;$this-&gt;visitorInfo)</code></pre>

### Translate.getClientSideTranslationKeys
_Defined in [Piwik/Translate](https://github.com/piwik/piwik/blob/master/core/Translate.php) in line [187](https://github.com/piwik/piwik/blob/master/core/Translate.php#L187)_


Arguments:
<pre><code>array(&amp;$result)</code></pre>

### Updater.checkForUpdates
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [311](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L311)_



### User.getLanguage
_Defined in [Piwik/Translate](https://github.com/piwik/piwik/blob/master/core/Translate.php) in line [133](https://github.com/piwik/piwik/blob/master/core/Translate.php#L133)_


Arguments:
<pre><code>array(&amp;$lang)</code></pre>

### User.isNotAuthorized
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [133](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L133)_


Arguments:
<pre><code>array($e), $pending = true</code></pre>

### Visualization.addVisualizations
_Defined in [Piwik/ViewDataTable/Visualization](https://github.com/piwik/piwik/blob/master/core/ViewDataTable/Visualization.php) in line [157](https://github.com/piwik/piwik/blob/master/core/ViewDataTable/Visualization.php#L157)_


Arguments:
<pre><code>array(&amp;$visualizations)</code></pre>

### Visualization.configureFooterIcons
_Defined in [Piwik/ViewDataTable](https://github.com/piwik/piwik/blob/master/core/ViewDataTable.php) in line [1228](https://github.com/piwik/piwik/blob/master/core/ViewDataTable.php#L1228)_


Arguments:
<pre><code>array(&amp;$result, $this)</code></pre>

### Visualization.getReportDisplayProperties
_Defined in [Piwik/ViewDataTable](https://github.com/piwik/piwik/blob/master/core/ViewDataTable.php) in line [407](https://github.com/piwik/piwik/blob/master/core/ViewDataTable.php#L407)_


Arguments:
<pre><code>array(&amp;self::$reportPropertiesCache)</code></pre>

### Visualization.initView
_Defined in [Piwik/ViewDataTable](https://github.com/piwik/piwik/blob/master/core/ViewDataTable.php) in line [1062](https://github.com/piwik/piwik/blob/master/core/ViewDataTable.php#L1062)_


Arguments:
<pre><code>array($this)</code></pre>

### WidgetsList.addWidgets
_Defined in [Piwik/WidgetsList](https://github.com/piwik/piwik/blob/master/core/WidgetsList.php) in line [62](https://github.com/piwik/piwik/blob/master/core/WidgetsList.php#L62)_



### WidgetsList.getWidgets
_Defined in [Piwik/WidgetsList](https://github.com/piwik/piwik/blob/master/core/WidgetsList.php) in line [44](https://github.com/piwik/piwik/blob/master/core/WidgetsList.php#L44)_

the documentation for tihs widetlist

### sprintf(API.%s.%s, $pluginName, $methodName)
_Defined in [Piwik/API/Proxy](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php) in line [188](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php#L188)_


Arguments:
<pre><code>array(&amp;$finalParameters)</code></pre>

### sprintf(API.%s.%s.end, $pluginName, $methodName)
_Defined in [Piwik/API/Proxy](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php) in line [200](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php#L200)_


Arguments:
<pre><code>$endHookParams</code></pre>

### sprintf(API.Request.dispatch, $pluginName, $methodName)
_Defined in [Piwik/API/Proxy](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php) in line [187](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php#L187)_


Arguments:
<pre><code>array(&amp;$finalParameters)</code></pre>

### sprintf(API.Request.dispatch.end, $pluginName, $methodName)
_Defined in [Piwik/API/Proxy](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php) in line [201](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php#L201)_


Arguments:
<pre><code>$endHookParams</code></pre>

### sprintf(Controller.%s.%s, $module, $action)
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [123](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L123)_


Arguments:
<pre><code>array($parameters)</code></pre>

### sprintf(Controller.%s.%s.end, $module, $action)
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [127](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L127)_


Arguments:
<pre><code>array(&amp;$result, $parameters)</code></pre>

