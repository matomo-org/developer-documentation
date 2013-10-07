Hooks
==========

This is a complete list of available hooks:

### sprintf(API.Request.dispatch, $pluginName, $methodName)
Defined in [Piwik/API/Proxy](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php) in line [187](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php#L187)

Arguments: array(&amp;$finalParameters)


### sprintf(API.%s.%s, $pluginName, $methodName)
Defined in [Piwik/API/Proxy](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php) in line [188](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php#L188)

Arguments: array(&amp;$finalParameters)


### sprintf(API.%s.%s.end, $pluginName, $methodName)
Defined in [Piwik/API/Proxy](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php) in line [200](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php#L200)

Arguments: $endHookParams


### sprintf(API.Request.dispatch.end, $pluginName, $methodName)
Defined in [Piwik/API/Proxy](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php) in line [201](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php#L201)

Arguments: $endHookParams


### API.Request.authenticate
Defined in [Piwik/API/Request](https://github.com/piwik/piwik/blob/master/core/API/Request.php) in line [182](https://github.com/piwik/piwik/blob/master/core/API/Request.php#L182)

Arguments: array($token_auth)


### ArchiveProcessor.Day.compute
Defined in [Piwik/ArchiveProcessor/Day](https://github.com/piwik/piwik/blob/master/core/ArchiveProcessor/Day.php) in line [105](https://github.com/piwik/piwik/blob/master/core/ArchiveProcessor/Day.php#L105)

Arguments: array(&amp;$this)


### ArchiveProcessor.Period.compute
Defined in [Piwik/ArchiveProcessor/Period](https://github.com/piwik/piwik/blob/master/core/ArchiveProcessor/Period.php) in line [187](https://github.com/piwik/piwik/blob/master/core/ArchiveProcessor/Period.php#L187)

Arguments: array(&amp;$this)


### AssetManager.filterMergedStylesheets
Defined in [Piwik/AssetManager](https://github.com/piwik/piwik/blob/master/core/AssetManager.php) in line [163](https://github.com/piwik/piwik/blob/master/core/AssetManager.php#L163)

Arguments: array(&amp;$mergedContent)


### AssetManager.getStylesheetFiles
Defined in [Piwik/AssetManager](https://github.com/piwik/piwik/blob/master/core/AssetManager.php) in line [282](https://github.com/piwik/piwik/blob/master/core/AssetManager.php#L282)

Arguments: array(&amp;$stylesheets)


### AssetManager.filterMergedJavaScripts
Defined in [Piwik/AssetManager](https://github.com/piwik/piwik/blob/master/core/AssetManager.php) in line [357](https://github.com/piwik/piwik/blob/master/core/AssetManager.php#L357)

Arguments: array(&amp;$mergedContent)


### AssetManager.getJavaScriptFiles
Defined in [Piwik/AssetManager](https://github.com/piwik/piwik/blob/master/core/AssetManager.php) in line [387](https://github.com/piwik/piwik/blob/master/core/AssetManager.php#L387)

Arguments: array(&amp;$jsFiles)


### Schema.loadSchema
Defined in [Piwik/Db/Schema](https://github.com/piwik/piwik/blob/master/core/Db/Schema.php) in line [134](https://github.com/piwik/piwik/blob/master/core/Db/Schema.php#L134)

Arguments: array(&amp;$schema)


### Reporting.getDatabaseConfig
Defined in [Piwik/Db](https://github.com/piwik/piwik/blob/master/core/Db.php) in line [57](https://github.com/piwik/piwik/blob/master/core/Db.php#L57)

Arguments: array(&amp;$dbInfos)


### Reporting.createDatabase
Defined in [Piwik/Db](https://github.com/piwik/piwik/blob/master/core/Db.php) in line [62](https://github.com/piwik/piwik/blob/master/core/Db.php#L62)

Arguments: array(&amp;$db)


### Request.dispatch
Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [122](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L122)

Arguments: $params


### sprintf(Controller.%s.%s, $module, $action)
Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [123](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L123)

Arguments: array($parameters)


### sprintf(Controller.%s.%s.end, $module, $action)
Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [127](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L127)

Arguments: array(&amp;$result, $parameters)


### Request.dispatch.end
Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [128](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L128)

Arguments: array(&amp;$result, $parameters)


### User.isNotAuthorized
Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [133](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L133)

Arguments: array($e), $pending = true


### Config.NoConfigurationFile
Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [207](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L207)

Arguments: array($e), $pending = true


### Config.badConfigurationFile
Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [274](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L274)

Arguments: array($e), $pending = true


### Request.dispatchCoreAndPluginUpdatesScreen
Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [281](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L281)

Arguments: 


### Request.initAuthenticationObject
Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [290](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L290)

Arguments: 


### Updater.checkForUpdates
Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [311](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L311)

Arguments: 


### $eventName
Defined in [/](https://github.com/piwik/piwik/blob/master/core/functions.php) in line [53](https://github.com/piwik/piwik/blob/master/core/functions.php#L53)

Arguments: $params, $pending, $plugins


### Log.formatFileMessage
Defined in [Piwik/Log](https://github.com/piwik/piwik/blob/master/core/Log.php) in line [316](https://github.com/piwik/piwik/blob/master/core/Log.php#L316)

Arguments: array(&amp;$message, $level, $tag, $datetime, $this)


### Log.formatScreenMessage
Defined in [Piwik/Log](https://github.com/piwik/piwik/blob/master/core/Log.php) in line [346](https://github.com/piwik/piwik/blob/master/core/Log.php#L346)

Arguments: array(&amp;$message, $level, $tag, $datetime, $this)


### Log.formatDatabaseMessage
Defined in [Piwik/Log](https://github.com/piwik/piwik/blob/master/core/Log.php) in line [361](https://github.com/piwik/piwik/blob/master/core/Log.php#L361)

Arguments: array(&amp;$message, $level, $tag, $datetime, $this)


### Menu.Admin.addItems
Defined in [Piwik/Menu/Admin](https://github.com/piwik/piwik/blob/master/core/Menu/Admin.php) in line [42](https://github.com/piwik/piwik/blob/master/core/Menu/Admin.php#L42)

Arguments: 


### Menu.Reporting.addItems
Defined in [Piwik/Menu/Main](https://github.com/piwik/piwik/blob/master/core/Menu/Main.php) in line [62](https://github.com/piwik/piwik/blob/master/core/Menu/Main.php#L62)

Arguments: 


### Menu.Top.addItems
Defined in [Piwik/Menu/Top](https://github.com/piwik/piwik/blob/master/core/Menu/Top.php) in line [62](https://github.com/piwik/piwik/blob/master/core/Menu/Top.php#L62)

Arguments: 


### Segments.getKnownSegmentsToArchiveAllSites
Defined in [Piwik/SettingsPiwik](https://github.com/piwik/piwik/blob/master/core/SettingsPiwik.php) in line [59](https://github.com/piwik/piwik/blob/master/core/SettingsPiwik.php#L59)

Arguments: array(&amp;$cachedResult)


### Segments.getKnownSegmentsToArchiveForSite
Defined in [Piwik/SettingsPiwik](https://github.com/piwik/piwik/blob/master/core/SettingsPiwik.php) in line [71](https://github.com/piwik/piwik/blob/master/core/SettingsPiwik.php#L71)

Arguments: array(&amp;$segments, $idSite)


### TaskScheduler.getScheduledTasks
Defined in [Piwik/TaskScheduler](https://github.com/piwik/piwik/blob/master/core/TaskScheduler.php) in line [50](https://github.com/piwik/piwik/blob/master/core/TaskScheduler.php#L50)

Arguments: array(&amp;$tasks)


### Tracker.recordAction
Defined in [Piwik/Tracker/Action](https://github.com/piwik/piwik/blob/master/core/Tracker/Action.php) in line [645](https://github.com/piwik/piwik/blob/master/core/Tracker/Action.php#L645)

Arguments: array($this, $info)


### Site.getSiteAttributes
Defined in [Piwik/Tracker/Cache](https://github.com/piwik/piwik/blob/master/core/Tracker/Cache.php) in line [64](https://github.com/piwik/piwik/blob/master/core/Tracker/Cache.php#L64)

Arguments: array(&amp;$content, $idSite)


### Tracker.setTrackerCacheGeneral
Defined in [Piwik/Tracker/Cache](https://github.com/piwik/piwik/blob/master/core/Tracker/Cache.php) in line [107](https://github.com/piwik/piwik/blob/master/core/Tracker/Cache.php#L107)

Arguments: array(&amp;$cacheContent)


### Tracker.recordEcommerceGoal
Defined in [Piwik/Tracker/GoalManager](https://github.com/piwik/piwik/blob/master/core/Tracker/GoalManager.php) in line [412](https://github.com/piwik/piwik/blob/master/core/Tracker/GoalManager.php#L412)

Arguments: array($goal)


### Tracker.recordStandardGoals
Defined in [Piwik/Tracker/GoalManager](https://github.com/piwik/piwik/blob/master/core/Tracker/GoalManager.php) in line [773](https://github.com/piwik/piwik/blob/master/core/Tracker/GoalManager.php#L773)

Arguments: array($newGoal)


### Tracker.detectRefererSearchEngine
Defined in [Piwik/Tracker/Referrer](https://github.com/piwik/piwik/blob/master/core/Tracker/Referrer.php) in line [130](https://github.com/piwik/piwik/blob/master/core/Tracker/Referrer.php#L130)

Arguments: array(&amp;$searchEngineInformation, $this-&gt;refererUrl)


### Tracker.setSiteId
Defined in [Piwik/Tracker/Request](https://github.com/piwik/piwik/blob/master/core/Tracker/Request.php) in line [295](https://github.com/piwik/piwik/blob/master/core/Tracker/Request.php#L295)

Arguments: array(&amp;$idSite, $this-&gt;params)


### Tracker.setVisitorIp
Defined in [Piwik/Tracker/Visit](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php) in line [117](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php#L117)

Arguments: array(&amp;$this-&gt;visitorInfo[&#039;location_ip&#039;])


### Tracker.knownVisitorUpdate
Defined in [Piwik/Tracker/Visit](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php) in line [328](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php#L328)

Arguments: array(&amp;$valuesToUpdate)


### Tracker.knownVisitorInformation
Defined in [Piwik/Tracker/Visit](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php) in line [369](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php#L369)

Arguments: array(&amp;$this-&gt;visitorInfo)


### Tracker.newVisitorInformation
Defined in [Piwik/Tracker/Visit](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php) in line [485](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php#L485)

Arguments: array(&amp;$this-&gt;visitorInfo, $extraInfo)


### Tracker.visitorInformation
Defined in [Piwik/Tracker/Visit](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php) in line [516](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php#L516)

Arguments: array(&amp;$this-&gt;visitorInfo)


### Tracker.isExcludedVisit
Defined in [Piwik/Tracker/VisitExcluded](https://github.com/piwik/piwik/blob/master/core/Tracker/VisitExcluded.php) in line [78](https://github.com/piwik/piwik/blob/master/core/Tracker/VisitExcluded.php#L78)

Arguments: array(&amp;$excluded)


### Tracker.getDatabaseConfig
Defined in [Piwik/Tracker](https://github.com/piwik/piwik/blob/master/core/Tracker.php) in line [557](https://github.com/piwik/piwik/blob/master/core/Tracker.php#L557)

Arguments: array(&amp;$configDb)


### Tracker.createDatabase
Defined in [Piwik/Tracker](https://github.com/piwik/piwik/blob/master/core/Tracker.php) in line [573](https://github.com/piwik/piwik/blob/master/core/Tracker.php#L573)

Arguments: array(&amp;$db)


### Tracker.getNewVisitObject
Defined in [Piwik/Tracker](https://github.com/piwik/piwik/blob/master/core/Tracker.php) in line [609](https://github.com/piwik/piwik/blob/master/core/Tracker.php#L609)

Arguments: array(&amp;$visit)


### User.getLanguage
Defined in [Piwik/Translate](https://github.com/piwik/piwik/blob/master/core/Translate.php) in line [133](https://github.com/piwik/piwik/blob/master/core/Translate.php#L133)

Arguments: array(&amp;$lang)


### Translate.getClientSideTranslationKeys
Defined in [Piwik/Translate](https://github.com/piwik/piwik/blob/master/core/Translate.php) in line [187](https://github.com/piwik/piwik/blob/master/core/Translate.php#L187)

Arguments: array(&amp;$result)


### $eventName
Defined in [Piwik/Twig](https://github.com/piwik/piwik/blob/master/core/Twig.php) in line [108](https://github.com/piwik/piwik/blob/master/core/Twig.php#L108)

Arguments: array(&amp;$str)


### Visualization.addVisualizations
Defined in [Piwik/ViewDataTable/Visualization](https://github.com/piwik/piwik/blob/master/core/ViewDataTable/Visualization.php) in line [157](https://github.com/piwik/piwik/blob/master/core/ViewDataTable/Visualization.php#L157)

Arguments: array(&amp;$visualizations)


### Visualization.getReportDisplayProperties
Defined in [Piwik/ViewDataTable](https://github.com/piwik/piwik/blob/master/core/ViewDataTable.php) in line [407](https://github.com/piwik/piwik/blob/master/core/ViewDataTable.php#L407)

Arguments: array(&amp;self::$reportPropertiesCache)


### Visualization.initView
Defined in [Piwik/ViewDataTable](https://github.com/piwik/piwik/blob/master/core/ViewDataTable.php) in line [1062](https://github.com/piwik/piwik/blob/master/core/ViewDataTable.php#L1062)

Arguments: array($this)


### Visualization.configureFooterIcons
Defined in [Piwik/ViewDataTable](https://github.com/piwik/piwik/blob/master/core/ViewDataTable.php) in line [1228](https://github.com/piwik/piwik/blob/master/core/ViewDataTable.php#L1228)

Arguments: array(&amp;$result, $this)


### WidgetsList.getWidgets
Defined in [Piwik/WidgetsList](https://github.com/piwik/piwik/blob/master/core/WidgetsList.php) in line [44](https://github.com/piwik/piwik/blob/master/core/WidgetsList.php#L44)

Arguments: 

/**
 * the documentation for tihs widetlist
 */

### WidgetsList.addWidgets
Defined in [Piwik/WidgetsList](https://github.com/piwik/piwik/blob/master/core/WidgetsList.php) in line [62](https://github.com/piwik/piwik/blob/master/core/WidgetsList.php#L62)

Arguments: 


