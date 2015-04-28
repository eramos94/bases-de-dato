CREATE TABLE voluntario 
	(id_vol INT NOT NULL AUTO_INCREMENT, nombre_vol VARCHAR(100), email VARCHAR(100), 
	direccion_vol VARCHAR(100), telefono_vol VARCHAR(20),
	sexo_vol CHAR(5), PRIMARY KEY (id_vol), UNIQUE (email) ) ENGINE = InnoDB;

CREATE TABLE trabajo ( semestre VARCHAR(20), rol VARCHAR(100), 
	id_vol INT, PRIMARY KEY (semestre, rol, id_vol), 
	FOREIGN KEY (id_vol) REFERENCES voluntario(id_vol) ) ENGINE = InnoDB;

CREATE TABLE clases 
	(nombre_clase VARCHAR(64), horario VARCHAR(25),
	semestre VARCHAR(20), id_vol INT,
	seccion VARCHAR(5), class_id INT NOT NULL AUTO_INCREMENT, UNIQUE (nombre_clase, seccion, semestre),
	FOREIGN KEY (semestre) REFERENCES trabajo(semestre),
	FOREIGN KEY (id_vol) REFERENCES voluntario(id_vol), PRIMARY KEY (class_id, nombre_clase) ) ENGINE = InnoDB;

CREATE TABLE estudiante
	(id_estudiante INT NOT NULL AUTO_INCREMENT, nombre_estudiante VARCHAR(100),
	direccion_estu VARCHAR(100), telefono_estu VARCHAR(20), sexo_estu CHAR(5),
	PRIMARY KEY (id_estudiante) ) ENGINE = InnoDB;

CREATE TABLE matriculados
	(id_estudiante INT, class_id INT,
	PRIMARY KEY (id_estudiante, class_id),
	FOREIGN KEY (id_estudiante) REFERENCES estudiante(id_estudiante),
	FOREIGN KEY (class_id) REFERENCES clases(class_id) ) ENGINE = InnoDB;

CREATE TABLE credenciales 
	(username VARCHAR(100), password VARCHAR(100),
	PRIMARY KEY (username, password) ) ENGINE = InnoDB;

INSERT INTO voluntario (nombre_vol, email, telefono_vol, direccion_vol, sexo_vol) VALUES
	('Fifo Copjiri', 'fifo@cauce.uprrp.edu', '787-555-5555', 'Apartamento #15, Calle West, Apartamentito Lindo', 'M'),
	('Mt. Fuji', 'fuji@cauce.uprrp.edu','787-407-3456', 'J-16, Calle 15, Japon', 'M'),
	('Alyssa', 'alyssa@cauce.uprrp.edu','787-123-8910', 'K-4, Calle CAUCE, Urb. Pan de Agua', 'F');

INSERT INTO credenciales (username, password) VALUES
	('fifo@cauce.uprrp.edu', 'fifo123'),
	('alyssa@cauce.uprrp.edu', 'alyssa123');

INSERT INTO trabajo (id_vol, rol, semestre) VALUES
	(1, 'Administrador', 'B42'),
	(2, 'Montana', 'B41'),
	(3, 'Syst. Admin.', 'B42'),
	(2, 'Montana', 'B42'),
	(2, 'Monumento', 'B41');

INSERT INTO clases (nombre_clase, semestre, id_vol, seccion) VALUES
	('Computadoras 101', 'B42', 1, '001'),
	('Computadoras Avanzadas', 'B42', 2, '001'),
	('Huerto', 'B42', 3, '001'),
	('Huerto', 'B41', 2, '001');

INSERT INTO estudiante (nombre_estudiante, direccion_estu, telefono_estu, sexo_estu) VALUES
	('Dolores Miranda', 'CAUCE Rio Piedras', '939-123-0000', 'F'),
	('Alfredo Corleone', 'Godfather Rio Piedras', '000-000-0000', 'M'),
	('Edwin Ramos', 'El Refugio Rio Piedras', '787-123-4567', 'M');

INSERT INTO matriculados (id_estudiante, class_id) VALUES
	('1', '1'),
	('1', '2'),
	('2', '2'),
	('2', '1'),
	('3', '1');

#--------------------------------------------------------------------------
# Displaying Courses:

SELECT distinct c.nombre_clase, c.horario, c.semestre, c.id_vol, c.seccion, c.class_id
	FROM clases c, trabajo t, voluntario v 
	WHERE c.id_vol = v.id_vol AND c.semestre = t.semestre
	AND v.id_vol = t.id_vol ORDER BY c.class_id;

#--------------------------------------------------------------------------
# Displaying Voluntary Staff:

SELECT * FROM voluntario;

#--------------------------------------------------------------------------
# Displaying Students:

SELECT * FROM estudiante;