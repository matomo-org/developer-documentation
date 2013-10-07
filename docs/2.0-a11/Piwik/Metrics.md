<small>Piwik</small>

Metrics
=======

This class holds the various mappings we use to internally store and manipulate metrics.


Constants
---------

This class defines the following constants:

- [`INDEX_NB_UNIQ_VISITORS`](#INDEX_NB_UNIQ_VISITORS) &mdash; When saving DataTables in the DB, we replace all columns name with these IDs.
- [`INDEX_NB_VISITS`](#INDEX_NB_VISITS)
- [`INDEX_NB_ACTIONS`](#INDEX_NB_ACTIONS)
- [`INDEX_MAX_ACTIONS`](#INDEX_MAX_ACTIONS)
- [`INDEX_SUM_VISIT_LENGTH`](#INDEX_SUM_VISIT_LENGTH)
- [`INDEX_BOUNCE_COUNT`](#INDEX_BOUNCE_COUNT)
- [`INDEX_NB_VISITS_CONVERTED`](#INDEX_NB_VISITS_CONVERTED)
- [`INDEX_NB_CONVERSIONS`](#INDEX_NB_CONVERSIONS)
- [`INDEX_REVENUE`](#INDEX_REVENUE)
- [`INDEX_GOALS`](#INDEX_GOALS)
- [`INDEX_SUM_DAILY_NB_UNIQ_VISITORS`](#INDEX_SUM_DAILY_NB_UNIQ_VISITORS)
- [`INDEX_PAGE_NB_HITS`](#INDEX_PAGE_NB_HITS)
- [`INDEX_PAGE_SUM_TIME_SPENT`](#INDEX_PAGE_SUM_TIME_SPENT)
- [`INDEX_PAGE_EXIT_NB_UNIQ_VISITORS`](#INDEX_PAGE_EXIT_NB_UNIQ_VISITORS)
- [`INDEX_PAGE_EXIT_NB_VISITS`](#INDEX_PAGE_EXIT_NB_VISITS)
- [`INDEX_PAGE_EXIT_SUM_DAILY_NB_UNIQ_VISITORS`](#INDEX_PAGE_EXIT_SUM_DAILY_NB_UNIQ_VISITORS)
- [`INDEX_PAGE_ENTRY_NB_UNIQ_VISITORS`](#INDEX_PAGE_ENTRY_NB_UNIQ_VISITORS)
- [`INDEX_PAGE_ENTRY_SUM_DAILY_NB_UNIQ_VISITORS`](#INDEX_PAGE_ENTRY_SUM_DAILY_NB_UNIQ_VISITORS)
- [`INDEX_PAGE_ENTRY_NB_VISITS`](#INDEX_PAGE_ENTRY_NB_VISITS)
- [`INDEX_PAGE_ENTRY_NB_ACTIONS`](#INDEX_PAGE_ENTRY_NB_ACTIONS)
- [`INDEX_PAGE_ENTRY_SUM_VISIT_LENGTH`](#INDEX_PAGE_ENTRY_SUM_VISIT_LENGTH)
- [`INDEX_PAGE_ENTRY_BOUNCE_COUNT`](#INDEX_PAGE_ENTRY_BOUNCE_COUNT)
- [`INDEX_ECOMMERCE_ITEM_REVENUE`](#INDEX_ECOMMERCE_ITEM_REVENUE)
- [`INDEX_ECOMMERCE_ITEM_QUANTITY`](#INDEX_ECOMMERCE_ITEM_QUANTITY)
- [`INDEX_ECOMMERCE_ITEM_PRICE`](#INDEX_ECOMMERCE_ITEM_PRICE)
- [`INDEX_ECOMMERCE_ORDERS`](#INDEX_ECOMMERCE_ORDERS)
- [`INDEX_ECOMMERCE_ITEM_PRICE_VIEWED`](#INDEX_ECOMMERCE_ITEM_PRICE_VIEWED)
- [`INDEX_SITE_SEARCH_HAS_NO_RESULT`](#INDEX_SITE_SEARCH_HAS_NO_RESULT)
- [`INDEX_PAGE_IS_FOLLOWING_SITE_SEARCH_NB_HITS`](#INDEX_PAGE_IS_FOLLOWING_SITE_SEARCH_NB_HITS)
- [`INDEX_PAGE_SUM_TIME_GENERATION`](#INDEX_PAGE_SUM_TIME_GENERATION)
- [`INDEX_PAGE_NB_HITS_WITH_TIME_GENERATION`](#INDEX_PAGE_NB_HITS_WITH_TIME_GENERATION)
- [`INDEX_PAGE_MIN_TIME_GENERATION`](#INDEX_PAGE_MIN_TIME_GENERATION)
- [`INDEX_PAGE_MAX_TIME_GENERATION`](#INDEX_PAGE_MAX_TIME_GENERATION)
- [`INDEX_GOAL_NB_CONVERSIONS`](#INDEX_GOAL_NB_CONVERSIONS)
- [`INDEX_GOAL_REVENUE`](#INDEX_GOAL_REVENUE)
- [`INDEX_GOAL_NB_VISITS_CONVERTED`](#INDEX_GOAL_NB_VISITS_CONVERTED)
- [`INDEX_GOAL_ECOMMERCE_REVENUE_SUBTOTAL`](#INDEX_GOAL_ECOMMERCE_REVENUE_SUBTOTAL)
- [`INDEX_GOAL_ECOMMERCE_REVENUE_TAX`](#INDEX_GOAL_ECOMMERCE_REVENUE_TAX)
- [`INDEX_GOAL_ECOMMERCE_REVENUE_SHIPPING`](#INDEX_GOAL_ECOMMERCE_REVENUE_SHIPPING)
- [`INDEX_GOAL_ECOMMERCE_REVENUE_DISCOUNT`](#INDEX_GOAL_ECOMMERCE_REVENUE_DISCOUNT)
- [`INDEX_GOAL_ECOMMERCE_ITEMS`](#INDEX_GOAL_ECOMMERCE_ITEMS)

### `INDEX_NB_UNIQ_VISITORS` <a name="INDEX_NB_UNIQ_VISITORS"></a>

This saves many bytes,
eg. INDEX_NB_UNIQ_VISITORS is an integer: 4 bytes, but &#039;nb_uniq_visitors&#039; is 16 bytes at least

Properties
----------

This class defines the following properties:

- [`$mappingFromIdToName`](#$mappingFromIdToName)
- [`$mappingFromIdToNameGoal`](#$mappingFromIdToNameGoal)
- [`$mappingFromNameToId`](#$mappingFromNameToId)

### `$mappingFromIdToName` <a name="mappingFromIdToName"></a>

#### Signature

- It is a **public static** property.
- Its type is not specified.


### `$mappingFromIdToNameGoal` <a name="mappingFromIdToNameGoal"></a>

#### Signature

- It is a **public static** property.
- Its type is not specified.


### `$mappingFromNameToId` <a name="mappingFromNameToId"></a>

#### Signature

- It is a **public static** property.
- Its type is not specified.


Methods
-------

The class defines the following methods:

- [`getVisitsMetricNames()`](#getVisitsMetricNames)
- [`getMappingFromIdToName()`](#getMappingFromIdToName)
- [`isLowerValueBetter()`](#isLowerValueBetter) &mdash; Is a lower value for a given column better?
- [`getUnit()`](#getUnit) &mdash; Derive the unit name from a column name
- [`getDefaultMetricTranslations()`](#getDefaultMetricTranslations)
- [`getDefaultMetrics()`](#getDefaultMetrics)
- [`getDefaultProcessedMetrics()`](#getDefaultProcessedMetrics)
- [`getDefaultMetricsDocumentation()`](#getDefaultMetricsDocumentation)
- [`getPercentVisitColumn()`](#getPercentVisitColumn)

### `getVisitsMetricNames()` <a name="getVisitsMetricNames"></a>

#### Signature

- It is a **public static** method.
- It does not return anything.

### `getMappingFromIdToName()` <a name="getMappingFromIdToName"></a>

#### Signature

- It is a **public static** method.
- It does not return anything.

### `isLowerValueBetter()` <a name="isLowerValueBetter"></a>

Is a lower value for a given column better?

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$column`
- It returns a(n) `bool` value.

### `getUnit()` <a name="getUnit"></a>

Derive the unit name from a column name

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$column`
    - `$idSite`
- It returns a(n) `string` value.

### `getDefaultMetricTranslations()` <a name="getDefaultMetricTranslations"></a>

#### Signature

- It is a **public static** method.
- It does not return anything.

### `getDefaultMetrics()` <a name="getDefaultMetrics"></a>

#### Signature

- It is a **public static** method.
- It does not return anything.

### `getDefaultProcessedMetrics()` <a name="getDefaultProcessedMetrics"></a>

#### Signature

- It is a **public static** method.
- It does not return anything.

### `getDefaultMetricsDocumentation()` <a name="getDefaultMetricsDocumentation"></a>

#### Signature

- It is a **public static** method.
- It does not return anything.

### `getPercentVisitColumn()` <a name="getPercentVisitColumn"></a>

#### Signature

- It is a **public static** method.
- It does not return anything.

