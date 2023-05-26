-- Crear la base de datos "blog"
CREATE DATABASE IF NOT EXISTS blog;

-- Utilizar la base de datos "blog"
USE blog;

-- Crear la tabla "usuarios"
CREATE TABLE usuarios (
  id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL UNIQUE,
  email VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
);

-- Crear la tabla "posts"
CREATE TABLE posts (
  id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  titulo VARCHAR(100) NOT NULL,
  descripcion TEXT,
  usuario_id INT(11) UNSIGNED,
  contenido TEXT,
  FOREIGN KEY (usuario_id) REFERENCES usuarios(id)
);