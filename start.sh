#!/usr/bin/env bash
mkdir logs

chmod -R 777 logs/.

cp env_files/.env ./env

docker-compose down

composer install

docker-compose up -d
>&2 echo "Sleeping for 30 seconds"
sleep 30
>&2 echo "App is ready"
exit 0
