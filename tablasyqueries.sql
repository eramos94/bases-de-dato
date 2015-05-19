CREATE TABLE voluntario 
	(id_vol INT NOT NULL AUTO_INCREMENT, nombre_vol VARCHAR(100), email VARCHAR(100), 
	direccion_vol VARCHAR(100), telefono_vol VARCHAR(20),
	sexo_vol CHAR(5), PRIMARY KEY (id_vol), UNIQUE (email) ) ENGINE = InnoDB;

CREATE TABLE roles
	(id_rol INT NOT NULL AUTO_INCREMENT, nombre_rol VARCHAR(100),
	PRIMARY KEY (id_rol), UNIQUE (nombre_rol) ) ENGINE = InnoDB;

CREATE TABLE tutor
	(id_vol INT REFERENCES voluntario(id_vol), PRIMARY KEY (id_vol) ) ENGINE = InnoDB;

CREATE TABLE notutor
	(id_vol INT REFERENCES voluntario(id_vol), PRIMARY KEY (id_vol) ) ENGINE = InnoDB;

CREATE TABLE clases 
	(nombre_clase VARCHAR(64),
	UNIQUE (nombre_clase), PRIMARY KEY (nombre_clase) ) ENGINE = InnoDB;

CREATE TABLE estudiante
	(id_estudiante INT NOT NULL AUTO_INCREMENT, nombre_estudiante VARCHAR(100),
	direccion_estu VARCHAR(100), telefono_estu VARCHAR(20), sexo_estu CHAR(5),
	PRIMARY KEY (id_estudiante), UNIQUE(nombre_estudiante, direccion_estu, telefono_estu, sexo_estu) ) ENGINE = InnoDB;

CREATE TABLE trabajo ( id_rol INT, 
	id_vol INT, UNIQUE (id_rol, id_vol), 
	FOREIGN KEY (id_vol) REFERENCES notutor(id_vol),
	FOREIGN KEY (id_rol) REFERENCES roles(id_rol) ) ENGINE = InnoDB;

CREATE TABLE secciones
	(seccion_id INT NOT NULL AUTO_INCREMENT, nombre_clase VARCHAR(64) REFERENCES clases(nombre_clase), 
	seccion CHAR(3), semestre CHAR(3),
	horario VARCHAR(10), UNIQUE (nombre_clase, seccion, semestre), 
	PRIMARY KEY (seccion_id) ) ENGINE = InnoDB;

CREATE TABLE ofrece
	(ofrece_id INT NOT NULL AUTO_INCREMENT, id_vol INT, seccion_id INT, 
	UNIQUE (id_vol, seccion_id),
	PRIMARY KEY (ofrece_id),
	FOREIGN KEY (id_vol) REFERENCES tutor(id_vol),
	FOREIGN KEY (seccion_id) REFERENCES secciones (seccion_id) ) ENGINE = InnoDB;

CREATE TABLE matriculados
	(id_estudiante INT, ofrece_id INT,
	PRIMARY KEY (id_estudiante, ofrece_id),
	FOREIGN KEY (id_estudiante) REFERENCES estudiante(id_estudiante),
	FOREIGN KEY (ofrece_id) REFERENCES ofrece(ofrece_id) ) ENGINE = InnoDB;

CREATE TABLE credenciales 
	(username VARCHAR(100), password VARCHAR(100),
	PRIMARY KEY (username, password), UNIQUE (username) ) ENGINE = InnoDB;

INSERT INTO credenciales (username, password) VALUES
	('fifo@cauce.uprrp.edu', 'fifo123'),
	('alyssa@cauce.uprrp.edu', 'alyssa123');

INSERT INTO voluntario (nombre_vol, email, telefono_vol, direccion_vol, sexo_vol) VALUES
	('Fifo Copjiri', 'fifo@cauce.uprrp.edu', '787-555-5555', 'Apartamento #15, Calle West, Apartamentito Lindo', 'M'),
	('Mt. Fuji', 'fuji@cauce.uprrp.edu','787-407-3456', 'J-16, Calle 15, Japon', 'M'),
	('Alyssa', 'alyssa@cauce.uprrp.edu','787-123-8910', 'K-4, Calle CAUCE, Urb. Pan de Agua', 'F'),
	('Edwin', 'edwin@cauce.uprrp.edu', '787-145-1452', 'UPR Rio Piedras', 'M'),
	('Alberto Papel', 'algoritmos@cauce.uprrp.edu', '190-190-1900', 'Carolina', 'M');

INSERT INTO tutor (id_vol) VALUES
	(1),
	(5);

INSERT INTO notutor (id_vol) VALUES
	(2),
	(3),
	(4),
	(1);

INSERT INTO clases (nombre_clase) VALUES
	('Computadoras 101'),
	('Computadoras Avanzadas'),
	('Huerto');

INSERT INTO estudiante (nombre_estudiante, direccion_estu, telefono_estu, sexo_estu) VALUES
	('Dolores Miranda', 'CAUCE Rio Piedras', '939-123-0000', 'F'),
	('Alfredo Corleone', 'Godfather Rio Piedras', '000-000-0000', 'M'),
	('Edwin Ramos', 'El Refugio Rio Piedras', '787-123-4567', 'M');

INSERT INTO roles (nombre_rol) VALUES
	('Huerto'),
	('Lectura'),
	('Trabajador Social'),
	('Secretario'),
	('Tutor');

INSERT INTO trabajo (id_vol, id_rol) VALUES
	(1, 3),
	(2, 4),
	(4, 3),
	(3, 1);

INSERT INTO ofrece (id_vol, seccion_id) VALUES
	(1, 1),
	(1, 3),
	(5, 4);

INSERT INTO matriculados (id_estudiante, ofrece_id) VALUES
	(1, 1),
	(1, 2),
	(2, 1),
	(3, 2),
	(2, 2);

INSERT INTO secciones (nombre_clase, seccion, semestre, horario) VALUES
	('Computadoras 101', '001', 'B42', '10:00am'),
	('Computadoras 101', '002', 'B42', '10:00am'),
	('Computadoras Avanzadas', '001', 'B32', '1:00pm'),
	('Huerto', '001', 'B41', '9:00am');


#--------------------------------------------------------------------------
# Displaying Courses:

SELECT c.nombre_clase, s.seccion, s.horario, v.nombre_vol
	FROM clases c, voluntario v, tutor t, secciones s, ofrece o
	WHERE c.nombre_clase = s.nombre_clase AND s.seccion_id = o.seccion_id AND o.id_vol = t.id_vol
	AND t.id_vol = v.id_vol;

#--------------------------------------------------------------------------
# Displaying Voluntary Staff:
# Query 1: Displays all of the voluntary staff, and their roles.
SELECT voluntario.id_vol, voluntario.nombre_vol, roles.nombre_rol, voluntario.email, voluntario.direccion_vol, 
	voluntario.telefono_vol, voluntario.sexo_vol FROM voluntario, roles, trabajo, tutor, notutor
	WHERE voluntario.id_vol = trabajo.id_vol AND trabajo.id_rol = roles.id_rol
	AND voluntario.id_vol = tutor.id_vol AND voluntario.id_vol = notutor.id_vol;

# Query 2: Displays voluntary staff that aren't tutors, and their roles.

SELECT * FROM voluntario;

# Query 3: Displays voluntary staff that are tutors, and their courses.

#--------------------------------------------------------------------------
# Displaying Students:

SELECT * FROM estudiante;