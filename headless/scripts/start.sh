#!/usr/bin/env bash

if [[ $(type -t rem-cli) != function ]]; then
    echo "Don't call scripts directly, use the rem binary!"

    exit;
fi

rem-docker-compose up -d

# Publish assets
if ! rem_is_running; then
    exit
fi

containerid=`rem-docker-compose ps --quiet app`
containername=`docker ps --filter "id=$containerid" --format="{{.Names}}"`

rem-docker-compose run --rm app php artisan storage:unlink
rem-docker-compose run --rm app php artisan storage:link --relative

rm $base_dir/public/* -rf
docker cp "$containername:/app/public/." "$base_dir/public"
