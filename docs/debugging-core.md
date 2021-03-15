---
category: DevelopInDepth
title: Debugging Core
---
# Matomo core - Debugging

## PHP

### IDE

We highly recommend using PHPStorm or a similar IDE that supports Xdebug, refactorings, auto completion, find usages of certain code pieces etc. Anything else should not really be considered for everyday work with Matomo.

### Xdebug

We highly recommend using [Xdebug](https://xdebug.org/) for any kind of debugging. For example, if you need to inspect the content of a variable or if you need to go through the code step by step. 

Using Xdebug for debugging the core will make your life a lot easier and faster. If you're not having it set up yet, we highly recommend doing it now and getting familiar with it and making it a habit to use it regularly. It will be otherwise hard and time consuming to troubleshoot issues. 

Please note that Xdebug will make running the tests run slower. Especially integration, system and UI tests. An improvement could be to have Xdebug only enabled for the web but disabled on the CLI. This way Xdebug will be disabled for integration and system tests but still run for UI tests. As a general advice for running tests faster you may want to only run a single test instead of all tests in a file like `./console tests:run file/to.php --options="--filter=test_methodNameToRun"`. 

If it's not possible to disable Xdebug for CLI because there is no separate php ini file, then you may want to give it a try to have Xdebug always enabled and put something like this in your `$HOME/.profile` file: `export XDEBUG_CONFIG="remote_enable=0"` (not tested if this works).

When you want to use the debugger in tests or in a CLI call (which will be needed regularly), then you could for example configure xdebug using an environment variable like below:

```bash
export XDEBUG_CONFIG="remote_enable=1"
php console ...
```

[Click here to read more about this.](https://www.jetbrains.com/help/phpstorm/debugging-a-php-cli-script.html)

### Logging

If Xdebug is not appropriate for some reasons then you can also use logging. For example you may log a message like this:

```php
\Piwik\Log::warning($warning);
```

and watch the log file in your Matomo directory like this:

```bash
tail -f tmp/logs/matomo.log
```

For this to work you need to make sure to have logging to file enabled in your `config/config.ini.php` like 

```ini
[log]
log_writers[] = "screen"
log_writers[] = "file"
```

Please note that the same information will in many cases also be logged to the screen.

For more information about logging and SQL query profiling read our [logging FAQ](https://matomo.org/faq/troubleshooting/faq_115/).

### Printing output

There is the classic way of printing information using `print_r`, `var_export`, or `var_dump`. There are no special methods for printing the content of a variable.

In twig you can use `{{ variable|dump }}` or `{{ variable|json_encode }}`.

### Debugging the tracker

You can configure to print debug output when executing a tracking request. This can be helpful understanding what's happening during a tracker request.

For more information about this read the [debugging the tracker guide](/api-reference/tracking-api#debugging-the-tracker).

### Debugging the archiver

To debug the archiver, you will need to change below config settings as by default the archiver is only executed approx every 900 seconds (see [time_before_today_archive_considered_outdated config setting](https://matomo.org/faq/roll-up-reporting/faq_25754/)). This means by default the archiver would only launch once, and then at the earliest again after 15 minutes if there was a tracking request. To force the archiver to launch every time, you will need to adjust the following configurations:

```ini
[Debug]
; if set to 1, the archiving process will always be triggered, even if the archive has already been computed
; this is useful when making changes to the archiving code so we can force the archiving process
always_archive_data_period = 0;
always_archive_data_day = 0;
; Force archiving Custom date range (without re-archiving sub-periods used to process this date range)
always_archive_data_range = 0;
```

## JavaScript

It's best to use the browser developer tools. Go to the source tab and select the right source and set breakpoints. 

To not needing to set a breakpoint you can also place the keyword `debugger;` anywhere in the JS code and the debugger will automatically break there.

If the JS is minified: Most browsers have a "Pretty print" feature which will format the code making it easier to debug.

In some cases you may want to log information using `console.(log|warning|error|...)`.


