<small>Piwik\Columns\</small>

Discriminator
=============

Since Matomo 3.1.0

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Join constructor.
- [`isValid()`](#isvalid)
- [`getTable()`](#gettable)
- [`getColumn()`](#getcolumn)
- [`getValue()`](#getvalue)

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Join constructor.

#### Signature

-  It accepts the following parameter(s):
    - `$table` (`string`) &mdash;
       unprefixed table name
    - `$discriminatorColumn` (`null`|`string`) &mdash;
      
    - `$discriminatorValue` (`null`|`int`) &mdash;
       should be only hard coded, safe values.
- It throws one of the following exceptions:
    - `Piwik\Columns\Exception`

<a name="isvalid" id="isvalid"></a>
<a name="isValid" id="isValid"></a>
### `isValid()`

#### Signature

- It does not return anything or a mixed result.

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

<a name="getvalue" id="getvalue"></a>
<a name="getValue" id="getValue"></a>
### `getValue()`

#### Signature


- *Returns:*  `int`|`null` &mdash;
    

