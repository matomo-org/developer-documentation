<small>Piwik\Columns\Join\</small>

SiteNameJoin
============

Since Matomo 3.1.0

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Join constructor.
- [`getTable()`](#gettable) Inherited from [`Join`](../../../Piwik/Columns/Join.md)
- [`getColumn()`](#getcolumn) Inherited from [`Join`](../../../Piwik/Columns/Join.md)
- [`getTargetColumn()`](#gettargetcolumn) Inherited from [`Join`](../../../Piwik/Columns/Join.md)
- [`getAdditionalKeyColumns()`](#getadditionalkeycolumns) &mdash; Columns that must additionally match between the joined-from table and the joined table to identify a row, given as column names present on both tables. Inherited from [`Join`](../../../Piwik/Columns/Join.md)

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Join constructor.

#### Signature

- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

<a name="gettable" id="gettable"></a>
<a name="getTable" id="getTable"></a>
### `getTable()`

#### Signature

- It returns a `string` value.

<a name="getcolumn" id="getcolumn"></a>
<a name="getColumn" id="getColumn"></a>
### `getColumn()`

#### Signature

- It returns a `string` value.

<a name="gettargetcolumn" id="gettargetcolumn"></a>
<a name="getTargetColumn" id="getTargetColumn"></a>
### `getTargetColumn()`

#### Signature

- It returns a `string` value.

<a name="getadditionalkeycolumns" id="getadditionalkeycolumns"></a>
<a name="getAdditionalKeyColumns" id="getAdditionalKeyColumns"></a>
### `getAdditionalKeyColumns()`

Since Matomo 5.13.0

Columns that must additionally match between the joined-from table and the joined table
to identify a row, given as column names present on both tables. Use this when the primary
join column is not unique on its own and needs a composite key (for example the site id).

#### Signature

- It returns a `string[]` value.

