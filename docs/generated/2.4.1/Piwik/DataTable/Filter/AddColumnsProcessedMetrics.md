<small>Piwik\DataTable\Filter\</small>

AddColumnsProcessedMetrics
==========================

Adds processed metrics columns to a DataTable using metrics that already exist.

Columns added are:

- **conversion_rate**: percent value of `nb_visits_converted / nb_visits
- **nb_actions_per_visit**: `nb_actions / nb_visits`
- **avg_time_on_site**: in number of seconds, `round(visit_length / nb_visits)`. Not
                        pretty formatted.
- **bounce_rate**: percent value of `bounce_count / nb_visits`

Adding the **filter_add_columns_when_show_all_columns** query parameter to
an API request will trigger the execution of this Filter.

_Note: This filter must be called before [ReplaceColumnNames](/api-reference/Piwik/DataTable/Filter/ReplaceColumnNames) is called._

**Basic usage example**

    $dataTable->filter('AddColumnsProcessedMetrics');

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`filter()`](#filter) &mdash; Adds the processed metrics.
- [`enableRecursive()`](#enablerecursive) &mdash; Enables/Disables recursive filtering. *inherited from* [`BaseFilter`](../../../Piwik/DataTable/BaseFilter.md)
- [`filterSubTable()`](#filtersubtable) &mdash; Filters a row's subtable, if one exists and is loaded in memory. *inherited from* [`BaseFilter`](../../../Piwik/DataTable/BaseFilter.md)

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
      `$deleteRowsWithNoVisit` (`bool`) &mdash;

      <div markdown="1" class="param-desc"> Whether to delete rows with no visits or not.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<a name="filter" id="filter"></a>
<a name="filter" id="filter"></a>
### `filter()`

Adds the processed metrics.

See [AddColumnsProcessedMetrics](/api-reference/Piwik/DataTable/Filter/AddColumnsProcessedMetrics) for
more information.

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
### `enableRecursive()`

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
### `filterSubTable()`

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

