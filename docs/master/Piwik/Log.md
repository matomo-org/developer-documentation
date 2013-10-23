<small>Piwik</small>

Log
===

Logging utility class.

Description
-----------

Log entries are made with a message and log level. The logging utility will tag each
log entry with the name of the plugin that&#039;s doing the logging. If no plugin is found,
the name of the current class is used.

You can log messages using one of the public static functions (eg, &#039;error&#039;, &#039;warning&#039;,
&#039;info&#039;, etc.). Messages logged with the **error** level will **always** be logged to
the screen, regardless of whether the [log] log_writer config option includes the
screen writer.

Currently, Piwik supports the following logging backends:
- logging to the screen
- logging to a file
- logging to a database

### Logging configuration

The logging utility can be configured by manipulating the INI config options in the
[log] section.

The following configuration options can be set:

- `log_writers[]`: This is an array of log writer IDs. The three log writers provided
                   by Piwik core are **file**, **screen** and **database**. You can
                   get more by installing plugins. The default value is **screen**.
- `log_level`: The current log level. Can be **ERROR**, **WARN**, **INFO**, **DEBUG**,
               or **VERBOSE**. Log entries made with a log level that is as or more
               severe than the current log level will be outputted. Others will be
               ignored. The default level is **WARN**.
- `log_only_when_cli`: 0 or 1. If 1, logging is only enabled when Piwik is executed
                       in the command line (for example, by the archive.php cron
                       script). Default: 0.
- `log_only_when_debug_parameter`: 0 or 1. If 1, logging is only enabled when the
                                   `debug` query parameter is 1. Default: 0.
- `logger_file_path`: For the file log writer, specifies the path to the log file
                      to log to or a path to a directory to store logs in. If a
                      directory, the file name is piwik.log. Can be relative to
                      Piwik&#039;s root dir or an absolute path. Defaults to **tmp/logs**.

### Custom message formatting

If you&#039;d like to format log messages differently for different backends, you can use
one of the `&#039;Log.format...Message&#039;` events. These events are fired when an object is
logged. You can create your own custom class containing the information to log and
listen to this event.

### Custom log writers

New logging backends can be added via the `&#039;Log.getAvailableWriters&#039;` event. A log
writer is just a callback that accepts log entry information (such as the message,
level, etc.), so any backend could conceivably be used (including existing PSR3
backends).

### Examples

**Basic logging**

    Log::error(&quot;This log message will end up on the screen and in a file.&quot;)
    Log::verbose(&quot;This log message uses %s params, but %s will only be called if the&quot;
               . &quot; configured log level includes %s.&quot;, &quot;sprintf&quot;, &quot;sprintf&quot;, &quot;verbose&quot;);


Constants
---------

This class defines the following constants:

- [`NONE`](#NONE)
- [`ERROR`](#ERROR)
- [`WARN`](#WARN)
- [`INFO`](#INFO)
- [`DEBUG`](#DEBUG)
- [`VERBOSE`](#VERBOSE)
- [`LOG_LEVEL_CONFIG_OPTION`](#LOG_LEVEL_CONFIG_OPTION)
- [`LOG_WRITERS_CONFIG_OPTION`](#LOG_WRITERS_CONFIG_OPTION)
- [`LOGGER_FILE_PATH_CONFIG_OPTION`](#LOGGER_FILE_PATH_CONFIG_OPTION)
- [`STRING_MESSAGE_FORMAT_OPTION`](#STRING_MESSAGE_FORMAT_OPTION)
- [`FORMAT_FILE_MESSAGE_EVENT`](#FORMAT_FILE_MESSAGE_EVENT)
- [`FORMAT_SCREEN_MESSAGE_EVENT`](#FORMAT_SCREEN_MESSAGE_EVENT)
- [`FORMAT_DATABASE_MESSAGE_EVENT`](#FORMAT_DATABASE_MESSAGE_EVENT)
- [`GET_AVAILABLE_WRITERS_EVENT`](#GET_AVAILABLE_WRITERS_EVENT)

Methods
-------

The class defines the following methods:

- [`error()`](#error) &mdash; Logs a message using the ERROR log level.
- [`warning()`](#warning) &mdash; Logs a message using the WARNING log level.
- [`info()`](#info) &mdash; Logs a message using the INFO log level.
- [`debug()`](#debug) &mdash; Logs a message using the DEBUG log level.
- [`verbose()`](#verbose) &mdash; Logs a message using the VERBOSE log level.

### `error()` <a name="error"></a>

Logs a message using the ERROR log level.

#### Description

Note: Messages logged with the ERROR level are always logged to the screen in addition
to configured writers.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$message`
- It does not return anything.

### `warning()` <a name="warning"></a>

Logs a message using the WARNING log level.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$message`
- It does not return anything.

### `info()` <a name="info"></a>

Logs a message using the INFO log level.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$message`
- It does not return anything.

### `debug()` <a name="debug"></a>

Logs a message using the DEBUG log level.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$message`
- It does not return anything.

### `verbose()` <a name="verbose"></a>

Logs a message using the VERBOSE log level.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$message`
- It does not return anything.

