<small>Piwik</small>

ViewDataTable
=============

This class is used to load (from the API) and customize the output of a given DataTable.

Description
-----------

The main() method will create an object implementing ViewInterface
You can customize the dataTable using the disable* methods.

You can also customize the dataTable rendering using row metadata:
- &#039;html_label_prefix&#039;: If this metadata is present on a row, it&#039;s contents will be prepended
                       the label in the HTML output.
- &#039;html_label_suffix&#039;: If this metadata is present on a row, it&#039;s contents will be appended
                       after the label in the HTML output.

Example:
In the Controller of the plugin VisitorInterest
&lt;pre&gt;
   function getNumberOfVisitsPerVisitDuration( $fetch = false)
 {
       $view = ViewDataTable::factory( &#039;cloud&#039; );
       $view-&gt;init( $this-&gt;pluginName,  __FUNCTION__, &#039;VisitorInterest.getNumberOfVisitsPerVisitDuration&#039; );
       $view-&gt;setColumnsToDisplay( array(&#039;label&#039;,&#039;nb_visits&#039;) );
       $view-&gt;disableSort();
       $view-&gt;disableExcludeLowPopulation();
       $view-&gt;disableOffsetInformation();

       return $this-&gt;renderView($view, $fetch);
   }
&lt;/pre&gt;


Methods
-------

The class defines the following methods:

- [`factory()`](#factory) &mdash; Returns a Piwik_ViewDataTable_* object.
- [`getAvailableVisualizations()`](#getAvailableVisualizations) &mdash; Returns all registered visualization classes.
- [`getNonCoreViewDataTables()`](#getNonCoreViewDataTables) &mdash; Returns all available visualizations that are not part of the CoreVisualizations plugin.
- [`renderReport()`](#renderReport) &mdash; Convenience method that creates and renders a ViewDataTable for a API method.

### `factory()` <a name="factory"></a>

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
    - [`ViewDataTable`](../Piwik/Plugin/ViewDataTable.md)
    - `Piwik\Plugin\Visualization`
    - `Piwik\Plugins\CoreVisualizations\Visualizations\Sparkline;`
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

### `getAvailableVisualizations()` <a name="getAvailableVisualizations"></a>

Returns all registered visualization classes.

#### Description

Uses the &#039;Visualization.getAvailable&#039;
event to retrieve visualizations.

#### Signature

- It is a **public static** method.
- _Returns:_ Array mapping visualization IDs with their associated visualization classes.
    - `array`
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If a visualization class does not exist or if a duplicate visualization ID is found.

### `getNonCoreViewDataTables()` <a name="getNonCoreViewDataTables"></a>

Returns all available visualizations that are not part of the CoreVisualizations plugin.

#### Signature

- It is a **public static** method.
- _Returns:_ Array mapping visualization IDs with their associated visualization classes.
    - `array`

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

