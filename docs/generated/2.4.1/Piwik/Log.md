<small>Piwik\</small>

Log
===

Logging utility class.

Log entries are made with a message and log level. The logging utility will tag each
log entry with the name of the plugin that's doing the logging. If no plugin is found,
the name of the current class is used.

You can log messages using one of the public static functions (eg, 'error', 'warning',
'info', etc.). Messages logged with the **error** level will **always** be logged to
the screen, regardless of whether the [log] log_writer config option includes the
screen writer.

Currently, Piwik supports the following logging backends:

- **screen**: logging to the screen
- **file**: logging to a file
- **database**: logging to Piwik's MySQL database

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
- `log_only_when_cli`: 0 or 1. If 1, logging is only enabled when Piwik is executed
                       in the command line (for example, by the core:archive command
                       script). Default: 0.
- `log_only_when_debug_parameter`: 0 or 1. If 1, logging is only enabled when the
                                   `debug` query parameter is 1. Default: 0.
- `logger_file_path`: For the file log writer, specifies the path to the log file
                      to log to or a path to a directory to store logs in. If a
                      directory, the file name is piwik.log. Can be relative to
                      Piwik's root dir or an absolute path. Defaults to **tmp/logs**.

### Custom message formatting

If you'd like to format log messages differently for different backends, you can use
one of the `'Log.format...Message'` events.

These events are fired when an object is logged. You can create your own custom class
containing the information to log and listen to these events to format it correctly for
different backends.

If you don't care about the backend when formatting an object, implement a `__toString()`
in the custom class.

### Custom log writers

New logging backends can be added via the [Log.getAvailableWriters](/api-reference/events#loggetavailablewriters)` event. A log
writer is just a callback that accepts log entry information (such as the message,
level, etc.), so any backend could conceivably be used (including existing PSR3
backends).

### Examples

**Basic logging**

    Log::error("This log message will end up on the screen and in a file.")
    Log::verbose("This log message uses %s params, but %s will only be called if the"
               . " configured log level includes %s.", "sprintf", "sprintf", "verbose");

**Logging objects**

    class MyDebugInfo
    {
        // ...

        public function __toString()
        {
            return // ...
        }
    }

    try {
        $myThirdPartyServiceClient->doSomething();
    } catch (Exception $unexpectedError) {
        $debugInfo = new MyDebugInfo($unexpectedError, $myThirdPartyServiceClient);
        Log::debug($debugInfo);
    }

Methods
-------

The class defines the following methods:

- [`getInstance()`](#getinstance) &mdash; Returns the singleton instance for the derived class.
- [`error()`](#error) &mdash; Logs a message using the ERROR log level.
- [`warning()`](#warning) &mdash; Logs a message using the WARNING log level.
- [`info()`](#info) &mdash; Logs a message using the INFO log level.
- [`debug()`](#debug) &mdash; Logs a message using the DEBUG log level.
- [`verbose()`](#verbose) &mdash; Logs a message using the VERBOSE log level.

<a name="getinstance" id="getinstance"></a>
<a name="getInstance" id="getInstance"></a>
### `getInstance() *inherited from*` [`Singleton`](../Piwik/Singleton.md)
Returns the singleton instance for the derived class.

If the singleton instance
has not been created, this method will create it.

#### Signature

- It returns a [`Singleton`](../Piwik/Singleton.md) value.

<a name="error" id="error"></a>
<a name="error" id="error"></a>
### `error() `
Logs a message using the ERROR log level.

_Note: Messages logged with the ERROR level are always logged to the screen in addition
to configured writers._

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$message`

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="warning" id="warning"></a>
<a name="warning" id="warning"></a>
### `warning() `
Logs a message using the WARNING log level.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$message`

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="info" id="info"></a>
<a name="info" id="info"></a>
### `info() `
Logs a message using the INFO log level.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$message`

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="debug" id="debug"></a>
<a name="debug" id="debug"></a>
### `debug() `
Logs a message using the DEBUG log level.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$message`

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="verbose" id="verbose"></a>
<a name="verbose" id="verbose"></a>
### `verbose() `
Logs a message using the VERBOSE log level.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$message`

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

