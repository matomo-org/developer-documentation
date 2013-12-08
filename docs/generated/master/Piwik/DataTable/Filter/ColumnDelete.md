<small>Piwik\DataTable\Filter\</small>

ColumnDelete
============

Filter that will remove columns from a DataTable using either a blacklist, whitelist or both.

This filter is used to handle the **hideColumn** and **showColumn** query parameters.

**Basic usage example**

    $columnsToRemove = array('nb_hits', 'nb_pageviews');
    $dataTable->filter('ColumnDelete', array($columnsToRemove));

    $columnsToKeep = array('nb_visits');
    $dataTable->filter('ColumnDelete', array(array(), $columnsToKeep));

Constants
---------

This class defines the following constants:

- [`APPEND_TO_COLUMN_NAME_TO_KEEP`](#append_to_column_name_to_keep) &mdash; Hack: when specifying "showColumns", sometimes we'd like to also keep columns that "look" like a given column, without manually specifying all these columns (which may not be possible if column names are generated dynamically)

<a name="append_to_column_name_to_keep" id="append_to_column_name_to_keep"></a>
<a name="APPEND_TO_COLUMN_NAME_TO_KEEP" id="APPEND_TO_COLUMN_NAME_TO_KEEP"></a>
### `APPEND_TO_COLUMN_NAME_TO_KEEP`

Column will be kept, if they match any name in the $columnsToKeep, or if they look like anyColumnToKeep__anythingHere

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`filter()`](#filter) &mdash; Filters the given DataTable.

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

      <div markdown="1" class="param-desc"> The DataTable instance that will eventually be filtered.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$columnsToRemove` (`array`|`string`) &mdash;

      <div markdown="1" class="param-desc"> An array of column names or a comma-separated list of column names. These columns will be removed.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$columnsToKeep` (`array`|`string`) &mdash;

      <div markdown="1" class="param-desc"> An array of column names that should be kept or a comma-separated list of column names. Columns not in this list will be removed.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$deleteIfZeroOnly` (`bool`) &mdash;

      <div markdown="1" class="param-desc"> If true, columns will be removed only if their value is 0.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<a name="filter" id="filter"></a>
<a name="filter" id="filter"></a>
### `filter()`

Filters the given DataTable.

Removes columns that are not desired from
each DataTable row.

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

