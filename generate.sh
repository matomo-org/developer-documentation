#!/bin/bash

DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
cd $DIR
git checkout docs
rm -rf cache
mkdir cache
rm -rf docs
mkdir docs
php vendor/tsteur/sami/sami.php update generator/config.php
cd piwik
git checkout master
git pull
cd ..
php generator/hooks.php