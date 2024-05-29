---
category: Develop
---

<div markdown="1" class="alert alert-warning">
**This API is unstable.**

The RecordBuilder API will eventually be public and the only way to define archiving logic, but for now the API is unstable
and subject to change. Please be aware it could potentially change between minor version releases.
</div>

# Writing a RecordBuilder

RecordBuilders encapsulate the smallest units of aggregation logic required to generate records for a plugin.

They define two methods: `aggregate()` which builds the actual `DataTable` & numeric records to insert into archive tables,
and `getRecordMetadata()` which returns information about what records the `RecordBuilder` builds.

`aggregate()` will generally aggregate data from log tables to create records, but it does not have to. An example of a use case
without aggregation would be importing analytics data from another service.

`getRecordMetadata()` is used when aggregating records for non-day periods. In this case, Matomo will find the record values
for the subperiods of the non-day period and aggregate them together.

If your plugin needs to insert data into the archive tables during archiving, then you'll want to create your own `RecordBuilder` classes.
This guide describes how to do that.

## How to create one

### Step one: identify the list of records and log aggregation queries you want to bundle together

Log aggregation queries are expensive (especially with segmentation) and Matomo wants to be able to run as few of them
as possible at a time. A `RecordBuilder` is meant to encapsulate the smallest amount of archiving logic possible, allowing Matomo
to run just what it needs to.

Many times this will either be running a single log aggregation query to generate a single `DataTable` or running a single
log aggregation query to generate multiple numeric metrics. Sometimes it will mean running multiple log aggregation queries
to generate a single `DataTable` or running multiple log aggregation queries to generate multiple `DataTable`s and multiple metrics.

It is up to you as a developer to find the balance between efficiency (executing the fewest log aggregation queries overall)
and modularity (having `RecordBuilder`s that individually do as little as possible).

Once you've identified the `RecordBuilder`s you'll need, create empty classes for them in a `RecordBuilders` subfolder of your plugin. For example,
`/path/to/matomo/plugins/MyPlugin/RecordBuilders/MyRecordBuilder`.

**A note about Parameterized RecordBuilders**

`RecordBuilder`s that can be created without specifying constructor arguments (as in, are default constructable)
are found and created automatically by Matomo. But it is also possible to create `RecordBuilder`s that require
parameters. These `RecordBuilder`s are added via the `Archiver.addRecordBuilders` event.

The ability to create parameterized `RecordBuilder`s may not be necessary in most cases, but if your plugin
manages entities and provides reports about those entities, it can be used to avoid having to run a query for
every entity in the database within a single `RecordBuilder`.

Examples of plugins that use this feature are the Custom Reports premium feature and the A/B Testing premium feature.
Each of these plugins use a `RecordBuilder` that takes an ID. For Custom Reports this is the ID of the specific custom
report and for A/B Testing this is the ID of the experiment.

### Step two: implement `getRecordMetadata()`

Once you know what queries the `RecordBuilder`s you are going to create will execute, you can start coding.
The first thing to do is implement the `getRecordMetadata()` method.

All this method does is return a list of `Record` entries describing the records the builder will create:

```
use Piwik\ArchiveProcessor\Record;

public function getRecordMetadata(ArchiveProcessor $archiveProcessor): array
{
    return [
        Record::make(Record::TYPE_BLOB, 'MyPlugin_myRecord'),
        Record::make(Record::TYPE_NUMERIC, 'MyPlugin_myMetric'),
        ...
    ];
}
```

The above is a typical example of how this method would be implemented, but it doesn't have to just be a hard-coded array.
You can use the `ArchiveProcessor` to get the current site/period/segment or fetch system settings or measurable
settings and vary the result based on that information. The only requirement is that every `Record` returned matches
what can be returned by the `aggregate()` method, which we'll look at next.

### Step three: implement `aggregate()`

The next step is to implement your actual log aggregation logic in the `aggregate()` method. This method accepts
an `ArchiveProcessor` and returns an array mapping record names with record values to insert. Record values are
either numeric metric values or `DataTable` instances, which get serialized and inserted as blobs.

As for how they are created, well, there is no straightforward way to define how log aggregation is done.

The current pattern in Matomo is to use the core `LogAggregator` class to query log data and loop through the result.
If your plugin provides its own additional log tables, then the pattern is to define your own `Aggregator` classes
to build and execute log aggregation SQL queries, and use those classes in your `RecordBuilders`.

An example of this might look like:

```
public function aggregate(ArchiveProcessor $archiveProcessor): array
{
    $logAggregator = $archiveProcessor->getLogAggregator();
    
    $report = new DataTable();
    
    $query = $logAggregator->queryVisitsByDimension(['label' => 'config_browser_name']);
    while ($row = $query->fetch()) {
        $columns = [
            Metrics::INDEX_NB_UNIQ_VISITORS => $row[Metrics::INDEX_NB_UNIQ_VISITORS],
            Metrics::INDEX_NB_VISITS => $row[Metrics::INDEX_NB_VISITS],
            Metrics::INDEX_NB_ACTIONS => $row[Metrics::INDEX_NB_ACTIONS],
            Metrics::INDEX_NB_USERS => $row[Metrics::INDEX_NB_USERS],
            Metrics::INDEX_MAX_ACTIONS => $row[Metrics::INDEX_MAX_ACTIONS],
            Metrics::INDEX_SUM_VISIT_LENGTH => $row[Metrics::INDEX_SUM_VISIT_LENGTH],
            Metrics::INDEX_BOUNCE_COUNT => $row[Metrics::INDEX_BOUNCE_COUNT],
            Metrics::INDEX_NB_VISITS_CONVERTED => $row[Metrics::INDEX_NB_VISITS_CONVERTED],
        ];

        $report->sumRowWithLabel($row['label'] ?? '', $columns);
    }

    return [
        'MyPlugin_myRecord' => $report,
    ];
}
```

This example queries the `log_visit` table, grouping by the `config_browser_name` column and aggregating visit metrics.
Then, for each row of that query, it adds the metrics to a `DataTable` which is eventually returned.

Most `aggregate()` methods will be more complicated than this, but hopefully it provides you with a general understanding
of how they should work. We recommend looking at existing `RecordBuilder`s in Matomo as well to see what is possible.

### Step four: decide whether you need to set custom row limits or aggregation operations

At this point, the hard parts are over. The last two steps are just finishing touches.

By default, Matomo does not limit the data that is inserted into archive tables. For reports that have a limited number
of rows, like the `VisitorInterest.getVisitsByVisitCount` and `UserCountry.getCountry`, this is acceptable. But for reports
with a variable number of rows, it's good practice to make sure the number of rows is capped.

To set a limit, set the `maxRowsInTable` and `maxRowsInSubtable` properties in the constructor of your `RecordBuilder`.
This can be hard-coded or it can come from configuration:

```
class MyRecordBuilder extends RecordBuilder
{
    public function __construct()
    {
        parent::__construct();
        $this->maxRowsInTable = (int)Config::getInstance()->MyPlugin['datatable_archiving_maximum_rows'];
        $this->maxRowsInSubtable = (int)Config::getInstance()->MyPlugin['datatable_archiving_maximum_rows_subtable'];

        // we want to sort by the most important metric in our reports before we cut off rows
        $this->columnToSortByBeforeTruncation = Metrics::INDEX_NB_VISITS;
    }
}
```

If you don't know what to use, you can set both values to `Config::getInstance()->General['datatable_archiving_maximum_rows_standard']`.

Also note we set `columnToSortByBeforeTruncation` to make sure the rows with the least visits are the ones that get removed.

Additionally, if your plugin provides metrics that should be aggregated together with an operation other than being `sum`-ed,
you will need to set the `$columnAggregationOps` property:

```
class MyRecordBuilder extends RecordBuilder
{
    public function __construct()
    {
        parent::__construct();
        
        // ...

        $this->columnAggregationOps = [
            'my_max_metric' => 'max',
            'my_min_metric' => 'min',
            'my_other_metric' => function ($thisValue, $otherValue) {
                // custom aggregation logic here
            },
        ];
    }
}
```

Note that each of these settings can also be overridden for specific records by setting the relevant property
on `Record` instances in your `getRecordMetadata()` method.

### Step five: if your RecordBuilder is parameterized, implement the relevant event

If your `RecordBuilder` is not parameterized then there's nothing else to do. You're done and Matomo will detect and use it.

If it is parameterized, then there's still one thing left to do. Matomo will not be able to automatically create a `RecordBuilder`
that takes parameters, so it must be added manually in the `Archiver.addRecordBuilders` event like so:

```
class MyPlugin
{
    public function registerEvents()
    {
        $hooks = [
            'Archiver.addRecordBuilders' => 'addRecordBuilders',
        ];
        return $hooks;
    }

    public function addRecordBuilders(array &$recordBuilders): void
    {
        $idSite = \Piwik\Request::fromRequest()->getIntegerParameter('idSite', 0);
        if (!$idSite) {
            return;
        }

        $entities = StaticContainer::get(MyEntityDao::class)->getAllEntitiesForSite($idSite);
        foreach ($entities as $entity) {
            $recordBuilders[] = new MyRecordBuilder($entity);
        }
    }
}
```

Here we create a `RecordBuilder` instance for every entity our plugin manages.

---

And that's it, your `RecordBuilder` is done.

## Advanced

### Overriding non-day period aggregation

Archiving for non-day periods is handled by the `buildForNonDayPeriod()` method, which
will use record metadata to query and aggregate records for the requested period's subperiods.

Normally, when creating a `RecordBuilder`, you will not need to interact with it. But, in
some rare cases, the default behavior of aggregating subperiods will not be enough.

In this case, it is perfectly acceptable to override the `buildForNonDayPeriod()` method
and implement your own logic.

If doing so, keep the following in mind:

* when querying for records of subperiods, do not query fetch all of them in memory at once.
  Record data can take up a significant amount of memory, and querying all the data at once here
  can cause out of memory errors for the archiving process. Instead, use a method like
  `Archive::querySingleBlob()` which uses a cursor.

* insert blob records via the `RecordBuilder::insertBlobRecord()` method. For numeric records,
  use `ArchiveProcessor::insertNumericRecords()`.
