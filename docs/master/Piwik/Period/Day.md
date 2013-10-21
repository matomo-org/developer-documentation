<small>Piwik\Period</small>

Day
===


Methods
-------

The class defines the following methods:

- [`getPrettyString()`](#getPrettyString) &mdash; Returns the day of the period as a string
- [`getLocalizedShortString()`](#getLocalizedShortString) &mdash; Returns the day of the period as a localized short string
- [`getLocalizedLongString()`](#getLocalizedLongString) &mdash; Returns the day of the period as a localized long string
- [`getNumberOfSubperiods()`](#getNumberOfSubperiods) &mdash; Returns the number of subperiods Always 0, in that case
- [`addSubperiod()`](#addSubperiod) &mdash; Adds a subperiod Not supported for day periods
- [`toString()`](#toString) &mdash; Returns the day of the period in the given format
- [`__toString()`](#__toString) &mdash; Returns the current period as a string

### `getPrettyString()` <a name="getPrettyString"></a>

Returns the day of the period as a string

#### Signature

- It is a **public** method.
- It returns a(n) `string` value.

### `getLocalizedShortString()` <a name="getLocalizedShortString"></a>

Returns the day of the period as a localized short string

#### Signature

- It is a **public** method.
- It returns a(n) `string` value.

### `getLocalizedLongString()` <a name="getLocalizedLongString"></a>

Returns the day of the period as a localized long string

#### Signature

- It is a **public** method.
- It returns a(n) `string` value.

### `getNumberOfSubperiods()` <a name="getNumberOfSubperiods"></a>

Returns the number of subperiods Always 0, in that case

#### Signature

- It is a **public** method.
- It returns a(n) `int` value.

### `addSubperiod()` <a name="addSubperiod"></a>

Adds a subperiod Not supported for day periods

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$date`
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

### `toString()` <a name="toString"></a>

Returns the day of the period in the given format

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$format`
- _Returns:_ An array of string dates that this period consists of.
    - `string`

### `__toString()` <a name="__toString"></a>

Returns the current period as a string

#### Signature

- It is a **public** method.
- It returns a(n) `string` value.

