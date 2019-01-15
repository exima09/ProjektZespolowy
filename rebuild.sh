#!/usr/bin/env bash
RED=`tput setaf 1`
NC=`tput sgr0` # No Color
cd ./Backend/
composer install
php bin/console doctrine:migrations:migrate
cd ../Frontend/
npm install
echo "${RED}Wybuchnie za..."
for i in 5 4 3 2 1
do
  echo ${i};
  sleep 1s
done
echo "${NS}"
