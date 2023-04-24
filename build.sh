#!/usr/bin/env bash

B_RED="\E[1;41m"
B_GRAY="\E[1;47m"
B_GREEN="\E[1;42m"
C_WHITE="\E[1;97m"
C_END="\E[0m "

function checkSuccess() {
  if [ "$1" -eq 0 ]; then
    printf "$B_GRAY %s $B_GREEN$C_WHITE = success!   $C_END\n\n" "$2"
  else
    printf "$B_RED$C_WHITE %s = failure!   $C_END\n" "$2"
    exit 1
  fi
}

# Check if composer is system command or in .phar
composer -v >/dev/null 2>&1
COMPOSER=$?
if [[ $COMPOSER -ne 0 ]]; then
  echo "Composer is not installed"
  FILE=composer.phar
  if test -f "$FILE"; then
    checkSuccess 0 "$FILE exists                "
  else
    printf "Not found: %s            \n" $FILE
    printf "You need composer on your system to install dependencies"
    checkSuccess 1 "Composer not found                  "
    # halt execution
  fi
else
  checkSuccess 0 "Composer is installed              "
fi

# Execute composer
if [[ $COMPOSER -ne 0 ]]; then
  ./composer.phar update
  checkSuccess $? "composer: update                  "
  ./composer.phar --with-dependencies --strict validate
  checkSuccess $? "composer: validate                "
  ./composer.phar install
  checkSuccess $? "composer: install                 "
else
  composer update
  checkSuccess $? "composer: update                  "
  composer --with-dependencies --strict validate
  checkSuccess $? "composer: validate                "
  composer install
  checkSuccess $? "composer: install                 "
fi

phpunit --bootstrap unit/bootstrap.php unit
checkSuccess $? "phpunit: PHPUnit unit tests         "

phpunit --bootstrap unit/bootstrap.php unit_ro
checkSuccess $? "phpunit: PHPUnit unit_ro tests      "

./doc2rst.phar -q docs
checkSuccess $? "doc2rst: install configuration files"

./doc2rst.phar -r docs
checkSuccess $? "doc2rst: generating reStructuredText"

sphinx-build -b html ./docs ./docs/_build/html
checkSuccess $? "sphinx-build: creating html         "
