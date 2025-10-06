CREATE TABLE supervisor (
    id_supervisor INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(65) NOT NULL,
    cui VARCHAR(13) NOT NULL,
    telefono VARCHAR(8) NOT NULL,
    correo VARCHAR(65) NOT NULL,
    cargo VARCHAR(55) NOT NULL,
    sexo VARCHAR(10),
    estado BOOLEAN NOT NULL DEFAULT 1,
    creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE practicante (
    id_practicante INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(65) NOT NULL,
    edad INT NOT NULL,
    telefono VARCHAR(8) NOT NULL,
    institucion VARCHAR(65) NOT NULL,
    carrera VARCHAR(55) NOT NULL,
    area VARCHAR(65),
    estado BOOLEAN NOT NULL DEFAULT 1,
    creado TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE control(
    id_control INT AUTO_INCREMENT PRIMARY KEY,
    id_supervisor INT,
    id_practicante INT,
    fecha_control DATE,
    comentario VARCHAR(255),
    estado BOOLEAN NOT NULL DEFAULT 1,
    FOREIGN KEY (id_practicante) REFERENCES practicante(id_practicante),
    FOREIGN KEY (id_supervisor) REFERENCES supervisor(id_supervisor)
);

//Formulario 
//input tipo numerio para consultar el dpi 


//graficas 


