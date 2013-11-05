<small>Piwik</small>

MetricsFormatter
================

Contains helper function that format numerical values in different ways.


Methods
-------

The class defines the following methods:

- [`getPrettyNumber()`](#getPrettyNumber) &mdash; Returns a prettified string representation of a number.
- [`getPrettyTimeFromSeconds()`](#getPrettyTimeFromSeconds) &mdash; Returns a prettified time value (in seconds).
- [`getPrettySizeFromBytes()`](#getPrettySizeFromBytes) &mdash; Returns a prettified memory size value.
- [`getPrettyMoney()`](#getPrettyMoney) &mdash; Returns a pretty formated monetary value using the currency associated with a site.
- [`getPrettyValue()`](#getPrettyValue) &mdash; Prettifies a metric value based on the column name.
- [`getCurrencySymbol()`](#getCurrencySymbol) &mdash; Returns the currency symbol for a site.
- [`getCurrencyList()`](#getCurrencyList) &mdash; Returns the list of all known currency symbols.

<a name="getprettynumber" id="getprettynumber"></a>
### `getPrettyNumber()`

Returns a prettified string representation of a number.

#### Description

The result will have
thousands separators and a decimal point specific to the current locale.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$value`
- It returns a(n) `string` value.

<a name="getprettytimefromseconds" id="getprettytimefromseconds"></a>
### `getPrettyTimeFromSeconds()`

Returns a prettified time value (in seconds).

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$numberOfSeconds`
    - `$displayTimeAsSentence`
    - `$isHtml`
    - `$round`
- It returns a(n) `string` value.

<a name="getprettysizefrombytes" id="getprettysizefrombytes"></a>
### `getPrettySizeFromBytes()`

Returns a prettified memory size value.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$size`
    - `$unit`
    - `$precision`
- _Returns:_ eg, `&#039;128 M&#039;` or `&#039;256 K&#039;`.
    - `string`

<a name="getprettymoney" id="getprettymoney"></a>
### `getPrettyMoney()`

Returns a pretty formated monetary value using the currency associated with a site.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$value`
    - `$idSite`
    - `$isHtml`
- It returns a(n) `string` value.

<a name="getprettyvalue" id="getprettyvalue"></a>
### `getPrettyValue()`

Prettifies a metric value based on the column name.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$idSite`
    - `$columnName`
    - `$value`
    - `$isHtml`
- It returns a(n) `string` value.

<a name="getcurrencysymbol" id="getcurrencysymbol"></a>
### `getCurrencySymbol()`

Returns the currency symbol for a site.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$idSite`
- _Returns:_ eg, `&#039;$&#039;`.
    - `string`

<a name="getcurrencylist" id="getcurrencylist"></a>
### `getCurrencyList()`

Returns the list of all known currency symbols.

#### Signature

- It is a **public static** method.
- _Returns:_ An array mapping currency codes to their respective currency symbols and a description, eg, `array(&#039;USD&#039; =&gt; array(&#039;$&#039;, &#039;US dollar&#039;))`.
    - `array`

