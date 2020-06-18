---
category: Develop
---
# Migrate Plugin from Matomo 3.X to Matomo 4

This migration guide covers explains how to do some migrations to make a plugin compatible with Matomo 4. A list of
all changes in Matomo 4 can be found in the [Changelog](/changelog).

## Adjust the required Matomo version

For your plugin to be executed in Matomo 4 you first need to configure it as compatible with Matomo 4:

* specify that your plugin requires Matomo 4 (the require for Piwik 3 used to be eg `"piwik": ">=3.0.0-b1,<4.0.0-b1"`). 
* we recommend to also increase your plugin's major version number eg from `3.2.3` to `4.0.0`.

The `plugin.json` would look like this:

```json
   "version": "4.0.0",
   "require": {
        "matomo": ">=4.0.0-b1,<5.0.0-b1"
    },
```

## Required PHP version

We now require PHP 7.2.5 instead of PHP 5.5. This means you can use more PHP language features:

* [New features in PHP 5.6](https://www.php.net/manual/en/migration56.new-features.php)
* [New features in PHP 7.0](https://www.php.net/manual/en/migration70.new-features.php)
* [New features in PHP 7.1](https://www.php.net/manual/en/migration71.new-features.php)
* [New features in PHP 7.2](https://www.php.net/manual/en/migration72.new-features.php)

## Browser support

We no longer support IE 10 in the Matomo user interface.

## Events

If your plugin is listening to events you have to rename the method `getListHooksRegistered` to `registerEvents`.

There are also various other event changes see the [changelog](/changelog).

## Twig templates

We updated from Twig 1 to Twig 3 which requires a few changes should you be using twig templates.

You can find details on that on this deprecation lists.

[Twig 2 changes](https://twig.symfony.com/doc/1.x/deprecated.html) | 
[Twig 3 changes](https://twig.symfony.com/doc/2.x/deprecated.html)

Changes from those lists we had to apply in core:

* Adding an if condition on a for tag is deprecated in Twig 2.10. Use a filter filter or an “if” condition inside the “for” body instead (if your condition depends on a variable updated inside the loop).

eg. 
```
{% for id,name in list if id > 17 %}
```
becomes
```
{% for id,name in list|filter(id=> id > 17) %}
```

* The spaceless tag is deprecated in Twig 2.7. Use the spaceless filter instead or {% apply spaceless %} (the Twig\Node\SpacelessNode and Twig\TokenParser\SpacelessTokenParser classes are also deprecated).

e.g. `{% spaceless %}` becomes `{% apply spaceless %}`

* The sameas and divisibleby tests are deprecated in favor of same as and divisible by respectively.

e.g. `divisibleby(2)` becomes `divisible by(2)`

## Summary

In this guide we have seen which steps to take to migrate your Matomo plugin to be compatible with our latest Matomo 4.
If you need further help for converting your plugin to Matomo 3, head over to the [Piwik developers community forums](https://forum.matomo.org/c/plugins-platform).

Once you've adjusted your plugin don't forget to release a new version.
