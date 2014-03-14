# Piwik's Extensibility Points

<!-- Meta (to be deleted)
Purpose:
- describe piwik's event system,
- describe other class hooks for plugins (ie, controller, API, settings, archiver, etc.),
- describe plugin folder structure

Audience: dev interested in some bit of info described here

Expected Result: 

Notes: 

What's missing? (stuff in my list that was not in when I wrote the 1st draft)
- LocationProvider needs to be documented (at least w/ class level docs)
-->

## About this guide

**Read this guide if**

* you'd like to know **more about Piwik's event system**,
* you'd like to know **of every way you can extend Piwik with a plugin**.

**Guide assumptions**

This guide assumes that you:

* can code in PHP,
* and have a general understanding of extending Piwik (if not, read our [Getting Started](#) guide).

## Piwik Extensibilty

Plugins can extend Piwik using the following methods:

* using the event emitting and handling system
* implementing special classes that are recognized by Piwik
* extending certain abstract base classes

This guide provides an overview describing how plugins can use these methods and how Piwik provides these methods.

## The Event Dispatching System

At certain points during Piwik's execution, Piwik will signal to the EventDispatcher that the callbacks for a certain event should be invoked. This is called **posting an event**.

Events are posted with an array of variables that are passed on to each callback as arguments. These variables can be passed by value or by reference.

Plugins can associate callbacks (sometimes called **event handlers**) with events, and are therefore able to insert custom logic into different parts of Piwik. Plugins can also use events to notify Piwik of new implementations of [extendable classes](#extendable-classes).

You can view the list of all events Piwik will post [here](#).

### Handling Events

Events are **handled** or **observed** by associating a callback with an event. There are two ways to do this:

1. Plugins can map a callback by name in the [Plugin::getListHooksRegistered](#) method of their plugin descriptor class, for example:

  ```
  class MyPlugin extends \Piwik\Plugin
  {
      public function getListHooksRegistered()
      {
          return array(
              'API.getSegmentsMetadata' => 'getSegmentsMetadata',
              'SomeClass.OtherEvent' => function ($arg1, $arg2) {
                  // ...
              }
          );
      }

      public function getSegmentsMetadata(&$result)
      {
          $result[] = array(
              // ...
          );
      }
  }
  ```

2. Or plugins can call the [Piwik::addAction](#) method, for example:

  ```
  Piwik::addAction('API.getSegmentsMetadata', function (&$result) {
      // ...
  });
  ```

#### Callback Execution Order

Callbacks can be made to run before or after others. This is done when associating callbacks with events.

To make a callback execute before all others, associate the event with an array like the following:

    public function getListHooksRegistered()
    {
        return array(
            'API.getSegmentsMetadata' => array(
                'before' => true,
                'function' => 'getSegmentsMetadata'
            )
        );
    }

To make a callback execute after other callbacks, associate the event with an array like the following:

    public function getListHooksRegistered()
    {
        return array(
            'API.getSegmentsMetadata' => array(
                'after' => true,
                'function' => 'getSegmentsMetadata'
            )
        );
    }

### Posting Events

Plugins can post events themselves if they want to be able to be extended by other plugins. The [ScheduledReports](#) plugins for example does this to [allow plugins to define new transport mediums and report formats](#).

To post an event, call the [Piwik::postEvent](#) function using the name of your event:

    Piwik::postEvent('MyPluginOrClass.MyEvent', array($myFirstArg, &$myRefArg));

**Event Naming Conventions**

Event names should follow this format: `"$scopeName.$shortEventDescription"` where `$scopeName` is either the name of the plugin that is posting the event or the name of the class and where `$shortEventDescription` is a short description of the event's purpose, for example, **getAvailableViewDataTables**.

#### Posting Events in Templates

You can post events within Twig templates by using the **postEvent** function:

    {{ postEvent('MyPlugin.MyEventInATemplate') }}


The **postEvent** function will pass a string by reference to all event handlers and then insert the string into the template. Event handlers can modify the string, inserting HTML into templates in other plugins:

    class MyOtherPlugin extends \Piwik\Plugin
    {
        public function getListHooksRegistered()
        {
            return array(
                'MyPlugin.MyEventInATemplate' => 'handleMyEventInATemplate'
            );
        }

        public function handleMyEventInATemplate(&$outString)
        {
            $outString .= '<h1>This text was injected!</h1>';
        }
    }

When posting events, the templates can pass extra parameters:

    {{ postEvent('MyPlugin.MyEventInATemplate', usefulVariable, usefulVariableBis) }}

Event handler can read these optional values as follows:

    public function handleMyEventInATemplate(&$outString, $usefulVariable, $usefulVariableBis)
    {
        $outString .= '<h1>This text was injected!</h1>';
        $outString .= $usefulVariable . " - " . $usefulVariableBis;
    }

## Plugin Classes

Plugins can define certain special classes in order to extend Piwik. These classes must be placed in the root namespace of the plugin. Piwik will automatically detect, instantiate and use them.

### API and Controller

Plugins can define an **API** class (that extends [Piwik\Plugin\API](#)) to add more methods to the [Reporting API](#). They can also define a **Controller** class to handle HTTP requests that are sent by Piwik's UI.

_Learn more about these classes in our [MVC in Piwik](#) guide._

TODO: is the base class(es) for Controller classes specified somewhere?

### Archiver

Plugins can define an **Archiver** class (that extends [Piwik\Plugin\Archiver](#)) to hook into Piwik's [Archiving Process](#). These classes are used to calculate and cache analytics data. They are, thus, very important types.

_Learn more about these classes in our [All About Analytics](#) guide._

### Settings

Plugins can define a **Settings** class (that extends [Piwik\Plugin\Settings](#)) to define their own configuration settings. These classes add sections to the _Settings > Plugins_ admin page.

_Learn more about these classes in our [Piwik Configuration](#) guide._

<a name="extendable-classes"></a>
## Extendable Classes

Some abstract classes defined by Piwik can be extended to provide different behavior. These classes usually provide some way for users to choose between different implementations.

### LocationProvider

The [LocationProvider](#) class (defined in the UserCountry plugin) can be extended to provide new means of geolocation. Currently, the default implementation will guess a visitor's country based on the language their browser is using. UserCountry provides three other implementations that use GeoIP databases in different ways.

### ViewDataTable & Visualization

The [ViewDataTable](#) class can be extended by plugins that want to provide new [report visualizations](#). New subclasses must be registered with Piwik through the [ViewDataTable.addViewDataTable](#) event.

_Learn more about creating new report visualizations in our [Visualizing Report Data](#) guide._

## Learn More

* To learn **about every event that Piwik posts** [read the event docs](#).
* To learn **more about the Twig filters and functions Piwik defines** read the documentation for the [View](#) class.
* To learn **about API and Controller classes** read our [MVC in Piwik](#) guide.
* To learn **about Archiver classes** read our [All About Analytics](#) guide.
* To learn **about plugin Settings** read our [Piwik Configuration](#) guide.
* To learn **about creating new LocationProviders** read our ???
* To learn **about creating new report visualizations** read our [Visualizing Report Data](#) guide._