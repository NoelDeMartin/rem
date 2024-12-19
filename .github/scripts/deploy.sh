#!/usr/bin/env bash

if [ -z $GITHUB_TOKEN ]; then
    echo "GITHUB_TOKEN missing from env"

    exit 1
fi

git clone https://${GITHUB_ACTOR}:${GITHUB_TOKEN}@github.com/${GITHUB_REPOSITORY}.git headless -b headless
rm headless/* -rf
rm deployment/Dockerfile
cp deployment/* headless/ -r
cp deployment/.env.example headless/
cp storage/ headless/ -r

if [[ -z `git -C headless status --short` ]]; then
    echo "No changes to apply!"

    exit;
fi

cd headless
git config user.name 'github-actions[bot]'
git config user.email 'github-actions[bot]@users.noreply.github.com'
git add -A
git commit -m '[github-actions] Update'
git push

echo "Headless branch updated!"
