FROM alpine:latest

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY ./docker-entrypoint.sh /docker/

ENV PATH="$PATH:/root/.composer/vendor/bin"

RUN apk update && \
    apk upgrade && \
    apk add --no-cache \
    supervisor \
    nginx \
    nodejs \
    npm \
    php84 \
    php84-cli \
    php84-fpm \
    php84-common \
    php84-iconv \
    php84-ctype \
    php84-phar \
    php84-session \
    php84-dom \
    php84-intl \
    php84-mysqli \
    php84-json \
    php84-pdo \
    php84-pdo_mysql \
    php84-pdo_odbc \
    php84-pdo_pgsql \
    php84-pdo_sqlite \
    php84-pdo_dblib \
    php84-fileinfo \
    php84-zip \
    php84-gd \
    php84-mbstring \
    php84-opcache \
    php84-curl \
    php84-xml \
    php84-simplexml \
    php84-xmlwriter \
    php84-xmlreader \
    php84-bcmath \
    php84-openssl \
    php84-tokenizer \
    php84-pecl-redis && \
    ln -s /usr/bin/php84 /usr/bin/php && \
    ln -s /usr/sbin/php-fpm84 /usr/sbin/php-fpm && \
    alias composer="php /usr/bin/composer" && \
    chmod +x /docker/docker-entrypoint.sh

WORKDIR /app

ENTRYPOINT [ "/docker/docker-entrypoint.sh" ]

CMD [ "/usr/bin/supervisord", "-c", "/config/supervisord.conf" ]