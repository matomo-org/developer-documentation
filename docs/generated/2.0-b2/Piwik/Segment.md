<small>Piwik</small>

Segment
=======

Limits the set of visits Piwik uses when aggregating analytics data.

Description
-----------

A segment is a condition used to filter visits. They can, for example,
select visits that have a specific browser or come from a specific
country, or both.

Individual segment parameters (such as `browserCode` and `countryCode`)
are defined by individual plugins. Read about the [API.getSegmentsMetadata](#)
event to learn more.

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

**Creating a 'null' segment**

    $idSites = array(1,2,3);
    $segment = new Segment('', $idSites);
    // $segment->getSelectQuery will return a query that selects all visits


Constants
---------

This class defines the following constants:

- [`SEGMENT_TRUNCATE_LIMIT`](#SEGMENT_TRUNCATE_LIMIT) &mdash; Truncate the Segments to 8k

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`isEmpty()`](#isEmpty) &mdash; Returns true if the segment is empty, false if otherwise.
- [`getString()`](#getString) &mdash; Returns the segment condition.
- [`getHash()`](#getHash) &mdash; Returns a hash of the segment condition, or the empty string if the segment condition is empty.
- [`getSelectQuery()`](#getSelectQuery) &mdash; Extend an SQL query that aggregates data over one of the 'log_' tables with segment expressions.

<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

- It accepts the following parameter(s):
    - `$segmentCondition`
    - `$idSites`
- It does not return anything.

<a name="isempty" id="isempty"></a>
### `isEmpty()`

Returns true if the segment is empty, false if otherwise.

#### Signature

- It does not return anything.

<a name="getstring" id="getstring"></a>
### `getString()`

Returns the segment condition.

#### Signature

- It returns a(n) `string` value.

<a name="gethash" id="gethash"></a>
### `getHash()`

Returns a hash of the segment condition, or the empty string if the segment condition is empty.

#### Signature

- It returns a(n) `string` value.

<a name="getselectquery" id="getselectquery"></a>
### `getSelectQuery()`

Extend an SQL query that aggregates data over one of the 'log_' tables with segment expressions.

#### Signature

- It accepts the following parameter(s):
    - `$select`
    - `$from`
    - `$where`
    - `$bind`
    - `$orderBy`
    - `$groupBy`
- _Returns:_ The entire select query.
    - `string`

