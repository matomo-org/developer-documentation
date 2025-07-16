<small>Piwik\Auth\</small>

PasswordStrength
================

Main class to handle actions related to password strength rules and verification of those rules.

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct)
- [`getRules()`](#getrules) &mdash; Provides the rules for defining a strong password.
- [`validatePasswordStrength()`](#validatepasswordstrength) &mdash; Determines which rules a password candidate breaks with regards to password strength.
- [`formatValidationFailedMessage()`](#formatvalidationfailedmessage)
- [`getRulesAsHtmlList()`](#getrulesashtmllist)

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

#### Signature

-  It accepts the following parameter(s):
    - `$featureEnabled` (`bool`) &mdash;
      

<a name="getrules" id="getrules"></a>
<a name="getRules" id="getRules"></a>
### `getRules()`

Provides the rules for defining a strong password. Rules are
broken up into a regular expression which is applied to a password candidate,
and a string which describes what the rule is testing for.

#### Signature


- *Returns:*  `array` &mdash;
    of rules to test password candidates against.

<a name="validatepasswordstrength" id="validatepasswordstrength"></a>
<a name="validatePasswordStrength" id="validatePasswordStrength"></a>
### `validatePasswordStrength()`

Determines which rules a password candidate breaks with regards to
password strength.

#### Signature

-  It accepts the following parameter(s):
    - `$candidate` (`string`) &mdash;
       The password candidate to be tested.

- *Returns:*  `array` &mdash;
    of rules which the password breaks.

<a name="formatvalidationfailedmessage" id="formatvalidationfailedmessage"></a>
<a name="formatValidationFailedMessage" id="formatValidationFailedMessage"></a>
### `formatValidationFailedMessage()`

#### Signature

-  It accepts the following parameter(s):
    - `$brokenRules` (`array`) &mdash;
      
- It returns a `string` value.

<a name="getrulesashtmllist" id="getrulesashtmllist"></a>
<a name="getRulesAsHtmlList" id="getRulesAsHtmlList"></a>
### `getRulesAsHtmlList()`

#### Signature

- It returns a `string` value.

