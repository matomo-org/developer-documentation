<small>Piwik\Plugins\Login\</small>

SecondFactorVerifier
====================

Requires the current user to confirm a sensitive action with their second factor, e.g.

Unlike a password confirmation done through PasswordVerifier, a second-factor confirmation is not
valid for a period of time: each confirmation is used up by the first request using it, is only valid for the
action it was requested for, and only reaches the browser that entered the code. Users without a second factor
are not asked for one.

Plugins providing a second factor answer the `Login.userRequiresSecondFactorConfirmation` and
`Login.verifySecondFactor` events. Failed codes count towards the brute force detection.

Usage in a controller action, typically after a password confirmation:

    $params = ['module' => 'MyPlugin', 'action' => 'mySensitiveAction'];
    if (!$secondFactorVerifier->requireSecondFactorConfirmed($params)) {
        return;
    }
    // perform the sensitive action

Methods
-------

The class defines the following methods:

- [`isSecondFactorRequired()`](#issecondfactorrequired) &mdash; Returns whether the given user has a second factor that has to be confirmed.
- [`requireSecondFactorConfirmed()`](#requiresecondfactorconfirmed) &mdash; Returns `true` if the current request carries a confirmation of the user's second factor for the given action, or if the user has no second factor.
- [`requestConfirmation()`](#requestconfirmation) &mdash; Records that the current user needs to confirm the given action and returns the id of that request, which the confirmation page needs.
- [`hasConfirmationBeenRequested()`](#hasconfirmationbeenrequested) &mdash; Returns whether the given confirmation request is pending for the current user.
- [`confirmSecondFactor()`](#confirmsecondfactor) &mdash; Verifies the given code for the current user and the given confirmation request.

<a name="issecondfactorrequired" id="issecondfactorrequired"></a>
<a name="isSecondFactorRequired" id="isSecondFactorRequired"></a>
### `isSecondFactorRequired()`

Returns whether the given user has a second factor that has to be confirmed.

#### Signature

-  It accepts the following parameter(s):
    - `$login` (`string`) &mdash;
      
- It returns a `bool` value.

<a name="requiresecondfactorconfirmed" id="requiresecondfactorconfirmed"></a>
<a name="requireSecondFactorConfirmed" id="requireSecondFactorConfirmed"></a>
### `requireSecondFactorConfirmed()`

Returns `true` if the current request carries a confirmation of the user's second factor for the given
action, or if the user has no second factor. The confirmation is used up by this call, so the action has
to perform the sensitive operation right away.

Otherwise, the user is redirected to the confirmation page, which redirects back to the action once
confirmed. Returns `false` if redirects are disabled.

#### Signature

-  It accepts the following parameter(s):
    - `$redirectParams` (`array`) &mdash;
       string|int> $redirectParams The query parameters of the action, including `module` and `action`. Values are URL encoded when redirecting.
- It returns a `bool` value.

<a name="requestconfirmation" id="requestconfirmation"></a>
<a name="requestConfirmation" id="requestConfirmation"></a>
### `requestConfirmation()`

Records that the current user needs to confirm the given action and returns the id of that request,
which the confirmation page needs. Prefer [requireSecondFactorConfirmed()](/api-reference/Piwik/Plugins/Login/SecondFactorVerifier#requiresecondfactorconfirmed).

#### Signature

-  It accepts the following parameter(s):
    - `$redirectParams` (`array`) &mdash;
       string|int> $redirectParams
- It returns a `string` value.

<a name="hasconfirmationbeenrequested" id="hasconfirmationbeenrequested"></a>
<a name="hasConfirmationBeenRequested" id="hasConfirmationBeenRequested"></a>
### `hasConfirmationBeenRequested()`

Returns whether the given confirmation request is pending for the current user.

#### Signature

-  It accepts the following parameter(s):
    - `$requestId` (`string`) &mdash;
      
- It returns a `bool` value.

<a name="confirmsecondfactor" id="confirmsecondfactor"></a>
<a name="confirmSecondFactor" id="confirmSecondFactor"></a>
### `confirmSecondFactor()`

Verifies the given code for the current user and the given confirmation request. If it is valid, returns
the URL of the action to redirect to. That URL carries a one-time token which lets the action proceed once.

Returns `null` if the code is not valid or the request is not pending.

Failed attempts count towards the brute force detection.

#### Signature

-  It accepts the following parameter(s):
    - `$requestId` (`string`) &mdash;
      
    - `$code` (`string`) &mdash;
      

- *Returns:*  `string`|`null` &mdash;
    

