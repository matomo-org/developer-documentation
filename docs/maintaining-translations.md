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
12. Don't forget to [add a webhook](https://developer.matomo.org/guides/translations#importing-your-plugins-strings-in-the-translation-platform) to the repository, so that Weblate is immediately notified of source string changes.

### Adding a language

When a user requests a new language we need to add the language.

1. Pick a language code for the new language
   from [the List of ISO 639 codes](https://en.wikipedia.org/wiki/List_of_ISO_639-1_codes). If a 639-1 two-letter code
   exists that describes the language accurately,, we use it. Otherwise, a three-letter code like `tzm` will be used. For
   country variants of languages like `es_AR` we format the language code using a dash and lowercase letters
   like `es-ar`
2. Create a file called `/lang/langcode.json` with the chosen language code in the main Matomo repository.
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

### Adding a language to Matomo

If a translation is complete enough to be added to Matomo (maybe somewhere around 3-5% completion with most important base strings translated), it can be added to the `[Languages]` section of `config/global.ini.php`.

### Configuring a component 

The following settings are changed from the default in the components. If you want to change settings in many components you can use and adapt [`mass-edit.py`](https://github.com/Findus23/matomo-utils/blob/main/localisation/mass-edit.py) which uses the Weblate API.

#### Settings

##### Priority (`priority`)

This can be set on a per-component basis to focus translators to the most important plugins in Matomo

##### Manage strings (`manage-units`)

This can be disabled as there should never be a reason to add new translation keys in Weblate.


##### Translation flags (`check_flags`)

- `php-format`: As Matomo uses `printf` for translations
- `safe-html`: Checks if the translation doesn't use more HTML tags or attributes than the source string
- `ignore-optional-plural`: The translation system of Matomo doesn't support plurals

##### Enforced checks (`enforced_checks`)
```json
["php_format"]
```

##### Push on commit (`push_on_commit`)

This is enabled, which means that whenever a change in Weblate is commited, a new pull request will be created or the existing one will be updated.

##### Language code Style (`language_code_style`)

We use "BCP style using hyphen as a separator" (`bcp`) as it is the closest to the language code style used in Matomo

##### Adding new translation (`new_lang`)

As a few steps need to be done to add a new language (see above), users can only request new languages, but don't add them. (`contact`)

#### Add-ons

In addition, the following add-ons are added to components:

##### Add missing languages ([`weblate.consistency.languages`](https://docs.weblate.org/en/latest/admin/addons.html#addon-weblate-consistency-languages))

This component is project-wide and adds languages added to one component to all others.

##### Remove blank strings ([`weblate.cleanup.blank`](https://docs.weblate.org/en/latest/admin/addons.html#addon-weblate-cleanup-blank))

##### Cleanup translation files ([`weblate.cleanup.generic`](https://docs.weblate.org/en/latest/admin/addons.html#addon-weblate-cleanup-generic))

Removes translation keys no longer in `en.json`

##### Customize JSON output ([`weblate.json.customize`](https://docs.weblate.org/en/latest/admin/addons.html#addon-weblate-json-customize))

```json
{
    "sort_keys": true,
    "indent": 4,
    "style": "spaces"
}
```

##### Squash Git commits ([`weblate.git.squash`](https://docs.weblate.org/en/latest/admin/addons.html#addon-weblate-git-squash))

```json
{
    "squash": "language",
    "append_trailers": true,
    "commit_message": ""
}
```

### List of involved translators

On https://matomo.org/translations we are showing which languages Matomo is available in, as well as a list of translators for each language. This list is actually created through a Matomo API request (`LanguagesManager.getAvailableLanguagesInfo`). Therefore, the list of translators is stored within the base translations files (`General_TranslatorName`).

Note: As the list is maintained in the translation files, the list on matomo.org will only be updated, once the translations have been update on GitHub, a new version was released and deployed.


## Update data from Unicode CLDR

The translations of the *Intl* plugin are automatically converted from the Unicode Common Locale Data Repository. To update them, check https://github.com/unicode-org/cldr-json/releases for the latest stable release of CLDR and update `$CLDRVersion` in ` plugins/Intl/Commands/GenerateIntl.php`. Afterwards you can run `php console translations:generate-intl-data` and commit the changed files in `plugins/Intl/lang`.
