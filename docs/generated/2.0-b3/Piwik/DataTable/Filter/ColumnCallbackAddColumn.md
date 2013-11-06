<small>Piwik\DataTable\Filter</small>

ColumnCallbackAddColumn
=======================

Adds a new column to every row of a DataTable based on the result of callback.

Description
-----------

**Basic usage example**

    $callback = function ($visits, $timeSpent) {
        return round($timeSpent / $visits, 2);
    };
    
    $dataTable->filter('ColumnCallbackAddColumn', array(array('nb_visits', 'sum_time_spent'), 'avg_time_on_site', $callback));


Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`filter()`](#filter) &mdash; See [ColumnCallbackAddColumn](#).

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

- It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md))
    - `$columns`
    - `$columnToAdd`
    - `$functionToApply`
    - `$functionParameters`
- It does not return anything.

<a name="filter" id="filter"></a>
<a name="filter" id="filter"></a>
### `filter()`

See [ColumnCallbackAddColumn](#).

#### Signature

- It accepts the following parameter(s):
    - `$table`
- It does not return anything.

