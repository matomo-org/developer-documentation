<small>Piwik\DataTable\Filter\</small>

Limit
=====

Delete all rows from the table that are not in the given offset -> offset+limit range.

**Basic example usage**

    // delete all rows from 5 -> 15
    $dataTable->filter('Limit', array(5, 10));

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`filter()`](#filter) &mdash; See [Limit](/api-reference/Piwik/DataTable/Filter/Limit).

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
      `$offset` (`int`) &mdash;

      <div markdown="1" class="param-desc"> The starting row index to keep.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$limit` (`int`) &mdash;

      <div markdown="1" class="param-desc"> Number of rows to keep (specify -1 to keep all rows).</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$keepSummaryRow` (`bool`) &mdash;

      <div markdown="1" class="param-desc"> Whether to keep the summary row or not.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<a name="filter" id="filter"></a>
<a name="filter" id="filter"></a>
### `filter()`

See [Limit](/api-reference/Piwik/DataTable/Filter/Limit).

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

