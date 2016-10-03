# Piwik Developer Documentation

- http://piwik.org
- http://developer.piwik.org

## Documentations

- [Index](docs/generated/master/Index.md)
- [Classes](docs/generated/master/Classes.md)
- [Namespaces](docs/generated/master/Namespaces.md)
- [Hooks](docs/generated/master/Hooks.md)
- [Guides](docs)

## Run locally

```bash
$ cd app/
$ composer install
$ cd public/
$ php -S 0.0.0.0:8000
```

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

### The first time
```
# Clone Piwik repository the first time
git clone git@github.com:piwik/piwik.git piwik
# Download the dependencies for our generator 
cd generator/
composer install
cd ../piwik/
# Now we download composer  https://getcomposer.org/download/
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('SHA384', 'composer-setup.php') === 'e115a8dc7871f15d853148a7fbac7da27d6c0030b848d9b3dc09e2a0388afed865e6a3d6b3c0fad45c48e2b5fc1196ae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
```

### Generate the API reference docs
- Execute `./generate.sh`
- Commit
- Push

or just execute `./generateAndPush.sh`.

The documents will be generated into the [docs/generated](docs/generated) directory. It will always generate the documentation for the master as well as for the latest stable version.

## How to add docs for a new Piwik version

* Increase version number for `LATEST_PIWIK_DOCS_VERSION` in `config/app.php`
* Add a new line to `generate.sh` eg `php generator/generate.php --branch=4.x-dev --targetname=4.x` similar to the other ones. You might also want to copy the generation success detection.
* Copy pictures from the previous version into latest version eg from `public/img/3.x` to `public/img/4.x` and update all needed pictures.
* In `app/routes/page.php` we might need to update the branch for the latest `CHANGELOG` version in the `/changelog` route
  see eg https://github.com/piwik/developer-documentation/blob/0.1.0/app/routes/page.php#L156  . It will be important that
  we merge all changes to the changelog for different Piwik versions into the changelog of the latest Piwik version as we currently
  want to show one changelog across all versions.

## How to manage docs for different Piwik versions

So far, docs can be put into `docs/2.x`, `docs/3.x` and directly under `docs/`. If eg a guide is requested for Piwik 2,
we first look for docs in `docs/2.x` and if not found for docs in `docs/`. This allows us to have some pages always the
same, eg "Support" page, "Piwik Core Development", etc. So far I have left all guides under `docs/` as not many docs will
actually change for Piwik 3. This way, when changing a document under `docs/` it will be updated for Piwik 2 and 3.

As soon as something on a guide changes for Piwik 3, we should copy that article into docs/2.x and afterwards make
adjustments on the content for Piwik 3.

If a guide will be removed for a newer Piwik version and does not exist in the latest Piwik version anymore we should setup
a redirect in `app/helpers/Redirects.php` eg to redirect `/guides/pages` to `/2.x/guides/pages`. This can be optional as
the 404 Error page would suggest to open that page.

### When does an article need to be copied into a versioned docs folder?

* When an article references a resource / URL that is not available for another Piwik version. For example an article links
to the API reference guide to a class that is not available in another Piwik version
* When links for some reason are not the same for 2 different Piwik versions in general
* When an article references eg menu items or something else but it is not the same across Piwik versions. For example
there is no user menu in Piwik 3 anymore, or Plugin Settings are now split into "Personal Settings" and "General Settings". In such
a case we need to make a copy of that article as the guide would be wrong otherwise.
* When a submenu is different across Piwik versions. Submenus are usually defined in markdown files, for example under
"Develop => Plugin Basics" submenu items are defined in `develop-plugin-basics.md`. If we eg add a new Import API into Piwik X we
would need to create that new guide under `/docs` so it will be also available for Piwik 4 etc and then copy
 `/docs/develop-plugin-basics.md` into `/docs/2.x/develop-plugin-basics.md` and next add the menu item to
 `/docs/develop-plugin-basics.md`.
* There can be many more reasons. In general if articles are different between 2 versions for various reasons because they mention
eg outdated classes, outdated configs etc or when links break between 2 Piwik versions etc we need to created a copy of that
guide, put it into eg `docs/2.x` and then update the existing article under `/docs`.

### How do we handle images for different Piwik versions?

Images are always stored in a versioned directory. Eg `public/img/2.x/*` and `public/img/3.x/*`. When there is a new Piwik version
 we need to copy all the images from the previous version and put them into a new Piwik directory. In guides you would still
 reference an image via `/img/myimage.jpg` and the Markdown parser will add the path for the currently selected Piwik version and
 turn it into either eg `/img/2.x/myimage.jpg` or `/img/3.x/myimage.jpg`. With a new Piwik version often the UI changes and this way
 it keeps things simple by having always different images and by not using the same image across different Piwik versions.


## Writing guides

Just edit the `docs/*.md` files. Any change you make there should be available on the developer website within a minute.

Guides are written using Markdown. [CommonMark](http://commonmark.org/) and [Markdown Extra](http://en.wikipedia.org/wiki/Markdown_Extra) are supported.

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

## Supported inline tags in PHP comments

The following tags can be used in PHP docblocks so that they can be turned to links in the API reference.

```
{@hook Request.dispatch}                    // link to Request.dispatch hook
{@hook Request.dispatch description text}   // link to Request.dispatch hook with different link text
{@hook # description}                       // link to hooks page
```

Note: In constrast to @link we do not check whether a hook with the given name exists.

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
{@link http://piwik.org}     // http link
{@link https://piwik.org}    // https link
{@link mailto:test}          // mailto link


{@link Map Description Text}                  // class within this namespace
{@link Piwik\DataTable\Map Description Text}  // full classname
{@link \Exception Description Text}           // php internal class
{@link getKeyName() Description Text}         // method within this class
{@link $myproperty Description Text}          // property within this class
{@link Map::getKeyName() Description Text}    // method from any class
{@link Map::$myproperty Description Text}     // property from any class
{@link http://piwik.org Description Text}     // http link
{@link https://piwik.org Description Text}    // https link
{@link mailto:test Description Text}          // mailto link
```
