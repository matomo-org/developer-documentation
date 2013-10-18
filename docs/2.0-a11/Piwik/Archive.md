<small>Piwik</small>

Archive
=======

The **Archive** class is used to query archive data.


Constants
---------

This class defines the following constants:

- [`REQUEST_ALL_WEBSITES_FLAG`](#REQUEST_ALL_WEBSITES_FLAG)
- [`ARCHIVE_ALL_PLUGINS_FLAG`](#ARCHIVE_ALL_PLUGINS_FLAG)
- [`ID_SUBTABLE_LOAD_ALL_SUBTABLES`](#ID_SUBTABLE_LOAD_ALL_SUBTABLES)

Methods
-------

The class defines the following methods:

- [`build()`](#build) &mdash; Returns a new Archive instance that will query archive data for the given set of sites and periods, using an optional Segment.
- [`factory()`](#factory) &mdash; Returns a new Archive instance that will query archive data for the given set of sites and periods, using an optional segment.
- [`getNumeric()`](#getNumeric) &mdash; Queries and returns metric data in an array.
- [`getBlob()`](#getBlob) &mdash; Queries and returns blob data in an array.
- [`getDataTableFromNumeric()`](#getDataTableFromNumeric) &mdash; Queries and returns metric data in a DataTable instance.
- [`getDataTable()`](#getDataTable) &mdash; Queries and returns a single report as a DataTable instance.
- [`getDataTableExpanded()`](#getDataTableExpanded) &mdash; Queries and returns one report with all of its subtables loaded.
- [`getRequestedPlugins()`](#getRequestedPlugins) &mdash; Returns the list of plugins that archive the given reports.
- [`getDataTableFromArchive()`](#getDataTableFromArchive) &mdash; Helper function that creates an Archive instance and queries for report data using query parameter data.
- [`getParams()`](#getParams) &mdash; Returns an object describing the set of sites, the set of periods and the segment this Archive will query data for.
- [`getPluginForReport()`](#getPluginForReport) &mdash; Returns the name of the plugin that archives a given report.

### `build()` <a name="build"></a>

Returns a new Archive instance that will query archive data for the given set of sites and periods, using an optional Segment.

#### Description

This method uses data that is found in query parameters, so the parameters to this
function can all be strings.

If you want to create an Archive instance with an array of Period instances, use
[Archive::factory](#factory).

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$idSites`
    - `$period`
    - `$strDate`
    - `$segment`
    - `$_restrictSitesToLogin`
- It returns a(n) [`Archive`](../Piwik/Archive.md) value.

### `factory()` <a name="factory"></a>

Returns a new Archive instance that will query archive data for the given set of sites and periods, using an optional segment.

#### Description

This method uses an array of Period instances and a Segment instance, instead of strings
like [Archive::build](#build).

If you want to create an Archive instance using data found in query parameters,
use [Archive::build](#build).

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$segment` (`Piwik\Segment`)
    - `$periods` (`array`)
    - `$idSites` (`array`)
    - `$idSiteIsAll`
    - `$isMultipleDate`
- It returns a(n) [`Archive`](../Piwik/Archive.md) value.

### `getNumeric()` <a name="getNumeric"></a>

Queries and returns metric data in an array.

#### Description

If multiple sites were requested in [build](#build) or [factory](#factory) the result will
be indexed by site ID.

If multiple periods were requested in [build](#build) or [factory](#factory) the result will
be indexed by period.

The site ID index is always first, so if multiple sites &amp; periods were requested, the result
will be indexed by site ID first, then period.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$names`
- _Returns:_ False if there is no data to return, a numeric if only we&#039;re not querying for multiple sites/dates, or an array if multiple sites, dates or names are queried for.
    - `mixed`

### `getBlob()` <a name="getBlob"></a>

Queries and returns blob data in an array.

#### Description

Reports are stored in blobs as serialized arrays of DataTable\Row instances, but this
data can technically be anything. In other words, you can store whatever you want
as archive data blobs.

If multiple sites were requested in [build](#build) or [factory](#factory) the result will
be indexed by site ID.

If multiple periods were requested in [build](#build) or [factory](#factory) the result will
be indexed by period.

The site ID index is always first, so if multiple sites &amp; periods were requested, the result
will be indexed by site ID first, then period.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$names`
    - `$idSubtable`
- _Returns:_ An array of appropriately indexed blob data.
    - `array`

### `getDataTableFromNumeric()` <a name="getDataTableFromNumeric"></a>

Queries and returns metric data in a DataTable instance.

#### Description

If multiple sites were requested in [build](#build) or [factory](#factory) the result will
be a DataTable\Map that is indexed by site ID.

If multiple periods were requested in [build](#build) or [factory](#factory) the result will
be a DataTable\Map that is indexed by period.

The site ID index is always first, so if multiple sites &amp; periods were requested, the result
will be a DataTable\Map indexed by site ID which contains DataTable\Map instances that are
indexed by period.

Note: Every DataTable instance returned will have at most one row in it. The contents of each
      row will be the requested metrics for the appropriate site and period.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$names`
- _Returns:_ A DataTable if multiple sites and periods were not requested. An appropriately indexed DataTable\Map if otherwise.
    - [`DataTable`](../Piwik/DataTable.md)
    - [`Map`](../Piwik/DataTable/Map.md)

### `getDataTable()` <a name="getDataTable"></a>

Queries and returns a single report as a DataTable instance.

#### Description

This method will query blob data that is a serialized array of of DataTable\Row&#039;s and
unserialize it.

If multiple sites were requested in [build](#build) or [factory](#factory) the result will
be a DataTable\Map that is indexed by site ID.

If multiple periods were requested in [build](#build) or [factory](#factory) the result will
be a DataTable\Map that is indexed by period.

The site ID index is always first, so if multiple sites &amp; periods were requested, the result
will be a DataTable\Map indexed by site ID which contains DataTable\Map instances that are
indexed by period.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$name`
    - `$idSubtable`
- _Returns:_ A DataTable if multiple sites and periods were not requested. An appropriately indexed DataTable\Map if otherwise.
    - [`DataTable`](../Piwik/DataTable.md)
    - [`Map`](../Piwik/DataTable/Map.md)

### `getDataTableExpanded()` <a name="getDataTableExpanded"></a>

Queries and returns one report with all of its subtables loaded.

#### Description

If multiple sites were requested in [build](#build) or [factory](#factory) the result will
be a DataTable\Map that is indexed by site ID.

If multiple periods were requested in [build](#build) or [factory](#factory) the result will
be a DataTable\Map that is indexed by period.

The site ID index is always first, so if multiple sites &amp; periods were requested, the result
will be a DataTable\Map indexed by site ID which contains DataTable\Map instances that are
indexed by period.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$name`
    - `$idSubtable`
    - `$depth`
    - `$addMetadataSubtableId`
- It returns a(n) [`DataTable`](../Piwik/DataTable.md) value.

### `getRequestedPlugins()` <a name="getRequestedPlugins"></a>

Returns the list of plugins that archive the given reports.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$archiveNames`
- It returns a(n) `array` value.

### `getDataTableFromArchive()` <a name="getDataTableFromArchive"></a>

Helper function that creates an Archive instance and queries for report data using query parameter data.

#### Description

API methods can use this method to reduce code redundancy.

#### Signature

- It is a **public static** method.
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

### `getParams()` <a name="getParams"></a>

Returns an object describing the set of sites, the set of periods and the segment this Archive will query data for.

#### Signature

- It is a **public** method.
- It returns a(n) `Piwik\Archive\Parameters` value.

### `getPluginForReport()` <a name="getPluginForReport"></a>

Returns the name of the plugin that archives a given report.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$report`
- _Returns:_ Plugin name.
    - `string`
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If a plugin cannot be found or if the plugin for the report isn&#039;t activated.

