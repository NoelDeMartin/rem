#!/usr/bin/env bash

if [[ $(type -t rem-cli) != function ]]; then
    echo "Don't call scripts directly, use the rem binary!"

    exit;
fi

# Abort on errors
set -e

# Pull new code
git -C $base_dir pull

# Update nginx-agora
# TODO if nginx-agora is configured, regenerate and copy nginx config

# Update containers
rem-docker-compose pull

if rem_is_running; then
    rem-cli restart
    rem-docker-compose exec app php artisan config:cache
    rem-docker-compose exec app php artisan event:cache
    rem-docker-compose exec app php artisan optimize
    rem-docker-compose exec app php artisan route:cache
    rem-docker-compose exec app php artisan view:cache
    rem-docker-compose exec app php artisan migrate --force
else
    rem-docker-compose run --rm app php artisan config:cache
    rem-docker-compose run --rm app php artisan event:cache
    rem-docker-compose run --rm app php artisan optimize
    rem-docker-compose run --rm app php artisan route:cache
    rem-docker-compose run --rm app php artisan view:cache
    rem-docker-compose run --rm app php artisan migrate --force
fi

echo "Updated successfully!"
