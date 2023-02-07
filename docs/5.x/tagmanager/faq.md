---
category: Develop
---
# Developer FAQ

This page is the Developer FAQ for the [Matomo Tag Manager](https://plugins.matomo.org/TagManager).
You may also be interested in the [Matomo Tag Manager User FAQs](https://matomo.org/faq/tag-manager) or the [Matomo Tag Manager User Guide](https://matomo.org/docs/tag-manager).

## Do I need to minify my tag, trigger, or variable?

Usually not. The system will automatically minify your template when a container is being created so you don't always have to remember to minify your template after each change.

However, the minifier we use in PHP is quite basic and does for example not rename any variables to reduce the file size. It does remove unneeded comments and whitespace though. If your template is very large, for example larger than 30kb, you may want to provide a minified version of your template as well. You can do this by minifying your template and naming the file `.web.min.js`.

For example if your tag is implemented in `PopupTag.web.js`, you may provide a `PopupTag.web.min.js`.

## How do I change the available environments in the Tag Manager?

If you self host your Matomo on premise, you can configure the list of available environments in the plugin settings by going to "Administration => Plugin Settings".

The "live" environment will always be present.

## Why do I need to update the Tag Manager JavaScript when adding a new tracker configuration?

The Matomo Configuration type Variables defined in a container and referenced by a Tag result in JavaScript trackers. When a tracker configuration is set using `_paq.push()`, that configuration is applied to all trackers created by Matomo tag manager and can override the values set in the Matomo Configuration Variables. If you create a new tracker configuration or find one that isn't working while using Matomo Tag Manager, please update `plugins/TagManager/Template/Tag/MatomoTag.web.js` so that the configuration is applied to all JavaScript trackers created by Tag Manager.