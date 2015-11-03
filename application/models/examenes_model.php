<?php

/**
 * Modelo exámenes
 *
 *@package      models
 *@author       Fernando Andrés Prieto
 *@author       Diego Martín Schwindt
 *@copyright    Marzo, 2014 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
*/

class Examenes_model extends CI_Model {

	
	public function __construct()
	{

	}


	/**
	 *	Almacena en la Base de Datos un nuevo examen
	 *	Comprueba que se puedan insertar todos los items, y se pueda insertar un examen valido.
	 *	Si el alumno, guia, docente, o algun id item es invalido, no inserta nada y lanza una excepción
	 *	Si la cantidad de items es menor a la indicada en la guia, no inserta nada y lanza una excepción.
	 *
	 * @access	public
	 * @param 	$id_guia int id de la guia correspondiente
	 * @param 	$cod_cat int cod de la catedra correspondiente
	 * @param 	$lu_alu int lu del alumno que rindió
	 * @param 	$leg_doc int legajo del docente que evaluó
	 * @param 	$fecha timestamp fecha y hora del examen
	 * @param 	$calificacion int calificacion dada al examen (-1,0,1,2: usar constantes)
	 * @param 	$obs_exam string observación general del examen
	 * @param 	$items array arreglo de los items: (id,estado,obs)
	 * @param 	$porcentaje_exam float porcentaje de items hechos
	 * @return	array - datos del examen id_exam,id_guia,lu_alu....
	 *
	 */
	public function guardar_examen($id_guia,$cod_cat,$lu_alu,$leg_doc,$fecha,$calificacion,$obs_exam,$items,$porcentaje_exam)//$nota 
	{
		//Verifico que no exista un examen con misma guia, alumno, legajo y diferencia de fecha menor a 3 minutos
		$query_string = "SELECT id_exam,fecha FROM examenes
				WHERE id_guia = ? AND lu_alu = ? AND leg_doc = ? AND TIMESTAMPDIFF(MINUTE,fecha,?) < 3 AND TIMESTAMPDIFF(MINUTE,fecha,?) > -3";
		$query = $this->db->query($query_string,array($id_guia,$lu_alu,$leg_doc,$fecha,$fecha));
		if($this->db->affected_rows() > 0) 
		{
			$exam = $query->row_array();	
			throw new Exception(ERROR_REPETIDO,$exam['id_exam']);
		}
		//Verifico que estén todos los items
		$query_string = "SELECT id_item	FROM items NATURAL LEFT JOIN items_guias
			WHERE id_guia = ? ORDER BY id_item ASC";
		$query = $this->db->query($query_string,array($id_guia));
		$items_guia = $query->result_array();
		//recorro todos los items, y busco que este entre los id que recibo por param. Si alguno falta, corta lanzando excepcion
		foreach ($items_guia as $item_guia) {
			$esta = false;
			foreach ($items as $item) {
				if($item['id']==$item_guia['id_item']) {
					$esta = true;
					break;
				}
			}
			if(!$esta)
				throw new Exception(ERROR_FALTA_ITEM);
		}


		//Inserto info en la tabla examenes                                                                              ,nota_exam
		$query_string = "INSERT INTO examenes (id_guia,cod_cat,lu_alu,leg_doc,fecha,calificacion,obs_exam,porcentaje_exam)  
			 VALUES (?,?,?,?,?,?,?,?)";
		$this->db->query($query_string,array($id_guia,$cod_cat,$lu_alu,$leg_doc,$fecha,$calificacion,$obs_exam,$porcentaje_exam));//,$nota
		
		
		if($this->db->affected_rows() == 0)
		{
			throw new Exception(ERROR_NO_INSERT_EXAM);
		}
		$id_exam = $this->db->insert_id();
		
		//insert items: Transacción, deben ejecutarse todas.
		$this->db->trans_start();
		foreach ($items as $item)
		{
			if(isset($item['obs']))
			{
				$query_string = "INSERT INTO items_examenes(id_item,id_exam,estado_item,obs_item)
								VALUES (?,?,?,?)";
				$this->db->query($query_string,array($item['id'],$id_exam,$item['estado'],$item['obs']));
			}
			else 
			{
				$query_string = "INSERT INTO items_examenes(id_item,id_exam,estado_item)
								VALUES (?,?,?)";
				$this->db->query($query_string,array($item['id'],$id_exam,$item['estado']));
			}
		}
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
		{
		    $query_string = "DELETE FROM examenes WHERE id_exam = ?";
			$this->db->query($query_string,array($id_exam));
		    throw new Exception(ERROR_NO_INSERT_ITEMEXAM);
		}
		$query_string = "SELECT * FROM examenes
				WHERE id_exam = ?";
		$query = $this->db->query($query_string,array($id_exam));
		
		return $query->row_array();

	}


	/**
	 *	Obtiene el examen de id especificada. Devuelve datos completos de docente, alumno, catedra, guia.
	 *
	 * @access	public
	 * @param 	$id_exam int id del examen
	 * @return	array - datos del examen id_exam,id_guia,lu_alu....
	 *
	 */
	public function get_examen_id($id_exam)
	{
		$query_string = "SELECT id_exam,cod_carr,nom_carr,cod_cat,nom_cat,leg_doc,apellido_doc,nom_doc,
							lu_alu,apellido_alu,nom_alu,id_guia,nro_guia,tit_guia,subtit_guia,
							fecha,calificacion,porcentaje_exam,obs_exam 
							FROM examenes NATURAL LEFT JOIN guias NATURAL LEFT JOIN guias_catedras NATURAL LEFT JOIN catedras 
							NATURAL LEFT JOIN carreras NATURAL LEFT JOIN docentes NATURAL LEFT JOIN alumnos 
							WHERE id_exam = ?";
		$query = $this->db->query($query_string,array($id_exam));
		$exam = $query->row_array();
		
		return $exam;
	}

	/**
	 *	Retorna todos los items del examen, con su posicion en la guia
	 *
	 * @access	public
	 * @param 	$id_exam int id del exam
	 * @return	array de items - item: id,pos,nro_seccion,nombre_seccion,nro_grupoitem,nombre_grupoitem,nro_item,nombre_item,solo_texto,estado (examen), obs (examen)
	 *
	 */

	public function get_items($id_exam)
	{
		$query_string = "SELECT id_item,pos_item,pon_item, nro_sec,nom_sec,nro_grupoitem,nom_grupoitem,nro_item,nom_item,solo_texto,estado_item,obs_item 
			FROM items NATURAL LEFT JOIN items_examenes NATURAL LEFT JOIN examenes NATURAL LEFT JOIN guias 
			NATURAL LEFT JOIN items_guias NATURAL LEFT JOIN secciones NATURAL LEFT JOIN grupositems 
			WHERE id_exam = ? ORDER BY pos_item ASC";
		$query = $this->db->query($query_string,array($id_exam));
	
		return $query->result_array();
	}

	/**
	 *	Obtiene lista de examenes del docente especificado. Devuelve datos completos de docente, alumno, catedra, guia.
	 *
	 * @access	public
	 * @param 	$leg_doc int leg del docente
	 * @return	array de array - datos del examen id_exam,id_guia,lu_alu....
	 *
	 */

	public function get_examenes_docente($leg_doc)
	{
		$query_string = "SELECT id_exam,cod_carr,nom_carr,cod_cat,nom_cat,leg_doc,apellido_doc,nom_doc,
							lu_alu,apellido_alu,nom_alu,id_guia,nro_guia,tit_guia,subtit_guia,
							fecha,calificacion,porcentaje_exam,obs_exam 
							FROM examenes NATURAL LEFT JOIN guias NATURAL LEFT JOIN guias_catedras NATURAL LEFT JOIN catedras 
							NATURAL LEFT JOIN carreras NATURAL LEFT JOIN docentes NATURAL LEFT JOIN alumnos 
							WHERE leg_doc = ?";
		$query = $this->db->query($query_string,array($leg_doc));

		return $query->result_array();
	}





	
	
}

/* Fin del archivo examenes_model.php */
/* Location: ./application/models/examenes_model.php */