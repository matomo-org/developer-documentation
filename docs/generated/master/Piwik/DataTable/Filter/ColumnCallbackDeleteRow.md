<small>Piwik\DataTable\Filter</small>

ColumnCallbackDeleteRow
=======================

Delete all rows for which a callback returns true.

Description
-----------

// TODO: modify

**Basic usage example**

    $labelsToRemove = array('label1', 'label2', 'label2');
    $dataTable->filter('ColumnCallbackDeleteRow', array('label', function ($label) use ($labelsToRemove) {
        return in_array($label, $labelsToRemove);
    }));


Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`filter()`](#filter) &mdash; Filters the given data table

### `__construct()` <a name="__construct"></a>

Constructor.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md))
    - `$columnsToFilter`
    - `$function`
    - `$functionParams`
- It does not return anything.

### `filter()` <a name="filter"></a>

Filters the given data table

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$table`
- It does not return anything.

