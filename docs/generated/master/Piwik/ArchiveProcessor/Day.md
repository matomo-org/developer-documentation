<small>Piwik\ArchiveProcessor</small>

Day
===

Initiates the archiving process for **day** periods via the [ArchiveProcessor.Day.compute](#) event.


Methods
-------

The class defines the following methods:

- [`getMetricsForDimension()`](#getMetricsForDimension) &mdash; Helper function that returns an array with common statistics for a given database field distinct values.

### `getMetricsForDimension()` <a name="getMetricsForDimension"></a>

Helper function that returns an array with common statistics for a given database field distinct values.

#### Description

The statistics returned are:
 - number of unique visitors
 - number of visits
 - number of actions
 - maximum number of action for a visit
 - sum of the visits&#039; length in sec
 - count of bouncing visits (visits with one page view)

For example if $dimension = &#039;config_os&#039; it will return the statistics for every distinct Operating systems
The returned array will have a row per distinct operating systems,
and a column per stat (nb of visits, max  actions, etc)

&#039;label&#039;    Metrics::INDEX_NB_UNIQ_VISITORS    Metrics::INDEX_NB_VISITS    etc.
Linux    27    66    ...
Windows XP    12    ...
Mac OS    15    36    ...

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$dimension`
- It returns a(n) `Piwik\DataArray` value.

