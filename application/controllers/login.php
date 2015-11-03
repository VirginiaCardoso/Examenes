<?php

/**
 * Controlador Login
 *
 *@package      controllers
 *@author       Fernando Andrés Prieto
 *@author       Diego Martín Schwindt
 *@copyright    Marzo, 2014 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

    private $view_data;
	
    public function __construct()
    {
        parent::__construct();
    

    }

    /**
     * Carga la vista apropiada dependiendo si el usuario 
     * se encuentra logueado o debe loguearse.
     *
     * @access  public
     * 
     */
    public function index()
    {  
    	if($this->usuario->logueado())
    	{   	
    		redirect('home');   
    	}
    	else
    	{     
    		$this->view_data['title'] = "Departamento de Ciencias de la Salud";

            $msj_error = $this->session->flashdata('error');
            if($msj_error) 
            {
                $msj= '';
                if(isset($this->view_data['error_login']))
                    $msj = $this->view_data['error_login'];
                $this->view_data['error_login'] = $msj . $msj_error;
            }


            $this->load->view('template/header', $this->view_data);
		    $this->load->view('content/login/index', $this->view_data);  //muestra errores si los hubo
		    $this->load->view('template/footer'); 	  		
    	}
    	
    }

    /**
     * Loguea al usuario
     *
     * @access  public
     */
	public function loguear_usuario()
	{	 
        $this->load->library('form_validation');
        $this->form_validation->set_rules('legajo', 'Legajo', 'required|numeric');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run())  //solo intenta loguear si cumple la validacion
        {
            
            $legajo = $this->input->post('legajo',TRUE); //2º param: filtro XSS
            $password = $this->input->post('password',TRUE);

            if($this->usuario->login($legajo, $password))
            { 
                redirect('home'); 
            }
            else
            {
                $this->view_data['error_login'] = 'Legajo o contraseña incorrectos. '; //discriminar error 
                $this->index();
            }

        } 
        else
            $this->index();    //muestra los errores de validación si hay                
	}

	/**
     * Desloguea al usuario
     *
     * @access  public
     */
	public function desloguear_usuario()
	{
		$this->usuario->logout();  
		redirect('login');
	}

}    

/* Fin del archivo login.php */
/* Ubicación: ./application/controllers/login.php */