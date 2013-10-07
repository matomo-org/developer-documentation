<small>Piwik\ArchiveProcessor</small>

Period
======

This class provides generic methods to archive data for a period (week / month / year).

Description
-----------

The archiving for a period is done by aggregating &quot;sub periods&quot; contained within this period.
For example to process a week&#039;s data, we sum each day&#039;s data.

Public methods can be called by the plugins that hook on the event &#039;ArchiveProcessor.Period.compute&#039;


Methods
-------

The class defines the following methods:

- [`aggregateDataTableReports()`](#aggregateDataTableReports) &mdash; This method will compute the sum of DataTables over the period for the given fields $recordNames.
- [`aggregateNumericMetrics()`](#aggregateNumericMetrics) &mdash; Given a list of records names, the method will fetch all their values over the period, and aggregate them.

### `aggregateDataTableReports()` <a name="aggregateDataTableReports"></a>

This method will compute the sum of DataTables over the period for the given fields $recordNames.

#### Description

The resulting DataTable will be then added to queue of data to be recorded in the database.
It will usually be called in a plugin that listens to the hook &#039;ArchiveProcessor.Period.compute&#039;

For example if $recordNames = &#039;UserCountry_country&#039; the method will select all UserCountry_country DataTable for the period
(eg. the 31 dataTable of the last month), sum them, then record it in the DB


This method works on recursive dataTable. For example for the &#039;Actions&#039; it will select all subtables of all dataTable of all the sub periods
 and get the sum.

It returns an array that gives information about the &quot;final&quot; DataTable. The array gives for every field name, the number of rows in the
 final DataTable (ie. the number of distinct LABEL over the period) (eg. the number of distinct keywords over the last month)

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$recordNames`
    - `$maximumRowsInDataTableLevelZero`
    - `$maximumRowsInSubDataTable`
    - `$columnToSortByBeforeTruncation`
    - `$columnAggregationOperations`
    - `$invalidSummedColumnNameToRenamedName`
- _Returns:_ array ( nameTable1 =&gt; number of rows, nameTable2 =&gt; number of rows, )
    - `array`

### `aggregateNumericMetrics()` <a name="aggregateNumericMetrics"></a>

Given a list of records names, the method will fetch all their values over the period, and aggregate them.

#### Description

For example $columns = array(&#039;nb_visits&#039;, &#039;sum_time_visit&#039;)
 it will sum all values of nb_visits for the period (eg. get number of visits for the month by summing the visits of every day)

The aggregate metrics are then stored in the Archive and the values are returned.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$columns`
    - `$operationToApply`
- It returns a(n) `array` value.

