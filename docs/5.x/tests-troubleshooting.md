---
category: Develop
title: Troubleshooting
---

# Troubleshooting Matomo Tests

If you have problems with running Matomo tests see below.

If you cannot solve your issues please [ask in the forums](https://forum.piwik.org/list.php?9)

## Using latest GIT version

On ubuntu to use the latest GIT:

```
sudo add-apt-repository ppa:git-core/ppa
sudo apt-get update
sudo apt-get upgrade
```

## Troubleshooting failing tests

If you get any of these errors:
 * `RuntimeException: Unable to create the cache directory ( matomo/tmp/templates_c/66/77).`
 * or `fopen( matomo/tmp/latest/testgz.txt): failed to open stream: No such file or directory`
 * or `Exception: Error while creating the file: matomo/tmp/latest/LATEST`
 * or `PHP Warning:  file_put_contents( matomo/tmp/logs/piwik.test.log): failed to open stream: Permission denied in [..]`

On your dev server, give your user permissions to write to the directory:

    $ sudo chmod 777 -R matomo/tmp/

**If you get the MySQL error number `2002`**, try changing the `[database_tests] host` config option to `"127.0.0.1"`.
