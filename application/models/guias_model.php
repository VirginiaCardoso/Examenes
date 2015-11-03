<?php

/**
 * Modelo guias
 *
 *@package      models
 *@author       Fernando Andrés Prieto
 *@author       Diego Martín Schwindt
 *@author       Cardoso Virginia
 *@author       Marzullo Matias
 *@copyright    Marzo, 2014 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
*/

class Guias_model extends CI_Model {

	
	public function __construct()
	{

	}

	/**
	 *	Retorna todas las guias
	 *
	 * @access	public
	 * @param 	$cod_catedra int codigo de la catedra
	 * @return	array - datos de las guias
	 *
	 */

	public function get_guias()
	{
		$query_string = "SELECT DISTINCT id_guia,cod_carr,tit_guia,cod_cat,nom_cat FROM guias NATURAL JOIN guias_catedras NATURAL JOIN catedras
				ORDER BY nro_guia ASC";
	
		$query = $this->db->query($query_string);
		return $query->result_array();
	}
	/**
	 *	Retorna todas las guias de la catedra indicada 
	 *
	 * @access	public
	 * @param 	$cod_catedra int codigo de la catedra
	 * @return	array - datos de las guias
	 *
	 */

	public function get_guias_catedra($cod_catedra)
	{
		$query_string = "SELECT DISTINCT id_guia,nro_guia,tit_guia,subtit_guia FROM guias NATURAL JOIN guias_catedras
				WHERE cod_cat = ? ORDER BY nro_guia ASC";
		$query = $this->db->query($query_string,array($cod_catedra));
	
		return $query->result_array();
	}

	/**
	 *	Retorna la guia de la catedra e id indicados
	 *
	 * @access	public
	 * @param 	$cod_cat int codigo de la catedra
	 * @param 	$id_guia int id de la guia
	 * @return	array - dato de las guia
	 *
	 */

	public function get_guia_catedra($id_guia,$cod_cat)
	{
		$query_string = "SELECT DISTINCT id_guia,nro_guia,tit_guia,subtit_guia FROM guias NATURAL JOIN guias_catedras
				WHERE cod_cat = ? AND id_guia = ?";
		$query = $this->db->query($query_string,array($cod_cat,$id_guia));
	
		return $query->row_array();
	}
	/**
	 *	Elimina un alumno.
	 *
	 * @access	public
	 * @param 	int $lu_alu
	 * 
	 *
	 */

	public function eliminar_guia($id_guia)
	{
		//Verifico que exista un guia con el mismo id_guia
		$query_string = "SELECT id_guia FROM guias
				WHERE id_guia = ? ";
		$query = $this->db->query($query_string,array($id_guia));
		if($this->db->affected_rows() == 0) 
		{

			$exam = $query->row_array();	
			throw new Exception(ERROR_REPETIDO); //cambiar error
		}
		else{
			$query_string = "SELECT cod_cat FROM guias_catedras
				WHERE id_guia = ? ";
			$query = $this->db->query($query_string,array($id_guia));
			if($this->db->affected_rows() > 0) 
			{	
				$query_string = "SELECT id_item FROM items_guias
				WHERE id_guia = ? ";
				$query = $this->db->query($query_string,array($id_guia));
			    if($this->db->affected_rows() > 0)
			    {
			    	$query_string = "DELETE FROM items_guias WHERE id_guia = ?";
					$this->db->query($query_string,array($id_guia));
			    }
				$query_string = "DELETE FROM guias_catedras WHERE id_guia = ?";
				$this->db->query($query_string,array($id_guia));
			}

		}
		$query_string = "DELETE FROM guias WHERE id_guia = ?";
		$this->db->query($query_string,array($id_guia));
	}

	/**
	 *	Crea la guia con la catedra y título indicados
	 *
	 * @access	public
	 * @param 	$cod_cat int codigo de la catedra
	 * @param 	$tit_guia dato titulo de la guia
	 *
	 */

	public function insert_guia_catedra($cod_cat, $nro_guia, $tit_guia)
	{

		//Verifico que no exista una guía con el mismo nombre
		$query_string = "SELECT tit_guia FROM guias
				WHERE tit_guia = ? ";
		$query = $this->db->query($query_string,array($tit_guia));
		if($this->db->affected_rows() > 0) 
		{
			$exam = $query->row_array();	
			throw new Exception(ERROR_REPETIDO);
		}
		//Inserto info en la tabla guias
		$query_string = "INSERT INTO guias(tit_guia) VALUES (?);";

		$query = $this->db->query($query_string,array($tit_guia));

		//controlo que se haya insertado nueva guia
		if($this->db->affected_rows() == 0)
		{
			throw new Exception(ERROR_NO_INSERT_EXAM); //cambiar error
		}
		$id_guia = $this->db->insert_id();
		
		//Inserto info en la tabla guias_catedras
		$query_string = "INSERT INTO guias_catedras(id_guia, cod_cat, nro_guia) VALUES (LAST_INSERT_ID(),?,?);";

		$this->db->query($query_string,array($cod_cat, $nro_guia));
		//controlo que se haya insertado nueva relacion guia-catedra
		if($this->db->affected_rows() == 0)
		{
			throw new Exception(ERROR_NO_INSERT_EXAM); //cambiar error
		}

		return $id_guia;
	
	}
	

	/**
	 *	Relaciona un item con una guía
	 *
	 * @access	public
	 * @param 	$nom_item dato nombre del item
	 * @param 	$id_guia int id de la guia
	 *
	 */

	public function set_item_guia($nom_item, $id_guia)
	{

		//Verifico que no exista un item con el mismo nombre
		$query_string = "SELECT nom_item FROM items
				WHERE nom_item = ? ";
		$query = $this->db->query($query_string,array($nom_item));
		if($this->db->affected_rows() > 0) 
		{
			$exam = $query->row_array();	
			throw new Exception(ERROR_REPETIDO);
		}
		//Inserto info en la tabla items
		$query_string = "INSERT INTO items(nom_item) VALUES (?);";

		$query = $this->db->query($query_string,array($nom_item));
		
		//Inserto info en la tabla items_guias
		$query_string = "INSERT INTO items_guias(id_item, id_guia) VALUES (LAST_INSERT_ID(),?);";

		$this->db->query($query_string,array($id_guia));
	

	}

	/**
	 *	Vincula un item con una guía
	 *
	 * @access	public
	 * @param 	$id_item int id del item
	 * @param 	$id_guia int id de la guia
	 *
	 */	
																		//$pon_item,
	public function vincular_item_guia($id_item, $id_guia,$pos_item,$pon_item,$nro_item,$id_grupoitem)
	{

		//Verifico que no exista el item en la guía
		// $query_string = "SELECT id_item FROM items_guia
		// 		WHERE id_item = ? 
		// 		WHERE id_guia = ?";
		// $query = $this->db->query($query_string,array($id_item,$id_guia));
		// if($this->db->affected_rows() > 0) 
		// {
		// 	$exam = $query->row_array();	
		// 	throw new Exception(ERROR_REPETIDO);
		// }	
		//Inserto info en la tabla items_guias                           pon_item,
		$query_string = "INSERT INTO items_guias(id_item, id_guia,pos_item,pon_item,nro_item,id_grupoitem) VALUES (?,?,?,?,?,?);";

		$this->db->query($query_string,array($id_item,$id_guia,$pos_item,$pon_item,$nro_item,$id_grupoitem)); //$pon_item,
	

	}


	/**
	 *	Verifica que la guia este asociada a la catedra
	 *
	 * @access	public
	 * @param 	$cod_cat int codigo de la catedra
	 * @param 	$id_guia int id de la guia
	 * @return	array - dato de las guia
	 *
	 */

	public function check_guia_catedra($id_guia,$cod_cat)
	{
		$query_string = "SELECT * FROM guias_catedras
				WHERE cod_cat = ? AND id_guia = ?";
		$query = $this->db->query($query_string,array($cod_cat,$id_guia));
	
		return $query->num_rows()>0;
	}

	/**
	 *	Retorna todos los items de la guia
	 *
	 * @access	public
	 * @param 	$id_guia int id de la guia
	 * @return	array de items - item: id,pos,nro_seccion,nombre_seccion,nro_grupoitem,nombre_grupoitem,nro_item,nombre_item,solo_texto
	 *
	 */

	public function get_items($id_guia)
	{									//pon_item,
		$query_string = "SELECT id_item,pos_item,pon_item,nro_sec,nom_sec,nro_grupoitem,nom_grupoitem,nro_item,nom_item,solo_texto 
			FROM items NATURAL LEFT JOIN items_guias NATURAL LEFT JOIN secciones NATURAL LEFT JOIN grupositems 
			WHERE id_guia = ? ORDER BY pos_item ASC";
		$query = $this->db->query($query_string,array($id_guia));
	
		return $query->result_array();
	}

	/**
	 *	Retorna las descripciones de la guia
	 *
	 * @access	public
	 * @param 	$id_guia int id de la guia
	 * @return	array de descripciones - desc: nom_desc,contenido_desc
	 *
	 */

	public function get_descripciones($id_guia)
	{
		$query_string = "SELECT nom_desc,contenido_desc
			FROM descripciones
			WHERE id_guia = ?";
		$query = $this->db->query($query_string,array($id_guia));
	
		return $query->result_array();
	}

	/**
	 *	Retorna las lista de itemes del estudiante
	 *
	 * @access	public
	 * @param 	$id_guia int id de la guia
	 * @return	array de items_estudiante - item_estudiante: nro_item,nom_itemest
	 *
	 */

	public function get_itemsestudiante($id_guia)
	{
		$query_string = "SELECT nro_item,nom_itemest
			FROM itemsestudiante NATURAL JOIN itemsestudiante_guias NATURAL JOIN guias 
			WHERE id_guia = ? ORDER BY nro_item ASC";
		$query = $this->db->query($query_string,array($id_guia));
	
		return $query->result_array();
	}

	/**
	 *	Retorna las lista de items
	 *
	 * @access	public
	 * @return	array de items:  id_item,nom_item
	 *
	 */

	public function get_items_2()
	{
		$query_string = "SELECT id_item,nom_item FROM items ORDER BY id_item ASC";
		$query = $this->db->query($query_string);
		
		return $query->result_array(); 
		
	}

	/**
	 *	Retorna las lista de items ordenados por nombre de item
	 *
	 * @access	public
	 * @return	array de items:  id_item,nom_item
	 *
	 */

	public function get_items_3()
	{
		$query_string = "SELECT id_item,nom_item FROM items ORDER BY nom_item";
		$query = $this->db->query($query_string);
		
		return $query->result_array(); 
		
	}

	/**
	 *	Retorna las lista de grupositems
	 *
	 * @access	public
	 * @return	array de grupoitems:  id_grupoitem,nom_grupoitem
	 *
	 */

	public function get_grupositems()
	{
		$query_string = "SELECT DISTINCT nom_grupoitem FROM grupositems ORDER BY nom_grupoitem ASC";
		$query = $this->db->query($query_string);
		
		return $query->result_array(); 
		
	}

	
	
}

/* Fin del archivo guias_model.php */
/* Location: ./application/models/guias_model.php */