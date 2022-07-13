FROM php:8.0-fpm

ENV DATA_ROOT /data

WORKDIR ${DATA_ROOT}

RUN apt-get update \
    && apt-get install -y wget git unzip libpq-dev libicu-dev libpng-dev libzip-dev libjpeg-dev libfreetype6-dev\
    && docker-php-ext-install pdo_mysql pcntl zip \
    && docker-php-ext-install exif


# Use the default production configuration
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

RUN mkdir -p ${DATA_ROOT}/public


ENV PATH="$PATH:/var/www/vendor/bin"
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer


WORKDIR /var/www
COPY composer.json composer.lock ./
RUN composer install --no-scripts --no-interaction --no-autoloader
COPY deploy/php-fpm/php.ini /usr/local/etc/php.ini

