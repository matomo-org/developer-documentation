<small>Piwik\DataAccess</small>

LogAggregator
=============

Contains methods that aggregates log data (visits, actions, conversions, ecommerce).

Description
-----------

Plugin [Archiver](#) descendants can use the methods in this class to aggregate data
in the log tables without creating their own SQL queries.

### Aggregation Principles

** TODO (explain &#039;dimension&#039;) **

### Examples

** TODO **


Constants
---------

This class defines the following constants:

- [`LOG_VISIT_TABLE`](#LOG_VISIT_TABLE)
- [`LOG_ACTIONS_TABLE`](#LOG_ACTIONS_TABLE)
- [`LOG_CONVERSION_TABLE`](#LOG_CONVERSION_TABLE)
- [`REVENUE_SUBTOTAL_FIELD`](#REVENUE_SUBTOTAL_FIELD)
- [`REVENUE_TAX_FIELD`](#REVENUE_TAX_FIELD)
- [`REVENUE_SHIPPING_FIELD`](#REVENUE_SHIPPING_FIELD)
- [`REVENUE_DISCOUNT_FIELD`](#REVENUE_DISCOUNT_FIELD)
- [`TOTAL_REVENUE_FIELD`](#TOTAL_REVENUE_FIELD)
- [`ITEMS_COUNT_FIELD`](#ITEMS_COUNT_FIELD)
- [`CONVERSION_DATETIME_FIELD`](#CONVERSION_DATETIME_FIELD)
- [`ACTION_DATETIME_FIELD`](#ACTION_DATETIME_FIELD)
- [`VISIT_DATETIME_FIELD`](#VISIT_DATETIME_FIELD)
- [`IDGOAL_FIELD`](#IDGOAL_FIELD)
- [`FIELDS_SEPARATOR`](#FIELDS_SEPARATOR)

Methods
-------

The class defines the following methods:

- [`queryVisitsByDimension()`](#queryVisitsByDimension) &mdash; Aggregates visit logs, optionally grouping by some dimension, and returns the aggregated data.
- [`queryEcommerceItems()`](#queryEcommerceItems) &mdash; Aggregates ecommerce item data (everything stored in the **log_conversion_item** table) and returns a DB statement that can be used to iterate over the aggregated data.
- [`queryActionsByDimension()`](#queryActionsByDimension) &mdash; Aggregates action data (everything in the log_action table) and returns a DB statement that can be used to iterate over the aggregated data.

### `queryVisitsByDimension()` <a name="queryVisitsByDimension"></a>

Aggregates visit logs, optionally grouping by some dimension, and returns the aggregated data.

#### Description

&lt;a name=&quot;queryVisitsByDimension-result-set&quot;/&gt;
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

- It is a **public** method.
- It accepts the following parameter(s):
    - `$dimensions` (`array`)
    - `$where`
    - `$additionalSelects` (`array`)
    - `$metrics`
    - `$rankingQuery`
- _Returns:_ A Zend_Db_Statement if `$rankingQuery` isn&#039;t supplied, otherwise the result of [RankingQuery::execute()](#). Read [this](#queryVisitsByDimension-result-set) to see what aggregate data is calculated by the query.
    - `mixed`

### `queryEcommerceItems()` <a name="queryEcommerceItems"></a>

Aggregates ecommerce item data (everything stored in the **log_conversion_item** table) and returns a DB statement that can be used to iterate over the aggregated data.

#### Description

&lt;a name=&quot;queryEcommerceItems-result-set&quot;/&gt;
**Result Set**

The following columns are in each row of the result set:

- **[Metrics::INDEX_ECOMMERCE_ITEM_REVENUE](#)**: The total revenue for the group of items
                                                  this row aggregated.
- **[Metrics::INDEX_ECOMMERCE_ITEM_QUANTITY](#)**: The total number of items of the group
                                                   this row aggregated.
- **[Metrics::INDEX_ECOMMERCE_ITEM_PRICE](#)**: The total price for the group of items this
                                                row aggregated.
- **[Metrics::INDEX_ECOMMERCE_ORDERS](#)**: The total number of orders this group of items
                                            belongs to. This will be &lt;= to the total number
                                            of items in this group.
- **[Metrics::INDEX_NB_VISITS](#)**: The total number of visits during which each item in
                                     this group of items was logged.
- **ecommerceType**: Either [GoalManager::IDGOAL_CART](#) if the items in this group were
                     abandoned by a visitor, or [GoalManager::IDGOAL_ORDER](#) if they
                     were ordered by a visitor.

**Limitations**

Segmentation is not yet supported in this aggregation method.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$dimension`
- _Returns:_ A statement object that can be used to iterate through the query&#039;s result set. See [above](#queryEcommerceItems-result-set) to learn more about what this query selects.
    - `Piwik\DataAccess\Zend_Db_Statement`

### `queryActionsByDimension()` <a name="queryActionsByDimension"></a>

Aggregates action data (everything in the log_action table) and returns a DB statement that can be used to iterate over the aggregated data.

#### Description

&lt;a name=&quot;queryActionsByDimension-result-set&quot;/&gt;
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

- It is a **public** method.
- It accepts the following parameter(s):
    - `$dimensions`
    - `$where`
    - `$additionalSelects`
    - `$metrics`
    - `$rankingQuery`
    - `$joinLogActionOnColumn`
- _Returns:_ A Zend_Db_Statement if `$rankingQuery` isn&#039;t supplied, otherwise the result of [RankingQuery::execute()](#). Read [this](#queryEcommerceItems-result-set) to see what aggregate data is calculated by the query.
    - `mixed`

