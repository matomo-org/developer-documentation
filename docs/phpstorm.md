---
category: DevelopInDepth
---
# PhpStorm

At Matomo we're using mostly PhpStorm for Matomo development. It's great at detecting errors and comes with a lot of features for refactoring and generating code.

## Setting Up PhpStorm for Matomo

To be defined. (Steps to setup phpunit, xdebug, etc.)

## Tips for using PhpStorm

To be defined.

### Multi-line edit

If you need to edit multiple lines in the same way, for example, to add a `[` or `=>` prefix to multiple lines, you can save a lot of time by using the "Column Selection Mode". Click on "Column Selection Mode" in the Edit menu or use the keyboard shortcut (varies by OS). If you currently select text it will create multiple cursors, one for each line of text. If not, you can create new cursors by clicking w/ a special key (alt + left click on Ubuntu).

### Quickly getting the full path of a file

PHPStorm allows copying the path of a file by right clicking on a file tab header and selecting 'Copy Path...'. This will provide several options, but if you just need the absolute path, you can use a shortcut. On Ubuntu it is 'Ctrl + Shift + C'. This can be useful if you want to run a test on the command line, for example.
