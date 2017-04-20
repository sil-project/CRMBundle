#!/usr/bin/env sh
set -ev

# To be removed when following PR will be merged: https://github.com/travis-ci/travis-build/pull/718
#composer self-update --stable

composer self-update
sed --in-place "s/\"dev-master\":/\"dev-${TRAVIS_COMMIT}\":/" composer.json