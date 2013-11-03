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
        $_GET[&#039;changeVisitAlpha&#039;] = false;
        $_GET[&#039;removeOldVisits&#039;] = false;
        $_GET[&#039;showFooterMessage&#039;] = false;
        FrontController::getInstance()-&gt;dispatch(&#039;UserCountryMap&#039;, &#039;realtimeMap&#039;);
    }

**Using other plugin controller actions**

    public function myPopupWithRealtimeMap()
    {
        $_GET[&#039;changeVisitAlpha&#039;] = false;
        $_GET[&#039;removeOldVisits&#039;] = false;
        $_GET[&#039;showFooterMessage&#039;] = false;
        $realtimeMap = FrontController::getInstance()-&gt;fetchDispatch(&#039;UserCountryMap&#039;, &#039;realtimeMap&#039;);
        
        $view = new View(&#039;@MyPlugin/myPopupWithRealtimeMap.twig&#039;);
        $view-&gt;realtimeMap = $realtimeMap;
        echo $realtimeMap-&gt;render();
    }

For a detailed explanation, see the documentation [here](http://piwik.org/docs/plugins/framework-overview).


Methods
-------

The class defines the following methods:

- [`dispatch()`](#dispatch) &mdash; Executes the requested plugin controller action.
- [`fetchDispatch()`](#fetchDispatch) &mdash; Executes the requested plugin controller action and returns the data the action echos.

### `dispatch()` <a name="dispatch"></a>

Executes the requested plugin controller action.

#### Description

See also [fetchDispatch](#fetchDispatch).

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$module`
    - `$action`
    - `$parameters`
- _Returns:_ The returned value of the call. Often nothing as most controller actions echo, but do not return data.
    - `void`
    - `mixed`
- It throws one of the following exceptions:
    - `Exception|\Piwik\PluginDeactivatedException` &mdash; in case the plugin doesn&#039;t exist, the action doesn&#039;t exist, there is not enough permission, etc.

### `fetchDispatch()` <a name="fetchDispatch"></a>

Executes the requested plugin controller action and returns the data the action echos.

#### Description

Note: If the plugin controller returns something, the return value is returned instead
of whatever is in the output buffer.

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$module`
    - `$actionName`
    - `$parameters`
- _Returns:_ The `echo`&#039;d data or the return value of the controller action.
    - `string`

