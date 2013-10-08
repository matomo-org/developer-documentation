#!/bin/bash

git checkout docs
rm -rf cache
mkdir cache
rm -rf docs
mkdir docs
php vendor/tsteur/sami/sami.php update config.php
cd piwik
git checkout master
git pull
cd ..
php hooks.php