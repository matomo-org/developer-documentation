<small>Piwik\DataTable\Filter\</small>

AddSegmentBySegmentValue
========================

Converts for each row of a DataTable a segmentValue to a segment (expression).

The name of the segment
is automatically detected based on the given report.

**Basic usage example**

    $dataTable->filter('AddSegmentBySegmentValue', array($reportInstance));

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct)
- [`filter()`](#filter) &mdash; See [AddSegmentBySegmentValue](/api-reference/Piwik/DataTable/Filter/AddSegmentBySegmentValue).
- [`enableRecursive()`](#enablerecursive) &mdash; Enables/Disables recursive filtering. Inherited from [`BaseFilter`](../../../Piwik/DataTable/BaseFilter.md)
- [`filterSubTable()`](#filtersubtable) &mdash; Filters a row's subtable, if one exists and is loaded in memory. Inherited from [`BaseFilter`](../../../Piwik/DataTable/BaseFilter.md)

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

#### Signature

-  It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md)) &mdash;
      
    - `$report` (`Piwik\DataTable\Filter\$report`) &mdash;
      

<a name="filter" id="filter"></a>
<a name="filter" id="filter"></a>
### `filter()`

See [AddSegmentBySegmentValue](/api-reference/Piwik/DataTable/Filter/AddSegmentBySegmentValue).

#### Signature

-  It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md)) &mdash;
      

- *Returns:*  `int` &mdash;
    The number of deleted rows.

<a name="enablerecursive" id="enablerecursive"></a>
<a name="enableRecursive" id="enableRecursive"></a>
### `enableRecursive()`

Enables/Disables recursive filtering.

Whether this property is actually used
is up to the derived BaseFilter class.

#### Signature

-  It accepts the following parameter(s):
    - `$enable` (`bool`) &mdash;
      
- It does not return anything.

<a name="filtersubtable" id="filtersubtable"></a>
<a name="filterSubTable" id="filterSubTable"></a>
### `filterSubTable()`

Filters a row's subtable, if one exists and is loaded in memory.

#### Signature

-  It accepts the following parameter(s):
    - `$row` ([`Row`](../../../Piwik/DataTable/Row.md)) &mdash;
       The row whose subtable should be filter.
- It does not return anything.

