#-------------------------------------------------------------------------------------------
#---------- Archivo batch (database.sql) para la creación de la Base de datos  -------------
#-------------------------------------------------------------------------------------------

# Creamos Base de Datos
CREATE DATABASE IF NOT EXISTS dcs_examenes;

# selecciono la base de datos sobre la cual voy a hacer modificaciones
USE dcs_examenes;

#-------------------------------------------------------------------------------------------
#------------------------------- Creación tablas -------------------------------------------
#-------------------------------------------------------------------------------------------

CREATE TABLE IF NOT EXISTS estudiantes (
	# id_alu INT UNSIGNED NOT NULL AUTO_INCREMENT,
	lu_alu INT UNSIGNED NOT NULL UNIQUE,
	apellido_alu VARCHAR(50) NOT NULL,
	nom_alu VARCHAR(50) NOT NULL,
	dni_alu INT UNIQUE,

	CONSTRAINT pk_estudiantes PRIMARY KEY(lu_alu)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS docentes (  # Usuarios del sistema
#	id_doc INT UNSIGNED NOT NULL AUTO_INCREMENT,
	leg_doc INT UNSIGNED NOT NULL UNIQUE,
	pass VARCHAR(60) NOT NULL,
	apellido_doc VARCHAR(50) NOT NULL,
	nom_doc VARCHAR(50) NOT NULL,
	dni_doc INT UNIQUE,
	email_doc VARCHAR(60),
	tel_doc VARCHAR(20),
	activo BOOLEAN NOT NULL DEFAULT FALSE,
	privilegio INT NOT NULL DEFAULT 0,

	CONSTRAINT pk_docente PRIMARY KEY(leg_doc)

) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS carreras (
#	id_carr INT UNSIGNED NOT NULL AUTO_INCREMENT,
	cod_carr INT UNSIGNED NOT NULL UNIQUE,
	nom_carr VARCHAR(40) NOT NULL,

	CONSTRAINT pk_carreras PRIMARY KEY(cod_carr)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS catedras (
#	id_cat INT UNSIGNED NOT NULL AUTO_INCREMENT,
	cod_cat INT UNSIGNED NOT NULL UNIQUE,
	cod_carr INT UNSIGNED NOT NULL,
	nom_cat VARCHAR(80) NOT NULL,

	CONSTRAINT pk_catedras PRIMARY KEY(cod_cat),
	CONSTRAINT fk_cod_carr FOREIGN KEY (cod_carr) REFERENCES carreras (cod_carr)
	ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS estudiantes_catedras (
#	id_alu_cat INT UNSIGNED NOT NULL AUTO_INCREMENT,
	lu_alu INT UNSIGNED NOT NULL,
	cod_cat INT UNSIGNED NOT NULL,
	estado_alu_cat INT NOT NULL DEFAULT 0,
	periodo_alu_cat INT NOT NULL,

	CONSTRAINT pk_alu_cat PRIMARY KEY (lu_alu,cod_cat),
	CONSTRAINT fk_lu_alu FOREIGN KEY (lu_alu) REFERENCES estudiantes(lu_alu),
	FOREIGN KEY (cod_cat) REFERENCES catedras(cod_cat)
) ENGINE=InnoDB; 

CREATE TABLE IF NOT EXISTS docentes_catedras (
#	id_doc_cat INT UNSIGNED NOT NULL AUTO_INCREMENT,
	leg_doc INT UNSIGNED NOT NULL,
	cod_cat INT UNSIGNED NOT NULL,
	permiso_doc INT NOT NULL DEFAULT 0,

	CONSTRAINT pk_docentes_catedras PRIMARY KEY (leg_doc,cod_cat),
	CONSTRAINT fk_leg_doc FOREIGN KEY (leg_doc) REFERENCES docentes(leg_doc),
	CONSTRAINT fk_cod_cat FOREIGN KEY (cod_cat) REFERENCES catedras(cod_cat)
) ENGINE=InnoDB; 


CREATE TABLE IF NOT EXISTS guias (
	id_guia INT UNSIGNED NOT NULL AUTO_INCREMENT,
	tit_guia VARCHAR(100) NOT NULL,
	subtit_guia VARCHAR(160),

	CONSTRAINT pk_guias PRIMARY KEY(id_guia)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS guias_catedras (
	id_guia INT UNSIGNED NOT NULL,
	cod_cat INT UNSIGNED NOT NULL,  
	nro_guia INT UNSIGNED NOT NULL,

	PRIMARY KEY (id_guia,cod_cat),
	FOREIGN KEY (id_guia) REFERENCES guias(id_guia),
	FOREIGN KEY (cod_cat) REFERENCES catedras(cod_cat)
) ENGINE=InnoDB; 

CREATE TABLE IF NOT EXISTS descripciones (
	id_desc INT UNSIGNED NOT NULL AUTO_INCREMENT,
	id_guia INT UNSIGNED NOT NULL,
	nom_desc VARCHAR(50), # Titulo descripcion
	contenido_desc TEXT, # Texto descripcion

	CONSTRAINT pk_descripciones PRIMARY KEY(id_desc),
	CONSTRAINT fk_id_guia FOREIGN KEY (id_guia) REFERENCES guias (id_guia)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS items (
	id_item INT UNSIGNED NOT NULL AUTO_INCREMENT,
	nom_item VARCHAR(255) NOT NULL, # nombre pauta
	solo_texto BOOLEAN NOT NULL DEFAULT FALSE,
		
	CONSTRAINT pk_items PRIMARY KEY(id_item)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS secciones (
	id_sec INT UNSIGNED NOT NULL AUTO_INCREMENT,
	nom_sec VARCHAR(100), # Titulo seccion
	nro_sec INT UNSIGNED, 	#pos de la secc en la guia

	CONSTRAINT pk_secciones PRIMARY KEY(id_sec)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS grupositems (
	id_grupoitem INT UNSIGNED NOT NULL AUTO_INCREMENT,
	nom_grupoitem VARCHAR(255), # Titulo grupo
	nro_grupoitem INT UNSIGNED, #pos del grupo en la guia
		
	CONSTRAINT pk_grupositems PRIMARY KEY(id_grupoitem)
) ENGINE=InnoDB;


CREATE TABLE IF NOT EXISTS items_guias (
	#	id_item_guia INT UNSIGNED NOT NULL AUTO_INCREMENT,
	id_item INT UNSIGNED NOT NULL,
	id_guia INT UNSIGNED NOT NULL,
	pos_item INT UNSIGNED NOT NULL, #pos general del item en la guia (si la guia no tiene secciones ni grupos, pos_item y nro_item son iguales)
	nro_item INT UNSIGNED NOT NULL, #pos del item en su "contenedor": guia, seccion o grupoitem
	id_grupoitem INT UNSIGNED,
	id_sec INT UNSIGNED,

	PRIMARY KEY(id_item,id_guia),
	FOREIGN KEY (id_guia) REFERENCES guias (id_guia),
	FOREIGN KEY (id_item) REFERENCES items (id_item),
	FOREIGN KEY (id_grupoitem) REFERENCES grupositems (id_grupoitem),
	FOREIGN KEY (id_sec) REFERENCES secciones (id_sec)

)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS itemsestudiante (
	id_itemest INT UNSIGNED NOT NULL AUTO_INCREMENT,
	nom_itemest VARCHAR(255) NOT NULL, # nombre pauta
		
	CONSTRAINT pk_itemsestudiantes PRIMARY KEY(id_itemest)
	
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS itemsestudiante_guias (
#	id_itemest_guia INT UNSIGNED NOT NULL AUTO_INCREMENT,
	id_itemest INT UNSIGNED NOT NULL,
	id_guia INT UNSIGNED NOT NULL,
	nro_item INT UNSIGNED NOT NULL,

	PRIMARY KEY(id_itemest,id_guia),
	FOREIGN KEY (id_guia) REFERENCES guias (id_guia),
	FOREIGN KEY (id_itemest) REFERENCES itemsestudiante (id_itemest)

)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS examenes (
	id_exam INT UNSIGNED NOT NULL AUTO_INCREMENT,
	id_guia INT UNSIGNED NOT NULL,
	cod_cat INT UNSIGNED NOT NULL, 
	lu_alu INT UNSIGNED NOT NULL, 
	leg_doc INT UNSIGNED NOT NULL,
	fecha TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	calificacion INT NOT NULL DEFAULT -1,
	obs_exam TEXT,
	porcentaje_exam FLOAT,

	PRIMARY KEY(id_exam),
	FOREIGN KEY (id_guia) REFERENCES guias (id_guia),
	FOREIGN KEY (cod_cat) REFERENCES catedras(cod_cat),
	FOREIGN KEY (lu_alu) REFERENCES estudiantes (lu_alu),
	FOREIGN KEY (leg_doc) REFERENCES docentes (leg_doc)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS items_examenes (
#	id_item_exam INT UNSIGNED NOT NULL AUTO_INCREMENT,
	id_item INT UNSIGNED NOT NULL,
	id_exam INT UNSIGNED NOT NULL,
	estado_item INT NOT NULL DEFAULT -1, #-1: sin responder, 0: NO, 1: SI
	obs_item TEXT,  # observacion

	CONSTRAINT pk_items_examenes PRIMARY KEY(id_item,id_exam),
	FOREIGN KEY (id_exam) REFERENCES examenes (id_exam),
	FOREIGN KEY (id_item) REFERENCES items (id_item)

)ENGINE=InnoDB;


CREATE TABLE IF NOT EXISTS  `ci_sessions` (
	session_id varchar(40) DEFAULT '0' NOT NULL,
	ip_address varchar(45) DEFAULT '0' NOT NULL,
	user_agent varchar(250) NOT NULL,
	last_activity int(10) unsigned DEFAULT 0 NOT NULL,
	user_data text NOT NULL,

	CONSTRAINT pk_ci_sessions PRIMARY KEY (session_id),
	KEY `last_activity_idx` (`last_activity`)
);


-- #---------------------------------------------------------
-- # Creacion usuario dcs_lab. Password:
-- # 
-- CREATE USER dcs_lab IDENTIFIED BY 'dcic2015..';

-- GRANT ALL PRIVILEGES ON dcs_examenes.* TO dcs_lab IDENTIFIED BY 'dcic2015..';
