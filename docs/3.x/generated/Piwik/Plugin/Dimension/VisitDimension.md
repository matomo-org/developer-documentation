<small>Piwik\Plugin\Dimension\</small>

VisitDimension
==============

Since Matomo 2.5.0

Defines a new visit dimension that records any visit related information during tracking.

You can record any visit information by implementing one of the following events: [onNewVisit()](/api-reference/Piwik/Plugin/Dimension/VisitDimension#onnewvisit),
[onExistingVisit()](/api-reference/Piwik/Plugin/Dimension/VisitDimension#onexistingvisit), [onConvertedVisit()](/api-reference/Piwik/Plugin/Dimension/VisitDimension#onconvertedvisit) or [onAnyGoalConversion()](/api-reference/Piwik/Plugin/Dimension/VisitDimension#onanygoalconversion). By defining a
[$columnName](/api-reference/Piwik/Plugin/Dimension/VisitDimension#$columnname) and [$columnType](/api-reference/Piwik/Plugin/Dimension/VisitDimension#$columntype) a new column will be created in the database (table `log_visit`)
automatically and the values you return in the previous mentioned events will be saved in this column.

You can create a new dimension using the console command `./console generate:dimension`.

Properties
----------

This abstract class defines the following properties:

- [`$columnName`](#$columnname) &mdash; This will be the name of the column in the database table if a $columnType is specified. Inherited from [`Dimension`](../../../Piwik/Columns/Dimension.md)
- [`$columnType`](#$columntype) &mdash; If a columnType is defined, we will create a column in the MySQL table having this type. Inherited from [`Dimension`](../../../Piwik/Columns/Dimension.md)
- [`$type`](#$type) &mdash; Defines what kind of data type this dimension holds. Inherited from [`Dimension`](../../../Piwik/Columns/Dimension.md)
- [`$namePlural`](#$nameplural) &mdash; Translation key for name plural Inherited from [`Dimension`](../../../Piwik/Columns/Dimension.md)
- [`$segmentName`](#$segmentname) &mdash; By defining a segment name a user will be able to filter their visitors by this column. Inherited from [`Dimension`](../../../Piwik/Columns/Dimension.md)
- [`$suggestedValuesCallback`](#$suggestedvaluescallback) &mdash; Sets a callback which will be executed when user will call for suggested values for segment. Inherited from [`Dimension`](../../../Piwik/Columns/Dimension.md)
- [`$acceptValues`](#$acceptvalues) &mdash; Here you should explain which values are accepted/useful for your segment, for example: "1, 2, 3, etc." or "comcast.net, proxad.net, etc.". Inherited from [`Dimension`](../../../Piwik/Columns/Dimension.md)
- [`$sqlSegment`](#$sqlsegment) &mdash; Defines to which column in the MySQL database the segment belongs (if one is conifugred). Inherited from [`Dimension`](../../../Piwik/Columns/Dimension.md)
- [`$sqlFilter`](#$sqlfilter) &mdash; Interesting when specifying a segment. Inherited from [`Dimension`](../../../Piwik/Columns/Dimension.md)
- [`$sqlFilterValue`](#$sqlfiltervalue) &mdash; Similar to [$sqlFilter](/api-reference/Piwik/Plugin/Dimension/VisitDimension#$sqlfilter) you can map a given segment value to another value. Inherited from [`Dimension`](../../../Piwik/Columns/Dimension.md)
- [`$allowAnonymous`](#$allowanonymous) &mdash; Defines whether this dimension (and segment based on this dimension) is available to anonymous users. Inherited from [`Dimension`](../../../Piwik/Columns/Dimension.md)
- [`$dbTableName`](#$dbtablename) &mdash; The name of the database table this dimension refers to Inherited from [`Dimension`](../../../Piwik/Columns/Dimension.md)
- [`$metricId`](#$metricid) &mdash; By default the metricId is automatically generated based on the dimensionId. Inherited from [`Dimension`](../../../Piwik/Columns/Dimension.md)

<a name="$columnname" id="$columnname"></a>
<a name="columnName" id="columnName"></a>
### `$columnName`

This will be the name of the column in the database table if a $columnType is specified.

#### Signature

- It is a `string` value.

<a name="$columntype" id="$columntype"></a>
<a name="columnType" id="columnType"></a>
### `$columnType`

If a columnType is defined, we will create a column in the MySQL table having this type. Please make sure
MySQL understands this type. Once you change the column type the Piwik platform will notify the user to
perform an update which can sometimes take a long time so be careful when choosing the correct column type.

#### Signature

- It is a `string` value.

<a name="$type" id="$type"></a>
<a name="type" id="type"></a>
### `$type`

Defines what kind of data type this dimension holds. By default the type is auto-detected based on
`$columnType` but sometimes it may be needed to correct this value. Depending on this type, a dimension will be
formatted differently for example.

#### Signature

- It is a `string` value.

<a name="$nameplural" id="$nameplural"></a>
<a name="namePlural" id="namePlural"></a>
### `$namePlural`

Translation key for name plural

#### Signature

- It is a `string` value.

<a name="$segmentname" id="$segmentname"></a>
<a name="segmentName" id="segmentName"></a>
### `$segmentName`

By defining a segment name a user will be able to filter their visitors by this column. If you do not want to
define a segment for this dimension, simply leave the name empty.

#### Signature

- Its type is not specified.


<a name="$suggestedvaluescallback" id="$suggestedvaluescallback"></a>
<a name="suggestedValuesCallback" id="suggestedValuesCallback"></a>
### `$suggestedValuesCallback`

Sets a callback which will be executed when user will call for suggested values for segment.

#### Signature

- It is a `callable` value.

<a name="$acceptvalues" id="$acceptvalues"></a>
<a name="acceptValues" id="acceptValues"></a>
### `$acceptValues`

Here you should explain which values are accepted/useful for your segment, for example:
"1, 2, 3, etc." or "comcast.net, proxad.net, etc.". If the value needs any special encoding you should mention
this as well. For example "Any URL including protocol. The URL must be URL encoded."

#### Signature

- It is a `string` value.

<a name="$sqlsegment" id="$sqlsegment"></a>
<a name="sqlSegment" id="sqlSegment"></a>
### `$sqlSegment`

Defines to which column in the MySQL database the segment belongs (if one is conifugred). Defaults to
`$this.dbTableName . '.'. $this.columnName` but you can customize it eg like `HOUR(log_visit.visit_last_action_time)`.

#### Signature

- Its type is not specified.


<a name="$sqlfilter" id="$sqlfilter"></a>
<a name="sqlFilter" id="sqlFilter"></a>
### `$sqlFilter`

Interesting when specifying a segment. Sometimes you want users to set segment values that differ from the way
they are actually stored. For instance if you want to allow to filter by any URL than you might have to resolve
this URL to an action id. Or a country name maybe has to be mapped to a 2 letter country code. You can do this by
specifing either a callable such as `array('Classname', 'methodName')` or by passing a closure.

There will be four values passed to the given closure or callable: `string $valueToMatch`, `string $segment`
(see setSegment()), `string $matchType` (eg SegmentExpression::MATCH_EQUAL or any other match constant
of this class) and `$segmentName`.

If the closure returns NULL, then Piwik assumes the segment sub-string will not match any visitor.

#### Signature

- It can be one of the following types:
    - `string`
    - [`Closure`](http://php.net/class.Closure)

<a name="$sqlfiltervalue" id="$sqlfiltervalue"></a>
<a name="sqlFilterValue" id="sqlFilterValue"></a>
### `$sqlFilterValue`

Similar to [$sqlFilter](/api-reference/Piwik/Plugin/Dimension/VisitDimension#$sqlfilter) you can map a given segment value to another value. For instance you could map
"new" to 0, 'returning' to 1 and any other value to '2'. You can either define a callable or a closure. There
will be only one value passed to the closure or callable which contains the value a user has set for this
segment.

#### Signature

- It can be one of the following types:
    - `string`
    - `array`

<a name="$allowanonymous" id="$allowanonymous"></a>
<a name="allowAnonymous" id="allowAnonymous"></a>
### `$allowAnonymous`

Defines whether this dimension (and segment based on this dimension) is available to anonymous users.

#### Signature

- It is a `bool` value.

<a name="$dbtablename" id="$dbtablename"></a>
<a name="dbTableName" id="dbTableName"></a>
### `$dbTableName`

The name of the database table this dimension refers to

#### Signature

- It is a `string` value.

<a name="$metricid" id="$metricid"></a>
<a name="metricId" id="metricId"></a>
### `$metricId`

By default the metricId is automatically generated based on the dimensionId. This might sometimes not be as
readable and quite long. If you want more expressive metric names like `nb_visits` compared to
`nb_corehomevisitid`, you can eg set a metricId `visit`.

#### Signature

- It is a `string` value.

Methods
-------

The abstract class defines the following methods:

- [`getDbColumnJoin()`](#getdbcolumnjoin) &mdash; To be implemented when a column references another column Inherited from [`Dimension`](../../../Piwik/Columns/Dimension.md)
- [`getDbDiscriminator()`](#getdbdiscriminator) Inherited from [`Dimension`](../../../Piwik/Columns/Dimension.md)
- [`getEnumColumnValues()`](#getenumcolumnvalues) &mdash; To be implemented when a column represents an enum. Inherited from [`Dimension`](../../../Piwik/Columns/Dimension.md)
- [`getMetricId()`](#getmetricid) &mdash; Get the metricId which is used to generate metric names based on this dimension. Inherited from [`Dimension`](../../../Piwik/Columns/Dimension.md)
- [`install()`](#install) &mdash; Installs the action dimension in case it is not installed yet.
- [`uninstall()`](#uninstall) &mdash; Uninstalls the dimension if a [$columnName](/api-reference/Piwik/Plugin/Dimension/VisitDimension#$columnname) and columnType is set.
- [`getCategoryId()`](#getcategoryid) &mdash; Returns the ID of the category (typically a translation key). Inherited from [`Dimension`](../../../Piwik/Columns/Dimension.md)
- [`getName()`](#getname) &mdash; Returns the translated name of this dimension which is typically in singular. Inherited from [`Dimension`](../../../Piwik/Columns/Dimension.md)
- [`getNamePlural()`](#getnameplural) &mdash; Returns a translated name in plural for this dimension. Inherited from [`Dimension`](../../../Piwik/Columns/Dimension.md)
- [`isAnonymousAllowed()`](#isanonymousallowed) &mdash; Defines whether an anonymous user is allowed to view this dimension Inherited from [`Dimension`](../../../Piwik/Columns/Dimension.md)
- [`setSqlSegment()`](#setsqlsegment) &mdash; Sets (overwrites) the SQL segment Inherited from [`Dimension`](../../../Piwik/Columns/Dimension.md)
- [`setType()`](#settype) &mdash; Sets (overwrites the dimension type) Inherited from [`Dimension`](../../../Piwik/Columns/Dimension.md)
- [`groupValue()`](#groupvalue) &mdash; A dimension should group values by using this method. Inherited from [`Dimension`](../../../Piwik/Columns/Dimension.md)
- [`formatValue()`](#formatvalue) &mdash; Formats the dimension value. Inherited from [`Dimension`](../../../Piwik/Columns/Dimension.md)
- [`configureMetrics()`](#configuremetrics) &mdash; Configures metrics for this dimension. Inherited from [`Dimension`](../../../Piwik/Columns/Dimension.md)
- [`addSegment()`](#addsegment) &mdash; Adds a new segment. Inherited from [`Dimension`](../../../Piwik/Columns/Dimension.md)
- [`getSegmentName()`](#getsegmentname) &mdash; Returns the name of the segment that this dimension defines Inherited from [`Dimension`](../../../Piwik/Columns/Dimension.md)
- [`getSqlSegment()`](#getsqlsegment) &mdash; Returns a sql segment expression for this dimension. Inherited from [`Dimension`](../../../Piwik/Columns/Dimension.md)
- [`getDbTableName()`](#getdbtablename) &mdash; Returns the name of the database table this dimension belongs to. Inherited from [`Dimension`](../../../Piwik/Columns/Dimension.md)
- [`getId()`](#getid) &mdash; Returns a unique string ID for this dimension. Inherited from [`Dimension`](../../../Piwik/Columns/Dimension.md)
- [`getAllDimensions()`](#getalldimensions) &mdash; Get all visit dimensions that are defined by all activated plugins.
- [`getDimensions()`](#getdimensions) Inherited from [`Dimension`](../../../Piwik/Columns/Dimension.md)
- [`factory()`](#factory) &mdash; Creates a Dimension instance from a string ID (see [getId()](/api-reference/Piwik/Plugin/Dimension/VisitDimension#getid)). Inherited from [`Dimension`](../../../Piwik/Columns/Dimension.md)
- [`getModule()`](#getmodule) &mdash; Returns the name of the plugin that contains this Dimension. Inherited from [`Dimension`](../../../Piwik/Columns/Dimension.md)
- [`getType()`](#gettype) &mdash; Returns the type of the dimension which defines what kind of value this dimension stores. Inherited from [`Dimension`](../../../Piwik/Columns/Dimension.md)
- [`getRequiredVisitFields()`](#getrequiredvisitfields) &mdash; Sometimes you may want to make sure another dimension is executed before your dimension so you can persist this dimensions' value depending on the value of other dimensions.
- [`onNewVisit()`](#onnewvisit) &mdash; The `onNewVisit` method is triggered when a new visitor is detected.
- [`onExistingVisit()`](#onexistingvisit) &mdash; The `onExistingVisit` method is triggered when a visitor was recognized meaning it is not a new visitor.
- [`onConvertedVisit()`](#onconvertedvisit) &mdash; This event is executed shortly after `onNewVisit` or `onExistingVisit` in case the visitor converted a goal.
- [`onAnyGoalConversion()`](#onanygoalconversion) &mdash; By implementing this event you can persist a value to the `log_conversion` table in case a conversion happens.
- [`shouldForceNewVisit()`](#shouldforcenewvisit) &mdash; This hook is executed by the tracker when determining if an action is the start of a new visit or part of an existing one.

<a name="getdbcolumnjoin" id="getdbcolumnjoin"></a>
<a name="getDbColumnJoin" id="getDbColumnJoin"></a>
### `getDbColumnJoin()`

To be implemented when a column references another column

#### Signature


- *Returns:*  [`Join`](../../../Piwik/Columns/Join.md)|`null` &mdash;
    

<a name="getdbdiscriminator" id="getdbdiscriminator"></a>
<a name="getDbDiscriminator" id="getDbDiscriminator"></a>
### `getDbDiscriminator()`

#### Signature


- *Returns:*  [`Discriminator`](../../../Piwik/Columns/Discriminator.md)|`null` &mdash;
    

<a name="getenumcolumnvalues" id="getenumcolumnvalues"></a>
<a name="getEnumColumnValues" id="getEnumColumnValues"></a>
### `getEnumColumnValues()`

To be implemented when a column represents an enum.

#### Signature

- It returns a `array` value.

<a name="getmetricid" id="getmetricid"></a>
<a name="getMetricId" id="getMetricId"></a>
### `getMetricId()`

Get the metricId which is used to generate metric names based on this dimension.

#### Signature

- It returns a `string` value.

<a name="install" id="install"></a>
<a name="install" id="install"></a>
### `install()`

Installs the action dimension in case it is not installed yet. The installation is already implemented based on
the [$columnName](/api-reference/Piwik/Plugin/Dimension/VisitDimension#$columnname) and [$columnType](/api-reference/Piwik/Plugin/Dimension/VisitDimension#$columntype). If you want to perform additional actions beside adding the
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


- *Returns:*  `array` &mdash;
    An array containing the table name as key and an array of MySQL alter table statements that should
              be executed on the given table. Example:
```
array(
'log_link_visit_action' => array("ADD COLUMN `$this->columnName` $this->columnType", "ADD INDEX ...")
);
```

<a name="uninstall" id="uninstall"></a>
<a name="uninstall" id="uninstall"></a>
### `uninstall()`

Uninstalls the dimension if a [$columnName](/api-reference/Piwik/Plugin/Dimension/VisitDimension#$columnname) and columnType is set. In case you perform any custom
actions during [install()](/api-reference/Piwik/Plugin/Dimension/VisitDimension#install) - for instance adding an index - you should make sure to undo those actions by
overwriting this method. Make sure to call this parent method to make sure the uninstallation of the column
will be done.

#### Signature

- It does not return anything or a mixed result.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

<a name="getcategoryid" id="getcategoryid"></a>
<a name="getCategoryId" id="getCategoryId"></a>
### `getCategoryId()`

Returns the ID of the category (typically a translation key).

#### Signature

- It returns a `string` value.

<a name="getname" id="getname"></a>
<a name="getName" id="getName"></a>
### `getName()`

Returns the translated name of this dimension which is typically in singular.

#### Signature

- It returns a `string` value.

<a name="getnameplural" id="getnameplural"></a>
<a name="getNamePlural" id="getNamePlural"></a>
### `getNamePlural()`

Returns a translated name in plural for this dimension.

#### Signature

- It returns a `string` value.

<a name="isanonymousallowed" id="isanonymousallowed"></a>
<a name="isAnonymousAllowed" id="isAnonymousAllowed"></a>
### `isAnonymousAllowed()`

Defines whether an anonymous user is allowed to view this dimension

#### Signature

- It returns a `bool` value.

<a name="setsqlsegment" id="setsqlsegment"></a>
<a name="setSqlSegment" id="setSqlSegment"></a>
### `setSqlSegment()`

Sets (overwrites) the SQL segment

#### Signature

-  It accepts the following parameter(s):
    - `$segment`
      
- It does not return anything or a mixed result.

<a name="settype" id="settype"></a>
<a name="setType" id="setType"></a>
### `setType()`

Sets (overwrites the dimension type)

#### Signature

-  It accepts the following parameter(s):
    - `$type`
      
- It does not return anything or a mixed result.

<a name="groupvalue" id="groupvalue"></a>
<a name="groupValue" id="groupValue"></a>
### `groupValue()`

A dimension should group values by using this method. Otherwise the same row may appear several times.

#### Signature

-  It accepts the following parameter(s):
    - `$value` (`mixed`) &mdash;
      
    - `$idSite` (`int`) &mdash;
      
- It returns a `mixed` value.

<a name="formatvalue" id="formatvalue"></a>
<a name="formatValue" id="formatValue"></a>
### `formatValue()`

Formats the dimension value. By default, the dimension is formatted based on the set dimension type.

#### Signature

-  It accepts the following parameter(s):
    - `$value` (`mixed`) &mdash;
      
    - `$idSite` (`int`) &mdash;
      
    - `$formatter` ([`Formatter`](../../../Piwik/Metrics/Formatter.md)) &mdash;
      
- It returns a `mixed` value.

<a name="configuremetrics" id="configuremetrics"></a>
<a name="configureMetrics" id="configureMetrics"></a>
### `configureMetrics()`

Configures metrics for this dimension.

For certain dimension types, some metrics will be added automatically.

#### Signature

-  It accepts the following parameter(s):
    - `$metricsList` ([`MetricsList`](../../../Piwik/Columns/MetricsList.md)) &mdash;
      
    - `$dimensionMetricFactory` ([`DimensionMetricFactory`](../../../Piwik/Columns/DimensionMetricFactory.md)) &mdash;
      
- It does not return anything or a mixed result.

<a name="addsegment" id="addsegment"></a>
<a name="addSegment" id="addSegment"></a>
### `addSegment()`

Adds a new segment. It automatically sets the SQL segment depending on the column name in case none is set
already.

#### See Also

- `\Piwik\Columns\Dimension::addSegment()`

#### Signature

-  It accepts the following parameter(s):
    - `$segment` ([`Segment`](../../../Piwik/Plugin/Segment.md)) &mdash;
      
- It does not return anything or a mixed result.

<a name="getsegmentname" id="getsegmentname"></a>
<a name="getSegmentName" id="getSegmentName"></a>
### `getSegmentName()`

Returns the name of the segment that this dimension defines

#### Signature

- It returns a `string` value.

<a name="getsqlsegment" id="getsqlsegment"></a>
<a name="getSqlSegment" id="getSqlSegment"></a>
### `getSqlSegment()`

Returns a sql segment expression for this dimension.

#### Signature

- It returns a `string` value.

<a name="getdbtablename" id="getdbtablename"></a>
<a name="getDbTableName" id="getDbTableName"></a>
### `getDbTableName()`

Returns the name of the database table this dimension belongs to.

#### Signature

- It returns a `string` value.

<a name="getid" id="getid"></a>
<a name="getId" id="getId"></a>
### `getId()`

Returns a unique string ID for this dimension. The ID is built using the namespaced class name
of the dimension, but is modified to be more human readable.

#### Signature


- *Returns:*  `string` &mdash;
    eg, `"Referrers.Keywords"`
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if the plugin and simple class name of this instance cannot be determined.
                  This would only happen if the dimension is located in the wrong directory.

<a name="getalldimensions" id="getalldimensions"></a>
<a name="getAllDimensions" id="getAllDimensions"></a>
### `getAllDimensions()`

Get all visit dimensions that are defined by all activated plugins.

#### Signature

- It returns a [`Dimension[]`](../../../Piwik/Columns/Dimension.md) value.

<a name="getdimensions" id="getdimensions"></a>
<a name="getDimensions" id="getDimensions"></a>
### `getDimensions()`

#### Signature

-  It accepts the following parameter(s):
    - `$plugin` ([`Plugin`](../../../Piwik/Plugin.md)) &mdash;
      
- It does not return anything or a mixed result.

<a name="factory" id="factory"></a>
<a name="factory" id="factory"></a>
### `factory()`

Creates a Dimension instance from a string ID (see [getId()](/api-reference/Piwik/Plugin/Dimension/VisitDimension#getid)).

#### Signature

-  It accepts the following parameter(s):
    - `$dimensionId` (`string`) &mdash;
       See [getId()](/api-reference/Piwik/Plugin/Dimension/VisitDimension#getid).

- *Returns:*  [`Dimension`](../../../Piwik/Columns/Dimension.md)|`null` &mdash;
    The created instance or null if there is no Dimension for
                       $dimensionId or if the plugin that contains the Dimension is
                       not loaded.

<a name="getmodule" id="getmodule"></a>
<a name="getModule" id="getModule"></a>
### `getModule()`

Returns the name of the plugin that contains this Dimension.

#### Signature

- It returns a `string` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if the Dimension is not located within a Plugin module.

<a name="gettype" id="gettype"></a>
<a name="getType" id="getType"></a>
### `getType()`

Returns the type of the dimension which defines what kind of value this dimension stores.

#### Signature

- It returns a `string` value.

<a name="getrequiredvisitfields" id="getrequiredvisitfields"></a>
<a name="getRequiredVisitFields" id="getRequiredVisitFields"></a>
### `getRequiredVisitFields()`

Sometimes you may want to make sure another dimension is executed before your dimension so you can persist
this dimensions' value depending on the value of other dimensions. You can do this by defining an array of
dimension names. If you access any value of any other column within your events, you should require them here.

Otherwise those values may not be available.

#### Signature

- It returns a `array` value.

<a name="onnewvisit" id="onnewvisit"></a>
<a name="onNewVisit" id="onNewVisit"></a>
### `onNewVisit()`

The `onNewVisit` method is triggered when a new visitor is detected. This means you can define an initial
value for this user here. By returning boolean `false` no value will be saved. Once the user makes another action
the event "onExistingVisit" is executed. Meaning for each visitor this method is executed once.

#### Signature

-  It accepts the following parameter(s):
    - `$request` (`Piwik\Tracker\Request`) &mdash;
      
    - `$visitor` (`Piwik\Tracker\Visitor`) &mdash;
      
    - `$action` (`Piwik\Tracker\Action`|`null`) &mdash;
      

- *Returns:*  `mixed`|`false` &mdash;
    

<a name="onexistingvisit" id="onexistingvisit"></a>
<a name="onExistingVisit" id="onExistingVisit"></a>
### `onExistingVisit()`

The `onExistingVisit` method is triggered when a visitor was recognized meaning it is not a new visitor.

You can overwrite any previous value set by the event `onNewVisit` by implemting this event. By returning boolean
`false` no value will be updated.

#### Signature

-  It accepts the following parameter(s):
    - `$request` (`Piwik\Tracker\Request`) &mdash;
      
    - `$visitor` (`Piwik\Tracker\Visitor`) &mdash;
      
    - `$action` (`Piwik\Tracker\Action`|`null`) &mdash;
      

- *Returns:*  `mixed`|`false` &mdash;
    

<a name="onconvertedvisit" id="onconvertedvisit"></a>
<a name="onConvertedVisit" id="onConvertedVisit"></a>
### `onConvertedVisit()`

This event is executed shortly after `onNewVisit` or `onExistingVisit` in case the visitor converted a goal.

Usually this event is not needed and you can simply remove this method therefore. An example would be for
instance to persist the last converted action url. Return boolean `false` if you do not want to change the
current value.

#### Signature

-  It accepts the following parameter(s):
    - `$request` (`Piwik\Tracker\Request`) &mdash;
      
    - `$visitor` (`Piwik\Tracker\Visitor`) &mdash;
      
    - `$action` (`Piwik\Tracker\Action`|`null`) &mdash;
      

- *Returns:*  `mixed`|`false` &mdash;
    

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
    - `$request` (`Piwik\Tracker\Request`) &mdash;
      
    - `$visitor` (`Piwik\Tracker\Visitor`) &mdash;
      
    - `$action` (`Piwik\Tracker\Action`|`null`) &mdash;
      

- *Returns:*  `mixed`|`false` &mdash;
    

<a name="shouldforcenewvisit" id="shouldforcenewvisit"></a>
<a name="shouldForceNewVisit" id="shouldForceNewVisit"></a>
### `shouldForceNewVisit()`

This hook is executed by the tracker when determining if an action is the start of a new visit
or part of an existing one. Derived classes can use it to force new visits based on dimension
data.

For example, the Campaign dimension in the Referrers plugin will force a new visit if the
campaign information for the current action is different from the last.

#### Signature

-  It accepts the following parameter(s):
    - `$request` (`Piwik\Tracker\Request`) &mdash;
       The current tracker request information.
    - `$visitor` (`Piwik\Tracker\Visitor`) &mdash;
       The information for the currently recognized visitor.
    - `$action` (`Piwik\Tracker\Action`) &mdash;
       The current action information (if any).

- *Returns:*  `bool` &mdash;
    Return true to force a visit, false if otherwise.

