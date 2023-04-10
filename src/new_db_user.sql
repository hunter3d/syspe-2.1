CREATE DATABASE reg_db;
CREATE USER 'reg_admin'@localhost IDENTIFIED BY 'reg_password';
GRANT ALL PRIVILEGES ON reg_db.* TO 'reg_admin'@localhost;
FLUSH PRIVILEGES;
