ARG PHPVERSION="8.0"

FROM arquivei/php:${PHPVERSION}-cli-debian
WORKDIR /application
RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer
