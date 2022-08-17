FROM composer as composer
WORKDIR /app

COPY src/composer.json composer.json
COPY src/composer.lock composer.lock

RUN composer install \
    --no-dev \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --optimize-autoloader

COPY ./src .
RUN composer dump-autoload

FROM php:8.1-apache
WORKDIR /var/www/root

COPY --from=composer /app/vendor /var/www/root/vendor
COPY ./src .

RUN a2enmod rewrite
