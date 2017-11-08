FROM debian:jessie
MAINTAINER adam.stipak@gmail.com

ENV DEBIAN_FRONTEND noninteractive

RUN apt-get update && apt-get install -y \
  curl \
  vim \
  wget \
  htop \
  openssh-client \
  git \
  mysql-client \
  bzip2 \
  apt-transport-https \
  lsb-release \
  ca-certificates \
  supervisor

# php
RUN wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg
RUN echo "deb https://packages.sury.org/php/ $(lsb_release -sc) main" > /etc/apt/sources.list.d/php.list
RUN apt-get update && apt-get install -y \
  php7.1 \
  php7.1-cli \
  apache2 \
  apache2-dev \
  libapache2-mod-php7.1 \
  php7.1-bcmath \
  php7.1-curl \
  php7.1-intl \
  php7.1-mysql \
  php7.1-sqlite \
  php7.1-mcrypt \
  php7.1-gd \
  php7.1-xml \
  php7.1-mbstring \
  php7.1-zip

# node
RUN curl -sL https://deb.nodesource.com/setup_8.x
RUN apt-get install -y nodejs npm && npm install -g yarn

# composer
RUN curl -s -o /usr/local/bin/composer https://getcomposer.org/composer.phar
RUN chmod +x /usr/local/bin/composer

# create user
RUN groupadd -g 1000 -r monitoring && useradd -r -u 1000 -m -g monitoring monitoring
RUN sed -i "s/export APACHE_RUN_USER=www-data/export APACHE_RUN_USER=monitoring/g" /etc/apache2/envvars
RUN sed -i "s/export APACHE_RUN_GROUP=www-data/export APACHE_RUN_GROUP=monitoring/g" /etc/apache2/envvars
#RUN usermod -a -G sudo monitoring
RUN passwd --delete monitoring
#RUN echo "monitoring  ALL=(ALL:ALL) ALL" >> /etc/sudoers
RUN chown -R monitoring:monitoring /home/monitoring

# setup supervisor
COPY supervisor/supervisord.conf /etc/supervisor/supervisord.conf

# apache
COPY apache2/monitoring.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod expires rewrite
