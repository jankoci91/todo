FROM php:8.0.9-apache

COPY default.conf /etc/apache2/sites-available/000-default.conf

RUN apt-get -y update && apt-get -y upgrade && apt-get -y install \
    wget \
    zip \
    libpq-dev \
    libicu-dev
RUN apt-get -y clean && apt-get -y autoremove

RUN ln -s ../mods-available/rewrite.load /etc/apache2/mods-enabled/rewrite.load

RUN docker-php-ext-install \
    pdo_pgsql \
    intl

RUN cp /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini
RUN echo "date.timezone = Europe/Prague" >> /usr/local/etc/php/php.ini

RUN wget https://getcomposer.org/installer -O - | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /usr/local/etc/php/conf.d
RUN pecl install xdebug
RUN echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > xdebug.ini
RUN echo "xdebug.mode=debug" >> xdebug.ini
RUN echo "xdebug.start_with_request=yes" >> xdebug.ini
RUN echo "xdebug.client_host=172.18.0.1" >> xdebug.ini

WORKDIR /var/www
