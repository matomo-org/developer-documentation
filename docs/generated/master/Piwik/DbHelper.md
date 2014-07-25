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

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$nameWithoutPrefix` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The name of the table without any piwik prefix.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$createDefinition` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The table create definition</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

