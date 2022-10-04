<small>Piwik\</small>

Mail
====

Class for sending mails

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct)
- [`setFrom()`](#setfrom) &mdash; Sets the sender.
- [`setDefaultFromPiwik()`](#setdefaultfrompiwik) &mdash; Sets the default sender
- [`getFrom()`](#getfrom) &mdash; Returns the address the mail will be sent from
- [`getFromName()`](#getfromname) &mdash; Returns the address the mail will be sent from
- [`setWrappedHtmlBody()`](#setwrappedhtmlbody)
- [`setBodyHtml()`](#setbodyhtml) &mdash; Sets the HTML part of the mail
- [`setBodyText()`](#setbodytext) &mdash; Sets the text part of the mail.
- [`getBodyHtml()`](#getbodyhtml) &mdash; Returns html content of the mail
- [`getBodyText()`](#getbodytext) &mdash; Returns text content of the mail
- [`setSubject()`](#setsubject) &mdash; Sets the subject of the mail
- [`getSubject()`](#getsubject) &mdash; Return the subject of the mail
- [`addTo()`](#addto) &mdash; Adds a recipient
- [`getRecipients()`](#getrecipients) &mdash; Returns the list of recipients
- [`addBcc()`](#addbcc) &mdash; Add Bcc address
- [`getBccs()`](#getbccs) &mdash; Returns the list of bcc addresses
- [`clearAllRecipients()`](#clearallrecipients) &mdash; Removes all recipients and bccs from the list
- [`addReplyTo()`](#addreplyto) &mdash; Add Reply-To address
- [`setReplyTo()`](#setreplyto) &mdash; Sets the reply to address (all previously added addresses will be removed)
- [`getReplyTos()`](#getreplytos) &mdash; Returns the list of reply to addresses
- [`addAttachment()`](#addattachment)
- [`getAttachments()`](#getattachments)
- [`send()`](#send) &mdash; Sends the mail
- [`safeSend()`](#safesend) &mdash; If the send email process throws an exception, we catch it and log it
- [`setSmtpDebug()`](#setsmtpdebug) &mdash; Enables SMTP debugging
- [`isSmtpDebugEnabled()`](#issmtpdebugenabled) &mdash; Returns whether SMTP debugging is enabled or not
- [`getMailHost()`](#getmailhost) &mdash; Returns the hostname mails will be sent from
- [`sanitiseString()`](#sanitisestring) &mdash; Replaces characters known to appear incorrectly in some email clients

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

#### Signature


<a name="setfrom" id="setfrom"></a>
<a name="setFrom" id="setFrom"></a>
### `setFrom()`

Sets the sender.

#### Signature

-  It accepts the following parameter(s):
    - `$email` (`string`) &mdash;
       Email address of the sender.
    - `$name` (`null`|`string`) &mdash;
       Name of the sender.
- It does not return anything or a mixed result.

<a name="setdefaultfrompiwik" id="setdefaultfrompiwik"></a>
<a name="setDefaultFromPiwik" id="setDefaultFromPiwik"></a>
### `setDefaultFromPiwik()`

Sets the default sender

#### Signature

- It does not return anything or a mixed result.
- It throws one of the following exceptions:
    - `DI\NotFoundException`

<a name="getfrom" id="getfrom"></a>
<a name="getFrom" id="getFrom"></a>
### `getFrom()`

Returns the address the mail will be sent from

#### Signature

- It returns a `string` value.

<a name="getfromname" id="getfromname"></a>
<a name="getFromName" id="getFromName"></a>
### `getFromName()`

Returns the address the mail will be sent from

#### Signature

- It returns a `string` value.

<a name="setwrappedhtmlbody" id="setwrappedhtmlbody"></a>
<a name="setWrappedHtmlBody" id="setWrappedHtmlBody"></a>
### `setWrappedHtmlBody()`

#### Signature

-  It accepts the following parameter(s):
    - `$body` ([`View`](../Piwik/View.md)|`string`) &mdash;
      
- It does not return anything or a mixed result.
- It throws one of the following exceptions:
    - `DI\NotFoundException`

<a name="setbodyhtml" id="setbodyhtml"></a>
<a name="setBodyHtml" id="setBodyHtml"></a>
### `setBodyHtml()`

Sets the HTML part of the mail

#### Signature

-  It accepts the following parameter(s):
    - `$html`
      
- It does not return anything or a mixed result.

<a name="setbodytext" id="setbodytext"></a>
<a name="setBodyText" id="setBodyText"></a>
### `setBodyText()`

Sets the text part of the mail.

If bodyHtml is set, this will be used as alternative text part

#### Signature

-  It accepts the following parameter(s):
    - `$txt`
      
- It does not return anything or a mixed result.

<a name="getbodyhtml" id="getbodyhtml"></a>
<a name="getBodyHtml" id="getBodyHtml"></a>
### `getBodyHtml()`

Returns html content of the mail

#### Signature

- It returns a `string` value.

<a name="getbodytext" id="getbodytext"></a>
<a name="getBodyText" id="getBodyText"></a>
### `getBodyText()`

Returns text content of the mail

#### Signature

- It returns a `string` value.

<a name="setsubject" id="setsubject"></a>
<a name="setSubject" id="setSubject"></a>
### `setSubject()`

Sets the subject of the mail

#### Signature

-  It accepts the following parameter(s):
    - `$subject`
      
- It does not return anything or a mixed result.

<a name="getsubject" id="getsubject"></a>
<a name="getSubject" id="getSubject"></a>
### `getSubject()`

Return the subject of the mail

#### Signature

- It returns a `string` value.

<a name="addto" id="addto"></a>
<a name="addTo" id="addTo"></a>
### `addTo()`

Adds a recipient

#### Signature

-  It accepts the following parameter(s):
    - `$address` (`string`) &mdash;
      
    - `$name` (`string`) &mdash;
      
- It does not return anything or a mixed result.

<a name="getrecipients" id="getrecipients"></a>
<a name="getRecipients" id="getRecipients"></a>
### `getRecipients()`

Returns the list of recipients

#### Signature

- It returns a `array` value.

<a name="addbcc" id="addbcc"></a>
<a name="addBcc" id="addBcc"></a>
### `addBcc()`

Add Bcc address

#### Signature

-  It accepts the following parameter(s):
    - `$email` (`string`) &mdash;
      
    - `$name` (`string`) &mdash;
      
- It does not return anything or a mixed result.

<a name="getbccs" id="getbccs"></a>
<a name="getBccs" id="getBccs"></a>
### `getBccs()`

Returns the list of bcc addresses

#### Signature

- It returns a `array` value.

<a name="clearallrecipients" id="clearallrecipients"></a>
<a name="clearAllRecipients" id="clearAllRecipients"></a>
### `clearAllRecipients()`

Removes all recipients and bccs from the list

#### Signature

- It does not return anything or a mixed result.

<a name="addreplyto" id="addreplyto"></a>
<a name="addReplyTo" id="addReplyTo"></a>
### `addReplyTo()`

Add Reply-To address

#### Signature

-  It accepts the following parameter(s):
    - `$email` (`string`) &mdash;
      
    - `$name` (`string`) &mdash;
      
- It does not return anything or a mixed result.

<a name="setreplyto" id="setreplyto"></a>
<a name="setReplyTo" id="setReplyTo"></a>
### `setReplyTo()`

Sets the reply to address (all previously added addresses will be removed)

#### Signature

-  It accepts the following parameter(s):
    - `$email` (`string`) &mdash;
      
    - `$name` (`string`) &mdash;
      
- It does not return anything or a mixed result.

<a name="getreplytos" id="getreplytos"></a>
<a name="getReplyTos" id="getReplyTos"></a>
### `getReplyTos()`

Returns the list of reply to addresses

#### Signature

- It returns a `array` value.

<a name="addattachment" id="addattachment"></a>
<a name="addAttachment" id="addAttachment"></a>
### `addAttachment()`

#### Signature

-  It accepts the following parameter(s):
    - `$body`
      
    - `$mimeType`
      
    - `$filename`
      
    - `$cid`
      
- It does not return anything or a mixed result.

<a name="getattachments" id="getattachments"></a>
<a name="getAttachments" id="getAttachments"></a>
### `getAttachments()`

#### Signature

- It does not return anything or a mixed result.

<a name="send" id="send"></a>
<a name="send" id="send"></a>
### `send()`

Sends the mail

#### Signature


- *Returns:*  `bool`|`null` &mdash;
    returns null if sending the mail was aborted by the Mail.send event
- It throws one of the following exceptions:
    - `DI\NotFoundException`

<a name="safesend" id="safesend"></a>
<a name="safeSend" id="safeSend"></a>
### `safeSend()`

If the send email process throws an exception, we catch it and log it

#### Signature

- It returns a `void` value.
- It throws one of the following exceptions:
    - `Piwik\NotFoundException`
    - `Piwik\DependencyException`

<a name="setsmtpdebug" id="setsmtpdebug"></a>
<a name="setSmtpDebug" id="setSmtpDebug"></a>
### `setSmtpDebug()`

Enables SMTP debugging

#### Signature

-  It accepts the following parameter(s):
    - `$smtpDebug` (`bool`) &mdash;
      
- It does not return anything or a mixed result.

<a name="issmtpdebugenabled" id="issmtpdebugenabled"></a>
<a name="isSmtpDebugEnabled" id="isSmtpDebugEnabled"></a>
### `isSmtpDebugEnabled()`

Returns whether SMTP debugging is enabled or not

#### Signature

- It returns a `bool` value.

<a name="getmailhost" id="getmailhost"></a>
<a name="getMailHost" id="getMailHost"></a>
### `getMailHost()`

Returns the hostname mails will be sent from

#### Signature

- It returns a `string` value.

<a name="sanitisestring" id="sanitisestring"></a>
<a name="sanitiseString" id="sanitiseString"></a>
### `sanitiseString()`

Replaces characters known to appear incorrectly in some email clients

#### Signature

-  It accepts the following parameter(s):
    - `$string`
      
- It returns a `mixed` value.

