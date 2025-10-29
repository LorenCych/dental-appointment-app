#!/usr/bin/env bash
# Render.com build script for Laravel

echo "Installing PHP dependencies..."
composer install --no-dev --optimize-autoloader

echo "Creating storage directories..."
mkdir -p storage/framework/cache/data
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/logs

echo "Setting permissions..."
chmod -R 775 storage bootstrap/cache

echo "Running database migrations..."
php artisan migrate --force

echo "Clearing and caching configuration..."
php artisan config:clear
php artisan config:cache

echo "Clearing and caching routes..."
php artisan route:clear
php artisan route:cache

echo "Clearing and caching views..."
php artisan view:clear
php artisan view:cache

echo "Build completed successfully!"