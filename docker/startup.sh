#!/bin/bash
set -e

echo "Starting Laravel application..."

# Fix storage permissions first
echo "Setting up storage permissions..."
chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
chmod -R 777 /var/www/html/storage
chmod -R 775 /var/www/html/bootstrap/cache

# Create log file if it doesn't exist
touch /var/www/html/storage/logs/laravel.log
chown www-data:www-data /var/www/html/storage/logs/laravel.log
chmod 666 /var/www/html/storage/logs/laravel.log

# Try to run migrations, but don't fail if tables already exist
echo "Running database migrations..."
php artisan migrate --force || {
    echo "Migration failed, likely due to existing tables. Continuing..."
}

# Clear and cache configuration for production
echo "Clearing old configuration cache..."
php artisan config:clear

echo "Caching fresh configuration..."
php artisan config:cache
php artisan route:cache  
php artisan view:cache

echo "Laravel setup complete. Starting Apache..."

# Start Apache
exec apache2-foreground