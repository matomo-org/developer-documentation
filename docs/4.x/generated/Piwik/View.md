<small>Piwik\</small>

View
====

Encapsulates and manages a [Twig](http://twig.sensiolabs.org/) template.

View lets you set properties that will be passed on to a Twig template.
View will also set several properties that will be available in all Twig
templates, including:

- **currentModule**: The value of the **module** query parameter.
- **currentAction**: The value of the **action** query parameter.
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
- **isInternetEnabled**: Whether the matomo server is allowed to connect to
                         external networks.

### Template Naming Convention

Template files should be named after the controller method they are used in.
If they are used in more than one controller method or are included by another
template, they should describe the output they generate and be prefixed with
an underscore, eg, **_dataTable.twig**.

### Twig

Twig templates must exist in the **templates** folder in a plugin's root
folder.

The following filters are available to twig templates:

- **translate**: Outputs internationalized text using a translation token, eg,
                 `{{ 'General_Date'|translate }}`. sprintf parameters can be passed
                 to the filter.
- **urlRewriteWithParameters**: Modifies the current query string with the given
                                set of parameters, eg,

                                    {{ {'module':'MyPlugin', 'action':'index'} | urlRewriteWithParameters }}

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
- **areAdsForProfessionalServicesEnabled**: Returns true if it is ok to show some advertising in the UI for providers of Professional Support for Piwik (from Piwik 2.16.0)
- **isMultiServerEnvironment**: Returns true if Piwik is used on more than one server (since Piwik 2.16.1)

### Examples

**Basic usage**

    // a controller method
    public function myView()
    {
        $view = new View("@MyPlugin/myView");
        $view->property1 = "a view property";
        $view->property2 = "another view property";
        return $view->render();
    }

Properties
----------

This class defines the following properties:

- [`$sendHeadersWhenRendering`](#$sendheaderswhenrendering) &mdash; Can be disabled to not send headers when rendering a view.

<a name="$sendheaderswhenrendering" id="$sendheaderswhenrendering"></a>
<a name="sendHeadersWhenRendering" id="sendHeadersWhenRendering"></a>
### `$sendHeadersWhenRendering`

Can be disabled to not send headers when rendering a view. This can be useful if heaps of views are being
rendered during one request to possibly prevent a segmentation fault see eg #15307 . It should not be disabled
for a main view, but could be disabled for views that are being rendered eg during a twig event as a "subview" which
is part of the "main view".

#### Signature

- It is a `bool` value.

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`disableCacheBuster()`](#disablecachebuster) &mdash; Disables the cache buster (adding of ?cb=.
- [`getTemplateFile()`](#gettemplatefile) &mdash; Returns the template filename.
- [`getTemplateVars()`](#gettemplatevars) &mdash; Returns the variables to bind to the template when rendering.
- [`__set()`](#__set) &mdash; Directly assigns a variable to the view script.
- [`__get()`](#__get) &mdash; Retrieves an assigned variable.
- [`__isset()`](#__isset) &mdash; Returns true if a template variable has been set or not.
- [`__unset()`](#__unset) &mdash; Unsets a template variable.
- [`render()`](#render) &mdash; Renders the current view.
- [`setContentType()`](#setcontenttype) &mdash; Set stored value used in the Content-Type HTTP header field.
- [`setXFrameOptions()`](#setxframeoptions) &mdash; Set X-Frame-Options field in the HTTP response.
- [`singleReport()`](#singlereport) &mdash; Creates a View for and then renders the single report template.
- [`getUseStrictReferrerPolicy()`](#getusestrictreferrerpolicy) &mdash; Returns whether a strict Referrer-Policy header will be sent.
- [`setUseStrictReferrerPolicy()`](#setusestrictreferrerpolicy) &mdash; Sets whether a strict Referrer-Policy header will be sent (if not, nothing is sent).

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

-  It accepts the following parameter(s):
    - `$templateFile` (`string`) &mdash;
       The template file to load. Must be in the following format: `"@MyPlugin/templateFileName"`. Note the absence of .twig from the end of the name.

<a name="disablecachebuster" id="disablecachebuster"></a>
<a name="disableCacheBuster" id="disableCacheBuster"></a>
### `disableCacheBuster()`

Disables the cache buster (adding of ?cb=.

..) to JavaScript and stylesheet files

#### Signature

- It does not return anything or a mixed result.

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

-  It accepts the following parameter(s):
    - `$override` (`array`) &mdash;
       Template variable override values. Mainly useful when including View templates in other templates.
- It returns a `array` value.

<a name="__set" id="__set"></a>
<a name="__set" id="__set"></a>
### `__set()`

Directly assigns a variable to the view script.

Variable names may not be prefixed with '_'.

#### Signature

-  It accepts the following parameter(s):
    - `$key` (`string`) &mdash;
       The variable name.
    - `$val` (`mixed`) &mdash;
       The variable value.
- It does not return anything or a mixed result.

<a name="__get" id="__get"></a>
<a name="__get" id="__get"></a>
### `__get()`

Retrieves an assigned variable.

Variable names may not be prefixed with '_'.

#### Signature

-  It accepts the following parameter(s):
    - `$key` (`string`) &mdash;
       The variable name.

- *Returns:*  `mixed` &mdash;
    The variable value.

<a name="__isset" id="__isset"></a>
<a name="__isset" id="__isset"></a>
### `__isset()`

Returns true if a template variable has been set or not.

#### Signature

-  It accepts the following parameter(s):
    - `$name` (`string`) &mdash;
       The name of the template variable.
- It returns a `bool` value.

<a name="__unset" id="__unset"></a>
<a name="__unset" id="__unset"></a>
### `__unset()`

Unsets a template variable.

#### Signature

-  It accepts the following parameter(s):
    - `$name` (`string`) &mdash;
       The name of the template variable.
- It does not return anything or a mixed result.

<a name="render" id="render"></a>
<a name="render" id="render"></a>
### `render()`

Renders the current view. Also sends the stored 'Content-Type' HTML header.

See [setContentType()](/api-reference/Piwik/View#setcontenttype).

#### Signature


- *Returns:*  `string` &mdash;
    Serialized data, eg, (image, array, html...).

<a name="setcontenttype" id="setcontenttype"></a>
<a name="setContentType" id="setContentType"></a>
### `setContentType()`

Set stored value used in the Content-Type HTTP header field. The header is
set just before rendering.

#### Signature

-  It accepts the following parameter(s):
    - `$contentType` (`string`) &mdash;
      
- It does not return anything or a mixed result.

<a name="setxframeoptions" id="setxframeoptions"></a>
<a name="setXFrameOptions" id="setXFrameOptions"></a>
### `setXFrameOptions()`

Set X-Frame-Options field in the HTTP response. The header is set just
before rendering.

_Note: setting this allows you to make sure the View **cannot** be
embedded in iframes. Learn more [here](https://developer.mozilla.org/en-US/docs/HTTP/X-Frame-Options)._

#### Signature

-  It accepts the following parameter(s):
    - `$option` (`string`) &mdash;
       ('deny' or 'sameorigin')
- It does not return anything or a mixed result.

<a name="singlereport" id="singlereport"></a>
<a name="singleReport" id="singleReport"></a>
### `singleReport()`

Creates a View for and then renders the single report template.

Can be used for pages that display only one report to avoid having to create
a new template.

#### Signature

-  It accepts the following parameter(s):
    - `$title` (`string`) &mdash;
       The report title.
    - `$reportHtml` (`string`) &mdash;
       The report body HTML.

- *Returns:*  `string`|`void` &mdash;
    The report contents if `$fetch` is true.

<a name="getusestrictreferrerpolicy" id="getusestrictreferrerpolicy"></a>
<a name="getUseStrictReferrerPolicy" id="getUseStrictReferrerPolicy"></a>
### `getUseStrictReferrerPolicy()`

Returns whether a strict Referrer-Policy header will be sent. Generally this should be set to 'true'.

#### Signature

- It returns a `bool` value.

<a name="setusestrictreferrerpolicy" id="setusestrictreferrerpolicy"></a>
<a name="setUseStrictReferrerPolicy" id="setUseStrictReferrerPolicy"></a>
### `setUseStrictReferrerPolicy()`

Sets whether a strict Referrer-Policy header will be sent (if not, nothing is sent).

#### Signature

-  It accepts the following parameter(s):
    - `$useStrictReferrerPolicy` (`bool`) &mdash;
      
- It does not return anything or a mixed result.

