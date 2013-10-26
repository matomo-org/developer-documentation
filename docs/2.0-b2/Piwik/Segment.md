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
    $segmentStr = &quot;browserCode==ff;countryCode==CA&quot;;
    $segment = new Segment($segmentStr, $idSites);

    $query = $segment-&gt;getSelectQuery(
        $select = &quot;table.col1, table2.col2&quot;,
        $from = array(&quot;table&quot;, &quot;table2&quot;),
        $where = &quot;table.col3 = ?&quot;,
        $bind = array(5),
        $orderBy = &quot;table.col1 DESC&quot;,
        $groupBy = &quot;table2.col2&quot;
    );
    
    Db::fetchAll($query[&#039;sql&#039;], $query[&#039;bind&#039;]);

**Creating a &#039;null&#039; segment**

    $idSites = array(1,2,3);
    $segment = new Segment(&#039;&#039;, $idSites);
    // $segment-&gt;getSelectQuery will return a query that selects all visits


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
- [`getSelectQuery()`](#getSelectQuery) &mdash; Extend an SQL query that aggregates data over one of the &#039;log_&#039; tables with segment expressions.

### `__construct()` <a name="__construct"></a>

Constructor.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$segmentCondition`
    - `$idSites`
- It does not return anything.

### `isEmpty()` <a name="isEmpty"></a>

Returns true if the segment is empty, false if otherwise.

#### Signature

- It is a **public** method.
- It does not return anything.

### `getString()` <a name="getString"></a>

Returns the segment condition.

#### Signature

- It is a **public** method.
- It returns a(n) `string` value.

### `getHash()` <a name="getHash"></a>

Returns a hash of the segment condition, or the empty string if the segment condition is empty.

#### Signature

- It is a **public** method.
- It returns a(n) `string` value.

### `getSelectQuery()` <a name="getSelectQuery"></a>

Extend an SQL query that aggregates data over one of the &#039;log_&#039; tables with segment expressions.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$select`
    - `$from`
    - `$where`
    - `$bind`
    - `$orderBy`
    - `$groupBy`
- _Returns:_ The entire select query.
    - `string`

