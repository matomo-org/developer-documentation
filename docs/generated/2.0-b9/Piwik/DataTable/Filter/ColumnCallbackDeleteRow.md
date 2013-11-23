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

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

- It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md)) &mdash; The DataTable that will be filtered eventually.
    - `$columnsToFilter` (`array`|`string`) &mdash; The column or array of columns that should be passed to the callback.
    - `$function` (`Piwik\DataTable\Filter\callback`) &mdash; The callback that determines whether a row should be deleted or not. Should return `true` if the row should be deleted.
    - `$functionParams` (`array`) &mdash; deprecated - use an [anonymous function](http://php.net/manual/en/functions.anonymous.php) instead.

<a name="filter" id="filter"></a>
<a name="filter" id="filter"></a>
### `filter()`

Filters the given data table

#### Signature

- It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md))
- It does not return anything.

