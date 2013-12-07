<small>Piwik\DataTable\Filter</small>

Pattern
=======

Deletes every row for which a specific column does not match a supplied regex pattern.

Description
-----------

**Example**

    // filter out all rows whose labels doesn't start with piwik
    $dataTable->filter('Pattern', array('label', '^piwik'));

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`filter()`](#filter) &mdash; See [Pattern](#).

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

      <div markdown="1" class="param-desc"> The table to eventually filter.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$columnToFilter` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The column to match with the `$patternToSearch` pattern.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$patternToSearch` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The regex pattern to use.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$invertedMatch` (`bool`) &mdash;

      <div markdown="1" class="param-desc"> Whether to invert the pattern or not. If true, will remove rows if they match the pattern.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<a name="filter" id="filter"></a>
<a name="filter" id="filter"></a>
### `filter()`

See [Pattern](#).

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

