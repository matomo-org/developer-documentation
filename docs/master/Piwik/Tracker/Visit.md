<small>Piwik\Tracker</small>

Visit
=====

Class used to handle a Visit.

Description
-----------

A visit is either NEW or KNOWN.
- If a visit is NEW then we process the visitor information (settings, referrers, etc.) and save
a new line in the log_visit table.
- If a visit is KNOWN then we update the visit row in the log_visit table, updating the number of pages
views, time spent, etc.

Whether a visit is NEW or KNOWN we also save the action in the DB.
One request to the piwik.php script is associated to one action.


Constants
---------

This class defines the following constants:

- [`UNKNOWN_CODE`](#UNKNOWN_CODE)

Methods
-------

The class defines the following methods:

- [`setRequest()`](#setRequest)
- [`handle()`](#handle) &mdash; Main algorithm to handle the visit.
- [`generateUniqueVisitorId()`](#generateUniqueVisitorId)
- [`isHostKnownAliasHost()`](#isHostKnownAliasHost)

### `setRequest()` <a name="setRequest"></a>

#### Signature

- It is a **public** method.
- It accepts the following parameter(s):
    - `$request` (`Piwik\Tracker\Request`)
- It does not return anything.

### `handle()` <a name="handle"></a>

Main algorithm to handle the visit.

#### Description

Once we have the visitor information, we have to determine if the visit is a new or a known visit.

1) When the last action was done more than 30min ago,
     or if the visitor is new, then this is a new visit.

2) If the last action is less than 30min ago, then the same visit is going on.
   Because the visit goes on, we can get the time spent during the last action.

NB:
 - In the case of a new visit, then the time spent
   during the last action of the previous visit is unknown.

   - In the case of a new visit but with a known visitor,
   we can set the &#039;returning visitor&#039; flag.

In all the cases we set a cookie to the visitor with the new information.

#### Signature

- It is a **public** method.
- It does not return anything.

### `generateUniqueVisitorId()` <a name="generateUniqueVisitorId"></a>

#### Signature

- It is a **public static** method.
- _Returns:_ returns random 16 chars hex string
    - `string`

### `isHostKnownAliasHost()` <a name="isHostKnownAliasHost"></a>

#### Signature

- It is a **public static** method.
- It accepts the following parameter(s):
    - `$urlHost`
    - `$idSite`
- It does not return anything.

