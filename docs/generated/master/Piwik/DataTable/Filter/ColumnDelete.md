<small>Piwik\DataTable\Filter</small>

ColumnDelete
============

Filter that will remove columns from a DataTable using either a blacklist, whitelist or both.

Description
-----------

This filter is used to handle the **hideColumn** and **showColumn** query parameters.

**Basic usage example**

    $columnsToRemove = array('nb_hits', 'nb_pageviews');
    $dataTable->filter('ColumnDelete', array($columnsToRemove));

    $columnsToKeep = array('nb_visits');
    $dataTable->filter('ColumnDelete', array(array(), $columnsToKeep));


Constants
---------

This class defines the following constants:

- [`APPEND_TO_COLUMN_NAME_TO_KEEP`](#APPEND_TO_COLUMN_NAME_TO_KEEP) &mdash; Hack: when specifying "showColumns", sometimes we'd like to also keep columns that "look" like a given column, without manually specifying all these columns (which may not be possible if column names are generated dynamically)

<a name="append_to_column_name_to_keep" id="append_to_column_name_to_keep"></a>
### `APPEND_TO_COLUMN_NAME_TO_KEEP`

Column will be kept, if they match any name in the $columnsToKeep, or if they look like anyColumnToKeep__anythingHere

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`filter()`](#filter) &mdash; Filters the given DataTable.

<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

- It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md))
    - `$columnsToRemove`
    - `$columnsToKeep`
    - `$deleteIfZeroOnly`
- It does not return anything.

<a name="filter" id="filter"></a>
### `filter()`

Filters the given DataTable.

#### Description

Removes columns that are not desired from
each DataTable row.

#### Signature

- It accepts the following parameter(s):
    - `$table`
- It does not return anything.

