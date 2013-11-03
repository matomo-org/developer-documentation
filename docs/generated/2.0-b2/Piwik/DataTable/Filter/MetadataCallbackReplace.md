<small>Piwik\DataTable\Filter</small>

MetadataCallbackReplace
=======================

Execute a callback for each row of a DataTable using certain column values and metadata and replaces row metadata with the result.

Description
-----------

**Basic usage example**

    $dataTable-&gt;filter(&#039;MetadataCallbackReplace&#039;, array(&#039;url&#039;, function ($url) {
        return $url . &#039;#index&#039;;
    }));


Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.

### `__construct()` <a name="__construct"></a>

Constructor.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$table`
    - `$metadataToFilter`
    - `$functionToApply`
    - `$functionParameters`
    - `$extraColumnParameters`
- It does not return anything.

