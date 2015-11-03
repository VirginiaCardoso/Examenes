<?php

/**
 * Modelo carreras
 *
 *@package      models
 *@author       Fernando Andrés Prieto
 *@author       Diego Martín Schwindt
 *@copyright    Marzo, 2014 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
*/

class Carreras_model extends CI_Model {

	
	public function __construct()
	{

	}


	/**
	 *	Retorna la carrera con codigoo indicado
	 *
	 * @access	public
	 * @return	array carrera (codigo y nombre)
	 *
	 */

	public function get_carrera($cod_carr)
	{
		$query_string = "SELECT cod_carr,nom_carr FROM carreras WHERE cod_carr = ?";
		$query = $this->db->query($query_string,array($cod_carr));
		
		return $query->row_array();
	}

	/**
	 *	Retorna la carrera con codigoo indicado, verificando que el docente esta asociado
	 *
	 * @access	public
	 * @param 	$legajo int legajo del docente
	 * @param 	$cod_carr int codigo de la carrera
	 * @return	array - carreras asociada al docente (codigo y nombre)
	 *
	 */

	public function get_carrera_docente($cod_carr,$legajo)
	{
		$query_string = "SELECT DISTINCT cod_carr,nom_carr
			FROM carreras NATURAL JOIN catedras NATURAL JOIN docentes_catedras 
			WHERE leg_doc = ? AND cod_carr = ?";
		$query = $this->db->query($query_string,array($legajo,$cod_carr));
			
		return $query->row_array();
	}


	/**
	 *	Retorna todas las carreras
	 *
	 * @access	public
	 * @return	array - carreras (codigo y nombre)
	 *
	 */

	public function get_carreras()
	{
		$query_string = "SELECT cod_carr,nom_carr FROM carreras ORDER BY cod_carr ASC";
		$query = $this->db->query($query_string);
		
		return $query->result_array();
	}

	/**
	 *	Retorna las carreras a las que está asociado el docente. 
	 *
	 * @access	public
	 * @param 	$legajo int legajo del docente
	 * @return	array - carreras asociadas al docente (codigo y nombre)
	 *
	 */

	public function get_carreras_docente($legajo)
	{
		$query_string = "SELECT DISTINCT cod_carr,nom_carr
			FROM carreras NATURAL JOIN catedras NATURAL JOIN docentes_catedras 
			WHERE leg_doc = ? ORDER BY cod_carr ASC";
		$query = $this->db->query($query_string,array($legajo));
			
		return $query->result_array();
	}

	
}

/* Fin del archivo carreras_model.php */
/* Location: ./application/models/carreras_model.php */