#!/bin/bash

echo "Starting deployment script..."

# Create necessary cache directories with proper ownership
mkdir -p /var/www/html/.laravel/cache
chmod -R 777 /var/www/html/.laravel/cache
chown -R www-data:www-data /var/www/html/.laravel/cache

echo "Cache directory created and permissions set"

# Create bootstrap cache directory
mkdir -p /var/www/html/bootstrap/cache
chmod -R 777 /var/www/html/bootstrap/cache
chown -R www-data:www-data /var/www/html/bootstrap/cache

echo "Bootstrap cache directory created and permissions set"

# Try to clear cache just in case
cd /var/www/html
php artisan config:clear
php artisan cache:clear
php artisan view:clear

echo "Caches cleared"

# Force regenerate package manifests
COMPOSER_MEMORY_LIMIT=-1 composer dump-autoload

echo "Composer dump-autoload completed"

# Run migrations with a parameter that allows Doctrine to recognize existing tables
php artisan migrate --force --schema-path=/var/www/html/database/migrations

echo "Migrations completed"
echo "Deployment script finished"
