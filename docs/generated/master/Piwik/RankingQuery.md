<small>Piwik</small>

RankingQuery
============

The ranking query class wraps an arbitrary SQL query with more SQL that limits the number of results while grouping the rest to &quot;Others&quot; and allows for some more fancy things that can be configured via method calls of this class.

Description
-----------

The
advanced use cases are explained in the doc comments of the methods.

The general use case looks like this:

    // limit to 500 rows + "Others"
    $rankingQuery = new RankingQuery();
    $rankingQuery->setLimit(500);

    // idaction_url will be "Others" in the row that contains the aggregated rest
    $rankingQuery->addLabelColumn('idaction_url');

    // the actual query. it's important to sort it before the limit is applied
    $sql = 'SELECT idaction_url, COUNT(*) AS nb_hits
            FROM log_link_visit_action
            GROUP BY idaction_url
            ORDER BY nb_hits DESC';

    // execute the query
    $rankingQuery->execute($sql);

For more examples, see RankingQueryTest.php


Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`setLimit()`](#setLimit) &mdash; Set the limit after which everything is grouped to "Others".
- [`setOthersLabel()`](#setOthersLabel) &mdash; Set the value to use for the label in the 'Others' row.
- [`addLabelColumn()`](#addLabelColumn) &mdash; Add a label column.
- [`addColumn()`](#addColumn) &mdash; Add a column that has be added to the outer queries.
- [`setColumnToMarkExcludedRows()`](#setColumnToMarkExcludedRows) &mdash; Sets a column that will be used to filter the result into two categories.
- [`partitionResultIntoMultipleGroups()`](#partitionResultIntoMultipleGroups) &mdash; This method can be used to parition the result based on the possible values of one table column.
- [`execute()`](#execute) &mdash; Executes the query.
- [`generateQuery()`](#generateQuery) &mdash; Generate the SQL code that does the magic.

### `__construct()` <a name="__construct"></a>

Constructor.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$limit`
- It does not return anything.

### `setLimit()` <a name="setLimit"></a>

Set the limit after which everything is grouped to "Others".

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$limit`
- It does not return anything.

### `setOthersLabel()` <a name="setOthersLabel"></a>

Set the value to use for the label in the 'Others' row.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$value`
- It does not return anything.

### `addLabelColumn()` <a name="addLabelColumn"></a>

Add a label column.

#### Description

Labels are the columns that are replaced with "Others" after the limit.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$labelColumn`
- It does not return anything.

### `addColumn()` <a name="addColumn"></a>

Add a column that has be added to the outer queries.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$column`
    - `$aggregationFunction`
- It does not return anything.

### `setColumnToMarkExcludedRows()` <a name="setColumnToMarkExcludedRows"></a>

Sets a column that will be used to filter the result into two categories.

#### Description

Rows where this column has a value > 0 will be removed from the result and put
into another array. Both the result and the array of excluded rows are returned
by [execute](#execute).

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$column`
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if method is used more than once.

### `partitionResultIntoMultipleGroups()` <a name="partitionResultIntoMultipleGroups"></a>

This method can be used to parition the result based on the possible values of one table column.

#### Description

This means the query will split the result set into other sets of rows
for each possible value you provide (where the rows of each set have a column value
that equals a possible value). Each of these new sets of rows will be individually
limited resulting in several limited result sets.

For example, you can run a query aggregating some data on the log_action table and
partition by log_action.type with the possible values of [TYPE_ACTION_URL](#),
[TYPE_OUTLINK](#), [TYPE_DOWNLOAD](#). The result will be three separate result sets
that are aggregated the same ways, but for rows where `log_action.type = TYPE_OUTLINK`,
for rows where `log_action.type = TYPE_ACTION_URL` and for rows `log_action.type = TYPE_DOWNLOAD`.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$partitionColumn`
    - `$possibleValues`
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if method is used more than once.

### `execute()` <a name="execute"></a>

Executes the query.

#### Description

The object has to be configured first using the other methods.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$innerQuery`
    - `$bind`
- _Returns:_ The format depends on which methods have been used to configure the ranking query.
    - `array`

### `generateQuery()` <a name="generateQuery"></a>

Generate the SQL code that does the magic.

#### Description

If you want to get the result, use execute() instead. If you want to run the query
yourself, use this method.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$innerQuery`
- _Returns:_ The entire ranking query SQL.
    - `string`

