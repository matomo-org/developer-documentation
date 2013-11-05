<small>Piwik\DataTable\Filter</small>

AddSummaryRow
=============

Add a summary row row to the table that is the sum of all other table rows.

Description
-----------

**Basic usage example**

    $dataTable->filter('AddSummaryRow');

    // use a human readable label for the summary row (instead of '-1')
    $dataTable->filter('AddSummaryRow', array($labelSummaryRow = Piwik_Translate('General_Total')));


Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`filter()`](#filter) &mdash; Executes the filter.

<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md))
    - `$labelSummaryRow`
- It does not return anything.

<a name="filter" id="filter"></a>
### `filter()`

Executes the filter.

#### Description

See [AddSummaryRow](#).

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$table`
- It does not return anything.

