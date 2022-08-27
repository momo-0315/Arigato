DROP SCHEMA IF EXISTS arigato;

CREATE SCHEMA arigato;

USE arigato;

DROP TABLE IF EXISTS users;

CREATE TABLE users (
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  email VARCHAR(255) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO
  users
SET
  email = 'test@posse-ap.com',
  password = sha1('password');

DROP TABLE IF EXISTS airbnbs;

CREATE TABLE airbnbs (
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  img VARCHAR(255) NOT NULL,
  location BIT NOT NULL,
  service BIT NOT NULL,
  price INT NOT NULL,
  capacity INT NOT NULL,
  popularity BIT NOT NULL
);

INSERT INTO
  airbnbs
SET
  name = 'おのかんの家',
  img = 'onokan.jpg',
  location = 1,
  service = 0,
  price = 1000,
  capacity = 15,
  popularity = 0;

INSERT INTO
  airbnbs
SET
  name = 'なおきの家',
  img = 'naoki.jpg',
  location = 0,
  service = 1,
  price = 10,
  capacity = 30,
  popularity = 0;

INSERT INTO
  airbnbs
SET
  name = 'けんとの家',
  img = 'kento.jpg',
  location = 1,
  service = 0,
  price = 500,
  capacity = 5,
  popularity = 0;

INSERT INTO
  airbnbs
SET
  name = 'かずきの家',
  img = 'kazuki.jpeg',
  location = 0,
  service = 0,
  price = 2000,
  capacity = 7,
  popularity = 1;

INSERT INTO
  airbnbs
SET
  name = 'こうへいの家',
  img = 'kohei.jpg',
  location = 1,
  service = 0,
  price = 10000,
  capacity = 10,
  popularity = 1;

INSERT INTO
  airbnbs
SET
  name = 'じんの家',
  img = 'jin.jpg',
  location = 1,
  service = 0,
  price = 30000,
  capacity = 8,
  popularity = 0;

INSERT INTO
  airbnbs
SET
  name = 'まいのの家',
  img = 'maino.jpg',
  location = 1,
  service = 1,
  price = 100000,
  capacity = 15,
  popularity = 1;

INSERT INTO
  airbnbs
SET
  name = 'さちの家',
  img = 'sachi.jpg',
  location = 1,
  service = 0,
  price = 120000,
  capacity = 20,
  popularity = 0;

INSERT INTO
  airbnbs
SET
  name = 'ももの家',
  img = 'momo.jpg',
  location = 1,
  service = 0,
  price = 500,
  capacity = 3,
  popularity = 1;

INSERT INTO
  airbnbs
SET
  name = 'HarborS',
  img = 'harbors.jpg',
  location = 1,
  service = 1,
  price = 900,
  capacity = 65,
  popularity = 0;

