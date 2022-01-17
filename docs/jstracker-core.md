---
category: DevelopInDepth
title: JavaScript Tracker
---
# Matomo core - JavaScript Tracker

This guide applies to Matomo core developers. If you develop a plugin and want to share it as a contributor please check out the guide for [Enriching the Matomo JS Tracker](https://developer.matomo.org/guides/enrich-js-tracker).

## Supported browsers

See [JavaScript Tracking Client integration guide](https://developer.matomo.org/guides/tracking-javascript-guide#supported-browsers).

It means we need to support older browsers. If you're not sure if a certain method is supported by all the required browsers, then you can use [Can I Use website](https://caniuse.com/) to find out.

Generally we try to keep the JS file smallish for fast performance.

## Making changes to the JS tracker

To make changes to the JS tracker, you need to edit the raw/unminfied JS tracker itself which you can find in the [js/piwik.js](https://github.com/matomo-org/matomo/blob/4.x-dev/js/piwik.js) directory. When you create a pull request, you can then minify the JS tracker see below.

### Adding a new public JS tracker method

Public tracker methods like `trackPageView` can be called eg using `_paq.push(['trackPageView', '...parameters'])`. Such methods are defined similiar to this [example](https://github.com/matomo-org/matomo/blob/4.4.1/js/piwik.js#L6260-L6275).

Any newly added method or changed parameters will be documented in the [developer changelog](https://developer.matomo.org/guides/apis#developer-changelog) and on the [JS tracking client](https://developer.matomo.org/api-reference/tracking-javascript) page.

A test also needs to be added unless it isn't possible. We also add a test to the `"API methods"` test group to ensure the function is exposed.

In most cases we'll also create a new FAQ on our [matomo.org](https://matomo.org) website.

## Tests

See [adding tests guide](https://developer.matomo.org/guides/enrich-js-tracker#adding-tests).

You can execute the JavaScript tests by opening https://yourlocal.matomo/tests/javascript/ .

The file containing all tests is located in `tests/javascript/index.php`.

### URL parameters for running the tests

To execute tests for a specific module use the `module` URL parameter, for example `&module=core`.

If you are developing multiple tracker plugins and want to only include tests for a specific tracker plugin (like Travis would do) use the URL parameter `plugin` as in `&plugin=MyPluginName`.

### Testing private methods that aren't exposed

Sometimes you may want to test private methods that aren't exposed in the JS tracker API. This can be done by following these steps:

* Add a new line to `tests/javascript/matomotest.js` where you expose a new internal method, for example `'_replaceHrefForCrossDomainLink: replaceHrefForCrossDomainLink,' `
* Now you can access such a private method in the tests using for example `tracker.hook.test._replaceHrefForCrossDomainLink`

### Testing private tracker variables

To access private tracker variables that only exist within a tracker instance, you can place extra tracker methods between `/*<DEBUG>*/` and `/*</DEBUG>*/`. Any code between these comments will be removed in the final minified JS tracker version. You can see this done for example here: https://github.com/matomo-org/matomo/blob/4.2.0/js/piwik.js#L4820-L4840

You can then access these methods on a tracker instance as usual. For example `tracker.isUsingAlwaysUseSendBeacon`. 

### Resolving JSLint errors

You may see a message like `Test failed in module externals: 'JSLint'. Error: JSLint validation: please check the browser console for the list of jslint errors.`

In that case you need to run the tests in the browser and then open the browser developer tools. It will show you all the JSLint errors in the console. There might be a lot of log output in the console. You can find the relevant entry by searching for `JSLint`. Explanations for the different errors you can find for example on [linterrors.com/js](http://linterrors.com/js).

If the error is for example `Unexpected /*property*/ '{a}'.` then you may need to [add a new member or global in the comments](https://github.com/matomo-org/matomo/blob/4.4.1/js/piwik.js#L30-L130) to resolve the issue.

## Minifying the JS tracker

When you create a pull request for a JS tracker change you will notice that a test will fail because the minified version wasn't updated. To generate the minified version for a JS tracker change simply create comment in the PR with the words `build js`.

### Community contributions 

If you are reviewing a pull request from a community contributor and you are happy with the change, then follow these steps:

* Click on `edit` PR in the top
* Open the select field that says eg `base: 4.x-dev`. 
* Enter a new branch name and select this branch
* Save the change
* Merge the PR
* Create a new PR for this newly created branch
* Comment `build js`
* Tests should now pass
* Thank the author of the PR for the contribution and merge this PR

## Debugging the JS Tracker

### When you are not in control of the website

If you need to debug the tracking code for a plugin that is not behaving correctly on a website you do not control, for example,
a client or customer's website, this strategy can help:

1. setup and start your local matomo, with the plugin you want to debug activated
2. visit the website you want to test the tracking code on
3. in the developer tools window, execute the following javascript snippet manually:

    ```javascript
    delete window.Piwik;
    delete window.Matomo;

    var _paq = [];
    _paq.push(['trackPageView']);
    _paq.push(['enableLinkTracking']);
    // ... add the other methods you need to call here, examples below ...
    //_paq.push(['FormAnalytics::enableDebugMode']);
    //_paq.push(['HeatmapSessionRecording::disable']);

    (function() {
        var u="//apache.matomo/"; // replace apache.matomo with the domain your local matomo is on, eg, localhost
        _paq.push(['setTrackerUrl', u+'piwik.php']);
        _paq.push(['setSiteId', '1']);
        var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
        g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
    })();
    ```

   Note: depending on the plugin you are testing, you may want or need to adjust what tracker methods are called.
4. tracking requests will now be sent to your local matomo, allowing you to debug the entire workflow, end to end, locally.

Once you're receiving tracking requests from the website, you may want to modify the tracking code that is used in order to
debug an issue or just get better insight into what's happening. You can do this by modifying the plugin's `tracker.js` file
(or the core `js/piwik.js`) and regenerating the JavaScript. Use the following method so the unminified code will be used:

```bash
./console custom-matomo-js:update --ignore-minified
```

Then reload the webpage and rerun the JavaScript snippet above to use the new tracking code.

This strategy can help increase the speed of debugging complex issues that you do not know how to reproduce locally
