# Matomo Developer Documentation

- https://matomo.org
- https://developer.matomo.org

## Documentations

- [Index](docs/generated/4.x-dev/Index.md)
- [Classes](docs/generated/4.x-dev/Classes.md)
- [Namespaces](docs/generated/4.x-dev/Namespaces.md)
- [Hooks](docs/generated/4.x-dev/Hooks.md)
- [Guides](docs)

## License

Copyright Matomo team. Do not republish, or copy, or distribute this code or content. Thank you!

## Prerequisites

You need the following to build and run the developer documentation:

- PHP 7.1+
- PHP extensions: `gd`
- The most recent version of [PHP Composer](https://getcomposer.org/)
- [Node.js](https://nodejs.org/en/) (for the API reference generator)
- A bash shell to run the scripts

## Run locally

Initialize the project by installing the dependencies and creating the cache and template directories:

    cd app/
    composer install
    mkdir tmp/cache
    mkdir tmp/templates

Now you can run the website locally using the PHP built-in web server:

    cd public/
    php -S 0.0.0.0:8000

Open http://localhost:8000/ in your browser to see the website.

To disable caching and enable debugging, create a `app/config/local.php` file with the following:

```php
<?php
define('CACHING_ENABLED', false);
define('DEBUG', true);
```

Without cache, the website might be slow because of the inclusion of remote files (through HTTP). You can disable that
locally by adding this to your `local.php`:

```php
define('DISABLE_INCLUDE', true);
```

## Automatic documentation generation (API-Reference)

To generate the API reference docs for the first time, you need to have a Matomo checkout. The generator will use it to
parse the PHP code and extract the documentation. So you need to clone the Matomo repository and install the dependencies
for the generator.

Clone Matomo repository into the subdirectory `piwik`:

    git clone git@github.com:matomo-org/matomo.git piwik

Download the dependencies for our generator:

    cd generator/
    composer install

To generate the API reference docs execute

    ./generate.sh

The script checks out the latest stable version of Matomo and generates the API reference docs for it. This takes some time.

The documents will be generated into the [docs/generated](docs/generated) directory. It will always generate the documentation for the latest stable version.

To generate, commit and push the API reference docs to the `live` branch execute

    ./generateAndPush.sh

## How to add docs for a new Matomo version

* Increase version number for `LATEST_PIWIK_DOCS_VERSION` in `config/app.php`
* Copy the previous documentation folder to the new one eg `cp docs/4.x docs/5.x -R`
* Add a new line to `generate.sh` eg `generateDocs "4.x-dev" "4.x"` similar to the other ones. You might also want to copy the generation success detection.
* Copy pictures from the previous version into latest version eg from `public/img/3.x` to `public/img/4.x` and update all needed pictures.
* In `app/routes/page.php` we might need to update the branch for the latest `CHANGELOG` version in the `/changelog` route
  see eg https://github.com/matomo-org/developer-documentation/blob/0.1.0/app/routes/page.php#L156  . It will be important that
  we merge all changes to the changelog for different Matomo versions into the changelog of the latest Matomo version as we currently
  want to show one changelog across all versions.

## How to manage docs for different Matomo versions

So far, docs can be put into `docs/2.x`, `docs/3.x` and directly under `docs/`. If eg a guide is requested for Piwik 2,
we first look for docs in `docs/2.x` and if not found for docs in `docs/`. This allows us to have some pages always the
same, eg "Support" page, "Matomo Core Development", etc. So far I have left all guides under `docs/` as not many docs will
actually change for Matomo 3. This way, when changing a document under `docs/` it will be updated for Piwik 2 and Matomo 3.

As soon as something on a guide changes for Matomo 3, we should copy that article into docs/2.x and afterwards make
adjustments on the content for Matomo 3.

If a guide will be removed for a newer Matomo version and does not exist in the latest Matomo version anymore we should setup
a redirect in `app/helpers/Redirects.php` eg to redirect `/guides/pages` to `/2.x/guides/pages`. This can be optional as
the 404 Error page would suggest to open that page.

### When does an article need to be copied into a versioned docs folder?

* When an article references a resource / URL that is not available for another Matomo version. For example an article links
to the API reference guide to a class that is not available in another Matomo version
* When links for some reason are not the same for 2 different Matomo versions in general
* When an article references eg menu items or something else but it is not the same across Matomo versions. For example
there is no user menu in Matomo 3 anymore, or Plugin Settings are now split into "Personal Settings" and "General Settings". In such
a case we need to make a copy of that article as the guide would be wrong otherwise.
* When a submenu is different across Matomo versions. Submenus are usually defined in markdown files, for example under
"Develop => Plugin Basics" submenu items are defined in `develop-plugin-basics.md`. If we eg add a new Import API into Matomo X we
would need to create that new guide under `/docs` so it will be also available for Matomo 4 etc and then copy
 `/docs/develop-plugin-basics.md` into `/docs/2.x/develop-plugin-basics.md` and next add the menu item to
 `/docs/develop-plugin-basics.md`.
* There can be many more reasons. In general if articles are different between 2 versions for various reasons because they mention
eg outdated classes, outdated configs etc or when links break between 2 Matomo versions etc we need to created a copy of that
guide, put it into eg `docs/2.x` and then update the existing article under `/docs`.

### How do we handle images for different Matomo versions?

Images are always stored in a versioned directory. Eg `public/img/2.x/*` and `public/img/3.x/*`. When there is a new Matomo version
 we need to copy all the images from the previous version and put them into a new Matomo directory. In guides you would still
 reference an image via `/img/myimage.jpg` and the Markdown parser will add the path for the currently selected Matomo version and
 turn it into either eg `/img/2.x/myimage.jpg` or `/img/3.x/myimage.jpg`. With a new Matomo version often the UI changes and this way
 it keeps things simple by having always different images and by not using the same image across different Matomo versions.


## Writing guides

Just edit the `docs/*.md` files. Any change you make there should be available on the developer website within a minute.

Guides are written using Markdown. [CommonMark](http://commonmark.org/) and [Markdown Extra](https://en.wikipedia.org/wiki/Markdown_Extra) are supported.

In addition:

- headers have an autogenerated HTML ID (so that they can be linked to). You can also use Markdown Extra to explicitly define it: `## Some title {#some-title-id}`
- you can include remote files as-is using:
  - `{@include http://example.com/file.xml}`: the content is **not** escaped
  - `{@include escape http://example.com/file.xml}`: the content will be escaped

### Adding a new guide

Create a new Markdown file in `docs/` and use YAML Front Matter to configure it:

```markdown
---
category: Develop
---
# The title

Lorem ipsum…
```

**YAML Front Matter** is YAML embedded at the top of Markdown files. It is commonly used to define metadata, and we use it to define several items:

- `category`: the name of the category (Develop, Integrate, Design, API Reference)
- `subGuides`: allows you to define a list of sub-guides (will appear in the left sidebar)
- `previous`: allows you to define the previous guide (a link will be added at the end of the guide, it does not affect the sidebar)
- `next`: allows you to define the next guide (a link will be added at the end of the guide, it does not affect the sidebar)

A guide must be either added to a category menu or set as a "sub-guide" of another guide. It cannot be both (else it will appear twice in the left sidebar).

To add a guide to a category (i.e. it will appear in the left sidebar) edit the PHP class for the category (in `app/helpers/Content/Category`).

### Adding the new guide to a menu item

Some menu items need to be added by adding the markdown filename without the `.md` in one of these [category classes](https://github.com/matomo-org/developer-documentation/tree/live/app/helpers/Content/Category).

Some submenu items need to be added as a subguide [see for example this example](https://raw.githubusercontent.com/matomo-org/developer-documentation/live/docs/4.x/develop-plugin-basics.md).

It really depends submenu item which one you need to edit. If the parent menu item defines it's submenu items in a category class, then you need a new entry there. Otherwise you need to edit the markdown file for the parent menu item and add a new entry to `subGuides`.

Please note that also the `category:` in the beginning of your guide needs to match the name of the category this page should be in. The category name can be for example `Develop`, `DevelopInDepth`, `Integrate` or `API Reference`.

## Supported inline tags in PHP comments

The following tags can be used in PHP docblocks so that they can be turned to links in the API reference.

```
{@hook Request.dispatch}                    // link to Request.dispatch hook
{@hook Request.dispatch description text}   // link to Request.dispatch hook with different link text
{@hook # description}                       // link to hooks page
```

Note: In contrast to @link we do not check whether a hook with the given name exists.

```
{@link Map}                  // class within this namespace
{@link Piwik\DataTable\Map}  // full classname
{@link \Exception}           // php internal class
{@link serialize()}          // php internal function
{@link getKeyName()}         // method within this class
{@link $myproperty}          // property within this class
{@link INDEX_NB_UNIQ_VISITORS}  // constant within this class, note: a link will be only generated if the constant has a long description
{@link Map::getKeyName()}    // method from any class
{@link Map::$myproperty}     // property from any class
{@link Piwik\Metrics::INDEX_NB_UNIQ_VISITORS}  // constant from any class, note: a link will be only generated if the constant has a long description
{@link http://matomo.org}    // http link
{@link https://matomo.org}   // https link
{@link mailto:test}          // mailto link


{@link Map Description Text}                  // class within this namespace
{@link Piwik\DataTable\Map Description Text}  // full classname
{@link \Exception Description Text}           // php internal class
{@link getKeyName() Description Text}         // method within this class
{@link $myproperty Description Text}          // property within this class
{@link Map::getKeyName() Description Text}    // method from any class
{@link Map::$myproperty Description Text}     // property from any class
{@link http://matomo.org Description Text}    // http link
{@link https://matomo.org Description Text}   // https link
{@link mailto:test Description Text}          // mailto link
```
