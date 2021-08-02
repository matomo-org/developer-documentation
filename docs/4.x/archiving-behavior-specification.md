---
category: API Reference
---

# Archiving Behavior Specification

This page lists all expected behavior of the internal report aggregation and storing mechanism (archiving)
and the expected behavior of the `core:archive` command (the cron archiving process).
It serves as a reference since the number of cases to think about is too high to keep in ones head, and as
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

* browser triggered archiving: this setting determines whether log aggregation is allowed to be launched from browser requests.
  If disabled, this only happens if a segment that is not set to auto-archive is requested (referred to as a custom segment), or
  if a range period is requested. The setting is stored in two potential places, the `[General] enable_browser_archiving_triggering`
  INI config setting or the `enableBrowserTriggerArchiving` option value. There are other related INI config settings to disable archiving even if
  a custom segment or range period is requested: `[General] browser_archiving_disabled_enforce` and `[General] archiving_range_force_on_browser_request`
  respectively.
  In the code, the `Rules::isBrowserTriggerEnabled()` checks for this setting.
* today time to live: this value is the number of seconds before which an archive for today's date is considered valid. If an
  archive is older than this value, then it is considered outdated. Controlled by a UI setting and the
  `[General] time_before_today_archive_considered_outdated` INI config option. This is also used as the default value
  for archives for other periods.
* `[General] time_before_week_archive_considered_outdated`, `[General time_before_month_archive_considered_outdated]`,
  `[General] time_before_year_archive_considered_outdated`, `[General] time_before_range_archive_considered_outdated`:
  specific ttls for different period types, defaults to 'today time to live' value if not specified
* custom date ranges to pre-process: there is an INI config setting and some user settings that allow users to specify that
  certain ranges should be pre-archived. The INI setting is `[General] archiving_custom_ranges`. The user setting is the
  setting that controls the default period to load in Matomo.

### Rules

**When archiving is allowed/disallowed for the current process**

If browser archiving is enabled, any HTTP request or CLI command can initiate archiving. Things are more complicated
if browser archiving is disabled:

- If the request is for a range period, and `[General] archiving_range_force_on_browser_request` is absent or set to 1,
  then the request will always be allowed to initiate archiving.
- If the request is triggered by the core:archive command, then it will always be allowed to initiate archiving. We assume
  that core:archive initiated the request if the `trigger` query parameter is set to `archivephp` and the user has superuser
  access.
- If we are archiving reports for a single plugin (either because it is forced during the core:archive command, or 
  the request is for a segment that isn't marked as pre-processed), then the request will always be allowed to initiate
  archiving...
  - unless, the reason we are archiving a single plugin is because the request is for a segment and
    `[General] browser_archiving_disabled_enforce` is set to 1.

**Optimizations that skip archiving**

_When there are no visits_

In certain situations, Matomo will be able to tell it does not have to archive and will skip it for a site and period.
This is generally because the site has no visits for that period, and we are able to easily tell.

The specific logic is in `Loader::canSkipThisArchive()`. If a website/period pair is:

- has no visits in the log tables for the period
- and has no subperiod archive within the period (ie, if we're looking at a week and there are no day archives for that week, this would be true)

We know we'd end up with zero visits if we archive, so we can just skip it. The only exceptions are for sites that do
not use the tracker (so there will always be zero visits in the log table) or are specified via the `'Archiving.getIdSitesToArchiveWhenNoVisits'`
event. RollUp websites are examples of sites for which this optimization does not apply.

This optimization is used both before launching the archive aggregation logic and in the `core:archive` command
before we launch individual archive requests. This saves a bit more time since we also don't have to launch an
archiving command.

### Special Query Parameter Handling

* `trigger`: if set to `archivephp`, let's the core archiving process know it was launched by the `core:archive` command.
  The archiving process will only assume this if the current request also has superuser access loaded.
* `skipArchiveSegmentToday`: if set and launching archiving is enabled for the current request, then `Archive.php` will
  skip the archiving of segment archives for today's date, if there are any in the request. (It will also skip querying this data as well.)
* `plugin`: If we want to initiate archiving for a specific plugin, this parameter specifies the name of the plugin to launch
  archiving for. If we want to force archiving of ONLY this plugin and not the all plugins archive, `pluginOnly=1` must also be set.
* `pluginOnly`: this query parameter is sent when processing one or more reports within a specific plugin and no others. It is only used
  during the core:archive command, so if `trigger` is not set to `archivephp` it is ignored. This query parameter is used
  when a user or something in the system invalidates the reports for a plugin. When processing it, we don't want to process anything else,
  so we make sure `pluginOnly` is set to `1`.
* `requestedReport`: If we only want to process a specific report within a plugin and not the entire plugin, this parameter is
  set to the name of the report. This will be set as the requested report in the ArchiveProcessor\Params instance that is passed
  to a plugin's Archiver instance. If the archiver supports partial archiving, it will handle it and a partial archive will be
  created, with the report archive in it only. This must be set in combination with `plugin` and `pluginOnly`.

## core:archive command

_Brief Description of system:_ The `core:archive` command is meant to be run as a cron job periodically archiving data
based on a queue. The queue that controls what archives get launched is the `archive_invalidations` table. `core:archive`
will both: insert into this table before processing each site and process the entries, launching the core archiving process
for each valid entry.

### Range Archiving vs All Others

By default when using core:archive, day, week, month & year periods are not processed in the browser. Range periods
on the other hand are still processed from web requests. This is because we cannot pre-archive every possible permutation
of dates that users can specify.

Instead when a range period is no longer considered up-to-date (it's TTL expires), we launch archiving for the range.
Since the range just aggregates day periods, this is still performant, as long as archiving for the days is not launched.

### Launching the core archiving process

The core:archive command launches the core archiving process through new processes, which allows it to achieve concurrency.
If it's supported by the OS configuration and PHP runtime configuration, these processes are CLI processes spawned through
`shell_exec()` running the `climulti:request` command. The `climulti:request` command takes a query string and processes it
like it is an API request.

If it's not supported, then we use CURL multi requests. CURL is not as fast as launching cli processes, so we prefer to use
`climulti:request`.

In each case, we call the `CoreAdminHome.archiveReports` API method which launches core archiving.
Note: previously the core:archive command would query `API.get` which would implicitly trigger the archiving process.

The request URI will always have `trigger=archivephp` which, when superuser access is granted as is the case during archiving,
will force the archiving process to initiate.

**Batching Archive Jobs**

In the core:archive command, we try and process multiple archives at the same time to make the process more performant. The
number of concurrent processes to run at a time is specified by the `--concurrent-requests-per-website` CLI option.

Archive jobs for different sites are never run concurrently from within the same `core:archive` process. Sites can be
archived concurrently but this is only possible by running multiple `core:archive` commands.

**Order of Execution**

Some archive invalidations have to be handled before others. Specifically:

- the "All Visits" segment is run before individual segments for a period.
- periods are run in ascending order: day periods are run before weeks that contain them
- invalidations are processed in descending order of start date. So the day starting on 07-26-2021 will run before
  the week on 07-26-2021, and both will run after the day starting on 07-27-2021.

**Multiple core:archive instances**

As mentioned above, multiple core:archive commands can be launched in order to process sites in parallel. These runs
do not have to be on the same server.

When a core:archive instance wants to run archiving for a site, the SharedSiteIds class is used. This class manages
a list of site IDs in an `option`. The process pulls a site ID and removes it from the list, then starts processing it.

Another core:archive process may then take the next site and process that one in parallel.

If `--force-idsites` is used, core:archive will not use SharedSiteIds but FixedSiteIds. This class has no knowledge of
SharedSiteIds, so it is possible by using this we can launch archiving for the same site multiple times in parallel,
which is generally something we want to avoid.

### General Expected Behavior

**invalidating today & yesterday archives**

`core:archive` will automatically invalidate the archives for `today` and `yesterday` if certain criteria are met.

For `today`, the archive will be automatically invalidated if there are visits for today and if the existing archive is
older than the configured TTL (see [the previous section on archiving settings](#settings)).

For `yesterday`, the archive will be automatically invalidated if the current date is a different day than the `ts_archived`
date for the latest archive for `yesterday`. If this is true, it means the day has changed since the archive was processed,
and there may be more visits to process. For example, the last known archive for 2021-05-20 is calculated at 2021-05-20 20:00:00,
but it is now 2021-05-21 00:30:00, and there may be visits between those two times to process.

**invalidating custom ranges**

If custom ranges are specified in the `[General] archiving_custom_ranges` INI config setting and/or
the default period to load in Matomo is configured to be a range, they will be invalidated and
rearchived during `core:archive`.

**queued invalidations**

Archives that are invalidated from system functions, for example, invalidating past data when a segment or entity changes, are
not immediately inserted into the archive_invalidations table. Instead they are added to an option via the `ReArchiveList` class.

This is done so UI functions like updating a segment are not slowed by the insertion of rows into the archive_invalidations table.

Before core:archive runs for a specific site, it will process entries in the ReArchiveList option and add the invalidations to the table.
They are then processed all at once with others.

**when processing a single archive fails**

core:archive detects when the core archiving process fails when it cannot parse the output of a climulti:request command or
an archiving curl request. When this occurs, the invalidation being processed's status is reset to 0, so it will be picked up
again. BUT we also take note of the idinvalidation and skip it for the rest of the current core:archive run. In case the problem
is persistent, we don't want to continuously run a failing job.

Note: we currently don't try to retry the job, since archiving jobs are usually compute intensive, and generally do not fail
randomly. Retrying would thus be a waste of resources.

**if the core:archive process is terminated in the middle of processing an archive**

If the entire core:archive process is terminated during the processing of an invalidation, we cannot unset the status back
to 0. So in the next core:archive run, we will think the job is still running.

We get around this by assuming all jobs that are older than 24 hours have stalled or failed. Before processing a site we set
all such invalidations' status to 1.

We detect the age of an in-progress invalidation by looking at the ts_started column. Before an archiving job is run, the
associated invalidation's ts_started column is set to the start time (this is done at the same time `status` is set to 1).

**an archiving run fails, the sites whose archives failed are deleted, and the archiver starts again**

In this case, an archiving run fails leaving invalidations in the archive_invalidations table. The sites for those invalidations
are then deleted, then another core:archive command runs.

This new run should ignore the invalidations in the archive_invalidations table. Currently this occurs because we process
archives for one site at a time. If the site to archive has been deleted, we will not see it.

**duplicate invalidations are found in the archive_invalidations table**

Duplicate invalidations are disallowed when inserting through ArchiveInvalidator. We specifically look for existing
invalidations before inserting. However, certain edge cases can allow duplicates to exist. It's also possible for other
code or users to end up inserting data into those tables.

Duplicates are detected during processing by QueueConsumer. Because of the ordering imposed when we select the next
archive to execute, duplicate archives will be right next to each other. We'll encounter one right after the other.

Since we look for a batch of archives to run, we'll keep looking for invalidations before starting a set of archive jobs.
After each query for the next invalidated archive, we'll check in the batch if there's a duplicate, and if so, we skip the
current one and query again.

Note, there is a currently unhandled edge case: if the last job in a batch has duplicates, at least one of the other
duplicates will also be run, because we won't query for those invalidations until the first batch finishes. Duplicates
are an edge case to begin with so we haven't handled this.

**how and when the ttl is checked**

Each period type has an associated TTL that is sometimes used to check if an archive is still valid. These TTLs are only
used if certain prerequisites are true:

- if the period is not a range and includes today, then it is used. We assume today will get new visits so we make sure
  archives containing today are always eventually reprocessed. For data that is tracked in the past, we invalidate the period
  when this occurs. We don't do this for today, because invalidating data for every visit encountered today would make
  the tracker far less performant. Tracking data in the past, however, does not happen with nearly has high frequency or
  volume.

- if the period is a range, then we always recompute it when it is no longer valid. This is because ranges are just two
  arbitrary dates. We cannot preprocess every single permutation during core:archive, so instead we launch the archiving process
  in browser requests when the ttl expires. Since range archives just aggregate day periods together, and we don't launch
  archiving for those days, this is still performant.

The TTLs are determined by user and config settings. The day period can be specific in the UI in the System Settings page
and through INI config. The other periods can have custom TTLs in INI config as well, but not in the UI.

If no custom TTL is specified for a non-day period, it defaults to the day TTL.

**archiving today/yesterday**

Every run of core:archive will try to invalidate the today period for each site. This is because we assume people will be
visiting them and there will generally be more data. We do check if there are no new visits within last time core:archive
was run and now, if there were not for the site then we don't follow through with the invalidation.

If there is also a usable archive within the day period's TTL, we skip archiving. So if the TTL is 6 hours, but we run core:archive
every hour, we will still only process the day archive again every 6 hours.

Also before starting archiving for a site, we will check if we need to invalidate the yesterday period as well. This is only
done if the day has changed since the last core:archive run. In that case, there may have been visits between the last archive
run and midnight. If we were to only invalidate today, we would ignore those visits.

So in this case, we invalidate yesterday's periods and they will be reprocessed (but only if there actually have been visits
between the last run time and midnight).

**amount of concurrency to expect**

In general, we can expect that individual core:archive processes will not process multiple sites at the same time. It is
however possible to achieve this by using `--force-idsites`. And unfortunately, users will use it. So while we don't need
the system to be performant when the same site is archived in parallel by multiple archivers, we need to be sure it won't
fail or insert strange report data.

That said, it is also possible for it to happen in a normal situation with SharedSiteIds, since the implementation is not
entirely thread-safe, though this should be a rare case.

Concerning the other level of concurrency within QueueConsumer, there isn't much to think about, since the system
makes sure that only the archives that are meant to be archived in parallel run together. However, when multiple core:archive
commands process the same site at the same time, it can be worth thinking about.

From within QueueConsumer we will also check the running process list to make sure that archives with intersecting periods are
not processed together. This keeps us, for example, from launching a day period archive if another core:archive process on the
same server is processing the month the day is containing. This does not, however, stop the same thing from happening if
core:archive is running on a separate server.

This is however only an issue when multiple archivers process the same site.

### Re-archiving of past data for new or updated segments

When a segment is created or updated, we make sure to re-archive the last several months of data for them, so
that data will appear for users. If we didn't, the data would be archived in the yearly archive for the current day,
which means it may not be much data if the current day is close to the beginning of the year, and could also mean
a much larger archiving request than just archiving days, weeks, months, years in that order for the segment.

We do this by checking if the segment created time or updated time is newer than the last time we invalidated archives
in core:archive. If it is, we know we have missing or out of date data for a segment, and we have to re-archive.

The segment created/updated time is stored in the `segment` table. The last invalidation time is stored in the
`CronArchive.lastInvalidationTime` option.

### Concurrency

**Processing multiple archives at the same time**

This is not desired behavior, we prefer if only one process creates a single archive, but sometimes multiple requests
will trigger archiving at the same time (this is only an issue for setups that enable browser triggered archiving).

When this happens, it is expected that both will aggregate the same data, and one will finish after the other, giving
it a greater `ts_archived` value. This archive is the one that ends up being used; the duplicate gets cleaned up in a
scheduled task during archive purging.

**When a site is deleted during archiving**

If a site is deleted while data for it is being archived, the archiver should handle it gracefully,
without erroring. If it happens while data is being aggregated, the data will finish being archived, then
the `core:archive` command should notice the site no longer exists, and move on to the next one. The archive
data will eventually be deleted in a scheduled task.

**When invalidations are inserted by another process after archiving for a site begins**

It's possible that while archiving is ongoing for a site, new invalidations will be inserted into the archive_invalidations
table. These invalidations will be ignored by QueueConsumer until the next core:archive run.

This is achieved by the following behavior:
- in QueueConsumer before we start processing invalidations for a site, we record the start time
- when getting the next invalidation to process, we only select invalidations where ts_invalidated < the archiving start time

If an invalidation is added after the start time, we ignore it. Ignoring these new invalidations avoids some unpredictable behavior,
since it is important the order in which archives are processed (for example, days before weeks and "All Visits" before segments, etc.).

**When a site is deleted during invalidation or archiving**

Invalidations for a deleted site will eventually be removed by a scheduled task in the CoreHome plugin, but before it runs,
they will still be in the archive_invalidations table. If this happens while archiving runs for a site, we run into an issue
where we may process archives for a deleted site.

In this case we'll just process the archive data. The inserted reports will just be deleted, but since this is a
rare occurrence, this is considered acceptable.

### Important Command Line Options

* `--force-idsites`: This option allows forcing the core:archive instance to process the specified sites. This option is worth noting since
                     it can result in multiple core:archive instances archiving for the same site.
* `--force-periods`: This option allows forcing the archiving of a specific period. It can be dangerous to use, since it will initiate archiving
                     of a higher period, even if a lower period is queued to archive first.
* `--force-date-range`: This option allows forcing to only archive data whose entire period range does not fall within the range. This can be
                        dangerous to use in the same way --force-periods is.
* `--skip-segments-today`: If specified, the today period for segments will not be archived, as long as the segment was not modified within
                           the last 24 hours.
* `--concurrent-requests-per-website`: Controls the maximum number of concurrent archiving requests that are launched at a time, for a single
                                       website.
* `--concurrent-archivers`: The maximum number of core:archive commands that should be running in parallel on a single server. This does not
                            affect archivers running on other servers.
* `--force-all-websites`: Like `--force-idsites` but for every website in Matomo.

## Archive Invalidation

Archive invalidation happens as a part of the `core:archive` command and is also triggered immediately before core archiving
if browser triggered archiving is enabled. These sources of invalidation are from Matomo automatically issuing invalidations.

It can also be invoked by the user through the `core:invalidate-report-data` command and through the InvalidateReports plugin.

### Expected Behavior

**automated triggering of archive invalidations**

* When tracking data in the past, the periods the data belong to are scheduled to be invalidated. They are not immediately
  invalidated to avoid having to add extra queries to the tracker. The periods to invalidate are stored in option values
  and eventually `core:archive` or the core archiving system will process them.
  
  See methods in `ArchiveInvalidator` named like `rememberToInvalidateArchivedReportsLater()` to see the details of how this
  is implemented.

* When certain entities are changed or created, for example, segments, funnels or custom reports, Matomo will rearchive past
  data to update these reports. The rearchiving is initiated through invalidating the old archive data.

**what specifically gets invalidated**

When a period is invalidated, all higher periods are automatically invalidated (because if the lower period's metrics change,
the existing higher periods are no longer accurate).

If the `cascade` option is specified when invoking `ArchiveInvalidator` (or the invalidation command), child periods of
the given period will also be invalidated. So if a week is to be invalidated, the days within the week would also be invalidated.

When invalidating 'All Visits' archives, all segment archives and plugin specific archives are effectively invalidated as well.
When invalidating a segment archive, plugin specific archives for the segment will be invalidated as well.
This behavior is due to how we look for archives to invalidate in DataAccess/Model.php. We compute the done flag name of the archive
to invalidate, then look for archives with a `name LIKE '...doneflag...%'`.

**invalidating in archive tables vs. inserting into the archive_invalidations table**

The invalidation process "invalidates" in two ways. The first is marking archive status entries in the archive_numeric tables
as having a done value of `DONE_INVLAIDATED`. This marks the archive as having out of date data.

If browser triggered archiving is enabled, and a `DONE_INVALIDATED` archive is encountered, it will be rearchived.

The second thing that is done, is inserting an entry into the archive_invalidations table. This tells the core:archive process that
the archive needs to be reprocessed.

Everything that is invalidated in the archive tables shoul1:d also appear in the archive_invalidations table, except for
plugin specific archives. Since we end up triggering archiving for the all plugins archiving, we don't need to re-create
invalidated plugin specific archives. The only time plugin specific archives are inserted into the archive_invalidations table,
is if we are only invalidating a specific plugin's archive.