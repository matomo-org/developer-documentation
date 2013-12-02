<small>Piwik\DataAccess</small>

LogAggregator
=============

Contains methods that aggregates log data (visits, actions, conversions, ecommerce).

Description
-----------

Plugin [Plugin\Archiver](/api-reference/Piwik/Plugin/Archiver) descendants can use the methods in this class to aggregate data
in the log tables without creating their own SQL queries.

### Aggregation Principles

**Dimensions**

Every aggregation method aggregates rows in a specific table. The rows that are
aggregated together are chosen by **_dimensions_** that you specify.

A **_dimension_** is a table column. In aggregation methods, rows that have the same
values for the specified dimensions are aggregated together. Using dimensions you
can calculate metrics for an entity (visits, actions, etc.) based on the values of one
or more of the entity's properties.

_Note: A dimension is essentially the same as a **GROUP BY** field._

### Examples

**Aggregating visit data**

    $archiveProcessor = // ...
    $logAggregator = $archiveProcessor->getLogAggregator();
    
    // get metrics for every used browser language of all visits by returning visitors
    $query = $logAggregator->queryVisitsByDimension(
        $dimensions = array('log_visit.location_browser_lang'),
        $where = 'log_visit.visitor_returning = 1',

        // also count visits for each browser language that are not located in the US
        $additionalSelects = array('sum(case when log_visit.location_country = 'us' then 1 else 0 end) as nonus'),

        // we're only interested in visits, unique visitors & actions, so don't waste time calculating anything else
        $metrics = array(Metrics::INDEX_NB_UNIQ_VISITORS, Metrics::INDEX_NB_VISITS, Metrics::INDEX_NB_ACTIONS),
    );
    if ($query === false) {
        return;
    }

    while ($row = $query->fetch()) {
        $uniqueVisitors = $row[Metrics::INDEX_NB_UNIQ_VISITORS];
        $visits = $row[Metrics::INDEX_NB_VISITS];
        $actions = $row[Metrics::INDEX_NB_ACTIONS];

        // ... do something w/ calculated metrics ...
    }

**Aggregating conversion data**

    $archiveProcessor = // ...
    $logAggregator = $archiveProcessor->getLogAggregator();

    // get metrics for ecommerce conversions for each country
    $query = $logAggregator->queryConversionsByDimension(
        $dimensions = array('log_conversion.location_country'),
        $where = 'log_conversion.idgoal = 0', // 0 is the special ecommerceOrder idGoal value in the table

        // also calculate average tax and max shipping per country
        $additionalSelects = array(
            'AVG(log_conversion.revenue_tax) as avg_tax',
            'MAX(log_conversion.revenue_shipping) as max_shipping'
        )
    );
    if ($query === false) {
        return;
    }

    while ($row = $query->fetch()) {
        $country = $row['location_country'];
        $numEcommerceSales = $row[Metrics::INDEX_GOAL_NB_CONVERSIONS];
        $numVisitsWithEcommerceSales = $row[Metrics::INDEX_GOAL_NB_VISITS_CONVERTED];
        $avgTaxForCountry = $country['avg_tax'];
        $maxShippingForCountry = $country['max_shipping'];

        // ... do something with aggregated data ...
    }

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
    - `$dimensions` (`array`) &mdash; SELECT fields (or just one field) that will be grouped by, eg, `'referrer_name'` or `array('referrer_name', 'referrer_keyword')`. The metrics retrieved from the query will be specific to combinations of these fields. So if `array('referrer_name', 'referrer_keyword')` is supplied, the query will select the visits for each referrer/keyword combination.
    - `$where` (`bool`|`string`) &mdash; Additional condition for the WHERE clause. Can be used to filter the set of visits that are considered for aggregation.
    - `$additionalSelects` (`array`) &mdash; Additional SELECT fields that are not included in the group by clause. These can be aggregate expressions, eg, `SUM(somecol)`.
    - `$metrics` (`bool`|`array`) &mdash; The set of metrics to calculate and return. If false, the query will select all of them. The following values can be used: - [Metrics::INDEX_NB_UNIQ_VISITORS](#) - [Metrics::INDEX_NB_VISITS](#) - [Metrics::INDEX_NB_ACTIONS](#) - [Metrics::INDEX_MAX_ACTIONS](#) - [Metrics::INDEX_SUM_VISIT_LENGTH](#) - [Metrics::INDEX_BOUNCE_COUNT](#) - [Metrics::INDEX_NB_VISITS_CONVERTED](#)
    - `$rankingQuery` (`bool`|[`RankingQuery`](../../Piwik/RankingQuery.md)) &mdash; A pre-configured ranking query instance that will be used to limit the result. If set, the return value is the array returned by {@link Piwik\RankingQuery::execute()}.
- _Returns:_ A Zend_Db_Statement if `$rankingQuery` isn't supplied, otherwise the result of {@link Piwik\RankingQuery::execute()}. Read [this](#queryVisitsByDimension-result-set) to see what aggregate data is calculated by the query.
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
    - `$rankingQuery` (`bool`|[`RankingQuery`](../../Piwik/RankingQuery.md)) &mdash; A pre-configured ranking query instance that will be used to limit the result. If set, the return value is the array returned by {@link Piwik\RankingQuery::execute()}.
    - `$joinLogActionOnColumn` (`bool`|`string`) &mdash; One or more columns from the **log_link_visit_action** table that log_action should be joined on. The table alias used for each join is `"log_action$i"` where `$i` is the index of the column in this array. If a string is used for this parameter, the table alias is not suffixed.
- _Returns:_ A Zend_Db_Statement if `$rankingQuery` isn't supplied, otherwise the result of {@link Piwik\RankingQuery::execute()}. Read [this](#queryEcommerceItems-result-set) to see what aggregate data is calculated by the query.
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
    - `$column` (`string`) &mdash; The name of a column in `$table` that will be summarized.
    - `$ranges` (`array`) &mdash; An array of arrays describing the ranges over which the data in the table will be summarized. For example, ``` array( array(1, 1), array(2, 2), array(3, 5), array(6, 10), array(10) // everything over 10 ) ```
    - `$table` (`string`) &mdash; The unprefixed name of the table whose rows will be summarized.
    - `$selectColumnPrefix` (`string`) &mdash; The prefix to prepend to each SELECT expression. This prefix is used to differentiate different sets of range summarization SELECTs. You can supply different values to this argument to summarize several columns in one query (see above for an example).
    - `$restrictToReturningVisitors` (`bool`) &mdash; Whether to only summarize rows that belong to visits of returning visitors or not. If this argument is true, then the SELECT expressions returned can only be used with the [queryVisitsByDimension](#queryVisitsByDimension) method.
- _Returns:_ An array of SQL SELECT expressions, for example, ``` array( 'sum(case when log_visit.visit_total_actions between 0 and 2 then 1 else 0 end) as vta0', 'sum(case when log_visit.visit_total_actions > 2 then 1 else 0 end) as vta1' ) ```
    - `array`

