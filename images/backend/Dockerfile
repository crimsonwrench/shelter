FROM php:7.2.12-fpm-alpine

# ADD php.ini /etc/php/php.ini
# ADD php-fpm.conf /etc/php/php-fpm.conf
# ADD php-fpm.d/www.conf /etc/php/php-fpm.d/www.conf

RUN apk add make
RUN docker-php-ext-install pdo pdo_mysql
EXPOSE 9000 9001
