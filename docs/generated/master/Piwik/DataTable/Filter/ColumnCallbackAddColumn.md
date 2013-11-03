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
    
    $dataTable-&gt;filter(&#039;ColumnCallbackAddColumn&#039;, array(array(&#039;nb_visits&#039;, &#039;sum_time_spent&#039;), &#039;avg_time_on_site&#039;, $callback));


Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`filter()`](#filter) &mdash; See [ColumnCallbackAddColumn](#).

### `__construct()` <a name="__construct"></a>

Constructor.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md))
    - `$columns`
    - `$columnToAdd`
    - `$functionToApply`
    - `$functionParameters`
- It does not return anything.

### `filter()` <a name="filter"></a>

See [ColumnCallbackAddColumn](#).

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$table`
- It does not return anything.

