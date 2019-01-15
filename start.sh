#!/usr/bin/env bash
cd ./Backend/
composer install
php bin/console doctrine:migrations:migrate
php bin/console server:run