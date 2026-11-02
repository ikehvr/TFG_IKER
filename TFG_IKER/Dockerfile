FROM richarvey/nginx-php-fpm:latest

# Instalar Node.js y npm
RUN apk add --no-cache nodejs npm

# Copiar el código del proyecto
COPY . /var/www/html

# Configurar explícitamente la ruta pública de Laravel para Nginx
ENV WEBROOT=/var/www/html/public
ENV DOCUMENT_ROOT=/var/www/html/public

# Instalar dependencias de Composer y Node
RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build

# Ajustar permisos para las carpetas críticas de Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Limpiar y reconstruir la caché de Laravel para producción
RUN php artisan config:clear \
    && php artisan cache:clear \
    && php artisan route:clear