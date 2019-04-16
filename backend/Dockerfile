FROM alpine:3.9

RUN set -ex \
  && apk --no-cache add \
    php7 \
    php7-fpm \
    php7-openssl \
    php7-mysqlnd \
    php7-pdo \
    php7-pdo_mysql \
    php7-mbstring \
    php7-tokenizer \
    php7-xml \
    php7-ctype \
    php7-json \
    php7-bcmath \
    php7-opcache \
    php7-gd \
    php7-dom \
    php7-session \
    tzdata

RUN cp /usr/share/zoneinfo/Europe/Moscow /etc/localtime

RUN mkdir -p /run/php-fpm
RUN mkdir -p /var/log/php-fpm
RUN ln -sf /dev/stderr /var/log/php-fpm/php-fpm.log

ADD config/php.ini      /etc/php7/php.ini
ADD config/php-fpm.conf /etc/php7/php-fpm.conf
ADD config/www.conf     /etc/php7/php-fpm.d/www.conf

ENTRYPOINT ["/usr/sbin/php-fpm7", "-F", "-R"]

EXPOSE 9000
