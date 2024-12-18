#!/usr/bin/env bash

if [[ $(type -t rem-cli) != function ]]; then
    echo "Don't call scripts directly, use the rem binary!"

    exit;
fi

if ! rem_is_running; then
    echo "App is not running!"

    exit
fi

service=${1:-app}

rem-docker-compose exec $service sh
