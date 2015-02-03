---
category: Develop
previous: tests-php
next: tests-travis
---
# UI Tests

**UI tests** test Piwik's twig templates, JavaScript and CSS by tracking visits, generating screenshots of URLs with [phantomjs](http://phantomjs.org/) and comparing generated screenshots with expected ones.

## Requirements

Unit, integration and system tests are fairly straightforward to run. UI tests, on the other hand, need a bit more work. To run UI tests you'll need to install [phantomjs version 1.9 or higher](http://phantomjs.org/download.html) and make sure `phantomjs` is on your PATH. Then you'll have to get the tests which are located in another repository but are included in Piwik as a submodule:

```
$ git submodule init
$ git submodule update
```

If you're on Ubuntu, you'll also need some extra packages to make sure screenshots will render correctly:

```
$ sudo apt-get install ttf-mscorefonts-installer imagemagick imagemagick-doc
```

## Running UI tests

To run UI tests, run the `tests:run-ui` command:

```
$ ./console tests:run-ui MyTestSpecName
```

or to run every UI test for a plugin:

```
$ ./console tests:run-ui --plugin=MyPlugin
```

## Testing your plugin with UI tests

UI screenshot tests are run directly by phantomjs and are written using [mocha](http://visionmedia.github.io/mocha/) and [chai](http://chaijs.com).

To create a new test, first decide whether it belongs to Piwik Core or a plugin. If it belongs to Piwik Core, the test should be placed within the `/tests/UI` directory. Otherwise, it should be placed within `Test/UI` sub-directory of your plugin.

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

#### Page Renderer Object Methods

The page renderer object has the following methods:

- **click(selector, [modifiers], [waitTime])**: Sends a click to the element referenced by `selector`. Modifiers is an array of strings that can be used to specify keys that are pressed at the same time. Currently only `'shift'` is supported.
- **mouseMove(selector, [waitTime])**: Sends a mouse move event to the element referenced by `selector`.
- **mousedown(selector, [waitTime])**: Sends a mouse down event to the element referenced by `selector`.
- **mouseup(selector, [waitTime])**: Sends a mouse up event to the element referenced by `selector`.
- **sendKeys(selector, keyString, [waitTime])**: Clicks an element to bring it into focus and then simulates typing a string of keys.
- **sendMouseEvent(type, pos. [waitTime])**: Sends a mouse event by name to a specific position. `type` is the name of an event that phantomjs will recognize. `pos` is a point, eg, `{x: 0, y: 0}`.
- **dragDrop(selectorStart, selectorEnd, waitTime)**: Performs a drag/drop of an element (mousedown, mousemove, mouseup) from the element referenced by `selectorStart` and the element referenced by `selectorEnd`.
- **wait([waitTime])**: Waits without doing anything.
- **load(url, [waitTime])**: Loads a URL.
- **reload([waitTime])**: Reloads the current URL.
- **evaluate(impl, [waitTime])**: Evaluates a function (`impl`) within a webpage. `impl` is an actual function, not a string and must take no arguments.

All **selector**s are jQuery selectors, so you can use jQuery only filters such as `:eq`.

All events are real events, not synthetic DOM events.

### Manipulating the test environment

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

 * [Overlay_spec.js](https://github.com/piwik/piwik/blob/master/tests/UI/specs/Overlay_spec.js)
 * [Dashboard_spec.js](https://github.com/piwik/piwik/blob/master/tests/UI/specs/Dashboard_spec.js)
 * [Login_spec.js](https://github.com/piwik/piwik/blob/master/tests/UI/specs/Login_spec.js)
