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

### Troubleshooting Integration Tests

There are some common issues that can occur when writing integration tests. These are listed below with their appropriate solution:

* **Translations are required to be loaded in my test, but are not**: By default, integration tests do not load translations (whereas system tests do). If you need real translations, you can override this behavior with the following code added to your integration test:
    ```
    protected static function configureFixture($fixture)
    {
        $fixture->extraTestEnvVars['loadRealTranslations'] = true;
    }
    ```
* **I want to track requests in my integration test, but they are not tracking and giving an empty response.**: There are a lot of reasons this could happen, but the most common is that there is no superuser created and the tracker cannot authenticate. Integration tests by default do not create real superuser before running tests. You can override this behavior with the following code added to your integration test:
    ```
    protected static function configureFixture($fixture)
    {
        $fixture->createSuperUser = true;
    }
    ```

### Custom behavior for tests

Whenever possible, you should be using [dependency injection](https://developer.matomo.org/guides/dependency-injection) to change behaviour in tests. For example if you don't want to fetch data from a remote service but instead use a local fixture then you could create a file in `plugins/MyPluginName/config/test.php` where you return a regular array and overwrite any DI dependency.

If DI is not possible or not trivial to use, then you can check if tests are currently being executed by using `$isTestMode = defined('PIWIK_TEST_MODE') && PIWIK_TEST_MODE;`.

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

## Special Tests

Most unit and integration tests in Matomo test a single class, or at most a matomo subsystem. One test, however, is special in that they don't test Matomo behavior, but instead tests that Matomo is ready to be released. This test is called **ReleaseCheckListTest** and performs the following types of tests:

* checking that deprecated methods have been removed by a certain date
  When developers mark a method as @deprecated, we will sometimes want to make sure we remove it by a certain time, after we've given plugin developers a chance to stop using it. This can be by a certain time or by the time a major version of Matomo is released.
* checking resource files are at the latest version or are otherwise ready to be released
* test debugging code was not accidentally left in some code
* and many other things.

Plugins sometimes define their own version of this test.

## Fixing a broken system tests build

### When the build fails locally

Locate the directory of the `processed` and `expected` tests directory for the test you are executing. For example `plugins/YourPluginName/tests/System/` or `tests/PHPUnit/System/`.

You can then compare the two directories for changes. If you are using PHPStorm, then simply select both `processed` and `expected` directories and then right click and select `Compare Directories`. There you can see the changes for each file and update any processed file if needed. If you don't use PHPStorm, then check if your IDE offers a similar feature or use a linux command like `diff processed expected`.

Once you have updated all expected files, then you need to `git add` and `git commit` and `git push` these changes.

### When the build fails on Travis

System PHP tests in Matomo typically execute an API method and compare the entire XML output of the API method with an expected XML output.

If you are making changes to Matomo then the result of such an API method may change and break the build. This is an opportunity to review your code and as a Matomo developer you should ensure that
any change in the output is actually expected.

If they are not expected, determine the cause of the change and fix it in a new commit. If the changes are expected,
then you should update the expected system files accordingly. To compare and update the expected system files, follow these steps:

* Find out the Travis build number by opening the Travis run for your pull request. The build number is typically a 5 or 6 digit number and has a leading hash character. For example when the build is `#45511`, then `45511` is the build number.
* Execute this command and replace `{buildnumber}` with the actual build number. `./console development:sync-system-test-processed {buildnumber}`.
  * To update the expected files directly append the option `--expected`. You then need to make sure before committing and pushing these changes that every change is actually expected
  * Or if you only want to update some files or if you don't use a visual tool for git then you can execute the command without the expected option in which case the system files are updated in the `processed` directory. For example `tests/PHPUnit/System/processed` and `plugins/Goals/tests/System/processed`. If you are using PHPStorm you can then select both the processed and expected directory and then `right click -> Compare Directories`. This allows you to review every change of added, changed and removed files and let's you update each expected file individually. 
* Then `git add` and `git commit` and `git push` the changes to trigger another build run 
* If some tests are still failing you may need to repeat this process as sometimes you might forget to update some

### To fix a broken build, follow these steps:

## Learn more

* To learn more about **what you can do with PHPUnit** read PHPUnit's [user documentation](https://phpunit.de/documentation.html).
