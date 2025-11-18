# Dockerfile pour application Symfony 7.1 avec PHP 8.2

FROM php:8.2-fpm-alpine AS base

# Installation des dépendances système
RUN apk add --no-cache \
    git \
    unzip \
    libzip-dev \
    postgresql-dev \
    mysql-dev \
    icu-dev \
    oniguruma-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    bash \
    nodejs \
    npm

# Installation des extensions PHP requises
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
    pdo \
    pdo_pgsql \
    pdo_mysql \
    zip \
    intl \
    opcache \
    gd \
    bcmath

# Installation de Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Configuration PHP-FPM
RUN { \
    echo '[www]'; \
    echo 'clear_env = no'; \
    } > /usr/local/etc/php-fpm.d/zz-docker.conf

# Définir le répertoire de travail
WORKDIR /var/www/symfony

# ==================================
# Image de développement
# ==================================
FROM base AS dev

# Configuration PHP pour développement
RUN { \
    echo 'opcache.enable=1'; \
    echo 'opcache.revalidate_freq=0'; \
    echo 'opcache.validate_timestamps=1'; \
    echo 'opcache.max_accelerated_files=10000'; \
    echo 'opcache.memory_consumption=128'; \
    } > /usr/local/etc/php/conf.d/opcache.ini

# Configuration de développement supplémentaire
RUN { \
    echo 'display_errors=On'; \
    echo 'error_reporting=E_ALL'; \
    echo 'memory_limit=512M'; \
    } > /usr/local/etc/php/conf.d/dev.ini

# Copier le script d'entrée
COPY docker/php/docker-entrypoint.sh /usr/local/bin/docker-entrypoint
RUN chmod +x /usr/local/bin/docker-entrypoint

# Exposer le port PHP-FPM
EXPOSE 9000

ENTRYPOINT ["docker-entrypoint"]
CMD ["php-fpm"]

# ==================================
# Image de production
# ==================================
FROM base AS prod

# Installation de nginx et supervisord
RUN apk add --no-cache \
    nginx \
    supervisor

# Configuration PHP pour production
RUN { \
    echo 'opcache.enable=1'; \
    echo 'opcache.memory_consumption=256'; \
    echo 'opcache.max_accelerated_files=20000'; \
    echo 'opcache.validate_timestamps=0'; \
    echo 'opcache.interned_strings_buffer=16'; \
    } > /usr/local/etc/php/conf.d/opcache.ini

# Configuration de production
RUN { \
    echo 'display_errors=Off'; \
    echo 'log_errors=On'; \
    echo 'memory_limit=256M'; \
    } > /usr/local/etc/php/conf.d/prod.ini

# Copier les fichiers de dépendances
COPY composer.json composer.lock symfony.lock ./

# Installation des dépendances de production
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist --optimize-autoloader && \
    composer clear-cache

# Copier le reste de l'application
COPY . .

# Finaliser l'installation de Composer
RUN composer dump-autoload --optimize --classmap-authoritative

# Créer les répertoires nécessaires et définir les permissions
RUN mkdir -p var/cache var/log /var/log/nginx /var/lib/nginx/tmp /run/nginx && \
    chown -R www-data:www-data var/ && \
    chmod -R 775 var/

# Copier la configuration nginx
COPY docker/nginx/production.conf /etc/nginx/http.d/default.conf
RUN rm -f /etc/nginx/http.d/default.conf.default

# Copier la configuration supervisord
COPY docker/supervisord/supervisord.conf /etc/supervisord.conf

# Copier le script d'entrée
COPY docker/php/docker-entrypoint.sh /usr/local/bin/docker-entrypoint
RUN chmod +x /usr/local/bin/docker-entrypoint

# Exposer le port HTTP (Render utilisera $PORT)
EXPOSE 8080

ENTRYPOINT ["docker-entrypoint"]
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisord.conf"]
