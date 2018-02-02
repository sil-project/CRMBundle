#!/usr/bin/env bash
set -ev

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




##################
#### POSTGRES ####


# TODO
# should remove db info from  app/config/config_test.yml
# and use sed or etcd or confd or both to update parameters.yml.dist or create parameters.yml
# sed -e s/'database_host: 127.0.0.1'/'database_host: ${DBHOST}'/g -i app/config/parameters.yml.dist
if [ -n "${DBHOST}" ]
then

    if [ -f  Tests/Resources/App/config/parameters.yml ]
    then
        sed -e s/'127.0.0.1'/${DBHOST}/g -i Tests/Resources/App/config/parameters.yml
        sed -e s/'blast_test_user'/${DBAPPUSER}/g -i Tests/Resources/App/config/parameters.yml
        sed -e s/'blast_test_password'/${DBAPPPASSWORD}/g -i Tests/Resources/App/config/parameters.yml
        sed -e s/'blast_test_db'/${DBAPPNAME}/g -i Tests/Resources/App/config/parameters.yml
        cat Tests/Resources/App/config/parameters.yml
    fi

    #TODO
    # should use env var from etcd (for password)
    echo  ${DBHOST}:5432:*:${DBROOTUSER}:${DBROOTPASSWORD} >> $HOME/.pgpass
    echo  ${DBHOST}:5432:*:${DBROOTUSER}:${DBROOTPASSWORD} >> $HOME/.pgpass
    chmod 600  $HOME/.pgpass
    cat  $HOME/.pgpass
fi
