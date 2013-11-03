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
- [`setOrder()`](#setOrder) &mdash; Updates the order
- [`sort()`](#sort) &mdash; Sorting method used for sorting numbers
- [`naturalSort()`](#naturalSort) &mdash; Sorting method used for sorting values natural
- [`sortString()`](#sortString) &mdash; Sorting method used for sorting values
- [`filter()`](#filter) &mdash; Sorts the given data table by defined column and sorting method

### `__construct()` <a name="__construct"></a>

Constructor.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md))
    - `$columnToSort`
    - `$order`
    - `$naturalSort`
    - `$recursiveSort`
- It does not return anything.

### `setOrder()` <a name="setOrder"></a>

Updates the order

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$order`
- It does not return anything.

### `sort()` <a name="sort"></a>

Sorting method used for sorting numbers

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$a`
    - `$b`
- It returns a(n) `int` value.

### `naturalSort()` <a name="naturalSort"></a>

Sorting method used for sorting values natural

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$a`
    - `$b`
- It returns a(n) `int` value.

### `sortString()` <a name="sortString"></a>

Sorting method used for sorting values

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$a`
    - `$b`
- It returns a(n) `int` value.

### `filter()` <a name="filter"></a>

Sorts the given data table by defined column and sorting method

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$table`
- It returns a(n) `mixed` value.

