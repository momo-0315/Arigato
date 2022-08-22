DEFAULT CHARACTER SET=utf8;

DROP DATABASE IF EXISTS Airbnb;

CREATE DATABASE Airbnb;

USE Airbnb;

DROP TABLE IF EXISTS members;

CREATE TABLE
    members (
        id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        name TEXT NOT NULL
    )
INSERT INTO members (name)
VALUES ("momo"), ("sacchan"), ("kenty"), ("koheii"), ("mainooo");