<small>Piwik</small>

Metrics
=======

This class contains metadata regarding core metrics and contains several related helper functions.

Description
-----------

Of note are the `INDEX_...` constants. In the database, metric column names
are stored in DataTable rows are stored as integers to save space. The integer
values used are determined by these constants.


Constants
---------

This class defines the following constants:

- [`INDEX_NB_UNIQ_VISITORS`](#index_nb_uniq_visitors)
- [`INDEX_NB_VISITS`](#index_nb_visits)
- [`INDEX_NB_ACTIONS`](#index_nb_actions)
- [`INDEX_MAX_ACTIONS`](#index_max_actions)
- [`INDEX_SUM_VISIT_LENGTH`](#index_sum_visit_length)
- [`INDEX_BOUNCE_COUNT`](#index_bounce_count)
- [`INDEX_NB_VISITS_CONVERTED`](#index_nb_visits_converted)
- [`INDEX_NB_CONVERSIONS`](#index_nb_conversions)
- [`INDEX_REVENUE`](#index_revenue)
- [`INDEX_GOALS`](#index_goals)
- [`INDEX_SUM_DAILY_NB_UNIQ_VISITORS`](#index_sum_daily_nb_uniq_visitors)
- [`INDEX_PAGE_NB_HITS`](#index_page_nb_hits)
- [`INDEX_PAGE_SUM_TIME_SPENT`](#index_page_sum_time_spent)
- [`INDEX_PAGE_EXIT_NB_UNIQ_VISITORS`](#index_page_exit_nb_uniq_visitors)
- [`INDEX_PAGE_EXIT_NB_VISITS`](#index_page_exit_nb_visits)
- [`INDEX_PAGE_EXIT_SUM_DAILY_NB_UNIQ_VISITORS`](#index_page_exit_sum_daily_nb_uniq_visitors)
- [`INDEX_PAGE_ENTRY_NB_UNIQ_VISITORS`](#index_page_entry_nb_uniq_visitors)
- [`INDEX_PAGE_ENTRY_SUM_DAILY_NB_UNIQ_VISITORS`](#index_page_entry_sum_daily_nb_uniq_visitors)
- [`INDEX_PAGE_ENTRY_NB_VISITS`](#index_page_entry_nb_visits)
- [`INDEX_PAGE_ENTRY_NB_ACTIONS`](#index_page_entry_nb_actions)
- [`INDEX_PAGE_ENTRY_SUM_VISIT_LENGTH`](#index_page_entry_sum_visit_length)
- [`INDEX_PAGE_ENTRY_BOUNCE_COUNT`](#index_page_entry_bounce_count)
- [`INDEX_ECOMMERCE_ITEM_REVENUE`](#index_ecommerce_item_revenue)
- [`INDEX_ECOMMERCE_ITEM_QUANTITY`](#index_ecommerce_item_quantity)
- [`INDEX_ECOMMERCE_ITEM_PRICE`](#index_ecommerce_item_price)
- [`INDEX_ECOMMERCE_ORDERS`](#index_ecommerce_orders)
- [`INDEX_ECOMMERCE_ITEM_PRICE_VIEWED`](#index_ecommerce_item_price_viewed)
- [`INDEX_SITE_SEARCH_HAS_NO_RESULT`](#index_site_search_has_no_result)
- [`INDEX_PAGE_IS_FOLLOWING_SITE_SEARCH_NB_HITS`](#index_page_is_following_site_search_nb_hits)
- [`INDEX_PAGE_SUM_TIME_GENERATION`](#index_page_sum_time_generation)
- [`INDEX_PAGE_NB_HITS_WITH_TIME_GENERATION`](#index_page_nb_hits_with_time_generation)
- [`INDEX_PAGE_MIN_TIME_GENERATION`](#index_page_min_time_generation)
- [`INDEX_PAGE_MAX_TIME_GENERATION`](#index_page_max_time_generation)
- [`INDEX_GOAL_NB_CONVERSIONS`](#index_goal_nb_conversions)
- [`INDEX_GOAL_REVENUE`](#index_goal_revenue)
- [`INDEX_GOAL_NB_VISITS_CONVERTED`](#index_goal_nb_visits_converted)
- [`INDEX_GOAL_ECOMMERCE_REVENUE_SUBTOTAL`](#index_goal_ecommerce_revenue_subtotal)
- [`INDEX_GOAL_ECOMMERCE_REVENUE_TAX`](#index_goal_ecommerce_revenue_tax)
- [`INDEX_GOAL_ECOMMERCE_REVENUE_SHIPPING`](#index_goal_ecommerce_revenue_shipping)
- [`INDEX_GOAL_ECOMMERCE_REVENUE_DISCOUNT`](#index_goal_ecommerce_revenue_discount)
- [`INDEX_GOAL_ECOMMERCE_ITEMS`](#index_goal_ecommerce_items)

Properties
----------

This class defines the following properties:

- [`$mappingFromIdToName`](#$mappingfromidtoname)
- [`$mappingFromIdToNameGoal`](#$mappingfromidtonamegoal)
- [`$mappingFromNameToId`](#$mappingfromnametoid)

<a name="mappingfromidtoname" id="mappingfromidtoname"></a>
### `$mappingFromIdToName`

#### Signature

- Its type is not specified.


<a name="mappingfromidtonamegoal" id="mappingfromidtonamegoal"></a>
### `$mappingFromIdToNameGoal`

#### Signature

- Its type is not specified.


<a name="mappingfromnametoid" id="mappingfromnametoid"></a>
### `$mappingFromNameToId`

#### Signature

- Its type is not specified.


Methods
-------

The class defines the following methods:

- [`getVisitsMetricNames()`](#getvisitsmetricnames)
- [`getMappingFromIdToName()`](#getmappingfromidtoname)
- [`isLowerValueBetter()`](#islowervaluebetter) &mdash; Is a lower value for a given column better?
- [`getUnit()`](#getunit) &mdash; Derive the unit name from a column name
- [`getDefaultMetricTranslations()`](#getdefaultmetrictranslations)
- [`getDefaultMetrics()`](#getdefaultmetrics)
- [`getDefaultProcessedMetrics()`](#getdefaultprocessedmetrics)
- [`getDefaultMetricsDocumentation()`](#getdefaultmetricsdocumentation)
- [`getPercentVisitColumn()`](#getpercentvisitcolumn)

<a name="getvisitsmetricnames" id="getvisitsmetricnames"></a>
### `getVisitsMetricNames()`

#### Signature

- It does not return anything.

<a name="getmappingfromidtoname" id="getmappingfromidtoname"></a>
### `getMappingFromIdToName()`

#### Signature

- It does not return anything.

<a name="islowervaluebetter" id="islowervaluebetter"></a>
### `isLowerValueBetter()`

Is a lower value for a given column better?

#### Signature

- It accepts the following parameter(s):
    - `$column`
- It returns a(n) `bool` value.

<a name="getunit" id="getunit"></a>
### `getUnit()`

Derive the unit name from a column name

#### Signature

- It accepts the following parameter(s):
    - `$column`
    - `$idSite`
- It returns a(n) `string` value.

<a name="getdefaultmetrictranslations" id="getdefaultmetrictranslations"></a>
### `getDefaultMetricTranslations()`

#### Signature

- It does not return anything.

<a name="getdefaultmetrics" id="getdefaultmetrics"></a>
### `getDefaultMetrics()`

#### Signature

- It does not return anything.

<a name="getdefaultprocessedmetrics" id="getdefaultprocessedmetrics"></a>
### `getDefaultProcessedMetrics()`

#### Signature

- It does not return anything.

<a name="getdefaultmetricsdocumentation" id="getdefaultmetricsdocumentation"></a>
### `getDefaultMetricsDocumentation()`

#### Signature

- It does not return anything.

<a name="getpercentvisitcolumn" id="getpercentvisitcolumn"></a>
### `getPercentVisitColumn()`

#### Signature

- It does not return anything.

