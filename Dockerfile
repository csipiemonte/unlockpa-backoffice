FROM php:8.0-apache

RUN apt-get update && apt-get install -y libpq-dev \
  && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
  && docker-php-ext-install pdo pdo_pgsql pgsql

COPY --chown=www-data ./www/ /var/www/html/


EXPOSE 80
