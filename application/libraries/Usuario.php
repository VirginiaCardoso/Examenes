<?php

/**
 * Usuario
 *
 *@package      libraries
 *@author       Fernando Andrés Prieto
 *@author       Diego Martín Schwindt
 *@copyright    Marzo, 2014 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario
{
	private $CI;	
	
	function __construct()
	{            
        $this->CI =& get_instance();
        //modelo docentes cargado en el autoload
	}

	/**
	 * Loguea al usuario y setea su información básica en la sesión (id, nombre, apellido).
	 * Retorna TRUE si el login se realizó con éxito, FALSE en caso contrario.
	 *
	 * @access	public
	 * @param	string $legajo
	 * @param	string $password
	 * @return	bool - TRUE si el login se realizó con éxito, FALSE en caso contrario
	 */
	public function login($legajo, $password)
	{
		$data_usuario = $this->CI->docentes_model->get_credenciales($legajo, $password);

		if($data_usuario) {
			
			$this->CI->session->set_userdata('usuario', $data_usuario);
			return TRUE;
		}
		
		return FALSE;
	}

	/**
	 * Desloguea al usuario destruyendo la sesión activa.
	 * @access	public
	 */
	public function logout()
	{
		$this->CI->session->sess_destroy(); 
	}	

	/**
	 * Verifica que el usuario se encuentre logueado (se encuentra en la sesión).
	 * Retorna la información del usuario guardada en la sesión.
	 *	Si la sesión expiró, retorna nulo.
	 *
	 * @access	public
	 * @return 	array | NULL
	 */
	public function logueado()
    {
    	return $this->CI->session->userdata('usuario');	

    }
    
    /**
	 * Obtiene el campo especificado por $campo de la información
     * correspondiente al usuario guadado en la sesión.
	 *
	 * @access	public
	 * @param	string $campo
	 * @return 	array | NULL
 	 */
	public function get_info_sesion_usuario($campo)
	{

		$data_usuario = $this->logueado();

		return $data_usuario[$campo];
	}

	/**
	 * Setea el campo especificado por $campo de la información
     * correspondiente al usuario guadado en la sesión.
	 *
	 * @access	public
	 * @param	string $campo
	 * @param	string $valor
	 */
	public function set_info_sesion_usuario($campo, $valor)
	{
		$data_usuario = $this->logueado();

		if($data_usuario) {

			$data_usuario[$campo] = $valor;
			$this->CI->session->set_userdata('usuario',$data_usuario);
		}
	}

	/**
	 * Verifica que el usuario haya sido activado.
	 * Retorna TRUE si el usuario se encuentra activo, FALSE en caso contrario.
	 *
	 * @access	public
	 * @return	bool
	 */
	public function activo()
	{
		return $this->get_info_sesion_usuario('activo'); 
	}

	/**
	 * Verifica que el usuario tenga permiso de acceso.
	 *
	 * @access	public
	 * @param 	int $privilegio nivel de privilegio requerido
	 * @return	bool - TRUE si está logueado, activo, y su privilegio es mayor o igual al requerido (por default, 0)
	 */
	public function acceso_permitido($privilegio = PRIVILEGIO_DOCENTE)
	{
		return  $this->logueado() && 
				$this->activo() &&
				$this->get_info_sesion_usuario('privilegio') >= $privilegio;
	}


	/**
	 *  Setea en la sesión la actividad actual
	 *
	 * @access public
	 * @param string $actual actividad actual del usuario
	 */
	public function set_actividad_actual($actual)
	{
		if($actual==NULL)
			$this->CI->session->unset_userdata('actividad_actual');
		else
			$this->CI->session->set_userdata('actividad_actual', $actual);

	}

	/**
	 * Obtiene la actividad actual del usuario, guardad en la sesión
     *
	 * @access	public
	 * @return 	string | FALSE
 	 */
	public function get_actividad_actual()
	{
		return $this->CI->session->userdata('actividad_actual');	
	}


}

/* Fin del archivo Usuario.php */
/* Ubicación: ./application/libraries/Usuario.php */