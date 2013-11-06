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
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md))
    - `$columnToSort`
    - `$order`
    - `$naturalSort`
    - `$recursiveSort`
- It does not return anything.

<a name="setorder" id="setorder"></a>
<a name="setOrder" id="setOrder"></a>
### `setOrder()`

Updates the order

#### Signature

- It accepts the following parameter(s):
    - `$order`
- It does not return anything.

<a name="sort" id="sort"></a>
<a name="sort" id="sort"></a>
### `sort()`

Sorting method used for sorting numbers

#### Signature

- It accepts the following parameter(s):
    - `$a`
    - `$b`
- It returns a `int` value.

<a name="naturalsort" id="naturalsort"></a>
<a name="naturalSort" id="naturalSort"></a>
### `naturalSort()`

Sorting method used for sorting values natural

#### Signature

- It accepts the following parameter(s):
    - `$a`
    - `$b`
- It returns a `int` value.

<a name="sortstring" id="sortstring"></a>
<a name="sortString" id="sortString"></a>
### `sortString()`

Sorting method used for sorting values

#### Signature

- It accepts the following parameter(s):
    - `$a`
    - `$b`
- It returns a `int` value.

<a name="filter" id="filter"></a>
<a name="filter" id="filter"></a>
### `filter()`

Sorts the given data table by defined column and sorting method

#### Signature

- It accepts the following parameter(s):
    - `$table`
- It returns a `mixed` value.

