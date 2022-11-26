FROM php:8.1.9-apache

RUN apt-get update \
  && apt-get install -y zlib1g-dev \
  && apt-get install -y zip unzip \
  && apt-get -y install libzip-dev libonig-dev \
  && docker-php-ext-install pdo_mysql mysqli zip \
  && docker-php-ext-enable pdo_mysql mysqli \
  && a2enmod rewrite

ENV TZ=Asia/Tokyo

RUN apt-get update && apt-get install -y \
  busybox-static \
  && apt-get clean

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /composer
ENV PATH $PATH:/composer/vendor/bin

ENV APP_HOME /var/www/html

RUN usermod -u 1000 www-data && groupmod -g 1000 www-data

#change the web_root to laravel /var/www/html/public folder
# RUN sed -i -e "s/html/html\/public/g" /etc/apache2/sites-enabled/000-default.conf
COPY ./php/vhost.conf /etc/apache2/conf-enabled/vhost.conf

RUN a2enmod rewrite

COPY . $APP_HOME
COPY .env.production /var/www/html/.env
COPY ./php/start.sh /var/www/html/start.sh
RUN chmod 744 ./php/start.sh

RUN mkdir bootstrap/sessions && \
    mkdir storage/framework/cache/data

RUN composer install --no-dev --no-interaction

RUN chown -R www-data:www-data $APP_HOME
# RUN chmod -R 777 storage && \
#     chmod -R 777 bootstrap
# CMD php artisan migrate --force
CMD ["bash", "start.sh"]