<small>Piwik\ArchiveProcessor</small>

Period
======

Initiates the archiving process for all non-day periods via the [ArchiveProcessor.aggregateMultipleReports](#) event.

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
    public function aggregateMultipleReports(ArchiveProcessor\Period $archiveProcessor)
    {
        $archiveProcessor-&gt;aggregateNumericMetrics(&#039;myFancyMetric&#039;, &#039;sum&#039;);
        $archiveProcessor-&gt;aggregateNumericMetrics(&#039;myOtherFancyMetric&#039;, &#039;max&#039;);
    }

**Archiving report data**

    // function in an Archiver descendent
    public function aggregateMultipleReports(ArchiveProcessor\Period $archiveProcessor)
    {
        $maxRowsInTable = Config::getInstance()-&gt;General[&#039;datatable_archiving_maximum_rows_standard&#039;];j

        $archiveProcessor-&gt;aggregateDataTableReports(
            &#039;MyPlugin_myFancyReport&#039;,
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

### `aggregateDataTableReports()` <a name="aggregateDataTableReports"></a>

Sums records for every subperiod of the current period and inserts the result as the record for this period.

#### Description

DataTables are summed recursively so subtables will be summed as well.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$recordNames`
    - `$maximumRowsInDataTableLevelZero`
    - `$maximumRowsInSubDataTable`
    - `$columnToSortByBeforeTruncation`
    - `$columnAggregationOperations`
    - `$invalidSummedColumnNameToRenamedName`
- _Returns:_ Returns the row counts of each aggregated report before truncation, eg, ``` array( &#039;report1&#039; =&gt; array(&#039;level0&#039; =&gt; $report1-&gt;getRowsCount, &#039;recursive&#039; =&gt; $report1-&gt;getRowsCountRecursive()), &#039;report2&#039; =&gt; array(&#039;level0&#039; =&gt; $report2-&gt;getRowsCount, &#039;recursive&#039; =&gt; $report2-&gt;getRowsCountRecursive()), ... ) ```
    - `array`

### `aggregateNumericMetrics()` <a name="aggregateNumericMetrics"></a>

Aggregates metrics for every subperiod of the current period and inserts the result as the metric for this period.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$columns`
    - `$operationToApply`
- _Returns:_ Returns the array of aggregate values. If only one metric was aggregated, the aggregate value will be returned as is, not in an array. For example, if `array(&#039;nb_visits&#039;, &#039;nb_hits&#039;)` is supplied for `$columns`, ``` array( &#039;nb_visits&#039; =&gt; 3040, &#039;nb_hits&#039; =&gt; 405 ) ``` is returned.
    - `array`
    - `int`

