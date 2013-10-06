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
- [`FORMAT_FILE_MESSAGE_EVENT`](#FORMAT_FILE_MESSAGE_EVENT) &mdash; This event is called when trying to log an object to a file.
- [`FORMAT_SCREEN_MESSAGE_EVENT`](#FORMAT_SCREEN_MESSAGE_EVENT) &mdash; This event is called when trying to log an object to the screen.
- [`FORMAT_DATABASE_MESSAGE_EVENT`](#FORMAT_DATABASE_MESSAGE_EVENT) &mdash; This event is called when trying to log an object to a database table.
- [`GET_AVAILABLE_WRITERS_EVENT`](#GET_AVAILABLE_WRITERS_EVENT) &mdash; This event is called when the Log instance is created.

### `FORMAT_FILE_MESSAGE_EVENT` <a name="FORMAT_FILE_MESSAGE_EVENT"></a>

Plugins can use
this event to convert objects to strings before they are logged.

Callback signature: function (&amp;$message, $level, $tag, $datetime, $logger)

The $message parameter is the object that is being logged. Event handlers should
check if the object is of a certain type and if it is, set $message to the
string that should be logged.

### `FORMAT_SCREEN_MESSAGE_EVENT` <a name="FORMAT_SCREEN_MESSAGE_EVENT"></a>

Plugins can use
this event to convert objects to strings before they are logged.

Callback signature: function (&amp;$message, $level, $tag, $datetiem, $logger)

The $message parameter is the object that is being logged. Event handlers should
check if the object is of a certain type and if it is, set $message to the
string that should be logged.

The result of this callback can be HTML so no sanitization is done on the result.
This means YOU MUST SANITIZE THE MESSAGE YOURSELF if you use this event.

### `FORMAT_DATABASE_MESSAGE_EVENT` <a name="FORMAT_DATABASE_MESSAGE_EVENT"></a>

Plugins can use
this event to convert objects to strings before they are logged.

Callback signature: function (&amp;$message, $level, $tag, $datetime, $logger)

The $message parameter is the object that is being logged. Event handlers should
check if the object is of a certain type and if it is, set $message to the
string that should be logged.

### `GET_AVAILABLE_WRITERS_EVENT` <a name="GET_AVAILABLE_WRITERS_EVENT"></a>

Plugins can use this event to
make new logging writers available.

A logging writer is a callback that takes the following arguments:
  int $level, string $tag, string $datetime, string $message

$level is the log level to use, $tag is the log tag used, $datetime is the date time
of the logging call and $message is the formatted log message.

Logging writers must be associated by name in the array passed to event handlers.

Callback signature: function (array &amp;$writers)

Example handler:
    function (&amp;$writers) {
        $writers[&#039;myloggername&#039;] = function ($level, $tag, $datetime, $message) {
            ...
        }
    }

    // &#039;myloggername&#039; can now be used in the log_writers config option.

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

