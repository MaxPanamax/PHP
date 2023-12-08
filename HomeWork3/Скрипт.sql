CREATE DATABASE IF NOT EXISTS Countries;
USE Countries;

CREATE TABLE Country
(
    id INT NOT NULL AUTO_INCREMENT,
    country VARCHAR(64) NOT NULL CHECK (country!=''),
    CONSTRAINT country_id_pk PRIMARY KEY(id)
);

CREATE TABLE City
(
    id INT NOT NULL AUTO_INCREMENT,
    city VARCHAR(64) NOT NULL CHECK (city!=''),
    country_id INT NOT NULL,
    CONSTRAINT city_id_pk PRIMARY KEY(id)
);

ALTER TABLE City
ADD CONSTRAINT FK_countryId_CityId FOREIGN KEY (country_id) REFERENCES Country(id) ON DELETE CASCADE;
/*Россия*/
INSERT INTO Country (id, country) VALUES (NULL, 'Россия');
SET @last_id_in_country = LAST_INSERT_ID();
INSERT INTO City (id, city, country_id) VALUES (NULL, 'Калининград', @last_id_in_country);
INSERT INTO City (id, city, country_id) VALUES (NULL, 'Москва', @last_id_in_country);
INSERT INTO City (id, city, country_id) VALUES (NULL, 'Казань', @last_id_in_country);
/*Великобритания*/
INSERT INTO Country (id, country) VALUES (NULL, 'Великобритания');
SET @last_id_in_country = LAST_INSERT_ID();
INSERT INTO City (id, city, country_id) VALUES (NULL, 'Бирмингем', @last_id_in_country);
INSERT INTO City (id, city, country_id) VALUES (NULL, 'Лондон', @last_id_in_country);
INSERT INTO City (id, city, country_id) VALUES (NULL, 'Лидс', @last_id_in_country);
/*Франция*/
INSERT INTO Country (id, country) VALUES (NULL, 'Франция');
/*Пользователи*/
CREATE TABLE Users
(
	id INT NOT NULL AUTO_INCREMENT,
    login VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL,
    CONSTRAINT users_id_pk PRIMARY KEY(id)
);
INSERT INTO Users (id, login, password) VALUES (NULL, 'Marat', '12345');
INSERT INTO Users (id, login, password) VALUES (NULL, 'Ivan', '12345');
INSERT INTO Users (id, login, password) VALUES (NULL, 'Max', '12345');