<small>Piwik\Plugin</small>

Controller
==========

Parent class of all plugins Controllers (located in /plugins/PluginName/Controller.php It defines some helper functions controllers can use.


Methods
-------

The abstract class defines the following methods:

- [`__construct()`](#__construct) &mdash; Builds the controller object, reads the date from the request, extracts plugin name from
- [`getDefaultAction()`](#getDefaultAction) &mdash; Returns the name of the default method that will be called when visiting: index.php?module=PluginName without the action parameter
- [`getDateRangeRelativeToEndDate()`](#getDateRangeRelativeToEndDate) &mdash; Given for example, $period = month, $lastN = &#039;last6&#039;, $endDate = &#039;2011-07-01&#039;, It will return the $date = &#039;2011-01-01,2011-07-01&#039; which is useful to draw graphs for the last N periods
- [`setHostValidationVariablesView()`](#setHostValidationVariablesView) &mdash; Checks if the current host is valid and sets variables on the given view, including:
- [`setPeriodVariablesView()`](#setPeriodVariablesView) &mdash; Sets general period variables (available periods, current period, period labels) used by templates
- [`redirectToIndex()`](#redirectToIndex) &mdash; Helper method used to redirect the current http request to another module/action If specified, will also redirect to a given website, period and /or date
- [`getCalendarPrettyDate()`](#getCalendarPrettyDate) &mdash; Returns pretty date for use in period selector widget.
- [`getPrettyDate()`](#getPrettyDate) &mdash; Returns the pretty date representation

### `__construct()` <a name="__construct"></a>

Builds the controller object, reads the date from the request, extracts plugin name from

#### Signature

- It is a **public** method.
- It does not return anything.

### `getDefaultAction()` <a name="getDefaultAction"></a>

Returns the name of the default method that will be called when visiting: index.php?module=PluginName without the action parameter

#### Signature

- It is a **public** method.
- It returns a(n) `string` value.

### `getDateRangeRelativeToEndDate()` <a name="getDateRangeRelativeToEndDate"></a>

Given for example, $period = month, $lastN = &#039;last6&#039;, $endDate = &#039;2011-07-01&#039;, It will return the $date = &#039;2011-01-01,2011-07-01&#039; which is useful to draw graphs for the last N periods

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$period`
    - `$lastN`
    - `$endDate`
    - `$site`
- It returns a(n) `string` value.

### `setHostValidationVariablesView()` <a name="setHostValidationVariablesView"></a>

Checks if the current host is valid and sets variables on the given view, including:

#### Description

isValidHost - true if host is valid, false if otherwise
invalidHostMessage - message to display if host is invalid (only set if host is invalid)
invalidHost - the invalid hostname (only set if host is invalid)
mailLinkStart - the open tag of a link to email the super user of this problem (only set
                if host is invalid)

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$view`
- It does not return anything.

### `setPeriodVariablesView()` <a name="setPeriodVariablesView"></a>

Sets general period variables (available periods, current period, period labels) used by templates

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$view`
- It returns a(n) `void` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

### `redirectToIndex()` <a name="redirectToIndex"></a>

Helper method used to redirect the current http request to another module/action If specified, will also redirect to a given website, period and /or date

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$moduleToRedirect`
    - `$actionToRedirect`
    - `$websiteId`
    - `$defaultPeriod`
    - `$defaultDate`
    - `$parameters`
- It does not return anything.

### `getCalendarPrettyDate()` <a name="getCalendarPrettyDate"></a>

Returns pretty date for use in period selector widget.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$period`
- It returns a(n) `string` value.

### `getPrettyDate()` <a name="getPrettyDate"></a>

Returns the pretty date representation

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$date`
    - `$period`
- _Returns:_ Pretty date
    - `string`

