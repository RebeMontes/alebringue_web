#!/bin/bash

echo "Iniciando aplicación..."

# Permisos
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Limpiar config (IMPORTANTE)
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# Migraciones
php artisan migrate --force

# Iniciar PHP-FPM
php-fpm &

sleep 3

# Iniciar nginx
nginx -g "daemon off;"