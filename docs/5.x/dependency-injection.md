---
category: Develop
subGuides:
  - tests-php
  - tests-ui
  - tests-travis
---
# Dependency injection

## About this guide

**Read this guide if**

* you want to take advantage of dependency injections which can help you decoupling your code, getting more reusable code,
and testing your code more easily.
* you want to configure Matomo differently by changing which classes it uses. For example you could define your own kind of logger and get Matomo to use it instead of the default logger.

## Loading a class through dependency injection

Plugin developers can take advantage of constructor injection in most API classes in Matomo. This works for example for 
controllers, APIs, widgets, menus, tasks, commands etc. Matomo will automatically create the needed instances and pass 
it to your constructor.

For example if you want an instance of a logger and translator, simply define them in the constructor. It automatically 
also works for your own classes. For example:

```php
  use Piwik\Translation\Translator;
  use Psr\Log\LoggerInterface;
  use Piwik\Plugins\MyPlugin\Dao\MyEntityDao;

  class API
  {
      /**
       * @var Translator
       */
      private $translator;

      /**
       * @var LoggerInterface
       */
      private $logger;

      /**
       * @var MyEntityDao
       */
      private $myEntityDao;

      public function __construct(Translator $translator, LoggerInterface $logger, MyEntityDao $myEntityDao)
      {
          $this->translator = $translator;
          $this->logger = $logger;
          $this->myEntityDao = $myEntityDao;
      }
      
      public function doSomething() {
          $this->myEntityDao->storeSomething();
          $text = $this->translator->translate('MyPlugin_TranslationKey');
          $this->logger->info($text);
      }
  }
```

When you inject your own classes, Matomo will also automatically resolve the dependencies for these classes using the
constructor. Say for the above `MyEntityDao` example you can take advantage of having dependencies automatically resolved like this

```php
  namespace Piwik\Plugins\MyPlugin\Dao;
  use Piwik\Translation\Translator;
  use Psr\Log\LoggerInterface;

  class MyEntityDao
  {

      /**
       * @var LoggerInterface
       */
      private $logger;

      public function __construct(LoggerInterface $logger)
      {
          $this->logger = $logger;
      }
      
      public function storeSomething() {
          $this->logger->info('store something in DB');
      }
  }
```

## Container Configuration

If you want to inject a **configuration value** (e.g. an int or a string) then you will have to create a DI configuration.

The container includes the following configuration files in the order listed:

- `config/global.php`: main configuration file
- `plugins/*/config/config.php`: the main configuration for each individual plugin (if any exists)
- `plugins/*/config/tracker.php`: only loaded in tracker mode when a tracking request is being processed
- `config/environment/$environment.php`: the "environment" configuration file (eg "dev", "test")

  _For each Matomo entry point (ie, cli, tracker) there is a different environment file that will be loaded. This allows plugins and developers to configure Matomo differently based on the way Piwik is running. Currently, the following environments are recognized: `cli`, `tracker`._
- `plugins/*/config/$environment.php`: the environment configuration for each individual plugin (if any exists)
- `config/environment/dev.php`: a special environment config file included when running in development mode
- `plugins/*/config/dev.php`: the `dev` configuration for each individual plugin (if any exists)
- `config/environment/test.php`: a special environment config file included when running PHPUnit tests or UI tests
- `plugins/*/config/test.php`: the `test` configuration for each individual plugin (if any exists)
- `config/config.php`: optional user configuration file (not versioned in git)

When developing a plugin, you can supply DI config with your plugin in one of the files listed above to either configure your plugin or customize Matomo.

The syntax used in those files is described in [PHP-DI's documentation](http://php-di.org/doc/definition.html). Below are examples of the most common use cases.

### Binding an interface to a class

```php
return array(
    'Piwik\Translation\Loader\LoaderInterface' => DI\autowire('Piwik\Translation\Loader\LoaderCache')
);
```

This will automatically create an instance of the `LoaderCache` whenever the `LoaderInterface` is requested.

### Defining a value

```php
return array(
    'log.format' => '%level% %tag%[%datetime%] %message%'
);
```

This can come in handy if you want to pass a value instead of an object to a constructor. For more details see the next example.

### Manually defining a constructor parameter

Given that you have the following class:

```php
class LineMessageFormatter
{
    public function __construct($logFormat)
    {
        // ...
    }
}
```

We configure to inject the `log.format` entry in the constructor:

```php
return array(
    'Piwik\Log\Formatter\LineMessageFormatter' => DI\autowire()
        ->constructor(DI\link('log.format')),
);
```

or

```php
return array(
    'Piwik\Log\Formatter\LineMessageFormatter' => DI\autowire()
        ->constructorParameter('logFormat', DI\link('log.format')),
);
```

### Using PHP code to create an object

```php
return array(
    'foo.bar' => DI\factory(function (ContainerInterface $c) {
        $bar = // ...
        return Foo::createSomething($bar);
    }),
);
```

### Adding new event listeners

It's also possible to add additional event listeners for any Matomo event using Dependency Injection. As most events are
using references to make manipulation possible it's required to wrap the event listener functions into `DI\value`.

```php
return [
    'observers.global' => [
        ['AssetManager.getStylesheetFiles', DI\value(function (&$stylesheets) {
            $stylesheets[] = 'my\custom.css';
        })],
    ],
];
```


### Configuring containers in tests

When writing integration or system tests you can inject your own classes (such as mocks) into the Matomo environment one of two ways:

1. Add configuration to your plugin's `config/test.php` file. For example:

  ```php
  <?php
  return array(
      'Piwik\Plugins\MyPlugin\MyRESTClient' => DI\autowire('Piwik\Plugins\MyPlugin\Test\MockRESTClient'),
  );
  ```

  This configuration is applied in every test, however, so it may not be desirable.

2. Override the `provideContainerConfig()` method in either your test case class or your `Fixture` class and return the DI config. For example:

  ```php
  use Piwik\Tests\Framework\TestCase\IntegrationTestCase;
  class APITest extends IntegrationTestCase
  {
      // ... test cases ...
      public function provideContainerConfig()
      {
          return array(
              'Piwik\Plugins\MyPlugin\Dao\MyEntityDao' => DI\autowire('Piwik\Plugins\MyPlugin\Test\Mock\MockMyEntityDao')
                  ->constructorParameter('tmpPath', '/my/test/tmp/path'),
          );
      }
  }
  ```

Both of these types of container configuration affect child processes as well. So, for example, tracker requests sent in Fixtures will use this overridden configuration.

### Configuring the container in UI tests

For UI tests which are written in JavaScript, this is a bit trickier. You can either use the first approach above, or override the DI config in a Fixture class and use it in your tests.

For example, in your Fixture:

```php
use Piwik\Tests\Framework\Fixture;
class MyFixture extends Fixture
{
    // ...
    public function provideContainerConfig()
    {
        return array( /** container config */);
    }
}
```

then in your UI test:

```js
describe("MyUiTest", function () {
    this.fixture = "Piwik\\Plugins\\MyPlugin\\Test\\Fixtures\\MyFixture";
    // ... tests ...
})
``` 
