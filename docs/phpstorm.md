---
category: DevelopInDepth
---
# PhpStorm

At Matomo we're using mostly PhpStorm for Matomo development. It's great at detecting errors and comes with a lot of features for refactoring and generating code.

## Setting Up PhpStorm for Matomo

**Using single quotes in auto-generated TypeScript**

Matomo uses AirBnB's eslint rules which require the use of single quote strings in TypeScript, but by default PHPStorm inserts double quotes
when auto-generating some TypeScript (like imports). The quote type used can be set by going to: _Settings > Editor > Code Style > TypeScript_,
then clicking the _Punctuation_ tab on the right and setting "Use **single** quotes in new code".

Rest to be defined. (Steps to setup phpunit, xdebug, etc.)

## Tips for using PhpStorm

To be defined.

### Multi-line edit

If you need to edit multiple lines in the same way, for example, to add a `[` or `=>` prefix to multiple lines, you can save a lot of time by using the "Column Selection Mode". Click on "Column Selection Mode" in the Edit menu or use the keyboard shortcut (varies by OS). If you currently select text it will create multiple cursors, one for each line of text. If not, you can create new cursors by clicking w/ a special key (alt + left click on Ubuntu).

### Quickly getting the full path of a file

PHPStorm allows copying the path of a file by right clicking on a file tab header and selecting 'Copy Path...'. This will provide several options, but if you just need the absolute path, you can use a shortcut. On Ubuntu it is 'Ctrl + Shift + C'. This can be useful if you want to run a test on the command line, for example.
