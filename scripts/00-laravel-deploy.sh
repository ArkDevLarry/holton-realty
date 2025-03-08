#!/usr/bin/env bash
echo "Running composer"
composer global require hirak/prestissimo

# Increase memory limit for composer
COMPOSER_MEMORY_LIMIT=-1 composer install --no-dev --working-dir=/var/www/html

sed -i 's/memory_limit = .*/memory_limit = 512M/' /etc/php/7.4/fpm/php.ini

echo "Skip generating application key..."
# php artisan key:generate --show

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "Running migrations..."
php artisan migrate --force

php -i | grep memory_limit