<small>Piwik\DataTable\Filter</small>

ColumnDelete
============

Filter that will remove columns from a DataTable using either a blacklist, whitelist or both.

Description
-----------

This filter is used to handle the **hideColumn** and **showColumn** query parameters.

**Basic usage example**

    $columnsToRemove = array(&#039;nb_hits&#039;, &#039;nb_pageviews&#039;);
    $dataTable-&gt;filter(&#039;ColumnDelete&#039;, array($columnsToRemove));

    $columnsToKeep = array(&#039;nb_visits&#039;);
    $dataTable-&gt;filter(&#039;ColumnDelete&#039;, array(array(), $columnsToKeep));


Constants
---------

This class defines the following constants:

- [`APPEND_TO_COLUMN_NAME_TO_KEEP`](#APPEND_TO_COLUMN_NAME_TO_KEEP) &mdash; Hack: when specifying &quot;showColumns&quot;, sometimes we&#039;d like to also keep columns that &quot;look&quot; like a given column, without manually specifying all these columns (which may not be possible if column names are generated dynamically)

### `APPEND_TO_COLUMN_NAME_TO_KEEP` <a name="APPEND_TO_COLUMN_NAME_TO_KEEP"></a>

Column will be kept, if they match any name in the $columnsToKeep, or if they look like anyColumnToKeep__anythingHere

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`filter()`](#filter) &mdash; Filters the given DataTable.

### `__construct()` <a name="__construct"></a>

Constructor.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md))
    - `$columnsToRemove`
    - `$columnsToKeep`
    - `$deleteIfZeroOnly`
- It does not return anything.

### `filter()` <a name="filter"></a>

Filters the given DataTable.

#### Description

Removes columns that are not desired from
each DataTable row.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$table`
- It does not return anything.

