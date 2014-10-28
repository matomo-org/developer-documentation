<small>Piwik\Plugin\Dimension\</small>

ActionDimension
===============

Since Piwik 2.5.0

Defines a new action dimension that records any information during tracking for each action.

You can record any action information by implementing one of the following events: [onLookupAction()](/api-reference/Piwik/Plugin/Dimension/ActionDimension#onlookupaction) and
[getActionId()](/api-reference/Piwik/Plugin/Dimension/ActionDimension#getactionid) or [onNewAction()](/api-reference/Piwik/Plugin/Dimension/ActionDimension#onnewaction). By defining a [$columnName](/api-reference/Piwik/Plugin/Dimension/ActionDimension#$columnname) and [$columnType](/api-reference/Piwik/Plugin/Dimension/ActionDimension#$columntype) a new
column will be created in the database (table `log_link_visit_action`) automatically and the values you return in
the previous mentioned events will be saved in this column.

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
- [`factory()`](#factory) &mdash; Creates a Dimension instance from a string ID (see [getId()](/api-reference/Piwik/Plugin/Dimension/ActionDimension#getid)). Inherited from [`Dimension`](../../../Piwik/Columns/Dimension.md)
- [`getModule()`](#getmodule) &mdash; Returns the name of the plugin that contains this Dimension. Inherited from [`Dimension`](../../../Piwik/Columns/Dimension.md)
- [`install()`](#install) &mdash; Installs the action dimension in case it is not installed yet.
- [`uninstall()`](#uninstall) &mdash; Uninstalls the dimension if a [$columnName](/api-reference/Piwik/Plugin/Dimension/ActionDimension#$columnname) and columnType is set.
- [`onLookupAction()`](#onlookupaction) &mdash; If the value you want to save for your dimension is something like a page title or page url, you usually do not want to save the raw value over and over again to save bytes in the database.
- [`getActionId()`](#getactionid) &mdash; An action id.
- [`onNewAction()`](#onnewaction) &mdash; This event is triggered before a new action is logged to the `log_link_visit_action` table.

<a name="addsegment" id="addsegment"></a>
<a name="addSegment" id="addSegment"></a>
### `addSegment()`

Adds a new segment.

It automatically sets the SQL segment depending on the column name in case none is set
already.

#### See Also

- `\Piwik\Columns\Dimension::addSegment()`

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$segment` ([`Segment`](../../../Piwik/Plugin/Segment.md)) &mdash;

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

<a name="getid" id="getid"></a>
<a name="getId" id="getId"></a>
### `getId()`

Returns a unique string ID for this dimension.

The ID is built using the namespaced class name
of the dimension, but is modified to be more human readable

#### Signature


<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`string`) &mdash;
    <div markdown="1" class="param-desc">eg, `"Referrers.Keywords"`</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>
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

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$plugin` ([`Plugin`](../../../Piwik/Plugin.md)) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="factory" id="factory"></a>
<a name="factory" id="factory"></a>
### `factory()`

Creates a Dimension instance from a string ID (see [getId()](/api-reference/Piwik/Plugin/Dimension/ActionDimension#getid)).

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$dimensionId` (`string`) &mdash;

      <div markdown="1" class="param-desc"> See [getId()](/api-reference/Piwik/Plugin/Dimension/ActionDimension#getid).</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  ([`Dimension`](../../../Piwik/Columns/Dimension.md)|`null`) &mdash;
    <div markdown="1" class="param-desc">The created instance or null if there is no Dimension for $dimensionId or if the plugin that contains the Dimension is not loaded.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

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

Installs the action dimension in case it is not installed yet.

The installation is already implemented based on
the [$columnName](/api-reference/Piwik/Plugin/Dimension/ActionDimension#$columnname) and [$columnType](/api-reference/Piwik/Plugin/Dimension/ActionDimension#$columntype). If you want to perform additional actions beside adding the
column to the database - for instance adding an index - you can overwrite this method. We recommend to call
this parent method to get the minimum required actions and then add further custom actions since this makes sure
the column will be installed correctly. We also recommend to change the default install behavior only if really
needed. FYI: We do not directly execute those alter table statements here as we group them together with several
other alter table statements do execute those changes in one step which results in a faster installation. The
column will be added to the `log_link_visit_action` MySQL table.

Example:
```
   public function install()
   {
       $changes = parent::install();
       $changes['log_link_visit_action'][] = "ADD INDEX index_idsite_servertime ( idsite, server_time )";

       return $changes;
   }
   ```

#### Signature


<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`array`) &mdash;
    <div markdown="1" class="param-desc">An array containing the table name as key and an array of MySQL alter table statements that should be executed on the given table. Example: ``` array( 'log_link_visit_action' => array("ADD COLUMN `$this->columnName` $this->columnType", "ADD INDEX ...") ); ```</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="uninstall" id="uninstall"></a>
<a name="uninstall" id="uninstall"></a>
### `uninstall()`

Uninstalls the dimension if a [$columnName](/api-reference/Piwik/Plugin/Dimension/ActionDimension#$columnname) and columnType is set.

In case you perform any custom
actions during [install()](/api-reference/Piwik/Plugin/Dimension/ActionDimension#install) - for instance adding an index - you should make sure to undo those actions by
overwriting this method. Make sure to call this parent method to make sure the uninstallation of the column
will be done.

#### Signature

- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

<a name="onlookupaction" id="onlookupaction"></a>
<a name="onLookupAction" id="onLookupAction"></a>
### `onLookupAction()`

If the value you want to save for your dimension is something like a page title or page url, you usually do not want to save the raw value over and over again to save bytes in the database.

Instead you want to save each value
once in the log_action table and refer to this value by its ID in the log_link_visit_action table. You can do
this by returning an action id in "getActionId()" and by returning a value here. If a value should be ignored
or not persisted just return boolean false. Please note if you return a value here and you implement the event
"onNewAction" the value will be probably overwritten by the other event. So make sure to implement only one of
those.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$request` (`Piwik\Tracker\Request`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$action` (`Piwik\Tracker\Action`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`Piwik\Plugin\Dimension\false`|`mixed`) &mdash;
    <div markdown="1" class="param-desc"></div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="getactionid" id="getactionid"></a>
<a name="getActionId" id="getActionId"></a>
### `getActionId()`

An action id.

The value returned by the lookup action will be associated with this id in the log_action table.

#### Signature

- It returns a `int` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; in case not implemented

<a name="onnewaction" id="onnewaction"></a>
<a name="onNewAction" id="onNewAction"></a>
### `onNewAction()`

This event is triggered before a new action is logged to the `log_link_visit_action` table.

It overwrites any
looked up action so it makes usually no sense to implement both methods but it sometimes does. You can assign
any value to the column or return boolan false in case you do not want to save any value.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$request` (`Piwik\Tracker\Request`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$visitor` (`Piwik\Tracker\Visitor`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$action` (`Piwik\Tracker\Action`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`mixed`|`Piwik\Plugin\Dimension\false`) &mdash;
    <div markdown="1" class="param-desc"></div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

