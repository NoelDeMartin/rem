#!/usr/bin/env bash

if [[ $(type -t rem-cli) != function ]]; then
    echo "Don't call scripts directly, use the rem binary!"

    exit;
fi

rem-docker-compose up -d
rem-cli publish-assets
