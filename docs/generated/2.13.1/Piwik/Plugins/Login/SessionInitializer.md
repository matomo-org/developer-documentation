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
    - `$usersManagerAPI` (`Piwik\Plugins\UsersManager\API`|`null`) &mdash;
      
    - `$authCookieName` (`string`|`null`) &mdash;
      
    - `$authCookieValidTime` (`int`|`null`) &mdash;
      
    - `$authCookiePath` (`string`|`null`) &mdash;
      

<a name="initsession" id="initsession"></a>
<a name="initSession" id="initSession"></a>
### `initSession()`

Authenticates the user and, if successful, initializes an authenticated session.

#### Signature

-  It accepts the following parameter(s):
    - `$auth` ([`Auth`](../../../Piwik/Auth.md)) &mdash;
       The Auth implementation to use.
    - `$rememberMe` (`bool`) &mdash;
       Whether the authenticated session should be remembered after the browser is closed or not.
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; If authentication fails or the user is not allowed to login for some reason.

<a name="gethashtokenauth" id="gethashtokenauth"></a>
<a name="getHashTokenAuth" id="getHashTokenAuth"></a>
### `getHashTokenAuth()`

Accessor to compute the hashed authentication token.

#### Signature

-  It accepts the following parameter(s):
    - `$login` (`string`) &mdash;
       user login
    - `$token_auth` (`string`) &mdash;
       authentication token

- *Returns:*  `string` &mdash;
    hashed authentication token

