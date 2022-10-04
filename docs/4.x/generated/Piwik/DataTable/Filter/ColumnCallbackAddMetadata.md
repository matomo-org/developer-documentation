<small>Piwik\DataTable\Filter\</small>

ColumnCallbackAddMetadata
=========================

Executes a callback for each row of a DataTable and adds the result as a new row metadata value.

**Basic usage example**

    $dataTable->filter('ColumnCallbackAddMetadata', array('label', 'logo', 'Piwik\Plugins\MyPlugin\getLogoFromLabel'));

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`filter()`](#filter) &mdash; See [ColumnCallbackAddMetadata](/api-reference/Piwik/DataTable/Filter/ColumnCallbackAddMetadata).
- [`enableRecursive()`](#enablerecursive) &mdash; Enables/Disables recursive filtering. Inherited from [`BaseFilter`](../../../Piwik/DataTable/BaseFilter.md)
- [`filterSubTable()`](#filtersubtable) &mdash; Filters a row's subtable, if one exists and is loaded in memory. Inherited from [`BaseFilter`](../../../Piwik/DataTable/BaseFilter.md)

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

-  It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md)) &mdash;
      
    - `$columnsToRead` (`string`|`array`) &mdash;
       The columns to read from each row and pass on to the callback.
    - `$metadataToAdd` (`string`) &mdash;
       The name of the metadata field that will be added to each row.
    - `$functionToApply` (`callable`) &mdash;
       The callback to apply for each row.
    - `$functionParameters` (`array`) &mdash;
       deprecated - use an [anonymous function](http://php.net/manual/en/functions.anonymous.php) instead.
    - `$applyToSummaryRow` (`bool`) &mdash;
       Whether the callback should be applied to the summary row or not.

<a name="filter" id="filter"></a>
<a name="filter" id="filter"></a>
### `filter()`

See [ColumnCallbackAddMetadata](/api-reference/Piwik/DataTable/Filter/ColumnCallbackAddMetadata).

#### Signature

-  It accepts the following parameter(s):
    - `$table` (`Piwik\DataTable\DataTable`) &mdash;
      
- It does not return anything or a mixed result.

<a name="enablerecursive" id="enablerecursive"></a>
<a name="enableRecursive" id="enableRecursive"></a>
### `enableRecursive()`

Enables/Disables recursive filtering. Whether this property is actually used
is up to the derived BaseFilter class.

#### Signature

-  It accepts the following parameter(s):
    - `$enable` (`bool`) &mdash;
      
- It does not return anything or a mixed result.

<a name="filtersubtable" id="filtersubtable"></a>
<a name="filterSubTable" id="filterSubTable"></a>
### `filterSubTable()`

Filters a row's subtable, if one exists and is loaded in memory.

#### Signature

-  It accepts the following parameter(s):
    - `$row` ([`Row`](../../../Piwik/DataTable/Row.md)) &mdash;
       The row whose subtable should be filter.
- It does not return anything or a mixed result.

