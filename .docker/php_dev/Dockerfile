FROM alpine:3.12.12

RUN apk update
RUN apk add bash nano php7 php7-opcache composer php7-json php7-mbstring php7-openssl php7-dom php7-tokenizer \
    php-xml php-xmlwriter php7-xdebug
RUN rm -rf /var/lib/apt/lists/*

COPY 51_php_dev.ini /etc/php7/conf.d/51_php.ini
COPY 51_xdebug_dev.ini /etc/php7/conf.d/xdebug.ini
RUN mkdir /.composer
RUN chmod -R 777 /.composer
WORKDIR /var/www/html

ENTRYPOINT ["tail", "-f", "/dev/null"]