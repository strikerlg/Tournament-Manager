#!/bin/bash
#
# Script used to update the dump file.
#

echo "Generating psql dump of the swiss DB."

sudo -u postgres pg_dump swiss > dump/swiss.sql
