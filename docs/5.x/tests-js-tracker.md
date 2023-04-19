---
category: Develop
previous: tests-ui
next: tests-github
title: JavaScript Tracker
---
# Matomo JavaScript Tracker Tests

## Setup

JS Tracker tests require an installed Matomo and ensure the `[database_tests]` section in `matomo/config/config.ini.php` is set up correctly, i.e. with the correct password to prevent the following error: `SQLSTATE[28000] [1045] Access denied for user 'root'@'localhost' (using password: NO)`

The tests will create a database named `tracker_tests` and store several tracking requests in it.

## Running tests

Either open http://matomo.example.com/tests/javascript/ in a browser or execute `phantomjs testrunner.js` on the command line. You can [download PhantomJS here](https://phantomjs.org/).

To execute tests for a specific module use the `module` URL parameter, for example `&module=core`.

If you are developing multiple tracker plugin and want to only include tests for a specific tracker plugin (like our CI would do) use the URL parameter `plugin` as in `&plugin=MyPluginName`.

## Adding tests

You can add additional JS tests by creating a file `tests/javascript/index.php` within your plugin directory. A test looks for example like this:

```html
<div id="MyPlugin">
    <div id="elementWhichWillBeUsedInMyTest">

    </div>
</div>

<script type="text/javascript">
module('MyPlugin');
    
test("Matomo MyPlugin", function() {
    expect(2);

    equal( typeof Matomo.MyPlugin, 'object', 'MyPlugin' );

    var MyPlugin = Matomo.MyPlugin;
    equal( typeof MyPlugin.disableTracking, 'object', 'MyPlugin.disableTracking' );
});

test("Matomo MyPlugin enriches tracker", function() {
    expect(2);

    var tracker = Matomo.getAsyncTracker();

    equal( typeof tracker.MyPlugin, 'object', 'MyPlugin' );
    equal( typeof tracker.MyPlugin.trackme, 'function', 'Tracker MyPlugin.trackme');
});

</script>
```

[For a list of possible assertions click here.](https://api.qunitjs.com/)

You don't have to define any div elements or any other HTML except for the script element. However, you may need to add
certain HTML elements to test the behaviour of your tracker plugin.
