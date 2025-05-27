#!/bin/bash

# Clear caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Migrate and seed the database
php artisan migrate:fresh --seed

echo "Database migrated and seeded with initial data!"
