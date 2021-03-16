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
reports using the getBlob(), [getDataTable()](/api-reference/Piwik/Archive#getdatatable) and [getDataTableExpanded()](/api-reference/Piwik/Archive#getdatatableexpanded) methods.

If you're creating an API that returns report data, you may want to use the
[createDataTableFromArchive()](/api-reference/Piwik/Archive#createdatatablefromarchive) helper function.

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
        $dataTable = Archive::createDataTableFromArchive('MyPlugin_MyReport', $idSite, $period, $date, $segment, $expanded);
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

- [`__construct()`](#__construct)
- [`build()`](#build) &mdash; Returns a new Archive instance that will query archive data for the given set of sites and periods, using an optional Segment.
- [`factory()`](#factory) &mdash; Returns a new Archive instance that will query archive data for the given set of sites and periods, using an optional segment.
- [`shouldSkipArchiveIfSkippingSegmentArchiveForToday()`](#shouldskiparchiveifskippingsegmentarchivefortoday)
- [`getNumeric()`](#getnumeric) &mdash; Queries and returns metric data in an array.
- [`getDataTableFromNumeric()`](#getdatatablefromnumeric) &mdash; Queries and returns metric data in a DataTable instance.
- [`getDataTable()`](#getdatatable) &mdash; Queries and returns one or more reports as DataTable instances.
- [`getDataTableExpanded()`](#getdatatableexpanded) &mdash; Queries and returns one report with all of its subtables loaded.
- [`getParams()`](#getparams) &mdash; Returns an object describing the set of sites, the set of periods and the segment this Archive will query data for.
- [`createDataTableFromArchive()`](#createdatatablefromarchive) &mdash; Helper function that creates an Archive instance and queries for report data using query parameter data.
- [`getPluginForReport()`](#getpluginforreport) &mdash; Returns the name of the plugin that archives a given report.
- [`forceFetchingWithoutLaunchingArchiving()`](#forcefetchingwithoutlaunchingarchiving)

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

#### Signature

-  It accepts the following parameter(s):
    - `$params` (`Piwik\Archive\Parameters`) &mdash;
      
    - `$forceIndexedBySite` (`bool`) &mdash;
       Whether to force index the result of a query by site ID.
    - `$forceIndexedByDate` (`bool`) &mdash;
       Whether to force index the result of a query by period.

<a name="build" id="build"></a>
<a name="build" id="build"></a>
### `build()`

Returns a new Archive instance that will query archive data for the given set of
sites and periods, using an optional Segment.

This method uses data that is found in query parameters, so the parameters to this
function can be string values.

If you want to create an Archive instance with an array of Period instances, use
[Archive::factory()](/api-reference/Piwik/Archive#factory).

#### Signature

-  It accepts the following parameter(s):
    - `$idSites` (`string`|`int`|`array`) &mdash;
       A single ID (eg, `'1'`), multiple IDs (eg, `'1,2,3'` or `array(1, 2, 3)`), or `'all'`.
    - `$period` (`string`) &mdash;
       'day', `'week'`, `'month'`, `'year'` or `'range'`
    - `$strDate` ([`Date`](../Piwik/Date.md)|`string`) &mdash;
       'YYYY-MM-DD', magic keywords (ie, 'today'; [Date::factory()](/api-reference/Piwik/Date#factory) or date range (ie, 'YYYY-MM-DD,YYYY-MM-DD').
    - `$segment` (`bool`|`false`|`string`) &mdash;
       Segment definition or false if no segment should be used. [Segment](/api-reference/Piwik/Segment)
    - `$_restrictSitesToLogin` (`bool`|`false`|`string`) &mdash;
       Used only when running as a scheduled task.
- It returns a `Piwik\Archive\ArchiveQuery` value.

<a name="factory" id="factory"></a>
<a name="factory" id="factory"></a>
### `factory()`

Returns a new Archive instance that will query archive data for the given set of
sites and periods, using an optional segment.

This method uses an array of Period instances and a Segment instance, instead of strings
like [build()](/api-reference/Piwik/Archive#build).

If you want to create an Archive instance using data found in query parameters,
use [build()](/api-reference/Piwik/Archive#build).

#### Signature

-  It accepts the following parameter(s):
    - `$segment` ([`Segment`](../Piwik/Segment.md)) &mdash;
       The segment to use. For no segment, use `new Segment('', $idSites)`.
    - `$periods` (`array`) &mdash;
       An array of Period instances.
    - `$idSites` (`array`) &mdash;
       An array of site IDs (eg, `array(1, 2, 3)`).
    - `$idSiteIsAll` (`bool`) &mdash;
       Whether `'all'` sites are being queried or not. If true, then the result of querying functions will be indexed by site, regardless of whether `count($idSites) == 1`.
    - `$isMultipleDate` (`bool`) &mdash;
       Whether multiple dates are being queried or not. If true, then the result of querying functions will be indexed by period, regardless of whether `count($periods) == 1`.
- It returns a `Piwik\Archive\ArchiveQuery` value.

<a name="shouldskiparchiveifskippingsegmentarchivefortoday" id="shouldskiparchiveifskippingsegmentarchivefortoday"></a>
<a name="shouldSkipArchiveIfSkippingSegmentArchiveForToday" id="shouldSkipArchiveIfSkippingSegmentArchiveForToday"></a>
### `shouldSkipArchiveIfSkippingSegmentArchiveForToday()`

#### Signature

-  It accepts the following parameter(s):
    - `$site` ([`Site`](../Piwik/Site.md)) &mdash;
      
    - `$period` ([`Period`](../Piwik/Period.md)) &mdash;
      
    - `$segment` ([`Segment`](../Piwik/Segment.md)) &mdash;
      
- It does not return anything or a mixed result.

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
    - `$names` (`string`|`array`) &mdash;
       One or more archive names, eg, `'nb_visits'`, `'Referrers_distinctKeywords'`, etc.

- *Returns:*  `false`|`integer`|`array` &mdash;
    `false` if there is no data to return, a single numeric value if we're not querying
                            for multiple sites/periods, or an array if multiple sites, periods or names are
                            queried for.

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
    - `$names` (`string`|`array`) &mdash;
       One or more archive names, eg, 'nb_visits', 'Referrers_distinctKeywords', etc.

- *Returns:*  [`DataTable`](../Piwik/DataTable.md)|[`Map`](../Piwik/DataTable/Map.md) &mdash;
    A DataTable if multiple sites and periods were not requested.
                                An appropriately indexed DataTable\Map if otherwise.

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
    - `$name` (`string`) &mdash;
       The name of the record to get. This method can only query one record at a time.
    - `$idSubtable` (`int`|`string`|`null`) &mdash;
       The ID of the subtable to get (if any).

- *Returns:*  [`DataTable`](../Piwik/DataTable.md)|[`Map`](../Piwik/DataTable/Map.md) &mdash;
    A DataTable if multiple sites and periods were not requested.
                                An appropriately indexed [Map](/api-reference/Piwik/DataTable/Map) if otherwise.

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
    - `$name` (`string`) &mdash;
       The name of the record to get.
    - `$idSubtable` (`int`|`string`|`null`) &mdash;
       The ID of the subtable to get (if any). The subtable will be expanded.
    - `$depth` (`int`|`null`) &mdash;
       The maximum number of subtable levels to load. If null, all levels are loaded. For example, if `1` is supplied, then the DataTable returned will have its subtables loaded. Those subtables, however, will NOT have their subtables loaded.
    - `$addMetadataSubtableId` (`bool`) &mdash;
       Whether to add the database subtable ID as metadata to each datatable, or not.

- *Returns:*  [`DataTable`](../Piwik/DataTable.md)|[`Map`](../Piwik/DataTable/Map.md) &mdash;
    

<a name="getparams" id="getparams"></a>
<a name="getParams" id="getParams"></a>
### `getParams()`

Returns an object describing the set of sites, the set of periods and the segment
this Archive will query data for.

#### Signature

- It returns a `Piwik\Archive\Parameters` value.

<a name="createdatatablefromarchive" id="createdatatablefromarchive"></a>
<a name="createDataTableFromArchive" id="createDataTableFromArchive"></a>
### `createDataTableFromArchive()`

Helper function that creates an Archive instance and queries for report data using
query parameter data. API methods can use this method to reduce code redundancy.

#### Signature

-  It accepts the following parameter(s):
    - `$recordName` (`string`) &mdash;
       The name of the report to return.
    - `$idSite` (`int`|`string`|`array`) &mdash;
       @see [build()](/api-reference/Piwik/Archive#build)
    - `$period` (`string`) &mdash;
       @see [build()](/api-reference/Piwik/Archive#build)
    - `$date` (`string`) &mdash;
       @see [build()](/api-reference/Piwik/Archive#build)
    - `$segment` (`string`) &mdash;
       @see [build()](/api-reference/Piwik/Archive#build)
    - `$expanded` (`bool`) &mdash;
       If true, loads all subtables. See [getDataTableExpanded()](/api-reference/Piwik/Archive#getdatatableexpanded)
    - `$flat` (`bool`) &mdash;
       If true, loads all subtables and disabled all recursive filters.
    - `$idSubtable` (`int`|`null`) &mdash;
       See [getDataTableExpanded()](/api-reference/Piwik/Archive#getdatatableexpanded)
    - `$depth` (`int`|`null`) &mdash;
       See [getDataTableExpanded()](/api-reference/Piwik/Archive#getdatatableexpanded)

- *Returns:*  [`DataTable`](../Piwik/DataTable.md)|[`Map`](../Piwik/DataTable/Map.md) &mdash;
    

<a name="getpluginforreport" id="getpluginforreport"></a>
<a name="getPluginForReport" id="getPluginForReport"></a>
### `getPluginForReport()`

Returns the name of the plugin that archives a given report.

#### Signature

-  It accepts the following parameter(s):
    - `$report` (`string`) &mdash;
       Archive data name, eg, `'nb_visits'`, `'DevicesDetection_...'`, etc.

- *Returns:*  `string` &mdash;
    Plugin name.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If a plugin cannot be found or if the plugin for the report isn&#039;t
                   activated.

<a name="forcefetchingwithoutlaunchingarchiving" id="forcefetchingwithoutlaunchingarchiving"></a>
<a name="forceFetchingWithoutLaunchingArchiving" id="forceFetchingWithoutLaunchingArchiving"></a>
### `forceFetchingWithoutLaunchingArchiving()`

#### Signature

- It does not return anything or a mixed result.

