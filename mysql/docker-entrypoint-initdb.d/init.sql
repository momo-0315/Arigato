DROP SCHEMA IF EXISTS airbnb;

CREATE SCHEMA airbnb;

USE airbnb;

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

DROP TABLE IF EXISTS events;

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
  location = 'true',
  service = 'false',
  price = 1000,
  capacity = 15,
  popularity = 'false';

INSERT INTO
  airbnbs
SET
  name = 'なおきの家',
  img = 'naoki.jpg',
  location = 'false',
  service = 'true',
  price = 10,
  capacity = 30,
  popularity = 'false';

INSERT INTO
  airbnbs
SET
  name = 'けんとの家',
  img = 'kento.jpg',
  location = 'true',
  service = 'false',
  price = 500,
  capacity = 5,
  popularity = 'false';

INSERT INTO
  airbnbs
SET
  name = 'かずきの家',
  img = 'kazuki.jpeg',
  location = 'false',
  service = 'false',
  price = 2000,
  capacity = 7,
  popularity = 'true';

INSERT INTO
  airbnbs
SET
  name = 'こうへいの家',
  img = 'kohei.jpg',
  location = 'true',
  service = 'false',
  price = 10000,
  capacity = 10,
  popularity = 'true';

INSERT INTO
  airbnbs
SET
  name = 'じんの家',
  img = 'jin.jpg',
  location = 'true',
  service = 'false',
  price = 30000,
  capacity = 8,
  popularity = 'false';

INSERT INTO
  airbnbs
SET
  name = 'まいのの家',
  img = 'maino.jpg',
  location = 'true',
  service = 'true',
  price = 100000,
  capacity = 15,
  popularity = 'true';

INSERT INTO
  airbnbs
SET
  name = 'さちの家',
  img = 'sachi.jpg',
  location = 'true',
  service = 'false',
  price = 120000,
  capacity = 20,
  popularity = 'false';

INSERT INTO
  airbnbs
SET
  name = 'ももの家',
  img = 'momo.jpg',
  location = 'true',
  service = 'false',
  price = 500,
  capacity = 3,
  popularity = 'true';

INSERT INTO
  airbnbs
SET
  name = 'HarborS',
  img = 'harbors.jpg',
  location = 'true',
  service = 'true',
  price = 900,
  capacity = 65,
  popularity = 'false';

