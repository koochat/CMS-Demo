FROM composer:2.10.3 AS composer

FROM php:8.5-fpm-bookworm

WORKDIR /var/www/html

COPY --from=composer /usr/bin/composer /usr/local/bin/composer
