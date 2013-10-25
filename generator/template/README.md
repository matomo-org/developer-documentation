sami-github
====

[![Latest Stable Version][]](https://packagist.org/packages/phine/sami-github)
[![Total Downloads][]](https://packagist.org/packages/phine/sami-github)

A Sami theme for GitHub Markdown formatted documentation.

Usage
-----

```php
use Sami\Sami;
use Sami\Version\GitVersionCollection;
use Symfony\Component\Finder\Finder;

$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->exclude('Resources')
    ->exclude('Tests')
    ->in($dir = '/path/to/symfony/src')
;

$versions = GitVersionCollection::create($dir)
    ->addFromTags('v2.0.*')
    ->add('2.0', '2.0 branch')
    ->add('master', 'master branch')
;

return new Sami($iterator, array(
    'theme'                => 'github',
    'versions'             => $versions,
    'title'                => 'Symfony2 API',
    'build_dir'            => __DIR__.'/../build/sf2/%version%',
    'cache_dir'            => __DIR__.'/../cache/sf2/%version%',
    // use a custom theme directory
    'template_dirs'        => array(__DIR__.'/themes/sami-github'),
    'default_opened_level' => 2,
));
```

Requirement
-----------

- PHP >= 5.3.3
- [Sami][] >= 1.1.0

Installation
------------

Via [Composer][]:

    $ composer require "phine/sami-github=~1.0"

License
-------

This library is available under the [MIT license](LICENSE).

[Latest Stable Version]: https://poser.pugx.org/phine/sami-github/v/stable.png
[Total Downloads]: https://poser.pugx.org/phine/sami-github/downloads.png
[Sami]: http://sami.sensiolabs.org/
[Composer]: http://getcomposer.org/
