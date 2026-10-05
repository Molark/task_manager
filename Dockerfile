FROM php:8.4-cli-alpine

RUN apk add --no-cache \
    postgresql-dev \
    libzip-dev \
    && docker-php-ext-install pdo_pgsql zip opcache

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --optimize-autoloader --ignore-platform-req=ext-http

COPY . .

RUN rm -rf var/cache/* \
    && APP_ENV=prod php bin/console cache:clear --no-warmup \
    && APP_ENV=prod php bin/console cache:warmup

EXPOSE 8000

CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
