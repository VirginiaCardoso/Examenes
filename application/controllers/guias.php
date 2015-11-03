<?php 

/**
 * Controlador Guias. Encargado de la vista y administración de las guias 
 *
 *@package      controllers
 *@author       Cardoso Virginia
 *@author       Matias Marzullo
 *@copyright    Octubre, 2015 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Guias extends CI_Controller {

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

            $this->load->model(array('guias_model'));
                
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
     * Controlador para listar todas las guias
     *  
     * En POST recibe los filtros para la lista //TODO
     *
     * Carga vista de la lista de guias
     * 
     * @access  public
     */
    public function lista_guias()
    {
        $this->load->model('guias_model');

        $guias = $this->guias_model->get_guias();
        
        $this->load->library('table');  
        
        $this->table->set_heading('Título', 'Cátedra','Carrera', 'Acción' , 'Modificar', 'Eliminar');
        foreach ($guias as $guia) {
            $this->table->add_row($guia['tit_guia'],
                                  $guia['nom_cat'].' ('.$guia['cod_cat'].')',
                                  $guia['cod_carr'],
                                  "",
                                  site_url(),// site_url('guias/modificar_guia/'.$guia['id_guia']),

                                  site_url('guias/eliminar_guia/'.$guia['id_guia'])
                                  );
        }
        
        $template= array ('table_open'  => '<table id="lista_guias" class="table table-striped table-bordered  table-condensed" cellspacing="5" width="100%" >');
        $this->table->set_template($template);
        $tabla= $this->table->generate();

        $this->view_data['title'] = "Lista de Guías - Departamento de Ciencias de la Salud";          
        $this->load->view('template/header', $this->view_data);
        $this->view_data['arreglo'] = $guias;
        $this->view_data['tabla'] = $tabla;
        $this->view_data['docente'] = $this->nom_doc." ".$this->apellido_doc;
        $this->load->view('content/guias/lista_guias', $this->view_data);

        $this->load->view('template/footer');
    } 

         /**
     * Controlador de la accion eliminar un guia
     *  
     * En GET (parametro) se recibe solo el id del guia
     *
     *
     * 
     * @access  public
     * @param   $id int id leg_doc del guia
     */
    public function eliminar_guia($id)
    {
      try {
                            $this->guias_model->eliminar_guia($id);
                            //$examen['id_exam'] = $id_exam;
                            $this->util->json_response(TRUE,STATUS_OK,$id); //no mandar el JSON tal cual la BD por seguridad??


          } catch (Exception $e) {
              switch ($e->getMessage()) {
                  //     case ERROR_REPETIDO:
                  //     //$ld = $e->getCode();
                  //     $error['error_msj'] = "El guia con ese legajo {$leg} ya ha sido guardado en la base de datos ";
                  //    //$error['leg_doc'] = $ld;
                  //     $this->util->json_response(FALSE,STATUS_REPEATED_POST,$error);
                  //     break;
                  // case ERROR_FALTA_ITEM:
                  //     $error['error_msj'] = "Falta(n) item(s) de la guia. El guia no fue guardado en la base de datos";
                  //     $this->util->json_response(FALSE,STATUS_INVALID_PARAM,$error);
                  //     break;
                  // case ERROR_NO_INSERT_EXAM:
                  //     $error['error_msj'] = "El guia no pudo ser archivado en la base de datos";
                  //     $this->util->json_response(FALSE,STATUS_NO_INSERT,$error);
                  //     break;
                  default:
                      $error['error_msj'] = "El guia no fue eliminada de la base de datos";
                      $this->util->json_response(FALSE,STATUS_UNKNOWN_ERROR,$error);
                      break;
              }
          }

           redirect('guias/lista_guias');
            
    }
  }