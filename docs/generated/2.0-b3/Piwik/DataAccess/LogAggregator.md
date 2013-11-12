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

### Examples

** TODO **

Methods
-------

The class defines the following methods:

- [`queryVisitsByDimension()`](#queryvisitsbydimension) &mdash; Aggregates visit logs, optionally grouping by some dimension, and returns the aggregated data.
- [`queryEcommerceItems()`](#queryecommerceitems) &mdash; Aggregates ecommerce item data (everything stored in the **log_conversion_item** table) and returns a DB statement that can be used to iterate over the aggregated data.
- [`queryActionsByDimension()`](#queryactionsbydimension) &mdash; Aggregates action data (everything in the log_action table) and returns a DB statement that can be used to iterate over the aggregated data.

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
    - `$dimensions` (`array`) &mdash; SELECT fields (or just one field) that will be grouped by, eg, `'referrer_name'` or `array('referrer_name', 'referrer_keyword')`. The metrics retrieved from the query will be specific to combinations of these fields. So if `array('referrer_name', 'referrer_keyword')` is supplied, the query will select the visits for each referrer/keyword combination.
    - `$where` (`bool`|`string`) &mdash; Additional condition for the WHERE clause. Can be used to filter the set of visits that are considered for aggregation.
    - `$additionalSelects` (`array`) &mdash; Additional SELECT fields that are not included in the group by clause. These can be aggregate expressions, eg, `SUM(somecol)`.
    - `$metrics` (`bool`|`array`) &mdash; The set of metrics to calculate and return. If false, the query will select all of them. The following values can be used: - [Metrics::INDEX_NB_UNIQ_VISITORS](#) - [Metrics::INDEX_NB_VISITS](#) - [Metrics::INDEX_NB_ACTIONS](#) - [Metrics::INDEX_MAX_ACTIONS](#) - [Metrics::INDEX_SUM_VISIT_LENGTH](#) - [Metrics::INDEX_BOUNCE_COUNT](#) - [Metrics::INDEX_NB_VISITS_CONVERTED](#)
    - `$rankingQuery` (`bool`|[`RankingQuery`](../../Piwik/RankingQuery.md)) &mdash; A pre-configured ranking query instance that will be used to limit the result. If set, the return value is the array returned by [RankingQuery::execute()](#).
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
    - `$dimension` (`string`) &mdash; One or more **log_conversion_item** column to group aggregated data by. Eg, `'idaction_sku'` or `'idaction_sku, idaction_category'`.
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
    - `$dimensions` (`array`|`string`) &mdash; One or more SELECT fields that will be used to group the log_action rows by. This parameter determines which log_action rows will be aggregated together.
    - `$where` (`bool`|`string`) &mdash; Additional condition for the WHERE clause. Can be used to filter the set of visits that are considered for aggregation.
    - `$additionalSelects` (`array`) &mdash; Additional SELECT fields that are not included in the group by clause. These can be aggregate expressions, eg, `SUM(somecol)`.
    - `$metrics` (`bool`|`array`) &mdash; The set of metrics to calculate and return. If false, the query will select all of them. The following values can be used: - [Metrics::INDEX_NB_UNIQ_VISITORS](#) - [Metrics::INDEX_NB_VISITS](#) - [Metrics::INDEX_NB_ACTIONS](#)
    - `$rankingQuery` (`bool`|[`RankingQuery`](../../Piwik/RankingQuery.md)) &mdash; A pre-configured ranking query instance that will be used to limit the result. If set, the return value is the array returned by [RankingQuery::execute()](#).
    - `$joinLogActionOnColumn` (`bool`|`string`) &mdash; One or more columns from the **log_link_visit_action** table that log_action should be joined on. The table alias used for each join is `"log_action$i"` where `$i` is the index of the column in this array. If a string is used for this parameter, the table alias is not suffixed.
- _Returns:_ A Zend_Db_Statement if `$rankingQuery` isn't supplied, otherwise the result of [RankingQuery::execute()](#). Read [this](#queryEcommerceItems-result-set) to see what aggregate data is calculated by the query.
    - `mixed`

