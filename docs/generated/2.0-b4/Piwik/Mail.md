<small>Piwik</small>

Mail
====

Class for sending mails, for more information see: [http://framework.zend.com/manual/en/zend.mail.html](#http://framework.zend.com/manual/en/zend.mail.html)

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct) &mdash; Constructor.
- [`setFrom()`](#setfrom) &mdash; Sets the sender.

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

- It accepts the following parameter(s):
    - `$charset` (`string`) &mdash; charset, defaults to utf-8

<a name="setfrom" id="setfrom"></a>
<a name="setFrom" id="setFrom"></a>
### `setFrom()`

Sets the sender.

#### Signature

- It accepts the following parameter(s):
    - `$email` (`string`) &mdash; Email address of the sender.
    - `$name` (`null`|`string`) &mdash; Name of the sender.
- It returns a `Zend_Mail` value.

