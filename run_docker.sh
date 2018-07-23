#!/bin/bash

docker run --name appdb -d -p 15432:5432 -e POSTGRES_PASSWORD=dockerci -e POSTGRES_USER=dockerci -e POSTGRES_DB=dockerci postgres:9.6
docker run --name appredis -d -p 16379:6379 redis
docker run --name appweb -e APPLICATION_ENV=docker --link appdb --link appredis -d -p 8000:80 php:7.1-apache-jessie
docker exec -i appweb bash -c "a2enmod rewrite"
docker exec -i appweb bash -c "apt-get update && apt-get install -y gnupg vim git curl nodejs wget sudo postgresql-common postgresql-client libpq-dev zlib1g-dev libicu-dev g++ libgmp-dev libmcrypt-dev libbz2-dev libpng-dev libjpeg62-turbo-dev libfreetype6-dev libfontconfig"
docker exec -i appweb bash -c "docker-php-ext-install iconv pdo pgsql pdo_pgsql intl bcmath gmp bz2 zip mcrypt"
docker exec -i appweb bash -c "docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/"
docker exec -i appweb bash -c "docker-php-ext-install gd"
docker exec -i appweb bash -c "pecl install -o -f redis"
docker exec -i appweb bash -c "docker-php-ext-enable redis"
docker restart appweb

docker cp $(pwd)/. appweb:/var/www
