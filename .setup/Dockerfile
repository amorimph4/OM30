FROM php:8.1-fpm

RUN apt update

RUN apt install -y \
    build-essential \
    libicu-dev \
    libzip-dev \
    libpq-dev \
    postgresql \
    postgresql-contrib \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libonig-dev \
    locales \
    zip \
    libxml2-dev \
    libxslt-dev \
    unzip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    git \
    curl \
    wget \
    zsh

RUN docker-php-ext-configure zip

RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql

RUN docker-php-ext-install \
    mbstring \
    pcntl \
    opcache

RUN docker-php-ext-install pdo pdo_pgsql zip intl bcmath xsl soap gd

RUN pecl install redis xdebug \
    && docker-php-ext-enable opcache redis xdebug \
    && docker-php-ext-configure gd \
    && docker-php-source delete

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

COPY . /var/www
WORKDIR /var/www

RUN chmod -R ugo+rw storage
RUN chown -R $USER:www-data storage/
RUN chmod 775 -R bootstrap/
RUN chown -R $USER:www-data bootstrap/

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
RUN composer install --no-interaction

EXPOSE 80

CMD ["php-fpm"]