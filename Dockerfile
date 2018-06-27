FROM php:7.0.30-cli-alpine3.7

# Install services
RUN apk add --no-cache --update $PHPIZE_DEPS

# Install Xdebug
RUN pecl install xdebug

# Enable php extensions
RUN docker-php-ext-enable xdebug

# Include composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy source code
WORKDIR /var/www
COPY . /var/www
