<small>Piwik\Intl\Data\Provider\</small>

RegionDataProvider
==================

Provides region related data (continents, countries, etc.).

Methods
-------

The class defines the following methods:

- [`getContinentList()`](#getcontinentlist) &mdash; Returns the list of continent codes.
- [`getCountryList()`](#getcountrylist) &mdash; Returns the list of valid country codes.

<a name="getcontinentlist" id="getcontinentlist"></a>
<a name="getContinentList" id="getContinentList"></a>
### `getContinentList()`

Returns the list of continent codes.

#### Signature


- *Returns:*  `string[]` &mdash;
    Array of 3 letter continent codes

<a name="getcountrylist" id="getcountrylist"></a>
<a name="getCountryList" id="getCountryList"></a>
### `getCountryList()`

Returns the list of valid country codes.

#### Signature

-  It accepts the following parameter(s):
    - `$includeInternalCodes` (`bool`) &mdash;
      

- *Returns:*  `string[]` &mdash;
    Array of 2 letter country ISO codes => 3 letter continent code

