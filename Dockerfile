FROM php:8.2-fpm-alpine

# Install required libs
RUN apk update && apk add openssl-dev bash libpng-dev libjpeg postgresql-dev libldap postgresql-dev libzip-dev zip git wget procps\
    && rm -rf /var/lib/apt/lists/*

# Postgres
RUN docker-php-ext-configure pgsql -with-pgsql=/usr/include/postgresql/ && \
    docker-php-ext-install pgsql pdo pdo_pgsql pdo_mysql zip

RUN docker-php-ext-install pcntl

# Install composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Create a new directory to run our app.
RUN mkdir -p /var/www/html/

# Set the new directory as our working directory
WORKDIR /var/www/html/

# Copy all the content to the working directory
COPY . /var/www/html/


# Install composer dependencies
#RUN composer install --no-dev
#RUN cd /var/www/html/ && php artisan vendor:publish --provider="Laravel\Horizon\HorizonServiceProvider"

RUN mkdir -p /var/www/html/storage/framework/sessions && \
    mkdir -p /var/www/html/storage/framework/views && \
    mkdir -p /var/www/html/storage/framework/cache && \
    mkdir -p /var/www/html/storage/framework/testing && \
    mkdir -p /var/www/html/storage/app/public && \
    mkdir -p /var/www/html/keys && \
    chmod -R 755 /var/www/html/storage && \
    chmod -R 755 /var/www/html/keys

# Our app runs on port 9000. Expose it!
EXPOSE 9000

# Run the application.
CMD ["php-fpm"]
    
