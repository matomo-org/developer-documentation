---
category: Develop
previous: tests-ui
---
# Running tests on Travis CI

[Travis-CI](http://travis-ci.org) is a continuous integration tool that will run tests for a GitHub repository every time commits are pushed.

## Piwik's tests on Travis CI

Piwik uses Travis to automatically run its test suite on every commit (for every branch and pull request):

- PHP tests are run on the [piwik/piwik](https://travis-ci.org/piwik/piwik/builds) build

  Current status for master branch: [![Build Status](https://travis-ci.org/piwik/piwik.svg?branch=master)](https://travis-ci.org/piwik/piwik)

- UI tests are run on the [piwik/piwik-ui-tests](https://travis-ci.org/piwik/piwik-ui-tests) build

  Current status for master branch: [![Build Status](https://travis-ci.org/piwik/piwik-ui-tests.svg?branch=master)](https://travis-ci.org/piwik/piwik-ui-tests)

## Running your plugins tests on Travis CI

Plugins can do the same if they include a `.travis.yml` file in their github repository. You can generate this file using the `generate:travis-yml` console command:

```bash
$ ./console generate:travis-yml --plugin=MyPlugin
```

The command will automatically detect if you have PHP and/or UI tests in your plugin's `Test/` directory and create a `.travis.yml` file that will run them. The tests will be run against both Piwik `master` branch and against the latest stable version.

### Auto-updating the .travis.yml file

The `generate:travis-yml` command will be changed over time as we modify the travis build process. The generated `.travis.yml` file will check if it is out of date from within travis and let you know by failing the build. In such a case you will have to re-run the command and commit the changes to get the build to run again.

To avoid having to do this you can setup auto-updating by using the `--github-token=` option when calling `generate:travis-yml`. You should supply a [GitHub token](https://help.github.com/articles/creating-an-access-token-for-command-line-use) that has read and write access to the repository the build is for. When a .travis.yml file is found to be out of date, the Travis build will update the file and push a commit using the GitHub token.

*Note: you will need the [travis command line tool](http://blog.travis-ci.com/2013-01-14-new-client/) to setup auto-updating.*
