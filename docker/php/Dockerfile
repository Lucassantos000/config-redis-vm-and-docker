FROM php:8.3-apache

# Install necessary extensions and libraries
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    libpq-dev \  
    && docker-php-ext-install pdo_mysql pdo_pgsql zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Enable Apache rewrite module
RUN a2enmod rewrite

# Expose port 80
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]
