#!/bin/bash
set -e

echo "Starting Laravel application..."

# Run database migrations
php artisan migrate --force

# Cache configuration for production
php artisan config:cache
php artisan route:cache  
php artisan view:cache

echo "Laravel setup complete. Starting Apache..."

# Start Apache
exec apache2-foreground