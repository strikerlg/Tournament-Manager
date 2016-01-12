#!/bin/bash
#
# Script used to update the dump file.
#

echo "Generating psql dump of the swiss DB."

mkdir -p dump

pg_dump swiss > dump/swiss
