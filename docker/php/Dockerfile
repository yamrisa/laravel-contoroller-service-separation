FROM php:8.2-fpm

# OSパッケージ
RUN apt-get update && apt-get install -y \
    zip unzip git curl libonig-dev libxml2-dev \
    && docker-php-ext-install pdo_mysql mbstring

# Composer インストール（ここが今回の肝）
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www
