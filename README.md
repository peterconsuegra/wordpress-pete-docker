#Docker recipes

docker-compose -f windows.yml up --build 
docker-compose -f unix.yml up --build

docker-compose up --build 

docker-compose -f docker-compose.yml 

docker-compose up -d --build   
docker-compose up -d nginx
docker-compose up -d apache

-Para montar servidor mostrando errores
docker-compose up

Stop docker:
docker-compose -f development.yml down

docker-compose down


###Error container activo

ERROR: for php  Cannot create container for service php: Conflict. The container name "/php" is already in use by container "2345b4931cb9bc0a4b18bc698524af7577db7337d476f367a68b1449af4fa4ba". You have to remove (or rename) that container to be able to reuse that name.


correr containers: 
docker ps -a

Detener container
docker container stop 2345b4931cb9

Eliminar container
docker container rm 5d255feb437e


###Parar servidor default de Mac
ERROR: ERROR: for nginx  Cannot start service nginx: Ports are not available: listen tcp 0.0.0.0:80: bind: address already in use

echo "1234" | sudo -S apachectl stop
echo "1234" | sudo -S launchctl unload -w /System/Library/LaunchDaemons/org.apache.httpd.plist 2>/dev/null


###Navegar en el container nginx

docker-compose exec nginx /bin/sh 

Configuracion de nginx por default:
/etc/nginx/conf.d/default.conf


###Navegar en el container apache

docker-compose exec apache /bin/sh 

###Navegar en el container apache

docker-compose exec php /bin/sh 

###Navegar en el container mysql

docker-compose -f unix.yml exec mysql /bin/sh 
php artisan create_database --host=mysql --db_user=root --db_user_pass=rootpassword --db_name=petedb

docker exec -it mysql mysql -uroot -prootpassword

docker exec -it mysql mysql -uusr_YspiChrvga -pPJc8eiYKtq

docker exec -it mysql mysql -uusr_3wTZlfyV9S -p5bu4RgpzEa

###Debug en containers
 
 a4d8978cfad0: container id
 docker logs a4d8978cfad0
 
 Listar containers
 docker ps -a


###Migrations

docker-compose exec php php /var/www/html/pete/artisan migrate

docker-compose exec php php /var/www/html/artisan migrate


###laravel

docker compose run --rm composer create-project laravel/laravel /var/www/html/laravelapp
 
###nginx
 nginx:
     build: 
       context: .
       dockerfile: nginx.dockerfile
     container_name: nginx
     ports: 
       - 80:80
       - 443:443
     volumes:
       - ./src:/var/www/html
     networks:
       - laravel

###apache2

 apache: 
    build:
      context: .
      dockerfile: apache.dockerfile
    container_name: apache
    ports: 
      - 80:80
      - 443:443
    volumes:
      - ./src:/var/www/html
    networks:
      - laravel

git clone git@bitbucket.org:ozone777/wordpress-pete-docker.git

WINDOWS 
:\Windows\System32\drivers\etc\hosts