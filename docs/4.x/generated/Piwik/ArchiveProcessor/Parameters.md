<small>Piwik\ArchiveProcessor\</small>

Parameters
==========

Contains the analytics parameters for the reports that are currently being archived.

Methods
-------

The class defines the following methods:

- [`setArchiveOnlyReport()`](#setarchiveonlyreport) &mdash; If we want to archive only a single report, we can request that via this method.
- [`getArchiveOnlyReport()`](#getarchiveonlyreport) &mdash; Gets the report we want to archive specifically, or null if none was specified.
- [`getPeriod()`](#getperiod) &mdash; Returns the period we are computing statistics for.
- [`getSite()`](#getsite) &mdash; Returns the site we are computing statistics for.
- [`getSegment()`](#getsegment) &mdash; The Segment used to limit the set of visits that are being aggregated.

<a name="setarchiveonlyreport" id="setarchiveonlyreport"></a>
<a name="setArchiveOnlyReport" id="setArchiveOnlyReport"></a>
### `setArchiveOnlyReport()`

If we want to archive only a single report, we can request that via this method.

It is up to each plugin's archiver to respect the setting.

#### Signature

-  It accepts the following parameter(s):
    - `$archiveOnlyReport` (`string`) &mdash;
      
- It does not return anything or a mixed result.

<a name="getarchiveonlyreport" id="getarchiveonlyreport"></a>
<a name="getArchiveOnlyReport" id="getArchiveOnlyReport"></a>
### `getArchiveOnlyReport()`

Gets the report we want to archive specifically, or null if none was specified.

#### Signature


- *Returns:*  `string`|`null` &mdash;
    

<a name="getperiod" id="getperiod"></a>
<a name="getPeriod" id="getPeriod"></a>
### `getPeriod()`

Returns the period we are computing statistics for.

#### Signature

- It returns a `Stmt_Namespace\Period` value.

<a name="getsite" id="getsite"></a>
<a name="getSite" id="getSite"></a>
### `getSite()`

Returns the site we are computing statistics for.

#### Signature

- It returns a `Stmt_Namespace\Site` value.

<a name="getsegment" id="getsegment"></a>
<a name="getSegment" id="getSegment"></a>
### `getSegment()`

The Segment used to limit the set of visits that are being aggregated.

#### Signature

- It returns a `Stmt_Namespace\Segment` value.

