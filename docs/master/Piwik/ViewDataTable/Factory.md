<small>Piwik\ViewDataTable</small>

Factory
=======

This class is used to load (from the API) and customize the output of a given DataTable.

Description
-----------

The build() method will create an object implementing ViewInterface
You can customize the dataTable using the disable* methods.

Example:
In the Controller of the plugin VisitorInterest
&lt;pre&gt;
 function getNumberOfVisitsPerVisitDuration( $fetch = false)
 {
     $view = ViewDataTable/Factory::build( &#039;cloud&#039;, &#039;VisitorInterest.getNumberOfVisitsPerVisitDuration&#039; );
     $view-&gt;config-&gt;show_search = true;
     $view-&gt;render();
 }
&lt;/pre&gt;


Methods
-------

The class defines the following methods:

- [`build()`](#build) &mdash; Returns a Piwik_ViewDataTable_* object.
- [`renderReport()`](#renderReport) &mdash; Convenience method that creates and renders a ViewDataTable for a API method.

### `build()` <a name="build"></a>

Returns a Piwik_ViewDataTable_* object.

#### Description

By default it will return a ViewDataTable_Html
If there is a viewDataTable parameter in the URL, a ViewDataTable of this &#039;viewDataTable&#039; type will be returned.
If defaultType is specified and if there is no &#039;viewDataTable&#039; in the URL, a ViewDataTable of this $defaultType will be returned.
If force is set to true, a ViewDataTable of the $defaultType will be returned in all cases.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$defaultType`
    - `$apiAction`
    - `$controllerAction`
    - `$forceDefault`
- It can return one of the following values:
    - [`ViewDataTable`](../../Piwik/Plugin/ViewDataTable.md)
    - [`Visualization`](../../Piwik/Plugin/Visualization.md)
    - `Piwik\Plugins\CoreVisualizations\Visualizations\Sparkline;`
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

### `renderReport()` <a name="renderReport"></a>

Convenience method that creates and renders a ViewDataTable for a API method.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$pluginName`
    - `$apiAction`
    - `$fetch`
- _Returns:_ See $fetch.
    - `string`
    - `null`
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

