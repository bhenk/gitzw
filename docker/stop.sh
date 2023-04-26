#!/usr/bin/env bash

result="$(docker compose stop)"
echo "## Docker down ################$result--"
exit 0

