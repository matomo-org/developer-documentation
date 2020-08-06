---
category: DevelopInDepth
previous: log-data
next: archive-data
---
# The archiving process

**Log data** cannot be used directly for end-user reports because it would require to process an enormous amount of data every time the report is needed.

To solve that problem, the **archiving process** aggregates log data into **archive data**. Reports are then built using archive data.

## Example

Let's take as an example a website that received 1000 page views in one day. The **log data** would be the list of those 1000 events along with other information, for example:

```
URL         Time     ...
/homepage   17:00:19 ...
/about      17:01:10 ...
/homepage   17:05:30 ...
/categories 17:06:14 ...
/homepage   17:10:03 ...
...
```

The **archiving process** aggregates this raw data into archive data.

For example, to build the report of the number of views per page (to see the most popular pages), the archiving will list all pages and sum the number of views for each page:

```
URL         Page views
/homepage   205
/categories 67
/about      5
...
```

That data is the **archive data**.

While pre-computing archive data seems of course superfluous for 1000 page views, it is not when dealing with higher amounts of data.

## When?

### On-demand Archiving

By default, archive data is calculated and cached **on-demand**. When a specific report is requested, Piwik will check if the required archive data exists and generate it if it does not.

### Pre-archiving

When tracking a website with a lot of traffic, on-demand archiving will take too much time and resources, causing users to wait a long time before a report becomes visible.
In those situations, archiving on demand must be disabled and [pre-archiving needs to run in background at a scheduled time](https://matomo.org/docs/setup-auto-archiving/).

Pre-archiving can be run for every site and period (except custom date ranges) using the `core:archive` console command:

```
$ ./console core:archive
```

A usual setup is to run that command at fixed interval using `cron`, for example, hourly.

The command will remember when it was last executed and will only archive a website if there have been new visits, or if an archive has been invalidated.

## How?

Log data is aggregated into archive data for each:

- site
- period: day, week, month, year or custom date range (custom date ranges cannot be pre-archived)
- [segment](https://matomo.org/docs/segmentation/)

Archiving logic (i.e. the way of aggregating log data) is defined by plugins. All reports defined by a plugin are archived together rather than individually.

If no segment is given in the query and data cannot be found, every report of every plugin will be generated and cached all at once. If a segment is supplied, then the reports that belong to the same plugins as the requested data will be generated and cached.

### Period aggregations

Archive data is calculated differently based on the period type:

- "day" periods are aggregation of log data
- "week", "month", "year" and custom date ranges are aggregation of "day" reports

For example archive data for a week is created by aggregating archive data of the 7 days of the week. This is much faster than aggregating log data.

### Plugin Archivers

Plugins that want to archive reports and metrics define a class called `Archiver` that extends [`Piwik\Plugin\Archiver`](/api-reference/Piwik/Plugin/Archiver). This class will be automatically detected and called during the archiving process.

Log data aggregation is handled by the [`LogAggregator`](/api-reference/Piwik/DataAccess/LogAggregator) class. Archive data aggregation is handled by the [`ArchiveProcessor::aggregateDataTableRecords()`](/api-reference/Piwik/ArchiveProcessor#aggregatedatatablerecords) and [`ArchiveProcessor::aggregateNumericMetrics()`](/api-reference/Piwik/ArchiveProcessor#aggregatenumericmetrics) methods.

Plugins can access a [`LogAggregator`](/api-reference/Piwik/DataAccess/LogAggregator) and [`ArchiveProcessor`](/api-reference/Piwik/ArchiveProcessor) instance with [`Piwik\Plugin\Archiver`](/api-reference/Piwik/Plugin/Archiver).

To learn more about how aggregation is accomplished with Piwik's MySQL backend, read about the [database schema](/guides/database-schema).

### Persisting archive data

Archive data is persisted using [`ArchiveProcessor`](/api-reference/Piwik/ArchiveProcessor).

Metrics are inserted using [`insertNumericRecord()`](/api-reference/Piwik/ArchiveProcessor#insertnumericrecords).

Reports are first serialized using [`DataTable::getSerialized()`](/api-reference/Piwik/DataTable#getserialized) and then inserted using [`ArchiveProcessor::insertBlobRecord()`](/api-reference/Piwik/ArchiveProcessor#insertblobrecord):

```php
// insert a numeric metric
$myFancyMetric = // ... calculate the metric value ...
$archiveProcessor->insertNumericRecord('MyPlugin_myFancyMetric', $myFancyMetric);

// insert a record (with all of its subtables)
$maxRowsInTable = Config::getInstance()->General['datatable_archiving_maximum_rows_standard'];j

$dataTable = // ... build by aggregating visits ...
$serializedData = $dataTable->getSerialized(
    $maxRowsInTable,
    $maxRowsInSubtable = $maxRowsInTable,
    $columnToSortBy = Metrics::INDEX_NB_VISITS
);

$archiveProcessor->insertBlobRecords('MyPlugin_myFancyReport', $serializedData);
```

Persisted reports and metrics are indexed by the website ID, period and segment. The date and time of archiving is also attached to the data. To learn the specifics of how this is done with MySQL see the [database schema](/guides/database-schema).

### How archive status is stored

The status of each archive is stored as a row in the `archive_numeric_*` tables. The archive status row has `name` value of
`done*`, where the suffix can contain a specific plugin name and/or segment hash.

In the code, these rows are called the "done flag"s of an archive, and the value of this row (called the "done flag value")
is the status of the archive. This row can have the following values:

* `ArchiveWriter::DONE_OK` - the archive was successfully processed and can be read.
* `ArchiveWriter::DONE_ERROR` - the archive experienced an error while being processed and should not be used.
* `ArchiveWriter::DONE_INVALIDATED` - the archive was successfully processed in the past, but has since been marked as invalid. It must be reprocessed at some point.
* `ArchiveWriter::DONE_PARTIAL` - the archive was successfully completed as a [partial archive](#partial-archives). This is an archive that only contains some reports. More information about these types of archives are below.

### How reports are stored as blob records in the `archive_blob_*` tables

When inserting blob records, one row in a `archive_blob_$year_$month` MySQL table for the root `DataTable` is created. Subtables of this `DataTable` are stored in different rows whereas 100 tables are combined into one chunk. For example the record `MyPlugin_myFancyReport_chunk_100_199` contains subtables having the ID 100-199. The `value` column of the `archive` table contains in this case a serialized array of blobs where `array([subtableId] => [subtableBlob])`. For example:


idarchive             | name             | value             | Description
-----------------|-----------------------|-----------------------|------------
1           | Actions_actions_url           | gzcompress(<br />$serializedRootTableBlob<br />)  | Contains the blob of the root table
1           | Actions_actions_url_chunk_0_99 | gzcompress(serialize(<br />array([subtableId]=>[serializedSubtableBlob])<br />)) | Contains the blobs of the subtables 0-99 (subtableId 0 is always unused as it is the id of the root table)
1           | Actions_actions_url_chunk_100_199 | ... | Contains the blobs of the subtables 100-199
1           | Actions_actions_url_chunk_200_299 | ... | Contains the blobs of the subtables 200-299

#### Reports vs Records

When a report is archived, it is called a **record** not a report. We make a distinction because multiple reports can sometimes be generated from one **record**.

For example, the *UserSettings* plugin uses one record to hold browser details of visitors. This record is used to generate both the `UserSettings.getBrowserVersion` and `UserSettings.getBrowser` reports. The second report simply processes the first to make a new report. The plugin could have archived both reports, but this would have been a **massive** waste of space, considering the new report would be cached for every website/period/segment combination.

<a name="record-storage-guidelines"></a>

<div markdown="1" class="alert alert-warning">
**Record storage guidelines**

Care must be taken to store as little as possible when persisting records. Make sure to follow the guidelines below before inserting records as archive data:

* **Records should not be stored with string column names.** Instead they should be replaced with integer column IDs (see [Metrics](/api-reference/Piwik/Metrics) for a list of existing ones).
* **Metadata that can be added using existing data should not be stored with reports.** Instead they should be added in API methods when turning records into reports.
</div>

/*
    archive invalidation: how are existing archives invalidated, what makes an archive invalidated, how is this done in code and handled by browser vs pre-archiving
    archive purging: how are old archives deleted? at what other times are archives deleted?
    partial archives: what are they, how do they fit into initiation/invalidation/purging workflow, how do archivers handle this, how do plugins initiate it, + a note that it doesn't work for browser archiving

*/

## Archive Invalidation

When an archive is known to no longer be valid, it is marked as invalid. This is done in the following situations:

* automatically by Matomo when a new visit is recorded in the past
* sometimes by plugins when they want to re-process an archive
* and can be done manually by a user to force an archive to be reprocessed. This can be done either through the web
  user interface or from the command line using the `core:invalidate-report-data` command.

Two things happen when an archive is invalidated:

* The [done flag value](#how-archive-status-is-stored) of the archive (if the archive exists) is set to `ArchiveWriter::DONE_INVALIDATED`.
* An entry is added to the `archive_invalidations` table saying that the archive should be re-processed.

Invalidating an archive means the archive should be reprocessed some time in the future. How it is reprocessed depends on whether on-demand archiving or
pre-archiving is used.

### Invalidation with on-demand archiving

When on-demand archiving is used, Matomo will re-process invalidated archives before they are requested. The archive
querying system will simply ignore archives with DONE_INVALIDATED, treating them like they are not there.

So when a query comes in for an invalidated archive, Matomo will find nothing and assume the archive needs to be processed.

### Invalidation with pre-archiving

When pre-archiving is used, the entry that is added to `archive_invalidations` is pulled and processed. After it successfully
completes, we remove the entry.

<div markdown="1" class="alert alert-info">
It should be noted that for pre-archiving, archive invalidating is the primary mechanism by which archiving is initiated.
In the `core:archive` command, we invalidate archives we know have had new visits (including periods for today and yesterday).
Then we go through each entry in `archive_invalidations` processing them until the table is empty.

The `archive_invalidations` table is very much like a queue, except unlike a LIFO queue, there is a specific order to
how archives are handled. For example, we want to archive days before weeks and weeks before months, etc. And we also
want to process the normal archives before handling segment archives to avoid any errors in the report data.
</div>

### For plugins: archiving data in the past

If a plugin needs to process reports in the past, for instance, because the plugin was recently activated or an entity
that affects report data was created/changed, there is an API for it:

```
TODO: code example
```

Here we use the `ArchiveInvalidator::reArchiveReport` method to invalidate archive data in the past, but only for the specific
plugin or report we care about. On the next `core:archive` run, they will be re-processed into [partial-archives](#partial-archives).

**NOTE: This API only works for pre-archiving. For on-demand archiving, there is no need since the reports in the past will be generated
if the user requests them.**

TODO: how to handle in Archivers.

## Specifics of archive querying

Archive data is queried through the `Archive` class:

```
TODO: code example
```

The class looks for usable archives for the given `idSite`, `period` and `segment`. This will include:

* the latest "all plugins" archive (where the done flag is like `done`) that we are allowed to query OR
  the latest plugin specific archives (where the done flag is like `done.MyPlugin`) that would have the specific reports/metrics we are looking for
* any partial archives for this `idSite`/`period`/`segment` combination that are newer than the latest archive above

`Archive` will then look for the requested data in all of these archives and use the most recently archived data (ie, the rows with the greatest `ts_archived`).

## Archive Purging

Archives that are invalidated or no longer require processing do not need to be stored, so they are deleted. Old and
errored archives are deleted in two places:

* right after a new archive is finalized, older archives for the same site, period and segment are deleted
* regularly through a scheduled task in the `CoreAdminHome` plugin, older and errored archives are deleted

The specifics of purging are straightforward. `idarchive`s of archives that are safe to delete are queried, then
rows with that `idarchive` in the respective numeric and blob tables are deleted.

### Other instances where archives are deleted

Archives can also be deleted in other contexts. For example, when a segment is deleted, we no longer need the
archives for that segment, so we delete them.

Plugins can delete archives themselves by using the `ArchivePurger` class.

## Partial Archives

Partial archives are a special type of archive that only contain one or a few reports of one plugin, rather than every report
for one plugin (or every report for all plugins).

Currently, they are only created when plugins want to archive a single report in the past.

 TODO
