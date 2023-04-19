---
category: Develop
previous: tests-js-tracker
next: tests-troubleshooting
---
# Running tests as GitHub Action

[GitHub Actions](https://github.com/features/actions) allow you to perform certain checks and tasks each time a certain action is performed. 

## Matomo's tests as GitHub Actions

Matomo uses GitHub Actions to automatically run its test suite for every pull requests, as well as for every commit to a development branch. All tests are run on the [matomo-org/matomo](https://github.com/matomo-org/matomo/actions/workflows/matomo-tests.yml) actions

Current status for 5.x-dev branch: [![Matomo Tests](https://github.com/matomo-org/matomo/actions/workflows/matomo-tests.yml/badge.svg?branch=5.x-dev)](https://github.com/matomo-org/matomo/actions/workflows/matomo-tests.yml)

Each developer is responsible to keep the build green.

## Running your plugins tests as GitHub Action

Plugins can do the same if they include a GitHub action file in their GitHub repository. You can generate this file using the `generate:test-action` console command:

```
$ ./console generate:test-action --plugin="MyPlugin" --php-versions="7.2,8.1"
```

The command will automatically detect if you have PHP, Client and/or UI tests in your plugin's directory and create a `.github/workflows/matomo-tests.yml` file that will run them. The tests will be run against the minimal required Matomo version, as defined in your `plugin.json`, as well as against the latest development branch or the latest version your plugin is marked as compatible with.

### Varying GitHub action behavior

You can control how the generated action file behaves, by providing certain options to the generator script.

  * **--plugin**

    Allows to specify the name of the plugin you want to generate the action file for. If the option is missing the action file for Matomo itself will be regenerated.


  * **--php-version**

    Allows to specify the PHP versions the tests should be run with. You can provide all versions as a comma separated list. e.g. "7.2,8.1" or "7.2,7.4,8.2"
    
    PHP tests will automatically run against all versions, while UI tests will always be run on the first version provided in the list. 

    We recommend to run UI tests on the minimal require PHP version of your plugin (or Matomo) to ensure everything works.


  * **--dependent-plugins**

    If your plugin requires other plugins, that are not included in the Matomo checkout, you can specify those plugins here. They will be automatically checked out and moved to the `plugins` directory. Plugins need to be provided as a comma separated list of the repository slugs e.g. "matomo-org/plugin-CustomVariables,nickname/PluginName"
   
    For this to work the repositories need to be named with the plugin name only or `plugin-PluginName`

    When using a private repository, the GitHub action requires an access token. This needs to be provided as a repository secret named `TESTS_ACCESS_TOKEN`. The token needs at least read access for the repositories.


  * **--repo-root-dir**

    Allows to specify the directory where the plugin is located. If the plugin is located within the plugins directory of Matomo you can omit this option.


  * **--force-php-tests**

    Forces the generator to include a part to run PHP tests for the plugin. If the option is omitted the Generator will decide to include PHP tests only if there are any PHP test files located in your plugin.


  * **--force-ui-tests** 

    Forces the generator to include a part to run UI tests for the plugin. If the option is omitted the Generator will decide to include UI tests only if there are any UI test files located in your plugin.


  * **--force-client-tests**

    Forces the generator to include a part to run Client tests for the plugin. If the option is omitted the Generator will decide to include Client tests only if there are any Client test files located in your plugin.


  * **--protect-artifacts**

    This option is used for premium plugins only. It advices the artifacts server to hide the uploaded artifacts behind a login.


  * **--setup-script**

    This option allows plugins to provide an additional setup bash script. The provided script will be run right before the tests are executed in the action. 

    [LoginLdap](https://github.com/matomo-org/plugin-LoginLdap), for example, tests itself against a live LDAP server and thus needs to install and setup OpenLDAP. To accomplish this, [LoginLdap](https://github.com/matomo-org/plugin-LoginLdap) provides a custom setup script.


  * **--enable-redis**

    If this option is provided a redis server and a redis sentinal will be setup. Provide this option if your tests require using redis.


  * **--has-submodules**

    Provide tihs option if your plugin contains git submodules that need to be fetched when checking out the plugin. If this option is not provided submodules will be ignored.

### Updating the matomo-tests.yml file

The `generate:test-action` command may be changed over time as we modify the GitHub action process. If you build stops working correctly you may need to re-run the command to update `.github/workflows/matomo-tests.yml`.

### Further details

The generated action for core or any plugin contains a list of jobs that should be executed for each test suite.
Besides checking out the repos code a custom test action will be performed. The performed test action can be found at [https://github.com/matomo-org/github-action-tests](https://github.com/matomo-org/github-action-tests). You can find more details in the [README](https://github.com/matomo-org/github-action-tests#readme).
