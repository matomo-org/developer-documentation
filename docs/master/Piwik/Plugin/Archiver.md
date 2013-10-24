<small>Piwik\Plugin</small>

Archiver
========

The base class that should be extended by plugins that archive their own metrics.

Description
-----------

### Examples

**Extending Archiver**

    class MyArchiver extends Archiver
    {
        public function archiveDay()
        {
            $logAggregator = $this-&gt;getLogAggregator();
            
            $data = $logAggregator-&gt;queryVisitsByDimension(...);
            
            $dataTable = new DataTable();
            $dataTable-&gt;addRowsFromSimpleArray($data);

            $archiveProcessor = $this-&gt;getProcessor();
            $archiveProcessor-&gt;insertBlobRecords(&#039;MyPlugin_myReport&#039;, $dataTable-&gt;getSerialized(500));
        }
        
        public function archivePeriod()
        {
            $archiveProcessor = $this-&gt;getProcessor();
            $archiveProcessor-&gt;aggregateDataTableReports(&#039;MyPlugin_myReport&#039;, 500);
        }
    }

**Using Archiver in archiving events**

    // event observer for ArchiveProcessor.Day.compute
    public function archiveDay(ArchiveProcessor\Day $archiveProcessor)
    {
        $archiving = new Archiver($archiveProcessor);
        if ($archiving-&gt;shouldArchive()) {
            $archiving-&gt;archiveDay();
        }
    }

    // event observer for ArchiveProcessor.Period.compute
    public function archivePeriod(ArchiveProcessor\Period $archiveProcessor)
    {
        $archiving = new Archiver($archiveProcessor);
        if ($archiving-&gt;shouldArchive()) {
            $archiving-&gt;archivePeriod();
        }
    }


Methods
-------

The abstract class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`archiveDay()`](#archiveDay) &mdash; Archive data for a day period.
- [`archivePeriod()`](#archivePeriod) &mdash; Archive data for a non-day period.
- [`shouldArchive()`](#shouldArchive) &mdash; Returns true if the current plugin should be archived or not.

### `__construct()` <a name="__construct"></a>

Constructor.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$processing` ([`ArchiveProcessor`](../../Piwik/ArchiveProcessor.md))
- It does not return anything.

### `archiveDay()` <a name="archiveDay"></a>

Archive data for a day period.

#### Signature

- It is a **public abstract** method.
- It does not return anything.

### `archivePeriod()` <a name="archivePeriod"></a>

Archive data for a non-day period.

#### Signature

- It is a **public abstract** method.
- It does not return anything.

### `shouldArchive()` <a name="shouldArchive"></a>

Returns true if the current plugin should be archived or not.

#### Signature

- It is a **public** method.
- It returns a(n) `bool` value.

