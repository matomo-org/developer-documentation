<small>Piwik\Plugin\</small>

API
===

The base class of all API singletons.

Plugins that want to expose functionality through the Reporting API should create a class
that extends this one. Every public method in that class that is not annotated with **@ignore**
will be callable through Piwik's Web API.

_Note: If your plugin calculates and stores reports, they should be made available through the API._

### Examples

**Defining an API for a plugin**

    class API extends \Piwik\Plugin\API
    {
        public function myMethod($idSite, $period, $date, $segment = false)
        {
            $dataTable = // ... get some data ...
            return $dataTable;
        }
    }

**Linking to an API method**

    <a href="?module=API&method=MyPlugin.myMethod&idSite=1&period=day&date=2013-10-23">Link</a>

Methods
-------

The abstract class defines the following methods:

- [`getInstance()`](#getinstance) &mdash; Returns the singleton instance for the derived class.
- [`unsetInstance()`](#unsetinstance) &mdash; Used in tests only
- [`unsetAllInstances()`](#unsetallinstances) &mdash; Used in tests only
- [`setSingletonInstance()`](#setsingletoninstance) &mdash; Sets the singleton instance.

<a name="getinstance" id="getinstance"></a>
<a name="getInstance" id="getInstance"></a>
### `getInstance()`

Returns the singleton instance for the derived class.

If the singleton instance
has not been created, this method will create it.

#### Signature

- It returns a [`API`](../../Piwik/Plugin/API.md) value.

<a name="unsetinstance" id="unsetinstance"></a>
<a name="unsetInstance" id="unsetInstance"></a>
### `unsetInstance()`

Used in tests only

#### Signature

- It does not return anything.

<a name="unsetallinstances" id="unsetallinstances"></a>
<a name="unsetAllInstances" id="unsetAllInstances"></a>
### `unsetAllInstances()`

Used in tests only

#### Signature

- It does not return anything.

<a name="setsingletoninstance" id="setsingletoninstance"></a>
<a name="setSingletonInstance" id="setSingletonInstance"></a>
### `setSingletonInstance()`

Sets the singleton instance.

For testing purposes.

#### Signature

-  It accepts the following parameter(s):
    - `$instance`
      
- It does not return anything.

