<small>Piwik\</small>

Segment
=======

Limits the set of visits Piwik uses when aggregating analytics data.

A segment is a condition used to filter visits. They can, for example,
select visits that have a specific browser or come from a specific
country, or both.

Plugins that aggregate data stored in Piwik can support segments by
using this class when generating aggregation SQL queries.

### Examples

**Basic usage**

    $idSites = array(1,2,3);
    $segmentStr = "browserCode==ff;countryCode==CA";
    $segment = new Segment($segmentStr, $idSites);

    $query = $segment->getSelectQuery(
        $select = "table.col1, table2.col2",
        $from = array("table", "table2"),
        $where = "table.col3 = ?",
        $bind = array(5),
        $orderBy = "table.col1 DESC",
        $groupBy = "table2.col2"
    );

    Db::fetchAll($query['sql'], $query['bind']);

**Creating a _null_ segment**

    $idSites = array(1,2,3);
    $segment = new Segment('', $idSites);
    // $segment->getSelectQuery will return a query that selects all visits

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`getSegmentExpression()`](#getsegmentexpression) &mdash; Returns the segment expression.
- [`isEmpty()`](#isempty) &mdash; Returns `true` if the segment is empty, `false` if otherwise.
- [`willBeArchived()`](#willbearchived) &mdash; Detects whether the Piwik instance is configured to be able to archive this segment.
- [`getString()`](#getstring) &mdash; Returns the segment condition.
- [`getHash()`](#gethash) &mdash; Returns a hash of the segment condition, or the empty string if the segment condition is empty.
- [`getSegmentHash()`](#getsegmenthash)
- [`getSelectQuery()`](#getselectquery) &mdash; Extend an SQL query that aggregates data over one of the 'log_' tables with segment expressions.
- [`__toString()`](#__tostring) &mdash; Returns the segment string.
- [`combine()`](#combine) &mdash; Combines this segment with another segment condition, if the segment condition is not already in the segment.

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

-  It accepts the following parameter(s):
    - `$segmentCondition` (`string`) &mdash;
       The segment condition, eg, `'browserCode=ff;countryCode=CA'`.
    - `$idSites` (`array`) &mdash;
       The list of sites the segment will be used with. Some segments are dependent on the site, such as goal segments.

<a name="getsegmentexpression" id="getsegmentexpression"></a>
<a name="getSegmentExpression" id="getSegmentExpression"></a>
### `getSegmentExpression()`

Returns the segment expression.

#### Signature

- It does not return anything.

<a name="isempty" id="isempty"></a>
<a name="isEmpty" id="isEmpty"></a>
### `isEmpty()`

Returns `true` if the segment is empty, `false` if otherwise.

#### Signature

- It does not return anything.

<a name="willbearchived" id="willbearchived"></a>
<a name="willBeArchived" id="willBeArchived"></a>
### `willBeArchived()`

Detects whether the Piwik instance is configured to be able to archive this segment.

It checks whether the segment
will be either archived via browser or cli archiving. It does not check if the segment has been archived. If you
want to know whether the segment has been archived, the actual report data needs to be requested.

This method does not take any date/period into consideration. Meaning a Piwik instance might be able to archive
this segment in general, but not for a certain period if eg the archiving of range dates is disabled.

#### Signature

- It returns a `bool` value.

<a name="getstring" id="getstring"></a>
<a name="getString" id="getString"></a>
### `getString()`

Returns the segment condition.

#### Signature

- It returns a `string` value.

<a name="gethash" id="gethash"></a>
<a name="getHash" id="getHash"></a>
### `getHash()`

Returns a hash of the segment condition, or the empty string if the segment condition is empty.

#### Signature

- It returns a `string` value.

<a name="getsegmenthash" id="getsegmenthash"></a>
<a name="getSegmentHash" id="getSegmentHash"></a>
### `getSegmentHash()`

#### Signature

-  It accepts the following parameter(s):
    - `$definition`
      
- It does not return anything.

<a name="getselectquery" id="getselectquery"></a>
<a name="getSelectQuery" id="getSelectQuery"></a>
### `getSelectQuery()`

Extend an SQL query that aggregates data over one of the 'log_' tables with segment expressions.

#### Signature

-  It accepts the following parameter(s):
    - `$select`
      
    - `$from`
      
    - `$where`
      
    - `$bind`
      
    - `$orderBy`
      
    - `$groupBy`
      
    - `$limit`
      
    - `$offset`
      

- *Returns:*  `string` &mdash;
    The entire select query.

<a name="__tostring" id="__tostring"></a>
<a name="__toString" id="__toString"></a>
### `__toString()`

Returns the segment string.

#### Signature

- It returns a `string` value.

<a name="combine" id="combine"></a>
<a name="combine" id="combine"></a>
### `combine()`

Combines this segment with another segment condition, if the segment condition is not already in the segment.

The combination is naive in that it does not take order of operations into account.

#### Signature

-  It accepts the following parameter(s):
    - `$segment` (`string`) &mdash;
      
    - `$operator` (`string`) &mdash;
       The operator to use. Should be either SegmentExpression::AND_DELIMITER or SegmentExpression::OR_DELIMITER.
    - `$segmentCondition` (`string`) &mdash;
       The segment condition to add.
- It returns a `string` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception)

