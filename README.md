# WordPres Pete

WordPress efficiency starts here. Integrate Laravel, migrate, launch, or clone WordPress sites in minutes.

![alt text](https://raw.githubusercontent.com/peterconsuegra/wordpress-pete-docker/master/apache/petelogo.png "WordPress Pete Logo")

# Install instructions

## MacOS & Linux

1. Open terminal
2. git clone https://github.com/peterconsuegra/wordpress-pete-docker.git
3. cd wordpress-pete-docker
4. Stop default apache server in macOs:

⋅⋅⋅ sudo -S apachectl stop

⋅⋅⋅ sudo -S launchctl unload -w /System/Library/LaunchDaemons/org.apache.httpd.plist 2>/dev/null

5. docker-compose -f unix.yml up --build

__Access to apache container console:__

docker-compose -f unix.yml exec apache /bin/sh 

__Access to mysql container console:__

docker-compose -f unix.yml exec mysql /bin/sh 

__Stop docker:__

docker-compose -f unix.yml down


## Windows

1. Open terminal
2. git clone https://github.com/peterconsuegra/wordpress-pete-docker.git
3. cd wordpress-pete-docker
4. Activate container Hyper-V docker
5. docker-compose -f windows.yml up --build

__Access to apache container console:__

docker-compose -f windows.yml exec apache /bin/sh 

__Access to mysql container console:__

docker-compose -f windows.yml exec mysql /bin/sh 

__Stop docker:__

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

## More

See more at: https://wordpresspete.com




