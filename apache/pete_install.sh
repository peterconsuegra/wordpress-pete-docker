#!/bin/bash 

FILE=/var/www/html/.installed
if [ ! -f "$FILE" ]; then
	
echo "#######################################"
echo "Starting WordPress Pete installation..."
echo "#######################################"

rm -rf /var/www/html/Pete4	
git clone -b 4 https://ozone777@bitbucket.org/ozone777/wordpresspete3.git /var/www/html/Pete4 && echo "cloned"
cd /var/www/html/Pete4

# Checkout latest tag
git fetch --tags
latestTag=$(git describe --tags `git rev-list --tags --max-count=1`)
git checkout $latestTag

#Hack wait 300 seconds to mysql be alive
#sleep 300

pete_route=/var/www/html/Pete4
route=/var/www/html
conf_route=/etc/apache2/pete-sites
mkdir $conf_route

cd $pete_route
rm -rf auth.json
rm composer.json
cp composer_original.json composer.json
cp .env.example .env

echo "
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=pete_db
DB_USERNAME=root
DB_PASSWORD=rootpassword

PETE_ROOT_PASS=rootpassword
PETE_DASHBOARD_URL=https://dashboard.wordpresspete.com
PETE_DEMO=inactive
PETE_ENVIRONMENT=production
PETE_DEBUG=inactive
" >> $pete_route/.env

composer install
php artisan key:generate
php artisan migrate

#general options
php artisan addoption --option_name=os --option_value=docker
php artisan addoption --option_name=parent_version --option_value=4
php artisan addoption --option_name=version --option_value=$latestTag
php artisan addoption --option_name=app_root --option_value=/var/www/html
php artisan addoption --option_name=server_conf --option_value=$conf_route
php artisan addoption --option_name=server --option_value=apache
php artisan addoption --option_name=server_version --option_value=24
php artisan addoption --option_name=os_version --option_value=bionic
php artisan addoption --option_name=os_distribution --option_value=docker
php artisan addoption --option_name=logs_route --option_value=/var/www/html/wwwlog


#sidebar options
php artisan addoption --option_name=sites --option_title=WordPress_Sites --option_value=/sites --option_category=sidebar --option_order=1 --option_privileges=all
php artisan addoption --option_name=plugins --option_title=premium_plugins --option_value=/premium_plugins --option_category=sidebar --option_order=10 --option_privileges=all
php artisan addoption --option_name=phpmyadmin --option_title=phpmyadmin --option_value=/phpmyadmin_panel --option_category=sidebar --option_order=12 --option_privileges=all
php artisan addoption --option_name=phpinfo --option_title=phpinfo --option_value=/phpinfo_panel --option_category=sidebar --option_order=13 --option_privileges=all

mkdir -p $pete_route/public/uploads
mkdir -p $pete_route/public/export
mkdir -p $pete_route/trash
mkdir -p $pete_route/storage
mkdir -p $pete_route/storage/logs
touch $pete_route/storage/logs/laravel.log

mkdir -p /var/www/html/wwwlog/Pete4
mkdir -p /var/www/html/wwwlog/example1
composer dump-autoload

echo "done" > /var/www/html/.installed
/etc/init.d/apache2 reload

echo "#######################################"
echo "WorPress Pete installation completed"
echo "#######################################"

fi

echo "#######################################"
echo "Launching WordPress Pete..."
echo "#######################################"

sleep 15

cd /var/www/html/Pete4 && php artisan addoption --option_name=domain_template --option_value=$DOMAIN_TEMPLATE

FILE=/var/www/.ssh/id_rsa.pub
if [ ! -f "$FILE" ]; then
   ssh-keygen -t rsa -N "" -f ~/.ssh/id_rsa
fi

chmod 600 -R /var/www/.ssh/id_rsa
chmod 600 -R /var/www/.ssh/id_rsa.pub

apachectl -DFOREGROUND
#systemctl start
#/etc/init.d/apache2 reload
echo "Loading apache..."