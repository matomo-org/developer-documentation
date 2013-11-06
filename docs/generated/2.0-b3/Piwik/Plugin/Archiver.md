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


Properties
----------

This abstract class defines the following properties:

- [`$processor`](#$processor)

<a name="processor" id="processor"></a>
### `$processor`

#### Signature

- It is a(n) [`ArchiveProcessor`](../../Piwik/ArchiveProcessor.md) value.

Methods
-------

The abstract class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`aggregateDayReport()`](#aggregatedayreport) &mdash; Triggered when the archiving process is initiated for a day period.
- [`aggregateMultipleReports()`](#aggregatemultiplereports) &mdash; Archive data for a non-day period.
- [`getProcessor()`](#getprocessor)
- [`getLogAggregator()`](#getlogaggregator)

<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

- It accepts the following parameter(s):
    - `$processing` ([`ArchiveProcessor`](../../Piwik/ArchiveProcessor.md))
- It does not return anything.

<a name="aggregatedayreport" id="aggregatedayreport"></a>
### `aggregateDayReport()`

Triggered when the archiving process is initiated for a day period.

#### Description

Plugins that compute analytics data should create an Archiver class that descends from [Plugin\Archiver](#).

#### Signature

- It does not return anything.

<a name="aggregatemultiplereports" id="aggregatemultiplereports"></a>
### `aggregateMultipleReports()`

Archive data for a non-day period.

#### Signature

- It does not return anything.

<a name="getprocessor" id="getprocessor"></a>
### `getProcessor()`

#### Signature

- It returns a(n) [`ArchiveProcessor`](../../Piwik/ArchiveProcessor.md) value.

<a name="getlogaggregator" id="getlogaggregator"></a>
### `getLogAggregator()`

#### Signature

- It returns a(n) [`LogAggregator`](../../Piwik/DataAccess/LogAggregator.md) value.

