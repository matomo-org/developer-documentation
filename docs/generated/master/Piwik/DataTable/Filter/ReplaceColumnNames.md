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

    // filter use in a plugin's API method
    public function getMyReport($idSite, $period, $date, $segment = false, $expanded = false)
    {
        $dataTable = Archive::getDataTableFromArchive('MyPlugin_MyReport', $idSite, $period, $date, $segment, $expanded);
        $dataTable->queueFilter('ReplaceColumnNames');
        return $dataTable;
    }


Properties
----------

This class defines the following properties:

- [`$mappingToApply`](#$mappingtoapply)

<a name="mappingtoapply" id="mappingtoapply"></a>
### `$mappingToApply`

#### Signature

- Its type is not specified.


Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`filter()`](#filter) &mdash; See [ReplaceColumnNames](#).
- [`filterTable()`](#filtertable)
- [`filterSimple()`](#filtersimple)
- [`getRenamedColumn()`](#getrenamedcolumn)
- [`getRenamedColumns()`](#getrenamedcolumns) &mdash; Checks the given columns and renames them if required
- [`flattenGoalColumns()`](#flattengoalcolumns)

<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

- It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md))
    - `$mappingToApply`
- It does not return anything.

<a name="filter" id="filter"></a>
### `filter()`

See [ReplaceColumnNames](#).

#### Signature

- It accepts the following parameter(s):
    - `$table`
- It does not return anything.

<a name="filtertable" id="filtertable"></a>
### `filterTable()`

#### Signature

- It accepts the following parameter(s):
    - `$table`
- It does not return anything.

<a name="filtersimple" id="filtersimple"></a>
### `filterSimple()`

#### Signature

- It accepts the following parameter(s):
    - `$table` ([`Simple`](../../../Piwik/DataTable/Simple.md))
- It does not return anything.

<a name="getrenamedcolumn" id="getrenamedcolumn"></a>
### `getRenamedColumn()`

#### Signature

- It accepts the following parameter(s):
    - `$column`
- It does not return anything.

<a name="getrenamedcolumns" id="getrenamedcolumns"></a>
### `getRenamedColumns()`

Checks the given columns and renames them if required

#### Signature

- It accepts the following parameter(s):
    - `$columns`
- It returns a(n) `array` value.

<a name="flattengoalcolumns" id="flattengoalcolumns"></a>
### `flattenGoalColumns()`

#### Signature

- It accepts the following parameter(s):
    - `$columnValue`
- It returns a(n) `array` value.

