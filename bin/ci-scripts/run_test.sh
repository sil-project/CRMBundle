#!/usr/bin/env sh

vendor/phpunit/phpunit/phpunit -v -c phpunit.xml.dist --coverage-clover build/logs/clover.xml

