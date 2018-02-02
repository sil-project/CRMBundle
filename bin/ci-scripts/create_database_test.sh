#!/usr/bin/env bash
set -v

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


# Database creation

###
### mysql
###

# (mysql service is started by default by travis for each build instance
# (mysql travis user is created by travis for each build instance
# mysql -u travis -e 'CREATE DATABASE travis;' -v

###
### postgresql
###

#psql auto password
#echo  localhost:5432:*:postgres:postgres24 >> ~/.pgpass

# needed in .travis.yml
#services:
#  - postgresql
# or here :  sudo /etc/init.d/postgresql start


psql -w -h ${DBHOST} -c "DROP DATABASE IF EXISTS ${DBAPPNAME};" -U ${DBROOTUSER}
psql -w -h ${DBHOST} -c "DROP ROLE IF EXISTS ${DBAPPUSER};" -U ${DBROOTUSER}


# (we try to create a travis user)
psql -w -h ${DBHOST} -c "CREATE USER ${DBAPPUSER} WITH PASSWORD '${DBAPPPASSWORD}';" -U ${DBROOTUSER}
psql -w -h ${DBHOST} -c "ALTER ROLE ${DBAPPUSER} WITH CREATEDB;" -U ${DBROOTUSER}

psql -w -h ${DBHOST} -c "CREATE DATABASE ${DBAPPNAME};" -U ${DBROOTUSER}
psql -w -h ${DBHOST} -c "ALTER DATABASE ${DBAPPNAME} OWNER TO ${DBAPPUSER};" -U ${DBROOTUSER}


psql -w -h ${DBHOST} -c 'CREATE EXTENSION "uuid-ossp";' -U ${DBROOTUSER} -d ${DBAPPNAME}

