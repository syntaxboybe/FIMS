#!/bin/bash

# Create necessary cache directories
mkdir -p /var/www/html/.laravel/cache
chmod -R 775 /var/www/html/.laravel/cache

# Run migrations with a parameter that allows Doctrine to recognize existing tables
php artisan migrate --force --schema-path=/var/www/html/database/migrations
