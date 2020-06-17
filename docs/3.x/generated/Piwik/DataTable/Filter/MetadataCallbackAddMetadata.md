<small>Piwik\DataTable\Filter\</small>

MetadataCallbackAddMetadata
===========================

Executes a callback for each row of a DataTable and adds the result to the row as a metadata value.

**Basic usage example**

    // add a logo metadata based on the url metadata
    $dataTable->filter('MetadataCallbackAddMetadata', array('url', 'logo', 'Piwik\Plugins\MyPlugin\getLogoFromUrl'));

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`filter()`](#filter) &mdash; See [MetadataCallbackAddMetadata](/api-reference/Piwik/DataTable/Filter/MetadataCallbackAddMetadata).
- [`enableRecursive()`](#enablerecursive) &mdash; Enables/Disables recursive filtering. Inherited from [`BaseFilter`](../../../Piwik/DataTable/BaseFilter.md)
- [`filterSubTable()`](#filtersubtable) &mdash; Filters a row's subtable, if one exists and is loaded in memory. Inherited from [`BaseFilter`](../../../Piwik/DataTable/BaseFilter.md)

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

-  It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md)) &mdash;
      
    - `$metadataToRead` (`string`|`array`) &mdash;
       The metadata to read from each row and pass to the callback.
    - `$metadataToAdd` (`string`) &mdash;
       The name of the metadata to add.
    - `$functionToApply` (`callable`) &mdash;
       The callback to execute for each row. The result will be added as metadata with the name `$metadataToAdd`.
    - `$applyToSummaryRow` (`bool`) &mdash;
       True if the callback should be applied to the summary row, false if otherwise.

<a name="filter" id="filter"></a>
<a name="filter" id="filter"></a>
### `filter()`

See [MetadataCallbackAddMetadata](/api-reference/Piwik/DataTable/Filter/MetadataCallbackAddMetadata).

#### Signature

-  It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md)) &mdash;
      
- It does not return anything.

<a name="enablerecursive" id="enablerecursive"></a>
<a name="enableRecursive" id="enableRecursive"></a>
### `enableRecursive()`

Enables/Disables recursive filtering. Whether this property is actually used
is up to the derived BaseFilter class.

#### Signature

-  It accepts the following parameter(s):
    - `$enable` (`bool`) &mdash;
      
- It does not return anything.

<a name="filtersubtable" id="filtersubtable"></a>
<a name="filterSubTable" id="filterSubTable"></a>
### `filterSubTable()`

Filters a row's subtable, if one exists and is loaded in memory.

#### Signature

-  It accepts the following parameter(s):
    - `$row` ([`Row`](../../../Piwik/DataTable/Row.md)) &mdash;
       The row whose subtable should be filter.
- It does not return anything.

