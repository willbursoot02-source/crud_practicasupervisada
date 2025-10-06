CREATE TABLE practicante (
    id_practicante INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(65) NOT NULL,
    edad INT NOT NULL,
    telefono VARCHAR(8) NOT NULL,
    institucion VARCHAR(65) NOT NULL,
    carrera VARCHAR(55) NOT NULL,
    area VARCHAR(65),
    creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
