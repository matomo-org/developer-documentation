<small>Piwik\DataTable</small>

Simple
======

A [DataTable](#) where every row has two columns: **label** and **value**.

Description
-----------

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

- It accepts the following parameter(s):
    - `$array` (`array`) &mdash; Array containing the rows, eg, ``` array( 'Label row 1' => $value1, 'Label row 2' => $value2, ) ```
- It does not return anything.

