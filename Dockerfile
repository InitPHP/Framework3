FROM ubuntu:22.04

RUN apt-get update && apt-get upgrade -y

RUN apt-get update && apt-get install -y software-properties-common

RUN add-apt-repository ppa:ondrej/php -y

RUN apt-get update && apt-get install -y nginx php8.1 php8.1-fpm php8.1-mysql \
    php8.1-gd \
    php8.1-cli \
    php8.1-common \
    php8.1-opcache \
    php8.1-mbstring \
    php8.1-zip \
    php8.1-xml \
    php8.1-intl \
    php8.1-curl \
    php8.1-soap \
    php8.1-fileinfo \
    php8.1-sockets

# 80 ve 443 numaralı portu aç
EXPOSE 80
EXPOSE 443

# NGINX ve PHP-FPM'yi başlat
CMD service php8.1-fpm start && nginx -g "daemon off;"