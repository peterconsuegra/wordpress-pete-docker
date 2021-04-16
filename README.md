# WordPres Pete

WordPress efficiency starts here. Integrate Laravel, migrate, launch, or clone WordPress sites in minutes.

![alt text](https://raw.githubusercontent.com/peterconsuegra/wordpress-pete-docker/master/apache/petelogo.png "WordPress Pete Logo")

# Install instructions

## MacOS & Linux

1. Install docker
2. Install GIT
3. Open terminal
4. Stop default apache server in macOs:

⋅⋅⋅ sudo -S apachectl stop

⋅⋅⋅ sudo -S launchctl unload -w /System/Library/LaunchDaemons/org.apache.httpd.plist 2>/dev/null

5. git clone https://github.com/peterconsuegra/wordpress-pete-docker.git
6. cd wordpress-pete-docker
7. docker-compose -f unix.yml up --build
8. Wait until wordPress Pete migrations finish
9. open: http://pete.petelocal.net/

Check the installation video for macOS:

<a href="http://www.youtube.com/watch?feature=player_embedded&v=_DWmv0Mqrhk
" target="_blank"><img src="http://img.youtube.com/vi/_DWmv0Mqrhk/0.jpg" 
alt="IMAGE ALT TEXT HERE" width="240" height="180" border="10" /></a>

__Access to apache container console:__

docker-compose -f unix.yml exec apache /bin/sh 

__Access to mysql container console:__

docker-compose -f unix.yml exec mysql /bin/sh 

__Stop docker:__

docker-compose -f unix.yml down


## Windows

1. Install docker
2. Activate container Hyper-V in docker
3. Install GIT
4. git config --global core.autocrlf true (For compatibility, line endings are converted to Unix style when you commit files)
5. Open terminal
6. git clone https://github.com/peterconsuegra/wordpress-pete-docker.git
7. cd wordpress-pete-docker  
8. docker-compose -f windows.yml up --build
9. Wait until wordPress Pete migrations finish
10. open: http://pete.petelocal.net/

Check the installation video for Windows:

<a href="http://www.youtube.com/watch?feature=player_embedded&v=ML8NNVGfq8I
" target="_blank"><img src="http://img.youtube.com/vi/ML8NNVGfq8I/0.jpg" 
alt="IMAGE ALT TEXT HERE" width="240" height="180" border="10" /></a>


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

Note: When you change the values of the DB_ROOT_PASSWORD in the .env file you must also do it in the /public_html/Pete4/.env file

## More

1. https://wordpresspete.com
2. https://wordpresspete.com/tutorials





