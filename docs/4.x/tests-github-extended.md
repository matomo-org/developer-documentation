---
category: DevelopInDepth
previous: tests-ui
---
# GitHub Action CI: Extended

### Setting up GitHub Action CI for core plugins

To add a build on GitHub Action you must first enable the build on GitHub Action, also create a dir `.github/workflow/**.yml`

### GitHub Action Settings

There are lots of configurable options in the Matomo tests, some are required some are optional.
You can find all the options under `input` https://github.com/matomo-org/github-action-tests/blob/main/action.yml

`test-type`: define test type, options:
- `UI` (used for UI screenshots tests)
- `PHP`(used for system and integration tests)
- `PluginTests` (used for all the plugin tests)
- `JS` (javascript tests, test our tracking js etc)
- `Angular` (this will deprecate on Matomo 5)
- `ALL` (running all tests)

`mysql-driver`: define the driver used in Matomo `config.ini.php`

`test-command`: 

- for PHP tests 
```
./vendor/phpunit/phpunit/phpunit --configuration ./tests/PHPUnit/phpunit.xml --testsuite ${{ test-command }}
```

- for UI tests
```
./console tests:run-ui --store-in-ui-tests-repo --persist-fixture-data --assume-artifacts --core --extra-options="--num-test-groups=8 --test-group=${{ test-command }}"
```

`php-version`: define the php version the tests wil run on.

`node-version`: define the node version the tests wil run on.

`php-memory`: config the php memory in the tests.

`mysql-service` : set it false, will remove mysql for.

`redis-service`: set it to true will enable redis services.

`merge-target`: used for UI tests, pull request merge target.

`addition`: used for extra services, like `ldap`.

`plugin-name`: when test plugins, plugin names.


###GitHub Action Tests Package Update

You can adjust tests package by create a PR in https://github.com/matomo-org/github-action-tests

`action.yml`: is using a composite action, details can be review in here https://docs.github.com/en/actions/creating-actions/creating-a-composite-action

You can create extra inputs or adjust steps for the tests.

DIR `scripts` contains the bash script you want to use.

DIR `artifacts` contains the fonts, config, Nginx config etc.




