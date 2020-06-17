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

By default, archive data is calculated and cached **on-demand**. When a specific report is requested, Piwik will check if the required archive data exist and generate it if not.

### Pre-archiving

When tracking a website with a lot of traffic, the archiving on-demand might take too much time. In those situations, archiving on demand must be disabled and [pre-archiving needs to run in background at a scheduled time](https://piwik.org/docs/setup-auto-archiving/).

Pre-archiving can be run for every site and period (except custom date ranges) using the `core:archive` console command:

```
$ ./console core:archive
```

A usual setup is to run that command at fixed interval using `cron`.

The command will remember when it was last executed and will only archive a website if there have been new visits.

## How?

Log data is aggregated into archive data for each:

- site
- period: day, week, month, year or custom date range (custom date ranges cannot be pre-archived)
- [segment](https://piwik.org/docs/segmentation/)

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

## Persisting archive data

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

### How reports are stored as blob records in the `archive_blob_*` tables

When inserting blob records, one row in a `archive_blob_$year_$month` MySQL table for the root `DataTable` is created. Subtables of this `DataTable` are stored in different rows whereas 100 tables are combined into one chunk. For example the record `MyPlugin_myFancyReport_chunk_100_199` contains subtables having the ID 100-199. The `value` column of the `archive` table contains in this case a serialized array of blobs where `array([subtableId] => [subtableBlob])`. For example:


idarchive             | name             | value             | Description
-----------------|-----------------------|-----------------------|------------
1           | Actions_actions_url           | gzcompress(<br />$serializedRootTableBlob<br />)  | Contains the blob of the root table
1           | Actions_actions_url_chunk_0_99 | gzcompress(serialize(<br />array([subtableId]=>[serializedSubtableBlob])<br />)) | Contains the blobs of the subtables 0-99 (subtableId 0 is always unused as it is the id of the root table)
1           | Actions_actions_url_chunk_100_199 | ... | Contains the blobs of the subtables 100-199
1           | Actions_actions_url_chunk_200_299 | ... | Contains the blobs of the subtables 200-299

### Reports vs Records

When a report is archived, it is called a **record** not a report. We make a distinction because multiple reports can sometimes be generated from one **record**.

For example, the *UserSettings* plugin uses one record to hold browser details of visitors. This record is used to generate both the `UserSettings.getBrowserVersion` and `UserSettings.getBrowser` reports. The second report simply processes the first to make a new report. The plugin could have archived both reports, but this would have been a **massive** waste of space, considering the new report would be cached for every website/period/segment combination.

<a name="record-storage-guidelines"></a>

<div markdown="1" class="alert alert-warning">
**Record storage guidelines**

Care must be taken to store as little as possible when persisting records. Make sure to follow the guidelines below before inserting records as archive data:

* **Records should not be stored with string column names.** Instead they should be replaced with integer column IDs (see [Metrics](/api-reference/Piwik/Metrics) for a list of existing ones).
* **Metadata that can be added using existing data should not be stored with reports.** Instead they should be added in API methods when turning records into reports.
</div>
