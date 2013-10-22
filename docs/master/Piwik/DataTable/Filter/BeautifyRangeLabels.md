<small>Piwik\DataTable\Filter</small>

BeautifyRangeLabels
===================

A DataTable filter that replaces range label columns with prettier, human-friendlier versions.

Description
-----------

When reports that summarize data over a set of ranges (such as the
reports in the VisitorInterest plugin) are archived, they are
archived with labels that read as: &#039;$min-$max&#039; or &#039;$min+&#039;. These labels
have no units and can look like &#039;1-1&#039;.

This filter can be used to clean up and add units those range labels. To
do this, you supply a string to use when the range specifies only
one unit (ie &#039;1-1&#039;) and another format string when the range specifies
more than one unit (ie &#039;2-2&#039;, &#039;3-5&#039; or &#039;6+&#039;).

This filter can be extended to vary exactly how ranges are prettified based
on the range values found in the DataTable. To see an example of this,
take a look at the [BeautifyTimeRangeLabels](#) filter.

**Basic usage example**

    $dataTable-&gt;queueFilter(&#039;BeautifyRangeLabels&#039;, array(&quot;1 visit&quot;, &quot;%s visits&quot;));


Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`beautify()`](#beautify) &mdash; Beautifies a range label and returns the pretty result.
- [`getSingleUnitLabel()`](#getSingleUnitLabel) &mdash; Beautifies and returns a range label whose range spans over one unit, ie 1-1, 2-2 or 3-3.
- [`getRangeLabel()`](#getRangeLabel) &mdash; Beautifies and returns a range label whose range is bounded and spans over more than one unit, ie 1-5, 5-10 but NOT 11+.
- [`getUnboundedLabel()`](#getUnboundedLabel) &mdash; Beautifies and returns a range label whose range is unbounded, ie 5+, 10+, etc.

### `__construct()` <a name="__construct"></a>

Constructor.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$table`
    - `$labelSingular`
    - `$labelPlural`
- It does not return anything.

### `beautify()` <a name="beautify"></a>

Beautifies a range label and returns the pretty result.

#### Description

See [BeautifyRangeLabels](#).

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$value`
- _Returns:_ The pretty range label.
    - `string`

### `getSingleUnitLabel()` <a name="getSingleUnitLabel"></a>

Beautifies and returns a range label whose range spans over one unit, ie 1-1, 2-2 or 3-3.

#### Description

This function can be overridden in derived types to customize beautifcation
behavior based on the range values.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$oldLabel`
    - `$lowerBound`
- _Returns:_ The pretty range label.
    - `string`

### `getRangeLabel()` <a name="getRangeLabel"></a>

Beautifies and returns a range label whose range is bounded and spans over more than one unit, ie 1-5, 5-10 but NOT 11+.

#### Description

This function can be overridden in derived types to customize beautifcation
behavior based on the range values.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$oldLabel`
    - `$lowerBound`
    - `$upperBound`
- _Returns:_ The pretty range label.
    - `string`

### `getUnboundedLabel()` <a name="getUnboundedLabel"></a>

Beautifies and returns a range label whose range is unbounded, ie 5+, 10+, etc.

#### Description

This function can be overridden in derived types to customize beautifcation
behavior based on the range values.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$oldLabel`
    - `$lowerBound`
- _Returns:_ The pretty range label.
    - `string`

