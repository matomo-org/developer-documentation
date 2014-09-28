<small>Piwik\Plugins\Login\</small>

SessionInitializer
==================

Initializes authenticated sessions using an Auth implementation.

If a user is authenticated, a browser cookie is created so the user will be remembered
until the cookie is destroyed.

Plugins can override SessionInitializer behavior by extending this class and
overriding methods. In order for these changes to have effect, however, an instance of
the derived class must be used by the Login/Controller.

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`initSession()`](#initsession) &mdash; Authenticates the user and, if successful, initializes an authenticated session.
- [`getHashTokenAuth()`](#gethashtokenauth) &mdash; Accessor to compute the hashed authentication token.

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$usersManagerAPI` (`Piwik\Plugins\UsersManager\API`|`null`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$authCookieName` (`string`|`null`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$authCookieValidTime` (`int`|`null`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$authCookiePath` (`string`|`null`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<a name="initsession" id="initsession"></a>
<a name="initSession" id="initSession"></a>
### `initSession()`

Authenticates the user and, if successful, initializes an authenticated session.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$auth` (`Piwik\Auth`) &mdash;

      <div markdown="1" class="param-desc"> The Auth implementation to use.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$rememberMe` (`bool`) &mdash;

      <div markdown="1" class="param-desc"> Whether the authenticated session should be remembered after the browser is closed or not.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If authentication fails or the user is not allowed to login for some reason.

<a name="gethashtokenauth" id="gethashtokenauth"></a>
<a name="getHashTokenAuth" id="getHashTokenAuth"></a>
### `getHashTokenAuth()`

Accessor to compute the hashed authentication token.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$login` (`string`) &mdash;

      <div markdown="1" class="param-desc"> user login</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$token_auth` (`string`) &mdash;

      <div markdown="1" class="param-desc"> authentication token</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`string`) &mdash;
    <div markdown="1" class="param-desc">hashed authentication token</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

