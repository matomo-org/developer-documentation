<small>Piwik</small>

View
====

Encapsulates and manages a [Twig](http://twig.sensiolabs.org/) template.

Description
-----------

View lets you set properties that will be passed on to a Twig template.
View will also set several properties that will be available in all Twig
templates, including:

- **currentModule**: The value of the &#039;module&#039; query parameter.
- **currentAction**: The value of the &#039;action&#039; query parameter.
- **userLogin**: The current user login name.
- **sites**: List of site data for every site the current user has at least
             view access for.
- **url**: The current URL (sanitized).
- **token_auth**: The current user&#039;s token auth.
- **userHasSomeAdminAccess**: True if the user has admin access to at least
                              one site, false if otherwise.
- **userIsSuperUser**: True if the user is the superuser, false if otherwise.
- **latest_version_available**: The latest version of Piwik available.
- **isWidget**: The value of the &#039;widget&#039; query parameter.
- **show_autocompleter**: Whether the site selector should be shown or not.
- **loginModule**: The name of the currently used authentication module.
- **userAlias**: The alias of the current user.

### Twig

Twig templates must exist in the **templates** folder in a plugin&#039;s root
folder.

The following filters are available to twig templates:

- **translate**: Outputs internationalized text using a translation token, eg,
                 `{{ &#039;General_Date&#039;|translate }}`. sprintf parameters can be passed
                 to the filter.
- **urlRewriteWithParameters**: Modifies the current query string with the given
                                set of parameters, eg,
                                ```
                                {{ {&#039;module&#039;:&#039;MyPlugin&#039;, &#039;action&#039;:&#039;index&#039;} | urlRewriteWithParameters }}
                                ```
- **sumTime**: Pretty formats an number of seconds.
- **money**: Formats a numerical value as a monetary value using the currency
             of the supplied site (second arg is site ID).
             eg, `{{ 23|money(site.idsite)|raw }}
- **truncate**: Truncates the text to certain length (determined by first arg.)
                eg, `{{ myReallyLongText|truncate(80) }}`
- **implode**: Calls `implode`.
- **ucwords**: Calls `ucwords`.

The following functions are available to twig templates:

- **linkTo**: Modifies the current query string with the given set of parameters,
              eg `{{ linkTo({&#039;module&#039;:&#039;MyPlugin&#039;, &#039;action&#039;:&#039;index&#039;}) }}`.
- **sparkline**: Outputs a sparkline image HTML element using the sparkline image
                 src link. eg, `{{ sparkline(sparklineUrl) }}`.
- **postEvent**: Posts an event that allows event observers to add text to a string
                 which is outputted in the template, eg, `{{ postEvent(&#039;MyPlugin.event&#039;) }}`
- **isPluginLoaded**: Returns true if the supplied plugin is loaded, false if otherwise.
                      `{% if isPluginLoaded(&#039;Goals&#039;) %}...{% endif %}`

### Examples

**Basic usage**

    $view = new View(&quot;@MyPlugin/myView&quot;);
    $view-&gt;property1 = &quot;a view property&quot;;
    $view-&gt;property2 = &quot;another view property&quot;;
    echo $view-&gt;render();


Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`getTemplateFile()`](#getTemplateFile) &mdash; Returns the template filename.
- [`getTemplateVars()`](#getTemplateVars) &mdash; Returns the variables to bind to the template when rendering.
- [`__set()`](#__set) &mdash; Directly assigns a variable to the view script.
- [`__get()`](#__get) &mdash; Retrieves an assigned variable.
- [`render()`](#render) &mdash; Renders the current view.
- [`setContentType()`](#setContentType) &mdash; Set stored value used in the Content-Type HTTP header field.
- [`setXFrameOptions()`](#setXFrameOptions) &mdash; Set X-Frame-Options field in the HTTP response.
- [`addForm()`](#addForm) &mdash; Add form to view
- [`assign()`](#assign) &mdash; Assign value to a variable for use in a template ToDo: This is ugly.
- [`clearCompiledTemplates()`](#clearCompiledTemplates) &mdash; Clear compiled Smarty templates
- [`singleReport()`](#singleReport) &mdash; Creates a View for and then renders the single report template.

### `__construct()` <a name="__construct"></a>

Constructor.

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

Variable names may not be prefixed with &#039;_&#039;.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$key`
    - `$val`
- It does not return anything.

### `__get()` <a name="__get"></a>

Retrieves an assigned variable.

#### Description

Variable names may not be prefixed with &#039;_&#039;.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$key`
- _Returns:_ The variable value.
    - `mixed`

### `render()` <a name="render"></a>

Renders the current view.

#### Description

Also sends the stored &#039;Content-Type&#039; HTML header.
See [setContentType](#setContentType).

#### Signature

- It is a **public** method.
- _Returns:_ Generated template.
    - `string`

### `setContentType()` <a name="setContentType"></a>

Set stored value used in the Content-Type HTTP header field.

#### Description

The header is
set just before rendering.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$contentType`
- It does not return anything.

### `setXFrameOptions()` <a name="setXFrameOptions"></a>

Set X-Frame-Options field in the HTTP response.

#### Description

The header is set just
before rendering.

Note: setting this allows you to make sure the View **cannot** be
embedded in iframes. Learn more [here](https://developer.mozilla.org/en-US/docs/HTTP/X-Frame-Options).

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

Creates a View for and then renders the single report template.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$title`
    - `$reportHtml`
    - `$fetch`
- _Returns:_ The report contents if `$fetch` is true.
    - `string`
    - `void`

