<small>Piwik\DataTable\Filter\</small>

ColumnCallbackDeleteRow
=======================

Deletes all rows for which a callback returns true.

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

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$table` ([`DataTable`](../../../Piwik/DataTable.md)) &mdash;

      <div markdown="1" class="param-desc"> The DataTable that will be filtered eventually.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$columnsToFilter` (`array`|`string`) &mdash;

      <div markdown="1" class="param-desc"> The column or array of columns that should be passed to the callback.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$function` (`Piwik\DataTable\Filter\callback`) &mdash;

      <div markdown="1" class="param-desc"> The callback that determines whether a row should be deleted or not. Should return `true` if the row should be deleted.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$functionParams` (`array`) &mdash;

      <div markdown="1" class="param-desc"> deprecated - use an [anonymous function](http://php.net/manual/en/functions.anonymous.php) instead.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<a name="filter" id="filter"></a>
<a name="filter" id="filter"></a>
### `filter()`

Filters the given data table

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

