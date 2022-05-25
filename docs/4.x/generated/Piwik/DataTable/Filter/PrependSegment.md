<small>Piwik\DataTable\Filter\</small>

PrependSegment
==============

Executes a callback for each row of a DataTable and prepends each existing segment with the given segment.

**Basic usage example**

    $dataTable->filter('PrependSegment', array('segmentName==segmentValue;'));

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct)
- [`filter()`](#filter) &mdash; See PrependValueToMetadata. Inherited from [`PrependValueToMetadata`](../../../Piwik/DataTable/Filter/PrependValueToMetadata.md)
- [`enableRecursive()`](#enablerecursive) &mdash; Enables/Disables recursive filtering. Inherited from [`BaseFilter`](../../../Piwik/DataTable/BaseFilter.md)
- [`filterSubTable()`](#filtersubtable) &mdash; Filters a row's subtable, if one exists and is loaded in memory. Inherited from [`BaseFilter`](../../../Piwik/DataTable/BaseFilter.md)

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

#### Signature

-  It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md)) &mdash;
      
    - `$prependSegment` (`string`) &mdash;
       The segment to prepend if a segment is already defined. Make sure to include A condition, eg the segment should end with ';' or ','

<a name="filter" id="filter"></a>
<a name="filter" id="filter"></a>
### `filter()`

See PrependValueToMetadata.

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

