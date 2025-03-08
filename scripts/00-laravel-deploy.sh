#!/usr/bin/env bash
echo "Adding swap memory..."
fallocate -l 1G /swapfile
chmod 600 /swapfile
mkswap /swapfile
swapon /swapfile

echo "Running composer"
COMPOSER_MEMORY_LIMIT=-1 composer install --no-dev --working-dir=/var/www/html


php artisan config:clear
php artisan cache:clear

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "Running migrations..."
php artisan migrate --force

service php-fpm restart