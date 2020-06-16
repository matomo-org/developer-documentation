<small>Piwik\DataTable\Filter\</small>

ExcludeLowPopulation
====================

Deletes all rows for which a specific column has a value that is lower than specified minimum threshold value.

**Basic usage examples**

    // remove all countries from UserCountry.getCountry that have less than 3 visits
    $dataTable = // ... get a DataTable whose queued filters have been run ...
    $dataTable->filter('ExcludeLowPopulation', array('nb_visits', 3));

    // remove all countries from UserCountry.getCountry whose percent of total visits is less than 5%
    $dataTable = // ... get a DataTable whose queued filters have been run ...
    $dataTable->filter('ExcludeLowPopulation', array('nb_visits', false, 0.05));

    // remove all countries from UserCountry.getCountry whose bounce rate is less than 10%
    $dataTable = // ... get a DataTable that has a numerical bounce_rate column ...
    $dataTable->filter('ExcludeLowPopulation', array('bounce_rate', 0.10));

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`filter()`](#filter) &mdash; See [ExcludeLowPopulation](/api-reference/Piwik/DataTable/Filter/ExcludeLowPopulation).
- [`enableRecursive()`](#enablerecursive) &mdash; Enables/Disables recursive filtering. Inherited from [`BaseFilter`](../../../Piwik/DataTable/BaseFilter.md)
- [`filterSubTable()`](#filtersubtable) &mdash; Filters a row's subtable, if one exists and is loaded in memory. Inherited from [`BaseFilter`](../../../Piwik/DataTable/BaseFilter.md)

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

-  It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md)) &mdash;
       The DataTable that will be filtered eventually.
    - `$columnToFilter` (`string`) &mdash;
       The name of the column whose value will determine whether a row is deleted or not.
    - `$minimumValue` (`Piwik\DataTable\Filter\number`|`Piwik\DataTable\Filter\false`) &mdash;
       The minimum column value. Rows with column values < this number will be deleted. If false, `$minimumPercentageThreshold` is used.
    - `$minimumPercentageThreshold` (`bool`|`float`) &mdash;
       If supplied, column values must be a greater percentage of the sum of all column values than this percentage.

<a name="filter" id="filter"></a>
<a name="filter" id="filter"></a>
### `filter()`

See [ExcludeLowPopulation](/api-reference/Piwik/DataTable/Filter/ExcludeLowPopulation).

#### Signature

-  It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md)) &mdash;
      
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

