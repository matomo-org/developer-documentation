<small>Piwik\Columns\</small>

Dimension
=========

Since Piwik 2.5.0

Properties
----------

This abstract class defines the following properties:

- [`$columnName`](#$columnname) &mdash; This will be the name of the column in the database table if a $columnType is specified.
- [`$columnType`](#$columntype) &mdash; If a columnType is defined, we will create a column in the MySQL table having this type.

<a name="$columnname" id="$columnname"></a>
<a name="columnName" id="columnName"></a>
### `$columnName`

This will be the name of the column in the database table if a $columnType is specified.

#### Signature

- It is a `string` value.

<a name="$columntype" id="$columntype"></a>
<a name="columnType" id="columnType"></a>
### `$columnType`

If a columnType is defined, we will create a column in the MySQL table having this type.

Please make sure
MySQL understands this type. Once you change the column type the Piwik platform will notify the user to
perform an update which can sometimes take a long time so be careful when choosing the correct column type.

#### Signature

- It is a `string` value.

Methods
-------

The abstract class defines the following methods:

- [`addSegment()`](#addsegment) &mdash; Adds a new segment.
- [`getName()`](#getname) &mdash; Get the translated name of the dimension.
- [`getId()`](#getid) &mdash; Returns a unique string ID for this dimension.
- [`getAllDimensions()`](#getalldimensions) &mdash; Gets an instance of all available visit, action and conversion dimension.
- [`getDimensions()`](#getdimensions)
- [`factory()`](#factory) &mdash; Creates a Dimension instance from a string ID (see [getId()](/api-reference/Piwik/Columns/Dimension#getid)).
- [`getModule()`](#getmodule) &mdash; Returns the name of the plugin that contains this Dimension.

<a name="addsegment" id="addsegment"></a>
<a name="addSegment" id="addSegment"></a>
### `addSegment()`

Adds a new segment.

The segment type will be set to 'dimension' automatically if not already set.

#### Signature

-  It accepts the following parameter(s):
    - `$segment` ([`Segment`](../../Piwik/Plugin/Segment.md)) &mdash;
      
- It does not return anything.

<a name="getname" id="getname"></a>
<a name="getName" id="getName"></a>
### `getName()`

Get the translated name of the dimension.

Defaults to an empty string.

#### Signature

- It returns a `string` value.

<a name="getid" id="getid"></a>
<a name="getId" id="getId"></a>
### `getId()`

Returns a unique string ID for this dimension.

The ID is built using the namespaced class name
of the dimension, but is modified to be more human readable

#### Signature


- *Returns:*  `string` &mdash;
    eg, `"Referrers.Keywords"`
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if the plugin and simple class name of this instance cannot be determined. This would only happen if the dimension is located in the wrong directory.

<a name="getalldimensions" id="getalldimensions"></a>
<a name="getAllDimensions" id="getAllDimensions"></a>
### `getAllDimensions()`

Gets an instance of all available visit, action and conversion dimension.

#### Signature

- It returns a [`Dimension[]`](../../Piwik/Columns/Dimension.md) value.

<a name="getdimensions" id="getdimensions"></a>
<a name="getDimensions" id="getDimensions"></a>
### `getDimensions()`

#### Signature

-  It accepts the following parameter(s):
    - `$plugin` ([`Plugin`](../../Piwik/Plugin.md)) &mdash;
      
- It does not return anything.

<a name="factory" id="factory"></a>
<a name="factory" id="factory"></a>
### `factory()`

Creates a Dimension instance from a string ID (see [getId()](/api-reference/Piwik/Columns/Dimension#getid)).

#### Signature

-  It accepts the following parameter(s):
    - `$dimensionId` (`string`) &mdash;
       See [getId()](/api-reference/Piwik/Columns/Dimension#getid).

- *Returns:*  [`Dimension`](../../Piwik/Columns/Dimension.md)|`null` &mdash;
    The created instance or null if there is no Dimension for $dimensionId or if the plugin that contains the Dimension is not loaded.

<a name="getmodule" id="getmodule"></a>
<a name="getModule" id="getModule"></a>
### `getModule()`

Returns the name of the plugin that contains this Dimension.

#### Signature

- It returns a `string` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if the Dimension is not located within a Plugin module.

