<small>Piwik\Plugin\Dimension\</small>

VisitDimension
==============

Since Piwik 2.5.0

Defines a new visit dimension that records any visit related information during tracking.

You can record any visit information by implementing one of the following events: [onNewVisit()](/api-reference/Piwik/Plugin/Dimension/VisitDimension#onnewvisit),
[onExistingVisit()](/api-reference/Piwik/Plugin/Dimension/VisitDimension#onexistingvisit), [onConvertedVisit()](/api-reference/Piwik/Plugin/Dimension/VisitDimension#onconvertedvisit) or [onAnyGoalConversion()](/api-reference/Piwik/Plugin/Dimension/VisitDimension#onanygoalconversion). By defining a
[$columnName](/api-reference/Piwik/Plugin/Dimension/VisitDimension#$columnname) and [$columnType](/api-reference/Piwik/Plugin/Dimension/VisitDimension#$columntype) a new column will be created in the database (table `log_visit`)
automatically and the values you return in the previous mentioned events will be saved in this column.

You can create a new dimension using the console command `./console generate:dimension`.

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
- [`getName()`](#getname) &mdash; Get the translated name of the dimension. *inherited from* [`Dimension`](../../../Piwik/Columns/Dimension.md)
- [`getAllDimensions()`](#getalldimensions) &mdash; Get all visit dimensions that are defined by all activated plugins.
- [`install()`](#install) &mdash; Installs the visit dimension in case it is not installed yet.
- [`uninstall()`](#uninstall) &mdash; Uninstalls the dimension if a [$columnName](/api-reference/Piwik/Plugin/Dimension/VisitDimension#$columnname) and columnType is set.
- [`getRequiredVisitFields()`](#getrequiredvisitfields) &mdash; Sometimes you may want to make sure another dimension is executed before your dimension so you can persist this dimensions' value depending on the value of other dimensions.
- [`onNewVisit()`](#onnewvisit) &mdash; The `onNewVisit` method is triggered when a new visitor is detected.
- [`onExistingVisit()`](#onexistingvisit) &mdash; The `onExistingVisit` method is triggered when a visitor was recognized meaning it is not a new visitor.
- [`onConvertedVisit()`](#onconvertedvisit) &mdash; This event is executed shortly after `onNewVisit` or `onExistingVisit` in case the visitor converted a goal.
- [`onAnyGoalConversion()`](#onanygoalconversion) &mdash; By implementing this event you can persist a value to the `log_conversion` table in case a conversion happens.

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

<a name="getalldimensions" id="getalldimensions"></a>
<a name="getAllDimensions" id="getAllDimensions"></a>
### `getAllDimensions()`

Get all visit dimensions that are defined by all activated plugins.

#### Signature

- It returns a [`VisitDimension[]`](../../../Piwik/Plugin/Dimension/VisitDimension.md) value.

<a name="install" id="install"></a>
<a name="install" id="install"></a>
### `install()`

Installs the visit dimension in case it is not installed yet.

The installation is already implemented based on
the [$columnName](/api-reference/Piwik/Plugin/Dimension/VisitDimension#$columnname) and [$columnType](/api-reference/Piwik/Plugin/Dimension/VisitDimension#$columntype). If you want to perform additional actions beside adding the
column to the database - for instance adding an index - you can overwrite this method. We recommend to call
this parent method to get the minimum required actions and then add further custom actions since this makes sure
the column will be installed correctly. We also recommend to change the default install behavior only if really
needed. FYI: We do not directly execute those alter table statements here as we group them together with several
other alter table statements do execute those changes in one step which results in a faster installation. The
column will be added to the `log_visit` MySQL table.

Example:
```
   public function install()
   {
       $changes = parent::install();
       $changes['log_visit'][] = "ADD INDEX index_idsite_servertime ( idsite, server_time )";

       return $changes;
   }
   ```

#### Signature


<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`array`) &mdash;
    <div markdown="1" class="param-desc">An array containing the table name as key and an array of MySQL alter table statements that should be executed on the given table. Example: ``` array( 'log_visit' => array("ADD COLUMN `$this->columnName` $this->columnType", "ADD INDEX ...") ); ```</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="uninstall" id="uninstall"></a>
<a name="uninstall" id="uninstall"></a>
### `uninstall()`

Uninstalls the dimension if a [$columnName](/api-reference/Piwik/Plugin/Dimension/VisitDimension#$columnname) and columnType is set.

In case you perform any custom
actions during [install()](/api-reference/Piwik/Plugin/Dimension/VisitDimension#install) - for instance adding an index - you should make sure to undo those actions by
overwriting this method. Make sure to call this parent method to make sure the uninstallation of the column
will be done.

#### Signature

- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

<a name="getrequiredvisitfields" id="getrequiredvisitfields"></a>
<a name="getRequiredVisitFields" id="getRequiredVisitFields"></a>
### `getRequiredVisitFields()`

Sometimes you may want to make sure another dimension is executed before your dimension so you can persist this dimensions' value depending on the value of other dimensions.

You can do this by defining an array of
dimension names. If you access any value of any other column within your events, you should require them here.
Otherwise those values may not be available.

#### Signature

- It returns a `array` value.

<a name="onnewvisit" id="onnewvisit"></a>
<a name="onNewVisit" id="onNewVisit"></a>
### `onNewVisit()`

The `onNewVisit` method is triggered when a new visitor is detected.

This means you can define an initial
value for this user here. By returning boolean `false` no value will be saved. Once the user makes another action
the event "onExistingVisit" is executed. Meaning for each visitor this method is executed once.

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
      `$action` (`Piwik\Tracker\Action`|`null`) &mdash;

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

<a name="onexistingvisit" id="onexistingvisit"></a>
<a name="onExistingVisit" id="onExistingVisit"></a>
### `onExistingVisit()`

The `onExistingVisit` method is triggered when a visitor was recognized meaning it is not a new visitor.

You can overwrite any previous value set by the event `onNewVisit` by implemting this event. By returning boolean
`false` no value will be updated.

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
      `$action` (`Piwik\Tracker\Action`|`null`) &mdash;

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

<a name="onconvertedvisit" id="onconvertedvisit"></a>
<a name="onConvertedVisit" id="onConvertedVisit"></a>
### `onConvertedVisit()`

This event is executed shortly after `onNewVisit` or `onExistingVisit` in case the visitor converted a goal.

Usually this event is not needed and you can simply remove this method therefore. An example would be for
instance to persist the last converted action url. Return boolean `false` if you do not want to change the
current value.

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
      `$action` (`Piwik\Tracker\Action`|`null`) &mdash;

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

<a name="onanygoalconversion" id="onanygoalconversion"></a>
<a name="onAnyGoalConversion" id="onAnyGoalConversion"></a>
### `onAnyGoalConversion()`

By implementing this event you can persist a value to the `log_conversion` table in case a conversion happens.

The persisted value will be logged along the conversion and will not be changed afterwards. This allows you to
generate reports that shows for instance which url was called how often for a specific conversion. Once you
implement this event and a $columnType is defined a column in the `log_conversion` MySQL table will be
created automatically.

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
      `$action` (`Piwik\Tracker\Action`|`null`) &mdash;

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

