---
category: DevelopInDepth
---
# PHP

## Xdebug

### Recommended settings for Xdebug 3 and newer

```
[xdebug]
xdebug.mode=debug
xdebug.start_with_request=yes
xdebug.log_level = 0
```

The following configuration can be useful also to debug from the command line:

```ini
[xdebug]
zend_extension="xdebug.so"
xdebug.mode=debug
xdebug.start_with_request=yes
xdebug.log_level = 0
xdebug.max_nesting_level = 10001
```

## Compiling PHP beta versions before their release

A quick [guide on how to compile PHP](https://guides.lw1.at/books/compiling-php-for-development) to be able to test Matomo with it:


