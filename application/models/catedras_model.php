<?php

/**
 * Modelo catedras
 *
 *@package      models
 *@author       Fernando Andrés Prieto
 *@author       Diego Martín Schwindt
 *@author       Virginia Cardoso
 *@author       Matías Marzullo
 *@copyright    Diciembre, 2015 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
*/

class Catedras_model extends CI_Model {

	
	// public function __construct()
	// {

	// }

	/**
	 *	Retorna todas las catedras de la carrera indicada 
	 *
	 * @access	public
	 * @param 	$cod_carrera int codigo de la carrera
	 * @return	array - todas las catedras de la carrera (codigo y nombre)
	 *
	 */

	public function get_catedras()
	{
		$query_string = "SELECT DISTINCT cod_cat, nom_cat, nom_carr, cod_carr
				FROM catedras NATURAL JOIN carreras ORDER BY cod_cat ASC";
		$query = $this->db->query($query_string);
	
		return $query->result_array();
	}
/**
	 *	Retorna todas las catedras del código indicado
	 *
	 * @access	public
	 * @param 	$cod_cat int codigo de la catedra
	 * @return	array - todas las catedras de la carrera (codigo y nombre)
	 *
	 */

	public function get_catedras_carrera($cod_carrera)
	{
		$query_string = "SELECT DISTINCT cod_cat,nom_cat FROM catedras
				WHERE cod_carr = ? ORDER BY cod_cat ASC";
		$query = $this->db->query($query_string,array($cod_carrera));
	
		return $query->result_array();
	}
	/**
	 *	Retorna todas las catedras de la carrera indicada 
	 *
	 * @access	public
	 * @param 	$cod_carrera int codigo de la carrera
	 * @return	array - todas las catedras de la carrera (codigo y nombre)
	 *
	 */

	public function get_catedra($cod_cat)
	{
		$query_string = "SELECT DISTINCT cod_cat,cod_carr,nom_cat FROM catedras
				WHERE cod_cat = ?";
		$query = $this->db->query($query_string,$cod_cat);
	
		return $query->row_array();
	}

	/**
	 *	Retorna la catedra de codigo y  de la carrera indicada 
	 *
	 * @access	public
	 * @param 	$cod_carr int codigo de la carrera
	 * @param 	$cod_cat int codigo de la catedra
	 * @return	array - catedra de la carrera (codigo y nombre)
	 *
	 */

	public function get_catedra_carrera($cod_cat,$cod_carr)
	{
		$query_string = "SELECT DISTINCT cod_cat,nom_cat FROM catedras
				WHERE cod_carr = ? AND cod_cat = ?";
		$query = $this->db->query($query_string,array($cod_carr,$cod_cat));
	
		return $query->row_array();
	}
	/**
	 *	Retorna todos los docentes asociados a la catedra indicada 
	 *
	 * @access	public
	 * @param 	$cod_catedra int codigo de la catedra
	 * @return	array - datos de los docentes asociados a la catedra
	 *
	 */
	public function get_docentes_catedra($cod_catedra)
	{
		$query_string = "SELECT DISTINCT leg_doc,apellido_doc,nom_doc,dni_doc
				FROM docentes NATURAL JOIN docentes_catedras 
				WHERE cod_cat = ? ORDER BY leg_doc ASC";
		$query = $this->db->query($query_string,array($cod_catedra));
	
		return $query->result_array();
	}

	public function get_docentes_not_catedra($cod_catedra){
		 
		$query_string = " SELECT leg_doc,apellido_doc,nom_doc,dni_doc FROM docentes WHERE NOT EXISTS( SELECT leg_doc FROM docentes_catedras WHERE ( docentes.leg_doc = docentes_catedras.leg_doc AND docentes_catedras.cod_cat = ?))";
		$query = $this->db->query($query_string,array($cod_catedra));
	
		return $query->result_array();
	}
	/**
	 *	Retorna el docente de lu indicado, verificando que este asociado a la catedra 
	 *
	 * @access	public
	 * @param 	$leg_doc int lu docente
	 * @param 	$cod_catedra int codigo de la catedra
	 * @return	array - datos de los docentes asociados a la catedra
	 *
	 */

	public function get_docente_catedra($leg_doc,$cod_catedra)
	{
		$query_string = "SELECT DISTINCT leg_doc,apellido_doc,nom_doc,dni_doc
				FROM docentes NATURAL JOIN docentes_catedras 
				WHERE leg_doc = ? AND cod_cat = ?";
		$query = $this->db->query($query_string,array($leg_doc,$cod_catedra));
	
		return $query->row_array();
	}
	/**
	 *	Retorna las catedras a las que está asociado el docente, de la carrera indicada.
	 *
	 * @access	public
	 * @param 	$legajo int legajo del docente
	 * @param 	$cod_carrera int codigo de la carrera
	 * @return	array - catedras asociadas al docente y la carrera (codigo y nombre)
	 *
	 */
	public function get_catedras_docente_carrera($legajo,$cod_carrera)
	{
		$query_string = "SELECT DISTINCT cod_cat,nom_cat
				FROM catedras NATURAL JOIN docentes_catedras 
				WHERE leg_doc = ? AND cod_carr = ? ORDER BY cod_cat ASC";
		$query = $this->db->query($query_string,array($legajo,$cod_carrera));
			
		return $query->result_array();
	}

	/**
	 *	Retorna las catedras a las que está asociado el docente con permiso total, de la carrera indicada.
	 *
	 * @access	public
	 * @param 	$legajo int legajo del docente
	 * @param 	$cod_carrera int codigo de la carrera
	 * @return	array - catedras asociadas al docente y la carrera (codigo y nombre)
	 *
	 */
	public function get_catedras_docente_carrera_permiso_modif($legajo,$cod_carrera)
	{
		$query_string = "SELECT DISTINCT cod_cat,nom_cat
				FROM catedras NATURAL JOIN docentes_catedras 
				WHERE leg_doc = ? AND cod_carr = ? AND permiso_doc = 2 ORDER BY cod_cat ASC";
		$query = $this->db->query($query_string,array($legajo,$cod_carrera));
			
		return $query->result_array();
	}

	/**
	 *	Retorna la catedra de codigo y  de la carrera indicada, verificando asociación al docente 
	 *
	 * @access	public
	 * @param 	$cod_carr int codigo de la carrera
	 * @param 	$cod_cat int codigo de la catedra
	 * @param 	$legajo int legajo del docente
	 * @return	array - catedra de la carrera (codigo y nombre)
	 *
	 */

	public function get_catedra_docente_carrera($cod_cat,$legajo,$cod_carr)
	{
		$query_string = "SELECT DISTINCT cod_cat,nom_cat
				FROM catedras NATURAL JOIN docentes_catedras 
				WHERE leg_doc = ? AND cod_carr = ? AND cod_cat = ?";
		$query = $this->db->query($query_string,array($legajo,$cod_carr,$cod_cat));
	
		return $query->row_array();
	}

	/**
	 *	Verifica que una catedra esté asociada al docente 
	 *
	 * @access	public
	 * @param 	$cod_cat int codigo de la catedra
	 * @param 	$legajo int legajo del docente
	 * @return	TRUE: docente asociado a catedra | FALSE: caso contrario.
	 *
	 */

	public function check_catedra_docente($cod_cat,$legajo)
	{
		$query_string = "SELECT * FROM docentes_catedras
				WHERE leg_doc = ? AND cod_cat = ?";
		$query = $this->db->query($query_string,array($legajo,$cod_cat));
	
		return $query->num_rows()>0;
	}

	/**
	 *	Verifica que una catedra esté asociada al docente con permiso mayor o igual al requerido
	 *
	 * @access	public
	 * @param 	$cod_cat int codigo de la catedra
	 * @param 	$legajo int legajo del docente
	 * @param   $permiso int permiso requerido
	 * @return	TRUE: docente asociado a catedra | FALSE: caso contrario.
	 *
	 */

	public function check_catedra_docente_permiso($cod_cat,$legajo,$permiso)
	{
		$query_string = "SELECT * FROM docentes_catedras
				WHERE leg_doc = ? AND cod_cat = ? AND permiso_doc >= ?";
		$query = $this->db->query($query_string,array($legajo,$cod_cat,$permiso));
	
		return $query->num_rows()>0;
	}
	/**
	 *	Vincula un docente con una cátedra
	 *
	 * @access	public
	 * @param 	$lu_alu int id del docente
	 * @param 	$cod_cat int id de la guia
	 *
	 */
	public function vincular_docente_catedra($leg_doc,$cod_cat)
	{

		//Verifico que no exista el docente en la catedra
		$query_string = "SELECT leg_doc FROM docentes_catedras
				WHERE leg_doc = ? AND cod_cat = ?";
		$query = $this->db->query($query_string,array($leg_doc,$cod_cat));
		if($this->db->affected_rows() > 0) 
		{
			$exam = $query->row_array();	
			throw new Exception(ERROR_REPETIDO);
		}	
		//Inserto info en la tabla items_guias
		$query_string = "INSERT INTO docentes_catedras(leg_doc,cod_cat) VALUES (?,?);";

		$this->db->query($query_string,array($leg_doc,$cod_cat));
	

	}

		/**
	 *	Elimina un docente de una cátedra.
	 *
	 * @access	public
	 * @param 	int $leg_doc
	 * 
	 *
	 */

	public function eliminar_docente_catedra($leg_doc,$cod_cat)
	{
		//Verifico que exista un docente con el mismo leg_doc
		$query_string = "SELECT leg_doc FROM docentes_catedras
				WHERE leg_doc = ? ";
		$query = $this->db->query($query_string,array($leg_doc));
		if($this->db->affected_rows() == 0) 
		{

			$exam = $query->row_array();	
			throw new Exception(ERROR_REPETIDO); //cambiar error
		}
		else{
			$query_string = "SELECT cod_cat FROM docentes_catedras
				WHERE cod_cat = ? ";
			$query = $this->db->query($query_string,array($cod_cat));
			if($this->db->affected_rows() > 0) 
			{	
				$query_string = "DELETE FROM docentes_catedras WHERE leg_doc = ?";
				$this->db->query($query_string,array($leg_doc));
			}

		}
	}

/**
	 *	Elimina una catedra.
	 *
	 * @access	public
	 * @param 	int $cod_cat
	 * 
	 *
	 */

	public function eliminar_catedra($cod_cat)
	{
		//Verifico que exista un docente con el mismo legajo
		// $query_string = "SELECT apellido_doc FROM catedras
		// 		WHERE leg_doc = ? ";
		// $query = $this->db->query($query_string,array($leg));
		// if($this->db->affected_rows() == 0) 
		// {

		// 	$exam = $query->row_array();	
		// 	throw new Exception(ERROR_REPETIDO); //cambiar error
		// }

			$query_string = "SELECT cod_cat FROM catedras
				 WHERE cod_cat = ? ";
			$query = $this->db->query($query_string,array($cod_cat));
			if($this->db->affected_rows() > 0) 
			{	
				$this->db->delete('guias_catedras', array('cod_cat' => $cod_cat)); 
				$this->db->delete('docentes_catedras', array('cod_cat' => $cod_cat)); 
				$this->db->delete('alumnos_catedras', array('cod_cat' => $cod_cat)); 
			}
			// if($this->db->affected_rows() > 0) 
			// {	
			// 	$query_string = "DELETE FROM docentes_catedras WHERE cod_cat = ?";
			// 	$this->db->query($query_string,array($cod_cat));
			// }
			// $query = $this->db->query($query_string,array($cod_cat));
			// if($this->db->affected_rows() > 0) 
			// {	
			// 	$query_string = "DELETE FROM alumnos_catedras WHERE cod_cat = ?";
			// 	$this->db->query($query_string,array($cod_cat));
			// }
			// $query = $this->db->query($query_string,array($cod_cat));
			

						$this->db->delete('catedras', array('cod_cat' => $cod_cat)); 

		// $query_string = "DELETE FROM catedras WHERE cod_cat = ?";
		// $this->db->query($query_string,array($cod_cat));
	}



	/**
	 *	Crea la guia con la catedra y título indicados
	 *
	 * @access	public
	 * @param 	$cod_cat int codigo de la catedra
	 * @param 	$cod_carr int codigo de la carrer
	 * @param 	$nom_cat VARCHAR nombre de la carrera
	 */
	 public function insertar_catedra($cod_cat, $nombre_cat, $cod_carr)
	{

		//Verifico que no exista una catedra con el mismo código
		$query_string = "SELECT nom_cat FROM catedras
				WHERE cod_cat = ? ";
		$query = $this->db->query($query_string,array($cod_cat));
		if($this->db->affected_rows() > 0) 
		{
			$exam = $query->row_array();	
			throw new Exception(ERROR_REPETIDO);
		}

		//Inserto info en la tabla guias
		$query_string = "INSERT INTO catedras(cod_cat, cod_carr, nom_cat) VALUES (?,?,?);";

		$query = $this->db->query($query_string,array($cod_cat, $cod_carr, $nombre_cat));

		//controlo que se haya insertado nueva guia
		if($this->db->affected_rows() == 0)
		{
			throw new Exception(ERROR_NO_INSERT_EXAM); //cambiar error
		}
		
			
	}

		/**
	 *	Actualiza una catedra.
	 *
	 * @access	public
	 * @param 	int $cod_cat, int cod_carr, varchar $nom_cat
	 * 
	 *
	 */

	public function actualizar_catedra($cod_cat, $nom_cat, $cod_carr)
	{

		//Verifico que exista un docente con el mismo legajo
		$query_string = " UPDATE catedras
	 		SET cod_carr = ?, nom_cat = ?
		 	WHERE cod_cat = ?";
		$query = $this->db->query($query_string,array($cod_carr,$nom_cat,$cod_cat));
		// if($this->db->affected_rows() == 0) 
		// {
		// 	$exam = $query->row_array();	
		// 	throw new Exception(ERROR_REPETIDO); //cambiar error
		// }
		
	}
	
}

/* Fin del archivo catedras_model.php */
/* Location: ./application/models/catedras_model.php */