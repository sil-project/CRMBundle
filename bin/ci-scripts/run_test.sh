#!/usr/bin/env sh

vendor/phpunit/phpunit/phpunit -c phpunit.xml.dist --coverage-clover build/logs/clover.xml

