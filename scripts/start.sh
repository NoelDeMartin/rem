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

rem-docker-compose exec app php artisan storage:unlink
rem-docker-compose exec app php artisan storage:link --relative

rm $base_dir/public -rf
rem-docker-compose cp "app:/app/public/." "$base_dir/public"
