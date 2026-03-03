#!/bin/bash

############################################################
# Help                                                     #
############################################################
Help()
{
   # Display Help
   echo "DDEV setup script for Developer Documentation"
   echo
   echo "Syntax: scriptTemplate [-w|h]"
   echo "options:"
   echo "a     Audit for security vulnerability advisories"
   echo "h     Print this Help."
   echo
}

Audit()
{
    ddev exec -d /var/www/html/app composer audit --locked 2> /dev/null
}

while getopts ":b:ah" option; do
   case $option in
      a) # display security vulnerability advisories
         Audit 
         exit;;
      h) # display Help
         Help
         exit;;
   esac
done

# Setup ddev if it has not been done yet
if test -d .ddev; then
  echo "DDEV already setup"
else
    ddev config --project-name=devdocs --project-type=php --docroot="app/public" --php-version=8.2 \
        --webserver-type=apache-fpm --composer-version=2 --corepack-enable=false --xdebug-enabled=false
fi

ddev start
ddev exec -d /var/www/html/app composer install
if test -d app/tmp/cache; then
    echo "Cache directory already created"
else
    ddev exec -d /var/www/html/app mkdir tmp/cache
fi

if test -d app/tmp/templates; then
    echo "Template directory already created"
else
    ddev exec -d /var/www/html/app mkdir tmp/templates
fi

Audit
