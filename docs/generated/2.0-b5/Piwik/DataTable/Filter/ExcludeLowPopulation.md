<small>Piwik\DataTable\Filter</small>

ExcludeLowPopulation
====================

Deletes all rows for which a specific column has a value that is lower than specific minimum threshold value.

Description
-----------

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
- [`filter()`](#filter) &mdash; See [ExcludeLowPopulation](#).

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

- It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md)) &mdash; The DataTable that will be filtered eventually.
    - `$columnToFilter` (`string`) &mdash; The name of the column whose value will determine whether row is deleted or not.
    - `$minimumValue` (`Piwik\DataTable\Filter\number`|`Piwik\DataTable\Filter\false`) &mdash; The minimum column value. Rows with column values < this number will be deleted. If false, `$minimumPercentageThreshold` is used.
    - `$minimumPercentageThreshold` (`bool`|`float`) &mdash; If supplied, column values must be a greater percentage of the sum of all column values than this value.

<a name="filter" id="filter"></a>
<a name="filter" id="filter"></a>
### `filter()`

See [ExcludeLowPopulation](#).

#### Signature

- It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md))
- It does not return anything.

