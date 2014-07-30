<small>Piwik\</small>

IP
==

Contains IP address helper functions (for both IPv4 and IPv6).

As of Piwik 1.3, IP addresses are stored in the DB has VARBINARY(16),
and passed around in network address format which has the advantage of
being in big-endian byte order. This allows for binary-safe string
comparison of addresses (of the same length), even on Intel x86.

As a matter of naming convention, we use `$ip` for the network address format
and `$ipString` for the presentation format (i.e., human-readable form).

We're not using the network address format (in_addr) for socket functions,
so we don't have to worry about incompatibility with Windows UNICODE
and inetPtonW().

Methods
-------

The class defines the following methods:

- [`sanitizeIp()`](#sanitizeip) &mdash; Removes the port and the last portion of a CIDR IP address.
- [`sanitizeIpRange()`](#sanitizeiprange) &mdash; Sanitize human-readable (user-supplied) IP address range.
- [`P2N()`](#p2n) &mdash; Converts an IP address in presentation format to network address format.
- [`N2P()`](#n2p) &mdash; Convert network address format to presentation format.
- [`prettyPrint()`](#prettyprint) &mdash; Alias for [N2P()](/api-reference/Piwik/IP#n2p).
- [`isIPv4()`](#isipv4) &mdash; Returns true if `$ip` is an IPv4, IPv4-compat, or IPv4-mapped address, false if otherwise.
- [`long2ip()`](#long2ip) &mdash; Converts an IP address (in network address format) to presentation format.
- [`isIPv6()`](#isipv6) &mdash; Returns true if $ip is an IPv6 address, false if otherwise.
- [`isMappedIPv4()`](#ismappedipv4) &mdash; Returns true if $ip is a IPv4 mapped address, false if otherwise.
- [`getIPv4FromMappedIPv6()`](#getipv4frommappedipv6) &mdash; Returns an IPv4 address from a 'mapped' IPv6 address.
- [`getIpsForRange()`](#getipsforrange) &mdash; Get low and high IP addresses for a specified range.
- [`isIpInRange()`](#isipinrange) &mdash; Determines if an IP address is in a specified IP address range.
- [`getIpFromHeader()`](#getipfromheader) &mdash; Returns the most accurate IP address availble for the current user, in IPv4 format.
- [`getNonProxyIpFromHeader()`](#getnonproxyipfromheader) &mdash; Returns a non-proxy IP address from header.
- [`getLastIpFromList()`](#getlastipfromlist) &mdash; Returns the last IP address in a comma separated list, subject to an optional exclusion list.
- [`getHostByAddr()`](#gethostbyaddr) &mdash; Retirms the hostname for a given IP address.

<a name="sanitizeip" id="sanitizeip"></a>
<a name="sanitizeIp" id="sanitizeIp"></a>
### `sanitizeIp()`

Removes the port and the last portion of a CIDR IP address.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$ipString` (`string`) &mdash;

      <div markdown="1" class="param-desc"> The IP address to sanitize.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It returns a `string` value.

<a name="sanitizeiprange" id="sanitizeiprange"></a>
<a name="sanitizeIpRange" id="sanitizeIpRange"></a>
### `sanitizeIpRange()`

Sanitize human-readable (user-supplied) IP address range.

Accepts the following formats for $ipRange:
- single IPv4 address, e.g., 127.0.0.1
- single IPv6 address, e.g., ::1/128
- IPv4 block using CIDR notation, e.g., 192.168.0.0/22 represents the IPv4 addresses from 192.168.0.0 to 192.168.3.255
- IPv6 block using CIDR notation, e.g., 2001:DB8::/48 represents the IPv6 addresses from 2001:DB8:0:0:0:0:0:0 to 2001:DB8:0:FFFF:FFFF:FFFF:FFFF:FFFF
- wildcards, e.g., 192.168.0.*

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$ipRangeString` (`string`) &mdash;

      <div markdown="1" class="param-desc"> IP address range</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`string`|`bool`) &mdash;
    <div markdown="1" class="param-desc">IP address range in CIDR notation OR false</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="p2n" id="p2n"></a>
<a name="P2N" id="P2N"></a>
### `P2N()`

Converts an IP address in presentation format to network address format.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$ipString` (`string`) &mdash;

      <div markdown="1" class="param-desc"> IP address, either IPv4 or IPv6, e.g., `"127.0.0.1"`.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`string`) &mdash;
    <div markdown="1" class="param-desc">Binary-safe string, e.g., `"\x7F\x00\x00\x01"`.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="n2p" id="n2p"></a>
<a name="N2P" id="N2P"></a>
### `N2P()`

Convert network address format to presentation format.

See also [prettyPrint()](/api-reference/Piwik/IP#prettyprint).

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$ip` (`string`) &mdash;

      <div markdown="1" class="param-desc"> IP address in network address format.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`string`) &mdash;
    <div markdown="1" class="param-desc">IP address in presentation format.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="prettyprint" id="prettyprint"></a>
<a name="prettyPrint" id="prettyPrint"></a>
### `prettyPrint()`

Alias for [N2P()](/api-reference/Piwik/IP#n2p).

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$ip` (`string`) &mdash;

      <div markdown="1" class="param-desc"> IP address in network address format.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`string`) &mdash;
    <div markdown="1" class="param-desc">IP address in presentation format.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="isipv4" id="isipv4"></a>
<a name="isIPv4" id="isIPv4"></a>
### `isIPv4()`

Returns true if `$ip` is an IPv4, IPv4-compat, or IPv4-mapped address, false if otherwise.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$ip` (`string`) &mdash;

      <div markdown="1" class="param-desc"> IP address in network address format.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`bool`) &mdash;
    <div markdown="1" class="param-desc">True if IPv4, else false.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="long2ip" id="long2ip"></a>
<a name="long2ip" id="long2ip"></a>
### `long2ip()`

Converts an IP address (in network address format) to presentation format.

This is a backward compatibility function for code that only expects
IPv4 addresses (i.e., doesn't support IPv6).

This function does not support the long (or its string representation)
returned by the built-in ip2long() function, from Piwik 1.3 and earlier.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$ip` (`string`) &mdash;

      <div markdown="1" class="param-desc"> IPv4 address in network address format.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`string`) &mdash;
    <div markdown="1" class="param-desc">IP address in presentation format.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="isipv6" id="isipv6"></a>
<a name="isIPv6" id="isIPv6"></a>
### `isIPv6()`

Returns true if $ip is an IPv6 address, false if otherwise.

This function does
a naive check. It assumes that whatever format $ip is in, it is well-formed.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$ip` (`string`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It returns a `bool` value.

<a name="ismappedipv4" id="ismappedipv4"></a>
<a name="isMappedIPv4" id="isMappedIPv4"></a>
### `isMappedIPv4()`

Returns true if $ip is a IPv4 mapped address, false if otherwise.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$ip` (`string`) &mdash;

      <div markdown="1" class="param-desc"></div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It returns a `bool` value.

<a name="getipv4frommappedipv6" id="getipv4frommappedipv6"></a>
<a name="getIPv4FromMappedIPv6" id="getIPv4FromMappedIPv6"></a>
### `getIPv4FromMappedIPv6()`

Returns an IPv4 address from a 'mapped' IPv6 address.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$ip` (`string`) &mdash;

      <div markdown="1" class="param-desc"> eg, `'::ffff:192.0.2.128'`</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`string`) &mdash;
    <div markdown="1" class="param-desc">eg, `'192.0.2.128'`</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="getipsforrange" id="getipsforrange"></a>
<a name="getIpsForRange" id="getIpsForRange"></a>
### `getIpsForRange()`

Get low and high IP addresses for a specified range.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$ipRange` (`array`) &mdash;

      <div markdown="1" class="param-desc"> An IP address range in presentation format.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`array`|`bool`) &mdash;
    <div markdown="1" class="param-desc">Array `array($lowIp, $highIp)` in network address format, or false on failure.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="isipinrange" id="isipinrange"></a>
<a name="isIpInRange" id="isIpInRange"></a>
### `isIpInRange()`

Determines if an IP address is in a specified IP address range.

An IPv4-mapped address should be range checked with an IPv4-mapped address range.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$ip` (`string`) &mdash;

      <div markdown="1" class="param-desc"> IP address in network address format</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$ipRanges` (`array`) &mdash;

      <div markdown="1" class="param-desc"> List of IP address ranges</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`bool`) &mdash;
    <div markdown="1" class="param-desc">True if in any of the specified IP address ranges; else false.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="getipfromheader" id="getipfromheader"></a>
<a name="getIpFromHeader" id="getIpFromHeader"></a>
### `getIpFromHeader()`

Returns the most accurate IP address availble for the current user, in IPv4 format.

This could be the proxy client's IP address.

#### Signature


<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`string`) &mdash;
    <div markdown="1" class="param-desc">IP address in presentation format.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="getnonproxyipfromheader" id="getnonproxyipfromheader"></a>
<a name="getNonProxyIpFromHeader" id="getNonProxyIpFromHeader"></a>
### `getNonProxyIpFromHeader()`

Returns a non-proxy IP address from header.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$default` (`string`) &mdash;

      <div markdown="1" class="param-desc"> Default value to return if there no matching proxy header.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$proxyHeaders` (`array`) &mdash;

      <div markdown="1" class="param-desc"> List of proxy headers.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>
- It returns a `string` value.

<a name="getlastipfromlist" id="getlastipfromlist"></a>
<a name="getLastIpFromList" id="getLastIpFromList"></a>
### `getLastIpFromList()`

Returns the last IP address in a comma separated list, subject to an optional exclusion list.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$csv` (`string`) &mdash;

      <div markdown="1" class="param-desc"> Comma separated list of elements.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   <li>
      <div markdown="1" class="parameter">
      `$excludedIps` (`array`) &mdash;

      <div markdown="1" class="param-desc"> Optional list of excluded IP addresses (or IP address ranges).</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`string`) &mdash;
    <div markdown="1" class="param-desc">Last (non-excluded) IP address in the list.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

<a name="gethostbyaddr" id="gethostbyaddr"></a>
<a name="getHostByAddr" id="getHostByAddr"></a>
### `getHostByAddr()`

Retirms the hostname for a given IP address.

#### Signature

-  It accepts the following parameter(s):

   <ul>
   <li>
      <div markdown="1" class="parameter">
      `$ipStr` (`string`) &mdash;

      <div markdown="1" class="param-desc"> Human-readable IP address.</div>

      <div style="clear:both;"/>

      </div>
   </li>
   </ul>

<ul>
  <li>
    <div markdown="1" class="parameter">
    _Returns:_  (`string`) &mdash;
    <div markdown="1" class="param-desc">The hostname or unmodified $ipStr on failure.</div>

    <div style="clear:both;"/>

    </div>
  </li>
</ul>

