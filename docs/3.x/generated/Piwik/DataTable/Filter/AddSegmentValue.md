<small>Piwik\DataTable\Filter\</small>

AddSegmentValue
===============

Executes a filter for each row of a DataTable and generates a segment filter for each row.

**Basic usage example**

    $dataTable->filter('AddSegmentValue', array());
    $dataTable->filter('AddSegmentValue', array(function ($label) {
       $transformedValue = urldecode($transformedValue);
       return $transformedValue;
   });

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`filter()`](#filter) &mdash; See [ColumnCallbackAddMetadata](/api-reference/Piwik/DataTable/Filter/ColumnCallbackAddMetadata). Inherited from [`ColumnCallbackAddMetadata`](../../../Piwik/DataTable/Filter/ColumnCallbackAddMetadata.md)

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

-  It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md)) &mdash;
       The DataTable instance that will be filtered.
    - `$callback`
      

<a name="filter" id="filter"></a>
<a name="filter" id="filter"></a>
### `filter()`

See [ColumnCallbackAddMetadata](/api-reference/Piwik/DataTable/Filter/ColumnCallbackAddMetadata).

#### Signature

-  It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md)) &mdash;
      
- It does not return anything.

