FROM php:8.2-apache
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
COPY . /var/www/html/
RUN echo "<?php echo 'API Ivory OK'; ?>" > /var/www/html/index.php
EXPOSE 80
