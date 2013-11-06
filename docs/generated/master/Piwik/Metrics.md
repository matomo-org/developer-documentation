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

- `INDEX_NB_UNIQ_VISITORS`
- `INDEX_NB_VISITS`
- `INDEX_NB_ACTIONS`
- `INDEX_MAX_ACTIONS`
- `INDEX_SUM_VISIT_LENGTH`
- `INDEX_BOUNCE_COUNT`
- `INDEX_NB_VISITS_CONVERTED`
- `INDEX_NB_CONVERSIONS`
- `INDEX_REVENUE`
- `INDEX_GOALS`
- `INDEX_SUM_DAILY_NB_UNIQ_VISITORS`
- `INDEX_PAGE_NB_HITS`
- `INDEX_PAGE_SUM_TIME_SPENT`
- `INDEX_PAGE_EXIT_NB_UNIQ_VISITORS`
- `INDEX_PAGE_EXIT_NB_VISITS`
- `INDEX_PAGE_EXIT_SUM_DAILY_NB_UNIQ_VISITORS`
- `INDEX_PAGE_ENTRY_NB_UNIQ_VISITORS`
- `INDEX_PAGE_ENTRY_SUM_DAILY_NB_UNIQ_VISITORS`
- `INDEX_PAGE_ENTRY_NB_VISITS`
- `INDEX_PAGE_ENTRY_NB_ACTIONS`
- `INDEX_PAGE_ENTRY_SUM_VISIT_LENGTH`
- `INDEX_PAGE_ENTRY_BOUNCE_COUNT`
- `INDEX_ECOMMERCE_ITEM_REVENUE`
- `INDEX_ECOMMERCE_ITEM_QUANTITY`
- `INDEX_ECOMMERCE_ITEM_PRICE`
- `INDEX_ECOMMERCE_ORDERS`
- `INDEX_ECOMMERCE_ITEM_PRICE_VIEWED`
- `INDEX_SITE_SEARCH_HAS_NO_RESULT`
- `INDEX_PAGE_IS_FOLLOWING_SITE_SEARCH_NB_HITS`
- `INDEX_PAGE_SUM_TIME_GENERATION`
- `INDEX_PAGE_NB_HITS_WITH_TIME_GENERATION`
- `INDEX_PAGE_MIN_TIME_GENERATION`
- `INDEX_PAGE_MAX_TIME_GENERATION`
- `INDEX_GOAL_NB_CONVERSIONS`
- `INDEX_GOAL_REVENUE`
- `INDEX_GOAL_NB_VISITS_CONVERTED`
- `INDEX_GOAL_ECOMMERCE_REVENUE_SUBTOTAL`
- `INDEX_GOAL_ECOMMERCE_REVENUE_TAX`
- `INDEX_GOAL_ECOMMERCE_REVENUE_SHIPPING`
- `INDEX_GOAL_ECOMMERCE_REVENUE_DISCOUNT`
- `INDEX_GOAL_ECOMMERCE_ITEMS`

Properties
----------

This class defines the following properties:

- [`$mappingFromIdToName`](#$mappingfromidtoname)
- [`$mappingFromIdToNameGoal`](#$mappingfromidtonamegoal)
- [`$mappingFromNameToId`](#$mappingfromnametoid)

<a name="mappingfromidtoname" id="mappingfromidtoname"></a>
<a name="mappingFromIdToName" id="mappingFromIdToName"></a>
### `$mappingFromIdToName`

#### Signature

- Its type is not specified.


<a name="mappingfromidtonamegoal" id="mappingfromidtonamegoal"></a>
<a name="mappingFromIdToNameGoal" id="mappingFromIdToNameGoal"></a>
### `$mappingFromIdToNameGoal`

#### Signature

- Its type is not specified.


<a name="mappingfromnametoid" id="mappingfromnametoid"></a>
<a name="mappingFromNameToId" id="mappingFromNameToId"></a>
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
<a name="getVisitsMetricNames" id="getVisitsMetricNames"></a>
### `getVisitsMetricNames()`

#### Signature

- It does not return anything.

<a name="getmappingfromidtoname" id="getmappingfromidtoname"></a>
<a name="getMappingFromIdToName" id="getMappingFromIdToName"></a>
### `getMappingFromIdToName()`

#### Signature

- It does not return anything.

<a name="islowervaluebetter" id="islowervaluebetter"></a>
<a name="isLowerValueBetter" id="isLowerValueBetter"></a>
### `isLowerValueBetter()`

Is a lower value for a given column better?

#### Signature

- It accepts the following parameter(s):
    - `$column`
- It returns a `bool` value.

<a name="getunit" id="getunit"></a>
<a name="getUnit" id="getUnit"></a>
### `getUnit()`

Derive the unit name from a column name

#### Signature

- It accepts the following parameter(s):
    - `$column`
    - `$idSite`
- It returns a `string` value.

<a name="getdefaultmetrictranslations" id="getdefaultmetrictranslations"></a>
<a name="getDefaultMetricTranslations" id="getDefaultMetricTranslations"></a>
### `getDefaultMetricTranslations()`

#### Signature

- It does not return anything.

<a name="getdefaultmetrics" id="getdefaultmetrics"></a>
<a name="getDefaultMetrics" id="getDefaultMetrics"></a>
### `getDefaultMetrics()`

#### Signature

- It does not return anything.

<a name="getdefaultprocessedmetrics" id="getdefaultprocessedmetrics"></a>
<a name="getDefaultProcessedMetrics" id="getDefaultProcessedMetrics"></a>
### `getDefaultProcessedMetrics()`

#### Signature

- It does not return anything.

<a name="getdefaultmetricsdocumentation" id="getdefaultmetricsdocumentation"></a>
<a name="getDefaultMetricsDocumentation" id="getDefaultMetricsDocumentation"></a>
### `getDefaultMetricsDocumentation()`

#### Signature

- It does not return anything.

<a name="getpercentvisitcolumn" id="getpercentvisitcolumn"></a>
<a name="getPercentVisitColumn" id="getPercentVisitColumn"></a>
### `getPercentVisitColumn()`

#### Signature

- It does not return anything.

