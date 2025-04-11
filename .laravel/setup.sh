#!/bin/bash

echo "Setting up Laravel caching environment..."

# Create Laravel cache directories and set liberal permissions temporarily for build
mkdir -p "C:/xampp/htdocs/FIMS/.laravel/cache"
chmod -R 777 "C:/xampp/htdocs/FIMS/.laravel/cache"

mkdir -p "C:/xampp/htdocs/FIMS/bootstrap/cache"
chmod -R 777 "C:/xampp/htdocs/FIMS/bootstrap/cache"

echo "Setup complete"
