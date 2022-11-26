#!/usr/bin/env bash
php artisan migrate --force
php artisan db:seed --force
chmod -R 777 bootstrap 
chmod -R 777 storage
/usr/sbin/apache2ctl -D FOREGROUND