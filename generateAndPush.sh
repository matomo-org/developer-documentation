#!/bin/bash

DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
cd $DIR
git checkout docs/*/generated
git pull
./generate.sh
GENERATION_SUCCESS=$?
if [ $GENERATION_SUCCESS -ne 0 ]; then
  echo -e "Failed to generate documentation" 1>&2;
  exit 1;
fi
git add docs/*/generated
DELETED_FILES=$(git ls-files --deleted docs/*/generated)
if [ -n "$DELETED_FILES" ]; then
  git rm $DELETED_FILES
fi
git commit -m 'updated plugins API documentation'
git push origin live