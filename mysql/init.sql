USE mysql;
CREATE DATABASE IF NOT EXISTS laravel;
CREATE USER 'laraveluser'@'%' IDENTIFIED BY 'laravel_db_password';
FLUSH PRIVILEGES;
GRANT ALL PRIVILEGES ON laraveluser.* TO 'laravel'@'localhost';
FLUSH PRIVILEGES;
