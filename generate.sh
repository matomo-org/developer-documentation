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
git checkout master
git pull
cd ..
php generator/generate.php