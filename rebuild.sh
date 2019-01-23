#!/usr/bin/env bash
RED=`tput setaf 1`
NC=`tput sgr0` # No Color
cd ./Backend/
composer install
bin/console doctrine:database:drop --force \
    && bin/console doctrine:database:create \
    && yes | bin/console doctrine:migrations:migrate \
    && bin/console doctrine:migrations:diff \
    && bin/console doctrine:migrations:migrate \
    && yes | bin/console doctrine:fixtures:load
cd ../Frontend/
npm install
echo "${RED}Wybuchnie za..."
for i in 5 4 3 2 1
do
  echo ${i};
  sleep 1s
done
echo "${NS}"
