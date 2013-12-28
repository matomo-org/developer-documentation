# Getting Started Part I: Setting Up

<!-- Meta (to be deleted)
TODO: (stuff that needs to go in SOME guide)
- DataTable row actions
TODO: removed scheduled reports guide. should be replaced w/ two tutorials (new output format + new transport medium)
-->

## About this guide

So you're a Piwik user and you need Piwik to do something it doesn't do. Or maybe you're a user of another web app and you want to integrate it with this amazing analytics software you've heard so much about (Piwik, naturally). Well, you've come to the right place!

This guide will show you:

- **how to get your development environment setup,**
- **how to create a new Piwik Plugin,**
- **and where to go next to continue building your extension.**

**Guide Assumptions**

This guide assumes that you, the reader, can code in PHP and can setup your own local webserver. If you do not have these skills, you will not be able to successfully understand this guide.

There are many resources on the internet you can use to learn PHP. We recommend reading [these tutorials](http://devzone.zend.com/6/).

## Piwik Plugins

Pretty much all the functionality you see when you use Piwik is provided through **_Piwik Plugins_**. The core of Piwik (unsurprisingly termed _**Piwik Core**_) contains the tools that the plugins use to provide this functionality. If you wanted to add more functionality to Piwik you'd create your own plugin and distribute it on the [Piwik Marketplace](#) so other users could use it.

_Note: If you want to integrate another piece of software with Piwik and you only need to know how to track visits or how to retrieve reports, read more about the [Tracking API](#) and the [Reporting API](#)._

### What's possible with Piwik plugins?

Here are some of the things you could accomplish through your own plugin:

- track new visitor data and create new reports that aggregate the new data
- track third party data and display it in new reports
- show existing reports in novel new ways
- send scheduled reports through new mediums or in new formats

These are only a few of the possibilities. Many of the existing plugins do things that cannot be categorized in such a way. For example, the [Annotations](#) plugin lets users create save notes for dates without needing any modifications to **Piwik Core**. The [DBStats](#) plugin will show users statistics about their MySQL database. The [Dashboard](#) plugin provides a configurable way to view multiple reports at once.

**Whatever ideas your imagination cooks up, we think it's highly probable you can implement them with Piwik.**

### What's not possible with Piwik plugins?

Well, we're not really sure. It might be hard to get your idea to scale, or maybe your idea involves creating some hardware that you have to distribute, but these problems can all be overcome in some way.

**Right now, we think _anything_ is possible with Piwik, and we want YOU to prove us right!**

## Getting setup to extend Piwik

### Get the appropriate tools

Before we start extending Piwik, let's make sure you have the tools you'll need to do so. Make sure you have the following installed:

- **A PHP IDE or a text editor.** We who work on Piwik reccommend you use [PHPStorm](#), a very powerful IDE built specifically for developing in PHP.
- **A webserver,** such as [Apache](#) or [Nginx](#).
- **[git](#)** so you can work with the latest Piwik source code.
- **[composer](http://getcomposer.org/)** so you can install the PHP libraries Piwik uses.
- **A browser,** such as [Firefox](#) or [Chrome](#). Ok, so this you've probably got.

The following tools aren't required for this guide, but you may find them useful when you continue writing your plugin:

- **[PHPUnit](#)** Necessary if you want to write or run automated tests.
- **[xhprof](#)** If you'd like to profile your code and debug any inefficiencies. See also [our guide for installing xhprof](#).
- **[python](#)** If you're going to be doing something with the log importer.

### Get & Install Piwik

Now that you've got the necessary tools, you can install Piwik. First, we'll get the very latest version of Piwik's source code using git.

Open a terminal and `cd` into the directory where you want to install Piwik. Then run the following command:

    $ git clone https://github.com/piwik/piwik piwik

Then run the following command to install some third party libraries:

    $ composer.phar install

Now that you've got a copy of Piwik, you'll need to point your webserver to it. The specific instructions for configuring your webserver depends on the webserver itself. You can see instructions for Apache [here](#) and instructions for Nginx [here](#).

Once your webserver is configured, load Piwik in your browser by going to the URL `http://localhost/`. Complete the installation process by following the instructions presented to you.

#### Adding anonymous access to your reports

Before we finish, we're going to allow anyone to view reports on your new Piwik environment. Open the _Manage > Users_ admin page and click the red icon in the **View** column for the **anonymous** user:

<img src="/img/getting_started_users_manager_anonymous.png"/>

This will make it possible to view raw report data without having to supply a **token_auth**.

#### Installing the VisitorGenerator plugin

Finally, you'll want to install a plugin that will help with development. Within Piwik, go to the _Platform > Marketplace_ admin page. Click on the **installing a new plugin from the Marketplace** link and install the **VisitorGenerator** plugin.

### Add some test data

You've got the necessary tools and Piwik itself. You're ready to create your first plugin now, but before we do that, let's add some test data for you to play with.

In your browser load Piwik and navigate to _Settings > Plugins > Manage_. Look for the _Visitor Generator_ plugin and enable it. Then on the admin menu to the left, click on _Visitor Generator_ (under _Diagnostic_).

On this page you'll see a form where you can select a site and enter a number of days to generate data for:

<img src="/img/visitor_generator_form.png"/>

Let's generate data for three days. Enter **3** in the **Days to compute** field, check the **Yes, I am sure!** checkbox and click **Submit**.

Now click on the **Dashboard** link at the top of the screen. You should see that reports that were previously empty now display some statistics:

<img src="/img/dashboard_after_test_data.png"/>

## Create a plugin

You're development environment is setup, and you are now ready to create a plugin! Creating a plugin consists primarily of creating a couple files. Piwik comes with a handy command-line tool that will do this legwork for you. In the root directory of your Piwik install, run the following command:

    ./console generate:plugin --name="MyPlugin"

When the tool asks if it should create an API & Controller, enter `'y'`. This will create a new plugin named **MyPlugin**.

<div markdown="1" class="alert alert-warning">
**Note**

You can use any name for your plugin, but this guide will assume you've created one named **MyPlugin**. If you use a different name, make sure to change `MyPlugin` to the name you used when copying the code in this guide.
</div>

In your browser load Piwik and navigate to _Settings > Plugins > Manage_. Look for your plugin in the list of plugins, you should see it disabled:

<img src="/img/disabled_my_plugin.png"/>

<a name="plugin-directory-structure"></a>
**Plugin directory structure**

The command-line tool will create a new directory for your plugin (in the **plugins** sub-directory) and fill it with some files and folders. Here's what these files and folders are for:

* **API.php**: Contains your plugin's API class. This class defines methods that serve data and will be accessible through Piwik's [Reporting API](#).
* **Controller.php**: Contains your plugin's Controller class. This class defines methods that generate HTML output.
* **MyPlugin.php**: Contains your plugin's Plugin Descriptor class. This class contains metadata about your plugin and a list of event handlers for Piwik events.
* **plugin.json**: Contains plugin metadata such as the name, description, version, etc.
* **README.md**: A dummy README file for your plugin.
* **javascripts**: This folder is where you'll put all your new JavaScript files.
* **screenshots**: TODO: ???
* **templates**: This folder is where you'll put all your [Twig](http://twig.sensiolabs.org/) templates.

## What to read next

Ok! You've set up your development environment and created your plugin! Now all you have to do is make it do what you want. The bad news is that this is the hard part. The good news is that we've written a bunch of other guides to help you shorten the learning curve.

**_Note: Our guides are great, but if you learn better through examples or just don't want to do a lot of reading, why not check out our [tutorials](#)? We've written one for everything we think you might want to do._**

If you'd like to learn the basics of Piwik plugin development all at once, continue on to the [next part in this series of guides](/guides/getting-started-part-2). If you want to learn how to do just one thing, try reading one of our other guides:

* If you're interested in **creating new analytics reports**, you may want to read our [All About Analytics Data](#) and [Visualizing Report Data](#) guides.
* If you're interested in **changing the look and feel of Piwik**, read our [Theming](#) guide.
* If you're interested in **taking part in core development**, read our [Contributing to Piwik Core](#) guide.
* If you're interested in **integrating Piwik with another technology**, you might want to read our [All About Tracking](#) guide to learn how to use our Tracking API. You might also want to read our [Piwik's HTTP API](#) guide to learn about Piwik's Reporting API.
* If you'd like to **add new console commands**, read our [Piwik on the command line](#) guide.
* If you want to **use automated testing to ensure your plugin works**, read your [Automated Tests](#) guide.

And **make sure to read our security guide, [Security in Piwik](#)**! We have very high security standards that your plugin or contribution **must** respect.

When you've completed your plugin, you can read our [Distributing your plugin](#) guide to learn how to **share your plugin with other Piwik users**.