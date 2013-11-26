# Piwik on the Command Line

<!-- Meta (to be deleted)
Purpose:
- describe how command line tool works,
- describe each console command,
- describe how plugin devs can create their own console commands (describe conventions)

Audience: 

Expected Result: 

Notes: 

What's missing? (stuff in my list that was not in when I wrote the 1st draft)
- TODO: can probably get rid of this guide, move the info to other guides.
-->

## About this guide

**Read this guide if**

* you'd like to know **how to use a specific command with Piwik's command line tool**
* you'd like to know **how your plugin can create a new command for the command line tool**
* you'd like to know more about **how the command line tool works**

**Guide assumptions**

This guide assumes that you:

* can code in PHP,
* and have installed Piwik (if not read our [Getting Started](#) guide)

## The **console** tool

Piwik comes with a special command line tool that can be used to make development easier. The tool is located in Piwik's root directory and is called **console**. You can run it with the command:

    ./console help

or

    php ./console help

**Libraries Used**

The console app uses the [Symfony Console component](http://symfony.com/doc/current/components/console/introduction.html). It would have been installed when you ran [composer.phar](#) while installing Piwik.

### Commands

The command line tool currently supports commands that generate empty plugins and plugin files, run git commands, watch Piwik's log output, run tests and deal with Piwik translations.

You can view the entire list of commands by running the following command:

    ./console list

To get more information about a single command (such as what arguments it takes), run the following command:

    ./console help <<command>>

where `<<command>>` should be replaced with the command you are interested in.

## Adding new commands

Plugins can extend the command line tool by creating their own commands. To create your own command, create a class that extends [ConsoleCommand](#) and expose it using the [Console.addCommands](#) event.

See the documentation for the class and event mentioned and see the docs for [SymfonyCommand](#) to learn more about how your command should be coded.