#!/usr/bin/env sh
set -ex

composer self-update --stable

mkdir -p ${HOME}/bin

# Coveralls client install
wget https://github.com/satooshi/php-coveralls/releases/download/v1.0.1/coveralls.phar --output-document="${HOME}/bin/coveralls"
chmod u+x "${HOME}/bin/coveralls"
