---
category: Develop
---
# Setting Up

<!-- Meta (to be deleted)
TODO: (stuff that needs to go in SOME guide)
- DataTable row actions
- removed scheduled reports guide. should be replaced w/ two tutorials (new output format + new transport medium)
-->

## About this guide

If you're a Piwik user and need Piwik to do something it doesn't do; or maybe you use another web app and want to integrate it with this amazing analytics software you've heard so much about (Piwik, naturally) — well, you've come to the right place!

This guide will show you:

- **how to get your development environment set up,**
- **how to create a new Piwik Plugin,**
- **and where to go next to continue building your extension.**

**Guide assumptions**

This guide assumes that you can code in PHP and can set up your own local webserver. If you do not have these skills, you won't be able to understand this guide.

There are many resources on the internet to help you learn PHP. We recommend reading [these tutorials](https://devzone.zend.com/6/). To learn how to set up a web server read the documentation for your preferred web server software (for example [Apache](https://www.apache.org/) or [Nginx](https://nginx.org/)).

## Piwik Plugins and Piwik Core

All the functionality you see when you use Piwik is provided by **_Piwik Plugins_**. The core of Piwik (termed _**Piwik Core**_) only contains tools for those plugins.

If you want to add more functionality to Piwik, create your own plugin then distribute it on the [Piwik Marketplace](https://plugins.matomo.org) so that others can use it.

_Note: If you want to integrate another piece of software with Piwik and you only need to know how to track visits or how to retrieve reports, read more about [Integrating Piwik in your application](/integration)._

### What is possible with Piwik plugins?

You can accomplish the following by creating a plugin:

- track new visitor data and create new reports to aggregate it
- track third party data and display it in new reports
- show existing reports in a new way
- send scheduled reports through new mediums or in new formats

These are only a few of the possibilities — it is not possible to categorize all the existing plugins' functionality simply because of the vast differences in their use cases. For example, the [Annotations](https://matomo.org/docs/annotations/) plugin lets users add notes for dates without requiring modifications to **Piwik Core**. The DBStats plugin will show users statistics about their MySQL database. The [Dashboard](https://matomo.org/docs/matomo-tour/#dashboard-widgets) plugin provides a configurable way to view multiple reports at once.

**Whatever ideas your imagination cooks up, we think you can implement them with Piwik.**

<div markdown="1" class="alert alert-info">
If you can't think of an idea for a plugin, you can check the *[New plugin](https://github.com/matomo-org/matomo/labels/c%3A%20New%20plugin)* label on Github or [adopt an existing, not maintained plugin](https://forum.matomo.org/t/adopt-a-plugin-dog/26869).
</div>

## Getting setup to extend Piwik

### Get the appropriate tools

Before we start extending Piwik, let's make sure you have the tools needed. You will need the following:

- **A PHP IDE or a text editor.** We recommend using [PhpStorm](https://www.jetbrains.com/phpstorm/), a powerful IDE built specifically for developing in PHP.
- **A webserver,** such as [Apache](https://www.apache.org/) or [Nginx](https://nginx.org/). You can also use [PHP's built-in webserver](https://secure.php.net/manual/en/features.commandline.webserver.php) on your development machine if you have PHP 5.4 or higher installed.
- **A MySQL database**
- **[git](https://git-scm.com/)** so you can work with the latest Piwik source code.
- **[Composer](https://getcomposer.org/)** so you can install the PHP libraries needed by Piwik.
- **A browser,** such as [Firefox](https://www.mozilla.org/en-US/firefox/new/) or [Chrome](https://www.google.com/chrome). Ok, you've probably got this.

The following tools aren't required for this guide, but you may find them useful as you create your plugin:

- **[PHPUnit](https://phpunit.de/)** Necessary if you want to write or run automated tests.
- **[xhprof](https://github.com/facebook/xhprof)** If you'd like to profile your code and debug any inefficiencies.
- **[python](https://www.python.org/)** If you want to use the log importer.

### Command to get the tools on Linux

If your computer is using a Debian based operating system, you can install all the required packages with the following command:

<!-- NOTE TO YOU see below -->

    $ sudo apt-get install php php-curl php-gd php-cli mysql-server php-mysql php-xml php-mbstring

<!-- NOTE TO YOU :-) Please also update the instructions here: https://matomo.org/docs/requirements/ -->


### Get & Install Matomo

We'll get the latest version of Matomo's source code using git.

Open a terminal, `cd` into the directory where you want to install Matomo, and then run the following commands (without the leading `$`):

    $ git clone https://github.com/matomo-org/matomo matomo
    $ cd matomo
    $ git submodule update --init

### Get & install Composer

Next, we will install all the libraries that Piwik needs using Composer.

 * Follow the [download instructions for Composer](https://getcomposer.org/download/) in order to get composer on your machine

 * Then run this command to download all PHP packages that Piwik requires:

        $ php composer.phar install

 On Windows, you will likely need to add an option `--no-script`:

        $ php composer.phar install --no-script

### Get a web server

Now that you've got a copy of Piwik, you'll need to point your web server to it. If you use Apache or Nginx, the specific instructions for configuring your web server depend on the web server itself.

If your PHP version is greater than 5.4, you can also use [PHP's built-in web server](https://secure.php.net/manual/en/features.commandline.webserver.php) which requires no installation. Simply run the following command:

    $ php -S 0.0.0.0:8000

Piwik should now be available at [http://localhost:8000/](http://localhost:8000/). To stop the web server, just hit `Ctrl+C`. Remember that PHP's built in web server is only suitable for development. It should **never** be used in production.

### Install MySQL and create a database

When you install Piwik, at the database creation step, you will need to specify your database user. 

[-> Click here to see how to create a new user in MySQL](https://matomo.org/faq/how-to-install/faq_23484/).


In Ubuntu systems running MySQL 5.7 (and later versions), the root MySQL user is set to authenticate using the `auth_socket` plugin by default rather than with a password. To use a password to connect to MySQL as root, you will need to switch its authentication method to `mysql_native_password`. To configure the root account to authenticate with a password, run the following ALTER USER command, and replace `my secure password` by a secure password:

```sql
ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'my secure password';
```

### Install Matomo

Once Piwik is running, open it in your browser and follow the instructions to complete the installation.


#### Adding anonymous access to your reports

Before we finish, we're going to allow anyone to view reports on your new Piwik environment. Open the Administration dashboard (click on the cog icon), go to _System > Users_ page and choose **View** in the **Role** column for the **anonymous** user:

<img src="/img/getting_started_users_manager_anonymous.png"/>

This will make it possible to view raw report data without having to supply a **token_auth**.


### Enable Development mode

After installing Piwik, we're going to change some of Piwik's INI configuration to make development easier and to make sure all changes take effect immediately. Piwik comes with a handy command-line tool that will do this work for you. In the root directory of your Piwik install, run the following command to enable development mode:

    ./console development:enable


### Add some test tracking data in your Piwik

You're now ready to create your first plugin, but before we do that, let's add some test data for you to play with.

In your browser, load Piwik and navigate to  _Platform > Marketplace_ on the Administration dashboard. Look for the "Visitor Generator" plugin and enable it. Then on the admin menu to the left, click on _Development > Visitor Generator_.

On this page you'll see a form where you can select a site and enter a number of days to generate data for:

<img src="/img/visitor_generator_form.png"/>

Let's generate data for three days. Enter **3** in the **Days to compute** field, check the **Yes, I am sure!** checkbox and click **Submit**.

Once the visits have been added, click on the **Dashboard** link at the top of the screen. You should see that reports which were previously empty now display some statistics:

<img src="/img/dashboard_after_test_data.png"/>

### If you want to execute the automated test suite

Make sure you have pulled Matomo's source code using git, an installation from an archive does not support running automated tests.

Set the following configuration options in `config/config.ini.php`:

```ini
[database_tests]
host = "127.0.0.1"
username = ...
password = ...
```

You also may have to create the `matomo_tests` database:
```
mysql -u'db_username_here' -p -e 'CREATE DATABASE matomo_tests'
```

The configured DB user for the tests should also have privileges to create and drop databases.

For more detailed instructions you can visit the [PHP Tests page](/guides/tests-php).

## Create a plugin

Your development environment is set up, and you are now ready to create a plugin! 

First of all, you need to choose the plugin's name. Remember, if you're going to publish on [Matomo's marketplace](https://plugins.matomo.org/), CamelCase will be splitted into words. So, for example "MyPlugin" will be published as "My Plugin".

Creating a plugin consists primarily of creating a couple of files which can be done by running the following command:

    ./console generate:plugin --name="MyPlugin"

This will create a new plugin named **MyPlugin**.

<div markdown="1" class="alert alert-info">
You can use any name for your plugin, but this guide will assume you've created one named **MyPlugin**. If you use a different name, make sure to change `MyPlugin` to the name you used when copying the code in this guide.
</div>

In your browser load Piwik and navigate to *Administration > Plugins*. Look for your plugin in the list of plugins, you should see it disabled:

<img src="/img/disabled_my_plugin.png"/>

To enable it, either do it through the web interface or use the command line:

    ./console plugin:activate MyPlugin

**Plugin directory structure**

The command-line tool will create a new directory for your plugin (in the **plugins** sub-directory) and fill it with some files and folders. Here's what these files and folders are for:

- `MyPlugin.php`: Contains your plugin's descriptor class. This class contains metadata about your plugin and a list of event handlers for [Piwik events](/guides/events).
- `plugin.json`: Contains plugin metadata such as the name, description, version, etc.
- `README.md`: A dummy README file for your plugin.
- `screenshots/`: Place screenshots of your plugin in this folder in case you want to [distribute it on the Piwik Marketplace](https://developer.matomo.org/guides/distributing-your-plugin).

## What to read next

Ok! You've set up your development environment and created your plugin! Now all you have to do is make it do what you want. The bad news is that this is the hard part. The good news is that we've written a bunch of other guides to help you shorten the learning curve.

- If you're interested in **creating new analytics reports**, you may want to read about [Custom Reports](/guides/custom-reports) and [Visualizing Report Data](/guides/visualizing-report-data) guides.
- If you're interested in **changing the look and feel of Piwik**, read the [Theming](/guides/theming) guide.
- If you're interested in **integrating Piwik with another technology**, you might want to read the [Tracking guides](/guides/tracking-introduction) to learn how to use the Tracking API.
- If you want to **use automated testing to ensure your plugin works**, read the [Automated Tests](/guides/tests) guide.

And **make sure to read our security guide, [Security in Piwik](/guides/security-in-piwik)**! We have very high security standards that your plugin or contribution **must** respect.

When you've completed your plugin, you can read the [Distributing your plugin](/guides/distributing-your-plugin) guide to learn how to **share your plugin with other Piwik users**.
