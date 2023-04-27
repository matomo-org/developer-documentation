---
category: Develop
---
# Migrate Plugin from Matomo 4.X to Matomo 5

This migration guide covers how to do some migrations to make a plugin compatible with Matomo 5. A list of
all changes in Matomo 5 can be found in the [Changelog](/changelog).

## Create a new branch

We recommend creating a new branch for your plugin that supports Matomo 5. For example `5.x-dev`. This way you will be able to make changes to your plugin for Matomo 4 and Matomo 5 and release independent versions for each of them. You can still publish updates to your plugin that supports Matomo 4 once you have published an update for a version that supports Matomo 5.

## Adjust the required Matomo version

For your plugin to be executed in Matomo 5 you first need to show it is compatible with Matomo 5 in your `plugin.json` file:

* specify that your plugin requires Matomo 5 (the requirement for Matomo 4 used to be e.g. `"matomo": ">=4.0.0-b1,<5.0.0-b1"`). 
* we also recommend increasing your plugin's major version number e.g. from `4.1.9` to `5.0.0`.

The `plugin.json` would look like this:

```json
   "version": "5.0.0",
   "require": {
        "matomo": ">=5.0.0-b1,<6.0.0-b1"
    },
```

It's not allowed to support multiple major Matomo versions such as Matomo 4 and Matomo 5: `"matomo": ">=4.0.0-b1,<6.0.0-b1"`. You would in this case receive an error email and the release would not be published.

## Required PHP version

Matomo still requires PHP 7.2.5. So there won't be any changes needed in terms of e.g. removed PHP functions. But with releases of PHP 8.1 and 8.2 you may need to check if your plugin might not start throwing warnings or deprecation notices in newer PHP releases.

## AngularJS replaced with VueJS

Matomo 5 completes the migration from AngularJS to the [VueJS 3 framework](https://vuejs.org/guide/introduction.html). If your plugin contains templates which make use of AngularJS components or directives then these will need to be recreated in VueJS and the templates adjusted. 

A new VueJS component can be created for your plugin using the console command:

```
./console generate:vue-component --pluginname=MYPLUGIN --component=NEWCOMPONENT
``` 

This will create an example component in `plugins/MYPLUGIN/vue/src/NEWCOMPONENT.vue` which shows the basic component structure and can be used a starting point to build a new component.

Because VueJS uses [TypeScript](https://www.typescriptlang.org/) the `*.vue` files must be compiled into `*.ts` TypeScript files and stored in `/plugins/MYPLUGIN/vue/dist` before they can be used. This can be achieved using the following console command:

```
./console vue:build MYPLUGIN
```
This will build all vue components for your plugin and must be run before testing any VueJS change. The `--watch` option for this command can be used to constantly monitor any VueJS changes for your plugin and automatically compile them.

## Vendor proxies

With Matomo 5 we have introduced vendor proxy patterns. Plugin should no longer use any dependencies that are shipped with Matomo directly, we have introduced a set of classes and methods that can be used instead. This step will allow us to easily update and replace vendor libraries without the requirement to do a major release for it as plugins will be fully encasuplated from our dependencies. If your plugin needs direct access to a certain dependency consider creating a GitHub issue for adding a proxy pattern for it or bundle your own prefixed version of the dependency with your plugin.

The following part will explain how to replace the usage of certain vendor libraries with our proxies:

### Configuration and Dependency Injection

In `config.php` files and in methods like `provideContainerConfig` in tests it is possible to define dependency configurations. Those configurations were previously done by directly using functions of the PHPDI library. We have introduced our own class providing static methods with the same functionallity that need to be used instead. In addition you can no longer use `\Psr\Container\ContainerInterface` or `\DI\Container` as type hints as we are now using or own container class `\Piwik\Container\Container`.

* `DI` namespaced functions need to be replaced with static `\Piwik\DI` methods. 
  * `\DI\add()` will become `\Piwik\DI::add()`
  * `\DI\string()` will become `\Piwik\DI::string()`
  * ...
* If you need to catch dependency related exceptions use `\Piwik\Exception\DI\DependencyException` or `\Piwik\Exception\DI\NotFoundException`
* Use `\Piwik\Container\Container` where you used to use `\Psr\Container\ContainerInterface` or `\DI\Container` as typehints

### Logging

We used to use `\Monolog\Logger` or `\Psr\Log\LoggerInterface` to access our logging interface through dependency injection.
* Use `\Piwik\Log\Logger` instead of `\Monolog\Logger`
* Use `\Piwik\Log\LoggerInterface` instead of `\Psr\Log\LoggerInterface`
* Use `\Piwik\Log\NullLogger` instead of `\Psr\Log\NullLogger`

To access our logging interface you can e.g. use
```php
$logger = \Piwik\Container\StaticContainer::get(\Piwik\Log\Logger::class);
```

Or when injection the logger into e.g. an API constructor using dependency injection you can use
```php
public function __construct(\Piwik\Log\LoggerInterface $logger)
{
    $this->logger = $logger;
```

### Console Commands

Our console commands were using parts of the symfony console directly. Command classes will no longer be allowed to any symfony components diretly, instead we have rewritten our base class for commands `\Piwik\Plugins\ConsoleCommand`. This class will no give you access to console functionalities directly. To update your plugin command you need to apply the following changes:
* Methods like `run`, `execute`, `interact` or `initialize` can no longer be overwritten. Instead, use our custom methods prefixed with `do`: `doExecute`, `doInteract` or `doInitialize`
  * `doExecute()` method needs to return integers. We recommend using the class constants `SUCCESS` or `FAILURE` as return values.
* Where ever you need to work with input or output streams use `$this->getInput()` or `$this->getOutput` instead. Don't use `InputInterface` or `OutputInterface` as method typehints.
* When defining input options and arguments `addOption` and `addArgument` can no longer be used
  * For arguments use `addOptionalArgument` or `addRequiredArgument`
  * For options use `addNegatableOption`, `addOptionalValueOption`, `addNoValueOption` or `addRequiredValueOption`
* Directly using any console helpers is now prohibited
  * To ask for user input use the new methods `askForConfirmation`, `askAndValidate` or `ask`
  * For a progress bar use the methods `initProgressBar`, `startProgressBar`, `advanceProgressBar` and `finishProgressBar`
  * Tables can be rendered using the new method `renderTable`
* For executing another command within your command use the new method `runCommand`

## Tests on CI

We used to use Travis CI for testing. With Matomo 5 we discontinued support for running tests on Travis CI, instead it is possible to use a GitHub action for this.
You can find more details on how to set up your own GitHub test action in [this guide](/guides/tests-github).

## JQuery Updated

jQuery has been updated to 3.6.3. Please check your plugin's JavaScript code if it needs to be adjusted. More details can be found in jQuery update guides: https://jquery.com/upgrade-guide/3.0/ and https://jquery.com/upgrade-guide/3.5/

## Plugin names

Plugin names are now limited to 60 characters. If your plugin name is longer then 60 characters then you will need to rename it.

### Deprecations

* The javascript event `piwikPageChange`, which is triggered when a reporting page is loaded, has been renamed to `matomoPageChange`. Ensure to update your plugin if you rely on it.
* The `Common::fixLbrace()` function has been removed. It was only necessary for AngularJS and no longer needs to be used.

## Summary

In this guide we have seen which steps to take to migrate your Matomo plugin to be compatible with our latest Matomo 5.
If you need further help with converting your plugin to Matomo 5, head over to the [Matomo developers community forums](https://forum.matomo.org/c/plugins-platform).

Once you've adjusted your plugin, don't forget to release a new version.
