<small>Piwik\DataTable\Filter\</small>

ReplaceColumnNames
==================

Replaces column names in each row of a table using an array that maps old column names new ones.

If no mapping is provided, this column will use one that maps index metric names
(which are integers) with their string column names. In the database, reports are
stored with integer metric names because it results in blobs that take up less space.
When loading the reports, the column names must be replaced, which is handled by this
class. (See [Metrics](/api-reference/Piwik/Metrics) for more information about integer metric names.)

**Basic example**

    // filter use in a plugin's API method
    public function getMyReport($idSite, $period, $date, $segment = false, $expanded = false)
    {
        $dataTable = Archive::getDataTableFromArchive('MyPlugin_MyReport', $idSite, $period, $date, $segment, $expanded);
        $dataTable->queueFilter('ReplaceColumnNames');
        return $dataTable;
    }

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`filter()`](#filter) &mdash; See [ReplaceColumnNames](/api-reference/Piwik/DataTable/Filter/ReplaceColumnNames).
- [`enableRecursive()`](#enablerecursive) &mdash; Enables/Disables recursive filtering.
- [`filterSubTable()`](#filtersubtable) &mdash; Filters a row's subtable, if one exists and is loaded in memory.

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()` 
Constructor.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$table` ([`DataTable`](../../../Piwik/DataTable.md)) &mdash;

      <div markdown="1" class="param-desc"> The table that will be eventually filtered.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$mappingToApply` (`array`|`null`) &mdash;

      <div markdown="1" class="param-desc"> The name mapping to apply. Must map old column names with new ones, eg, array('OLD_COLUMN_NAME' => 'NEW_COLUMN NAME', 'OLD_COLUMN_NAME2' => 'NEW_COLUMN NAME2') If null, [Metrics::$mappingFromIdToName](/api-reference/Piwik/Metrics#$mappingfromidtoname) is used.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<a name="filter" id="filter"></a>
<a name="filter" id="filter"></a>
### `filter()` 
See [ReplaceColumnNames](/api-reference/Piwik/DataTable/Filter/ReplaceColumnNames).

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$table` ([`DataTable`](../../../Piwik/DataTable.md)) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="enablerecursive" id="enablerecursive"></a>
<a name="enableRecursive" id="enableRecursive"></a>
### `enableRecursive()` *inherited from [`BaseFilter`](../../../Piwik/DataTable/BaseFilter.md)*
Enables/Disables recursive filtering.

Whether this property is actually used
is up to the derived BaseFilter class.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$enable` (`bool`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="filtersubtable" id="filtersubtable"></a>
<a name="filterSubTable" id="filterSubTable"></a>
### `filterSubTable()` *inherited from [`BaseFilter`](../../../Piwik/DataTable/BaseFilter.md)*
Filters a row's subtable, if one exists and is loaded in memory.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$row` ([`Row`](../../../Piwik/DataTable/Row.md)) &mdash;

      <div markdown="1" class="param-desc"> The row whose subtable should be filter.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

