---
category: DevelopInDepth
title: Profiling Code
---
# Matomo - Profiling code

By profiling code you can easily find performance bottlenecks in the code and find out why a certain code is slow and where.

## PHP

The core supports profiling using the `xhprof` or the `tideways` PHP extension (only one of them is needed). You can typically install these extensions like `pecl install xhprof`. We usually try to use `xhprof` (might not work with some PHP versions) and fallback to `tideways` if this doesn't work. The reason is that with the local `tideways` extension we've had issues  with the output directory in the past where a profile run result is being written to doesn't match the directory being used when viewing a report run and we sometimes had to patch xhprof files to make this work. 

### General recommendations

When profiling, we need to make sure to profile a production system as close as possible. This means we should follow these steps:

* disable development mode (so caches will be used)
* warm up the caches by executing the action you want to profile once so on the next request the caches will be used when you profile
* ideally you have a fast disk otherwise the results might not be as accurate. For example if you are using a virtual machine the disk can be slower than usual sometimes
* you may need to call `php composer.phar install --no-dev -o --ignore-platform-reqs` to make sure the autoloader is used properly and doesn't try to find files

### UI and API

You can append `&xhprof=1` to any Matomo URL and it should automatically launch the profiler. 

### Tracking

You will need to edit the file `piwik.php` and add the below line after the environment is being initiated but after the autoloader was configured. This would be typically around [this line](https://github.com/matomo-org/matomo/blob/4.2.1/piwik.php#L52). 

It's not possible to simply set the xhprof URL parameter currently.

```php
\Piwik\Profiler::setupProfilerXHProf(true, true);
```

### Console (eg CLI, tests, ...)

You can append the CLI option `--xhprof` to start a profiling run. 

### Other parts

If something can't be profiled, then you may need to call the above method as mentioned in the tracker section to start the profiling.

The profiler will automatically stop the recording as soon as the `register_shutdown_function` is called and write the results into a file see next section.

### Storage of profile runs

The files will be stored as `{runId}-{profilerNamespace}.xhprof` under the configured directory in the `xhprof.output_dir` PHP ini setting. If that's not configured, then it may fall back to the `sys_get_temp_dir()` which is for example `/tmp`. Please note that when the ini setting is not set, there's a chance that when viewing a run that it can't locate the xhprof file.

The profiler namespace may the name of your git branch.

### Viewing a profile run

At the end of a profiling run a URL will be printed to view the report. This URL will roughly look like this:

`https://your-matomo-domain/vendor/lox/xhprof/xhprof_html/?source=$profilerNamespace&run=$runId`

If you are using Apache then you may need to remove the file `vendor/.htaccess` to be able to view the recorded run.

#### Things to keep in mind

* If there are many (like hundreds or thousands) function calls (eg built-in functions or generally) within a function, this will always add some additional overhead / time in the profile run result but won't be as much of a problem in real live

## Database queries

Edit your `config/config.ini.php` and activate the setting `[Debug]enable_sql_profiler=1`. Any executed query will be logged into the DB table `{table_prefix}_log_profiling` including the number of time this query was executed and the time it took to execute this query. You will want to sort the table by `idprofiling` to find the most recent executed queries. 

If you prefer the SQL query information being logged to a file then you can additionally add these configurations to your config file:

```
[log]
log_writers[] = file
log_level=debug
```

When you set the log level to `debug`, then it will log/print a lot more information which is why you will likely not want to log to `screen` while you have this log level set and only log to file instead. 

### Tracker

If you also want to profile the tracker DB queries, then you additionally need to enable `[Tracker]enable_sql_profiler=1` and `[Tracker]debug=1`. When you then issue a tracking request, the individual queries will be printed as part of the tracker debug output. Please note that the HTML will not be evaluated since it will be a text response and you might need to copy/paste this into an HTML file to view it better.

### Profiling a specific query

You can profile a specifc query like this:

```
SET SESSION profiling = 1;
SELECT SQL_NO_CACHE * FROM ...
SHOW PROFILES;
```

You can also get even more details for a query for example like this: `SHOW PROFILE CPU FOR QUERY 16;`. Learn more about this in the [MySQL docs for profiling](https://dev.mysql.com/doc/refman/8.0/en/show-profile.html).

When profiling a query (before MySQL 5.7.20) or generally checking how long a query takes to load, it's important to use `SQL_NO_CACHE` after the `SELECT` statement to prevent any cache from being used and giving you a wrong result. Also, be aware [MySQL documentation](https://dev.mysql.com/doc/refman/5.6/en/query-cache-in-select.html) warns "that due to a limitation in the parser, a space character **must** precede and follow the SQL_NO_CACHE keyword; a nonspace such as a newline causes the server to check the query cache to see whether the result is already cached".

### Understanding query execution

To get more insights into a query like how many rows it will likely look at, whether it uses an index or not etc simply prepend `explain extended` or `explain format=json` or `explain format=tree` to the SQL select query. [Learn more about this here.](https://elephantdolphin.blogspot.com/2021/08/explaining-different-explains-in-mysql.html)

Since MySQL 8.0.18 there is also `explain analyze` which breaks down the query execution stage by measuring each step of the query execution plan which can be a lot easier to read and understand. Learn more [here](https://dev.mysql.com/blog-archive/mysql-explain-analyze/) and [here](https://dev.mysql.com/doc/refman/8.0/en/explain.html#explain-analyze).

## JavaScript

This can vary depending on the browser. You basically want to open the browser developer tools and activate the `Performance` tab.

There you can start a recording (or start a recording and directly trigger a page reload). When you stop the recording you will get a detailed breakdown of the time spent in JavaScript, rendering, network, etc. You can drill down into the different JavaScript methods to see what's causing issues etc.
