<small>Piwik\Intl\Data\Provider\</small>

LanguageDataProvider
====================

Provides language data.

Methods
-------

The class defines the following methods:

- [`getLanguageList()`](#getlanguagelist) &mdash; Returns the list of valid language codes.
- [`getLanguageToCountryList()`](#getlanguagetocountrylist) &mdash; Returns the list of language to country mappings.

<a name="getlanguagelist" id="getlanguagelist"></a>
<a name="getLanguageList" id="getLanguageList"></a>
### `getLanguageList()`

Returns the list of valid language codes.

#### Signature


- *Returns:*  `string[]` &mdash;
    Array of 2 letter ISO code => language name (in english).
                 E.g. `array('en' => 'English', 'ja' => 'Japanese')`.

<a name="getlanguagetocountrylist" id="getlanguagetocountrylist"></a>
<a name="getLanguageToCountryList" id="getLanguageToCountryList"></a>
### `getLanguageToCountryList()`

Returns the list of language to country mappings.

#### Signature


- *Returns:*  `string[]` &mdash;
    Array of 2 letter ISO language code => 2 letter ISO country code.
                 E.g. `array('fr' => 'fr') // French => France`.

