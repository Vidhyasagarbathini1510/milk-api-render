FROM php:8.2-apache

# Disable all MPMs
RUN a2dismod mpm_event mpm_worker || true

# Enable prefork (required for PHP)
RUN a2enmod mpm_prefork

# Install mysqli
RUN docker-php-ext-install mysqli

# Copy project files
COPY . /var/www/html/

# Permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
