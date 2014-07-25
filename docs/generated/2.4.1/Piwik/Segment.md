<small>Piwik\</small>

Segment
=======

Limits the set of visits Piwik uses when aggregating analytics data.

A segment is a condition used to filter visits. They can, for example,
select visits that have a specific browser or come from a specific
country, or both.

Individual segment dimensions (such as `browserCode` and `countryCode`)
are defined by plugins. Read about the [API.getSegmentDimensionMetadata](/api-reference/events#apigetsegmentdimensionmetadata)
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

**Creating a _null_ segment**

    $idSites = array(1,2,3);
    $segment = new Segment('', $idSites);
    // $segment->getSelectQuery will return a query that selects all visits

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`isEmpty()`](#isempty) &mdash; Returns `true` if the segment is empty, `false` if otherwise.
- [`getString()`](#getstring) &mdash; Returns the segment condition.
- [`getHash()`](#gethash) &mdash; Returns a hash of the segment condition, or the empty string if the segment condition is empty.
- [`getSelectQuery()`](#getselectquery) &mdash; Extend an SQL query that aggregates data over one of the 'log_' tables with segment expressions.

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct() `
Constructor.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$segmentCondition` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The segment condition, eg, `'browserCode=ff;countryCode=CA'`.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$idSites` (`array`) &mdash;

      <div markdown="1" class="param-desc"> The list of sites the segment will be used with. Some segments are dependent on the site, such as goal segments.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<a name="isempty" id="isempty"></a>
<a name="isEmpty" id="isEmpty"></a>
### `isEmpty() `
Returns `true` if the segment is empty, `false` if otherwise.

#### Signature

- It does not return anything.

<a name="getstring" id="getstring"></a>
<a name="getString" id="getString"></a>
### `getString() `
Returns the segment condition.

#### Signature

- It returns a `string` value.

<a name="gethash" id="gethash"></a>
<a name="getHash" id="getHash"></a>
### `getHash() `
Returns a hash of the segment condition, or the empty string if the segment condition is empty.

#### Signature

- It returns a `string` value.

<a name="getselectquery" id="getselectquery"></a>
<a name="getSelectQuery" id="getSelectQuery"></a>
### `getSelectQuery() `
Extend an SQL query that aggregates data over one of the 'log_' tables with segment expressions.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$select` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The select clause. Should NOT include the **SELECT** just the columns, eg, `'t1.col1 as col1, t2.col2 as col2'`.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$from` (`array`) &mdash;

      <div markdown="1" class="param-desc"> Array of table names (without prefix), eg, `array('log_visit', 'log_conversion')`.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$where` (`Piwik\false`|`string`) &mdash;

      <div markdown="1" class="param-desc"> (optional) Where clause, eg, `'t1.col1 = ? AND t2.col2 = ?'`.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$bind` (`array`|`string`) &mdash;

      <div markdown="1" class="param-desc"> (optional) Bind parameters, eg, `array($col1Value, $col2Value)`.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$orderBy` (`Piwik\false`|`string`) &mdash;

      <div markdown="1" class="param-desc"> (optional) Order by clause, eg, `"t1.col1 ASC"`.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$groupBy` (`Piwik\false`|`string`) &mdash;

      <div markdown="1" class="param-desc"> (optional) Group by clause, eg, `"t2.col2"`.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`string`) &mdash;
    <div markdown="1" class="param-desc">The entire select query.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

