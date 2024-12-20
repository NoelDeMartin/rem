#!/usr/bin/env bash

if [[ $(type -t rem-cli) != function ]]; then
    echo "Don't call scripts directly, use the rem binary!"

    exit;
fi

WWWDATA_UID=`rem-docker-compose run --rm app id -u www-data | tail -n 1 | sed 's/\r$//'`

if [ -z $WWWDATA_UID ]; then
    echo "Could not set permissions"

    exit 1
fi

sudo chown -R $WWWDATA_UID:docker storage
sudo chown -R $WWWDATA_UID:docker database
