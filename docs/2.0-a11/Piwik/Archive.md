<small>Piwik</small>

Archive
=======

The archive object is used to query specific data for a day or a period of statistics for a given website.

Description
-----------

Limitations:
- If you query w/ a range period, you can only query for ONE at a time.
- If you query w/ a non-range period, you can query for multiple periods, but they must
  all be of the same type (ie, day, week, month, year).

Example:
&lt;pre&gt;
       $archive = Archive::build($idSite = 1, $period = &#039;week&#039;, &#039;2008-03-08&#039;);
       $dataTable = $archive-&gt;getDataTable(&#039;Provider_hostnameExt&#039;);
       $dataTable-&gt;queueFilter(&#039;ReplaceColumnNames&#039;);
       return $dataTable;
&lt;/pre&gt;

Example bis:
&lt;pre&gt;
       $archive = Archive::build($idSite = 3, $period = &#039;day&#039;, $date = &#039;today&#039;);
       $nbVisits = $archive-&gt;getNumeric(&#039;nb_visits&#039;);
       return $nbVisits;
&lt;/pre&gt;

If the requested statistics are not yet processed, Archive uses ArchiveProcessor to archive the statistics.

TODO: create ticket for this: when building archives, should use each site&#039;s timezone (ONLY FOR &#039;now&#039;).


Constants
---------

This class defines the following constants:

- [`REQUEST_ALL_WEBSITES_FLAG`](#REQUEST_ALL_WEBSITES_FLAG)
- [`ARCHIVE_ALL_PLUGINS_FLAG`](#ARCHIVE_ALL_PLUGINS_FLAG)
- [`ID_SUBTABLE_LOAD_ALL_SUBTABLES`](#ID_SUBTABLE_LOAD_ALL_SUBTABLES)

Methods
-------

The class defines the following methods:

- [`build()`](#build) &mdash; Builds an Archive object using query parameter values.
- [`factory()`](#factory)
- [`getNumeric()`](#getNumeric) &mdash; Returns the value of the element $name from the current archive The value to be returned is a numeric value and is stored in the archive_numeric_* tables
- [`getBlob()`](#getBlob) &mdash; Returns the value of the elements in $names from the current archive.
- [`getDataTableFromNumeric()`](#getDataTableFromNumeric) &mdash; Returns the numeric values of the elements in $names as a DataTable.
- [`getDataTable()`](#getDataTable) &mdash; This method will build a dataTable from the blob value $name in the current archive.
- [`getDataTableExpanded()`](#getDataTableExpanded) &mdash; Same as getDataTable() except that it will also load in memory all the subtables for the DataTable $name.
- [`getRequestedPlugins()`](#getRequestedPlugins) &mdash; Returns the list of plugins that archive the given reports.
- [`getDataTableFromArchive()`](#getDataTableFromArchive) &mdash; Helper - Loads a DataTable from the Archive.
- [`getParams()`](#getParams)
- [`getPluginForReport()`](#getPluginForReport) &mdash; Returns the name of the plugin that archives a given report.

### `build()` <a name="build"></a>

Builds an Archive object using query parameter values.

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

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$segment` (`Piwik\Segment`)
    - `$periods` (`array`)
    - `$idSites`
    - `$idSiteIsAll`
    - `$isMultipleDate`
- It does not return anything.

### `getNumeric()` <a name="getNumeric"></a>

Returns the value of the element $name from the current archive The value to be returned is a numeric value and is stored in the archive_numeric_* tables

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$names`
- _Returns:_ False if no value with the given name, numeric if only one site and date and we&#039;re not forcing an index, and array if multiple sites/dates are queried.
    - `mixed`

### `getBlob()` <a name="getBlob"></a>

Returns the value of the elements in $names from the current archive.

#### Description

The value to be returned is a blob value and is stored in the archive_blob_* tables.

It can return anything from strings, to serialized PHP arrays or PHP objects, etc.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$names`
    - `$idSubtable`
- _Returns:_ False if no value with the given name, numeric if only one site and date and we&#039;re not forcing an index, and array if multiple sites/dates are queried.
    - `string`
    - `array`
    - `bool`

### `getDataTableFromNumeric()` <a name="getDataTableFromNumeric"></a>

Returns the numeric values of the elements in $names as a DataTable.

#### Description

Note: Every DataTable instance returned will have at most one row in it.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$names`
- _Returns:_ False if no value with the given names. Based on the number of sites/periods, the result can be a DataTable\Map, which contains DataTable instances.
    - [`DataTable`](../Piwik/DataTable.md)
    - `Piwik\DataTable\Map`
    - `bool`

### `getDataTable()` <a name="getDataTable"></a>

This method will build a dataTable from the blob value $name in the current archive.

#### Description

For example $name = &#039;Referers_searchEngineByKeyword&#039; will return a
DataTable containing all the keywords. If a $idSubtable is given, the method
will return the subTable of $name. If &#039;all&#039; is supplied for $idSubtable every subtable
will be returned.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$name`
    - `$idSubtable`
- It can return one of the following values:
    - [`DataTable`](../Piwik/DataTable.md)
    - `Piwik\DataTable\Map`
    - `bool`

### `getDataTableExpanded()` <a name="getDataTableExpanded"></a>

Same as getDataTable() except that it will also load in memory all the subtables for the DataTable $name.

#### Description

You can then access the subtables by using the
Manager::getTable() function.

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

Helper - Loads a DataTable from the Archive.

#### Description

Optionally loads the table recursively,
or optionally fetches a given subtable with $idSubtable

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
- It can return one of the following values:
    - [`DataTable`](../Piwik/DataTable.md)
    - `Piwik\DataTable\Map`

### `getParams()` <a name="getParams"></a>

#### Signature

- It is a **public** method.
- It returns a(n) `Piwik\Archive\Parameters` value.

### `getPluginForReport()` <a name="getPluginForReport"></a>

Returns the name of the plugin that archives a given report.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$report`
- It returns a(n) `string` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

