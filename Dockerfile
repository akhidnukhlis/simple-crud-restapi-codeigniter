FROM php:7.2.33-apache

MAINTAINER Akhid Nukhlis

#COPY . /srv/app
#COPY . /restclient/
#COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

#RUN chown -R www-data:www-data /srv/app \
#    && a2enmod rewrite

RUN apt-get update && apt-get install -y libpq-dev && docker-php-ext-install pdo pdo_mysql
RUN a2enmod rewrite
COPY restclient /var/www/html/restclient