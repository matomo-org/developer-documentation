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

Callback signature: function (&amp;$message, $level, $tag, $datetiem, $logger)

The $message parameter is the object that is being logged. Event handlers should
check if the object is of a certain type and if it is, set $message to the
string that should be logged.
