FROM php:8.1-apache

RUN a2enmod rewrite

WORKDIR /var/www/html

COPY --from=composer:2.0 /usr/bin/composer /usr/local/bin/composer
RUN composer install --no-interaction --no-dev --optimize-autoloader
