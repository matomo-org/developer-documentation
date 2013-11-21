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
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

- It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md)) &mdash; The DataTable that will eventually be filtered.
    - `$metadataToRead` (`string`|`array`) &mdash; The metadata to read from each row and pass to the callback.
    - `$metadataToAdd` (`string`) &mdash; The name of the metadata to add.
    - `$functionToApply` (`callable`) &mdash; The callback to execute for each row. The result will be added as metadata with the name `$metadataToAdd`.
    - `$applyToSummaryRow` (`bool`) &mdash; True if the callback should be applied to the summary row, false if otherwise.

<a name="filter" id="filter"></a>
<a name="filter" id="filter"></a>
### `filter()`

See [MetadataCallbackAddMetadata](#).

#### Signature

- It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md))
- It does not return anything.

