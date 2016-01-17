#!/bin/bash
#
# Script used to restart the testing database.
#

echo "Restarting swiss test sqlite db."

composer dump-autoload

rm    database/testing_db.sqlite
touch database/testing_db.sqlite

php artisan migrate --env=testing --database=sqlite --force
