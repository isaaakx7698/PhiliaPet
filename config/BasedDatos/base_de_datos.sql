CREATE DATABASE IF NOT EXISTS philiapet_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE philiapet_db;

CREATE TABLE IF NOT EXISTS fundaciones (
    id_fundacion INT AUTO_INCREMENT PRIMARY KEY,
    nombre_fundacion VARCHAR(100) NOT NULL,
    nombre_representante VARCHAR(100),
    telefono VARCHAR(20) NOT NULL,
    correo_electronico VARCHAR(100) UNIQUE,
    direccion_sede VARCHAR(150),
    enlace_redes_sociales VARCHAR(255),
    ruta_qr_nequi VARCHAR(255),
    estado_validacion ENUM('pendiente', 'verificado', 'rechazado') DEFAULT 'pendiente',
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS mascotas (
    id_mascota INT AUTO_INCREMENT PRIMARY KEY,
    id_fundacion INT NOT NULL,
    nombre_mascota VARCHAR(50) NOT NULL,
    especie_animal ENUM('perro', 'gato', 'otro') NOT NULL,
    edad_estimada VARCHAR(50) NOT NULL,
    estado_salud VARCHAR(255) DEFAULT 'Sano y listo para adopción',
    ruta_foto VARCHAR(255),
    historia_perfil TEXT,
    estado_disponibilidad ENUM('disponible', 'en_proceso', 'adoptado') DEFAULT 'disponible',
    fecha_ingreso TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_mascotas_fundaciones 
        FOREIGN KEY (id_fundacion) 
        REFERENCES fundaciones(id_fundacion) 
        ON DELETE CASCADE 
        ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS jornadas_eventos (
    id_evento INT AUTO_INCREMENT PRIMARY KEY,
    titulo_evento VARCHAR(150) NOT NULL,
    tipo_evento ENUM('vacunacion', 'adopcion_centro_comercial', 'recolecta', 'otro') NOT NULL,
    descripcion_evento TEXT,
    fecha_programada DATE NOT NULL,
    hora_programada TIME NOT NULL,
    lugar_encuentro VARCHAR(150) NOT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS participacion_eventos (
    id_evento INT NOT NULL,
    id_fundacion INT NOT NULL,
    PRIMARY KEY (id_evento, id_fundacion),
    CONSTRAINT fk_participacion_eventos 
        FOREIGN KEY (id_evento) 
        REFERENCES jornadas_eventos(id_evento) 
        ON DELETE CASCADE,
    CONSTRAINT fk_participacion_fundaciones 
        FOREIGN KEY (id_fundacion) 
        REFERENCES fundaciones(id_fundacion) 
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS solicitudes_contacto (
    id_solicitud INT AUTO_INCREMENT PRIMARY KEY,
    id_mascota INT NOT NULL,
    nombre_interesado VARCHAR(100) NOT NULL,
    telefono_interesado VARCHAR(20) NOT NULL,
    correo_interesado VARCHAR(100),
    mensaje_contacto TEXT,
    fecha_envio TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_contacto_mascotas 
        FOREIGN KEY (id_mascota) 
        REFERENCES mascotas(id_mascota) 
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS registro_donaciones (
    id_donacion INT AUTO_INCREMENT PRIMARY KEY,
    id_fundacion INT NOT NULL,
    tipo_aporte ENUM('dinero', 'alimento', 'cobijas', 'otro') NOT NULL,
    detalle_donacion TEXT,
    nombre_donante VARCHAR(100) DEFAULT 'Anónimo',
    fecha_donacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_donaciones_fundaciones 
        FOREIGN KEY (id_fundacion) 
        REFERENCES fundaciones(id_fundacion) 
        ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    correo VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    rol ENUM('adoptante', 'refugio') DEFAULT 'adoptante',
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);