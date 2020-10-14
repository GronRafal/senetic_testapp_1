## run commands 

> composer install

> sudo docker-compose build app

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

copy env.example to .env

> env DB_HOST=127.0.0.1 php artisan migrate:refresh --seed

[http://localhost:9001/api/docs](http://localhost:9001/api/docs)
