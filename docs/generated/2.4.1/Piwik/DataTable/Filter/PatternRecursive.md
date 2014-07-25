<small>Piwik\DataTable\Filter\</small>

PatternRecursive
================

Deletes rows that do not contain a column that matches a regex pattern and do not contain a subtable that contains a column that matches a regex pattern.

**Example**

    // only display index pageviews in Actions.getPageUrls
    $dataTable->filter('PatternRecursive', array('label', 'index'));

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`filter()`](#filter) &mdash; See [PatternRecursive](/api-reference/Piwik/DataTable/Filter/PatternRecursive).
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
   </ul>

<a name="filter" id="filter"></a>
<a name="filter" id="filter"></a>
### `filter()` 
See [PatternRecursive](/api-reference/Piwik/DataTable/Filter/PatternRecursive).

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

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`int`) &mdash;
    <div markdown="1" class="param-desc">The number of deleted rows.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

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

