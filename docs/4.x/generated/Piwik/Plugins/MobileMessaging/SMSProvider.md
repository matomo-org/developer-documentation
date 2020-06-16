<small>Piwik\Plugins\MobileMessaging\</small>

SMSProvider
===========

The SMSProvider abstract class is used as a base class for SMS provider implementations.

To create your own custom
SMSProvider extend this class and implement the methods to send text messages. The class needs to be placed in a
`SMSProvider` directory of your plugin.

Methods
-------

The abstract class defines the following methods:

- [`getId()`](#getid) &mdash; Get the ID of the SMS Provider.
- [`getDescription()`](#getdescription) &mdash; Get a description about the SMS Provider.
- [`verifyCredential()`](#verifycredential) &mdash; Verify the SMS API credential.
- [`getCreditLeft()`](#getcreditleft) &mdash; Get the amount of remaining credits.
- [`sendSMS()`](#sendsms) &mdash; Actually send the given text message.
- [`getCredentialFields()`](#getcredentialfields) &mdash; Defines the fields that needs to be filled up to provide credentials
- [`isAvailable()`](#isavailable) &mdash; Defines whether the SMS Provider is available.

<a name="getid" id="getid"></a>
<a name="getId" id="getId"></a>
### `getId()`

Get the ID of the SMS Provider.

Eg 'Clockwork' or 'FreeMobile'

#### Signature

- It returns a `string` value.

<a name="getdescription" id="getdescription"></a>
<a name="getDescription" id="getDescription"></a>
### `getDescription()`

Get a description about the SMS Provider.

For example who the SMS Provider is, instructions how the API Key
needs to be set, and more. You may return HTML here for better formatting.

#### Signature

- It returns a `string` value.

<a name="verifycredential" id="verifycredential"></a>
<a name="verifyCredential" id="verifyCredential"></a>
### `verifyCredential()`

Verify the SMS API credential.

#### Signature

-  It accepts the following parameter(s):
    - `$credentials` (`array`) &mdash;
       contains credentials (eg. like API key, user name, ...)

- *Returns:*  `bool` &mdash;
    true if credentials are valid, false otherwise

<a name="getcreditleft" id="getcreditleft"></a>
<a name="getCreditLeft" id="getCreditLeft"></a>
### `getCreditLeft()`

Get the amount of remaining credits.

#### Signature

-  It accepts the following parameter(s):
    - `$credentials` (`array`) &mdash;
       contains credentials (eg. like API key, user name, ...)

- *Returns:*  `string` &mdash;
    remaining credits

<a name="sendsms" id="sendsms"></a>
<a name="sendSMS" id="sendSMS"></a>
### `sendSMS()`

Actually send the given text message.

This method should only send the text message, it should not trigger
any notifications etc.

#### Signature

-  It accepts the following parameter(s):
    - `$credentials` (`array`) &mdash;
       contains credentials (eg. like API key, user name, ...)
    - `$smsText` (`string`) &mdash;
      
    - `$phoneNumber` (`string`) &mdash;
      
    - `$from` (`string`) &mdash;
      

- *Returns:*  `bool` &mdash;
    true

<a name="getcredentialfields" id="getcredentialfields"></a>
<a name="getCredentialFields" id="getCredentialFields"></a>
### `getCredentialFields()`

Defines the fields that needs to be filled up to provide credentials

Example:
array (
  array(
    'type' => 'text',
    'name' => 'apiKey',
    'title' => 'Translation_Key_To_Use'
  )
)

#### Signature

- It returns a `array` value.

<a name="isavailable" id="isavailable"></a>
<a name="isAvailable" id="isAvailable"></a>
### `isAvailable()`

Defines whether the SMS Provider is available.

If a certain provider should be used only be a limited
range of users you can restrict the provider here. For example there is a Development SMS Provider that is only
available when the development is actually enabled. You could also create a SMS Provider that is only available
to Super Users etc. Usually this method does not have to be implemented by a SMS Provider.

#### Signature

- It returns a `bool` value.

