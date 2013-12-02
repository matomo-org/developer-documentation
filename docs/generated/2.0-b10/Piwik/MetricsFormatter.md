<small>Piwik</small>

MetricsFormatter
================

Contains helper function that format numerical values in different ways.

Methods
-------

The class defines the following methods:

- [`getPrettyNumber()`](#getprettynumber) &mdash; Returns a prettified string representation of a number.
- [`getPrettyTimeFromSeconds()`](#getprettytimefromseconds) &mdash; Returns a prettified time value (in seconds).
- [`getPrettySizeFromBytes()`](#getprettysizefrombytes) &mdash; Returns a prettified memory size value.
- [`getPrettyMoney()`](#getprettymoney) &mdash; Returns a pretty formated monetary value using the currency associated with a site.
- [`getPrettyValue()`](#getprettyvalue) &mdash; Prettifies a metric value based on the column name.
- [`getCurrencySymbol()`](#getcurrencysymbol) &mdash; Returns the currency symbol for a site.
- [`getCurrencyList()`](#getcurrencylist) &mdash; Returns the list of all known currency symbols.

<a name="getprettynumber" id="getprettynumber"></a>
<a name="getPrettyNumber" id="getPrettyNumber"></a>
### `getPrettyNumber()`

Returns a prettified string representation of a number.

#### Description

The result will have
thousands separators and a decimal point specific to the current locale.

#### Signature

- It accepts the following parameter(s):
    - `$value` (`Piwik\number`)
- It returns a `string` value.

<a name="getprettytimefromseconds" id="getprettytimefromseconds"></a>
<a name="getPrettyTimeFromSeconds" id="getPrettyTimeFromSeconds"></a>
### `getPrettyTimeFromSeconds()`

Returns a prettified time value (in seconds).

#### Signature

- It accepts the following parameter(s):
    - `$numberOfSeconds` (`int`) &mdash; The number of seconds.
    - `$displayTimeAsSentence` (`bool`) &mdash; If set to true, will output `"5min 17s"`, if false `"00:05:17"`.
    - `$isHtml` (`bool`) &mdash; If true, replaces all spaces with `'&nbsp;'`.
    - `$round` (`bool`) &mdash; Whether to round to the nearest second or not.
- It returns a `string` value.

<a name="getprettysizefrombytes" id="getprettysizefrombytes"></a>
<a name="getPrettySizeFromBytes" id="getPrettySizeFromBytes"></a>
### `getPrettySizeFromBytes()`

Returns a prettified memory size value.

#### Signature

- It accepts the following parameter(s):
    - `$size` (`Piwik\number`) &mdash; The size in bytes.
    - `$unit` (`string`) &mdash; The specific unit to use, if any. If null, the unit is determined by $size.
    - `$precision` (`int`) &mdash; The precision to use when rounding.
- _Returns:_ eg, `'128 M'` or `'256 K'`.
    - `string`

<a name="getprettymoney" id="getprettymoney"></a>
<a name="getPrettyMoney" id="getPrettyMoney"></a>
### `getPrettyMoney()`

Returns a pretty formated monetary value using the currency associated with a site.

#### Signature

- It accepts the following parameter(s):
    - `$value` (`int`|`string`) &mdash; The monetary value to format.
    - `$idSite` (`int`) &mdash; The ID of the site whose currency will be used.
    - `$isHtml` (`bool`) &mdash; If true, replaces all spaces with `'&nbsp;'`.
- It returns a `string` value.

<a name="getprettyvalue" id="getprettyvalue"></a>
<a name="getPrettyValue" id="getPrettyValue"></a>
### `getPrettyValue()`

Prettifies a metric value based on the column name.

#### Signature

- It accepts the following parameter(s):
    - `$idSite` (`int`) &mdash; The ID of the site the metric is for (used if the column value is an amount of money).
    - `$columnName` (`string`) &mdash; The metric name.
    - `$value` (`mixed`) &mdash; The metric value.
    - `$isHtml` (`bool`) &mdash; If true, replaces all spaces with `'&nbsp;'`.
- It returns a `string` value.

<a name="getcurrencysymbol" id="getcurrencysymbol"></a>
<a name="getCurrencySymbol" id="getCurrencySymbol"></a>
### `getCurrencySymbol()`

Returns the currency symbol for a site.

#### Signature

- It accepts the following parameter(s):
    - `$idSite` (`int`) &mdash; The ID of the site to return the currency symbol for.
- _Returns:_ eg, `'$'`.
    - `string`

<a name="getcurrencylist" id="getcurrencylist"></a>
<a name="getCurrencyList" id="getCurrencyList"></a>
### `getCurrencyList()`

Returns the list of all known currency symbols.

#### Signature

- _Returns:_ An array mapping currency codes to their respective currency symbols and a description, eg, `array('USD' => array('$', 'US dollar'))`.
    - `array`

