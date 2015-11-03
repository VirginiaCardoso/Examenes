USE dcs_examenes;

#alumnos
INSERT INTO alumnos(lu_alu,apellido_alu,nom_alu) VALUES
	(89689,'Panzoni','Estefanía'),
	(90536,'Arró Ortiz','Carolina'),
	(90840,'Tracanna','Ezio'),
	(87250,'Caligaris','Marisel'),
	(90821,'Herold','Andrea'),
	(79115,'Reisvig','Mariela'),
	(89592,'Alessandroni','Gianfranco'),
	(92335,'Mosna','Catalina'),
	(94462,'Iriarte','Fermín'),
	(94589,'Pesticone','María Eugenia'),
	(94436,'Hartstock','Joaquín'),
	(82015,'Urban','Frederike');
INSERT INTO docentes(leg_doc,pass,apellido_doc,nom_doc, privilegio,activo) VALUES
	(12666,MD5('menna'),'Menna','Teresa',0,TRUE);

#Catedra: Obstetricia y ginecología
#INSERT INTO catedras(cod_cat,cod_carr,nom_cat) VALUES
#	(20063,155,'Obstetricia y ginecología'),	

INSERT INTO alumnos_catedras(lu_alu,cod_cat,estado_alu_cat) VALUES
	(89689,20063,1),
	(90536,20063,1),
	(90840,20063,1),
	(87250,20063,1),
	(90821,20063,1),
	(79115,20063,1),
	(89592,20063,1),
	(92335,20063,1),
	(94462,20063,1),
	(94589,20063,1),
	(94436,20063,1),
	(82015,20063,1);

INSERT INTO docentes_catedras(leg_doc,cod_cat,permiso_doc) VALUES
	(12666,20063,2);	