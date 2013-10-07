<small>Piwik</small>

MetricsFormatter
================

Class MetricsFormatter


Methods
-------

The class defines the following methods:

- [`getPrettyNumber()`](#getPrettyNumber) &mdash; Gets a prettified string representation of a number.
- [`getPrettyTimeFromSeconds()`](#getPrettyTimeFromSeconds) &mdash; Pretty format a time
- [`getPrettySizeFromBytes()`](#getPrettySizeFromBytes) &mdash; Pretty format a memory size value
- [`getPrettyMoney()`](#getPrettyMoney) &mdash; Pretty format monetary value for a site
- [`getPrettyValue()`](#getPrettyValue) &mdash; For the given value, based on the column name, will apply: pretty time, pretty money
- [`getCurrencySymbol()`](#getCurrencySymbol) &mdash; Get currency symbol for a site
- [`getCurrencyList()`](#getCurrencyList) &mdash; Returns a list of currency symbols

### `getPrettyNumber()` <a name="getPrettyNumber"></a>

Gets a prettified string representation of a number.

#### Description

The result will have
thousands separators and a decimal point specific to the current locale.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$value`
- It returns a(n) `string` value.

### `getPrettyTimeFromSeconds()` <a name="getPrettyTimeFromSeconds"></a>

Pretty format a time

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$numberOfSeconds`
    - `$displayTimeAsSentence`
    - `$isHtml`
    - `$round`
- It returns a(n) `string` value.

### `getPrettySizeFromBytes()` <a name="getPrettySizeFromBytes"></a>

Pretty format a memory size value

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$size`
    - `$unit`
    - `$precision`
- It returns a(n) `string` value.

### `getPrettyMoney()` <a name="getPrettyMoney"></a>

Pretty format monetary value for a site

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$value`
    - `$idSite`
    - `$htmlAllowed`
- It returns a(n) `string` value.

### `getPrettyValue()` <a name="getPrettyValue"></a>

For the given value, based on the column name, will apply: pretty time, pretty money

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$idSite`
    - `$columnName`
    - `$value`
    - `$htmlAllowed`
- It returns a(n) `string` value.

### `getCurrencySymbol()` <a name="getCurrencySymbol"></a>

Get currency symbol for a site

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$idSite`
- It returns a(n) `string` value.

### `getCurrencyList()` <a name="getCurrencyList"></a>

Returns a list of currency symbols

#### Signature

- It is a **public static** method.
- _Returns:_ array( currencyCode =&gt; symbol, ... )
    - `array`

