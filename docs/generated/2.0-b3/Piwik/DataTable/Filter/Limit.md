<small>Piwik\DataTable\Filter</small>

Limit
=====

Delete all rows from the table that are not in the given offset -&gt; offset+limit range.

Description
-----------

**Basic example usage**

    // delete all rows from 5 -> 15
    $dataTable->filter('Limit', array(5, 10));


Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`filter()`](#filter) &mdash; See [Limit](#).

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

- It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md))
    - `$offset`
    - `$limit`
    - `$keepSummaryRow`
- It does not return anything.

<a name="filter" id="filter"></a>
<a name="filter" id="filter"></a>
### `filter()`

See [Limit](#).

#### Signature

- It accepts the following parameter(s):
    - `$table`
- It does not return anything.

