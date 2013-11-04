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

### `__construct()` <a name="__construct"></a>

Constructor.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md))
    - `$groupByColumn`
    - `$reduceFunction`
    - `$parameters`
- It does not return anything.

### `filter()` <a name="filter"></a>

See [GroupBy](#).

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$table`
- It does not return anything.

