#!/bin/bash

# Run migrations with a parameter that allows Doctrine to recognize existing tables
php artisan migrate --force --schema-path=/var/www/html/database/migrations
