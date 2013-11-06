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
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md))
    - `$columnsToRead`
    - `$metadataToAdd`
    - `$functionToApply`
    - `$functionParameters`
    - `$applyToSummaryRow`
- It does not return anything.

<a name="filter" id="filter"></a>
<a name="filter" id="filter"></a>
### `filter()`

See [ColumnCallbackAddMetadata](#).

#### Signature

- It accepts the following parameter(s):
    - `$table`
- It does not return anything.

