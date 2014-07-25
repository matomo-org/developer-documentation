<small>Piwik\</small>

FrontController
===============

This singleton dispatches requests to the appropriate plugin Controller.

Piwik uses this class for all requests that go through **index.php**. Plugins can
use it to call controller actions of other plugins.

### Examples

**Forwarding controller requests**

    public function myConfiguredRealtimeMap()
    {
        $_GET['changeVisitAlpha'] = false;
        $_GET['removeOldVisits'] = false;
        $_GET['showFooterMessage'] = false;
        return FrontController::getInstance()->dispatch('UserCountryMap', 'realtimeMap');
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
        return $realtimeMap->render();
    }

For a detailed explanation, see the documentation [here](http://piwik.org/docs/plugins/framework-overview).

Methods
-------

The class defines the following methods:

- [`getInstance()`](#getinstance) &mdash; Returns the singleton instance for the derived class.
- [`dispatch()`](#dispatch) &mdash; Executes the requested plugin controller method.

<a name="getinstance" id="getinstance"></a>
<a name="getInstance" id="getInstance"></a>
### `getInstance()`

Returns the singleton instance for the derived class.

If the singleton instance
has not been created, this method will create it.

#### Signature

- It returns a [`Singleton`](../Piwik/Singleton.md) value.

<a name="dispatch" id="dispatch"></a>
<a name="dispatch" id="dispatch"></a>
### `dispatch()`

Executes the requested plugin controller method.

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

      <div markdown="1" class="param-desc"> The controller method name, eg, `'realtimeMap'`.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$parameters` (`array`) &mdash;

      <div markdown="1" class="param-desc"> Array of parameters to pass to the controller method.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`void`|`mixed`) &mdash;
    <div markdown="1" class="param-desc">The returned value of the call. This is the output of the controller method.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>
- It throws one of the following exceptions:
    - `Exception|\Piwik\PluginDeactivatedException` &mdash; in case the plugin doesn&#039;t exist, the action doesn&#039;t exist, there is not enough permission, etc.

