<small>Piwik\Plugin</small>

Visualization
=============

Base class for all DataTable visualizations.

Description
-----------

A Visualization is a special kind of ViewDataTable that comes with some
handy hooks. Different visualizations are used to handle different values of the viewDataTable query parameter.
Each one will display DataTable data in a different way.

TODO: must be more in depth

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`assignTemplateVar()`](#assigntemplatevar) &mdash; Assigns a template variable.
- [`beforeLoadDataTable()`](#beforeloaddatatable) &mdash; Hook that is intended to change the request config that is sent to the API.
- [`beforeGenericFiltersAreAppliedToLoadedDataTable()`](#beforegenericfiltersareappliedtoloadeddatatable) &mdash; Hook that is executed before generic filters like "filter_limit" and "filter_offset" are applied
- [`afterGenericFiltersAreAppliedToLoadedDataTable()`](#aftergenericfiltersareappliedtoloadeddatatable) &mdash; This hook is executed after generic filters like "filter_limit" and "filter_offset" are applied
- [`afterAllFiltersAreApplied()`](#afterallfiltersareapplied) &mdash; This hook is executed after the data table is loaded and after all filteres are applied.
- [`beforeRender()`](#beforerender) &mdash; Hook to make sure config properties have a specific value because the default config can be changed by a report or by request ($_GET and $_POST) params.

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Description

Initializes the default config, requestConfig and the request itself. After configuring some
mandatory properties reports can modify the view by listening to the hook 'ViewDataTable.configure'.

#### Signature

- It is a **finalized** method.
- It accepts the following parameter(s):
    - `$controllerAction`
    - `$apiMethodToRequestDataTable`

<a name="assigntemplatevar" id="assigntemplatevar"></a>
<a name="assignTemplateVar" id="assignTemplateVar"></a>
### `assignTemplateVar()`

Assigns a template variable.

#### Description

All assigned variables are available in the twig view template afterwards. You can
assign either one variable by setting $vars and $value or an array of key/value pairs.

#### Signature

- It accepts the following parameter(s):
    - `$vars` (`array`|`string`)
    - `$value` (`mixed`)
- It does not return anything.

<a name="beforeloaddatatable" id="beforeloaddatatable"></a>
<a name="beforeLoadDataTable" id="beforeLoadDataTable"></a>
### `beforeLoadDataTable()`

Hook that is intended to change the request config that is sent to the API.

#### Signature

- It does not return anything.

<a name="beforegenericfiltersareappliedtoloadeddatatable" id="beforegenericfiltersareappliedtoloadeddatatable"></a>
<a name="beforeGenericFiltersAreAppliedToLoadedDataTable" id="beforeGenericFiltersAreAppliedToLoadedDataTable"></a>
### `beforeGenericFiltersAreAppliedToLoadedDataTable()`

Hook that is executed before generic filters like "filter_limit" and "filter_offset" are applied

#### Signature

- It does not return anything.

<a name="aftergenericfiltersareappliedtoloadeddatatable" id="aftergenericfiltersareappliedtoloadeddatatable"></a>
<a name="afterGenericFiltersAreAppliedToLoadedDataTable" id="afterGenericFiltersAreAppliedToLoadedDataTable"></a>
### `afterGenericFiltersAreAppliedToLoadedDataTable()`

This hook is executed after generic filters like "filter_limit" and "filter_offset" are applied

#### Signature

- It does not return anything.

<a name="afterallfiltersareapplied" id="afterallfiltersareapplied"></a>
<a name="afterAllFiltersAreApplied" id="afterAllFiltersAreApplied"></a>
### `afterAllFiltersAreApplied()`

This hook is executed after the data table is loaded and after all filteres are applied.

#### Description

Format the data that you want to pass to the view here.

#### Signature

- It does not return anything.

<a name="beforerender" id="beforerender"></a>
<a name="beforeRender" id="beforeRender"></a>
### `beforeRender()`

Hook to make sure config properties have a specific value because the default config can be changed by a report or by request ($_GET and $_POST) params.

#### Signature

- It does not return anything.

