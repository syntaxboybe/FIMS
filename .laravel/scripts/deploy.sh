#!/bin/bash

echo "Starting deployment script..."

# Create necessary cache directories with proper ownership
mkdir -p "C:/xampp/htdocs/FIMS/.laravel/cache"
chmod -R 777 "C:/xampp/htdocs/FIMS/.laravel/cache"
# Windows doesn't have chown, so we skip this line
# chown -R www-data:www-data "C:/xampp/htdocs/FIMS/.laravel/cache"

echo "Cache directory created and permissions set"

# Create bootstrap cache directory
mkdir -p "C:/xampp/htdocs/FIMS/bootstrap/cache"
chmod -R 777 "C:/xampp/htdocs/FIMS/bootstrap/cache"
# Windows doesn't have chown, so we skip this line
# chown -R www-data:www-data "C:/xampp/htdocs/FIMS/bootstrap/cache"

echo "Bootstrap cache directory created and permissions set"

# Try to clear cache just in case
cd "C:/xampp/htdocs/FIMS"
php artisan config:clear
php artisan cache:clear
php artisan view:clear

echo "Caches cleared"

# Force regenerate package manifests
COMPOSER_MEMORY_LIMIT=-1 composer dump-autoload

echo "Composer dump-autoload completed"

# Run migrations with a parameter that allows Doctrine to recognize existing tables
php artisan migrate --force --schema-path="C:/xampp/htdocs/FIMS/database/migrations"

echo "Migrations completed"
echo "Deployment script finished"
