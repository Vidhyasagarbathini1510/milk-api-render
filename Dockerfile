FROM php:8.2-apache

# Install mysqli only (NO apache reinstall, NO mpm changes)
RUN docker-php-ext-install mysqli

# Copy files
COPY . /var/www/html/

# Permissions
RUN chown -R www-data:www-data /var/www/html

# Make Apache listen on Railway PORT
RUN sed -i "s/Listen 80/Listen ${PORT}/" /etc/apache2/ports.conf \
 && sed -i "s/:80/:${PORT}/" /etc/apache2/sites-available/000-default.conf

EXPOSE 8080
