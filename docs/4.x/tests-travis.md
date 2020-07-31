---
category: Develop
previous: tests-ui
---
# Running tests on Travis CI

[Travis-CI](https://travis-ci.org) is a continuous integration tool that will run tests for a GitHub repository every time commits are pushed.

## Matomo's tests on Travis CI

Piwik uses Travis to automatically run its test suite on every commit (for every branch and pull request). PHP and UI tests are run on the [matomo-org/matomo](https://travis-ci.org/matomo-org/matomo/builds) build

Current status for master branch: [![Build Status](https://travis-ci.org/matomo-org/matomo.svg?branch=master)](https://travis-ci.org/matomo-org/matomo)

## Running your plugins tests on Travis CI

Plugins can do the same if they include a `.travis.yml` file in their github repository. You can generate this file using the `generate:travis-yml` console command:

```
$ ./console generate:travis-yml --plugin=MyPlugin
```

The command will automatically detect if you have PHP and/or UI tests in your plugin's `Test/` directory and create a `.travis.yml` file that will run them. The tests will be run against both Piwik `master` branch and against the latest stable version.

### Updating the .travis.yml file

The `generate:travis-yml` command will be changed over time as we modify the travis build process. The generated `.travis.yml` file will check if it is out-of-date from within travis and let you know by failing the build. In such a case you will have to re-run the command and commit the changes to get the build to run again.

### Varying .travis.yml behavior

You can control how the generated .travis.yml file behaves, by setting certain environment variables in your .travis.yml file.

These variables let you download other, test your plugin against a specific Piwik version and more.

Below is the list of all supported environment variables:

  * **TEST\_AGAINST\_CORE**

    This variable can be set to `minimum_required_piwik` to test against the required Piwik version specified in your plugin's plugin.json manifest.

    This variable should not be set as a global environment variable, instead it should be added as an entry in your .travis.yml file's `matrix:` section, eg:

    ```
    env:
      matrix:
        - TEST_SUITE=PluginTests MYSQL_ADAPTER=PDO_MYSQL TEST_AGAINST_CORE=minimum_required_piwik
    ```

    By default, one build will run the PHP tests against the minimum required Piwik version.

  * **PIWIK\_TEST\_TARGET**

   This variable can be used to specify an exact Piwik version number / branch or the `maximum_supported_piwik` the test should run against. By specifying `maximum_supported_piwik` your tests will automatically run against the highest supported Piwik version number in your `plugin.json`. If no maximum Piwik version is specified, the tests will automatically run against the latest beta. To specify a max version in `plugin.json` you can eg specify `"require": {"piwik": ">=2.15.0-rc1,<=2.15.1-b11"}`. In this case max supported version is `2.15.1-b11`. For more information on how to specify supported Piwik versions in your plugin have a look at the [distributing your Piwik plugin](https://developer.matomo.org/guides/distributing-your-plugin#prepare-your-plugin) guide.

    This variable should be set as a global environment variable, eg:

    ```
    env:
      global:
        - PIWIK_TEST_TARGET="maximum_supported_piwik"  // run test against max supported version...
        - PIWIK_TEST_TARGET="2.15.0"  // ... or against a specific version
    ```


  * **DEPENDENT\_PLUGINS**

    This variable should be set to a space separated list of git repository slugs. Before running tests on travis, these repositories will be cloned. If your plugin depends on other plugins, you can use this variable to make sure your tests pass and/or test as much functionality as possible on travis.

    This variable should be set as a global environment variable, eg:

    ```
    env:
      global:
        - DEPENDENT_PLUGINS="myGithubAccount/myDependentPlugin myGithubAccount/myOtherDependentPlugin"
    ```
    
    Should a dependent plugin be from a private repository, then you need to go Travis and select the build for your plugin (the plugin you are wanting to run the tests for, not the dependent plugin). Next go to "Settings". In the "Environment Variables" section add a new variable named "GITHUB_USER_TOKEN" and specify the token. Make sure to have the setting "DISPLAY VALUE IN BUILD LOG" disabled so the token value won't be visible to others. You can generate this github user token by going to https://github.com/settings/tokens and generating a new token. Make sure to select all checkboxes in the "repo" scope.

### Extending .travis.yml behavior

Plugins that use technologies other than MySQL or PHP may require extra setup and install steps to be executed on travis before running tests.

[LoginLdap](https://github.com/matomo-org/plugin-LoginLdap), for example, tests itself against a live LDAP server and thus needs to install and setup OpenLDAP on travis. To accomplish this, [LoginLdap](https://github.com/matomo-org/plugin-LoginLdap) adds extra steps to its generated .travis.yml file.

To add extra steps to your plugin's .travis.yml file, create a `/tests/travis` folder inside your plugin and add one or more of the following special .yml files:

  * before_install.before.yml
  * before_install.after.yml
  * install.before.yml
  * install.after.yml
  * before_script.before.yml
  * before_script.after.yml
  * after_script.before.yml
  * after_script.after.yml
  * after_success.before.yml
  * after_success.after.yml

The contents of the `XXX.before.yml` files will be prepended to the specific section in your .travis.yml file, while the contents of the `XXX.after.yml` files will be appended.
