FROM php:7.2-apache

WORKDIR /var/www/html

# Install required packages and PHP modules
RUN apt-get update 
RUN apt-get upgrade -y
RUN apt-get -y install --fix-missing apt-utils build-essential git curl libcurl3 libcurl3-dev zip vim

# Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Other PHP7 Extensions
RUN apt-get -y install libmcrypt-dev

RUN apt-get -y install libsqlite3-dev libsqlite3-0 mysql-client
RUN docker-php-ext-install pdo_mysql 
RUN docker-php-ext-install pdo_sqlite
RUN docker-php-ext-install mysqli

RUN docker-php-ext-install curl
# RUN docker-php-ext-install tokenizer
# RUN docker-php-ext-install json

RUN apt-get -y install zlib1g-dev
RUN docker-php-ext-install zip

# Fix write permissions with shared folders
RUN usermod -u 1000 www-data

# Correction to .htaccess file to enamble student to see his file tree in browser
RUN echo 'Options Indexes FollowSymLinks' > .htaccess \
    && echo 'Require all granted' >> .htaccess

# Copy the working dir to the image's web root
COPY . /var/www/html

