<small>Piwik\DataTable\Filter\</small>

GroupBy
=======

DataTable filter that will group DataTable rows together based on the results of a reduce function.

_NOTE: This filter should never be queued, it must be applied directly on a DataTable._

**Basic usage example**

    // group URLs by host
    $dataTable->filter('GroupBy', array('label', function ($labelUrl) {
        return parse_url($labelUrl, PHP_URL_HOST);
    }));

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`filter()`](#filter) &mdash; See GroupBy.
- [`enableRecursive()`](#enablerecursive) &mdash; Enables/Disables recursive filtering. Inherited from [`BaseFilter`](../../../Piwik/DataTable/BaseFilter.md)
- [`filterSubTable()`](#filtersubtable) &mdash; Filters a row's subtable, if one exists and is loaded in memory. Inherited from [`BaseFilter`](../../../Piwik/DataTable/BaseFilter.md)

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

-  It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md)) &mdash;
      
    - `$groupByColumn` (`string`) &mdash;
       The column name to reduce.
    - `$reduceFunction` (`callable`) &mdash;
       The reduce function. This must alter the `$groupByColumn` column in some way. If not set then the filter will group by the raw column value.
    - `$parameters` (`array`) &mdash;
       deprecated - use an [anonymous function](http://php.net/manual/en/functions.anonymous.php) instead.

<a name="filter" id="filter"></a>
<a name="filter" id="filter"></a>
### `filter()`

See GroupBy.

#### Signature

-  It accepts the following parameter(s):
    - `$table` (`Stmt_Namespace\DataTable`) &mdash;
      
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

