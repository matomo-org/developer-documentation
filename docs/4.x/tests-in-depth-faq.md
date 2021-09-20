---
category: DevelopInDepth
---
# Tests FAQ 

## How do I modify the config ini to test certain conditions?

### Integration and system PHP tests

You can use the [configuration object](/guides/piwiks-ini-configuration) as usual and set any specific ini setting before executing the test.

In integration tests you don't need to reset the config ini after each test as this is done automatically. In system tests the ini change is kept for all tests in the same class unless you manually undo the ini change.

You can find an example in the [BlobReportLimitingTest](https://github.com/matomo-org/matomo/blob/4.4.0/tests/PHPUnit/System/BlobReportLimitingTest.php#L194-L216). 

### UI tests

You can overwrite the config like below:

```
testEnvironment.configOverride.General = {
    browser_archiving_disabled_enforce: '1',
    enable_browser_archiving_triggering: '0',
};
testEnvironment.save();
```
 
## How do I change objects or configurations in tests?

### Generic dependency injection overwrite for tests

You can use either `/config/environment/test.php` or a plugin specific `config/test.php` say `plugins/CoreHome/config/test.php` to overwrite any dependency in Matomo during tests.

For examples see [config/test.php](https://github.com/matomo-org/matomo/blob/4.4.0/config/environment/test.php) and [Tour/test.php](https://github.com/matomo-org/matomo/blob/4.4.0/plugins/Tour/config/test.php).

Changes here are usually applied to all tests.

### Integration and system PHP tests

If you want to apply changes only for a specific test then you can overwrite the `provideContainerConfigBeforeClass` in system tests (and the overwrite will be applied for all tests in this test class) or the `provideContainerConfig` method in integration tests to change the injected dependencies.

You can find an example in [ArchiveCronTest](https://github.com/matomo-org/matomo/blob/4.4.0/plugins/CoreConsole/tests/System/ArchiveCronTest.php#L455-L471).

### UI tests

If you need to change the conditions for a specific UI test then first set in the UI test spec file a specific test variable like this:

```js
beforeEach(function () {
    testEnvironment.testGenerateFixedId = 1;
    testEnvironment.save();
});

afterEach(function () {
    delete testEnvironment.testGenerateFixedId;
    testEnvironment.save();
});
```

You can make up any name for the variable. The same environment variable could be also set for a specific test within a UI test spec file only: 

```js
it("should show use a fixed ID", async function () {
    testEnvironment.testGenerateFixedId = 1;
    testEnvironment.save();
    await page.goto(url);
});

afterEach(function () {
    delete testEnvironment.testGenerateFixedId;
    testEnvironment.save();
});
```

In PHP in a `config/test.php` you can then check if the corresponding variable is set and overwrite it like this:

```php 
'Piwik\Plugins\TagManager\Model\Container\ContainerIdGenerator' => DI\decorate(function ($previous) {
    $testGenerateFixedId = \Piwik\Container\StaticContainer::get('test.vars.testGenerateFixedId');
    if (!empty($testGenerateFixedId)) {
        return new \Piwik\Plugins\TagManager\Model\Container\FixedIdGenerator();
    }
    return $previous;
}),
```

This is very powerful and allows you to force all kind of different conditions in UI tests.

## How do I configure user permissions in tests?

### Integration and system PHP tests

You can overwrite the `Access` class using dependency injection and then configure the access class to your needs like in the examples below:

```php 
public function test_superuser() {
    FakeAccess::$superUser = true;
    // ...
}
public function test_viewuser() {
    FakeAccess::clearAccess();
    FakeAccess::$idSitesView = array($idsite = 1);
    // ...
}
public function test_adminuser() {
    FakeAccess::clearAccess();
    FakeAccess::$idSitesAdmin = array($idsite = 1);
    // ...
}
public function test_anonymous_user() {
    FakeAccess::clearAccess();
    // ...
}
public function provideContainerConfig() {
    return array(
        'Piwik\Access' => new FakeAccess()
    );
}
```

### UI tests

As part of a UI test spec file you can call the below code:

```js
it('should have only view permission', async function () {
    // depending on the permissions you want you can force different permissions
    delete testEnvironment.idSitesAdminAccess;
    delete testEnvironment.idSitesWriteAccess;
    testEnvironment.idSitesViewAccess = [1,2,5];
    testEnvironment.save();
    await page.goto('mypageurl');
    await capture.page(page, 'some_exist_view_user');
});

afterEach(function () {
    // reset permissions after each test
    delete testEnvironment.idSitesViewAccess;
    delete testEnvironment.idSitesWriteAccess;
    delete testEnvironment.idSitesAdminAccess;
    delete testEnvironment.idSitesCapabilities;
    testEnvironment.save();
});
```

## How do I test if an event was triggered?

During a test you can listen to an event and then check if it was triggered. The listener will be removed after the test automatically. Here's an example:

```php
public function test_configEventTriggered()
{
    $path = '';
    \Piwik\Piwik::addAction('Core.configFileChanged', function ($configFilePath) use (&$path) {
        $path = $configFilePath;
    });
    Config::getInstance()->forceSave();// this method will trigger above event
    $this->assertSame('config/config.ini.php', $path); // we not only test the event was triggered but also test the passed parameters
}
```

## Is there anything special about translations as they are only returning the translation key?

This is expected and wanted for most tests so the test won't fail when the wording changes. Few tests may load translations on test `setUp` and reset them on `tearDown` to test the actual wording if there is for example some logic behind the translations. Example:

```php
use Piwik\Tests\Framework\Fixture;

public function setUp(): void
{
    parent::setUp();

    Fixture::loadAllTranslations();
}

public function tearDown(): void
{
    Fixture::resetTranslations();
    parent::tearDown();
}
```
