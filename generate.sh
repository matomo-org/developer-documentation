#!/bin/bash

DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

function generateDocs {
    echo "generating $1 - $2"
    git checkout docs/$2/generated
    rm -rf docs/$2/cache
    mkdir docs/$2/cache
    rm -rf docs/$2/generated
    mkdir docs/$2/generated

    cd piwik
    git rm --cached -r . > /dev/null 
    git reset --hard > /dev/null 
    git submodule foreach --recursive git reset --hard
    git clean -f -d
    git submodule foreach git clean -f
    git fetch
    git checkout $1
    branchname=$(git rev-parse --abbrev-ref HEAD)
    if [ "$branchname" != "$1" ]; then
       echo "Not on correct branch"
      return
    fi
    sleep 4
    git rev-parse --abbrev-ref HEAD
    git pull origin $1
    sleep 3
    git submodule update --recursive --force
    php ../app/composer.phar self-update
    php ../app/composer.phar install || true
    cd ..
    sleep 4
    php generator/generate.php --branch=$1 --targetname=$2

    GENERATION_SUCCESS=$?

    if [ $GENERATION_SUCCESS -ne 0 ]; then
      exit 1;
    fi
}

cd $DIR
generateDocs "4.x-dev" "4.x"
rm -rf app/tmp/cache/*

