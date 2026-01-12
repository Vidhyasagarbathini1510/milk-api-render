FROM php:8.2-apache

# Install mysqli
RUN docker-php-ext-install mysqli

# Copy project
COPY . /var/www/html/

# Fix permissions
RUN chown -R www-data:www-data /var/www/html

# Make Apache listen on Railway PORT
RUN sed -i 's/Listen 80/Listen ${PORT}/' /etc/apache2/ports.conf && \
    sed -i 's/:80/:${PORT}/' /etc/apache2/sites-available/000-default.conf

# Start Apache
CMD ["apache2-foreground"]
