---
category: DevelopInDepth
---
# Getting started with AngularJS

Upfront: This document is working draft and far from being perfect. We will improve this over time as we do more work with AngularJS.

With using AngularJS we are trying to achieve different goals:

* Decouple the Piwik UI from the backend. Ideally, in a few years, we have a completely separated UI based on HTML, JavaScript and CSS (no PHP) which uses all the Piwik Reporting API's. This brings lots of advantages:
  * Reducing complexity in frontend and backend
  * Reducing complexity brings faster development, fewer bugs, ...
  * The project gets attractive for non PHP developers
  * Providing an offline version (one day in the future)
  * ...
* AngularJS allows us to write unit tests for the JavaScript world
* Getting rid of jQuery soup [[0]](http://programming.oreilly.com/2014/01/keeping-jquery-in-check.html) [[1]](https://martinfowler.com/bliki/SegregatedDOM.html) and reducing complexity in our frontend
* More reusable code (models, services, filters, directives, ...)
* Shift some work from the server side into client side
* Faster response (especially once we can use AngularJS routing and [AMD](https://requirejs.org/docs/whyamd.html)). If you are not familiar with AMD -> please ignore for now

## Before you start using AngularJS
I recommend watching some videos and read a few resources about the benefits and best practices of AngularJS. It is important to understand how AngularJS works and especially to be aware of pitfalls and best practices.

* [Video AngularJS introduction](https://www.youtube.com/watch?v=i9MHigUZKEM)
* [Video Best Practices](https://www.youtube.com/watch?v=ZhfUv0spHCY)
* [Great AngularJS style guide that we should follow](https://github.com/johnpapa/angularjs-styleguide)
* [Video Course (lots of short videos, good to watch videos from time to time or when needed)](https://www.youtube.com/playlist?list=PLP6DbQBkn9ymGQh2qpk9ImLHdSH5T7yw7)
* [Common Pitfalls](https://docs.angularjs.org/misc/faq#common-pitfalls)
* [Considering Speed and Slowness in AngularJS](https://www.exratione.com/2013/12/considering-speed-and-slowness-in-angularjs/)
* [The Hitchhiker’s Guide to the Directive](https://amitgharat.wordpress.com/2013/06/08/the-hitchhikers-guide-to-the-directive/)


## Some random notes and tips
* It is very important to understand AngularJS Scopes.
  * [Nested Scopes in AngularJS](https://jimhoskins.com/2012/12/14/nested-scopes-in-angularjs.html)
  * [Scope Hierarchies](https://docs.angularjs.org/guide/scope#scope-hierarchies)
  * [The Hitchhiker’s Guide to the Directive](https://amitgharat.wordpress.com/2013/06/08/the-hitchhikers-guide-to-the-directive/)

  Hints:
  * [Isolated scopes](https://www.youtube.com/watch?v=fYgdU7u2--g) in directives are preferred
  * Some directives such as ng-if and ng-repeat create their own scope
  * All bound data should be dotted when using ng-model otherwise you are doing it wrong. You would be wondering why a value is not updated and it will take you hours to figure this out.
    Example:
    `<div ng-model="model.searchfield">` instead of `<div ng-model="searchfield">`
* The second most important thing to understand are probably [directives](https://amitgharat.wordpress.com/2013/06/08/the-hitchhikers-guide-to-the-directive/).
* Try to keep the number of data-bound elements low (< 200)
* The ng-repeat directive of AngularJS is getting slow above 2500 two-way data bindings.
* Sometimes you need some properties only in the view (HTML template). Try to prefix them with `view`. For instance `<div ng-show='view.showPaginator'>`
* When Angular detects the presence of a jQuery version in your page, it uses the full jQuery implementation in lieu of jqLite.
* "Here are two rules for filters: firstly, if the same effect can be simply achieved by decorating the underlying data, such as by adding a 'formattedValue' property, then do it that way. It will always be faster because it only happens once, not multiple times per digest cycle. Secondly, when you do have good reasons to write a filter make sure that it is blindingly fast." --> No DOM access if possible as filters are called many many times. [Read more](https://www.exratione.com/2013/12/considering-speed-and-slowness-in-angularjs/)
* Do not access the DOM within a Controller, only from directives and only if needed
* AngularJS is unique as it does not force you to use a model but it is definitely recommended. There is no class to extend to create a model, still you should always use a model and keep the controller as short as possible.
* Difference between Services, Factories, Provider:
   * A `Service` is a Singleton and whenever you request a service the same instance will be returned
   * A new instance will be created whenever you request a `Factory`
   * `Providers` have the advantage that they can be configured during the module configuration phase. A service and factory are both provider.
   [Read more](https://stackoverflow.com/questions/15666048/angular-js-service-vs-provider-vs-factory)
* If you don't know promises yet, read about it: [https://www.sitepoint.com/overview-javascript-promises/](https://www.sitepoint.com/overview-javascript-promises/)
* When working with promises you will notice that `.catch()` and `.finally()` won't work in IE8. Use `promise['finally']()` instead. [Read more](https://github.com/angular/angular.js/commit/f078762d48d0d5d9796dcdf2cb0241198677582c)

## Namespacing

## Code organization / file structure
There are lots of discussions about the best file structure. In the past we divided a feature into multiple folders called `javascripts`, `stylesheets`, ... From now on we want to
organize files per feature which is [recommended](https://docs.google.com/document/d/1XXMvReO8-Awi1EZXAXS4PzDzdNvV6pGcuaF4Q9821Es/pub) by the Angular Team and also works best in large projects.

Basically we create a folder for each feature within the plugin folder. Say we want to create a "site selector" than we create the following files:
+ CoreHome
  + angularjs
    + siteselector
      + siteselector.directive.js
      + siteselector.directive.less
      + siteselector.directive.html
      + siteselector.controller.js
      + siteselector.filter.js
      + siteselector-model.service.js
      + search.png
    + common
      + images
      + filters
        + corehomespecific.js

Sometimes you might have some reusable components within your plugin in which case you can but them into a `common` folder.
What's the adventage of this? Beside that is scales with the project you will notice immediately what a plugin does when opening a plugin folder whereas this is not the case if you see only `javascripts`, `templates` and `stylesheets` folders. Another advantage is we could - in theory - extract a feature into a separate repository and share single widgets with other people.

A module always ends with `.module.js`. A service or factory always ends with `.service.js`, a controller with `.controller.js`, a directive with `.directive.js` and a filter with `.filter.js`. Filenames are lowercase and words should be separated by a dash: `site-selector.directive.js`. If there is a config for an app the file has to be named as `appname.config.js`, eg. `piwikApp.config.js`.

There is currently the `angularjs` namespace within a plugin which is a bit annoying, we know. Long term we will remove this folder. medium term - once we have more Angular components - we will give this folder at least a better, more meaningful, name. With the existing assets structure of jQuery code it is hard to find the least annoying solution for this.

For a more detailed naming convention have a look at the [Angular Naming Guide](https://github.com/johnpapa/angularjs-styleguide#naming).

If a component, say a filter, can be reused in different plugins and is not plugin specific we but them into `CoreHome/angularjs/common`:

+ CoreHome
  + angularjs
    + common
      + filters
        + evolution.js
        + translate.js
      + services
        + piwik-api.js
      + directives
        + focusif.js
        + focus-anywhere-but-here.js

Filenames are always lower case and words are separated by dashes. In general, we have one file per type. The type - eg filter, directive or service - does not have to appear in the filename in this case as it is already placed in the related folder.

**Important**: Our directives always start with `piwik-` for instance `<div piwik-onenter="close()">`

### Coding style guide

* In AngularJS there are many ways to define attributes for a directive (Class, HTML Attributes, Elementname, ...). We are using HTML attributes and as we do not really aim to be W3C compliant we chose not to prefix attributes with "data-" to keep templates clean.
* See here for a complete style guide: https://github.com/johnpapa/angularjs-styleguide . We are using this style guide for any type as long as not mentioned differently in this document.


### Related links
* [https://docs.google.com/document/d/1XXMvReO8-Awi1EZXAXS4PzDzdNvV6pGcuaF4Q9821Es/pub](https://docs.google.com/document/d/1XXMvReO8-Awi1EZXAXS4PzDzdNvV6pGcuaF4Q9821Es/pub)
* [https://cliffmeyers.com/blog/2013/4/21/code-organization-angularjs-javascript](https://cliffmeyers.com/blog/2013/4/21/code-organization-angularjs-javascript)
* [https://joelhooks.com/blog/2013/05/22/lessons-learned-kicking-off-an-angularjs-project/](https://joelhooks.com/blog/2013/05/22/lessons-learned-kicking-off-an-angularjs-project/)
* [https://gocardless.com/blog/building-a-large-angular-application/](https://gocardless.com/blog/building-a-large-angular-application/)
* [https://www.artandlogic.com/blog/2013/05/ive-been-doing-it-wrong-part-1-of-3/](https://www.artandlogic.com/blog/2013/05/ive-been-doing-it-wrong-part-1-of-3/)

## Examples
Some features in Piwik are already realized by using AngularJS.

* [SiteSelector](https://github.com/matomo-org/matomo/tree/master/plugins/CoreHome/javascripts/siteselector)
* [All Websites Dashboard](https://github.com/matomo-org/matomo/tree/master/plugins/MultiSites/javascripts)

They make use of different components

* [Controller](https://github.com/matomo-org/matomo/blob/master/plugins/CoreHome/javascripts/siteselector/siteselector-controller.js)
* [Directive](https://github.com/matomo-org/matomo/blob/master/plugins/CoreHome/javascripts/siteselector/siteselector-directive.js)
* [Model](https://github.com/matomo-org/matomo/blob/master/plugins/CoreHome/javascripts/siteselector/siteselector-model.js)
* [Template](https://github.com/matomo-org/matomo/blob/master/plugins/CoreHome/javascripts/siteselector/siteselector.html)
* [Factory](https://github.com/matomo-org/matomo/blob/master/plugins/CoreHome/javascripts/services/piwik-api-service.js)
* [Filter](https://github.com/matomo-org/matomo/blob/master/plugins/CoreHome/javascripts/filters/translate-filter.js)

We are currently not using AngularJS Routing. The goal is to use it in long term to get rid of piwikBroadcast and many other classes.

## Testing
We use [Karma](https://karma-runner.github.io) + [Chai](https://chaijs.com) + [Mocha] (https://mochajs.org/) to write unit tests. Read more about it here: [https://github.com/matomo-org/matomo/blob/master/tests/angularjs/README.md](https://github.com/matomo-org/matomo/blob/master/tests/angularjs/README.md)

## How to document
TBD

Might be interesting link: [Docular](https://grunt-docular.com/)

## Plugin architecture
AngularJS dependency injection allows plugins to overwrite or extend whatever whey want, for instance a directive. A plugin architecture comes therefore more or less out of the box.

For instance a plugin can "hook" on to a certain directive, extend/change controller behaviour etc. This video might give you some ideas: [https://www.youtube.com/watch?v=rzMrBIVuxgM](https://www.youtube.com/watch?v=rzMrBIVuxgM)

More to come!

## Links

### Further Learning AngularJS Links
* [Recipes with Angular.js](https://leanpub.com/recipes-with-angular-js/read)
* [Angular Basics Guide](https://www.angularbasics.co.uk/)
* [Huge AngularJS related link collection](https://github.com/jmcunningham/AngularJS-Learning)
* [Google Chrome extension for AngularJS](https://chrome.google.com/webstore/detail/angularjs-batarang/ighdmehidhipcmcojjgiloacoafjmpfk?hl=en). It helps you for instance to get insights into scopes
* [PHPStorm extension for AngularJS](https://plugins.jetbrains.com/plugin/6971-angularjs)
* [Improving ng-repeat Performance with track by](https://www.codelord.net/2014/04/15/improving-ng-repeat-performance-with-track-by/)
* [Debugging AngularJS Apps from the Console](https://ionicframework.com/blog/angularjs-console/)

### AngularJS modules
* https://bower.io/search/?q=angularjs#!%2Fsearch%2Fangular
* https://ngmodules.org/
