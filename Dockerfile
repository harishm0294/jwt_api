# Use an official PHP-Apache base image
FROM php:8.0-apache

# Set the environment variable for the correct timezone
ENV TZ=UTC

# Install necessary packages and PHP extensions
RUN apt-get update && apt-get install -y \
    apache2 \
    zip \
    unzip \
    git \
    curl \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd mbstring pdo pdo_mysql zip exif pcntl bcmath

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version=2.6.0

# Copy application files
COPY . /var/www/html

# Set working directory
WORKDIR /var/www/html

# Set the correct permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Expose port 80 to the host
EXPOSE 80

# Start Apache server
#CMD ["apache2-foreground"]
RUN docker-php-ext-install pdo_mysql
CMD ["apache2ctl", "-D", "FOREGROUND"]

# MySQL setup
FROM mysql:8.0.30
ENV MYSQL_ROOT_PASSWORD=root
ENV MYSQL_DATABASE=jwt_api
ENV MYSQL_USER=root
ENV MYSQL_ALLOW_EMPTY_PASSWORD=yes
# Expose MySQL port
EXPOSE 3306

# Start MySQL server
CMD ["mysqld"]
