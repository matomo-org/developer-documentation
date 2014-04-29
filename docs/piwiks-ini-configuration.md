# Piwik's INI Configuration

## About this guide

**Read this guide if**

* you'd like to know **how INI configuration values are defined and loaded**

**Guide assumptions**

This guide assumes that you:

* can code in PHP,
* and have a general understanding of extending Piwik (if not, read our [Getting Started](/guides/getting-started-part-1) guide).

### The INI files

INI configuration options are stored in both the **config/config.ini.php** and **config/global.ini.php** files. The **global.ini.php** file contains the default values for configuration options. If an option does not exist in **config.ini.php** the value in **global.ini.php** is used.

Plugins and other code can access and modify INI config options using the [Piwik\Config](/api-reference/Piwik/Config) singleton.

_To learn more about individual configuration options, read the documentation in [global.ini.php](#https://github.com/piwik/piwik/blob/master/config/global.ini.php)._

#### INI file structure

The INI config options are grouped into different sections. Sections are declared in the INI configuration with surrounding brackets, for example:

    [ini]

    [MySection]
    my_config_value = 1

An option can be used to store multiple items by appending **[]** to the name and setting it more than once, for example:

    [ini]

    [MySection]
    myarray[] = 1
    myarray[] = 2
    myarray[] = 3

### Reading INI configuration

The [Config](/api-reference/Piwik/Config) singleton allows PHP code to access whole configuration sections. They are accessed as if they were named public fields of the [Config](/api-reference/Piwik/Config) singleton. 

For example, the following code will output every config option in the [General] section:

    for (Config::getInstance()->General as $name => $value) {
        echo "Option $name == " . print_r($value, true);
    }

### Modifying INI configuration

Configuration options can be modified in memory through the [Config](/api-reference/Piwik/Config) singleton in the same way they are set:

    Config::getInstance()->General['disable_merged_assets'] = 1;

To persist these changes so they will appear in the INI files, call the [forceSave](/api-reference/Piwik/Config#forcesave) method:

    Config::getInstance()->forceSave();

### Adding new configuration options

**Plugins cannot add new configuration options.** If you are creating a core contribution and want to add a new INI option, you can simply add the option and its default value to **global.ini.php**.

If you want to make your plugin configurable, create a [Plugin Setting](/guides/piwik-configuration#plugin-configuration).