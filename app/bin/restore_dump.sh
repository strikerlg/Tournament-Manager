#!/bin/bash
#
# Script used to update the Database using the dump file.
#

echo "Restoring psql dump of the swiss DB into psql."

if [ -f ../dump/swiss.* ]; then
    sudo -u postgres psql --username=postgres swiss < ../dump/swiss.sql
else
    echo "The dump file wasn't found."
fi
