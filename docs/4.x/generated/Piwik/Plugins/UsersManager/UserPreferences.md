<small>Piwik\Plugins\UsersManager\</small>

UserPreferences
===============

Methods
-------

The class defines the following methods:

- [`getDefaultWebsiteId()`](#getdefaultwebsiteid) &mdash; Returns default site ID that Piwik should load.
- [`getDefaultReport()`](#getdefaultreport) &mdash; Returns default site ID that Piwik should load.
- [`getDefaultDate()`](#getdefaultdate) &mdash; Returns default date for Piwik reports.
- [`getDefaultPeriod()`](#getdefaultperiod) &mdash; Returns default period type for Piwik reports.

<a name="getdefaultwebsiteid" id="getdefaultwebsiteid"></a>
<a name="getDefaultWebsiteId" id="getDefaultWebsiteId"></a>
### `getDefaultWebsiteId()`

Returns default site ID that Piwik should load.

_Note: This value is a Piwik setting set by each user._

#### Signature


- *Returns:*  `bool`|`int` &mdash;
    

<a name="getdefaultreport" id="getdefaultreport"></a>
<a name="getDefaultReport" id="getDefaultReport"></a>
### `getDefaultReport()`

Returns default site ID that Piwik should load.

_Note: This value is a Piwik setting set by each user._

#### Signature


- *Returns:*  `bool`|`int` &mdash;
    

<a name="getdefaultdate" id="getdefaultdate"></a>
<a name="getDefaultDate" id="getDefaultDate"></a>
### `getDefaultDate()`

Returns default date for Piwik reports.

_Note: This value is a Piwik setting set by each user._

#### Signature


- *Returns:*  `string` &mdash;
    `'today'`, `'2010-01-01'`, etc.

<a name="getdefaultperiod" id="getdefaultperiod"></a>
<a name="getDefaultPeriod" id="getDefaultPeriod"></a>
### `getDefaultPeriod()`

Returns default period type for Piwik reports.

#### Signature

-  It accepts the following parameter(s):
    - `$defaultDate` (`string`) &mdash;
       the default date string from which the default period will be guessed

- *Returns:*  `string` &mdash;
    `'day'`, `'week'`, `'month'`, `'year'` or `'range'`

