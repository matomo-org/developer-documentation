<small>Piwik\DataTable\Filter\</small>

AddSegmentByLabelMapping
========================

Executes a filter for each row of a DataTable and generates a segment filter for each row.

It will map the label column to a segmentValue by searching for the label in the index of the given
mapping array.

**Basic usage example**

    $dataTable->filter('AddSegmentByLabelMapping', array('segmentName', array('1' => 'smartphone, '2' => 'desktop')));

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct)
- [`filter()`](#filter) &mdash; See [AddSegmentByLabelMapping](/api-reference/Piwik/DataTable/Filter/AddSegmentByLabelMapping).
- [`enableRecursive()`](#enablerecursive) &mdash; Enables/Disables recursive filtering. Inherited from [`BaseFilter`](../../../Piwik/DataTable/BaseFilter.md)
- [`filterSubTable()`](#filtersubtable) &mdash; Filters a row's subtable, if one exists and is loaded in memory. Inherited from [`BaseFilter`](../../../Piwik/DataTable/BaseFilter.md)

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

#### Signature

-  It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md)) &mdash;
      
    - `$segment` (`string`) &mdash;
      
    - `$mapping` (`array`) &mdash;
      

<a name="filter" id="filter"></a>
<a name="filter" id="filter"></a>
### `filter()`

See [AddSegmentByLabelMapping](/api-reference/Piwik/DataTable/Filter/AddSegmentByLabelMapping).

#### Signature

-  It accepts the following parameter(s):
    - `$table` (`Piwik\DataTable\DataTable`) &mdash;
      
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

