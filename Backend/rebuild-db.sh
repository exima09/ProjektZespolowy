#!/bin/bash
bin/console doctrine:database:drop --force \
    && bin/console doctrine:database:create \
    && rm src/Migrations/* \
    && yes |bin/console doctrine:migrations:diff \
    && bin/console doctrine:migrations:migrate \
    && yes | bin/console doctrine:fixtures:load \
    && rm -r config/jwt \
    && mkdir  config/jwt \
    && openssl genrsa -out config/jwt/private.pem -aes256 4096 \
    && openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem \
    && openssl rsa -in config/jwt/private.pem -out config/jwt/private2.pem \
    && mv config/jwt/private.pem config/jwt/private.pem-back \
    && mv config/jwt/private2.pem config/jwt/private.pem
