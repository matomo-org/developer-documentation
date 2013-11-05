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

- [`LOG_VISIT_TABLE`](#log_visit_table)
- [`LOG_ACTIONS_TABLE`](#log_actions_table)
- [`LOG_CONVERSION_TABLE`](#log_conversion_table)
- [`REVENUE_SUBTOTAL_FIELD`](#revenue_subtotal_field)
- [`REVENUE_TAX_FIELD`](#revenue_tax_field)
- [`REVENUE_SHIPPING_FIELD`](#revenue_shipping_field)
- [`REVENUE_DISCOUNT_FIELD`](#revenue_discount_field)
- [`TOTAL_REVENUE_FIELD`](#total_revenue_field)
- [`ITEMS_COUNT_FIELD`](#items_count_field)
- [`CONVERSION_DATETIME_FIELD`](#conversion_datetime_field)
- [`ACTION_DATETIME_FIELD`](#action_datetime_field)
- [`VISIT_DATETIME_FIELD`](#visit_datetime_field)
- [`IDGOAL_FIELD`](#idgoal_field)
- [`FIELDS_SEPARATOR`](#fields_separator)

Methods
-------

The class defines the following methods:

- [`queryVisitsByDimension()`](#queryvisitsbydimension) &mdash; Queries visit logs by dimension and returns the aggregate data.

<a name="queryvisitsbydimension" id="queryvisitsbydimension"></a>
### `queryVisitsByDimension()`

Queries visit logs by dimension and returns the aggregate data.

#### Signature

- It accepts the following parameter(s):
    - `$dimensions` (`array`)
    - `$where`
    - `$additionalSelects` (`array`)
    - `$metrics`
    - `$rankingQuery`
- _Returns:_ A Zend_Db_Statement if `$rankingQuery` isn't supplied, otherwise the result of [RankingQuery::execute()](#).
    - `mixed`

