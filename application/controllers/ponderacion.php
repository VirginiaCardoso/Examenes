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

        $this->view_data['adq'] = $this->ponderacion_model->get_max_min(2);
        $this->view_data['med_adq'] = $this->ponderacion_model->get_max_min(1);
        $this->view_data['no_adq'] = $this->ponderacion_model->get_max_min(0);

        $this->load->view('content/ponderacion/rango', $this->view_data);

        $this->load->view('template/footer');
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
    public function actualizar()
    {
        
        // if(!$this->input->post()) 
        // {
        //     $this->session->set_flashdata('error', 'Acceso inválido a la creación de un nuevo alumno');
        //     redirect('estudiantes/lista_estudiantes');
        // }

        $this->load->library('form_validation');
       
        $this->form_validation->set_rules('min_adq', 'min_adq', 'required');
        $this->form_validation->set_rules('min_med_adq', 'min_med_adq', 'required');
     

      // if($this->form_validation->run() == TRUE){
       // if (!$this->form_validation->run())  //si no verifica inputs
       //  {
       //      $this->session->set_flashdata('error', validation_errors());
       //  }

        // $leg = $this->input->post('legajo'); 
        $min_adq = $this->input->post('min_adq');
        $min_med_adq = $this->input->post('min_med_adq');
       
         try {
                        $this->ponderacion_model->actualizar_pond(2, 100, $min_adq);
                        $this->ponderacion_model->actualizar_pond(1, $min_adq-0.1, $min_med_adq);
                        $this->ponderacion_model->actualizar_pond(0, $min_med_adq-0.1, 0);

                            //$examen['id_exam'] = $id_exam;
                             $this->util->json_response(TRUE,STATUS_OK,$id); //no mandar el JSON tal cual la BD por seguridad??
                              // $this->util->json_response(TRUE,STATUS_OK);

          } catch (Exception $e) {
              switch ($e->getMessage()) {
                      case ERROR_REPETIDO:
                      //$ld = $e->getCode();
                      $error['error_msj'] = "El alumno con ese legajo {$leg} ya ha sido guardado en la base de datos ";
                     //$error['leg_doc'] = $ld;
                      $this->util->json_response(FALSE,STATUS_REPEATED_POST,$error);
                      break;
                  case ERROR_FALTA_ITEM:
                      $error['error_msj'] = "Falta(n) item(s) de la guia. El alumno no fue guardado en la base de datos";
                      $this->util->json_response(FALSE,STATUS_INVALID_PARAM,$error);
                      break;
                  case ERROR_NO_INSERT_EXAM:
                      $error['error_msj'] = "El alumno no pudo ser archivado en la base de datos";
                      $this->util->json_response(FALSE,STATUS_NO_INSERT,$error);
                      break;
                  default:
                      $error['error_msj'] = "El alumno no fue guardado en la base de datos";
                      $this->util->json_response(FALSE,STATUS_UNKNOWN_ERROR,$error);
                      break;
              }
          } 

           $this->view_data['modificar'] = FALSE;
           redirect('administracion/admin');
    }

}