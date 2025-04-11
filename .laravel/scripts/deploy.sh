#!/bin/bash

# Create necessary cache directories with proper ownership
mkdir -p /var/www/html/.laravel/cache
chmod -R 775 /var/www/html/.laravel/cache
# Ensure the web server user (www-data) owns the directory
chown -R www-data:www-data /var/www/html/.laravel/cache

# Run package discovery manually
cd /var/www/html
php -d memory_limit=-1 artisan package:discover

# Run migrations with a parameter that allows Doctrine to recognize existing tables
php artisan migrate --force --schema-path=/var/www/html/database/migrations
