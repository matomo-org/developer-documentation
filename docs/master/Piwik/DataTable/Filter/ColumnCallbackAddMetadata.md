<small>Piwik\DataTable\Filter</small>

ColumnCallbackAddMetadata
=========================

Executes a callback for each row of a DataTable and adds the result as a new metadata column.

Description
-----------

**Basic usage example**

    $dataTable-&gt;filter(&#039;ColumnCallbackAddMetadata&#039;, array(&#039;label&#039;, &#039;logo&#039;, &#039;Piwik\Plugins\MyPlugin\getLogoFromLabel&#039;));


Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`filter()`](#filter) &mdash; See [ColumnCallbackAddMetadata](#).

### `__construct()` <a name="__construct"></a>

Constructor.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md))
    - `$columnsToRead`
    - `$metadataToAdd`
    - `$functionToApply`
    - `$functionParameters`
    - `$applyToSummaryRow`
- It does not return anything.

### `filter()` <a name="filter"></a>

See [ColumnCallbackAddMetadata](#).

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$table`
- It does not return anything.

