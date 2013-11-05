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


Constants
---------

This class defines the following constants:

- DONE_OK &mdash; Flag stored at the end of the archiving
- DONE_ERROR &mdash; Flag stored at the start of the archiving When requesting an Archive, we make sure that non-finished archive are not considered valid
- [`DONE_OK_TEMPORARY`](#done_ok_temporary) &mdash; Flag indicates the archive is over a period that is not finished, eg.

<a name="done_ok_temporary" id="done_ok_temporary"></a>
### `DONE_OK_TEMPORARY`

the current day, current week, etc.
Archives flagged will be regularly purged from the DB.

Methods
-------

The class defines the following methods:

- [`getLogAggregator()`](#getlogaggregator) &mdash; Returns a [LogAggregator](#) instance for the site, period and segment this ArchiveProcessor will insert archive data for.
- [`getPeriod()`](#getperiod) &mdash; Returns the period we computing statistics for.
- [`getSite()`](#getsite) &mdash; Returns the site we are computing statistics for.
- [`getSegment()`](#getsegment) &mdash; The Segment used to limit the set of visits that are being aggregated.
- [`insertNumericRecords()`](#insertnumericrecords) &mdash; Caches multiple numeric records in the archive for this processor's site, period and segment.
- [`insertNumericRecord()`](#insertnumericrecord) &mdash; Caches a single numeric record in the archive for this processor's site, period and segment.
- [`insertBlobRecord()`](#insertblobrecord) &mdash; Caches one or more blob records in the archive for this processor's site, period and segment.

<a name="getlogaggregator" id="getlogaggregator"></a>
### `getLogAggregator()`

Returns a [LogAggregator](#) instance for the site, period and segment this ArchiveProcessor will insert archive data for.

#### Signature

- It returns a(n) [`LogAggregator`](../Piwik/DataAccess/LogAggregator.md) value.

<a name="getperiod" id="getperiod"></a>
### `getPeriod()`

Returns the period we computing statistics for.

#### Signature

- It returns a(n) [`Period`](../Piwik/Period.md) value.

<a name="getsite" id="getsite"></a>
### `getSite()`

Returns the site we are computing statistics for.

#### Signature

- It returns a(n) [`Site`](../Piwik/Site.md) value.

<a name="getsegment" id="getsegment"></a>
### `getSegment()`

The Segment used to limit the set of visits that are being aggregated.

#### Signature

- It returns a(n) [`Segment`](../Piwik/Segment.md) value.

<a name="insertnumericrecords" id="insertnumericrecords"></a>
### `insertNumericRecords()`

Caches multiple numeric records in the archive for this processor's site, period and segment.

#### Signature

- It accepts the following parameter(s):
    - `$numericRecords`
- It does not return anything.

<a name="insertnumericrecord" id="insertnumericrecord"></a>
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
### `insertBlobRecord()`

Caches one or more blob records in the archive for this processor's site, period and segment.

#### Signature

- It accepts the following parameter(s):
    - `$name`
    - `$values`
- It does not return anything.

