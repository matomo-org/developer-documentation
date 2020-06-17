<small>Piwik\Plugins\Live\</small>

VisitorDetailsAbstract
======================

Class VisitorDetailsAbstract

This class can be implemented in a plugin to extend the Live reports, visit log and profile

Methods
-------

The abstract class defines the following methods:

- [`extendVisitorDetails()`](#extendvisitordetails) &mdash; Makes it possible to extend the visitor details returned from API
- [`provideActionsForVisit()`](#provideactionsforvisit) &mdash; Makes it possible to enrich the action set for a single visit
- [`provideActionsForVisitIds()`](#provideactionsforvisitids) &mdash; Makes it possible to enrich the action set for multiple visits identified by given visit ids
- [`filterActions()`](#filteractions) &mdash; Allows filtering the provided actions
- [`extendActionDetails()`](#extendactiondetails) &mdash; Allows extending each action with additional information
- [`renderAction()`](#renderaction) &mdash; Called when rendering a single Action
- [`renderActionTooltip()`](#renderactiontooltip) &mdash; Called for rendering the tooltip on actions returned array needs to look like this:
- [`renderIcons()`](#rendericons) &mdash; Called when rendering the Icons in visit log
- [`renderVisitorDetails()`](#rendervisitordetails) &mdash; Called when rendering the visitor details in visit log returned array needs to look like this: array ( 20, // order id 'rendered html content' )
- [`initProfile()`](#initprofile) &mdash; Allows manipulating the visitor profile properties Will be called when visitor profile is initialized
- [`handleProfileVisit()`](#handleprofilevisit) &mdash; Allows manipulating the visitor profile properties based on included visits Will be called for every action within the profile
- [`handleProfileAction()`](#handleprofileaction) &mdash; Allows manipulating the visitor profile properties based on included actions Will be called for every action within the profile
- [`finalizeProfile()`](#finalizeprofile) &mdash; Will be called after iterating over all actions Can be used to set profile information that requires data that was set while iterating over visits & actions
- [`getDb()`](#getdb)

<a name="extendvisitordetails" id="extendvisitordetails"></a>
<a name="extendVisitorDetails" id="extendVisitorDetails"></a>
### `extendVisitorDetails()`

Makes it possible to extend the visitor details returned from API

**Example:**

    public function extendVisitorDetails(&$visitor) {
        $crmData = Model::getCRMData($visitor['userid']);

        foreach ($crmData as $prop => $value) {
            $visitor[$prop] = $value;
        }
    }

#### Signature

-  It accepts the following parameter(s):
    - `$visitor` (`array`) &mdash;
      
- It does not return anything.

<a name="provideactionsforvisit" id="provideactionsforvisit"></a>
<a name="provideActionsForVisit" id="provideActionsForVisit"></a>
### `provideActionsForVisit()`

Makes it possible to enrich the action set for a single visit

**Example:**

    public function provideActionsForVisit(&$actions, $visitorDetails) {
        $adviews = Model::getAdviews($visitorDetails['visitid']);
        $actions += $adviews;
    }

#### Signature

-  It accepts the following parameter(s):
    - `$actions` (`array`) &mdash;
       List of action to manipulate
    - `$visitorDetails` (`array`) &mdash;
      
- It does not return anything.

<a name="provideactionsforvisitids" id="provideactionsforvisitids"></a>
<a name="provideActionsForVisitIds" id="provideActionsForVisitIds"></a>
### `provideActionsForVisitIds()`

Makes it possible to enrich the action set for multiple visits identified by given visit ids

action set to enrich needs to have the following structure

```
$actions = array (
    'idvisit' => array ( list of actions for this visit id ),
    'idvisit' => array ( list of actions for this visit id ),
    ...
)
```

**Example:**

    public function provideActionsForVisitIds(&$actions, $visitIds) {
        $adviews = Model::getAdviewsByVisitIds($visitIds);
        foreach ($adviews as $idVisit => $adView) {
            $actions[$idVisit][] = $adView;
        }
    }

#### Signature

-  It accepts the following parameter(s):
    - `$actions` (`array`) &mdash;
       action set to enrich
    - `$visitIds` (`array`) &mdash;
       list of visit ids
- It does not return anything.

<a name="filteractions" id="filteractions"></a>
<a name="filterActions" id="filterActions"></a>
### `filterActions()`

Allows filtering the provided actions

**Example:**

    public function filterActions(&$actions, $visitorDetailsArray) {
        foreach ($actions as $idx => $action) {
            if ($action['type'] == 'customaction') {
                unset($actions[$idx]);
                continue;
            }
        }
    }

#### Signature

-  It accepts the following parameter(s):
    - `$actions` (`array`) &mdash;
      
    - `$visitorDetailsArray` (`array`) &mdash;
      
- It does not return anything.

<a name="extendactiondetails" id="extendactiondetails"></a>
<a name="extendActionDetails" id="extendActionDetails"></a>
### `extendActionDetails()`

Allows extending each action with additional information

**Example:**

    public function extendActionDetails(&$action, $nextAction, $visitorDetails) {
         if ($action['type'] === 'Contents') {
             $action['contentView'] = true;
         }
    }

#### Signature

-  It accepts the following parameter(s):
    - `$action` (`array`) &mdash;
      
    - `$nextAction` (`array`) &mdash;
      
    - `$visitorDetails` (`array`) &mdash;
      
- It does not return anything.

<a name="renderaction" id="renderaction"></a>
<a name="renderAction" id="renderAction"></a>
### `renderAction()`

Called when rendering a single Action

**Example:**

    public function renderAction($action, $previousAction, $visitorDetails) {
        if ($action['type'] != Action::TYPE_CONTENT) {
            return;
        }

        $view                 = new View('@Contents/_actionContent.twig');
        $view->sendHeadersWhenRendering = false;
        $view->action         = $action;
        $view->previousAction = $previousAction;
        $view->visitInfo      = $visitorDetails;
        return $view->render();
    }

#### Signature

-  It accepts the following parameter(s):
    - `$action` (`array`) &mdash;
      
    - `$previousAction` (`array`) &mdash;
      
    - `$visitorDetails` (`array`) &mdash;
      
- It returns a `string` value.

<a name="renderactiontooltip" id="renderactiontooltip"></a>
<a name="renderActionTooltip" id="renderActionTooltip"></a>
### `renderActionTooltip()`

Called for rendering the tooltip on actions
returned array needs to look like this:

```
array (
         20,   // order id
         'rendered html content'
)
```

**Example:**

    public function renderActionTooltip($action, $visitInfo) {
        if (empty($action['bandwidth'])) {
            return [];
        }

        $view         = new View('@Bandwidth/_actionTooltip');
        $view->action = $action;
        return [[ 20, $view->render() ]];
    }

#### Signature

-  It accepts the following parameter(s):
    - `$action` (`array`) &mdash;
      
    - `$visitInfo` (`array`) &mdash;
      
- It returns a `array` value.

<a name="rendericons" id="rendericons"></a>
<a name="renderIcons" id="renderIcons"></a>
### `renderIcons()`

Called when rendering the Icons in visit log

**Example:**

    public function renderIcons($visitorDetails) {
        if (!empty($visitorDetails['avatar'])) {
            return '<img src="' . $visitorDetails['avatar'] . '" height="16" width="16">';
        }
        return '';
    }

#### Signature

-  It accepts the following parameter(s):
    - `$visitorDetails` (`array`) &mdash;
      
- It returns a `string` value.

<a name="rendervisitordetails" id="rendervisitordetails"></a>
<a name="renderVisitorDetails" id="renderVisitorDetails"></a>
### `renderVisitorDetails()`

Called when rendering the visitor details in visit log
returned array needs to look like this:
array (
         20,   // order id
         'rendered html content'
)

**Example:**

    public function renderVisitorDetails($visitorDetails) {
        $view            = new View('@MyPlugin/_visitorDetails.twig');
        $view->visitInfo = $visitorDetails;
        return $view->render();
    }

#### Signature

-  It accepts the following parameter(s):
    - `$visitorDetails` (`array`) &mdash;
      
- It returns a `array` value.

<a name="initprofile" id="initprofile"></a>
<a name="initProfile" id="initProfile"></a>
### `initProfile()`

Allows manipulating the visitor profile properties
Will be called when visitor profile is initialized

**Example:**

    public function initProfile($visit, &$profile) {
        // initialize properties that will be filled based on visits or actions
        $profile['totalActions']         = 0;
        $profile['totalActionsOfMyType'] = 0;
    }

#### Signature

-  It accepts the following parameter(s):
    - `$visits` ([`DataTable`](../../../Piwik/DataTable.md)) &mdash;
      
    - `$profile` (`array`) &mdash;
      
- It does not return anything.

<a name="handleprofilevisit" id="handleprofilevisit"></a>
<a name="handleProfileVisit" id="handleProfileVisit"></a>
### `handleProfileVisit()`

Allows manipulating the visitor profile properties based on included visits
Will be called for every action within the profile

**Example:**

    public function handleProfileVisit($visit, &$profile) {
        $profile['totalActions'] += $visit->getColumn('actions');
    }

#### Signature

-  It accepts the following parameter(s):
    - `$visit` ([`Row`](../../../Piwik/DataTable/Row.md)) &mdash;
      
    - `$profile` (`array`) &mdash;
      
- It does not return anything.

<a name="handleprofileaction" id="handleprofileaction"></a>
<a name="handleProfileAction" id="handleProfileAction"></a>
### `handleProfileAction()`

Allows manipulating the visitor profile properties based on included actions
Will be called for every action within the profile

**Example:**

    public function handleProfileAction($action, &$profile)
    {
        if ($action['type'] != 'myactiontype') {
            return;
        }

        $profile['totalActionsOfMyType']++;
    }

#### Signature

-  It accepts the following parameter(s):
    - `$action` (`array`) &mdash;
      
    - `$profile` (`array`) &mdash;
      
- It does not return anything.

<a name="finalizeprofile" id="finalizeprofile"></a>
<a name="finalizeProfile" id="finalizeProfile"></a>
### `finalizeProfile()`

Will be called after iterating over all actions
Can be used to set profile information that requires data that was set while iterating over visits & actions

**Example:**

    public function finalizeProfile($visits, &$profile) {
        $profile['isPowerUser'] = false;

        if ($profile['totalActionsOfMyType'] > 20) {
            $profile['isPowerUser'] = true;
        }
    }

#### Signature

-  It accepts the following parameter(s):
    - `$visits` ([`DataTable`](../../../Piwik/DataTable.md)) &mdash;
      
    - `$profile` (`array`) &mdash;
      
- It does not return anything.

<a name="getdb" id="getdb"></a>
<a name="getDb" id="getDb"></a>
### `getDb()`

Since Matomo Matomo

#### Signature


- *Returns:*  [`Db`](../../../Piwik/Db.md)|`Piwik\Db\AdapterInterface` &mdash;
    

