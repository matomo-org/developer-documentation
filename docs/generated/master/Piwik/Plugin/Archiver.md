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

<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$processing` ([`ArchiveProcessor`](../../Piwik/ArchiveProcessor.md))
- It does not return anything.

<a name="aggregatedayreport" id="aggregatedayreport"></a>
### `aggregateDayReport()`

Triggered when the archiving process is initiated for a day period.

#### Description

Plugins that compute analytics data should create an Archiver class that descends from [Plugin\Archiver](#).

#### Signature

- It is a **public abstract** method.
- It does not return anything.

<a name="aggregatemultiplereports" id="aggregatemultiplereports"></a>
### `aggregateMultipleReports()`

Archive data for a non-day period.

#### Signature

- It is a **public abstract** method.
- It does not return anything.

<a name="shouldarchive" id="shouldarchive"></a>
### `shouldArchive()`

Returns true if the current plugin should be archived or not.

#### Signature

- It is a **public** method.
- It returns a(n) `bool` value.

