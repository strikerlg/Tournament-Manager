#!/bin/bash
#
# Script used to update the Database using the dump file.
#

echo "Restoring psql dump of the swiss DB into psql."

if [ -f dump/swiss.* ]; then
    psql swiss < dump/swiss
else
    echo "The dump file wasn't found."
fi
