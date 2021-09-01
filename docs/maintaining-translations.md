---
category: DevelopInDepth
title: Maintaining Translations
---

# Maintaining Translations and using Weblate

We are managing our translation using the service of Weblate: https://hosted.weblate.org/projects/matomo/. If you want
to learn how to use translation in Matomo code or your plugins, check
the [developers guide](https://developer.matomo.org/guides/translations).

## Managing Translations on Weblate

### Structure on Weblate

Weblate is structured using Projects. We are currently having two projects to manage our different translations spaces:

- "Matomo":
  This project is used to maintain all translations within Matomo itself, all our open source plugins as well as some
  Third Party Plugins
  that [asked to handle the translations](https://developer.matomo.org/guides/translations#getting-translations-for-your-plugin)
  for them. The process and all descriptions below are meant for this project only.
- "Matomo Premium Plugins": This project is used for translations of our premium plugins only.

Within the project it is possible to have components. We are using a component for each en.json that is located anywhere
within Matomo or a plugin. Resources can be managed by an admin.

Each resource can be translated into each language that is available. The list of available languages is managed by us.
Users can request for new languages, but it’s only possible to translate for a language when we accept such a request or
add a language manually.

### Adding a new Component

When we create a new plugin that contains its own en.json or a third party developer asks to get translations for his
plugin, we create a new resource for this plugin. This can be done with the following steps:

1. Click on the `+` in the top right corner
2. Select "Add new translation component"
3. Stay in the "From version control" tab
4. Add a Component name like "Plugin SomeOfficialPlugin" or "CommunityPlugin SomeThirdPartyPlugin"
5. Change "Version control system" to "GitHub"
6. Set the "Source code repository" to the Git repository URL
   like `https://github.com/matomo-org/plugin-GoogleAnalyticsImporter.git`.
7. Set the branch used in the plugin
8. Continue
9. Select "File format `JSON nested structure file`, Filemask `lang/*.json`"
10. If the repository doesn't contain a LICENSE file, you need to select a "Translation license"
11. This should automatically import all existing translations from this repository
12. Don't forget to [add a webhook](https://developer.matomo.org/guides/translations#importing-your-plugins-strings-in-the-translation-platform) to the repository, so that Weblate is immediatly notified of source string changes.

### Adding a language

When a user requests a new language we need to add the language.

1. Pick a language code for the new language
   from [the List of ISO 639 codes](https://en.wikipedia.org/wiki/List_of_ISO_639-1_codes). If a 639-1 two-letter code
   exists that descibes the language accuratly, we use it. Otherwise a three letter code like `tzm` will be used. For
   country variants of languages like `es_AR` we format the language code using a dash and lowercase letters
   like `es-ar`
2. Create a file called `/lang/langcode.json` with the chosen languagecode in the main Matomo repository.
3. This file needs to contain at least a translation key for `General_Locale` specifying the PHP locale Matomo should set. You can use `/usr/share/i18n/SUPPORTED` on a Linux host for inspiration.
```json
{
  "General": {
    "Locale": "es_AR.UTF-8"
  }
}
```
4. You need to [import the CLDR data](https://developer.matomo.org/guides/maintaining-translations#update-data-from-unicode-cldr) for this plugin into the *Intl* plugin. (assuming the language is supported by CLDR)
5. Once merged, the language should be shown in the Matomo-Base component.
6. Daily all new languages are added to all other components and empty JSON files are created for them.


### Configuring a component 

### List of involved translators

On https://matomo.org/translations we are showing which languages Matomo is available in, as well as a list of translators for each language. This list is actually created through a Matomo API request (`LanguagesManager.getAvailableLanguagesInfo`). Therefore, the list of translators is stored within the base translations files (`General_TranslatorName`).

Note: As the list is maintained in the translation files, the list on matomo.org will only be updated, once the translations have been update on GitHub, a new version was released and deployed.


## Update data from Unicode CLDR

The translations of the *Intl* plugin are automatically converted from the Unicode Common Locale Data Repository. To update them, check https://github.com/unicode-org/cldr-json/releases for the latest stable release of CLDR and update `$CLDRVersion` in ` plugins/Intl/Commands/GenerateIntl.php`. Afterwards you can run `php console translations:generate-intl-data` and commit the changed files in `plugins/Intl/lang`.
