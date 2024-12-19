#!/usr/bin/env bash

if [[ $(type -t rem-cli) != function ]]; then
    echo "Don't call scripts directly, use the rem binary!"

    exit;
fi

if ! rem_is_running; then
    echo "Can't publish assets if app is not running!"

    exit
fi

containerid=`rem-docker-compose ps --quiet app`
containername=`docker ps --filter "id=$containerid" --format="{{.Names}}"`

rm $base_dir/public/* -rf
docker cp "$containername:/app/public/." "$base_dir/public"
ln -s "$base_dir/storage/app/public/img/applications" "$base_dir/public/img/applications"
