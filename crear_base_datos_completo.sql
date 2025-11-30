-- Script SQL para crear la base de datos completa del Parque Nacional

-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS parque_nacional;
USE parque_nacional;

-- Crear la tabla de rutas
CREATE TABLE rutas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    locacion VARCHAR(255) NOT NULL,
    dificultad ENUM('0', '1', '2', '3') NOT NULL,
    rating ENUM('1', '2', '3', '4', '5') NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Crear la tabla de usuarios
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    telefono VARCHAR(20),
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Crear la tabla de reservas
CREATE TABLE reservas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    fecha_visita DATE NOT NULL,
    hora_visita TIME NOT NULL,
    numero_visitantes INT NOT NULL,
    ruta_preferida VARCHAR(255) NOT NULL,
    requiere_guia BOOLEAN DEFAULT FALSE,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);

-- Insertar datos de ejemplo para rutas
INSERT INTO rutas (nombre, locacion, dificultad, rating) VALUES
('Ruta del Cóndor', 'Cañón del Cóndor', '1', '4'),
('Sendero del Mirador', 'Valle del Mirador', '0', '5'),
('Travesía del Bosque', 'Bosque Encantado', '2', '3'),
('Ascenso al Pico', 'Cima del Volcán', '3', '4'),
('Paseo por el Río', 'Río Claro', '0', '4');