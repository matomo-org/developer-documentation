<small>Piwik\Plugin\</small>

API
===

The base class of all API singletons.

Plugins that want to expose functionality through the Reporting API should create a class
that extends this one. Every public method in that class that is not annotated with **@ignore**
will be callable through Matomo's Web API.

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

<a name="getinstance" id="getinstance"></a>
<a name="getInstance" id="getInstance"></a>
### `getInstance()`

Returns the singleton instance for the derived class. If the singleton instance
has not been created, this method will create it.

#### Signature

- It returns a [`API`](../../Piwik/Plugin/API.md) value.

