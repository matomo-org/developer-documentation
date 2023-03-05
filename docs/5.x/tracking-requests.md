---
category: DevelopInDepth
---
# Tracking Requests

## About this guide

**Read this guide if**

* you want to manipulate a tracking request and change what information is being stored and which requests should be processed
* you want to store additional data during a tracking request
* implement a new action

## Request processor

Plugins can define so called "request processors" to manipulate a tracking request at various stages of a tracking request.

They are currently only documented in the [RequestProcessor class itself](https://github.com/matomo-org/matomo/blob/4.x-dev/core/Tracker/RequestProcessor.php). You can use this to change/modify/remove/add tracking request parameters, to discard tracking requests, to record additional data, and more.

For example, the Privacy Manager plugin uses a request processor to anonymise certain data automatically. Some tracking plugins like Media Analytics or Form Analytics use them to track additional data.

### Adding a new request processor

To add such a request processor, simply create a new file called `Tracker/RequestProcessor.php` within a plugin and define a class that extends `Piwik\Tracker\RequestProcessor`. For example, if a plugin is called `MyPluginName`, then you would create a file in `plugins/MyPluginName/Tracker/RequestProcessor.php` and there you would define a class like this:

```php
namespace Piwik\Plugins\MyPluginName\Tracker;

use Piwik\Tracker\RequestProcessor;

class RequestProcessor extends RequestProcessor 
{
}
```

Within this class you can then overwrite various methods of the extended [RequestProcessor class](https://github.com/matomo-org/matomo/blob/4.x-dev/core/Tracker/RequestProcessor.php).

#### Manipulating a request

For example, if you wanted to make sure to never ever record any user ID, then you could overwrite the `manipulateRequest` method like this:

```php
public function manipulateRequest(Request $request)
{
      $request->setParam('uid', '');
}
```

#### Discarding a tracking request

If you want to make sure to never track certain tracking requests, then simply `return true;` either in the `processRequestParams()` or the `afterRequestProcessed()` method. For example, you could make sure to never track any heartbeat ping request for a specific site like this:

```php
public function processRequestParams(VisitProperties $visitProperties, Request $request)
{
      if ($request->getParam('idsite') == 999 && $request->getParam('ping')) {
           return true; // abort this tracking request
      }
}
```

#### Recording additional data

If you want to track additional log raw data, then usually you will want to [create a dimension](https://developer.matomo.org/guides/dimensions). In some cases, for example if you want to track data into a completely new log table that is not defined in core, this won't work. In those cases you will need to overwrite the `recordLogs` method where you can store any kind of data.


```php
public function recordLogs(VisitProperties $visitProperties, Request $request)
{
    $idVisit = $visitProperties->getProperty('idvisit');
    $idVisitor = $visitProperties->getProperty('idvisitor');
    $idSite = $request->getIdSite();
    $date = Date::factory($request->getCurrentTimestamp())->getDatetime();
    $temperature = $this->getTemperatureForIp($request->getIpString());
    
    $model = new MyNewLogTableModel();
    $model->recordNewTemperature($idVisit, $idVisitor, $idSite, $date, $temperature);
}
```

## Using Events

Sometimes you can also influence the tracking using [events](https://developer.matomo.org/guides/events).

You can check the [list of available event names](https://developer.matomo.org/api-reference/events#trackerdetectreferrersearchengine) for possible hooks. 

### Example 1 - Excluding visits

The `Tracker.isExcludedVisit` can be used to dynamically excluded vists based on certain criteria. 

### Example 2 - Excluding query parameters

The `Tracker.PageUrl.getQueryParametersToExclude` can be used to dynamically excluded query parameters based on certain criteria.

## Action classes

Every tracking request gets assigned an action class. The action defines basically what kind of tracking request the current request is. For example, is it a page view, an outlink, a download, an event, a media analytics request, etc. All these classes have in common that they share the same [base class Piwik\Tracker\Action](https://github.com/matomo-org/matomo/blob/4.x-dev/core/Tracker/Action.php).

When we added event tracking or content tracking, we basically simply added a new action type, gave it an ID, and most things work then out of the box within Matomo.

### Defining a new action

To add such an action, simply create a new file called `Tracker/ActionMyDescriptiveName.php` within a plugin and define a class that extends `Piwik\Tracker\Action`. For example, if a plugin is called `MyPluginName`, then you would create a file in `plugins/MyPluginName/Tracker/ActionMyDescriptiveName.php` and there you would define a class like this:

```php
namespace Piwik\Plugins\MyPluginName\Tracker;

use Piwik\Tracker\Action;

class ActionMyDescriptiveName extends Action 
{
}
```

### Define if the current request is meant for this action

The `shouldHandle` method is executed to determine whether this tracking request is meant for this action. Typically, a tracking request would have a specific tracking parameter that lets you detect that this tracking request is meant for this action. For example, an event action would detect it should handle this request by checking if an `e_c` parameter is set.

```php
public static function shouldHandle(Request $request)
{
    return !empty($request->getParam('e_c'));
}
```

If no action returns true for a tracking request, then the default page view action will be used.

### Accessing an action in a request processor

In the request processor, these action instances can be accessed using the metadata see below example. There a plugin defines its own action and will only record an entry, if the action for the current tracking request was actually meant for this plugin

```php
public function recordLogs(VisitProperties $visitProperties, Request $request)
{
    $action = $request->getMetadata('Actions', 'action');
    if ($action && $action && ActionMyDescriptiveName) {
        $this->recordSomeData();
    }
}
```

Alternatively, some plugins may want a visit to be updated, but not cause any entry in `log_link_visit_action` DB table to be recorded.

This can be achieved by simply unsetting the action, and then the actions processor will no longer record an entry for this request in the log_link_visit_action table:

```php
public function afterRequestProcessed(VisitProperties $visitProperties, Request $request)
{
    $request->setMetadata('Actions', 'action', null);
}
```

### Customising the action behaviour

You can have a look at the `Action` base class for what methods exist. You can overwrite some of these methods to customise the behaviour and for example define if an entry and exit URL should be stored for this action or not.
