<small>Piwik\DataTable\Filter</small>

MetadataCallbackReplace
=======================

Execute a callback for each row of a DataTable using certain column values and metadata and replaces row metadata with the result.

Description
-----------

**Basic usage example**

    $dataTable->filter('MetadataCallbackReplace', array('url', function ($url) {
        return $url . '#index';
    }));


Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`setElementToReplace()`](#setelementtoreplace)
- [`getElementToReplace()`](#getelementtoreplace)

<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

- It accepts the following parameter(s):
    - `$table`
    - `$metadataToFilter`
    - `$functionToApply`
    - `$functionParameters`
    - `$extraColumnParameters`
- It does not return anything.

<a name="setelementtoreplace" id="setelementtoreplace"></a>
### `setElementToReplace()`

#### Signature

- It accepts the following parameter(s):
    - `$row`
    - `$metadataToFilter`
    - `$newValue`
- It does not return anything.

<a name="getelementtoreplace" id="getelementtoreplace"></a>
### `getElementToReplace()`

#### Signature

- It accepts the following parameter(s):
    - `$row`
    - `$metadataToFilter`
- It can return one of the following values:
    - `array`
    - `bool`
    - `mixed`

