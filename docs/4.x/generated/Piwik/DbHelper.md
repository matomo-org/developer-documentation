<small>Piwik\</small>

DbHelper
========

Contains database related helper functions.

Methods
-------

The class defines the following methods:

- [`createTable()`](#createtable) &mdash; Creates a new table in the database.

<a name="createtable" id="createtable"></a>
<a name="createTable" id="createTable"></a>
### `createTable()`

Creates a new table in the database.

Example:
```
$tableDefinition = "`age` INT(11) NOT NULL AUTO_INCREMENT,
                    `name` VARCHAR(255) NOT NULL";

DbHelper::createTable('tablename', $tableDefinition);
``

#### Signature

-  It accepts the following parameter(s):
    - `$nameWithoutPrefix` (`string`) &mdash;
       The name of the table without any piwik prefix.
    - `$createDefinition` (`string`) &mdash;
       The table create definition
- It does not return anything.

