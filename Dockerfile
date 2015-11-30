FROM php:5.6-apache

# Install missing PHP extensions
RUN apt-get update && apt-get install -y \
      libfreetype6-dev \
      libjpeg62-turbo-dev \
      libmcrypt-dev \
      libpng12-dev \
      libxslt1-dev \
      libxml2-dev \
      zlib1g-dev \
      libicu-dev \
      g++ \
      git \
    && docker-php-ext-install mcrypt \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install gd \
    && docker-php-ext-install mbstring \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install xsl \
    && docker-php-ext-configure intl && docker-php-ext-install intl \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN pecl install apcu && echo extension=apcu.so > $PHP_INI_DIR/conf.d/apcu.ini

# Apache configuration
RUN a2enmod rewrite
COPY docker/apache/vhost.conf /etc/apache2/sites-enabled/default.conf
COPY docker/php/app.ini $PHP_INI_DIR/conf.d/

# Download Composer
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/bin/composer

# Add the application
ADD . /app
WORKDIR /app

# Run installation
#RUN composer install --no-iteraction --optimize-autoloader
