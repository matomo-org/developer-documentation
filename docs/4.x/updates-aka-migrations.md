---
category: DevelopInDepth
---
# Writing Updates (aka Migrations)

Sometimes when a new version of Matomo is released, it's necessary to make changes to the database or filesystem.
Matomo accomplishes this through the auto update process via individual `Update` classes that contain the logic to
upgrade a Matomo from one version to another. (In other frameworks and libraries these are called "migrations".)

This document explains how to create Updates both in Matomo core and in plugins.

## Creating a new Update

Core updates are stored in the `core/Updates` directory. The filename should match the version the Update upgrades to,
for example, `4.0.1-b1.php`. Inside, the class name should replace non-alphanumeric characters with underscores: `Updates_4_0_1_b1`.

The basic structure of an Update class is:

```php
<?php
class Updates_4_3_0_b3 extends PiwikUpdates
{
    /**
     * @var MigrationFactory
     */
    private $migration;

    public function __construct(MigrationFactory $factory)
    {
        $this->migration = $factory;
    }

    public function getMigrations(Updater $updater)
    {
        // many different migrations are available to be used via $this->migration factory
        $migration1 = $this->migration->db->changeColumnType('log_visit', 'example', 'BOOLEAN NOT NULL');
        // you can also define custom SQL migrations. If you need to bind parameters, use `->boundSql()`
        $migration2 = $this->migration->db->sql($sqlQuery = 'SELECT 1');

        return array(
            // $migration1,
            // $migration2
        );
    }

    public function doUpdate(Updater $updater)
    {
        $updater->executeMigrations(__FILE__, $this->getMigrations($updater));
    }
}
```

The `getMigrations()` method returns explicit step by step changes to make to the system. Separating them like
this allows us to display the list of changes that will be made to the user in case the user would like to do
them manually, one at a time (useful for large instances).

The `doUpdate()` method performs the entire update. It must call `$updater->executeMigrations(...)` as above if there are
individual migrations defined. It can also include other update logic that doesn't have an associated migration,
but it is encouraged to find some way to put them in a migration, since otherwise the user wouldn't be able
to apply them manually.

If you do create a custom migration, it is required that you make it **idempotent**. That is to say, running the
update multiple times should change the system only once and should not result in an error.

**Steps to creating a new Update**

To create a new Update class, do the following:

1. Check the version in core/Version.php, and bump it. If it's set to `4.0.0`, for example, set it to `4.0.0-b1`. If it's set to `4.0.0-b1`, set it to `4.0.0-b2`.
   If it's set to `4.0.0-rc1`, set it to `4.0.0-rc2`. The version you bump it to must always be a beta or release candidate version, since the product
   owner is the only one who releases whole new versions.
2. Run the `./console generate:update` command and specify `core`.
3. In the `core/Updates` folder there will now be a new Update with the version you bumped Version.php to. Fill it with the update
   logic you need.

## Differences with the Migration pattern

Some of this may sound familiar to you if you're aware of the Migration pattern. If so, you'll also note there
are some key differences:

* The migrations are tied to a specific Matomo version. Which means every time you need to create an update, the version has to
  be bumped. In practice this isn't a problem since we bump to betas and release candidates, but it can be annoying.
* There is no way to downgrade an Update. This means Matomo downgrades must be done manually. It also means the logic
  to downgrade is not described anywhere.

# Updates for Plugins

Plugins can include their own updates as well. The only real difference between core updates is where plugin updates are placed.
Plugin updates are placed in the `plugins/{PluginName}/Updates` folders and can be generated via the `generate:update`
command.

The only other difference in the workflow for creating an Update for a plugin is where the plugin version is stored, which is
the `plugin.json` file.