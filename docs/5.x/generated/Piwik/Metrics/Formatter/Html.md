<small>Piwik\Metrics\Formatter\</small>

Html
====

Metrics formatter that formats for HTML output.

Methods
-------

The class defines the following methods:

- [`getPrettyNumber()`](#getprettynumber) &mdash; Returns a prettified string representation of a number. Inherited from [`Formatter`](../../../Piwik/Metrics/Formatter.md)
- [`getPrettyTimeFromSeconds()`](#getprettytimefromseconds) &mdash; Returns a prettified time value (in seconds). Inherited from [`Formatter`](../../../Piwik/Metrics/Formatter.md)
- [`getPrettySizeFromBytes()`](#getprettysizefrombytes) &mdash; Returns a prettified memory size value. Inherited from [`Formatter`](../../../Piwik/Metrics/Formatter.md)
- [`getPrettyMoney()`](#getprettymoney) &mdash; Returns a pretty formatted monetary value using the currency associated with a site. Inherited from [`Formatter`](../../../Piwik/Metrics/Formatter.md)
- [`getPrettyPercentFromQuotient()`](#getprettypercentfromquotient) &mdash; Returns a percent string from a quotient value. Inherited from [`Formatter`](../../../Piwik/Metrics/Formatter.md)
- [`formatMetrics()`](#formatmetrics) &mdash; Formats all metrics, including processed metrics, for a DataTable. Inherited from [`Formatter`](../../../Piwik/Metrics/Formatter.md)

<a name="getprettynumber" id="getprettynumber"></a>
<a name="getPrettyNumber" id="getPrettyNumber"></a>
### `getPrettyNumber()`

Returns a prettified string representation of a number. The result will have
thousands separators and a decimal point specific to the current locale, eg,
`'1,000,000.05'` or `'1.000.000,05'`.

#### Signature

-  It accepts the following parameter(s):
    - `$value`
      
    - `$precision`
      
- It returns a `string` value.

<a name="getprettytimefromseconds" id="getprettytimefromseconds"></a>
<a name="getPrettyTimeFromSeconds" id="getPrettyTimeFromSeconds"></a>
### `getPrettyTimeFromSeconds()`

Returns a prettified time value (in seconds).

#### Signature

-  It accepts the following parameter(s):
    - `$numberOfSeconds` (`int`) &mdash;
       The number of seconds.
    - `$displayTimeAsSentence` (`bool`) &mdash;
       If set to true, will output `"5min 17s"`, if false `"00:05:17"`.
    - `$round` (`bool`) &mdash;
       Whether to round to the nearest second or not.
- It returns a `string` value.

<a name="getprettysizefrombytes" id="getprettysizefrombytes"></a>
<a name="getPrettySizeFromBytes" id="getPrettySizeFromBytes"></a>
### `getPrettySizeFromBytes()`

Returns a prettified memory size value.

#### Signature

-  It accepts the following parameter(s):
    - `$size` (`Piwik\Metrics\number`) &mdash;
       The size in bytes.
    - `$unit` (`string`) &mdash;
       The specific unit to use, if any. If null, the unit is determined by $size.
    - `$precision` (`int`) &mdash;
       The precision to use when rounding.

- *Returns:*  `string` &mdash;
    eg, `'128 M'` or `'256 K'`.

<a name="getprettymoney" id="getprettymoney"></a>
<a name="getPrettyMoney" id="getPrettyMoney"></a>
### `getPrettyMoney()`

Returns a pretty formatted monetary value using the currency associated with a site.

#### Signature

-  It accepts the following parameter(s):
    - `$value` (`int`|`string`) &mdash;
       The monetary value to format.
    - `$idSite` (`int`) &mdash;
       The ID of the site whose currency will be used.
- It returns a `string` value.

<a name="getprettypercentfromquotient" id="getprettypercentfromquotient"></a>
<a name="getPrettyPercentFromQuotient" id="getPrettyPercentFromQuotient"></a>
### `getPrettyPercentFromQuotient()`

Returns a percent string from a quotient value. Forces the use of a '.'
decimal place.

#### Signature

-  It accepts the following parameter(s):
    - `$value` (`float`) &mdash;
      
- It returns a `string` value.

<a name="formatmetrics" id="formatmetrics"></a>
<a name="formatMetrics" id="formatMetrics"></a>
### `formatMetrics()`

Formats all metrics, including processed metrics, for a DataTable. Metrics to format
are found through report metadata and DataTable metadata.

#### Signature

-  It accepts the following parameter(s):
    - `$dataTable` ([`DataTable`](../../../Piwik/DataTable.md)) &mdash;
       The table to format metrics for.
    - `$report` ([`Report`](../../../Piwik/Plugin/Report.md)|`null`) &mdash;
       The report the table belongs to.
    - `$metricsToFormat` (`string[]`|`null`) &mdash;
       Allow a list of names of metrics to format.
    - `$formatAll` (`boolean`) &mdash;
       If true, will also apply formatting to non-processed metrics like revenue. This parameter is not currently supported and subject to change.
- It does not return anything or a mixed result.

