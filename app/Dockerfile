FROM wordpress:php8.2-apache

# Copie tes fichiers WordPress si tu as un thème/plugin custom
 
 COPY ./public/wp-content/themes/jg-theme-wordpress /var/www/html/wp-content/themes/jg-themes-wordpress
 COPY ./public/wp-content/plugins  /var/www/html/wp-content/plugins

 

# Définir le répertoire de travail
WORKDIR /var/www/html


# Droits d'accès pour WordPress
RUN chown -R www-data:www-data /var/www/html
