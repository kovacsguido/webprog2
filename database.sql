SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS web2hf DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE web2hf;

CREATE TABLE IF NOT EXISTS user_permissions (
  id int NOT NULL AUTO_INCREMENT,
  name varchar(64) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

INSERT INTO user_permissions(id, name) VALUES
(1, 'Látogató'),
(2, 'Regisztrált felhasználó'),
(3, 'Adminisztrátor');

CREATE TABLE IF NOT EXISTS users (
  id int NOT NULL AUTO_INCREMENT,
  username varchar(64) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL,
  firstname varchar(32) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL,
  lastname varchar(32) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL,
  password varchar(40) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL,
  permission int NOT NULL,
  PRIMARY KEY (id),
  FOREIGN KEY (permission) REFERENCES user_permissions(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

INSERT INTO users(id, username, firstname, lastname, password, permission) VALUES
(1, "admin", "Admin", "Admin", "7dd12f3a9afa0282a575b8ef99dea2a0c1becb51", 3);

CREATE TABLE IF NOT EXISTS menu (
  id INT NOT NULL AUTO_INCREMENT,
  parent_id INT NOT NULL,
  url varchar(64) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL,
  name varchar(32) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL,
  permission int NOT NULL,
  position int NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

INSERT INTO menu (id, parent_id, url, name, permission, position) VALUES
(1, 0, 'kezdolap', 'Kezdőlap', 1, 10),
(2, 0, 'hirek', 'Hírek', 1, 20),
(3, 0, '', 'Információ',  1, 40),
(4, 0, '', 'Belépés/Regisztráció', 1, 30),
(5, 0, '', 'Adminisztráció',  3, 50),
(6, 3, 'rolunk', 'Rólunk', 1, 31),
(7, 3, 'elerhetoseg', 'Elérhetőség', 1, 32),
(8, 4, 'regisztracio', 'Regisztráció', 1, 41),
(9, 4, 'belepes', 'Belépés', 1, 42),
(10, 4, 'kilepes', 'Kilépés', 2, 43),
(11, 5, 'felhasznalok', 'Felhasználók', 3, 51);

CREATE TABLE IF NOT EXISTS news (
  id INT NOT NULL AUTO_INCREMENT,
  title varchar(62) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL,
  body varchar(4096) CHARACTER SET utf8 COLLATE utf8_hungarian_ci NOT NULL,
  created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  creator INT NOT NULL,
  FOREIGN KEY (creator) REFERENCES users(id),
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;