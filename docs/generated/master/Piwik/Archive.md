<small>Piwik</small>

Archive
=======

The **Archive** class is used to query cached analytics statistics (termed &quot;archive data&quot;).

Description
-----------

You can use **Archive** instances to get archive data for one or more sites,
for one or more periods and one optional segment.

If archive data is not found, this class will initiate the archiving process. [1](#footnote-1)

**Archive** instances must be created using the [build](#build) factory method;
they cannot be constructed.

You can search for metrics (such as `nb_visits`) using the [getNumeric](#getNumeric) and
[getDataTableFromNumeric](#getDataTableFromNumeric) methods. You can search for
reports using the [getBlob](#getBlob), [getDataTable](#getDataTable) and
[getDataTableExpanded](#getDataTableExpanded) methods.

If you're creating an API that returns report data, you may want to use the
[getDataTableFromArchive](#getDataTableFromArchive) helper function.

### Learn more

Learn more about _archiving_ [here](#).

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
     and the current request came from a browser (and not the archive.php cron
     script).


Constants
---------

This class defines the following constants:

- `REQUEST_ALL_WEBSITES_FLAG`
- `ARCHIVE_ALL_PLUGINS_FLAG`
- `ID_SUBTABLE_LOAD_ALL_SUBTABLES`

Methods
-------

The class defines the following methods:

- [`build()`](#build) &mdash; Returns a new Archive instance that will query archive data for the given set of sites and periods, using an optional Segment.
- [`factory()`](#factory) &mdash; Returns a new Archive instance that will query archive data for the given set of sites and periods, using an optional segment.
- [`getNumeric()`](#getnumeric) &mdash; Queries and returns metric data in an array.
- [`getBlob()`](#getblob) &mdash; Queries and returns blob data in an array.
- [`getDataTableFromNumeric()`](#getdatatablefromnumeric) &mdash; Queries and returns metric data in a DataTable instance.
- [`getDataTable()`](#getdatatable) &mdash; Queries and returns a single report as a DataTable instance.
- [`getDataTableExpanded()`](#getdatatableexpanded) &mdash; Queries and returns one report with all of its subtables loaded.
- [`getRequestedPlugins()`](#getrequestedplugins) &mdash; Returns the list of plugins that archive the given reports.
- [`getDataTableFromArchive()`](#getdatatablefromarchive) &mdash; Helper function that creates an Archive instance and queries for report data using query parameter data.
- [`getParams()`](#getparams) &mdash; Returns an object describing the set of sites, the set of periods and the segment this Archive will query data for.
- [`getPluginForReport()`](#getpluginforreport) &mdash; Returns the name of the plugin that archives a given report.

<a name="build" id="build"></a>
### `build()`

Returns a new Archive instance that will query archive data for the given set of sites and periods, using an optional Segment.

#### Description

This method uses data that is found in query parameters, so the parameters to this
function can all be strings.

If you want to create an Archive instance with an array of Period instances, use
[Archive::factory](#factory).

#### Signature

- It accepts the following parameter(s):
    - `$idSites`
    - `$period`
    - `$strDate`
    - `$segment`
    - `$_restrictSitesToLogin`
- It returns a(n) [`Archive`](../Piwik/Archive.md) value.

<a name="factory" id="factory"></a>
### `factory()`

Returns a new Archive instance that will query archive data for the given set of sites and periods, using an optional segment.

#### Description

This method uses an array of Period instances and a Segment instance, instead of strings
like [Archive::build](#build).

If you want to create an Archive instance using data found in query parameters,
use [Archive::build](#build).

#### Signature

- It accepts the following parameter(s):
    - `$segment` ([`Segment`](../Piwik/Segment.md))
    - `$periods` (`array`)
    - `$idSites` (`array`)
    - `$idSiteIsAll`
    - `$isMultipleDate`
- It returns a(n) [`Archive`](../Piwik/Archive.md) value.

<a name="getnumeric" id="getnumeric"></a>
### `getNumeric()`

Queries and returns metric data in an array.

#### Description

If multiple sites were requested in [build](#build) or [factory](#factory) the result will
be indexed by site ID.

If multiple periods were requested in [build](#build) or [factory](#factory) the result will
be indexed by period.

The site ID index is always first, so if multiple sites & periods were requested, the result
will be indexed by site ID first, then period.

#### Signature

- It accepts the following parameter(s):
    - `$names`
- _Returns:_ False if there is no data to return, a numeric if only we're not querying for multiple sites/dates, or an array if multiple sites, dates or names are queried for.
    - `mixed`

<a name="getblob" id="getblob"></a>
### `getBlob()`

Queries and returns blob data in an array.

#### Description

Reports are stored in blobs as serialized arrays of DataTable\Row instances, but this
data can technically be anything. In other words, you can store whatever you want
as archive data blobs.

If multiple sites were requested in [build](#build) or [factory](#factory) the result will
be indexed by site ID.

If multiple periods were requested in [build](#build) or [factory](#factory) the result will
be indexed by period.

The site ID index is always first, so if multiple sites & periods were requested, the result
will be indexed by site ID first, then period.

#### Signature

- It accepts the following parameter(s):
    - `$names`
    - `$idSubtable`
- _Returns:_ An array of appropriately indexed blob data.
    - `array`

<a name="getdatatablefromnumeric" id="getdatatablefromnumeric"></a>
### `getDataTableFromNumeric()`

Queries and returns metric data in a DataTable instance.

#### Description

If multiple sites were requested in [build](#build) or [factory](#factory) the result will
be a DataTable\Map that is indexed by site ID.

If multiple periods were requested in [build](#build) or [factory](#factory) the result will
be a DataTable\Map that is indexed by period.

The site ID index is always first, so if multiple sites & periods were requested, the result
will be a DataTable\Map indexed by site ID which contains DataTable\Map instances that are
indexed by period.

Note: Every DataTable instance returned will have at most one row in it. The contents of each
      row will be the requested metrics for the appropriate site and period.

#### Signature

- It accepts the following parameter(s):
    - `$names`
- _Returns:_ A DataTable if multiple sites and periods were not requested. An appropriately indexed DataTable\Map if otherwise.
    - [`DataTable`](../Piwik/DataTable.md)
    - [`Map`](../Piwik/DataTable/Map.md)

<a name="getdatatable" id="getdatatable"></a>
### `getDataTable()`

Queries and returns a single report as a DataTable instance.

#### Description

This method will query blob data that is a serialized array of of DataTable\Row's and
unserialize it.

If multiple sites were requested in [build](#build) or [factory](#factory) the result will
be a DataTable\Map that is indexed by site ID.

If multiple periods were requested in [build](#build) or [factory](#factory) the result will
be a DataTable\Map that is indexed by period.

The site ID index is always first, so if multiple sites & periods were requested, the result
will be a DataTable\Map indexed by site ID which contains DataTable\Map instances that are
indexed by period.

#### Signature

- It accepts the following parameter(s):
    - `$name`
    - `$idSubtable`
- _Returns:_ A DataTable if multiple sites and periods were not requested. An appropriately indexed DataTable\Map if otherwise.
    - [`DataTable`](../Piwik/DataTable.md)
    - [`Map`](../Piwik/DataTable/Map.md)

<a name="getdatatableexpanded" id="getdatatableexpanded"></a>
### `getDataTableExpanded()`

Queries and returns one report with all of its subtables loaded.

#### Description

If multiple sites were requested in [build](#build) or [factory](#factory) the result will
be a DataTable\Map that is indexed by site ID.

If multiple periods were requested in [build](#build) or [factory](#factory) the result will
be a DataTable\Map that is indexed by period.

The site ID index is always first, so if multiple sites & periods were requested, the result
will be a DataTable\Map indexed by site ID which contains DataTable\Map instances that are
indexed by period.

#### Signature

- It accepts the following parameter(s):
    - `$name`
    - `$idSubtable`
    - `$depth`
    - `$addMetadataSubtableId`
- It returns a(n) [`DataTable`](../Piwik/DataTable.md) value.

<a name="getrequestedplugins" id="getrequestedplugins"></a>
### `getRequestedPlugins()`

Returns the list of plugins that archive the given reports.

#### Signature

- It accepts the following parameter(s):
    - `$archiveNames`
- It returns a(n) `array` value.

<a name="getdatatablefromarchive" id="getdatatablefromarchive"></a>
### `getDataTableFromArchive()`

Helper function that creates an Archive instance and queries for report data using query parameter data.

#### Description

API methods can use this method to reduce code redundancy.

#### Signature

- It accepts the following parameter(s):
    - `$name`
    - `$idSite`
    - `$period`
    - `$date`
    - `$segment`
    - `$expanded`
    - `$idSubtable`
    - `$depth`
- _Returns:_ @see [getDataTable](#getDataTable) and [getDataTableExpanded](#getDataTableExpanded) for more information
    - [`DataTable`](../Piwik/DataTable.md)
    - [`Map`](../Piwik/DataTable/Map.md)

<a name="getparams" id="getparams"></a>
### `getParams()`

Returns an object describing the set of sites, the set of periods and the segment this Archive will query data for.

#### Signature

- It returns a(n) `Piwik\Archive\Parameters` value.

<a name="getpluginforreport" id="getpluginforreport"></a>
### `getPluginForReport()`

Returns the name of the plugin that archives a given report.

#### Signature

- It accepts the following parameter(s):
    - `$report`
- _Returns:_ Plugin name.
    - `string`
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If a plugin cannot be found or if the plugin for the report isn&#039;t activated.

