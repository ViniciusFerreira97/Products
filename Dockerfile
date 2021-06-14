FROM composer:1.10.19 as build
WORKDIR /app
COPY . /app
#RUN composer install

FROM php:7.4-apache
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        build-essential \
        mariadb-client \
        libpng-dev \
        libjpeg62-turbo-dev \
        libfreetype6-dev \
        libzip-dev \
        libpq-dev \
        zip \
        jpegoptim \
        optipng \
        pngquant \
        gifsicle \
        cron \
        libwebp-dev \
        net-tools \
        wget \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install \
        pdo_mysql \
        zip \
        exif \
        pcntl \
        bcmath \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install gd


# Adjust application settings
COPY --from=build /app /var/www/
COPY .env.example /var/www/.env
COPY apache/000-default.conf /etc/apache2/sites-available/000-default.conf
COPY apache/ports.conf /etc/apache2/ports.conf

RUN chmod 777 -R /var/www/storage/ \
    && chown -R www-data:www-data /var/www/ \
    && a2enmod rewrite

EXPOSE 8080
