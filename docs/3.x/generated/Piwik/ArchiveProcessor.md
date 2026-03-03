<small>Piwik\</small>

ArchiveProcessor
================

Used by [Archiver](/api-reference/Piwik/Plugin/Archiver) instances to insert and aggregate archive data.

### See also

- **[Archiver](/api-reference/Piwik/Plugin/Archiver)** - to learn how plugins should implement their own analytics
                                      aggregation logic.
- **[LogAggregator](/api-reference/Piwik/DataAccess/LogAggregator)** - to learn how plugins can perform data aggregation
                                               across Piwik's log tables.

### Examples

**Inserting numeric data**

    // function in an Archiver descendant
    public function aggregateDayReport()
    {
        $archiveProcessor = $this->getProcessor();

        $myFancyMetric = // ... calculate the metric value ...
        $archiveProcessor->insertNumericRecord('MyPlugin_myFancyMetric', $myFancyMetric);
    }

**Inserting serialized DataTables**

    // function in an Archiver descendant
    public function aggregateDayReport()
    {
        $archiveProcessor = $this->getProcessor();

        $maxRowsInTable = Config::getInstance()->General['datatable_archiving_maximum_rows_standard'];j

        $dataTable = // ... build by aggregating visits ...
        $serializedData = $dataTable->getSerialized($maxRowsInTable, $maxRowsInSubtable = $maxRowsInTable,
                                                    $columnToSortBy = Metrics::INDEX_NB_VISITS);

        $archiveProcessor->insertBlobRecords('MyPlugin_myFancyReport', $serializedData);
    }

**Aggregating archive data**

    // function in Archiver descendant
    public function aggregateMultipleReports()
    {
        $archiveProcessor = $this->getProcessor();

        // aggregate a metric
        $archiveProcessor->aggregateNumericMetrics('MyPlugin_myFancyMetric');
        $archiveProcessor->aggregateNumericMetrics('MyPlugin_mySuperFancyMetric', 'max');

        // aggregate a report
        $archiveProcessor->aggregateDataTableRecords('MyPlugin_myFancyReport');
    }

Methods
-------

The class defines the following methods:

- [`getParams()`](#getparams) &mdash; Returns the Parameters object containing the site, period and segment we're archiving data for.
- [`getLogAggregator()`](#getlogaggregator) &mdash; Returns a `[LogAggregator](/api-reference/Piwik/DataAccess/LogAggregator)` instance for the site, period and segment this ArchiveProcessor will insert archive data for.
- [`aggregateDataTableRecords()`](#aggregatedatatablerecords) &mdash; Sums records for every subperiod of the current period and inserts the result as the record for this period.
- [`aggregateNumericMetrics()`](#aggregatenumericmetrics) &mdash; Aggregates one or more metrics for every subperiod of the current period and inserts the results as metrics for the current period.
- [`insertNumericRecords()`](#insertnumericrecords) &mdash; Caches multiple numeric records in the archive for this processor's site, period and segment.
- [`insertNumericRecord()`](#insertnumericrecord) &mdash; Caches a single numeric record in the archive for this processor's site, period and segment.
- [`insertBlobRecord()`](#insertblobrecord) &mdash; Caches one or more blob records in the archive for this processor's site, period and segment.

<a name="getparams" id="getparams"></a>
<a name="getParams" id="getParams"></a>
### `getParams()`

Returns the Parameters object containing the site, period and segment we're archiving
data for.

#### Signature

- It returns a [`Parameters`](../Piwik/ArchiveProcessor/Parameters.md) value.

<a name="getlogaggregator" id="getlogaggregator"></a>
<a name="getLogAggregator" id="getLogAggregator"></a>
### `getLogAggregator()`

Returns a `[LogAggregator](/api-reference/Piwik/DataAccess/LogAggregator)` instance for the site, period and segment this
ArchiveProcessor will insert archive data for.

#### Signature

- It returns a [`LogAggregator`](../Piwik/DataAccess/LogAggregator.md) value.

<a name="aggregatedatatablerecords" id="aggregatedatatablerecords"></a>
<a name="aggregateDataTableRecords" id="aggregateDataTableRecords"></a>
### `aggregateDataTableRecords()`

Sums records for every subperiod of the current period and inserts the result as the record
for this period.

DataTables are summed recursively so subtables will be summed as well.

#### Signature

-  It accepts the following parameter(s):
    - `$recordNames` (`string`|`array`) &mdash;
       Name(s) of the report we are aggregating, eg, `'Referrers_type'`.
    - `$maximumRowsInDataTableLevelZero` (`int`) &mdash;
       Maximum number of rows allowed in the top level DataTable.
    - `$maximumRowsInSubDataTable` (`int`) &mdash;
       Maximum number of rows allowed in each subtable.
    - `$columnToSortByBeforeTruncation` (`string`) &mdash;
       The name of the column to sort by before truncating a DataTable.
    - `$columnsAggregationOperation` (`array`) &mdash;
       Operations for aggregating columns, see Row::sumRow().
    - `$columnsToRenameAfterAggregation` (`array`) &mdash;
       Columns mapped to new names for columns that must change names when summed because they cannot be summed, eg, `array('nb_uniq_visitors' => 'sum_daily_nb_uniq_visitors')`.
    - `$countRowsRecursive` (`bool`|`array`) &mdash;
       if set to true, will calculate the recursive rows count for all record names which makes it slower. If you only need it for some records pass an array of recordNames that defines for which ones you need a recursive row count.

- *Returns:*  `array` &mdash;
    Returns the row counts of each aggregated report before truncation, eg,

                  array(
                      'report1' => array('level0' => $report1->getRowsCount,
                                         'recursive' => $report1->getRowsCountRecursive()),
                      'report2' => array('level0' => $report2->getRowsCount,
                                         'recursive' => $report2->getRowsCountRecursive()),
                      ...
                  )

<a name="aggregatenumericmetrics" id="aggregatenumericmetrics"></a>
<a name="aggregateNumericMetrics" id="aggregateNumericMetrics"></a>
### `aggregateNumericMetrics()`

Aggregates one or more metrics for every subperiod of the current period and inserts the results
as metrics for the current period.

#### Signature

-  It accepts the following parameter(s):
    - `$columns` (`array`|`string`) &mdash;
       Array of metric names to aggregate.
    - `$operationToApply` (`bool`|`string`) &mdash;
       The operation to apply to the metric. Either `'sum'`, `'max'` or `'min'`.

- *Returns:*  `array`|`int` &mdash;
    Returns the array of aggregate values. If only one metric was aggregated,
                  the aggregate value will be returned as is, not in an array.
                  For example, if `array('nb_visits', 'nb_hits')` is supplied for `$columns`,

                      array(
                          'nb_visits' => 3040,
                          'nb_hits' => 405
                      )

                  could be returned. If `array('nb_visits')` or `'nb_visits'` is used for `$columns`,
                  then `3040` would be returned.

<a name="insertnumericrecords" id="insertnumericrecords"></a>
<a name="insertNumericRecords" id="insertNumericRecords"></a>
### `insertNumericRecords()`

Caches multiple numeric records in the archive for this processor's site, period
and segment.

#### Signature

-  It accepts the following parameter(s):
    - `$numericRecords` (`array`) &mdash;
       A name-value mapping of numeric values that should be archived, eg, array('Referrers_distinctKeywords' => 23, 'Referrers_distinctCampaigns' => 234)
- It does not return anything or a mixed result.

<a name="insertnumericrecord" id="insertnumericrecord"></a>
<a name="insertNumericRecord" id="insertNumericRecord"></a>
### `insertNumericRecord()`

Caches a single numeric record in the archive for this processor's site, period and
segment.

Numeric values are not inserted if they equal `0`.

#### Signature

-  It accepts the following parameter(s):
    - `$name` (`string`) &mdash;
       The name of the numeric value, eg, `'Referrers_distinctKeywords'`.
    - `$value` (`float`) &mdash;
       The numeric value.
- It does not return anything or a mixed result.

<a name="insertblobrecord" id="insertblobrecord"></a>
<a name="insertBlobRecord" id="insertBlobRecord"></a>
### `insertBlobRecord()`

Caches one or more blob records in the archive for this processor's site, period
and segment.

#### Signature

-  It accepts the following parameter(s):
    - `$name` (`string`) &mdash;
       The name of the record, eg, 'Referrers_type'.
    - `$values` (`string`|`array`) &mdash;
       A blob string or an array of blob strings. If an array is used, the first element in the array will be inserted with the `$name` name. The others will be inserted with `$name . '_' . $index` as the record name (where $index is the index of the blob record in `$values`).
- It does not return anything or a mixed result.

