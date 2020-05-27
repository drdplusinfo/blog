#!/usr/bin/env bash

nohup php-fpm &

nohup sudo -u www-data sh -c /var/www/blog/node_modules/.bin/gulp &

/usr/local/bin/caddy -conf /etc/caddy/Caddyfile