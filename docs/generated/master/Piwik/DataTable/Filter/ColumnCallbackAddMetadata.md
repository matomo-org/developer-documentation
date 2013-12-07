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
- [`filter()`](#filter) &mdash; See [ColumnCallbackAddMetadata](/api-reference/Piwik/DataTable/Filter/ColumnCallbackAddMetadata).

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

      <div markdown="1" class="param-desc"> The DataTable instance that will be filtered.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$columnsToRead` (`string`|`array`) &mdash;

      <div markdown="1" class="param-desc"> The columns to read from each row and pass on to the callback.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$metadataToAdd` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The name of the metadata field that will be added to each row.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$functionToApply` (`callable`) &mdash;

      <div markdown="1" class="param-desc"> The callback to apply for each row.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$functionParameters` (`array`) &mdash;

      <div markdown="1" class="param-desc"> deprecated - use an [anonymous function](http://php.net/manual/en/functions.anonymous.php) instead.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$applyToSummaryRow` (`bool`) &mdash;

      <div markdown="1" class="param-desc"> Whether the callback should be applied to the summary row or not.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<a name="filter" id="filter"></a>
<a name="filter" id="filter"></a>
### `filter()`

See [ColumnCallbackAddMetadata](/api-reference/Piwik/DataTable/Filter/ColumnCallbackAddMetadata).

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

