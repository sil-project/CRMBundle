#!/usr/bin/env sh
set -ev

# Ugly hack
echo "memory_limit=-1" >> ~/.phpenv/versions/$(phpenv version-name)/etc/conf.d/travis.ini

composer self-update --stable

composer global require --no-interaction cedx/coveralls

mkdir -p ${HOME}/bin

ln -s ${HOME}/.config/composer/vendor/bin/coveralls ${HOME}/bin/coveralls


