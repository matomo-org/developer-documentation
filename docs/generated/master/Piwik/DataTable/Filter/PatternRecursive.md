<small>Piwik\DataTable\Filter</small>

PatternRecursive
================

Deletes rows for which a specific column in both the row and all subtables that descend from the row do not match a supplied regex pattern.

Description
-----------

**Example**

    // only display index pageviews in Actions.getPageUrls
    $dataTable-&gt;filter(&#039;PatternRecursive&#039;, array(&#039;label&#039;, &#039;index&#039;));


Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`filter()`](#filter) &mdash; See [PatternRecursive](#).

### `__construct()` <a name="__construct"></a>

Constructor.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md))
    - `$columnToFilter`
    - `$patternToSearch`
- It does not return anything.

### `filter()` <a name="filter"></a>

See [PatternRecursive](#).

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$table`
- _Returns:_ The number of deleted rows.
    - `int`

