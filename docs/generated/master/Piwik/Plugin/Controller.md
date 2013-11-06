<small>Piwik\Plugin</small>

Controller
==========

Base class of all plugin Controllers.

Description
-----------

Plugins that wish to add display HTML should create a Controller that either
extends from this class or from [ControllerAdmin](#). Every public method in
the controller will be exposed as a controller action.

Learn more about Piwik's MVC system [here](#).

### Examples

**Defining a controller**

    class Controller extends \Piwik\Plugin\Controller
    {
        public function index()
        {
            $view = new View("@MyPlugin/index.twig");
            // ... setup view ...
            echo $view->render();
        }
    }

**Linking to a controller action**

    <a href="?module=MyPlugin&action=index&idSite=1&period=day&date=2013-10-10">Link</a>


Properties
----------

This abstract class defines the following properties:

- [`$pluginName`](#$pluginname) &mdash; The plugin name, eg.
- [`$strDate`](#$strdate) &mdash; The value of the `'date'` query parameter.
- [`$date`](#$date) &mdash; The Date object created with ($strDate)[#strDate] or null if the requested date is a range.
- [`$idSite`](#$idsite) &mdash; The value of the `'idSite'` query parameter.
- [`$site`](#$site) &mdash; The Site object created with ($idSite)[#idSite].

<a name="pluginname" id="pluginname"></a>
<a name="pluginName" id="pluginName"></a>
### `$pluginName`

The plugin name, eg.

#### Description

`'Referrers'`.

#### Signature

- It is a `string` value.

<a name="strdate" id="strdate"></a>
<a name="strDate" id="strDate"></a>
### `$strDate`

The value of the `'date'` query parameter.

#### Signature

- It is a `string` value.

<a name="date" id="date"></a>
<a name="date" id="date"></a>
### `$date`

The Date object created with ($strDate)[#strDate] or null if the requested date is a range.

#### Signature

- It can be one of the following types:
    - [`Date`](../../Piwik/Date.md)
    - `null`

<a name="idsite" id="idsite"></a>
<a name="idSite" id="idSite"></a>
### `$idSite`

The value of the `'idSite'` query parameter.

#### Signature

- It is a `int` value.

<a name="site" id="site"></a>
<a name="site" id="site"></a>
### `$site`

The Site object created with ($idSite)[#idSite].

#### Signature

- It is a [`Site`](../../Piwik/Site.md) value.

Methods
-------

The abstract class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`getDateParameterInTimezone()`](#getdateparameterintimezone) &mdash; Helper method that converts "today" or "yesterday" to the specified timezone.
- [`setDate()`](#setdate) &mdash; Sets the date to be used by all other methods in the controller.
- [`getDefaultAction()`](#getdefaultaction) &mdash; Returns the name of the default method that will be called when visiting: index.php?module=PluginName without the action parameter.
- [`renderView()`](#renderview) &mdash; A helper method that renders a view either to the screen or to a string.
- [`getLastUnitGraph()`](#getlastunitgraph) &mdash; Returns a ViewDataTable object that will render a jqPlot evolution graph for the last30 days/weeks/etc.
- [`getLastUnitGraphAcrossPlugins()`](#getlastunitgraphacrossplugins) &mdash; Same as [getLastUnitGraph](#getLastUnitGraph), but will set some properties of the ViewDataTable object based on the arguments supplied.
- [`getUrlSparkline()`](#geturlsparkline) &mdash; Returns a URL to a sparkline image for a report served by the current plugin.
- [`setMinDateView()`](#setmindateview) &mdash; Sets the first date available in the calendar.
- [`setMaxDateView()`](#setmaxdateview) &mdash; Sets the last date available in the calendar.
- [`setGeneralVariablesView()`](#setgeneralvariablesview) &mdash; Assigns variables to [View](#) instances that display an entire page.
- [`setBasicVariablesView()`](#setbasicvariablesview) &mdash; Assigns a set of generally useful variables to a [View](#) instance.
- [`setHostValidationVariablesView()`](#sethostvalidationvariablesview) &mdash; Checks if the current host is valid and sets variables on the given view, including:
- [`setPeriodVariablesView()`](#setperiodvariablesview) &mdash; Sets general period variables on a view, including:  - **displayUniqueVisitors** - Whether unique visitors should be displayed for the current                               period.
- [`redirectToIndex()`](#redirecttoindex) &mdash; Helper method used to redirect the current http request to another module/action.
- [`getDefaultWebsiteId()`](#getdefaultwebsiteid) &mdash; Returns default site ID that Piwik should load.
- [`getDefaultDate()`](#getdefaultdate) &mdash; Returns default date for Piwik reports.
- [`getDefaultPeriod()`](#getdefaultperiod) &mdash; Returns default period type for Piwik reports.
- [`checkTokenInUrl()`](#checktokeninurl) &mdash; Checks that the token_auth in the URl matches the current logged in user's token_auth.
- [`getCalendarPrettyDate()`](#getcalendarprettydate) &mdash; Returns a prettified date string for use in period selector widget.
- [`getEvolutionHtml()`](#getevolutionhtml) &mdash; Calculates the evolution from one value to another and returns HTML displaying the evolution percent.

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

- It does not return anything.

<a name="getdateparameterintimezone" id="getdateparameterintimezone"></a>
<a name="getDateParameterInTimezone" id="getDateParameterInTimezone"></a>
### `getDateParameterInTimezone()`

Helper method that converts "today" or "yesterday" to the specified timezone.

#### Description

If the date is absolute, ie. YYYY-MM-DD, it will not be converted to the timezone.

#### Signature

- It accepts the following parameter(s):
    - `$date`
    - `$timezone`
- It returns a [`Date`](../../Piwik/Date.md) value.

<a name="setdate" id="setdate"></a>
<a name="setDate" id="setDate"></a>
### `setDate()`

Sets the date to be used by all other methods in the controller.

#### Description

If the date has to be modified, this method should be called just after
construction.

#### Signature

- It accepts the following parameter(s):
    - `$date` ([`Date`](../../Piwik/Date.md))
- It returns a `void` value.

<a name="getdefaultaction" id="getdefaultaction"></a>
<a name="getDefaultAction" id="getDefaultAction"></a>
### `getDefaultAction()`

Returns the name of the default method that will be called when visiting: index.php?module=PluginName without the action parameter.

#### Signature

- It returns a `string` value.

<a name="renderview" id="renderview"></a>
<a name="renderView" id="renderView"></a>
### `renderView()`

A helper method that renders a view either to the screen or to a string.

#### Signature

- It accepts the following parameter(s):
    - `$view` (`Piwik\View\ViewInterface`)
    - `$fetch`
- It can return one of the following values:
    - `string`
    - `void`

<a name="getlastunitgraph" id="getlastunitgraph"></a>
<a name="getLastUnitGraph" id="getLastUnitGraph"></a>
### `getLastUnitGraph()`

Returns a ViewDataTable object that will render a jqPlot evolution graph for the last30 days/weeks/etc.

#### Description

of the current period, relative to the current date.

#### Signature

- It accepts the following parameter(s):
    - `$currentModuleName`
    - `$currentControllerAction`
    - `$apiMethod`
- It returns a [`ViewDataTable`](../../Piwik/Plugin/ViewDataTable.md) value.

<a name="getlastunitgraphacrossplugins" id="getlastunitgraphacrossplugins"></a>
<a name="getLastUnitGraphAcrossPlugins" id="getLastUnitGraphAcrossPlugins"></a>
### `getLastUnitGraphAcrossPlugins()`

Same as [getLastUnitGraph](#getLastUnitGraph), but will set some properties of the ViewDataTable object based on the arguments supplied.

#### Signature

- It accepts the following parameter(s):
    - `$currentModuleName`
    - `$currentControllerAction`
    - `$columnsToDisplay`
    - `$selectableColumns`
    - `$reportDocumentation`
    - `$apiMethod`
- It returns a [`ViewDataTable`](../../Piwik/Plugin/ViewDataTable.md) value.

<a name="geturlsparkline" id="geturlsparkline"></a>
<a name="getUrlSparkline" id="getUrlSparkline"></a>
### `getUrlSparkline()`

Returns a URL to a sparkline image for a report served by the current plugin.

#### Description

The result of this URL should be used with the [sparkline()](#) twig function.

The current site ID and period will be used.

See [Sparkline](#) for more information about the Sparkline visualization.

#### Signature

- It accepts the following parameter(s):
    - `$action`
    - `$customParameters`
- _Returns:_ The generated URL.
    - `string`

<a name="setmindateview" id="setmindateview"></a>
<a name="setMinDateView" id="setMinDateView"></a>
### `setMinDateView()`

Sets the first date available in the calendar.

#### Signature

- It accepts the following parameter(s):
    - `$minDate` ([`Date`](../../Piwik/Date.md))
    - `$view`
- It does not return anything.

<a name="setmaxdateview" id="setmaxdateview"></a>
<a name="setMaxDateView" id="setMaxDateView"></a>
### `setMaxDateView()`

Sets the last date available in the calendar.

#### Description

Usually this just the "today" date
for a site (which can depend on the timezone of a site).

#### Signature

- It accepts the following parameter(s):
    - `$maxDate` ([`Date`](../../Piwik/Date.md))
    - `$view`
- It does not return anything.

<a name="setgeneralvariablesview" id="setgeneralvariablesview"></a>
<a name="setGeneralVariablesView" id="setGeneralVariablesView"></a>
### `setGeneralVariablesView()`

Assigns variables to [View](#) instances that display an entire page.

#### Description

The following variables assigned:

**date** - The value of the **date** query parameter.
**idSite** - The value of the **idSite** query parameter.
**rawDate** - The value of the **date** query parameter.
**prettyDate** - A pretty string description of the current period.
**siteName** - The current site's name.
**siteMainUrl** - The URL of the current site.
**startDate** - The start date of the current period. A [Date](#) instance.
**endDate** - The end date of the current period. A [Date](#) instance.
**language** - The current language's language code.
**config_action_url_category_delimiter** - The value of the `[General] action_url_category_delimiter`
                                           INI config option.
**topMenu** - The result of `MenuTop::getInstance()->getMenu()`.

As well as the variables set by [setPeriodVariablesView](#setPeriodVariablesView).

Will exit on error.

#### Signature

- It accepts the following parameter(s):
    - `$view`
- It returns a `void` value.

<a name="setbasicvariablesview" id="setbasicvariablesview"></a>
<a name="setBasicVariablesView" id="setBasicVariablesView"></a>
### `setBasicVariablesView()`

Assigns a set of generally useful variables to a [View](#) instance.

#### Description

The following variables assigned:

**debugTrackVisitsInsidePiwikUI** - The value of the `[Debug] track_visits_inside_piwik_ui`
                                    INI config option.
**isSuperUser** - True if the current user is the super user, false if otherwise.
**hasSomeAdminAccess** - True if the current user has admin access to at least one site,
                         false if otherwise.
**isCustomLogo** - The value of the `[branding] use_custom_logo` INI config option.
**logoHeader** - The header logo URL to use.
**logoLarge** - The large logo URL to use.
**logoSVG** - The SVG logo URL to use.
**hasSVGLogo** - True if there is a SVG logo, false if otherwise.
**enableFrames** - The value of the `[General] enable_framed_pages` INI config option. If
                   true, [View::setXFrameOptions](#) is called on the view.

Also calls [setHostValidationVariablesView](#setHostValidationVariablesView).

#### Signature

- It accepts the following parameter(s):
    - `$view`
- It does not return anything.

<a name="sethostvalidationvariablesview" id="sethostvalidationvariablesview"></a>
<a name="setHostValidationVariablesView" id="setHostValidationVariablesView"></a>
### `setHostValidationVariablesView()`

Checks if the current host is valid and sets variables on the given view, including:

#### Description

- **isValidHost** - true if host is valid, false if otherwise
- **invalidHostMessage** - message to display if host is invalid (only set if host is invalid)
- **invalidHost** - the invalid hostname (only set if host is invalid)
- **mailLinkStart** - the open tag of a link to email the super user of this problem (only set
                      if host is invalid)

#### Signature

- It accepts the following parameter(s):
    - `$view`
- It does not return anything.

<a name="setperiodvariablesview" id="setperiodvariablesview"></a>
<a name="setPeriodVariablesView" id="setPeriodVariablesView"></a>
### `setPeriodVariablesView()`

Sets general period variables on a view, including:  - **displayUniqueVisitors** - Whether unique visitors should be displayed for the current                               period.

#### Description

- **period** - The value of the **period** query parameter.
- **otherPeriods** - `array('day', 'week', 'month', 'year', 'range')`
- **periodsNames** - List of available periods mapped to their singular and plural translations.

#### Signature

- It accepts the following parameter(s):
    - `$view`
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if the current period is invalid.

<a name="redirecttoindex" id="redirecttoindex"></a>
<a name="redirectToIndex" id="redirectToIndex"></a>
### `redirectToIndex()`

Helper method used to redirect the current http request to another module/action.

#### Description

If specified, will also change the idSite, date and/or period query parameters.

This function will exit immediately after executing.

#### Signature

- It accepts the following parameter(s):
    - `$moduleToRedirect`
    - `$actionToRedirect`
    - `$websiteId`
    - `$defaultPeriod`
    - `$defaultDate`
    - `$parameters`
- It does not return anything.

<a name="getdefaultwebsiteid" id="getdefaultwebsiteid"></a>
<a name="getDefaultWebsiteId" id="getDefaultWebsiteId"></a>
### `getDefaultWebsiteId()`

Returns default site ID that Piwik should load.

#### Signature

- It can return one of the following values:
    - `bool`
    - `int`

<a name="getdefaultdate" id="getdefaultdate"></a>
<a name="getDefaultDate" id="getDefaultDate"></a>
### `getDefaultDate()`

Returns default date for Piwik reports.

#### Signature

- _Returns:_ `'today'`, `'2010-01-01'`, etc.
    - `string`

<a name="getdefaultperiod" id="getdefaultperiod"></a>
<a name="getDefaultPeriod" id="getDefaultPeriod"></a>
### `getDefaultPeriod()`

Returns default period type for Piwik reports.

#### Signature

- _Returns:_ `'day'`, `'week'`, `'month'`, `'year'` or `'range'`
    - `string`

<a name="checktokeninurl" id="checktokeninurl"></a>
<a name="checkTokenInUrl" id="checkTokenInUrl"></a>
### `checkTokenInUrl()`

Checks that the token_auth in the URl matches the current logged in user's token_auth.

#### Description

This is a protection against CSRF should be used in controller
actions that are either invoked via AJAX or redirect to a page
within the site. It should be used in all controller actions that modify
Piwik or user settings.

**The token_auth should never appear in the browser's address bar.**

#### Signature

- It does not return anything.
- It throws one of the following exceptions:
    - `Piwik\NoAccessException` &mdash; If the token doesn&#039;t match.

<a name="getcalendarprettydate" id="getcalendarprettydate"></a>
<a name="getCalendarPrettyDate" id="getCalendarPrettyDate"></a>
### `getCalendarPrettyDate()`

Returns a prettified date string for use in period selector widget.

#### Signature

- It accepts the following parameter(s):
    - `$period`
- It returns a `string` value.

<a name="getevolutionhtml" id="getevolutionhtml"></a>
<a name="getEvolutionHtml" id="getEvolutionHtml"></a>
### `getEvolutionHtml()`

Calculates the evolution from one value to another and returns HTML displaying the evolution percent.

#### Description

The HTML includes an up/down arrow and is colored red, black or
green depending on whether the evolution is negative, 0 or positive.

No HTML is returned if the current value and evolution percent are both 0.

#### Signature

- It accepts the following parameter(s):
    - `$date`
    - `$currentValue`
    - `$pastDate`
    - `$pastValue`
- _Returns:_ The HTML or false if the evolution is 0 and the current value is 0.
    - `string`
    - `bool`

