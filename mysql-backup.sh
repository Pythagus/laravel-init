#!/bin/bash
# From the tutorial: https://www.folio3.com/5-easy-steps-on-scheduling-mysql-database-backup-using-cron

error() {
  echo -e "\e[31m$1\e[0m"
  exit
}

if [ ! -f ./.env ] ; then
  error "You should generate the .env file" 
fi

source ./.env
DATE=`date +"%d_%b_%Y_%H%M"`
SQL_FILE=$STORAGE"/db_"$DATE".sql"
