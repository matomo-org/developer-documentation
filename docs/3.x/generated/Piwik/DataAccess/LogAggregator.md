<small>Piwik\DataAccess\</small>

LogAggregator
=============

Contains methods that calculate metrics by aggregating log data (visits, actions, conversions, ecommerce items).

You can use the methods in this class within [Archiver](/api-reference/Piwik/Plugin/Archiver) descendants
to aggregate log data without having to write SQL queries.

### Aggregation Dimension

All aggregation methods accept a **dimension** parameter. These parameters are important as
they control how rows in a table are aggregated together.

A **_dimension_** is just a table column. Rows that have the same values for these columns are
aggregated together. The result of these aggregations is a set of metrics for every recorded value
of a **dimension**.

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
        $additionalSelects = array('sum(case when log_visit.location_country <> 'us' then 1 else 0 end) as nonus'),

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
        $avgTaxForCountry = $row['avg_tax'];
        $maxShippingForCountry = $row['max_shipping'];

        // ... do something with aggregated data ...
    }

Methods
-------

The class defines the following methods:

- [`queryVisitsByDimension()`](#queryvisitsbydimension) &mdash; Executes and returns a query aggregating visit logs, optionally grouping by some dimension.
- [`queryEcommerceItems()`](#queryecommerceitems) &mdash; Executes and returns a query aggregating ecommerce item data (everything stored in the **log\_conversion\_item** table)  and returns a DB statement that can be used to iterate over the result
- [`queryActionsByDimension()`](#queryactionsbydimension) &mdash; Executes and returns a query aggregating action data (everything in the log_action table) and returns a DB statement that can be used to iterate over the result
- [`getSelectsFromRangedColumn()`](#getselectsfromrangedcolumn) &mdash; Creates and returns an array of SQL `SELECT` expressions that will each count how many rows have a column whose value is within a certain range.

<a name="queryvisitsbydimension" id="queryvisitsbydimension"></a>
<a name="queryVisitsByDimension" id="queryVisitsByDimension"></a>
### `queryVisitsByDimension()`

Executes and returns a query aggregating visit logs, optionally grouping by some dimension.

Returns
a DB statement that can be used to iterate over the result

**Result Set**

The following columns are in each row of the result set:

- **`Metrics::INDEX_NB_UNIQ_VISITORS`**: The total number of unique visitors in this group
                                                     of aggregated visits.
- **`Metrics::INDEX_NB_VISITS`**: The total number of visits aggregated.
- **`Metrics::INDEX_NB_ACTIONS`**: The total number of actions performed in this group of
                                               aggregated visits.
- **`Metrics::INDEX_MAX_ACTIONS`**: The maximum actions perfomred in one visit for this group of
                                                visits.
- **`Metrics::INDEX_SUM_VISIT_LENGTH`**: The total amount of time spent on the site for this
                                                     group of visits.
- **`Metrics::INDEX_BOUNCE_COUNT`**: The total number of bounced visits in this group of
                                                 visits.
- **`Metrics::INDEX_NB_VISITS_CONVERTED`**: The total number of visits for which at least one
                                                        conversion occurred, for this group of visits.

Additional data can be selected by setting the `$additionalSelects` parameter.

_Note: The metrics returned by this query can be customized by the `$metrics` parameter._

#### Signature

-  It accepts the following parameter(s):
    - `$dimensions` (`array`) &mdash;
       `SELECT` fields (or just one field) that will be grouped by, eg, `'referrer_name'` or `array('referrer_name', 'referrer_keyword')`. The metrics retrieved from the query will be specific to combinations of these fields. So if `array('referrer_name', 'referrer_keyword')` is supplied, the query will aggregate visits for each referrer/keyword combination.
    - `$where` (`bool`|`string`) &mdash;
       Additional condition for the `WHERE` clause. Can be used to filter the set of visits that are considered for aggregation.
    - `$additionalSelects` (`array`) &mdash;
       Additional `SELECT` fields that are not included in the group by clause. These can be aggregate expressions, eg, `SUM(somecol)`.
    - `$metrics` (`bool`|`array`) &mdash;
       The set of metrics to calculate and return. If false, the query will select all of them. The following values can be used: - `Metrics::INDEX_NB_UNIQ_VISITORS` - `Metrics::INDEX_NB_VISITS` - `Metrics::INDEX_NB_ACTIONS` - `Metrics::INDEX_MAX_ACTIONS` - `Metrics::INDEX_SUM_VISIT_LENGTH` - `Metrics::INDEX_BOUNCE_COUNT` - `Metrics::INDEX_NB_VISITS_CONVERTED`
    - `$rankingQuery` (`bool`|[`RankingQuery`](../../Piwik/RankingQuery.md)) &mdash;
       A pre-configured ranking query instance that will be used to limit the result. If set, the return value is the array returned by [RankingQuery::execute()](/api-reference/Piwik/RankingQuery#execute).
    - `$orderBy` (`bool`|`string`) &mdash;
       Order By clause to add (e.g. user_id ASC)
    - `$timeLimitInMs` (`int`) &mdash;
       Adds a MAX_EXECUTION_TIME query hint to the query if $timeLimitInMs > 0

- *Returns:*  `mixed` &mdash;
    A Zend_Db_Statement if `$rankingQuery` isn't supplied, otherwise the result of [RankingQuery::execute()](/api-reference/Piwik/RankingQuery#execute). Read [this](/api-reference/Piwik/DataAccess/LogAggregator#queryvisitsbydimension) to see what aggregate data is calculated by the query.

<a name="queryecommerceitems" id="queryecommerceitems"></a>
<a name="queryEcommerceItems" id="queryEcommerceItems"></a>
### `queryEcommerceItems()`

Executes and returns a query aggregating ecommerce item data (everything stored in the **log\_conversion\_item** table)  and returns a DB statement that can be used to iterate over the result

<a name="queryEcommerceItems-result-set"></a>
**Result Set**

Each row of the result set represents an aggregated group of ecommerce items. The following
columns are in each row of the result set:

- **`Metrics::INDEX_ECOMMERCE_ITEM_REVENUE`**: The total revenue for the group of items.
- **`Metrics::INDEX_ECOMMERCE_ITEM_QUANTITY`**: The total number of items in this group.
- **`Metrics::INDEX_ECOMMERCE_ITEM_PRICE`**: The total price for the group of items.
- **`Metrics::INDEX_ECOMMERCE_ORDERS`**: The total number of orders this group of items
                                                     belongs to. This will be <= to the total number
                                                     of items in this group.
- **`Metrics::INDEX_NB_VISITS`**: The total number of visits that caused these items to be logged.
- **ecommerceType**: Either Piwik\Tracker\GoalManager::IDGOAL\_CART if the items in this group were
                     abandoned by a visitor, or Piwik\Tracker\GoalManager::IDGOAL\_ORDER if they
                     were ordered by a visitor.

**Limitations**

Segmentation is not yet supported for this aggregation method.

#### Signature

-  It accepts the following parameter(s):
    - `$dimension` (`string`) &mdash;
       One or more **log\_conversion\_item** columns to group aggregated data by. Eg, `'idaction_sku'` or `'idaction_sku, idaction_category'`.

- *Returns:*  `Zend_Db_Statement` &mdash;
    A statement object that can be used to iterate through the query's result set. See [above](#queryEcommerceItems-result-set) to learn more about what this query selects.

<a name="queryactionsbydimension" id="queryactionsbydimension"></a>
<a name="queryActionsByDimension" id="queryActionsByDimension"></a>
### `queryActionsByDimension()`

Executes and returns a query aggregating action data (everything in the log_action table) and returns a DB statement that can be used to iterate over the result

<a name="queryActionsByDimension-result-set"></a>
**Result Set**

Each row of the result set represents an aggregated group of actions. The following columns
are in each aggregate row:

- **`Metrics::INDEX_NB_UNIQ_VISITORS`**: The total number of unique visitors that performed
                                            the actions in this group.
- **`Metrics::INDEX_NB_VISITS`**: The total number of visits these actions belong to.
- **`Metrics::INDEX_NB_ACTIONS`**: The total number of actions in this aggregate group.

Additional data can be selected through the `$additionalSelects` parameter.

_Note: The metrics calculated by this query can be customized by the `$metrics` parameter._

#### Signature

-  It accepts the following parameter(s):
    - `$dimensions` (`array`|`string`) &mdash;
       One or more SELECT fields that will be used to group the log_action rows by. This parameter determines which log_action rows will be aggregated together.
    - `$where` (`bool`|`string`) &mdash;
       Additional condition for the WHERE clause. Can be used to filter the set of visits that are considered for aggregation.
    - `$additionalSelects` (`array`) &mdash;
       Additional SELECT fields that are not included in the group by clause. These can be aggregate expressions, eg, `SUM(somecol)`.
    - `$metrics` (`bool`|`array`) &mdash;
       The set of metrics to calculate and return. If `false`, the query will select all of them. The following values can be used: - `Metrics::INDEX_NB_UNIQ_VISITORS` - `Metrics::INDEX_NB_VISITS` - `Metrics::INDEX_NB_ACTIONS`
    - `$rankingQuery` (`bool`|[`RankingQuery`](../../Piwik/RankingQuery.md)) &mdash;
       A pre-configured ranking query instance that will be used to limit the result. If set, the return value is the array returned by [RankingQuery::execute()](/api-reference/Piwik/RankingQuery#execute).
    - `$joinLogActionOnColumn` (`bool`|`string`) &mdash;
       One or more columns from the **log_link_visit_action** table that log_action should be joined on. The table alias used for each join is `"log_action$i"` where `$i` is the index of the column in this array. If a string is used for this parameter, the table alias is not suffixed (since there is only one column).
    - `$secondaryOrderBy` (`string`) &mdash;
       A secondary order by clause for the ranking query
    - `$timeLimitInMs` (`int`) &mdash;
       Adds a MAX_EXECUTION_TIME hint to the query if $timeLimitInMs > 0

- *Returns:*  `mixed` &mdash;
    A Zend_Db_Statement if `$rankingQuery` isn't supplied, otherwise the result of [RankingQuery::execute()](/api-reference/Piwik/RankingQuery#execute). Read [this](#queryEcommerceItems-result-set) to see what aggregate data is calculated by the query.

<a name="getselectsfromrangedcolumn" id="getselectsfromrangedcolumn"></a>
<a name="getSelectsFromRangedColumn" id="getSelectsFromRangedColumn"></a>
### `getSelectsFromRangedColumn()`

Creates and returns an array of SQL `SELECT` expressions that will each count how many rows have a column whose value is within a certain range.

**Note:** The result of this function is meant for use in the `$additionalSelects` parameter
in one of the query... methods (for example [queryVisitsByDimension()](/api-reference/Piwik/DataAccess/LogAggregator#queryvisitsbydimension)).

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

    // perform the query
    $logAggregator = // get the LogAggregator somehow
    $query = $logAggregator->queryVisitsByDimension($dimensions = array(), $where = false, $selects);
    $tableSummary = $query->fetch();

    $numberOfVisitsWithOneAction = $tableSummary['vta0'];
    $numberOfVisitsBetweenTwoAnd10 = $tableSummary['vta1'];

    $numberOfVisitsWithVisitCountOfOne = $tableSummary['vcv0'];

#### Signature

-  It accepts the following parameter(s):
    - `$column` (`string`) &mdash;
       The name of a column in `$table` that will be summarized.
    - `$ranges` (`array`) &mdash;
       The array of ranges over which the data in the table will be summarized. For example, ``` array( array(1, 1), array(2, 2), array(3, 8), array(8) // everything over 8 ) ```
    - `$table` (`string`) &mdash;
       The unprefixed name of the table whose rows will be summarized.
    - `$selectColumnPrefix` (`string`) &mdash;
       The prefix to prepend to each SELECT expression. This prefix is used to differentiate different sets of range summarization SELECTs. You can supply different values to this argument to summarize several columns in one query (see above for an example).
    - `$restrictToReturningVisitors` (`bool`) &mdash;
       Whether to only summarize rows that belong to visits of returning visitors or not. If this argument is true, then the SELECT expressions returned can only be used with the [queryVisitsByDimension()](/api-reference/Piwik/DataAccess/LogAggregator#queryvisitsbydimension) method.

- *Returns:*  `array` &mdash;
    An array of SQL SELECT expressions, for example, ``` array( 'sum(case when log_visit.visit_total_actions between 0 and 2 then 1 else 0 end) as vta0', 'sum(case when log_visit.visit_total_actions > 2 then 1 else 0 end) as vta1' ) ```

