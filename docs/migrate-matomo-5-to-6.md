---
category: Develop
---
# Migrate Plugin from Matomo 5.X to Matomo 6

This migration guide covers the changes required in order to make a plugin compatible with Matomo 6.
A list of all changes in Matomo 6 can be found in the [Changelog](/changelog).

## Create a new branch

We recommend creating a new branch for your plugin that supports Matomo 6. For example `6.x-dev`. This way you will be able to make changes to your plugin for Matomo 5 and Matomo 6 and release independent versions for each of them. You can still publish updates to your plugin that supports Matomo 5 once you have published an update for a version that supports Matomo 6.

## Adjust the required Matomo version

For your plugin to be executed in Matomo 6 you first need to show it is compatible with Matomo 6 in your `plugin.json` file:

* specify that your plugin requires Matomo 6 (the requirement for Matomo 5 used to be e.g. `"matomo": ">=5.0.0-b1,<6.0.0-b1"`).
* we also recommend increasing your plugin's major version number e.g. from `5.1.9` to `6.0.0`.

The `plugin.json` would look like this:

```json
   "version": "6.0.0",
   "require": {
        "matomo": ">=6.0.0-b1,<7.0.0-b1"
    },
```

The `-b1` suffix on the lower bound matters: a plain `>=6.0.0` sorts above `6.0.0-b1`, so your plugin would be disabled against a Matomo 6 beta or release candidate.

It's not allowed to support multiple major Matomo versions such as Matomo 5 and Matomo 6: `"matomo": ">=5.0.0-b1,<7.0.0-b1"`. In this case you would receive an error email and the release would not be published.

## Required PHP and database versions

Matomo 6 raises the minimum requirements:

* **PHP 8.1.0** (was 7.2.5)
* **MySQL 8.0** or **MariaDB 10.6** (was 5.5)

If your plugin declares its own `php` requirement in `plugin.json` or `composer.json`, raise it to at least `8.1.0`. Support for TiDB has been dropped.

## Removed PHP APIs

| Removed | Replacement |
|---|---|
| `Piwik\Archive::getBlob()` | one of the `Piwik\Archive::getDataTable*()` methods |
| `Piwik\Archive::clearStaticCache()` | none — it was already a no-op |
| `Piwik\ArchiveProcessor\Parameters::setIsPartialArchive()` | none — remove the call, see below |
| `Piwik\Db\Adapter::getDefaultPortForAdapter()` | `Piwik\Db\Schema::getDefaultPortForSchema()` |
| `Piwik\Db\AdapterInterface::getDefaultPort()` and its `Mysqli` / `Pdo\Mysql` implementations | `Piwik\Db\Schema::getDefaultPortForSchema()` |
| `Piwik\Url::saveCORSHostnameInConfig()` | none — it was no longer in use |
| `Piwik\Plugin\Report::getThirdLeveltableDimension()` | `Piwik\Plugin\Report::getNthLevelTableDimension(2)` |
| `Piwik\Db::optimizeTables()` | `Piwik\Db\Schema::getInstance()->optimizeTables()` |
| `Piwik\Db::isOptimizeInnoDBSupported()` | `Piwik\Db\Schema::getInstance()->isOptimizeInnoDBSupported()` |
| `Piwik\Db\TransactionLevel::setUncommitted()` | `Piwik\Db\TransactionLevel::setTransactionLevelForNonLockingReads()` |
| `Piwik\API\Request::isTokenAuthProvidedSecurely()` | none |
| `Piwik\Plugins\Overlay\API::getExcludedQueryParameters()` | the `SitesManager.getExcludedQueryParameters` API method |

Note that `getDefaultPort()` also exists as an instance method on `Piwik\Db\SchemaInterface`, which is **not** removed. Check the receiver before changing a call.

An `Archiver` that marked its archive as partial no longer needs to do anything: `Parameters::isPartialArchive()` is now derived from the requested report, so the `setIsPartialArchive(true)` call (usually in the archiver's constructor) should simply be deleted. See [Archiving](/guides/archiving#for-plugins-supporting-partial-archives).

### The SEO plugin has been removed

The whole `SEO` plugin is gone, including its widget, the `SEO.getRank` API method and `Piwik\Plugins\SEO\*` classes. Matomo 6 deactivates and uninstalls it on upgrade. If your plugin referenced it, that reference has to be removed.

### TrackingSpamPrevention is now bundled

`TrackingSpamPrevention` ships with core, is activated by default and can no longer be uninstalled. It is no longer distributed on the Marketplace, and `Piwik\Plugin\Manager::isPluginBundledWithCore('TrackingSpamPrevention')` now returns `true`.

## Removed HTTP API methods

| Removed | Replacement |
|---|---|
| `API.getSettings` | none. Integrations reading key/value pairs over the REST API must move to another mechanism; the `[APISettings]` section of `config/global.ini.php` is gone and any entries in a local `config.ini.php` become inert |
| `SitesManager.setGlobalExcludedQueryParameters` | `SitesManager.setGlobalQueryParamExclusion` |
| `Overlay.getExcludedQueryParameters` | `SitesManager.getExcludedQueryParameters` |
| `SEO.getRank` | none |

Remember to search your templates, JavaScript, tests, fixtures and expected files, not just your PHP.

## Removed global functions

The polyfills in `libs/upgradephp/upgrade.php` have been removed, as every supported PHP version provides them natively.

| Removed | Replacement |
|---|---|
| `_glob()` | native `glob()`. It returns `false` on error, so callers expecting an array need `glob(…) ?: []` |
| `safe_serialize()`, `_safe_serialize()` | native `serialize()` |
| `_parse_ini_file()` | `Piwik\Config`, or `Matomo\Ini\IniReader` for other INI files |
| the fallbacks for `mysqli_set_charset()`, `file_get_contents()`, `utf8_encode()`, `utf8_decode()`, `fnmatch()`, the `Error` class and `PHP_INT_SIZE` / `PHP_INT_MAX` | the native functions and constants |
| the `gzopen()` alias to `gzopen64()` | none — `Piwik\Unzip` falls back to `PclZip` |

`safe_unserialize()` is kept, but it is stricter than native `unserialize()`: it rejects `R:` reference tokens and reads a resource back as the integer `0`. Swapping `safe_serialize()` for `serialize()` is therefore only a drop-in replacement for values that contain no objects, references or resources.

`glob()`, `fnmatch()` and `file_get_contents()` also moved from the recommended to the **required** functions in the system check. Matomo now refuses to start when one of them is listed in the `disable_functions` php.ini directive instead of emulating it.

## Removed console commands and scripts

The development console commands `git:commit`, `git:pull` and `git:push` have been removed. Use `git` directly.

The archiving script `./misc/cron/archive.sh` has been removed. Use the `core:archive` console command instead.

## Interface changes

* **`Piwik\Log\LoggerInterface`** follows psr/log 3, so `log()`, `debug()`, `info()`, `notice()`, `warning()`, `error()`, `critical()`, `alert()` and `emergency()` all require a `: void` return type. Plugins that obtain the logger through dependency injection or extend `Piwik\Log\Logger` are not affected.

## Dependency upgrades

Several bundled libraries received a major upgrade. These surface as fatal errors rather than deprecation notices, so they are worth checking even if your plugin looks unaffected.

* **Monolog 1 → 3**: every custom handler, formatter and processor now receives a `Monolog\LogRecord` instead of `array $record`, and records are immutable. `protected function write(array $record)` becomes `protected function write(LogRecord $record): void`, and mutating a record becomes `return $record->with(message: $new);`. Core's handlers under `plugins/Monolog/` are the reference implementations.
* **PHP-DI 6 → 7**: `Piwik\Container\Container::get()`, `make()` and `injectOn()` gained native types, so an overriding class must match them. Annotation-based injection no longer exists — `@Inject` docblocks must become explicit container configuration or PHP attributes.
* **Symfony 5.4 → 6.4** (console, event-dispatcher, process, monolog-bridge): `Piwik\Plugin\ConsoleCommand::addOption()` and `addArgument()` return `static` and `getHelper()` returns `mixed`. Only a plugin overriding them is affected.
* **matomo/matomo-php-tracker 3 → 4**: typed setters. Use `setUserId(null)` instead of `setUserId(false)`, pass a string name to `setCustomVariable()` rather than an array, and declare `: string` on an overridden `getBaseUrl()`.
* **Others**: `geoip2/geoip2` 2 → 3, `matomo/decompress` 2 → 3, `psr/log` 1 → 3, `wikimedia/less.php` 3 → 5, `twig/twig` now `^3.11.3`. For tests, PHPUnit 8.5 → 9 (`assertRegExp()` becomes `assertMatchesRegularExpression()`) and PHPStan 1.12 → 2.

## Controllers returning JSON

Controller actions that return JSON should now carry the `#[Piwik\Http\JsonResponse]` attribute and declare a `string` return type:

```php
use Piwik\Http\JsonResponse;

#[JsonResponse]
public function myControllerMethod(): string
{
    return json_encode($result);
}
```

An action using the attribute must return the JSON string, must not send the `Content-Type` header itself, and must not emit output or call `exit`/`die` before returning.

**The attribute is not inherited.** If your plugin extends a core controller and overrides an action that core has annotated, you must re-declare `#[JsonResponse]` and declare a compatible `string` return type. Affected core actions include `Dashboard::getAllDashboards()` and `getDashboardLayout()`, `CoreHome::markNotificationAsRead()`, and several in `SitesManager`, `Goals`, `CoreAdminHome`, `Marketplace`, `GeoIp2`, `CoreUpdater` and `MobileMessaging`.

See [Controllers](/guides/controllers#using-controller-methods-as-api-methods) for details.

## Vue build moved to Vite

Matomo 6 builds plugin Vue libraries with [Vite](https://vite.dev/) instead of the Vue CLI, and requires **Node 24**. The `vue:build` command is unchanged, but a few things around it are:

* `vue:build` no longer emits the unminified `plugins/<Plugin>/vue/dist/<Plugin>.umd.js`. Only `<Plugin>.umd.min.js` was ever loaded by Matomo. Delete the committed `vue/dist/<Plugin>.umd.js` from your repository and add `/vue/dist/*.umd.js` to your `.gitignore`.
* ESLint is no longer run as part of `vue:build`. Run `npm run eslint` separately.
* The `--clear-webpack-cache` option is now `--clear-cache`, and clears `node_modules/.vite`.

The build is stricter about TypeScript than the previous toolchain. `vue:build` exits with status 0 even when it reports TypeScript errors, so read its output. The recurring fixes are:

* type-only re-exports need `export type { X }` rather than `export { X }`;
* interfaces referenced in emitted declarations must be exported (`interface State` → `export interface State`);
* explicit coercion where a type is now checked: `translate('X', count)` → `translate('X', String(count))`, `:content-title="i"` → `:content-title="String(i)"`;
* null guards: `alert.siteName` → `alert.siteName || ''`, `logs?.length < 1` → `(logs?.length || 0) < 1`, `$sanitize(x)` → `$sanitize(x || '')`;
* typed array props: `type: Array` → `type: Array as PropType<Alert[]>`, plus the `PropType` import;
* drop `this.` in templates: `:title="this.triggers[id]"` → `:title="triggers[id]"`;
* drop the `.ts` suffix from import specifiers: `from '../types.ts'` → `from '../types'`.

Some CoreHome exports are now type-only (`SiteRef`, `WidgetType`, `WidgetContainerType`, `GroupedWidgetsType`); importing them as values fails. `tslib` is a new external provided by the CoreVue polyfill.

## Jest replaced with Vitest

Vue component tests now run on [Vitest](https://vitest.dev/). `npm test` is `TZ=UTC vitest run`. In your specs, replace `jest.mock`, `jest.fn` and `jest.spyOn` with `vi.mock`, `vi.fn` and `vi.spyOn`, drop the Jest-only `{ virtual: true }` mock option, and replace the require-after-mock pattern with an ESM import using `vi.hoisted`.

## Theming and Less changes

Registering a removed stylesheet in `getStylesheetFiles()` breaks stylesheet merging with `The ui asset with 'href' = … is not readable`, so check these first:

* `plugins/Morpheus/stylesheets/base/mode-colors.less` has been removed together with `@color-mode-black` and `@color-mode-white`. Use the `.inDarkMode()` mixin from `base/mixins.less` or a `@theme-color-*` variable.
* `plugins/Login/stylesheets/variables.less` has been removed together with `@login-section-background`.

Removed Less variables:

* the `Piwik`-era aliases `@color-black-piwik`, `@color-blue-piwik`, `@color-red-piwik` and `@color-green-piwik` — use the `@color-*-matomo` equivalents;
* the third-party brand colours `@color-orange-brand` (`#f57c00`), `@color-green-brandSocial` (`#009874`), `@color-blue-brandSocial` (`#3b5998`), `@color-blue-brandSocialLight` (`#1c87bd`) and `@color-blue-brandSocialVeryLight` (`#00aced`) — use the literal value;
* the unused tokens `@color-gray-light`, `@color-gray-bright`, `@color-gray-400`, `@color-jetstream`, `@color-silver-l14`, `@color-silver-l50`, `@color-silver-l70` and `@color-silver-l98`.

Variables that were only used inside a single stylesheet have been inlined or renamed to private `@_`-prefixed names and are no longer visible to other stylesheets: `@top-menu-nav-color`, the four `@color-period-selector*`, the eight `@add-widget-*`, and `@calendarHeaderBackground`, `@calendarHeaderColor`, `@calendarCurrentStateHover` and `@calendarBorder`.

**Themes should note** that `@theme-color-new-brand` / `ThemeStyles::$colorNewBrand` has been removed, and its teal is now the value of `@theme-color-brand` / `$colorBrand` — which previously held green. That green moved to the new `@theme-color-success` / `$colorSuccess`, which is deliberately kept independent of the brand colour so success states stay green when a theme overrides the brand. If your theme overrode `colorNewBrand`, move that override to `colorBrand`, **not** to `colorSuccess`. Note that these are `[light, dark]` pairs where `$colorNewBrand` was a plain string; a bare string still works but gives both modes the same colour. A theme reading `themeStyles.getPropertyValue('colorNewBrand')` breaks silently rather than erroring.

Finally, `@theme-color-widget-background` and a group of `@theme-color-menu-contrast-*` and `@theme-color-widget-*` variables are **deprecated** and will be removed in Matomo 7. They keep working in Matomo 6; see the [Changelog](/changelog) for the full list.

## JavaScript changes

* The jQuery UI widget `$.fn.liveWidget` (`piwik.liveWidget`) has been removed together with `plugins/Live/javascripts/live.js`. Use the `Live.AutoRefreshWidget` Vue component.

## Behaviour changes

These do not produce fatal errors, so they typically show up as unexpected results or failing tests.

* **Request parameters are no longer trimmed.** `Piwik\API\Request::getRequestArrayFromString()` used to apply `trim((string) $value)` to every non-array parameter. Whitespace in values such as a `label` or a segment operand is now preserved, and scalars keep their type. As a consequence, a boolean passed through `Piwik\API\Request::processRequest()` no longer arrives as `'1'`/`''`, so a parameter read with `Common::getRequestVar($name, $default, 'string')` or `Request::getStringParameter()` falls back to its default. Pass a string, or read it with `Request::getBoolParameter()`. See [Request parameters](/guides/request-parameters#whitespace-and-types-are-preserved).
* **`Annotations.add`, `Annotations.save` and `Annotations.delete` now require `Write` permission.** Previously `add` required only `View`, and an annotation's author could modify or delete it with `View`.
* **`UsersManager.addCapabilities` and `removeCapabilities`** are now gated behind the `enable_users_admin` setting.
* **Report rows gained `{metric}_percent_of_total` columns.** If you parse CSV or TSV output by column position, this changes the header and column count — pass `percent_of_total=0` to keep the previous output. See [the API reference](/api-reference/reporting-api#optional-api-parameters).
* **One Click Update is HTTPS-only.** The "retry over HTTP" fallback and the `https` request parameter of the `CoreUpdater.oneClickUpdate` action have been removed, along with the `$https` parameter of `Piwik\Plugins\CoreUpdater\Updater::updatePiwik()` and `getArchiveUrl()`.

## Tests on CI

If you use the GitHub test action, update the PHP versions it runs against. You can use the `matomo6_min_php` and `matomo6_max_php` aliases instead of literal versions so they follow the supported range:

```
$ ./console generate:test-action --plugin="MyPlugin" --php-versions="matomo6_min_php,matomo6_max_php"
```

Set `node-version: '24'` on every job that specifies one, and add a database matrix covering MySQL 8.0 and MariaDB 10.6. More details are in [the GitHub tests guide](/guides/tests-github).

## Summary

In this guide we have seen which steps to take to migrate your Matomo plugin to be compatible with our latest Matomo 6.
If you need further help with converting your plugin to Matomo 6, head over to the [Matomo developers community forums](https://forum.matomo.org/c/plugins-platform).

Once you've adjusted your plugin, don't forget to release a new version!
