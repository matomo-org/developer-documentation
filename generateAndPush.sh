#!/bin/bash

cd piwik
git checkout master
git pull
cd ..
git checkout docs
git pull
./generate.sh
git add docs
git add piwik
git commit -m 'updated plugins API documentation'
git push