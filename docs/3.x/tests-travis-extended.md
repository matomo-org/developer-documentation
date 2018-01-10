---
category: DevelopInDepth
previous: tests-ui
---
# Travis CI: Extended

### Setting up Travis CI for core plugins

To add a build on travis you must first enable the build on travis-ci.org or magnum.travis-ci.com (or find someone with sufficient permission to do it for you). Then, you must create the .travis.yml file for your plugin by running the following Piwik console command:

    ./console generate:travis-yml --plugin=MyNewPlugin

After you have executed this and committed to the repository, please send an email to Matthieu A. or Benaka, they will execute the same command with the `--github-token` and `--artifacts-pass` parameter. This will ensure that the `.travis.yml` will automatically update itself when [the template](https://github.com/matomo-org/matomo/blob/master/plugins/TestRunner/templates/travis.yml.twig) has changed. 

### Varying .travis.yml behavior

You can control how the generated .travis.yml file behaves, by setting certain environment variables in your .travis.yml file.

These variables let you download other, test your plugin against a specific Piwik version and more.

Below is the list of all supported environment variables:

  * **TEST\_AGAINST\_PIWIK\_BRANCH**

    This variable can be set to a branch, tag or commit hash in order to test your plugin against it.

    This variable should not be set as a global environment variable, instead it should be added as an entry in your .travis.yml file's `matrix:` section, eg:

    ```
    env:
      matrix:
        - TEST_SUITE=PluginTests MYSQL_ADAPTER=PDO_MYSQL TEST_AGAINST_PIWIK_BRANCH=branchname
    ```
    
  * **PROTECTED\_ARTIFACTS**

    This variable controls whether build artifacts will be uploaded to a password protected folder on builds-artifacts.piwik.org. If you are building a plugin and need your artifacts protected, please [contact the Piwik team](https://piwik.org/contact/) to learn more.

    By default, artifacts for plugins are stored in a public folder. To change this behavior, set `PROTECTED_ARTIFACTS=1` as a global environment variable, eg:

    ```
    env:
      global:
        - PROTECTED_ARTIFACTS=1
    ```
  * **SKIP\_COMPOSER\_INSTALL**

    If set to 1, the `composer install` step will be skipped. This can be used to speed up builds that don't need composer install.

    Can be set as a global environment variable for all builds or in the matrix for individual builds.

  * **SKIP\_INSTALL\_MYSQL\_56**

    If set to 1, MySQL 5.6 will not be installed on travis. This can be used to speed up builds that don't need MySQL 5.6.

    Can be set as a global environment variable for all builds or in the matrix for individual builds.

  * **SKIP\_INSTALL\_PYTHON\_26**

    If set to 1, python 2.6 will not be installed on travis. This can be used to speed up builds that don't need python.

    Can be set as a global environment variable for all builds or in the matrix for individual builds.

  * **SKIP\_PIWIK\_TEST\_PREPARE**

    If set to 1, the prepare.sh/setup_webserver.sh scripts are not executed. This can be used to speed up builds that don't execute PHP tests or need a webserver running Piwik.

    Can be set as a global environment variable for all builds or in the matrix for individual builds.

  * **TRAVIS\_COMMITTER\_NAME**
  * **TRAVIS\_COMMITTER\_EMAIL**

    These variables control the username and email address used when commiting changes from within a travis build.

    When the .travis.yml file is auto-updated, the travis build will commit the changes and push them to your plugin's git repository. The committer's username and email address are determined by these variable.

    `TRAVIS_COMMITTER_NAME` defaults to `Piwik Automation`. `TRAVIS_COMMITTER_EMAIL` defaults to `hello@matomo.org`.

    Example usage:

    ```
    env:
      global:
        - TRAVIS_COMMITTER_NAME="My Org Automation"
        - TRAVIS_COMMITTER_EMAIL=my-org@myorg.com
    ```
    
    
    
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

*Note: You cannot simply add these changes by hand to the .travis.yml file since they will be overwritten on the next `generate:travis-yml` execution.*

### Modifying the .travis.yml generation system

The system used to generate .travis.yml files is defined in the TestRunner plugin. Here are some notes to keep in mind if you need to modify it:

**Generating new .travis.yml sections**

This .twig file is used to generate the .travis.yml file: [https://github.com/matomo-org/matomo/blob/master/plugins/TestRunner/templates/travis.yml.twig](https://github.com/matomo-org/matomo/blob/master/plugins/TestRunner/templates/travis.yml.twig).

If you want to add a new section to generated .travis.yml output, you have to both add the section to the travis.yml.twig file **AND** add the section's name to this array: [https://github.com/matomo-org/matomo/blob/master/plugins/TestRunner/TravisYml/TravisYmlView.php#L23](https://github.com/matomo-org/matomo/blob/master/plugins/TestRunner/TravisYml/TravisYmlView.php#L23)

If you don't add it, the system will consider the section as a section that should be preserved, and will output it again after rendering the twig template.
