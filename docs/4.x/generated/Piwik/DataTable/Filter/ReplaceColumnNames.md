<small>Piwik\DataTable\Filter\</small>

ReplaceColumnNames
==================

Replaces column names in each row of a table using an array that maps old column names new ones.

If no mapping is provided, this column will use one that maps index metric names
(which are integers) with their string column names. In the database, reports are
stored with integer metric names because it results in blobs that take up less space.
When loading the reports, the column names must be replaced, which is handled by this
class. (See [Metrics](/api-reference/Piwik/Metrics) for more information about integer metric names.)

**Basic example**

    // filter use in a plugin's API method
    public function getMyReport($idSite, $period, $date, $segment = false, $expanded = false)
    {
        $dataTable = Archive::createDataTableFromArchive('MyPlugin_MyReport', $idSite, $period, $date, $segment, $expanded);
        $dataTable->queueFilter('ReplaceColumnNames');
        return $dataTable;
    }

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`filter()`](#filter) &mdash; See [ReplaceColumnNames](/api-reference/Piwik/DataTable/Filter/ReplaceColumnNames).
- [`enableRecursive()`](#enablerecursive) &mdash; Enables/Disables recursive filtering. Inherited from [`BaseFilter`](../../../Piwik/DataTable/BaseFilter.md)
- [`filterSubTable()`](#filtersubtable) &mdash; Filters a row's subtable, if one exists and is loaded in memory. Inherited from [`BaseFilter`](../../../Piwik/DataTable/BaseFilter.md)

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

-  It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md)) &mdash;
      
    - `$mappingToApply` (`array`|`null`) &mdash;
       The name mapping to apply. Must map old column names with new ones, eg, array('OLD_COLUMN_NAME' => 'NEW_COLUMN NAME', 'OLD_COLUMN_NAME2' => 'NEW_COLUMN NAME2') If null, [Metrics::$mappingFromIdToName](/api-reference/Piwik/Metrics#$mappingfromidtoname) is used.

<a name="filter" id="filter"></a>
<a name="filter" id="filter"></a>
### `filter()`

See [ReplaceColumnNames](/api-reference/Piwik/DataTable/Filter/ReplaceColumnNames).

#### Signature

-  It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md)) &mdash;
      
- It does not return anything or a mixed result.

<a name="enablerecursive" id="enablerecursive"></a>
<a name="enableRecursive" id="enableRecursive"></a>
### `enableRecursive()`

Enables/Disables recursive filtering. Whether this property is actually used
is up to the derived BaseFilter class.

#### Signature

-  It accepts the following parameter(s):
    - `$enable` (`bool`) &mdash;
      
- It does not return anything or a mixed result.

<a name="filtersubtable" id="filtersubtable"></a>
<a name="filterSubTable" id="filterSubTable"></a>
### `filterSubTable()`

Filters a row's subtable, if one exists and is loaded in memory.

#### Signature

-  It accepts the following parameter(s):
    - `$row` ([`Row`](../../../Piwik/DataTable/Row.md)) &mdash;
       The row whose subtable should be filter.
- It does not return anything or a mixed result.

