#!/bin/bash

DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
cd $DIR
git checkout docs/*/generated
rm -rf docs/*/cache
mkdir docs/*/cache
rm -rf docs/*/generated
mkdir docs/*/generated
cd piwik
git reset --hard
git submodule foreach --recursive git reset --hard
git clean -f -d
git submodule foreach git clean -f
git fetch
git checkout master
git pull origin master
git submodule update --recursive --force
php composer.phar install || true
cd ..
php generator/generate.php --branch=master --targetname=2.x
GENERATION_SUCCESS=$?

if [ $GENERATION_SUCCESS -ne 0 ]; then
  exit 1;
fi

php generator/generate.php --branch=3.x-dev --targetname=3.x

GENERATION_SUCCESS=$?
rm -rf app/tmp/cache/*

if [ $GENERATION_SUCCESS -ne 0 ]; then
  exit 1;
fi
