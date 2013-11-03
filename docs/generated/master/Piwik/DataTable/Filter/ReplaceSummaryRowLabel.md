<small>Piwik\DataTable\Filter</small>

ReplaceSummaryRowLabel
======================

Replaces the label of the summary row with a supplied label.

Description
-----------

This filter is only used to prettify the summary row label and so it should
always be queued on a DataTable.

This filter always recurses. In other words, this filter will apply itself to
all subtables in the given DataTable&#039;s hierarchy.

**Basic example**

    $dataTable-&gt;queueFilter(&#039;ReplaceSummaryRowLabel&#039;, array(Piwik::translate(&#039;General_Others&#039;)));


Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`filter()`](#filter) &mdash; See [ReplaceSummaryRowLabel](#).

### `__construct()` <a name="__construct"></a>

Constructor.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md))
    - `$newLabel`
- It does not return anything.

### `filter()` <a name="filter"></a>

See [ReplaceSummaryRowLabel](#).

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$table`
- It does not return anything.

