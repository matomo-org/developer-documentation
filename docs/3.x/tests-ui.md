---
category: Develop
previous: tests-php
next: tests-travis
---
# UI Tests

Some might know a UI test under the term 'CSS test' or 'screenshot test'. When we speak of UI tests we mean automated tests that capture a screenshot of a URL and then compare the result with an expected image. If the images are not exactly the same the test will fail. For more information read our blog post about [UI Testing](https://piwik.org/blog/2013/10/our-latest-improvement-to-qa-screenshot-testing/).

**What is a UI test good for?**

We use them to test our PHP Controllers, Twig templates, CSS, and indirectly test our JavaScript. We usually don't write Unit or Integration tests for our controllers. For example, we use UI tests to ensure that the installation, the login and the update process works as expected. We also have tests for most pages, reports, settings, etc. This increases the quality of our product and saves us a lot of time as it is easy to write and maintain such tests. All UI tests are executed on [Travis](https://travis-ci.org/matomo-org/matomo) after each commit and compared with [our expected screenshots](https://github.com/matomo-org/piwik-ui-tests).

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

For example if Piwik is set up at `http://localhost/piwik` modify the config.js such as:
```
exports.piwikUrl = "http://localhost/piwik/";
exports.phpServer = {
    HTTP_HOST: 'localhost',
    REQUEST_URI: '/piwik/',
    REMOTE_ADDR: '127.0.0.1'
};

```

## Creating a UI test

We start by using the [Piwik Console](https://developer.piwik.org/guides/piwik-on-the-command-line) to create a new UI test:

```bash
./console generate:test --testtype ui
```

The command will ask you to enter the name of the plugin the created test should belong to. For the rest of this guide we assume you're using the plugin name "Widgetize". Next it will ask you for the name of the test. Here you usually enter the name of the page or report you want to test. We will use the name "WidgetizePage" in this example. There should now be a file `plugins/Widgetize/tests/UI/WidgetizePage_spec.js` which contains already an example to get you started easily:

```javascript
describe("WidgetizePage", function () {
    var generalParams = 'idSite=1&amp;period=day&amp;date=2010-01-03';

    it('should load a simple page by its module and action', function (done) {
        var screenshotName = 'simplePage';
        // will save image in "processed-ui-screenshots/WidgetizePageTest_simplePage.png"

        expect.screenshot(screenshotName).to.be.capture(function (page) {
            var urlToTest = "?" + generalParams + "&amp;module=Widgetize&amp;action=index";
            page.load(urlToTest);
        }, done);
    });
});
```

### What is happening here?

This example declares a new set of [specs](https://en.wikipedia.org/wiki/Behavior-driven_development#Behavioural_specifications) by calling the method `describe(name, callback)` and within that a new spec by calling the method `it(description, func)`. Within the spec we load a URL and once loaded capture a screenshot of the whole page. The captured screenshot will be saved under the defined `screenshotName`. You might have noticed we write our UI tests in [BDD](http://en.wikipedia.org/wiki/Behavior-driven_development) style.

### Capturing only a part of the page
It is good practice to not always capture the full page. For example many pages contain a menu and if you change that menu, all your screenshot tests would fail. To avoid this you would instead have a separate test for your menu. To capture only a part of the page simply specify a [jQuery selector](https://api.jquery.com/category/selectors/) and call the method `captureSelector` instead of `capture`:

```javascript
var contentSelector = '#selector1, .selector2 .selector3';
// Only the content of both selectors will be in visible in the captured screenshot
expect.screenshot('page_partial').to.be.captureSelector(contentSelector, function (page) {
    page.load(urlToTest);
}, done);
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

### Fixing a test

At some point your UI test will fail, for example due to expected CSS changes. To fix a test all you have to do is to copy the captured screenshot from the folder `processed-ui-screenshots` to the folder `expected-ui-screenshots`.

## Writing a UI test in depth

UI screenshot tests are run directly by Puppeteer and are written using [mocha](https://mochajs.org/) and [chai](http://chaijs.com).

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

#### Page Renderer Object Methods

The page renderer object has the following methods:

- **click(selector, [modifiers], [waitTime])**: Sends a click to the element referenced by `selector`. Modifiers is an array of strings that can be used to specify keys that are pressed at the same time. Currently only `'shift'` is supported.
- **mouseMove(selector, [waitTime])**: Sends a mouse move event to the element referenced by `selector`.
- **mousedown(selector, [waitTime])**: Sends a mouse down event to the element referenced by `selector`.
- **mouseup(selector, [waitTime])**: Sends a mouse up event to the element referenced by `selector`.
- **sendKeys(selector, keyString, [waitTime])**: Clicks an element to bring it into focus and then simulates typing a string of keys.
- **sendMouseEvent(type, pos. [waitTime])**: Sends a mouse event by name to a specific position. `type` is the name of an event. `pos` is a point, eg, `{x: 0, y: 0}`.
- **dragDrop(selectorStart, selectorEnd, waitTime)**: Performs a drag/drop of an element (mousedown, mousemove, mouseup) from the element referenced by `selectorStart` and the element referenced by `selectorEnd`.
- **wait([waitTime])**: Waits without doing anything.
- **load(url, [waitTime])**: Loads a URL.
- **reload([waitTime])**: Reloads the current URL.
- **evaluate(impl, [waitTime])**: Evaluates a function (`impl`) within a webpage. `impl` is an actual function, not a string and must take no arguments.

All **selector**s are jQuery selectors, so you can use jQuery only filters such as `:eq`.

All events are real events, not synthetic DOM events.

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

To do this, you need to implement `provideContainerConfig()` in a fixture class and return [a valid DI configuration](http://php-di.org/doc/definition.html). For example:

```php
class FailUpdateHttpsFixture extends Fixture
{
    public function provideContainerConfig()
    {
        return array(
            'Piwik\Plugins\CoreUpdater\Updater' => \DI\object('Piwik\Plugins\CoreUpdater\Test\Mock\UpdaterMock'),
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

## Learn more

Check out this blog post to learn more about Screenshot Tests in Piwik:
[QA Screenshot Testing blog post](https://piwik.org/blog/2013/10/our-latest-improvement-to-qa-screenshot-testing/)
