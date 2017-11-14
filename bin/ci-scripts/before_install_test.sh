#!/usr/bin/env sh
set -ev

# check syntax
find . -name '*.php' -exec php -l {} \;

# Ugly hack
echo "memory_limit=-1" >> ~/.phpenv/versions/$(phpenv version-name)/etc/conf.d/travis.ini

composer self-update --stable

composer global require --no-interaction cedx/coveralls
composer global require --no-interaction  phpunit/phpunit 


