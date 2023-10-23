-- Créer la base de données
CREATE DATABASE blogsjt;

-- Utiliser la base de données
USE blogsjt;

-- Créer la table "user"
CREATE TABLE user (
  id INT PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password_hash VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);