<small>Piwik</small>

SettingsServer
==============

Contains helper methods that can be used to get information regarding the server, its settings and PHP settings.


Methods
-------

The class defines the following methods:

- [`isArchivePhpTriggered()`](#isArchivePhpTriggered) &mdash; Returns true if the current script execution was triggered misc/cron/archive.php.
- [`isIIS()`](#isIIS) &mdash; Returns true if running on Microsoft IIS 7 (or above), false if otherwise.
- [`isApache()`](#isApache) &mdash; Returns true if running on an Apache web server, false if otherwise.
- [`isWindows()`](#isWindows) &mdash; Returns true if running on a Windows operating system, false if otherwise.
- [`isTimezoneSupportEnabled()`](#isTimezoneSupportEnabled) &mdash; Returns true if this php version/build supports timezone manipulation (e.g., php &gt;= 5.2, or compiled with EXPERIMENTAL_DATE_SUPPORT=1 for php &lt; 5.2).
- [`isGdExtensionEnabled()`](#isGdExtensionEnabled) &mdash; Returns true if the GD PHP extension is available, false if otherwise.

### `isArchivePhpTriggered()` <a name="isArchivePhpTriggered"></a>

Returns true if the current script execution was triggered misc/cron/archive.php.

#### Description

Helpful for error handling: directly throw error without HTML (eg. when DB is down).

#### Signature

- It is a **public static** method.
- It returns a(n) `bool` value.

### `isIIS()` <a name="isIIS"></a>

Returns true if running on Microsoft IIS 7 (or above), false if otherwise.

#### Signature

- It is a **public static** method.
- It returns a(n) `bool` value.

### `isApache()` <a name="isApache"></a>

Returns true if running on an Apache web server, false if otherwise.

#### Signature

- It is a **public static** method.
- It returns a(n) `bool` value.

### `isWindows()` <a name="isWindows"></a>

Returns true if running on a Windows operating system, false if otherwise.

#### Signature

- It is a **public static** method.
- It returns a(n) `bool` value.

### `isTimezoneSupportEnabled()` <a name="isTimezoneSupportEnabled"></a>

Returns true if this php version/build supports timezone manipulation (e.g., php &gt;= 5.2, or compiled with EXPERIMENTAL_DATE_SUPPORT=1 for php &lt; 5.2).

#### Signature

- It is a **public static** method.
- It returns a(n) `bool` value.

### `isGdExtensionEnabled()` <a name="isGdExtensionEnabled"></a>

Returns true if the GD PHP extension is available, false if otherwise.

#### Description

ImageGraph and sparklines depend on the GD extension.

#### Signature

- It is a **public static** method.
- It returns a(n) `bool` value.

