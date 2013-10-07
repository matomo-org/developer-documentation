Hooks
==========

This is a complete list of available hooks:

### sprintf(API.Request.dispatch, $pluginName, $methodName)
Defined in Piwik/API/Proxy in line 187

Arguments: array(&amp;$finalParameters)


### sprintf(API.%s.%s, $pluginName, $methodName)
Defined in Piwik/API/Proxy in line 188

Arguments: array(&amp;$finalParameters)


### sprintf(API.%s.%s.end, $pluginName, $methodName)
Defined in Piwik/API/Proxy in line 200

Arguments: $endHookParams


### sprintf(API.Request.dispatch.end, $pluginName, $methodName)
Defined in Piwik/API/Proxy in line 201

Arguments: $endHookParams


### API.Request.authenticate
Defined in Piwik/API/Request in line 182

Arguments: array($token_auth)


### ArchiveProcessor.Day.compute
Defined in Piwik/ArchiveProcessor/Day in line 105

Arguments: array(&amp;$this)


### ArchiveProcessor.Period.compute
Defined in Piwik/ArchiveProcessor/Period in line 187

Arguments: array(&amp;$this)


### AssetManager.filterMergedStylesheets
Defined in Piwik/AssetManager in line 163

Arguments: array(&amp;$mergedContent)


### AssetManager.getStylesheetFiles
Defined in Piwik/AssetManager in line 282

Arguments: array(&amp;$stylesheets)


### AssetManager.filterMergedJavaScripts
Defined in Piwik/AssetManager in line 357

Arguments: array(&amp;$mergedContent)


### AssetManager.getJavaScriptFiles
Defined in Piwik/AssetManager in line 387

Arguments: array(&amp;$jsFiles)


### Schema.loadSchema
Defined in Piwik/Db/Schema in line 134

Arguments: array(&amp;$schema)


### Reporting.getDatabaseConfig
Defined in Piwik/Db in line 57

Arguments: array(&amp;$dbInfos)


### Reporting.createDatabase
Defined in Piwik/Db in line 62

Arguments: array(&amp;$db)


### Request.dispatch
Defined in Piwik/FrontController in line 122

Arguments: $params


### sprintf(Controller.%s.%s, $module, $action)
Defined in Piwik/FrontController in line 123

Arguments: array($parameters)


### sprintf(Controller.%s.%s.end, $module, $action)
Defined in Piwik/FrontController in line 127

Arguments: array(&amp;$result, $parameters)


### Request.dispatch.end
Defined in Piwik/FrontController in line 128

Arguments: array(&amp;$result, $parameters)


### User.isNotAuthorized
Defined in Piwik/FrontController in line 133

Arguments: array($e), $pending = true


### Config.NoConfigurationFile
Defined in Piwik/FrontController in line 207

Arguments: array($e), $pending = true


### Config.badConfigurationFile
Defined in Piwik/FrontController in line 274

Arguments: array($e), $pending = true


### Request.dispatchCoreAndPluginUpdatesScreen
Defined in Piwik/FrontController in line 281

Arguments: 


### Request.initAuthenticationObject
Defined in Piwik/FrontController in line 290

Arguments: 


### Updater.checkForUpdates
Defined in Piwik/FrontController in line 311

Arguments: 


### $eventName
Defined in / in line 53

Arguments: $params, $pending, $plugins


### Log.formatFileMessage
Defined in Piwik/Log in line 316

Arguments: array(&amp;$message, $level, $tag, $datetime, $this)


### Log.formatScreenMessage
Defined in Piwik/Log in line 346

Arguments: array(&amp;$message, $level, $tag, $datetime, $this)


### Log.formatDatabaseMessage
Defined in Piwik/Log in line 361

Arguments: array(&amp;$message, $level, $tag, $datetime, $this)


### Menu.Admin.addItems
Defined in Piwik/Menu/Admin in line 42

Arguments: 


### Menu.Reporting.addItems
Defined in Piwik/Menu/Main in line 62

Arguments: 


### Menu.Top.addItems
Defined in Piwik/Menu/Top in line 62

Arguments: 


### Segments.getKnownSegmentsToArchiveAllSites
Defined in Piwik/SettingsPiwik in line 59

Arguments: array(&amp;$cachedResult)


### Segments.getKnownSegmentsToArchiveForSite
Defined in Piwik/SettingsPiwik in line 71

Arguments: array(&amp;$segments, $idSite)


### TaskScheduler.getScheduledTasks
Defined in Piwik/TaskScheduler in line 50

Arguments: array(&amp;$tasks)


### Tracker.recordAction
Defined in Piwik/Tracker/Action in line 645

Arguments: array($this, $info)


### Site.getSiteAttributes
Defined in Piwik/Tracker/Cache in line 64

Arguments: array(&amp;$content, $idSite)


### Tracker.setTrackerCacheGeneral
Defined in Piwik/Tracker/Cache in line 107

Arguments: array(&amp;$cacheContent)


### Tracker.recordEcommerceGoal
Defined in Piwik/Tracker/GoalManager in line 412

Arguments: array($goal)


### Tracker.recordStandardGoals
Defined in Piwik/Tracker/GoalManager in line 773

Arguments: array($newGoal)


### Tracker.detectRefererSearchEngine
Defined in Piwik/Tracker/Referrer in line 130

Arguments: array(&amp;$searchEngineInformation, $this-&gt;refererUrl)


### Tracker.setSiteId
Defined in Piwik/Tracker/Request in line 295

Arguments: array(&amp;$idSite, $this-&gt;params)


### Tracker.setVisitorIp
Defined in Piwik/Tracker/Visit in line 117

Arguments: array(&amp;$this-&gt;visitorInfo[&#039;location_ip&#039;])


### Tracker.knownVisitorUpdate
Defined in Piwik/Tracker/Visit in line 328

Arguments: array(&amp;$valuesToUpdate)


### Tracker.knownVisitorInformation
Defined in Piwik/Tracker/Visit in line 369

Arguments: array(&amp;$this-&gt;visitorInfo)


### Tracker.newVisitorInformation
Defined in Piwik/Tracker/Visit in line 485

Arguments: array(&amp;$this-&gt;visitorInfo, $extraInfo)


### Tracker.visitorInformation
Defined in Piwik/Tracker/Visit in line 516

Arguments: array(&amp;$this-&gt;visitorInfo)


### Tracker.isExcludedVisit
Defined in Piwik/Tracker/VisitExcluded in line 78

Arguments: array(&amp;$excluded)


### Tracker.getDatabaseConfig
Defined in Piwik/Tracker in line 557

Arguments: array(&amp;$configDb)


### Tracker.createDatabase
Defined in Piwik/Tracker in line 573

Arguments: array(&amp;$db)


### Tracker.getNewVisitObject
Defined in Piwik/Tracker in line 609

Arguments: array(&amp;$visit)


### User.getLanguage
Defined in Piwik/Translate in line 133

Arguments: array(&amp;$lang)


### Translate.getClientSideTranslationKeys
Defined in Piwik/Translate in line 187

Arguments: array(&amp;$result)


### $eventName
Defined in Piwik/Twig in line 108

Arguments: array(&amp;$str)


### Visualization.addVisualizations
Defined in Piwik/ViewDataTable/Visualization in line 157

Arguments: array(&amp;$visualizations)


### Visualization.getReportDisplayProperties
Defined in Piwik/ViewDataTable in line 407

Arguments: array(&amp;self::$reportPropertiesCache)


### Visualization.initView
Defined in Piwik/ViewDataTable in line 1062

Arguments: array($this)


### Visualization.configureFooterIcons
Defined in Piwik/ViewDataTable in line 1228

Arguments: array(&amp;$result, $this)


### WidgetsList.getWidgets
Defined in Piwik/WidgetsList in line 44

Arguments: 

/**
 * the documentation for tihs widetlist
 */

### WidgetsList.addWidgets
Defined in Piwik/WidgetsList in line 62

Arguments: 


