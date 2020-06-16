<small>Piwik\</small>

IP
==

Contains IP address helper functions (for both IPv4 and IPv6).

As of Piwik 2.9, most methods in this class are deprecated. You are
encouraged to use classes from the Piwik "Network" component:

Methods
-------

The class defines the following methods:

- [`getIpFromHeader()`](#getipfromheader) &mdash; Returns the most accurate IP address available for the current user, in IPv4 format.
- [`getNonProxyIpFromHeader()`](#getnonproxyipfromheader) &mdash; Returns a non-proxy IP address from header.
- [`getFirstIpFromList()`](#getfirstipfromlist) &mdash; Returns the last IP address in a comma separated list, subject to an optional exclusion list.

<a name="getipfromheader" id="getipfromheader"></a>
<a name="getIpFromHeader" id="getIpFromHeader"></a>
### `getIpFromHeader()`

Returns the most accurate IP address available for the current user, in IPv4 format.

This could be the proxy client's IP address.

#### Signature


- *Returns:*  `string` &mdash;
    IP address in presentation format.

<a name="getnonproxyipfromheader" id="getnonproxyipfromheader"></a>
<a name="getNonProxyIpFromHeader" id="getNonProxyIpFromHeader"></a>
### `getNonProxyIpFromHeader()`

Returns a non-proxy IP address from header.

#### Signature

-  It accepts the following parameter(s):
    - `$default` (`string`) &mdash;
       Default value to return if there no matching proxy header.
    - `$proxyHeaders` (`array`) &mdash;
       List of proxy headers.
- It returns a `string` value.

<a name="getfirstipfromlist" id="getfirstipfromlist"></a>
<a name="getFirstIpFromList" id="getFirstIpFromList"></a>
### `getFirstIpFromList()`

Returns the last IP address in a comma separated list, subject to an optional exclusion list.

#### Signature

-  It accepts the following parameter(s):
    - `$csv` (`string`) &mdash;
       Comma separated list of elements.
    - `$excludedIps` (`array`) &mdash;
       Optional list of excluded IP addresses (or IP address ranges).

- *Returns:*  `string` &mdash;
    Last (non-excluded) IP address in the list or an empty string if all given IPs are excluded.

