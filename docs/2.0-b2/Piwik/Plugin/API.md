<small>Piwik\Plugin</small>

API
===

The base class of all API singletons.

Description
-----------

Plugins that want to expose functionality through an API should create a class
that derives from this one. Every public method in that class will be callable
through Piwik&#039;s API.

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

    &lt;a href=&quot;?module=API&amp;method=MyPlugin.myMethod&amp;idSite=1&amp;period=day&amp;date=2013-10-23&quot;&gt;Link&lt;/a&gt;

