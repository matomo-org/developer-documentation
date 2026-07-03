Events
==========

This is a complete list of available hooks. If you are not familiar with this read our [Guide about events](/guides/events).

## &quot;Dashboard

- [&quot;Dashboard.changeDefaultDashboardLayout&quot;](#dashboardchangedefaultdashboardlayout)

### &quot;Dashboard.changeDefaultDashboardLayout&quot;

*Defined in [Piwik/Plugins/Dashboard/Dashboard](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Dashboard/Dashboard.php) in line [205](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Dashboard/Dashboard.php#L205)*

Allows other plugins to modify the default dashboard layout.

Callback Signature:
<pre><code>function(&amp;$defaultLayout)</code></pre>

- string &$defaultLayout JSON encoded string of the default dashboard layout. Contains an
                              array of columns where each column is an array of widgets. Each
                              widget is an associative array w/ the following elements:

                              * **uniqueId**: The widget's unique ID.
                              * **parameters**: The array of query parameters that should be used to get this widget's report.



## Access

- [Access.Capability.addCapabilities](#accesscapabilityaddcapabilities)
- [Access.Capability.filterCapabilities](#accesscapabilityfiltercapabilities)
- [Access.modifyUserAccess](#accessmodifyuseraccess)

### Access.Capability.addCapabilities

*Defined in [Piwik/Access/CapabilitiesProvider](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Access/CapabilitiesProvider.php) in line [45](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Access/CapabilitiesProvider.php#L45)*

Triggered to add new capabilities. **Example**

    public function addCapabilities(&$capabilities)
    {
        $capabilities[] = new MyNewCapability();
    }

Callback Signature:
<pre><code>function(&amp;$capabilities)</code></pre>

- \Capability `$reports` An array of reports

Usages:

[TagManager::addCapabilities](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TagManager/TagManager.php#L111)


### Access.Capability.filterCapabilities

*Defined in [Piwik/Access/CapabilitiesProvider](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Access/CapabilitiesProvider.php) in line [64](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Access/CapabilitiesProvider.php#L64)*

Triggered to filter / restrict capabilities. **Example**

    public function filterCapabilities(&$capabilities)
    {
        foreach ($capabilities as $index => $capability) {
             if ($capability->getId() === 'tagmanager_write') {}
                 unset($capabilities[$index]); // remove the given capability
             }
        }
    }

Callback Signature:
<pre><code>function(&amp;$capabilities)</code></pre>

- \Capability `$reports` An array of reports


### Access.modifyUserAccess

*Defined in [Piwik/Access](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Access.php) in line [305](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Access.php#L305)*

Triggered after the initial access levels and permissions for the current user are loaded. Use this
event to modify the current user's permissions (for example, making sure every user has view access
to a specific site). **Example**

    function (&$idsitesByAccess, $login) {
        if ($login == 'somespecialuser') {
            return;
        }

        $idsitesByAccess['view'][] = $mySpecialIdSite;
    }

Callback Signature:
<pre><code>function(&amp;$this-&gt;idsitesByAccess, $this-&gt;login]</code></pre>

- array &$idsitesByAccess The current user's access levels for individual sites. Maps role and
                                 capability IDs to list of site IDs, eg:

                                 ```
                                 [
                                     'view' => [1, 2, 3],
                                     'write' => [4, 5],
                                     'admin' => [],
                                 ]
                                 ```

- string `$login` The current user's login.

## Actions

- [Actions.addActionTypes](#actionsaddactiontypes)
- [Actions.Archiving.addActionMetrics](#actionsarchivingaddactionmetrics)
- [Actions.getCustomActionDimensionFieldsAndJoins](#actionsgetcustomactiondimensionfieldsandjoins)

### Actions.addActionTypes

*Defined in [Piwik/Plugins/Actions/Columns/ActionType](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Actions/Columns/ActionType.php) in line [60](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Actions/Columns/ActionType.php#L60)*

Triggered to determine the available action types Plugin can use this event to add their own action types, so they are available in segmentation
The array maps internal ids to readable action type names used in visitor details

**Example**

public function addActionTypes(&$availableTypes)
{
    $availableTypes[] = array(
        'id' => 76,
        'name' => 'media_play'
     );
}

Callback Signature:
<pre><code>function(&amp;$availableTypes]</code></pre>

- array `&$availableTypes`

Usages:

[Actions::addActionTypes](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Actions/Actions.php#L120)


### Actions.Archiving.addActionMetrics

*Defined in [Piwik/Plugins/Actions/Metrics](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Actions/Metrics.php) in line [99](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Actions/Metrics.php#L99)*



Callback Signature:
<pre><code>function(&amp;$metricsConfig)</code></pre>

Usages:

[Bandwidth::addActionMetrics](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Bandwidth/Bandwidth.php#L118), [PagePerformance::addActionMetrics](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/PagePerformance/PagePerformance.php#L147)


### Actions.getCustomActionDimensionFieldsAndJoins

*Defined in [Piwik/Plugins/Actions/VisitorDetails](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Actions/VisitorDetails.php) in line [309](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Actions/VisitorDetails.php#L309)*



Callback Signature:
<pre><code>function(&amp;$customFields, &amp;$customJoins)</code></pre>

Usages:

[Bandwidth::provideActionDimensionFields](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Bandwidth/Bandwidth.php#L211), [Contents::provideActionDimensionFields](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Contents/Contents.php#L56), [CustomDimensions::provideActionDimensionFields](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomDimensions/CustomDimensions.php#L381), [CustomVariables::provideActionDimensionFields](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomVariables/CustomVariables.php#L144), [Ecommerce::provideActionDimensionFields](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Ecommerce/Ecommerce.php#L48), [Events::provideActionDimensionFields](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Events/Events.php#L262)

## API

- [API.$pluginName.$methodName](#apipluginnamemethodname)
- [API.$pluginName.$methodName.end](#apipluginnamemethodnameend)
- [API.addGlossaryItems](#apiaddglossaryitems)
- [API.DocumentationGenerator.$token](#apidocumentationgeneratortoken)
- [API.getPagesComparisonsDisabledFor](#apigetpagescomparisonsdisabledfor)
- [API.getProcessedReport.inner.after](#apigetprocessedreportinnerafter)
- [API.getProcessedReport.inner.before](#apigetprocessedreportinnerbefore)
- [API.getReportMetadata.end](#apigetreportmetadataend)
- [API.Request.authenticate](#apirequestauthenticate)
- [API.Request.dispatch](#apirequestdispatch)
- [API.Request.dispatch.end](#apirequestdispatchend)
- [API.Request.intercept](#apirequestintercept)

### API.$pluginName.$methodName

*Defined in [Piwik/API/Proxy](https://github.com/matomo-org/matomo/blob/5.x-dev/core/API/Proxy.php) in line [267](https://github.com/matomo-org/matomo/blob/5.x-dev/core/API/Proxy.php#L267)*

Triggered before an API request is dispatched. This event exists for convenience and is triggered directly after the [API.Request.dispatch](/api-reference/events#apirequestdispatch)
event is triggered. It can be used to modify the arguments passed to a **single** API method.

_Note: This is can be accomplished with the [API.Request.dispatch](/api-reference/events#apirequestdispatch) event as well, however
event handlers for that event will have to do more work._

**Example**

    Piwik::addAction('API.Actions.getPageUrls', function (&$parameters) {
        // force use of a single website. for some reason.
        $parameters['idSite'] = 1;
    });

Callback Signature:
<pre><code>function(&amp;$finalParameters)</code></pre>

- array &$finalParameters List of parameters that will be passed to the API method.


### API.$pluginName.$methodName.end

*Defined in [Piwik/API/Proxy](https://github.com/matomo-org/matomo/blob/5.x-dev/core/API/Proxy.php) in line [342](https://github.com/matomo-org/matomo/blob/5.x-dev/core/API/Proxy.php#L342)*

Triggered directly after an API request is dispatched. This event exists for convenience and is triggered immediately before the
[API.Request.dispatch.end](/api-reference/events#apirequestdispatchend) event. It can be used to modify the output of a **single**
API method.

_Note: This can be accomplished with the [API.Request.dispatch.end](/api-reference/events#apirequestdispatchend) event as well,
however event handlers for that event will have to do more work._

**Example**

    // append (0 hits) to the end of row labels whose row has 0 hits
    Piwik::addAction('API.Actions.getPageUrls', function (&$returnValue, $info)) {
        $returnValue->filter('ColumnCallbackReplace', 'label', function ($label, $hits) {
            if ($hits === 0) {
                return $label . " (0 hits)";
            } else {
                return $label;
            }
        }, null, array('nb_hits'));
    }

Callback Signature:
<pre><code>$endHookParams</code></pre>

- mixed &$returnedValue The API method's return value. Can be an object, such as a
                             [DataTable](/api-reference/Piwik/DataTable) instance.
                             could be a [DataTable](/api-reference/Piwik/DataTable).

- array `$extraInfo` An array holding information regarding the API request. Will
                        contain the following data:

                        - **className**: The namespace-d class name of the API instance
                                         that's being called.
                        - **module**: The name of the plugin the API request was
                                      dispatched to.
                        - **action**: The name of the API method that was executed.
                        - **parameters**: The array of parameters passed to the API
                                          method.


### API.addGlossaryItems

*Defined in [Piwik/Plugins/API/Controller](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/API/Controller.php) in line [199](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/API/Controller.php#L199)*

Triggered to add or modify glossary items. You can either modify one of the existing core categories
'reports' and 'metrics' or add your own category. **Example**

    public function addGlossaryItems(&$glossaryItems)
    {
         $glossaryItems['users'] = array('title' => 'Users', 'entries' => array(
             array('name' => 'User1', 'documentation' => 'This user has ...'),
             array('name' => 'User2', 'documentation' => 'This user has ...'),
         ));
         $glossaryItems['reports']['entries'][] = array('name' => 'My Report', 'documentation' => 'This report has ...');
    }

Callback Signature:
<pre><code>function(&amp;$glossaryItems)</code></pre>

- array &$glossaryItems An array containing all glossary items.

Usages:

[TagManager::addGlossaryItems](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TagManager/TagManager.php#L132)


### API.DocumentationGenerator.$token

*Defined in [Piwik/API/Proxy](https://github.com/matomo-org/matomo/blob/5.x-dev/core/API/Proxy.php) in line [688](https://github.com/matomo-org/matomo/blob/5.x-dev/core/API/Proxy.php#L688)*

This event exists for checking whether a Plugin API class or a Plugin API method tagged
with a `@hideXYZ` should be hidden in the API listing.

Callback Signature:
<pre><code>function(&amp;$hide)</code></pre>

- bool &$hide whether to hide APIs tagged with $token should be displayed.


### API.getPagesComparisonsDisabledFor

*Defined in [Piwik/Plugins/API/API](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/API/API.php) in line [764](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/API/API.php#L764)*

If your plugin has pages where you'd like comparison features to be disabled, you can add them
via this event. Add the pages as "CategoryId.SubcategoryId". **Example**

```
public function getPagesComparisonsDisabledFor(&$pages)
{
    $pages[] = "General_Visitors.MyPlugin_MySubcategory";
    $pages[] = "MyPlugin.myControllerAction"; // if your plugin defines a whole page you want comparison disabled for
}
```

Callback Signature:
<pre><code>function(&amp;$pages]</code></pre>

- string &$pages

Usages:

[Live::getPagesComparisonsDisabledFor](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Live/Live.php#L39), [MultiSites::getPagesComparisonsDisabledFor](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/MultiSites/MultiSites.php#L29), [Referrers::getPagesComparisonsDisabledFor](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Referrers/Referrers.php#L98), [SegmentEditor::getPagesComparisonsDisabledFor](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/SegmentEditor/SegmentEditor.php#L61), [Transitions::getPagesComparisonsDisabledFor](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Transitions/Transitions.php#L31), [UserCountryMap::getPagesComparisonsDisabledFor](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/UserCountryMap/UserCountryMap.php#L39)


### API.getProcessedReport.inner.after

*Defined in [Piwik/Plugins/API/ProcessedReport](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/API/ProcessedReport.php) in line [513](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/API/ProcessedReport.php#L513)*

Triggered before the API.getProcessedReport API method fetches
report data. This event can be used to directly modify the report data returned
by API.getProcessedReport, before the data is processed.

Callback Signature:
<pre><code>function($parameters, $dataTable]</code></pre>

- array `$parameters` The request parameters used to fetch report
                          data.

- \DataTableInterface `$dataTable`


### API.getProcessedReport.inner.before

*Defined in [Piwik/Plugins/API/ProcessedReport](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/API/ProcessedReport.php) in line [492](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/API/ProcessedReport.php#L492)*

Triggered before the API.getProcessedReport API method fetches
report data. This event can be used to modify the parameters of the API request
used to get report data, allowing plugins to modify the output of
API.getProcessedReport.

Callback Signature:
<pre><code>function(&amp;$parameters]</code></pre>

- array &$parameters The request parameters used to fetch report
                          data.


### API.getReportMetadata.end

*Defined in [Piwik/Plugins/API/ProcessedReport](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/API/ProcessedReport.php) in line [258](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/API/ProcessedReport.php#L258)*

Triggered after all available reports are collected. This event can be used to modify the report metadata of reports in other plugins. You
could, for example, add custom metrics to every report or remove reports from the list
of available reports.

Callback Signature:
<pre><code>function(&amp;$availableReports, $parameters)</code></pre>

- array &$availableReports List of all report metadata. Read the [API.getReportMetadata](/api-reference/events#apigetreportmetadata)
                                docs to see what this array contains.

- array `$parameters` Contains the values of the sites and period we are
                         getting reports for. Some report depend on this data.
                         For example, Goals reports depend on the site IDs being
                         request. Contains the following information:

                         - **idSite**: The site ID we are getting reports for.
                         - **period**: The period type, eg, `'day'`, `'week'`, `'month'`,
                                       `'year'`, `'range'`.
                         - **date**: A string date within the period or a date range, eg,
                                     `'2013-01-01'` or `'2012-01-01,2013-01-01'`.

Usages:

[Goals::getReportMetadataEnd](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Goals/Goals.php#L280)


### API.Request.authenticate

*Defined in [Piwik/API/Request](https://github.com/matomo-org/matomo/blob/5.x-dev/core/API/Request.php) in line [470](https://github.com/matomo-org/matomo/blob/5.x-dev/core/API/Request.php#L470)*

Triggered when authenticating an API request, but only if the **token_auth**
query parameter is found in the request. Plugins that provide authentication capabilities should subscribe to this event
and make sure the global authentication object (the object returned by `StaticContainer::get('Piwik\Auth')`)
is setup to use `$token_auth` when its `authenticate()` method is executed.

Callback Signature:
<pre><code>function($tokenAuth)</code></pre>

- string `$token_auth` The value of the **token_auth** query parameter.

Usages:

[Login::apiRequestAuthenticate](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/Login.php#L327), [LoginLdap::apiRequestAuthenticate](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/LoginLdap/LoginLdap.php#L226)


### API.Request.dispatch

*Defined in [Piwik/API/Proxy](https://github.com/matomo-org/matomo/blob/5.x-dev/core/API/Proxy.php) in line [247](https://github.com/matomo-org/matomo/blob/5.x-dev/core/API/Proxy.php#L247)*

Triggered before an API request is dispatched. This event can be used to modify the arguments passed to one or more API methods.

**Example**

    Piwik::addAction('API.Request.dispatch', function (&$parameters, $pluginName, $methodName) {
        if ($pluginName == 'Actions') {
            if ($methodName == 'getPageUrls') {
                // ... do something ...
            } else {
                // ... do something else ...
            }
        }
    });

Callback Signature:
<pre><code>function(&amp;$finalParameters, $pluginName, $methodName)</code></pre>

- array &$finalParameters List of parameters that will be passed to the API method.

- string `$pluginName` The name of the plugin the API method belongs to.

- string `$methodName` The name of the API method that will be called.

Usages:

[AnonymousPiwikUsageMeasurement::logStartTimeOfApiCall](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/AnonymousPiwikUsageMeasurement/AnonymousPiwikUsageMeasurement.php#L61), [CustomAlerts::checkApiPermission](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomAlerts/CustomAlerts.php#L65)


### API.Request.dispatch.end

*Defined in [Piwik/API/Proxy](https://github.com/matomo-org/matomo/blob/5.x-dev/core/API/Proxy.php) in line [382](https://github.com/matomo-org/matomo/blob/5.x-dev/core/API/Proxy.php#L382)*

Triggered directly after an API request is dispatched. This event can be used to modify the output of any API method.

**Example**

    // append (0 hits) to the end of row labels whose row has 0 hits for any report that has the 'nb_hits' metric
    Piwik::addAction('API.Actions.getPageUrls.end', function (&$returnValue, $info)) {
        // don't process non-DataTable reports and reports that don't have the nb_hits column
        if (!($returnValue instanceof DataTableInterface)
            || in_array('nb_hits', $returnValue->getColumns())
        ) {
            return;
        }

        $returnValue->filter('ColumnCallbackReplace', 'label', function ($label, $hits) {
            if ($hits === 0) {
                return $label . " (0 hits)";
            } else {
                return $label;
            }
        }, null, array('nb_hits'));
    }

Callback Signature:
<pre><code>$endHookParams</code></pre>

- mixed &$returnedValue The API method's return value. Can be an object, such as a
                             [DataTable](/api-reference/Piwik/DataTable) instance.

- array `$extraInfo` An array holding information regarding the API request. Will
                        contain the following data:

                        - **className**: The namespace-d class name of the API instance
                                         that's being called.
                        - **module**: The name of the plugin the API request was
                                      dispatched to.
                        - **action**: The name of the API method that was executed.
                        - **parameters**: The array of parameters passed to the API
                                          method.

Usages:

[AnonymousPiwikUsageMeasurement::trackApiCall](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/AnonymousPiwikUsageMeasurement/AnonymousPiwikUsageMeasurement.php#L70), [PagePerformance::enrichApi](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/PagePerformance/PagePerformance.php#L86)


### API.Request.intercept

*Defined in [Piwik/API/Proxy](https://github.com/matomo-org/matomo/blob/5.x-dev/core/API/Proxy.php) in line [282](https://github.com/matomo-org/matomo/blob/5.x-dev/core/API/Proxy.php#L282)*

Triggered before an API request is dispatched. Use this event to intercept an API request and execute your own code instead. If you set
`$returnedValue` in a handler for this event, the original API method will not be executed,
and the result will be what you set in the event handler.

Callback Signature:
<pre><code>function(&amp;$returnedValue, $finalParameters, $pluginName, $methodName, $parametersRequest]</code></pre>

- mixed &$returnedValue Set this to set the result and preempt normal API invocation.

- array &$finalParameters List of parameters that will be passed to the API method.

- string `$pluginName` The name of the plugin the API method belongs to.

- string `$methodName` The name of the API method that will be called.

- array `$parametersRequest` The query parameters for this request.

## ArchiveProcessor

- [ArchiveProcessor.ComputeNbUniques.getIdSites](#archiveprocessorcomputenbuniquesgetidsites)
- [ArchiveProcessor.getArchive](#archiveprocessorgetarchive)
- [ArchiveProcessor.Parameters.getIdSites](#archiveprocessorparametersgetidsites)
- [ArchiveProcessor.shouldAggregateFromRawData](#archiveprocessorshouldaggregatefromrawdata)

### ArchiveProcessor.ComputeNbUniques.getIdSites

*Defined in [Piwik/ArchiveProcessor](https://github.com/matomo-org/matomo/blob/5.x-dev/core/ArchiveProcessor.php) in line [557](https://github.com/matomo-org/matomo/blob/5.x-dev/core/ArchiveProcessor.php#L557)*

Triggered to change which site ids should be looked at when processing unique visitors and users.

Callback Signature:
<pre><code>function(&amp;$sites, $params-&gt;getPeriod(), $params-&gt;getSegment())</code></pre>

- array &$idSites An array with one idSite. This site is being archived currently. To cancel the query
                       you can change this value to an empty array. To include other sites in the query you
                       can add more idSites to this list of idSites.

- [Period](/api-reference/Piwik/Period) `$period` The period that is being requested to be archived.

- [Segment](/api-reference/Piwik/Segment) `$segment` The segment that is request to be archived.


### ArchiveProcessor.getArchive

*Defined in [Piwik/ArchiveProcessor](https://github.com/matomo-org/matomo/blob/5.x-dev/core/ArchiveProcessor.php) in line [134](https://github.com/matomo-org/matomo/blob/5.x-dev/core/ArchiveProcessor.php#L134)*



Callback Signature:
<pre><code>function($this-&gt;archive]</code></pre>


### ArchiveProcessor.Parameters.getIdSites

*Defined in [Piwik/ArchiveProcessor/Parameters](https://github.com/matomo-org/matomo/blob/5.x-dev/core/ArchiveProcessor/Parameters.php) in line [163](https://github.com/matomo-org/matomo/blob/5.x-dev/core/ArchiveProcessor/Parameters.php#L163)*



Callback Signature:
<pre><code>function(&amp;$idSites, $this-&gt;getPeriod())</code></pre>


### ArchiveProcessor.shouldAggregateFromRawData

*Defined in [Piwik/ArchiveProcessor/PluginsArchiver](https://github.com/matomo-org/matomo/blob/5.x-dev/core/ArchiveProcessor/PluginsArchiver.php) in line [91](https://github.com/matomo-org/matomo/blob/5.x-dev/core/ArchiveProcessor/PluginsArchiver.php#L91)*

Triggered to detect if the archiver should aggregate from raw data by using MySQL queries (when true)
or by aggregate archives (when false). Typically, data is aggregated from raw data for "day" period, and
aggregregated from archives for all other periods.

Callback Signature:
<pre><code>function(&amp;$shouldAggregateFromRawData, $this-&gt;params)</code></pre>

- bool `&$shouldAggregateFromRawData` Set to true, to aggregate from raw data, or false to aggregate multiple reports.

- [Parameters](/api-reference/Piwik/ArchiveProcessor/Parameters) `$params`

## Archiver

- [Archiver.addRecordBuilders](#archiveraddrecordbuilders)
- [Archiver.filterRecordBuilders](#archiverfilterrecordbuilders)

### Archiver.addRecordBuilders

*Defined in [Piwik/Plugin/Archiver](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Plugin/Archiver.php) in line [142](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Plugin/Archiver.php#L142)*

Triggered to add new RecordBuilders that cannot be picked up automatically by the platform. If you define RecordBuilders that take a parameter, for example, an ID to an entity your plugin
manages, use this event to add instances of that RecordBuilder to the global list.

**Example**

    public function addRecordBuilders(&$recordBuilders)
    {
        $recordBuilders[] = new MyParameterizedRecordBuilder($idOfThingToArchiveFor);
    }

Callback Signature:
<pre><code>function(&amp;$recordBuilders]</code></pre>

- \ArchiveProcessor\RecordBuilder `&$recordBuilders` An array of RecordBuilder instances

Usages:

[CustomDimensions::addRecordBuilders](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomDimensions/CustomDimensions.php#L93), [Goals::addRecordBuilders](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Goals/Goals.php#L118)


### Archiver.filterRecordBuilders

*Defined in [Piwik/Plugin/Archiver](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Plugin/Archiver.php) in line [164](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Plugin/Archiver.php#L164)*

Triggered to filter / restrict reports. **Example**

    public function filterRecordBuilders(&$recordBuilders)
    {
        foreach ($reports as $index => $recordBuilder) {
             if ($recordBuilders instanceof AnotherPluginRecordBuilder) {
                 unset($reports[$index]);
             }
        }
    }

Callback Signature:
<pre><code>function(&amp;$recordBuilders]</code></pre>

- \ArchiveProcessor\RecordBuilder `&$recordBuilders` An array of RecordBuilder instances

## Archiving

- [Archiving.getIdSitesToArchiveWhenNoVisits](#archivinggetidsitestoarchivewhennovisits)
- [Archiving.getIdSitesToMarkArchivesAsInvalidated](#archivinggetidsitestomarkarchivesasinvalidated)
- [Archiving.getIdSitesToMarkArchivesAsInvalidated](#archivinggetidsitestomarkarchivesasinvalidated)
- [Archiving.makeNewArchiverObject](#archivingmakenewarchiverobject)

### Archiving.getIdSitesToArchiveWhenNoVisits

*Defined in [Piwik/ArchiveProcessor/Loader](https://github.com/matomo-org/matomo/blob/5.x-dev/core/ArchiveProcessor/Loader.php) in line [447](https://github.com/matomo-org/matomo/blob/5.x-dev/core/ArchiveProcessor/Loader.php#L447)*



Callback Signature:
<pre><code>function(&amp;$idSites)</code></pre>


### Archiving.getIdSitesToMarkArchivesAsInvalidated

*Defined in [Piwik/Plugins/PrivacyManager/Model/DataSubjects](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/PrivacyManager/Model/DataSubjects.php) in line [155](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/PrivacyManager/Model/DataSubjects.php#L155)*



Callback Signature:
<pre><code>function(&amp;$idSites, $visitDates, null, null, null, $isPrivacyDeleteData = true)</code></pre>


### Archiving.getIdSitesToMarkArchivesAsInvalidated

*Defined in [Piwik/Archive/ArchiveInvalidator](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Archive/ArchiveInvalidator.php) in line [324](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Archive/ArchiveInvalidator.php#L324)*

Triggered when a Matomo user requested the invalidation of some reporting archives. Using this event, plugin
developers can automatically invalidate another site, when a site is being invalidated. A plugin may even
remove an idSite from the list of sites that should be invalidated to prevent it from ever being
invalidated. **Example**

    public function getIdSitesToMarkArchivesAsInvalidates(&$idSites)
    {
        if (in_array(1, $idSites)) {
            $idSites[] = 5; // when idSite 1 is being invalidated, also invalidate idSite 5
        }
    }

Callback Signature:
<pre><code>function(&amp;$idSites, $dates, $period, $segment, $name, $isPrivacyDeleteData = false)</code></pre>

- array &$idSites An array containing a list of site IDs which are requested to be invalidated.

- array `$dates` An array containing the dates to invalidate.

- string `$period` A string containing the period to be invalidated.

- null `$segment` A Segment Object containing segment to invalidate.

- string `$name` A string containing the name of the archive to be invalidated.

- bool `$isPrivacyDeleteData` A boolean value if event is triggered via Privacy delete visit action.


### Archiving.makeNewArchiverObject

*Defined in [Piwik/ArchiveProcessor/PluginsArchiver](https://github.com/matomo-org/matomo/blob/5.x-dev/core/ArchiveProcessor/PluginsArchiver.php) in line [365](https://github.com/matomo-org/matomo/blob/5.x-dev/core/ArchiveProcessor/PluginsArchiver.php#L365)*

Triggered right after a new **plugin archiver instance** is created. Subscribers to this event can configure the plugin archiver, for example prevent the archiving of a plugin's data
by calling `$archiver->disable()` method.

Callback Signature:
<pre><code>function($archiver, $pluginName, $this-&gt;params, false)</code></pre>

- [Archiver](/api-reference/Piwik/Plugin/Archiver) &$archiver The newly created plugin archiver instance.

- string `$pluginName` The name of plugin of which archiver instance was created.

- array `$this-&gt;params` Array containing archive parameters (Site, Period, Date and Segment)

- bool false This parameter is deprecated and will be removed.

## AssetManager

- [AssetManager.addStylesheets](#assetmanageraddstylesheets)
- [AssetManager.filterMergedJavaScripts](#assetmanagerfiltermergedjavascripts)
- [AssetManager.filterMergedJavaScripts](#assetmanagerfiltermergedjavascripts)
- [AssetManager.filterMergedJavaScripts](#assetmanagerfiltermergedjavascripts)
- [AssetManager.filterMergedStylesheets](#assetmanagerfiltermergedstylesheets)
- [AssetManager.getJavaScriptFiles](#assetmanagergetjavascriptfiles)
- [AssetManager.getStylesheetFiles](#assetmanagergetstylesheetfiles)

### AssetManager.addStylesheets

*Defined in [Piwik/AssetManager/UIAssetMerger/StylesheetUIAssetMerger](https://github.com/matomo-org/matomo/blob/5.x-dev/core/AssetManager/UIAssetMerger/StylesheetUIAssetMerger.php) in line [106](https://github.com/matomo-org/matomo/blob/5.x-dev/core/AssetManager/UIAssetMerger/StylesheetUIAssetMerger.php#L106)*

Triggered after all less stylesheets are concatenated into one long string but before it is
minified and merged into one file. This event can be used to add less stylesheets that are not located in a file on the disc.

Callback Signature:
<pre><code>function(&amp;$concatenatedContent)</code></pre>

- string `&$concatenatedContent` The content of all concatenated less files.

Usages:

[CoreHome::addStylesheets](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CoreHome/CoreHome.php#L89), [Morpheus::addStylesheets](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Morpheus/Morpheus.php#L29)


### AssetManager.filterMergedJavaScripts

*Defined in [Piwik/Plugins/CoreHome/tests/Integration/CoreHomeTest](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CoreHome/tests/Integration/CoreHomeTest.php) in line [26](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CoreHome/tests/Integration/CoreHomeTest.php#L26)*



Callback Signature:
<pre><code>function(&amp;$content)</code></pre>

Usages:

[CoreHome::filterMergedJavaScripts](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CoreHome/CoreHome.php#L135)


### AssetManager.filterMergedJavaScripts

*Defined in [Piwik/Plugins/CoreHome/tests/Integration/CoreHomeTest](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CoreHome/tests/Integration/CoreHomeTest.php) in line [34](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CoreHome/tests/Integration/CoreHomeTest.php#L34)*



Callback Signature:
<pre><code>function(&amp;$content)</code></pre>

Usages:

[CoreHome::filterMergedJavaScripts](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CoreHome/CoreHome.php#L135)


### AssetManager.filterMergedJavaScripts

*Defined in [Piwik/AssetManager/UIAssetMerger/JScriptUIAssetMerger](https://github.com/matomo-org/matomo/blob/5.x-dev/core/AssetManager/UIAssetMerger/JScriptUIAssetMerger.php) in line [69](https://github.com/matomo-org/matomo/blob/5.x-dev/core/AssetManager/UIAssetMerger/JScriptUIAssetMerger.php#L69)*

Triggered after all the JavaScript files Piwik uses are minified and merged into a
single file, but before the merged JavaScript is written to disk. Plugins can use this event to modify merged JavaScript or do something else
with it.

Callback Signature:
<pre><code>function(&amp;$mergedContent)</code></pre>

- string `&$mergedContent` The minified and merged JavaScript.

Usages:

[CoreHome::filterMergedJavaScripts](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CoreHome/CoreHome.php#L135)


### AssetManager.filterMergedStylesheets

*Defined in [Piwik/AssetManager/UIAssetMerger/StylesheetUIAssetMerger](https://github.com/matomo-org/matomo/blob/5.x-dev/core/AssetManager/UIAssetMerger/StylesheetUIAssetMerger.php) in line [146](https://github.com/matomo-org/matomo/blob/5.x-dev/core/AssetManager/UIAssetMerger/StylesheetUIAssetMerger.php#L146)*

Triggered after all less stylesheets are compiled to CSS, minified and merged into
one file, but before the generated CSS is written to disk. This event can be used to modify merged CSS.

Callback Signature:
<pre><code>function(&amp;$mergedContent)</code></pre>

- string `&$mergedContent` The merged and minified CSS.


### AssetManager.getJavaScriptFiles

*Defined in [Piwik/AssetManager/UIAssetFetcher/JScriptUIAssetFetcher](https://github.com/matomo-org/matomo/blob/5.x-dev/core/AssetManager/UIAssetFetcher/JScriptUIAssetFetcher.php) in line [44](https://github.com/matomo-org/matomo/blob/5.x-dev/core/AssetManager/UIAssetFetcher/JScriptUIAssetFetcher.php#L44)*

Triggered when gathering the list of all JavaScript files needed by Piwik
and its plugins. Plugins that have their own JavaScript should use this event to make those
files load in the browser.

JavaScript files should be placed within a **javascripts** subdirectory in your
plugin's root directory.

_Note: While you are developing your plugin you should enable the config setting
`[Development] disable_merged_assets` so JavaScript files will be reloaded immediately
after every change._

**Example**

    public function getJsFiles(&$jsFiles)
    {
        $jsFiles[] = "plugins/MyPlugin/javascripts/myfile.js";
        $jsFiles[] = "plugins/MyPlugin/javascripts/anotherone.js";
    }

Callback Signature:
<pre><code>function(&amp;$this-&gt;fileLocations)</code></pre>

- string `$jsFiles` The JavaScript files to load.

Usages:

[Actions::getJsFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Actions/Actions.php#L114), [Annotations::getJsFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Annotations/Annotations.php#L52), [AnonymousPiwikUsageMeasurement::getJsFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/AnonymousPiwikUsageMeasurement/AnonymousPiwikUsageMeasurement.php#L100), [Contents::getJsFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Contents/Contents.php#L45), [CoreAdminHome::getJsFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CoreAdminHome/CoreAdminHome.php#L147), [CoreHome::getJsFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CoreHome/CoreHome.php#L184), [CorePluginsAdmin::getJsFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CorePluginsAdmin/CorePluginsAdmin.php#L103), [CoreVisualizations::getJsFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CoreVisualizations/CoreVisualizations.php#L78), [CoreVue::getJsFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CoreVue/CoreVue.php#L23), [CustomAlerts::getJavaScriptFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomAlerts/CustomAlerts.php#L100), [CustomDimensions::getJsFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomDimensions/CustomDimensions.php#L209), [Dashboard::getJsFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Dashboard/Dashboard.php#L288), [Feedback::getJsFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Feedback/Feedback.php#L43), [Insights::getJsFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Insights/Insights.php#L30), [Live::getJsFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Live/Live.php#L152), [LogViewer::getJsFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/LogViewer/LogViewer.php#L31), [Login::getJsFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/Login.php#L255), [LoginLdap::getJsFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/LoginLdap/LoginLdap.php#L57), [Marketplace::getJsFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Marketplace/Marketplace.php#L63), [Overlay::getJsFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Overlay/Overlay.php#L32), [PagePerformance::getJsFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/PagePerformance/PagePerformance.php#L52), [Referrers::getJsFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Referrers/Referrers.php#L137), [ScheduledReports::getJsFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/ScheduledReports/ScheduledReports.php#L210), [SegmentEditor::getJsFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/SegmentEditor/SegmentEditor.php#L337), [TagManager::getJsFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TagManager/TagManager.php#L974), [Transitions::getJsFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Transitions/Transitions.php#L42), [TreemapVisualization::getJsFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TreemapVisualization/TreemapVisualization.php#L56), [TwoFactorAuth::getJsFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TwoFactorAuth/TwoFactorAuth.php#L118), [UserCountry::getJsFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/UserCountry/UserCountry.php#L65), [UserCountryMap::getJsFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/UserCountryMap/UserCountryMap.php#L44), [UserId::getJavaScriptFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/UserId/UserId.php#L38), [Widgetize::getJsFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Widgetize/Widgetize.php#L26)


### AssetManager.getStylesheetFiles

*Defined in [Piwik/AssetManager/UIAssetFetcher/StylesheetUIAssetFetcher](https://github.com/matomo-org/matomo/blob/5.x-dev/core/AssetManager/UIAssetFetcher/StylesheetUIAssetFetcher.php) in line [70](https://github.com/matomo-org/matomo/blob/5.x-dev/core/AssetManager/UIAssetFetcher/StylesheetUIAssetFetcher.php#L70)*

Triggered when gathering the list of all stylesheets (CSS and LESS) needed by
Piwik and its plugins. Plugins that have stylesheets should use this event to make those stylesheets
load.

Stylesheets should be placed within a **stylesheets** subdirectory in your plugin's
root directory.

**Example**

    public function getStylesheetFiles(&$stylesheets)
    {
        $stylesheets[] = "plugins/MyPlugin/stylesheets/myfile.less";
        $stylesheets[] = "plugins/MyPlugin/stylesheets/myotherfile.css";
    }

Callback Signature:
<pre><code>function(&amp;$this-&gt;fileLocations)</code></pre>

- string &$stylesheets The list of stylesheet paths.

Usages:

[Plugin::getStylesheetFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/API/API.php#L975), [Annotations::getStylesheetFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Annotations/Annotations.php#L44), [BotTracking::getStylesheetFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/BotTracking/BotTracking.php#L189), [CoreAdminHome::getStylesheetFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CoreAdminHome/CoreAdminHome.php#L136), [CoreHome::getStylesheetFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CoreHome/CoreHome.php#L140), [CorePluginsAdmin::getStylesheetFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CorePluginsAdmin/CorePluginsAdmin.php#L83), [CoreVisualizations::getStylesheetFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CoreVisualizations/CoreVisualizations.php#L65), [CustomAlerts::getStylesheetFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomAlerts/CustomAlerts.php#L104), [CustomDimensions::getStylesheetFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomDimensions/CustomDimensions.php#L214), [CustomVariables::getStylesheetFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomVariables/CustomVariables.php#L139), [DBStats::getStylesheetFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/DBStats/DBStats.php#L38), [Dashboard::getStylesheetFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Dashboard/Dashboard.php#L296), [DevicesDetection::getStylesheetFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/DevicesDetection/DevicesDetection.php#L53), [Diagnostics::getStylesheetFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Diagnostics/Diagnostics.php#L44), [Events::getStylesheetFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Events/Events.php#L257), [Feedback::getStylesheetFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Feedback/Feedback.php#L35), [Goals::getStylesheetFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Goals/Goals.php#L461), [Insights::getStylesheetFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Insights/Insights.php#L25), [Installation::getStylesheetFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Installation/Installation.php#L147), [JsTrackerInstallCheck::getStylesheetFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/JsTrackerInstallCheck/JsTrackerInstallCheck.php#L41), [Live::getStylesheetFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Live/Live.php#L146), [LogViewer::getStylesheetFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/LogViewer/LogViewer.php#L26), [Login::getStylesheetFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/Login.php#L265), [LoginLdap::getStylesheetFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/LoginLdap/LoginLdap.php#L62), [MarketingCampaignsReporting::getStylesheetFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/MarketingCampaignsReporting/MarketingCampaignsReporting.php#L49), [Marketplace::getStylesheetFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Marketplace/Marketplace.php#L55), [MobileMessaging::getStylesheetFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/MobileMessaging/MobileMessaging.php#L85), [MultiSites::getStylesheetFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/MultiSites/MultiSites.php#L111), [PrivacyManager::getStylesheetFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/PrivacyManager/PrivacyManager.php#L606), [ProfessionalServices::getStylesheetFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/ProfessionalServices/ProfessionalServices.php#L42), [Referrers::getStylesheetFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Referrers/Referrers.php#L103), [RssWidget::getStylesheetFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/RssWidget/RssWidget.php#L31), [ScheduledReports::getStylesheetFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/ScheduledReports/ScheduledReports.php#L214), [SecurityInfo::getStylesheetFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/SecurityInfo/SecurityInfo.php#L27), [SegmentEditor::getStylesheetFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/SegmentEditor/SegmentEditor.php#L343), [SitesManager::getStylesheetFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/SitesManager/SitesManager.php#L168), [TagManager::getStylesheetFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TagManager/TagManager.php#L959), [Tour::getStylesheetFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Tour/Tour.php#L135), [Transitions::getStylesheetFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Transitions/Transitions.php#L36), [TreemapVisualization::getStylesheetFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TreemapVisualization/TreemapVisualization.php#L50), [TwoFactorAuth::getStylesheetFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TwoFactorAuth/TwoFactorAuth.php#L113), [UserCountry::getStylesheetFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/UserCountry/UserCountry.php#L60), [UserCountryMap::getStylesheetFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/UserCountryMap/UserCountryMap.php#L55), [UsersManager::getStylesheetFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/UsersManager/UsersManager.php#L172), [VisitsSummary::getStylesheetFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/VisitsSummary/VisitsSummary.php#L72), [Widgetize::getStylesheetFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Widgetize/Widgetize.php#L34)

## Category

- [Category.addSubcategories](#categoryaddsubcategories)

### Category.addSubcategories

*Defined in [Piwik/Plugin/Categories](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Plugin/Categories.php) in line [63](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Plugin/Categories.php#L63)*

Triggered to add custom subcategories. **Example**

    public function addSubcategories(&$subcategories)
    {
        $subcategory = new Subcategory();
        $subcategory->setId('General_Overview');
        $subcategory->setCategoryId('General_Visits');
        $subcategory->setOrder(5);
        $subcategories[] = $subcategory;
    }

Callback Signature:
<pre><code>function(&amp;$subcategories)</code></pre>

- array &$subcategories An array containing a list of subcategories.

Usages:

[CustomDimensions::addSubcategories](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomDimensions/CustomDimensions.php#L174), [Dashboard::addSubcategories](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Dashboard/Dashboard.php#L101), [Goals::addSubcategories](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Goals/Goals.php#L200)

## Changes

- [Changes.filterChanges](#changesfilterchanges)

### Changes.filterChanges

*Defined in [Piwik/Changes/Model](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Changes/Model.php) in line [222](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Changes/Model.php#L222)*

Event triggered before changes are displayed Can be used to filter out unwanted changes

**Example**

    Piwik::addAction('Changes.filterChanges', function ($changes) {
        foreach ($changes as $k => $c) {
            // Hide changes for the CoreHome plugin
            if (isset($c['plugin_name']) && $c['plugin_name'] == 'CoreHome') {
                 unset($changes[$k]);
            }
        }
    });

Callback Signature:
<pre><code>function(&amp;$changes)</code></pre>

- array &$changes

## CliMulti

- [CliMulti.supportsAsync](#climultisupportsasync)

### CliMulti.supportsAsync

*Defined in [Piwik/CliMulti](https://github.com/matomo-org/matomo/blob/5.x-dev/core/CliMulti.php) in line [401](https://github.com/matomo-org/matomo/blob/5.x-dev/core/CliMulti.php#L401)*

Triggered to allow plugins to force the usage of async cli multi execution or to disable it. **Example**

    public function supportsAsync(&$supportsAsync)
    {
        $supportsAsync = false; // do not allow async climulti execution
    }

Callback Signature:
<pre><code>function(&amp;$supportsAsync)</code></pre>

- bool &$supportsAsync Whether async is supported or not.

## CompliancePolicy

- [CompliancePolicy.setActiveStatus](#compliancepolicysetactivestatus)
- [CompliancePolicy.shouldShowWarnings](#compliancepolicyshouldshowwarnings)
- [CompliancePolicy.updatePolicyDescription](#compliancepolicyupdatepolicydescription)

### CompliancePolicy.setActiveStatus

*Defined in [Piwik/Policy/CompliancePolicy](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Policy/CompliancePolicy.php) in line [168](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Policy/CompliancePolicy.php#L168)*

This event is triggered when the status of a compliance policy changes, and
is to be used to perform extra actions when a policy is activated/deactivated. The status of a policy cannot be changed via this event.

Callback Signature:
<pre><code>function($isActive, $idSite, static::class]</code></pre>

- bool `$isActive` Whether the policy is being activated or deactivated

- int `$idSite`

- \class-string<CompliancePolicy> The compliance policy in question


### CompliancePolicy.shouldShowWarnings

*Defined in [Piwik/Policy/CompliancePolicy](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Policy/CompliancePolicy.php) in line [69](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Policy/CompliancePolicy.php#L69)*

This event is triggered while the description of a compliance policy is
being generated, and controls whether any warnings specific to the policy
are displayed at the end of the description.

Callback Signature:
<pre><code>function(&amp;$shouldShowWarnings, static::class]</code></pre>

- bool &$shouldShowWarnings set to false if the warnings should be hidden


### CompliancePolicy.updatePolicyDescription

*Defined in [Piwik/Policy/CompliancePolicy](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Policy/CompliancePolicy.php) in line [58](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Policy/CompliancePolicy.php#L58)*

This event is triggered while the description of a compliance policy is
being generated. The policy description can be modified via this event.

Callback Signature:
<pre><code>function(&amp;$description, static::class]</code></pre>

- string &$description of the policy.

## Config

- [Config.badConfigurationFile](#configbadconfigurationfile)
- [Config.beforeSave](#configbeforesave)
- [Config.NoConfigurationFile](#confignoconfigurationfile)

### Config.badConfigurationFile

*Defined in [Piwik/FrontController](https://github.com/matomo-org/matomo/blob/5.x-dev/core/FrontController.php) in line [381](https://github.com/matomo-org/matomo/blob/5.x-dev/core/FrontController.php#L381)*

Triggered when Piwik cannot access database data. This event can be used to start the installation process or to display a custom error
message.

Callback Signature:
<pre><code>function($exception)</code></pre>

- [\Exception](http://php.net/class.\Exception) `$exception` The exception thrown from trying to get an option value.

Usages:

[Installation::dispatch](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Installation/Installation.php#L120)


### Config.beforeSave

*Defined in [Piwik/Config/IniFileChain](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Config/IniFileChain.php) in line [545](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Config/IniFileChain.php#L545)*

Triggered before a config is being written / saved on the local file system. A plugin can listen to it and modify which settings will be saved on the file system. This allows you
to prevent saving config values that a plugin sets on demand. Say you configure the database password in the
config on demand in your plugin, then you could prevent that the password is saved in the actual config file
by listening to this event like this:

**Example**
    function doNotSaveDbPassword (&$values) {
        unset($values['database']['password']);
    }

Callback Signature:
<pre><code>function(&amp;$values]</code></pre>

- array &$values Config values that will be saved


### Config.NoConfigurationFile

*Defined in [Piwik/Application/Kernel/EnvironmentValidator](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Application/Kernel/EnvironmentValidator.php) in line [116](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Application/Kernel/EnvironmentValidator.php#L116)*

Triggered when the configuration file cannot be found or read, which usually
means Piwik is not installed yet. This event can be used to start the installation process or to display a custom error message.

Callback Signature:
<pre><code>function($exception)</code></pre>

- [\Exception](http://php.net/class.\Exception) `$exception` The exception that was thrown by `Config::getInstance()`.

Usages:

[Installation::dispatch](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Installation/Installation.php#L120), [LanguagesManager::initLanguage](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/LanguagesManager/LanguagesManager.php#L106)

## Console

- [Console.filterCommands](#consolefiltercommands)

### Console.filterCommands

*Defined in [Piwik/Console](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Console.php) in line [216](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Console.php#L216)*

Triggered to filter / restrict console commands. Plugins that want to restrict commands
should subscribe to this event and remove commands from the existing list. **Example**

    public function filterConsoleCommands(&$commands)
    {
        $key = array_search('Piwik\Plugins\MyPlugin\Commands\MyCommand', $commands);
        if (false !== $key) {
            unset($commands[$key]);
        }
    }

Callback Signature:
<pre><code>function(&amp;$commands)</code></pre>

- array &$commands An array containing a list of command class names.

## Controller

- [Controller.$module.$action](#controllermoduleaction)
- [Controller.$module.$action.end](#controllermoduleactionend)
- [Controller.triggerAdminNotifications](#controllertriggeradminnotifications)

### Controller.$module.$action

*Defined in [Piwik/FrontController](https://github.com/matomo-org/matomo/blob/5.x-dev/core/FrontController.php) in line [665](https://github.com/matomo-org/matomo/blob/5.x-dev/core/FrontController.php#L665)*

Triggered directly before controller actions are dispatched. This event exists for convenience and is triggered directly after the [Request.dispatch](/api-reference/events#requestdispatch)
event is triggered.

It can be used to do the same things as the [Request.dispatch](/api-reference/events#requestdispatch) event, but for one controller
action only. Using this event will result in a little less code than [Request.dispatch](/api-reference/events#requestdispatch).

Callback Signature:
<pre><code>function(&amp;$parameters)</code></pre>

- array &$parameters The arguments passed to the controller action.


### Controller.$module.$action.end

*Defined in [Piwik/FrontController](https://github.com/matomo-org/matomo/blob/5.x-dev/core/FrontController.php) in line [682](https://github.com/matomo-org/matomo/blob/5.x-dev/core/FrontController.php#L682)*

Triggered after a controller action is successfully called. This event exists for convenience and is triggered immediately before the [Request.dispatch.end](/api-reference/events#requestdispatchend)
event is triggered.

It can be used to do the same things as the [Request.dispatch.end](/api-reference/events#requestdispatchend) event, but for one
controller action only. Using this event will result in a little less code than
[Request.dispatch.end](/api-reference/events#requestdispatchend).

Callback Signature:
<pre><code>function(&amp;$result, $parameters)</code></pre>

- mixed &$result The result of the controller action.

- array `$parameters` The arguments passed to the controller action.


### Controller.triggerAdminNotifications

*Defined in [Piwik/Plugin/ControllerAdmin](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Plugin/ControllerAdmin.php) in line [529](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Plugin/ControllerAdmin.php#L529)*

Posted when rendering an admin page and notifications about any warnings or errors should be triggered. You can use it for example when you have a plugin that needs to be configured in order to work and the
plugin has not been configured yet. It can be also used to cancel / remove other notifications by calling
eg `Notification\Manager::cancel($notificationId)`.

**Example**

    public function onTriggerAdminNotifications(Piwik\Widget\WidgetsList $list)
    {
        if ($pluginFooIsNotConfigured) {
             $notification = new Notification('The plugin foo has not been configured yet');
             $notification->context = Notification::CONTEXT_WARNING;
             Notification\Manager::notify('fooNotConfigured', $notification);
        }
    }

## Core

- [Core.configFileChanged](#coreconfigfilechanged)
- [Core.configFileDeleted](#coreconfigfiledeleted)
- [Core.configFileSanityCheckFailed](#coreconfigfilesanitycheckfailed)

### Core.configFileChanged

*Defined in [Piwik/Config](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Config.php) in line [430](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Config.php#L430)*

Triggered when a INI config file is changed on disk.

Callback Signature:
<pre><code>function($localPath]</code></pre>

- string `$localPath` Absolute path to the changed file on the server.


### Core.configFileDeleted

*Defined in [Piwik/Config/Cache](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Config/Cache.php) in line [88](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Config/Cache.php#L88)*



Callback Signature:
<pre><code>function($this-&gt;getFilename($id)]</code></pre>


### Core.configFileSanityCheckFailed

*Defined in [Piwik/Config](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Config.php) in line [499](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Config.php#L499)*

Triggered when the INI config file was not written correctly with the expected content.

Callback Signature:
<pre><code>function($localPath]</code></pre>

- string `$localPath` Absolute path to the changed file on the server.

## CoreAdminHome

- [CoreAdminHome.archiveReports.complete](#coreadminhomearchivereportscomplete)
- [CoreAdminHome.archiveReports.start](#coreadminhomearchivereportsstart)
- [CoreAdminHome.customLogoChanged](#coreadminhomecustomlogochanged)

### CoreAdminHome.archiveReports.complete

*Defined in [Piwik/Plugins/CoreAdminHome/API](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CoreAdminHome/API.php) in line [370](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CoreAdminHome/API.php#L370)*

Triggered after a full archiveReports run completes. Usage example:
Piwik::addAction('CoreAdminHome.archiveReports.complete', function ($idSite, $period, $segment, $plugin, $report, $isArchivePhpTriggered, $idArchives, $wasCached) { ... });

Callback Signature:
<pre><code>function($idSite, $period, $segmentObj, (string) $plugin, $report, $isArchivePhpTriggered, $idArchives, $wasCached]</code></pre>

Usages:

[ArchivingMetrics::onArchiveReportsComplete](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/ArchivingMetrics/ArchivingMetrics.php#L45)


### CoreAdminHome.archiveReports.start

*Defined in [Piwik/Plugins/CoreAdminHome/API](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CoreAdminHome/API.php) in line [339](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CoreAdminHome/API.php#L339)*

Triggered before a full archiveReports run starts. Usage example:
Piwik::addAction('CoreAdminHome.archiveReports.start', function ($idSite, $period, $segment, $plugin, $report, $isArchivePhpTriggered) { ... });

Callback Signature:
<pre><code>function($idSite, $period, $segmentObj, (string) $plugin, $report, $isArchivePhpTriggered]</code></pre>

Usages:

[ArchivingMetrics::onArchiveReportsStart](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/ArchivingMetrics/ArchivingMetrics.php#L28)


### CoreAdminHome.customLogoChanged

*Defined in [Piwik/Plugins/CoreAdminHome/CustomLogo](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CoreAdminHome/CustomLogo.php) in line [260](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CoreAdminHome/CustomLogo.php#L260)*

Triggered when a user uploads a custom logo. This event is triggered for
the large logo, for the smaller logo-header.png file, and for the favicon.

Callback Signature:
<pre><code>function($absolutePath]</code></pre>

- string `$absolutePath` The absolute path to the logo file on the Piwik server.

## CoreUpdater

- [CoreUpdater.update.end](#coreupdaterupdateend)
- [CoreUpdater.update.end](#coreupdaterupdateend)

### CoreUpdater.update.end

*Defined in [Piwik/Plugins/TagManager/tests/Integration/TagManagerTest](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TagManager/tests/Integration/TagManagerTest.php) in line [45](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TagManager/tests/Integration/TagManagerTest.php#L45)*



Usages:

[CustomJsTracker::updateTracker](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomJsTracker/CustomJsTracker.php#L32), [TagManager::onPluginActivateOrInstall](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TagManager/TagManager.php#L200)


### CoreUpdater.update.end

*Defined in [Piwik/Updater](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Updater.php) in line [529](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Updater.php#L529)*

Triggered after Piwik has been updated.

Usages:

[CustomJsTracker::updateTracker](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomJsTracker/CustomJsTracker.php#L32), [TagManager::onPluginActivateOrInstall](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TagManager/TagManager.php#L200)

## CronArchive

- [CronArchive.archiveSingleSite.finish](#cronarchivearchivesinglesitefinish)
- [CronArchive.archiveSingleSite.start](#cronarchivearchivesinglesitestart)
- [CronArchive.end](#cronarchiveend)
- [CronArchive.filterWebsiteIds](#cronarchivefilterwebsiteids)
- [CronArchive.getIdSitesNotUsingTracker](#cronarchivegetidsitesnotusingtracker)
- [CronArchive.init.finish](#cronarchiveinitfinish)
- [CronArchive.init.start](#cronarchiveinitstart)

### CronArchive.archiveSingleSite.finish

*Defined in [Piwik/CronArchive/QueueConsumer](https://github.com/matomo-org/matomo/blob/5.x-dev/core/CronArchive/QueueConsumer.php) in line [312](https://github.com/matomo-org/matomo/blob/5.x-dev/core/CronArchive/QueueConsumer.php#L312)*

This event is triggered immediately after the cron archiving process starts archiving data for a single
site. Note: multiple archiving processes can post this event.

Callback Signature:
<pre><code>function($this-&gt;idSite, $this-&gt;pid)</code></pre>

- int `$idSite` The ID of the site we're archiving data for.

- string `$pid` The PID of the process processing archives for this site.


### CronArchive.archiveSingleSite.start

*Defined in [Piwik/CronArchive/QueueConsumer](https://github.com/matomo-org/matomo/blob/5.x-dev/core/CronArchive/QueueConsumer.php) in line [165](https://github.com/matomo-org/matomo/blob/5.x-dev/core/CronArchive/QueueConsumer.php#L165)*

This event is triggered before the cron archiving process starts archiving data for a single
site. Note: multiple archiving processes can post this event.

Callback Signature:
<pre><code>function($this-&gt;idSite, $this-&gt;pid)</code></pre>

- int `$idSite` The ID of the site we're archiving data for.

- string `$pid` The PID of the process processing archives for this site.


### CronArchive.end

*Defined in [Piwik/CronArchive](https://github.com/matomo-org/matomo/blob/5.x-dev/core/CronArchive.php) in line [717](https://github.com/matomo-org/matomo/blob/5.x-dev/core/CronArchive.php#L717)*

This event is triggered after archiving.

Callback Signature:
<pre><code>function($this]</code></pre>

- \CronArchive `$this`


### CronArchive.filterWebsiteIds

*Defined in [Piwik/CronArchive](https://github.com/matomo-org/matomo/blob/5.x-dev/core/CronArchive.php) in line [903](https://github.com/matomo-org/matomo/blob/5.x-dev/core/CronArchive.php#L903)*

Triggered by the **core:archive** console command so plugins can modify the priority of
websites that the archiving process will be launched for. Plugins can use this hook to add websites to archive, remove websites to archive, or change
the order in which websites will be archived.

Callback Signature:
<pre><code>function(&amp;$websiteIds]</code></pre>

- array `&$websiteIds` The list of website IDs to launch the archiving process for.


### CronArchive.getIdSitesNotUsingTracker

*Defined in [Piwik/ArchiveProcessor/Loader](https://github.com/matomo-org/matomo/blob/5.x-dev/core/ArchiveProcessor/Loader.php) in line [675](https://github.com/matomo-org/matomo/blob/5.x-dev/core/ArchiveProcessor/Loader.php#L675)*

This event is triggered when detecting whether there are sites that do not use the tracker. By default we only archive a site when there was actually any visit since the last archiving.
However, some plugins do import data from another source instead of using the tracker and therefore
will never have any visits for this site. To make sure we still archive data for such a site when
archiving for this site is requested, you can listen to this event and add the idSite to the list of
sites that do not use the tracker.

Callback Signature:
<pre><code>function(&amp;$idSitesNotUsingTracker)</code></pre>

- bool `&$idSitesNotUsingTracker` The list of idSites that rather import data instead of using the tracker


### CronArchive.init.finish

*Defined in [Piwik/CronArchive](https://github.com/matomo-org/matomo/blob/5.x-dev/core/CronArchive.php) in line [394](https://github.com/matomo-org/matomo/blob/5.x-dev/core/CronArchive.php#L394)*

This event is triggered after a CronArchive instance is initialized.

Callback Signature:
<pre><code>function($this-&gt;allWebsites]</code></pre>

- array `$websiteIds` The list of website IDs this CronArchive instance is processing.
                         This will be the entire list of IDs regardless of whether some have
                         already been processed.


### CronArchive.init.start

*Defined in [Piwik/CronArchive](https://github.com/matomo-org/matomo/blob/5.x-dev/core/CronArchive.php) in line [350](https://github.com/matomo-org/matomo/blob/5.x-dev/core/CronArchive.php#L350)*

This event is triggered during initializing archiving.

Callback Signature:
<pre><code>function($this]</code></pre>

- \CronArchive `$this`

## CustomAlerts

- [CustomAlerts.sendNewAlerts](#customalertssendnewalerts)
- [CustomAlerts.validateReportParameters](#customalertsvalidatereportparameters)

### CustomAlerts.sendNewAlerts

*Defined in [Piwik/Plugins/CustomAlerts/Notifier](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomAlerts/Notifier.php) in line [48](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomAlerts/Notifier.php#L48)*



Callback Signature:
<pre><code>function($triggeredAlerts]</code></pre>


### CustomAlerts.validateReportParameters

*Defined in [Piwik/Plugins/CustomAlerts/API](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomAlerts/API.php) in line [224](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomAlerts/API.php#L224)*



Callback Signature:
<pre><code>function(get_defined_vars(), $reportMedium]</code></pre>

Usages:

[CustomAlerts::validateReportParameters](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomAlerts/CustomAlerts.php#L294)

## CustomJsTracker

- [CustomJsTracker.manipulateJsTracker](#customjstrackermanipulatejstracker)
- [CustomJsTracker.shouldAddTrackerFile](#customjstrackershouldaddtrackerfile)
- [CustomJsTracker.trackerJsChanged](#customjstrackertrackerjschanged)
- [CustomJsTracker.trackerJsChanged](#customjstrackertrackerjschanged)
- [CustomJsTracker.updateTracker](#customjstrackerupdatetracker)

### CustomJsTracker.manipulateJsTracker

*Defined in [Piwik/Plugins/CustomJsTracker/TrackingCode/PiwikJsManipulator](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomJsTracker/TrackingCode/PiwikJsManipulator.php) in line [57](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomJsTracker/TrackingCode/PiwikJsManipulator.php#L57)*

Triggered after the Matomo JavaScript tracker has been generated and shortly before the tracker file
is written to disk. You can listen to this event to for example automatically append some code to the JS
tracker file. **Example**

    function onManipulateJsTracker (&$content) {
        $content .= "\nPiwik.DOM.onLoad(function () { console.log('loaded'); });";
    }

Callback Signature:
<pre><code>function(&amp;$content)</code></pre>

- string `&$content` the generated JavaScript tracker code


### CustomJsTracker.shouldAddTrackerFile

*Defined in [Piwik/Plugins/CustomJsTracker/TrackingCode/PluginTrackerFiles](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomJsTracker/TrackingCode/PluginTrackerFiles.php) in line [87](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomJsTracker/TrackingCode/PluginTrackerFiles.php#L87)*

Detect if a custom tracker file should be added to the piwik.js tracker or not. This is useful for example if a plugin only wants to add its tracker file when the plugin is configured.

Callback Signature:
<pre><code>function(&amp;$shouldAddFile, $pluginName)</code></pre>

- bool &$shouldAddFile Decides whether the tracker file belonging to the given plugin should be added or not.

- string `$pluginName` The name of the plugin this file belongs to

Usages:

[PrivacyManager::shouldAddTrackerFile](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/PrivacyManager/PrivacyManager.php#L1026)


### CustomJsTracker.trackerJsChanged

*Defined in [Piwik/Plugins/CustomJsTracker/TrackerUpdater](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomJsTracker/TrackerUpdater.php) in line [143](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomJsTracker/TrackerUpdater.php#L143)*

Triggered after the tracker JavaScript content (the content of the piwik.js file) is changed.

Callback Signature:
<pre><code>function($savedFile]</code></pre>

- string `$absolutePath` The path to the new piwik.js file.

Usages:

[TagManager::regenerateReleasedContainers](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TagManager/TagManager.php#L344)


### CustomJsTracker.trackerJsChanged

*Defined in [Piwik/Plugins/CustomJsTracker/TrackerUpdater](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomJsTracker/TrackerUpdater.php) in line [160](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomJsTracker/TrackerUpdater.php#L160)*



Callback Signature:
<pre><code>function($savedFile]</code></pre>

Usages:

[TagManager::regenerateReleasedContainers](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TagManager/TagManager.php#L344)


### CustomJsTracker.updateTracker

*Defined in [Piwik/Plugins/PrivacyManager/API](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/PrivacyManager/API.php) in line [459](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/PrivacyManager/API.php#L459)*



Usages:

[CustomJsTracker::updateTracker](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomJsTracker/CustomJsTracker.php#L32)

## Db

- [Db.cannotConnectToDb](#dbcannotconnecttodb)
- [Db.getActionReferenceColumnsByTable](#dbgetactionreferencecolumnsbytable)
- [Db.getDatabaseConfig](#dbgetdatabaseconfig)
- [Db.getTablesInstalled](#dbgettablesinstalled)

### Db.cannotConnectToDb

*Defined in [Piwik/FrontController](https://github.com/matomo-org/matomo/blob/5.x-dev/core/FrontController.php) in line [358](https://github.com/matomo-org/matomo/blob/5.x-dev/core/FrontController.php#L358)*

Triggered when Piwik cannot connect to the database. This event can be used to start the installation process or to display a custom error
message.

Callback Signature:
<pre><code>function($exception)</code></pre>

- [\Exception](http://php.net/class.\Exception) `$exception` The exception thrown from creating and testing the database
                            connection.

Usages:

[Installation::displayDbConnectionMessage](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Installation/Installation.php#L62)


### Db.getActionReferenceColumnsByTable

*Defined in [Piwik/Plugin/Dimension/DimensionMetadataProvider](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Plugin/Dimension/DimensionMetadataProvider.php) in line [94](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Plugin/Dimension/DimensionMetadataProvider.php#L94)*

Triggered when detecting which log_action entries to keep. Any log tables that use the log_action
table to reference text via an ID should add their table info so no actions that are still in use
will be accidentally deleted. **Example**

    Piwik::addAction('Db.getActionReferenceColumnsByTable', function(&$result) {
        $tableNameUnprefixed = 'log_example';
        $columnNameThatReferencesIdActionInLogActionTable = 'idaction_example';
        $result[$tableNameUnprefixed] = array($columnNameThatReferencesIdActionInLogActionTable);
    });

Callback Signature:
<pre><code>function(&amp;$result)</code></pre>

- array `&$result`


### Db.getDatabaseConfig

*Defined in [Piwik/Db](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Db.php) in line [131](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Db.php#L131)*

Triggered before a database connection is established. This event can be used to change the settings used to establish a connection.

Callback Signature:
<pre><code>function(&amp;$dbConfig)</code></pre>

- array *$dbInfos Reference to an array containing database connection info,
                       including:

                       - **host**: The host name or IP address to the MySQL database.
                       - **username**: The username to use when connecting to the
                                       database.
                       - **password**: The password to use when connecting to the
                                      database.
                       - **dbname**: The name of the Piwik MySQL database.
                       - **port**: The MySQL database port to use.
                       - **adapter**: either `'PDO\MYSQL'` or `'MYSQLI'`
                       - **type**: The MySQL engine to use, for instance 'InnoDB'


### Db.getTablesInstalled

*Defined in [Piwik/Db/Schema/Mysql](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Db/Schema/Mysql.php) in line [529](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Db/Schema/Mysql.php#L529)*



Callback Signature:
<pre><code>function(&amp;$allMyTables]</code></pre>

Usages:

[AnonymousPiwikUsageMeasurement::getTablesInstalled](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/AnonymousPiwikUsageMeasurement/AnonymousPiwikUsageMeasurement.php#L56), [CustomAlerts::getTablesInstalled](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomAlerts/CustomAlerts.php#L58), [CustomDimensions::getTablesInstalled](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomDimensions/CustomDimensions.php#L417), [Dashboard::getTablesInstalled](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Dashboard/Dashboard.php#L44), [ExampleLogTables::getTablesInstalled](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/ExampleLogTables/ExampleLogTables.php#L39), [LanguagesManager::getTablesInstalled](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/LanguagesManager/LanguagesManager.php#L61), [PrivacyManager::getTablesInstalled](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/PrivacyManager/PrivacyManager.php#L250), [QueuedTracking::getTablesInstalled](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/QueuedTracking/QueuedTracking.php#L35), [ScheduledReports::getTablesInstalled](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/ScheduledReports/ScheduledReports.php#L112), [SegmentEditor::getTablesInstalled](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/SegmentEditor/SegmentEditor.php#L81), [TagManager::getTablesInstalled](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TagManager/TagManager.php#L87)

## Dimension

- [Dimension.addDimensions](#dimensionadddimensions)
- [Dimension.filterDimensions](#dimensionfilterdimensions)

### Dimension.addDimensions

*Defined in [Piwik/Columns/Dimension](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Columns/Dimension.php) in line [728](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Columns/Dimension.php#L728)*

Triggered to add new dimensions that cannot be picked up automatically by the platform. This is useful if the plugin allows a user to create reports / dimensions dynamically. For example
CustomDimensions or CustomVariables. There are a variable number of dimensions in this case and it
wouldn't be really possible to create a report file for one of these dimensions as it is not known
how many Custom Dimensions will exist.

**Example**

    public function addDimension(&$dimensions)
    {
        $dimensions[] = new MyCustomDimension();
    }

Callback Signature:
<pre><code>function(&amp;$instances)</code></pre>

- [Dimension](/api-reference/Piwik/Columns/Dimension) `$reports` An array of dimensions

Usages:

[CustomDimensions::addDimensions](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomDimensions/CustomDimensions.php#L111), [CustomVariables::addDimensions](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomVariables/CustomVariables.php#L44)


### Dimension.filterDimensions

*Defined in [Piwik/Columns/Dimension](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Columns/Dimension.php) in line [752](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Columns/Dimension.php#L752)*

Triggered to filter / restrict dimensions. **Example**

    public function filterDimensions(&$dimensions)
    {
        foreach ($dimensions as $index => $dimension) {
             if ($dimension->getName() === 'Page URL') {}
                 unset($dimensions[$index]); // remove this dimension
             }
        }
    }

Callback Signature:
<pre><code>function(&amp;$instances)</code></pre>

- [Dimension](/api-reference/Piwik/Columns/Dimension) `$dimensions` An array of dimensions

## EntityDuplicator

- [EntityDuplicator.DuplicationSuccessful](#entityduplicatorduplicationsuccessful)

### EntityDuplicator.DuplicationSuccessful

*Defined in [Piwik/Plugins/CoreHome/EntityDuplicator/DuplicateRequestResponse](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CoreHome/EntityDuplicator/DuplicateRequestResponse.php) in line [133](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CoreHome/EntityDuplicator/DuplicateRequestResponse.php#L133)*



Callback Signature:
<pre><code>$this-&gt;eventDataToPost</code></pre>

## Environment

- [Environment.bootstrapped](#environmentbootstrapped)

### Environment.bootstrapped

*Defined in [Piwik/Application/Environment](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Application/Environment.php) in line [105](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Application/Environment.php#L105)*



## Feedback

- [Feedback.showQuestionBanner](#feedbackshowquestionbanner)

### Feedback.showQuestionBanner

*Defined in [Piwik/Plugins/Feedback/Feedback](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Feedback/Feedback.php) in line [131](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Feedback/Feedback.php#L131)*



Callback Signature:
<pre><code>function(&amp;$shouldShowQuestionBanner]</code></pre>

## Filesystem

- [Filesystem.allCachesCleared](#filesystemallcachescleared)

### Filesystem.allCachesCleared

*Defined in [Piwik/Filesystem](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Filesystem.php) in line [56](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Filesystem.php#L56)*

Triggered after all non-memory caches are cleared (eg, via the cache:clear
command).

## FrontController

- [FrontController.modifyErrorPage](#frontcontrollermodifyerrorpage)

### FrontController.modifyErrorPage

*Defined in [Piwik/ExceptionHandler](https://github.com/matomo-org/matomo/blob/5.x-dev/core/ExceptionHandler.php) in line [218](https://github.com/matomo-org/matomo/blob/5.x-dev/core/ExceptionHandler.php#L218)*

Triggered before a Piwik error page is displayed to the user. This event can be used to modify the content of the error page that is displayed when
an exception is caught.

Callback Signature:
<pre><code>function(&amp;$result, $ex]</code></pre>

- string &$result The HTML of the error page.

- [\Exception](http://php.net/class.\Exception) `$ex` The Exception displayed in the error page.

Usages:

[CoreAdminHome::onModifyErrorPage](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CoreAdminHome/CoreAdminHome.php#L40)

## Http

- [Http.sendHttpRequest](#httpsendhttprequest)
- [Http.sendHttpRequest.end](#httpsendhttprequestend)

### Http.sendHttpRequest

*Defined in [Piwik/Http](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Http.php) in line [354](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Http.php#L354)*

Triggered to send an HTTP request. Allows plugins to resolve the HTTP request themselves or to find out
when an HTTP request is triggered to log this information for example to a monitoring tool.

Callback Signature:
<pre><code>function($aUrl, $httpEventParams, &amp;$response, &amp;$status, &amp;$headers)</code></pre>

- string `$url` The URL that needs to be requested

- array `$params` HTTP params like
                     - 'httpMethod' (eg GET, POST, ...),
                     - 'body' the request body if the HTTP method needs to be posted
                     - 'userAgent'
                     - 'timeout' After how many seconds a request should time out
                     - 'headers' An array of header strings like array('Accept-Language: en', '...')
                     - 'verifySsl' A boolean whether SSL certificate should be verified
                     - 'destinationPath' If set, the response of the HTTP request should be saved to this file

- string &$response A plugin listening to this event should assign the HTTP response it received to this variable, for example "{value: true}"

- int &$status A plugin listening to this event should assign the HTTP status code it received to this variable, for example "200"

- array &$headers A plugin listening to this event should assign the HTTP headers it received to this variable, eg array('Content-Length' => '5')


### Http.sendHttpRequest.end

*Defined in [Piwik/Http](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Http.php) in line [846](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Http.php#L846)*

Triggered when an HTTP request finished. A plugin can for example listen to this and alter the response,
status code, or finish a timer in case the plugin is measuring how long it took to execute the request

Callback Signature:
<pre><code>function($aUrl, $httpEventParams, &amp;$response, &amp;$status, &amp;$headers)</code></pre>

- string `$url` The URL that needs to be requested

- array `$params` HTTP params like
                     - 'httpMethod' (eg GET, POST, ...),
                     - 'body' the request body if the HTTP method needs to be posted
                     - 'userAgent'
                     - 'timeout' After how many seconds a request should time out
                     - 'headers' An array of header strings like array('Accept-Language: en', '...')
                     - 'verifySsl' A boolean whether SSL certificate should be verified
                     - 'destinationPath' If set, the response of the HTTP request should be saved to this file

- string &$response The response of the HTTP request, for example "{value: true}"

- int &$status The returned HTTP status code, for example "200"

- array &$headers The returned headers, eg array('Content-Length' => '5')

## Insights

- [Insights.addReportToOverview](#insightsaddreporttooverview)

### Insights.addReportToOverview

*Defined in [Piwik/Plugins/Insights/API](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Insights/API.php) in line [71](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Insights/API.php#L71)*

Triggered to gather all reports to be displayed in the "Insight" and "Movers And Shakers" overview reports. Plugins that want to add new reports to the overview should subscribe to this event and add reports to the
incoming array. API parameters can be configured as an array optionally.

**Example**

    public function addReportToInsightsOverview(&$reports)
    {
        $reports['Actions_getPageUrls']  = array();
        $reports['Actions_getDownloads'] = array('flat' => 1, 'minGrowthPercent' => 60);
    }

Callback Signature:
<pre><code>function(&amp;$reports)</code></pre>

- array &$reports An array containing a report unique id as key and an array of API parameters as
                       values.

Usages:

[Actions::addReportToInsightsOverview](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Actions/Actions.php#L107), [MarketingCampaignsReporting::addReportToInsightsOverview](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/MarketingCampaignsReporting/MarketingCampaignsReporting.php#L75), [Referrers::addReportToInsightsOverview](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Referrers/Referrers.php#L156), [UserCountry::addReportToInsightsOverview](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/UserCountry/UserCountry.php#L50)

## Installation

- [Installation.defaultSettingsForm.init](#installationdefaultsettingsforminit)
- [Installation.defaultSettingsForm.submit](#installationdefaultsettingsformsubmit)

### Installation.defaultSettingsForm.init

*Defined in [Piwik/Plugins/Installation/Controller](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Installation/Controller.php) in line [441](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Installation/Controller.php#L441)*

Triggered on initialization of the form to customize default Matomo settings (at the end of the installation process).

Callback Signature:
<pre><code>function($form)</code></pre>

- \Piwik\Plugins\Installation\FormDefaultSettings `$form`

Usages:

[GeoIp2::installationFormInit](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/GeoIp2/GeoIp2.php#L79), [PrivacyManager::installationFormInit](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/PrivacyManager/PrivacyManager.php#L619)


### Installation.defaultSettingsForm.submit

*Defined in [Piwik/Plugins/Installation/Controller](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Installation/Controller.php) in line [452](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Installation/Controller.php#L452)*

Triggered on submission of the form to customize default Matomo settings (at the end of the installation process).

Callback Signature:
<pre><code>function($form)</code></pre>

- \Piwik\Plugins\Installation\FormDefaultSettings `$form`

Usages:

[GeoIp2::installationFormSubmit](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/GeoIp2/GeoIp2.php#L99), [PrivacyManager::installationFormSubmit](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/PrivacyManager/PrivacyManager.php#L640)

## LanguagesManager

- [LanguagesManager.getAvailableLanguages](#languagesmanagergetavailablelanguages)

### LanguagesManager.getAvailableLanguages

*Defined in [Piwik/Plugins/LanguagesManager/API](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/LanguagesManager/API.php) in line [113](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/LanguagesManager/API.php#L113)*

Hook called after loading available language files. Use this hook to customise the list of languagesPath available in Matomo.

Callback Signature:
<pre><code>function(&amp;$languages)</code></pre>

- array

## Live

- [Live.addProfileSummaries](#liveaddprofilesummaries)
- [Live.addVisitorDetails](#liveaddvisitordetails)
- [Live.API.getIdSitesString](#liveapigetidsitesstring)
- [Live.filterProfileSummaries](#livefilterprofilesummaries)
- [Live.filterVisitorDetails](#livefiltervisitordetails)
- [Live.makeNewVisitorObject](#livemakenewvisitorobject)

### Live.addProfileSummaries

*Defined in [Piwik/Plugins/Live/ProfileSummaryProvider](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Live/ProfileSummaryProvider.php) in line [56](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Live/ProfileSummaryProvider.php#L56)*

Triggered to add new live profile summaries. **Example**

    public function addProfileSummary(&$profileSummaries)
    {
        $profileSummaries[] = new MyCustomProfileSummary();
    }

Callback Signature:
<pre><code>function(&amp;$instances)</code></pre>

- \ProfileSummaryAbstract `$profileSummaries` An array of profile summaries


### Live.addVisitorDetails

*Defined in [Piwik/Plugins/Live/Visitor](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Live/Visitor.php) in line [71](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Live/Visitor.php#L71)*

Triggered to add new visitor details that cannot be picked up by the platform automatically. **Example**

    public function addVisitorDetails(&$visitorDetails)
    {
        $visitorDetails[] = new CustomVisitorDetails();
    }

Callback Signature:
<pre><code>function(&amp;$instances)</code></pre>

- [VisitorDetailsAbstract](/api-reference/Piwik/Plugins/Live/VisitorDetailsAbstract) `$visitorDetails` An array of visitorDetails


### Live.API.getIdSitesString

*Defined in [Piwik/Plugins/Live/Model](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Live/Model.php) in line [547](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Live/Model.php#L547)*



Callback Signature:
<pre><code>function(&amp;$idSites)</code></pre>


### Live.filterProfileSummaries

*Defined in [Piwik/Plugins/Live/ProfileSummaryProvider](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Live/ProfileSummaryProvider.php) in line [78](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Live/ProfileSummaryProvider.php#L78)*

Triggered to filter / restrict profile summaries. **Example**

    public function filterProfileSummary(&$profileSummaries)
    {
        foreach ($profileSummaries as $index => $profileSummary) {
             if ($profileSummary->getId() === 'myid') {}
                 unset($profileSummaries[$index]); // remove all summaries having this ID
             }
        }
    }

Callback Signature:
<pre><code>function(&amp;$instances)</code></pre>

- \ProfileSummaryAbstract `$profileSummaries` An array of profile summaries


### Live.filterVisitorDetails

*Defined in [Piwik/Plugins/Live/Visitor](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Live/Visitor.php) in line [99](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Live/Visitor.php#L99)*

Triggered to filter / restrict vistor details. **Example**

    public function filterVisitorDetails(&$visitorDetails)
    {
        foreach ($visitorDetails as $index => $visitorDetail) {
             if (strpos(get_class($visitorDetail), 'MyPluginName') !== false) {}
                 unset($visitorDetails[$index]); // remove all visitor details for a specific plugin
             }
        }
    }

Callback Signature:
<pre><code>function(&amp;$instances)</code></pre>

- [VisitorDetailsAbstract](/api-reference/Piwik/Plugins/Live/VisitorDetailsAbstract) `$visitorDetails` An array of visitorDetails


### Live.makeNewVisitorObject

*Defined in [Piwik/Plugins/Live/VisitorFactory](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Live/VisitorFactory.php) in line [40](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Live/VisitorFactory.php#L40)*

Triggered while visit is filtering in live plugin. Subscribers to this
event can force the use of a custom visitor object that extends from
\Piwik\Plugins\Live\VisitorInterface.

Callback Signature:
<pre><code>function(&amp;$visitor, $visitorRawData)</code></pre>

- \Piwik\Plugins\Live\VisitorInterface &$visitor Initialized to null, but can be set to
                                             a new visitor object. If it isn't modified
                                             Piwik uses the default class.

- array `$visitorRawData` Raw data using in Visitor object constructor.

## Login

- [Login.authenticate](#loginauthenticate)
- [Login.authenticate](#loginauthenticate)
- [Login.authenticate.failed](#loginauthenticatefailed)
- [Login.authenticate.failed](#loginauthenticatefailed)
- [Login.authenticate.processSuccessfulSession.end](#loginauthenticateprocesssuccessfulsessionend)
- [Login.authenticate.processSuccessfulSession.end](#loginauthenticateprocesssuccessfulsessionend)
- [Login.authenticate.processSuccessfulSession.end](#loginauthenticateprocesssuccessfulsessionend)
- [Login.authenticate.processSuccessfulSession.end](#loginauthenticateprocesssuccessfulsessionend)
- [Login.authenticate.processSuccessfulSession.end](#loginauthenticateprocesssuccessfulsessionend)
- [Login.authenticate.processSuccessfulSession.end](#loginauthenticateprocesssuccessfulsessionend)
- [Login.authenticate.processSuccessfulSession.end](#loginauthenticateprocesssuccessfulsessionend)
- [Login.authenticate.processSuccessfulSession.end](#loginauthenticateprocesssuccessfulsessionend)
- [Login.authenticate.processSuccessfulSession.end](#loginauthenticateprocesssuccessfulsessionend)
- [Login.authenticate.processSuccessfulSession.end](#loginauthenticateprocesssuccessfulsessionend)
- [Login.authenticate.processSuccessfulSession.end](#loginauthenticateprocesssuccessfulsessionend)
- [Login.authenticate.processSuccessfulSession.end](#loginauthenticateprocesssuccessfulsessionend)
- [Login.authenticate.processSuccessfulSession.end](#loginauthenticateprocesssuccessfulsessionend)
- [Login.authenticate.processSuccessfulSession.end](#loginauthenticateprocesssuccessfulsessionend)
- [Login.authenticate.successful](#loginauthenticatesuccessful)
- [Login.authenticate.successful](#loginauthenticatesuccessful)
- [Login.logout](#loginlogout)
- [Login.resetPassword.cancelled](#loginresetpasswordcancelled)
- [Login.resetPassword.confirmed](#loginresetpasswordconfirmed)
- [Login.resetPassword.initiated](#loginresetpasswordinitiated)
- [Login.userRequiresPasswordConfirmation](#loginuserrequirespasswordconfirmation)

### Login.authenticate

*Defined in [Piwik/Session/SessionInitializer](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Session/SessionInitializer.php) in line [58](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Session/SessionInitializer.php#L58)*



Callback Signature:
<pre><code>function($auth-&gt;getLogin())</code></pre>


### Login.authenticate

*Defined in [Piwik/Plugins/Login/SessionInitializer](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/SessionInitializer.php) in line [126](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/SessionInitializer.php#L126)*



Callback Signature:
<pre><code>function($auth-&gt;getLogin())</code></pre>


### Login.authenticate.failed

*Defined in [Piwik/Session/SessionInitializer](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Session/SessionInitializer.php) in line [37](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Session/SessionInitializer.php#L37)*



Callback Signature:
<pre><code>function($auth-&gt;getLogin())</code></pre>

Usages:

[Login::onFailedLoginRecordAttempt](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/Login.php#L138)


### Login.authenticate.failed

*Defined in [Piwik/Plugins/Login/SessionInitializer](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/SessionInitializer.php) in line [105](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/SessionInitializer.php#L105)*



Callback Signature:
<pre><code>function($auth-&gt;getLogin())</code></pre>

Usages:

[Login::onFailedLoginRecordAttempt](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/Login.php#L138)


### Login.authenticate.processSuccessfulSession.end

*Defined in [Integration/Security/LoginFromAnotherCountryTest](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/tests/Integration/Security/LoginFromAnotherCountryTest.php) in line [73](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/tests/Integration/Security/LoginFromAnotherCountryTest.php#L73)*



Callback Signature:
<pre><code>function(self::LOGIN]</code></pre>

Usages:

[Login::checkLoginFromAnotherCountry](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/Login.php#L180), [TwoFactorAuth::onSuccessfulSession](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TwoFactorAuth/TwoFactorAuth.php#L147)


### Login.authenticate.processSuccessfulSession.end

*Defined in [Integration/Security/LoginFromAnotherCountryTest](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/tests/Integration/Security/LoginFromAnotherCountryTest.php) in line [81](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/tests/Integration/Security/LoginFromAnotherCountryTest.php#L81)*



Callback Signature:
<pre><code>function(self::LOGIN]</code></pre>

Usages:

[Login::checkLoginFromAnotherCountry](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/Login.php#L180), [TwoFactorAuth::onSuccessfulSession](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TwoFactorAuth/TwoFactorAuth.php#L147)


### Login.authenticate.processSuccessfulSession.end

*Defined in [Integration/Security/LoginFromAnotherCountryTest](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/tests/Integration/Security/LoginFromAnotherCountryTest.php) in line [86](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/tests/Integration/Security/LoginFromAnotherCountryTest.php#L86)*



Callback Signature:
<pre><code>function(self::LOGIN]</code></pre>

Usages:

[Login::checkLoginFromAnotherCountry](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/Login.php#L180), [TwoFactorAuth::onSuccessfulSession](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TwoFactorAuth/TwoFactorAuth.php#L147)


### Login.authenticate.processSuccessfulSession.end

*Defined in [Integration/Security/LoginFromAnotherCountryTest](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/tests/Integration/Security/LoginFromAnotherCountryTest.php) in line [94](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/tests/Integration/Security/LoginFromAnotherCountryTest.php#L94)*



Callback Signature:
<pre><code>function(self::LOGIN]</code></pre>

Usages:

[Login::checkLoginFromAnotherCountry](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/Login.php#L180), [TwoFactorAuth::onSuccessfulSession](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TwoFactorAuth/TwoFactorAuth.php#L147)


### Login.authenticate.processSuccessfulSession.end

*Defined in [Integration/Security/LoginFromAnotherCountryTest](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/tests/Integration/Security/LoginFromAnotherCountryTest.php) in line [99](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/tests/Integration/Security/LoginFromAnotherCountryTest.php#L99)*



Callback Signature:
<pre><code>function(self::LOGIN]</code></pre>

Usages:

[Login::checkLoginFromAnotherCountry](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/Login.php#L180), [TwoFactorAuth::onSuccessfulSession](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TwoFactorAuth/TwoFactorAuth.php#L147)


### Login.authenticate.processSuccessfulSession.end

*Defined in [Integration/Security/LoginFromAnotherCountryTest](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/tests/Integration/Security/LoginFromAnotherCountryTest.php) in line [107](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/tests/Integration/Security/LoginFromAnotherCountryTest.php#L107)*



Callback Signature:
<pre><code>function(self::LOGIN]</code></pre>

Usages:

[Login::checkLoginFromAnotherCountry](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/Login.php#L180), [TwoFactorAuth::onSuccessfulSession](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TwoFactorAuth/TwoFactorAuth.php#L147)


### Login.authenticate.processSuccessfulSession.end

*Defined in [Integration/Security/LoginFromAnotherCountryTest](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/tests/Integration/Security/LoginFromAnotherCountryTest.php) in line [112](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/tests/Integration/Security/LoginFromAnotherCountryTest.php#L112)*



Callback Signature:
<pre><code>function(self::LOGIN]</code></pre>

Usages:

[Login::checkLoginFromAnotherCountry](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/Login.php#L180), [TwoFactorAuth::onSuccessfulSession](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TwoFactorAuth/TwoFactorAuth.php#L147)


### Login.authenticate.processSuccessfulSession.end

*Defined in [Integration/Security/LoginFromAnotherCountryTest](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/tests/Integration/Security/LoginFromAnotherCountryTest.php) in line [117](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/tests/Integration/Security/LoginFromAnotherCountryTest.php#L117)*



Callback Signature:
<pre><code>function(self::LOGIN]</code></pre>

Usages:

[Login::checkLoginFromAnotherCountry](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/Login.php#L180), [TwoFactorAuth::onSuccessfulSession](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TwoFactorAuth/TwoFactorAuth.php#L147)


### Login.authenticate.processSuccessfulSession.end

*Defined in [Integration/Security/LoginFromAnotherCountryTest](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/tests/Integration/Security/LoginFromAnotherCountryTest.php) in line [127](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/tests/Integration/Security/LoginFromAnotherCountryTest.php#L127)*



Callback Signature:
<pre><code>function(self::LOGIN]</code></pre>

Usages:

[Login::checkLoginFromAnotherCountry](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/Login.php#L180), [TwoFactorAuth::onSuccessfulSession](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TwoFactorAuth/TwoFactorAuth.php#L147)


### Login.authenticate.processSuccessfulSession.end

*Defined in [Integration/Security/LoginFromAnotherCountryTest](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/tests/Integration/Security/LoginFromAnotherCountryTest.php) in line [132](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/tests/Integration/Security/LoginFromAnotherCountryTest.php#L132)*



Callback Signature:
<pre><code>function(self::LOGIN]</code></pre>

Usages:

[Login::checkLoginFromAnotherCountry](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/Login.php#L180), [TwoFactorAuth::onSuccessfulSession](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TwoFactorAuth/TwoFactorAuth.php#L147)


### Login.authenticate.processSuccessfulSession.end

*Defined in [Integration/Security/LoginFromAnotherCountryTest](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/tests/Integration/Security/LoginFromAnotherCountryTest.php) in line [142](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/tests/Integration/Security/LoginFromAnotherCountryTest.php#L142)*



Callback Signature:
<pre><code>function(self::LOGIN]</code></pre>

Usages:

[Login::checkLoginFromAnotherCountry](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/Login.php#L180), [TwoFactorAuth::onSuccessfulSession](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TwoFactorAuth/TwoFactorAuth.php#L147)


### Login.authenticate.processSuccessfulSession.end

*Defined in [Integration/Security/LoginFromAnotherCountryTest](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/tests/Integration/Security/LoginFromAnotherCountryTest.php) in line [147](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/tests/Integration/Security/LoginFromAnotherCountryTest.php#L147)*



Callback Signature:
<pre><code>function(self::LOGIN]</code></pre>

Usages:

[Login::checkLoginFromAnotherCountry](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/Login.php#L180), [TwoFactorAuth::onSuccessfulSession](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TwoFactorAuth/TwoFactorAuth.php#L147)


### Login.authenticate.processSuccessfulSession.end

*Defined in [Integration/Security/LoginFromAnotherCountryTest](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/tests/Integration/Security/LoginFromAnotherCountryTest.php) in line [157](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/tests/Integration/Security/LoginFromAnotherCountryTest.php#L157)*



Callback Signature:
<pre><code>function(self::LOGIN]</code></pre>

Usages:

[Login::checkLoginFromAnotherCountry](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/Login.php#L180), [TwoFactorAuth::onSuccessfulSession](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TwoFactorAuth/TwoFactorAuth.php#L147)


### Login.authenticate.processSuccessfulSession.end

*Defined in [Integration/Security/LoginFromAnotherCountryTest](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/tests/Integration/Security/LoginFromAnotherCountryTest.php) in line [162](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/tests/Integration/Security/LoginFromAnotherCountryTest.php#L162)*



Callback Signature:
<pre><code>function(self::LOGIN]</code></pre>

Usages:

[Login::checkLoginFromAnotherCountry](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/Login.php#L180), [TwoFactorAuth::onSuccessfulSession](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TwoFactorAuth/TwoFactorAuth.php#L147)


### Login.authenticate.successful

*Defined in [Piwik/Session/SessionInitializer](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Session/SessionInitializer.php) in line [41](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Session/SessionInitializer.php#L41)*



Callback Signature:
<pre><code>function($auth-&gt;getLogin())</code></pre>

Usages:

[Login::beforeLoginCheckBruteForce](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/Login.php#L196)


### Login.authenticate.successful

*Defined in [Piwik/Plugins/Login/SessionInitializer](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/SessionInitializer.php) in line [109](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/SessionInitializer.php#L109)*



Callback Signature:
<pre><code>function($auth-&gt;getLogin())</code></pre>

Usages:

[Login::beforeLoginCheckBruteForce](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/Login.php#L196)


### Login.logout

*Defined in [Piwik/Plugins/Login/Controller](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/Controller.php) in line [657](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/Controller.php#L657)*



Callback Signature:
<pre><code>function(Piwik::getCurrentUserLogin()]</code></pre>


### Login.resetPassword.cancelled

*Defined in [Piwik/Plugins/Login/PasswordResetter](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/PasswordResetter.php) in line [187](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/PasswordResetter.php#L187)*

Triggered after a user cancelled a password reset process.

Callback Signature:
<pre><code>function($userfunction(&#039;login&#039;]]</code></pre>

- string `$userLogin` The user's login.


### Login.resetPassword.confirmed

*Defined in [Piwik/Plugins/Login/PasswordResetter](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/PasswordResetter.php) in line [312](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/PasswordResetter.php#L312)*

Triggered after a user confirmed/completed a password reset process.

Callback Signature:
<pre><code>function($login]</code></pre>

- string `$userLogin` The user's login.


### Login.resetPassword.initiated

*Defined in [Piwik/Plugins/Login/PasswordResetter](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/PasswordResetter.php) in line [246](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/PasswordResetter.php#L246)*

Triggered after a user initiated a password reset process.

Callback Signature:
<pre><code>function($login]</code></pre>

- string `$userLogin` The user's login.


### Login.userRequiresPasswordConfirmation

*Defined in [Piwik/Piwik](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Piwik.php) in line [311](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Piwik.php#L311)*

Triggered to check if a password confirmation for a user is required. This event can be used in custom login plugins to skip the password confirmation checks for certain users,
where e.g. no password would be available.

Attention: Use this event wisely. Disabling password confirmation decreases the security.

Callback Signature:
<pre><code>function(&amp;$requiresPasswordConfirmation, $login]</code></pre>

- bool `&$requiresPasswordConfirmation` Indicates if the password should be checked or not

- string `$login` Login of a user the password should be confirmed for

Usages:

[LoginLdap::skipPasswordConfirmation](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/LoginLdap/LoginLdap.php#L283)

## Mail

- [Mail.send](#mailsend)
- [Mail.shouldSend](#mailshouldsend)

### Mail.send

*Defined in [Piwik/Mail](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Mail.php) in line [295](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Mail.php#L295)*

This event is posted right before an email is sent. You can use it to customize the email by, for example, replacing
the subject/body, changing the from address, etc.

Callback Signature:
<pre><code>function($mail]</code></pre>

- [Mail](/api-reference/Piwik/Mail) `$mail` The Mail instance that is about to be sent.


### Mail.shouldSend

*Defined in [Piwik/Mail](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Mail.php) in line [407](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Mail.php#L407)*

This event is posted before sending an email. You can use it to abort sending a specific email, if you want.

Callback Signature:
<pre><code>function(&amp;$shouldSendMail, $mail]</code></pre>

- bool &$shouldSendMail Whether to send this email or not. Set to false to skip sending.

- [Mail](/api-reference/Piwik/Mail) `$mail` The Mail instance that will be sent.

## MeasurableSettings

- [MeasurableSettings.updated](#measurablesettingsupdated)

### MeasurableSettings.updated

*Defined in [Piwik/Settings/Measurable/MeasurableSettings](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Settings/Measurable/MeasurableSettings.php) in line [137](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Settings/Measurable/MeasurableSettings.php#L137)*

Triggered after a plugin settings have been updated. **Example**

    Piwik::addAction('MeasurableSettings.updated', function (MeasurableSettings $settings) {
        $value = $settings->someSetting->getValue();
        // Do something with the new setting value
    });

Callback Signature:
<pre><code>function($this, $this-&gt;idSite)</code></pre>

- \Settings `$settings` The plugin settings object.

## Metric

- [Metric.addComputedMetrics](#metricaddcomputedmetrics)
- [Metric.addMetrics](#metricaddmetrics)
- [Metric.filterMetrics](#metricfiltermetrics)

### Metric.addComputedMetrics

*Defined in [Piwik/Columns/MetricsList](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Columns/MetricsList.php) in line [150](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Columns/MetricsList.php#L150)*

Triggered to add new metrics that cannot be picked up automatically by the platform. This is useful if the plugin allows a user to create metrics dynamically. For example
CustomDimensions or CustomVariables.

**Example**

    public function addMetric(&$list)
    {
        $list->addMetric(new MyCustomMetric());
    }

Callback Signature:
<pre><code>function($list, $computedFactory)</code></pre>

- [MetricsList](/api-reference/Piwik/Columns/MetricsList) `$list` An instance of the MetricsList. You can add metrics to the list this way.

Usages:

[CoreHome::addComputedMetrics](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CoreHome/CoreHome.php#L116), [Ecommerce::addComputedMetrics](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Ecommerce/Ecommerce.php#L66), [Goals::addComputedMetrics](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Goals/Goals.php#L138)


### Metric.addMetrics

*Defined in [Piwik/Columns/MetricsList](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Columns/MetricsList.php) in line [126](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Columns/MetricsList.php#L126)*

Triggered to add new metrics that cannot be picked up automatically by the platform. This is useful if the plugin allows a user to create metrics dynamically. For example
CustomDimensions or CustomVariables.

**Example**

    public function addMetric(&$list)
    {
        $list->addMetric(new MyCustomMetric());
    }

Callback Signature:
<pre><code>function($list)</code></pre>

- [MetricsList](/api-reference/Piwik/Columns/MetricsList) `$list` An instance of the MetricsList. You can add metrics to the list this way.

Usages:

[Goals::addMetrics](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Goals/Goals.php#L152)


### Metric.filterMetrics

*Defined in [Piwik/Columns/MetricsList](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Columns/MetricsList.php) in line [164](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Columns/MetricsList.php#L164)*

Triggered to filter metrics. **Example**

    public function removeMetrics(Piwik\Columns\MetricsList $list)
    {
        $list->remove($category='General_Visits'); // remove all metrics having this category
    }

Callback Signature:
<pre><code>function($list)</code></pre>

- [MetricsList](/api-reference/Piwik/Columns/MetricsList) `$list` An instance of the MetricsList. You can change the list of metrics this way.

## Metrics

- [Metrics.getDefaultMetricDocumentationTranslations](#metricsgetdefaultmetricdocumentationtranslations)
- [Metrics.getDefaultMetricSemanticTypes](#metricsgetdefaultmetricsemantictypes)
- [Metrics.getDefaultMetricTranslations](#metricsgetdefaultmetrictranslations)
- [Metrics.getEvolutionUnit](#metricsgetevolutionunit)
- [Metrics.isLowerValueBetter](#metricsislowervaluebetter)

### Metrics.getDefaultMetricDocumentationTranslations

*Defined in [Piwik/Metrics](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Metrics.php) in line [631](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Metrics.php#L631)*

Use this event to register translations for metrics documentation processed by your plugin.

Callback Signature:
<pre><code>function(&amp;$translations)</code></pre>

- string `&$translations` The array mapping of column_name => Plugin_TranslationForColumnDocumentation

Usages:

[Actions::addMetricDocumentationTranslations](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Actions/Actions.php#L87), [BotTracking::addMetricDocumentationTranslations](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/BotTracking/BotTracking.php#L139), [Contents::addMetricDocumentationTranslations](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Contents/Contents.php#L50), [Events::addMetricDocumentationTranslations](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Events/Events.php#L42)


### Metrics.getDefaultMetricSemanticTypes

*Defined in [Piwik/Metrics](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Metrics.php) in line [433](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Metrics.php#L433)*

Use this event to notify Matomo of the semantic types of metrics your plugin adds. A metric's semantic type is metadata used primarily in integrations with Matomo
and third party services/applications. It provides information that can be used
to determine how to display or use the information.

It is recommended for your plugin to provide this information so users of third
party services that connect with Matomo can make full use of the data your plugin
tracks.

See [Metrics](/api-reference/Piwik/Metrics) for the list of available semantic types.

Callback Signature:
<pre><code>function(&amp;$types]</code></pre>

- string `&$types` The array mapping of metric_name => metric semantic type

Usages:

[AIAgents::addMetricSemanticTypes](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/AIAgents/AIAgents.php#L56), [Actions::addMetricSemanticTypes](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Actions/Actions.php#L43), [Bandwidth::addMetricSemanticTypes](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Bandwidth/Bandwidth.php#L91), [BotTracking::addMetricSemanticTypes](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/BotTracking/BotTracking.php#L157), [Contents::addMetricSemanticTypes](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Contents/Contents.php#L39), [Events::addMetricSemanticTypes](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Events/Events.php#L47), [Goals::addMetricSemanticTypes](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Goals/Goals.php#L247), [PagePerformance::addMetricSemanticTypes](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/PagePerformance/PagePerformance.php#L73), [Referrers::addMetricSemanticTypes](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Referrers/Referrers.php#L70), [VisitFrequency::addMetricSemanticTypes](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/VisitFrequency/VisitFrequency.php#L50)


### Metrics.getDefaultMetricTranslations

*Defined in [Piwik/Metrics](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Metrics.php) in line [497](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Metrics.php#L497)*

Use this event to register translations for metrics processed by your plugin.

Callback Signature:
<pre><code>function(&amp;$translations)</code></pre>

- string `&$translations` The array mapping of column_name => Plugin_TranslationForColumn

Usages:

[AIAgents::addMetricTranslations](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/AIAgents/AIAgents.php#L33), [Actions::addMetricTranslations](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Actions/Actions.php#L64), [Bandwidth::addMetricTranslations](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Bandwidth/Bandwidth.php#L85), [BotTracking::addMetricTranslations](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/BotTracking/BotTracking.php#L122), [Contents::addMetricTranslations](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Contents/Contents.php#L32), [DevicePlugins::addMetricTranslations](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/DevicePlugins/DevicePlugins.php#L30), [Events::addMetricTranslations](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Events/Events.php#L37), [Goals::addMetricTranslations](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Goals/Goals.php#L226), [MultiSites::addMetricTranslations](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/MultiSites/MultiSites.php#L34), [PagePerformance::addMetricTranslations](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/PagePerformance/PagePerformance.php#L67), [Referrers::getDefaultMetricTranslations](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Referrers/Referrers.php#L42), [VisitFrequency::addMetricTranslations](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/VisitFrequency/VisitFrequency.php#L27)


### Metrics.getEvolutionUnit

*Defined in [Piwik/Metrics](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Metrics.php) in line [354](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Metrics.php#L354)*

Use this event to define units for custom metrics used in evolution graphs and row evolution only.

Callback Signature:
<pre><code>function(&amp;$unit, $column, $idSite]</code></pre>

- string `&$unit` should hold the unit (e.g. %, €, s or empty string)

- string `$column` name of the column to determine

- string `$idSite` id of the current site

Usages:

[Bandwidth::getEvolutionUnit](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Bandwidth/Bandwidth.php#L97), [BotTracking::getEvolutionUnit](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/BotTracking/BotTracking.php#L112)


### Metrics.isLowerValueBetter

*Defined in [Piwik/Metrics](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Metrics.php) in line [310](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Metrics.php#L310)*

Use this event to define if a lower value of a metric is better.

Callback Signature:
<pre><code>function(&amp;$isLowerBetter, $column]</code></pre>

- string `&$isLowerBetter` should be set to a boolean indicating if lower is better

- string `$column` name of the column to determine

**Example**

public function checkIsLowerMetricValueBetter(&$isLowerBetter, $metric)
{
    if ($metric === 'position') {
        $isLowerBetter = true;
    }
}

Usages:

[PagePerformance::isLowerValueBetter](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/PagePerformance/PagePerformance.php#L79)

## MobileMessaging

- [MobileMessaging.deletePhoneNumber](#mobilemessagingdeletephonenumber)

### MobileMessaging.deletePhoneNumber

*Defined in [Piwik/Plugins/MobileMessaging/API](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/MobileMessaging/API.php) in line [234](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/MobileMessaging/API.php#L234)*

Triggered after a phone number has been deleted. This event should be used to clean up any data that is
related to the now deleted phone number. The ScheduledReports plugin, for example, uses this event to remove
the phone number from all reports to make sure no text message will be sent to this phone number. **Example**

    public function deletePhoneNumber($phoneNumber)
    {
        $this->unsubscribePhoneNumberFromScheduledReport($phoneNumber);
    }

Callback Signature:
<pre><code>function($phoneNumber)</code></pre>

- string `$phoneNumber` The phone number that was just deleted.

Usages:

[CustomAlerts::removePhoneNumberFromAllAlerts](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomAlerts/CustomAlerts.php#L153), [ScheduledReports::deletePhoneNumber](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/ScheduledReports/ScheduledReports.php#L513)

## MultiSites

- [MultiSites.filterRowsForTotalsCalculation](#multisitesfilterrowsfortotalscalculation)
- [MultiSites.filterSites](#multisitesfiltersites)

### MultiSites.filterRowsForTotalsCalculation

*Defined in [Piwik/Plugins/MultiSites/API](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/MultiSites/API.php) in line [697](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/MultiSites/API.php#L697)*

Triggered to filter / restrict which rows should be included in the MultiSites (All Websites Dashboard)
totals calculation **Example**

    public function filterMultiSitesRows(&$rows)
    {
        foreach ($rows as $index => $row) {
            if ($row->getColumn('label') === 5) {
                unset($rows[$index]); // remove idSite 5 from totals
            }
        }
    }

Callback Signature:
<pre><code>function(&amp;$rows]</code></pre>

- \Row &$rows An array containing rows, one row for each site. The label columns equals the idSite.


### MultiSites.filterSites

*Defined in [Piwik/Plugins/MultiSites/API](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/MultiSites/API.php) in line [137](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/MultiSites/API.php#L137)*

This event can be used to manipulate the sites being displayed on all websites dashboard. **Example**

    Piwik::addAction('MultiSites.filterSites', function (&$idSites) {
        $idSites = array_filter($idSites, function($idSite) {
            return $idSite !== 1
        });
    });

Callback Signature:
<pre><code>function(&amp;$idSites]</code></pre>

- \array<int> &$idSites List of idSites that the current user would be allowed to see in all websites dashboard.

## Platform

- [Platform.initialized](#platforminitialized)
- [Platform.initialized](#platforminitialized)

### Platform.initialized

*Defined in [Piwik/Plugins/Widgetize/tests/System/WidgetTest](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Widgetize/tests/System/WidgetTest.php) in line [64](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Widgetize/tests/System/WidgetTest.php#L64)*



Usages:

[Plugin::detectIsApiRequest](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/API/API.php#L967), [CoreUpdater::updateCheck](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CoreUpdater/CoreUpdater.php#L82), [LanguagesManager::initLanguage](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/LanguagesManager/LanguagesManager.php#L106), [UsersManager::onPlatformInitialized](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/UsersManager/UsersManager.php#L85)


### Platform.initialized

*Defined in [Piwik/FrontController](https://github.com/matomo-org/matomo/blob/5.x-dev/core/FrontController.php) in line [479](https://github.com/matomo-org/matomo/blob/5.x-dev/core/FrontController.php#L479)*

Triggered after the platform is initialized and after the user has been authenticated, but
before the platform has handled the request. Piwik uses this event to check for updates to Piwik.

Usages:

[Plugin::detectIsApiRequest](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/API/API.php#L967), [CoreUpdater::updateCheck](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CoreUpdater/CoreUpdater.php#L82), [LanguagesManager::initLanguage](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/LanguagesManager/LanguagesManager.php#L106), [UsersManager::onPlatformInitialized](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/UsersManager/UsersManager.php#L85)

## PluginManager

- [PluginManager.pluginActivated](#pluginmanagerpluginactivated)
- [PluginManager.pluginActivated](#pluginmanagerpluginactivated)
- [PluginManager.pluginDeactivated](#pluginmanagerplugindeactivated)
- [PluginManager.pluginInstalled](#pluginmanagerplugininstalled)
- [PluginManager.pluginUninstalled](#pluginmanagerpluginuninstalled)

### PluginManager.pluginActivated

*Defined in [Piwik/Plugins/TagManager/tests/Integration/Context/WebContextTest](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TagManager/tests/Integration/Context/WebContextTest.php) in line [95](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TagManager/tests/Integration/Context/WebContextTest.php#L95)*



Callback Signature:
<pre><code>function(&#039;TagManager&#039;]</code></pre>

Usages:

[CorePluginsAdmin::onPluginActivated](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CorePluginsAdmin/CorePluginsAdmin.php#L66), [CustomJsTracker::updateTracker](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomJsTracker/CustomJsTracker.php#L32), [Marketplace::removePluginTrialRequest](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Marketplace/Marketplace.php#L227), [TagManager::onPluginActivated](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TagManager/TagManager.php#L211)


### PluginManager.pluginActivated

*Defined in [Piwik/Plugin/Manager](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Plugin/Manager.php) in line [814](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Plugin/Manager.php#L814)*

Event triggered after a plugin has been activated.

Callback Signature:
<pre><code>function($pluginName)</code></pre>

- string `$pluginName` The plugin that has been activated.

Usages:

[CorePluginsAdmin::onPluginActivated](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CorePluginsAdmin/CorePluginsAdmin.php#L66), [CustomJsTracker::updateTracker](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomJsTracker/CustomJsTracker.php#L32), [Marketplace::removePluginTrialRequest](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Marketplace/Marketplace.php#L227), [TagManager::onPluginActivated](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TagManager/TagManager.php#L211)


### PluginManager.pluginDeactivated

*Defined in [Piwik/Plugin/Manager](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Plugin/Manager.php) in line [628](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Plugin/Manager.php#L628)*

Event triggered after a plugin has been deactivated.

Callback Signature:
<pre><code>function($pluginName)</code></pre>

- string `$pluginName` The plugin that has been deactivated.

Usages:

[CorePluginsAdmin::removePluginChanges](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CorePluginsAdmin/CorePluginsAdmin.php#L53), [CustomJsTracker::updateTracker](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomJsTracker/CustomJsTracker.php#L32), [TagManager::onPluginActivateOrInstall](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TagManager/TagManager.php#L200)


### PluginManager.pluginInstalled

*Defined in [Piwik/Plugin/Manager](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Plugin/Manager.php) in line [1519](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Plugin/Manager.php#L1519)*

Event triggered after a new plugin has been installed. Note: Might be triggered more than once if the config file is not writable

Callback Signature:
<pre><code>function($pluginName)</code></pre>

- string `$pluginName` The plugin that has been installed.

Usages:

[CustomJsTracker::updateTracker](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomJsTracker/CustomJsTracker.php#L32), [Marketplace::removePluginTrialRequest](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Marketplace/Marketplace.php#L227), [TagManager::onPluginActivateOrInstall](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TagManager/TagManager.php#L200)


### PluginManager.pluginUninstalled

*Defined in [Piwik/Plugin/Manager](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Plugin/Manager.php) in line [725](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Plugin/Manager.php#L725)*

Event triggered after a plugin has been uninstalled.

Callback Signature:
<pre><code>function($pluginName)</code></pre>

- string `$pluginName` The plugin that has been uninstalled.

Usages:

[CustomJsTracker::updateTracker](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomJsTracker/CustomJsTracker.php#L32), [TagManager::onPluginActivateOrInstall](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TagManager/TagManager.php#L200)

## PrivacyManager

- [PrivacyManager.deleteDataSubjects](#privacymanagerdeletedatasubjects)
- [PrivacyManager.deleteDataSubjectsForDeletedSites](#privacymanagerdeletedatasubjectsfordeletedsites)
- [PrivacyManager.deleteLogsOlderThan](#privacymanagerdeletelogsolderthan)
- [PrivacyManager.exportDataSubjects](#privacymanagerexportdatasubjects)
- [PrivacyManager.shouldIgnoreDnt](#privacymanagershouldignorednt)

### PrivacyManager.deleteDataSubjects

*Defined in [Piwik/Plugins/PrivacyManager/Model/DataSubjects](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/PrivacyManager/Model/DataSubjects.php) in line [136](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/PrivacyManager/Model/DataSubjects.php#L136)*

Lets you delete data subjects to make your plugin GDPR compliant. This can be useful if you have developed a plugin which stores any data for visits but doesn't
use any core logic to store this data. If core API's are used, for example log tables, then the data may
be deleted automatically.

**Example**

    public function deleteDataSubjects(&$result, $visitsToDelete)
    {
        $numDeletes = $this->deleteVisits($visitsToDelete)
        $result['myplugin'] = $numDeletes;
    }

Callback Signature:
<pre><code>function(&amp;$results, $visits]</code></pre>

- array &$results An array storing the result of how much data was deleted for .

- array &$visits An array with multiple visit entries containing an idvisit and idsite each. The data
                      for these visits is requested to be deleted.


### PrivacyManager.deleteDataSubjectsForDeletedSites

*Defined in [Piwik/Plugins/PrivacyManager/Model/DataSubjects](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/PrivacyManager/Model/DataSubjects.php) in line [104](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/PrivacyManager/Model/DataSubjects.php#L104)*

Lets you delete data subjects to make your plugin GDPR compliant. This can be useful if you have developed a plugin which stores any data for specific sites, not bound to a visit but doesn't
use any core logic to store this data. If core API's are used, for example log tables, then the data may
be deleted automatically.

**Example**

    public function deleteDataSubjectsForDeletedSites(&$result)
    {
        $existingSiteIds = SitesManager\API::getInstance()->getAllSitesId();
        $idSitesInTable = $this->>getAllSiteIdsInLogTable();
        $idSitesNoLongerExisting = array_diff($existingSiteIds, $idSitesInTable);
        $numDeletes = $this->deleteDataForSites($idSitesNoLongerExisting);
        $result['myplugin'] = $numDeletes;
    }

Callback Signature:
<pre><code>function(&amp;$results]</code></pre>

- array &$results An array storing the result of how much data was deleted for.

Usages:

[BotTracking::deleteDataSubjectsForDeletedSites](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/BotTracking/BotTracking.php#L81)


### PrivacyManager.deleteLogsOlderThan

*Defined in [Piwik/Plugins/PrivacyManager/LogDataPurger](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/PrivacyManager/LogDataPurger.php) in line [102](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/PrivacyManager/LogDataPurger.php#L102)*

Triggered when a plugin is supposed to delete log/raw data that is older than a certain amount of days. **Example**

    public function deleteLogsOlderThan($dateUpperLimit, $deleteLogsOlderThan)
    {
        Db::query('DELETE FROM mytable WHERE creation_date < ' . $dateUpperLimit->getDateTime());
    }

Callback Signature:
<pre><code>function($dateUpperLimit, $deleteLogsOlderThan)</code></pre>

- [Date](/api-reference/Piwik/Date) `$dateUpperLimit` A date where visits that occur before this time should be deleted.

- int `$deleteLogsOlderThan` The number of days after which log entries are considered old.
                                Visits and related data whose age is greater than this number will be purged.

Usages:

[BotTracking::deleteLogsOlderThan](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/BotTracking/BotTracking.php#L73)


### PrivacyManager.exportDataSubjects

*Defined in [Piwik/Plugins/PrivacyManager/Model/DataSubjects](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/PrivacyManager/Model/DataSubjects.php) in line [475](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/PrivacyManager/Model/DataSubjects.php#L475)*

Lets you enrich the data export for one or multiple data subjects to make your plugin GDPR compliant. This can be useful if you have developed a plugin which stores any data for visits but doesn't
use any core logic to store this data. If core API's are used, for example log tables, then the data may
be exported automatically.

**Example**

    public function exportDataSubjects(&export, $visitsToExport)
    {
        $export['myplugin'] = array();
        foreach($visitsToExport as $visit) {
             $export['myplugin'][] = 'exported data';
        }
    }

Callback Signature:
<pre><code>function(&amp;$results, $visits]</code></pre>

- array &$results An array containing the exported data subjects.

- array &$visits An array with multiple visit entries containing an idvisit and idsite each. The data
                      for these visits is requested to be exported.


### PrivacyManager.shouldIgnoreDnt

*Defined in [Piwik/Plugins/PrivacyManager/DoNotTrackHeaderChecker](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/PrivacyManager/DoNotTrackHeaderChecker.php) in line [77](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/PrivacyManager/DoNotTrackHeaderChecker.php#L77)*



Callback Signature:
<pre><code>function(&amp;$shouldIgnore)</code></pre>

## Provider

- [Provider.getCleanHostname](#providergetcleanhostname)

### Provider.getCleanHostname

*Defined in [Piwik/Plugins/Provider/Provider](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Provider/Provider.php) in line [88](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Provider/Provider.php#L88)*

Triggered when prettifying a hostname string. This event can be used to customize the way a hostname is displayed in the
Providers report.

**Example**

    public function getCleanHostname(&$cleanHostname, $hostname)
    {
        if ('fvae.VARG.ceaga.site.co.jp' == $hostname) {
            $cleanHostname = 'site.co.jp';
        }
    }

Callback Signature:
<pre><code>function(&amp;$cleanHostname, $hostname]</code></pre>

- string &$cleanHostname The hostname string to display. Set by the event
                              handler.

- string `$hostname` The full hostname.

## Referrer

- [Referrer.addAIAssistantUrls](#referreraddaiassistanturls)
- [Referrer.addSearchEngineUrls](#referreraddsearchengineurls)
- [Referrer.addSocialUrls](#referreraddsocialurls)

### Referrer.addAIAssistantUrls

*Defined in [Piwik/Plugins/Referrers/AIAssistant](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Referrers/AIAssistant.php) in line [69](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Referrers/AIAssistant.php#L69)*



Callback Signature:
<pre><code>function(&amp;$this-&gt;definitionList]</code></pre>


### Referrer.addSearchEngineUrls

*Defined in [Piwik/Plugins/Referrers/SearchEngine](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Referrers/SearchEngine.php) in line [66](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Referrers/SearchEngine.php#L66)*



Callback Signature:
<pre><code>function(&amp;$this-&gt;definitionList)</code></pre>


### Referrer.addSocialUrls

*Defined in [Piwik/Plugins/Referrers/Social](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Referrers/Social.php) in line [64](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Referrers/Social.php#L64)*



Callback Signature:
<pre><code>function(&amp;$this-&gt;definitionList)</code></pre>

## Report

- [Report.addReports](#reportaddreports)
- [Report.filterReports](#reportfilterreports)
- [Report.unsubscribe](#reportunsubscribe)

### Report.addReports

*Defined in [Piwik/Plugin/ReportsProvider](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Plugin/ReportsProvider.php) in line [142](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Plugin/ReportsProvider.php#L142)*

Triggered to add new reports that cannot be picked up automatically by the platform. This is useful if the plugin allows a user to create reports / dimensions dynamically. For example
CustomDimensions or CustomVariables. There are a variable number of dimensions in this case and it
wouldn't be really possible to create a report file for one of these dimensions as it is not known
how many Custom Dimensions will exist.

**Example**

    public function addReport(&$reports)
    {
        $reports[] = new MyCustomReport();
    }

Callback Signature:
<pre><code>function(&amp;$instances)</code></pre>

- [Report](/api-reference/Piwik/Plugin/Report) `$reports` An array of reports

Usages:

[CustomDimensions::addReports](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomDimensions/CustomDimensions.php#L131)


### Report.filterReports

*Defined in [Piwik/Plugin/ReportsProvider](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Plugin/ReportsProvider.php) in line [164](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Plugin/ReportsProvider.php#L164)*

Triggered to filter / restrict reports. **Example**

    public function filterReports(&$reports)
    {
        foreach ($reports as $index => $report) {
             if ($report->getCategoryId() === 'General_Actions') {
                 unset($reports[$index]); // remove all reports having this action
             }
        }
    }

Callback Signature:
<pre><code>function(&amp;$instances)</code></pre>

- [Report](/api-reference/Piwik/Plugin/Report) `$reports` An array of reports

Usages:

[MarketingCampaignsReporting::removeOriginalCampaignReport](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/MarketingCampaignsReporting/MarketingCampaignsReporting.php#L101)


### Report.unsubscribe

*Defined in [Piwik/Plugins/ScheduledReports/SubscriptionModel](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/ScheduledReports/SubscriptionModel.php) in line [95](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/ScheduledReports/SubscriptionModel.php#L95)*



Callback Signature:
<pre><code>function($reportfunction(&#039;idreport&#039;], $email]</code></pre>

## Request

- [Request.dispatch](#requestdispatch)
- [Request.dispatch.end](#requestdispatchend)
- [Request.dispatch.end](#requestdispatchend)
- [Request.dispatchCoreAndPluginUpdatesScreen](#requestdispatchcoreandpluginupdatesscreen)
- [Request.getRenamedModuleAndAction](#requestgetrenamedmoduleandaction)
- [Request.initAuthenticationObject](#requestinitauthenticationobject)
- [Request.initAuthenticationObject](#requestinitauthenticationobject)
- [Request.initAuthenticationObject](#requestinitauthenticationobject)
- [Request.initAuthenticationObject](#requestinitauthenticationobject)
- [Request.initAuthenticationObject](#requestinitauthenticationobject)
- [Request.initAuthenticationObject](#requestinitauthenticationobject)
- [Request.initAuthenticationObject](#requestinitauthenticationobject)
- [Request.shouldDisablePostProcessing](#requestshoulddisablepostprocessing)

### Request.dispatch

*Defined in [Piwik/FrontController](https://github.com/matomo-org/matomo/blob/5.x-dev/core/FrontController.php) in line [647](https://github.com/matomo-org/matomo/blob/5.x-dev/core/FrontController.php#L647)*

Triggered directly before controller actions are dispatched. This event can be used to modify the parameters passed to one or more controller actions
and can be used to change the controller action being dispatched to.

Callback Signature:
<pre><code>function(&amp;$module, &amp;$action, &amp;$parameters)</code></pre>

- string &$module The name of the plugin being dispatched to.

- string &$action The name of the controller method being dispatched to.

- array &$parameters The arguments passed to the controller action.

Usages:

[CustomAlerts::checkControllerPermission](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomAlerts/CustomAlerts.php#L77), [Installation::dispatchIfNotInstalledYet](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Installation/Installation.php#L82), [LanguagesManager::initLanguage](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/LanguagesManager/LanguagesManager.php#L106), [Marketplace::createPluginTrialNotification](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Marketplace/Marketplace.php#L218)


### Request.dispatch.end

*Defined in [Piwik/Plugins/TwoFactorAuth/tests/System/TwoFactorAuthTest](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TwoFactorAuth/tests/System/TwoFactorAuthTest.php) in line [65](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TwoFactorAuth/tests/System/TwoFactorAuthTest.php#L65)*



Callback Signature:
<pre><code>function(&amp;$html, &#039;module&#039;, &#039;action&#039;, function())</code></pre>


### Request.dispatch.end

*Defined in [Piwik/FrontController](https://github.com/matomo-org/matomo/blob/5.x-dev/core/FrontController.php) in line [692](https://github.com/matomo-org/matomo/blob/5.x-dev/core/FrontController.php#L692)*

Triggered after a controller action is successfully called. This event can be used to modify controller action output (if any) before the output is returned.

Callback Signature:
<pre><code>function(&amp;$result, $module, $action, $parameters)</code></pre>

- mixed &$result The controller action result.

- array `$parameters` The arguments passed to the controller action.


### Request.dispatchCoreAndPluginUpdatesScreen

*Defined in [Piwik/FrontController](https://github.com/matomo-org/matomo/blob/5.x-dev/core/FrontController.php) in line [396](https://github.com/matomo-org/matomo/blob/5.x-dev/core/FrontController.php#L396)*

Triggered just after the platform is initialized and plugins are loaded. This event can be used to do early initialization.

_Note: At this point the user is not authenticated yet._

Usages:

[CoreUpdater::dispatch](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CoreUpdater/CoreUpdater.php#L36), [LanguagesManager::initLanguage](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/LanguagesManager/LanguagesManager.php#L106)


### Request.getRenamedModuleAndAction

*Defined in [Piwik/API/Request](https://github.com/matomo-org/matomo/blob/5.x-dev/core/API/Request.php) in line [181](https://github.com/matomo-org/matomo/blob/5.x-dev/core/API/Request.php#L181)*

This event is posted in the Request dispatcher and can be used
to overwrite the Module and Action to dispatch. This is useful when some Controller methods or API methods have been renamed or moved to another plugin.

Callback Signature:
<pre><code>function(&amp;$module, &amp;$action)</code></pre>

-  `&$module` string

-  `&$action` string

Usages:

[Referrers::renameDeprecatedModuleAndAction](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Referrers/Referrers.php#L149), [RssWidget::renameExampleRssWidgetModule](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/RssWidget/RssWidget.php#L36), [ScheduledReports::renameDeprecatedModuleAndAction](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/ScheduledReports/ScheduledReports.php#L118)


### Request.initAuthenticationObject

*Defined in [Piwik/Plugins/BulkTracking/Tracker/Handler](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/BulkTracking/Tracker/Handler.php) in line [127](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/BulkTracking/Tracker/Handler.php#L127)*



Usages:

[Login::onInitAuthenticationObject](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/Login.php#L123), [LoginLdap::initAuthenticationObject](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/LoginLdap/LoginLdap.php#L216)


### Request.initAuthenticationObject

*Defined in [Piwik/Tracker/Request](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Tracker/Request.php) in line [243](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Tracker/Request.php#L243)*



Usages:

[Login::onInitAuthenticationObject](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/Login.php#L123), [LoginLdap::initAuthenticationObject](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/LoginLdap/LoginLdap.php#L216)


### Request.initAuthenticationObject

*Defined in [Piwik/Console](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Console.php) in line [322](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Console.php#L322)*



Usages:

[Login::onInitAuthenticationObject](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/Login.php#L123), [LoginLdap::initAuthenticationObject](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/LoginLdap/LoginLdap.php#L216)


### Request.initAuthenticationObject

*Defined in [Piwik/Plugins/API/tests/Integration/APITest](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/API/tests/Integration/APITest.php) in line [461](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/API/tests/Integration/APITest.php#L461)*



Usages:

[Login::onInitAuthenticationObject](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/Login.php#L123), [LoginLdap::initAuthenticationObject](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/LoginLdap/LoginLdap.php#L216)


### Request.initAuthenticationObject

*Defined in [Piwik/Plugins/API/tests/Integration/APITest](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/API/tests/Integration/APITest.php) in line [472](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/API/tests/Integration/APITest.php#L472)*



Usages:

[Login::onInitAuthenticationObject](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/Login.php#L123), [LoginLdap::initAuthenticationObject](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/LoginLdap/LoginLdap.php#L216)


### Request.initAuthenticationObject

*Defined in [Piwik/Plugins/API/tests/Integration/APITest](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/API/tests/Integration/APITest.php) in line [482](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/API/tests/Integration/APITest.php#L482)*



Usages:

[Login::onInitAuthenticationObject](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/Login.php#L123), [LoginLdap::initAuthenticationObject](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/LoginLdap/LoginLdap.php#L216)


### Request.initAuthenticationObject

*Defined in [Piwik/FrontController](https://github.com/matomo-org/matomo/blob/5.x-dev/core/FrontController.php) in line [778](https://github.com/matomo-org/matomo/blob/5.x-dev/core/FrontController.php#L778)*

Triggered before the user is authenticated, when the global authentication object
should be created. Plugins that provide their own authentication implementation should use this event
to set the global authentication object (which must derive from [Auth](/api-reference/Piwik/Auth)).

**Example**

    Piwik::addAction('Request.initAuthenticationObject', function() {
        StaticContainer::getContainer()->set('Piwik\Auth', new MyAuthImplementation());
    });

Usages:

[Login::onInitAuthenticationObject](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/Login.php#L123), [LoginLdap::initAuthenticationObject](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/LoginLdap/LoginLdap.php#L216)


### Request.shouldDisablePostProcessing

*Defined in [Piwik/API/Request](https://github.com/matomo-org/matomo/blob/5.x-dev/core/API/Request.php) in line [757](https://github.com/matomo-org/matomo/blob/5.x-dev/core/API/Request.php#L757)*

After an API method returns a value, the value is post processed (eg, rows are sorted
based on the `filter_sort_column` query parameter, rows are truncated based on the
`filter_limit`/`filter_offset` parameters, amongst other things). If you're creating a plugin that needs to disable post processing entirely for
certain requests, use this event.

Callback Signature:
<pre><code>function(&amp;$shouldDisable, $this-&gt;request]</code></pre>

- bool &$shouldDisable Set this to true to disable datatable post processing for a request.

- array `$request` The request parameters.

Usages:

[PrivacyManager::shouldDisablePostProcessing](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/PrivacyManager/PrivacyManager.php#L197)

## ScheduledReports

- [ScheduledReports.allowMultipleReports](#scheduledreportsallowmultiplereports)
- [ScheduledReports.getRendererInstance](#scheduledreportsgetrendererinstance)
- [ScheduledReports.getReportFormats](#scheduledreportsgetreportformats)
- [ScheduledReports.getReportMetadata](#scheduledreportsgetreportmetadata)
- [ScheduledReports.getReportParameters](#scheduledreportsgetreportparameters)
- [ScheduledReports.getReportRecipients](#scheduledreportsgetreportrecipients)
- [ScheduledReports.getReportTypes](#scheduledreportsgetreporttypes)
- [ScheduledReports.processReports](#scheduledreportsprocessreports)
- [ScheduledReports.sendReport](#scheduledreportssendreport)
- [ScheduledReports.validateReportParameters](#scheduledreportsvalidatereportparameters)

### ScheduledReports.allowMultipleReports

*Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/ScheduledReports/API.php) in line [1247](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/ScheduledReports/API.php#L1247)*

Triggered when we're determining if a scheduled report transport medium can
handle sending multiple Matomo reports in one scheduled report or not. Plugins that provide their own transport mediums should use this
event to specify whether their backend can send more than one Matomo report
at a time.

Callback Signature:
<pre><code>function(&amp;$allowMultipleReports, $reportType]</code></pre>

- bool &$allowMultipleReports Whether the backend type can handle multiple
                                   Matomo reports or not.

- string `$reportType` A string ID describing how the report is sent, eg,
                          `'sms'` or `'email'`.

Usages:

[MobileMessaging::allowMultipleReports](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/MobileMessaging/MobileMessaging.php#L202), [ScheduledReports::allowMultipleReports](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/ScheduledReports/ScheduledReports.php#L372)


### ScheduledReports.getRendererInstance

*Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/ScheduledReports/API.php) in line [785](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/ScheduledReports/API.php#L785)*

Triggered when obtaining a renderer instance based on the scheduled report output format. Plugins that provide new scheduled report output formats should use this event to
handle their new report formats.

Callback Signature:
<pre><code>function(&amp;$reportRenderer, $reportType, $outputType, $report]</code></pre>

- \ReportRenderer &$reportRenderer This variable should be set to an instance that
                                       extends \Piwik\ReportRenderer by one of the event
                                       subscribers.

- string `$reportType` A string ID describing how the report is sent, e.g.
                          `'sms'` or `'email'`.

- int `$outputType` The scheduled report output mode. One of {@see API::OUTPUT_DOWNLOAD},
                       {@see API::OUTPUT_SAVE_ON_DISK}, {@see API::OUTPUT_INLINE},
                       or {@see API::OUTPUT_RETURN}.

- array `&$report` An array describing the scheduled report that is being generated.
                     See the `ScheduledReport` type on {@see API} for the structure.

Usages:

[MobileMessaging::getRendererInstance](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/MobileMessaging/MobileMessaging.php#L189), [ScheduledReports::getRendererInstance](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/ScheduledReports/ScheduledReports.php#L357)


### ScheduledReports.getReportFormats

*Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/ScheduledReports/API.php) in line [1297](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/ScheduledReports/API.php#L1297)*

Triggered when gathering all available scheduled report formats. Plugins that provide their own scheduled report format should use
this event to make their format available.

Callback Signature:
<pre><code>function(&amp;$reportFormats, $reportType]</code></pre>

- array &$reportFormats An array mapping string IDs for each available
                             scheduled report format with icon paths for those
                             formats. Add your new format's ID to this array.

- string `$reportType` A string ID describing how the report is sent, eg,
                          `'sms'` or `'email'`.

Usages:

[MobileMessaging::getReportFormats](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/MobileMessaging/MobileMessaging.php#L175), [ScheduledReports::getReportFormats](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/ScheduledReports/ScheduledReports.php#L302)


### ScheduledReports.getReportMetadata

*Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/ScheduledReports/API.php) in line [1217](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/ScheduledReports/API.php#L1217)*

TODO: change this event so it returns a list of API methods instead of report metadata arrays. Triggered when gathering the list of Matomo reports that can be used with a certain
transport medium.

Plugins that provide their own transport mediums should use this
event to list the Matomo reports that their backend supports.

Callback Signature:
<pre><code>function(&amp;$availableReportMetadata, $reportType, $idSite]</code></pre>

- array &$availableReportMetadata An array containing report metadata for each supported
                                       report.

- string `$reportType` A string ID describing how the report is sent, eg,
                          `'sms'` or `'email'`.

- int `$idSite` The ID of the site we're getting available reports for.

Usages:

[MobileMessaging::getReportMetadata](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/MobileMessaging/MobileMessaging.php#L152), [ScheduledReports::getReportMetadata](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/ScheduledReports/ScheduledReports.php#L273)


### ScheduledReports.getReportParameters

*Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/ScheduledReports/API.php) in line [1010](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/ScheduledReports/API.php#L1010)*

Triggered when gathering the available parameters for a scheduled report type. Plugins that provide their own scheduled report transport mediums should use this
event to list the available report parameters for their transport medium.

Callback Signature:
<pre><code>function(&amp;$availableParameters, $reportType]</code></pre>

- array `&$availableParameters` The list of available parameters for this report type.
                                  This is an array that maps parameter IDs with a boolean
                                  that indicates whether the parameter is mandatory or not.

- string `$reportType` A string ID describing how the report is sent, eg,
                          `'sms'` or `'email'`.

Usages:

[MobileMessaging::getReportParameters](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/MobileMessaging/MobileMessaging.php#L182), [ScheduledReports::getReportParameters](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/ScheduledReports/ScheduledReports.php#L309)


### ScheduledReports.getReportRecipients

*Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/ScheduledReports/API.php) in line [1330](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/ScheduledReports/API.php#L1330)*

Triggered when getting the list of recipients of a scheduled report. Plugins that provide their own scheduled report transport medium should use this event
to extract the list of recipients their backend's specific scheduled report
format.

Callback Signature:
<pre><code>function(&amp;$recipients, $reportfunction(&#039;type&#039;], $report]</code></pre>

- array &$recipients An array of strings describing each of the scheduled
                          reports recipients. Can be, for example, a list of email
                          addresses or phone numbers or whatever else your plugin
                          uses.

- string `$reportType` A string ID describing how the report is sent, eg,
                          `'sms'` or `'email'`.

- array `$report` An array describing the scheduled report that is being
                     generated.

Usages:

[MobileMessaging::getReportRecipients](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/MobileMessaging/MobileMessaging.php#L209), [ScheduledReports::getReportRecipients](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/ScheduledReports/ScheduledReports.php#L555)


### ScheduledReports.getReportTypes

*Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/ScheduledReports/API.php) in line [1271](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/ScheduledReports/API.php#L1271)*

Triggered when gathering all available transport mediums. Plugins that provide their own transport mediums should use this
event to make their medium available.

Callback Signature:
<pre><code>function(&amp;$reportTypes]</code></pre>

- array &$reportTypes An array mapping transport medium IDs with the paths to those
                           mediums' icons. Add your new backend's ID to this array.

Usages:

[MobileMessaging::getReportTypes](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/MobileMessaging/MobileMessaging.php#L170), [ScheduledReports::getReportTypes](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/ScheduledReports/ScheduledReports.php#L297)


### ScheduledReports.processReports

*Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/ScheduledReports/API.php) in line [760](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/ScheduledReports/API.php#L760)*

Triggered when generating the content of scheduled reports. This event can be used to modify the report data or report metadata of one or more reports
in a scheduled report, before the scheduled report is rendered and delivered.

TODO: list data available in $report or make it a new class that can be documented (same for
      all other events that use a $report)

Callback Signature:
<pre><code>function(&amp;$processedReports, $reportType, $outputType, $report]</code></pre>

- array &$processedReports The list of processed reports in the scheduled report. Each entry
                                contains report data and metadata as returned by `API.getProcessedReport`.

- string `$reportType` A string ID describing how the scheduled report will be sent, e.g.
                          `'sms'` or `'email'`.

- int `$outputType` The scheduled report output mode. One of {@see API::OUTPUT_DOWNLOAD},
                       {@see API::OUTPUT_SAVE_ON_DISK}, {@see API::OUTPUT_INLINE},
                       or {@see API::OUTPUT_RETURN}.

- array `$report` An array describing the scheduled report that is being generated.
                     See the `ScheduledReport` type on {@see API} for the structure.

Usages:

[PagePerformance::processReports](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/PagePerformance/PagePerformance.php#L152), [ScheduledReports::processReports](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/ScheduledReports/ScheduledReports.php#L316)


### ScheduledReports.sendReport

*Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/ScheduledReports/API.php) in line [937](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/ScheduledReports/API.php#L937)*

Triggered when sending scheduled reports. Plugins that provide new scheduled report transport mediums should use this event to
send the scheduled report.

Callback Signature:
<pre><code>function(&amp;$reportType, $report, $contents, $filename = basename($outputFilename), $prettyDate, $reportSubject, $reportTitle, $additionalFiles, \Piwik\Period\Factory::build($reportfunction(&#039;period_param&#039;] ?? $reportfunction(&#039;period&#039;], $date), $force]</code></pre>

- string `&$reportType` A string ID describing how the report is sent, e.g.
                          `'sms'` or `'email'`.

- array `&$report` An array describing the scheduled report that is being generated.
                     See the `ScheduledReport` type on {@see API} for the structure.

- string `$contents` The rendered contents of the scheduled report that should
                        now be sent.

- string `$filename` The basename of the temporary file where the report was saved.

- string `$prettyDate` A human-readable date string for the data within the
                          scheduled report.

- string `$reportSubject` A string describing what's in the scheduled report
                             (typically the site name or "All Websites").

- string `$reportTitle` The scheduled report's title as configured by the user.

- array `$additionalFiles` The list of additional files (e.g. image attachments)
                              that should be sent with this report.

- \Period `$period` The period for which the report has been generated.

- bool `$force` A report can only be sent once per period. Setting this to true
                   will force to send the report even if it has already been sent.

Usages:

[MobileMessaging::sendReport](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/MobileMessaging/MobileMessaging.php#L228), [ScheduledReports::sendReport](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/ScheduledReports/ScheduledReports.php#L393)


### ScheduledReports.validateReportParameters

*Defined in [Piwik/Plugins/ScheduledReports/API](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/ScheduledReports/API.php) in line [1037](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/ScheduledReports/API.php#L1037)*

Triggered when validating the parameters for a scheduled report. Plugins that provide their own scheduled reports backend should use this
event to validate the custom parameters defined with ScheduledReports::getReportParameters().

Callback Signature:
<pre><code>function(&amp;$parameters, $reportType]</code></pre>

- array `&$parameters` The list of parameters for the scheduled report.

- string `$reportType` A string ID describing how the report is sent, eg,
                          `'sms'` or `'email'`.

Usages:

[MobileMessaging::validateReportParameters](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/MobileMessaging/MobileMessaging.php#L133), [ScheduledReports::validateReportParameters](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/ScheduledReports/ScheduledReports.php#L219)

## ScheduledTasks

- [ScheduledTasks.execute](#scheduledtasksexecute)
- [ScheduledTasks.execute.end](#scheduledtasksexecuteend)
- [ScheduledTasks.shouldExecuteTask](#scheduledtasksshouldexecutetask)

### ScheduledTasks.execute

*Defined in [Piwik/Scheduler/Scheduler](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Scheduler/Scheduler.php) in line [362](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Scheduler/Scheduler.php#L362)*

Triggered directly before a scheduled task is executed

Callback Signature:
<pre><code>function(&amp;$task)</code></pre>

- [Task](/api-reference/Piwik/Scheduler/Task) `&$task` The task that is about to be executed

Usages:

[CustomAlerts::startingScheduledTask](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomAlerts/CustomAlerts.php#L212)


### ScheduledTasks.execute.end

*Defined in [Piwik/Scheduler/Scheduler](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Scheduler/Scheduler.php) in line [391](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Scheduler/Scheduler.php#L391)*

Triggered after a scheduled task is successfully executed. You can use the event to execute for example another task whenever a specific task is executed or to clean up
certain resources.

Callback Signature:
<pre><code>function(&amp;$task)</code></pre>

- [Task](/api-reference/Piwik/Scheduler/Task) `&$task` The task that was just executed

Usages:

[CustomAlerts::endingScheduledTask](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomAlerts/CustomAlerts.php#L232)


### ScheduledTasks.shouldExecuteTask

*Defined in [Piwik/Scheduler/Scheduler](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Scheduler/Scheduler.php) in line [181](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Scheduler/Scheduler.php#L181)*

Triggered before a task is executed. A plugin can listen to it and modify whether a specific task should be executed or not. This way
you can force certain tasks to be executed more often or for example to be never executed.

Callback Signature:
<pre><code>function(&amp;$shouldExecuteTask, $task)</code></pre>

- bool &$shouldExecuteTask Decides whether the task will be executed.

- [Task](/api-reference/Piwik/Scheduler/Task) `$task` The task that is about to be executed.

## Segment

- [Segment.addSegments](#segmentaddsegments)
- [Segment.filterSegments](#segmentfiltersegments)

### Segment.addSegments

*Defined in [Piwik/Segment/SegmentsList](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Segment/SegmentsList.php) in line [128](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Segment/SegmentsList.php#L128)*

Triggered to add custom segment definitions. **Example**

    public function addSegments(&$segments)
    {
        $segment = new Segment();
        $segment->setSegment('my_segment_name');
        $segment->setType(Segment::TYPE_DIMENSION);
        $segment->setName('My Segment Name');
        $segment->setSqlSegment('log_table.my_segment_name');
        $segments[] = $segment;
    }

Callback Signature:
<pre><code>function($list]</code></pre>

- [SegmentsList](/api-reference/Piwik/Segment/SegmentsList) `$list` An instance of the SegmentsList. You can add segments to the list this way.


### Segment.filterSegments

*Defined in [Piwik/Segment/SegmentsList](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Segment/SegmentsList.php) in line [147](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Segment/SegmentsList.php#L147)*

Triggered to filter segment definitions. **Example**

    public function filterSegments(&$segmentList)
    {
        $segmentList->remove('Category');
    }

Callback Signature:
<pre><code>function(&amp;$list, $idSites]</code></pre>

- [SegmentsList](/api-reference/Piwik/Segment/SegmentsList) `&$list` An instance of the SegmentsList.

- array `$idSites`

Usages:

[CoreHome::filterSegments](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CoreHome/CoreHome.php#L472), [DevicesDetection::filterSegments](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/DevicesDetection/DevicesDetection.php#L78), [Ecommerce::filterSegments](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Ecommerce/Ecommerce.php#L87), [Goals::filterSegments](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Goals/Goals.php#L542), [Resolution::filterSegments](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Resolution/Resolution.php#L39), [VisitTime::filterSegments](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/VisitTime/VisitTime.php#L25)

## SegmentEditor

- [SegmentEditor.deactivate](#segmenteditordeactivate)
- [SegmentEditor.update](#segmenteditorupdate)

### SegmentEditor.deactivate

*Defined in [Piwik/Plugins/SegmentEditor/API](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/SegmentEditor/API.php) in line [262](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/SegmentEditor/API.php#L262)*

Triggered before a segment is deleted or made invisible. This event can be used by plugins to throw an exception
or do something else.

Callback Signature:
<pre><code>function($idSegment]</code></pre>

- int `$idSegment` The ID of the segment being deleted.

Usages:

[ScheduledReports::segmentDeactivation](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/ScheduledReports/ScheduledReports.php#L624)


### SegmentEditor.update

*Defined in [Piwik/Plugins/SegmentEditor/API](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/SegmentEditor/API.php) in line [331](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/SegmentEditor/API.php#L331)*

Triggered before a segment is modified. This event can be used by plugins to throw an exception
or do something else.

Callback Signature:
<pre><code>function($idSegment, $bind]</code></pre>

- int `$idSegment` The ID of the segment which visibility is reduced.

Usages:

[ScheduledReports::segmentUpdated](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/ScheduledReports/ScheduledReports.php#L591)

## Segments

- [Segments.getKnownSegmentsToArchiveAllSites](#segmentsgetknownsegmentstoarchiveallsites)
- [Segments.getKnownSegmentsToArchiveForSite](#segmentsgetknownsegmentstoarchiveforsite)

### Segments.getKnownSegmentsToArchiveAllSites

*Defined in [Piwik/SettingsPiwik](https://github.com/matomo-org/matomo/blob/5.x-dev/core/SettingsPiwik.php) in line [102](https://github.com/matomo-org/matomo/blob/5.x-dev/core/SettingsPiwik.php#L102)*

Triggered during the cron archiving process to collect segments that
should be pre-processed for all websites. The archiving process will be launched
for each of these segments when archiving data. This event can be used to add segments to be pre-processed. If your plugin depends
on data from a specific segment, this event could be used to provide enhanced
performance.

_Note: If you just want to add a segment that is managed by the user, use the
SegmentEditor API._

**Example**

    Piwik::addAction('Segments.getKnownSegmentsToArchiveAllSites', function (&$segments) {
        $segments[] = 'country=jp;city=Tokyo';
    });

Callback Signature:
<pre><code>function(&amp;$segmentsToProcess)</code></pre>

- array &$segmentsToProcess List of segment definitions, eg,

                                     array(
                                         'browserCode=ff;resolution=800x600',
                                         'country=jp;city=Tokyo'
                                     )

                                 Add segments to this array in your event handler.

Usages:

[SegmentEditor::getKnownSegmentsToArchiveAllSites](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/SegmentEditor/SegmentEditor.php#L121)


### Segments.getKnownSegmentsToArchiveForSite

*Defined in [Piwik/SettingsPiwik](https://github.com/matomo-org/matomo/blob/5.x-dev/core/SettingsPiwik.php) in line [152](https://github.com/matomo-org/matomo/blob/5.x-dev/core/SettingsPiwik.php#L152)*

Triggered during the cron archiving process to collect segments that
should be pre-processed for one specific site. The archiving process will be launched
for each of these segments when archiving data for that one site. This event can be used to add segments to be pre-processed for one site.

_Note: If you just want to add a segment that is managed by the user, you should use the
SegmentEditor API._

**Example**

    Piwik::addAction('Segments.getKnownSegmentsToArchiveForSite', function (&$segments, $idSite) {
        $segments[] = 'country=jp;city=Tokyo';
    });

Callback Signature:
<pre><code>function(&amp;$segments, $idSite)</code></pre>

- array &$segmentsToProcess List of segment definitions, eg,

                                     array(
                                         'browserCode=ff;resolution=800x600',
                                         'country=JP;city=Tokyo'
                                     )

                                 Add segments to this array in your event handler.

- int `$idSite` The ID of the site to get segments for.

Usages:

[SegmentEditor::getKnownSegmentsToArchiveForSite](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/SegmentEditor/SegmentEditor.php#L133)

## SEO

- [SEO.getMetricsProviders](#seogetmetricsproviders)

### SEO.getMetricsProviders

*Defined in [Piwik/Plugins/SEO/Metric/Aggregator](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/SEO/Metric/Aggregator.php) in line [58](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/SEO/Metric/Aggregator.php#L58)*

Use this event to register new SEO metrics providers.

Callback Signature:
<pre><code>function(&amp;$providers]</code></pre>

- array `&$providers` Contains an array of Piwik\Plugins\SEO\Metric\MetricsProvider instances.

## Session

- [Session.shouldSendSameSiteCookieAsNoneForcefully](#sessionshouldsendsamesitecookieasnoneforcefully)

### Session.shouldSendSameSiteCookieAsNoneForcefully

*Defined in [Piwik/Session](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Session.php) in line [202](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Session.php#L202)*

Triggered to determine whether the session cookie SameSite value should be forced to None. Plugins can set `$shouldUseNoneForcefully` to true when the session cookie needs to be
sent in a third-party context that is not covered by Matomo's built-in iframe, opt-out,
or Overlay detection. The final cookie value is still only set to `None` when the request
is served over HTTPS.

Callback Signature:
<pre><code>function(&amp;$shouldUseNoneForcefully]</code></pre>

- bool &$shouldUseNoneForcefully Set this to true to force the session cookie SameSite value to None.

## SitesManager

- [SitesManager.addSite.end](#sitesmanageraddsiteend)
- [SitesManager.deleteSite.end](#sitesmanagerdeletesiteend)
- [SitesManager.getImageTrackingCode](#sitesmanagergetimagetrackingcode)
- [SitesManager.getMessagesToWarnOnSiteRemoval](#sitesmanagergetmessagestowarnonsiteremoval)
- [SitesManager.shouldPerformEmptySiteCheck](#sitesmanagershouldperformemptysitecheck)

### SitesManager.addSite.end

*Defined in [Piwik/Plugins/SitesManager/API](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/SitesManager/API.php) in line [895](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/SitesManager/API.php#L895)*

Triggered after a site has been added.

Callback Signature:
<pre><code>function($idSite]</code></pre>

- int `$idSite` The ID of the site that was added.

Usages:

[TagManager::onSiteAdded](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TagManager/TagManager.php#L991)


### SitesManager.deleteSite.end

*Defined in [Piwik/Plugins/SitesManager/API](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/SitesManager/API.php) in line [1038](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/SitesManager/API.php#L1038)*

Triggered after a site has been deleted. Plugins can use this event to remove site specific values or settings, such as removing all
goals that belong to a specific website. If you store any data related to a website you
should clean up that information here.

Callback Signature:
<pre><code>function($idSite]</code></pre>

- int `$idSite` The ID of the site being deleted.

Usages:

[CustomAlerts::deleteAlertsForSite](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomAlerts/CustomAlerts.php#L134), [CustomDimensions::deleteCustomDimensionDefinitionsForSite](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomDimensions/CustomDimensions.php#L282), [Goals::deleteSiteGoals](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Goals/Goals.php#L267), [PrivacyManager::deleteSiteSpecificAnonymisationSettings](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/PrivacyManager/PrivacyManager.php#L1109), [ScheduledReports::deleteSiteReport](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/ScheduledReports/ScheduledReports.php#L200), [SegmentEditor::onDeleteSite](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/SegmentEditor/SegmentEditor.php#L66), [SitesManager::onSiteDeleted](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/SitesManager/SitesManager.php#L154), [TagManager::onSiteDeleted](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TagManager/TagManager.php#L1000), [UsersManager::deleteSite](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/UsersManager/UsersManager.php#L128)


### SitesManager.getImageTrackingCode

*Defined in [Piwik/Plugins/SitesManager/API](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/SitesManager/API.php) in line [266](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/SitesManager/API.php#L266)*

Triggered when generating image link tracking code server side. Plugins can use
this event to customise the image tracking code that is displayed to the
user.

Callback Signature:
<pre><code>function(&amp;$piwikUrl, &amp;$urlParams]</code></pre>

- string &$piwikHost The domain and URL path to the Matomo installation, eg,
                          `'examplepiwik.com/path/to/piwik'`.

- array &$urlParams The query parameters used in the <img> element's src
                         URL. See Matomo's image tracking docs for more info.


### SitesManager.getMessagesToWarnOnSiteRemoval

*Defined in [Piwik/Plugins/SitesManager/API](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/SitesManager/API.php) in line [515](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/SitesManager/API.php#L515)*

Triggered before a modal to delete a measurable is displayed A plugin can listen to it and add additional information to be displayed in the measurable delete modal body

Callback Signature:
<pre><code>function(&amp;$messages, $idSite]</code></pre>

- array &$messages Additional messages to be shown in the delete measurable modal body

- int `$idSite` The idSite to be deleted

Usages:

[TagManager::getMessagesToWarnOnSiteRemoval](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TagManager/TagManager.php#L1026)


### SitesManager.shouldPerformEmptySiteCheck

*Defined in [Piwik/Plugins/SitesManager/SitesManager](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/SitesManager/SitesManager.php) in line [149](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/SitesManager/SitesManager.php#L149)*

Posted before checking to display the "No data has been recorded yet" message. If your Measurable should never have visits, you can use this event to make
sure that message is never displayed.

Callback Signature:
<pre><code>function(&amp;$shouldPerformEmptySiteCheck, $siteId]</code></pre>

- bool &$shouldPerformEmptySiteCheck Set this value to true to perform the
                                          check, false if otherwise.

- int `$siteId` The ID of the site we would perform a check for.

## System

- [System.addSystemSummaryItems](#systemaddsystemsummaryitems)
- [System.filterSystemSummaryItems](#systemfiltersystemsummaryitems)

### System.addSystemSummaryItems

*Defined in [Piwik/Plugins/CoreHome/Widgets/GetSystemSummary](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CoreHome/Widgets/GetSystemSummary.php) in line [69](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CoreHome/Widgets/GetSystemSummary.php#L69)*

Triggered to add system summary items that are shown in the System Summary widget. **Example**

    public function addSystemSummaryItem(&$systemSummary)
    {
        $numUsers = 5;
        $systemSummary[] = new SystemSummary\Item($key = 'users', Piwik::translate('General_NUsers', $numUsers), $value = null, array('module' => 'UsersManager', 'action' => 'index'), $icon = 'icon-user');
    }

Callback Signature:
<pre><code>function(&amp;$systemSummary)</code></pre>

- \Item &$systemSummary An array containing system summary items.

Usages:

[CoreAdminHome::addSystemSummaryItems](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CoreAdminHome/CoreAdminHome.php#L118), [CorePluginsAdmin::addSystemSummaryItems](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CorePluginsAdmin/CorePluginsAdmin.php#L77), [Goals::addSystemSummaryItems](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Goals/Goals.php#L130), [SegmentEditor::addSystemSummaryItems](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/SegmentEditor/SegmentEditor.php#L86), [SitesManager::addSystemSummaryItems](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/SitesManager/SitesManager.php#L76), [TagManager::addSystemSummaryItems](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TagManager/TagManager.php#L328), [UsersManager::addSystemSummaryItems](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/UsersManager/UsersManager.php#L62)


### System.filterSystemSummaryItems

*Defined in [Piwik/Plugins/CoreHome/Widgets/GetSystemSummary](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CoreHome/Widgets/GetSystemSummary.php) in line [103](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CoreHome/Widgets/GetSystemSummary.php#L103)*

Triggered to filter system summary items that are shown in the System Summary widget. A plugin might also
sort the system summary items differently. **Example**

    public function filterSystemSummaryItems(&$systemSummary)
    {
        foreach ($systemSummaryItems as $index => $item) {
            if ($item && $item->getKey() === 'users') {
                $systemSummaryItems[$index] = null;
            }
        }
    }

Callback Signature:
<pre><code>function(&amp;$systemSummary)</code></pre>

- \Item &$systemSummary An array containing system summary items.

## SystemSettings

- [SystemSettings.updated](#systemsettingsupdated)

### SystemSettings.updated

*Defined in [Piwik/Settings/Plugin/SystemSettings](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Settings/Plugin/SystemSettings.php) in line [104](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Settings/Plugin/SystemSettings.php#L104)*

Triggered after system settings have been updated. **Example**

    Piwik::addAction('SystemSettings.updated', function (SystemSettings $settings) {
        if ($settings->getPluginName() === 'PluginName') {
            $value = $settings->someSetting->getValue();
            // Do something with the new setting value
        }
    });

Callback Signature:
<pre><code>function($this)</code></pre>

- \Settings `$settings` The plugin settings object.

## TagManager

- [TagManager.addTags](#tagmanageraddtags)
- [TagManager.addTriggers](#tagmanageraddtriggers)
- [TagManager.addVariables](#tagmanageraddvariables)
- [TagManager.containerFileChanged](#tagmanagercontainerfilechanged)
- [TagManager.containerFileDeleted](#tagmanagercontainerfiledeleted)
- [TagManager.deleteContainer.end](#tagmanagerdeletecontainerend)
- [TagManager.deleteContainerTag.end](#tagmanagerdeletecontainertagend)
- [TagManager.deleteContainerTrigger.end](#tagmanagerdeletecontainertriggerend)
- [TagManager.deleteContainerVariable.end](#tagmanagerdeletecontainervariableend)
- [TagManager.deleteContainerVersion.end](#tagmanagerdeletecontainerversionend)
- [TagManager.filterTags](#tagmanagerfiltertags)
- [TagManager.filterTriggers](#tagmanagerfiltertriggers)
- [TagManager.filterVariables](#tagmanagerfiltervariables)
- [TagManager.pauseContainerTag.end](#tagmanagerpausecontainertagend)
- [TagManager.regenerateContainerReleases](#tagmanagerregeneratecontainerreleases)
- [TagManager.resumeContainerTag.end](#tagmanagerresumecontainertagend)

### TagManager.addTags

*Defined in [Piwik/Plugins/TagManager/Template/Tag/TagsProvider](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TagManager/Template/Tag/TagsProvider.php) in line [93](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TagManager/Template/Tag/TagsProvider.php#L93)*

Event to add custom tags. To filter tags have a look at the [TagManager.filterTags](/api-reference/events#tagmanagerfiltertags)
event. **Example**

    public function addTags(&$tags)
    {
        $tags[] = new MyCustomTag();
    }

Callback Signature:
<pre><code>function(&amp;$tags)</code></pre>

- [BaseTag](/api-reference/Piwik/Plugins/TagManager/Template/Tag/BaseTag) &$tags An array containing a list of tags.


### TagManager.addTriggers

*Defined in [Piwik/Plugins/TagManager/Template/Trigger/TriggersProvider](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TagManager/Template/Trigger/TriggersProvider.php) in line [92](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TagManager/Template/Trigger/TriggersProvider.php#L92)*

Event to add custom triggers. To filter triggers have a look at the [TagManager.filterTriggers](/api-reference/events#tagmanagerfiltertriggers)
event. **Example**

    public function addTriggers(&$triggers)
    {
        $triggers[] = new MyCustomTrigger();
    }

Callback Signature:
<pre><code>function(&amp;$triggers)</code></pre>

- [BaseTrigger](/api-reference/Piwik/Plugins/TagManager/Template/Trigger/BaseTrigger) &$triggers An array containing a list of triggers.


### TagManager.addVariables

*Defined in [Piwik/Plugins/TagManager/Template/Variable/VariablesProvider](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TagManager/Template/Variable/VariablesProvider.php) in line [108](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TagManager/Template/Variable/VariablesProvider.php#L108)*

Event to add custom variables. To filter variables have a look at the [TagManager.filterVariables](/api-reference/events#tagmanagerfiltervariables)
event. **Example**

    public function addVariables(&$variables)
    {
        $variables[] = new MyCustomVariable();
    }

Callback Signature:
<pre><code>function(&amp;$variables)</code></pre>

- [BaseVariable](/api-reference/Piwik/Plugins/TagManager/Template/Variable/BaseVariable) &$variables An array containing a list of variables.


### TagManager.containerFileChanged

*Defined in [Piwik/Plugins/TagManager/Context/Storage/Filesystem](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TagManager/Context/Storage/Filesystem.php) in line [35](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TagManager/Context/Storage/Filesystem.php#L35)*

Triggered so plugins can detect the changed file and for example sync it to other servers.

Callback Signature:
<pre><code>function($name)</code></pre>


### TagManager.containerFileDeleted

*Defined in [Piwik/Plugins/TagManager/Context/Storage/Filesystem](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TagManager/Context/Storage/Filesystem.php) in line [46](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TagManager/Context/Storage/Filesystem.php#L46)*

Triggered so plugins can detect the deleted file and for example sync it to other servers.

Callback Signature:
<pre><code>function($name)</code></pre>


### TagManager.deleteContainer.end

*Defined in [Piwik/Plugins/TagManager/API](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TagManager/API.php) in line [1315](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TagManager/API.php#L1315)*



Callback Signature:
<pre><code>function(function(&#039;idSite&#039; =&gt; $idSite, &#039;idContainer&#039; =&gt; $idContainer))</code></pre>


### TagManager.deleteContainerTag.end

*Defined in [Piwik/Plugins/TagManager/API](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TagManager/API.php) in line [613](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TagManager/API.php#L613)*



Callback Signature:
<pre><code>function(function(&#039;idSite&#039; =&gt; $idSite, &#039;idContainer&#039; =&gt; $idContainer, &#039;idContainerVersion&#039; =&gt; $idContainerVersion, &#039;idTag&#039; =&gt; $idTag))</code></pre>


### TagManager.deleteContainerTrigger.end

*Defined in [Piwik/Plugins/TagManager/API](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TagManager/API.php) in line [833](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TagManager/API.php#L833)*



Callback Signature:
<pre><code>function(function(&#039;idSite&#039; =&gt; $idSite, &#039;idContainer&#039; =&gt; $idContainer, &#039;idContainerVersion&#039; =&gt; $idContainerVersion, &#039;idTrigger&#039; =&gt; $idTrigger))</code></pre>


### TagManager.deleteContainerVariable.end

*Defined in [Piwik/Plugins/TagManager/API](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TagManager/API.php) in line [1077](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TagManager/API.php#L1077)*



Callback Signature:
<pre><code>function(function(&#039;idSite&#039; =&gt; $idSite, &#039;idContainer&#039; =&gt; $idContainer, &#039;idContainerVersion&#039; =&gt; $idContainerVersion, &#039;idVariable&#039; =&gt; $idVariable))</code></pre>


### TagManager.deleteContainerVersion.end

*Defined in [Piwik/Plugins/TagManager/API](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TagManager/API.php) in line [1265](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TagManager/API.php#L1265)*



Callback Signature:
<pre><code>function(function(&#039;idSite&#039; =&gt; $idSite, &#039;idContainer&#039; =&gt; $idContainer, &#039;idContainerVersion&#039; =&gt; $idContainerVersion))</code></pre>


### TagManager.filterTags

*Defined in [Piwik/Plugins/TagManager/Template/Tag/TagsProvider](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TagManager/Template/Tag/TagsProvider.php) in line [126](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TagManager/Template/Tag/TagsProvider.php#L126)*

Triggered to filter / restrict tags. **Example**

    public function filterTags(&$tags)
    {
        foreach ($tags as $index => $tag) {
             if ($tag->getId() === 'CustomHtml') {}
                 unset($tags[$index]); // remove the tag having this ID
             }
        }
    }

Callback Signature:
<pre><code>function(&amp;$tags)</code></pre>

- [BaseTag](/api-reference/Piwik/Plugins/TagManager/Template/Tag/BaseTag) &$tags An array containing a list of tags.


### TagManager.filterTriggers

*Defined in [Piwik/Plugins/TagManager/Template/Trigger/TriggersProvider](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TagManager/Template/Trigger/TriggersProvider.php) in line [125](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TagManager/Template/Trigger/TriggersProvider.php#L125)*

Event to filter / restrict triggers. **Example**

    public function filterTriggers(&$triggers)
    {
        foreach ($triggers as $index => $trigger) {
             if ($trigger->getId() === 'CustomJs') {}
                 unset($triggers[$index]); // remove the trigger having this ID
             }
        }
    }

Callback Signature:
<pre><code>function(&amp;$triggers)</code></pre>

- [BaseTrigger](/api-reference/Piwik/Plugins/TagManager/Template/Trigger/BaseTrigger) &$triggers An array containing a list of triggers.


### TagManager.filterVariables

*Defined in [Piwik/Plugins/TagManager/Template/Variable/VariablesProvider](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TagManager/Template/Variable/VariablesProvider.php) in line [142](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TagManager/Template/Variable/VariablesProvider.php#L142)*

Event to filter / restrict variables. **Example**

    public function filterVariables(&$variables)
    {
        foreach ($variables as $index => $variable) {
             if ($variable->getId() === 'CustomVariable') {}
                 unset($variables[$index]); // remove the variable having this ID
             }
        }
    }

Callback Signature:
<pre><code>function(&amp;$variables)</code></pre>

- [BaseVariable](/api-reference/Piwik/Plugins/TagManager/Template/Variable/BaseVariable) &$variables An array containing a list of variables.


### TagManager.pauseContainerTag.end

*Defined in [Piwik/Plugins/TagManager/API](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TagManager/API.php) in line [643](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TagManager/API.php#L643)*



Callback Signature:
<pre><code>function(function(&#039;idSite&#039; =&gt; $idSite, &#039;idContainer&#039; =&gt; $idContainer, &#039;idContainerVersion&#039; =&gt; $idContainerVersion, &#039;idTag&#039; =&gt; $idTag))</code></pre>


### TagManager.regenerateContainerReleases

*Defined in [Piwik/Plugins/TagManager/Commands/RegenerateContainers](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TagManager/Commands/RegenerateContainers.php) in line [33](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TagManager/Commands/RegenerateContainers.php#L33)*



Callback Signature:
<pre><code>function($onlyPreview]</code></pre>

Usages:

[TagManager::regenerateReleasedContainers](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TagManager/TagManager.php#L344)


### TagManager.resumeContainerTag.end

*Defined in [Piwik/Plugins/TagManager/API](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TagManager/API.php) in line [677](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TagManager/API.php#L677)*



Callback Signature:
<pre><code>function(function(&#039;idSite&#039; =&gt; $idSite, &#039;idContainer&#039; =&gt; $idContainer, &#039;idContainerVersion&#039; =&gt; $idContainerVersion, &#039;idTag&#039; =&gt; $idTag))</code></pre>

## Template

- [Template.afterCustomVariablesReport](#templateaftercustomvariablesreport)
- [Template.afterGDPROverviewIntro](#templateaftergdproverviewintro)
- [Template.afterReferrerTypeReport](#templateafterreferrertypereport)
- [Template.beforeGoalListActionsBody](#templatebeforegoallistactionsbody)
- [Template.beforeGoalListActionsHead](#templatebeforegoallistactionshead)
- [Template.endGoalEditTable](#templateendgoaledittable)
- [Template.jsGlobalVariables](#templatejsglobalvariables)
- [Template.jsGlobalVariables](#templatejsglobalvariables)
- [Template.jsGlobalVariables](#templatejsglobalvariables)
- [Template.jsGlobalVariables](#templatejsglobalvariables)
- [Template.loginCancelResetPasswordContent](#templatelogincancelresetpasswordcontent)
- [Template.siteWithoutDataTab. . $obj::getId() . .content](#templatesitewithoutdatatabobjgetidcontent)
- [Template.siteWithoutDataTab. . $obj::getId() . .others](#templatesitewithoutdatatabobjgetidothers)

### Template.afterCustomVariablesReport

*Defined in [Piwik/Plugins/CustomVariables/Reports/GetCustomVariables](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomVariables/Reports/GetCustomVariables.php) in line [73](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomVariables/Reports/GetCustomVariables.php#L73)*



Callback Signature:
<pre><code>function(&amp;$out)</code></pre>

Usages:

[ProfessionalServices::getCustomVariablesPromo](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/ProfessionalServices/ProfessionalServices.php#L113)


### Template.afterGDPROverviewIntro

*Defined in [Piwik/Plugins/PrivacyManager/Controller](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/PrivacyManager/Controller.php) in line [118](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/PrivacyManager/Controller.php#L118)*



Callback Signature:
<pre><code>function(&amp;$afterGDPROverviewIntroContent]</code></pre>


### Template.afterReferrerTypeReport

*Defined in [Piwik/Plugins/Referrers/Reports/GetReferrerType](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Referrers/Reports/GetReferrerType.php) in line [134](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Referrers/Reports/GetReferrerType.php#L134)*



Callback Signature:
<pre><code>function(&amp;$out)</code></pre>

Usages:

[ProfessionalServices::getReferrerTypePromo](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/ProfessionalServices/ProfessionalServices.php#L150)


### Template.beforeGoalListActionsBody

*Defined in [Piwik/Plugins/Goals/Controller](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Goals/Controller.php) in line [156](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Goals/Controller.php#L156)*



Callback Signature:
<pre><code>function(&amp;$str, $goal]</code></pre>


### Template.beforeGoalListActionsHead

*Defined in [Piwik/Plugins/Goals/Controller](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Goals/Controller.php) in line [165](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Goals/Controller.php#L165)*



Callback Signature:
<pre><code>function(&amp;$str]</code></pre>


### Template.endGoalEditTable

*Defined in [Piwik/Plugins/Goals/Controller](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Goals/Controller.php) in line [171](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Goals/Controller.php#L171)*



Callback Signature:
<pre><code>function(&amp;$str]</code></pre>


### Template.jsGlobalVariables

*Defined in [Piwik/Plugins/AnonymousPiwikUsageMeasurement/tests/Integration/AnonymousPiwikUsageMeasurementTest](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/AnonymousPiwikUsageMeasurement/tests/Integration/AnonymousPiwikUsageMeasurementTest.php) in line [76](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/AnonymousPiwikUsageMeasurement/tests/Integration/AnonymousPiwikUsageMeasurementTest.php#L76)*



Callback Signature:
<pre><code>function(&amp;$out)</code></pre>

Usages:

[Plugin::getJsGlobalVariables](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/API/API.php#L984), [AnonymousPiwikUsageMeasurement::addMatomoClientTracking](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/AnonymousPiwikUsageMeasurement/AnonymousPiwikUsageMeasurement.php#L107), [CoreAdminHome::addJsGlobalVariables](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CoreAdminHome/CoreAdminHome.php#L162), [LanguagesManager::jsGlobalVariables](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/LanguagesManager/LanguagesManager.php#L85), [Live::addJsGlobalVariables](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Live/Live.php#L45), [Transitions::addJsGlobalVariables](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Transitions/Transitions.php#L67)


### Template.jsGlobalVariables

*Defined in [Piwik/Plugins/AnonymousPiwikUsageMeasurement/tests/Integration/AnonymousPiwikUsageMeasurementTest](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/AnonymousPiwikUsageMeasurement/tests/Integration/AnonymousPiwikUsageMeasurementTest.php) in line [91](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/AnonymousPiwikUsageMeasurement/tests/Integration/AnonymousPiwikUsageMeasurementTest.php#L91)*



Callback Signature:
<pre><code>function(&amp;$out)</code></pre>

Usages:

[Plugin::getJsGlobalVariables](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/API/API.php#L984), [AnonymousPiwikUsageMeasurement::addMatomoClientTracking](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/AnonymousPiwikUsageMeasurement/AnonymousPiwikUsageMeasurement.php#L107), [CoreAdminHome::addJsGlobalVariables](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CoreAdminHome/CoreAdminHome.php#L162), [LanguagesManager::jsGlobalVariables](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/LanguagesManager/LanguagesManager.php#L85), [Live::addJsGlobalVariables](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Live/Live.php#L45), [Transitions::addJsGlobalVariables](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Transitions/Transitions.php#L67)


### Template.jsGlobalVariables

*Defined in [Piwik/Plugins/AnonymousPiwikUsageMeasurement/tests/Integration/AnonymousPiwikUsageMeasurementTest](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/AnonymousPiwikUsageMeasurement/tests/Integration/AnonymousPiwikUsageMeasurementTest.php) in line [104](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/AnonymousPiwikUsageMeasurement/tests/Integration/AnonymousPiwikUsageMeasurementTest.php#L104)*



Callback Signature:
<pre><code>function(&amp;$out)</code></pre>

Usages:

[Plugin::getJsGlobalVariables](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/API/API.php#L984), [AnonymousPiwikUsageMeasurement::addMatomoClientTracking](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/AnonymousPiwikUsageMeasurement/AnonymousPiwikUsageMeasurement.php#L107), [CoreAdminHome::addJsGlobalVariables](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CoreAdminHome/CoreAdminHome.php#L162), [LanguagesManager::jsGlobalVariables](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/LanguagesManager/LanguagesManager.php#L85), [Live::addJsGlobalVariables](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Live/Live.php#L45), [Transitions::addJsGlobalVariables](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Transitions/Transitions.php#L67)


### Template.jsGlobalVariables

*Defined in [Piwik/Plugins/AnonymousPiwikUsageMeasurement/tests/Integration/AnonymousPiwikUsageMeasurementTest](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/AnonymousPiwikUsageMeasurement/tests/Integration/AnonymousPiwikUsageMeasurementTest.php) in line [121](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/AnonymousPiwikUsageMeasurement/tests/Integration/AnonymousPiwikUsageMeasurementTest.php#L121)*



Callback Signature:
<pre><code>function(&amp;$out)</code></pre>

Usages:

[Plugin::getJsGlobalVariables](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/API/API.php#L984), [AnonymousPiwikUsageMeasurement::addMatomoClientTracking](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/AnonymousPiwikUsageMeasurement/AnonymousPiwikUsageMeasurement.php#L107), [CoreAdminHome::addJsGlobalVariables](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CoreAdminHome/CoreAdminHome.php#L162), [LanguagesManager::jsGlobalVariables](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/LanguagesManager/LanguagesManager.php#L85), [Live::addJsGlobalVariables](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Live/Live.php#L45), [Transitions::addJsGlobalVariables](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Transitions/Transitions.php#L67)


### Template.loginCancelResetPasswordContent

*Defined in [Piwik/Plugins/Login/Controller](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/Controller.php) in line [556](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/Controller.php#L556)*

Overwrite the content displayed on the "reset password process cancelled page". Will display default content if no event content returned.

Callback Signature:
<pre><code>function(&amp;$cancelResetPasswordContent]</code></pre>

- string `&$cancelResetPasswordContent` The content to render.


### Template.siteWithoutDataTab. . $obj::getId() . .content

*Defined in [Piwik/Plugins/SitesManager/Controller](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/SitesManager/Controller.php) in line [196](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/SitesManager/Controller.php#L196)*

Event that can be used to manipulate the content of a certain tab on the no data page

Callback Signature:
<pre><code>function(&amp;$tabContent, $this-&gt;siteContentDetector]</code></pre>

- string `&$tabContent` Content of the tab

- \SiteContentDetector `$detector` Instance of SiteContentDetector, holding current detection results


### Template.siteWithoutDataTab. . $obj::getId() . .others

*Defined in [Piwik/Plugins/SitesManager/Controller](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/SitesManager/Controller.php) in line [203](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/SitesManager/Controller.php#L203)*

Event that can be used to manipulate the content of a record on the others tab on the no data page

Callback Signature:
<pre><code>function(&amp;$othersInstruction, $this-&gt;siteContentDetector]</code></pre>

- string `&$othersInstruction` Content of the record

- \SiteContentDetector `$detector` Instance of SiteContentDetector, holding current detection results

## Tour

- [Tour.filterChallenges](#tourfilterchallenges)

### Tour.filterChallenges

*Defined in [Piwik/Plugins/Tour/Engagement/Challenges](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Tour/Engagement/Challenges.php) in line [115](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Tour/Engagement/Challenges.php#L115)*

Triggered to add new challenges to the "welcome to Matomo tour". **Example**

    public function addChallenge(&$challenges)
    {
        $challenges[] = new MyChallenge();
    }

Callback Signature:
<pre><code>function(&amp;$challenges)</code></pre>

- [Challenge](/api-reference/Piwik/Plugins/Tour/Engagement/Challenge) `&$challenges` An array of challenges

## Tracker

- [Tracker.Cache.getSiteAttributes](#trackercachegetsiteattributes)
- [Tracker.detectReferrerAIAssistant](#trackerdetectreferreraiassistant)
- [Tracker.detectReferrerSearchEngine](#trackerdetectreferrersearchengine)
- [Tracker.detectReferrerSocialNetwork](#trackerdetectreferrersocialnetwork)
- [Tracker.end](#trackerend)
- [Tracker.end](#trackerend)
- [Tracker.getDatabaseConfig](#trackergetdatabaseconfig)
- [Tracker.getJavascriptCode](#trackergetjavascriptcode)
- [Tracker.isBotRequest](#trackerisbotrequest)
- [Tracker.isExcludedVisit](#trackerisexcludedvisit)
- [Tracker.makeNewVisitObject](#trackermakenewvisitobject)
- [Tracker.PageUrl.getQueryParametersToExclude](#trackerpageurlgetqueryparameterstoexclude)
- [Tracker.Request.getIdSite](#trackerrequestgetidsite)
- [Tracker.setTrackerCacheGeneral](#trackersettrackercachegeneral)

### Tracker.Cache.getSiteAttributes

*Defined in [Piwik/Tracker/Cache](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Tracker/Cache.php) in line [136](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Tracker/Cache.php#L136)*

Triggered to get the attributes of a site entity that might be used by the
Tracker. Plugins add new site attributes for use in other tracking events must
use this event to put those attributes in the Tracker Cache.

**Example**

    public function getSiteAttributes($content, $idSite)
    {
        $sql = "SELECT info FROM " . Common::prefixTable('myplugin_extra_site_info') . " WHERE idsite = ?";
        $content['myplugin_site_data'] = Db::fetchOne($sql, [$idSite]);
    }

Callback Signature:
<pre><code>function(&amp;$content, $idSite]</code></pre>

- array &$content Array mapping of site attribute names with values.

- int `$idSite` The site ID to get attributes for.

Usages:

[CustomDimensions::addCustomDimensionsAttributes](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomDimensions/CustomDimensions.php#L266), [Goals::fetchGoalsFromDb](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Goals/Goals.php#L466), [PrivacyManager::setTrackerCacheSiteAttributes](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/PrivacyManager/PrivacyManager.php#L598), [UsersManager::recordAdminUsersInCache](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/UsersManager/UsersManager.php#L99)


### Tracker.detectReferrerAIAssistant

*Defined in [Piwik/Plugins/Referrers/Columns/Base](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Referrers/Columns/Base.php) in line [426](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Referrers/Columns/Base.php#L426)*

Triggered when detecting the AI of a referrer URL. Plugins can use this event to provide custom AI detection logic.

Callback Signature:
<pre><code>function(&amp;$aiAssistantName, $this-&gt;referrerUrl]</code></pre>

- string &$aiAssistantName Name of the AI Assistant, or false if none detected

                                       This parameter is initialized to the results
                                       of Matomo's default AI detection
                                       logic.

- string referrerUrl The referrer URL from the tracking request.


### Tracker.detectReferrerSearchEngine

*Defined in [Piwik/Plugins/Referrers/Columns/Base](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Referrers/Columns/Base.php) in line [324](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Referrers/Columns/Base.php#L324)*

Triggered when detecting the search engine of a referrer URL. Plugins can use this event to provide custom search engine detection
logic.

Callback Signature:
<pre><code>function(&amp;$searchEngineInformation, $this-&gt;referrerUrl]</code></pre>

- array &$searchEngineInformation An array with the following information:

                                       - **name**: The search engine name.
                                       - **keywords**: The search keywords used.

                                       This parameter is initialized to the results
                                       of Piwik's default search engine detection
                                       logic.

- string referrerUrl The referrer URL from the tracking request.


### Tracker.detectReferrerSocialNetwork

*Defined in [Piwik/Plugins/Referrers/Columns/Base](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Referrers/Columns/Base.php) in line [375](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Referrers/Columns/Base.php#L375)*

Triggered when detecting the social network of a referrer URL. Plugins can use this event to provide custom social network detection
logic.

Callback Signature:
<pre><code>function(&amp;$socialNetworkName, $this-&gt;referrerUrl]</code></pre>

- string &$socialNetworkName Name of the social network, or false if none detected

                                       This parameter is initialized to the results
                                       of Matomo's default social network detection
                                       logic.

- string referrerUrl The referrer URL from the tracking request.


### Tracker.end

*Defined in [Piwik/Tracker](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Tracker.php) in line [135](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Tracker.php#L135)*




### Tracker.end

*Defined in [Piwik/Plugins/QueuedTracking/Commands/Process](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/QueuedTracking/Commands/Process.php) in line [141](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/QueuedTracking/Commands/Process.php#L141)*




### Tracker.getDatabaseConfig

*Defined in [Piwik/Tracker/Db](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Tracker/Db.php) in line [264](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Tracker/Db.php#L264)*

Triggered before a connection to the database is established by the Tracker. This event can be used to change the database connection settings used by the Tracker.

Callback Signature:
<pre><code>function(&amp;$configDb)</code></pre>

- array `$dbInfos` Reference to an array containing database connection info,
                      including:

                      - **host**: The host name or IP address to the MySQL database.
                      - **username**: The username to use when connecting to the
                                      database.
                      - **password**: The password to use when connecting to the
                                      database.
                      - **dbname**: The name of the Piwik MySQL database.
                      - **port**: The MySQL database port to use.
                      - **adapter**: either `'PDO\MYSQL'` or `'MYSQLI'`
                      - **type**: The MySQL engine to use, for instance 'InnoDB'


### Tracker.getJavascriptCode

*Defined in [Piwik/Tracker/TrackerCodeGenerator](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Tracker/TrackerCodeGenerator.php) in line [228](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Tracker/TrackerCodeGenerator.php#L228)*

Triggered when generating JavaScript tracking code server side. Plugins can use
this event to customise the JavaScript tracking code that is displayed to the
user.

Callback Signature:
<pre><code>function(&amp;$codeImpl, $parameters)</code></pre>

- array &$codeImpl An array containing snippets of code that the event handler
                        can modify. Will contain the following elements:

                        - **idSite**: The ID of the site being tracked.
                        - **piwikUrl**: The tracker URL to use.
                        - **options**: A string of JavaScript code that customises
                                       the JavaScript tracker.
                        - **optionsBeforeTrackerUrl**: A string of Javascript code that customises
                                       the JavaScript tracker inside of anonymous function before
                                       adding setTrackerUrl into paq.
                        - **protocol**: Piwik url protocol.
                        - **loadAsync**: boolean whether piwik.js should be loaded synchronous or asynchronous

                        The **httpsPiwikUrl** element can be set if the HTTPS
                        domain is different from the normal domain.

- array `$parameters` The parameters supplied to `TrackerCodeGenerator::generate()`.


### Tracker.isBotRequest

*Defined in [Piwik/Tracker](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Tracker.php) in line [179](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Tracker.php#L179)*

Allows overwriting the Bot detection done using Device Detector
Use this event if you want to have a request handled as bot request instead of a normal visit

Callback Signature:
<pre><code>function(&amp;$isBot, $request]</code></pre>

- bool &$isBot Indicates if the request should be handled as Bot

- [Request](/api-reference/Piwik/Request) `$request` current tracking request

Usages:

[BotTracking::isBotRequest](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/BotTracking/BotTracking.php#L103)


### Tracker.isExcludedVisit

*Defined in [Piwik/Tracker/VisitExcluded](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Tracker/VisitExcluded.php) in line [100](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Tracker/VisitExcluded.php#L100)*

Triggered on every tracking request. This event can be used to tell the Tracker not to record this particular action or visit.

Callback Signature:
<pre><code>function(&amp;$excluded, $this-&gt;request)</code></pre>

- bool &$excluded Whether the request should be excluded or not. Initialized
                       to `false`. Event subscribers should set it to `true` in
                       order to exclude the request.

- \Request `$request` The request object which contains all of the request's information

Usages:

[JsTrackerInstallCheck::isExcludedVisit](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/JsTrackerInstallCheck/JsTrackerInstallCheck.php#L46), [TrackingSpamPrevention::isExcludedVisit](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TrackingSpamPrevention/TrackingSpamPrevention.php#L74)


### Tracker.makeNewVisitObject

*Defined in [Piwik/Tracker/Visit/Factory](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Tracker/Visit/Factory.php) in line [39](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Tracker/Visit/Factory.php#L39)*

Triggered before a new **visit tracking object** is created. Subscribers to this
event can force the use of a custom visit tracking object that extends from
Piwik\Tracker\VisitInterface.

Callback Signature:
<pre><code>function(&amp;$visit)</code></pre>

- \Piwik\Tracker\VisitInterface &$visit Initialized to null, but can be set to
                                             a new visit object. If it isn't modified
                                             Piwik uses the default class.


### Tracker.PageUrl.getQueryParametersToExclude

*Defined in [Piwik/Tracker/PageUrl](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Tracker/PageUrl.php) in line [102](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Tracker/PageUrl.php#L102)*

Triggered before setting the action url in Piwik\Tracker\Action so plugins can register
parameters to be excluded from the tracking URL (e.g. campaign parameters).

Callback Signature:
<pre><code>function(&amp;$parametersToExclude)</code></pre>

- array &$parametersToExclude An array of parameters to exclude from the tracking url.

Usages:

[MarketingCampaignsReporting::getQueryParametersToExclude](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/MarketingCampaignsReporting/MarketingCampaignsReporting.php#L66), [TagManager::getQueryParametersToExclude](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TagManager/TagManager.php#L257)


### Tracker.Request.getIdSite

*Defined in [Piwik/Tracker/Request](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Tracker/Request.php) in line [615](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Tracker/Request.php#L615)*

Triggered when obtaining the ID of the site we are tracking a visit for. This event can be used to change the site ID so data is tracked for a different
website.

Callback Signature:
<pre><code>function(&amp;$idSite, $this-&gt;params)</code></pre>

- int &$idSite Initialized to the value of the **idsite** query parameter. If a
                    subscriber sets this variable, the value it uses must be greater
                    than 0.

- array `$params` The entire array of request parameters in the current tracking
                     request.


### Tracker.setTrackerCacheGeneral

*Defined in [Piwik/Tracker/Cache](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Tracker/Cache.php) in line [217](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Tracker/Cache.php#L217)*

Triggered before the [general tracker cache](/guides/all-about-tracking#the-tracker-cache)
is saved to disk. This event can be used to add extra content to the cache. Data that is used during tracking but is expensive to compute/query should be
cached to keep tracking efficient. One example of such data are options
that are stored in the option table. Querying data for each tracking
request means an extra unnecessary database query for each visitor action. Using
a cache solves this problem.

**Example**

    public function setTrackerCacheGeneral(&$cacheContent)
    {
        $cacheContent['MyPlugin.myCacheKey'] = Option::get('MyPlugin_myOption');
    }

Callback Signature:
<pre><code>function(&amp;$cacheContent]</code></pre>

- array &$cacheContent Array of cached data. Each piece of data must be
                            mapped by name.

Usages:

[CoreHome::setTrackerCacheGeneral](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CoreHome/CoreHome.php#L79), [CustomDimensions::setTrackerCacheGeneral](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomDimensions/CustomDimensions.php#L404), [CustomVariables::getCacheGeneral](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomVariables/CustomVariables.php#L91), [PrivacyManager::setTrackerCacheGeneral](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/PrivacyManager/PrivacyManager.php#L586), [Referrers::setTrackerCacheGeneral](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Referrers/Referrers.php#L141), [SitesManager::setTrackerCacheGeneral](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/SitesManager/SitesManager.php#L216), [TrackingSpamPrevention::setTrackerCacheGeneral](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TrackingSpamPrevention/TrackingSpamPrevention.php#L62), [UserCountry::setTrackerCacheGeneral](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/UserCountry/UserCountry.php#L55)

## TrackingSpamPrevention

- [TrackingSpamPrevention.banIp](#trackingspampreventionbanip)

### TrackingSpamPrevention.banIp

*Defined in [Piwik/Plugins/TrackingSpamPrevention/BlockedIpRanges](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TrackingSpamPrevention/BlockedIpRanges.php) in line [153](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TrackingSpamPrevention/BlockedIpRanges.php#L153)*

This event is posted when an IP is being banned from tracking. You can use it for example to notify someone
that this IP was banned.

Callback Signature:
<pre><code>function($ipRange, $ip]</code></pre>

- string `$ipRange` The IP range that will be blocked

- string `$ip` The IP that caused this range to be blocked

Usages:

[TrackingSpamPrevention::onBanIp](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TrackingSpamPrevention/TrackingSpamPrevention.php#L50)

## Translate

- [Translate.getClientSideTranslationKeys](#translategetclientsidetranslationkeys)

### Translate.getClientSideTranslationKeys

*Defined in [Piwik/Translation/Translator](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Translation/Translator.php) in line [264](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Translation/Translator.php#L264)*

Triggered before generating the JavaScript code that allows i18n strings to be used
in the browser. Plugins should subscribe to this event to specify which translations
should be available to JavaScript.

Event handlers should add whole translation keys, ie, keys that include the plugin name.

**Example**

    public function getClientSideTranslationKeys(&$result)
    {
        $result[] = "MyPlugin_MyTranslation";
    }

Callback Signature:
<pre><code>function(&amp;$result)</code></pre>

- array &$result The whole list of client side translation keys.

Usages:

[Plugin::getClientSideTranslationKeys](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/API/API.php#L1000), [Annotations::getClientSideTranslationKeys](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Annotations/Annotations.php#L36), [BotTracking::getClientSideTranslationKeys](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/BotTracking/BotTracking.php#L166), [CoreAdminHome::getClientSideTranslationKeys](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CoreAdminHome/CoreAdminHome.php#L173), [CoreHome::getClientSideTranslationKeys](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CoreHome/CoreHome.php#L219), [CorePluginsAdmin::getClientSideTranslationKeys](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CorePluginsAdmin/CorePluginsAdmin.php#L108), [CoreVisualizations::getClientSideTranslationKeys](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CoreVisualizations/CoreVisualizations.php#L88), [CustomAlerts::getClientSideTranslationKeys](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomAlerts/CustomAlerts.php#L242), [CustomDimensions::getClientSideTranslationKeys](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomDimensions/CustomDimensions.php#L287), [CustomVariables::getClientSideTranslationKeys](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomVariables/CustomVariables.php#L120), [DBStats::getClientSideTranslationKeys](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/DBStats/DBStats.php#L31), [Dashboard::getClientSideTranslationKeys](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Dashboard/Dashboard.php#L319), [DevicesDetection::getClientSideTranslationKeys](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/DevicesDetection/DevicesDetection.php#L31), [Diagnostics::getClientSideTranslationKeys](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Diagnostics/Diagnostics.php#L36), [Ecommerce::getClientSideTranslationKeys](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Ecommerce/Ecommerce.php#L36), [Feedback::getClientSideTranslationKeys](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Feedback/Feedback.php#L47), [GeoIp2::getClientSideTranslationKeys](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/GeoIp2/GeoIp2.php#L44), [Goals::getClientSideTranslationKeys](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Goals/Goals.php#L472), [Installation::getClientSideTranslationKeys](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Installation/Installation.php#L42), [Intl::getClientSideTranslationKeys](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Intl/Intl.php#L21), [JsTrackerInstallCheck::getClientSideTranslationKeys](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/JsTrackerInstallCheck/JsTrackerInstallCheck.php#L31), [LanguagesManager::getClientSideTranslationKeys](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/LanguagesManager/LanguagesManager.php#L50), [Live::getClientSideTranslationKeys](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Live/Live.php#L163), [LogViewer::getClientSideTranslationKeys](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/LogViewer/LogViewer.php#L36), [Login::getClientSideTranslationKeys](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/Login.php#L103), [LoginLdap::getClientSideTranslationKeys](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/LoginLdap/LoginLdap.php#L70), [Marketplace::getClientSideTranslationKeys](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Marketplace/Marketplace.php#L68), [MobileMessaging::getClientSideTranslationKeys](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/MobileMessaging/MobileMessaging.php#L90), [MultiSites::getClientSideTranslationKeys](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/MultiSites/MultiSites.php#L53), [Overlay::getClientSideTranslationKeys](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Overlay/Overlay.php#L38), [PagePerformance::getClientSideTranslationKeys](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/PagePerformance/PagePerformance.php#L59), [PrivacyManager::getClientSideTranslationKeys](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/PrivacyManager/PrivacyManager.php#L260), [ProfessionalServices::getClientSideTranslationKeys](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/ProfessionalServices/ProfessionalServices.php#L48), [Referrers::getClientSideTranslationKeys](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Referrers/Referrers.php#L108), [ScheduledReports::getClientSideTranslationKeys](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/ScheduledReports/ScheduledReports.php#L125), [SecurityInfo::getClientSideTranslationKeys](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/SecurityInfo/SecurityInfo.php#L32), [SegmentEditor::getClientSideTranslationKeys](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/SegmentEditor/SegmentEditor.php#L365), [SitesManager::getClientSideTranslationKeys](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/SitesManager/SitesManager.php#L374), [TagManager::getClientSideTranslationKeys](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TagManager/TagManager.php#L428), [TasksTimetable::getClientSideTranslationKeys](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TasksTimetable/TasksTimetable.php#L25), [Tour::getClientSideTranslationKeys](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Tour/Tour.php#L140), [Transitions::getClientSideTranslationKeys](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Transitions/Transitions.php#L47), [TwoFactorAuth::getClientSideTranslationKeys](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TwoFactorAuth/TwoFactorAuth.php#L50), [UserCountry::getClientSideTranslationKeys](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/UserCountry/UserCountry.php#L33), [UserCountryMap::getClientSideTranslationKeys](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/UserCountryMap/UserCountryMap.php#L61), [UserId::getClientSideTranslationKeys](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/UserId/UserId.php#L48), [UsersManager::getClientSideTranslationKeys](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/UsersManager/UsersManager.php#L286), [VisitorGenerator::getClientSideTranslationKeys](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/VisitorGenerator/VisitorGenerator.php#L24), [Widgetize::getClientSideTranslationKeys](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Widgetize/Widgetize.php#L43)

## TwoFactorAuth

- [TwoFactorAuth.disabled](#twofactorauthdisabled)
- [TwoFactorAuth.enabled](#twofactorauthenabled)
- [TwoFactorAuth.requiresTwoFactorAuthentication](#twofactorauthrequirestwofactorauthentication)

### TwoFactorAuth.disabled

*Defined in [Piwik/Plugins/TwoFactorAuth/TwoFactorAuthentication](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TwoFactorAuth/TwoFactorAuthentication.php) in line [81](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TwoFactorAuth/TwoFactorAuthentication.php#L81)*



Callback Signature:
<pre><code>function($login)</code></pre>


### TwoFactorAuth.enabled

*Defined in [Piwik/Plugins/TwoFactorAuth/Controller](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TwoFactorAuth/Controller.php) in line [246](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TwoFactorAuth/Controller.php#L246)*



Callback Signature:
<pre><code>function($login)</code></pre>


### TwoFactorAuth.requiresTwoFactorAuthentication

*Defined in [Piwik/Plugins/TwoFactorAuth/TwoFactorAuth](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TwoFactorAuth/TwoFactorAuth.php) in line [313](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TwoFactorAuth/TwoFactorAuth.php#L313)*



Callback Signature:
<pre><code>function(&amp;$requiresAuth, $module, $action, $parameters)</code></pre>

Usages:

[TagManager::requiresTwoFactorAuthentication](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TagManager/TagManager.php#L97)

## Updater

- [Updater.componentInstalled](#updatercomponentinstalled)
- [Updater.componentUninstalled](#updatercomponentuninstalled)
- [Updater.componentUpdated](#updatercomponentupdated)

### Updater.componentInstalled

*Defined in [Piwik/Updater](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Updater.php) in line [108](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Updater.php#L108)*

Event triggered after a new component has been installed.

Callback Signature:
<pre><code>function($name)</code></pre>

- string `$name` The component that has been installed.


### Updater.componentUninstalled

*Defined in [Piwik/Updater](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Updater.php) in line [158](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Updater.php#L158)*

Event triggered after a component has been uninstalled.

Callback Signature:
<pre><code>function($name)</code></pre>

- string `$name` The component that has been uninstalled.


### Updater.componentUpdated

*Defined in [Piwik/Updater](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Updater.php) in line [136](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Updater.php#L136)*

Event triggered after a component has been updated. Can be used to handle logic that should be done after a component was updated

**Example**

    Piwik::addAction('Updater.componentUpdated', function ($componentName, $updatedVersion) {
         $mail = new Mail();
         $mail->setDefaultFromPiwik();
         $mail->addTo('test@example.org');
         $mail->setSubject('Component was updated);
         $message = sprintf(
             'Component %1$s has been updated to version %2$s',
             $componentName, $updatedVersion
         );
         $mail->setBodyText($message);
         $mail->send();
    });

Callback Signature:
<pre><code>function($name, $version)</code></pre>

- string `$componentName` 'core', plugin name or dimension name

- string `$updatedVersion` version updated to

Usages:

[CorePluginsAdmin::addPluginChanges](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CorePluginsAdmin/CorePluginsAdmin.php#L43), [CustomJsTracker::updateTracker](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomJsTracker/CustomJsTracker.php#L32)

## User

- [User.isNotAuthorized](#userisnotauthorized)

### User.isNotAuthorized

*Defined in [Piwik/FrontController](https://github.com/matomo-org/matomo/blob/5.x-dev/core/FrontController.php) in line [192](https://github.com/matomo-org/matomo/blob/5.x-dev/core/FrontController.php#L192)*

Triggered when a user with insufficient access permissions tries to view some resource. This event can be used to customize the error that occurs when a user is denied access
(for example, displaying an error message, redirecting to a page other than login, etc.).

Callback Signature:
<pre><code>function($exception)</code></pre>

- [NoAccessException](/api-reference/Piwik/NoAccessException) `$exception` The exception that was caught.

Usages:

[Login::noAccess](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/Login.php#L306)

## UserSettings

- [UserSettings.updated](#usersettingsupdated)

### UserSettings.updated

*Defined in [Piwik/Settings/Plugin/UserSettings](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Settings/Plugin/UserSettings.php) in line [87](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Settings/Plugin/UserSettings.php#L87)*

Triggered after user settings have been updated. **Example**

    Piwik::addAction('UserSettings.updated', function (UserSettings $settings) {
        if ($settings->getPluginName() === 'PluginName') {
            $value = $settings->someSetting->getValue();
            // Do something with the new setting value
        }
    });

Callback Signature:
<pre><code>function($this)</code></pre>

- \Settings `$settings` The plugin settings object.

## UsersManager

- [UsersManager.addUser.end](#usersmanageradduserend)
- [UsersManager.checkPassword](#usersmanagercheckpassword)
- [UsersManager.deleteUser](#usersmanagerdeleteuser)
- [UsersManager.getDefaultDates](#usersmanagergetdefaultdates)
- [UsersManager.getInviteVueComponents](#usersmanagergetinvitevuecomponents)
- [UsersManager.inviteUser.accepted](#usersmanagerinviteuseraccepted)
- [UsersManager.inviteUser.declined](#usersmanagerinviteuserdeclined)
- [UsersManager.inviteUser.end](#usersmanagerinviteuserend)
- [UsersManager.inviteUser.generateInviteLinkToken](#usersmanagerinviteusergenerateinvitelinktoken)
- [UsersManager.inviteUser.resendInvite](#usersmanagerinviteuserresendinvite)
- [UsersManager.removeSiteAccess](#usersmanagerremovesiteaccess)
- [UsersManager.removeSiteAccess](#usersmanagerremovesiteaccess)
- [UsersManager.removeSiteAccess](#usersmanagerremovesiteaccess)
- [UsersManager.removeSiteAccess](#usersmanagerremovesiteaccess)
- [UsersManager.updateUser.end](#usersmanagerupdateuserend)

### UsersManager.addUser.end

*Defined in [Piwik/Plugins/UsersManager/API](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/UsersManager/API.php) in line [798](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/UsersManager/API.php#L798)*

Triggered after a new user is created.

Callback Signature:
<pre><code>function($userLogin, $email, Piwik::getCurrentUserLogin()]</code></pre>

- string `$userLogin` The new user's login.

- string `$email` The new user's e-mail.

- string `$inviterLogin` The login of the user who created the new user


### UsersManager.checkPassword

*Defined in [Piwik/Plugins/UsersManager/UsersManager](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/UsersManager/UsersManager.php) in line [225](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/UsersManager/UsersManager.php#L225)*

Triggered before core password validator check password. This event exists for enable option to create custom password validation rules.
It can be used to validate password (length, used chars etc) and to notify about checking password.

**Example**

    Piwik::addAction('UsersManager.checkPassword', function ($password) {
        if (strlen($password) < 10) {
            throw new Exception('Password is too short.');
        }
    });

Callback Signature:
<pre><code>function($password)</code></pre>

- string `$password` Checking password in plain text.

Usages:

[LoginLdap::checkPassword](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/LoginLdap/LoginLdap.php#L271)


### UsersManager.deleteUser

*Defined in [Piwik/Plugins/UsersManager/Model](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/UsersManager/Model.php) in line [865](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/UsersManager/Model.php#L865)*



Callback Signature:
<pre><code>function($userLogin)</code></pre>

Usages:

[CoreAdminHome::cleanupUser](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CoreAdminHome/CoreAdminHome.php#L131), [CoreVisualizations::deleteUser](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CoreVisualizations/CoreVisualizations.php#L40), [CustomAlerts::deleteAlertsForLogin](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomAlerts/CustomAlerts.php#L109), [Dashboard::deleteDashboardLayout](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Dashboard/Dashboard.php#L304), [LanguagesManager::deleteUserLanguage](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/LanguagesManager/LanguagesManager.php#L126), [LoginLdap::onUserDeleted](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/LoginLdap/LoginLdap.php#L295), [ScheduledReports::deleteUserReport](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/ScheduledReports/ScheduledReports.php#L651), [SegmentEditor::onDeleteUser](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/SegmentEditor/SegmentEditor.php#L447)


### UsersManager.getDefaultDates

*Defined in [Piwik/Plugins/UsersManager/Controller](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/UsersManager/Controller.php) in line [233](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/UsersManager/Controller.php#L233)*

Triggered when the list of available dates is requested, for example for the
User Settings > Report date to load by default.

Callback Signature:
<pre><code>function(&amp;$dates)</code></pre>

- array &$dates Array of (date => translation)


### UsersManager.getInviteVueComponents

*Defined in [Piwik/Plugins/UsersManager/Controller](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/UsersManager/Controller.php) in line [162](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/UsersManager/Controller.php#L162)*



Callback Signature:
<pre><code>function(&amp;$inviteVueComponents]</code></pre>


### UsersManager.inviteUser.accepted

*Defined in [Piwik/Plugins/Login/Controller](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/Controller.php) in line [777](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/Controller.php#L777)*

Triggered after a user accepted an invite

Callback Signature:
<pre><code>function($userfunction(&#039;login&#039;], $userfunction(&#039;email&#039;], $userfunction(&#039;invited_by&#039;]]</code></pre>

- string `$userLogin` The invited user's login.

- string `$email` The invited user's e-mail.

- string `$inviterLogin` The login of the user, who invited this user


### UsersManager.inviteUser.declined

*Defined in [Piwik/Plugins/Login/Controller](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/Controller.php) in line [848](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Login/Controller.php#L848)*

Triggered after a user accepted an invite

Callback Signature:
<pre><code>function($userfunction(&#039;login&#039;], $userfunction(&#039;email&#039;], $userfunction(&#039;invited_by&#039;]]</code></pre>

- string `$userLogin` The invited user's login.

- string `$email` The invited user's e-mail.

- string `$inviterLogin` The login of the user, who invited this user


### UsersManager.inviteUser.end

*Defined in [Piwik/Plugins/UsersManager/API](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/UsersManager/API.php) in line [849](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/UsersManager/API.php#L849)*

Triggered after a new user was invited.

Callback Signature:
<pre><code>function($userLogin, $email]</code></pre>

- string `$userLogin` The new user's login.

- string `$email` The new user's e-mail.

Usages:

[Tour::onUserInvited](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Tour/Tour.php#L115)


### UsersManager.inviteUser.generateInviteLinkToken

*Defined in [Piwik/Plugins/UsersManager/API](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/UsersManager/API.php) in line [1789](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/UsersManager/API.php#L1789)*

Triggered after a new user invite token was generate.

Callback Signature:
<pre><code>function($userLogin, $userfunction(&#039;email&#039;]]</code></pre>

- string `$userLogin` The new user's login.


### UsersManager.inviteUser.resendInvite

*Defined in [Piwik/Plugins/UsersManager/API](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/UsersManager/API.php) in line [1740](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/UsersManager/API.php#L1740)*

Triggered after a new user was invited.

Callback Signature:
<pre><code>function($userLogin, $userfunction(&#039;email&#039;]]</code></pre>

- string `$userLogin` The new user's login.


### UsersManager.removeSiteAccess

*Defined in [Piwik/Plugins/ScheduledReports/tests/ScheduledReportsTest](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/ScheduledReports/tests/Integration/ScheduledReportsTest.php) in line [96](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/ScheduledReports/tests/Integration/ScheduledReportsTest.php#L96)*



Callback Signature:
<pre><code>function(&#039;userLogin&#039;, function(1, 2))</code></pre>

Usages:

[CustomAlerts::removeAlertsForUser](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomAlerts/CustomAlerts.php#L317), [ScheduledReports::deleteUserReportForSites](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/ScheduledReports/ScheduledReports.php#L656)


### UsersManager.removeSiteAccess

*Defined in [Piwik/Plugins/CustomAlerts/tests/Integration/CustomAlertsTest](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomAlerts/tests/Integration/CustomAlertsTest.php) in line [208](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomAlerts/tests/Integration/CustomAlertsTest.php#L208)*



Callback Signature:
<pre><code>function(&#039;userLogin&#039;, function(1))</code></pre>

Usages:

[CustomAlerts::removeAlertsForUser](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomAlerts/CustomAlerts.php#L317), [ScheduledReports::deleteUserReportForSites](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/ScheduledReports/ScheduledReports.php#L656)


### UsersManager.removeSiteAccess

*Defined in [Piwik/Plugins/CustomAlerts/tests/Integration/CustomAlertsTest](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomAlerts/tests/Integration/CustomAlertsTest.php) in line [217](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomAlerts/tests/Integration/CustomAlertsTest.php#L217)*



Callback Signature:
<pre><code>function(&#039;userLogin&#039;, function(1))</code></pre>

Usages:

[CustomAlerts::removeAlertsForUser](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomAlerts/CustomAlerts.php#L317), [ScheduledReports::deleteUserReportForSites](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/ScheduledReports/ScheduledReports.php#L656)


### UsersManager.removeSiteAccess

*Defined in [Piwik/Plugins/UsersManager/API](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/UsersManager/API.php) in line [1249](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/UsersManager/API.php#L1249)*



Callback Signature:
<pre><code>function($userLogin, $idSites]</code></pre>

Usages:

[CustomAlerts::removeAlertsForUser](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/CustomAlerts/CustomAlerts.php#L317), [ScheduledReports::deleteUserReportForSites](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/ScheduledReports/ScheduledReports.php#L656)


### UsersManager.updateUser.end

*Defined in [Piwik/Plugins/UsersManager/API](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/UsersManager/API.php) in line [1025](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/UsersManager/API.php#L1025)*

Triggered after an existing user has been updated. Event notify about password change.

Callback Signature:
<pre><code>function($userLogin, $passwordHasBeenUpdated, $email, $password]</code></pre>

- string `$userLogin` The user's login handle.

- boolean `$passwordHasBeenUpdated` Flag containing information about password change.

## ViewDataTable

- [ViewDataTable.configure](#viewdatatableconfigure)
- [ViewDataTable.configure.end](#viewdatatableconfigureend)
- [ViewDataTable.filterViewDataTable](#viewdatatablefilterviewdatatable)

### ViewDataTable.configure

*Defined in [Piwik/Plugin/ViewDataTable](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Plugin/ViewDataTable.php) in line [275](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Plugin/ViewDataTable.php#L275)*

Triggered during [ViewDataTable](/api-reference/Piwik/Plugin/ViewDataTable) construction. Subscribers should customize
the view based on the report that is being displayed. This event is triggered before view configuration properties are overwritten by saved settings or request
parameters. Use this to define default values.

Plugins that define their own reports must subscribe to this event in order to
specify how the Piwik UI should display the report.

**Example**

    // event handler
    public function configureViewDataTable(ViewDataTable $view)
    {
        switch ($view->requestConfig->apiMethodToRequestDataTable) {
            case 'VisitTime.getVisitInformationPerServerTime':
                $view->config->enable_sort = true;
                $view->requestConfig->filter_limit = 10;
                break;
        }
    }

Callback Signature:
<pre><code>function($this)</code></pre>

- [ViewDataTable](/api-reference/Piwik/Plugin/ViewDataTable) `$view` The instance to configure.

Usages:

[Actions::configureViewDataTable](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Actions/Actions.php#L170), [Bandwidth::configureViewDataTable](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Bandwidth/Bandwidth.php#L136), [Events::configureViewDataTable](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Events/Events.php#L144), [PagePerformance::configureViewDataTable](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/PagePerformance/PagePerformance.php#L138)


### ViewDataTable.configure.end

*Defined in [Piwik/Plugin/ViewDataTable](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Plugin/ViewDataTable.php) in line [318](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Plugin/ViewDataTable.php#L318)*

Triggered after [ViewDataTable](/api-reference/Piwik/Plugin/ViewDataTable) construction. Subscribers should customize
the view based on the report that is being displayed. This event is triggered after all view configuration values have been overwritten by saved settings or
request parameters. Use this if you need to work with the final configuration values.

Plugins that define their own reports can subscribe to this event in order to
specify how the Piwik UI should display the report.

**Example**

    // event handler
    public function configureViewDataTableEnd(ViewDataTable $view)
    {
        if ($view->requestConfig->apiMethodToRequestDataTable == 'VisitTime.getVisitInformationPerServerTime'
            && $view->requestConfig->flat == 1) {
                $view->config->show_header_message = 'You are viewing this report flattened';
        }
    }

Callback Signature:
<pre><code>function($this)</code></pre>

- [ViewDataTable](/api-reference/Piwik/Plugin/ViewDataTable) `$view` The instance to configure.


### ViewDataTable.filterViewDataTable

*Defined in [Piwik/ViewDataTable/Manager](https://github.com/matomo-org/matomo/blob/5.x-dev/core/ViewDataTable/Manager.php) in line [117](https://github.com/matomo-org/matomo/blob/5.x-dev/core/ViewDataTable/Manager.php#L117)*

Triggered to filter available DataTable visualizations. Plugins that want to disable certain visualizations should subscribe to
this event and remove visualizations from the incoming array.

**Example**

    public function filterViewDataTable(&$visualizations)
    {
        unset($visualizations[HtmlTable::ID]);
    }

Callback Signature:
<pre><code>function(&amp;$result)</code></pre>

- array &$visualizations An array of all available visualizations indexed by visualization ID.

Usages:

[TreemapVisualization::removeTreemapVisualizationIfFlattenIsUsed](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/TreemapVisualization/TreemapVisualization.php#L42)

## Visualization

- [Visualization.beforeRender](#visualizationbeforerender)

### Visualization.beforeRender

*Defined in [Piwik/Plugin/Visualization](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Plugin/Visualization.php) in line [833](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Plugin/Visualization.php#L833)*

Posted immediately before rendering the view. Plugins can use this event to perform last minute
configuration of the view based on it's data or the report being viewed.

Callback Signature:
<pre><code>function($this]</code></pre>

- [Visualization](/api-reference/Piwik/Plugin/Visualization) `$view` The instance to configure.

Usages:

[PrivacyManager::onConfigureVisualisation](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/PrivacyManager/PrivacyManager.php#L207)

## Widget

- [Widget.addWidgetConfigs](#widgetaddwidgetconfigs)
- [Widget.filterWidgets](#widgetfilterwidgets)

### Widget.addWidgetConfigs

*Defined in [Piwik/Plugin/WidgetsProvider](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Plugin/WidgetsProvider.php) in line [63](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Plugin/WidgetsProvider.php#L63)*

Triggered to add custom widget configs. To filter widgets have a look at the [Widget.filterWidgets](/api-reference/events#widgetfilterwidgets)
event. **Example**

    public function addWidgetConfigs(&$configs)
    {
        $config = new WidgetConfig();
        $config->setModule('PluginName');
        $config->setAction('renderDashboard');
        $config->setCategoryId('Dashboard_Dashboard');
        $config->setSubcategoryId('dashboardId');
        $configs[] = $config;
    }

Callback Signature:
<pre><code>function(&amp;$configs)</code></pre>

- array &$configs An array containing a list of widget config entries.

Usages:

[Dashboard::addWidgetConfigs](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Dashboard/Dashboard.php#L56)


### Widget.filterWidgets

*Defined in [Piwik/Widget/WidgetsList](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Widget/WidgetsList.php) in line [212](https://github.com/matomo-org/matomo/blob/5.x-dev/core/Widget/WidgetsList.php#L212)*

Triggered to filter widgets. **Example**

    public function removeWidgetConfigs(Piwik\Widget\WidgetsList $list)
    {
        $list->remove($category='General_Visits'); // remove all widgets having this category
    }

Callback Signature:
<pre><code>function($list)</code></pre>

- [WidgetsList](/api-reference/Piwik/Widget/WidgetsList) `$list` An instance of the WidgetsList. You can change the list of widgets this way.

Usages:

[Marketplace::filterWidgets](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Marketplace/Marketplace.php#L200), [RssWidget::filterWidgets](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/RssWidget/RssWidget.php#L46)

## Widgetize

- [Widgetize.shouldEmbedIframeEmpty](#widgetizeshouldembediframeempty)

### Widgetize.shouldEmbedIframeEmpty

*Defined in [Piwik/Plugins/Widgetize/Controller](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Widgetize/Controller.php) in line [81](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Widgetize/Controller.php#L81)*

Triggered to detect whether a widgetized report should be wrapped in the widgetized HTML or whether only
the rendered output of the controller/action should be printed. Set `$shouldEmbedEmpty` to `true` if
your widget renders the full HTML itself. **Example**

    public function embedIframeEmpty(&$shouldEmbedEmpty, $controllerName, $actionName)
    {
        if ($controllerName == 'Dashboard' && $actionName == 'index') {
            $shouldEmbedEmpty = true;
        }
    }

Callback Signature:
<pre><code>function(&amp;$shouldEmbedEmpty, $controllerName, $actionName)</code></pre>

- string &$shouldEmbedEmpty Defines whether the iframe should be embedded empty or wrapped within the widgetized html.

- string `$controllerName` The name of the controller that will be executed.

- string `$actionName` The name of the action within the controller that will be executed.

Usages:

[Dashboard::shouldEmbedIframeEmpty](https://github.com/matomo-org/matomo/blob/5.x-dev/plugins/Dashboard/Dashboard.php#L49)

