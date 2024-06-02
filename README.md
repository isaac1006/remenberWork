# remenberWork
Proyecto FInal
inplementar base de datos :

-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS remenberWorkDB;

-- Seleccionar la base de datos
USE remenberWorkDB;

-- Crear la tabla administrador
CREATE TABLE IF NOT EXISTS administrador (
    superAdmin VARCHAR(50),
    contrasena VARCHAR(50)
);

-- Insertar valores en la tabla administrador
INSERT INTO administrador (superAdmin, contrasena) VALUES ('adm', '1234');

-- Crear la tabla registroDeUsuarios
CREATE TABLE IF NOT EXISTS registroDeUsuarios (
    usuarioID INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    cedula VARCHAR(20),
    email VARCHAR(100),
    contrasena VARCHAR(50)
);

-- Crear la tabla supervisiones
CREATE TABLE IF NOT EXISTS supervisiones (
    supervisionID INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    tipologia VARCHAR(50),
    placa VARCHAR(20),
    fecha DATE
);

-- Crear la tabla tipologias
CREATE TABLE IF NOT EXISTS tipologias (
    tipologiaID INT AUTO_INCREMENT PRIMARY KEY,
    nombreDeTipologia VARCHAR(50)
);

-- Insertar valores en la tabla tipologias
INSERT INTO tipologias (nombreDeTipologia) VALUES 
    ('microbus'),
    ('enseñanza'),
    ('taxi'),
    ('carga'),
    ('diesel'),
    ('gasolina'),
    ('hibrido'),
    ('electrico'),
    ('moto-sport'),
    ('moto-scooter'),
    ('moto-alto Cilindraje'),
    ('moto-dobleEscape');