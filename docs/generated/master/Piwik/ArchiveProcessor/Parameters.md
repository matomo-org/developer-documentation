<small>Piwik\ArchiveProcessor</small>

Parameters
==========

An ArchiveProcessor processes data for an Archive determined by these Parameters: website, period and segment.

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct)
- [`setRequestedPlugin()`](#setrequestedplugin)
- [`getRequestedPlugin()`](#getrequestedplugin)
- [`getPeriod()`](#getperiod) &mdash; Returns the period we computing statistics for.
- [`getSubPeriods()`](#getsubperiods) &mdash; Returns the array of Period which make up this archive.
- [`getIdSites()`](#getidsites)
- [`getSite()`](#getsite) &mdash; Returns the site we are computing statistics for.
- [`getSegment()`](#getsegment) &mdash; The Segment used to limit the set of visits that are being aggregated.
- [`getDateEnd()`](#getdateend) &mdash; Returns the Date end of this period.
- [`getDateStart()`](#getdatestart) &mdash; Returns the Date start of this period.
- [`isSingleSiteDayArchive()`](#issinglesitedayarchive)
- [`logStatusDebug()`](#logstatusdebug)

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

#### Signature

- It accepts the following parameter(s):
    - `$site` ([`Site`](../../Piwik/Site.md))
    - `$period` ([`Period`](../../Piwik/Period.md))
    - `$segment` ([`Segment`](../../Piwik/Segment.md))

<a name="setrequestedplugin" id="setrequestedplugin"></a>
<a name="setRequestedPlugin" id="setRequestedPlugin"></a>
### `setRequestedPlugin()`

#### Signature

- It accepts the following parameter(s):
    - `$plugin`
- It does not return anything.

<a name="getrequestedplugin" id="getrequestedplugin"></a>
<a name="getRequestedPlugin" id="getRequestedPlugin"></a>
### `getRequestedPlugin()`

#### Signature

- It does not return anything.

<a name="getperiod" id="getperiod"></a>
<a name="getPeriod" id="getPeriod"></a>
### `getPeriod()`

Returns the period we computing statistics for.

#### Signature

- It returns a [`Period`](../../Piwik/Period.md) value.

<a name="getsubperiods" id="getsubperiods"></a>
<a name="getSubPeriods" id="getSubPeriods"></a>
### `getSubPeriods()`

Returns the array of Period which make up this archive.

#### Signature

- It returns a [`Period[]`](../../Piwik/Period.md) value.

<a name="getidsites" id="getidsites"></a>
<a name="getIdSites" id="getIdSites"></a>
### `getIdSites()`

#### Signature

- It returns a `array` value.

<a name="getsite" id="getsite"></a>
<a name="getSite" id="getSite"></a>
### `getSite()`

Returns the site we are computing statistics for.

#### Signature

- It returns a [`Site`](../../Piwik/Site.md) value.

<a name="getsegment" id="getsegment"></a>
<a name="getSegment" id="getSegment"></a>
### `getSegment()`

The Segment used to limit the set of visits that are being aggregated.

#### Signature

- It returns a [`Segment`](../../Piwik/Segment.md) value.

<a name="getdateend" id="getdateend"></a>
<a name="getDateEnd" id="getDateEnd"></a>
### `getDateEnd()`

Returns the Date end of this period.

#### Signature

- It returns a [`Date`](../../Piwik/Date.md) value.

<a name="getdatestart" id="getdatestart"></a>
<a name="getDateStart" id="getDateStart"></a>
### `getDateStart()`

Returns the Date start of this period.

#### Signature

- It returns a [`Date`](../../Piwik/Date.md) value.

<a name="issinglesitedayarchive" id="issinglesitedayarchive"></a>
<a name="isSingleSiteDayArchive" id="isSingleSiteDayArchive"></a>
### `isSingleSiteDayArchive()`

#### Signature

- It returns a `bool` value.

<a name="logstatusdebug" id="logstatusdebug"></a>
<a name="logStatusDebug" id="logStatusDebug"></a>
### `logStatusDebug()`

#### Signature

- It accepts the following parameter(s):
    - `$isTemporary`
- It does not return anything.

