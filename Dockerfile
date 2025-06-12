FROM php:8.2-cli

# Install dependencies
RUN apt-get update && apt-get install -y unzip curl git libzip-dev zip && \
    docker-php-ext-install zip pdo pdo_mysql

# Set working directory
WORKDIR /var/www

# Copy project files
COPY . .

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php && \
    mv composer.phar /usr/local/bin/composer

# Install dependencies
RUN composer install --optimize-autoloader --no-dev

# Expose port
EXPOSE 3000

# Start Laravel server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=3000"]
