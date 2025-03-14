FROM docker.arvancloud.ir/php:8.2-fpm

MAINTAINER Aref Sajjadi <arefsajjadi80@gmail.com>

WORKDIR /var/www

RUN apt-get update && apt-get install -y nginx unzip libxml2-dev
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install soap

RUN rm /etc/nginx/sites-enabled/default

ADD nginx.conf /etc/nginx/conf.d/default.conf
COPY --chmod=777 entrypoint.sh /entrypoint.sh

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php && php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer

ENTRYPOINT ["/entrypoint.sh"]
