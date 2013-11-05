<small>Piwik\DataAccess</small>

LogAggregator
=============

Contains methods that aggregates log data (visits, actions, conversions, ecommerce).

Description
-----------

Plugin [Archiver](#) descendants can use the methods in this class to aggregate data
in the log tables without creating their own SQL queries.

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

- [`queryVisitsByDimension()`](#queryVisitsByDimension) &mdash; Queries visit logs by dimension and returns the aggregate data.

<a name="queryvisitsbydimension" id="queryvisitsbydimension"></a>
### `queryVisitsByDimension()`

Queries visit logs by dimension and returns the aggregate data.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$dimensions` (`array`)
    - `$where`
    - `$additionalSelects` (`array`)
    - `$metrics`
    - `$rankingQuery`
- _Returns:_ A Zend_Db_Statement if `$rankingQuery` isn&#039;t supplied, otherwise the result of [RankingQuery::execute()](#).
    - `mixed`

