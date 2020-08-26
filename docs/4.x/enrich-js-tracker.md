---
category: Develop
title: JS Tracker
---
# Enriching the Matomo JavaScript Tracker

You can add additional code to the `matomo.js` JavaScript tracker. This allows you for example to:

* configure the Matomo JavaScript tracker in a certain way to ensure the same behaviour is applied across all sites. For example enforcing that cookies are disabled on all sites.
* track additional information about the visitor such as tracking additional browser plugins or other browser or device data.  
* add additional analytics features to the tracker such as JS error tracking

## Enriching the tracker:

To enrich the tracker create a file named `tracker.js` in your Matomo plugin directory. The base template for this file looks like this:

```js
(function () {

    function init() {
        // Add your plugin code here. For example to enforce disabling cookies:
        window._paq = window._paq || [];
        winodw._paq.push(['disableCookies']);
    }

    if ('object' === typeof window.Matomo) {
        init();
    } else {
        // tracker might not be loaded yet
        if ('object' !== typeof window.matomoPluginAsyncInit) {
            window.matomoPluginAsyncInit = [];
        }

        window.matomoPluginAsyncInit.push(init);
    }

})(); 
```

### Updating the JS tracker

In order to test your tracker integration, execute the following console command within your root Matomo directory.

```bash
./console custom-matomo-js:update --ignore-minified
```

This will merge the content of your `tracker.js` file with the JS tracker template from `$matomoRootDir/js/piwik.min.js` and save the
output in the regular `$matomoRootDir/matomo.js` tracker file. Make sure to always clear your browser cache when you test changes.

When a user installs your plugin, Matomo will automatically update the `matomo.js` tracker file. 

### Adding additional tracker methods

You can add additional tracking methods for example to disable your feature, to send a tracking request or to trigger any other
 code within your plugin.

```js
function init() {
    var enableTracker = true;
    Matomo.MyPlugin = {
        disableTracking: function () {
            enableTracker = false;
        }
    };
    
    Matomo.on('TrackerSetup', function (tracker) {
        tracker.MyPlugin = {
            trackme: function () {
                if (enableTracker) {
                    tracker.trackEvent('category', 'action', 'name');
                }
            }
        };
    });
}
```

Above code allows you to trigger the static `disableTracking` method like this:

```js
_paq.push(['MyPlugin::disableTracking']);
```

and the tracker specific method like this (using a dot instead of a double colon):

```js
_paq.push(['MyPlugin.trackme']); 
```

Most of the time you will want to use a tracker specific tracking method like `trackme`. This allows you for example to send tracking requests and it allows a user to configure each tracker instance separately (when using multiple JS trackers on the same page).
If you want to provide for example an option to disable your feature across all trackers, then you may want to add a static method like `disableTracking`.

We recommend to always namespace your tracker methods with your plugin name as done above with the `MyPlugin` namespace.

### Hooking into plugin events

You may hook into events to add additional tracking parameters to tracking requests. Your plugin can access these tracking
parameters server side, store the value in a dimension and provide new reports based on this data. 

```js
function init() {
    Matomo.addPlugin('MyPlugin', {
        log: function () {
            // add additional tracking parameters to a page view tracking request
            var canvas = document.createElement('canvas');
            if(canvas.getContext('webgl')) {
                return '&webgl=1';
            }

            return '&webgl=0';
        },
        event: function () {
            // lets you add additional tracking parameters for an event tracking request
        },
        goal: function () {
            // lets you add additional tracking parameters for a goal tracking request
        },
        unload: function() {
            // executed when the user is leaving the page
            // can be useful to send for example any not yet sent tracking request
            var trackers = Matomo.getAsyncTrackers();
            for (var i = 0; i < trackers.length; i++) {
                trackers[i].trackRequest('ping=1');
            }
        }
    });
}
```

Other event names are `ecommerce`, `sitesearch`, `link`, `contentInteraction`, `contentImpressions` and `contentImpression`.

### Useful methods:

* `Matomo.JSON` get access to the JSON object
* `Matomo.DOM.onReady(callback)` calls the `callback` method when the DOM is ready but not yet loaded
* `Matomo.DOM.onLoad(callback)` calls the `callback` method when the DOM is fully loaded
* `Matomo.DOM.isNodeVisible(htmlNode)` checks if the given HTML element is visible within the viewport right now
* `Matomo.DOM.addEventListener(element, eventType, callback, useCapture)` listen to an event without needing to worry about cross browser support
* `Matomo.on(eventName, callback)` listen to a Matomo JS tracker event
* `Matomo.off(eventName, callback)` stop listening to a Matomo JS tracker event
* `Matomo.trigger(eventName, params, context)` Triggers the given event and passes the parameters to all handlers. If no context is given, the callback will be executed in the `window` context.
* `Matomo.addPlugin(pluginName, pluginObject)` listen to tracker plugin events see example above
* `Matomo.getAsyncTrackers()` get an array of all created async tracker instances
* For a [list of all tracker specific methods click here](/api-reference/tracking-javascript)

### Minifying the tracker

You can optionally create a minified version of your tracker file. However, you will need to make sure to always keep
it up to date whenever you change the `tracker.js` file. To provide a minified version simply create a file named `tracker.min.js` in your plugin directory.

## Adding tests

Matomo JS Tracker tests can be executed by opening `https://your.matomo.domain/tests/javascript`. You can add additional JS tests by 
creating a file `tests/javascript/index.php` within your plugin directory. A test looks for example like this:

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
