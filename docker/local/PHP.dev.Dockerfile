FROM php:7.4-fpm

WORKDIR /app

RUN apt-get update -y

RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

RUN rm -rf /var/lib/apt/lists/*