FROM php:8.1-apache

# Define build arguments for database connection
ARG MYSQLHOST
ARG MYSQLPORT
ARG MYSQLUSER
ARG MYSQLPASSWORD
ARG MYSQLDATABASE
ARG DATABASE_URL

# Set environment variables using build arguments
ENV MYSQLHOST=${MYSQLHOST:-mysql.railway.internal} \
    MYSQLPORT=${MYSQLPORT:-3306} \
    MYSQLUSER=${MYSQLUSER:-root} \
    MYSQLPASSWORD=${MYSQLPASSWORD} \
    MYSQLDATABASE=${MYSQLDATABASE:-railway} \
    DATABASE_URL=${DATABASE_URL}

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libicu-dev \
    apache2 \
    apache2-utils

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-configure intl \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd intl

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy existing application directory
COPY . /var/www

# Install dependencies
RUN composer install --no-interaction --no-dev --prefer-dist

# Change ownership of our applications
RUN chown -R www-data:www-data /var/www

# Copy apache configuration
COPY docker/apache/000-default.conf /etc/apache2/sites-available/000-default.conf

# Enable Apache modules
RUN a2enmod rewrite

# Set ServerName globally
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Make sure apache is installed and configured
RUN apt-get update && apt-get install -y apache2 \
    && a2enmod rewrite \
    && service apache2 start

# Create and set permissions for the environment file
RUN touch /var/www/.env && \
    chown www-data:www-data /var/www/.env && \
    chmod 600 /var/www/.env

# Script to update environment variables
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

EXPOSE 80

# Use custom entrypoint script
ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["apache2-foreground"] 