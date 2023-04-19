---
category: Develop
subGuides:
  - tests-php
  - tests-ui
  - tests-js-tracker
  - tests-github
  - tests-troubleshooting
---
# Tests

## About this guide

**Read this guide if**

* you'd like to know **how to run the testing suite used to test Matomo core**
* you'd like to know **how to add tests to your plugin so you can catch bugs before your users do**

**Guide assumptions**

This guide assumes that you:

* can code in PHP,
* can use PHPUnit,
* have a general understanding of extending Matomo (if not, read our [Getting Started](/guides/getting-started-part-1) guide),
* and understand how Matomo handles requests (if not, read our [HTTP Request Handling](/guides/http-request-handling) guide).
* have pulled Matomo's source code using git (an installation from an archive does not support running automated tests)

## Matomo's test suite

Matomo Core contains a suite of tests used to make sure that Matomo works properly and that new commits do not introduce new bugs. These are the types of tests in this suite: **unit tests**, **integration tests**, **system tests** and **ui tests**.

- **Unit tests** test individual classes isolated from the rest of the code to make sure they work correctly as a unit.

- **Integration tests** test several parts working together, e.g. a test using a database.

- **System tests** test Matomo's [Reporting API](/guides/piwiks-reporting-api) and [archiving logic](/guides/archiving) by tracking visits and checking that the output of certain API queries matches the expected output.

- **UI tests** test Matomo's twig templates, JavaScript and CSS by tracking visits, generating screenshots of URLs with [Puppeteer](https://pptr.dev/) and comparing expected screenshots with generated ones.

- **Javascript tests** test Matomo's tracking layer (matomo.js) to ensure tracking in the browser keeps working as expected.

- **Client tests** test some parts of the Vue code used in the Matomo UI.