#!/usr/bin/env sh

cd Resources/doc
sphinx-build -b html -d _build/doctrees . _build/html
