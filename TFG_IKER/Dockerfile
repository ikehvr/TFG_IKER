FROM richarvey/nginx-php-fpm:latest

# Instalar Node.js y npm en el contenedor
RUN apk add --no-cache nodejs npm

# Copiar el código del proyecto al contenedor
COPY . /var/www/html

# Configuración del directorio raíz de Laravel para Nginx
ENV DOCUMENT_ROOT=/var/www/html/public
ENV ROUTER_PHP_SCRIPT=/var/www/html/public/index.php

# Instalar dependencias de Composer y Node
RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build

# Permisos para carpetas de Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache