# Automated Tests

<!-- Meta (to be deleted)
Purpose: describe how current automated tests work (unit, integration + UI). describe how plugins can create their own unit tests, integration tests and UI tests. describe how to run tests only for plugin & how to run core tests.

Audience: plugin developers who want to test their plugins.

Expected Result: 

Notes: 

What's missing? (stuff in my list that was not in when I wrote the 1st draft)
-->

## About this guide

**Read this guide if**

* you'd like to know **how to add automated testing to your plugin so you can catch bugs before your users do**
* you'd like to know **how to run the testing suite used to test Piwik core**

**Guide assumptions**

This guide assumes that you:

* can code in PHP,
* can use PHPUnit,
* and have a general understanding of extending Piwik (if not, read our [Getting Started](#) guide).

## Piwik's automated testing suite

Piwik Core contains suite of tests used to make sure Piwik works properly and new commits do not introduce new bugs. There are three types of tests in this suite: **unit tests**, **integration tests** and **ui tests**.

**Unit tests** test individual classes to make sure their methods work properly. **Integration tests** test Piwik's [Reporting API](#) and [archiving logic](#) by tracking visits and checking that the output of certain API queries matches the expected output. **UI tests** tests Piwik's twig templates, JavaScript and CSS by tracking visits, generating screenshots of URLs with [phantomjs](#) and comparing expected screenshots with processed ones.

### UI tests

Unit and integration tests are fairly straightforward to run. UI tests, on the other hand, need a bit more work. To run UI tests you'll need to install [phantomjs version 1.9 or higher](#) and make sure `phantomjs` is on your PATH. Then you'll have to get the tests which are located in another repository but are included in Piwik as a submodule:

    git submodule init
    git submodule update

If you're on Ubuntu, you'll also need some extra packages to make sure screenshots will render correctly:

    sudo apt-get install ttf-mscorefonts-installer imagemagick imagemagick-doc

### Running tests

Piwik Core's tests can be run in two ways. The first is to use the [console](#) command line tool by running:

    ./console test:run

or to run a specific set of test suites

    ./console test:run Core # for unit tests
    ./console test:run Integration

To run UI tests or the tests in a single file in the set of unit or integration tests, you will have to use the second method, which is to call [phpunit](#) directly:

    # first, we must be in the PHPUnit directory, so
    cd tests/PHPUnit
    phpunit Core
    phpunit Integration
    phpunit UI

or

    phpunit Core/CommonTest.php
    phpunit Integration/ArchiveCronTest.php
    phpunit UI/UIIntegrationTest.php

## Testing your plugins

If you're creating a new plugin that defines new reports or has some complex logic, you may find it beneficial to engage in [Test Driven Development](#) or at least to verify your code is correct with tests. With tests you'll be able to ensure that your code works and you'll be able to ensure the changes you make don't cause regressions.

At the moment, you can write unit or integration tests for your plugins. This section will explain how.

_Note: All test files must be put in a **tests** directory located in the root directory of your plugin._

### Writing unit tests

To create a unit test, 

### Writing integration tests

### Writing UI tests

### Running test plugins

### Continuous Integration with Travis-CI

## Learn more

* 