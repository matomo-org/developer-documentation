<small>Piwik\DataTable\Filter</small>

Limit
=====

Delete all rows from the table that are not in the given offset -> offset+limit range.

Description
-----------

**Basic example usage**

    // delete all rows from 5 -> 15
    $dataTable->filter('Limit', array(5, 10));

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`filter()`](#filter) &mdash; See [Limit](/api-reference/Piwik/DataTable/Filter/Limit).

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

- It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md)) &mdash; The DataTable that will be filtered eventually.
    - `$offset` (`int`) &mdash; The starting row index to keep.
    - `$limit` (`int`) &mdash; Number of rows to keep (specify -1 to keep all rows).
    - `$keepSummaryRow` (`bool`) &mdash; Whether to keep the summary row or not.

<a name="filter" id="filter"></a>
<a name="filter" id="filter"></a>
### `filter()`

See [Limit](/api-reference/Piwik/DataTable/Filter/Limit).

#### Signature

- It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md))
- It does not return anything.

