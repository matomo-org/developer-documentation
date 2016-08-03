<small>Piwik\Plugin\Dimension\</small>

ConversionDimension
===================

Since Piwik 2.5.0

Defines a new conversion dimension that records any visit related information during tracking.

You can record any visit information by implementing one of the following events:
[onEcommerceOrderConversion()](/api-reference/Piwik/Plugin/Dimension/ConversionDimension#onecommerceorderconversion), [onEcommerceCartUpdateConversion()](/api-reference/Piwik/Plugin/Dimension/ConversionDimension#onecommercecartupdateconversion) or [onGoalConversion()](/api-reference/Piwik/Plugin/Dimension/ConversionDimension#ongoalconversion).
By defining a [$columnName](/api-reference/Piwik/Plugin/Dimension/ConversionDimension#$columnname) and [$columnType](/api-reference/Piwik/Plugin/Dimension/ConversionDimension#$columntype) a new column will be created in the database
(table `log_conversion`) automatically and the values you return in the previous mentioned events will be saved in
this column.

You can create a new dimension using the console command `./console generate:dimension`.

Properties
----------

This abstract class defines the following properties:

- [`$columnName`](#$columnname) &mdash; This will be the name of the column in the database table if a $columnType is specified. Inherited from [`Dimension`](../../../Piwik/Columns/Dimension.md)
- [`$columnType`](#$columntype) &mdash; If a columnType is defined, we will create a column in the MySQL table having this type. Inherited from [`Dimension`](../../../Piwik/Columns/Dimension.md)

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
- [`getName()`](#getname) &mdash; Get the translated name of the dimension. Inherited from [`Dimension`](../../../Piwik/Columns/Dimension.md)
- [`getId()`](#getid) &mdash; Returns a unique string ID for this dimension. Inherited from [`Dimension`](../../../Piwik/Columns/Dimension.md)
- [`getAllDimensions()`](#getalldimensions) &mdash; Gets an instance of all available visit, action and conversion dimension. Inherited from [`Dimension`](../../../Piwik/Columns/Dimension.md)
- [`getDimensions()`](#getdimensions) Inherited from [`Dimension`](../../../Piwik/Columns/Dimension.md)
- [`factory()`](#factory) &mdash; Creates a Dimension instance from a string ID (see [getId()](/api-reference/Piwik/Plugin/Dimension/ConversionDimension#getid)). Inherited from [`Dimension`](../../../Piwik/Columns/Dimension.md)
- [`getModule()`](#getmodule) &mdash; Returns the name of the plugin that contains this Dimension. Inherited from [`Dimension`](../../../Piwik/Columns/Dimension.md)
- [`install()`](#install) &mdash; Installs the conversion dimension in case it is not installed yet.
- [`uninstall()`](#uninstall) &mdash; Uninstalls the dimension if a [$columnName](/api-reference/Piwik/Plugin/Dimension/ConversionDimension#$columnname) and columnType is set.
- [`onEcommerceOrderConversion()`](#onecommerceorderconversion) &mdash; This event is triggered when an ecommerce order is converted.
- [`onEcommerceCartUpdateConversion()`](#onecommercecartupdateconversion) &mdash; This event is triggered when an ecommerce cart update is converted.
- [`onGoalConversion()`](#ongoalconversion) &mdash; This event is triggered when an any custom goal is converted.

<a name="addsegment" id="addsegment"></a>
<a name="addSegment" id="addSegment"></a>
### `addSegment()`

Adds a new segment.

The segment type will be set to 'dimension' automatically if not already set.

#### See Also

- `\Piwik\Columns\Dimension::addSegment()`

#### Signature

-  It accepts the following parameter(s):
    - `$segment` ([`Segment`](../../../Piwik/Plugin/Segment.md)) &mdash;
      
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
of the dimension, but is modified to be more human readable.

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

- It returns a [`Dimension[]`](../../../Piwik/Columns/Dimension.md) value.

<a name="getdimensions" id="getdimensions"></a>
<a name="getDimensions" id="getDimensions"></a>
### `getDimensions()`

#### Signature

-  It accepts the following parameter(s):
    - `$plugin` ([`Plugin`](../../../Piwik/Plugin.md)) &mdash;
      
- It does not return anything.

<a name="factory" id="factory"></a>
<a name="factory" id="factory"></a>
### `factory()`

Creates a Dimension instance from a string ID (see [getId()](/api-reference/Piwik/Plugin/Dimension/ConversionDimension#getid)).

#### Signature

-  It accepts the following parameter(s):
    - `$dimensionId` (`string`) &mdash;
       See [getId()](/api-reference/Piwik/Plugin/Dimension/ConversionDimension#getid).

- *Returns:*  [`Dimension`](../../../Piwik/Columns/Dimension.md)|`null` &mdash;
    The created instance or null if there is no Dimension for $dimensionId or if the plugin that contains the Dimension is not loaded.

<a name="getmodule" id="getmodule"></a>
<a name="getModule" id="getModule"></a>
### `getModule()`

Returns the name of the plugin that contains this Dimension.

#### Signature

- It returns a `string` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if the Dimension is not located within a Plugin module.

<a name="install" id="install"></a>
<a name="install" id="install"></a>
### `install()`

Installs the conversion dimension in case it is not installed yet.

The installation is already implemented based
on the [$columnName](/api-reference/Piwik/Plugin/Dimension/ConversionDimension#$columnname) and [$columnType](/api-reference/Piwik/Plugin/Dimension/ConversionDimension#$columntype). If you want to perform additional actions beside adding the
column to the database - for instance adding an index - you can overwrite this method. We recommend to call
this parent method to get the minimum required actions and then add further custom actions since this makes sure
the column will be installed correctly. We also recommend to change the default install behavior only if really
needed. FYI: We do not directly execute those alter table statements here as we group them together with several
other alter table statements do execute those changes in one step which results in a faster installation. The
column will be added to the `log_conversion` MySQL table.

Example:
```
   public function install()
   {
   $changes = parent::install();
   $changes['log_conversion'][] = "ADD INDEX index_idsite_servertime ( idsite, server_time )";

   return $changes;
   }
   ```

#### Signature


- *Returns:*  `array` &mdash;
    An array containing the table name as key and an array of MySQL alter table statements that should be executed on the given table. Example: ``` array( 'log_conversion' => array("ADD COLUMN `$this->columnName` $this->columnType", "ADD INDEX ...") ); ```

<a name="uninstall" id="uninstall"></a>
<a name="uninstall" id="uninstall"></a>
### `uninstall()`

Uninstalls the dimension if a [$columnName](/api-reference/Piwik/Plugin/Dimension/ConversionDimension#$columnname) and columnType is set.

In case you perform any custom
actions during [install()](/api-reference/Piwik/Plugin/Dimension/ConversionDimension#install) - for instance adding an index - you should make sure to undo those actions by
overwriting this method. Make sure to call this parent method to make sure the uninstallation of the column
will be done.

#### Signature

- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

<a name="onecommerceorderconversion" id="onecommerceorderconversion"></a>
<a name="onEcommerceOrderConversion" id="onEcommerceOrderConversion"></a>
### `onEcommerceOrderConversion()`

This event is triggered when an ecommerce order is converted.

Any returned value will be persist in the database.
Return boolean `false` if you do not want to change the value in some cases.

#### Signature

-  It accepts the following parameter(s):
    - `$request` (`Piwik\Tracker\Request`) &mdash;
      
    - `$visitor` (`Piwik\Tracker\Visitor`) &mdash;
      
    - `$action` (`Piwik\Tracker\Action`|`null`) &mdash;
      
    - `$goalManager` (`Piwik\Tracker\GoalManager`) &mdash;
      

- *Returns:*  `mixed`|`Piwik\Plugin\Dimension\false` &mdash;
    

<a name="onecommercecartupdateconversion" id="onecommercecartupdateconversion"></a>
<a name="onEcommerceCartUpdateConversion" id="onEcommerceCartUpdateConversion"></a>
### `onEcommerceCartUpdateConversion()`

This event is triggered when an ecommerce cart update is converted.

Any returned value will be persist in the
database. Return boolean `false` if you do not want to change the value in some cases.

#### Signature

-  It accepts the following parameter(s):
    - `$request` (`Piwik\Tracker\Request`) &mdash;
      
    - `$visitor` (`Piwik\Tracker\Visitor`) &mdash;
      
    - `$action` (`Piwik\Tracker\Action`|`null`) &mdash;
      
    - `$goalManager` (`Piwik\Tracker\GoalManager`) &mdash;
      

- *Returns:*  `mixed`|`Piwik\Plugin\Dimension\false` &mdash;
    

<a name="ongoalconversion" id="ongoalconversion"></a>
<a name="onGoalConversion" id="onGoalConversion"></a>
### `onGoalConversion()`

This event is triggered when an any custom goal is converted.

Any returned value will be persist in the
database. Return boolean `false` if you do not want to change the value in some cases.

#### Signature

-  It accepts the following parameter(s):
    - `$request` (`Piwik\Tracker\Request`) &mdash;
      
    - `$visitor` (`Piwik\Tracker\Visitor`) &mdash;
      
    - `$action` (`Piwik\Tracker\Action`|`null`) &mdash;
      
    - `$goalManager` (`Piwik\Tracker\GoalManager`) &mdash;
      

- *Returns:*  `mixed`|`Piwik\Plugin\Dimension\false` &mdash;
    

