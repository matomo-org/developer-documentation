<small>Piwik\DataTable</small>

Filter
======

A filter is set of logic that manipulates a DataTable.

Description
-----------

Existing filters do things like,

- remove rows
- change column values (change string to lowercase, truncate, etc.)
- add/remove columns or metadata (compute percentage values, add an 'icon' metadata based on the label, etc.)
- add/remove/edit subtable associated with rows
- etc.

Filters are called with a DataTable instance and extra parameters that are specified
in [DataTable::filter()](#) and [DataTable::queueFilter()](#).

To see examples of Filters look at the existing ones in the Piwik\DataTable\Filter
namespace.


Properties
----------

This abstract class defines the following properties:

- [`$enableRecursive`](#$enablerecursive)

<a name="enablerecursive" id="enablerecursive"></a>
### `$enableRecursive`

#### Signature

- It is a(n) `bool` value.

Methods
-------

The abstract class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`filter()`](#filter) &mdash; Filters the supplied DataTable.
- [`enableRecursive()`](#enablerecursive) &mdash; Enables/Disables recursive filtering.
- [`filterSubTable()`](#filtersubtable) &mdash; Filters a row's subtable, if one exists and is loaded in memory.

<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

- It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../Piwik/DataTable.md))
- It does not return anything.

<a name="filter" id="filter"></a>
### `filter()`

Filters the supplied DataTable.

#### Signature

- It accepts the following parameter(s):
    - `$table`
- It does not return anything.

<a name="enablerecursive" id="enablerecursive"></a>
### `enableRecursive()`

Enables/Disables recursive filtering.

#### Description

Whether this property is actually used
is up to the derived Filter class.

#### Signature

- It accepts the following parameter(s):
    - `$enable`
- It does not return anything.

<a name="filtersubtable" id="filtersubtable"></a>
### `filterSubTable()`

Filters a row's subtable, if one exists and is loaded in memory.

#### Signature

- It accepts the following parameter(s):
    - `$row` ([`Row`](../../Piwik/DataTable/Row.md))
- It does not return anything.

