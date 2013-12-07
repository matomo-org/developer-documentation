<small>Piwik</small>

View
====

Encapsulates and manages a [Twig](http://twig.sensiolabs.org/) template.

Description
-----------

View lets you set properties that will be passed on to a Twig template.
View will also set several properties that will be available in all Twig
templates, including:

- **currentModule**: The value of the 'module' query parameter.
- **currentAction**: The value of the 'action' query parameter.
- **userLogin**: The current user login name.
- **sites**: List of site data for every site the current user has at least
             view access for.
- **url**: The current URL (sanitized).
- **token_auth**: The current user's token auth.
- **userHasSomeAdminAccess**: True if the user has admin access to at least
                              one site, false if otherwise.
- **userIsSuperUser**: True if the user is the superuser, false if otherwise.
- **latest_version_available**: The latest version of Piwik available.
- **isWidget**: The value of the 'widget' query parameter.
- **show_autocompleter**: Whether the site selector should be shown or not.
- **loginModule**: The name of the currently used authentication module.
- **userAlias**: The alias of the current user.

### Twig

Twig templates must exist in the **templates** folder in a plugin's root
folder.

The following filters are available to twig templates:

- **translate**: Outputs internationalized text using a translation token, eg,
                 `{{ 'General_Date'|translate }}`. sprintf parameters can be passed
                 to the filter.
- **urlRewriteWithParameters**: Modifies the current query string with the given
                                set of parameters, eg,
                                ```
                                {{ {'module':'MyPlugin', 'action':'index'} | urlRewriteWithParameters }}
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
              eg `{{ linkTo({'module':'MyPlugin', 'action':'index'}) }}`.
- **sparkline**: Outputs a sparkline image HTML element using the sparkline image
                 src link. eg, `{{ sparkline(sparklineUrl) }}`.
- **postEvent**: Posts an event that allows event observers to add text to a string
                 which is outputted in the template, eg, `{{ postEvent('MyPlugin.event') }}`
- **isPluginLoaded**: Returns true if the supplied plugin is loaded, false if otherwise.
                      `{% if isPluginLoaded('Goals') %}...{% endif %}`

### Examples

**Basic usage**

    $view = new View("@MyPlugin/myView");
    $view->property1 = "a view property";
    $view->property2 = "another view property";
    echo $view->render();

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`getTemplateFile()`](#gettemplatefile) &mdash; Returns the template filename.
- [`getTemplateVars()`](#gettemplatevars) &mdash; Returns the variables to bind to the template when rendering.
- [`__set()`](#__set) &mdash; Directly assigns a variable to the view script.
- [`__get()`](#__get) &mdash; Retrieves an assigned variable.
- [`render()`](#render) &mdash; Renders the current view.
- [`setContentType()`](#setcontenttype) &mdash; Set stored value used in the Content-Type HTTP header field.
- [`setXFrameOptions()`](#setxframeoptions) &mdash; Set X-Frame-Options field in the HTTP response.
- [`singleReport()`](#singlereport) &mdash; Creates a View for and then renders the single report template.

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$templateFile` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The template file to load. Must be in the following format: `"@MyPlugin/templateFileName"`. Note the absence of .twig from the end of the name.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<a name="gettemplatefile" id="gettemplatefile"></a>
<a name="getTemplateFile" id="getTemplateFile"></a>
### `getTemplateFile()`

Returns the template filename.

#### Signature

- It returns a `string` value.

<a name="gettemplatevars" id="gettemplatevars"></a>
<a name="getTemplateVars" id="getTemplateVars"></a>
### `getTemplateVars()`

Returns the variables to bind to the template when rendering.

#### Signature

- It returns a `array` value.

<a name="__set" id="__set"></a>
<a name="__set" id="__set"></a>
### `__set()`

Directly assigns a variable to the view script.

#### Description

Variable names may not be prefixed with '_'.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$key` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The variable name.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$val` (`mixed`) &mdash;

      <div markdown="1" class="param-desc"> The variable value.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="__get" id="__get"></a>
<a name="__get" id="__get"></a>
### `__get()`

Retrieves an assigned variable.

#### Description

Variable names may not be prefixed with '_'.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$key` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The variable name.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- _Returns:_ The variable value.
    - `mixed`

<a name="render" id="render"></a>
<a name="render" id="render"></a>
### `render()`

Renders the current view.

#### Description

Also sends the stored 'Content-Type' HTML header.
See [setContentType](#setContentType).

#### Signature

- _Returns:_ Generated template.
    - `string`

<a name="setcontenttype" id="setcontenttype"></a>
<a name="setContentType" id="setContentType"></a>
### `setContentType()`

Set stored value used in the Content-Type HTTP header field.

#### Description

The header is
set just before rendering.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$contentType` (`string`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="setxframeoptions" id="setxframeoptions"></a>
<a name="setXFrameOptions" id="setXFrameOptions"></a>
### `setXFrameOptions()`

Set X-Frame-Options field in the HTTP response.

#### Description

The header is set just
before rendering.

Note: setting this allows you to make sure the View **cannot** be
embedded in iframes. Learn more [here](https://developer.mozilla.org/en-US/docs/HTTP/X-Frame-Options).

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$option` (`string`) &mdash;

      <div markdown="1" class="param-desc"> ('deny' or 'sameorigin')</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="singlereport" id="singlereport"></a>
<a name="singleReport" id="singleReport"></a>
### `singleReport()`

Creates a View for and then renders the single report template.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$title`

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$reportHtml`

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- _Returns:_ The report contents if `$fetch` is true.
    - `string`
    - `void`

