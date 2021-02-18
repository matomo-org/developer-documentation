---
category: Develop
previous: tests
next: tests-ui
---
# PHP Tests

As explained in the previous guide, Piwik's test suite contains PHP tests and [UI tests](/guides/tests-ui). The PHP test suite is written and run using [PHPUnit](https://phpunit.de).

If you're creating a new plugin, you may find it beneficial to engage in [Test Driven Development](https://en.wikipedia.org/wiki/Test-driven_development) or at least to verify your code is correct with tests. With tests, you'll be able to ensure that your code works and you'll be able to ensure the changes you make don't cause regressions.
## Requirements

Before you start make sure you have enabled development mode:

```
$ ./console development:enable
```

If your development Matomo is not using `localhost` as a hostname (or if your webserver is using a custom port number), then edit your `config/config.ini.php` file and under `[tests]` section, add the `http_host` and/or `port` settings:

```
[tests]
http_host = localhost
port = 8777
```

The `request_uri` needs to be configured for running tests. If your development Matomo is setup in a sub-directory for example at `http://localhost/dev/matomo`, then your settings should be like this:

```
[tests]
request_uri = "/dev/matomo"
```

If you don't use any sub-directory, you can simple setup like this:

```
[tests]
request_uri = "/"
```

Before you run the tests (at least the first time, but you can rerun it any time), run this command to migrate the test database.

```
$ ./console tests:setup-fixture OmniFixture
```

  
## Writing unit tests

A unit test tests only a single method or class and does not use dependencies like the filesystem, web, config, database or any other plugin.

To create a new unit test, use the console:

```
$ ./console generate:test --testtype unit
```

The command will ask you for the name of the plugin and the name of the test (which is usually the name of the class you want to test). It will create a file `plugins/MyPlugin/tests/Unit/WidgetsTest.php` which contains an example to get you started:

```php
/**
 * @group MyPlugin
 * @group WidgetsTest
 * @group Plugins
 */
class WidgetsTest extends UnitTestCase
{
    public function testSimpleAddition()
    {
        $this->assertEquals(2, 1+1);
    }
}
```

We don’t want to cover how you should write your unit test. This is totally up to you. If you have no experience writing unit tests we recommend reading articles or a book on the topic, watching videos or anything else that will help you learn best.

## Writing integration tests

If your test needs access to a test Piwik database, filesystem, or any other dependency — create an integration test:

```
$ ./console generate:test --testtype integration
```

The command will as well ask you for the name of the plugin and the name of the test. It will create a file `plugins/MyPlugin/tests/Integration/WidgetsTest.php` which contains an example to get you started.

The `IntegrationTestCase` base class provides a `setUp()` method that creates a test Piwik database and a `tearDown()` method that removes it. During integration
tests all plugins will be loaded allowing you to write actual integration tests.

## Running tests

To run a test, use the command `tests:run` which allows you to execute a test suite, a specific file, all files within a folder or a group of tests.

To verify whether the created test works we will run it as follows:

```bash
$ ./console tests:run WidgetsTest
```

This will run all tests having the group `WidgetsTest`. As other tests can use the same group you might want to pass the path to your test file instead:

```bash
$ ./console tests:run plugins/Insights/tests/Unit/Widgets.php
```

If you want to run all tests within your plugin pass the name of your plugin as an argument:

```bash
$ ./console tests:run insights
```

Of course, you can also define multiple arguments:

```bash
$ ./console tests:run insights WidgetsTest
```

This will execute all tests within the insights plugin having the group WidgetsTest. If you only want to run unit tests within your plugin you can do the following:

```bash
$ ./console tests:run insights unit
```

To run all unit, integration or system tests, use one of the following arguments:

```bash
$ ./console tests:run unit
$ ./console tests:run integration
$ ./console tests:run system
```

## Learn more

* To learn more about **what you can do with PHPUnit** read PHPUnit's [user documentation](https://phpunit.de/documentation.html).
