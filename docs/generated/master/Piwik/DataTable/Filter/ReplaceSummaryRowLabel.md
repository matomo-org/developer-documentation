<small>Piwik\DataTable\Filter\</small>

ReplaceSummaryRowLabel
======================

Replaces the label of the summary row with a supplied label.

This filter is only used to prettify the summary row label and so it should
always be queued on a DataTable.

This filter always recurses. In other words, this filter will always apply itself to
all subtables in the given DataTable's table hierarchy.

**Basic example**

    $dataTable->queueFilter('ReplaceSummaryRowLabel', array(Piwik::translate('General_Others')));

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`filter()`](#filter) &mdash; See [ReplaceSummaryRowLabel](/api-reference/Piwik/DataTable/Filter/ReplaceSummaryRowLabel).
- [`enableRecursive()`](#enablerecursive) &mdash; Enables/Disables recursive filtering.
- [`filterSubTable()`](#filtersubtable) &mdash; Filters a row's subtable, if one exists and is loaded in memory.

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

      <div markdown="1" class="param-desc"> The table that will eventually be filtered.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$newLabel` (`string`|`null`) &mdash;

      <div markdown="1" class="param-desc"> The new label for summary row. If null, defaults to `Piwik::translate('General_Others')`.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<a name="filter" id="filter"></a>
<a name="filter" id="filter"></a>
### `filter()` 
See [ReplaceSummaryRowLabel](/api-reference/Piwik/DataTable/Filter/ReplaceSummaryRowLabel).

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

<a name="enablerecursive" id="enablerecursive"></a>
<a name="enableRecursive" id="enableRecursive"></a>
### `enableRecursive()` *inherited from [`BaseFilter`](../../../Piwik/DataTable/BaseFilter.md)*
Enables/Disables recursive filtering.

Whether this property is actually used
is up to the derived BaseFilter class.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$enable` (`bool`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="filtersubtable" id="filtersubtable"></a>
<a name="filterSubTable" id="filterSubTable"></a>
### `filterSubTable()` *inherited from [`BaseFilter`](../../../Piwik/DataTable/BaseFilter.md)*
Filters a row's subtable, if one exists and is loaded in memory.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$row` ([`Row`](../../../Piwik/DataTable/Row.md)) &mdash;

      <div markdown="1" class="param-desc"> The row whose subtable should be filter.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

