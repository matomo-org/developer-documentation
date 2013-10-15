<small>Piwik</small>

Log
===

Logging utility.

Description
-----------

You can log messages using one of the public static functions (eg, &#039;error&#039;, &#039;warning&#039;,
&#039;info&#039;, etc.).

Currently, Piwik supports the following logging backends:
- logging to the screen
- logging to a file
- logging to a database

The logging utility can be configured by manipulating the INI config options in the
[log] section.


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
- [`getInstance()`](#getInstance)

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

### `getInstance()` <a name="getInstance"></a>

#### Signature

- It is a **public** method.
- It returns a(n) [`Log`](../Piwik/Log.md) value.

