<small>Piwik\</small>

RankingQuery
============

The ranking query class wraps an arbitrary SQL query with more SQL that limits the number of results while aggregating the rest in an a new "Others" row.

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
- [`setLimit()`](#setlimit) &mdash; Set the limit after which everything is grouped to "Others".
- [`setOthersLabel()`](#setotherslabel) &mdash; Set the value to use for the label in the 'Others' row.
- [`addLabelColumn()`](#addlabelcolumn) &mdash; Add a label column.
- [`getLabelColumns()`](#getlabelcolumns)
- [`addColumn()`](#addcolumn) &mdash; Add a column that has be added to the outer queries.
- [`setColumnToMarkExcludedRows()`](#setcolumntomarkexcludedrows) &mdash; Sets a column that will be used to filter the result into two categories.
- [`partitionResultIntoMultipleGroups()`](#partitionresultintomultiplegroups) &mdash; This method can be used to partition the result based on the possible values of one table column.
- [`execute()`](#execute) &mdash; Executes the query.
- [`generateRankingQuery()`](#generaterankingquery) &mdash; Generate the SQL code that does the magic.

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

-  It accepts the following parameter(s):
    - `$limit` (`int`|`false`) &mdash;
       The result row limit. See [setLimit()](/api-reference/Piwik/RankingQuery#setlimit).

<a name="setlimit" id="setlimit"></a>
<a name="setLimit" id="setLimit"></a>
### `setLimit()`

Set the limit after which everything is grouped to "Others".

#### Signature

-  It accepts the following parameter(s):
    - `$limit` (`int`) &mdash;
      
- It does not return anything or a mixed result.

<a name="setotherslabel" id="setotherslabel"></a>
<a name="setOthersLabel" id="setOthersLabel"></a>
### `setOthersLabel()`

Set the value to use for the label in the 'Others' row.

#### Signature

-  It accepts the following parameter(s):
    - `$value` (`string`) &mdash;
      
- It does not return anything or a mixed result.

<a name="addlabelcolumn" id="addlabelcolumn"></a>
<a name="addLabelColumn" id="addLabelColumn"></a>
### `addLabelColumn()`

Add a label column.

Labels are the columns that are replaced with "Others" after the limit.

#### Signature

-  It accepts the following parameter(s):
    - `$labelColumn` (`string`|`array`) &mdash;
      
- It does not return anything or a mixed result.

<a name="getlabelcolumns" id="getlabelcolumns"></a>
<a name="getLabelColumns" id="getLabelColumns"></a>
### `getLabelColumns()`

#### Signature

- It returns a `array` value.

<a name="addcolumn" id="addcolumn"></a>
<a name="addColumn" id="addColumn"></a>
### `addColumn()`

Add a column that has be added to the outer queries.

#### Signature

-  It accepts the following parameter(s):
    - `$column`
      
    - `$aggregationFunction` (`string`|`bool`) &mdash;
       If set, this function is used to aggregate the values of "Others", eg, `'min'`, `'max'` or `'sum'`.
- It does not return anything or a mixed result.

<a name="setcolumntomarkexcludedrows" id="setcolumntomarkexcludedrows"></a>
<a name="setColumnToMarkExcludedRows" id="setColumnToMarkExcludedRows"></a>
### `setColumnToMarkExcludedRows()`

Sets a column that will be used to filter the result into two categories.

Rows where this column has a value > 0 will be removed from the result and put
into another array. Both the result and the array of excluded rows are returned
by [execute()](/api-reference/Piwik/RankingQuery#execute).

#### Signature

-  It accepts the following parameter(s):
    - `$column`
       string Name of the column.
- It does not return anything or a mixed result.
- It throws one of the following exceptions:
    - `Stmt_Namespace\Exception` &mdash; if method is used more than once.

<a name="partitionresultintomultiplegroups" id="partitionresultintomultiplegroups"></a>
<a name="partitionResultIntoMultipleGroups" id="partitionResultIntoMultipleGroups"></a>
### `partitionResultIntoMultipleGroups()`

This method can be used to partition the result based on the possible values of one
table column. This means the query will split the result set into other sets of rows
for each possible value you provide (where the rows of each set have a column value
that equals a possible value). Each of these new sets of rows will be individually
limited resulting in several limited result sets.

For example, you can run a query aggregating some data on the log_action table and
partition by log_action.type with the possible values of Piwik\Tracker\Action::TYPE\_PAGE\_URL,
Piwik\Tracker\Action::TYPE\_OUTLINK, Piwik\Tracker\Action::TYPE\_DOWNLOAD.
The result will be three separate result sets that are aggregated the same ways, but for rows
where `log_action.type = TYPE_OUTLINK`, for rows where `log_action.type = TYPE_ACTION_URL` and for
rows `log_action.type = TYPE_DOWNLOAD`.

#### Signature

-  It accepts the following parameter(s):
    - `$partitionColumn`
       string The column name to partition by.
    - `$possibleValues`
       Array of possible column values.
- It does not return anything or a mixed result.
- It throws one of the following exceptions:
    - `Stmt_Namespace\Exception` &mdash; if method is used more than once.

<a name="execute" id="execute"></a>
<a name="execute" id="execute"></a>
### `execute()`

Executes the query.

The object has to be configured first using the other methods.

#### Signature

-  It accepts the following parameter(s):
    - `$innerQuery`
       string The "payload" query that does the actual data aggregation. The ordering has to be specified in this query. RankingQuery cannot apply ordering itself.
    - `$bind`
       array Bindings for the inner query.
    - `$timeLimitInMs` (`int`) &mdash;
       Adds a MAX_EXECUTION_TIME query hint to the query if $timeLimitInMs > 0

- *Returns:*  `array` &mdash;
    The format depends on which methods have been used
                           to configure the ranking query.

<a name="generaterankingquery" id="generaterankingquery"></a>
<a name="generateRankingQuery" id="generateRankingQuery"></a>
### `generateRankingQuery()`

Generate the SQL code that does the magic.

If you want to get the result, use execute() instead. If you want to run the query
yourself, use this method.

#### Signature

-  It accepts the following parameter(s):
    - `$innerQuery`
       string The "payload" query that does the actual data aggregation. The ordering has to be specified in this query. RankingQuery cannot apply ordering itself.

- *Returns:*  `string` &mdash;
    The entire ranking query SQL.

