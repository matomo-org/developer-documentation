---
category: Develop
subGuides:
  - plugin-settings
  - piwiks-ini-configuration
---
# Configuration

## About this guide

**Read this guide if**

* you'd like to know **how the INI configuration system works**
* you'd like to know **how your plugin can define its own configuration settings**

**Guide assumptions**

This guide assumes that you:

* can code in PHP,
* and have a general understanding of extending Piwik (if not, read our [Getting Started](/guides/getting-started-part-1) guide).

## Piwik Configuration

Piwik uses two methods to store configuration settings:

- **INI files** in the `config/` folder
- **Options** which are persisted to the database

These methods are used by **Piwik Core** and should not be used by plugins. Plugins use a separate method of configuration [described here](/guides/plugin-settings).

### INI configuration

INI configuration is explained in the [INI configuration](/guides/piwiks-ini-configuration) guide.

### Options

Some Piwik configuration settings are stored as **Options**. Options are just key value pairs persisted in the database. To learn more about options, read the documentation of the [Option](/api-reference/Piwik/Option) class.

*To learn about how options are persisted in the MySQL backend, read about the [Piwik database schema](/guides/database-schema).*
