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
- [`getCountOfRecordName()`](#getcountofrecordname)
- [`getCountOfRecordNameIsRecursive()`](#getcountofrecordnameisrecursive)
- [`setColumnToRenameAfterAggregation()`](#setcolumntorenameafteraggregation)
- [`getColumnToRenameAfterAggregation()`](#getcolumntorenameafteraggregation)
- [`setBlobColumnAggregationOps()`](#setblobcolumnaggregationops)
- [`getBlobColumnAggregationOps()`](#getblobcolumnaggregationops)

<a name="make" id="make"></a>
<a name="make" id="make"></a>
### `make()`

#### Signature

-  It accepts the following parameter(s):
    - `$type`
      
    - `$name`
      
- It does not return anything or a mixed result.

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
    

