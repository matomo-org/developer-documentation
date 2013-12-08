<small>Piwik\DataTable\Filter\</small>

BeautifyTimeRangeLabels
=======================

A DataTable filter that replaces range labels whose values are in seconds with prettier, human-friendlier versions.

This filter customizes the behavior of the [BeautifyRangeLabels](#) filter
so range values that are less than one minute are displayed in seconds but
other ranges are displayed in minutes.

**Basic usage**

    $dataTable->filter('BeautifyTimeRangeLabels', array("%1$s-%2$s min", "1 min", "%s min"));

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`getSingleUnitLabel()`](#getsingleunitlabel) &mdash; Beautifies and returns a range label whose range spans over one unit, ie 1-1, 2-2 or 3-3.
- [`getRangeLabel()`](#getrangelabel) &mdash; Beautifies and returns a range label whose range is bounded and spans over more than one unit, ie 1-5, 5-10 but NOT 11+.
- [`getUnboundedLabel()`](#getunboundedlabel) &mdash; Beautifies and returns a range label whose range is unbounded, ie 5+, 10+, etc.

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

      <div markdown="1" class="param-desc"> The DataTable this filter will run over.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$labelSecondsPlural` (`string`) &mdash;

      <div markdown="1" class="param-desc"> A string to use when beautifying range labels whose lower bound is between 0 and 60. Must be a format string that takes two numeric params.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$labelMinutesSingular` (`string`) &mdash;

      <div markdown="1" class="param-desc"> A string to use when replacing a range that equals 60-60 (or 1 minute - 1 minute).</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$labelMinutesPlural` (`string`) &mdash;

      <div markdown="1" class="param-desc"> A string to use when replacing a range that spans multiple minutes. This must be a format string that takes one string parameter.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<a name="getsingleunitlabel" id="getsingleunitlabel"></a>
<a name="getSingleUnitLabel" id="getSingleUnitLabel"></a>
### `getSingleUnitLabel()`

Beautifies and returns a range label whose range spans over one unit, ie 1-1, 2-2 or 3-3.

If the lower bound of the range is less than 60 the pretty range label
will be in seconds. Otherwise, it will be in minutes.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$oldLabel` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The original label value.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$lowerBound` (`int`) &mdash;

      <div markdown="1" class="param-desc"> The lower bound of the range.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`string`) &mdash;
    <div markdown="1" class="param-desc">The pretty range label.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="getrangelabel" id="getrangelabel"></a>
<a name="getRangeLabel" id="getRangeLabel"></a>
### `getRangeLabel()`

Beautifies and returns a range label whose range is bounded and spans over more than one unit, ie 1-5, 5-10 but NOT 11+.

If the lower bound of the range is less than 60 the pretty range label
will be in seconds. Otherwise, it will be in minutes.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$oldLabel` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The original label value.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$lowerBound` (`int`) &mdash;

      <div markdown="1" class="param-desc"> The lower bound of the range.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$upperBound` (`int`) &mdash;

      <div markdown="1" class="param-desc"> The upper bound of the range.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`string`) &mdash;
    <div markdown="1" class="param-desc">The pretty range label.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="getunboundedlabel" id="getunboundedlabel"></a>
<a name="getUnboundedLabel" id="getUnboundedLabel"></a>
### `getUnboundedLabel()`

Beautifies and returns a range label whose range is unbounded, ie 5+, 10+, etc.

If the lower bound of the range is less than 60 the pretty range label
will be in seconds. Otherwise, it will be in minutes.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$oldLabel` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The original label value.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$lowerBound` (`int`) &mdash;

      <div markdown="1" class="param-desc"> The lower bound of the range.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`string`) &mdash;
    <div markdown="1" class="param-desc">The pretty range label.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

