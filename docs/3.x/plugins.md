# Implementing a plugin
## CLI tool
Piwik comes with a powerful command line tool to help you generating a plugin easily. The command line tool is called "console" and is located in the Piwik root directory.
To get familiar with the command line tool enter either `./console` or `php console`. As you haven't specified any command yet, it will list you all available commands along with their descriptions. 
The most interesting commands for developers are:

* `generate:plugin`
* `generate:theme`
* `generate:api`
* `generate:controller`
* `generate:test`
* `generate:visualizationplugin`
* `log:watch`
* `tests:run`

To execute a specific command just enter the name of the command as an argument:

`./console log:watch`

Some of the commands require further arguments or options. Use `help` to see which ones are available for a specific command:

`./console help generate:plugin`

Some of the arguments and options are required, whereas other are optional. If you do not specify a value, the command line tool will ask you to enter the missing values. So you do not have to care much about arguments and options. Easy!

### Creating a plugin
Execute the command `./console generate:plugin` in order to create a new plugin. The CLI tool will ask you to enter a name, a description and a version number. This creates a very basic plugin for you including all the necessary files. If you already know that you need a Controller and an API, the console tool can create those for you as well. 

## Building the plugin
### Namespaces
### Defining new widgets
### Defining new menus
### Using the database
#### Create a new table
#### Update schema

### Track additional data
### Understanding Hooks

#### Register an action for a given hook
If you want to listen to a specific event, and trigger your own function when this event is posted, you have to define a method `registerEvents()` in your plugin class, that will return an array containing pair of (hook name, method to call).

For example if you want to execute your function `AddCityInformation()` when a new visitor is recorded by Piwik (hook `Tracker.newVisitorInformation`), in your class `MyPlugin` you would define a method:

<pre><code>function registerEvents()
{
    return array( 'Tracker.newVisitorInformation' => 'AddCityInformation' );
}</code></pre>

The hook `Tracker.newVisitorInformation` has an argument: an array containing the visitor’s information. You can add new elements to this array. Example:

<pre><code>function AddCityInformation( &$visitorInfo )
{
    // we modify the variable, adding the new city field
    $visitorInfo['city'] = 'Paris, France';
}</code></pre>

You can have a look at the [provider plugin](https://github.com/piwik/piwik/blob/master/plugins/Provider/Provider.php#L31) to see an example of a plugin registering actions for multiple hooks.

Piwik also provides a means of dynamic hook registration using `Piwik_AddAction($eventName, $callback)`.

#### Add a new hook
Plugins can themselves post new events, the same way Piwik posts events. A common example is custom page headers and footers (on a per plugin basis).

```
Piwik_PostEvent( $eventName,  [ $object , [ $info ]])
```

or in Twig templates:

```
{{ postEvent($eventName) }}
```
By convention, the event name should be prefixed by the Plugin name.

### Understanding Archiving
### How to create an API

Start by using the CLI tool to create the needed files: `./console generate:api`. This script creates a file named `API.php` within your plugin.

Each public method within this class will be accessible over the API. Adding new actions is as easy as creating a new function, accepting any input parameter you need and returning any value.

#### Filename API.php, public/private
#### Getting data from another API
#### Returning data as an array or DataTable
#### Authenticate users

### Creating a console command

In order to enrich the [Piwik CLI tool](#cli-tool) your plugin can create an unlimited number of console commands. For example a particular plugin could provide long running administrative tasks via the console.

We recommend to use the CLI tool to create a command:

`./console generate:command`

This will create a command for you and place it in the `Commands` directory of your plugin. Afterwards you have to register the command by subscribing to a hook. Read more about this in the [Hooks reference](/api-reference/hooks#consoleaddcommands).

If you are interested in learning more about writing commands, read the [Symfony Commands documentation](https://symfony.com/doc/current/components/console.html).

### Writing tests for your plugin
We are sure you love tests as much as we do. That's why we want to make it as easy as possible for you to write tests. 

#### Generating a test class

To create a test we highly recommend to use our [cli tool](#cli-tool). You can create a new test to executing the following command:

`./console generate:test`

Enter your plugin name as well as a test name and you can already start writing beautiful tests. The command will generate a `tests` folder within your plugin directory if it does not already exist and create a test file containing a dummy test depending on the entered test name.

#### Creating different kind of tests

You can write three different types of tests for your plugin: 

 * Unit test
 * Integration test
 * Integration test that needs a database

By default we create a unit test for you. But there is an optional option to directly create a different kind of test:

 * `./console generate:test -t "unit"`
 * `./console generate:test -t "integration"`
 * `./console generate:test -t "database"`

#### Executing tests

To execute all your plugin tests simply run the following command:

`./console tests:run PluginName`

Do not forget to replace `PluginName` with your plugin name. Note: The plugin name is case sensitive. 

You can run a single test file as well by executing the following command:

`./console tests:run Testname`

The testname is case sensitive as well. 

### How to create a Controller

Start by using the CLI tool to create the needed files: `./console generate:controller`. This script creates a file named `Controller.php` within your plugin. The Controller already comes with a default action and template which is located in the `templates` directory.

Each public method within the controller will be accessible over the Piwik UI.

MVC intro, uses of a controller 
#### Useful helpers 
parent:: methods, checkUser* auth helpers, ...
### How to add settings to the plugin
### How to use other APIs
#### API.php: getting data and modifying it
#### Controller.php: getting data and displaying it in a View
#### Controller.php: calling API for admin action
### Defining a new segment
### Make your custom reports visible in Email reports & Piwik Mobile
## Persisting data
#### Hint: Do not create any files in your plugins folder, it will be deleted on update --> use for instance tmp instead
## Templating
### Styling
### Scheduled Tasks
### Translating your plugins
## Security

*This page aims to provide a quick reference on how to secure your PHP code, when developing Piwik Plugins*

### Always load the GET/POST/etc. using Piwik_Common::getRequestVar()

To be protected against Cross Site Scripting (XSS) you need to load all external variables using the function `Piwik::getRequestVar()`.

Example: If you have a URL that looks like

<pre><code>piwik/index.php?module=Home&date=yesterday</code></pre>

If you want to read the `$_GET['date']` value, don't read it directly but use `Piwik_Common::getRequestVar('date')`

* see `Piwik_Common::getRequestVar()` implementation for more details
* see `Piwik_Common::sanitizeInputValues()` if you simply want to clean a given value (not coming from GET/POST/etc.) against XSS. Note that `Piwik_Common::getRequestVar()` calls `Piwik_Common::sanitizeInputValues()`.

### Use the Piwik functions & bind parameters to execute SQL queries

SQL injections make it possible for attackers to modify certain unsafe SQL queries, your script executes, in such a way that it could alter data in your database or give out sensible data to the attacker. That is because of unvalidated user input.

Take a look at this code:

<pre><code>&lt;?php
    $idsite = $_GET['value'];
    Piwik_Query( "SELECT * FROM ".Piwik_Common::prefixTable('site')." WHERE idsite = $idsite" );
</code></pre>

An attacker could hand over a string like `1 OR 1`, the query results in `"SELECT * FROM piwik_site WHERE idsite = 1 OR 1"`, thus returning all rows from piwik_site. We're not going into details here, SQL injections are covered quite well on the web. Please take a look at the resources listed at the bottom of this post.

To safely execute SQL queries in Piwik, you have to **bind all the parameters passed to the SQL queries**. Use the following helper functions and provide query parameters using the `$parameters` array.

* `function Piwik_Query( $sqlQuery, $parameters = array())`
* `function Piwik_FetchAll( $sqlQuery, $parameters = array())`
* `function Piwik_FetchOne( $sqlQuery, $parameters = array())`

Example of binded parameters with `Piwik_FetchOne`

<pre><code>&lt;?php
$feedburnerFeedName = Piwik_FetchOne('SELECT feedburnerName
    FROM '.Piwik_Common::prefixTable('site').
    ' WHERE idsite = ? and name = ?',
    array( Piwik_Common::getRequestVar('idSite'), Piwik_Common::getRequestVar('name') )
);
</code></pre>

### Secure your software against remote file inclusion

Consider the following code:

<pre><code>&lt;?php
// $lib_dir is an optional configuration variable
include($lib_dir . "functions.inc");
</code></pre>

or worse still:

<pre><code>&lt;?php
// $page is a variable from the URL
include($page);
</code></pre>

The user could set the `$lib_dir` or `$page` variables and include files such as `/etc/passwd` or remote files such as [http://www.example-hacker-website.example/whatever.php](http://www.example-hacker-website.example/whatever.php) with malicious code. This malicious code could potentially delete files, corrupt databases, or change the values of variables used to track authentication status.

When using functions such as `readfile, fopen, file, include, require` using user data, you must be careful!

**Possible solutions**

* Are you sure you really need to use a user value to include a new file?
* If yes, check the file name against a list of valid file names. For example,

<pre><code>&lt;?php
$valid_pages = array(
    "apage.php"   => "",
    "another.php" => "",
    "more.php"    => ""
);

if (!isset($valid_pages[$page])) {
    // Abort the script
    die("Invalid request");
}
</code></pre>

* If you must really use a variable from the browser, check the variable's value using code like the following:

<pre><code>&lt;?php
if (!(eregi("^[a-z_./]*$", $page) && !eregi("\\.\\.", $page))) {
    // Abort the script
    die("Invalid request");
}
</code></pre>

### Secure your software against direct access

The files of your plugins will usually be called by Piwik. Piwik is a wrapper around your software, it provides many useful features like user authentication and so on. Since developers usually test their plugins only through Piwik, they tend to forget about the possibility of calling files directly. Instead of calling your plugin by

    http://yoursite.com/piwik/index.php?module=YourPlugin

crackers also might try to use

    http://yoursite.com/piwik/plugins/YourPlugin/YourPlugin.php

As you can see, the PHP file will be executed directly, without Piwik as a wrapper around it. Now, if your file only contains some classes or functions, but does not execute any code, there is nothing wrong about that:

Example class

<pre><code>&lt;?php
class myClass {
    [SomeFunctionsHere]
}
function myFunction() {
    [SomeCodeHere]
}
</code></pre>

The cracker would just see an empty page when accessing your file directly. But if that PHP file actually executes anything, he would probably see a bunch of error messages, revealing important details of your system. Under some circumstances, he might also be able to execute any code he wants to, on your system!

Conclusion: To make your plugin secure against direct access, insert this code line into the beginning of every PHP file that executes code:

<pre><code>&lt;?php
// no direct access
defined('PIWIK_INCLUDE_PATH') or die('Restricted access');
// your code here
</code></pre>

This is a recommendation for any PHP file that allows for direct execution. If in doubt, use the above!

### Other tips

* Make sure that accessing your files directly doesn't execute any function that could have an impact.
* Use `.php` extension for all your PHP scripts
* Avoid executing php code using one of the following functions: `eval(), exec(), passthru(), system(), popen(), preg_replace()` with "e" modifier
* Make sure your code doesn't rely on `register_globals` set to `On`, which should be the case because PHP5 has `register_globals = Off` by default
* If your plugin has Admin settings (e.g., your template includes CoreAdminHome/templates/header.tpl) then your Controller should extend `Piwik_Controller_Admin`.
* Some servers will disable PHP functions for (undisclosed) security reasons. Replacement functions can sometimes be found in libs/upgradephp/upgrade.php, including `_parse_ini_file()`, `_glob()`, `_fnmatch()`, and `_readfile()`. The functions `safe_serialize()` and `safe_unserialize()` are like the built-in functions, but won't serialize/unserialize objects.

### References

* [Top 10 Security from The Open Web Application Security Project (OWASP)](https://www.owasp.org/index.php/Top_10_2007)
* Top 10 php security list [part 1](http://www.onlamp.com/pub/a/php/2003/03/20/php_security.html), [part 2](http://www.onlamp.com/pub/a/php/2003/04/03/php_security.html?CMP=AFC-ak_article&ATT=Ten+Security+Checks+for+PHP%2c+Part+2)

#### Handle user/untrusted input
#### Handling output
### Release in Marketplace
## Limitations
