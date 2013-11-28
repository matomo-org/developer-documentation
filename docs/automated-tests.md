# Automated Tests

<!-- Meta (to be deleted)
Purpose: describe how current automated tests work (unit, integration + UI). describe how plugins can create their own unit tests, integration tests and UI tests. describe how to run tests only for plugin & how to run core tests.

Audience: plugin developers who want to test their plugins.

Expected Result: 

Notes: 

What's missing? (stuff in my list that was not in when I wrote the 1st draft)
-->

## About this guide

**Read this guide if**

* you'd like to know **how to add automated testing to your plugin so you can catch bugs before your users do**
* you'd like to know **how to run the testing suite used to test Piwik core**

**Guide assumptions**

This guide assumes that you:

* can code in PHP,
* can use PHPUnit,
* have a general understanding of extending Piwik (if not, read our [Getting Started](#) guide),
* and understand how Piwik handles requests (if not, read our [MVC in Piwik](#) guide).

## Piwik's automated testing suite

Piwik Core contains suite of tests used to make sure Piwik works properly and new commits do not introduce new bugs. There are three types of tests in this suite: **unit tests**, **integration tests** and **ui tests**.

**Unit tests** test individual classes to make sure their methods work properly. **Integration tests** test Piwik's [Reporting API](#) and [archiving logic](#) by tracking visits and checking that the output of certain API queries matches the expected output. **UI tests** tests Piwik's twig templates, JavaScript and CSS by tracking visits, generating screenshots of URLs with [phantomjs](#) and comparing expected screenshots with processed ones.

### UI tests

Unit and integration tests are fairly straightforward to run. UI tests, on the other hand, need a bit more work. To run UI tests you'll need to install [phantomjs version 1.9 or higher](#) and make sure `phantomjs` is on your PATH. Then you'll have to get the tests which are located in another repository but are included in Piwik as a submodule:

    git submodule init
    git submodule update

If you're on Ubuntu, you'll also need some extra packages to make sure screenshots will render correctly:

    sudo apt-get install ttf-mscorefonts-installer imagemagick imagemagick-doc

### Running tests

Piwik Core's tests can be run in two ways. The first is to use the [console](#) command line tool by running:

    ./console test:run

or to run a specific set of test suites

    ./console test:run Core # for unit tests
    ./console test:run Integration

To run UI tests or the tests in a single file in the set of unit or integration tests, you will have to use the second method, which is to call [phpunit](#) directly:

    # first, we must be in the PHPUnit directory, so
    cd tests/PHPUnit
    phpunit Core
    phpunit Integration
    phpunit UI

or

    phpunit Core/CommonTest.php
    phpunit Integration/ArchiveCronTest.php
    phpunit UI/UIIntegrationTest.php

## Testing your plugins

If you're creating a new plugin that defines new reports or has some complex logic, you may find it beneficial to engage in [Test Driven Development](#) or at least to verify your code is correct with tests. With tests you'll be able to ensure that your code works and you'll be able to ensure the changes you make don't cause regressions.

At the moment, you can write unit or integration tests for your plugins. This section will explain how.

_Note: All test files must be put in a **tests** directory located in the root directory of your plugin and every test you write should have the `@group` set to the name of your plugin (for example, `@group MyPlugin`)._

### Writing unit tests

To create a simple unit test that doesn't need a MySQL database to test against, create a test case that extends [PHPUnit_Framework_TestCase](#). If your test will need access to a test Piwik database, create a test case that extends the **DatabaseTestCase** class.

**DatabaseTestCase** is a Piwik test class that provides **setUp** and **tearDown** logic that creates a test database with Piwik tables.

### Writing integration tests

To create an integration test, create a test case that extends the **IntegrationTestCase** base class. Then implement the **getApiForTesting**. This method should return an array of arrays. Each nested array contains information for a single test.

The first element in the array should be one or more API methods or the `'all'` string. This determines which API methods whose output should be compared against expected files. The second element should be an associative array that contains a set of options that affect the way the test is run or URL used to invoke the API method. You are allowed to set the following options:

* **testSuffix**: The suffix added to the output file name. If you call a single API method more than once in an integration test, all but one of them should have a **testSuffix** set so different output files will be created.
* **format**: The desired format of the output. Defaults to `'xml'`. The extension of the output is determined by the format.
* **idSite**: The ID of the website to get data for or `'all'`.
* **date**: The date to get data for.
* **periods**: The period or periods to get data for. Can be an array. For example, `'day'` or `array('day', 'mont')`.
* **setDateLastN**: Flag describing whether to query for a set of dates or not.
* **language**: The language to use.
* **segment**: The segment to use.
* **visitorId**: Sets the visitorId query parameter to this value.
* **abandonedCarts**: Sets the abandonedCarts query parameter to this value.
* **idGoal**: Sets the idGoal query parameter to this value.
* **apiModule**: The value to use in the apiModule request parameter.
* **apiAction**: The value to use in the apiAction request parameter.
* **otherRequestParameters**: An array of extra request parameters to use.
* **disableArchiving**: If true, disables archiving before running tests.

Some examples:

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
                                              'periods' => array('day', 'week', 'month', 'year'),
                                              'setDateLastN' => true)),

After implementing **getApiForTesting**, add the following test to the file:

    /**
     * @dataProvider getApiForTesting
     * @group        Integration
     */
    public function testApi($api, $params)
    {
        $this->runApiTests($api, $params);
    }

This will test every API method specified in **getApiForTesting**.

#### Fixtures

Before you can run your tests, you'll have to set the test's fixture. **Fixtures** add test data to the database by adding websites, tracking visits, etc.

To set a fixture, add a `public static` field named `$fixture` to your test class and initialize it below the class definition, for example:

    namespace Piwik\Plugins\MyPlugin\Tests;

    class MyIntegrationTest extends IntegrationTestCase
    {
        public static $fixture = null;

        // ...
    }

    MyIntegrationTest::$fixture = new \Test_Piwik_Fixture_ThreeGoalsOnePageview();

To see the fixtures Piwik defines, see the files in the **tests/PHPUnit/Fixtures** directory. TODO: list them here?

#### Expected and processed output

Integration tests will generate an expected output file for every API method and period combination. The generated output (also called **processed** output) is stored in the **processed** subdirectory of your plugin's **tests** directory. The expected output should be stored in a directory named **expected**.

When you first create an integration test, there will be no expected files. You will have to copy processed files to the expected folder after ensuring they are correct.

### Writing UI tests

TODO: ensure they can be written

### Running plugin tests

To run the tests for your plugin, run the following command in the root of your Piwik install:

    ./console tests:run MyPlugin

Where `MyPlugin` should be replaced with the name of your plugin.

## Learn more

* To learn **more about what you can do with phpunit** read phpunit's [user docs](#).