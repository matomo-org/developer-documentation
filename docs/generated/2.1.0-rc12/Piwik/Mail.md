<small>Piwik\</small>

Mail
====

Class for sending mails, for more information see: [http://framework.zend.com/manual/en/zend.mail.html](http://framework.zend.com/manual/en/zend.mail.html)

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

