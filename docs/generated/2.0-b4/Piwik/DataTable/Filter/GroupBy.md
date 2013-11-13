<small>Piwik\DataTable\Filter</small>

GroupBy
=======

DataTable filter that will group DataTable rows together based on the results of a reduce function.

Description
-----------

Rows with the same reduce result will be summed and merged.

NOTE: This filter should never be queued, it must be applied directly on a DataTable.

**Basic usage example**

    // group URLs by host
    $dataTable->filter('GroupBy', array('label', function ($labelUrl) {
        return parse_url($labelUrl, PHP_URL_HOST);
    }));

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`filter()`](#filter) &mdash; See [GroupBy](#).

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

- It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md)) &mdash; The DataTable to filter.
    - `$groupByColumn` (`string`) &mdash; The column name to reduce.
    - `$reduceFunction` (`callable`) &mdash; The reduce function. This must alter the `$groupByColumn` columng in some way.
    - `$parameters` (`array`) &mdash; deprecated - use an [anonymous function](http://php.net/manual/en/functions.anonymous.php) instead.

<a name="filter" id="filter"></a>
<a name="filter" id="filter"></a>
### `filter()`

See [GroupBy](#).

#### Signature

- It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md))
- It does not return anything.

