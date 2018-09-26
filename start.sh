#!/usr/bin/env bash
docker-compose down

composer install

docker-compose up -d

cp env_files/.env ./.env

>&2 echo "Sleeping for 30 seconds"
sleep 30

>&2 echo "App is ready"
exit 0
