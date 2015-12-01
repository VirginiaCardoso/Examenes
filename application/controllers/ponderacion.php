<?php 

/**
 * Controlador Administración. Encargado de la vista y administración de usuarios del sistema
 *
 *@package      controllers
 *@author       Cardoso Virginia
 *@author       Marzullo Matias
 *@copyright    Julio, 2015 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ponderacion extends CI_Controller {

    private $view_data;
    private $legajo, $nom_doc, $apellido_doc;
    private $privilegio;

    
	public function __construct()
    {
    	parent::__construct();

    	if($this->usuario->acceso_permitido(PRIVILEGIO_DOCENTE)) 
   		{
   			$this->nom_doc = $this->usuario->get_info_sesion_usuario('nom_doc');
            $this->view_data['navbar']['nombre'] = $this->nom_doc; 
            $this->apellido_doc = $this->usuario->get_info_sesion_usuario('apellido_doc');
            $this->view_data['navbar']['apellido'] = $this->apellido_doc;
            $this->view_data['activo'] = $this->usuario->activo(); 

            $this->legajo = $this->usuario->get_info_sesion_usuario('leg_doc');
            $this->privilegio = $this->usuario->get_info_sesion_usuario('privilegio'); 

            $this->load->model(array('docentes_model','ponderacion_model'));
                
        }
        else if($this->usuario->logueado()) //no tiene privilegio, pero esta logueado
        { 
            $this->session->set_flashdata('error', 'No tiene permiso para realizar esta acción');
            redirect('home/index/error_privilegio');
            
        }
        else
        {
            $this->session->set_flashdata('error', 'Sesión caducada. Vuelva a iniciar sesión');
            redirect('login');
        }

  	}


      /**
     * Controlador para 
     *  
     * En POST recibe los filtros para la lista //TODO
     *
     * Carga vista de la lista de examenes
     * 
     * @access  public
     */
    public function rango()
    {
        
        $this->view_data['title'] = "Rango ponderación  - Departamento de Ciencias de la Salud";          
        $this->load->view('template/header', $this->view_data);

        $this->view_data['docente'] = $this->nom_doc." ".$this->apellido_doc;
        $this->view_data['privilegio_user'] =  $this->privilegio;
        $this->load->view('content/ponderacion/rango', $this->view_data);

        $this->load->view('template/footer');
    }

}