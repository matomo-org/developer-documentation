<small>Piwik\DataTable\Filter</small>

ReplaceColumnNames
==================

Replaces column names in each row of a table using an array that maps old column names new ones.

Description
-----------

If no mapping is provided, this column will use one that maps index metric names
(which are integers) with their string column names. In the database, reports are
stored with integer metric names because it results in blobs that take up less space.
When loading the reports, the column names must be replaced, which is handled by this
class. (See [Metrics](#) for more information about integer metric names.)

**Basic example**

    // filter use in a plugin&#039;s API method
    public function getMyReport($idSite, $period, $date, $segment = false, $expanded = false)
    {
        $dataTable = Archive::getDataTableFromArchive(&#039;MyPlugin_MyReport&#039;, $idSite, $period, $date, $segment, $expanded);
        $dataTable-&gt;queueFilter(&#039;ReplaceColumnNames&#039;);
        return $dataTable;
    }


Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`filter()`](#filter) &mdash; See [ReplaceColumnNames](#).

### `__construct()` <a name="__construct"></a>

Constructor.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md))
    - `$mappingToApply`
- It does not return anything.

### `filter()` <a name="filter"></a>

See [ReplaceColumnNames](#).

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$table`
- It does not return anything.

