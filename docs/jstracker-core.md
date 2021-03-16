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
