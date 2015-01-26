---
category: Develop
---
# Piwik's Extensibility Points

Plugins can extend Piwik using the following methods:

- using **events**
- implementing **special classes** that are recognized by Piwik
- extending certain **abstract base classes**

This guide provides an overview describing how plugins can use these methods and some implementation details regarding how Piwik provides these methods.

## Events

Piwik's event system works like any other event system:

- **events can be posted**
- **events can be handled** by registering code to be executed when it is posted

Piwik Core will post events all along the code execution so that plugins can register to them. The complete list of events posted by Piwik Core is [here](/api-reference/events).

Plugins can also post and handle their own custom events (or events of other plugins).

### Handling events

Events are **handled** by registering a callback.

There are two ways to do this:

- Plugins can map a callback by name in the [`Plugin::getListHooksRegistered()`](/api-reference/Piwik/Plugin#getlisthooksregistered) method of their plugin descriptor class, for example:

    ```php
    class MyPlugin extends \Piwik\Plugin
    {
        public function getListHooksRegistered()
        {
            return array(
                'API.getSegmentsMetadata' => 'getSegmentsMetadata',
                'SomeClass.OtherEvent'    => function ($arg1, $arg2) {
                    // Will be called when the SomeClass.OtherEvent event is posted
                },
            );
        }

        public function getSegmentsMetadata(&$result)
        {
            // Will be called when the API.getSegmentsMetadata event is posted
        }
    }
    ```

    This is the preferred way since using it will group all event handlers in one place.

- Alternatively, plugins can call [`Piwik::addAction()`](/api-reference/Piwik/Piwik#addaction):

    ```php
    Piwik::addAction('API.getSegmentsMetadata', function (&$result) {
        // Will be called when the API.getSegmentsMetadata event is posted
    });
    ```

#### Callback Execution Order

Callbacks can be made to run before or after other callbacks. This is accomplished when associating callbacks with events.

To make a callback execute before all others, associate the event with an array like the following:

```php
public function getListHooksRegistered()
{
    return array(
        'API.getSegmentsMetadata' => array(
            'before'   => true,
            'function' => 'getSegmentsMetadata',
        )
    );
}
```

To make a callback execute after other callbacks, associate the event with an array like the following:

```php
public function getListHooksRegistered()
{
    return array(
        'API.getSegmentsMetadata' => array(
            'after'    => true,
            'function' => 'getSegmentsMetadata',
        )
    );
}
```

*Note: You can also use these options when calling [`Piwik::addAction()`](/api-reference/Piwik/Piwik#addaction).*

### Posting events

Plugins can post events themselves if they want to provide extension points to other plugins. For example, the [ScheduledReports](https://github.com/piwik/piwik/tree/master/plugins/ScheduledReports) plugin post events to allow plugins to define new transport mediums and report formats.

To post an event, call [`Piwik::postEvent()`](/api-reference/Piwik/Piwik#postevent) using the name of your event:

```php
Piwik::postEvent('MyPluginOrClass.MyEvent', array($myFirstArg, &$myRefArg));
```

#### Event naming conventions

Event names should follow this format: `$scopeName.$shortEventDescription` where `$scopeName` is the name of the plugin or class that is posting the event and where `$shortEventDescription` is a short description of the event's purpose, for example, **getAvailableViewDataTables**.

#### Posting events in templates

You can post events within Twig templates by using the `postEvent()` function:

```twig
{{ postEvent('MyPlugin.MyEventInATemplate') }}
```

This function will pass a string by reference to all event handlers and then insert the string into the template. Event handlers can modify the string, inserting HTML into templates in other plugins:

```php
class MyOtherPlugin extends \Piwik\Plugin
{
    public function getListHooksRegistered()
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

## Special plugin classes

Plugins can define certain special classes in order to extend Piwik. These classes must be placed in the root namespace of the plugin. Piwik will automatically detect, instantiate and use them.

### API and Controller

Plugins can define an **API** class (that extends [Piwik\Plugin\API](/api-reference/Piwik/Plugin/API)) to add more methods to the [Reporting API](/guides/piwiks-reporting-api). They can also define a **Controller** class to handle HTTP requests that are sent by Piwik's UI.

*Learn more about these classes in our [Controllers](/guides/controllers) or [APIs](/guides/apis) guides.*

### Archiver

Plugins can define an **Archiver** class (that extends [Piwik\Plugin\Archiver](/api-reference/Piwik/Plugin/Archiver)) to hook into Piwik's [Archiving Process](/guides/archiving). These classes are used to calculate and cache analytics data. They are, thus, very important.

*Learn more about these classes in our [Data Model](/guides/data-model) guide.*

### Settings

Plugins can define a **Settings** class (that extends [Piwik\Plugin\Settings](/api-reference/Piwik/Plugin/Settings)) to define their own configuration settings. These classes add sections to the _Settings > Plugins_ admin page.

*Learn more about these classes in our [Plugin Settings](/guides/plugin-settings) guide.*

## Extendable classes

Some abstract classes defined by Piwik can be extended to provide different behavior. These classes usually provide some way for users to choose between different implementations.

### LocationProvider

The **LocationProvider** class (defined in the [UserCountry](https://github.com/piwik/piwik/tree/master/plugins/UserCountry) plugin) can be extended to provide new means of geolocation. Currently, the default implementation will guess a visitor's country based on the language their browser is using. UserCountry provides three other implementations that use GeoIP databases in different ways.

If you want to provide geolocation by some other means, you can extend the LocationProvider base class. Just make sure your new class is required by your plugin.

### ViewDataTable & Visualization

The [ViewDataTable](/api-reference/Piwik/Plugin/ViewDataTable) class can be extended by plugins that want to provide new [report visualizations](/guides/visualizing-report-data#core-visualizations). New subclasses must be registered with Piwik through the [`ViewDataTable.addViewDataTable`](/api-reference/events#viewdatatableaddviewdatatable) event.

*Learn more about creating new report visualizations in our [Visualizing Report Data](/guides/visualizing-report-data) guide.*

## Learn More

* To learn **about every event that Piwik posts** [read the event docs](/api-reference/events).
* To learn **more about the Twig filters and functions Piwik defines** read the documentation for the [View](/api-reference/Piwik/View) class.
* To learn **about API and Controller classes** read our [Controllers](/guides/controllers) or [APIs](/guides/apis) guides.
* To learn **about Archiver classes** read our [Archiving](/guides/archiving) guide.
* To learn **about plugin settings** read our [Plugin Settings](/guides/plugin-settings) guide.
* To learn **about creating new report visualizations** read our [Visualizing Report Data](/guides/visualizing-report-data) guide.
