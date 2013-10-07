<small>Piwik</small>

View
====

View class to render the user interface

Signature
---------

- It implements the `Piwik\View\ViewInterface` interface.

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct)
- [`getTemplateFile()`](#getTemplateFile) &mdash; Returns the template filename.
- [`getTemplateVars()`](#getTemplateVars) &mdash; Returns the variables to bind to the template when rendering.
- [`__set()`](#__set) &mdash; Directly assigns a variable to the view script.
- [`__get()`](#__get) &mdash; Retrieves an assigned variable.
- [`initializeTwig()`](#initializeTwig)
- [`render()`](#render) &mdash; Renders the current view.
- [`setContentType()`](#setContentType) &mdash; Set Content-Type field in HTTP response.
- [`setXFrameOptions()`](#setXFrameOptions) &mdash; Set X-Frame-Options field in the HTTP response.
- [`addForm()`](#addForm) &mdash; Add form to view
- [`assign()`](#assign) &mdash; Assign value to a variable for use in a template ToDo: This is ugly.
- [`clearCompiledTemplates()`](#clearCompiledTemplates) &mdash; Clear compiled Smarty templates
- [`singleReport()`](#singleReport) &mdash; Render the single report template

### `__construct()` <a name="__construct"></a>

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$templateFile`
- It does not return anything.

### `getTemplateFile()` <a name="getTemplateFile"></a>

Returns the template filename.

#### Signature

- It is a **public** method.
- It returns a(n) `string` value.

### `getTemplateVars()` <a name="getTemplateVars"></a>

Returns the variables to bind to the template when rendering.

#### Signature

- It is a **public** method.
- It returns a(n) `array` value.

### `__set()` <a name="__set"></a>

Directly assigns a variable to the view script.

#### Description

VAR names may not be prefixed with &#039;_&#039;.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$key`
    - `$val`
- It does not return anything.

### `__get()` <a name="__get"></a>

Retrieves an assigned variable.

#### Description

VAR names may not be prefixed with &#039;_&#039;.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$key`
- _Returns:_ The variable value.
    - `mixed`

### `initializeTwig()` <a name="initializeTwig"></a>

#### Signature

- It is a **public** method.
- It does not return anything.

### `render()` <a name="render"></a>

Renders the current view.

#### Signature

- It is a **public** method.
- _Returns:_ Generated template
    - `string`

### `setContentType()` <a name="setContentType"></a>

Set Content-Type field in HTTP response.

#### Description

Since PHP 5.1.2, header() protects against header injection attacks.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$contentType`
- It does not return anything.

### `setXFrameOptions()` <a name="setXFrameOptions"></a>

Set X-Frame-Options field in the HTTP response.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$option`
- It does not return anything.

### `addForm()` <a name="addForm"></a>

Add form to view

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$form` (`Piwik\QuickForm2`)
- It does not return anything.

### `assign()` <a name="assign"></a>

Assign value to a variable for use in a template ToDo: This is ugly.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$var`
    - `$value`
- It does not return anything.

### `clearCompiledTemplates()` <a name="clearCompiledTemplates"></a>

Clear compiled Smarty templates

#### Signature

- It is a **public static** method.
- It does not return anything.

### `singleReport()` <a name="singleReport"></a>

Render the single report template

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$title`
    - `$reportHtml`
    - `$fetch`
- _Returns:_ Report contents if $fetch == true
    - `string`

