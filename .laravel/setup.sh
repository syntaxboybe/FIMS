#!/bin/bash

echo "Setting up Laravel caching environment..."

# Create Laravel cache directories and set liberal permissions temporarily for build
mkdir -p /var/www/html/.laravel/cache
chmod -R 777 /var/www/html/.laravel/cache

mkdir -p /var/www/html/bootstrap/cache
chmod -R 777 /var/www/html/bootstrap/cache

echo "Setup complete"
