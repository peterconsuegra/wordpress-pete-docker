# Install instructions

## Mac

Install Docker

git clone -b 1.1 https://github.com/peterconsuegra/wordpress-pete-docker.git
cd wordpress-pete-docker

Stop default apache server in macOs
sudo -S apachectl stop
sudo -S launchctl unload -w /System/Library/LaunchDaemons/org.apache.httpd.plist 2>/dev/null

docker-compose -f unix.yml up --build

Access to apache container console:
docker-compose -f unix.yml exec apache /bin/sh 

Stop docker
docker-compose -f unix.yml down


## Windows

git clone -b 1.1 https://github.com/peterconsuegra/wordpress-pete-docker.git
cd wordpress-pete-docker
docker-compose -f windows.yml up --build

Access to apache container console:
docker-compose -f windows.yml exec apache /bin/sh 

Access to mysql container console:
docker-compose -f windows.yml exec mysql /bin/sh 

Stop docker
docker-compose -f windows.yml down

## Docker settings

You can change the docker settings from .env file:

PHP_VERSION=7.4
MYSQL_VERSION=5.7
APACHE_VERSION=2.4.32
ENVIRONMENT=development

DB_ROOT_PASSWORD=rootpassword
DB_NAME=pete_db
DB_USERNAME=otherUser
DB_PASSWORD=password


