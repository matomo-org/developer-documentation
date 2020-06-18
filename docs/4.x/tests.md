---
category: Develop
subGuides:
  - tests-php
  - tests-ui
  - tests-travis
  - dependency-injection
---
# Tests

## About this guide

**Read this guide if**

* you'd like to know **how to run the testing suite used to test Piwik core**
* you'd like to know **how to add tests to your plugin so you can catch bugs before your users do**

**Guide assumptions**

This guide assumes that you:

* can code in PHP,
* can use PHPUnit,
* have a general understanding of extending Piwik (if not, read our [Getting Started](/guides/getting-started-part-1) guide),
* and understand how Piwik handles requests (if not, read our [HTTP Request Handling](/guides/http-request-handling) guide).
* have pulled Matomo's source code using git (an installation from an archive does not support running automated tests)

## Piwik's test suite

Piwik Core contains a suite of tests used to make sure that Piwik works properly and that new commits do not introduce new bugs. These are the types of tests in this suite: **unit tests**, **integration tests**, **system tests** and **ui tests**.

- **Unit tests** test individual classes isolated from the rest of the code to make sure they work correctly as a unit.

- **Integration tests** test several parts working together, e.g. a test using a database.

- **System tests** test Piwik's [Reporting API](/guides/piwiks-reporting-api) and [archiving logic](/guides/archiving) by tracking visits and checking that the output of certain API queries matches the expected output.

- **UI tests** test Piwik's twig templates, JavaScript and CSS by tracking visits, generating screenshots of URLs with [phantomjs](http://phantomjs.org/) and comparing expected screenshots with generated ones.
