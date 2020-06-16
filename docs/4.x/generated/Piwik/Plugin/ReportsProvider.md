<small>Piwik\Plugin\</small>

ReportsProvider
===============

Get reports that are defined by plugins.

Methods
-------

The class defines the following methods:

- [`factory()`](#factory) &mdash; Get an instance of a specific report belonging to the given module and having the given action.
- [`getAllReports()`](#getallreports) &mdash; Returns a list of all available reports.
- [`getAllReportClasses()`](#getallreportclasses) &mdash; Returns class names of all Report metadata classes.

<a name="factory" id="factory"></a>
<a name="factory" id="factory"></a>
### `factory()`

Get an instance of a specific report belonging to the given module and having the given action.

#### Signature

-  It accepts the following parameter(s):
    - `$module` (`string`) &mdash;
      
    - `$action` (`string`) &mdash;
      

- *Returns:*  `null`|[`Report`](../../Piwik/Plugin/Report.md) &mdash;
    

<a name="getallreports" id="getallreports"></a>
<a name="getAllReports" id="getAllReports"></a>
### `getAllReports()`

Returns a list of all available reports.

Even not enabled reports will be returned. They will be already sorted
depending on the order and category of the report.

#### Signature

- It returns a [`Report[]`](../../Piwik/Plugin/Report.md) value.

<a name="getallreportclasses" id="getallreportclasses"></a>
<a name="getAllReportClasses" id="getAllReportClasses"></a>
### `getAllReportClasses()`

Returns class names of all Report metadata classes.

#### Signature

- It returns a `string[]` value.

