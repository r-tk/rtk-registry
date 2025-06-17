ARG PHP_VERSION=8.1

FROM php:${PHP_VERSION}-cli-alpine AS base

WORKDIR /app

FROM base as composer

COPY --from=composer:lts /usr/bin/composer /usr/bin/composer

ENTRYPOINT [ "composer" ]

CMD [ "install", "--no-interaction", "--prefer-source" ]

