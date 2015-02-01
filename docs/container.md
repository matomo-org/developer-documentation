---
category: Develop
previous: piwiks-ini-configuration
next: plugin-settings
---
# Dependency Injection Container

Some components in Piwik are configured and constructed using a **dependency injection container**.

## Retrieving from the container

There are two ways to retrieve an entry (object or value) from the container:

- **dependency injection**
- getting it from the container using **`Container::get()`**

### Dependency injection

The preferred way to retrieve objects or values from the container is **to not call the container at all**.

For example the `Translator` needs a `Loader` that loads translation files. Here is how it is retrieved:

```php
class Translator
{
    private $loader;

    public function __construct(Loader $loader)
    {
        $this->loader = $loader;
    }

    // ...
}
```

By using [dependency injection](http://fabien.potencier.org/article/11/what-is-dependency-injection), our class is easily testable and decoupled from the container. To instruct the container to inject the correct loader, we need to configure it (see the *Configuration* section).

### Container::get()

Another way to get entries from the container is to directly call `Container::get($id)`. This method is not ideal because it means we are coupling our code to the container and our class is also no longer unit-testable.

However, given the current Piwik codebase is not following the pattern of dependency injection everywhere, it is accepted to call this method when dependency injection is not practical.

Example:

```php
$foo = StaticContainer::get('entry-name');
```

The entry name can also be a class name, e.g. `"Piwik\Translation\Loader\LoaderInterface"`.

## Configuring the container

The container used in Piwik is [PHP-DI](http://php-di.org/). The container reads its configuration from 2 kinds of sources:

- it reads **constructor type-hints** to auto-detect the dependencies that are needed (which means less configuration to write)
- it reads **configuration files** that explicitly define entries

This container also offers a way to configure injections using annotations but this feature is not used in Piwik and is disabled.

### Autowiring

**Autowiring** means the container reads constructor type-hints to guess what needs to be injected.

For example:

```php
class Translator
{
    public function __construct(Loader $loader)
    {
        // ...
    }
}
```

Here the container will guess that an object `Piwik\Translation\Loader` needs to be injected. No configuration is needed if `Loader` is either:

- configured in configuration files
- or can be auto-configured with autowiring too

### Configuration files

Autowiring doesn't work for every case. For example if you want to inject a **configuration value** (e.g. an int or a string).

The container includes the following configuration files:

- `config/global.php`: main configuration file
- `config/environment/cli.php`: included when running in the command line console
- `config/environment/dev.php`: included when running in development mode
- `config/environment/test.php`: included when running PHPUnit tests
- `config/config.php`: optional user configuration file (not versioned in git)

The syntax used in those files is described in [PHP-DI's documentation](http://php-di.org/doc/definition.html). Below are examples of the most common use cases.

#### Binding an interface to a class

```php
return array(
    'Piwik\Translation\Loader\LoaderInterface' => DI\object('Piwik\Translation\Loader\LoaderCache')
);
```

#### Defining a value

```php
return array(
    'log.format' => '%level% %tag%[%datetime%] %message%'
);
```

#### Manually defining a constructor parameter

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

#### Using PHP code to create an object

```php
return array(
    'foo.bar' => DI\factory(function (ContainerInterface $c) {
        $bar = // ...

        return Foo::createSomething($bar);
    }),
);
```
