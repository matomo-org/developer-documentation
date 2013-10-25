<small>Piwik\DataTable\Filter</small>

MetadataCallbackAddMetadata
===========================

Executes a callback for each row of a DataTable and adds the result to the row as a metadata value.

Description
-----------

Only metadata values are passed to the callback.

**Basic usage example**

    // add a logo metadata based on the url metadata
    $dataTable-&gt;filter(&#039;MetadataCallbackAddMetadata&#039;, array(&#039;url&#039;, &#039;logo&#039;, &#039;Piwik\Plugins\MyPlugin\getLogoFromUrl&#039;));


Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`filter()`](#filter) &mdash; See [MetadataCallbackAddMetadata](#).

### `__construct()` <a name="__construct"></a>

Constructor.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md))
    - `$metadataToRead`
    - `$metadataToAdd`
    - `$functionToApply`
    - `$applyToSummaryRow`
- It does not return anything.

### `filter()` <a name="filter"></a>

See [MetadataCallbackAddMetadata](#).

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$table`
- It does not return anything.

