FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
    git curl zip unzip \
    libpng-dev libonig-dev libxml2-dev libpq-dev

RUN docker-php-ext-install pdo_pgsql pgsql mbstring exif pcntl bcmath gd opcache

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . /var/www

RUN chown -R www-data:www-data /var/www

CMD ["php-fpm"]
