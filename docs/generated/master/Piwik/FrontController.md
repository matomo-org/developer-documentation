<small>Piwik</small>

FrontController
===============

This singleton dispatches requests to the appropriate plugin Controller.

Description
-----------

Piwik uses this class for all requests that go through index.php. Plugins can
use it to call controller actions of other plugins.

### Examples

**Forwarding controller requests**

    public function myConfiguredRealtimeMap()
    {
        $_GET['changeVisitAlpha'] = false;
        $_GET['removeOldVisits'] = false;
        $_GET['showFooterMessage'] = false;
        FrontController::getInstance()->dispatch('UserCountryMap', 'realtimeMap');
    }

**Using other plugin controller actions**

    public function myPopupWithRealtimeMap()
    {
        $_GET['changeVisitAlpha'] = false;
        $_GET['removeOldVisits'] = false;
        $_GET['showFooterMessage'] = false;
        $realtimeMap = FrontController::getInstance()->fetchDispatch('UserCountryMap', 'realtimeMap');
        
        $view = new View('@MyPlugin/myPopupWithRealtimeMap.twig');
        $view->realtimeMap = $realtimeMap;
        echo $realtimeMap->render();
    }

For a detailed explanation, see the documentation [here](http://piwik.org/docs/plugins/framework-overview).

Methods
-------

The class defines the following methods:

- [`dispatch()`](#dispatch) &mdash; Executes the requested plugin controller action.
- [`fetchDispatch()`](#fetchdispatch) &mdash; Executes the requested plugin controller action and returns the data the action echos.

<a name="dispatch" id="dispatch"></a>
<a name="dispatch" id="dispatch"></a>
### `dispatch()`

Executes the requested plugin controller action.

#### Description

See also [fetchDispatch()](/api-reference/Piwik/FrontController#fetchdispatch).

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$module` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The name of the plugin whose controller to execute, eg, `'UserCountryMap'`.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$action` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The controller action name, eg, `'realtimeMap'`.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$parameters` (`array`) &mdash;

      <div markdown="1" class="param-desc"> Array of parameters to pass to the controller action method.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- _Returns:_ The returned value of the call. Often nothing as most controller actions echo, but do not return data.
    - `void`
    - `mixed`
- It throws one of the following exceptions:
    - `Exception|\Piwik\PluginDeactivatedException` &mdash; in case the plugin doesn&#039;t exist, the action doesn&#039;t exist, there is not enough permission, etc.

<a name="fetchdispatch" id="fetchdispatch"></a>
<a name="fetchDispatch" id="fetchDispatch"></a>
### `fetchDispatch()`

Executes the requested plugin controller action and returns the data the action echos.

#### Description

Note: If the plugin controller returns something, the return value is returned instead
of whatever is in the output buffer.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$module`

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$actionName`

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$parameters`

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- _Returns:_ The `echo`'d data or the return value of the controller action.
    - `string`

