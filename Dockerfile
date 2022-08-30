FROM composer as build

COPY ./src /app

RUN composer install \
    --no-dev \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --optimize-autoloader
RUN composer dump-autoload

FROM php:8.1-apache

COPY --from=build /app /var/www/html
COPY ./apache.conf /etc/apache2/sites-enabled/000-default.conf

RUN a2enmod rewrite
