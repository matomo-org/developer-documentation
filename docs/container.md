---
category: Develop
previous: piwiks-ini-configuration
next: plugin-settings
---
# Dependency Injection Container

Most objects in Piwik are configured and constructed using a **dependency injection container**.

## Using Dependency Injection

The general workflow for creating a new class when developing for Piwik is as follows:

1. **Determine what type of class you are creating and whether it should be stored in the container.**

  1. If you are creating a class that contains important application logic and depends on some part of Piwik, such as the Translator class or a DAO class, then it should be stored in the container.

  2. If you are creating a class whose only purpose is to store data (such as a data structure or value object), it should not be stored in container.

  3. If you are creating a class that can be used outside of Piwik, then you should use a third party library (or create a third party library) instead.

  4. If you are creating a class that is a combination of #1 and #2, then you should split it into two classes.

  In general, the rule is, if your class contains important application logic, it should be stored in DI.

2. **If the class should be stored in DI, determine and specify its dependencies.**

  A class' dependencies are the other classes stored in DI that it depends on. For example, an API class that serves data from the DB may depend on a DAO class. Create a list of these dependencies.

  Then specify them as constructor arguments in your new class. For example:

  ```php
  use Piwik\Translation\Translator;
  use Piwik\Plugins\MyPlugin\Dao\MyEntityDao;

  class API
  {
      /**
       * @var Translator
       */
      private $translator;

      /**
       * @var MyEntityDao
       */
      private $myEntityDao;

      public function __construct(Translator $translator, MyEntityDao $myEntityDao)
      {
          $this->translator = $translator;
          $this->myEntityDao = $myEntityDao;
      }

      // ...
  }
  ```

3. **Determine if your class has any non-class dependencies.**

  Sometimes your class may depend on data that is in the DI container and not just classes, for example, [path.tmp](https://github.com/piwik/piwik/blob/master/config/global.php).

  If your class has such a dependency, add it to the constructor without a type and then manually configure the parameter in DI config. _See the next section to learn how to create DI config._

  For example:

  ```php
  use Piwik\Translation\Translator;
  use Piwik\Plugins\MyPlugin\Dao\MyEntityDao;

  class API
  {
      /**
       * @var Translator
       */
      private $translator;

      /**
       * @var MyEntityDao
       */
      private $myEntityDao;

      /**
       * @var string
       */
      private $tmpPath;

      public function __construct(Translator $translator, MyEntityDao $myEntityDao, $tmpPath)
      {
          $this->translator = $translator;
          $this->myEntityDao = $myEntityDao;
          $this->tmpPath = $tmpPath;
      }

      // ...
  }
  ```

* **Determine how your new class will be used and ensure it is constructed by the DI container.**

  **If another one of your classes creates your new class...**

  ... simply add the new class to the constructor of the class that's using it. If the class that's using it is stored in the container, then your new class will be constructed using DI automatically.

  If the user class cannot be stored in the container, then you must use `Piwik\Container\StaticContainer::get('Piwik\Plugins\MyPlugin\MyNewClass')` to get the instance in the user class.

  **If Piwik creates your new class...**

  Some classes are constructed by Piwik core (for example, API classes, Report classes, etc.). Some of these classes will automatically be constructed using the DI container. For these classes, you don't have any extra work to do.

  If the class is not constructed with DI, then you must use `StaticContainer` as described above.

  The list of classes that are automatically constructed using DI include:

  * API classes.
  * Implementations of the [Auth interface](http://developer.piwik.org/api-reference/Piwik/Auth).
  * `Widgets` classes.
  * Plugin `Settings` classes.
  * `Type` classes.
  * Plugin `Menu` classes.
  * Plugin `Tasks` classes.

  In 3.0, all classes will be constructed with dependency injection.

### Configuring the container

The container used in Piwik is [PHP-DI](http://php-di.org/). The container reads its configuration from 2 kinds of sources:

- it reads **constructor type-hints** to auto-detect the dependencies that are needed (which means less configuration to write)
- it reads **configuration files** that explicitly define entries

This container also offers a way to configure injections using annotations but this feature is not used in Piwik and is disabled.

#### Configuration files

If you want to inject a **configuration value** (e.g. an int or a string) then you will have to write DI configuration.

The container includes the following configuration files in the order listed:

- `config/global.php`: main configuration file
- `plugins/*/config/config.php`: the main configuration for each individual plugin (if any exists)
- `config/environment/$environment.php`: the "environment" configuration file.

  _For each Piwik entry point (ie, cli, tracker) there is a different environment file that will be loaded. This allows plugins and developers to configure Piwik differently based on the way Piwik is running. Currently, the following environments are recognized: `cli`, `tracker`._
- `plugins/*/config/$environment.php`: the environment configuration for each individual plugin (if any exists)
- `config/environment/dev.php`: a special environment config file included when running in development mode
- `plugins/*/config/dev.php`: the `dev` configuration for each individual plugin (if any exists)
- `config/environment/test.php`: a special environment config file included when running PHPUnit tests or UI tests
- `plugins/*/config/test.php`: the `test` configuration for each individual plugin (if any exists)
- `config/config.php`: optional user configuration file (not versioned in git)

When developing a plugin, you can supply DI config with your plugin in one of the files listed above to either configure your plugin or customize Piwik.

The syntax used in those files is described in [PHP-DI's documentation](http://php-di.org/doc/definition.html). Below are examples of the most common use cases.

**Binding an interface to a class**

```php
return array(
    'Piwik\Translation\Loader\LoaderInterface' => DI\object('Piwik\Translation\Loader\LoaderCache')
);
```

**Defining a value**

```php
return array(
    'log.format' => '%level% %tag%[%datetime%] %message%'
);
```

**Manually defining a constructor parameter**

Given that:

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
    'Piwik\Log\Formatter\LineMessageFormatter' => DI\object()
        ->constructor(DI\link('log.format')),
);
```

or

```php
return array(
    'Piwik\Log\Formatter\LineMessageFormatter' => DI\object()
        ->constructorParameter('logFormat', DI\link('log.format')),
);
```

**Using PHP code to create an object**

```php
return array(
    'foo.bar' => DI\factory(function (ContainerInterface $c) {
        $bar = // ...

        return Foo::createSomething($bar);
    }),
);
```

#### Configuring containers in tests

When writing integration or system tests you can inject your own classes (such as mocks) into the Piwik environment one of two ways:

1. Add configuration to your plugin's `config/test.php` file. For example:

  ```php
  <?php

  return array(
      'Piwik\Plugins\MyPlugin\MyRESTClient' => DI\object('Piwik\Plugins\MyPlugin\Test\MockRESTClient'),
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
              'Piwik\Plugins\MyPlugin\Dao\MyEntityDao' => DI\object('Piwik\Plugins\MyPlugin\Test\Mock\MockMyEntityDao')
                  ->constructorParameter('tmpPath', '/my/test/tmp/path'),
          );
      }
  }
  ```

Both of these types of container configuration affect child processes as well. So, for example, tracker requests sent in Fixtures will use this overridden configuration.

**Configuring the container in UI tests**

For UI tests which are written in JavaScript, this is a bit trickier. You can either use the first approach above, or override the DI config in a Fixture class and use it in your tests.

For example, in your Fixture:

```php
use Piwik\Tests\Framework\Fixture;

class MyFixture extends Fixture
{
    // ...

    public function provideContainerConfig()
    {
        // ...
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

## More about Dependency Injection in Piwik

This section describes 

The **DI container** is used to store and configure all of Piwik's application logic. That is to say, any class that encapsulates logic important to Piwik and Piwik only should be stored in the container.

We use dependency injection for the following reasons:

* to move the responsibility of resolving dependencies outside of individual classes. Classes only list what they need, and the DI container gives it to them.
* to allow plugins and users the ability to extend Piwik in any way they need by replacing and extending objects in the DI container.
* to allow developers to more easily test classes both in isolation and in the Piwik environment, by making it easy to inject mocks.
* to allow developers to more easily maintain code modularity by avoiding hard-coded dependencies.

### What classes go in the container

In Piwik development, there are four types of classes that exist:

* **Reusable, isolated classes**. _Examples: [Piwik\\Date](https://github.com/piwik/piwik/blob/master/core/Date.php), [Piwik\\Ini\\IniWriter](https://github.com/piwik/component-ini/blob/master/src/IniWriter.php)._
  
  These classes do not depend on Piwik and can be used outside of Piwik without issue.

* **Data structures & value objects**. _Examples: [Piwik\\DataTable](https://github.com/piwik/piwik/blob/master/core/DataTable.php)._

  These classes only store information. They do not depend on other Piwik classes that are in DI, but are still specific to Piwik. In other words, you wouldn't use one of these classes outside of Piwik or a Piwik plugin.

* **"Service" classes**. _Examples: [Piwik\\Plugins\\SegmentEditor\\API](https://github.com/piwik/piwik/blob/master/plugins/SegmentEditor/API.php), [Piwik\\Plugins\\SegmentEditor\\Model](https://github.com/piwik/piwik/blob/master/plugins/SegmentEditor/Model.php), [Piwik\\Scheduler\\Scheduler](https://github.com/piwik/piwik/blob/master/core/Scheduler/Scheduler.php)._

  The most common type of class, these classes are immutable and contain only logic important to Piwik. Together, these classes constitute the Piwik application.

  All Data Access Object classes, API classes, Controller classes are "service" classes. They use reusable classes, data structures and value objects, but none of them are mutable. In other words, none of them change their properties after a method is called.

**Of these types of classes, only "service" classes should be stored in DI.** Other classes should be constructed manually by service classes.
