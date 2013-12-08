<small>Piwik\DataTable\Filter\</small>

Sort
====

Sorts a DataTable based on the value of a specific column.

It is possible to specify a natural sorting (see [php.net/natsort](http://php.net/natsort) for details).

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`setOrder()`](#setorder) &mdash; Updates the order
- [`sort()`](#sort) &mdash; Sorting method used for sorting numbers
- [`naturalSort()`](#naturalsort) &mdash; Sorting method used for sorting values natural
- [`sortString()`](#sortstring) &mdash; Sorting method used for sorting values
- [`filter()`](#filter) &mdash; See [Sort](/api-reference/Piwik/DataTable/Filter/Sort).

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

      <div markdown="1" class="param-desc"> The table to eventually filter.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$columnToSort` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The name of the column to sort by.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$order` (`string`) &mdash;

      <div markdown="1" class="param-desc"> order `'asc'` or `'desc'`.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$naturalSort` (`bool`) &mdash;

      <div markdown="1" class="param-desc"> Whether to use a natural sort or not (see [http://php.net/natsort](http://php.net/natsort)).</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$recursiveSort` (`bool`) &mdash;

      <div markdown="1" class="param-desc"> Whether to sort all subtables or not.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<a name="setorder" id="setorder"></a>
<a name="setOrder" id="setOrder"></a>
### `setOrder()`

Updates the order

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$order` (`string`) &mdash;

      <div markdown="1" class="param-desc"> asc|desc</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="sort" id="sort"></a>
<a name="sort" id="sort"></a>
### `sort()`

Sorting method used for sorting numbers

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$a` (`Piwik\DataTable\Filter\number`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$b` (`Piwik\DataTable\Filter\number`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It returns a `int` value.

<a name="naturalsort" id="naturalsort"></a>
<a name="naturalSort" id="naturalSort"></a>
### `naturalSort()`

Sorting method used for sorting values natural

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$a` (`mixed`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$b` (`mixed`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It returns a `int` value.

<a name="sortstring" id="sortstring"></a>
<a name="sortString" id="sortString"></a>
### `sortString()`

Sorting method used for sorting values

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$a` (`mixed`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$b` (`mixed`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It returns a `int` value.

<a name="filter" id="filter"></a>
<a name="filter" id="filter"></a>
### `filter()`

See [Sort](/api-reference/Piwik/DataTable/Filter/Sort).

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$table` ([`DataTable`](../../../Piwik/DataTable.md)) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It returns a `mixed` value.

