<small>Piwik\DataTable\Filter\</small>

AddColumnsProcessedMetricsGoal
==============================

Adds goal related metrics to a DataTable using metrics that already exist.

Metrics added are:

- **revenue_per_visit**: total goal and ecommerce revenue / nb_visits
- **goal_%idGoal%_conversion_rate**: the conversion rate. There will be one of
                                     these columns for each goal that exists
                                     for the site.
- **goal_%idGoal%_nb_conversions**: the number of conversions. There will be one of
                                    these columns for each goal that exists
                                    for the site.
- **goal_%idGoal%_revenue_per_visit**: goal revenue / nb_visits. There will be one of
                                       these columns for each goal that exists
                                       for the site.
- **goal_%idGoal%_revenue**: goal revenue. There will be one of
                             these columns for each goal that exists
                             for the site.
- **goal_%idGoal%_avg_order_revenue**: goal revenue / number of orders or abandoned
                                       carts. Only for ecommerce order and abandoned cart
                                       reports.
- **goal_%idGoal%_items**: number of items. Only for ecommerce order and abandoned cart
                           reports.

Adding the **filter_update_columns_when_show_all_goals** query parameter to
an API request will trigger the execution of this Filter.

_Note: This filter must be called before [ReplaceColumnNames](/api-reference/Piwik/DataTable/Filter/ReplaceColumnNames) is called._

**Basic usage example**

    $dataTable->filter('AddColumnsProcessedMetricsGoal',
        array($enable = true, $idGoal = Piwik::LABEL_ID_GOAL_IS_ECOMMERCE_ORDER));

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`filter()`](#filter) &mdash; Adds the processed metrics.
- [`enableRecursive()`](#enablerecursive) &mdash; Enables/Disables recursive filtering. Inherited from [`BaseFilter`](../../../Piwik/DataTable/BaseFilter.md)
- [`filterSubTable()`](#filtersubtable) &mdash; Filters a row's subtable, if one exists and is loaded in memory. Inherited from [`BaseFilter`](../../../Piwik/DataTable/BaseFilter.md)

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

-  It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md)) &mdash;
      
    - `$enable`
      
    - `$processOnlyIdGoal`
      
    - `$goalsToProcess`
      

<a name="filter" id="filter"></a>
<a name="filter" id="filter"></a>
### `filter()`

Adds the processed metrics. See [AddColumnsProcessedMetrics](/api-reference/Piwik/DataTable/Filter/AddColumnsProcessedMetrics) for
more information.

#### Signature

-  It accepts the following parameter(s):
    - `$table` (`Piwik\DataTable\DataTable`) &mdash;
      
- It does not return anything or a mixed result.

<a name="enablerecursive" id="enablerecursive"></a>
<a name="enableRecursive" id="enableRecursive"></a>
### `enableRecursive()`

Enables/Disables recursive filtering. Whether this property is actually used
is up to the derived BaseFilter class.

#### Signature

-  It accepts the following parameter(s):
    - `$enable` (`bool`) &mdash;
      
- It does not return anything or a mixed result.

<a name="filtersubtable" id="filtersubtable"></a>
<a name="filterSubTable" id="filterSubTable"></a>
### `filterSubTable()`

Filters a row's subtable, if one exists and is loaded in memory.

#### Signature

-  It accepts the following parameter(s):
    - `$row` ([`Row`](../../../Piwik/DataTable/Row.md)) &mdash;
       The row whose subtable should be filter.
- It does not return anything or a mixed result.

