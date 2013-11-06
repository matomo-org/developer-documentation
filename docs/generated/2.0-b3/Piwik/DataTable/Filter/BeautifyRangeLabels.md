<small>Piwik\DataTable\Filter</small>

BeautifyRangeLabels
===================

A DataTable filter that replaces range label columns with prettier, human-friendlier versions.

Description
-----------

When reports that summarize data over a set of ranges (such as the
reports in the VisitorInterest plugin) are archived, they are
archived with labels that read as: '$min-$max' or '$min+'. These labels
have no units and can look like '1-1'.

This filter can be used to clean up and add units those range labels. To
do this, you supply a string to use when the range specifies only
one unit (ie '1-1') and another format string when the range specifies
more than one unit (ie '2-2', '3-5' or '6+').

This filter can be extended to vary exactly how ranges are prettified based
on the range values found in the DataTable. To see an example of this,
take a look at the [BeautifyTimeRangeLabels](#) filter.

**Basic usage example**

    $dataTable->queueFilter('BeautifyRangeLabels', array("1 visit", "%s visits"));


Properties
----------

This class defines the following properties:

- [`$labelSingular`](#$labelsingular) &mdash; The string to use when the range being beautified is between 1-1 units.
- [`$labelPlural`](#$labelplural) &mdash; The format string to use when the range being beautified references more than one unit.

<a name="labelsingular" id="labelsingular"></a>
### `$labelSingular`

The string to use when the range being beautified is between 1-1 units.

#### Signature

- It is a(n) `string` value.

<a name="labelplural" id="labelplural"></a>
### `$labelPlural`

The format string to use when the range being beautified references more than one unit.

#### Signature

- It is a(n) `string` value.

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`beautify()`](#beautify) &mdash; Beautifies a range label and returns the pretty result.
- [`getSingleUnitLabel()`](#getsingleunitlabel) &mdash; Beautifies and returns a range label whose range spans over one unit, ie 1-1, 2-2 or 3-3.
- [`getRangeLabel()`](#getrangelabel) &mdash; Beautifies and returns a range label whose range is bounded and spans over more than one unit, ie 1-5, 5-10 but NOT 11+.
- [`getUnboundedLabel()`](#getunboundedlabel) &mdash; Beautifies and returns a range label whose range is unbounded, ie 5+, 10+, etc.

<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

- It accepts the following parameter(s):
    - `$table`
    - `$labelSingular`
    - `$labelPlural`
- It does not return anything.

<a name="beautify" id="beautify"></a>
### `beautify()`

Beautifies a range label and returns the pretty result.

#### Description

See [BeautifyRangeLabels](#).

#### Signature

- It accepts the following parameter(s):
    - `$value`
- _Returns:_ The pretty range label.
    - `string`

<a name="getsingleunitlabel" id="getsingleunitlabel"></a>
### `getSingleUnitLabel()`

Beautifies and returns a range label whose range spans over one unit, ie 1-1, 2-2 or 3-3.

#### Description

This function can be overridden in derived types to customize beautifcation
behavior based on the range values.

#### Signature

- It accepts the following parameter(s):
    - `$oldLabel`
    - `$lowerBound`
- _Returns:_ The pretty range label.
    - `string`

<a name="getrangelabel" id="getrangelabel"></a>
### `getRangeLabel()`

Beautifies and returns a range label whose range is bounded and spans over more than one unit, ie 1-5, 5-10 but NOT 11+.

#### Description

This function can be overridden in derived types to customize beautifcation
behavior based on the range values.

#### Signature

- It accepts the following parameter(s):
    - `$oldLabel`
    - `$lowerBound`
    - `$upperBound`
- _Returns:_ The pretty range label.
    - `string`

<a name="getunboundedlabel" id="getunboundedlabel"></a>
### `getUnboundedLabel()`

Beautifies and returns a range label whose range is unbounded, ie 5+, 10+, etc.

#### Description

This function can be overridden in derived types to customize beautifcation
behavior based on the range values.

#### Signature

- It accepts the following parameter(s):
    - `$oldLabel`
    - `$lowerBound`
- _Returns:_ The pretty range label.
    - `string`

