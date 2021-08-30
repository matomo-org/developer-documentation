---
category: DevelopInDepth
---
# PHP

## Xdebug

### Recommended settings for Xdebug 3 and newer

```ini
[xdebug]
xdebug.mode=debug
xdebug.start_with_request=yes
xdebug.log_level = 0
```

This can be useful for also debugging php invoked from the CLI.


### Note

Be sure to avoid loading the Zend extensions in the wrong order. See

```bash
# THIS IS CORRECT
php -v
PHP 8.0.9 (cli) (built: Jul 29 2021 08:52:24) ( NTS )
Copyright (c) The PHP Group
Zend Engine v4.0.9, Copyright (c) Zend Technologies
    with Zend OPcache v8.0.9, Copyright (c), by Zend Technologies
    with Xdebug v3.0.4, Copyright (c) 2002-2021, by Derick Rethans
```

Make sure it is NOT:

```bash
# THIS IS WRONG
PHP 8.0.9 (cli) (built: Jul 29 2021 08:52:24) ( NTS )
Copyright (c) The PHP Group
Zend Engine v4.0.9, Copyright (c) Zend Technologies
    with Xdebug v3.0.4, Copyright (c) 2002-2021, by Derick Rethans
    with Zend OPcache v8.0.9, Copyright (c), by Zend Technologies
```

You can see how things are load and in which order with

`php -i # equivalent to <?php phpinfo();`.

## Compiling PHP beta versions before their release

A quick [guide on how to compile PHP](https://guides.lw1.at/books/compiling-php-for-development) to be able to test Matomo with it:

