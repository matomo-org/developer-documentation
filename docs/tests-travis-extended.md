---
category: CoreDevelop
previous: tests-ui
---
# Travis CI: Extended

### Auto-updating the .travis.yml file

The `generate:travis-yml` command will be changed over time as we modify the travis build process. To avoid having to 
update the travis file manually you can setup auto-updating by using the `--github-token=` option when calling `generate:travis-yml`. You should supply a [GitHub token](https://help.github.com/articles/creating-an-access-token-for-command-line-use) that has read and write access to the repository the build is for. When a .travis.yml file is found to be out of date, the Travis build will update the file and push a commit using the GitHub token.

*Note: you will need the [travis command line tool](http://blog.travis-ci.com/2013-01-14-new-client/) to setup auto-updating.*

### Varying .travis.yml behavior

You can control how the generated .travis.yml file behaves, by setting certain environment variables in your .travis.yml file.

These variables let you download other, test your plugin against a specific Piwik version and more.

Below is the list of all supported environment variables:

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

  * **TEST\_AGAINST\_PIWIK\_BRANCH**

    This variable can be set to a branch, tag or commit hash in order to test your plugin against it.

    This variable should not be set as a global environment variable, instead it should be added as an entry in your .travis.yml file's `matrix:` section, eg:

    ```
    env:
      matrix:
        - TEST_SUITE=PluginTests MYSQL_ADAPTER=PDO_MYSQL TEST_AGAINST_PIWIK_BRANCH=branchname
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
