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
        public function aggregateDayReport()
        {
            $logAggregator = $this->getLogAggregator();
            
            $data = $logAggregator->queryVisitsByDimension(...);
            
            $dataTable = new DataTable();
            $dataTable->addRowsFromSimpleArray($data);

            $archiveProcessor = $this->getProcessor();
            $archiveProcessor->insertBlobRecords('MyPlugin_myReport', $dataTable->getSerialized(500));
        }
        
        public function aggregateMultipleReports()
        {
            $archiveProcessor = $this->getProcessor();
            $archiveProcessor->aggregateDataTableRecords('MyPlugin_myReport', 500);
        }
    }


Methods
-------

The abstract class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`aggregateDayReport()`](#aggregateDayReport) &mdash; Triggered when the archiving process is initiated for a day period.
- [`aggregateMultipleReports()`](#aggregateMultipleReports) &mdash; Archive data for a non-day period.
- [`shouldArchive()`](#shouldArchive) &mdash; Returns true if the current plugin should be archived or not.

### `__construct()` <a name="__construct"></a>

Constructor.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$processing` ([`ArchiveProcessor`](../../Piwik/ArchiveProcessor.md))
- It does not return anything.

### `aggregateDayReport()` <a name="aggregateDayReport"></a>

Triggered when the archiving process is initiated for a day period.

#### Description

Plugins that compute analytics data should create an Archiver class that descends from [Plugin\Archiver](#).

#### Signature

- It is a **public abstract** method.
- It does not return anything.

### `aggregateMultipleReports()` <a name="aggregateMultipleReports"></a>

Archive data for a non-day period.

#### Signature

- It is a **public abstract** method.
- It does not return anything.

### `shouldArchive()` <a name="shouldArchive"></a>

Returns true if the current plugin should be archived or not.

#### Signature

- It is a **public** method.
- It returns a(n) `bool` value.

