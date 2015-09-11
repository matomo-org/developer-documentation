<small>Piwik\</small>

Mail
====

Class for sending mails, for more information see: [http://framework.zend.com/manual/en/zend.mail.html](http://framework.zend.com/manual/en/zend.mail.html)

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`setDefaultFromPiwik()`](#setdefaultfrompiwik)
- [`setFrom()`](#setfrom) &mdash; Sets the sender.
- [`setReplyTo()`](#setreplyto) &mdash; Set Reply-To Header
- [`send()`](#send)

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

