<small>Piwik\DataTable\Filter</small>

MetadataCallbackAddMetadata
===========================

Executes a callback for each row of a DataTable and adds the result to the row as a metadata value.

Description
-----------

Only metadata values are passed to the callback.

**Basic usage example**

    // add a logo metadata based on the url metadata
    $dataTable->filter('MetadataCallbackAddMetadata', array('url', 'logo', 'Piwik\Plugins\MyPlugin\getLogoFromUrl'));


Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`filter()`](#filter) &mdash; See [MetadataCallbackAddMetadata](#).

<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

- It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md))
    - `$metadataToRead`
    - `$metadataToAdd`
    - `$functionToApply`
    - `$applyToSummaryRow`
- It does not return anything.

<a name="filter" id="filter"></a>
### `filter()`

See [MetadataCallbackAddMetadata](#).

#### Signature

- It accepts the following parameter(s):
    - `$table`
- It does not return anything.

