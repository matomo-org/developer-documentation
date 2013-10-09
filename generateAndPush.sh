#!/bin/bash

DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
cd $DIR
cd piwik
git checkout master
git pull
cd ..
git checkout docs
git pull
./generate.sh
git add docs
git commit -m 'updated plugins API documentation'
git push