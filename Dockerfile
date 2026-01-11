FROM php:8.2-apache

# Install mysqli
RUN docker-php-ext-install mysqli

# Copy ALL files to Apache root
COPY . /var/www/html/

# Permissions (safe)
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
