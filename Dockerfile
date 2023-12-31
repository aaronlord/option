FROM php:8.1-fpm

WORKDIR /var/www

RUN apt-get update && apt-get install git zip unzip -y

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN groupadd -g 1000 www && useradd -u 1000 -ms /bin/bash -g www www

COPY --chown=www:www . /var/www

USER www
