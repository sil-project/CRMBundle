#!/usr/bin/env sh
set -ev

mkdir --parents "${HOME}/bin"

composer install --no-interaction --prefer-dist

# composer update --prefer-dist --no-interaction --prefer-stable



