CREATE TABLE voluntario 
	(nombre_vol VARCHAR(100), email VARCHAR(100), 
	direccion VARCHAR(100), telefono VARCHAR(20),
	sexo_vol CHAR(5), PRIMARY KEY (nombre_vol, email), UNIQUE (email) ) ENGINE = InnoDB;

CREATE TABLE trabajo ( semestre VARCHAR(20), rol VARCHAR(100), 
	email VARCHAR(100), PRIMARY KEY (semestre, rol, email), 
	FOREIGN KEY (email) REFERENCES voluntario(email) ) ENGINE = InnoDB;

CREATE TABLE clases 
	(nombre_clase VARCHAR(64), horario VARCHAR(25),
	semestre VARCHAR(20), email VARCHAR(100),
	seccion VARCHAR(5), class_id VARCHAR(20), UNIQUE (nombre_clase, seccion, semestre),
	FOREIGN KEY (semestre) REFERENCES trabajo(semestre),
	FOREIGN KEY (email) REFERENCES voluntario(email), PRIMARY KEY (class_id) ) ENGINE = InnoDB;

CREATE TABLE estudiante
	(id_estudiante VARCHAR(5), nombre_estudiante VARCHAR(100),
	direccion VARCHAR(100), telefono VARCHAR(20), sexo_estu CHAR(5),
	PRIMARY KEY (id_estudiante) ) ENGINE = InnoDB;

CREATE TABLE matriculados
	(id_estudiante VARCHAR(5), class_id VARCHAR(20),
	PRIMARY KEY (id_estudiante, class_id),
	FOREIGN KEY (id_estudiante) REFERENCES estudiante(id_estudiante),
	FOREIGN KEY (class_id) REFERENCES clases(class_id) ) ENGINE = InnoDB;

CREATE TABLE credenciales 
	(username VARCHAR(100), password VARCHAR(100),
	PRIMARY KEY (username, password) ) ENGINE = InnoDB;

INSERT INTO voluntario (nombre_vol, email, telefono, sexo_vol) VALUES
	('Fifo Copjiri', 'fifo@cauce.uprrp.edu', '787-555-5555', 'M'),
	('Mt. Fuji', 'fuji@cauce.uprrp.edu','787-407-3456', 'M'),
	('Alyssa', 'alyssa@cauce.uprrp.edu','787-123-8910', 'F');

INSERT INTO credenciales (username, password) VALUES
	('fifo@cauce.uprrp.edu', 'fifo123');

INSERT INTO trabajo (email, rol, semestre) VALUES
	('fifo@cauce.uprrp.edu', 'Administrador', 'B42'),
	('fuji@cauce.uprrp.edu', 'Montana', 'B41'),
	('alyssa@cauce.uprrp.edu', 'Syst. Admin.', 'B42'),
	('fuji@cauce.uprrp.edu', 'Montana', 'B42'),
	('fuji@cauce.uprrp.edu', 'Monumento', 'B41');

INSERT INTO clases (nombre_clase, semestre, email, class_id, seccion) VALUES
	('Computadoras 101', 'B42', 'fifo@cauce.uprrp.edu', '1', '001'),
	('Computadoras Avanzadas', 'B42', 'fuji@cauce.uprrp.edu', '2', '001'),
	('Huerto', 'B42', 'alyssa@cauce.uprrp.edu', '3', '001'),
	('Huerto', 'B41', 'fifo@cauce.uprrp.edu', '4', '001');

INSERT INTO estudiante (id_estudiante, nombre_estudiante) VALUES
	('1', 'Alfredo Corleone'),
	('2', 'Edwin Deprimido'),
	('3', 'Dolores Miranda');

INSERT INTO matriculados (id_estudiante, class_id) VALUES
	('1', '1'),
	('1', '3'),
	('2', '2'),
	('2', '1'),
	('3', '4');

#--------------------------------------------------------------------------
# Displaying Courses:

SELECT c.nombre_clase, c.horario, c.semestre, c.email, c.seccion, c.class_id
	FROM clases c, trabajo t, voluntario v 
	WHERE c.email = v.email AND c.semestre = t.semestre
	AND v.email = t.email ORDER BY c.class_id;

#--------------------------------------------------------------------------
# Displaying Voluntary Staff:

SELECT * FROM voluntario;

#--------------------------------------------------------------------------
# Displaying Students:

SELECT * FROM estudiante;