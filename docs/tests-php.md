---
category: Develop
previous: tests
next: tests-ui
---
# PHP Tests

## Piwik's PHP tests

As explained in the previous guide, Piwik's test suite contains PHP tests and UI tests (written in JavaScript).

The PHP test suite is written and run using [PHPUnit](https://phpunit.de). Tests are categorized like so:

- **Unit tests** test individual classes isolated from the rest of the code to make sure they work correctly as a unit
- **Integration tests** test several parts working together, e.g. a test using a database
- **System tests** test Piwik's [Reporting API](/guides/piwiks-reporting-api) and [archiving logic](/guides/all-about-analytics-data#the-archiving-process) by tracking visits and checking that the output of certain API queries matches the expected output

## Running PHP tests

Piwik Core's tests can be run in two ways. The first is to use the **console** command line tool by running:

    $ ./console tests:run
    # You can specify a specific test suite:
    $ ./console tests:run unit
    $ ./console tests:run integration
    $ ./console tests:run system

The second method is by using [PHPUnit](http://phpunit.de/) directly. This method also allows you to run tests of a single file:

    $ cd tests/PHPUnit
    $ phpunit Unit
    $ phpunit Integration
    # or also
    $ phpunit Unit/CommonTest.php
    $ phpunit System/ArchiveCronTest.php

## Testing your plugins

If you're creating a new plugin that defines new reports or has some complex logic, you may find it beneficial to engage in [Test Driven Development](http://en.wikipedia.org/wiki/Test-driven_development) or at least to verify your code is correct with tests. With tests you'll be able to ensure that your code works and you'll be able to ensure the changes you make don't cause regressions.

*Note: All test files must be put in a `Test/` directory located in the root directory of your plugin.*

### Writing unit tests

A unit test tests only a single method or class and does not use dependencies like the filesystem, web, config, database or to any other plugin.

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
class WidgetsTest extends \PHPUnit_Framework_TestCase
{
    public function testSimpleAddition()
    {
        $this->assertEquals(2, 1+1);
    }
}
```

### Writing integration tests

If your test needs access to a test Piwik database, create a test case that extends `Piwik\Tests\Framework\TestCase\IntegrationTestCase`. This base class provides a `setUp()` method that creates a test Piwik database and a `tearDown()` method that removes it.

### Writing system tests

To create a system test, extends `Piwik\Tests\Framework\TestCase\SystemTestCase`. Then implement the `getApiForTesting()` method. This method should return an array of arrays. Each nested array contains information for a single test.

The first element in the array should be one or more API methods or the `'all'` string. This determines which API methods whose output should be compared against expected files. The second element should be an associative array that contains a set of options that affect the way the test is run or URL used to invoke the API method. You are allowed to set the following options:

* **testSuffix**: The suffix added to the output file name. If you call a single API method more than once in an system test, all but one of them should have a **testSuffix** set so different output files will be created.
* **format**: The desired format of the output. Defaults to `'xml'`. The extension of the output is determined by the format.
* **idSite**: The ID of the website to get data for or `'all'`.
* **date**: The date to get data for.
* **periods**: The period or periods to get data for. Can be an array. For example, `'day'` or `array('day', 'month')`.
* **setDateLastN**: Flag describing whether to query for a set of dates or not.
* **language**: The language to use.
* **segment**: The segment to use.
* **idGoal**: Sets the idGoal query parameter to this value.
* **apiModule**: The value to use in the apiModule request parameter.
* **apiAction**: The value to use in the apiAction request parameter.
* **otherRequestParameters**: An array of extra request parameters to use.
* **disableArchiving**: If true, disables archiving before running tests.

Some examples:

```php
public function getApiForTesting()
{
    $idSite = self::$fixture->idSite;
    $dateTime = self::$fixture->dateTime;

    return array(
        // test a single API method
        array('UserSettings.getResolution', array('idSite' => $idSite, 'date' => $dateTime)),

        // test all methods in a plugin
        array('API', array('idSite' => $idSite, 'date' => $dateTime)),

        // test every API method
        array('all', array('idSite' => $idSite, 'date' => $dateTime)),

        // set some custom request parameters
        array('API.getBulkRequest', array('format' => 'xml',
                                          'testSuffix' => '_bulk_xml',
                                          'otherRequestParameters' => array('urls' => $bulkUrls))),

        // test multiple dates w/ multiple periods and multiple sites
        array('UserSettings.getResolution', array('idSite' => 'all',
                                                  'date' => $dateTime,
                                                  'periods' => array('day', 'week', 'month'),
                                                  'setDateLastN' => true)),
    );
}
```

After implementing `getApiForTesting()`, add the following test to the file:

```php
/**
 * @dataProvider getApiForTesting
 * @group        System
 */
public function testApi($api, $params)
{
    $this->runApiTests($api, $params);
}
```

This will test every API method specified in `getApiForTesting()`.

#### Fixtures

Before you can run your tests, you'll have to set the test's fixture. **Fixtures** add test data to the database by adding websites, tracking visits, etc.

To set a fixture, add a `public static` field named `$fixture` to your test class and initialize it below the class definition, for example:

```php
namespace Piwik\Plugins\MyPlugin\Test;

use Piwik\Tests\Framework\TestCase\SystemTestCase;

class MySystemTest extends SystemTestCase
{
    public static $fixture = null;

    // ...
}

MySystemTest::$fixture = new \Test_Piwik_Fixture_ThreeGoalsOnePageview();
```

To see the fixtures Piwik defines, see the files in the `tests/PHPUnit/Fixtures` directory.

You can create your own fixture as well, just extend `Piwik\Tests\Framework\Fixture` and place the file in the `Test/Fixtures/` directory of your plugin.

#### Expected and processed output

System tests will generate an expected output file for every API method and period combination. The generated output (also called *processed* output) is stored in the `processed/` subdirectory of your plugin's `Test/` directory. The expected output should be stored in a directory named `expected/`.

When you first create a system test, there will be no expected files. You will have to copy processed files to the expected folder after ensuring they are correct.

### Running plugin tests

To run the tests for your plugin, run the following command in the root of your Piwik install:

```
$ ./console tests:run MyPlugin
```

Where `MyPlugin` should be replaced with the name of your plugin.

For UI tests run:

```
$ ./console tests:run-ui --plugin=MyPlugin
```

## Learn more

* To learn more about **what you can do with PHPUnit** read PHPUnit's [user documentation](http://phpunit.de/documentation.html).
