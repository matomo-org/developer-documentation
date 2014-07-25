<small>Piwik\</small>

MetricsFormatter
================

Contains helper function that format numerical values in different ways.

Methods
-------

The class defines the following methods:

- [`getPrettyNumber()`](#getprettynumber) &mdash; Returns a prettified string representation of a number.
- [`getPrettyTimeFromSeconds()`](#getprettytimefromseconds) &mdash; Returns a prettified time value (in seconds).
- [`getPrettySizeFromBytes()`](#getprettysizefrombytes) &mdash; Returns a prettified memory size value.
- [`getPrettyMoney()`](#getprettymoney) &mdash; Returns a pretty formated monetary value using the currency associated with a site.
- [`getPrettyValue()`](#getprettyvalue) &mdash; Prettifies a metric value based on the column name.
- [`getCurrencySymbol()`](#getcurrencysymbol) &mdash; Returns the currency symbol for a site.
- [`getCurrencyList()`](#getcurrencylist) &mdash; Returns the list of all known currency symbols.

<a name="getprettynumber" id="getprettynumber"></a>
<a name="getPrettyNumber" id="getPrettyNumber"></a>
### `getPrettyNumber() `
Returns a prettified string representation of a number.

The result will have
thousands separators and a decimal point specific to the current locale, eg,
`'1,000,000.05'` or `'1.000.000,05'`.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$value` (`Piwik\number`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It returns a `string` value.

<a name="getprettytimefromseconds" id="getprettytimefromseconds"></a>
<a name="getPrettyTimeFromSeconds" id="getPrettyTimeFromSeconds"></a>
### `getPrettyTimeFromSeconds() `
Returns a prettified time value (in seconds).

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$numberOfSeconds` (`int`) &mdash;

      <div markdown="1" class="param-desc"> The number of seconds.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$displayTimeAsSentence` (`bool`) &mdash;

      <div markdown="1" class="param-desc"> If set to true, will output `"5min 17s"`, if false `"00:05:17"`.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$isHtml` (`bool`) &mdash;

      <div markdown="1" class="param-desc"> If true, replaces all spaces with `'&nbsp;'`.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$round` (`bool`) &mdash;

      <div markdown="1" class="param-desc"> Whether to round to the nearest second or not.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It returns a `string` value.

<a name="getprettysizefrombytes" id="getprettysizefrombytes"></a>
<a name="getPrettySizeFromBytes" id="getPrettySizeFromBytes"></a>
### `getPrettySizeFromBytes() `
Returns a prettified memory size value.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$size` (`Piwik\number`) &mdash;

      <div markdown="1" class="param-desc"> The size in bytes.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$unit` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The specific unit to use, if any. If null, the unit is determined by $size.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$precision` (`int`) &mdash;

      <div markdown="1" class="param-desc"> The precision to use when rounding.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`string`) &mdash;
    <div markdown="1" class="param-desc">eg, `'128 M'` or `'256 K'`.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="getprettymoney" id="getprettymoney"></a>
<a name="getPrettyMoney" id="getPrettyMoney"></a>
### `getPrettyMoney() `
Returns a pretty formated monetary value using the currency associated with a site.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$value` (`int`|`string`) &mdash;

      <div markdown="1" class="param-desc"> The monetary value to format.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$idSite` (`int`) &mdash;

      <div markdown="1" class="param-desc"> The ID of the site whose currency will be used.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$isHtml` (`bool`) &mdash;

      <div markdown="1" class="param-desc"> If true, replaces all spaces with `'&nbsp;'`.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It returns a `string` value.

<a name="getprettyvalue" id="getprettyvalue"></a>
<a name="getPrettyValue" id="getPrettyValue"></a>
### `getPrettyValue() `
Prettifies a metric value based on the column name.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$idSite` (`int`) &mdash;

      <div markdown="1" class="param-desc"> The ID of the site the metric is for (used if the column value is an amount of money).</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$columnName` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The metric name.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$value` (`mixed`) &mdash;

      <div markdown="1" class="param-desc"> The metric value.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$isHtml` (`bool`) &mdash;

      <div markdown="1" class="param-desc"> If true, replaces all spaces with `'&nbsp;'`.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It returns a `string` value.

<a name="getcurrencysymbol" id="getcurrencysymbol"></a>
<a name="getCurrencySymbol" id="getCurrencySymbol"></a>
### `getCurrencySymbol() `
Returns the currency symbol for a site.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$idSite` (`int`) &mdash;

      <div markdown="1" class="param-desc"> The ID of the site to return the currency symbol for.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`string`) &mdash;
    <div markdown="1" class="param-desc">eg, `'$'`.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="getcurrencylist" id="getcurrencylist"></a>
<a name="getCurrencyList" id="getCurrencyList"></a>
### `getCurrencyList() `
Returns the list of all known currency symbols.

#### Signature


<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`array`) &mdash;
    <div markdown="1" class="param-desc">An array mapping currency codes to their respective currency symbols and a description, eg, `array('USD' => array('$', 'US dollar'))`.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

