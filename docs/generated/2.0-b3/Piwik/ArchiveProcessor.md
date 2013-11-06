<small>Piwik</small>

ArchiveProcessor
================

Used to insert numeric and blob archive data.

Description
-----------

During the Archiving process a descendant of this class is used by plugins
to cache aggregated analytics statistics.

When the [Archive](#) class is used to query for archive data and that archive
data is found to be absent, the archiving process is launched. An ArchiveProcessor
instance is created based on the period type and the archiving logic of every
active plugin is executed through the [ArchiveProcessor.Day.compute](#) and
[ArchiveProcessor.aggregateMultipleReports](#) events.

Plugins receive ArchiveProcessor instances in those events and use them to
aggregate data for the requested site, period and segment. The aggregate
data is then persisted, again using the ArchiveProcessor instance.

### Limitations

- It is currently only possible to aggregate statistics for one site and period
at a time. The archive.php cron script does, however, issue asynchronous HTTP
requests that initiate archiving, so statistics can be calculated in parallel.

### See also

- **[Archiver](#)** - to learn how plugins should implement their own analytics
                      aggregation logic.
- **[LogAggregator](#)** - to learn how plugins can perform data aggregation
                           across Piwik's log tables.

### Examples

**Inserting numeric data**

    // function in an Archiver descendent
    public function aggregateDayReport(ArchiveProcessor $archiveProcessor)
    {
        $myFancyMetric = // ... calculate the metric value ...
        $archiveProcessor->insertNumericRecord('MyPlugin_myFancyMetric', $myFancyMetric);
    }

**Inserting serialized DataTables**

    // function in an Archiver descendent
    public function aggregateDayReport(ArchiveProcessor $archiveProcessor)
    {
        $maxRowsInTable = Config::getInstance()->General['datatable_archiving_maximum_rows_standard'];j

        $myDataTable = // ... use LogAggregator to generate a report about some log data ...
    
        $dataTable = // ... build by aggregating visits ...
        $serializedData = $dataTable->getSerialized($maxRowsInTable, $maxRowsInSubtable = $maxRowsInTable,
                                                    $columnToSortBy = Metrics::INDEX_NB_VISITS);
        
        $archiveProcessor->insertBlobRecords('MyPlugin_myFancyReport', $serializedData);
    }


Methods
-------

The class defines the following methods:

- [`getParams()`](#getparams) &mdash; Returns the Parameters object containing Period, Site, Segment used for this archive.
- [`getLogAggregator()`](#getlogaggregator) &mdash; Returns a [LogAggregator](#) instance for the site, period and segment this ArchiveProcessor will insert archive data for.
- [`insertNumericRecords()`](#insertnumericrecords) &mdash; Caches multiple numeric records in the archive for this processor's site, period and segment.
- [`insertNumericRecord()`](#insertnumericrecord) &mdash; Caches a single numeric record in the archive for this processor's site, period and segment.
- [`insertBlobRecord()`](#insertblobrecord) &mdash; Caches one or more blob records in the archive for this processor's site, period and segment.

<a name="getparams" id="getparams"></a>
<a name="getParams" id="getParams"></a>
### `getParams()`

Returns the Parameters object containing Period, Site, Segment used for this archive.

#### Signature

- It returns a [`Parameters`](../Piwik/ArchiveProcessor/Parameters.md) value.

<a name="getlogaggregator" id="getlogaggregator"></a>
<a name="getLogAggregator" id="getLogAggregator"></a>
### `getLogAggregator()`

Returns a [LogAggregator](#) instance for the site, period and segment this ArchiveProcessor will insert archive data for.

#### Signature

- It returns a [`LogAggregator`](../Piwik/DataAccess/LogAggregator.md) value.

<a name="insertnumericrecords" id="insertnumericrecords"></a>
<a name="insertNumericRecords" id="insertNumericRecords"></a>
### `insertNumericRecords()`

Caches multiple numeric records in the archive for this processor's site, period and segment.

#### Signature

- It accepts the following parameter(s):
    - `$numericRecords`
- It does not return anything.

<a name="insertnumericrecord" id="insertnumericrecord"></a>
<a name="insertNumericRecord" id="insertNumericRecord"></a>
### `insertNumericRecord()`

Caches a single numeric record in the archive for this processor's site, period and segment.

#### Description

Numeric values are not inserted if they equal 0.

#### Signature

- It accepts the following parameter(s):
    - `$name`
    - `$value`
- It does not return anything.

<a name="insertblobrecord" id="insertblobrecord"></a>
<a name="insertBlobRecord" id="insertBlobRecord"></a>
### `insertBlobRecord()`

Caches one or more blob records in the archive for this processor's site, period and segment.

#### Signature

- It accepts the following parameter(s):
    - `$name`
    - `$values`
- It does not return anything.

