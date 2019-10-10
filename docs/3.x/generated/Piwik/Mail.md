<small>Piwik\</small>

Mail
====

Class for sending mails, for more information see: [http://framework.zend.com/manual/en/zend.mail.html](http://framework.zend.com/manual/en/zend.mail.html)

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`setDefaultFromPiwik()`](#setdefaultfrompiwik)
- [`setWrappedHtmlBody()`](#setwrappedhtmlbody)
- [`setFrom()`](#setfrom) &mdash; Sets the sender.
- [`setReplyTo()`](#setreplyto) &mdash; Set Reply-To Header
- [`send()`](#send)
- [`createAttachment()`](#createattachment)
- [`setSubject()`](#setsubject)
- [`getMailHost()`](#getmailhost)
- [`sanitiseString()`](#sanitisestring) &mdash; Replaces characters known to appear incorrectly in some email clients

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

-  It accepts the following parameter(s):
    - `$charset` (`string`) &mdash;
       charset, defaults to utf-8

<a name="setdefaultfrompiwik" id="setdefaultfrompiwik"></a>
<a name="setDefaultFromPiwik" id="setDefaultFromPiwik"></a>
### `setDefaultFromPiwik()`

#### Signature

- It does not return anything.

<a name="setwrappedhtmlbody" id="setwrappedhtmlbody"></a>
<a name="setWrappedHtmlBody" id="setWrappedHtmlBody"></a>
### `setWrappedHtmlBody()`

#### Signature

-  It accepts the following parameter(s):
    - `$body` ([`View`](../Piwik/View.md)|`string`) &mdash;
      
- It does not return anything.
- It throws one of the following exceptions:
    - `DI\NotFoundException`

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
- It returns a `Zend_Mail` value.

<a name="setreplyto" id="setreplyto"></a>
<a name="setReplyTo" id="setReplyTo"></a>
### `setReplyTo()`

Set Reply-To Header

#### Signature

-  It accepts the following parameter(s):
    - `$email` (`string`) &mdash;
      
    - `$name` (`null`|`string`) &mdash;
      
- It returns a `Zend_Mail` value.

<a name="send" id="send"></a>
<a name="send" id="send"></a>
### `send()`

#### Signature

-  It accepts the following parameter(s):
    - `$transport`
      
- It does not return anything.

<a name="createattachment" id="createattachment"></a>
<a name="createAttachment" id="createAttachment"></a>
### `createAttachment()`

#### Signature

-  It accepts the following parameter(s):
    - `$body`
      
    - `$mimeType`
      
    - `$disposition`
      
    - `$encoding`
      
    - `$filename`
      
- It does not return anything.

<a name="setsubject" id="setsubject"></a>
<a name="setSubject" id="setSubject"></a>
### `setSubject()`

#### Signature

-  It accepts the following parameter(s):
    - `$subject`
      
- It does not return anything.

<a name="getmailhost" id="getmailhost"></a>
<a name="getMailHost" id="getMailHost"></a>
### `getMailHost()`

#### Signature

- It does not return anything.

<a name="sanitisestring" id="sanitisestring"></a>
<a name="sanitiseString" id="sanitiseString"></a>
### `sanitiseString()`

Replaces characters known to appear incorrectly in some email clients

#### Signature

-  It accepts the following parameter(s):
    - `$string` (`Piwik\$string`) &mdash;
      
- It returns a `mixed` value.

