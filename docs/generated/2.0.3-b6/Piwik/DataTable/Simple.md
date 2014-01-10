<small>Piwik\DataTable\</small>

Simple
======

A [DataTable](/api-reference/Piwik/DataTable) where every row has two columns: **label** and **value**.

Simple DataTables are only used to slightly alter the output of some renderers
(notably the XML renderer).

Methods
-------

The class defines the following methods:

- [`addRowsFromArray()`](#addrowsfromarray) &mdash; Adds rows based on an array mapping label column values to value column values.

<a name="addrowsfromarray" id="addrowsfromarray"></a>
<a name="addRowsFromArray" id="addRowsFromArray"></a>
### `addRowsFromArray()`

Adds rows based on an array mapping label column values to value column values.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$array` (`array`) &mdash;

      <div markdown="1" class="param-desc"> Array containing the rows, eg,  array( 'Label row 1' => $value1, 'Label row 2' => $value2, )</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

