<small>Piwik\DataTable\Filter\</small>

AddSegmentByLabel
=================

Executes a filter for each row of a DataTable and generates a segment filter for each row.

**Basic usage example**

    $dataTable->filter('AddSegmentByLabel', array('segmentName'));
    $dataTable->filter('AddSegmentByLabel', array(array('segmentName1', 'segment2'), ';');

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Generates a segment filter based on the label column and the given segment names
- [`filter()`](#filter) &mdash; See AddSegmentByLabel.
- [`enableRecursive()`](#enablerecursive) &mdash; Enables/Disables recursive filtering. Inherited from [`BaseFilter`](../../../Piwik/DataTable/BaseFilter.md)
- [`filterSubTable()`](#filtersubtable) &mdash; Filters a row's subtable, if one exists and is loaded in memory. Inherited from [`BaseFilter`](../../../Piwik/DataTable/BaseFilter.md)

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Generates a segment filter based on the label column and the given segment names

#### Signature

-  It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md)) &mdash;
      
    - `$segmentOrSegments` (`string`|`array`) &mdash;
       Either one segment or an array of segments. If more than one segment is given a delimter has to be defined.
    - `$delimiter` (`string`) &mdash;
       The delimiter by which the label should be splitted.

<a name="filter" id="filter"></a>
<a name="filter" id="filter"></a>
### `filter()`

See AddSegmentByLabel.

#### Signature

-  It accepts the following parameter(s):
    - `$table` (`Stmt_Namespace\DataTable`) &mdash;
      
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

