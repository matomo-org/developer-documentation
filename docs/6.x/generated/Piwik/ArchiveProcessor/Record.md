<small>Piwik\ArchiveProcessor\</small>

Record
======

Since Matomo 5.0.0

Methods
-------

The class defines the following methods:

- [`make()`](#make)
- [`setPlugin()`](#setplugin)
- [`setName()`](#setname)
- [`setColumnToSortByBeforeTruncation()`](#setcolumntosortbybeforetruncation)
- [`setMaxRowsInTable()`](#setmaxrowsintable)
- [`setMaxRowsInSubtable()`](#setmaxrowsinsubtable)
- [`getPlugin()`](#getplugin)
- [`getName()`](#getname)
- [`getColumnToSortByBeforeTruncation()`](#getcolumntosortbybeforetruncation)
- [`getMaxRowsInTable()`](#getmaxrowsintable)
- [`getMaxRowsInSubtable()`](#getmaxrowsinsubtable)
- [`setType()`](#settype)
- [`getType()`](#gettype)
- [`setIsCountOfBlobRecordRows()`](#setiscountofblobrecordrows)
- [`setIsCountOfBlobRecordLeafRows()`](#setiscountofblobrecordleafrows)
- [`getCountOfRecordName()`](#getcountofrecordname)
- [`getCountOfRecordNameIsRecursive()`](#getcountofrecordnameisrecursive)
- [`getCountOfRecordNameIsForLeafs()`](#getcountofrecordnameisforleafs)
- [`setColumnToRenameAfterAggregation()`](#setcolumntorenameafteraggregation)
- [`getColumnToRenameAfterAggregation()`](#getcolumntorenameafteraggregation)
- [`setBlobColumnAggregationOps()`](#setblobcolumnaggregationops)
- [`getBlobColumnAggregationOps()`](#getblobcolumnaggregationops)
- [`setMultiplePeriodTransform()`](#setmultipleperiodtransform)
- [`getMultiplePeriodTransform()`](#getmultipleperiodtransform)
- [`setAggregatedRecordTransform()`](#setaggregatedrecordtransform) &mdash; Sets a transform applied to this blob record's aggregated table during non-day archiving, after the day blobs have been aggregated together (additive columns summed, columns marked 'skip' in the aggregation ops left untouched) and before the table is truncated and stored.
- [`getAggregatedRecordTransform()`](#getaggregatedrecordtransform)
- [`setBuiltFromFlatRecord()`](#setbuiltfromflatrecord) &mdash; Marks this blob record as being derived from a flat blob record during non-day aggregation.
- [`getBuiltFromFlatRecord()`](#getbuiltfromflatrecord)
- [`getFlatToHierarchyPathCallback()`](#getflattohierarchypathcallback)
- [`getLegacyHierarchyToFlatReducerCallback()`](#getlegacyhierarchytoflatreducercallback)

<a name="make" id="make"></a>
<a name="make" id="make"></a>
### `make()`

#### Signature

-  It accepts the following parameter(s):
    - `$type`
      
    - `$name`
      
- It returns a [`Record`](../../Piwik/ArchiveProcessor/Record.md) value.

<a name="setplugin" id="setplugin"></a>
<a name="setPlugin" id="setPlugin"></a>
### `setPlugin()`

#### Signature

-  It accepts the following parameter(s):
    - `$plugin` (`string`|`null`) &mdash;
      
- It returns a [`Record`](../../Piwik/ArchiveProcessor/Record.md) value.

<a name="setname" id="setname"></a>
<a name="setName" id="setName"></a>
### `setName()`

#### Signature

-  It accepts the following parameter(s):
    - `$name` (`string`) &mdash;
      
- It returns a [`Record`](../../Piwik/ArchiveProcessor/Record.md) value.

<a name="setcolumntosortbybeforetruncation" id="setcolumntosortbybeforetruncation"></a>
<a name="setColumnToSortByBeforeTruncation" id="setColumnToSortByBeforeTruncation"></a>
### `setColumnToSortByBeforeTruncation()`

#### Signature

-  It accepts the following parameter(s):
    - `$columnToSortByBeforeTruncation` (`int`|`string`) &mdash;
      
- It returns a [`Record`](../../Piwik/ArchiveProcessor/Record.md) value.

<a name="setmaxrowsintable" id="setmaxrowsintable"></a>
<a name="setMaxRowsInTable" id="setMaxRowsInTable"></a>
### `setMaxRowsInTable()`

#### Signature

-  It accepts the following parameter(s):
    - `$maxRowsInTable` (`int`|`null`) &mdash;
      
- It returns a [`Record`](../../Piwik/ArchiveProcessor/Record.md) value.

<a name="setmaxrowsinsubtable" id="setmaxrowsinsubtable"></a>
<a name="setMaxRowsInSubtable" id="setMaxRowsInSubtable"></a>
### `setMaxRowsInSubtable()`

#### Signature

-  It accepts the following parameter(s):
    - `$maxRowsInSubtable` (`int`|`null`) &mdash;
      
- It returns a [`Record`](../../Piwik/ArchiveProcessor/Record.md) value.

<a name="getplugin" id="getplugin"></a>
<a name="getPlugin" id="getPlugin"></a>
### `getPlugin()`

#### Signature


- *Returns:*  `string`|`null` &mdash;
    

<a name="getname" id="getname"></a>
<a name="getName" id="getName"></a>
### `getName()`

#### Signature

- It returns a `string` value.

<a name="getcolumntosortbybeforetruncation" id="getcolumntosortbybeforetruncation"></a>
<a name="getColumnToSortByBeforeTruncation" id="getColumnToSortByBeforeTruncation"></a>
### `getColumnToSortByBeforeTruncation()`

#### Signature


- *Returns:*  `int`|`string` &mdash;
    

<a name="getmaxrowsintable" id="getmaxrowsintable"></a>
<a name="getMaxRowsInTable" id="getMaxRowsInTable"></a>
### `getMaxRowsInTable()`

#### Signature


- *Returns:*  `int`|`null` &mdash;
    

<a name="getmaxrowsinsubtable" id="getmaxrowsinsubtable"></a>
<a name="getMaxRowsInSubtable" id="getMaxRowsInSubtable"></a>
### `getMaxRowsInSubtable()`

#### Signature


- *Returns:*  `int`|`null` &mdash;
    

<a name="settype" id="settype"></a>
<a name="setType" id="setType"></a>
### `setType()`

#### Signature

-  It accepts the following parameter(s):
    - `$type` (`string`) &mdash;
      
- It returns a [`Record`](../../Piwik/ArchiveProcessor/Record.md) value.

<a name="gettype" id="gettype"></a>
<a name="getType" id="getType"></a>
### `getType()`

#### Signature

- It returns a `string` value.

<a name="setiscountofblobrecordrows" id="setiscountofblobrecordrows"></a>
<a name="setIsCountOfBlobRecordRows" id="setIsCountOfBlobRecordRows"></a>
### `setIsCountOfBlobRecordRows()`

#### Signature

-  It accepts the following parameter(s):
    - `$dependentRecordName` (`string`) &mdash;
      
    - `$isRecursive` (`bool`) &mdash;
      
- It returns a [`Record`](../../Piwik/ArchiveProcessor/Record.md) value.

<a name="setiscountofblobrecordleafrows" id="setiscountofblobrecordleafrows"></a>
<a name="setIsCountOfBlobRecordLeafRows" id="setIsCountOfBlobRecordLeafRows"></a>
### `setIsCountOfBlobRecordLeafRows()`

#### Signature

-  It accepts the following parameter(s):
    - `$dependentRecordName` (`string`) &mdash;
      
- It returns a [`Record`](../../Piwik/ArchiveProcessor/Record.md) value.

<a name="getcountofrecordname" id="getcountofrecordname"></a>
<a name="getCountOfRecordName" id="getCountOfRecordName"></a>
### `getCountOfRecordName()`

#### Signature


- *Returns:*  `string`|`null` &mdash;
    

<a name="getcountofrecordnameisrecursive" id="getcountofrecordnameisrecursive"></a>
<a name="getCountOfRecordNameIsRecursive" id="getCountOfRecordNameIsRecursive"></a>
### `getCountOfRecordNameIsRecursive()`

#### Signature

- It returns a `bool` value.

<a name="getcountofrecordnameisforleafs" id="getcountofrecordnameisforleafs"></a>
<a name="getCountOfRecordNameIsForLeafs" id="getCountOfRecordNameIsForLeafs"></a>
### `getCountOfRecordNameIsForLeafs()`

#### Signature

- It returns a `bool` value.

<a name="setcolumntorenameafteraggregation" id="setcolumntorenameafteraggregation"></a>
<a name="setColumnToRenameAfterAggregation" id="setColumnToRenameAfterAggregation"></a>
### `setColumnToRenameAfterAggregation()`

#### Signature

-  It accepts the following parameter(s):
    - `$columnToRenameAfterAggregation` (`array`|`null`) &mdash;
      
- It returns a [`Record`](../../Piwik/ArchiveProcessor/Record.md) value.

<a name="getcolumntorenameafteraggregation" id="getcolumntorenameafteraggregation"></a>
<a name="getColumnToRenameAfterAggregation" id="getColumnToRenameAfterAggregation"></a>
### `getColumnToRenameAfterAggregation()`

#### Signature


- *Returns:*  `array`|`null` &mdash;
    

<a name="setblobcolumnaggregationops" id="setblobcolumnaggregationops"></a>
<a name="setBlobColumnAggregationOps" id="setBlobColumnAggregationOps"></a>
### `setBlobColumnAggregationOps()`

#### Signature

-  It accepts the following parameter(s):
    - `$blobColumnAggregationOps` (`array`|`null`) &mdash;
      
- It returns a [`Record`](../../Piwik/ArchiveProcessor/Record.md) value.

<a name="getblobcolumnaggregationops" id="getblobcolumnaggregationops"></a>
<a name="getBlobColumnAggregationOps" id="getBlobColumnAggregationOps"></a>
### `getBlobColumnAggregationOps()`

#### Signature


- *Returns:*  `array`|`null` &mdash;
    

<a name="setmultipleperiodtransform" id="setmultipleperiodtransform"></a>
<a name="setMultiplePeriodTransform" id="setMultiplePeriodTransform"></a>
### `setMultiplePeriodTransform()`

#### Signature

-  It accepts the following parameter(s):
    - `$multiplePeriodTransform` (`callable`|`null`) &mdash;
      
- It returns a [`Record`](../../Piwik/ArchiveProcessor/Record.md) value.

<a name="getmultipleperiodtransform" id="getmultipleperiodtransform"></a>
<a name="getMultiplePeriodTransform" id="getMultiplePeriodTransform"></a>
### `getMultiplePeriodTransform()`

#### Signature


- *Returns:*  `callable`|`null` &mdash;
    

<a name="setaggregatedrecordtransform" id="setaggregatedrecordtransform"></a>
<a name="setAggregatedRecordTransform" id="setAggregatedRecordTransform"></a>
### `setAggregatedRecordTransform()`

Sets a transform applied to this blob record's aggregated table during non-day archiving,
after the day blobs have been aggregated together (additive columns summed, columns marked
'skip' in the aggregation ops left untouched) and before the table is truncated and stored.

Use this for columns that cannot be summed across child periods and must be recomputed from
the aggregated additive columns — for example a table-relative ratio, index or score. Mark
such a column 'skip' via {@see setBlobColumnAggregationOps()} so it is not summed, then
recompute it here. Because the transform runs before truncation, a column it (re)computes can
be used as {@see setColumnToSortByBeforeTruncation()}.

Only used for non-day periods; the day archive builds the record from logs via the
RecordBuilder's aggregate() and should apply any equivalent computation there.

Applies on both the standard blob path and the built-from-flat path ({@see setBuiltFromFlatRecord()}):
each record's transform runs on that record's own aggregated table, so a flat base record and the
hierarchy rebuilt from it are each transformed (the hierarchy after it is built) before being stored.

#### Signature

-  It accepts the following parameter(s):
    - `$transform` (`callable`|`null`) &mdash;
       Signature: function (\Piwik\DataTable $table, ArchiveProcessor $archiveProcessor, Record $record): void The callback mutates $table in place.
- It returns a [`Record`](../../Piwik/ArchiveProcessor/Record.md) value.

<a name="getaggregatedrecordtransform" id="getaggregatedrecordtransform"></a>
<a name="getAggregatedRecordTransform" id="getAggregatedRecordTransform"></a>
### `getAggregatedRecordTransform()`

#### Signature


- *Returns:*  `callable`|`null` &mdash;
    

<a name="setbuiltfromflatrecord" id="setbuiltfromflatrecord"></a>
<a name="setBuiltFromFlatRecord" id="setBuiltFromFlatRecord"></a>
### `setBuiltFromFlatRecord()`

Marks this blob record as being derived from a flat blob record during non-day aggregation.

Use this when day archives store a flat representation and non-day archives should rebuild
hierarchy from it. The flat record must be present in getRecordMetadata().

#### Signature

-  It accepts the following parameter(s):
    - `$flatRecordName` (`string`) &mdash;
       Name of the flat blob record to aggregate first.
    - `$flatToHierarchyPathCallback` (`callable`) &mdash;
       Callback used when rebuilding hierarchy. Signature: function (Row $flatRow, ArchiveProcessor $archiveProcessor, Record $hierarchicalRecord): ?array Return value is the path of labels to map the flat row into the hierarchy.
    - `$legacyHierarchyToFlatReducerCallback` (`callable`|`null`) &mdash;
       Optional callback that can merge legacy hierarchical aggregates into the flat table when some periods do not have the flat record yet. Signature: function (DataTable $legacyHierarchy, DataTable $flatTable, ArchiveProcessor $archiveProcessor, Record $hierarchicalRecord): void The callback is invoked once per legacy source period hierarchy table.
- It returns a [`Record`](../../Piwik/ArchiveProcessor/Record.md) value.

<a name="getbuiltfromflatrecord" id="getbuiltfromflatrecord"></a>
<a name="getBuiltFromFlatRecord" id="getBuiltFromFlatRecord"></a>
### `getBuiltFromFlatRecord()`

#### Signature


- *Returns:*  `string`|`null` &mdash;
    

<a name="getflattohierarchypathcallback" id="getflattohierarchypathcallback"></a>
<a name="getFlatToHierarchyPathCallback" id="getFlatToHierarchyPathCallback"></a>
### `getFlatToHierarchyPathCallback()`

#### See Also

- `setBuiltFromFlatRecord()`

#### Signature


- *Returns:*  `callable`|`null` &mdash;
    

<a name="getlegacyhierarchytoflatreducercallback" id="getlegacyhierarchytoflatreducercallback"></a>
<a name="getLegacyHierarchyToFlatReducerCallback" id="getLegacyHierarchyToFlatReducerCallback"></a>
### `getLegacyHierarchyToFlatReducerCallback()`

#### See Also

- `setBuiltFromFlatRecord()`

#### Signature


- *Returns:*  `callable`|`null` &mdash;
    

