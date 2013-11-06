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
    - `$value`
- It returns a `string` value.

<a name="getprettytimefromseconds" id="getprettytimefromseconds"></a>
<a name="getPrettyTimeFromSeconds" id="getPrettyTimeFromSeconds"></a>
### `getPrettyTimeFromSeconds()`

Returns a prettified time value (in seconds).

#### Signature

- It accepts the following parameter(s):
    - `$numberOfSeconds`
    - `$displayTimeAsSentence`
    - `$isHtml`
    - `$round`
- It returns a `string` value.

<a name="getprettysizefrombytes" id="getprettysizefrombytes"></a>
<a name="getPrettySizeFromBytes" id="getPrettySizeFromBytes"></a>
### `getPrettySizeFromBytes()`

Returns a prettified memory size value.

#### Signature

- It accepts the following parameter(s):
    - `$size`
    - `$unit`
    - `$precision`
- _Returns:_ eg, `'128 M'` or `'256 K'`.
    - `string`

<a name="getprettymoney" id="getprettymoney"></a>
<a name="getPrettyMoney" id="getPrettyMoney"></a>
### `getPrettyMoney()`

Returns a pretty formated monetary value using the currency associated with a site.

#### Signature

- It accepts the following parameter(s):
    - `$value`
    - `$idSite`
    - `$isHtml`
- It returns a `string` value.

<a name="getprettyvalue" id="getprettyvalue"></a>
<a name="getPrettyValue" id="getPrettyValue"></a>
### `getPrettyValue()`

Prettifies a metric value based on the column name.

#### Signature

- It accepts the following parameter(s):
    - `$idSite`
    - `$columnName`
    - `$value`
    - `$isHtml`
- It returns a `string` value.

<a name="getcurrencysymbol" id="getcurrencysymbol"></a>
<a name="getCurrencySymbol" id="getCurrencySymbol"></a>
### `getCurrencySymbol()`

Returns the currency symbol for a site.

#### Signature

- It accepts the following parameter(s):
    - `$idSite`
- _Returns:_ eg, `'$'`.
    - `string`

<a name="getcurrencylist" id="getcurrencylist"></a>
<a name="getCurrencyList" id="getCurrencyList"></a>
### `getCurrencyList()`

Returns the list of all known currency symbols.

#### Signature

- _Returns:_ An array mapping currency codes to their respective currency symbols and a description, eg, `array('USD' => array('$', 'US dollar'))`.
    - `array`

