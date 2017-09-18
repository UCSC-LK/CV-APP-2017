#!/bin/sh
DIR=`date +%m%d%y`
TIE=`date +%s`
DEST=/db_backups/$DIR/$TIE
mkdir -p $DEST
mongodump -h localhost -d databsename -u username -p password -o $DEST

# 0 * * * * /backup_script.sh
