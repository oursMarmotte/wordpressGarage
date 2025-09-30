FROM wordpress:latest

# Installer les extensions PHP nécessaires
RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    unzip \
    && docker-php-ext-install zip

# Copier le fichier de configuration WordPress personnalisé
COPY wp-config.php /var/www/html/wp-config.php

# Définir les permissions appropriées
RUN chown -R www-data:www-data /var/www/html

# Exposer le port 8080 (requis par Fly.io)
EXPOSE 8080

# Modifier la configuration Apache pour écouter sur le port 8080
RUN sed -i 's/80/8080/g' /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

# Activer mod_rewrite pour les permaliens WordPress
RUN a2enmod rewrite

# Démarrer Apache
CMD ["apache2-foreground"]