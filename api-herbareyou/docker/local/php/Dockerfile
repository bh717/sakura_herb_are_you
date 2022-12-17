# See https://github.com/Daursu/laradocker/blob/master/docker/php.Dockerfile

# ----------------------
# The FPM base container
# ----------------------
FROM php:7.3-fpm-alpine as dev

RUN apk add -U --no-cache \
    autoconf \
    build-base

RUN docker-php-ext-install -j$(nproc) pdo_mysql

RUN pecl install xdebug

WORKDIR /app

# ----------------------
# Composer install step
# ----------------------
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app

COPY composer.* ./

# RUN composer install \
#     --ignore-platform-reqs \
#     --no-interaction \
#     --no-plugins \
#     --no-scripts \
#     --prefer-dist


# ----------------------
# The FPM production container
# ----------------------
FROM dev

COPY ./docker/local/php/www.conf /usr/local/etc/php-fpm.d/www.conf
COPY ./docker/local/php/php.ini /usr/local/etc/php/php.ini
COPY . /app
# COPY --from=dev /app/vendor/ /app/vendor/

RUN chmod -R 777 /app/storage
RUN chmod 777 /app/bootstrap/cache
