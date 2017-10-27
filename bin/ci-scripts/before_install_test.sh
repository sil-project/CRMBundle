#!/usr/bin/env sh
set -ev

# check syntax
find . -name '*.php' -exec php -l {} \;

composer self-update --stable




