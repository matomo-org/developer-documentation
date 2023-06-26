<small>Piwik\Plugin\</small>

Archiver
========

The base class that should be extended by plugins that compute their own analytics data.

Descendants should implement the [aggregateDayReport()](/api-reference/Piwik/Plugin/Archiver#aggregatedayreport) and [aggregateMultipleReports()](/api-reference/Piwik/Plugin/Archiver#aggregatemultiplereports)
methods.

Both of these methods should persist analytics data using the [ArchiveProcessor](/api-reference/Piwik/ArchiveProcessor)
instance returned by [getProcessor()](/api-reference/Piwik/Plugin/Archiver#getprocessor). The [aggregateDayReport()](/api-reference/Piwik/Plugin/Archiver#aggregatedayreport) method should
compute analytics data using the [LogAggregator](/api-reference/Piwik/DataAccess/LogAggregator) instance
returned by [getLogAggregator()](/api-reference/Piwik/Plugin/Archiver#getlogaggregator).

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

This class defines the following properties:

- [`$ARCHIVE_DEPENDENT`](#$archive_dependent)

<a name="$archive_dependent" id="$archive_dependent"></a>
<a name="ARCHIVE_DEPENDENT" id="ARCHIVE_DEPENDENT"></a>
### `$ARCHIVE_DEPENDENT`

#### Signature

- Its type is not specified.


Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`aggregateDayReport()`](#aggregatedayreport) &mdash; Archives data for a day period.
- [`aggregateMultipleReports()`](#aggregatemultiplereports) &mdash; Archives data for a non-day period.
- [`getProcessor()`](#getprocessor) &mdash; Returns a [ArchiveProcessor](/api-reference/Piwik/ArchiveProcessor) instance that can be used to insert archive data for the period, segment and site we are archiving data for.
- [`getLogAggregator()`](#getlogaggregator) &mdash; Returns a [LogAggregator](/api-reference/Piwik/DataAccess/LogAggregator) instance that can be used to aggregate log table rows for this period, segment and site.
- [`disable()`](#disable)
- [`isEnabled()`](#isenabled) &mdash; Whether this Archiver should be used or not.
- [`shouldRunEvenWhenNoVisits()`](#shouldrunevenwhennovisits) &mdash; By overwriting this method and returning true, a plugin archiver can force the archiving to run even when there was no visit for the website/date/period/segment combination (by default, archivers are skipped when there is no visit).
- [`getDependentSegmentsToArchive()`](#getdependentsegmentstoarchive) &mdash; Returns a list of segments that should be pre-archived along with the segment currently being archived.
- [`doesPluginHaveRecordBuilders()`](#doespluginhaverecordbuilders)

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

-  It accepts the following parameter(s):
    - `$processor` ([`ArchiveProcessor`](../../Piwik/ArchiveProcessor.md)) &mdash;
      
    - `$pluginName` (`string`|`null`) &mdash;
      

<a name="aggregatedayreport" id="aggregatedayreport"></a>
<a name="aggregateDayReport" id="aggregateDayReport"></a>
### `aggregateDayReport()`

Archives data for a day period.

Implementations of this method should do more computation intensive activities such
as aggregating data across log tables. Since this method only deals w/ data logged for a day,
aggregating individual log table rows isn't a problem. Doing this for any larger period,
however, would cause performance degradation.

Aggregate log table rows using a [LogAggregator](/api-reference/Piwik/DataAccess/LogAggregator) instance. Get a
[LogAggregator](/api-reference/Piwik/DataAccess/LogAggregator) instance using the [getLogAggregator()](/api-reference/Piwik/Plugin/Archiver#getlogaggregator) method.

#### Signature

- It does not return anything or a mixed result.

<a name="aggregatemultiplereports" id="aggregatemultiplereports"></a>
<a name="aggregateMultipleReports" id="aggregateMultipleReports"></a>
### `aggregateMultipleReports()`

Archives data for a non-day period.

Implementations of this method should only aggregate existing reports of subperiods of the
current period. For example, it is more efficient to aggregate reports for each day of a
week than to aggregate each log entry of the week.

Use [ArchiveProcessor::aggregateNumericMetrics()](/api-reference/Piwik/ArchiveProcessor#aggregatenumericmetrics) and [ArchiveProcessor::aggregateDataTableRecords()](/api-reference/Piwik/ArchiveProcessor#aggregatedatatablerecords)
to aggregate archived reports. Get the [ArchiveProcessor](/api-reference/Piwik/ArchiveProcessor) instance using the [getProcessor()](/api-reference/Piwik/Plugin/Archiver#getprocessor)
method.

#### Signature

- It does not return anything or a mixed result.

<a name="getprocessor" id="getprocessor"></a>
<a name="getProcessor" id="getProcessor"></a>
### `getProcessor()`

Returns a [ArchiveProcessor](/api-reference/Piwik/ArchiveProcessor) instance that can be used to insert archive data for
the period, segment and site we are archiving data for.

#### Signature

- It returns a [`ArchiveProcessor`](../../Piwik/ArchiveProcessor.md) value.

<a name="getlogaggregator" id="getlogaggregator"></a>
<a name="getLogAggregator" id="getLogAggregator"></a>
### `getLogAggregator()`

Returns a [LogAggregator](/api-reference/Piwik/DataAccess/LogAggregator) instance that can be used to aggregate log table rows
for this period, segment and site.

#### Signature

- It returns a [`LogAggregator`](../../Piwik/DataAccess/LogAggregator.md) value.

<a name="disable" id="disable"></a>
<a name="disable" id="disable"></a>
### `disable()`

#### Signature

- It does not return anything or a mixed result.

<a name="isenabled" id="isenabled"></a>
<a name="isEnabled" id="isEnabled"></a>
### `isEnabled()`

Whether this Archiver should be used or not.

#### Signature

- It returns a `bool` value.

<a name="shouldrunevenwhennovisits" id="shouldrunevenwhennovisits"></a>
<a name="shouldRunEvenWhenNoVisits" id="shouldRunEvenWhenNoVisits"></a>
### `shouldRunEvenWhenNoVisits()`

By overwriting this method and returning true, a plugin archiver can force the archiving to run even when there
was no visit for the website/date/period/segment combination
(by default, archivers are skipped when there is no visit).

#### Signature

- It returns a `bool` value.

<a name="getdependentsegmentstoarchive" id="getdependentsegmentstoarchive"></a>
<a name="getDependentSegmentsToArchive" id="getDependentSegmentsToArchive"></a>
### `getDependentSegmentsToArchive()`

Returns a list of segments that should be pre-archived along with the segment currently being archived.

The segments in this list will be added to the current segment via an AND condition and archiving
for the current plugin will be launched. This process will not recurse further.

If your plugin's API appends conditions to the requested segment when fetching data, you will want to
use this method to make sure those segments get pre-archived. Otherwise, if browser archiving is disabled,
the modified segments will appear to have no data.

To archive another plugin, use an array instead of a string segment, for example:

```
['plugin' => 'VisitsSummary', 'segment' => '...']
```

See the Goals and VisitFrequency plugins for examples.

#### Signature

- It returns a `array` value.

<a name="doespluginhaverecordbuilders" id="doespluginhaverecordbuilders"></a>
<a name="doesPluginHaveRecordBuilders" id="doesPluginHaveRecordBuilders"></a>
### `doesPluginHaveRecordBuilders()`

#### Signature

-  It accepts the following parameter(s):
    - `$pluginName` (`string`) &mdash;
      
- It returns a `bool` value.

