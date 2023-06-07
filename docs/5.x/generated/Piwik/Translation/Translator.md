<small>Piwik\Translation\</small>

Translator
==========

Translates messages.

Methods
-------

The class defines the following methods:

- [`__construct()`](#__construct)
- [`clean()`](#clean) &mdash; Clean a string that may contain HTML special chars, single/double quotes, HTML entities, leading/trailing whitespace
- [`translate()`](#translate) &mdash; Returns an internationalized string using a translation ID.
- [`createAndListing()`](#createandlisting) &mdash; Converts the given list of items into a listing (e.g.
- [`createOrListing()`](#createorlisting) &mdash; Converts the given list of items into a or listing (e.g.
- [`getCurrentLanguage()`](#getcurrentlanguage)
- [`setCurrentLanguage()`](#setcurrentlanguage)
- [`getDefaultLanguage()`](#getdefaultlanguage)
- [`getJavascriptTranslations()`](#getjavascripttranslations) &mdash; Generate javascript translations array
- [`addDirectory()`](#adddirectory) &mdash; Add a directory containing translations.
- [`reset()`](#reset) &mdash; Should be used by tests only, and this method should eventually be removed.
- [`findTranslationKeyForTranslation()`](#findtranslationkeyfortranslation)
- [`getAllTranslations()`](#getalltranslations) &mdash; Returns all the translation messages loaded.

<a name="__construct" id="__construct"></a>
<a name="__construct" id="__construct"></a>
### `__construct()`

#### Signature

-  It accepts the following parameter(s):
    - `$loader` (`Piwik\Translation\Loader\LoaderInterface`) &mdash;
      
    - `$directories` (`array`) &mdash;
      

<a name="clean" id="clean"></a>
<a name="clean" id="clean"></a>
### `clean()`

Clean a string that may contain HTML special chars, single/double quotes, HTML entities, leading/trailing whitespace

#### Signature

-  It accepts the following parameter(s):
    - `$s` (`string`) &mdash;
      
- It returns a `string` value.

<a name="translate" id="translate"></a>
<a name="translate" id="translate"></a>
### `translate()`

Returns an internationalized string using a translation ID. If a translation
cannot be found for the ID, the ID is returned.

#### Signature

-  It accepts the following parameter(s):
    - `$translationId` (`string`) &mdash;
       Translation ID, eg, `General_Date`.
    - `$args` (`array`|`string`|`int`) &mdash;
       `sprintf` arguments to be applied to the internationalized string.
    - `$language` (`string`|`null`) &mdash;
       Optionally force the language.

- *Returns:*  `string` &mdash;
    The translated string or `$translationId`.

<a name="createandlisting" id="createandlisting"></a>
<a name="createAndListing" id="createAndListing"></a>
### `createAndListing()`

Converts the given list of items into a listing (e.g. One, Two, and Three)

#### Signature

-  It accepts the following parameter(s):
    - `$items` (`array`) &mdash;
      
    - `$language` (`string`) &mdash;
      
- It returns a `string` value.

<a name="createorlisting" id="createorlisting"></a>
<a name="createOrListing" id="createOrListing"></a>
### `createOrListing()`

Converts the given list of items into a or listing (e.g. One, Two, or Three)

#### Signature

-  It accepts the following parameter(s):
    - `$items` (`array`) &mdash;
      
    - `$language` (`string`) &mdash;
      
- It returns a `string` value.

<a name="getcurrentlanguage" id="getcurrentlanguage"></a>
<a name="getCurrentLanguage" id="getCurrentLanguage"></a>
### `getCurrentLanguage()`

#### Signature

- It returns a `string` value.

<a name="setcurrentlanguage" id="setcurrentlanguage"></a>
<a name="setCurrentLanguage" id="setCurrentLanguage"></a>
### `setCurrentLanguage()`

#### Signature

-  It accepts the following parameter(s):
    - `$language` (`string`) &mdash;
      
- It does not return anything or a mixed result.

<a name="getdefaultlanguage" id="getdefaultlanguage"></a>
<a name="getDefaultLanguage" id="getDefaultLanguage"></a>
### `getDefaultLanguage()`

#### Signature


- *Returns:*  `string` &mdash;
    The default configured language.

<a name="getjavascripttranslations" id="getjavascripttranslations"></a>
<a name="getJavascriptTranslations" id="getJavascriptTranslations"></a>
### `getJavascriptTranslations()`

Generate javascript translations array

#### Signature

- It does not return anything or a mixed result.

<a name="adddirectory" id="adddirectory"></a>
<a name="addDirectory" id="addDirectory"></a>
### `addDirectory()`

Add a directory containing translations.

#### Signature

-  It accepts the following parameter(s):
    - `$directory` (`string`) &mdash;
      
- It does not return anything or a mixed result.

<a name="reset" id="reset"></a>
<a name="reset" id="reset"></a>
### `reset()`

Should be used by tests only, and this method should eventually be removed.

#### Signature

- It does not return anything or a mixed result.

<a name="findtranslationkeyfortranslation" id="findtranslationkeyfortranslation"></a>
<a name="findTranslationKeyForTranslation" id="findTranslationKeyForTranslation"></a>
### `findTranslationKeyForTranslation()`

#### Signature

-  It accepts the following parameter(s):
    - `$translation` (`string`) &mdash;
      

- *Returns:*  `null`|`string` &mdash;
    

<a name="getalltranslations" id="getalltranslations"></a>
<a name="getAllTranslations" id="getAllTranslations"></a>
### `getAllTranslations()`

Returns all the translation messages loaded.

#### Signature

- It returns a `array` value.

