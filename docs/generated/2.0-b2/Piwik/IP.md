<small>Piwik</small>

IP
==

Contains IP address helper functions (for both IPv4 and IPv6).

Description
-----------

As of Piwik 1.3, IP addresses are stored in the DB has VARBINARY(16),
and passed around in network address format which has the advantage of
being in big-endian byte order, allowing for binary-safe string
comparison of addresses (of the same length), even on Intel x86.

As a matter of naming convention, we use $ip for the network address format
and $ipString for the presentation format (i.e., human-readable form).

We're not using the network address format (in_addr) for socket functions,
so we don't have to worry about incompatibility with Windows UNICODE
and inetPtonW().


Constants
---------

This class defines the following constants:

- [`MAPPED_IPv4_START`](#mapped_ipv4_start)

Methods
-------

The class defines the following methods:

- [`sanitizeIp()`](#sanitizeip) &mdash; Removes the port and the last portion of a CIDR IP address.
- [`sanitizeIpRange()`](#sanitizeiprange) &mdash; Sanitize human-readable (user-supplied) IP address range.
- [`P2N()`](#p2n) &mdash; Convert presentation format IP address to network address format.
- [`N2P()`](#n2p) &mdash; Convert network address format to presentation format.
- [`prettyPrint()`](#prettyprint) &mdash; Alias for [N2P()](#N2P).
- [`isIPv4()`](#isipv4) &mdash; Returns true if `$ip` is an IPv4, IPv4-compat, or IPv4-mapped address, false if otherwise.
- [`long2ip()`](#long2ip) &mdash; Convert IP address (in network address format) to presentation format.
- [`isIPv6()`](#isipv6) &mdash; Returns true if $ip is an IPv6 address, false if otherwise.
- [`isMappedIPv4()`](#ismappedipv4) &mdash; Returns true if $ip is a IPv4 mapped address, false if otherwise.
- [`getIPv4FromMappedIPv6()`](#getipv4frommappedipv6) &mdash; Returns an IPv4 address from a 'mapped' IPv6 address.
- [`getIpsForRange()`](#getipsforrange) &mdash; Get low and high IP addresses for a specified range.
- [`isIpInRange()`](#isipinrange) &mdash; Determines if an IP address is in a specified IP address range.
- [`getIpFromHeader()`](#getipfromheader) &mdash; Returns the most accurate IP address availble for the current user, in IPv4 format.
- [`getNonProxyIpFromHeader()`](#getnonproxyipfromheader) &mdash; Returns a non-proxy IP address from header.
- [`getLastIpFromList()`](#getlastipfromlist) &mdash; Returns the last IP address in a comma separated list, subject to an optional exclusion list.
- [`getHostByAddr()`](#gethostbyaddr) &mdash; Get hostname for a given IP address.

<a name="sanitizeip" id="sanitizeip"></a>
### `sanitizeIp()`

Removes the port and the last portion of a CIDR IP address.

#### Signature

- It accepts the following parameter(s):
    - `$ipString`
- It returns a(n) `string` value.

<a name="sanitizeiprange" id="sanitizeiprange"></a>
### `sanitizeIpRange()`

Sanitize human-readable (user-supplied) IP address range.

#### Description

Accepts the following formats for $ipRange:
- single IPv4 address, e.g., 127.0.0.1
- single IPv6 address, e.g., ::1/128
- IPv4 block using CIDR notation, e.g., 192.168.0.0/22 represents the IPv4 addresses from 192.168.0.0 to 192.168.3.255
- IPv6 block using CIDR notation, e.g., 2001:DB8::/48 represents the IPv6 addresses from 2001:DB8:0:0:0:0:0:0 to 2001:DB8:0:FFFF:FFFF:FFFF:FFFF:FFFF
- wildcards, e.g., 192.168.0.*

#### Signature

- It accepts the following parameter(s):
    - `$ipRangeString`
- _Returns:_ IP address range in CIDR notation OR false
    - `string`
    - `bool`

<a name="p2n" id="p2n"></a>
### `P2N()`

Convert presentation format IP address to network address format.

#### Signature

- It accepts the following parameter(s):
    - `$ipString`
- _Returns:_ Binary-safe string, e.g., `"\x7F\x00\x00\x01"`.
    - `string`

<a name="n2p" id="n2p"></a>
### `N2P()`

Convert network address format to presentation format.

#### Description

See also [prettyPreint](#prettyPrint).

#### Signature

- It accepts the following parameter(s):
    - `$ip`
- _Returns:_ IP address in presentation format.
    - `string`

<a name="prettyprint" id="prettyprint"></a>
### `prettyPrint()`

Alias for [N2P()](#N2P).

#### Signature

- It accepts the following parameter(s):
    - `$ip`
- _Returns:_ IP address in presentation format.
    - `string`

<a name="isipv4" id="isipv4"></a>
### `isIPv4()`

Returns true if `$ip` is an IPv4, IPv4-compat, or IPv4-mapped address, false if otherwise.

#### Signature

- It accepts the following parameter(s):
    - `$ip`
- _Returns:_ True if IPv4, else false.
    - `bool`

<a name="long2ip" id="long2ip"></a>
### `long2ip()`

Convert IP address (in network address format) to presentation format.

#### Description

This is a backward compatibility function for code that only expects
IPv4 addresses (i.e., doesn't support IPv6).

This function does not support the long (or its string representation)
returned by the built-in ip2long() function, from Piwik 1.3 and earlier.

#### Signature

- It accepts the following parameter(s):
    - `$ip`
- _Returns:_ IP address in presentation format.
    - `string`

<a name="isipv6" id="isipv6"></a>
### `isIPv6()`

Returns true if $ip is an IPv6 address, false if otherwise.

#### Description

This function does
a naive check. It assumes that whatever format $ip is in, it is well-formed.

#### Signature

- It accepts the following parameter(s):
    - `$ip`
- It returns a(n) `bool` value.

<a name="ismappedipv4" id="ismappedipv4"></a>
### `isMappedIPv4()`

Returns true if $ip is a IPv4 mapped address, false if otherwise.

#### Signature

- It accepts the following parameter(s):
    - `$ip`
- It returns a(n) `bool` value.

<a name="getipv4frommappedipv6" id="getipv4frommappedipv6"></a>
### `getIPv4FromMappedIPv6()`

Returns an IPv4 address from a 'mapped' IPv6 address.

#### Signature

- It accepts the following parameter(s):
    - `$ip`
- _Returns:_ eg, `'192.0.2.128'`
    - `string`

<a name="getipsforrange" id="getipsforrange"></a>
### `getIpsForRange()`

Get low and high IP addresses for a specified range.

#### Signature

- It accepts the following parameter(s):
    - `$ipRange`
- _Returns:_ Array `array($lowIp, $highIp)` in network address format, or false on failure.
    - `array`
    - `bool`

<a name="isipinrange" id="isipinrange"></a>
### `isIpInRange()`

Determines if an IP address is in a specified IP address range.

#### Description

An IPv4-mapped address should be range checked with an IPv4-mapped address range.

#### Signature

- It accepts the following parameter(s):
    - `$ip`
    - `$ipRanges`
- _Returns:_ True if in any of the specified IP address ranges; else false.
    - `bool`

<a name="getipfromheader" id="getipfromheader"></a>
### `getIpFromHeader()`

Returns the most accurate IP address availble for the current user, in IPv4 format.

#### Description

This could be the proxy client's IP address.

#### Signature

- _Returns:_ IP address in presentation format.
    - `string`

<a name="getnonproxyipfromheader" id="getnonproxyipfromheader"></a>
### `getNonProxyIpFromHeader()`

Returns a non-proxy IP address from header.

#### Signature

- It accepts the following parameter(s):
    - `$default`
    - `$proxyHeaders`
- It returns a(n) `string` value.

<a name="getlastipfromlist" id="getlastipfromlist"></a>
### `getLastIpFromList()`

Returns the last IP address in a comma separated list, subject to an optional exclusion list.

#### Signature

- It accepts the following parameter(s):
    - `$csv`
    - `$excludedIps`
- _Returns:_ Last (non-excluded) IP address in the list.
    - `string`

<a name="gethostbyaddr" id="gethostbyaddr"></a>
### `getHostByAddr()`

Get hostname for a given IP address.

#### Signature

- It accepts the following parameter(s):
    - `$ipStr`
- _Returns:_ The hostname or unmodified $ipStr on failure.
    - `string`

