CREATE DATABASE IF NOT EXISTS TestDb;
USE TestDb;

CREATE TABLE Users
(
    id INT NOT NULL AUTO_INCREMENT,
    fullName VARCHAR(50) NOT NULL CHECK (fullname!=''),
    login VARCHAR(20) NOT NULL CHECK (login!=''),
    password VARCHAR(20) NOT NULL CHECK (password!=''),
    email VARCHAR(50) NOT NULL CHECK (email!=''),
    CONSTRAINT users_id_pk PRIMARY KEY(Id),
    CONSTRAINT users_login_uq UNIQUE(login),
    CONSTRAINT users_email_uq UNIQUE(email)
);