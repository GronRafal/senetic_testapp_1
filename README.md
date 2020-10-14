## run commands 

> composer install

> sudo docker-compose build app

copy env.example to .env

> sudo docker-compose up -d

> sudo docker-compose exec db bash

> mysql

>>CREATE DATABASE IF NOT EXISTS laravel;
>
>>CREATE USER 'laraveluser'@'localhost' IDENTIFIED BY 'laravel_db_password';
>
>>GRANT ALL PRIVILEGES ON laravel.* TO 'laraveluser'@'localhost' with grant option;
>
>>FLUSH PRIVILEGES;

### exit from mysql

### exit from docker

update DB_PORT=3306 in .env to DB_PORT=3307
run from local
> env DB_HOST=127.0.0.1 php artisan migrate:refresh --seed

update DB_PORT=3307 in .env to DB_PORT=3306

[http://localhost:9001/api/docs](http://localhost:9001/api/docs)
