# Use the official PHP image with Apache
FROM php:8.2-apache

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Enable Apache mod_rewrite for pretty URLs (if needed)
RUN a2enmod rewrite

# Set the working directory inside the container
WORKDIR /var/www/html

# Install PHP extensions needed for the project
RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable pdo_mysql

# Install Composer for managing PHP dependencies
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Xdebug for debugging (optional)
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# Copy the local project files into the container
COPY . /var/www/html/

# Expose the container’s HTTP port (Apache default is 80)
EXPOSE 80
