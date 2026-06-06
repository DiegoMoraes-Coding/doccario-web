# Stage 1: Build Assets using Node
FROM node:20-alpine AS asset-builder
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# Stage 2: Main PHP/Nginx Runtime
FROM php:8.3-fpm-alpine

RUN apk add --no-cache unzip nginx supervisor

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

COPY --from=asset-builder /app/public/build ./public/build

# Install PHP dependencies smoothly without baking a permanent configuration cache
RUN composer install --no-dev --optimize-autoloader

# Ensure permissions are wide open for real-time file writing
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache \
    && chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80

# Configure an inline Nginx server with expanded header buffers to prevent 502 cookie drops
RUN echo 'server { \
    listen 80; \
    root /var/www/html/public; \
    index index.php index.html; \
    location / { try_files $uri $uri/ /index.php?$query_string; } \
    location ~ \.php$ { \
        try_files $uri =404; \
        fastcgi_split_path_info ^(.+\.php)(/.+)$; \
        fastcgi_pass 127.0.0.1:9000; \
        fastcgi_index index.php; \
        include fastcgi_params; \
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name; \
        fastcgi_param PATH_INFO $fastcgi_path_info; \
        \
        # FIX: Widen Nginx pipes for large encrypted auth cookies \
        fastcgi_buffers 16 16k; \
        fastcgi_buffer_size 32k; \
        fastcgi_busy_buffers_size 32k; \
    } \
}' > /etc/nginx/http.d/default.conf

CMD php-fpm -D && nginx -g "daemon off;"