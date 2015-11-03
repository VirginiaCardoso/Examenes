<?php 

/**
 * Controlador Home
 *
 *@package      controllers
 *@author       Fernando Andrés Prieto
 *@author       Diego Martín Schwindt
 *@copyright    Marzo, 2014 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

    //private $docente;
    private $view_data;

	public function __construct()
    {
        parent::__construct();
    
        if($this->usuario->logueado())
   		{
            $this->view_data['navbar']['nombre'] = $this->usuario->get_info_sesion_usuario('nom_doc'); 
            $this->view_data['navbar']['apellido'] = $this->usuario->get_info_sesion_usuario('apellido_doc'); 
            $this->view_data['activo'] = $this->usuario->activo(); 
            // $this->load->model('docentes_model');   (se carga en Usuario)
        }
        else
        {
            $this->session->set_flashdata('error', 'Sesión caducada. Vuelva a iniciar sesión');
            redirect('login');
        }
    }


	/**
     * Carga la vista apropiada dependiendo si el usuario 
     * se encuentra activo o no.
     *
     * @access  public
     * @param string $info mensaje a mostrar
     */
    public function index($info = NULL)
    { 
        $this->view_data['title'] = "Exámenes - Departamento de Ciencias de la Salud";          
        
        if($info) 
        {
            if($info == 'error_privilegio')
                $this->view_data['info'] = 'No tiene permiso para ingresar en esa sección';
        }

        $msj_error = $this->session->flashdata('error');
        if($msj_error) 
        {
            $this->view_data['info']= $msj_error;
        }

        $this->load->view('template/header', $this->view_data); 
        if($this->usuario->activo()) {
            
            $this->load->view('content/home/index', $this->view_data);
        }
        else {
            
            $this->load->view('content/home/activar', $this->view_data);
        }


        $this->load->view('template/footer');  
    }
}    

/* Fin del archivo home.php */
/* Ubicación: ./application/controllers/home.php */