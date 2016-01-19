#!/bin/shell
#
# Shell script used to setup the App DB
#

composer dumpautoload

sudo -u postgres psql -c "DROP DATABASE swiss;"
sudo -u postgres psql -c "CREATE DATABASE swiss OWNER homestead;"

php artisan migrate --verbose
