---
category: DevelopInDepth
---
# Matomo's Asset Pipeline

This page contains an in-depth description of every part of Matomo's asset pipeline. It describes how Matomo processes and serves the
JavaScript files and LESS files that plugin developers create.

## Types of Processed Assets

Matomo can handle and process many different types of frontend assets, including:

* vanilla CSS
* LESS
* vanilla JavaScript
* ECMAScript (processed by babel)
* TypeScript (processed by the TypeScript compiler, then babel)
* Vue files (where the specific language is chosen within the file)

### Vanilla JavaScript, CSS and LESS files

Vanilla Javascript and CSS files do not need processing. They simply need to be discoverable by Matomo's asset pipeline.
Plugins accomplish this with two separate events:

* [`AssetManager.getStylesheetFiles`](/api-reference/events#assetmanagergetstylesheetfiles)
* [`AssetManager.getJavaScriptFiles`](/api-reference/events#assetmanagergetjavascriptfiles)

Each event is passed an array, and plugins add file paths to the array. Then the file will be processed and served by Matomo.

LESS files are made discoverable in the same way: they must be added via the [`AssetManager.getStylesheetFiles`](/api-reference/events#assetmanagergetstylesheetfiles)
event. Unlike vanilla CSS, however, they will be processed by the [less.php](https://github.com/wikimedia/less.php) library server side.

### TypeScript, ECMAScript and Vue files

Since version 4.5.0 of Matomo, plugins can use TypeScript and ECMAScript (referred to as ES from now on), and can create Vue components. These files cannot
be handled by Matomo's asset pipeline, as they require far more processing than can be done in PHP.

Instead, they must be built during development into a [UMD file](https://github.com/umdjs/umd), and distributed with
plugins. The compiled UMD file, which consists of vanilla JavaScript, will be picked up by Matomo's asset pipeline and
included like a file you'd specify through [`AssetManager.getJavaScriptFiles`](/api-reference/events#assetmanagergetjavascriptfiles).

### Building UMD modules

Matomo uses the [Vue CLI](https://cli.vuejs.org/) tool to bundle advanced assets. There is one global configuration that
is used for every Matomo plugin.

The build process is initiated through the Matomo command `vue:build`. Internally, this invokes the Vue CLI service, which
in turn, invokes many separate tools that process individual files. These tools are:

- [the TypeScript compiler](https://www.typescriptlang.org/): used to compile TypeScript and Vue files into ES files. The
  configuration for this tool is stored in the `tsconfig.json` file in Matomo's root folder. Individual plugins can
  extend and/or override this file by placing their own `tsconfig.json` in their `vue` folder.
- [ESLint](https://eslint.org/): used to lint our TypeScript, Vue and ES files. Currently we use the
  [https://github.com/airbnb/javascript](Airbnb ESlint ruleset). Base configuration for this tool is stored in the
  `eslintrc.js` file in Matomo's root folder. Plugins can extend or override this file by placing their own `eslintrc.js`
  file in their `vue` folder.
- [Babel](https://babeljs.io/): used to compile the ES that the TypeScript compiler emits into JavaScript that
  can be consumed by the browsers we support. Technically, the TypeScript compiler can do this too, but babel is included
  as well, since it provides some features the TypeScript compiler does not, such as [modern mode](https://cli.vuejs.org/guide/browser-compatibility.html#modern-mode).
  Babel is also extensible in a way TypeScript is not, so overall it provides more power and possibility.
  Babel configuration is stored in the `babel.config.js` file.
- [Webpack](https://webpack.js.org/): the bundler used by Vue CLI, webpack converts ES modules into UMD files that can
  be loaded directly in the browser. Webpack config is stored in the `vue.config.js` file. Vue CLI uses the [webpack-chain](https://github.com/neutrinojs/webpack-chain)
  tool to allow users to add custom webpack config. Matomo adds some extra config to make sure plugin UMD modules
  can be accessed from other plugins at runtime.
- [browserslist](https://github.com/browserslist/browserslist): this tool is used to specify what browsers we want our
  compiled JavaScript to be compatible with, and is used by babel to understand which advanced ES features need to be
  transpiled and which do not. Configuration for this tool is in the `.browserslistrc` file.

### UMD Module Dependencies

Plugin UMD modules can depend on each other, for example, most plugins will depend on `CoreHome`.
In TypeScript and .vue files, this will appear as imports:

```typescript
import { blahblah } from 'CoreHome';
import { anotherBlahBlah } from 'MyPlugin';
```

This means that UMD module loading order is important, CoreHome has to appear in the compiled asset
before this plugin, otherwise `blahblah` will be undefined and things will break.

We solve this in Matomo by automatically detecting plugin dependencies and using them to order
the UMD modules that get loaded.

Detecting plugin dependencies is done by:

* using a function in the `externals` webpack config. When a request for a plugin UMD is detected,
  we save it in an array.
* Later, after compilation has ended, we output the array to a metadata JSON file (`plugins/MyPlugin/vue/dist/umd.metadata.json`).

Ordering of plugins is done in JScriptUIFetcher.php by:

* Reading the dependencies from the umd.metadata.json files above,
* and performing a DFS that orders the plugins, dependencies first.

### Browser support

As stated above, `browserslist` is used to control what browsers our compiled JavaScript supports. In the `.browserslistrc`
file we specify some generic parameters, like `> 1%` (we want to support browsers with an overall usage of over 1%) and
`last 2 versions` (we want to support the last two versions of every browser).

Browserslist takes this description and creates the list of browsers and browser versions that must be supported. To
see this list yourself, run the following command:

`npx browserslist`

Based on the features these browsers support and do not support, `babel` will determine exactly how to compile our
ES files.

**Polyfills**

Some advanced ES features need polyfills in order to be available in older browsers. These polyfills unfortunately 
cannot be automatically detected using babel, since we do not know exactly what features every plugin developer will want to
use.

So instead we allow a specific set of polyfills to be included and disallow all others. We don't include every possible
polyfill as this could result in a lot of extra JavaScript in our finished asset.

These polyfills are stored in the `plugins/CoreVue/polyfills` folder. This folder houses a separate Vue project
that is built as a Vue app instead of a Vue library (all plugin `vue` folders are built as libraries). The specific
polyfills we include are specified in the `plugins/CoreVue/polyfills/vue.config.js` file.

Building the polyfill project is done via the `vue:build-polyfill` command. Only core developers will have
to use this command and only when adding or removing polyfills.

### Updating Browser Support

browserslist uses an npm package to determine the usage statistics of browsers. As long as it doesn't change, the
list of minimum supported browsers Matomo supports will stay the same. browserslist is in turn installed as a dependency of @vue/cli-service.

When it's time to update the minimum supported browser versions, which happens before every major release, all
that's needed is to upgrade the @vue/cli-service package to the latest version. Then, based on the `npx browserslist`
output & some manual testing to double check, change the versions in core/SupportedBrowser.php.

### Async components and chunking

A note concerning [async components](https://v3.vuejs.org/guide/migration/async-components.html#introduction) in Vue:
Vue allows developers to define components but not include them in the final bundle, instead loading them dynamically
via a network request. This is done via the magic `import()` function. This section describes how this is done, so it
is not so magical.

[import()](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Statements/import) is an advanced ES
feature that dynamically loads an ES module over a network, returning a promise that resolves to the ES module object.
Older browsers do not support this natively, so it is polyfilled by webpack.

When webpack processes a file to create a bundle, it will notice these `import()` calls and handle them. First,
it creates a separate bundle (called a **chunk**) for the ES module that is imported. This is outputted as a file like,
`MyPlugin.umd.1.js`. Then, the `import()` call is replaced with a call to a function provided by webpack, which creates
a `<script>` element to dynamically load the JavaScript chunk file.

All of this happens transparently to the developer.

_Note: these files, unlike all other JavaScript assets in Matomo, cannot be requested with our cache buster as the
URL used to load them is, more or less, hardcoded by Webpack._

### Discovering UMD files

UMD files are automatically discovered by Matomo's asset pipeline. If Matomo sees a file in a plugin stored in the
`plugins/MyPlugin/vue/dist` folder with a name like `MyPlugin.umd.js`, it will automatically be included as a
JavaScript asset. (Note: this code is in the `Piwik\AssetManager\UIAssetFetcher\JScriptUIAssetFetcher` class.)

So these files do not need to be added via the [`AssetManager.getJavaScriptFiles`](/api-reference/events#assetmanagergetjavascriptfiles)
event.

## More about the AssetManager

The previous section describes the frontend assets that the asset pipeline can discover. This section describes
how the asset pipeline system works.

The entrypoint to the asset pipeline is the `Piwik\AssetManager` class. This class' main purpose is to manage
**merged asset files**. All the JavaScript and LESS/CSS files in Matomo are merged into three separate files
that are then served. These files are:

- `asset_manager_global_css.css`: every stylesheet compiled to CSS and merged together
- `asset_manager_core_js.js`: all core JavaScript merged together. (core JavaScript includes JavaScript from plugins bundled with Matomo core)
- `asset_manager_non_core_js.js`: all non-core JavaScript merged together.

They are stored in the `tmp/assets` subfolder.

`AssetManager` contains methods to fetch these merged assets (these methods will generate the merged asset if it does
not exist in the filesystem), and contains methods to remove them from the filesystem (so they will be generated again).

If a plugin is activated or deactivated, the assets are removed. The next time they are generated, the updated list
of activated plugins will be used.

**Development mode**

If development mode is activated, assets will not be merged (except for LESS stylesheets since they must be compiled).
We assume since JavaScript files will be modified often it will be too annoying to have to wait for assets to be
compiled and merged on every browser reload.

For LESS files, if a top-level LESS file is modified, the asset pipeline will notice and re-build the stylesheets.
This does not work for any LESS files that are imported in others.

## Serving assets

The asset files which are stored in `tmp/assets` are served through the `Proxy` plugin. This plugin's controller
defines actions for getting the merged CSS and merged JavaScript.

These controller actions will compress the assets based on what the compression formats the current client accepts (currently
`deflate` and `gzip` are supported). The result of the compression is stored on the filesystem in the `tmp/assets` folder
and re-used so we don't have to compress on every request.

## Checking asset file size

Since version 4.5.0, Matomo includes a command to compute the production file sizes for merged JavaScript assets:
`development:compute-js-asset-size`. Run this during development to get an idea of how large the merged and minified JavaScript
assets are. _(Note: this is currently only for use by core developers. It assumes the source code for every premium feature plugin
is available locally.)_
