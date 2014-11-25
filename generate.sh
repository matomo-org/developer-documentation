#!/bin/bash

DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
cd $DIR
git checkout docs/generated
rm -rf docs/cache
mkdir docs/cache
rm -rf docs/generated
mkdir docs/generated
cd piwik
git reset --hard
git clean -f -d
gif fetch
git checkout master
git pull origin master
cd ..
php generator/generate.php
GENERATION_SUCCESS=$?
rm -rf app/tmp/cache/*

if [ $GENERATION_SUCCESS -ne 0 ]; then
  exit 1;
fi
