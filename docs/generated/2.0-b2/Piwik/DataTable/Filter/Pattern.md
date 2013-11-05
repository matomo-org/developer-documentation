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
- [`getPatternQuoted()`](#getpatternquoted) &mdash; Helper method to return the given pattern quoted
- [`match()`](#match) &mdash; Performs case insensitive match
- [`filter()`](#filter) &mdash; See [Pattern](#).

<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

- It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md))
    - `$columnToFilter`
    - `$patternToSearch`
    - `$invertedMatch`
- It does not return anything.

<a name="getpatternquoted" id="getpatternquoted"></a>
### `getPatternQuoted()`

Helper method to return the given pattern quoted

#### Signature

- It accepts the following parameter(s):
    - `$pattern`
- It returns a(n) `string` value.

<a name="match" id="match"></a>
### `match()`

Performs case insensitive match

#### Signature

- It accepts the following parameter(s):
    - `$pattern`
    - `$patternQuoted`
    - `$string`
    - `$invertedMatch`
- It returns a(n) `int` value.

<a name="filter" id="filter"></a>
### `filter()`

See [Pattern](#).

#### Signature

- It accepts the following parameter(s):
    - `$table`
- It does not return anything.

