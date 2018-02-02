#!/usr/bin/env bash

# TODO share this between script (in an include)
if [ -f .env ]
then
    source .env
else
    echo "Please run this script from project root, and check .env file as it is mandatory"
    echo "If it is missing a quick solution is :"
    echo "ln -s .env.travis .env"
    exit 42
fi

if [ -z "${DBHOST}" ]
then
    echo "Please add DBHOST in .env file as it is mandatory"
    exit 42
fi

psql -w -h ${DBHOST}  -U ${DBROOTUSER} -d ${DBAPPNAME} <<EOF
SELECT 'Hello ${DBAPPUSER}'
EOF

psql -w -h ${DBHOST}  -U ${DBROOTUSER} -d ${DBAPPNAME} <<EOF
SELECT 'Hello ${DBAPPUSER}'
EOF
