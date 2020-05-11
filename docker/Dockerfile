FROM php:7.4-fpm

RUN apt-get update

RUN apt-get install -y git
RUN apt-get install -y zip
RUN apt-get install -y libzip-dev
RUN apt-get install -y unzip
RUN apt-get install -y libfreetype6-dev
RUN apt-get install -y libjpeg-dev
RUN apt-get install -y libpng-dev

RUN apt-get install -y  zlib1g-dev libicu-dev libpq-dev libonig-dev imagemagick git default-mysql-client\
	&& docker-php-ext-install opcache \
	&& docker-php-ext-install intl \
	&& docker-php-ext-install mbstring \
	&& docker-php-ext-install pdo_mysql \
	&& docker-php-ext-install zip \
    && docker-php-ext-configure gd

RUN docker-php-ext-install gd
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer --version

RUN curl -OS http://couscous.io/couscous.phar
RUN chmod +x couscous.phar \
   &&  mv couscous.phar /usr/local/bin/couscous
EXPOSE 9000

WORKDIR /var/www/vigsan-rj.local
