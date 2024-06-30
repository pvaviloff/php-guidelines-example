FROM php:8.3-fpm

LABEL maintainer="Pavlo Vavilov <pasha.v13@gmail.com>"

ENV USER_UID 1000
ENV USER_NAME app
ENV USER_HOME /home/app

WORKDIR /var/www/html

ADD .docker/supervisor/supervisord.conf /etc/supervisor/conf.d/


RUN apt-get update && apt-get install -y \
        libpq-dev \
        libonig-dev \
        libzip-dev \
        unzip \
        supervisor \
    && docker-php-ext-install pcntl \
    && docker-php-ext-install bcmath \
    && docker-php-ext-install mbstring \
    && docker-php-ext-install zip \
    && docker-php-ext-install pdo \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pgsql pdo_pgsql


RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php \
    && php -r "unlink('composer-setup.php');" \
    && mv composer.phar /usr/local/bin/composer


CMD ["/bin/bash", "-c", "/usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf"]
