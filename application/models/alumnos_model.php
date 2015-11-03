<?php

/**
 * Modelo alumnos
 *
 *@package      models
 *@author       Fernando Andrés Prieto
 *@author       Diego Martín Schwindt
 *@author 		Cardoso Virginia
 *@author 		Marzullo, Matias
 *@COPYRIGHT	Septiembre, 2015 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
*/

class Alumnos_model extends CI_Model {

	
	public function __construct()
	{

	}


	 function Alumnos_model() {
	 parent::__construct(); //llamada al constructor de Model.
	 }


	// function getData() 
	// {	
 // 		$alumnos = $this->db->get('alumnos'); //obtenemos la tabla 'alumnos'. db->get('nombre_tabla') equivale a SELECT * FROM nombre_tabla.
 
	//  return $alumnos->result(); //devolvemos el resultado de lanzar la query.
	//  }



	public function guardar_alumno($lu_alu, $apellido_alu,$nom_alu,$dni_alu)
	{
		//Verifico que no exista un alumno con el mismo legajo
		$query_string = "SELECT apellido_alu FROM alumnos
				WHERE lu_alu = ? ";
		$query = $this->db->query($query_string,array($lu_alu));
		if($this->db->affected_rows() > 0) 
		{
			$exam = $query->row_array();	
			throw new Exception(ERROR_REPETIDO);
		}
		//Inserto info en la tabla alumno
		$query_string = "INSERT INTO alumnos (lu_alu,apellido_alu,nom_alu,dni_alu) 
			 VALUES (?,?,?,?)";
		$this->db->query($query_string,array($lu_alu, $apellido_alu,$nom_alu,$dni_alu));
		
		
		if($this->db->affected_rows() == 0)
		{
			throw new Exception(ERROR_NO_INSERT_EXAM);
		}
		//$id_exam = $this->db->insert_id();
	}
	/**
	 *	Elimina un alumno.
	 *
	 * @access	public
	 * @param 	int $lu_alu
	 * 
	 *
	 */

	public function eliminar_alumno($lu_alu)
	{
		//Verifico que exista un alumno con el mismo lu_alu
		$query_string = "SELECT lu_alu FROM alumnos
				WHERE lu_alu = ? ";
		$query = $this->db->query($query_string,array($lu_alu));
		if($this->db->affected_rows() == 0) 
		{

			$exam = $query->row_array();	
			throw new Exception(ERROR_REPETIDO); //cambiar error
		}
		else{
			$query_string = "SELECT cod_cat FROM alumnos_catedras
				WHERE lu_alu = ? ";
			$query = $this->db->query($query_string,array($lu_alu));
			if($this->db->affected_rows() > 0) 
			{	
				$query_string = "DELETE FROM alumnos_catedras WHERE lu_alu = ?";
				$this->db->query($query_string,array($lu_alu));
			}

		}
		$query_string = "DELETE FROM alumnos WHERE lu_alu = ?";
		$this->db->query($query_string,array($lu_alu));
	}

	/**
	 *	Obtiene lista de alumnos.
	 *
	 * @access	public
	 * @param 	
	 * @return	array de array - datos de los alumnos
	 *
	 */

	public function get_alumnos()
	{

		$query_string = "SELECT lu_alu,apellido_alu,nom_alu,dni_alu 
							FROM alumnos ";
		$query = $this->db->query($query_string);
		return $query->result_array();
	}


	/**
	 *	Retorna todos los alumnos asociados a la catedra indicada 
	 *
	 * @access	public
	 * @param 	$cod_catedra int codigo de la catedra
	 * @return	array - datos de los alumnos asociados a la catedra
	 *
	 */
	public function get_alumnos_catedra($cod_catedra)
	{
		$query_string = "SELECT DISTINCT lu_alu,apellido_alu,nom_alu,dni_alu,year_alu_cat,periodo_alu_cat
				FROM alumnos NATURAL JOIN alumnos_catedras 
				WHERE cod_cat = ? ORDER BY lu_alu ASC";
		$query = $this->db->query($query_string,array($cod_catedra));
	
		return $query->result_array();
	}

	public function get_alumnos_not_catedra($cod_catedra){
		 
		$query_string = " SELECT lu_alu,apellido_alu,nom_alu,dni_alu FROM alumnos WHERE NOT EXISTS( SELECT lu_alu FROM alumnos_catedras WHERE ( alumnos.lu_alu = alumnos_catedras.lu_alu AND alumnos_catedras.cod_cat = ?))";
		$query = $this->db->query($query_string,array($cod_catedra));
	
		return $query->result_array();
	}

	/**
	 *	Retorna el alumno de lu indicado, verificando que este asociado a la catedra 
	 *
	 * @access	public
	 * @param 	$lu_alu int lu alumno
	 * @param 	$cod_catedra int codigo de la catedra
	 * @return	array - datos de los alumnos asociados a la catedra
	 *
	 */

	public function get_alumno_catedra($lu_alu,$cod_catedra)
	{
		$query_string = "SELECT DISTINCT lu_alu,apellido_alu,nom_alu,dni_alu
				FROM alumnos NATURAL JOIN alumnos_catedras 
				WHERE lu_alu = ? AND cod_cat = ?";
		$query = $this->db->query($query_string,array($lu_alu,$cod_catedra));
	
		return $query->row_array();
	}

	/**
	 *	Verificando que el alumno este asociado a la catedra 
	 *
	 * @access	public
	 * @param 	$lu_alu int lu alumno
	 * @param 	$cod_catedra int codigo de la catedra
	 * @return	TRUE: alumno asociado a catedra | FALSE: caso contrario.
	 *
	 */

	public function check_alumno_catedra($lu_alu,$cod_catedra)
	{
		$query_string = "SELECT * FROM alumnos_catedras
				WHERE lu_alu = ? AND cod_cat = ?";
		$query = $this->db->query($query_string,array($lu_alu,$cod_catedra));
	
		return $query->num_rows()>0;
	}

	/**
	 *	Vincula un alumno con una cátedra
	 *
	 * @access	public
	 * @param 	$lu_alu int id del alumno
	 * @param 	$cod_cat int id de la guia
	 *
	 */
	public function vincular_alumno_catedra($lu_alu, $anio_alu_cat, $per_alu_cat, $cod_cat)//($id_item, $id_guia)
	{

		//Verifico que no exista el alumno en la catedra
		$query_string = "SELECT lu_alu FROM alumnos_catedras
				WHERE lu_alu = ? AND cod_cat = ? AND year_alu_cat = ? AND periodo_alu_cat = ?";
		$query = $this->db->query($query_string,array($lu_alu,$cod_cat,$anio_alu_cat, $per_alu_cat));
		if($this->db->affected_rows() > 0) 
		{
			$exam = $query->row_array();	
			throw new Exception(ERROR_REPETIDO);
		}	
		//Inserto info en la tabla items_guias
		$query_string = "INSERT INTO alumnos_catedras(lu_alu,cod_cat,year_alu_cat,periodo_alu_cat) VALUES (?,?,?,?);";

		$this->db->query($query_string,array($lu_alu,$cod_cat,$anio_alu_cat, $per_alu_cat));
	

	}

		/**  year_alu_cat VARCHAR(4) NOT NULL,
	
	 *	Elimina un alumno de cátedra.
	 *
	 * @access	public
	 * @param 	int $lu_alu
	 * 
	 *
	 */

	public function eliminar_alumno_catedra($lu_alu, $cod_cat)
	{
		//Verifico que exista un alumno con el mismo lu_alu
		$query_string = "SELECT lu_alu FROM alumnos_catedras
				WHERE lu_alu = ? ";
		$query = $this->db->query($query_string,array($lu_alu));
		if($this->db->affected_rows() == 0) 
		{

			$exam = $query->row_array();	
			throw new Exception(ERROR_REPETIDO); //cambiar error
		}
		else{
			$query_string = "SELECT cod_cat FROM alumnos_catedras
				WHERE cod_cat = ? ";
			$query = $this->db->query($query_string,array($cod_cat));
			if($this->db->affected_rows() > 0) 
			{	
				$query_string = "DELETE FROM alumnos_catedras WHERE lu_alu = ?";
				$this->db->query($query_string,array($lu_alu));
			}

		}
	}
		/**
	 *	Retorna el alumno con el id seleccionado
	 *
	 * @access	public
	 * @param 	$cod_cat int codigo de la catedra
	 * @param 	$id_guia int id de la guia
	 * @return	array - dato de las guia
	 *
	 */

	public function get_alumno($lu)
	{
		$query_string = "SELECT lu_alu, apellido_alu,nom_alu,dni_alu  FROM alumnos 
				WHERE lu_alu = ?";
		$query = $this->db->query($query_string,$lu);
	
		return $query->row_array();
	}


/**
	 *	Actualiza un alumno
	 *
	 * @access	public
	 * @param 	int $leg
	 * 
	 *
	 */

	public function actualizar_alumno($leg,$apellido,$nom,$dni)
	{
		// UPDATE table_name
		// 	SET column_name = value
		// 	WHERE condition

		//Verifico que exista un alumno con el mismo legajo
		$query_string = " UPDATE alumnos
	 		SET apellido_alu = ?, nom_alu = ?, dni_alu = ? 
		 	WHERE lu_alu = ?";
		$query = $this->db->query($query_string,array($apellido,$nom,$dni,$leg));
		// if($this->db->affected_rows() == 0) 
		// {
		// 	$exam = $query->row_array();	
		// 	throw new Exception(ERROR_REPETIDO); //cambiar error
		// }
		
	}	
	
}

/* Fin del archivo alumnos_model.php */
/* Location: ./application/models/alumnos_model.php */