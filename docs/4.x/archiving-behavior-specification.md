---
category: API Reference
---

# Archiving Behavior Specification

This page describes all the behavior of the internal report aggregation and storing mechanism (archiving)
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
request/process, and cannot find a recent, usable archive, we generate it, by launching the core archiving process.

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
  specific ttls for different period types. They each default to the 'today time to live' value if not specified
* custom date ranges to pre-process: there is an INI config setting and some user settings that allow users to specify that
  certain ranges should be pre-archived. The INI setting is `[General] archiving_custom_ranges`. The user setting is the
  setting that controls the default period to load in Matomo. These ranges will be processed in core:archive if specified.

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
  skip the archiving of segment archives for today's date, if there are any in the request. (It will also skip querying this data as well,
  so the result for that data will be empty.)
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

### PHP Classes

The following classes are involved in the Core Archiving process:

- **Piwik\Archive**: entry point for archive data queries. This is used by API methods to get numeric and blob data by site ID and/or period.
  If we can't find up to date data for an archive data query, and the current request is allowed to start the core archiving process, we
  initiate archiving. This class will call the CoreAdminHome.archiveReports API method to do so.
- **Piwik\Loader**: entry point for the core archiving process. The `prepareArchive()` method is invoked directly by CoreAdminHome.archiveReports.
  This class is used to look for one individual archive (so for one site and one period). If we can't find a usable one, we launch the core
  archiving process.
  
  This process involves first initiating archiving for core metrics (metrics for VisitsSummary.get). If we find there were no visits for
  the archive we skip the archive (there are events that can disable this optimization on a per site basis). Then we use PluginsArchiver
  to initiate archiving for all plugins.
  
  Note: for some archives (where period=range or if using a custom segment), we will only initiate archiving for the requested plugin(s).
- **Piwik\PluginsArchiver**: This class will loop through every plugin (or requested plugin), create the plugin's `Archiver` instance
  and invoke it. Based on whether a day or non-day period is being archived, either the `aggregateDayReports()` or `aggregateMultipleReports()`
  method will be invoked.
- **Piwik\Plugin\Archiver**: This is the base class for all plugin archivers. Plugins define their archiving logic within one of these
  classes, which will then be invoked by PluginsArchiver.
- **Piwik\ArchiveProcessor**: This is a utility class that contains methods to easily query and aggregate metrics and reports for multiple periods.
  It is mostly used by `aggregateMultipleReports()` implementations to aggregate and insert archive data with a single method call, and by
  both `aggregateMultipleReports()` and `aggregateDayReports()` to insert archive data.
- **Piwik\DataAccess\LogAggregator**: This is a utility class that contains some methods to aggregate log data. It is mostly used by
  `aggregateDayReports()` implementations to aggregate log data and turn the result into `DataTable`s to insert. Many plugin may find
  that those methods are not enough, however, and will query log tables directly.
- **Piwik\DataAccess\ArchiveWriter**: This class contains low level methods to create, write to and delete archives. It is used by
  `ArchiveProcessor` to initialize new archives, insert archive data into them, and to finalize them when finished.
- **Piwik\Archive\Parameters**: This is a utility class that contains all the parameters of an archive data queries, such as the
  site IDs to get data for, the periods to get data for and the segment to get data for.
- **Piwik\ArchiveProcessor\Parameters**: This is a utility class that, like `Piwik\ArchiveParameters`, contains the parameters for
  a single archiving run. It only stores one site ID and period, however, since we can only launch the archiving process for a single site/period
  at a time. It also contains some other information like the request plugin/report if any or whether we want to only archive data for
  a single report.

The entire code path for Core Archiving is as follows:

- An API class constructs an `Archive` instance and queries for archive data.
- If archiving is not allowed to launch, `Archive` will look through the archive tables directly for data and return whatever it finds.
- If archiving is allowed, `Archive` will initiate archiving for every site/period combination in the query. It does this by calling the
  `CoreAdminHome.archiveReports` API method.
- `CoreAdminHome.archiveReports` creates and invokes the `Loader` class.
- `Loader` looks for a usable archive. If found, it returns that archive ID. Otherwise it launches the archiving process, first aggregating
  core metrics like nb_visits. Then if we can't skip the archive, it invokes `PluginsArchiver`.
- `PluginsArchiver` loops through every activated plugin and creates the plugin's `Archiver` instance if there is one. It invokes the appropriate
  method on the `Archiver` instances.
- `Archiver` instances define `aggregateDayReports()` and `aggregateMultipleReports()` methods. `aggregateDayReports()` methods will
  generally use a `LogAggregator` instance to aggregate log data and then insert it using an `ArchiveProcessor` instance. `aggregateMultipleReports()`
  methods will use an aggregation method in `ArchiveProcessor`.
  - `ArchiveProcessor` aggregation methods will query data using an internal `Archive` instance created using the current period's subperiods
    (so if the current period is a week, this `Archive` will query for days within that week).
  - `ArchiveProcessor` will aggregate that data together ans insert it into the archive tables.
- After all plugin archivers finish, `PluginsArchiver` will finalize the archive using the `ArchiveWriter` that was created.

## core:archive command

_Brief Description of system:_ The `core:archive` command is meant to be run as a cron job periodically archiving data
based on a queue. The queue that controls what archives get launched is the `archive_invalidations` table. `core:archive`
will both: insert into this table before processing each site, and then process the entries, launching the core archiving process
for each valid entry.

### PHP Classes

* **Piwik\Plugins\CoreConsole\Commands\CoreArchiver**: The `Command` class for the `core:archive` command. This will create and use a `CronArchive`
  instance. This is the main code path from which `CronArchive` is invoked, the only other being the `CoreAdminHome.runCronArchiving` API method.
* **Piwik\CronArchive**: Encapsulates the entire cron archiving process. This class will loop over every requested site (or work on an existing
  shared queue of site IDs), invalidate data tha needs to be invalidated for it, and process archives for every invalidation for the site.
* **Piwik\CronArchive\QueueConsumer**: This class is used by CronArchive to get the next invalidated archives to process. It queries the
  archive_invalidations table and returns a batch of archive invalidations to process. CronArchive will then launch API requests to
  `CoreAdminHome.archiveReports` for those invalidations.
* **Piwik\CliMulti**: This is a utility class used by CronArchive to initiate multiple API requests in parallel. It will try to execute the requests
  from the CLI using the `climulti:request` command if it can. Otherwise it falls back to initiating curl requests.
* **Piwik\CronArchive\SharedSiteIds**/**Piwik\CronArchive\FixedSiteIds**: These two classes specify the site IDs to archive for `CronArchive`.
  `FixedSiteIds` is used when the `--force-idsites` option is used and provides an in memory list of site IDs to `CronArchive`. `SharedSiteIds`
  uses an `option` table entry to pull sites from. If the option does not exist, the ID for every site in matomo is added, if it already exists
  we use what's there. `SharedSiteIds` will pull one site ID at a time from the option and give it to `CronArchive` to process. This allows
  multiple `core:archive` instances to work on the same list.
* **Piwik\CronArchive\SegmentArchiving**: This is a utility class that contains some logic for getting the stored segments to invoke archiving for
  and how long in the past we need to re-archive data for when a segment is created or updated.
* **Piwik\Archive\ArchiveInvalidator**: This is a core service class that is not strictly part of the core:archive system, but is very important
  to it. It contains the logic to invalidate archive data, and `CronArchive` uses it (indirectly) to invalidate archives before it starts processing
  for a single site.

The entire code path for core:archive execution is:

- The `CoreArchiver` command class is invoked. It processes user input and constructs a `CronArchive` instance. Options are set on the instance and
  it is invoked.
- `CronArchive` uses `FixedSiteIds` or `SharedSiteIds` to start pulling sites to archive. For every site in that list:
  - `CronArchive` invalidates any data that needs to be invalidate for the site. This can be from visits tracked in the past, entities like segments that were
    created or updated or special periods specified in config or settings. The invalidations are inserted into the `archive_invalidations` table.
  - `CronArchive` then uses `QueueConsumer` to pull invalidations to process from the `archive_invalidations` table which pulls them in the correct execution
    order.
  - `CronArchive` takes the batch of invalidations from `QueueConsumer` and uses `CliMulti` to launch multiple archiving processes via API method.
  - `CronArchive` looks at the results of those API calls and determines whether the request was successful. If so, the invalidation is removed. Otherwise
    it is unset and we ignore it until the next time we process this site.
  - This continues until `QueueConsumer` reports no invalidations to process.
- We pull a new site and process it. This continues until there are no sites to process.

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
like it is an HTTP request.

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
- periods are run in ascending order: day periods are run before the weeks that contain them
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
and there may be more visits to process. For example, if the last known archive for 2021-05-20 is calculated at 2021-05-20 20:00:00,
but it is now 2021-05-21 00:30:00, there may be visits between 20:00:00 and 00:00:00 (midnight) to process.

**if core:archive is not run for several days**

If for some reason core:archive does not run for several days or more and is run again, we will currently ignore
the days between the last successful run and yesterday.

So if the last run was on Monday, and it is now Friday and the command is run again, then we don't take into account
that there might be visits between Monday and Thursday.

We will still invalidate today and yesterday, which will in turn invalidate the parent week, month and year. Archiving
these periods will launch day archiving for the days we're not explicitly thinking about and create archives.

This is a known, unhandled edge case.

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

core:archive can detect when the core archiving process fails, since it will not be able to parse the output of a climulti:request
command or the archiving curl request. When this occurs, the invalidation being processed's status is reset to 0, so it will be picked up
again. BUT we also take note of the idinvalidation and skip it for the rest of the current core:archive run. In case the problem
is persistent, we don't want to continuously run a failing job.

Note: we currently don't try to immediately retry the job, since archiving jobs are usually compute intensive, and generally do not fail
randomly. Retrying would thus be a waste of resources.

**if the core:archive process is terminated in the middle of processing an archive**

If the entire core:archive process is terminated during the processing of an invalidation, we cannot unset the status back
to 0. So in the next core:archive run, we will think the job is still running.

We get around this by assuming all jobs that are older than 24 hours have stalled or failed. Before processing a site we set
all such invalidations' status to 1.

We detect the age of an in-progress invalidation by looking at the ts_started column. Before an archiving job is run, the
associated invalidation's ts_started column is set to the start time (this is done at the same time `status` is set to 1).

**an archiving run fails, the sites for the failed archive are deleted, and the archiver starts again**

In this case, an archiving run fails leaving invalidations in the archive_invalidations table. The sites for those invalidations
are then deleted, then another core:archive command runs.

This new run should ignore the invalidations in the archive_invalidations table. If we start an entirely new SharedSiteIds
list, then we will simply not see the site. If however we use an existing site ID queue, we will encounter the site ID, but fail
to get the rest of the site information and move on to the next.

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
  archives containing today are always eventually reprocessed. By contrast, for data that is tracked in the past, we
  explicitly invalidate the period. We don't do this for `today`, because invalidating data for every visit encountered
  today would make the tracker far less performant. Tracking data in the past, however, does not happen with nearly as
  high frequency or volume.

- if the period is a range, then we always recompute it when it is no longer valid. This is because ranges are just two
  arbitrary dates. We cannot preprocess every single permutation during core:archive, so instead we launch the archiving process
  in browser requests when the ttl expires. Since range archives just aggregate day periods together, and we don't launch
  archiving for those days, this is still performant.

The TTLs are determined by user and config settings. The day period can be specific in the UI in the System Settings page
and through INI config. The other periods can have custom TTLs in INI config as well, but not in the UI. See above for
the specific settings.

If no custom TTL is specified for a non-day period, it defaults to the day TTL.

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

### Concurrency

**Processing multiple archives at the same time**

This is not desired behavior, we prefer if only one process creates a single archive, but sometimes multiple requests
will trigger archiving at the same time (this is mostly an issue for setups that enable browser triggered archiving).

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
* `--force-all-websites`: Like `--force-idsites` but for every website in the instance.

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
as having a done value of `DONE_INVALIDATED`. This marks the archive as having out of date data.

If browser triggered archiving is enabled, and a `DONE_INVALIDATED` archive is encountered, it will be rearchived.

The second thing that is done, is inserting an entry into the archive_invalidations table. This tells the core:archive process that
the archive needs to be reprocessed.

Everything that is invalidated in the archive tables should also appear in the archive_invalidations table. However, the
reverse is not true. If we just put something into archive_invalidations, it will still overwrite an existing archive.