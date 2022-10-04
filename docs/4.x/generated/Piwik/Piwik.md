<small>Piwik\</small>

Piwik
=====

Main piwik helper class.

Contains helper methods for a variety of common tasks. Plugin developers are
encouraged to reuse these methods as much as possible.

Methods
-------

The class defines the following methods:

- [`getCurrentUserEmail()`](#getcurrentuseremail) &mdash; Returns the current user's email address.
- [`getCurrentUserLastSeen()`](#getcurrentuserlastseen) &mdash; Returns the current user's Last Seen.
- [`getCurrentUserLogin()`](#getcurrentuserlogin) &mdash; Returns the current user's username.
- [`getCurrentUserTokenAuth()`](#getcurrentusertokenauth) &mdash; Returns the current user's token auth.
- [`hasUserSuperUserAccessOrIsTheUser()`](#hasusersuperuseraccessoristheuser) &mdash; Returns `true` if the current user is either the Super User or the user specified by `$theUser`.
- [`checkUserHasSuperUserAccessOrIsTheUser()`](#checkuserhassuperuseraccessoristheuser) &mdash; Check that the current user is either the specified user or the superuser.
- [`hasTheUserSuperUserAccess()`](#hastheusersuperuseraccess) &mdash; Check whether the given user has superuser access.
- [`hasUserSuperUserAccess()`](#hasusersuperuseraccess) &mdash; Returns true if the current user has Super User access.
- [`isUserIsAnonymous()`](#isuserisanonymous) &mdash; Returns true if the current user is the special **anonymous** user or not.
- [`checkUserIsNotAnonymous()`](#checkuserisnotanonymous) &mdash; Checks that the user is not the anonymous user.
- [`checkUserHasSuperUserAccess()`](#checkuserhassuperuseraccess) &mdash; Check that the current user has superuser access.
- [`isUserHasAdminAccess()`](#isuserhasadminaccess) &mdash; Returns `true` if the user has admin access to the requested sites, `false` if otherwise.
- [`checkUserHasAdminAccess()`](#checkuserhasadminaccess) &mdash; Checks that the current user has admin access to the requested list of sites.
- [`isUserHasSomeAdminAccess()`](#isuserhassomeadminaccess) &mdash; Returns `true` if the current user has admin access to at least one site.
- [`checkUserHasSomeWriteAccess()`](#checkuserhassomewriteaccess) &mdash; Checks that the current user has write access to at least one site.
- [`isUserHasSomeWriteAccess()`](#isuserhassomewriteaccess) &mdash; Returns `true` if the current user has write access to at least one site.
- [`isUserHasCapability()`](#isuserhascapability) &mdash; Returns `true` if the current user has the given capability for the given sites.
- [`checkUserHasSomeAdminAccess()`](#checkuserhassomeadminaccess) &mdash; Checks that the current user has admin access to at least one site.
- [`isUserHasViewAccess()`](#isuserhasviewaccess) &mdash; Returns `true` if the user has view access to the requested list of sites.
- [`isUserHasWriteAccess()`](#isuserhaswriteaccess) &mdash; Returns `true` if the user has write access to the requested list of sites.
- [`checkUserHasViewAccess()`](#checkuserhasviewaccess) &mdash; Checks that the current user has view access to the requested list of sites
- [`checkUserHasWriteAccess()`](#checkuserhaswriteaccess) &mdash; Checks that the current user has write access to the requested list of sites
- [`isUserHasSomeViewAccess()`](#isuserhassomeviewaccess) &mdash; Returns `true` if the current user has view access to at least one site.
- [`checkUserHasSomeViewAccess()`](#checkuserhassomeviewaccess) &mdash; Checks that the current user has view access to at least one site.
- [`getLoginPluginName()`](#getloginpluginname) &mdash; Returns the name of the Login plugin currently being used.
- [`redirectToModule()`](#redirecttomodule) &mdash; Redirects the current request to a new module and action.
- [`isValidEmailString()`](#isvalidemailstring) &mdash; Returns `true` if supplied the email address is a valid.
- [`postEvent()`](#postevent) &mdash; Post an event to Piwik's event dispatcher which will execute the event's observers.
- [`addAction()`](#addaction) &mdash; Register an observer to an event.
- [`translate()`](#translate) &mdash; Returns an internationalized string using a translation token.
- [`getPeriod()`](#getperiod) &mdash; Returns the period provided in the current request.
- [`getDate()`](#getdate) &mdash; Returns the date provided in the current request.

<a name="getcurrentuseremail" id="getcurrentuseremail"></a>
<a name="getCurrentUserEmail" id="getCurrentUserEmail"></a>
### `getCurrentUserEmail()`

Returns the current user's email address.

#### Signature

- It returns a `string` value.

<a name="getcurrentuserlastseen" id="getcurrentuserlastseen"></a>
<a name="getCurrentUserLastSeen" id="getCurrentUserLastSeen"></a>
### `getCurrentUserLastSeen()`

Returns the current user's Last Seen.

#### Signature

- It returns a `string` value.

<a name="getcurrentuserlogin" id="getcurrentuserlogin"></a>
<a name="getCurrentUserLogin" id="getCurrentUserLogin"></a>
### `getCurrentUserLogin()`

Returns the current user's username.

#### Signature

- It returns a `string` value.

<a name="getcurrentusertokenauth" id="getcurrentusertokenauth"></a>
<a name="getCurrentUserTokenAuth" id="getCurrentUserTokenAuth"></a>
### `getCurrentUserTokenAuth()`

Returns the current user's token auth.

#### Signature

- It returns a `string` value.

<a name="hasusersuperuseraccessoristheuser" id="hasusersuperuseraccessoristheuser"></a>
<a name="hasUserSuperUserAccessOrIsTheUser" id="hasUserSuperUserAccessOrIsTheUser"></a>
### `hasUserSuperUserAccessOrIsTheUser()`

Returns `true` if the current user is either the Super User or the user specified by
`$theUser`.

#### Signature

-  It accepts the following parameter(s):
    - `$theUser` (`string`) &mdash;
       A username.
- It returns a `bool` value.

<a name="checkuserhassuperuseraccessoristheuser" id="checkuserhassuperuseraccessoristheuser"></a>
<a name="checkUserHasSuperUserAccessOrIsTheUser" id="checkUserHasSuperUserAccessOrIsTheUser"></a>
### `checkUserHasSuperUserAccessOrIsTheUser()`

Check that the current user is either the specified user or the superuser.

#### Signature

-  It accepts the following parameter(s):
    - `$theUser` (`string`) &mdash;
       A username.
- It does not return anything or a mixed result.
- It throws one of the following exceptions:
    - [`Piwik\NoAccessException`](../Piwik/NoAccessException.md) &mdash; If the user is neither the Super User nor the user `$theUser`.

<a name="hastheusersuperuseraccess" id="hastheusersuperuseraccess"></a>
<a name="hasTheUserSuperUserAccess" id="hasTheUserSuperUserAccess"></a>
### `hasTheUserSuperUserAccess()`

Check whether the given user has superuser access.

#### Signature

-  It accepts the following parameter(s):
    - `$theUser` (`string`) &mdash;
       A username.
- It returns a `bool` value.

<a name="hasusersuperuseraccess" id="hasusersuperuseraccess"></a>
<a name="hasUserSuperUserAccess" id="hasUserSuperUserAccess"></a>
### `hasUserSuperUserAccess()`

Returns true if the current user has Super User access.

#### Signature

- It returns a `bool` value.

<a name="isuserisanonymous" id="isuserisanonymous"></a>
<a name="isUserIsAnonymous" id="isUserIsAnonymous"></a>
### `isUserIsAnonymous()`

Returns true if the current user is the special **anonymous** user or not.

#### Signature

- It returns a `bool` value.

<a name="checkuserisnotanonymous" id="checkuserisnotanonymous"></a>
<a name="checkUserIsNotAnonymous" id="checkUserIsNotAnonymous"></a>
### `checkUserIsNotAnonymous()`

Checks that the user is not the anonymous user.

#### Signature

- It does not return anything or a mixed result.
- It throws one of the following exceptions:
    - [`Piwik\NoAccessException`](../Piwik/NoAccessException.md) &mdash; if the current user is the anonymous user.

<a name="checkuserhassuperuseraccess" id="checkuserhassuperuseraccess"></a>
<a name="checkUserHasSuperUserAccess" id="checkUserHasSuperUserAccess"></a>
### `checkUserHasSuperUserAccess()`

Check that the current user has superuser access.

#### Signature

- It does not return anything or a mixed result.
- It throws one of the following exceptions:
    - `Piwik\Exception` &mdash; if the current user is not the superuser.

<a name="isuserhasadminaccess" id="isuserhasadminaccess"></a>
<a name="isUserHasAdminAccess" id="isUserHasAdminAccess"></a>
### `isUserHasAdminAccess()`

Returns `true` if the user has admin access to the requested sites, `false` if otherwise.

#### Signature

-  It accepts the following parameter(s):
    - `$idSites` (`int`|`array`) &mdash;
       The list of site IDs to check access for.
- It returns a `bool` value.

<a name="checkuserhasadminaccess" id="checkuserhasadminaccess"></a>
<a name="checkUserHasAdminAccess" id="checkUserHasAdminAccess"></a>
### `checkUserHasAdminAccess()`

Checks that the current user has admin access to the requested list of sites.

#### Signature

-  It accepts the following parameter(s):
    - `$idSites` (`int`|`array`) &mdash;
       One or more site IDs to check access for.
- It does not return anything or a mixed result.
- It throws one of the following exceptions:
    - `Piwik\Exception` &mdash; If user doesn&#039;t have admin access.

<a name="isuserhassomeadminaccess" id="isuserhassomeadminaccess"></a>
<a name="isUserHasSomeAdminAccess" id="isUserHasSomeAdminAccess"></a>
### `isUserHasSomeAdminAccess()`

Returns `true` if the current user has admin access to at least one site.

#### Signature

- It returns a `bool` value.

<a name="checkuserhassomewriteaccess" id="checkuserhassomewriteaccess"></a>
<a name="checkUserHasSomeWriteAccess" id="checkUserHasSomeWriteAccess"></a>
### `checkUserHasSomeWriteAccess()`

Checks that the current user has write access to at least one site.

#### Signature

- It does not return anything or a mixed result.
- It throws one of the following exceptions:
    - `Piwik\Exception` &mdash; if user doesn&#039;t have write access to any site.

<a name="isuserhassomewriteaccess" id="isuserhassomewriteaccess"></a>
<a name="isUserHasSomeWriteAccess" id="isUserHasSomeWriteAccess"></a>
### `isUserHasSomeWriteAccess()`

Returns `true` if the current user has write access to at least one site.

#### Signature

- It returns a `bool` value.

<a name="isuserhascapability" id="isuserhascapability"></a>
<a name="isUserHasCapability" id="isUserHasCapability"></a>
### `isUserHasCapability()`

Returns `true` if the current user has the given capability for the given sites.

#### Signature

-  It accepts the following parameter(s):
    - `$idSites`
      
    - `$capability`
      
- It returns a `bool` value.

<a name="checkuserhassomeadminaccess" id="checkuserhassomeadminaccess"></a>
<a name="checkUserHasSomeAdminAccess" id="checkUserHasSomeAdminAccess"></a>
### `checkUserHasSomeAdminAccess()`

Checks that the current user has admin access to at least one site.

#### Signature

- It does not return anything or a mixed result.
- It throws one of the following exceptions:
    - `Piwik\Exception` &mdash; if user doesn&#039;t have admin access to any site.

<a name="isuserhasviewaccess" id="isuserhasviewaccess"></a>
<a name="isUserHasViewAccess" id="isUserHasViewAccess"></a>
### `isUserHasViewAccess()`

Returns `true` if the user has view access to the requested list of sites.

#### Signature

-  It accepts the following parameter(s):
    - `$idSites` (`int`|`array`) &mdash;
       One or more site IDs to check access for.
- It returns a `bool` value.

<a name="isuserhaswriteaccess" id="isuserhaswriteaccess"></a>
<a name="isUserHasWriteAccess" id="isUserHasWriteAccess"></a>
### `isUserHasWriteAccess()`

Returns `true` if the user has write access to the requested list of sites.

#### Signature

-  It accepts the following parameter(s):
    - `$idSites` (`int`|`array`) &mdash;
       One or more site IDs to check access for.
- It returns a `bool` value.

<a name="checkuserhasviewaccess" id="checkuserhasviewaccess"></a>
<a name="checkUserHasViewAccess" id="checkUserHasViewAccess"></a>
### `checkUserHasViewAccess()`

Checks that the current user has view access to the requested list of sites

#### Signature

-  It accepts the following parameter(s):
    - `$idSites` (`int`|`array`) &mdash;
       The list of site IDs to check access for.
- It does not return anything or a mixed result.
- It throws one of the following exceptions:
    - `Piwik\Exception` &mdash; if the current user does not have view access to every site in the list.

<a name="checkuserhaswriteaccess" id="checkuserhaswriteaccess"></a>
<a name="checkUserHasWriteAccess" id="checkUserHasWriteAccess"></a>
### `checkUserHasWriteAccess()`

Checks that the current user has write access to the requested list of sites

#### Signature

-  It accepts the following parameter(s):
    - `$idSites` (`int`|`array`) &mdash;
       The list of site IDs to check access for.
- It does not return anything or a mixed result.
- It throws one of the following exceptions:
    - `Piwik\Exception` &mdash; if the current user does not have write access to every site in the list.

<a name="isuserhassomeviewaccess" id="isuserhassomeviewaccess"></a>
<a name="isUserHasSomeViewAccess" id="isUserHasSomeViewAccess"></a>
### `isUserHasSomeViewAccess()`

Returns `true` if the current user has view access to at least one site.

#### Signature

- It returns a `bool` value.

<a name="checkuserhassomeviewaccess" id="checkuserhassomeviewaccess"></a>
<a name="checkUserHasSomeViewAccess" id="checkUserHasSomeViewAccess"></a>
### `checkUserHasSomeViewAccess()`

Checks that the current user has view access to at least one site.

#### Signature

- It does not return anything or a mixed result.
- It throws one of the following exceptions:
    - `Piwik\Exception` &mdash; if user doesn&#039;t have view access to any site.

<a name="getloginpluginname" id="getloginpluginname"></a>
<a name="getLoginPluginName" id="getLoginPluginName"></a>
### `getLoginPluginName()`

Returns the name of the Login plugin currently being used.

Must be used since it is not allowed to hardcode 'Login' in URLs
in case another Login plugin is being used.

#### Signature

- It returns a `string` value.

<a name="redirecttomodule" id="redirecttomodule"></a>
<a name="redirectToModule" id="redirectToModule"></a>
### `redirectToModule()`

Redirects the current request to a new module and action.

#### Signature

-  It accepts the following parameter(s):
    - `$newModule` (`string`) &mdash;
       The target module, eg, `'UserCountry'`.
    - `$newAction` (`string`) &mdash;
       The target controller action, eg, `'index'`.
    - `$parameters` (`array`) &mdash;
       The query parameter values to modify before redirecting.
- It does not return anything or a mixed result.

<a name="isvalidemailstring" id="isvalidemailstring"></a>
<a name="isValidEmailString" id="isValidEmailString"></a>
### `isValidEmailString()`

Returns `true` if supplied the email address is a valid.

#### Signature

-  It accepts the following parameter(s):
    - `$emailAddress` (`string`) &mdash;
      
- It returns a `bool` value.

<a name="postevent" id="postevent"></a>
<a name="postEvent" id="postEvent"></a>
### `postEvent()`

Post an event to Piwik's event dispatcher which will execute the event's observers.

#### Signature

-  It accepts the following parameter(s):
    - `$eventName` (`string`) &mdash;
       The event name.
    - `$params` (`array`) &mdash;
       The parameter array to forward to observer callbacks.
    - `$pending` (`bool`) &mdash;
       If true, plugins that are loaded after this event is fired will have their observers for this event executed.
    - `$plugins` (`array`|`null`) &mdash;
       The list of plugins to execute observers for. If null, all plugin observers will be executed.
- It does not return anything or a mixed result.

<a name="addaction" id="addaction"></a>
<a name="addAction" id="addAction"></a>
### `addAction()`

Register an observer to an event.

**_Note: Observers should normally be defined in plugin objects. It is unlikely that you will
need to use this function._**

#### Signature

-  It accepts the following parameter(s):
    - `$eventName` (`string`) &mdash;
       The event name.
    - `$function` (`callable`|`array`) &mdash;
       The observer.
- It does not return anything or a mixed result.

<a name="translate" id="translate"></a>
<a name="translate" id="translate"></a>
### `translate()`

Returns an internationalized string using a translation token. If a translation
cannot be found for the token, the token is returned.

#### Signature

-  It accepts the following parameter(s):
    - `$translationId` (`string`) &mdash;
       Translation ID, eg, `'General_Date'`.
    - `$args` (`array`|`string`|`int`) &mdash;
       `sprintf` arguments to be applied to the internationalized string.
    - `$language` (`string`|`null`) &mdash;
       Optionally force the language.

- *Returns:*  `string` &mdash;
    The translated string or `$translationId`.

<a name="getperiod" id="getperiod"></a>
<a name="getPeriod" id="getPeriod"></a>
### `getPeriod()`

Returns the period provided in the current request.

If no $default is provided, this method will throw an Exception if `period` can't be found in the request

#### Signature

-  It accepts the following parameter(s):
    - `$default` (`string`|`null`) &mdash;
       default value to use
- It returns a `string` value.
- It throws one of the following exceptions:
    - `Piwik\Exception`

<a name="getdate" id="getdate"></a>
<a name="getDate" id="getDate"></a>
### `getDate()`

Returns the date provided in the current request.

If no $default is provided, this method will throw an Exception if `date` can't be found in the request

#### Signature

-  It accepts the following parameter(s):
    - `$default` (`string`|`null`) &mdash;
       default value to use
- It returns a `string` value.
- It throws one of the following exceptions:
    - `Piwik\Exception`

