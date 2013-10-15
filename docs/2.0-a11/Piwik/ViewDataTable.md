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


Constants
---------

This class defines the following constants:

- [`CONFIGURE_VIEW_EVENT`](#CONFIGURE_VIEW_EVENT)
- [`CONFIGURE_FOOTER_ICONS_EVENT`](#CONFIGURE_FOOTER_ICONS_EVENT)

Properties
----------

This class defines the following properties:

- [`$reportPropertiesCache`](#$reportPropertiesCache) &mdash; Cache for getAllReportDisplayProperties result.

### `$reportPropertiesCache` <a name="reportPropertiesCache"></a>

Cache for getAllReportDisplayProperties result.

#### Signature

- It is a **public static** property.
- It is a(n) `array` value.

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Default constructor.
- [`getReportApiMethod()`](#getReportApiMethod) &mdash; Returns the API method that will be called to obatin the report data.
- [`getVisualizationClass()`](#getVisualizationClass) &mdash; Returns the view&#039;s associated visualization class name.
- [`__get()`](#__get) &mdash; Gets a view property by reference.
- [`__set()`](#__set) &mdash; Sets a view property.
- [`__call()`](#__call) &mdash; Hack to allow property access in Twig (w/ property name checking).
- [`getViewDataTableId()`](#getViewDataTableId) &mdash; Unique string ID that defines the format of the dataTable, eg.
- [`factory()`](#factory) &mdash; Returns a Piwik_ViewDataTable_* object.
- [`getClientSideConfigProperties()`](#getClientSideConfigProperties) &mdash; Returns the list of view properties that should be sent with the HTML response as JSON.
- [`getClientSideRequestParameters()`](#getClientSideRequestParameters) &mdash; Returns the list of view properties that should be sent with the HTML response and resent by the UI JavaScript in every subsequent AJAX request.
- [`getOverridableProperties()`](#getOverridableProperties) &mdash; Returns the list of view properties that can be overriden by query parameters.
- [`getCurrentControllerAction()`](#getCurrentControllerAction)
- [`getCurrentControllerName()`](#getCurrentControllerName)
- [`getDataTable()`](#getDataTable) &mdash; Returns the DataTable loaded from the API
- [`setDataTable()`](#setDataTable) &mdash; To prevent calling an API multiple times, the DataTable can be set directly.
- [`getRequestArray()`](#getRequestArray)
- [`hasReportBeenPurged()`](#hasReportBeenPurged) &mdash; Returns true if it is likely that the data for this report has been purged and if the user should be told about that.
- [`renderReport()`](#renderReport) &mdash; Convenience method that creates and renders a ViewDataTable for a API method.
- [`render()`](#render) &mdash; Convenience function.
- [`shouldLoadExpanded()`](#shouldLoadExpanded) &mdash; Returns whether the DataTable result will have to be expanded for the current request before rendering.
- [`getDefaultDataTableCssClass()`](#getDefaultDataTableCssClass)

### `__construct()` <a name="__construct"></a>

Default constructor.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$currentControllerAction`
    - `$apiMethodToRequestDataTable`
    - `$viewProperties`
    - `$visualizationId`
- It does not return anything.

### `getReportApiMethod()` <a name="getReportApiMethod"></a>

Returns the API method that will be called to obatin the report data.

#### Signature

- It is a **public** method.
- _Returns:_ e.g. &#039;Actions.getPageUrls&#039;
    - `string`

### `getVisualizationClass()` <a name="getVisualizationClass"></a>

Returns the view&#039;s associated visualization class name.

#### Signature

- It is a **public** method.
- It returns a(n) `string` value.

### `__get()` <a name="__get"></a>

Gets a view property by reference.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$name`
- It returns a(n) `mixed` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if the property name is invalid.

### `__set()` <a name="__set"></a>

Sets a view property.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$name`
    - `$value`
- _Returns:_ Returns $value.
    - `mixed`
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if the property name is invalid.

### `__call()` <a name="__call"></a>

Hack to allow property access in Twig (w/ property name checking).

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$name`
    - `$arguments`
- It does not return anything.

### `getViewDataTableId()` <a name="getViewDataTableId"></a>

Unique string ID that defines the format of the dataTable, eg.

#### Description

&quot;pieChart&quot;, &quot;table&quot;, etc.

#### Signature

- It is a **public** method.
- It returns a(n) `string` value.

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
- It returns a(n) [`ViewDataTable`](../Piwik/ViewDataTable.md) value.

### `getClientSideConfigProperties()` <a name="getClientSideConfigProperties"></a>

Returns the list of view properties that should be sent with the HTML response as JSON.

#### Description

These properties are visible to the UI JavaScript, but are not passed
with every request.

#### Signature

- It is a **public** method.
- It returns a(n) `array` value.

### `getClientSideRequestParameters()` <a name="getClientSideRequestParameters"></a>

Returns the list of view properties that should be sent with the HTML response and resent by the UI JavaScript in every subsequent AJAX request.

#### Signature

- It is a **public** method.
- It returns a(n) `array` value.

### `getOverridableProperties()` <a name="getOverridableProperties"></a>

Returns the list of view properties that can be overriden by query parameters.

#### Signature

- It is a **public** method.
- It returns a(n) `array` value.

### `getCurrentControllerAction()` <a name="getCurrentControllerAction"></a>

#### Signature

- It is a **public** method.
- It does not return anything.

### `getCurrentControllerName()` <a name="getCurrentControllerName"></a>

#### Signature

- It is a **public** method.
- It does not return anything.

### `getDataTable()` <a name="getDataTable"></a>

Returns the DataTable loaded from the API

#### Signature

- It is a **public** method.
- It returns a(n) [`DataTable`](../Piwik/DataTable.md) value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if not yet defined

### `setDataTable()` <a name="setDataTable"></a>

To prevent calling an API multiple times, the DataTable can be set directly.

#### Description

It won&#039;t be loaded again from the API in this case

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$dataTable`
- _Returns:_ $dataTable DataTable
    - `void`

### `getRequestArray()` <a name="getRequestArray"></a>

#### Signature

- It is a **public** method.
- _Returns:_ URL to call the API, eg. &quot;method=Referrers.getKeywords&amp;period=day&amp;date=yesterday&quot;...
    - `string`

### `hasReportBeenPurged()` <a name="hasReportBeenPurged"></a>

Returns true if it is likely that the data for this report has been purged and if the user should be told about that.

#### Description

In order for this function to return true, the following must also be true:
- The data table for this report must either be empty or not have been fetched.
- The period of this report is not a multiple period.
- The date of this report must be older than the delete_reports_older_than config option.

#### Signature

- It is a **public** method.
- It returns a(n) `bool` value.

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

### `render()` <a name="render"></a>

Convenience function.

#### Description

Calls main() &amp; renders the view that gets built.

#### Signature

- It is a **public** method.
- _Returns:_ The result of rendering.
    - `string`

### `shouldLoadExpanded()` <a name="shouldLoadExpanded"></a>

Returns whether the DataTable result will have to be expanded for the current request before rendering.

#### Signature

- It is a **public static** method.
- It returns a(n) `bool` value.

### `getDefaultDataTableCssClass()` <a name="getDefaultDataTableCssClass"></a>

#### Signature

- It is a **public** method.
- It does not return anything.

