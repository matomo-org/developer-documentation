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
_Defined in [Piwik/API/Proxy](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php) in line [196](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php#L196)_

This event is similar to the `API.Request.dispatch` event. It distinguishes the possibility to subscribe
only to a specific API method instead of all API methods. You can use it for example to modify any input
parameters or to execute any other logic before the actual API method is called.

Callback Signature:
<pre><code>function(&amp;$finalParameters)</code></pre>


#### API.$pluginName.$methodName.end
_Defined in [Piwik/API/Proxy](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php) in line [225](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php#L225)_

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
_Defined in [Piwik/API/Request](https://github.com/piwik/piwik/blob/master/core/API/Request.php) in line [190](https://github.com/piwik/piwik/blob/master/core/API/Request.php#L190)_

This event will be triggered if the token_auth is found in the $request parameter. In this case the
current session will be authenticated using this token_auth. It will overwrite the previous Auth object.

Callback Signature:
<pre><code>function($token_auth)</code></pre>


#### API.Request.dispatch
_Defined in [Piwik/API/Proxy](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php) in line [189](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php#L189)_

Generic hook that plugins can use to modify any input to any API method. You could also use this to build
an enhanced permission system. The event is triggered shortly before any API method is executed.

The `$fnalParameters` contains all paramteres that will be passed to the actual API method.

Callback Signature:
<pre><code>function(&amp;$finalParameters)</code></pre>


#### API.Request.dispatch.end
_Defined in [Piwik/API/Proxy](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php) in line [242](https://github.com/piwik/piwik/blob/master/core/API/Proxy.php#L242)_

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
_Defined in [Piwik/ArchiveProcessor/Day](https://github.com/piwik/piwik/blob/master/core/ArchiveProcessor/Day.php) in line [122](https://github.com/piwik/piwik/blob/master/core/ArchiveProcessor/Day.php#L122)_

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

## AssetManager

#### AssetManager.filterMergedJavaScripts
_Defined in [Piwik/AssetManager](https://github.com/piwik/piwik/blob/master/core/AssetManager.php) in line [385](https://github.com/piwik/piwik/blob/master/core/AssetManager.php#L385)_

This event is triggered after the JavaScript files are minified and merged to a single file but before the generated JS file is written to disk. It can be used to change the generated JavaScript to your needs,
like adding further scripts or storing the generated file somewhere else.

Callback Signature:
<pre><code>function(&amp;$mergedContent)</code></pre>


#### AssetManager.filterMergedStylesheets
_Defined in [Piwik/AssetManager](https://github.com/piwik/piwik/blob/master/core/AssetManager.php) in line [168](https://github.com/piwik/piwik/blob/master/core/AssetManager.php#L168)_

This event is triggered after the less stylesheets are compiled to CSS, minified and merged but before the generated CSS is written to disk. It can be used to change the generated stylesheets to your needs,
like replacing image paths or adding further custom stylesheets.

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


#### AssetManager.getStylesheetFiles
_Defined in [Piwik/AssetManager](https://github.com/piwik/piwik/blob/master/core/AssetManager.php) in line [303](https://github.com/piwik/piwik/blob/master/core/AssetManager.php#L303)_

This event is triggered to gather a list of all stylesheets (CSS and Less). Use this event to add your own
stylesheets. Note: In case you are in development you may enable the config setting `disable_merged_assets`.
Otherwise your custom stylesheets won't be loaded. It is best practice to place stylesheet files within a
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

## Config

#### Config.badConfigurationFile
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [321](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L321)_

This event is triggered in case a config file is not in the correct format or in case required values are missing. The event can be used to start the installation process or to display a custom error
message.

Callback Signature:
<pre><code>function($exception)</code></pre>


#### Config.NoConfigurationFile
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [248](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L248)_

This event is triggered in case no configuration file is available. This usually means Piwik is not
installed yet. The event can be used to start the installation process or to display a custom error
message.

Callback Signature:
<pre><code>function($exception)</code></pre>

## Controller

#### Controller.$module.$action
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [140](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L140)_

This event is similar to the `Request.dispatch` hook. It distinguishes the possibility to subscribe only to a
specific controller call instead of all controller calls. You can use it for example to modify any input
parameters or execute any other logic before the actual controller is called.

Callback Signature:
<pre><code>function($parameters)</code></pre>


#### Controller.$module.$action.end
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [150](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L150)_

This event is similar to the `Request.dispatch.end` hook. It distinguishes the possibility to subscribe
only to the end of a specific controller call instead of all controller calls. You can use it for example
to modify the response of a single controller.

Callback Signature:
<pre><code>function(&amp;$result, $parameters)</code></pre>

## Goals

#### Goals.getReportsWithGoalMetrics
_Defined in [Piwik/Plugins/Goals/Goals](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php) in line [343](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L343)_



Callback Signature:
<pre><code>function(&amp;$reportsWithGoals)</code></pre>


#### Goals.getReportsWithGoalMetrics
_Defined in [Piwik/Plugins/Goals/Goals](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php) in line [39](https://github.com/piwik/piwik/blob/master/plugins/Goals/Goals.php#L39)_



Callback Signature:
<pre><code>function(&amp;$dimensions)</code></pre>

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
_Defined in [Piwik/Plugins/UsersManager/Controller](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/Controller.php) in line [325](https://github.com/piwik/piwik/blob/master/plugins/UsersManager/Controller.php#L325)_



Callback Signature:
<pre><code>function($info)</code></pre>


#### Login.initSession
_Defined in [Piwik/Plugins/Login/Controller](https://github.com/piwik/piwik/blob/master/plugins/Login/Controller.php) in line [172](https://github.com/piwik/piwik/blob/master/plugins/Login/Controller.php#L172)_



Callback Signature:
<pre><code>function(&amp;$info)</code></pre>

## Menu

#### Menu.Admin.addItems
_Defined in [Piwik/Menu/Admin](https://github.com/piwik/piwik/blob/master/core/Menu/Admin.php) in line [63](https://github.com/piwik/piwik/blob/master/core/Menu/Admin.php#L63)_

This event is triggered to collect all available admin menu items. Subscribe to this event if you want
to add one or more items to the Piwik admin menu. It's fairly easy. Just define the name of your menu
item as well as a controller and an action that should be executed once a user selects your menu item.
It is also possible to display the item only for users having a specific role.

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


#### Menu.Reporting.addItems
_Defined in [Piwik/Menu/Main](https://github.com/piwik/piwik/blob/master/core/Menu/Main.php) in line [83](https://github.com/piwik/piwik/blob/master/core/Menu/Main.php#L83)_

This event is triggered to collect all available reporting menu items. Subscribe to this event if you
want to add one or more items to the Piwik reporting menu. It's fairly easy. Just define the name of your
menu item as well as a controller and an action that should be executed once a user selects your menu
item. It is also possible to display the item only for users having a specific role.

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


#### Menu.Top.addItems
_Defined in [Piwik/Menu/Top](https://github.com/piwik/piwik/blob/master/core/Menu/Top.php) in line [83](https://github.com/piwik/piwik/blob/master/core/Menu/Top.php#L83)_

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

## Provider

#### Provider.getCleanHostname
_Defined in [Piwik/Plugins/Provider/Provider](https://github.com/piwik/piwik/blob/master/plugins/Provider/Provider.php) in line [165](https://github.com/piwik/piwik/blob/master/plugins/Provider/Provider.php#L165)_



Callback Signature:
<pre><code>function(&amp;$cleanHostname, $hostname)</code></pre>

## Reporting

#### Reporting.createDatabase
_Defined in [Piwik/Db](https://github.com/piwik/piwik/blob/master/core/Db.php) in line [74](https://github.com/piwik/piwik/blob/master/core/Db.php#L74)_

This event is triggered after the database config is loaded but immediately before a connection to the database is established. Use this event to create your own database handler instead of the default Piwik
DB handler.

Callback Signature:
<pre><code>function(&amp;$db)</code></pre>


#### Reporting.getDatabaseConfig
_Defined in [Piwik/Db](https://github.com/piwik/piwik/blob/master/core/Db.php) in line [63](https://github.com/piwik/piwik/blob/master/core/Db.php#L63)_

This event is triggered before a connection to the database is established. Use it to dynamically change the
datatabase settings defined in the config. The reporting database config is used in case someone accesses
the Piwik UI.

Callback Signature:
<pre><code>function(&amp;$dbInfos)</code></pre>

## Request

#### Request.dispatch
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [133](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L133)_

Generic hook that plugins can use to modify any input to the function, or even change the plugin being called. You could also use this to build an enhanced permission system. The event is triggered before any
controller is called.

The `$params` array contains the following properties: `array($module, $action, $parameters, $controller)`

Callback Signature:
<pre><code>$params</code></pre>


#### Request.dispatch.end
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [157](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L157)_

Generic hook that plugins can use to modify any output of any controller. The event is triggered after
any controller is executed but before the result is send to the user. The parameters originally
passed to the controller are available as well.

Callback Signature:
<pre><code>function(&amp;$result, $parameters)</code></pre>


#### Request.dispatchCoreAndPluginUpdatesScreen
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [333](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L333)_

This event is triggered after the platform is initialized and most plugins are loaded. The user is not
authenticated at this point though. You can use this event for instance to initialize your own plugin.


#### Request.initAuthenticationObject
_Defined in [Piwik/Plugins/Overlay/API](https://github.com/piwik/piwik/blob/master/plugins/Overlay/API.php) in line [120](https://github.com/piwik/piwik/blob/master/plugins/Overlay/API.php#L120)_



Callback Signature:
<pre><code>function($allowCookieAuthentication = true)</code></pre>


#### Request.initAuthenticationObject
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [347](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L347)_

This event is triggered shortly before the user is authenticated. Use it to create your own
authentication object instead of the Piwik authentication. Make sure to implement the `Piwik\Auth`
interface in case you want to define your own authentication.

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
_Defined in [Piwik/Db/Schema](https://github.com/piwik/piwik/blob/master/core/Db/Schema.php) in line [137](https://github.com/piwik/piwik/blob/master/core/Db/Schema.php#L137)_



Callback Signature:
<pre><code>function(&amp;$schema)</code></pre>

## SegmentEditor

#### SegmentEditor.deactivate
_Defined in [Piwik/Plugins/SegmentEditor/API](https://github.com/piwik/piwik/blob/master/plugins/SegmentEditor/API.php) in line [313](https://github.com/piwik/piwik/blob/master/plugins/SegmentEditor/API.php#L313)_



Callback Signature:
<pre><code>function(&amp;$idSegment)</code></pre>

## Segments

#### Segments.getKnownSegmentsToArchiveAllSites
_Defined in [Piwik/SettingsPiwik](https://github.com/piwik/piwik/blob/master/core/SettingsPiwik.php) in line [68](https://github.com/piwik/piwik/blob/master/core/SettingsPiwik.php#L68)_



Callback Signature:
<pre><code>function(&amp;$cachedResult)</code></pre>


#### Segments.getKnownSegmentsToArchiveForSite
_Defined in [Piwik/SettingsPiwik](https://github.com/piwik/piwik/blob/master/core/SettingsPiwik.php) in line [84](https://github.com/piwik/piwik/blob/master/core/SettingsPiwik.php#L84)_



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
_Defined in [Piwik/TaskScheduler](https://github.com/piwik/piwik/blob/master/core/TaskScheduler.php) in line [70](https://github.com/piwik/piwik/blob/master/core/TaskScheduler.php#L70)_

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

## Tracker

#### Tracker.createDatabase
_Defined in [Piwik/Tracker](https://github.com/piwik/piwik/blob/master/core/Tracker.php) in line [584](https://github.com/piwik/piwik/blob/master/core/Tracker.php#L584)_

This event is triggered after the database config is loaded but immediately before a connection to the database is established. Use this event to create your own database handler instead of the default Piwik
DB handler.

Callback Signature:
<pre><code>function(&amp;$db)</code></pre>


#### Tracker.detectReferrerSearchEngine
_Defined in [Piwik/Tracker/Referrer](https://github.com/piwik/piwik/blob/master/core/Tracker/Referrer.php) in line [130](https://github.com/piwik/piwik/blob/master/core/Tracker/Referrer.php#L130)_



Callback Signature:
<pre><code>function(&amp;$searchEngineInformation, $this-&gt;referrerUrl)</code></pre>


#### Tracker.getDatabaseConfig
_Defined in [Piwik/Tracker](https://github.com/piwik/piwik/blob/master/core/Tracker.php) in line [562](https://github.com/piwik/piwik/blob/master/core/Tracker.php#L562)_

This event is triggered before a connection to the database is established. Use it to dynamically change the
datatabase settings defined in the config. The tracker database config is used in case a new pageview/visit
will be tracked.

Callback Signature:
<pre><code>function(&amp;$configDb)</code></pre>


#### Tracker.getNewVisitObject
_Defined in [Piwik/Tracker](https://github.com/piwik/piwik/blob/master/core/Tracker.php) in line [626](https://github.com/piwik/piwik/blob/master/core/Tracker.php#L626)_

This event is triggered once a new `Piwik\Tracker\Visit` object is requested. Use this event to force the
usage of your own or your extended visit object but make sure to implement the
`Piwik\Tracker\VisitInterface`.

Callback Signature:
<pre><code>function(&amp;$visit)</code></pre>


#### Tracker.isExcludedVisit
_Defined in [Piwik/Tracker/VisitExcluded](https://github.com/piwik/piwik/blob/master/core/Tracker/VisitExcluded.php) in line [78](https://github.com/piwik/piwik/blob/master/core/Tracker/VisitExcluded.php#L78)_



Callback Signature:
<pre><code>function(&amp;$excluded)</code></pre>


#### Tracker.knownVisitorInformation
_Defined in [Piwik/Tracker/Visit](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php) in line [353](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php#L353)_



Callback Signature:
<pre><code>function(&amp;$this-&gt;visitorInfo)</code></pre>


#### Tracker.knownVisitorUpdate
_Defined in [Piwik/Tracker/Visit](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php) in line [312](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php#L312)_



Callback Signature:
<pre><code>function(&amp;$valuesToUpdate)</code></pre>


#### Tracker.newVisitorInformation
_Defined in [Piwik/Tracker/Visit](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php) in line [469](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php#L469)_



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
_Defined in [Piwik/Tracker/Visit](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php) in line [101](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php#L101)_



Callback Signature:
<pre><code>function(&amp;$this-&gt;visitorInfo[&#039;location_ip&#039;])</code></pre>


#### Tracker.visitorInformation
_Defined in [Piwik/Tracker/Visit](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php) in line [500](https://github.com/piwik/piwik/blob/master/core/Tracker/Visit.php#L500)_



Callback Signature:
<pre><code>function(&amp;$this-&gt;visitorInfo)</code></pre>

## Translate

#### Translate.getClientSideTranslationKeys
_Defined in [Piwik/Translate](https://github.com/piwik/piwik/blob/master/core/Translate.php) in line [190](https://github.com/piwik/piwik/blob/master/core/Translate.php#L190)_

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
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [373](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L373)_

This event is triggered to check for updates. It is triggered after the platform is initialized and after
the user is authenticated but before the platform is going to dispatch the actual request. You can use
it to check for any updates.

## User

#### User.getLanguage
_Defined in [Piwik/Translate](https://github.com/piwik/piwik/blob/master/core/Translate.php) in line [121](https://github.com/piwik/piwik/blob/master/core/Translate.php#L121)_

This event is triggered to identify the language code, such as 'en', for the current user. You can use
it for instance to detect the users language by using a third party API such as a CMS. The language that
is set in the request URL is passed as an argument.

Callback Signature:
<pre><code>function(&amp;$lang)</code></pre>


#### User.isNotAuthorized
_Defined in [Piwik/FrontController](https://github.com/piwik/piwik/blob/master/core/FrontController.php) in line [168](https://github.com/piwik/piwik/blob/master/core/FrontController.php#L168)_

This event is triggered in case the user wants to access anything in the Piwik UI but has not the required permissions to do this. You can subscribe to this event to display a custom error message or
to display a custom login form in such a case.

Callback Signature:
<pre><code>function($exception)</code></pre>

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
_Defined in [Piwik/ViewDataTable](https://github.com/piwik/piwik/blob/master/core/ViewDataTable.php) in line [1301](https://github.com/piwik/piwik/blob/master/core/ViewDataTable.php#L1301)_

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
your own report, you mant to subscribe to this event to define how your report shall be displayed in the
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


#### Visualization.initView
_Defined in [Piwik/ViewDataTable](https://github.com/piwik/piwik/blob/master/core/ViewDataTable.php) in line [1108](https://github.com/piwik/piwik/blob/master/core/ViewDataTable.php#L1108)_

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
one or more custom widgets. It's fairly easy. Just define the name of your widgets as well as a
controller and an action that should be executed once your widget is requested.

Example:
```
public function addWidgets()
{
    WidgetsList::add('General_Actions', 'General_Pages', 'Actions', 'getPageUrls');
}
```

