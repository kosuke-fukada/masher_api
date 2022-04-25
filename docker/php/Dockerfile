FROM php:8.1-apache

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN apt-get update && apt-get install -y \
  git zip unzip sqlite3 \
  && docker-php-ext-install pdo_mysql

RUN pecl install xdebug \
  && docker-php-ext-enable xdebug

COPY ./docker/php/php.ini /usr/local/etc/php/php.ini
COPY ./docker/php/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY ./docker/php/default-ssl.conf /etc/apache2/sites-available/default-ssl.conf
COPY ./src/certs/server.key /etc/ssl/private/server.key
COPY ./src/certs/server.crt /etc/ssl/certs/server.crt

ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN a2enmod rewrite
RUN a2ensite default-ssl
RUN a2enmod ssl
