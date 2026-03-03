<small>Piwik\</small>

Auth
====

Base interface for authentication implementations.

Plugins that provide Auth implementations must provide a class that implements
this interface. Additionally, an instance of that class must be set in the
container with the 'Piwik\Auth' key during the
[Request.initAuthenticationObject](https://developer.matomo.org/api-reference/events#requestinitauthenticationobject)
event.

Authentication implementations must support authentication via username and
clear-text password and authentication via username and token auth. They can
additionally support authentication via username and an MD5 hash of a password. If
they don't support it, then [formless authentication](https://matomo.org/faq/how-to/faq_30/) will fail.

Derived implementations should favor authenticating by password over authenticating
by token auth. That is to say, if a token auth and a password are set, password
authentication should be used.

### Examples

**How an Auth implementation will be used**

    // authenticating by password
    $auth = StaticContainer::get('Piwik\Auth');
    $auth->setLogin('user');
    $auth->setPassword('password');
    $result = $auth->authenticate();

    // authenticating by token auth
    $auth = StaticContainer::get('Piwik\Auth');
    $auth->setLogin('user');
    $auth->setTokenAuth('...');
    $result = $auth->authenticate();

Methods
-------

The interface defines the following methods:

- [`getName()`](#getname) &mdash; Must return the Authentication module's name, e.g., `"Login"`.
- [`setTokenAuth()`](#settokenauth) &mdash; Sets the authentication token to authenticate with.
- [`getLogin()`](#getlogin) &mdash; Returns the login of the user being authenticated.
- [`getTokenAuthSecret()`](#gettokenauthsecret) &mdash; Returns the secret used to calculate a user's token auth.
- [`setLogin()`](#setlogin) &mdash; Sets the login name to authenticate with.
- [`setPassword()`](#setpassword) &mdash; Sets the password to authenticate with.
- [`setPasswordHash()`](#setpasswordhash) &mdash; Sets the hash of the password to authenticate with.
- [`authenticate()`](#authenticate) &mdash; Authenticates a user using the login and password set using the setters.

<a name="getname" id="getname"></a>
<a name="getName" id="getName"></a>
### `getName()`

Must return the Authentication module's name, e.g., `"Login"`.

#### Signature

- It returns a `string` value.

<a name="settokenauth" id="settokenauth"></a>
<a name="setTokenAuth" id="setTokenAuth"></a>
### `setTokenAuth()`

Sets the authentication token to authenticate with.

#### Signature

-  It accepts the following parameter(s):
    - `$token_auth` (`string`) &mdash;
       authentication token
- It does not return anything or a mixed result.

<a name="getlogin" id="getlogin"></a>
<a name="getLogin" id="getLogin"></a>
### `getLogin()`

Returns the login of the user being authenticated.

#### Signature

- It returns a `string` value.

<a name="gettokenauthsecret" id="gettokenauthsecret"></a>
<a name="getTokenAuthSecret" id="getTokenAuthSecret"></a>
### `getTokenAuthSecret()`

Returns the secret used to calculate a user's token auth.

A users token auth is generated using the user's login and this secret. The secret
should be specific to the user and not easily guessed. Piwik's default Auth implementation
uses an MD5 hash of a user's password.

#### Signature

- It returns a `string` value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if the token auth secret does not exist or cannot be obtained.

<a name="setlogin" id="setlogin"></a>
<a name="setLogin" id="setLogin"></a>
### `setLogin()`

Sets the login name to authenticate with.

#### Signature

-  It accepts the following parameter(s):
    - `$login` (`string`) &mdash;
       The username.
- It does not return anything or a mixed result.

<a name="setpassword" id="setpassword"></a>
<a name="setPassword" id="setPassword"></a>
### `setPassword()`

Sets the password to authenticate with.

#### Signature

-  It accepts the following parameter(s):
    - `$password` (`string`) &mdash;
       Password (not hashed).
- It does not return anything or a mixed result.

<a name="setpasswordhash" id="setpasswordhash"></a>
<a name="setPasswordHash" id="setPasswordHash"></a>
### `setPasswordHash()`

Sets the hash of the password to authenticate with. The hash will be an MD5 hash.

#### Signature

-  It accepts the following parameter(s):
    - `$passwordHash` (`string`) &mdash;
       The hashed password.
- It does not return anything or a mixed result.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if authentication by hashed password is not supported.

<a name="authenticate" id="authenticate"></a>
<a name="authenticate" id="authenticate"></a>
### `authenticate()`

Authenticates a user using the login and password set using the setters. Can also authenticate
via token auth if one is set and no password is set.

Note: this method must successfully authenticate if the token auth supplied is a special hash
of the user's real token auth. This is because the SessionInitializer class stores a
hash of the token auth in the session cookie. You can calculate the token auth hash using the
\Piwik\Plugins\Login\SessionInitializer::getHashTokenAuth() method.

#### Signature

- It returns a [`AuthResult`](../Piwik/AuthResult.md) value.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if the Auth implementation has an invalid state (ie, no login
                  was specified). Note: implementations are not **required** to throw
                  exceptions for invalid state, but they are allowed to.

