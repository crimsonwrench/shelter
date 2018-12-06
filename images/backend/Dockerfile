FROM php:7.2.12-fpm-alpine

RUN apk add make
RUN docker-php-ext-install pdo pdo_mysql

ADD usr/local/etc/php/php.ini /usr/local/etc/php/php.ini

ENTRYPOINT ["/usr/local/sbin/php-fpm", "-F", "-R"]

EXPOSE 9000
