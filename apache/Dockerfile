FROM ubuntu:focal
LABEL Author="Pedro Consuegra" Description="A comprehensive docker image to run Apache-2.4 PHP applications like Wordpress, Laravel or WordPres+Laravel"

# Stop dpkg-reconfigure tzdata from prompting for input
ENV DEBIAN_FRONTEND=noninteractive
RUN echo "Hello pete"
RUN echo COMPOSE_FILE
# Install apache and php7
RUN apt-get update && \
    apt-get -y install \
	    sudo \
	    nodejs \
		npm \
		curl \
        apache2 \
		git \
		vim \
		unzip \
        libapache2-mod-php \
        php-cli \
        php-curl \
        php-mbstring \
        php-gd \
        php-mysql \
        php-json \
        php-ldap \
        php-mime-type \
        php-tidy \
        php-intl \
        php-xmlrpc \
        php-soap \
        php-uploadprogress \
        php-zip \
		php-curl \
# Ensure apache can bind to 80 as non-root
        libcap2-bin && \
    setcap 'cap_net_bind_service=+ep' /usr/sbin/apache2 && \
    dpkg --purge libcap2-bin && \
    apt-get -y autoremove && \
# As apache is never run as root, change dir ownership
    a2disconf other-vhosts-access-log && \
    chown -Rh www-data. /var/run/apache2 && \
# Install ImageMagick CLI tools
    apt-get -y install --no-install-recommends imagemagick && \
# Clean up apt setup files
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* && \
# Setup apache
    a2enmod rewrite headers expires ext_filter
	
RUN apt update
RUN apt install -y curl wget gnupg2 ca-certificates lsb-release apt-transport-https
RUN apt-get install -y software-properties-common
RUN apt-add-repository ppa:ondrej/php
RUN apt update


RUN apt-get --assume-yes install php7.2 php7.2-common
RUN apt-get --assume-yes install php7.2-curl php7.2-xml php7.2-zip php7.2-gd php7.2-mysql php7.2-mbstring php7.2-imagick
RUN a2enmod php7.2
RUN ln -sfn /usr/bin/php7.2 /etc/alternatives/php
RUN find /etc/php/7.2/apache2/php.ini -type f -exec sed -i 's/upload_max_filesize = 2M/upload_max_filesize = 50M/g' {} \;
RUN find /etc/php/7.2/apache2/php.ini -type f -exec sed -i 's/post_max_size = 2M/post_max_size = 50M/g' {} \;
RUN find /etc/php/7.2/apache2/php.ini -type f -exec sed -i 's/memory_limit = 128M/memory_limit = 256M/g' {} \;
	
RUN apt-get --assume-yes install php7.3 php7.3-common
RUN apt-get --assume-yes install php7.3-curl php7.3-xml php7.3-zip php7.3-gd php7.3-mysql php7.3-mbstring php7.3-imagick
RUN a2enmod php7.3
RUN ln -sfn /usr/bin/php7.3 /etc/alternatives/php
RUN find /etc/php/7.3/apache2/php.ini -type f -exec sed -i 's/upload_max_filesize = 2M/upload_max_filesize = 50M/g' {} \;
RUN find /etc/php/7.3/apache2/php.ini -type f -exec sed -i 's/post_max_size = 2M/post_max_size = 50M/g' {} \;
RUN find /etc/php/7.3/apache2/php.ini -type f -exec sed -i 's/memory_limit = 128M/memory_limit = 256M/g' {} \;

RUN apt-get --assume-yes install php7.4 php7.4-common
RUN apt-get --assume-yes install php7.4-curl php7.4-xml php7.4-zip php7.4-gd php7.4-mysql php7.4-mbstring php7.4-imagick
RUN a2enmod php7.4
RUN ln -sfn /usr/bin/php7.4 /etc/alternatives/php
RUN find /etc/php/7.4/apache2/php.ini -type f -exec sed -i 's/upload_max_filesize = 2M/upload_max_filesize = 50M/g' {} \;
RUN find /etc/php/7.4/apache2/php.ini -type f -exec sed -i 's/post_max_size = 2M/post_max_size = 50M/g' {} \;
RUN find /etc/php/7.4/apache2/php.ini -type f -exec sed -i 's/memory_limit = 128M/memory_limit = 256M/g' {} \;

RUN a2dismod php7.2
RUN a2dismod php7.3
RUN a2dismod php7.4
ARG PHP_VERSION
RUN a2enmod php${PHP_VERSION}

# Override default apache and php config
COPY src/000-default.conf /etc/apache2/sites-available
#COPY src/example1.conf /etc/apache2/sites-available
COPY src/mpm_prefork.conf /etc/apache2/mods-available
COPY src/status.conf      /etc/apache2/mods-available
COPY src/99-pete.ini     /etc/php/7.4/apache2/conf.d

#RUN a2ensite example1

RUN mkdir -p /etc/apache2/pete-sites

RUN echo "Include /etc/apache2/pete-sites/*.conf" >> /etc/apache2/apache2.conf

RUN echo "www-data ALL=NOPASSWD: /etc/init.d/apache2 reload" >> /etc/sudoers
RUN echo "www-data ALL=NOPASSWD: /usr/sbin/a2dismod" >> /etc/sudoers
RUN echo "www-data ALL=NOPASSWD: /usr/sbin/a2enmod" >> /etc/sudoers

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
RUN chmod +x wp-cli.phar
RUN mv wp-cli.phar /usr/local/bin/wp

# Expose details about this docker image
COPY src/index.php /var/www/html
RUN rm -f /var/www/html/index.html && \
    mkdir /var/www/html/.config && \
    tar cf /var/www/html/.config/etc-apache2.tar etc/apache2 && \
    tar cf /var/www/html/.config/etc-php.tar     etc/php && \
    dpkg -l > /var/www/html/.config/dpkg-l.txt
	
RUN mkdir -p /var/www/html/wwwlog
RUN chown -R www-data:www-data /var/www
RUN chown -R www-data:www-data /etc/apache2/mods-enabled


EXPOSE 80
USER www-data

ARG ENVIRONMENT
ENV ENVIRONMENTENV=$ENVIRONMENT
ARG PETE_INSTALL_VERSION
ENV PETE_INSTALL_VERSION=$PETE_INSTALL_VERSION

COPY pete_install.sh /usr/local/bin/pete_install.sh
ENTRYPOINT ["sh","/usr/local/bin/pete_install.sh"]

