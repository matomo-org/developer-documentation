<small>Piwik\Plugin\</small>

API
===

The base class of all API singletons.

Plugins that want to expose functionality through an API should create a class
that derives from this one. Every public method in that class will be callable
through Piwik's API.

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
