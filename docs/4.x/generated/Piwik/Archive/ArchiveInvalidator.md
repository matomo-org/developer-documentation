<small>Piwik\Archive\</small>

ArchiveInvalidator
==================

Service that can be used to invalidate archives or add archive references to a list so they will be invalidated later.

Archives are put in an "invalidated" state by setting the done flag to `ArchiveWriter::DONE_INVALIDATED`.
This class also adds the archive's associated site to the a distributed list and adding the archive's year month to another
distributed list.

CronArchive will reprocess the archive data for all sites in the first list, and a scheduled task
will purge the old, invalidated data in archive tables identified by the second list.

Until CronArchive, or browser triggered archiving, re-processes data for an invalidated archive, the invalidated
archive data will still be displayed in the UI and API.

### Deferred Invalidation

Invalidating archives means running queries on one or more archive tables. In some situations, like during
tracking, this is not desired. In such cases, archive references can be added to a list via the
rememberToInvalidateArchivedReportsLater method, which will add the reference to a distributed list

Later, during Piwik's normal execution, the list will be read and every archive it references will
be invalidated.

Methods
-------

The class defines the following methods:

- [`reArchiveReport()`](#rearchivereport) &mdash; Schedule rearchiving of reports for a single plugin or single report for N months in the past.

<a name="rearchivereport" id="rearchivereport"></a>
<a name="reArchiveReport" id="reArchiveReport"></a>
### `reArchiveReport()`

Schedule rearchiving of reports for a single plugin or single report for N months in the past. The next time
core:archive is run, they will be processed.

#### Signature

-  It accepts the following parameter(s):
    - `$idSites` (`int[]`|`string`) &mdash;
       A list of idSites or 'all'
    - `$plugin` (`string`) &mdash;
      
    - `$report` (`string`) &mdash;
      
    - `$lastNMonthsToInvalidate` (`string`) &mdash;
       eg, last12
- It does not return anything or a mixed result.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

