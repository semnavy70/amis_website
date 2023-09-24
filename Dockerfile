FROM php:8.0-fpm-alpine3.13

RUN apk add --no-cache nginx wget

RUN mkdir -p /run/nginx

COPY docker/nginx.conf /etc/nginx/nginx.conf

RUN mkdir -p /app
COPY . /app

RUN sh -c "wget https://getcomposer.org/composer.phar && chmod a+x composer.phar && mv composer.phar /usr/local/bin/composer"
RUN apk add --no-cache \
        libjpeg-turbo-dev \
        libpng-dev \
        libwebp-dev \
        freetype-dev
RUN docker-php-ext-configure gd --with-jpeg --with-webp --with-freetype
RUN docker-php-ext-install gd
RUN docker-php-ext-install exif
RUN docker-php-ext-install pdo_mysql pdo

RUN cd /app && \
    /usr/local/bin/composer install --ignore-platform-reqs

RUN chown -R www-data: /app

#RUN cd /app && php artisan cache:clear && php artisan view:clear && php artisan route:clear && php artisan config:clear

CMD sh /app/docker/startup.sh
