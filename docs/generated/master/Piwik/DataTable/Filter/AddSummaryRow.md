<small>Piwik\DataTable\Filter</small>

AddSummaryRow
=============

Add a summary row row to the table that is the sum of all other table rows.

Description
-----------

**Basic usage example**

    $dataTable-&gt;filter(&#039;AddSummaryRow&#039;);

    // use a human readable label for the summary row (instead of &#039;-1&#039;)
    $dataTable-&gt;filter(&#039;AddSummaryRow&#039;, array($labelSummaryRow = Piwik_Translate(&#039;General_Total&#039;)));


Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`filter()`](#filter) &mdash; Executes the filter.

### `__construct()` <a name="__construct"></a>

Constructor.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md))
    - `$labelSummaryRow`
- It does not return anything.

### `filter()` <a name="filter"></a>

Executes the filter.

#### Description

See [AddSummaryRow](#).

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$table`
- It does not return anything.

