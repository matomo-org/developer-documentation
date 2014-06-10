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
- [`send()`](#send)

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

Constructor.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$charset` (`string`) &mdash;

      <div markdown="1" class="param-desc"> charset, defaults to utf-8</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

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

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$email` (`string`) &mdash;

      <div markdown="1" class="param-desc"> Email address of the sender.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$name` (`null`|`string`) &mdash;

      <div markdown="1" class="param-desc"> Name of the sender.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It returns a `Zend_Mail` value.

<a name="send" id="send"></a>
<a name="send" id="send"></a>
### `send()`

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$transport`

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It does not return anything.

