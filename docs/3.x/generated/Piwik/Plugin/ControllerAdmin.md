<small>Piwik\Plugin\</small>

ControllerAdmin
===============

Base class of plugin controllers that provide administrative functionality.

See [Controller](/api-reference/Piwik/Plugin/Controller) to learn more about Piwik controllers.

Properties
----------

This abstract class defines the following properties:

- [`$pluginName`](#$pluginname) &mdash; The plugin name, eg. Inherited from [`Controller`](../../Piwik/Plugin/Controller.md)
- [`$strDate`](#$strdate) &mdash; The value of the **date** query parameter. Inherited from [`Controller`](../../Piwik/Plugin/Controller.md)
- [`$date`](#$date) &mdash; The Date object created with ($strDate)[#strDate] or null if the requested date is a range. Inherited from [`Controller`](../../Piwik/Plugin/Controller.md)
- [`$idSite`](#$idsite) &mdash; The value of the **idSite** query parameter. Inherited from [`Controller`](../../Piwik/Plugin/Controller.md)
- [`$site`](#$site) &mdash; The Site object created with [$idSite](/api-reference/Piwik/Plugin/ControllerAdmin#$idsite). Inherited from [`Controller`](../../Piwik/Plugin/Controller.md)

<a name="$pluginname" id="$pluginname"></a>
<a name="pluginName" id="pluginName"></a>
### `$pluginName`

The plugin name, eg.

`'Referrers'`.

#### Signature

- It is a `string` value.

<a name="$strdate" id="$strdate"></a>
<a name="strDate" id="strDate"></a>
### `$strDate`

The value of the **date** query parameter.

#### Signature

- It is a `string` value.

<a name="$date" id="$date"></a>
<a name="date" id="date"></a>
### `$date`

The Date object created with ($strDate)[#strDate] or null if the requested date is a range.

#### Signature

- It can be one of the following types:
    - [`Date`](../../Piwik/Date.md)
    - `null`

<a name="$idsite" id="$idsite"></a>
<a name="idSite" id="idSite"></a>
### `$idSite`

The value of the **idSite** query parameter.

#### Signature

- It is a `int` value.

<a name="$site" id="$site"></a>
<a name="site" id="site"></a>
### `$site`

The Site object created with [$idSite](/api-reference/Piwik/Plugin/ControllerAdmin#$idsite).

#### Signature

- It is a [`Site`](../../Piwik/Site.md) value.

Methods
-------

The abstract class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor. Inherited from [`Controller`](../../Piwik/Plugin/Controller.md)
- [`getDateParameterInTimezone()`](#getdateparameterintimezone) &mdash; Helper method that converts `"today"` or `"yesterday"` to the specified timezone. Inherited from [`Controller`](../../Piwik/Plugin/Controller.md)
- [`setDate()`](#setdate) &mdash; Sets the date to be used by all other methods in the controller. Inherited from [`Controller`](../../Piwik/Plugin/Controller.md)
- [`getDefaultAction()`](#getdefaultaction) &mdash; Returns the name of the default method that will be called when visiting: index.php?module=PluginName without the action parameter. Inherited from [`Controller`](../../Piwik/Plugin/Controller.md)
- [`renderTemplate()`](#rendertemplate) &mdash; Assigns the given variables to the template and renders it. Inherited from [`Controller`](../../Piwik/Plugin/Controller.md)
- [`renderReport()`](#renderreport) &mdash; Convenience method that creates and renders a ViewDataTable for a API method. Inherited from [`Controller`](../../Piwik/Plugin/Controller.md)
- [`getLastUnitGraph()`](#getlastunitgraph) &mdash; Returns a ViewDataTable object that will render a jqPlot evolution graph for the last30 days/weeks/etc. Inherited from [`Controller`](../../Piwik/Plugin/Controller.md)
- [`getLastUnitGraphAcrossPlugins()`](#getlastunitgraphacrossplugins) &mdash; Same as [getLastUnitGraph()](/api-reference/Piwik/Plugin/ControllerAdmin#getlastunitgraph), but will set some properties of the ViewDataTable object based on the arguments supplied. Inherited from [`Controller`](../../Piwik/Plugin/Controller.md)
- [`getUrlSparkline()`](#geturlsparkline) &mdash; Returns a URL to a sparkline image for a report served by the current plugin. Inherited from [`Controller`](../../Piwik/Plugin/Controller.md)
- [`setMinDateView()`](#setmindateview) &mdash; Sets the first date available in the period selector's calendar. Inherited from [`Controller`](../../Piwik/Plugin/Controller.md)
- [`setMaxDateView()`](#setmaxdateview) &mdash; Sets the last date available in the period selector's calendar. Inherited from [`Controller`](../../Piwik/Plugin/Controller.md)
- [`setGeneralVariablesView()`](#setgeneralvariablesview) &mdash; Assigns variables to [View](/api-reference/Piwik/View) instances that display an entire page. Inherited from [`Controller`](../../Piwik/Plugin/Controller.md)
- [`setBasicVariablesView()`](#setbasicvariablesview) &mdash; Assigns a set of generally useful variables to a [View](/api-reference/Piwik/View) instance. Inherited from [`Controller`](../../Piwik/Plugin/Controller.md)
- [`setHostValidationVariablesView()`](#sethostvalidationvariablesview) &mdash; Checks if the current host is valid and sets variables on the given view, including: Inherited from [`Controller`](../../Piwik/Plugin/Controller.md)
- [`setPeriodVariablesView()`](#setperiodvariablesview) &mdash; Sets general period variables on a view, including: Inherited from [`Controller`](../../Piwik/Plugin/Controller.md)
- [`redirectToIndex()`](#redirecttoindex) &mdash; Helper method used to redirect the current HTTP request to another module/action. Inherited from [`Controller`](../../Piwik/Plugin/Controller.md)
- [`checkTokenInUrl()`](#checktokeninurl) &mdash; Checks that the token_auth in the URL matches the currently logged-in user's token_auth. Inherited from [`Controller`](../../Piwik/Plugin/Controller.md)
- [`getCalendarPrettyDate()`](#getcalendarprettydate) &mdash; Returns a prettified date string for use in period selector widget. Inherited from [`Controller`](../../Piwik/Plugin/Controller.md)
- [`setBasicVariablesAdminView()`](#setbasicvariablesadminview) &mdash; Assigns view properties that would be useful to views that render admin pages.

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature


<a name="getdateparameterintimezone" id="getdateparameterintimezone"></a>
<a name="getDateParameterInTimezone" id="getDateParameterInTimezone"></a>
### `getDateParameterInTimezone()`

Helper method that converts `"today"` or `"yesterday"` to the specified timezone.

If the date is absolute, ie. YYYY-MM-DD, it will not be converted to the timezone.

#### Signature

-  It accepts the following parameter(s):
    - `$date` (`string`) &mdash;
       `'today'`, `'yesterday'`, `'YYYY-MM-DD'`
    - `$timezone` (`string`) &mdash;
       The timezone to use.
- It returns a [`Date`](../../Piwik/Date.md) value.

<a name="setdate" id="setdate"></a>
<a name="setDate" id="setDate"></a>
### `setDate()`

Sets the date to be used by all other methods in the controller.

If the date has to be modified, this method should be called just after
construction.

#### Signature

-  It accepts the following parameter(s):
    - `$date` ([`Date`](../../Piwik/Date.md)) &mdash;
       The new Date.
- It returns a `void` value.

<a name="getdefaultaction" id="getdefaultaction"></a>
<a name="getDefaultAction" id="getDefaultAction"></a>
### `getDefaultAction()`

Returns the name of the default method that will be called when visiting: index.php?module=PluginName without the action parameter.

#### Signature

- It returns a `string` value.

<a name="rendertemplate" id="rendertemplate"></a>
<a name="renderTemplate" id="renderTemplate"></a>
### `renderTemplate()`

Since Piwik 2.5.0

Assigns the given variables to the template and renders it.

Example:

    public function myControllerAction () {
       return $this->renderTemplate('index', array(
           'answerToLife' => '42'
       ));
    }

This will render the 'index.twig' file within the plugin templates folder and assign the view variable
`answerToLife` to `42`.

#### Signature

-  It accepts the following parameter(s):
    - `$template` (`string`) &mdash;
       The name of the template file. If only a name is given it will automatically use the template within the plugin folder. For instance 'myTemplate' will result in '@$pluginName/myTemplate.twig'. Alternatively you can include the full path: '@anyOtherFolder/otherTemplate'. The trailing '.twig' is not needed.
    - `$variables` (`array`) &mdash;
       For instance array('myViewVar' => 'myValue'). In template you can use {{ myViewVar }}
- It returns a `string` value.

<a name="renderreport" id="renderreport"></a>
<a name="renderReport" id="renderReport"></a>
### `renderReport()`

Convenience method that creates and renders a ViewDataTable for a API method.

#### Signature

-  It accepts the following parameter(s):
    - `$apiAction`
      
    - `$controllerAction`
      

- *Returns:*  `string`|`void` &mdash;
    See `$fetch`.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if `$pluginName` is not an existing plugin or if `$apiAction` is not an existing method of the plugin&#039;s API.

<a name="getlastunitgraph" id="getlastunitgraph"></a>
<a name="getLastUnitGraph" id="getLastUnitGraph"></a>
### `getLastUnitGraph()`

Returns a ViewDataTable object that will render a jqPlot evolution graph for the last30 days/weeks/etc.

of the current period, relative to the current date.

#### Signature

-  It accepts the following parameter(s):
    - `$currentModuleName` (`string`) &mdash;
       The name of the current plugin.
    - `$currentControllerAction` (`string`) &mdash;
       The name of the action that renders the desired report.
    - `$apiMethod` (`string`) &mdash;
       The API method that the ViewDataTable will use to get graph data.
- It returns a [`ViewDataTable`](../../Piwik/Plugin/ViewDataTable.md) value.

<a name="getlastunitgraphacrossplugins" id="getlastunitgraphacrossplugins"></a>
<a name="getLastUnitGraphAcrossPlugins" id="getLastUnitGraphAcrossPlugins"></a>
### `getLastUnitGraphAcrossPlugins()`

Same as [getLastUnitGraph()](/api-reference/Piwik/Plugin/ControllerAdmin#getlastunitgraph), but will set some properties of the ViewDataTable object based on the arguments supplied.

#### Signature

-  It accepts the following parameter(s):
    - `$currentModuleName` (`string`) &mdash;
       The name of the current plugin.
    - `$currentControllerAction` (`string`) &mdash;
       The name of the action that renders the desired report.
    - `$columnsToDisplay` (`array`) &mdash;
       The value to use for the ViewDataTable's columns_to_display config property.
    - `$selectableColumns` (`array`) &mdash;
       The value to use for the ViewDataTable's selectable_columns config property.
    - `$reportDocumentation` (`bool`|`string`) &mdash;
       The value to use for the ViewDataTable's documentation config property.
    - `$apiMethod` (`string`) &mdash;
       The API method that the ViewDataTable will use to get graph data.
- It returns a [`ViewDataTable`](../../Piwik/Plugin/ViewDataTable.md) value.

<a name="geturlsparkline" id="geturlsparkline"></a>
<a name="getUrlSparkline" id="getUrlSparkline"></a>
### `getUrlSparkline()`

Returns a URL to a sparkline image for a report served by the current plugin.

The result of this URL should be used with the [sparkline()](/api-reference/Piwik/View#twig) twig function.

The current site ID and period will be used.

#### Signature

-  It accepts the following parameter(s):
    - `$action` (`string`) &mdash;
       Method name of the controller that serves the report.
    - `$customParameters` (`array`) &mdash;
       The array of query parameter name/value pairs that should be set in result URL.

- *Returns:*  `string` &mdash;
    The generated URL.

<a name="setmindateview" id="setmindateview"></a>
<a name="setMinDateView" id="setMinDateView"></a>
### `setMinDateView()`

Sets the first date available in the period selector's calendar.

#### Signature

-  It accepts the following parameter(s):
    - `$minDate` ([`Date`](../../Piwik/Date.md)) &mdash;
       The min date.
    - `$view` ([`View`](../../Piwik/View.md)) &mdash;
       The view that contains the period selector.
- It does not return anything.

<a name="setmaxdateview" id="setmaxdateview"></a>
<a name="setMaxDateView" id="setMaxDateView"></a>
### `setMaxDateView()`

Sets the last date available in the period selector's calendar.

Usually this is just the "today" date
for a site (which varies based on the timezone of a site).

#### Signature

-  It accepts the following parameter(s):
    - `$maxDate` ([`Date`](../../Piwik/Date.md)) &mdash;
       The max date.
    - `$view` ([`View`](../../Piwik/View.md)) &mdash;
       The view that contains the period selector.
- It does not return anything.

<a name="setgeneralvariablesview" id="setgeneralvariablesview"></a>
<a name="setGeneralVariablesView" id="setGeneralVariablesView"></a>
### `setGeneralVariablesView()`

Assigns variables to [View](/api-reference/Piwik/View) instances that display an entire page.

The following variables assigned:

**date** - The value of the **date** query parameter.
**idSite** - The value of the **idSite** query parameter.
**rawDate** - The value of the **date** query parameter.
**prettyDate** - A pretty string description of the current period.
**siteName** - The current site's name.
**siteMainUrl** - The URL of the current site.
**startDate** - The start date of the current period. A [Date](/api-reference/Piwik/Date) instance.
**endDate** - The end date of the current period. A [Date](/api-reference/Piwik/Date) instance.
**language** - The current language's language code.
**config_action_url_category_delimiter** - The value of the `[General] action_url_category_delimiter`
                                           INI config option.
**topMenu** - The result of `MenuTop::getInstance()->getMenu()`.

As well as the variables set by [setPeriodVariablesView()](/api-reference/Piwik/Plugin/ControllerAdmin#setperiodvariablesview).

Will exit on error.

#### Signature

-  It accepts the following parameter(s):
    - `$view`
      
- It returns a `void` value.

<a name="setbasicvariablesview" id="setbasicvariablesview"></a>
<a name="setBasicVariablesView" id="setBasicVariablesView"></a>
### `setBasicVariablesView()`

Assigns a set of generally useful variables to a [View](/api-reference/Piwik/View) instance.

The following variables assigned:

**isSuperUser** - True if the current user is the Super User, false if otherwise.
**hasSomeAdminAccess** - True if the current user has admin access to at least one site,
                         false if otherwise.
**isCustomLogo** - The value of the `branding_use_custom_logo` option.
**logoHeader** - The header logo URL to use.
**logoLarge** - The large logo URL to use.
**logoSVG** - The SVG logo URL to use.
**hasSVGLogo** - True if there is a SVG logo, false if otherwise.
**enableFrames** - The value of the `[General] enable_framed_pages` INI config option. If
                   true, [View::setXFrameOptions()](/api-reference/Piwik/View#setxframeoptions) is called on the view.

Also calls [setHostValidationVariablesView()](/api-reference/Piwik/Plugin/ControllerAdmin#sethostvalidationvariablesview).

#### Signature

-  It accepts the following parameter(s):
    - `$view`
      
- It does not return anything.

<a name="sethostvalidationvariablesview" id="sethostvalidationvariablesview"></a>
<a name="setHostValidationVariablesView" id="setHostValidationVariablesView"></a>
### `setHostValidationVariablesView()`

Checks if the current host is valid and sets variables on the given view, including:

- **isValidHost** - true if host is valid, false if otherwise
- **invalidHostMessage** - message to display if host is invalid (only set if host is invalid)
- **invalidHost** - the invalid hostname (only set if host is invalid)
- **mailLinkStart** - the open tag of a link to email the Super User of this problem (only set
                      if host is invalid)

#### Signature

-  It accepts the following parameter(s):
    - `$view` ([`View`](../../Piwik/View.md)) &mdash;
      
- It does not return anything.

<a name="setperiodvariablesview" id="setperiodvariablesview"></a>
<a name="setPeriodVariablesView" id="setPeriodVariablesView"></a>
### `setPeriodVariablesView()`

Sets general period variables on a view, including:

- **displayUniqueVisitors** - Whether unique visitors should be displayed for the current
                              period.
- **period** - The value of the **period** query parameter.
- **otherPeriods** - `array('day', 'week', 'month', 'year', 'range')`
- **periodsNames** - List of available periods mapped to their singular and plural translations.

#### Signature

-  It accepts the following parameter(s):
    - `$view` ([`View`](../../Piwik/View.md)) &mdash;
      
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if the current period is invalid.

<a name="redirecttoindex" id="redirecttoindex"></a>
<a name="redirectToIndex" id="redirectToIndex"></a>
### `redirectToIndex()`

Helper method used to redirect the current HTTP request to another module/action.

This function will exit immediately after executing.

#### Signature

-  It accepts the following parameter(s):
    - `$moduleToRedirect` (`string`) &mdash;
       The plugin to redirect to, eg. `"MultiSites"`.
    - `$actionToRedirect` (`string`) &mdash;
       Action, eg. `"index"`.
    - `$websiteId` (`int`|`null`) &mdash;
       The new idSite query parameter, eg, `1`.
    - `$defaultPeriod` (`string`|`null`) &mdash;
       The new period query parameter, eg, `'day'`.
    - `$defaultDate` (`string`|`null`) &mdash;
       The new date query parameter, eg, `'today'`.
    - `$parameters` (`array`) &mdash;
       Other query parameters to append to the URL.
- It does not return anything.

<a name="checktokeninurl" id="checktokeninurl"></a>
<a name="checkTokenInUrl" id="checkTokenInUrl"></a>
### `checkTokenInUrl()`

Checks that the token_auth in the URL matches the currently logged-in user's token_auth.

This is a protection against CSRF and should be used in all controller
methods that modify Piwik or any user settings.

If called from JavaScript by using the `ajaxHelper` you have to call `ajaxHelper.withTokenInUrl();` before
`ajaxHandler.send();` to send the token along with the request.

**The token_auth should never appear in the browser's address bar.**

#### Signature

- It does not return anything.
- It throws one of the following exceptions:
    - [`Piwik\NoAccessException`](../../Piwik/NoAccessException.md) &mdash; If the token doesn&#039;t match.

<a name="getcalendarprettydate" id="getcalendarprettydate"></a>
<a name="getCalendarPrettyDate" id="getCalendarPrettyDate"></a>
### `getCalendarPrettyDate()`

Returns a prettified date string for use in period selector widget.

#### Signature

-  It accepts the following parameter(s):
    - `$period` ([`Period`](../../Piwik/Period.md)) &mdash;
       The period to return a pretty string for.
- It returns a `string` value.

<a name="setbasicvariablesadminview" id="setbasicvariablesadminview"></a>
<a name="setBasicVariablesAdminView" id="setBasicVariablesAdminView"></a>
### `setBasicVariablesAdminView()`

Assigns view properties that would be useful to views that render admin pages.

Assigns the following variables:

- **statisticsNotRecorded** - Set to true if the `[Tracker] record_statistics` INI
                              config is `0`. If not `0`, this variable will not be defined.
- **topMenu** - The result of `MenuTop::getInstance()->getMenu()`.
- **enableFrames** - The value of the `[General] enable_framed_pages` INI config option. If
                   true, [View::setXFrameOptions()](/api-reference/Piwik/View#setxframeoptions) is called on the view.
- **isSuperUser** - Whether the current user is a superuser or not.
- **usingOldGeoIPPlugin** - Whether this Piwik install is currently using the old GeoIP
                            plugin or not.
- **invalidPluginsWarning** - Set if some of the plugins to load (determined by INI configuration)
                              are invalid or missing.
- **phpVersion** - The current PHP version.
- **phpIsNewEnough** - Whether the current PHP version is new enough to run Piwik.
- **adminMenu** - The result of `MenuAdmin::getInstance()->getMenu()`.

#### Signature

-  It accepts the following parameter(s):
    - `$view` ([`View`](../../Piwik/View.md)) &mdash;
      
- It does not return anything.

