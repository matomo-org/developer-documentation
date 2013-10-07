<small>Piwik</small>

IP
==

Handling IP addresses (both IPv4 and IPv6).

Description
-----------

As of Piwik 1.3, IP addresses are stored in the DB has VARBINARY(16),
and passed around in network address format which has the advantage of
being in big-endian byte order, allowing for binary-safe string
comparison of addresses (of the same length), even on Intel x86.

As a matter of naming convention, we use $ip for the network address format
and $ipString for the presentation format (i.e., human-readable form).

We&#039;re not using the network address format (in_addr) for socket functions,
so we don&#039;t have to worry about incompatibility with Windows UNICODE
and inetPtonW().


Constants
---------

This class defines the following constants:

- [`MAPPED_IPv4_START`](#MAPPED_IPv4_START)

Methods
-------

The class defines the following methods:

- [`sanitizeIp()`](#sanitizeIp) &mdash; Sanitize human-readable IP address.
- [`sanitizeIpRange()`](#sanitizeIpRange) &mdash; Sanitize human-readable (user-supplied) IP address range.
- [`P2N()`](#P2N) &mdash; Convert presentation format IP address to network address format
- [`N2P()`](#N2P) &mdash; Convert network address format to presentation format
- [`prettyPrint()`](#prettyPrint) &mdash; Alias for N2P()
- [`isIPv4()`](#isIPv4) &mdash; Is this an IPv4, IPv4-compat, or IPv4-mapped address?
- [`long2ip()`](#long2ip) &mdash; Convert IP address (in network address format) to presentation format.
- [`isIPv6()`](#isIPv6) &mdash; Returns true if $ip is an IPv6 address, false if otherwise.
- [`isMappedIPv4()`](#isMappedIPv4) &mdash; Returns true if $ip is a IPv4 mapped address, false if otherwise.
- [`getIPv4FromMappedIPv6()`](#getIPv4FromMappedIPv6) &mdash; Returns
- [`getIpsForRange()`](#getIpsForRange) &mdash; Get low and high IP addresses for a specified range.
- [`isIpInRange()`](#isIpInRange) &mdash; Determines if an IP address is in a specified IP address range.
- [`getIpFromHeader()`](#getIpFromHeader) &mdash; Returns the best possible IP of the current user, in the format A.B.C.D For example, this could be the proxy client&#039;s IP address.
- [`getNonProxyIpFromHeader()`](#getNonProxyIpFromHeader) &mdash; Returns a non-proxy IP address from header
- [`getLastIpFromList()`](#getLastIpFromList) &mdash; Returns the last IP address in a comma separated list, subject to an optional exclusion list.
- [`getHostByAddr()`](#getHostByAddr) &mdash; Get hostname for a given IP address

### `sanitizeIp()` <a name="sanitizeIp"></a>

Sanitize human-readable IP address.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$ipString`
- It returns a(n) `string` value.

### `sanitizeIpRange()` <a name="sanitizeIpRange"></a>

Sanitize human-readable (user-supplied) IP address range.

#### Description

Accepts the following formats for $ipRange:
- single IPv4 address, e.g., 127.0.0.1
- single IPv6 address, e.g., ::1/128
- IPv4 block using CIDR notation, e.g., 192.168.0.0/22 represents the IPv4 addresses from 192.168.0.0 to 192.168.3.255
- IPv6 block using CIDR notation, e.g., 2001:DB8::/48 represents the IPv6 addresses from 2001:DB8:0:0:0:0:0:0 to 2001:DB8:0:FFFF:FFFF:FFFF:FFFF:FFFF
- wildcards, e.g., 192.168.0.*

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$ipRangeString`
- _Returns:_ IP address range in CIDR notation OR false
    - `string`
    - `bool`

### `P2N()` <a name="P2N"></a>

Convert presentation format IP address to network address format

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$ipString`
- _Returns:_ Binary-safe string, e.g., &quot;\x7F\x00\x00\x01&quot;
    - `string`

### `N2P()` <a name="N2P"></a>

Convert network address format to presentation format

#### See Also

- `prettyPrint()`

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$ip`
- _Returns:_ IP address in presentation format
    - `string`

### `prettyPrint()` <a name="prettyPrint"></a>

Alias for N2P()

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$ip`
- _Returns:_ IP address in presentation format
    - `string`

### `isIPv4()` <a name="isIPv4"></a>

Is this an IPv4, IPv4-compat, or IPv4-mapped address?

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$ip`
- _Returns:_ True if IPv4, else false
    - `bool`

### `long2ip()` <a name="long2ip"></a>

Convert IP address (in network address format) to presentation format.

#### Description

This is a backward compatibility function for code that only expects
IPv4 addresses (i.e., doesn&#039;t support IPv6).

This function does not support the long (or its string representation)
returned by the built-in ip2long() function, from Piwik 1.3 and earlier.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$ip`
- _Returns:_ IP address in presentation format
    - `string`

### `isIPv6()` <a name="isIPv6"></a>

Returns true if $ip is an IPv6 address, false if otherwise.

#### Description

This function does
a naive check. It assumes that whatever format $ip is in, it is well-formed.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$ip`
- It returns a(n) `bool` value.

### `isMappedIPv4()` <a name="isMappedIPv4"></a>

Returns true if $ip is a IPv4 mapped address, false if otherwise.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$ip`
- It returns a(n) `bool` value.

### `getIPv4FromMappedIPv6()` <a name="getIPv4FromMappedIPv6"></a>

Returns

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$ip`
- It does not return anything.

### `getIpsForRange()` <a name="getIpsForRange"></a>

Get low and high IP addresses for a specified range.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$ipRange`
- _Returns:_ Array ($lowIp, $highIp) in network address format, or false if failure
    - `array`
    - `bool`

### `isIpInRange()` <a name="isIpInRange"></a>

Determines if an IP address is in a specified IP address range.

#### Description

An IPv4-mapped address should be range checked with an IPv4-mapped address range.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$ip`
    - `$ipRanges`
- _Returns:_ True if in any of the specified IP address ranges; else false.
    - `bool`

### `getIpFromHeader()` <a name="getIpFromHeader"></a>

Returns the best possible IP of the current user, in the format A.B.C.D For example, this could be the proxy client&#039;s IP address.

#### Signature

- It is a **public static** method.
- _Returns:_ IP address in presentation format
    - `string`

### `getNonProxyIpFromHeader()` <a name="getNonProxyIpFromHeader"></a>

Returns a non-proxy IP address from header

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$default`
    - `$proxyHeaders`
- It returns a(n) `string` value.

### `getLastIpFromList()` <a name="getLastIpFromList"></a>

Returns the last IP address in a comma separated list, subject to an optional exclusion list.

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$csv`
    - `$excludedIps`
- _Returns:_ Last (non-excluded) IP address in the list
    - `string`

### `getHostByAddr()` <a name="getHostByAddr"></a>

Get hostname for a given IP address

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$ipStr`
- _Returns:_ Hostname or unmodified $ipStr if failure
    - `string`

