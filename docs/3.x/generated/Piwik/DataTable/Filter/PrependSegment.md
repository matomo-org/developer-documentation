<small>Piwik\DataTable\Filter\</small>

PrependSegment
==============

Executes a callback for each row of a DataTable and prepends each existing segment with the given segment.

**Basic usage example**

    $dataTable->filter('PrependSegment', array('segmentName==segmentValue;'));

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`filter()`](#filter) &mdash; Manipulates a DataTable in some way. Inherited from [`PrependValueToMetadata`](../../../Piwik/DataTable/Filter/PrependValueToMetadata.md)

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

-  It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md)) &mdash;
      
    - `$prependSegment` (`string`) &mdash;
       The segment to prepend if a segment is already defined. Make sure to include A condition, eg the segment should end with ';' or ','

<a name="filter" id="filter"></a>
<a name="filter" id="filter"></a>
### `filter()`

Manipulates a DataTable in some way.

#### Signature

-  It accepts the following parameter(s):
    - `$table` ([`DataTable`](../../../Piwik/DataTable.md)) &mdash;
      
- It does not return anything.

