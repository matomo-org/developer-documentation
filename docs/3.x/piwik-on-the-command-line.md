---
category: Develop
---
# Commands

Piwik can be used through several interfaces, the command line being one of them.

The CLI console enables users to run **commands** defined by plugins. The commands can be used to perform maintenance, to monitor the application, to ease development, and so on.

## The `console` tool

To use Piwik on the command line, all you need to do is run the console tool. The tool is a script located in Piwik's root directory and called `console`. You can run it with the command:

```bash
./console help
```

or

```bash
php ./console help
```

The Piwik console is built using the [Symfony Console component](https://symfony.com/doc/current/components/console.html). If you are familiar with Symfony, you should immediately find your way in the Piwik console.

### Commands

The console can be used to run Piwik commands like so:

```bash
./console <command>
```

The console comes with many commands, for example to generate empty plugins and plugin files with, run git commands, watch Piwik's log output, run tests, and deal with Piwik translations.

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

To learn how to flesh out your command, you can read the [Symfony Console documentation](http://symfony.com/doc/current/components/console/index.html).
