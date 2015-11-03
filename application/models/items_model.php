<?php

/**
 * Modelo items
 *
 *@package      models
 *@author       Fernando Andrés Prieto
 *@author       Diego Martín Schwindt
 *@author       Cardoso Virginia
 *@author       Marzullo Matias
 *@copyright    Octubre, 2015 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
*/

class Items_model extends CI_Model {

	
	public function __construct()
	{

	}
	

	/**
	 *	Crea el item c
	 *
	 * @access	public
	 * @param 	$nomb_item String nombre del item
	 * @param 	$solo_texto 
	 *
	 */

// INSERT INTO `dcs_examenes`.`items` (`id_item`, `nom_item`, `solo_texto`) VALUES (NULL, 'Saluda al paciente', '0');
	public function insert_item($nomb_item, $solo_texto)
	{

		// //Verifico que no exista una guía con el mismo nombre
		// $query_string = "SELECT tit_guia FROM guias
		// 		WHERE tit_guia = ? ";
		// $query = $this->db->query($query_string,array($tit_guia));
		// if($this->db->affected_rows() > 0) 
		// {
		// 	$exam = $query->row_array();	
		// 	throw new Exception(ERROR_REPETIDO);
		// }
		//Inserto info en la tabla guias
		$query_string = "INSERT INTO items(nom_item, solo_texto) VALUES (?,?);";

		$query = $this->db->query($query_string,array($nomb_item, $solo_texto));

		//controlo que se haya insertado nueva guia
		if($this->db->affected_rows() == 0)
		{
			throw new Exception(ERROR_NO_INSERT_EXAM); //cambiar error
		}
		$id_item = $this->db->insert_id();
		
		

		return $id_item;
	
	}

	public function insert_grupoitems($nomb_grupoitem,$nro_grupoitem){
		$query_string = "INSERT INTO grupositems(nom_grupoitem, nro_grupoitem) VALUES (?,?);";

		$query = $this->db->query($query_string,array($nomb_grupoitem, $nro_grupoitem));

		//controlo que se haya insertado nueva guia
		if($this->db->affected_rows() == 0)
		{
			throw new Exception(ERROR_NO_INSERT_EXAM); //cambiar error
		}
		$id_grupoitem = $this->db->insert_id();
		
		return $id_grupoitem;

	}
	

	
	
}

/* Fin del archivo items_model.php */
/* Location: ./application/models/items_model.php */
