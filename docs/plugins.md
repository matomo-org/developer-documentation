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
#### Update schemaf
### Track additional data
### Understanding Hooks

#### Register an action for a given hook
If you want to listen to a specific event, and trigger your own function when this event is posted, you have to define a method `getListHooksRegistered()` in your plugin class, that will return an array containing pair of (hook name, method to call).

For example if you want to execute your function `AddCityInformation()` when a new visitor is recorded by Piwik (hook `Tracker.newVisitorInformation`), in your class `MyPlugin` you would define a method:

```
function getListHooksRegistered()
{
    return array( 'Tracker.newVisitorInformation' => 'AddCityInformation' );
}
```

The hook `Tracker.newVisitorInformation` has an argument: an array containing the visitor’s information. You can add new elements to this array. Example:

```
function AddCityInformation( &$visitorInfo )
{
    // we modify the variable, adding the new city field
    $visitorInfo['city'] = 'Paris, France';
}
```

You can have a look at the [provider plugin](https://github.com/piwik/piwik/blob/master/plugins/Provider/Provider.php#L31) to see an example of a plugin registering actions for multiple hooks.

Piwik also provides a means of dynamic hook registration using `Piwik_AddAction($eventName, $callback)`.

#### Add a new hook
Plugins can themselves post new events, the same way Piwik posts events. A common example is custom page headers and footers (on a per plugin basis).

```
Piwik_PostEvent( $eventName,  [ $object , [ $info ]])
```

or in Twig templates:

```
{{ '{{ postEvent($eventName) }}' }}
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

`./console generate:test -t "unit"`
`./console generate:test -t "integration"`
`./console generate:test -t "database"`

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
#### Handle user/untrusted input
#### Handling output
### Release in Marketplace
## Limitations
