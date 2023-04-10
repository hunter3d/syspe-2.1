CREATE DATABASE syspe_db;
CREATE USER 'syspe_admin'@localhost IDENTIFIED BY 'syspe_password';
GRANT ALL PRIVILEGES ON syspe_db.* TO 'syspe_admin'@localhost;
FLUSH PRIVILEGES;
