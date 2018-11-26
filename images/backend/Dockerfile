FROM php:7.2.12-fpm-alpine

RUN apk add make
RUN docker-php-ext-install pdo pdo_mysql
RUN sed -ri 's/^www-data:x:82:82:/www-data:x:1000:50:/' /etc/passwd

EXPOSE 9000