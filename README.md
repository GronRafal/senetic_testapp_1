## run commands 

> sudo docker-compose up -d

> sudo docker-compose exec db bash

> mysql

>>CREATE DATABASE laravel;
>
>>CREATE USER 'laraveluser'@'%' IDENTIFIED BY 'laravel_db_password';
>
>>GRANT ALL PRIVILEGES ON laravel.* TO 'laraveluser'@'%' with grant option;
>
>>FLUSH PRIVILEGES;

### exit from mysql

### exit from docker

> env DB_HOST=127.0.0.1 php artisan migrate:refresh --seed

[http://localhost:9001/api/docs](http://localhost:9001/api/docs)
