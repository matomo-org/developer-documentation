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
- [`aggregateDayReport()`](#aggregatedayreport) &mdash; Archives data for a day period.
- [`aggregateMultipleReports()`](#aggregatemultiplereports) &mdash; Archives data for a non-day period.

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

- It accepts the following parameter(s):
    - `$aggregator` ([`ArchiveProcessor`](../../Piwik/ArchiveProcessor.md)) &mdash; The ArchiveProcessor instance sent to the archiving event observer.

<a name="aggregatedayreport" id="aggregatedayreport"></a>
<a name="aggregateDayReport" id="aggregateDayReport"></a>
### `aggregateDayReport()`

Archives data for a day period.

#### Description

Implementations of this method should do more computation intensive activities such
as aggregating data across log tables. Since this method only deals w/ data logged for a day,
aggregating individual log table rows isn't a problem. Doing this for any larger period,
however, would cause performance issues.

Aggregate log table rows using a instance. Get a {@link Piwik\DataAccess\LogAggregator instance
using the getLogAggregator() method.

#### Signature

- It does not return anything.

<a name="aggregatemultiplereports" id="aggregatemultiplereports"></a>
<a name="aggregateMultipleReports" id="aggregateMultipleReports"></a>
### `aggregateMultipleReports()`

Archives data for a non-day period.

#### Description

Implementations of this method should only aggregate existing reports of subperiods of the
current period. For example, it is more efficient to aggregate reports for each day of a
week than to aggregate each log entry of the week.

Use and {@link Piwik\ArchiveProcessor::aggregateDataTableRecords()
to aggregate archived reports. Get the instance using the {@link getProcessor().

#### Signature

- It does not return anything.

