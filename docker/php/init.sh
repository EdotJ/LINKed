#!/usr/bin/env sh
echo "Init composer"
composer install --optimize-autoloader --no-interaction

php artisan cache:clear
php artisan route:cache
php artisan config:cache
php artisan view:clear

echo "Waiting for Database"
sleep 10

echo "Init migrations"
php artisan migrate