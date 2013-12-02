<small>Piwik\DataTable\Filter</small>

PatternRecursive
================

Deletes rows for which a specific column in both the row and all subtables that descend from the row do not match a supplied regex pattern.

Description
-----------

**Example**

    // only display index pageviews in Actions.getPageUrls
    $dataTable->filter('PatternRecursive', array('label', 'index'));

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`filter()`](#filter) &mdash; See [PatternRecursive](/api-reference/Piwik/DataTable/Filter/PatternRecursive).

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

- It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md)) &mdash; The table to eventually filter.
    - `$columnToFilter` (`string`) &mdash; The column to match with the `$patternToSearch` pattern.
    - `$patternToSearch` (`string`) &mdash; The regex pattern to use.

<a name="filter" id="filter"></a>
<a name="filter" id="filter"></a>
### `filter()`

See [PatternRecursive](/api-reference/Piwik/DataTable/Filter/PatternRecursive).

#### Signature

- It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md))
- _Returns:_ The number of deleted rows.
    - `int`

