FROM php:7.1-cli-alpine3.7

# Include composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy source code
WORKDIR /var/www
COPY . /var/www
