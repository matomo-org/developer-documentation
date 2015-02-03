---
category: Develop
previous: tests-ui
---
# Running tests on Travis CI

[Travis-CI](http://travis-ci.org) is a continuous integration tool that will run tests for a GitHub repository every time commits are pushed.

## Piwik's tests on Travis CI

Piwik uses Travis to automatically run its test suite on every commit (for every branch and pull request):

- PHP and UI tests are run on the [piwik/piwik](https://travis-ci.org/piwik/piwik/builds) build

  Current status for master branch: [![Build Status](https://travis-ci.org/piwik/piwik.svg?branch=master)](https://travis-ci.org/piwik/piwik)

## Running your plugins tests on Travis CI

Plugins can do the same if they include a `.travis.yml` file in their github repository. You can generate this file using the `generate:travis-yml` console command:

```
$ ./console generate:travis-yml --plugin=MyPlugin
```

The command will automatically detect if you have PHP and/or UI tests in your plugin's `Test/` directory and create a `.travis.yml` file that will run them. The tests will be run against both Piwik `master` branch and against the latest stable version.

**Modifying the .travis.yml file**

The `generate:travis-yml` command will not overwrite the `env:` and `matrix:` sections of an existing .travis.yml file. This means your modifications will be preserved when the file is updated.

### Auto-updating the .travis.yml file

The `generate:travis-yml` command will be changed over time as we modify the travis build process. The generated `.travis.yml` file will check if it is out of date from within travis and let you know by failing the build. In such a case you will have to re-run the command and commit the changes to get the build to run again.

To avoid having to do this you can setup auto-updating by using the `--github-token=` option when calling `generate:travis-yml`. You should supply a [GitHub token](https://help.github.com/articles/creating-an-access-token-for-command-line-use) that has read and write access to the repository the build is for. When a .travis.yml file is found to be out of date, the Travis build will update the file and push a commit using the GitHub token.

*Note: you will need the [travis command line tool](http://blog.travis-ci.com/2013-01-14-new-client/) to setup auto-updating.*

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

  * **TEST\_AGAINST\_PIWIK\_BRANCH**

    This variable can be set to a branch, tag or commit hash in order to test your plugin against it.

    This variable should not be set as a global environment variable, instead it should be added as an entry in your .travis.yml file's `matrix:` section, eg:

    ```
    env:
      matrix:
        - TEST_SUITE=PluginTests MYSQL_ADAPTER=PDO_MYSQL TEST_AGAINST_CORE=2.10.0
    ```

  * **DEPENDENT\_PLUGINS**

    This variable should be set to a space separated list of git repository slugs. Before running tests on travis, these repositories will be cloned. If your plugin depends on other plugins, you can use this variable to make sure your tests pass and/or test as much functionality as possible on travis.

    This variable should be set as a global environment variable, eg:

    ```
    env:
      global:
        - DEPENDENT_PLUGINS="myGithubAccount/myDependentPlugin myGithubAccount/myOtherDependentPlugin"
    ```

  * **TRAVIS\_COMMITTER\_NAME**
  * **TRAVIS\_COMMITTER\_EMAIL**

    These variables control the username and email address used when commiting changes from within a travis build.

    When the .travis.yml file is auto-updated, the travis build will commit the changes and push them to your plugin's git repository. The committer's username and email address are determined by these variable.

    `TRAVIS_COMMITTER_NAME` defaults to `Piwik Automation`. `TRAVIS_COMMITTER_EMAIL` defaults to `hello@piwik.org`.

    Example usage:

    ```
    env:
      global:
        - TRAVIS_COMMITTER_NAME="My Org Automation"
        - TRAVIS_COMMITTER_EMAIL=my-org@myorg.com
    ```

  * **UNPROTECTED\_ARTIFACTS**

    **For core or pro developers only.** This variable controls whether build artifacts will be uploaded to a password protected folder on builds-artifacts.piwik.org or not.

    By default, artifacts for plugins are stored in a protected folder. To change this behavior, set `UNPROTECTED_ARTIFACTS=1` as a global environment variable, eg:

    ```
    env:
      global:
        - UNPROTECTED_ARTIFACTS=1
    ```

### Extending .travis.yml behavior

Plugins that use technologies other than MySQL or PHP may require extra setup and install steps to be executed on travis before running tests.

[LoginLdap](https://github.com/piwik/plugin-LoginLdap), for example, tests itself against a live LDAP server and thus needs to install and setup OpenLDAP on travis. To accomplish this, [LoginLdap](https://github.com/piwik/plugin-LoginLdap) adds extra steps to its generated .travis.yml file.

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

*Note: You cannot simply add these changes by hand to the .travis.yml file since they will be overwritten on the next `generate:travis-yml` execution.*
