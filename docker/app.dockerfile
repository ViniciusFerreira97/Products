FROM php:7.4-fpm
WORKDIR /var/www

RUN apt-get update \
    && apt-get install -y \
        build-essential \
        mariadb-client \
        libpng-dev \
        libjpeg62-turbo-dev \
        libfreetype6-dev \
        libzip-dev \
        libpq-dev \
        libonig-dev \
        zip \
        jpegoptim \
        optipng \
        pngquant \
        gifsicle \
        cron \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install \
        pdo_mysql \
        mbstring \
        zip \
        exif \
        pcntl \
        bcmath \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

CMD php-fpm