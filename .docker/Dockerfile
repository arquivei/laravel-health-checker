ARG PHPVERSION="8.3"

FROM php:${PHPVERSION}-cli

WORKDIR /application
RUN apt-get update --allow-releaseinfo-change\
&& apt-get install -y libzip-dev unzip git\
&& docker-php-ext-install zip
RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer
