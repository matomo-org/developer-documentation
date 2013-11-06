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


Properties
----------

This class defines the following properties:

- [`$invalidDivision`](#$invaliddivision)
- [`$roundPrecision`](#$roundprecision)
- [`$deleteRowsWithNoVisit`](#$deleterowswithnovisit)

<a name="invaliddivision" id="invaliddivision"></a>
### `$invalidDivision`

#### Signature

- Its type is not specified.


<a name="roundprecision" id="roundprecision"></a>
### `$roundPrecision`

#### Signature

- Its type is not specified.


<a name="deleterowswithnovisit" id="deleterowswithnovisit"></a>
### `$deleteRowsWithNoVisit`

#### Signature

- Its type is not specified.


Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`filter()`](#filter) &mdash; Adds the processed metrics.
- [`getColumn()`](#getcolumn) &mdash; Returns column from a given row.

<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

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

- It accepts the following parameter(s):
    - `$table`
- It does not return anything.

<a name="getcolumn" id="getcolumn"></a>
### `getColumn()`

Returns column from a given row.

#### Description

Will work with 2 types of datatable
- raw datatables coming from the archive DB, which columns are int indexed
- datatables processed resulting of API calls, which columns have human readable english names

#### Signature

- It accepts the following parameter(s):
    - `$row`
    - `$columnIdRaw`
    - `$mappingIdToName`
- _Returns:_ Value of column, false if not found
    - `mixed`

