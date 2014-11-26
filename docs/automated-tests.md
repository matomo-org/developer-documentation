---
category: Develop
---
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

* you'd like to know **how to run the testing suite used to test Piwik core**
* you'd like to know **how to add automated testing to your plugin so you can catch bugs before your users do**

**Guide assumptions**

This guide assumes that you:

* can code in PHP,
* can use PHPUnit,
* have a general understanding of extending Piwik (if not, read our [Getting Started](/guides/getting-started-part-1) guide),
* and understand how Piwik handles requests (if not, read our [MVC in Piwik](/guides/mvc-in-piwik) guide).

## Piwik's automated testing suite

Piwik Core contains a suite of tests used to make sure that Piwik works properly and that new commits do not introduce new bugs. These are the types of tests in this suite: **unit tests**, **integration tests**, **system tests** and **ui tests**.

- **Unit tests** test individual classes isolated from the rest of the code to make sure they work correctly as a unit.

- **Integration tests** test several parts working together, e.g. a test using a database.

- **System tests** test Piwik's [Reporting API](/guides/piwiks-reporting-api) and [archiving logic](/guides/all-about-analytics-data#the-archiving-process) by tracking visits and checking that the output of certain API queries matches the expected output.

- **UI tests** test Piwik's twig templates, JavaScript and CSS by tracking visits, generating screenshots of URLs with [phantomjs](http://phantomjs.org/) and comparing expected screenshots with generated ones.

### UI tests

Unit, integration and system tests are fairly straightforward to run. UI tests, on the other hand, need a bit more work. To run UI tests you'll need to install [phantomjs version 1.9 or higher](http://phantomjs.org/download.html) and make sure `phantomjs` is on your PATH. Then you'll have to get the tests which are located in another repository but are included in Piwik as a submodule:

    $ git submodule init
    $ git submodule update

If you're on Ubuntu, you'll also need some extra packages to make sure screenshots will render correctly:

    $ sudo apt-get install ttf-mscorefonts-installer imagemagick imagemagick-doc

### Running tests

Piwik Core's tests can be run in two ways. The first is to use the **console** command line tool by running:

    $ ./console tests:run

or to run a specific set of test suites

    $ ./console tests:run unit
    $ ./console tests:run integration
    $ ./console tests:run system

To run the tests in a single file in the set of unit or integration tests, you will have to use the second method, which is to call [phpunit](http://phpunit.de/) directly:

    # first, we must be in the PHPUnit directory, so
    $ cd tests/PHPUnit
    $ phpunit Unit
    $ phpunit Integration

or

    $ phpunit Unit/CommonTest.php
    $ phpunit System/ArchiveCronTest.php

To run UI tests, run the **tests:run-ui** command:

    $ ./console tests:run-ui MyTestSpecName

or to run every UI test for a plugin,

    $ ./console tests:run-ui --plugin=MyPlugin

## Testing your plugins

If you're creating a new plugin that defines new reports or has some complex logic, you may find it beneficial to engage in [Test Driven Development](http://en.wikipedia.org/wiki/Test-driven_development) or at least to verify your code is correct with tests. With tests you'll be able to ensure that your code works and you'll be able to ensure the changes you make don't cause regressions.

At the moment, you can write unit, integration or system tests for your plugins. This section will explain how.

*Note: All test files must be put in a `Test/` directory located in the root directory of your plugin.*

### Writing unit tests

To create a simple unit test that doesn't need a MySQL database, create a test case that extends [PHPUnit_Framework_TestCase](http://apidoc.phpunit.de/classes/PHPUnit_Framework_TestCase.html).

You can read [this blogpost](http://piwik.org/blog/2014/11/how-to-write-unit-tests-for-your-plugin-introducing-the-piwik-platform/) to learn in details how to write unit tests for Piwik.

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

```
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

### Writing UI tests

UI screenshot tests are run directly by phantomjs and are written using [mocha](http://visionmedia.github.io/mocha/) and [chai](http://chaijs.com).

To create a new test, first decide whether it belongs to Piwik Core or a plugin. If it belongs to Piwik Core, the test should be placed within the [piwik-ui-tests](https://github.com/piwik/piwik-ui-tests) repository. Otherwise, it should be placed within `Test/UI` sub-directory of your plugin.

All test files should have \_spec.js file name suffixes (for example, `ActionsDataTable_spec.js`).

Tests should be written using [BDD](http://en.wikipedia.org/wiki/Behavior-driven_development) style, for example:

```javascript
describe("TheControlImTesting", function () {
    // ...
});
```

Since screenshots can take a while to capture, you will want to override mocha's default timeout like this:

```javascript
describe("TheControlImTesting", function () {
    this.timeout(0);

    // ...
});
```

Each test should use Piwik's special chai extension to capture and compare screenshots:

```javascript
describe("TheControlImTesting", function () {
    this.timeout(0);

    var url = // ...

    it("should load correctly", function (done) {
        expect.screenshot("screenshot_name").to.be.capture(function (page) {
            page.load(url);
        }, done);
    });
});
```

If you want to compare a screenshot against an already existing expected screenshot you can do the following:

```javascript
it("should load correctly", function (done) {
    expect.screenshot("screenshot_to_compare_against", "OptionalPrefix").to.be.capture("processed_screenshot_name", function (page) {
        page.load(url);
    }, done);
});
```

`"OptionalPrefix"` will default to the name of the test.

### Manipulating pages before capture

The callback supplied to the `capture()` function accepts one argument: the page renderer. You can use this object to queue events to be sent to the page before taking a screenshot. For example:

```javascript
.capture(function (page) {
    page.click('.myDropDown');
    page.mouseMove('.someOtherElement');
}, done);
```

After each event the page renderer will wait for all AJAX requests to finish and for all images to load and then will wait an additional second for any JavaScript to finish running. If you want to wait longer, you can supply an extra wait time (in milliseconds) to the event queuing call:

```javascript
.capture(function (page) {
    page.click('.something');
    page.click('.myReallyLongRunningJavaScriptFunctionButton', 10000); // will wait for 10s
}, done);
```

*Note: phantomjs has its quirks and you may have to hack around to get certain behavior to work. For example, clicking a `<select>` will not open the dropdown, so dropdowns have to be manipulated via JavaScript within the page (ie, the `.evaluate()` method).*

**Page Renderer Object Methods**

The page renderer object has the following methods:

 * **click(selector, [modifiers], [waitTime])**: Sends a click to the element referenced by `selector`. Modifiers is an array of strings that can be used to specify keys that are pressed at the same time. Currently only `'shift'` is supported.
 * **mouseMove(selector, [waitTime])**: Sends a mouse move event to the element referenced by `selector`.
 * **mousedown(selector, [waitTime])**: Sends a mouse down event to the element referenced by `selector`.
 * **mouseup(selector, [waitTime])**: Sends a mouse up event to the element referenced by `selector`.
 * **sendKeys(selector, keyString, [waitTime])**: Clicks an element to bring it into focus and then simulates typing a string of keys.
 * **sendMouseEvent(type, pos. [waitTime])**: Sends a mouse event by name to a specific position. `type` is the name of an event that phantomjs will recognize. `pos` is a point, eg, `{x: 0, y: 0}`.
 * **dragDrop(selectorStart, selectorEnd, waitTime)**: Performs a drag/drop of an element (mousedown, mousemove, mouseup) from the element referenced by `selectorStart` and the element referenced by `selectorEnd`.
 * **wait([waitTime])**: Waits without doing anything.
 * **load(url, [waitTime])**: Loads a URL.
 * **reload([waitTime])**: Reloads the current URL.
 * **evaluate(impl, [waitTime])**: Evaluates a function (`impl`) within a webpage. `impl` is an actual function, not a string and must take no arguments.

All **selector**s are jQuery selectors, so you can use jQuery only filters such as `:eq`.

All events are real events, not synthetic DOM events.

#### Manipulating the Test Environment

Sometimes it will be necessary to manipulate Piwik for testing purposes. You may want to remove randomness, manipulate data or simulate certain situations (such as there being no config.ini.php file). This section describes how you can do that.

**In your screenshot tests,** use the global **testEnvironment** object. You can use this object to call Piwik API methods using the `callApi(method, params, callback)` method and to call Piwik Controller methods using the `callController(method, params, callback)` method.

You can communicate with PHP code by setting data on the testEnvironment object and calling `save()`, for example:

```javascript
testEnvironment.myTestVar = "abcdefg";
testEnvironment.save();
```

This data will be loaded by the `TestingEnvironment` PHP class.

**In your Piwik plugin,** handle the **TestingEnvironment.addHooks** event and use the data in the TestingEnvironment object. for example:

```php
// event handler in a plugin descriptor class
public function addTestHooks($testingEnvironment) {
    if ($testingEnvironment->myTestVar) {
        // ...
    }
}
```

*Note: the Piwik environment is not initialized when the **TestingEnvironment.addHooks** event is fired, so attempts to use the Config and other objects may fail. It is best to use Piwik::addAction to inject logic.*

The following are examples of test environment manipulation:

 * [Overlay_spec.js](https://github.com/piwik/piwik-ui-tests/blob/master/specs/Overlay_spec.js)
 * [Dashboard_spec.js](https://github.com/piwik/piwik-ui-tests/blob/master/specs/Dashboard_spec.js)
 * [Login_spec.js](https://github.com/piwik/piwik-ui-tests/blob/master/specs/Login_spec.js)

### Running plugin tests

To run the tests for your plugin, run the following command in the root of your Piwik install:

```bash
$ ./console tests:run MyPlugin
```

Where `MyPlugin` should be replaced with the name of your plugin.

For UI tests run:

```bash
$ ./console tests:run-ui --plugin=MyPlugin
```

### Running your tests on Travis-CI

[Travis-CI](http://travis-ci.org) is a continuous integration tool that will run tests for a GitHub repository every time commits are pushed. Piwik uses Travis to automatically run its test suite on every commit (for every branch and pull request).

Plugins can do the same if they include a `.travis.yml` file in their github repository. You can generate this file using the `generate:travis-yml` Piwik console command:

```bash
$ ./console generate:travis-yml --plugin=MyPlugin
```

The command will automatically detect if you have unit and/or UI tests in your plugin's `Test/` directory and create a `.travis.yml` file that will run them. The tests will be run against both Piwik **master** and against the latest stable version.

#### Autoupdating the .travis.yml file

The `generate:travis-yml` will be changed over time as we modify the travis build process. The generated .travis.yml file will check if it is out of date from within travis and let you know by failing the build. In such a case you will have to re-run the command and commit the changes to get the build to run again.

To avoid having to do this you can setup auto-updating by using the `--github-token=` option when calling **generate:travis-yml**. You should supply a [GitHub token](https://help.github.com/articles/creating-an-access-token-for-command-line-use) that has read and write access to the repository the build is for. When a .travis.yml file is found to be out of date, the Travis build will update the file and push a commit using the GitHub token.

*Note: You will need the [travis command line tool](http://blog.travis-ci.com/2013-01-14-new-client/) to setup auto-updating.*

## Learn more

* To learn more about **what you can do with PHPUnit** read PHPUnit's [user documentation](http://phpunit.de/documentation.html).
