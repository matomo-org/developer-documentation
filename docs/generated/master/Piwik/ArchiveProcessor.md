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
                           across Piwik&#039;s log tables.

### Examples

**Inserting numeric data**

    // function in an Archiver descendent
    public function aggregateDayReport(ArchiveProcessor $archiveProcessor)
    {
        $myFancyMetric = // ... calculate the metric value ...
        $archiveProcessor-&gt;insertNumericRecord(&#039;MyPlugin_myFancyMetric&#039;, $myFancyMetric);
    }

**Inserting serialized DataTables**

    // function in an Archiver descendent
    public function aggregateDayReport(ArchiveProcessor $archiveProcessor)
    {
        $maxRowsInTable = Config::getInstance()-&gt;General[&#039;datatable_archiving_maximum_rows_standard&#039;];j

        $myDataTable = // ... use LogAggregator to generate a report about some log data ...
    
        $dataTable = // ... build by aggregating visits ...
        $serializedData = $dataTable-&gt;getSerialized($maxRowsInTable, $maxRowsInSubtable = $maxRowsInTable,
                                                    $columnToSortBy = Metrics::INDEX_NB_VISITS);
        
        $archiveProcessor-&gt;insertBlobRecords(&#039;MyPlugin_myFancyReport&#039;, $serializedData);
    }


Constants
---------

This class defines the following constants:

- [`DONE_OK`](#DONE_OK) &mdash; Flag stored at the end of the archiving
- [`DONE_ERROR`](#DONE_ERROR) &mdash; Flag stored at the start of the archiving When requesting an Archive, we make sure that non-finished archive are not considered valid
- [`DONE_OK_TEMPORARY`](#DONE_OK_TEMPORARY) &mdash; Flag indicates the archive is over a period that is not finished, eg.

### `DONE_OK_TEMPORARY` <a name="DONE_OK_TEMPORARY"></a>

the current day, current week, etc.
Archives flagged will be regularly purged from the DB.

Methods
-------

The class defines the following methods:

- [`getLogAggregator()`](#getLogAggregator) &mdash; Returns a [LogAggregator](#) instance for the site, period and segment this ArchiveProcessor will insert archive data for.
- [`getPeriod()`](#getPeriod) &mdash; Returns the period we computing statistics for.
- [`getSite()`](#getSite) &mdash; Returns the site we are computing statistics for.
- [`getSegment()`](#getSegment) &mdash; The Segment used to limit the set of visits that are being aggregated.
- [`insertNumericRecords()`](#insertNumericRecords) &mdash; Caches multiple numeric records in the archive for this processor&#039;s site, period and segment.
- [`insertNumericRecord()`](#insertNumericRecord) &mdash; Caches a single numeric record in the archive for this processor&#039;s site, period and segment.
- [`insertBlobRecord()`](#insertBlobRecord) &mdash; Caches one or more blob records in the archive for this processor&#039;s site, period and segment.

### `getLogAggregator()` <a name="getLogAggregator"></a>

Returns a [LogAggregator](#) instance for the site, period and segment this ArchiveProcessor will insert archive data for.

#### Signature

- It is a **public** method.
- It returns a(n) [`LogAggregator`](../Piwik/DataAccess/LogAggregator.md) value.

### `getPeriod()` <a name="getPeriod"></a>

Returns the period we computing statistics for.

#### Signature

- It is a **public** method.
- It returns a(n) [`Period`](../Piwik/Period.md) value.

### `getSite()` <a name="getSite"></a>

Returns the site we are computing statistics for.

#### Signature

- It is a **public** method.
- It returns a(n) [`Site`](../Piwik/Site.md) value.

### `getSegment()` <a name="getSegment"></a>

The Segment used to limit the set of visits that are being aggregated.

#### Signature

- It is a **public** method.
- It returns a(n) [`Segment`](../Piwik/Segment.md) value.

### `insertNumericRecords()` <a name="insertNumericRecords"></a>

Caches multiple numeric records in the archive for this processor&#039;s site, period and segment.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$numericRecords`
- It does not return anything.

### `insertNumericRecord()` <a name="insertNumericRecord"></a>

Caches a single numeric record in the archive for this processor&#039;s site, period and segment.

#### Description

Numeric values are not inserted if they equal 0.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$name`
    - `$value`
- It does not return anything.

### `insertBlobRecord()` <a name="insertBlobRecord"></a>

Caches one or more blob records in the archive for this processor&#039;s site, period and segment.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$name`
    - `$values`
- It does not return anything.

