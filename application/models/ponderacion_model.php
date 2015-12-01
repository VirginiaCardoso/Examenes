<?php

/**
 * Modelo ponderacion
 *
 *@package      models
 *@author       Cardoso Virginia
 *@author       Marzullo Matias
 *@copyright    Octubre, 2015 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
*/

class Ponderacion_model extends CI_Model {

	
	public function __construct()
	{

	}
	
	/**
	 *	Retorna valores maximo y minimo de la ponderacion
	 *
	 * @access	public
	 * @param 	$nro Nro de ponderacion
	 * @return	array - dato de las guia
	 *
	 */

	public function get_max_min($nro)
	{
		$query_string = "SELECT texto_pond, max_valor, min_valor  FROM ponderacion 
				WHERE nro_pond = ?";
		$query = $this->db->query($query_string,$nro);
	
		return $query->row_array();
	}

	public function actualizar_pond($nro, $max, $min)
	{
		// UPDATE table_name
		// 	SET column_name = value
		// 	WHERE condition

		//Verifico que exista un alumno con el mismo legajo
		$query_string = " UPDATE ponderacion
	 		SET max_valor = ?, min_valor = ? 
		 	WHERE nro_pond = ?";
		$query = $this->db->query($query_string,array($max,$min,$nro));
		// if($this->db->affected_rows() == 0) 
		// {
		// 	$exam = $query->row_array();	
		// 	throw new Exception(ERROR_REPETIDO); //cambiar error
		// }
		
	}	

}

/* Fin del archivo ponderacion_model.php */
/* Location: ./application/model*/
