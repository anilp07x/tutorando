#!/bin/bash

# Check environment
echo "Checking environment..."
php -v

# Make scripts executable
chmod +x setup-storage.sh
chmod +x setup-database.sh

# Setup storage directories and link
echo "Setting up storage directories..."
./setup-storage.sh

# Setup database
echo "Setting up database..."
./setup-database.sh

# Run server
echo "Starting server..."
php artisan serve --host=0.0.0.0 --port=8000
