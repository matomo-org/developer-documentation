<small>Piwik</small>

Piwik
=====

Main piwik helper class.

Description
-----------

Contains static functions you can call from the plugins.


Constants
---------

This class defines the following constants:

- [`LABEL_ID_GOAL_IS_ECOMMERCE_CART`](#LABEL_ID_GOAL_IS_ECOMMERCE_CART)
- [`LABEL_ID_GOAL_IS_ECOMMERCE_ORDER`](#LABEL_ID_GOAL_IS_ECOMMERCE_ORDER)

Methods
-------

The class defines the following methods:

- [`exitWithErrorMessage()`](#exitWithErrorMessage) &mdash; Display the message in a nice red font with a nice icon ...
- [`getCurrentUserEmail()`](#getCurrentUserEmail) &mdash; Get current user email address
- [`getSuperUserLogin()`](#getSuperUserLogin) &mdash; Returns Super User login
- [`getSuperUserEmail()`](#getSuperUserEmail) &mdash; Returns Super User email
- [`getCurrentUserLogin()`](#getCurrentUserLogin) &mdash; Get current user login
- [`getCurrentUserTokenAuth()`](#getCurrentUserTokenAuth) &mdash; Get current user&#039;s token auth
- [`isUserIsSuperUserOrTheUser()`](#isUserIsSuperUserOrTheUser) &mdash; Returns true if the current user is either the super user, or the user $theUser Used when modifying user preference: this usually requires super user or being the user itself.
- [`checkUserIsSuperUserOrTheUser()`](#checkUserIsSuperUserOrTheUser) &mdash; Check that current user is either the specified user or the superuser
- [`isUserIsSuperUser()`](#isUserIsSuperUser) &mdash; Returns true if the current user is the Super User
- [`isUserIsAnonymous()`](#isUserIsAnonymous) &mdash; Is user the anonymous user?
- [`checkUserIsNotAnonymous()`](#checkUserIsNotAnonymous) &mdash; Checks if user is not the anonymous user.
- [`setUserIsSuperUser()`](#setUserIsSuperUser) &mdash; Helper method user to set the current as Super User.
- [`checkUserIsSuperUser()`](#checkUserIsSuperUser) &mdash; Check that user is the superuser
- [`isUserHasAdminAccess()`](#isUserHasAdminAccess) &mdash; Returns true if the user has admin access to the sites
- [`checkUserHasAdminAccess()`](#checkUserHasAdminAccess) &mdash; Check user has admin access to the sites
- [`isUserHasSomeAdminAccess()`](#isUserHasSomeAdminAccess) &mdash; Returns true if the user has admin access to any sites
- [`checkUserHasSomeAdminAccess()`](#checkUserHasSomeAdminAccess) &mdash; Check user has admin access to any sites
- [`isUserHasViewAccess()`](#isUserHasViewAccess) &mdash; Returns true if the user has view access to the sites
- [`checkUserHasViewAccess()`](#checkUserHasViewAccess) &mdash; Check user has view access to the sites
- [`isUserHasSomeViewAccess()`](#isUserHasSomeViewAccess) &mdash; Returns true if the user has view access to any sites
- [`checkUserHasSomeViewAccess()`](#checkUserHasSomeViewAccess) &mdash; Check user has view access to any sites
- [`getModule()`](#getModule) &mdash; Returns the current module read from the URL (eg.
- [`getAction()`](#getAction) &mdash; Returns the current action read from the URL
- [`redirectToModule()`](#redirectToModule) &mdash; Redirect to module (and action)
- [`isValidEmailString()`](#isValidEmailString) &mdash; Returns true if the email is a valid email
- [`postEvent()`](#postEvent) &mdash; Post an event to the dispatcher which will notice the observers.
- [`addAction()`](#addAction) &mdash; Register an action to execute for a given event
- [`translate()`](#translate) &mdash; Returns translated string or given message if translation is not found.
- [`translateException()`](#translateException) &mdash; Returns translated string or given message if translation is not found.

### `exitWithErrorMessage()` <a name="exitWithErrorMessage"></a>

Display the message in a nice red font with a nice icon ...

#### Description

and dies

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$message`
- It does not return anything.

### `getCurrentUserEmail()` <a name="getCurrentUserEmail"></a>

Get current user email address

#### Signature

- It is a **public static** method.
- It returns a(n) `string` value.

### `getSuperUserLogin()` <a name="getSuperUserLogin"></a>

Returns Super User login

#### Signature

- It is a **public static** method.
- It returns a(n) `string` value.

### `getSuperUserEmail()` <a name="getSuperUserEmail"></a>

Returns Super User email

#### Signature

- It is a **public static** method.
- It returns a(n) `string` value.

### `getCurrentUserLogin()` <a name="getCurrentUserLogin"></a>

Get current user login

#### Signature

- It is a **public static** method.
- _Returns:_ login ID
    - `string`

### `getCurrentUserTokenAuth()` <a name="getCurrentUserTokenAuth"></a>

Get current user&#039;s token auth

#### Signature

- It is a **public static** method.
- _Returns:_ Token auth
    - `string`

### `isUserIsSuperUserOrTheUser()` <a name="isUserIsSuperUserOrTheUser"></a>

Returns true if the current user is either the super user, or the user $theUser Used when modifying user preference: this usually requires super user or being the user itself.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$theUser`
- It returns a(n) `bool` value.

### `checkUserIsSuperUserOrTheUser()` <a name="checkUserIsSuperUserOrTheUser"></a>

Check that current user is either the specified user or the superuser

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$theUser`
- It does not return anything.
- It throws one of the following exceptions:
    - `NoAccessException` &mdash; if the user is neither the super user nor the user $theUser

### `isUserIsSuperUser()` <a name="isUserIsSuperUser"></a>

Returns true if the current user is the Super User

#### Signature

- It is a **public static** method.
- It returns a(n) `bool` value.

### `isUserIsAnonymous()` <a name="isUserIsAnonymous"></a>

Is user the anonymous user?

#### Signature

- It is a **public static** method.
- _Returns:_ True if anonymouse; false otherwise
    - `bool`

### `checkUserIsNotAnonymous()` <a name="checkUserIsNotAnonymous"></a>

Checks if user is not the anonymous user.

#### Signature

- It is a **public static** method.
- It does not return anything.
- It throws one of the following exceptions:
    - `NoAccessException` &mdash; if user is anonymous.

### `setUserIsSuperUser()` <a name="setUserIsSuperUser"></a>

Helper method user to set the current as Super User.

#### Description

This should be used with great care as this gives the user all permissions.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$bool`
- It does not return anything.

### `checkUserIsSuperUser()` <a name="checkUserIsSuperUser"></a>

Check that user is the superuser

#### Signature

- It is a **public static** method.
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if not the superuser

### `isUserHasAdminAccess()` <a name="isUserHasAdminAccess"></a>

Returns true if the user has admin access to the sites

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$idSites`
- It returns a(n) `bool` value.

### `checkUserHasAdminAccess()` <a name="checkUserHasAdminAccess"></a>

Check user has admin access to the sites

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$idSites`
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if user doesn&#039;t have admin access to the sites

### `isUserHasSomeAdminAccess()` <a name="isUserHasSomeAdminAccess"></a>

Returns true if the user has admin access to any sites

#### Signature

- It is a **public static** method.
- It returns a(n) `bool` value.

### `checkUserHasSomeAdminAccess()` <a name="checkUserHasSomeAdminAccess"></a>

Check user has admin access to any sites

#### Signature

- It is a **public static** method.
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if user doesn&#039;t have admin access to any sites

### `isUserHasViewAccess()` <a name="isUserHasViewAccess"></a>

Returns true if the user has view access to the sites

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$idSites`
- It returns a(n) `bool` value.

### `checkUserHasViewAccess()` <a name="checkUserHasViewAccess"></a>

Check user has view access to the sites

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$idSites`
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if user doesn&#039;t have view access to sites

### `isUserHasSomeViewAccess()` <a name="isUserHasSomeViewAccess"></a>

Returns true if the user has view access to any sites

#### Signature

- It is a **public static** method.
- It returns a(n) `bool` value.

### `checkUserHasSomeViewAccess()` <a name="checkUserHasSomeViewAccess"></a>

Check user has view access to any sites

#### Signature

- It is a **public static** method.
- It does not return anything.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; if user doesn&#039;t have view access to any sites

### `getModule()` <a name="getModule"></a>

Returns the current module read from the URL (eg.

#### Description

&#039;API&#039;, &#039;UserSettings&#039;, etc.)

#### Signature

- It is a **public static** method.
- It returns a(n) `string` value.

### `getAction()` <a name="getAction"></a>

Returns the current action read from the URL

#### Signature

- It is a **public static** method.
- It returns a(n) `string` value.

### `redirectToModule()` <a name="redirectToModule"></a>

Redirect to module (and action)

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$newModule`
    - `$newAction`
    - `$parameters`
- _Returns:_ false if the URL to redirect to is already this URL
    - `bool`

### `isValidEmailString()` <a name="isValidEmailString"></a>

Returns true if the email is a valid email

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$email`
- It returns a(n) `bool` value.

### `postEvent()` <a name="postEvent"></a>

Post an event to the dispatcher which will notice the observers.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$eventName`
    - `$params`
    - `$pending`
    - `$plugins`
- It returns a(n) `void` value.

### `addAction()` <a name="addAction"></a>

Register an action to execute for a given event

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$eventName`
    - `$function`
- It does not return anything.

### `translate()` <a name="translate"></a>

Returns translated string or given message if translation is not found.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$string`
    - `$args`
- It returns a(n) `string` value.

### `translateException()` <a name="translateException"></a>

Returns translated string or given message if translation is not found.

#### Description

This function does not throw any exception. Use it to translate exceptions.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$message`
    - `$args`
- It returns a(n) `string` value.

