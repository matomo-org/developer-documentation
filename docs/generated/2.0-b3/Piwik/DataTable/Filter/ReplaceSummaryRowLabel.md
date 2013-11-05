<small>Piwik\DataTable\Filter</small>

ReplaceSummaryRowLabel
======================

Replaces the label of the summary row with a supplied label.

Description
-----------

This filter is only used to prettify the summary row label and so it should
always be queued on a DataTable.

This filter always recurses. In other words, this filter will apply itself to
all subtables in the given DataTable's hierarchy.

**Basic example**

    $dataTable->queueFilter('ReplaceSummaryRowLabel', array(Piwik::translate('General_Others')));


Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`filter()`](#filter) &mdash; See [ReplaceSummaryRowLabel](#).

<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

- It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md))
    - `$newLabel`
- It does not return anything.

<a name="filter" id="filter"></a>
### `filter()`

See [ReplaceSummaryRowLabel](#).

#### Signature

- It accepts the following parameter(s):
    - `$table`
- It does not return anything.

