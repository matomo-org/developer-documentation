<small>Piwik\DataTable\</small>

BaseFilter
==========

A filter is set of logic that manipulates a DataTable.

- add/remove rows
- change column values (change string to lowercase, truncate, etc.)
- add/remove columns or metadata (compute percentage values, add an 'icon' metadata based on the label, etc.)
- add/remove/edit subtable associated with rows
- etc.

Filters are called with a DataTable instance and extra parameters that are specified
in [DataTable::filter()](/api-reference/Piwik/DataTable#filter) and [DataTable::queueFilter()](/api-reference/Piwik/DataTable#queuefilter).

To see examples of Filters look at the existing ones in the Piwik\DataTable\BaseFilter
namespace.

Methods
-------

The abstract class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`filter()`](#filter) &mdash; Manipulates a DataTable in some way.
- [`enableRecursive()`](#enablerecursive) &mdash; Enables/Disables recursive filtering.
- [`filterSubTable()`](#filtersubtable) &mdash; Filters a row's subtable, if one exists and is loaded in memory.

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

-  It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../Piwik/DataTable.md)) &mdash;
      

<a name="filter" id="filter"></a>
<a name="filter" id="filter"></a>
### `filter()`

Manipulates a DataTable in some way.

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
    - `$row` ([`Row`](../../Piwik/DataTable/Row.md)) &mdash;
       The row whose subtable should be filter.
- It does not return anything or a mixed result.

