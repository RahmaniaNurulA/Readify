FROM php:8.2-apache

# Install extensions
RUN apt-get update && apt-get install -y \
    libpng-dev libonig-dev libxml2-dev zip unzip git curl \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Enable mod_rewrite
RUN a2enmod rewrite

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

# Buat .env sementara hanya untuk build
RUN cp .env.example .env

RUN composer install --no-dev --optimize-autoloader

RUN php artisan key:generate

# Set Apache document root to /public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' \
    /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE ${PORT:-80}

CMD bash -c "\
    sed -i 's/Listen 80/Listen ${PORT:-80}/' /etc/apache2/ports.conf && \
    sed -i 's/:80>/:${PORT:-80}>/' /etc/apache2/sites-available/*.conf && \
    until php artisan db:show > /dev/null 2>&1; do echo 'Waiting for DB...'; sleep 2; done && \
    php artisan migrate --force && \
    apache2-foreground"
    && php artisan migrate --force --seed \
    && apache2-foreground"
