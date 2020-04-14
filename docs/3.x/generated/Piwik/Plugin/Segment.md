<small>Piwik\Plugin\</small>

Segment
=======

Since Piwik 2.5.0

Creates a new segment that can be used for instance within the \Piwik\Columns\Dimension::configureSegment() method.

Make sure to set at least the following values: [setName()](/api-reference/Piwik/Plugin/Segment#setname), [setSegment()](/api-reference/Piwik/Plugin/Segment#setsegment),
[setSqlSegment()](/api-reference/Piwik/Plugin/Segment#setsqlsegment), [setType()](/api-reference/Piwik/Plugin/Segment#settype) and [setCategory()](/api-reference/Piwik/Plugin/Segment#setcategory). If you are using a segment in the context of a
dimension the type and the SQL segment is usually set for you automatically.

Example:
```
$segment = new \Piwik\Plugin\Segment();
$segment->setType(\Piwik\Plugin\Segment::TYPE_DIMENSION);
$segment->setName('General_EntryKeyword');
$segment->setCategory('General_Visit');
$segment->setSegment('entryKeyword');
$segment->setSqlSegment('log_visit.entry_keyword');
$segment->setAcceptedValues('Any keywords people search for on your website such as "help" or "imprint"');
```

Constants
---------

This class defines the following constants:

- [`TYPE_DIMENSION`](#type_dimension) — Segment type 'dimension'.- [`TYPE_METRIC`](#type_metric) — Segment type 'metric'.
<a name="type_dimension" id="type_dimension"></a>
<a name="TYPE_DIMENSION" id="TYPE_DIMENSION"></a>
### `TYPE_DIMENSION`

Can be used along with [setType()](/api-reference/Piwik/Plugin/Segment#settype).
<a name="type_metric" id="type_metric"></a>
<a name="TYPE_METRIC" id="TYPE_METRIC"></a>
### `TYPE_METRIC`

Can be used along with [setType()](/api-reference/Piwik/Plugin/Segment#settype).

Methods
-------

The class defines the following methods:

- [`init()`](#init) &mdash; Here you can initialize this segment and set any default values.
- [`setAcceptedValues()`](#setacceptedvalues) &mdash; Here you should explain which values are accepted/useful for your segment, for example: "1, 2, 3, etc." or "comcast.net, proxad.net, etc.".
- [`setCategory()`](#setcategory) &mdash; Set (overwrite) the category this segment belongs to.
- [`setName()`](#setname) &mdash; Set (overwrite) the segment display name.
- [`setSegment()`](#setsegment) &mdash; Set (overwrite) the name of the segment.
- [`setSqlFilter()`](#setsqlfilter) &mdash; Sometimes you want users to set values that differ from the way they are actually stored.
- [`setSqlFilterValue()`](#setsqlfiltervalue) &mdash; Similar to [setSqlFilter()](/api-reference/Piwik/Plugin/Segment#setsqlfilter) you can map a given segment value to another value.
- [`setSqlSegment()`](#setsqlsegment) &mdash; Defines to which column in the MySQL database the segment belongs: 'mytablename.mycolumnname'.
- [`setUnionOfSegments()`](#setunionofsegments) &mdash; Set a list of segments that should be used instead of fetching the values from a single column.
- [`setType()`](#settype) &mdash; Set (overwrite) the type of this segment which is usually either a 'dimension' or a 'metric'.
- [`getSegment()`](#getsegment) &mdash; Returns the name of this segment as it should appear in segment expressions.
- [`setSuggestedValuesCallback()`](#setsuggestedvaluescallback) &mdash; Set callback which will be executed when user will call for suggested values for segment.
- [`setSuggestedValuesApi()`](#setsuggestedvaluesapi) &mdash; Set callback which will be executed when user will call for suggested values for segment.
- [`setPermission()`](#setpermission) &mdash; You can restrict the access to this segment by passing a boolean `false`.
- [`setIsInternal()`](#setisinternal) &mdash; Sets whether the segment is for internal use only and should not be visible in the UI or in API metadata output.
- [`isInternal()`](#isinternal) &mdash; Gets whether the segment is for internal use only and should not be visible in the UI or in API metadata output.

<a name="init" id="init"></a>
<a name="init" id="init"></a>
### `init()`

Here you can initialize this segment and set any default values.

It is called directly after the object is
created.

#### Signature

- It does not return anything.

<a name="setacceptedvalues" id="setacceptedvalues"></a>
<a name="setAcceptedValues" id="setAcceptedValues"></a>
### `setAcceptedValues()`

Here you should explain which values are accepted/useful for your segment, for example: "1, 2, 3, etc." or "comcast.net, proxad.net, etc.".

If the value needs any special encoding you should mention
this as well. For example "Any URL including protocol. The URL must be URL encoded."

#### Signature

-  It accepts the following parameter(s):
    - `$acceptedValues` (`string`) &mdash;
      
- It does not return anything.

<a name="setcategory" id="setcategory"></a>
<a name="setCategory" id="setCategory"></a>
### `setCategory()`

Set (overwrite) the category this segment belongs to.

It should be a translation key such as 'General_Actions'
or 'General_Visit'.

#### Signature

-  It accepts the following parameter(s):
    - `$category` (`string`) &mdash;
      
- It does not return anything.

<a name="setname" id="setname"></a>
<a name="setName" id="setName"></a>
### `setName()`

Set (overwrite) the segment display name.

This name will be visible in the API and the UI. It should be a
translation key such as 'Actions_ColumnEntryPageTitle' or 'Resolution_ColumnResolution'.

#### Signature

-  It accepts the following parameter(s):
    - `$name` (`string`) &mdash;
      
- It does not return anything.

<a name="setsegment" id="setsegment"></a>
<a name="setSegment" id="setSegment"></a>
### `setSegment()`

Set (overwrite) the name of the segment.

The name should be lower case first and has to be unique. The segment
name defined here needs to be set in the URL to actually apply this segment. Eg if the segment is 'searches'
you need to set "&segment=searches>0" in the UI.

#### Signature

-  It accepts the following parameter(s):
    - `$segment` (`string`) &mdash;
      
- It does not return anything.

<a name="setsqlfilter" id="setsqlfilter"></a>
<a name="setSqlFilter" id="setSqlFilter"></a>
### `setSqlFilter()`

Sometimes you want users to set values that differ from the way they are actually stored.

For instance if you
want to allow to filter by any URL than you might have to resolve this URL to an action id. Or a country name
maybe has to be mapped to a 2 letter country code. You can do this by specifing either a callable such as
`array('Classname', 'methodName')` or by passing a closure. There will be four values passed to the given closure
or callable: `string $valueToMatch`, `string $segment` (see [setSegment()](/api-reference/Piwik/Plugin/Segment#setsegment)), `string $matchType`
(eg SegmentExpression::MATCH_EQUAL or any other match constant of this class) and `$segmentName`.

If the closure returns NULL, then Piwik assumes the segment sub-string will not match any visitor.

#### Signature

-  It accepts the following parameter(s):
    - `$sqlFilter` (`string`|[`Closure`](http://php.net/class.Closure)) &mdash;
      
- It does not return anything.

<a name="setsqlfiltervalue" id="setsqlfiltervalue"></a>
<a name="setSqlFilterValue" id="setSqlFilterValue"></a>
### `setSqlFilterValue()`

Similar to [setSqlFilter()](/api-reference/Piwik/Plugin/Segment#setsqlfilter) you can map a given segment value to another value.

For instance you could map
"new" to 0, 'returning' to 1 and any other value to '2'. You can either define a callable or a closure. There
will be only one value passed to the closure or callable which contains the value a user has set for this
segment. This callback is called shortly before [setSqlFilter()](/api-reference/Piwik/Plugin/Segment#setsqlfilter).

#### Signature

-  It accepts the following parameter(s):
    - `$sqlFilterValue` (`string`|`array`) &mdash;
      
- It does not return anything.

<a name="setsqlsegment" id="setsqlsegment"></a>
<a name="setSqlSegment" id="setSqlSegment"></a>
### `setSqlSegment()`

Defines to which column in the MySQL database the segment belongs: 'mytablename.mycolumnname'.

Eg
'log_visit.idsite'. When a segment is applied the given or filtered value will be compared with this column.

#### Signature

-  It accepts the following parameter(s):
    - `$sqlSegment` (`string`) &mdash;
      
- It does not return anything.

<a name="setunionofsegments" id="setunionofsegments"></a>
<a name="setUnionOfSegments" id="setUnionOfSegments"></a>
### `setUnionOfSegments()`

Set a list of segments that should be used instead of fetching the values from a single column.

All set segments will be applied via an OR operator.

#### Signature

-  It accepts the following parameter(s):
    - `$segments` (`array`) &mdash;
      
- It does not return anything.

<a name="settype" id="settype"></a>
<a name="setType" id="setType"></a>
### `setType()`

Set (overwrite) the type of this segment which is usually either a 'dimension' or a 'metric'.

#### Signature

-  It accepts the following parameter(s):
    - `$type` (`string`) &mdash;
       See constansts TYPE_*
- It does not return anything.

<a name="getsegment" id="getsegment"></a>
<a name="getSegment" id="getSegment"></a>
### `getSegment()`

Returns the name of this segment as it should appear in segment expressions.

#### Signature

- It returns a `string` value.

<a name="setsuggestedvaluescallback" id="setsuggestedvaluescallback"></a>
<a name="setSuggestedValuesCallback" id="setSuggestedValuesCallback"></a>
### `setSuggestedValuesCallback()`

Set callback which will be executed when user will call for suggested values for segment.

#### Signature

-  It accepts the following parameter(s):
    - `$suggestedValuesCallback` (`callable`) &mdash;
      
- It does not return anything.

<a name="setsuggestedvaluesapi" id="setsuggestedvaluesapi"></a>
<a name="setSuggestedValuesApi" id="setSuggestedValuesApi"></a>
### `setSuggestedValuesApi()`

Set callback which will be executed when user will call for suggested values for segment.

#### Signature

-  It accepts the following parameter(s):
    - `$suggestedValuesApi` (`string`) &mdash;
      
- It does not return anything.

<a name="setpermission" id="setpermission"></a>
<a name="setPermission" id="setPermission"></a>
### `setPermission()`

You can restrict the access to this segment by passing a boolean `false`.

For instance if you want to make
a certain segment only available to users having super user access you could do the following:
`$segment->setPermission(Piwik::hasUserSuperUserAccess());`

#### Signature

-  It accepts the following parameter(s):
    - `$permission` (`bool`) &mdash;
      
- It does not return anything.

<a name="setisinternal" id="setisinternal"></a>
<a name="setIsInternal" id="setIsInternal"></a>
### `setIsInternal()`

Sets whether the segment is for internal use only and should not be visible in the UI or in API metadata output.

These types of segments are, for example, used in unions for other segments, but have no value to users.

#### Signature

-  It accepts the following parameter(s):
    - `$value` (`bool`) &mdash;
      
- It does not return anything.

<a name="isinternal" id="isinternal"></a>
<a name="isInternal" id="isInternal"></a>
### `isInternal()`

Gets whether the segment is for internal use only and should not be visible in the UI or in API metadata output.

These types of segments are, for example, used in unions for other segments, but have no value to users.

#### Signature

- It returns a `bool` value.

