#!/usr/bin/env bash
set -ex

mkdir --parents "${HOME}/bin"

if [ "${WHORUN}" = travis  ]
then
    # Ugly hack
    echo "memory_limit=-1" >> ~/.phpenv/versions/$(phpenv version-name)/etc/conf.d/travis.ini

fi
