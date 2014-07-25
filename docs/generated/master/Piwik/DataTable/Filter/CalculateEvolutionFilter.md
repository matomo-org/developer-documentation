<small>Piwik\DataTable\Filter\</small>

CalculateEvolutionFilter
========================

A DataTable filter that calculates the evolution of a metric and adds it to each row as a percentage.

**This filter cannot be used as an argument to [DataTable::filter()](/api-reference/Piwik/DataTable#filter)** since
it requires corresponding data from another DataTable. Instead,
you must manually perform a binary filter (see the **MultiSites** API for an
example).

The evolution metric is calculated as:

    ((currentValue - pastValue) / pastValue) * 100

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`calculate()`](#calculate) &mdash; Calculates the evolution percentage for two arbitrary values.
- [`appendPercentSign()`](#appendpercentsign)
- [`prependPlusSignToNumber()`](#prependplussigntonumber)

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

      <div markdown="1" class="param-desc"> The DataTable being filtered.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$pastDataTable` ([`DataTable`](../../../Piwik/DataTable.md)) &mdash;

      <div markdown="1" class="param-desc"> The DataTable containing data for the period in the past.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$columnToAdd` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The column to add evolution data to, eg, `'visits_evolution'`.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$columnToRead` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The column to use to calculate evolution data, eg, `'nb_visits'`.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$quotientPrecision` (`int`) &mdash;

      <div markdown="1" class="param-desc"> The precision to use when rounding the evolution value.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<a name="calculate" id="calculate"></a>
<a name="calculate" id="calculate"></a>
### `calculate()` 
Calculates the evolution percentage for two arbitrary values.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$currentValue` (`float`|`int`) &mdash;

      <div markdown="1" class="param-desc"> The current metric value.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$pastValue` (`float`|`int`) &mdash;

      <div markdown="1" class="param-desc"> The value of the metric in the past. We measure the % change from this value to $currentValue.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$quotientPrecision` (`float`|`int`) &mdash;

      <div markdown="1" class="param-desc"> The quotient precision to round to.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$appendPercentSign` (`bool`) &mdash;

      <div markdown="1" class="param-desc"> Whether to append a '%' sign to the end of the number or not.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`string`) &mdash;
    <div markdown="1" class="param-desc">The evolution percent, eg `'15%'`.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="appendpercentsign" id="appendpercentsign"></a>
<a name="appendPercentSign" id="appendPercentSign"></a>
### `appendPercentSign()` 
#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$number`

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="prependplussigntonumber" id="prependplussigntonumber"></a>
<a name="prependPlusSignToNumber" id="prependPlusSignToNumber"></a>
### `prependPlusSignToNumber()` 
#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$number`

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

