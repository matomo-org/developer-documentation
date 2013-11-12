<small>Piwik\DataTable\Filter</small>

ColumnCallbackAddMetadata
=========================

Executes a callback for each row of a DataTable and adds the result as a new metadata column.

Description
-----------

**Basic usage example**

    $dataTable->filter('ColumnCallbackAddMetadata', array('label', 'logo', 'Piwik\Plugins\MyPlugin\getLogoFromLabel'));

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`filter()`](#filter) &mdash; See [ColumnCallbackAddMetadata](#).

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

- It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md)) &mdash; The DataTable instance that will be filtered.
    - `$columnsToRead` (`string`|`array`) &mdash; The columns to read from each row and pass on to the callback.
    - `$metadataToAdd` (`string`) &mdash; The name of the metadata field that will be added to each row.
    - `$functionToApply` (`callable`) &mdash; The callback to apply for each row.
    - `$functionParameters` (`array`) &mdash; deprecated - use an [anonymous function](http://php.net/manual/en/functions.anonymous.php) instead.
    - `$applyToSummaryRow` (`bool`) &mdash; Whether the callback should be applied to the summary row or not.

<a name="filter" id="filter"></a>
<a name="filter" id="filter"></a>
### `filter()`

See [ColumnCallbackAddMetadata](#).

#### Signature

- It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md))
- It does not return anything.

