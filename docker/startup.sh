#!/bin/bash
set -e

echo "Starting Laravel application..."

# Try to run migrations, but don't fail if tables already exist
echo "Running database migrations..."
php artisan migrate --force || {
    echo "Migration failed, likely due to existing tables. Continuing..."
    echo "Checking current migration status:"
    php artisan migrate:status || echo "Could not check migration status"
}

# Cache configuration for production
echo "Caching configuration..."
php artisan config:cache
php artisan route:cache  
php artisan view:cache

echo "Laravel setup complete. Starting Apache..."

# Start Apache
exec apache2-foreground