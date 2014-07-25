<small>Piwik\</small>

SettingsServer
==============

Contains helper methods that can be used to get information regarding the server, its settings and currently used PHP settings.

Methods
-------

The class defines the following methods:

- [`isArchivePhpTriggered()`](#isarchivephptriggered) &mdash; Returns true if the current script execution was triggered by the cron archiving script.
- [`isIIS()`](#isiis) &mdash; Returns `true` if running on Microsoft IIS 7 (or above), `false` if otherwise.
- [`isApache()`](#isapache) &mdash; Returns `true` if running on an Apache web server, `false` if otherwise.
- [`isWindows()`](#iswindows) &mdash; Returns `true` if running on a Windows operating system, `false` if otherwise.
- [`isTimezoneSupportEnabled()`](#istimezonesupportenabled) &mdash; Returns `true` if this PHP version/build supports timezone manipulation (e.g., php >= 5.2, or compiled with **EXPERIMENTAL_DATE_SUPPORT=1** for php < 5.2).
- [`isGdExtensionEnabled()`](#isgdextensionenabled) &mdash; Returns `true` if the GD PHP extension is available, `false` if otherwise.

<a name="isarchivephptriggered" id="isarchivephptriggered"></a>
<a name="isArchivePhpTriggered" id="isArchivePhpTriggered"></a>
### `isArchivePhpTriggered()` 
Returns true if the current script execution was triggered by the cron archiving script.

Helpful for error handling: directly throw error without HTML (eg. when DB is down).

#### Signature

- It returns a `bool` value.

<a name="isiis" id="isiis"></a>
<a name="isIIS" id="isIIS"></a>
### `isIIS()` 
Returns `true` if running on Microsoft IIS 7 (or above), `false` if otherwise.

#### Signature

- It returns a `bool` value.

<a name="isapache" id="isapache"></a>
<a name="isApache" id="isApache"></a>
### `isApache()` 
Returns `true` if running on an Apache web server, `false` if otherwise.

#### Signature

- It returns a `bool` value.

<a name="iswindows" id="iswindows"></a>
<a name="isWindows" id="isWindows"></a>
### `isWindows()` 
Since Piwik 0.6.5

Returns `true` if running on a Windows operating system, `false` if otherwise.

#### Signature

- It returns a `bool` value.

<a name="istimezonesupportenabled" id="istimezonesupportenabled"></a>
<a name="isTimezoneSupportEnabled" id="isTimezoneSupportEnabled"></a>
### `isTimezoneSupportEnabled()` 
Returns `true` if this PHP version/build supports timezone manipulation (e.g., php >= 5.2, or compiled with **EXPERIMENTAL_DATE_SUPPORT=1** for php < 5.2).

#### Signature

- It returns a `bool` value.

<a name="isgdextensionenabled" id="isgdextensionenabled"></a>
<a name="isGdExtensionEnabled" id="isGdExtensionEnabled"></a>
### `isGdExtensionEnabled()` 
Returns `true` if the GD PHP extension is available, `false` if otherwise.

_Note: ImageGraph and the sparkline report visualization depend on the GD extension._

#### Signature

- It returns a `bool` value.

