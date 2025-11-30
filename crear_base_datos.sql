-- Script SQL para crear la base de datos y tabla de rutas

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

-- Insertar datos de ejemplo
INSERT INTO rutas (nombre, locacion, dificultad, rating) VALUES
('Ruta del Cóndor', 'Cañón del Cóndor', '1', '4'),
('Sendero del Mirador', 'Valle del Mirador', '0', '5'),
('Travesía del Bosque', 'Bosque Encantado', '2', '3'),
('Ascenso al Pico', 'Cima del Volcán', '3', '4'),
('Paseo por el Río', 'Río Claro', '0', '4');