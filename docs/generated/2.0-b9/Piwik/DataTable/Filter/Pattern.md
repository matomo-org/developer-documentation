<small>Piwik\DataTable\Filter</small>

Pattern
=======

Deletes every row for which a specific column does not match a supplied regex pattern.

Description
-----------

**Example**

    // filter out all rows whose labels doesn't start with piwik
    $dataTable->filter('Pattern', array('label', '^piwik'));

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`filter()`](#filter) &mdash; See [Pattern](#).

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

- It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md)) &mdash; The table to eventually filter.
    - `$columnToFilter` (`string`) &mdash; The column to match with the `$patternToSearch` pattern.
    - `$patternToSearch` (`string`) &mdash; The regex pattern to use.
    - `$invertedMatch` (`bool`) &mdash; Whether to invert the pattern or not. If true, will remove rows if they match the pattern.

<a name="filter" id="filter"></a>
<a name="filter" id="filter"></a>
### `filter()`

See [Pattern](#).

#### Signature

- It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md))
- It does not return anything.

