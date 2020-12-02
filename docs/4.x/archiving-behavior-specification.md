---
category: API Reference
---

# Archiving Behavior Specification

This page lists all expected behavior of the internal report aggregation and storing mechanism (archiving)
and the expected behavior of the `core:archive` command (the cron archiving process).
It serves as a reference since the number of cases to think about is too high to keep in ones head and as
a jumping off point for manual testing of the whole process.

It will be added to over time, since this process in Matomo is especially complex.

## Core Archiving

_Brief Description of system:_ the entry point for this is the `Piwik\Archive` class which handles both querying
for archive data, and launching the report aggregation process if archive data isn't found. `Piwik\ArchiveProcessor\Loader`
is in charge of determining if archiving should be done and then launching the whole process. `PluginsArchiver` is
the entrypoint for report aggregation.

### General Expected Behavior

API methods use the `Piwik\Archive` class to query for archive data. If we are allowed to archive in the current
request/process, and cannot find a recent, usable archive, we generate it.

### Settings

* browser triggered archiving: TODO
* today time to live: this value is the number of seconds before which an archive for today's date is considered valid. If an
  archive is older than this value, then it is considered outdated. Controlled by a UI setting and the
  `[General] time_before_today_archive_considered_outdated` INI config option. This is also used as the default value
  for archives for other periods.
* `[General] time_before_week_archive_considered_outdated`, `[General time_before_month_archive_considered_outdated]`,
  `[General] time_before_year_archive_considered_outdated`, `[General] time_before_range_archive_considered_outdated`:
  specific ttls for different period types, defaults to 'today time to live' value if not specified
* TODO

### Rules

**When archiving is allowed/disallowed for the current process**

TODO

### Special Query Parameter Handling

* `trigger`: if set to `archivephp`, let's the core archiving process know it was launched by the `core:archive` command.
  The archiving process will only assume this if the current request also has superuser access loaded.
* `skipArchiveSegmentToday`: if set and launching archiving is enabled for the current request, then `Archive.php` will
  skip the archiving of segment archives for today's date, if there are any in the request. (It will also skip querying this data as well.)
* TODO

### Concurrency

**Processing multiple archives at the same time**

This is not desired behavior, we prefer if only one process creates a single archive, but sometimes multiple requests
 will trigger archiving at the same time (this is only an issue for setups that enable browser triggered archiving).

When this happens, it is expected that both will aggregate the same data, and one will finish after the other, giving
it a greater `ts_archived` value. This archive is the one that ends up being used; the duplicate gets cleaned up in a
scheduled task.

**When a site is deleted during archiving**

TODO

## core:archive command

_Brief Description of system:_ The `core:archive` command is meant to be run as a cron job periodically archiving data
based on a queue. The queue that controls what archives get launched is the `archive_invalidations` table. `core:archive`
will both, insert into this table before processing each site and process the entries, launching the archiving process
for each valid entry.

### General Expected Behavior

**invalidating today & yesterday archives**

TODO

**invalidating custom ranges**

TODO

**invalidating queued invalidations**

TODO

**invalidations are inserted after archiving for a site begins**

TODO

**site is deleted during invalidation or archiving**

TODO

**an archiving run fails**

TODO

**an archiving run fails, sites are deleted, the archiver starts again**

TODO

**duplicate invalidations are found in the archive_invalidations table**

TODO

### Command Line Options

`--skip-segments-today`: TODO
`--force-periods`: TODO
``