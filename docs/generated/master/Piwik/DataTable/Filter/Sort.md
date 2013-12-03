<small>Piwik\DataTable\Filter</small>

Sort
====

Sorts a DataTable based on the value of a specific column.

Description
-----------

Possible to specify a natural sorting (see php.net/natsort for details)

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`setOrder()`](#setorder) &mdash; Updates the order
- [`sort()`](#sort) &mdash; Sorting method used for sorting numbers
- [`naturalSort()`](#naturalsort) &mdash; Sorting method used for sorting values natural
- [`sortString()`](#sortstring) &mdash; Sorting method used for sorting values
- [`filter()`](#filter) &mdash; Sorts the given data table by defined column and sorting method

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

- It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md)) &mdash; The table to eventually filter.
    - `$columnToSort` (`string`) &mdash; The name of the column to sort by.
    - `$order` (`string`) &mdash; order `'asc'` or `'desc'`.
    - `$naturalSort` (`bool`) &mdash; Whether to use a natural sort or not (see [http://php.net/natsort](http://php.net/natsort)).
    - `$recursiveSort` (`bool`) &mdash; Whether to sort all subtables or not.

<a name="setorder" id="setorder"></a>
<a name="setOrder" id="setOrder"></a>
### `setOrder()`

Updates the order

#### Signature

- It accepts the following parameter(s):
    - `$order` (`string`) &mdash; asc|desc
- It does not return anything.

<a name="sort" id="sort"></a>
<a name="sort" id="sort"></a>
### `sort()`

Sorting method used for sorting numbers

#### Signature

- It accepts the following parameter(s):
    - `$a` (`Piwik\DataTable\Filter\number`)
    - `$b` (`Piwik\DataTable\Filter\number`)
- It returns a `int` value.

<a name="naturalsort" id="naturalsort"></a>
<a name="naturalSort" id="naturalSort"></a>
### `naturalSort()`

Sorting method used for sorting values natural

#### Signature

- It accepts the following parameter(s):
    - `$a` (`mixed`)
    - `$b` (`mixed`)
- It returns a `int` value.

<a name="sortstring" id="sortstring"></a>
<a name="sortString" id="sortString"></a>
### `sortString()`

Sorting method used for sorting values

#### Signature

- It accepts the following parameter(s):
    - `$a` (`mixed`)
    - `$b` (`mixed`)
- It returns a `int` value.

<a name="filter" id="filter"></a>
<a name="filter" id="filter"></a>
### `filter()`

Sorts the given data table by defined column and sorting method

#### Signature

- It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md))
- It returns a `mixed` value.

