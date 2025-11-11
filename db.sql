CREATE DATABASE vetcare;
USE vetcare;

CREATE TABLE duenos (
    id_dueno INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    telefono VARCHAR(15),
    direccion VARCHAR(150),
    email VARCHAR(100)
);

CREATE TABLE mascotas (
    id_mascota INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    especie VARCHAR(50) NOT NULL,
    raza VARCHAR(50),
    edad INT,
    id_dueno INT,
    FOREIGN KEY (id_dueno) REFERENCES duenos(id_dueno)
);

CREATE TABLE citas (
    id_cita INT AUTO_INCREMENT PRIMARY KEY,
    id_mascota INT,
    fecha DATE,
    hora TIME,
    motivo VARCHAR(200),
    estado VARCHAR(20) DEFAULT 'Pendiente',
    FOREIGN KEY (id_mascota) REFERENCES mascotas(id_mascota)
);

CREATE TABLE tratamientos (
    id_tratamiento INT AUTO_INCREMENT PRIMARY KEY,
    id_cita INT,
    descripcion TEXT,
    medicamento VARCHAR(100),
    dosis VARCHAR(50),
    FOREIGN KEY (id_cita) REFERENCES citas(id_cita)
);
