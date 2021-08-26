---
category: Develop
---

# Translations

<!-- Meta (to be deleted)
Purpose:
- describe how to make plugins/contributions available in different languages,
- describe how to use internationalization in twig templates & in PHP code,
- describe how to create new translation keys (ie, reuse as much as possible),

Audience: plugin developers

Expected Result:

Notes:

What's missing? (stuff in my list that was not in when I wrote the 1st draft)
- plugin developers + otrance
-->

Read this guide if you'd like to know

- **how to make your plugin available in other languages**
- **how to make your contribution to Matomo Core available in other languages**

## The Basics

Matomo is available in over 50 languages and comes with many translations. The core itself provides some basic translations for words like "Visitor" and "Help". They are stored in the directory <code>/lang</code>. In addition, each plugin can provide its own translations for wordings that are used in this plugin. They are located in <code>/plugins/\*/lang</code>. In those directories you'll find one JSON file for each language. Each language file consists in turn of tokens that belong to a group.

```json
{
  "MyPlugin": {
    "BlogPost": "Blog post",
    "MyToken": "My translation",
    "InteractionRate": "Interaction Rate",
    "MyParagraphWithALink": "This translated text %1$s uses %2$s parameters."
  }
}
```

A group usually represents the name of a plugin, in this case "MyPlugin". Within this group, all the tokens are listed on the left side and the related translations on the right side.

Translated text entries are allowed to contain `sprintf` parameters, for example, `"This translated text is uses a %s parameter"` or `"This translated text %1$s uses %2$s parameters."`. Every translate function will accept extra parameters that get passed to `sprintf` with the text.

### Building a translation key

As you will later see to actually translate a word or a sentence you'll need to know the corresponding translation key. This key is built by combining a group and a token separated by an underscore. You can for instance use the key `MyPlugin_BlogPost` to get a translation of "Blog post". Defining a new key is as easy as adding a new entry to the "MyPlugin" group.

### Providing default translations

To replace a key with translated text, Matomo will look into the JSON file for the current language. If no entry can be found, Matomo will use the english translation by default. Therefore, you should always provide a default translation in English for all keys in the file `en.json` (ie, `/plugins/MyPlugin/lang/en.json`).

### Reusing translations

As mentioned Matomo comes with quite a lot of translations. You can and should reuse them but you are supposed to be aware that a translation key might be removed or renamed in the future. It is also possible that a translation key was added in a recent version and therefore is not available in older versions of Matomo. We do not currently announce any of such changes. Still, 99% of the translation keys do not change and it is therefore usually a good idea to reuse existing translations. Especially when you or your company would otherwise not be able to provide them. To find any existing translation keys go to <span style="font-variant: small-caps">Settings =&gt; Translation search</span> in your Matomo installation. The menu item will only appear if the [development mode](https://developer.matomo.org/guides/getting-started-part-1#enable-development-mode) is enabled.

### Don't try to reduce the amount of translation keys

Sometimes you have repetitive translations like `Choose the site` and `Choose the user` and you might be tempted to rather use a translation key for `The %s` for the translation and then pass different words for the replaceholder like `translate('Choose the %s', 'site')` and `translate('Choose the %s', 'user')`. We recommend not doing this as it can lead to poorly translated text. For example in other languages there might be many different words for `The` (like `der`, `die` and `das` in German). Also using upper and lower case might differ depending on the language. We therefore recommend not trying to reduce the amount of translation keys using placeholders and rather use a translation key for each sentence.

## Translations in PHP

To translate text in PHP, use the [Piwik::translate()](/api-reference/Piwik/Piwik#translate) function. Simply pass any existing translation key and you will get the translated text in the language of the current user in return. The English translation will be returned in case none for the current language exists. For example:

```php
$translatedText = Piwik::translate('MyPlugin_BlogPost');
```

or

```php
$translatedText = Piwik::translate('MyPlugin_MyParagraphWithALink', ['<a href="https://matomo.org">', '</a>']);
// where the key "MyPlugin_MyParagraphWithALink" could look like this:
// "My paragraph has a %1$slink%2$s."
```

## Translation in Twig templates

To translate text in Twig templates, use the `translate` filter. For example,

```twig
{{ 'MyPlugin_BlogPost'|translate }}
```

or

```twig
{{ 'MyPlugin_MyParagraphWithALink'|translate('<a href="https://matomo.org">', '</a>') }}
```

## Translation in JavaScript

Translating text in the browser is a bit more complicated than on the server. The browser doesn't have access to the translations, and we don't want to send every translation file to every user just so a couple lines of text can be translated.

Matomo solves this problem by allowing plugins to define which translation keys should be available in the browser. It can then send only those translations in the current language to the browser.

To make a translation key available on the client side, use the [Translate.getClientSideTranslationKeys](/api-reference/events#translategetclientsidetranslationkeys) event ([read more about Events](/guides/events)):

```php
// In MyPlugin.php
public function registerEvents()
{
    return array(
        'Translate.getClientSideTranslationKeys' => 'getClientSideTranslationKeys'
    );
}

public function getClientSideTranslationKeys(&$translationKeys)
{
    $translationKeys[] = 'MyPlugin_BlogPost';
}
```

To use these translations in JavaScript, use the global `_pk_translate()` JavaScript function:

```javascript
var translatedText = _pk_translate("MyPlugin_BlogPost");
```

## Contributing translations to Matomo

Did you know you can contribute [translations](https://matomo.org/translations/) to Matomo? In case you want to improve an existing translation, translate a missing one or add a new language go to [the Matomo Project on Weblate](https://hosted.weblate.org/projects/matomo/). If you just want to make a quick suggestion for a change (e.g. to fix a typo you noticed while using Matomo), you don't need an account.

## Getting translations for your plugin

As long as you are [developing an open source plugin](https://developer.matomo.org/develop) hosted on GitHub, you may get in touch with us ([translations@matomo.org](mailto:translations@matomo.org?subject=Getting my Matomo plugin translated in other languages)) in order to get your plugin translated by the Matomo translators community.


### Importing your plugin’s strings in the translation platform

While doing the initial setup for your plugin, we will import your English translation file (`en.json`) in your Github plugin repository. For Weblate to be notified of any changes to the English strings, you need to set up a [webhook](https://docs.weblate.org/en/latest/admin/continuous.html#github-setup) using `https://hosted.weblate.org/hooks/github/` as the Payload URL and keep the rest of the settings at the default.


### How to fetch your plugins translations into your repository

As soon as we have set up your plugin within [our Matomo project on Weblate](https://hosted.weblate.org/projects/matomo/), you are able to recieve a pull request with commits per translation update, that you can directly merge into your source e.g. before releases.

## Best practices for new translation keys

Follow these guidelines when creating your own translation keys:

1. **Reuse!** If a core plugin contains a translation you can use, use that instead. If there's a translation you want to use but can't because it's in the wrong case, don't use functions like `lcfirst` and `ucfirst` as it won't work in all languages and rather create a new translation key.
2. **Use numbered placeholders** if more than one is required in your text.

Using numbered placeholders, such as `%1$s`, `%2$s`, etc. instead of `%s` makes it possible for translators to switch the order. That might be necessary to translate it to certain languages properly.

This guideline is more important for contributions to Matomo Core than for new plugins.

## Update data from Unicode CLDR

The translations of the *Intl* plugin are automatically converted from the Unicode Common Locale Data Repository. To update them, check https://github.com/unicode-org/cldr-json/releases for the latest stable release of CLDR and update `$CLDRVersion` in ` plugins/Intl/Commands/GenerateIntl.php`. Afterwards you can run `php console translations:generate-intl-data` and commit the changed files in `plugins/Intl/lang`.
