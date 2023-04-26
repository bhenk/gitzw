#!/usr/bin/env bash

while getopts f: flag; do
  case "${flag}" in
  f) follow_logs=${OPTARG} ;;
  *) ;;
  esac
done

B_GREEN="\E[1;42m"
C_WHITE="\E[1;97m"
C_END="\E[0m "

result="$(docker compose up -d)"
echo "## Docker up ################$result--"

docker ps

addr="$(ifconfig | sed -En 's/127.0.0.1//;s/.*inet (addr:)?(([0-9]*\.){3}[0-9]*).*/\2/p')"
echo "---------------------------------------------"
echo "serving on http://localhost:8081"
[ -z "$addr" ] && echo "--" || printf "\n$B_GREEN$C_WHITE  network addresses  $C_END\n%s:8081\n" "$addr"
printf "$B_GREEN$C_WHITE  -----------------  $C_END%s\n\n" ""

if [[ $follow_logs == p* ]]; then
  echo "Following apache logs ######################"
  docker logs -f docker-php-1
elif [[ $follow_logs == d* ]]; then
  echo "Following database logs ####################"
  docker logs -f docker-db-1
elif [[ $follow_logs == a* ]]; then
  echo "Following adminer logs ######################"
  docker logs -f docker-adminer-1
else
  echo -e "Usage: up [-f {p | php | d | db | a | adminer} to follow logs ]\n"
fi
