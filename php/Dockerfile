FROM php:7.4-fpm-alpine
RUN apk update; \
    apk upgrade;
	
# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY php.ini /usr/local/etc/php/php.ini