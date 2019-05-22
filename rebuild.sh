#!/usr/bin/env bash
RED=`tput setaf 1`
NC=`tput sgr0` # No Color
cd ./Backend/
bin/console cache:clear
composer install
composer update
bin/console doctrine:database:drop --force
bin/console doctrine:database:create
rm src/Migrations/*
bin/console doctrine:migrations:diff &&
    bin/console -n doctrine:migrations:migrate &&
    bin/console -n doctrine:fixtures:load
rm src/Migrations/*
cd ../Frontend/
npm install
echo "${RED}Wybuchnie za..."
for i in 5 4 3 2 1
do
  echo ${i};
  sleep 1s
done
echo "${NS}"
