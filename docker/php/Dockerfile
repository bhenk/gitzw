FROM php:8.2-apache

ADD https://raw.githubusercontent.com/mlocati/docker-php-extension-installer/master/install-php-extensions /usr/local/bin/
RUN chmod uga+x /usr/local/bin/install-php-extensions && sync && install-php-extensions gd
RUN docker-php-ext-install exif
RUN docker-php-ext-install mysqli

RUN mkdir /var/www/application
RUN mkdir /var/www/config
RUN mkdir /var/www/data
RUN mkdir /var/www/logs
RUN mkdir /var/www/vendor

RUN a2enmod rewrite