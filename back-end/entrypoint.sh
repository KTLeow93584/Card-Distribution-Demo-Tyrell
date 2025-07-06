#!/bin/bash

# Run Laravel setup
echo "✅ MySQL is up. Running migrations..."
php artisan migrate --force

# Optional: install dependencies (safe inside container)
# composer install --no-interaction --prefer-dist --optimize-autoloader

# Generate the App Key
php artisan key:generate

# Start Laravel server
php artisan serve --host=0.0.0.0 --port=8000