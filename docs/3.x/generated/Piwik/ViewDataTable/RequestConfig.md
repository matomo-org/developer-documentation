<small>Piwik\ViewDataTable\</small>

RequestConfig
=============

Contains base request properties for [ViewDataTable](/api-reference/Piwik/Plugin/ViewDataTable) instances.

<a name="client-side-parameters-desc"></a>
**Client Side Parameters**

Client side parameters are request properties that should be passed on to the browser so
client side JavaScript can use them. These properties will also be passed to the server with
every AJAX request made.

Only affects ViewDataTables that output HTML.

<a name="overridable-properties-desc"></a>
**Overridable Properties**

Overridable properties are properties that can be set via the query string.
If a request has a query parameter that matches an overridable property, the property
will be set to the query parameter value.

**Reusing base properties**

Many of the properties in this class only have meaning for the [Visualization](/api-reference/Piwik/Plugin/Visualization)
class, but can be set for other visualizations that extend [ViewDataTable](/api-reference/Piwik/Plugin/ViewDataTable)
directly.

Visualizations that extend [ViewDataTable](/api-reference/Piwik/Plugin/ViewDataTable) directly and want to re-use these
properties must make sure the properties are used in the exact same way they are used in
[Visualization](/api-reference/Piwik/Plugin/Visualization).

**Defining new request properties**

If you are creating your own visualization and want to add new request properties for
it, extend this class and add your properties as fields.

Properties are marked as client side parameters by calling the
[addPropertiesThatShouldBeAvailableClientSide()](/api-reference/Piwik/ViewDataTable/RequestConfig#addpropertiesthatshouldbeavailableclientside) method.

Properties are marked as overridable by calling the
[addPropertiesThatCanBeOverwrittenByQueryParams()](/api-reference/Piwik/ViewDataTable/RequestConfig#addpropertiesthatcanbeoverwrittenbyqueryparams) method.

### Example

**Defining new request properties**

    class MyCustomVizRequestConfig extends RequestConfig
    {
        /**
         * My custom property. It is overridable.
         *\/
        public $my_custom_property = false;

        /**
         * Another custom property. It is available client side.
         *\/
        public $another_custom_property = true;

        public function __construct()
        {
            parent::__construct();

            $this->addPropertiesThatShouldBeAvailableClientSide(array('another_custom_property'));
            $this->addPropertiesThatCanBeOverwrittenByQueryParams(array('my_custom_property'));
        }
    }

Properties
----------

This class defines the following properties:

- [`$clientSideParameters`](#$clientsideparameters) &mdash; The list of request parameters that are 'Client Side Parameters'.
- [`$overridableProperties`](#$overridableproperties) &mdash; The list of ViewDataTable properties that can be overriden by query parameters.
- [`$filter_sort_column`](#$filter_sort_column) &mdash; Controls which column to sort the DataTable by before truncating and displaying.
- [`$filter_sort_order`](#$filter_sort_order) &mdash; Controls the sort order.
- [`$filter_limit`](#$filter_limit) &mdash; The number of items to truncate the data set to before rendering the DataTable view.
- [`$flat`](#$flat) &mdash; If set to true, the returned data will contain the flattened view of the table data set.
- [`$totals`](#$totals) &mdash; If set to true or "1", the report may calculate totals information and show percentage values for each row in relative to the total value.
- [`$expanded`](#$expanded) &mdash; If set to true, the returned data will contain the first level results, as well as all sub-tables.
- [`$filter_offset`](#$filter_offset) &mdash; The number of items from the start of the data set that should be ignored.
- [`$filter_pattern`](#$filter_pattern) &mdash; A regex pattern to use to filter the DataTable before it is shown.
- [`$filter_column`](#$filter_column) &mdash; The column to apply a filter pattern to.
- [`$filter_excludelowpop`](#$filter_excludelowpop) &mdash; Stores the column name to filter when filtering out rows with low values.
- [`$filter_excludelowpop_value`](#$filter_excludelowpop_value) &mdash; Stores the value considered 'low' when filtering out rows w/ low values.
- [`$request_parameters_to_modify`](#$request_parameters_to_modify) &mdash; An array property that contains query parameter name/value overrides for API requests made by ViewDataTable.
- [`$disable_generic_filters`](#$disable_generic_filters) &mdash; Whether to run generic filters on the DataTable before rendering or not.
- [`$disable_queued_filters`](#$disable_queued_filters) &mdash; Whether to run ViewDataTable's list of queued filters or not.
- [`$apiMethodToRequestDataTable`](#$apimethodtorequestdatatable) &mdash; returns 'Plugin.apiMethodName' used for this ViewDataTable, eg.
- [`$idSubtable`](#$idsubtable) &mdash; If the current dataTable refers to a subDataTable (eg.
- [`$pivotBy`](#$pivotby) &mdash; Dimension ID to pivot by.
- [`$pivotByColumn`](#$pivotbycolumn) &mdash; The column to display in a pivot table, eg, `'nb_visits'`.
- [`$pivotByColumnLimit`](#$pivotbycolumnlimit) &mdash; The maximum number of columns to display in a pivot table.
- [`$compareSegments`](#$comparesegments) &mdash; List of segments to compare with.
- [`$comparePeriods`](#$compareperiods) &mdash; List of period labels to compare with.
- [`$compareDates`](#$comparedates) &mdash; List of period dates to compare with.

<a name="$clientsideparameters" id="$clientsideparameters"></a>
<a name="clientSideParameters" id="clientSideParameters"></a>
### `$clientSideParameters`

The list of request parameters that are 'Client Side Parameters'.

#### Signature

- Its type is not specified.


<a name="$overridableproperties" id="$overridableproperties"></a>
<a name="overridableProperties" id="overridableProperties"></a>
### `$overridableProperties`

The list of ViewDataTable properties that can be overriden by query parameters.

#### Signature

- Its type is not specified.


<a name="$filter_sort_column" id="$filter_sort_column"></a>
<a name="filter_sort_column" id="filter_sort_column"></a>
### `$filter_sort_column`

Controls which column to sort the DataTable by before truncating and displaying.

Default value: If the report contains nb_uniq_visitors and nb_uniq_visitors is a
               displayed column, then the default value is 'nb_uniq_visitors'.
               Otherwise, it is 'nb_visits'.

#### Signature

- Its type is not specified.


<a name="$filter_sort_order" id="$filter_sort_order"></a>
<a name="filter_sort_order" id="filter_sort_order"></a>
### `$filter_sort_order`

Controls the sort order. Either 'asc' or 'desc'.

Default value: 'desc'

#### Signature

- Its type is not specified.


<a name="$filter_limit" id="$filter_limit"></a>
<a name="filter_limit" id="filter_limit"></a>
### `$filter_limit`

The number of items to truncate the data set to before rendering the DataTable view.

Default value: false

#### Signature

- Its type is not specified.


<a name="$flat" id="$flat"></a>
<a name="flat" id="flat"></a>
### `$flat`

If set to true, the returned data will contain the flattened view of the table data set.

The children of all first level rows will be aggregated under one row.

Default value: false

#### Signature

- Its type is not specified.


<a name="$totals" id="$totals"></a>
<a name="totals" id="totals"></a>
### `$totals`

If set to true or "1", the report may calculate totals information and show percentage values for each row in
relative to the total value.

Default value: 0

#### Signature

- Its type is not specified.


<a name="$expanded" id="$expanded"></a>
<a name="expanded" id="expanded"></a>
### `$expanded`

If set to true, the returned data will contain the first level results, as well as all sub-tables.

Default value: false

#### Signature

- Its type is not specified.


<a name="$filter_offset" id="$filter_offset"></a>
<a name="filter_offset" id="filter_offset"></a>
### `$filter_offset`

The number of items from the start of the data set that should be ignored.

Default value: 0

#### Signature

- Its type is not specified.


<a name="$filter_pattern" id="$filter_pattern"></a>
<a name="filter_pattern" id="filter_pattern"></a>
### `$filter_pattern`

A regex pattern to use to filter the DataTable before it is shown.

#### Signature

- Its type is not specified.


<a name="$filter_column" id="$filter_column"></a>
<a name="filter_column" id="filter_column"></a>
### `$filter_column`

The column to apply a filter pattern to.

#### Signature

- Its type is not specified.


<a name="$filter_excludelowpop" id="$filter_excludelowpop"></a>
<a name="filter_excludelowpop" id="filter_excludelowpop"></a>
### `$filter_excludelowpop`

Stores the column name to filter when filtering out rows with low values.

Default value: false

#### Signature

- Its type is not specified.


<a name="$filter_excludelowpop_value" id="$filter_excludelowpop_value"></a>
<a name="filter_excludelowpop_value" id="filter_excludelowpop_value"></a>
### `$filter_excludelowpop_value`

Stores the value considered 'low' when filtering out rows w/ low values.

Default value: false

#### Signature

- It can be one of the following types:
    - [`Closure`](http://php.net/class.Closure)
    - `string`

<a name="$request_parameters_to_modify" id="$request_parameters_to_modify"></a>
<a name="request_parameters_to_modify" id="request_parameters_to_modify"></a>
### `$request_parameters_to_modify`

An array property that contains query parameter name/value overrides for API requests made
by ViewDataTable.

E.g. array('idSite' => ..., 'period' => 'month')

Default value: array()

#### Signature

- Its type is not specified.


<a name="$disable_generic_filters" id="$disable_generic_filters"></a>
<a name="disable_generic_filters" id="disable_generic_filters"></a>
### `$disable_generic_filters`

Whether to run generic filters on the DataTable before rendering or not.

#### Signature

- Its type is not specified.


<a name="$disable_queued_filters" id="$disable_queued_filters"></a>
<a name="disable_queued_filters" id="disable_queued_filters"></a>
### `$disable_queued_filters`

Whether to run ViewDataTable's list of queued filters or not.

_NOTE: Priority queued filters are always run._

Default value: false

#### Signature

- Its type is not specified.


<a name="$apimethodtorequestdatatable" id="$apimethodtorequestdatatable"></a>
<a name="apiMethodToRequestDataTable" id="apiMethodToRequestDataTable"></a>
### `$apiMethodToRequestDataTable`

returns 'Plugin.apiMethodName' used for this ViewDataTable,
eg. 'Actions.getPageUrls'

#### Signature

- It is a `string` value.

<a name="$idsubtable" id="$idsubtable"></a>
<a name="idSubtable" id="idSubtable"></a>
### `$idSubtable`

If the current dataTable refers to a subDataTable (eg. keywordsBySearchEngineId for id=X) this variable is set to the Id

#### Signature

- It can be one of the following types:
    - `bool`
    - `int`

<a name="$pivotby" id="$pivotby"></a>
<a name="pivotBy" id="pivotBy"></a>
### `$pivotBy`

Dimension ID to pivot by. See Piwik\DataTable\Filter\PivotByDimension for more info.

#### Signature

- It is a `string` value.

<a name="$pivotbycolumn" id="$pivotbycolumn"></a>
<a name="pivotByColumn" id="pivotByColumn"></a>
### `$pivotByColumn`

The column to display in a pivot table, eg, `'nb_visits'`. See Piwik\DataTable\Filter\PivotByDimension
for more info.

#### Signature

- It is a `string` value.

<a name="$pivotbycolumnlimit" id="$pivotbycolumnlimit"></a>
<a name="pivotByColumnLimit" id="pivotByColumnLimit"></a>
### `$pivotByColumnLimit`

The maximum number of columns to display in a pivot table. See Piwik\DataTable\Filter\PivotByDimension
for more info.

#### Signature

- It is a `int` value.

<a name="$comparesegments" id="$comparesegments"></a>
<a name="compareSegments" id="compareSegments"></a>
### `$compareSegments`

List of segments to compare with. Defaults to segments used in `compareSegments[]` query parameter.

#### Signature

- It is a `array` value.

<a name="$compareperiods" id="$compareperiods"></a>
<a name="comparePeriods" id="comparePeriods"></a>
### `$comparePeriods`

List of period labels to compare with. Defaults to values used in `comparePeriods[]` query parameter.

#### Signature

- It is a `array` value.

<a name="$comparedates" id="$comparedates"></a>
<a name="compareDates" id="compareDates"></a>
### `$compareDates`

List of period dates to compare with. Defaults to values used in `compareDates[]` query parameter.

#### Signature

- It is a `array` value.

Methods
-------

The class defines the following methods:

- [`getProperties()`](#getproperties)
- [`addPropertiesThatShouldBeAvailableClientSide()`](#addpropertiesthatshouldbeavailableclientside) &mdash; Marks request properties as client side properties.
- [`addPropertiesThatCanBeOverwrittenByQueryParams()`](#addpropertiesthatcanbeoverwrittenbyqueryparams) &mdash; Marks display properties as overridable.
- [`setDefaultSort()`](#setdefaultsort)
- [`getApiModuleToRequest()`](#getapimoduletorequest)
- [`getApiMethodToRequest()`](#getapimethodtorequest)
- [`getRequestParam()`](#getrequestparam)
- [`getExtraParametersToSet()`](#getextraparameterstoset) &mdash; Override this method if you want to add custom request parameters to the API request based on ViewDataTable parameters.

<a name="getproperties" id="getproperties"></a>
<a name="getProperties" id="getProperties"></a>
### `getProperties()`

#### Signature

- It does not return anything.

<a name="addpropertiesthatshouldbeavailableclientside" id="addpropertiesthatshouldbeavailableclientside"></a>
<a name="addPropertiesThatShouldBeAvailableClientSide" id="addPropertiesThatShouldBeAvailableClientSide"></a>
### `addPropertiesThatShouldBeAvailableClientSide()`

Marks request properties as client side properties. [Read this](#client-side-properties-desc)
to learn more.

#### Signature

-  It accepts the following parameter(s):
    - `$propertyNames` (`array`) &mdash;
       List of property names, eg, `array('disable_queued_filters', 'filter_column')`.
- It does not return anything.

<a name="addpropertiesthatcanbeoverwrittenbyqueryparams" id="addpropertiesthatcanbeoverwrittenbyqueryparams"></a>
<a name="addPropertiesThatCanBeOverwrittenByQueryParams" id="addPropertiesThatCanBeOverwrittenByQueryParams"></a>
### `addPropertiesThatCanBeOverwrittenByQueryParams()`

Marks display properties as overridable. [Read this](#overridable-properties-desc) to
learn more.

#### Signature

-  It accepts the following parameter(s):
    - `$propertyNames` (`array`) &mdash;
       List of property names, eg, `array('disable_queued_filters', 'filter_column')`.
- It does not return anything.

<a name="setdefaultsort" id="setdefaultsort"></a>
<a name="setDefaultSort" id="setDefaultSort"></a>
### `setDefaultSort()`

#### Signature

-  It accepts the following parameter(s):
    - `$columnsToDisplay`
      
    - `$hasNbUniqVisitors`
      
    - `$actualColumns`
      
- It does not return anything.

<a name="getapimoduletorequest" id="getapimoduletorequest"></a>
<a name="getApiModuleToRequest" id="getApiModuleToRequest"></a>
### `getApiModuleToRequest()`

#### Signature

- It does not return anything.

<a name="getapimethodtorequest" id="getapimethodtorequest"></a>
<a name="getApiMethodToRequest" id="getApiMethodToRequest"></a>
### `getApiMethodToRequest()`

#### Signature

- It does not return anything.

<a name="getrequestparam" id="getrequestparam"></a>
<a name="getRequestParam" id="getRequestParam"></a>
### `getRequestParam()`

#### Signature

-  It accepts the following parameter(s):
    - `$paramName`
      
- It does not return anything.

<a name="getextraparameterstoset" id="getextraparameterstoset"></a>
<a name="getExtraParametersToSet" id="getExtraParametersToSet"></a>
### `getExtraParametersToSet()`

Override this method if you want to add custom request parameters to the API request based on ViewDataTable
parameters. Return in the result the list of extra parameters.

#### Signature


- *Returns:*  `array` &mdash;
    eg, `['mycustomparam']`

