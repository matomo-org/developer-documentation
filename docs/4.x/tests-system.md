---
category: DevelopInDepth
---
# Writing system tests

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
