FROM php:7.2.12-fpm-alpine

RUN apk add make
RUN docker-php-ext-install pdo pdo_mysql

ENTRYPOINT ["/usr/local/sbin/php-fpm", "-F", "-R"]

EXPOSE 9000
