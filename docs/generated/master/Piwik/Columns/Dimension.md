<small>Piwik\Columns\</small>

Dimension
=========

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

<a name="addsegment" id="addsegment"></a>
<a name="addSegment" id="addSegment"></a>
### `addSegment()`

Adds a new segment.

The segment type will be set to 'dimension' automatically if not already set.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$segment` ([`Segment`](../../Piwik/Plugin/Segment.md)) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="getname" id="getname"></a>
<a name="getName" id="getName"></a>
### `getName()`

Get the translated name of the dimension.

Defaults to an empty string.

#### Signature

- It returns a `string` value.

