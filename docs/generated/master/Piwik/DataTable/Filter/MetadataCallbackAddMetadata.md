<small>Piwik\DataTable\Filter\</small>

MetadataCallbackAddMetadata
===========================

Executes a callback for each row of a DataTable and adds the result to the row as a metadata value.

Only metadata values are passed to the callback.

**Basic usage example**

    // add a logo metadata based on the url metadata
    $dataTable->filter('MetadataCallbackAddMetadata', array('url', 'logo', 'Piwik\Plugins\MyPlugin\getLogoFromUrl'));

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`filter()`](#filter) &mdash; See [MetadataCallbackAddMetadata](/api-reference/Piwik/DataTable/Filter/MetadataCallbackAddMetadata).

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$table` ([`DataTable`](../../../Piwik/DataTable.md)) &mdash;

      <div markdown="1" class="param-desc"> The DataTable that will eventually be filtered.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$metadataToRead` (`string`|`array`) &mdash;

      <div markdown="1" class="param-desc"> The metadata to read from each row and pass to the callback.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$metadataToAdd` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The name of the metadata to add.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$functionToApply` (`callable`) &mdash;

      <div markdown="1" class="param-desc"> The callback to execute for each row. The result will be added as metadata with the name `$metadataToAdd`.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$applyToSummaryRow` (`bool`) &mdash;

      <div markdown="1" class="param-desc"> True if the callback should be applied to the summary row, false if otherwise.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<a name="filter" id="filter"></a>
<a name="filter" id="filter"></a>
### `filter()`

See [MetadataCallbackAddMetadata](/api-reference/Piwik/DataTable/Filter/MetadataCallbackAddMetadata).

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$table` ([`DataTable`](../../../Piwik/DataTable.md)) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

