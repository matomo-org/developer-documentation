<small>Piwik\</small>

Archive
=======

The **Archive** class is used to query cached analytics statistics (termed "archive data").

You can use **Archive** instances to get data that was archived for one or more sites,
for one or more periods and one optional segment.

If archive data is not found, this class will initiate the archiving process. [1](#footnote-1)

**Archive** instances must be created using the [build()](/api-reference/Piwik/Archive#build) factory method;
they cannot be constructed.

You can search for metrics (such as `nb_visits`) using the [getNumeric()](/api-reference/Piwik/Archive#getnumeric) and
[getDataTableFromNumeric()](/api-reference/Piwik/Archive#getdatatablefromnumeric) methods. You can search for
reports using the [getBlob()](/api-reference/Piwik/Archive#getblob), [getDataTable()](/api-reference/Piwik/Archive#getdatatable) and [getDataTableExpanded()](/api-reference/Piwik/Archive#getdatatableexpanded) methods.

If you're creating an API that returns report data, you may want to use the
[getDataTableFromArchive()](/api-reference/Piwik/Archive#getdatatablefromarchive) helper function.

### Learn more

Learn more about _archiving_ [here](/guides/all-about-analytics-data).

### Limitations

- You cannot get data for multiple range periods in a single query.
- You cannot get data for periods of different types in a single query.

### Examples

**_Querying metrics for an API method_**

    // one site and one period
    $archive = Archive::build($idSite = 1, $period = 'week', $date = '2013-03-08');
    return $archive->getDataTableFromNumeric(array('nb_visits', 'nb_actions'));
    
    // all sites and multiple dates
    $archive = Archive::build($idSite = 'all', $period = 'month', $date = '2013-01-02,2013-03-08');
    return $archive->getDataTableFromNumeric(array('nb_visits', 'nb_actions'));

**_Querying and using metrics immediately_**

    // one site and one period
    $archive = Archive::build($idSite = 1, $period = 'week', $date = '2013-03-08');
    $data = $archive->getNumeric(array('nb_visits', 'nb_actions'));
    
    $visits = $data['nb_visits'];
    $actions = $data['nb_actions'];

    // ... do something w/ metric data ...

    // multiple sites and multiple dates
    $archive = Archive::build($idSite = '1,2,3', $period = 'month', $date = '2013-01-02,2013-03-08');
    $data = $archive->getNumeric('nb_visits');
    
    $janSite1Visits = $data['1']['2013-01-01,2013-01-31']['nb_visits'];
    $febSite1Visits = $data['1']['2013-02-01,2013-02-28']['nb_visits'];
    // ... etc.
    
**_Querying for reports_**

    $archive = Archive::build($idSite = 1, $period = 'week', $date = '2013-03-08');
    $dataTable = $archive->getDataTable('MyPlugin_MyReport');
    // ... manipulate $dataTable ...
    return $dataTable;

**_Querying a report for an API method_**

    public function getMyReport($idSite, $period, $date, $segment = false, $expanded = false)
    {
        $dataTable = Archive::getDataTableFromArchive('MyPlugin_MyReport', $idSite, $period, $date, $segment, $expanded);
        $dataTable->queueFilter('ReplaceColumnNames');
        return $dataTable;
    }

**_Querying data for multiple range periods_**

    // get data for first range
    $archive = Archive::build($idSite = 1, $period = 'range', $date = '2013-03-08,2013-03-12');
    $dataTable = $archive->getDataTableFromNumeric(array('nb_visits', 'nb_actions'));
    
    // get data for second range
    $archive = Archive::build($idSite = 1, $period = 'range', $date = '2013-03-15,2013-03-20');
    $dataTable = $archive->getDataTableFromNumeric(array('nb_visits', 'nb_actions'));

<a name="footnote-1"></a>
[1]: The archiving process will not be launched if browser archiving is disabled
     and the current request came from a browser.

Methods
-------

The class defines the following methods:

- [`build()`](#build) &mdash; Returns a new Archive instance that will query archive data for the given set of sites and periods, using an optional Segment.
- [`factory()`](#factory) &mdash; Returns a new Archive instance that will query archive data for the given set of sites and periods, using an optional segment.
- [`getNumeric()`](#getnumeric) &mdash; Queries and returns metric data in an array.
- [`getBlob()`](#getblob) &mdash; Queries and returns blob data in an array.
- [`getDataTableFromNumeric()`](#getdatatablefromnumeric) &mdash; Queries and returns metric data in a DataTable instance.
- [`getDataTable()`](#getdatatable) &mdash; Queries and returns one or more reports as DataTable instances.
- [`getDataTableExpanded()`](#getdatatableexpanded) &mdash; Queries and returns one report with all of its subtables loaded.
- [`getParams()`](#getparams) &mdash; Returns an object describing the set of sites, the set of periods and the segment this Archive will query data for.
- [`getDataTableFromArchive()`](#getdatatablefromarchive) &mdash; Helper function that creates an Archive instance and queries for report data using query parameter data.

<a name="build" id="build"></a>
<a name="build" id="build"></a>
### `build()` 
Returns a new Archive instance that will query archive data for the given set of sites and periods, using an optional Segment.

This method uses data that is found in query parameters, so the parameters to this
function can be string values.

If you want to create an Archive instance with an array of Period instances, use
[Archive::factory()](/api-reference/Piwik/Archive#factory).

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$idSites` (`string`|`int`|`array`) &mdash;

      <div markdown="1" class="param-desc"> A single ID (eg, `'1'`), multiple IDs (eg, `'1,2,3'` or `array(1, 2, 3)`), or `'all'`.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$period` (`string`) &mdash;

      <div markdown="1" class="param-desc"> 'day', `'week'`, `'month'`, `'year'` or `'range'`</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$strDate` ([`Date`](../Piwik/Date.md)|`string`) &mdash;

      <div markdown="1" class="param-desc"> 'YYYY-MM-DD', magic keywords (ie, 'today'; [Date::factory()](/api-reference/Piwik/Date#factory) or date range (ie, 'YYYY-MM-DD,YYYY-MM-DD').</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$segment` (`bool`|`Piwik\false`|`string`) &mdash;

      <div markdown="1" class="param-desc"> Segment definition or false if no segment should be used. [Segment](/api-reference/Piwik/Segment)</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$_restrictSitesToLogin` (`bool`|`Piwik\false`|`string`) &mdash;

      <div markdown="1" class="param-desc"> Used only when running as a scheduled task.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$skipAggregationOfSubTables` (`bool`) &mdash;

      <div markdown="1" class="param-desc"> Whether the archive, when it is processed, should also aggregate all sub-tables</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It returns a [`Archive`](../Piwik/Archive.md) value.

<a name="factory" id="factory"></a>
<a name="factory" id="factory"></a>
### `factory()` 
Returns a new Archive instance that will query archive data for the given set of sites and periods, using an optional segment.

This method uses an array of Period instances and a Segment instance, instead of strings
like [build()](/api-reference/Piwik/Archive#build).

If you want to create an Archive instance using data found in query parameters,
use [build()](/api-reference/Piwik/Archive#build).

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$segment` ([`Segment`](../Piwik/Segment.md)) &mdash;

      <div markdown="1" class="param-desc"> The segment to use. For no segment, use `new Segment('', $idSites)`.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$periods` (`array`) &mdash;

      <div markdown="1" class="param-desc"> An array of Period instances.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$idSites` (`array`) &mdash;

      <div markdown="1" class="param-desc"> An array of site IDs (eg, `array(1, 2, 3)`).</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$idSiteIsAll` (`bool`) &mdash;

      <div markdown="1" class="param-desc"> Whether `'all'` sites are being queried or not. If true, then the result of querying functions will be indexed by site, regardless of whether `count($idSites) == 1`.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$isMultipleDate` (`bool`) &mdash;

      <div markdown="1" class="param-desc"> Whether multiple dates are being queried or not. If true, then the result of querying functions will be indexed by period, regardless of whether `count($periods) == 1`.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$skipAggregationOfSubTables` (`bool`) &mdash;

      <div markdown="1" class="param-desc"> Whether the archive should skip aggregation of all sub-tables</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It returns a [`Archive`](../Piwik/Archive.md) value.

<a name="getnumeric" id="getnumeric"></a>
<a name="getNumeric" id="getNumeric"></a>
### `getNumeric()` 
Queries and returns metric data in an array.

If multiple sites were requested in [build()](/api-reference/Piwik/Archive#build) or [factory()](/api-reference/Piwik/Archive#factory) the result will
be indexed by site ID.

If multiple periods were requested in [build()](/api-reference/Piwik/Archive#build) or [factory()](/api-reference/Piwik/Archive#factory) the result will
be indexed by period.

The site ID index is always first, so if multiple sites & periods were requested, the result
will be indexed by site ID first, then period.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$names` (`string`|`array`) &mdash;

      <div markdown="1" class="param-desc"> One or more archive names, eg, `'nb_visits'`, `'Referrers_distinctKeywords'`, etc.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`Piwik\false`|`Piwik\numeric`|`array`) &mdash;
    <div markdown="1" class="param-desc">`false` if there is no data to return, a single numeric value if we're not querying for multiple sites/periods, or an array if multiple sites, periods or names are queried for.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="getblob" id="getblob"></a>
<a name="getBlob" id="getBlob"></a>
### `getBlob()` 
Queries and returns blob data in an array.

Reports are stored in blobs as serialized arrays of [Row](/api-reference/Piwik/DataTable/Row) instances, but this
data can technically be anything. In other words, you can store whatever you want
as archive data blobs.

If multiple sites were requested in [build()](/api-reference/Piwik/Archive#build) or [factory()](/api-reference/Piwik/Archive#factory) the result will
be indexed by site ID.

If multiple periods were requested in [build()](/api-reference/Piwik/Archive#build) or [factory()](/api-reference/Piwik/Archive#factory) the result will
be indexed by period.

The site ID index is always first, so if multiple sites & periods were requested, the result
will be indexed by site ID first, then period.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$names` (`string`|`array`) &mdash;

      <div markdown="1" class="param-desc"> One or more archive names, eg, `'Referrers_keywordBySearchEngine'`.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$idSubtable` (`null`|`string`) &mdash;

      <div markdown="1" class="param-desc"> If we're returning serialized DataTable data, then this refers to the subtable ID to return. If set to 'all', all subtables of each requested report are returned.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`array`) &mdash;
    <div markdown="1" class="param-desc">An array of appropriately indexed blob data.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="getdatatablefromnumeric" id="getdatatablefromnumeric"></a>
<a name="getDataTableFromNumeric" id="getDataTableFromNumeric"></a>
### `getDataTableFromNumeric()` 
Queries and returns metric data in a DataTable instance.

If multiple sites were requested in [build()](/api-reference/Piwik/Archive#build) or [factory()](/api-reference/Piwik/Archive#factory) the result will
be a DataTable\Map that is indexed by site ID.

If multiple periods were requested in [build()](/api-reference/Piwik/Archive#build) or [factory()](/api-reference/Piwik/Archive#factory) the result will
be a [Map](/api-reference/Piwik/DataTable/Map) that is indexed by period.

The site ID index is always first, so if multiple sites & periods were requested, the result
will be a [Map](/api-reference/Piwik/DataTable/Map) indexed by site ID which contains [Map](/api-reference/Piwik/DataTable/Map) instances that are
indexed by period.

_Note: Every DataTable instance returned will have at most one row in it. The contents of each
       row will be the requested metrics for the appropriate site and period._

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$names` (`string`|`array`) &mdash;

      <div markdown="1" class="param-desc"> One or more archive names, eg, 'nb_visits', 'Referrers_distinctKeywords', etc.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  ([`DataTable`](../Piwik/DataTable.md)|[`Map`](../Piwik/DataTable/Map.md)) &mdash;
    <div markdown="1" class="param-desc">A DataTable if multiple sites and periods were not requested. An appropriately indexed DataTable\Map if otherwise.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="getdatatable" id="getdatatable"></a>
<a name="getDataTable" id="getDataTable"></a>
### `getDataTable()` 
Queries and returns one or more reports as DataTable instances.

This method will query blob data that is a serialized array of of [Row](/api-reference/Piwik/DataTable/Row)'s and
unserialize it.

If multiple sites were requested in [build()](/api-reference/Piwik/Archive#build) or [factory()](/api-reference/Piwik/Archive#factory) the result will
be a [Map](/api-reference/Piwik/DataTable/Map) that is indexed by site ID.

If multiple periods were requested in [build()](/api-reference/Piwik/Archive#build) or [factory()](/api-reference/Piwik/Archive#factory) the result will
be a DataTable\Map that is indexed by period.

The site ID index is always first, so if multiple sites & periods were requested, the result
will be a [Map](/api-reference/Piwik/DataTable/Map) indexed by site ID which contains [Map](/api-reference/Piwik/DataTable/Map) instances that are
indexed by period.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$name` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The name of the record to get. This method can only query one record at a time.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$idSubtable` (`int`|`string`|`null`) &mdash;

      <div markdown="1" class="param-desc"> The ID of the subtable to get (if any).</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  ([`DataTable`](../Piwik/DataTable.md)|[`Map`](../Piwik/DataTable/Map.md)) &mdash;
    <div markdown="1" class="param-desc">A DataTable if multiple sites and periods were not requested. An appropriately indexed [Map](/api-reference/Piwik/DataTable/Map) if otherwise.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="getdatatableexpanded" id="getdatatableexpanded"></a>
<a name="getDataTableExpanded" id="getDataTableExpanded"></a>
### `getDataTableExpanded()` 
Queries and returns one report with all of its subtables loaded.

If multiple sites were requested in [build()](/api-reference/Piwik/Archive#build) or [factory()](/api-reference/Piwik/Archive#factory) the result will
be a DataTable\Map that is indexed by site ID.

If multiple periods were requested in [build()](/api-reference/Piwik/Archive#build) or [factory()](/api-reference/Piwik/Archive#factory) the result will
be a DataTable\Map that is indexed by period.

The site ID index is always first, so if multiple sites & periods were requested, the result
will be a [indexed](/api-reference/Piwik/DataTable/Map) by site ID which contains [Map](/api-reference/Piwik/DataTable/Map) instances that are
indexed by period.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$name` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The name of the record to get.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$idSubtable` (`int`|`string`|`null`) &mdash;

      <div markdown="1" class="param-desc"> The ID of the subtable to get (if any). The subtable will be expanded.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$depth` (`int`|`null`) &mdash;

      <div markdown="1" class="param-desc"> The maximum number of subtable levels to load. If null, all levels are loaded. For example, if `1` is supplied, then the DataTable returned will have its subtables loaded. Those subtables, however, will NOT have their subtables loaded.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$addMetadataSubtableId` (`bool`) &mdash;

      <div markdown="1" class="param-desc"> Whether to add the database subtable ID as metadata to each datatable, or not.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  ([`DataTable`](../Piwik/DataTable.md)|[`Map`](../Piwik/DataTable/Map.md)) &mdash;
    <div markdown="1" class="param-desc"></div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="getparams" id="getparams"></a>
<a name="getParams" id="getParams"></a>
### `getParams()` 
Returns an object describing the set of sites, the set of periods and the segment this Archive will query data for.

#### Signature

- It returns a `Piwik\Archive\Parameters` value.

<a name="getdatatablefromarchive" id="getdatatablefromarchive"></a>
<a name="getDataTableFromArchive" id="getDataTableFromArchive"></a>
### `getDataTableFromArchive()` 
Helper function that creates an Archive instance and queries for report data using query parameter data.

API methods can use this method to reduce code redundancy.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$name` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The name of the report to return.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$idSite` (`int`|`string`|`array`) &mdash;

      <div markdown="1" class="param-desc"> @see [build()](/api-reference/Piwik/Archive#build)</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$period` (`string`) &mdash;

      <div markdown="1" class="param-desc"> @see [build()](/api-reference/Piwik/Archive#build)</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$date` (`string`) &mdash;

      <div markdown="1" class="param-desc"> @see [build()](/api-reference/Piwik/Archive#build)</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$segment` (`string`) &mdash;

      <div markdown="1" class="param-desc"> @see [build()](/api-reference/Piwik/Archive#build)</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$expanded` (`bool`) &mdash;

      <div markdown="1" class="param-desc"> If true, loads all subtables. See [getDataTableExpanded()](/api-reference/Piwik/Archive#getdatatableexpanded)</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$idSubtable` (`int`|`null`) &mdash;

      <div markdown="1" class="param-desc"> See [getDataTableExpanded()](/api-reference/Piwik/Archive#getdatatableexpanded)</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$skipAggregationOfSubTables` (`bool`) &mdash;

      <div markdown="1" class="param-desc"> Whether or not we should skip the aggregation of all sub-tables and only aggregate parent DataTable.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$depth` (`int`|`null`) &mdash;

      <div markdown="1" class="param-desc"> See [getDataTableExpanded()](/api-reference/Piwik/Archive#getdatatableexpanded)</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  ([`DataTable`](../Piwik/DataTable.md)|[`Map`](../Piwik/DataTable/Map.md)) &mdash;
    <div markdown="1" class="param-desc">See [getDataTable()](/api-reference/Piwik/Archive#getdatatable) and [getDataTableExpanded()](/api-reference/Piwik/Archive#getdatatableexpanded) for more information</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

