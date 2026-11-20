FROM composer:2 AS composer
FROM node:22-bookworm-slim AS node
FROM php:8.3-fpm-bookworm

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        cron git unzip \
        libfreetype6-dev libicu-dev libjpeg62-turbo-dev \
        libonig-dev libpng-dev libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" \
        bcmath exif gd intl mbstring opcache pdo_mysql zip \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer /usr/bin/composer /usr/local/bin/composer
COPY --from=node /usr/local/bin/node /usr/local/bin/node
COPY --from=node /usr/local/lib/node_modules /usr/local/lib/node_modules
RUN ln -s /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm \
    && ln -s /usr/local/lib/node_modules/npm/bin/npx-cli.js /usr/local/bin/npx

COPY infra/php/crontab /etc/cron.d/laravel
RUN sed -i 's/\r$//' /etc/cron.d/laravel \
    && chmod 0644 /etc/cron.d/laravel

WORKDIR /var/www/html
