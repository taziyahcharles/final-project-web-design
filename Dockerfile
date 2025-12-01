# Use the official PHP Apache image
FROM php:8.2-apache

# Enable required Apache modules
RUN a2enmod rewrite

# Copy your app into the container
COPY . /var/www/html/

# Set the working directory
WORKDIR /var/www/html

# Configure Apache to use Render's PORT environment variable
# Replace the default ports.conf with one that listens on $PORT
RUN echo "Listen ${PORT}" > /etc/apache2/ports.conf \
    && echo "<VirtualHost *:${PORT}>\n\
        ServerName localhost\n\
        DocumentRoot /var/www/html\n\
        <Directory /var/www/html>\n\
            Options Indexes FollowSymLinks\n\
            AllowOverride All\n\
            Require all granted\n\
        </Directory>\n\
    </VirtualHost>" > /etc/apache2/sites-available/000-default.conf

# Expose the port (Render will override this with its own PORT)
EXPOSE 10000

# Start Apache in the foreground
CMD ["apache2-foreground"]
