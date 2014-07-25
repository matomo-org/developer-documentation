<small>Piwik\DataTable\Filter\</small>

MetadataCallbackReplace
=======================

Execute a callback for each row of a DataTable passing certain column values and metadata as metadata, and replaces row metadata with the callback result.

**Basic usage example**

    $dataTable->filter('MetadataCallbackReplace', array('url', function ($url) {
        return $url . '#index';
    }));

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()` 
Constructor.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$table` ([`DataTable`](../../../Piwik/DataTable.md)) &mdash;

      <div markdown="1" class="param-desc"> The DataTable that will eventually be filtered.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$metadataToFilter` (`array`|`string`) &mdash;

      <div markdown="1" class="param-desc"> The metadata whose values should be passed to the callback and then replaced with the callback's result.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$functionToApply` (`callable`) &mdash;

      <div markdown="1" class="param-desc"> The function to execute. Must take the metadata value as a parameter and return a value that will be used to replace the original.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$functionParameters` (`array`|`null`) &mdash;

      <div markdown="1" class="param-desc"> deprecated - use an [anonymous function](http://php.net/manual/en/functions.anonymous.php) instead.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$extraColumnParameters` (`array`) &mdash;

      <div markdown="1" class="param-desc"> Extra column values that should be passed to the callback, but shouldn't be replaced.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

