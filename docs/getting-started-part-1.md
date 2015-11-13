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

You're a Piwik user and you need Piwik to do something it doesn't do. Or maybe you're a user of another web app and you want to integrate it with this amazing analytics software you've heard so much about (Piwik, naturally). Well, you've come to the right place!

This guide will show you:

- **how to get your development environment setup,**
- **how to create a new Piwik Plugin,**
- **and where to go next to continue building your extension.**

**Guide assumptions**

This guide assumes that you can code in PHP and can setup your own local webserver. If you do not have these skills, you will not be able to understand this guide.

There are many resources on the internet to learn PHP. We recommend reading [these tutorials](http://devzone.zend.com/6/). To learn how to setup a webserver read the documentation for your preferred webserver software (for example [Apache](http://www.apache.org/) or [Nginx](http://nginx.org/)).

## Piwik Plugins and Piwik Core

All the functionality you see when you use Piwik is provided by **_Piwik Plugins_**. The core of Piwik (termed _**Piwik Core**_) only contains tools for those plugins.

If you want to add more functionality to Piwik, create your own plugin then distribute it on the [Piwik Marketplace](http://plugins.piwik.org) so others can use it.

_Note: If you want to integrate another piece of software with Piwik and you only need to know how to track visits or how to retrieve reports, read more about [Integrating Piwik in your application](/integration)._

### What is possible with Piwik plugins?

Here are some of the things you can accomplish by creating a plugin:

- track new visitor data and create new reports to aggregate it
- track third party data and display it in new reports
- show existing reports in a new way
- send scheduled reports through new mediums or in new formats

These are only a few of the possibilities. Many of the existing plugins do things that cannot be categorized in such a way. For example, the [Annotations](http://piwik.org/docs/annotations/) plugin lets users add notes for dates without requiring modifications to **Piwik Core**. The DBStats plugin will show users statistics about their MySQL database. The [Dashboard](http://piwik.org/docs/piwik-tour/#dashboard-widgets) plugin provides a configurable way to view multiple reports at once.

**Whatever ideas your imagination cooks up, we think you can implement them with Piwik.**

## Getting setup to extend Piwik

### Get the appropriate tools

Before we start extending Piwik, let's make sure you have the tools needed. You will need the following:

- **A PHP IDE or a text editor.** We recommend to use [PhpStorm](http://www.jetbrains.com/phpstorm/), a powerful IDE built specifically for developing in PHP.

  _Note: we have published our [customized PSR coding style XML file](https://github.com/piwik/piwik/tree/master/misc/phpstorm-codestyles) for PhpStorm that you can use._

- **A webserver,** such as [Apache](http://www.apache.org/) or [Nginx](http://nginx.org/). You can also use [PHP's built-in webserver](http://php.net/manual/en/features.commandline.webserver.php) on your development machine if you have PHP 5.4 or higher installed.
- **A MySQL database**
- **[git](http://git-scm.com/)** so you can work with the latest Piwik source code.
- **[Composer](http://getcomposer.org/)** so you can install the PHP libraries needed by Piwik.
- **A browser,** such as [Firefox](http://www.mozilla.org/en-US/firefox/new/) or [Chrome](http://www.google.com/chrome). Ok, you've probably got this.

The following tools aren't required for this guide, but you may find them useful as you create your plugin:

- **[PHPUnit](http://phpunit.de/)** Necessary if you want to write or run automated tests.
- **[xhprof](https://github.com/facebook/xhprof)** If you'd like to profile your code and debug any inefficiencies.
- **[python](https://www.python.org/)** If you want to use the log importer.

### Get & Install Piwik

We'll get the latest version of Piwik's source code using git.

Open a terminal and `cd` into the directory where you want to install Piwik. Then run the following commands:

    $ git clone https://github.com/piwik/piwik piwik
    $ cd piwik
    $ git submodule update --init

Then run the following command to install the third party libraries:

    $ php composer.phar install

Now that you've got a copy of Piwik, you'll need to point your webserver to it. If you use Apache or Nginx, the specific instructions for configuring your webserver depends on the webserver itself. <!-- TODO: are there instructions for setting up Piwik w/ Apache/nginx? can't find any. (text was: You can see instructions for Apache [here](#) and instructions for Nginx [here](#).)-->

If your PHP version is greater than 5.4, you can also use [PHP's built-in webserver](http://php.net/manual/en/features.commandline.webserver.php) which requires no installation. Simply run the following command:

    $ php -S 0.0.0.0:8000

Piwik should now be available at [http://localhost:8000/](http://localhost:8000/). To stop the webserver, just hit `Ctrl+C`. Remember that PHP's built in webserver is only suitable for development. It should **never** be used in production.

Once Piwik is running, open it in your browser and follow the instructions to complete the installation.

#### Adding anonymous access to your reports

Before we finish, we're going to allow anyone to view reports on your new Piwik environment. Open the _Manage > Users_ admin page and click the red icon in the **View** column for the **anonymous** user:

<img src="/img/getting_started_users_manager_anonymous.png"/>

This will make it possible to view raw report data without having to supply a **token_auth**.


### Enable Development mode

After installing Piwik, we're going to change some of Piwik's INI configuration to make development easier and to make sure all changes take affect immediately. Piwik comes with a handy command-line tool that will do this work for you. In the root directory of your Piwik install, run the following command to enable the development mode:

    ./console development:enable

If you plan on running automated tests, you'll have to set the following configuration options in `config/config.ini.php`:

```ini
[database_tests]
password = ...
user = ...
```

### Add some test data

You're now ready to create your first plugin, but before we do that, let's add some test data for you to play with.

In your browser load Piwik and navigate to _Administration > Plugins_. Look for the _Visitor Generator_ plugin and enable it. Then on the admin menu to the left, click on _Visitor Generator_ (under _Diagnostic_).

On this page you'll see a form where you can select a site and enter a number of days to generate data for:

<img src="/img/visitor_generator_form.png"/>

Let's generate data for three days. Enter **3** in the **Days to compute** field, check the **Yes, I am sure!** checkbox and click **Submit**.

Once the visits have been added, click on the **Dashboard** link at the top of the screen. You should see that reports that were previously empty now display some statistics:

<img src="/img/dashboard_after_test_data.png"/>

## Create a plugin

Your development environment is set up, and you are now ready to create a plugin! Creating a plugin consists primarily of creating a couple of files which can be done by running the following command:

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
- `screenshots/`: Place screenshots of your plugin in this folder in case you want to [distribute it on the Piwik Marketplace](http://developer.piwik.org/guides/distributing-your-plugin).

## What to read next

Ok! You've set up your development environment and created your plugin! Now all you have to do is make it do what you want. The bad news is that this is the hard part. The good news is that we've written a bunch of other guides to help you shorten the learning curve.

- If you're interested in **creating new analytics reports**, you may want to read about [Custom Reports](/guides/custom-reports) and [Visualizing Report Data](/guides/visualizing-report-data) guides.
- If you're interested in **changing the look and feel of Piwik**, read our [Theming](/guides/theming) guide.
- If you're interested in **integrating Piwik with another technology**, you might want to read our [Tracking guides](/guides/tracking-introduction) to learn how to use our Tracking API.
- If you want to **use automated testing to ensure your plugin works**, read your [Automated Tests](/guides/tests) guide.

And **make sure to read our security guide, [Security in Piwik](/guides/security-in-piwik)**! We have very high security standards that your plugin or contribution **must** respect.

When you've completed your plugin, you can read our [Distributing your plugin](/guides/distributing-your-plugin) guide to learn how to **share your plugin with other Piwik users**.
