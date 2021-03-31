---
category: DevelopInDepth
---
# Matomo APIs

On this page you can view the list of APIs, how we maintain backwards compatibility, how we announce changes to the API and other useful tips.

## List of APIs

Everything below is what we consider API.

-   [Reporting HTTP API](/api-reference/reporting-api).
    -   They are defined in API.php files and APIs are called over HTTP.
    -   API endpoint `index.php`, URL structure `?module=API&method=X.Y&format=...`, method names and parameter names are part of the API.
-   [Tracking HTTP API](/api-reference/tracking-api)
    -   API endpoint `piwik.php`, parameter names are part of the API.
-   HTTP Status code for Reporting and Tracking APIs are API
-   [Events](/api-reference/events)
    -   Event names, and parameter list are API.
-   [Classes](/api-reference/classes) and [Methods](/api-reference/index)
    -   They are tagged with `@api` in our sourcecode. (these docs are automatically generated on each commit.)
    -   Since PHP 8 argument names of public API's are also considered API
-   A few console commands are API (the command name and parameter names should not change)
    -   so far we only consider public APIs these commands: `core:archive`, `core:update`, `plugin:activate`, `plugin:deactivate`, `git:pull`, `development:enable`, `development:disable`, `customvariables:set-max-custom-variables`.
    -   some of these commands are setup in crontabs and we shouldn't break them.
-   JavaScript variables in global `piwik.*` object
    -   as [documented here](https://developer.piwik.org/guides/working-with-piwiks-ui#global-variables-defined-by-piwik)
-   LESS variables used for Theming
    -   when [writing a theme for Piwik](/guides/theming) we announce that LESS variables in ([theme.less](https://github.com/piwik/piwik/blob/master/plugins/Morpheus/stylesheets/theme.less) and [theme-advanced.less](https://github.com/piwik/piwik/blob/master/plugins/Morpheus/stylesheets/theme-advanced.less)) are API
-   INI Config settings names in `config/global.ini.php` are API
    -   we should not rename INI config settings as users may have overridden them in `config/config.ini.php`
-   Widgets embed URLs are API
    -   thousands of users include Piwik reports directly via [the iframe embed feature](http://piwik.org/docs/embed-piwik-report/) and rely on the URL to work
-   Some tools bundled with Piwik are considered API in the sense that their paths should not change:
    -   `libs/PiwikTracker/PiwikTracker.php` <- tracker API client directly used from this path (as we advise [in our doc](https://piwik.org/docs/tracking-api/))
    -   `misc/log-analytics/import_logs.py` <- [Log Analytics script](http://piwik.org/log-analytics/)
    -   `piwik.js` is the minified JavaScript tracking client referenced in Tracking code in users' websites
    -   alternatively `/js/` endpoint is sometimes used to serve the minified file ensuring caching of the file in browsers.

Some other parts are sometimes considered public APIs but it is not a hard rule:

-   Translation keys, especially generic ones such as `General_*` and `CoreHome_*` keys, are part of the API and should not change.
    -   Many plugins may use these generic translations, as [we advise them to.](/guides/translations#best-practices-for-new-translation-keys)

Deprecations and changes to any of these public APIs will be documented here.

### Our Backwards Compatibility Promise

All popular software platforms have a process to ensure Backward Compatibility (BC) is kept between `Minor` and `Patch` releases (see [Semantic Versioning 2.0.0](http://semver.org/)). when BC is kept, it means users can be confident to upgrade to a newer version (Minor or Patch release) that their platform will still work (including any installed third party plugins.). For example Symfony have a very advanced BC guide: [Our Backwards Compatibility Promise ](http://symfony.com/doc/current/contributing/code/bc.html).

Rarely, we may have to break an API for example for security reasons. We mention any deprecations or breaking changes in our [developer changelog](/changelog) see [instructions](#developer-changelog).

### Deprecating a PHP or API method

When we need to change an API, or remove an API, before removing or changing the API, we deprecate it:
this can usually be done by adding `@deprecated` tag in the API, event name, etc.
we announce the deprecation in the Developer Changelog at least 3-6 months early. With the deprecated annotation we also mention when it was deprecated (which Matomo version) and provide recommendations what to use instead.

Example:

```php
/**
 * @deprecated since Matomo 4.2.1. Use Xyz instead.
 */
public function getMyReport() {

}
```

When we release a new Major version (eg. Matomo 5.0.0) then we are will remove all `@deprecated` code and therefore break BC. We announce the details of code removed in the [developer changelog](/changelog) (see [instructions](#developer-changelog)) and we also document to developers how they can convert their code to the new way.

## Developer changelog

When we are adding a new API or when we are breaking or deprecating an existing API, then we change our [Developer Changelog](https://github.com/matomo-org/matomo/blob/4.x-dev/CHANGELOG.md). We also mention library updates and on occasion internal changes that may be interesting for developers.

### Examples when to update the developer changelog

* change to a Reporting API method (eg. new API method added, deprecated, removed)
* change to Reporting API output (eg. a new field in an API response)
* change to Reporting API parameter (eg. parameter added, deprecated, removed)
* change to Tracking API parameter (eg. parameter added, deprecated, removed)
* change to Piwik JavaScript Tracker feature (eg. new feature, or removed feature)
* since PHP 8 argument names of public API's are also considered API
* new console command
* new parameter for a console command
* new developer guide
* update to a third party library
* any other relevant internal change that may interest developers

Any change would usually fall under one of these categories:

```
#‎# Template: Matomo version number

#‎## Breaking Changes
#‎## Deprecations
#‎## API Changes
#‎## New features
#‎## New APIs
#‎## New commands
#‎## New developer guide
#‎## Library updates
#‎## Internal change
```

If the change is a new config or a config change, then it's usually not mentioned in the developer changelog as they are mostly meant for users and not for developers.

## PHP Plugin API

### Process for declaring something as public API for plugins

We provide a [public PHP API for plugins](https://developer.matomo.org/api-reference/classes) so plugins can extend and customise Matomo. For example, they allow plugins to define new reports, widgets and track additional data. They also provide utility methods to store data, to show notifications, to define settings and more.

We aim to make as few classes as needed a public API yet as many as possible. Generally, to make a method or a class a public API the following criteria needs to be fulfilled:

* The method or class has existed for ideally more than a year and there were very little to no changes to it. This means we can consider this API as a stable component that is unlikely to change again soon. Making something a public API means we can make changes to it only as part of a major version upgrade because of our [backwards compatibility promise](#our-backwards-compatibility-promise).
* The component is used ideally at least by two plugins in different ways so we no the API works well for various use cases. The more the API is used by core or plugins the better.
* We have written a plugin developer guide on this website as part of the "Develop" section. This is important because when documenting something you often notice that something may be hard to use or hard to explain meaning the API can be improved maybe making it a public API. 
* The API follows our principle of being very easy to use for most of the use cases, yet it allows to be used in very advanced ways. A good example is for example our [Tasks API](/api-reference/Piwik/Plugin/Tasks) where you simply define for example `$this->hourly('myTask');` to run an hourly task, but you can also use it in a very advanced way if needed (for example `$this->custom($customSchedule, ...)`).  
* The API is needed to provide a good user experience (fast, easy to use and learn, stable to use, ...) or to enrich Matomo's capabilities.

When making something a public API:

  * We mention the new API in our [Developer Changelog](#developer-changelog).
  * If an API is a component (like an API, Task, Setting, ...) then we provide a command to generate such a component if possible.
  * We consider writing a blog post about it to mention this new API.

## HTTP API

This section applies to the HTTP API's that are defined in an `API.php` file within a plugin.

### Annotations

You can optionally add annotations to an API method to prevent a method to be visible in the [list of all APIs](/api-reference/reporting-api). Please note that below annotations don't replace the need to [check for the correct permissions](/guides/permissions) in the beginning of the method.

* `@hide` -> Won't be shown in list of all APIs but is also not possible to be called via HTTP API. It is not recommended to use this annotation and instead you should move this method to another place outside the API as there should be no reason to have it in the API if it's not supposed to be called.
* `@hideForAll` Same as `@hide`.
* `@hideExceptForSuperUser` Same as `@hide` but still shown and possible to be called by a user with super user access.
* `@internal` Won't be shown in list of all APIs but is possible to be called via HTTP API.

Example:

```php
/**
 * @hideExceptForSuperUser
 */
public function getMyReport() {

}
```
