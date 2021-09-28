---
category: DevelopInDepth
---
# System tests

System tests files are in `tests/PHPUnit/System/*Test.php`

System tests allow to test how major Matomo components interact together.
A test will typically generate hits to the Tracker (record visits and page views)
and then test all API responses and for each API output. It then checks that they match expected XML (or CSV, json, etc.).
If a test fails, you can compare the processed/ and expected/ directories in a graphical text compare tool, such as WinMerge on Win, or MELD on Linux, or even with PhpStorm, to easily view changes between files.

For example using Meld, click on "Start new comparison", "Directory comparison",
in "Original" select "path/to/matomo/tests/PHPUnit/System/expected"
in "Mine" select "path/to/matomo/tests/PHPUnit/System/processed"

If changes are expected due to the code changes you make, simply copy the file from processed/ to expected/, and test will then pass. Copying files is done easily using Meld (ALT+LEFT).
Otherwise, if you didn't expect to modify the API outputs, it might be that your changes are breaking some features unexpectedly.

## Fixtures for System tests

System tests use Fixtures to generate controlled web usage data (visits, goals, pageviews, events, site searches, content tracking, custom variables, etc.).

Fixtures are stored in [tests/PHPUnit/Fixtures](https://github.com/matomo-org/matomo/tree/master/tests/PHPUnit/Fixtures)

### OmniFixture

We also have an OmniFixture that includes all other Fixtures. OmniFixture is used for screenshot tests to provide data across most reports.

### Keep OmniFixture up to date

Remember to update the [Omnifixture SQL dump](https://github.com/matomo-org/matomo/blob/master/tests/resources/OmniFixture-dump.sql) whenever you make any change to any fixture. You can use:

    ./console tests:setup-fixture OmniFixture --sqldump=OmniFixture-dump.sql

Keeping the OmniFixture up to date makes it easier to see which tests fail after each small fixture change.

If we don't update the OmniFixture then we end up with many failed screenshots tests which makes it hard to see whether those changes are expected or not.

### Scheduled Reports Tests

As part of our system tests we generate the scheduled reports (in HTML, PDF & SMS).
Some of these scheduled reports contain PNG graphs. Depending on the system under test, generated images can differ.
Therefore, PNG graphs are only tested and compared against "expected" graphs, if the system under test has the same characteristics as the integration server.
The characteristics of the integration server are described in `SystemTestCase::canImagesBeIncludedInScheduledReports()`

## Writing system tests

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

## Fixtures

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

## Expected and processed output

System tests will generate an expected output file for every API method and period combination. The generated output (also called *processed* output) is stored in the `processed/` subdirectory of your plugin's `Test/` directory. The expected output should be stored in a directory named `expected/`.

When you first create a system test, there will be no expected files. You will have to copy processed files to the expected folder after ensuring they are correct.

## Troubleshooting

**Only generated N API calls to test but was expecting more for this test.**

Sometimes when writing a test you'll see this error in the test output:

```
Only generated N API calls to test but was expecting more for this test
Want to test APIs: ...
But only generated these URLs:
...
```

This can have the following possible causes:

* You're trying to test API methods that do not start with `get`. System tests are designed only to be able to test
  `get` API methods.
* You're missing a required parameter in a specific API call or it's being set to `null` or equivalent. To determine
  what the root issue is here, you'll need to inspect the variable `$nameVariable` in this if statement:
  [https://github.com/matomo-org/matomo/blob/4.2.0/core/API/DocumentationGenerator.php#L40-L41](https://github.com/matomo-org/matomo/blob/4.2.0/core/API/DocumentationGenerator.php#L40-L41)

## Writing tests for commands

It is also possible to write system tests for console commands. These tests should extend `Piwik\Tests\Framework\TestCase\ConsoleCommandTestCase`. 

Example for a test that tests the `config:set` command:

```php
class MyCommandTest extends \Piwik\Tests\Framework\TestCase\ConsoleCommandTestCase
{

    public function test_command_succeedsWhenOptionsUsed()
    {
        // execute the command with few different options
        $code = $this->applicationTester->run(array(
            'command' => 'config:set',
            '--section' => 'MySection',
            '--key' => 'setting',
            '--value' => 'myvalue',
            '-vvv' => false,
        ));

        // assert exit code
        $this->assertEquals(0, $code, $this->getCommandDisplayOutputErrorMessage()); 

        // assert the command actually performed the correct action
        $config = $this->makeNewConfig();
        $this->assertEquals(array('setting' => 'myvalue'), $config->MySection);

        // assert printed command output
        self::assertStringContainsString('Setting [MySection] setting = "myvalue"', $this->applicationTester->getDisplay());
    }

}
```
