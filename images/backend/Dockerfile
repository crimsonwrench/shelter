FROM php:7.2.12-fpm-alpine

RUN apk add --no-cache make \
    libpng \
    libpng-dev \
    libjpeg \
    libjpeg-turbo-dev

RUN docker-php-ext-install pdo pdo_mysql

RUN docker-php-ext-configure gd --with-jpeg-dir=/usr/include/
RUN docker-php-ext-install -j$(nproc) gd

ADD usr/local/etc/php/php.ini /usr/local/etc/php/php.ini

ENTRYPOINT ["/usr/local/sbin/php-fpm", "-F", "-R"]

EXPOSE 9000
