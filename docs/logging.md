---
category: Develop
---
# Logging

<div class="alert alert-info" markdown="1">
<strong>Since v2.11:</strong>
the API described here has been introduced in Piwik 2.11 and doesn't apply to previous versions.
</div>

Logging is the action of recording events which happen while Piwik is running. It is intended to:

- let users monitor the health of their Piwik installation by being able to know when minor or major errors happen
- help users debug problems by having a detailed account of events leading to an error

To log messages, Piwik uses the standardized `Psr\Log\LoggerInterface` ([PSR-3 standard](http://www.php-fig.org/psr/psr-3/)). This PHP standard lets Piwik developers use the standard interface, leaving the possibility to switch from and to *any* compatible PHP logger.

The PSR-3 implementation that Piwik has chosen is [Monolog](https://github.com/Seldaek/monolog). Monolog is a robust and very customizable logger used by Symfony, Silex, Laravel…

## How to log messages

To log messages, you need to get an instance of the logger. To do this, you can use dependency injection by injecting `Psr\Log\LoggerInterface` or you can retrieve the logger from the container:

```php
$logger = StaticContainer::getInstance()->get('Psr\Log\LoggerInterface');
```

You can then log messages using any severity level:

```php
$logger->error('This is an error');
$logger->warning('This is a warning');
$logger->notice('This is a notice');
$logger->info('This is an info');
$logger->debug('This is a debug message');
```

Each of this message will or will not be logged according to the log level configured by the user. Developers should not log conditionally according to the current log level: they should simply log and let the system figure it all out.

### Parameterized messages

If your error message is a string constructed dynamically, you should **not** log like this:

```php
$logger->info('The configuration option ' . $name . ' has an invalid value ' . $value);
```

Instead, you should use the standardized log format (described in the [PSR-3 standard](http://www.php-fig.org/psr/psr-3/)):

```php
$logger->info('The configuration option {name} has an invalid value {value}', array(
    'name'  => $name,
    'value' => $value,
));
```

Before writing logs to the backend (for example a file, database, …) the placeholders will be replaced with the actual values:

> INFO [2014-12-14 21:49:06] The configuration option foo has an invalid value bar

### Logging exceptions

If an exception occurs, you have two choices:

- catch it
- not catch it and let it bubble

If an exception happens and everything should be stopped and an error page should be shown, you should not catch the exception. Let it bubble and Piwik will catch it and display the exception message to the user.

If an exception happens but the current action should not be interrupted, you should catch the exception. If the exception was an expected case, you probably shouldn't log it. You should only log it if it's an unexpected situation that the user should be aware of.

In a more general rule: **you should only log information that is useful to the user** (either to debug problems to anticipate potential problems).

If you want to log an exception, you should follow PSR-3's standard **by using the `exception` key in the parameters array**:

```php
try {
    $httpClient->post('http://example.com/_abc_123', $data);
} catch (RequestException $e) {
    $logger->error('Cannot backup data, will try again later', array('exception' => $e));
}
```

In this example, we log to `error` level but we catched the exception: the current process will not be aborted.

## Logger configuration

As explain in the user documentation, users can configure the logger by setting the following ini options:

```ini
[log]
; possible values: screen, database, file
log_writers[] = screen
; NONE, ERROR, WARN, INFO or DEBUG
log_level = WARN
; if configured to log to file, file in which to log
logger_file_path = tmp/logs/piwik.log
```

However plugins can override much more things in the configuration.

Before reading the following documentation, you are encouraged to read the [Dependency Injection Configuration guide]() and [Monolog's documentation](https://github.com/Seldaek/monolog).

### Overriding the logger

The logger itself is configured by binding the `Psr\Log\LoggerInterface` to an instance:

```php
return array(
    'Psr\Log\LoggerInterface' => DI\object('Monolog\Logger'),
);
```

You can have Piwik use any other logger implementation by overriding that binding. For example, in tests we disable logging by binding the interface to an implementation that doesn't log anything (the [null object pattern](http://en.wikipedia.org/wiki/Null_Object_pattern)):

```php
return array(
    'Psr\Log\LoggerInterface' => DI\object('Psr\Log\NullLogger'),
);
```

### Adding log handlers

Overriding the logger completely is a bit extreme and would break the user configuration.

If you only want to **add a new logging backend**, you can do so by registering a new [Monolog Handler](https://github.com/Seldaek/monolog/blob/master/doc/extending.md#writing-your-own-handler).

```php
return array(
    'log.handlers' => DI\extend()->add(
        DI\link('Piwik\Plugins\MyPlugin\MyLogHandler'),
    ),
);
```

Your handler should inherit from Monolog's [`AbstractProcessingHandler`](https://github.com/Seldaek/monolog/blob/master/src/Monolog/Handler/AbstractProcessingHandler.php), which means your handler's configuration should look like this:

```php
return array(
    // ...
    'Piwik\Plugins\MyPlugin\MyLogHandler' => DI\object()
        ->constructor(DI\link('log.level'))
        ->method('setFormatter', DI\link('Piwik\Log\Formatter\LineMessageFormatter')),
);
```

### Adding log processors

Log processors let you:

- add custom data to log records
- pre-process log messages or parameters

To register a new Monolog Processor:

```php
return array(
    'log.processors' => DI\extend()->add(
        DI\link('Piwik\Plugins\MyPlugin\MyLogProcessor'),
    ),
);
```

A simple example of a processor is Monolog's [`ProcessIdProcessor`](https://github.com/Seldaek/monolog/blob/master/src/Monolog/Processor/ProcessIdProcessor.php).
