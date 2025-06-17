ARG PHP_VERSION=8.1

FROM php:${PHP_VERSION}-cli-alpine AS base

WORKDIR /app

FROM base AS composer

COPY --from=composer:lts /usr/bin/composer /usr/bin/composer

ENTRYPOINT [ "composer" ]

CMD [ "install", "--no-interaction", "--prefer-source" ]

FROM base AS test

WORKDIR /app

RUN apk add --no-cache $PHPIZE_DEPS \
    && pecl install pcov \
    && docker-php-ext-enable pcov \
    && apk del $PHPIZE_DEPS

ENTRYPOINT [  "php", "vendor/bin/phpunit" ]
CMD [ "--coverage-text", "--coverage-clover=./build/logs/clover.xml" ]
