---
category: Develop
---
# Events

Piwik's event system works like any other event system:

- **events can be posted**
- **events can be handled** by registering code to be executed when it is posted

Piwik Core will post events all along the code execution so that plugins can register to them. 
Plugins can also post and handle their own custom events (or events of other plugins).

## Complete list of events

The complete list of events posted by Piwik Core is [here](/api-reference/events).


## Handling events

Events are **handled** by registering a callback by name in the [`Plugin::registerEvents()`](/api-reference/Piwik/Plugin#getlisthooksregistered) method of the plugin descriptor class (`YourPluginName.php`), for example:

```php
class MyPlugin extends \Piwik\Plugin
{
    public function registerEvents()
    {
        return array(
            'Referrer.addSearchEngineUrls' => 'addExampleSearchEngine'
        );
    }

    public function addExampleSearchEngine(&$searchEngines)
    {
        // Will be called when the Referrer.addSearchEngineUrls event is posted
        $searchEngines['www.example.org'] = array('Example earch engine');
    }
}
```

### Callback Execution Order

Callbacks can be made to run before or after other callbacks. To make a callback execute before all others, associate the event with an array like the following:

```php
public function registerEvents()
{
    return array(
        'Referrer.addSearchEngineUrls' => array(
            'before'   => true,
            'function' => 'addExampleSearchEngine',
        )
    );
}
```

To make a callback execute after other callbacks, associate the event with an array like the following:

```php
public function registerEvents()
{
    return array(
        'Referrer.addSearchEngineUrls' => array(
            'after'    => true,
            'function' => 'addExampleSearchEngine',
        )
    );
}
```

## Posting events

Plugins can post events themselves if they want to provide extension points to other plugins. For example, the [ScheduledReports](https://github.com/matomo-org/matomo/tree/master/plugins/ScheduledReports) plugin post events to allow plugins to define new transport mediums and report formats.

To post an event, call [`Piwik::postEvent()`](/api-reference/Piwik/Piwik#postevent) using the name of your event:

```php
Piwik::postEvent('MyPlugin.MyEventName', array($myFirstArg, &$myRefArg));
```

### Event naming conventions

Event names should follow this format: `$pluginName.$shortEventDescription` where `$pluginName` is the name of your plugin and where `$shortEventDescription` is a short description of the event's purpose, for example, **addSearchEngineUrls**.

### Testing a posted event

In case you want to write a test that checks whether your plugin triggers an event you can do this as follows: [`Piwik::addAction()`](/api-reference/Piwik/Piwik#addaction):

```php
$called = false;
$self   = $this;

Piwik::addAction('Referrer.addSearchEngineUrls', function (&$searchEngines) use ($self, &$called) {
    // Will be called when the Referrer.addSearchEngineUrls event is posted
    $called = true;
    $self->assertEquals(array(), $searchEngines);
});

$this->assertTrue($called);
```

### Posting events in templates

You can post events within Twig templates by using the `postEvent()` function:

```twig
{{ postEvent('MyPlugin.MyEventInATemplate') }}
```

This function will pass a string by reference to all event handlers and then insert the string into the template. Event handlers can modify the string, inserting HTML into templates in other plugins:

```php
class MyOtherPlugin extends \Piwik\Plugin
{
    public function registerEvents()
    {
        return array(
            'MyPlugin.MyEventInATemplate' => 'handleMyEventInATemplate',
        );
    }

    public function handleMyEventInATemplate(&$outString)
    {
        $outString .= '<h1>This text was injected!</h1>';
    }
}
```

When posting events, the templates can pass extra parameters:

```twig
{{ postEvent('MyPlugin.MyEventInATemplate', usefulVariable1, usefulVariable2) }}
```

Event handlers can read these optional values as follows:

```php
public function handleMyEventInATemplate(&$outString, $usefulVariable1, $usefulVariable2)
{
    $outString .= '<h1>This text was injected!</h1>';
    $outString .= $usefulVariable . ' - ' . $usefulVariable2;
}
```
