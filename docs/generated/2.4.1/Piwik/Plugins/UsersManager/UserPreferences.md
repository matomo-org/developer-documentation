<small>Piwik\Plugins\UsersManager\</small>

UserPreferences
===============

Methods
-------

The class defines the following methods:

- [`getDefaultWebsiteId()`](#getdefaultwebsiteid) &mdash; Returns default site ID that Piwik should load.
- [`getDefaultDate()`](#getdefaultdate) &mdash; Returns default date for Piwik reports.
- [`getDefaultPeriod()`](#getdefaultperiod) &mdash; Returns default period type for Piwik reports.

<a name="getdefaultwebsiteid" id="getdefaultwebsiteid"></a>
<a name="getDefaultWebsiteId" id="getDefaultWebsiteId"></a>
### `getDefaultWebsiteId()` 
Returns default site ID that Piwik should load.

_Note: This value is a Piwik setting set by each user._

#### Signature


<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`bool`|`int`) &mdash;
    <div markdown="1" class="param-desc"></div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="getdefaultdate" id="getdefaultdate"></a>
<a name="getDefaultDate" id="getDefaultDate"></a>
### `getDefaultDate()` 
Returns default date for Piwik reports.

_Note: This value is a Piwik setting set by each user._

#### Signature


<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`string`) &mdash;
    <div markdown="1" class="param-desc">`'today'`, `'2010-01-01'`, etc.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="getdefaultperiod" id="getdefaultperiod"></a>
<a name="getDefaultPeriod" id="getDefaultPeriod"></a>
### `getDefaultPeriod()` 
Returns default period type for Piwik reports.

#### Signature


<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`string`) &mdash;
    <div markdown="1" class="param-desc">`'day'`, `'week'`, `'month'`, `'year'` or `'range'`</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

