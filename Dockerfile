FROM php:5.6-apache


## Update packages
RUN apt-get update

## Install depending packages
RUN apt-get install -y --no-install-recommends \
wget \
libmcrypt-dev \
vim

## Install FuelPHP's depending extensions
RUN docker-php-ext-install \
fileinfo \
mysqli \
mbstring \
mcrypt \
pdo \
pdo_mysql 

## Cleanup
RUN rm -rf /var/lib/apt/lists/*

## Set php.ini
RUN cat /usr/src/php/php.ini-development | sed 's/^;\(date.timezone.*\)/\1 \"Asia\/Tokyo\"/' > /usr/local/etc/php/php.ini

## TODO: Install xdebug

## Install phpunit
RUN wget https://phar.phpunit.de/phpunit.phar
RUN chmod +x phpunit.phar
RUN mv phpunit.phar /usr/local/bin/phpunit

## log
RUN mkdir /var/log/fuel
RUN chmod 777 /var/log/fuel

## Enable mod_rewrite
RUN a2enmod rewrite

## Restart Apache
RUN service apache2 restart
