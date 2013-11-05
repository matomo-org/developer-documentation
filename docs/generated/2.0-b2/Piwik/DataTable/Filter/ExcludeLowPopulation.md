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


Constants
---------

This class defines the following constants:

- `MINIMUM_SIGNIFICANT_PERCENTAGE_THRESHOLD`

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`filter()`](#filter) &mdash; See [ExcludeLowPopulation](#).

<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

- It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md))
    - `$columnToFilter`
    - `$minimumValue`
    - `$minimumPercentageThreshold`
- It does not return anything.

<a name="filter" id="filter"></a>
### `filter()`

See [ExcludeLowPopulation](#).

#### Signature

- It accepts the following parameter(s):
    - `$table`
- It does not return anything.

