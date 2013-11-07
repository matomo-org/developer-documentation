Piwik Plugins API documentation generator
=======================

http://piwik.org

## Documentations

 * [Index](docs/master/4. Index.md)
 * [Classes](docs/master/2. Classes.md)
 * [Namespaces](docs/master/1. Namespaces.md)
 * [Hooks](docs/master/Hooks.md)

## License

GPLv3 or later

## Automatic documentation generation (API-Reference)

 * Execute `./generate.sh`
 * Commit
 * Push

or just execute `./generateAndPush.sh`.

The documents will be generated into the [docs/generated](docs/generated) directory. It will always generated the documentations for the master as well as for the latest stable version.

## Manual documentation writing (Guides)

Just edit the `docs/*.md` files. Any change you make there should be available on the developer website within a minute.

## Adding or removing categories

### Adding new guide

Edit the file [app/helpers/Guide.php](app/helpers/Guide.php) and add a new entry to the `menu` function. You need to define the following attributes:

 * `title` The name of the guide that will be displayed on the website
 * `file` The name of the file without the `.md` extension that should be loaded when a user opens the guide. The file has to be placed in the [docs](docs) directory. For instance a value `introduction` matches [docs/introduction.md](docs/introduction.md)
 * `description` The description of the guide. Will be usually displayed below the title on the guides site.
 * `url` The url under which the guide should be available. For instance a value.
 * `callToAction` This is an optional parameter and defines the title of the call to action button.

### Adding a new API-Reference

Works similar as adding a new guide except that you have to make the changes in the file [app/helpers/ApiReference.php](app/helpers/ApiReference.php).

### Adding a new teaser to the home page

Works similar as adding a new guide except that you have to make the changes in the file [app/helpers/Home.php](app/helpers/Home.php).
Please note it is currently not possible to define a file name here. So it is more or less only possible to change existing entries or to add new teasers to external links.
