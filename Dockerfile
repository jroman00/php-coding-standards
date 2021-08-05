FROM php:7.2.34-cli-buster

# Install services
RUN apt-get update \
  && apt-get install -y \
    $PHPIZE_DEPS \
    git

# Install PHP extensions
RUN pecl channel-update pecl.php.net \
  && pecl install xdebug

# Enable PHP extensions
RUN docker-php-ext-enable xdebug

# Include composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy source code
WORKDIR /usr/src
COPY . /usr/src

# Install application dependencies
RUN composer install
