<small>Piwik\DataTable\Filter\</small>

ColumnCallbackAddColumn
=======================

Adds a new column to every row of a DataTable based on the result of callback.

**Basic usage example**

    $callback = function ($visits, $timeSpent) {
        return round($timeSpent / $visits, 2);
    };

    $dataTable->filter('ColumnCallbackAddColumn', array(array('nb_visits', 'sum_time_spent'), 'avg_time_on_site', $callback));

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`filter()`](#filter) &mdash; See [ColumnCallbackAddColumn](/api-reference/Piwik/DataTable/Filter/ColumnCallbackAddColumn).
- [`enableRecursive()`](#enablerecursive) &mdash; Enables/Disables recursive filtering. Inherited from [`BaseFilter`](../../../Piwik/DataTable/BaseFilter.md)
- [`filterSubTable()`](#filtersubtable) &mdash; Filters a row's subtable, if one exists and is loaded in memory. Inherited from [`BaseFilter`](../../../Piwik/DataTable/BaseFilter.md)

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

-  It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md)) &mdash;
       The DataTable that will be filtered.
    - `$columns` (`array`|`string`) &mdash;
       The names of the columns to pass to the callback.
    - `$columnToAdd` (`string`) &mdash;
       The name of the column to add.
    - `$functionToApply` (`callable`) &mdash;
       The callback to apply to each row of a DataTable. The columns specified in `$columns` are passed to this callback.
    - `$functionParameters` (`array`) &mdash;
       deprecated - use an [anonymous function](http://php.net/manual/en/functions.anonymous.php) instead.

<a name="filter" id="filter"></a>
<a name="filter" id="filter"></a>
### `filter()`

See [ColumnCallbackAddColumn](/api-reference/Piwik/DataTable/Filter/ColumnCallbackAddColumn).

#### Signature

-  It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md)) &mdash;
       The table to filter.
- It does not return anything.

<a name="enablerecursive" id="enablerecursive"></a>
<a name="enableRecursive" id="enableRecursive"></a>
### `enableRecursive()`

Enables/Disables recursive filtering.

Whether this property is actually used
is up to the derived BaseFilter class.

#### Signature

-  It accepts the following parameter(s):
    - `$enable` (`bool`) &mdash;
      
- It does not return anything.

<a name="filtersubtable" id="filtersubtable"></a>
<a name="filterSubTable" id="filterSubTable"></a>
### `filterSubTable()`

Filters a row's subtable, if one exists and is loaded in memory.

#### Signature

-  It accepts the following parameter(s):
    - `$row` ([`Row`](../../../Piwik/DataTable/Row.md)) &mdash;
       The row whose subtable should be filter.
- It does not return anything.

