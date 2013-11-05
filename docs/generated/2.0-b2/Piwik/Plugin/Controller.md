<small>Piwik\Plugin</small>

Controller
==========

Base class of all plugin Controllers.

Description
-----------

Plugins that wish to add display HTML should create a Controller that either
extends from this class or from [ControllerAdmin](#). Every public method in
the controller will be exposed as a controller action.

Learn more about Piwik's MVC system [here](#).

### Examples

**Defining a controller**

    class Controller extends \Piwik\Plugin\Controller
    {
        public function index()
        {
            $view = new View("@MyPlugin/index.twig");
            // ... setup view ...
            echo $view->render();
        }
    }

**Linking to a controller action**

    <a href="?module=MyPlugin&action=index&idSite=1&period=day&date=2013-10-10">Link</a>


Methods
-------

The abstract class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`getDefaultAction()`](#getdefaultaction) &mdash; Returns the name of the default method that will be called when visiting: index.php?module=PluginName without the action parameter.
- [`setHostValidationVariablesView()`](#sethostvalidationvariablesview) &mdash; Checks if the current host is valid and sets variables on the given view, including:
- [`setPeriodVariablesView()`](#setperiodvariablesview) &mdash; Sets general period variables on a view, including:  - **displayUniqueVisitors** - Whether unique visitors should be displayed for the current                               period.
- [`redirectToIndex()`](#redirecttoindex) &mdash; Helper method used to redirect the current http request to another module/action.
- [`getCalendarPrettyDate()`](#getcalendarprettydate) &mdash; Returns a prettified date string for use in period selector widget.

<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

- It does not return anything.

<a name="getdefaultaction" id="getdefaultaction"></a>
### `getDefaultAction()`

Returns the name of the default method that will be called when visiting: index.php?module=PluginName without the action parameter.

#### Signature

- It returns a(n) `string` value.

<a name="sethostvalidationvariablesview" id="sethostvalidationvariablesview"></a>
### `setHostValidationVariablesView()`

Checks if the current host is valid and sets variables on the given view, including:

#### Description

- **isValidHost** - true if host is valid, false if otherwise
- **invalidHostMessage** - message to display if host is invalid (only set if host is invalid)
- **invalidHost** - the invalid hostname (only set if host is invalid)
- **mailLinkStart** - the open tag of a link to email the super user of this problem (only set
                      if host is invalid)

#### Signature

- It accepts the following parameter(s):
    - `$view`
- It does not return anything.

<a name="setperiodvariablesview" id="setperiodvariablesview"></a>
### `setPeriodVariablesView()`

Sets general period variables on a view, including:  - **displayUniqueVisitors** - Whether unique visitors should be displayed for the current                               period.

#### Description

- **period** - The value of the **period** query parameter.
- **otherPeriods** - `array('day', 'week', 'month', 'year', 'range')`
- **periodsNames** - List of available periods mapped to their singular and plural translations.

#### Signature

- It accepts the following parameter(s):
    - `$view`
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if the current period is invalid.

<a name="redirecttoindex" id="redirecttoindex"></a>
### `redirectToIndex()`

Helper method used to redirect the current http request to another module/action.

#### Description

If specified, will also change the idSite, date and/or period query parameters.

This function will exit immediately after executing.

#### Signature

- It accepts the following parameter(s):
    - `$moduleToRedirect`
    - `$actionToRedirect`
    - `$websiteId`
    - `$defaultPeriod`
    - `$defaultDate`
    - `$parameters`
- It does not return anything.

<a name="getcalendarprettydate" id="getcalendarprettydate"></a>
### `getCalendarPrettyDate()`

Returns a prettified date string for use in period selector widget.

#### Signature

- It accepts the following parameter(s):
    - `$period`
- It returns a(n) `string` value.

