<small>Piwik\</small>

Log
===

Logging utility class.

Log entries are made with a message and log level. The logging utility will tag each
log entry with the name of the plugin that's doing the logging. If no plugin is found,
the name of the current class is used.

You can log messages using one of the public static functions (eg, 'error', 'warning',
'info', etc.).

Currently, Piwik supports the following logging backends:

- **screen**: logging to the screen
- **file**: logging to a file
- **database**: logging to Piwik's MySQL database

Messages logged in the console will always be logged to the console output.

### Logging configuration

The logging utility can be configured by manipulating the INI config options in the
`[log]` section.

The following configuration options can be set:

- `log_writers[]`: This is an array of log writer IDs. The three log writers provided
                   by Piwik core are **file**, **screen** and **database**. You can
                   get more by installing plugins. The default value is **screen**.
- `log_level`: The current log level. Can be **ERROR**, **WARN**, **INFO**, **DEBUG**,
               or **VERBOSE**. Log entries made with a log level that is as or more
               severe than the current log level will be outputted. Others will be
               ignored. The default level is **WARN**.
- `logger_file_path`: For the file log writer, specifies the path to the log file
                      to log to or a path to a directory to store logs in. If a
                      directory, the file name is piwik.log. Can be relative to
                      Piwik's root dir or an absolute path. Defaults to **tmp/logs**.

Methods
-------

The class defines the following methods:

- [`getInstance()`](#getinstance) &mdash; Returns the singleton instance for the derived class. Inherited from [`Singleton`](../Piwik/Singleton.md)
- [`error()`](#error) &mdash; Logs a message using the ERROR log level.
- [`warning()`](#warning) &mdash; Logs a message using the WARNING log level.
- [`info()`](#info) &mdash; Logs a message using the INFO log level.
- [`debug()`](#debug) &mdash; Logs a message using the DEBUG log level.
- [`verbose()`](#verbose) &mdash; Logs a message using the VERBOSE log level.

<a name="getinstance" id="getinstance"></a>
<a name="getInstance" id="getInstance"></a>
### `getInstance()`

Returns the singleton instance for the derived class. If the singleton instance
has not been created, this method will create it.

#### Signature

- It returns a [`Singleton`](../Piwik/Singleton.md) value.

<a name="error" id="error"></a>
<a name="error" id="error"></a>
### `error()`

Logs a message using the ERROR log level.

#### See Also

- `\Psr\Log\LoggerInterface::error()`

#### Signature

-  It accepts the following parameter(s):
    - `$message`
      
- It does not return anything or a mixed result.

<a name="warning" id="warning"></a>
<a name="warning" id="warning"></a>
### `warning()`

Logs a message using the WARNING log level.

#### See Also

- `\Psr\Log\LoggerInterface::warning()`

#### Signature

-  It accepts the following parameter(s):
    - `$message`
      
- It does not return anything or a mixed result.

<a name="info" id="info"></a>
<a name="info" id="info"></a>
### `info()`

Logs a message using the INFO log level.

#### See Also

- `\Psr\Log\LoggerInterface::info()`

#### Signature

-  It accepts the following parameter(s):
    - `$message`
      
- It does not return anything or a mixed result.

<a name="debug" id="debug"></a>
<a name="debug" id="debug"></a>
### `debug()`

Logs a message using the DEBUG log level.

#### See Also

- `\Psr\Log\LoggerInterface::debug()`

#### Signature

-  It accepts the following parameter(s):
    - `$message`
      
- It does not return anything or a mixed result.

<a name="verbose" id="verbose"></a>
<a name="verbose" id="verbose"></a>
### `verbose()`

Logs a message using the VERBOSE log level.

#### See Also

- `\Psr\Log\LoggerInterface::debug()`

#### Signature

-  It accepts the following parameter(s):
    - `$message`
      
- It does not return anything or a mixed result.

