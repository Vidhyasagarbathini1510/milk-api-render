FROM php:8.2-apache

# Disable other MPMs (VERY IMPORTANT)
RUN a2dismod mpm_event || true \
 && a2dismod mpm_worker || true \
 && a2enmod mpm_prefork

# Enable required Apache modules
RUN a2enmod rewrite

# Install mysqli
RUN docker-php-ext-install mysqli

# Copy project files
COPY . /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 8080

# Apache runs automatically
