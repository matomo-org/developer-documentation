---
category: DevelopInDepth
---
# Matomo APIs

## List of APIs

Everything below is what we consider API and thereware keep backwards compatibility in minor and patch releases. Rarely, sometimes we may have to break an API for example for security reasons. We mention any deprecations or breaking changes in our [developer changelog](/changelog) see [instructions](/guides/contributing-to-piwik-core#developer-changelog).

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