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
- [`getPatternQuoted()`](#getPatternQuoted) &mdash; Helper method to return the given pattern quoted
- [`match()`](#match) &mdash; Performs case insensitive match
- [`filter()`](#filter) &mdash; See [Pattern](#).

### `__construct()` <a name="__construct"></a>

Constructor.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md))
    - `$columnToFilter`
    - `$patternToSearch`
    - `$invertedMatch`
- It does not return anything.

### `getPatternQuoted()` <a name="getPatternQuoted"></a>

Helper method to return the given pattern quoted

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$pattern`
- It returns a(n) `string` value.

### `match()` <a name="match"></a>

Performs case insensitive match

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$pattern`
    - `$patternQuoted`
    - `$string`
    - `$invertedMatch`
- It returns a(n) `int` value.

### `filter()` <a name="filter"></a>

See [Pattern](#).

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$table`
- It does not return anything.

