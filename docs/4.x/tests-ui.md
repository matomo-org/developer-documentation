---
category: Develop
previous: tests-php
next: tests-js-tracker
---
# UI Tests

Some might know a UI test under the term 'CSS test' or 'screenshot test'. When we speak of UI tests we mean automated tests that capture a screenshot of a URL and then compare the result with an expected image. If the images are not exactly the same the test will fail. For more information read our blog post about [UI Testing](https://matomo.org/blog/2013/10/our-latest-improvement-to-qa-screenshot-testing/).

**What is a UI test good for?**

We use them to test our PHP Controllers, Twig templates, CSS, and indirectly test our JavaScript. We usually don't write Unit or Integration tests for our controllers. For example, we use UI tests to ensure that the installation, the login and the update process works as expected. We also have tests for most pages, reports, settings, etc. This increases the quality of our product and saves us a lot of time as it is easy to write and maintain such tests. All UI tests are executed on [Travis](https://travis-ci.org/matomo-org/matomo) after each commit and compared with [our expected screenshots](https://github.com/matomo-org/matomo-ui-tests).

**When is it better to create a php tests?** 

We usually don't create a UI test if the same logic or behaviour can be tested using an integration or system test and the UI isn't actually rendering any custom UI. For example if something is throwing an excption, then the generic error UI will be used and as there is no custom UI an integration or system test may be better suited to check if an exception is triggered as it's more easy to debug, more clear what goes wrong, easier to write these tests and they are faster to execute. 

## Requirements

Unit, integration and system tests are fairly straightforward to run. UI tests, on the other hand, need a bit more work.

You'll need to install [nodejs and npm](https://nodejs.org/en/download/) first. Once you've done this, you can run npm to install the JavaScript dependencies for the UI tests:

```
// Starting from the root directory of your Matomo install
cd tests/lib/screenshot-testing
$ npm install
```

If you are running or writing UI tests for [Matomo Core](https://github.com/matomo-org/matomo), you will need to install the [git-lfs](https://git-lfs.github.com/) extension to be able to download and commit UI screenshots. Then you can pull the example screenshots for the tests:

```
$ git lfs pull --exclude=
// NOTE: the --exclude= is important, because by default Matomo tells git not to pull these files (to save on bandwidth)
```

If you're on Ubuntu, you'll need some extra packages to make sure screenshots will render correctly:

```
$ sudo apt-get install ttf-mscorefonts-installer imagemagick imagemagick-doc
```

Removing this font may be useful if your generated screenshots' fonts do not match the expected screenshots:

```
$ sudo apt-get remove ttf-bitstream-vera
```

On Ubuntu 18.04, you may also need to download and install [libpng12](https://packages.ubuntu.com/xenial/amd64/libpng12-0/download).

## Configuring UI tests

The screenshot testing library's configuration resides in the `tests/UI/config.dist.js` file.
If your development environment's PHP executable isn't named `php`
or your dev Piwik install isn't at `http://localhost/` you may need to copy that file to
`tests/UI/config.js` and edit the contents of this file.

For example if Piwik is set up at `http://localhost/matomo` modify the config.js such as:
```
exports.piwikUrl = "http://localhost/matomo/";
exports.phpServer = {
    HTTP_HOST: 'localhost',
    REQUEST_URI: '/matomo/',
    REMOTE_ADDR: '127.0.0.1'
};

```

## Creating a UI test

We start by using the [Piwik Console](https://developer.matomo.org/guides/piwik-on-the-command-line) to create a new UI test:

```bash
./console generate:test --testtype ui
```

The command will ask you to enter the name of the plugin the created test should belong to. For the rest of this guide we assume you're using the plugin name "Widgetize". Next it will ask you for the name of the test. Here you usually enter the name of the page or report you want to test. We will use the name "WidgetizePage" in this example. There should now be a file `plugins/Widgetize/tests/UI/WidgetizePage_spec.js` which contains already an example to get you started easily:

```javascript
describe("WidgetizePage", function () {
    var generalParams = 'idSite=1&amp;period=day&amp;date=2010-01-03';

    it('should load a simple page by its module and action', function (done) {
        var urlToTest = "?" + generalParams + "&amp;module=Widgetize&amp;action=index";
        page.load(urlToTest);

        var screenshotName = 'simplePage';
        // will save image in "processed-ui-screenshots/WidgetizePageTest_simplePage.png"
        expect(await page.screenshot()).to.matchImage(screenshotName);
    });
});
```

### What is happening here?

This example declares a new set of [specs](https://en.wikipedia.org/wiki/Behavior-driven_development#Behavioural_specifications) by calling the method `describe(name, callback)` and within that a new spec by calling the method `it(description, func)`. Within the spec we load a URL and once loaded capture a screenshot of the whole page. The captured screenshot will be saved under the defined `screenshotName`. You might have noticed we write our UI tests in [BDD](https://en.wikipedia.org/wiki/Behavior-driven_development) style.

### Capturing only a part of the page
It is good practice to not always capture the full page. For example many pages contain a menu and if you change that menu, all your screenshot tests would fail. To avoid this you would instead have a separate test for your menu. To capture only a part of the page simply specify a [jQuery selector](https://api.jquery.com/category/selectors/) and use `page.$` to get the element to capture, or call `page.screenshotSelector`:

```javascript
var myElement = page.$('#myElement');
// Only the content of the selected element will be in visible in the captured screenshot
expect (await myElement.screenshot()).to.matchImage("screenshot_name");
```

```javascript
var contentSelector = '#selector1, .selector2 .selector3';
// Only the content of both selectors will be in visible in the captured screenshot
expect (await page.screenshotSelector(contentSelector)).to.matchImage("screenshot_name");
```

### Hiding content

There is a known issue with sparklines that can fail tests randomly. Also version numbers or a date that changes from time to time can fail tests without actually having an error. To avoid this you can prevent elements from being visible in the captured screenshot via CSS as we add a CSS class called `uiTest` to the `HTML` element while tests are running.

```css
.uiTest .version { visibility:hidden }
```

## Running UI tests

To run the previously generated tests, use the command `tests:run-ui`:

```
$ ./console tests:run-ui WidgetizePage
```

or to run every UI test for a plugin:

```
$ ./console tests:run-ui --plugin=MyPlugin
```

After running the tests for the first time you will notice a new folder `plugins/PLUGINNAME/tests/UI/processed-ui-screenshots` in your plugin. If everything worked, there will be an image for every captured screenshot. If you're happy with the result it is time to copy the file over to the `expected-ui-screenshots` folder, otherwise you have to adjust your test until you get the result you want. From now on, the newly captured screenshots will be compared with the expected images whenever you execute the tests.

Some fixtures can take a long while to set up. You can save time by using the `persist-fixture-data` flag, which means the fixture teardown and setup will be skipped and the test database from the previous execution will be used:

```
$ ./console tests:run-ui WidgetizePage --persist-fixture-data
```

### Useful options

The following options may be useful if you plan on running the UI tests locally often:

* **--persist-fixture-data**: This will save the test data in a separate database so the setup only has to be run once.
  This can save 5 mins per screenshot test run.
* **--drop**: If you've used --persist-fixture-data and need to re-setup the separate data, use this option with --persist-fixture-data.
* **--keep-symlinks**: If you want to visit the URLs of captured pages in a browser to diagnose failures use this option.
  This will keep the recursive symlinks in tests/PHPUnit/proxy.

### Fixing a test

At some point your UI test will fail, for example due to expected CSS changes. To fix a test all you have to do is to copy the captured screenshot from the folder `processed-ui-screenshots` to the folder `expected-ui-screenshots`.

## Writing a UI test in depth

UI screenshot tests are run directly by Puppeteer and are written using [mocha](https://mochajs.org/) and [chai](https://chaijs.com).

All test files should have \_spec.js file name suffixes (for example, `ActionsDataTable_spec.js`). Since screenshots can take a while to capture, you will want to override mocha's default timeout like this:

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
        await page.goto(url);
        var myElement = await page.$('#myElement');
        expect(await myElement.screenshot()).to.matchImage("screenshot_name");
    });
});
```

### Manipulating pages before capture

You can use any method from the <a href="https://pptr.dev/#?product=Puppeteer&version=v1.18.0&show=api-class-page">Puppeteer library</a> to manipulate the page before you take a screenshot. Matomo also provides a couple of extra methods:

- **waitForNetworkIdle()**: Wait for all requests to finish. Automatically called on functions that load a page.
- **screenshotSelector(selector)**: An alternative to `element.screenshot()`.

### Adding test data in a UI test

Some of your tests may require specific data to exist in Piwik's DB. To add this data, you can define a [PHP fixture class](/guides/tests-system#fixtures) and set it as the fixture to use in your UI test, like so:

```javascript
describe("TheControlImTesting", function () {
    this.timeout(0);

    this.fixture = "Piwik\\Plugins\\MyPlugin\\tests\\Fixtures\\MySpecialFixture";

    // ... rest of the test spec ...
});
```

The fixture you use must derive from the `Piwik\Tests\Framework\Fixture` class and must be visible to Piwik's autoloader.

*Note: The test data added by the fixture will not be removed and re-added before each individual test.*

Learn more about defining fixtures [here](/guides/tests-system#fixtures).

### Manipulating the test environment

Sometimes it will be necessary to manipulate Piwik for testing purposes. You may want to remove randomness, manipulate data or simulate certain situations (such as there being no `config.ini.php` file). This section describes how you can do that.

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

 * [Overlay_spec.js](https://github.com/matomo-org/matomo/blob/master/tests/UI/specs/Overlay_spec.js)
 * [Dashboard_spec.js](https://github.com/matomo-org/matomo/blob/master/tests/UI/specs/Dashboard_spec.js)
 * [Login_spec.js](https://github.com/matomo-org/matomo/blob/master/tests/UI/specs/Login_spec.js)

#### Dependency injection configuration

On top of calling API, controllers, and setting up INI options you can also register dependency injection configuration. This allows to replace a service or a configuration value in order to mock or simulate a behavior.

To do this, you need to implement `provideContainerConfig()` in a fixture class and return [a valid DI configuration](https://php-di.org/doc/definition.html). For example:

```php
class FailUpdateHttpsFixture extends Fixture
{
    public function provideContainerConfig()
    {
        return array(
            'Piwik\Plugins\CoreUpdater\Updater' => \DI\autowire('Piwik\Plugins\CoreUpdater\Test\Mock\UpdaterMock'),
        );
    }
}
```

Then by simply setting up this fixture in your test Piwik will load the DI configuration in every PHP request or process:

```javascript
describe("PiwikUpdater", function () {
    this.fixture = "Piwik\\Plugins\\CoreUpdater\\Test\\Fixtures\\FailUpdateHttpsFixture";

    it("should ...", function () {
        // ...
    });
});
```

## Troubleshooting UI tests

If a UI test fails and it's not clear why, then open all the Travis UI jobs in your browser and check if there was any warning or error logged for a particular UI test. Please note that at the time of writing there are 3 jobs in each travis build dedicated to UI tests (so they complete faster than one long running job) and you need to click into each job to find the output for a specific UI test. You can identify that a travis job was running a UI test by looking in the environment variables for the jobs that have `TEST_SUITE=UITests`. Within the output of a specific job, you can find the UI test by searching for the name of the UI test, for example `"should show percent metrics like bounce rate correctly`". Simply search each of the UI jobs for the name of the test that is failing and see if there's any additional information printed.

### Checklist for common problems

* If the screenshot is showing a message `already installed` or `not installed yet` then make sure the URL you open as part of the `page.goTo()` call starts with a question mark (`?`).

## Fixing a broken build

Changes made to Matomo that affect the UI (such as changes to CSS, JavaScript, Twig templates or even PHP code) may
break the UI tests build. This is an opportunity to review your code and as a Matomo developer you should ensure that
any side effects created by your changes are expected.

If they are not expected, determine the cause of the change and fix it in a new commit. If the changes are correct,
then you should update the expected screenshots accordingly.

### To fix a broken build, follow these steps:

See also below the steps for how to sync the files automatically.

* Go to the Tests travis build: [https://travis-ci.org/matomo-org/matomo](https://travis-ci.org/matomo-org/matomo) and select the build containing `TEST_SUITE=UITests`
* Find the build you are interested in. The UI tests build will be run for each commit in each branch, so if you're
  looking to resolve a specific failure, you'll have to find the build for the commit you've made.
* In the build output, at the beginning of the test output, there will be a link to a image diff viewer. It will look something
  like this:

      View UI failures (if any) here https://builds-artifacts.matomo.org/ui-tests.master/1837.1/screenshot-diffs/diffviewer.html

  Click on the link in the message.
* The diff viewer will list links to the generated screenshots for failed tests as well as the expected screenshots and image diffs.
* For each failure, check if the change is desired. Sometimes we introduce regression without realising, and screenshot tests can help us spot such regressions.
    * If a change is not wanted, revert or fix your commit.
    * If a change is correct, then you can set the new screenshot as the expected screenshot.
      To do so, in the diffviewer.html page click on the "Processed" link for this screenshot.
      Then "Save this file as" and save it in the piwik/tests/UI/expected-screenshots/ directory.
      (If the screenshot test is for a plugin and not Piwik Core, the expected screenshot should be added to the
      plugin's expected screenshot directory. For example: piwik/plugins/DBStats/tests/UI/expected-screenshots.)

  _Note: When determining whether a screenshot is correct, the data displayed is not important. Report data correctness is verified through System and other PHP tests. The UI tests should only test UI behavior._
* Push the changes (to your code and/or to the expected-screenshots directory).
* Wait for next Test build [on travis](https://travis-ci.org/matomo-org/matomo). Hopefully, the build should be green!

#### Sync command 

The `tests:sync-ui-screenshots` console command can be used to speed up the process. Run `./console tests:sync-ui-screenshots -h` to learn more._

For example executing `./console tests:sync-ui-screenshots {buildnumber}`, the script will automatically download all screenshots of tests that failed on Travis (meaning there was a change in the expected screenshot compared to the processed screenshot).

## Learn more

Check out this blog post to learn more about Screenshot Tests in Piwik:
[QA Screenshot Testing blog post](https://matomo.org/blog/2013/10/our-latest-improvement-to-qa-screenshot-testing/)
