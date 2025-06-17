ARG PHP_VERSION=5.6

FROM php:${PHP_VERSION}-cli as base

WORKDIR /app

FROM base as composer

COPY --from=composer:lts /usr/bin/composer /usr/bin/composer

ENTRYPOINT [ "composer" ]

