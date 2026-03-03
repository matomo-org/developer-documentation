<small>Piwik\Plugins\CustomPiwikJs\</small>

TrackerUpdater
==============

Updates the Piwik JavaScript Tracker "piwik.js" in case plugins extend the tracker.

Usage:
StaticContainer::get('Piwik\Plugins\CustomPiwikJs\TrackerUpdater')->update();

Methods
-------

The class defines the following methods:

- [`checkWillSucceed()`](#checkwillsucceed) &mdash; Checks whether the Piwik JavaScript tracker file "piwik.js" is writable.
- [`update()`](#update) &mdash; Updates / re-generates the Piwik JavaScript tracker "piwik.js".

<a name="checkwillsucceed" id="checkwillsucceed"></a>
<a name="checkWillSucceed" id="checkWillSucceed"></a>
### `checkWillSucceed()`

Checks whether the Piwik JavaScript tracker file "piwik.js" is writable.

#### Signature

- It does not return anything or a mixed result.
- It throws one of the following exceptions:
    - [`Exception`](http://php.net/class.Exception) &mdash; In case the piwik.js file is not writable.

<a name="update" id="update"></a>
<a name="update" id="update"></a>
### `update()`

Updates / re-generates the Piwik JavaScript tracker "piwik.js".

It may not be possible to update the "piwik.js" tracker file if the file is not writable. It won't throw
an exception in such a case and instead just to nothing. To check if the update would succeed, call
[checkWillSucceed()](/api-reference/Piwik/Plugins/CustomPiwikJs/TrackerUpdater#checkwillsucceed).

#### Signature

- It does not return anything or a mixed result.

