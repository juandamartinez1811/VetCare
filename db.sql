CREATE DATABASE vetcare;
USE vetcare;

CREATE TABLE citas (
  id_cita INT AUTO_INCREMENT PRIMARY KEY,
  nombre_cliente VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  mascota VARCHAR(100) NOT NULL,
  fecha DATE NOT NULL,
  hora TIME NOT NULL,
  motivo TEXT
);
