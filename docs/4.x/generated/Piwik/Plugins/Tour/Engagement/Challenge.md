<small>Piwik\Plugins\Tour\Engagement\</small>

Challenge
=========

Since Piwik 3.10.0

Defines a new challenge which a super user needs to complete in order to become a "Matomo expert".

Plugins can add new challenges by listening to the [Tour.filterChallenges](/api-reference/events#tourfilterchallenges) event.

Methods
-------

The abstract class defines the following methods:

- [`getName()`](#getname) &mdash; The human readable name that will be shown in the onboarding widget.
- [`getId()`](#getid) &mdash; A short unique ID that represents this challenge, for example "add_report".
- [`isCompleted()`](#iscompleted) &mdash; By default, we attribute a challenge as soon as it was completed manually by calling `$challenge->setCompleted()`.
- [`getDescription()`](#getdescription) &mdash; A detailed description that describes the value of the action the user needs to complete, or some tips on how to complete this challenge.
- [`getUrl()`](#geturl) &mdash; A URL that has more information about how to complete the given event or a URL within the Matomo app to directly complete a challenge.
- [`clearCache()`](#clearcache)
- [`setCompleted()`](#setcompleted) &mdash; Set this challenge was completed successfully by the current user.

<a name="getname" id="getname"></a>
<a name="getName" id="getName"></a>
### `getName()`

The human readable name that will be shown in the onboarding widget.

Should be max 3 or 4 words and represent an
action, like "Add a report"

#### Signature

- It returns a `string` value.

<a name="getid" id="getid"></a>
<a name="getId" id="getId"></a>
### `getId()`

A short unique ID that represents this challenge, for example "add_report".

#### Signature

- It returns a `string` value.

<a name="iscompleted" id="iscompleted"></a>
<a name="isCompleted" id="isCompleted"></a>
### `isCompleted()`

By default, we attribute a challenge as soon as it was completed manually by calling `$challenge->setCompleted()`.

If we can detect whether a particular user has already completed a challenge in the past then we mark it automatically
as completed. We can detect this automatically eg by querying the DB and check if a particular login has for example
created a segment etc. We do this only if the query is supposed to be fast. Otherwise we would fallback to the manual
way.

#### Signature

- It returns a `bool` value.

<a name="getdescription" id="getdescription"></a>
<a name="getDescription" id="getDescription"></a>
### `getDescription()`

A detailed description that describes the value of the action the user needs to complete, or some tips on how to complete this challenge.

Will be shown when hovering a challenge name.

#### Signature

- It returns a `string` value.

<a name="geturl" id="geturl"></a>
<a name="getUrl" id="getUrl"></a>
### `getUrl()`

A URL that has more information about how to complete the given event or a URL within the Matomo app to directly complete a challenge.

For example "add_user" challenge could directly link to the user management.

#### Signature

- It returns a `string` value.

<a name="clearcache" id="clearcache"></a>
<a name="clearCache" id="clearCache"></a>
### `clearCache()`

#### Signature

- It does not return anything.

<a name="setcompleted" id="setcompleted"></a>
<a name="setCompleted" id="setCompleted"></a>
### `setCompleted()`

Set this challenge was completed successfully by the current user.

Only works for a super user.

#### Signature

- It returns a `bool` value.

