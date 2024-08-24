# Dockerfile

# Use the official PHP image with Apache
FROM php:8.0-apache

# Install required PHP extensions and Composer
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql gd

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Set the working directory
WORKDIR /var/www/html

# Copy the application code
COPY . /var/www/html

# Ensure web server can write to application files
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 777 /var/www/html

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Modify the default Apache configuration to include "Require all granted"
RUN echo "<Directory /var/www/html>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>" > /etc/apache2/conf-available/custom-directory.conf

# Enable the new custom configuration
RUN a2enconf custom-directory

# Expose port 80
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]

RUN echo "the server is running at http://localhost:8080/"