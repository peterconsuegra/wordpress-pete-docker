ARG OS_VERSION
FROM ${OS_VERSION}
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
RUN apt update --fix-missing

RUN apt-get --assume-yes install php7.4 php7.4-common
RUN apt-get --assume-yes install php7.4-curl php7.4-xml php7.4-zip php7.4-gd php7.4-mysql php7.4-mbstring php7.4-imagick
RUN a2enmod php7.4
RUN ln -sfn /usr/bin/php7.4 /etc/alternatives/php
RUN find /etc/php/7.4/apache2/php.ini -type f -exec sed -i 's/upload_max_filesize = 2M/upload_max_filesize = 50M/g' {} \;
RUN find /etc/php/7.4/apache2/php.ini -type f -exec sed -i 's/post_max_size = 2M/post_max_size = 50M/g' {} \;
RUN find /etc/php/7.4/apache2/php.ini -type f -exec sed -i 's/memory_limit = 128M/memory_limit = 256M/g' {} \;
	
RUN	sudo apt-get --assume-yes install php8.0 php8.0-common
RUN	sudo apt-get --assume-yes install php8.0-curl php8.0-xml php8.0-zip php8.0-gd php8.0-mysql php8.0-mbstring php8.0-imagick
RUN	ln -sfn /usr/bin/php8.0 /etc/alternatives/php
RUN	find /etc/php/8.0/apache2/php.ini -type f -exec sed -i 's/upload_max_filesize = 2M/upload_max_filesize = 50M/g' {} \;
RUN	find /etc/php/8.0/apache2/php.ini -type f -exec sed -i 's/post_max_size = 8M/post_max_size = 50M/g' {} \;
RUN	find /etc/php/8.0/apache2/php.ini -type f -exec sed -i 's/memory_limit = 128M/memory_limit = 256M/g' {} \;
	
RUN	sudo apt-get --assume-yes install php8.1 php8.1-common
RUN	sudo apt-get --assume-yes install php8.1-curl php8.1-xml php8.1-zip php8.1-gd php8.1-mysql php8.1-mbstring php8.1-imagick
RUN	ln -sfn /usr/bin/php8.1 /etc/alternatives/php
RUN	find /etc/php/8.1/apache2/php.ini -type f -exec sed -i 's/upload_max_filesize = 2M/upload_max_filesize = 50M/g' {} \;
RUN	find /etc/php/8.1/apache2/php.ini -type f -exec sed -i 's/post_max_size = 8M/post_max_size = 50M/g' {} \;
RUN	find /etc/php/8.1/apache2/php.ini -type f -exec sed -i 's/memory_limit = 128M/memory_limit = 256M/g' {} \;
	
#Set php 7.4 in console by default 
#RUN echo 1 | sudo update-alternatives --config php
ARG PHP_VERSION
RUN if [ "$PHP_VERSION" = "7.4" ] ; then echo 1 | sudo update-alternatives --config php ; fi

RUN if [ "$PHP_VERSION" = "8.0" ] ; then echo 2 | sudo update-alternatives --config php ; fi

RUN if [ "$PHP_VERSION" = "8.1" ] ; then echo 3 | sudo update-alternatives --config php ; fi

RUN a2dismod php8.0
RUN a2dismod php8.1
RUN a2dismod php7.4

RUN a2enmod php${PHP_VERSION}
RUN sudo a2enmod ssl

# Override default apache and php config
COPY src/000-default.conf /etc/apache2/sites-available
#COPY src/example1.conf /etc/apache2/sites-available
COPY src/mpm_prefork.conf /etc/apache2/mods-available
COPY src/status.conf      /etc/apache2/mods-available
COPY src/99-pete.ini     /etc/php/7.4/apache2/conf.d
COPY src/ssh_config     /etc/ssh/ssh_config

#RUN a2ensite example1

RUN mkdir -p /etc/apache2/pete-sites

RUN echo "Include /etc/apache2/pete-sites/*.conf" >> /etc/apache2/apache2.conf

RUN echo "www-data ALL=NOPASSWD: /etc/init.d/apache2 reload" >> /etc/sudoers
RUN echo "www-data ALL=NOPASSWD: /var/www/html/Pete/scripts/restart_server.sh" >> /etc/sudoers
RUN echo "www-data ALL=NOPASSWD: /var/www/html/Pete/scripts/securitystatus.sh" >> /etc/sudoers
RUN echo "www-data ALL=NOPASSWD: /var/www/html/Pete/scripts/get_mod_sec_report.sh" >> /etc/sudoers
RUN echo "www-data ALL=NOPASSWD: /var/www/html/Pete/scripts/print_security_report.sh" >> /etc/sudoers
RUN echo "www-data ALL=NOPASSWD: /usr/local/bin/composer" >> /etc/sudoers




RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
RUN chmod +x wp-cli.phar
#RUN chmod 400 -R /var/www/.ssh
RUN mv wp-cli.phar /usr/local/bin/wp

#MOD SECURITY CONFIGURATION
RUN apt-get -y install libapache2-mod-security2
RUN a2enmod security2
RUN cp /etc/modsecurity/modsecurity.conf-recommended /etc/modsecurity/modsecurity.conf

#installing mod_security rules
RUN cd /etc/modsecurity && git clone https://github.com/coreruleset/coreruleset.git
RUN cd /etc/modsecurity/coreruleset && git checkout v3.3/master
RUN mv /etc/modsecurity/coreruleset/crs-setup.conf.example /etc/modsecurity/crs-setup.conf
RUN mv /etc/modsecurity/coreruleset/rules/ /etc/modsecurity/

RUN rm -rf /etc/apache2/mods-available/security2.conf


RUN echo 'SecAuditLogFormat JSON' >> /etc/modsecurity/modsecurity.conf
ARG MOD_SECURITY
RUN if [ "$MOD_SECURITY" = "On" ] ; then find /etc/modsecurity/modsecurity.conf -type f -exec sed -i 's/SecRuleEngine DetectionOnly/SecRuleEngine On/g' {} \; ; fi

RUN if [ "$MOD_SECURITY" = "Off" ] ; then find /etc/modsecurity/modsecurity.conf -type f -exec sed -i 's/SecRuleEngine DetectionOnly/SecRuleEngine Off/g' {} \; ; fi

ARG SERVER_STATUS
RUN if [ "$SERVER_STATUS" = "On" ] ; then a2enmod status ; else a2dismod status; fi


#RUN mkdir -p /var/log/apache2
RUN touch /var/log/apache2/modsec_audit.log
RUN touch /var/log/apache2/error_log
COPY security2.conf /etc/apache2/mods-available/security2.conf
COPY whitelist.conf /etc/modsecurity/rules/whitelist.conf
RUN chmod -R 755 /var/log/apache2
RUN chown -R www-data:www-data /var/log/apache2
RUN rm /etc/modsecurity/rules/REQUEST-922-MULTIPART-ATTACK.conf
RUN chown -R www-data:www-data /etc/apache2/pete-sites
RUN chmod -R 755 /etc/apache2/pete-sites

#mod_sec_report
RUN apt --assume-yes install python3-pip
RUN chown -R www-data:www-data /var/log/apache2

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

ARG DOMAIN_TEMPLATE
ENV DOMAIN_TEMPLATE=$DOMAIN_TEMPLATE
ARG PETE_INSTALL_VERSION
ENV PETE_INSTALL_VERSION=$PETE_INSTALL_VERSION

RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html


COPY pete_install.sh /usr/local/bin/pete_install.sh
RUN apt install -y dos2unix
RUN dos2unix pete_install.sh
ENTRYPOINT ["sh","/usr/local/bin/pete_install.sh"]

