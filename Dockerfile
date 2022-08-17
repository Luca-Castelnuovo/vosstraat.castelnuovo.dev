FROM php:8.1-apache

RUN a2enmod rewrite

RUN apt-get update && apt-get install -y git unzip zip

WORKDIR /var/www/html

COPY --from=composer:2.0 /usr/bin/composer /usr/local/bin/composer
