#!/bin/bash
#
# Script used to restart the testing database.
#

echo "Restarting swiss test sqlite db."

composer dump-autoload

rm    database/database.sqlite
touch database/database.sqlite

php artisan migrate --env=testing --database=sqlite --force
