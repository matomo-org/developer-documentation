<small>Piwik\DataAccess</small>

LogAggregator
=============

Contains methods that aggregates log data (visits, actions, conversions, ecommerce).

Description
-----------

Plugin [Archiver](#) descendants can use the methods in this class to aggregate data
in the log tables without creating their own SQL queries.

### Aggregation Principles

** TODO (explain 'dimension') **

### Aggregation Functions

** TODO (describe how to use functions)

### Examples

**Aggregating visit data**

    // TODO

**Aggregating conversion data**

    // TODO


Constants
---------

This class defines the following constants:

- `LOG_VISIT_TABLE`
- `LOG_ACTIONS_TABLE`
- `LOG_CONVERSION_TABLE`
- `REVENUE_SUBTOTAL_FIELD`
- `REVENUE_TAX_FIELD`
- `REVENUE_SHIPPING_FIELD`
- `REVENUE_DISCOUNT_FIELD`
- `TOTAL_REVENUE_FIELD`
- `ITEMS_COUNT_FIELD`
- `CONVERSION_DATETIME_FIELD`
- `ACTION_DATETIME_FIELD`
- `VISIT_DATETIME_FIELD`
- `IDGOAL_FIELD`
- `FIELDS_SEPARATOR`

Methods
-------

The class defines the following methods:

- [`queryVisitsByDimension()`](#queryvisitsbydimension) &mdash; Aggregates visit logs, optionally grouping by some dimension, and returns the aggregated data.
- [`queryEcommerceItems()`](#queryecommerceitems) &mdash; Aggregates ecommerce item data (everything stored in the **log_conversion_item** table) and returns a DB statement that can be used to iterate over the aggregated data.
- [`queryActionsByDimension()`](#queryactionsbydimension) &mdash; Aggregates action data (everything in the log_action table) and returns a DB statement that can be used to iterate over the aggregated data.
- [`getSelectsFromRangedColumn()`](#getselectsfromrangedcolumn) &mdash; Creates and returns an array of SQL SELECT expressions that will count the number of rows for which a specific column falls within specific ranges.

<a name="queryvisitsbydimension" id="queryvisitsbydimension"></a>
<a name="queryVisitsByDimension" id="queryVisitsByDimension"></a>
### `queryVisitsByDimension()`

Aggregates visit logs, optionally grouping by some dimension, and returns the aggregated data.

#### Description

<a name="queryVisitsByDimension-result-set"/>
**Result Set**

The following columns are in each row of the result set:

- **[Metrics::INDEX_NB_UNIQ_VISITORS](#)**: The total number of unique visitors in this group
                                            of aggregated visits.
- **[Metrics::INDEX_NB_VISITS](#)**: The total number of visits aggregated.
- **[Metrics::INDEX_NB_ACTIONS](#)**: The total number of actions performed in this group of
                                      aggregated visits.
- **[Metrics::INDEX_MAX_ACTIONS](#)**: The maximum actions perfomred in one visit for this group of
                                       visits.
- **[Metrics::INDEX_SUM_VISIT_LENGTH](#)**: The total amount of time spent on the site for this
                                            group of visits.
- **[Metrics::INDEX_BOUNCE_COUNT](#)**: The total number of bounced visits in this group of
                                        visits.
- **[Metrics::INDEX_NB_VISITS_CONVERTED](#)**: The total number of visits for which at least one
                                               conversion occurred, for this group of visits.

Additional data can be selected by setting the `$additionalSelects` parameter.

_Note: The metrics returned by this query can be customized by the `$metrics` parameter._

#### Signature

- It accepts the following parameter(s):
    - `$dimensions` (`array`)
    - `$where`
    - `$additionalSelects` (`array`)
    - `$metrics`
    - `$rankingQuery`
- _Returns:_ A Zend_Db_Statement if `$rankingQuery` isn't supplied, otherwise the result of [RankingQuery::execute()](#). Read [this](#queryVisitsByDimension-result-set) to see what aggregate data is calculated by the query.
    - `mixed`

<a name="queryecommerceitems" id="queryecommerceitems"></a>
<a name="queryEcommerceItems" id="queryEcommerceItems"></a>
### `queryEcommerceItems()`

Aggregates ecommerce item data (everything stored in the **log_conversion_item** table) and returns a DB statement that can be used to iterate over the aggregated data.

#### Description

<a name="queryEcommerceItems-result-set"/>
**Result Set**

The following columns are in each row of the result set:

- **[Metrics::INDEX_ECOMMERCE_ITEM_REVENUE](#)**: The total revenue for the group of items
                                                  this row aggregated.
- **[Metrics::INDEX_ECOMMERCE_ITEM_QUANTITY](#)**: The total number of items of the group
                                                   this row aggregated.
- **[Metrics::INDEX_ECOMMERCE_ITEM_PRICE](#)**: The total price for the group of items this
                                                row aggregated.
- **[Metrics::INDEX_ECOMMERCE_ORDERS](#)**: The total number of orders this group of items
                                            belongs to. This will be <= to the total number
                                            of items in this group.
- **[Metrics::INDEX_NB_VISITS](#)**: The total number of visits during which each item in
                                     this group of items was logged.
- **ecommerceType**: Either [GoalManager::IDGOAL_CART](#) if the items in this group were
                     abandoned by a visitor, or [GoalManager::IDGOAL_ORDER](#) if they
                     were ordered by a visitor.

**Limitations**

Segmentation is not yet supported in this aggregation method.

#### Signature

- It accepts the following parameter(s):
    - `$dimension`
- _Returns:_ A statement object that can be used to iterate through the query's result set. See [above](#queryEcommerceItems-result-set) to learn more about what this query selects.
    - `Piwik\DataAccess\Zend_Db_Statement`

<a name="queryactionsbydimension" id="queryactionsbydimension"></a>
<a name="queryActionsByDimension" id="queryActionsByDimension"></a>
### `queryActionsByDimension()`

Aggregates action data (everything in the log_action table) and returns a DB statement that can be used to iterate over the aggregated data.

#### Description

<a name="queryActionsByDimension-result-set"/>
**Result Set**

Each row of the result set represents an aggregated group of actions. The following columns
are in each aggregate row:

- **[Metrics::INDEX_NB_UNIQ_VISITORS](#)**: The total number of unique visitors that performed
                                            the actions in this group.
- **[Metrics::INDEX_NB_VISITS](#)**: The total number of visits these actions belong to.
- **[Metrics::INDEX_NB_ACTIONS](#)**: The total number of actions in this aggregate group.

Additional data can be selected through the `$additionalSelects` parameter.

_Note: The metrics returned by this query can be customized by the `$metrics` parameter._

#### Signature

- It accepts the following parameter(s):
    - `$dimensions`
    - `$where`
    - `$additionalSelects`
    - `$metrics`
    - `$rankingQuery`
    - `$joinLogActionOnColumn`
- _Returns:_ A Zend_Db_Statement if `$rankingQuery` isn't supplied, otherwise the result of [RankingQuery::execute()](#). Read [this](#queryEcommerceItems-result-set) to see what aggregate data is calculated by the query.
    - `mixed`

<a name="getselectsfromrangedcolumn" id="getselectsfromrangedcolumn"></a>
<a name="getSelectsFromRangedColumn" id="getSelectsFromRangedColumn"></a>
### `getSelectsFromRangedColumn()`

Creates and returns an array of SQL SELECT expressions that will count the number of rows for which a specific column falls within specific ranges.

#### Description

The SELECT expressions will count the number of column values that are
within each range.

**Note:** The result of this function is meant for use in the `$additionalSelects` parameter
in one of the query... methods (for example [queryVisitsByDimension](#queryVisitsByDimension)).

**Example**

    // summarize one column
    $visitTotalActionsRanges = array(
        array(1, 1),
        array(2, 10),
        array(10)
    );
    $selects = LogAggregator::getSelectsFromRangedColumn('visit_total_actions', $visitTotalActionsRanges, 'log_visit', 'vta');

    // summarize another column in the same request
    $visitCountVisitsRanges = array(
        array(1, 1),
        array(2, 20),
        array(20)
    );
    $selects = array_merge(
        $selects,
        LogAggregator::getSelectsFromRangedColumn('visitor_count_visits', $visitCountVisitsRanges, 'log_visit', 'vcv')
    );

    // perform query
    $logAggregator = // get the LogAggregator somehow
    $query = $logAggregator->queryVisitsByDimension($dimensions = array(), $where = false, $selects);
    $tableSummary = $query->fetch();
    
    $numberOfVisitsWithOneAction = $tableSummary['vta0'];

#### Signature

- It accepts the following parameter(s):
    - `$column`
    - `$ranges`
    - `$table`
    - `$selectColumnPrefix`
    - `$restrictToReturningVisitors`
- _Returns:_ An array of SQL SELECT expressions, for example, ``` array( 'sum(case when log_visit.visit_total_actions between 0 and 2 then 1 else 0 end) as vta0', 'sum(case when log_visit.visit_total_actions > 2 then 1 else 0 end) as vta1' ) ```
    - `array`

