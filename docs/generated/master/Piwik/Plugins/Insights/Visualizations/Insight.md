<small>Piwik\Plugins\Insights\Visualizations\</small>

Insight
=======

InsightsVisualization Visualization.

Properties
----------

This class defines the following properties:

- [`$config`](#$config) &mdash; Contains display properties for this visualization.
- [`$requestConfig`](#$requestconfig) &mdash; Insight\RequestConfig$requestConfig

<a name="$config" id="$config"></a>
<a name="config" id="config"></a>
### `$config`

Contains display properties for this visualization.

#### Signature

- It is a [`Config`](../../../../Piwik/ViewDataTable/Config.md) value.

<a name="$requestconfig" id="$requestconfig"></a>
<a name="requestConfig" id="requestConfig"></a>
### `$requestConfig`

Insight\RequestConfig$requestConfig

#### Signature

- It is a `Insight\RequestConfig` value.

Methods
-------

The class defines the following methods:

- [`assignTemplateVar()`](#assigntemplatevar) &mdash; Assigns a template variable making it available in the Twig template specified by `TEMPLATE_FILE`.
- [`isThereDataToDisplay()`](#istheredatatodisplay) &mdash; Returns `true` if there is data to display, `false` if otherwise.
- [`beforeLoadDataTable()`](#beforeloaddatatable) &mdash; Hook that is called before loading report data from the API.
- [`beforeGenericFiltersAreAppliedToLoadedDataTable()`](#beforegenericfiltersareappliedtoloadeddatatable) &mdash; Hook that is executed before generic filters are applied.
- [`afterGenericFiltersAreAppliedToLoadedDataTable()`](#aftergenericfiltersareappliedtoloadeddatatable) &mdash; Hook that is executed after generic filters are applied.
- [`afterAllFiltersAreApplied()`](#afterallfiltersareapplied) &mdash; Hook that is executed after the report data is loaded and after all filters have been applied.
- [`beforeRender()`](#beforerender) &mdash; Hook that is executed directly before rendering.

<a name="assigntemplatevar" id="assigntemplatevar"></a>
<a name="assignTemplateVar" id="assignTemplateVar"></a>
### `assignTemplateVar()`

Assigns a template variable making it available in the Twig template specified by `TEMPLATE_FILE`.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$vars` (`array`|`string`) &mdash;

      <div markdown="1" class="param-desc"> One or more variable names to set.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$value` (`mixed`) &mdash;

      <div markdown="1" class="param-desc"> The value to set each variable to.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

<a name="istheredatatodisplay" id="istheredatatodisplay"></a>
<a name="isThereDataToDisplay" id="isThereDataToDisplay"></a>
### `isThereDataToDisplay()`

Returns `true` if there is data to display, `false` if otherwise.

Derived classes should override this method if they change the amount of data that is loaded.

#### Signature

- It does not return anything.

<a name="beforeloaddatatable" id="beforeloaddatatable"></a>
<a name="beforeLoadDataTable" id="beforeLoadDataTable"></a>
### `beforeLoadDataTable()`

Hook that is called before loading report data from the API.

Use this method to change the request parameters that is sent to the API when requesting
data.

#### Signature

- It does not return anything.

<a name="beforegenericfiltersareappliedtoloadeddatatable" id="beforegenericfiltersareappliedtoloadeddatatable"></a>
<a name="beforeGenericFiltersAreAppliedToLoadedDataTable" id="beforeGenericFiltersAreAppliedToLoadedDataTable"></a>
### `beforeGenericFiltersAreAppliedToLoadedDataTable()`

Hook that is executed before generic filters are applied.

Use this method if you need access to the entire dataset (since generic filters will
limit and truncate reports).

#### Signature

- It does not return anything.

<a name="aftergenericfiltersareappliedtoloadeddatatable" id="aftergenericfiltersareappliedtoloadeddatatable"></a>
<a name="afterGenericFiltersAreAppliedToLoadedDataTable" id="afterGenericFiltersAreAppliedToLoadedDataTable"></a>
### `afterGenericFiltersAreAppliedToLoadedDataTable()`

Hook that is executed after generic filters are applied.

#### Signature

- It does not return anything.

<a name="afterallfiltersareapplied" id="afterallfiltersareapplied"></a>
<a name="afterAllFiltersAreApplied" id="afterAllFiltersAreApplied"></a>
### `afterAllFiltersAreApplied()`

Hook that is executed after the report data is loaded and after all filters have been applied.

Use this method to format the report data before the view is rendered.

#### Signature

- It does not return anything.

<a name="beforerender" id="beforerender"></a>
<a name="beforeRender" id="beforeRender"></a>
### `beforeRender()`

Hook that is executed directly before rendering.

Use this hook to force display properties to
be a certain value, despite changes from plugins and query parameters.

#### Signature

- It does not return anything.

