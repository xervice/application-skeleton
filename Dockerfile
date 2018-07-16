FROM php:7.1-apache
MAINTAINER Mike Bertram <contact@mibexx.de>

RUN apt-get update \
 && apt-get install -y zlib1g-dev vim wget git curl zip libpcre3-dev libpq-dev\
 && docker-php-ext-install zip opcache pgsql pdo_pgsql \
 && a2enmod rewrite

RUN curl --silent --show-error https://getcomposer.org/installer | php

ADD . /var/www/project

RUN rm -rf /var/www/html \
 && ln -s /var/www/project/public /var/www/html

#RUN wget -q -O - https://packagecloud.io/gpg.key | apt-key add - \
# && echo "deb http://packages.blackfire.io/debian any main" | tee /etc/apt/sources.list.d/blackfire.list \
# && apt-get update \
# && apt-get install -y blackfire-agent \
# && apt-get install blackfire-php


