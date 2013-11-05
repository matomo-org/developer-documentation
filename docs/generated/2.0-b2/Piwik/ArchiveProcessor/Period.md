<small>Piwik\ArchiveProcessor</small>

Period
======

Initiates the archiving process for all non-day periods via the [ArchiveProcessor.Period.compute](#) event.

Description
-----------

Period archiving differs from archiving day periods in that log tables are not aggregated.
Instead the data from periods within the non-day period are aggregated. For example, if the data
for a month is being archived, this ArchiveProcessor will select the aggregated data for each
day in the month and add them together. This is much faster than running aggregation queries over
the entire set of visits.

If data has not been archived for the subperiods, archiving will be launched for those subperiods.

### Examples

**Archiving metric data**

    // function in an Archiver descendent
    public function archivePeriod(ArchiveProcessor\Period $archiveProcessor)
    {
        $archiveProcessor->aggregateNumericMetrics('myFancyMetric', 'sum');
        $archiveProcessor->aggregateNumericMetrics('myOtherFancyMetric', 'max');
    }

**Archiving report data**

    // function in an Archiver descendent
    public function archivePeriod(ArchiveProcessor\Period $archiveProcessor)
    {
        $maxRowsInTable = Config::getInstance()->General['datatable_archiving_maximum_rows_standard'];j

        $archiveProcessor->aggregateDataTableReports(
            'MyPlugin_myFancyReport',
            $maxRowsInTable,
            $maxRowsInSubtable = $maxRowsInTable,
            $columnToSortByBeforeTruncation = Metrics::INDEX_NB_VISITS,
        );
    }


Methods
-------

The class defines the following methods:

- [`aggregateDataTableReports()`](#aggregateDataTableReports) &mdash; Sums records for every subperiod of the current period and inserts the result as the record for this period.
- [`aggregateNumericMetrics()`](#aggregateNumericMetrics) &mdash; Aggregates metrics for every subperiod of the current period and inserts the result as the metric for this period.

<a name="aggregatedatatablereports" id="aggregatedatatablereports"></a>
### `aggregateDataTableReports()`

Sums records for every subperiod of the current period and inserts the result as the record for this period.

#### Description

DataTables are summed recursively so subtables will be summed as well.

#### Signature

- It accepts the following parameter(s):
    - `$recordNames`
    - `$maximumRowsInDataTableLevelZero`
    - `$maximumRowsInSubDataTable`
    - `$columnToSortByBeforeTruncation`
    - `$columnAggregationOperations`
    - `$invalidSummedColumnNameToRenamedName`
- _Returns:_ Returns the row counts of each aggregated report before truncation, eg, ``` array( 'report1' => array('level0' => $report1->getRowsCount, 'recursive' => $report1->getRowsCountRecursive()), 'report2' => array('level0' => $report2->getRowsCount, 'recursive' => $report2->getRowsCountRecursive()), ... ) ```
    - `array`

<a name="aggregatenumericmetrics" id="aggregatenumericmetrics"></a>
### `aggregateNumericMetrics()`

Aggregates metrics for every subperiod of the current period and inserts the result as the metric for this period.

#### Signature

- It accepts the following parameter(s):
    - `$columns`
    - `$operationToApply`
- _Returns:_ Returns the array of aggregate values. If only one metric was aggregated, the aggregate value will be returned as is, not in an array. For example, if `array('nb_visits', 'nb_hits')` is supplied for `$columns`, ``` array( 'nb_visits' => 3040, 'nb_hits' => 405 ) ``` is returned.
    - `array`
    - `int`

