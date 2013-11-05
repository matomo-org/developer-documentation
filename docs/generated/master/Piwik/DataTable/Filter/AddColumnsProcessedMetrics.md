<small>Piwik\DataTable\Filter</small>

AddColumnsProcessedMetrics
==========================

Adds the following columns to a DataTable using metrics that already exist:  - **conversion_rate**: percent value of `nb_conversions / nb_visits - **nb_actions_per_visit**: `nb_actions / nb_visits` - **avg_time_on_site**: in number of seconds, `round(visit_length / nb_visits)`.

Description
-----------

not
                        pretty formatted
- **bounce_rate**: percent value of `bounce_count / nb_visits`

Adding the **filter_add_columns_when_show_all_columns** query parameter to
an API request will trigger the execution of this Filter.

Note: This filter must be called before [ReplaceColumnNames](#) is called.

**Basic usage example**

    $dataTable->filter('AddColumnsProcessedMetrics');


Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`filter()`](#filter) &mdash; Adds the processed metrics.

<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md))
    - `$deleteRowsWithNoVisit`
- It does not return anything.

<a name="filter" id="filter"></a>
### `filter()`

Adds the processed metrics.

#### Description

See [AddColumnsProcessedMetrics](#AddColumnsProcessedMetrics) for
more information.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$table`
- It does not return anything.

