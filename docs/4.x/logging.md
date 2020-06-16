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
$logger = StaticContainer::getContainer()->get('Psr\Log\LoggerInterface');
```

You can then log messages using any severity level:

```php
$logger->error('This is an error');
$logger->warning('This is a warning');
$logger->notice('This is a notice');
$logger->info('This is an info');
$logger->debug('This is a debug message');
```

Each of these messages will or will not be logged according to the log level configured by the user in their `config.php.ini`. Developers should not log conditionally according to the current log level: they should simply log and let the system figure it all out.

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

A generic rule is: **you should only log information that is useful to the user** (either to debug problems or anticipate potential problems).

If you want to log an exception, you should follow PSR-3's standard **by using the `exception` key in the parameters array**:

```php
try {
    $httpClient->post('http://example.com/_abc_123', $data);
} catch (RequestException $e) {
    $logger->error('Cannot backup data, will try again later', array('exception' => $e));
}
```

In this example, we log to `error` level, but we caught the exception: the current process will not be aborted.

### Viewing logs

To view the logs, we recommend using our [LogViewer plugin](https://plugins.piwik.org/LogViewer): learn more in [How do I view Piwik application logs?](https://piwik.org/faq/how-to/faq_20991/)
