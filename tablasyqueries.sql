CREATE TABLE voluntario 
	(nombre_vol VARCHAR(100), email VARCHAR(100), 
	direccion VARCHAR(100), telefono VARCHAR(20),
	sexo_vol CHAR(5), PRIMARY KEY (nombre_vol, email), UNIQUE (email) ) ENGINE = InnoDB;


CREATE TABLE trabajo ( semestre VARCHAR(20), rol VARCHAR(100), 
	email VARCHAR(100), PRIMARY KEY (semestre, rol, email), 
	FOREIGN KEY (email) REFERENCES voluntario(email) ) ENGINE = InnoDB;

CREATE TABLE clases 
	(nombre_clase VARCHAR(64), horario VARCHAR(25),
	semestre VARCHAR(20), nombre_vol VARCHAR(100),
	seccion INT, class_id VARCHAR(20), PRIMARY KEY (nombre_clase, class_id, semestre),
	FOREIGN KEY (semestre) REFERENCES trabajo(semestre),
	FOREIGN KEY (nombre_vol) REFERENCES voluntario(nombre_vol) ) ENGINE = InnoDB;

CREATE TABLE estudiante
	(id_estudiante INT, nombre_estudiante VARCHAR(100),
	direccion VARCHAR(100), telefono VARCHAR(20), sexo_estu CHAR(5),
	PRIMARY KEY (id_estudiante) ) ENGINE = InnoDB;

CREATE TABLE matriculados
	(id_estudiante INT, class_id VARCHAR(20),
	PRIMARY KEY (id_estudiante, class_id),
	FOREIGN KEY (id_estudiante) REFERENCES estudiante(id_estudiante),
	FOREIGN KEY (class_id) REFERENCES clases(class_id) ) ENGINE = InnoDB;


CREATE TABLE credenciales 
	(username VARCHAR(100), password VARCHAR(100),
	PRIMARY KEY (username, password) ) ENGINE = InnoDB;

INSERT INTO 'voluntario' ('nombre_vol', 'email', 'telefono', 'sexo_vol') VALUES
	('Fifo Copjiri', 'fifo@cauce.uprrp.edu', '787-555-5555', 'M'),
	('Mt. Fuji', 'fuji@cauce.uprrp.edu','787-407-3456', 'M'),
	('Alyssa', 'alyssa@cauce.uprrp.edu','787-123-8910', 'F');

INSERT INTO credenciales (username, password) VALUES
	('fifo@cauce.uprrp.edu', 'fifo123');