# ============================================================
# Production image — SAE105 (Apache + PHP behind Traefik)
# ============================================================
FROM php:8.3-apache

# ----- 1. System deps & PHP extensions -----
# exif     → exif_imagetype() in upload_image.php
# mbstring → mb_strtolower()  in envoi_mail.php
# msmtp    → lightweight sendmail replacement for mail()
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        libonig-dev \
        msmtp \
        msmtp-mta \
        curl \
    && docker-php-ext-install exif mbstring \
    && apt-get purge -y --auto-remove -o APT::AutoRemove::RecommendsImportant=false \
    && rm -rf /var/lib/apt/lists/*

# ----- 2. Apache modules -----
RUN a2enmod rewrite headers remoteip

# ----- 3. PHP production config -----
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

RUN { \
    echo 'expose_php = Off'; \
    echo 'upload_max_filesize = 2M'; \
    echo 'post_max_size = 2M'; \
    echo 'max_file_uploads = 1'; \
    echo 'memory_limit = 64M'; \
    echo 'session.cookie_httponly = 1'; \
    echo 'session.cookie_secure = 1'; \
    echo 'session.cookie_samesite = Lax'; \
    echo 'session.use_strict_mode = 1'; \
    echo 'session.name = SAESESSID'; \
    echo 'session.gc_maxlifetime = 3600'; \
    echo 'sendmail_path = /usr/bin/msmtp -t'; \
} > "$PHP_INI_DIR/conf.d/99-custom.ini"

# ----- 4. Apache config -----
RUN echo 'ServerTokens Prod' >> /etc/apache2/conf-available/security.conf
COPY docker/000-default.conf /etc/apache2/sites-available/000-default.conf

# ----- 5. Application source -----
COPY . /var/www/html/

# ----- 6. Clean non-web files from image -----
RUN rm -rf /var/www/html/docker \
           /var/www/html/Dockerfile \
           /var/www/html/.dockerignore

# ----- 7. File permissions -----
RUN chown -R root:www-data /var/www/html \
    && find /var/www/html -type f -exec chmod 644 {} + \
    && find /var/www/html -type d -exec chmod 755 {} + \
    && chown -R www-data:www-data /var/www/html/images/galerie \
    && chmod 775 /var/www/html/images/galerie

# ----- 8. Health check -----
HEALTHCHECK --interval=30s --timeout=5s --start-period=10s --retries=3 \
    CMD curl -f http://localhost/ || exit 1

EXPOSE 80
