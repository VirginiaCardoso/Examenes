<?php

/**
 * Modelo docentes
 *
 *@package      models
 *@author       Fernando Andrés Prieto
 *@author       Diego Martín Schwindt
 *@copyright    Marzo, 2014 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
*/

class Docentes_model extends CI_Model {

	private $docente_actual;
	
	public function __construct()
	{
		$this->docente_actual = $this->usuario->logueado();
	}

	/**
	 * Retorna la información básica del docente, si el legajo y el password son válidos
	 *
	 * @access	public
	 * @param	string $legajo
	 * @param	string $password
	 * @return	array - datos del docente | NULL si legajo y/o password no son validos
	 */
	public function get_credenciales($legajo, $password)
	{
		$query_string = "SELECT leg_doc,apellido_doc,nom_doc,dni_doc,email_doc,tel_doc,activo,privilegio FROM docentes WHERE leg_doc = ? AND pass = MD5(?)";

		$query = $this->db->query($query_string,array($legajo,$password));

		return $query->row_array();
	}

	public function guardar_docente($leg_doc,$pass, $apellido_doc,$nom_doc,$dni_doc,$email_doc,$tel_doc,$privilegio)
	{
		//Verifico que no exista un docente con el mismo legajo
		$query_string = "SELECT apellido_doc FROM docentes
				WHERE leg_doc = ? ";
		$query = $this->db->query($query_string,array($leg_doc));
		if($this->db->affected_rows() > 0) 
		{
			$exam = $query->row_array();	
			throw new Exception(ERROR_REPETIDO);
		}
		//Inserto info en la tabla docente
		$query_string = "INSERT INTO docentes (leg_doc,pass,apellido_doc,nom_doc,dni_doc,email_doc,tel_doc,privilegio) 
			 VALUES (?,?,?,?,?,?,?,?)";
		$this->db->query($query_string,array($leg_doc,md5($pass), $apellido_doc,$nom_doc,$dni_doc,$email_doc,$tel_doc,$privilegio));
		
		
		if($this->db->affected_rows() == 0)
		{
			throw new Exception(ERROR_NO_INSERT_EXAM);
		}
		//$id_exam = $this->db->insert_id();
	}

	/**
	 *	Obtiene lista de usuarios.
	 *
	 * @access	public
	 * @param 	
	 * @return	array de array - datos de los usuarios
	 *
	 */

	public function get_usuarios()
	{
		$query_string = "SELECT leg_doc, pass, apellido_doc,nom_doc,dni_doc,email_doc,tel_doc,privilegio 
							FROM docentes ";
		$query = $this->db->query($query_string);
		return $query->result_array();
	}

/**
	 *	Elimina un usuario.
	 *
	 * @access	public
	 * @param 	int $leg
	 * 
	 *
	 */

	public function eliminar_docente($leg)
	{
		//Verifico que exista un docente con el mismo legajo
		$query_string = "SELECT apellido_doc FROM docentes
				WHERE leg_doc = ? ";
		$query = $this->db->query($query_string,array($leg));
		if($this->db->affected_rows() == 0) 
		{

			$exam = $query->row_array();	
			throw new Exception(ERROR_REPETIDO); //cambiar error
		}
		else{
			$query_string = "SELECT cod_cat FROM docentes_catedras
				WHERE leg_doc = ? ";
			$query = $this->db->query($query_string,array($leg));
			if($this->db->affected_rows() > 0) 
			{	
				$query_string = "DELETE FROM docentes_catedras WHERE leg_doc = ?";
				$this->db->query($query_string,array($leg));
			}

		}
		$query_string = "DELETE FROM docentes WHERE leg_doc = ?";
		$this->db->query($query_string,array($leg));
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

	public function get_docente($leg)
	{
		$query_string = "SELECT leg_doc, pass, apellido_doc,nom_doc,dni_doc,email_doc,tel_doc,privilegio  FROM docentes 
				WHERE leg_doc = ?";
		$query = $this->db->query($query_string,$leg);
	
		return $query->row_array();


	}

	/**
	 *	Modificar datos de un docente
	 *
	 * @access	public
	 * @param 	int $leg
	 * 
	 *
	 */

	public function actualizar_docente($leg,$apellido,$nom,$dni,$email,$tel,$priv)
	{
		// UPDATE table_name
		// 	SET column_name = value
		// 	WHERE condition

		//Verifico que exista un docente con el mismo legajo
		$query_string = " UPDATE docentes
	 		SET apellido_doc = ?, nom_doc = ?, dni_doc = ?, email_doc =?, tel_doc = ?, privilegio = ? 
		 	WHERE leg_doc = ?";
		$query = $this->db->query($query_string,array($apellido,$nom,$dni,$email,$tel,$priv,$leg));
		if($this->db->affected_rows() == 0) 
		{
			//$exam = $query->row_array();	//salta error si no modifican nada y guardan
			
			throw new Exception(ERROR_REPETIDO); //cambiar error
		}
		
	}


	/**
	 *	Modiicar Contraseña docente
	 *
	 * @access	public
	 * @param 	int $leg
	 * 
	 *
	 */

	public function actualizarC_docente($leg,$pass)
	{
		// UPDATE table_name
		// 	SET column_name = value
		// 	WHERE condition

		//Verifico que exista un docente con el mismo legajo
		$query_string = " UPDATE docentes
	 		SET pass = ?
		 	WHERE leg_doc = ?";
		$query = $this->db->query($query_string,array($pass,$leg));
		if($this->db->affected_rows() == 0) 
		{
			$exam = $query->row_array();	
			throw new Exception(ERROR_REPETIDO); //cambiar error
		}
		
	}
	
	
}

/* Fin del archivo docentes_model.php */
/* Location: ./application/models/docentes_model.php */