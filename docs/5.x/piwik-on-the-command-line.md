---
category: Develop
---
# Commands

Matomo can be used through several interfaces, the command line being one of them.

The CLI console enables users to run **commands** defined by plugins. The commands can be used to perform maintenance, to monitor the application, to ease development, and so on.

## The `console` tool

To use Matomo on the command line, all you need to do is run the console tool. The tool is a script located in Matomo's root directory and called `console`. You can run it with the command:

```bash
./console help
```

or

```bash
php ./console help
```

The Matomo console is built using the [Symfony Console component](https://symfony.com/doc/current/components/console.html). If you are familiar with Symfony, it should be easy to find your way in the Matomo console.

### Commands

The console can be used to run Matomo commands like so:

```bash
./console <command>
```

The console comes with many commands, for example to generate empty plugins and plugin files with, run git commands, watch Matomo's log output, run tests, and deal with Matomo translations.

You can view the entire list of commands by running the following command:

```bash
./console list
```

To get more information about a single command (such as its arguments), run the following command:

```bash
./console help <command>
```

where `<command>` should be replaced with the command you are interested in.

## Adding new commands

Plugins can extend the command line tool by creating their own commands. To do so you can use the CLI itself: 

```bash
./console generate:command --pluginname=MyPlugin
```

This will create a folder named `Commands` within your plugin along with a PHP file which represents the actual command. You can add an unlimited number of commands to a plugin.

To learn how to flesh out your command, you can read the [Symfony Console documentation](https://symfony.com/doc/current/components/console/index.html).

Nevertheless, there are some differences when building Matomo commands. As plugins should avoid any direct references to Matomo's dependencies we have our own Command class to inherit from.
This class inherits from the Symfony Console Command class, but has some adjustments that will avoid the direct requirement of using typehints like `InputInterface` or `OutputInterface`, class constants from `InputOption` or `InputArgument` and any Console helpers.
* Methods like `run`, `execute`, `interact` or `initialize` cannot be overwritten. Instead, use our custom methods prefixed with `do`: `doExecute`, `doInteract` or `doInitialize`
* Wherever you need to work with input or output, use `$this->getInput()` or `$this->getOutput()` instead. Don't use `InputInterface` or `OutputInterface` as method typehints.
* When configuring input options and arguments `addOption` and `addArgument` cannot be used
  * For arguments use `addOptionalArgument` or `addRequiredArgument`
  * For options use `addNegatableOption`, `addOptionalValueOption`, `addNoValueOption` or `addRequiredValueOption`
* Directly using any of the console helpers is now prohibited
  * When needing user input use the new methods `askForConfirmation`, `askAndValidate` or `ask`
  * For progress bars use the methods `initProgressBar`, `startProgressBar`, `advanceProgressBar` and `finishProgressBar`
  * To render tables use the new method `renderTable`
* For executing another command within your command use the method `runCommand`
