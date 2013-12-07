<small>Piwik\DataTable\Filter</small>

AddColumnsProcessedMetrics
==========================

Adds processed metrics columns to a DataTable using metrics that already exist.

Description
-----------

Columns added are:

- **conversion_rate**: percent value of `nb_visits_converted / nb_visits
- **nb_actions_per_visit**: `nb_actions / nb_visits`
- **avg_time_on_site**: in number of seconds, `round(visit_length / nb_visits)`. not
                        pretty formatted.
- **bounce_rate**: percent value of `bounce_count / nb_visits`

Adding the **filter_add_columns_when_show_all_columns** query parameter to
an API request will trigger the execution of this Filter.

_Note: This filter must be called before [ReplaceColumnNames](#) is called._

**Basic usage example**

    $dataTable->filter('AddColumnsProcessedMetrics');

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`filter()`](#filter) &mdash; Adds the processed metrics.

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

#### Description

See [AddColumnsProcessedMetrics](#AddColumnsProcessedMetrics) for
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

