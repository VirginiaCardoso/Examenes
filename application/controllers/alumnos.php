<?php 

/**
 * Controlador Alumnos. Encargado de la vista y administración de los alumnos 
 *
 *@package      controllers
 *@author       Cardoso Virginia
 *@author       Matias Marzullo
 *@copyright    Noviembre, 2015 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Alumnos extends CI_Controller {

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

            $this->load->model(array('alumnos_model'));
                
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

    public function nuevo_alumno(){

             $this->view_data['title'] = "Administrar Estudiantes  - Departamento de Ciencias de la Salud";          
        $this->load->view('template/header', $this->view_data);

        $this->usuario->set_actividad_actual('nuevo_alumno');

        //Mensaje de error: flashdata en la sesion
        $error = $this->session->flashdata('error');
        if($error)
            $this->view_data['error'] = $error;
        
        $this->view_data['docente'] = $this->nom_doc." ".$this->apellido_doc;
        $this->view_data['privilegio_user'] =  $this->privilegio;
        $this->view_data['nuevo'] = true;
        $this->load->view('content/alumnos/nuevo_alumno', $this->view_data);

        $this->load->view('template/footer');
  }


  public function set_alumno(){    //equivale a "nuevo" de usuarios
    
    if(!$this->input->post()) 
          {
              $this->session->set_flashdata('error', 'Acceso inválido a la creación de un nuevo alumno');
              redirect('alumnos/lista_alumnos');
          }

          $this->load->library('form_validation');
          $this->form_validation->set_rules('legajo', 'Legajo', 'trim|required|integer');
          $this->form_validation->set_rules('apellido', 'Apellido', 'required');
          $this->form_validation->set_rules('nombre', 'Nombre', 'required');
          $this->form_validation->set_rules('dni', 'Dni', 'integer');

        // if($this->form_validation->run() == TRUE){
         if (!$this->form_validation->run())  //si no verifica inputs
          {
              $this->session->set_flashdata('error', validation_errors());
              redirect('alumnos/nuevo_alumno');
          }

          $leg = $this->input->post('legajo'); 
          $apellido = $this->input->post('apellido');
          $nom = $this->input->post('nombre');
          $dni = $this->input->post('dni');

          if ($this->input->post('privilegio')=="superadmin")
          {
              $priv = PRIVILEGIO_SUPERADMIN;
          }
          else{
              if ($this->input->post('privilegio')=="admin"){
                  $priv = PRIVILEGIO_ADMIN;
              }
              else{
                  $priv = PRIVILEGIO_DOCENTE;
               }
          }
          
           try {
                              $alumno_nuevo = $this->alumnos_model->guardar_alumno($leg,$apellido,$nom,$dni);
                              $this->util->json_response(TRUE,STATUS_OK,$alumno_nuevo); //no mandar el JSON tal cual la BD por seguridad??


            } catch (Exception $e) {
                switch ($e->getMessage()) {
                        case ERROR_REPETIDO:
                        //$ld = $e->getCode();
                        $error['error_msj'] = "El alumno con ese legajo {$leg} ya ha sido guardado en la base de datos ";
                       //$error['leg_doc'] = $ld;
                        $this->util->json_response(FALSE,STATUS_REPEATED_POST,$error);
                        break;
                    // case ERROR_FALTA_ITEM:
                    //     $error['error_msj'] = "Falta(n) item(s) de la guia. El usuario no fue guardado en la base de datos";
                    //     $this->util->json_response(FALSE,STATUS_INVALID_PARAM,$error);
                    //     break;
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

            redirect('alumnos/lista_alumnos');

    }

private function mostrar_tabla_alumnos(){

        $this->load->model('alumnos_model');

        $alumnos = $this->alumnos_model->get_alumnos();
        //usar date helper

        $this->load->library('table');
        
        $this->table->set_heading('Apellido', 'Nombre', 'Nro Libreta', 'Dni','Acción', 'Modificar', 'Eliminar');
        foreach ($alumnos as $alu) {
        
            $this->table->add_row($alu['apellido_alu'], 
                                  $alu['nom_alu'], 
                                  $alu['lu_alu'], 
                                  $alu['dni_alu'], 
                                  " ",
                                  site_url('alumnos/modificar_alumno/'.$alu['lu_alu']),
                                  site_url('alumnos/eliminar_alumno/'.$alu['lu_alu'])
                                  // "eliminar"
                                  );
        }
        $template= array ('table_open'  => '<table id="lista_alumnos" class="table table-striped table-bordered  table-condensed" cellspacing="5" width="100%">');
        $this->table->set_template($template);
        $tabla= $this->table->generate();
        return $tabla;

    }

     /**
     * Controlador de la accion eliminar un alumno
     *  
     * En GET (parametro) se recibe solo el id del alumno
     *
     *
     * 
     * @access  public
     * @param   $id int id leg_doc del alumno
     */
    public function eliminar_alumno($id)
    {
      try {
                            $this->alumnos_model->eliminar_alumno($id);
                            //$examen['id_exam'] = $id_exam;
                            $this->util->json_response(TRUE,STATUS_OK,$id); //no mandar el JSON tal cual la BD por seguridad??


          } catch (Exception $e) {
              switch ($e->getMessage()) {
                  //     case ERROR_REPETIDO:
                  //     //$ld = $e->getCode();
                  //     $error['error_msj'] = "El alumno con ese legajo {$leg} ya ha sido guardado en la base de datos ";
                  //    //$error['leg_doc'] = $ld;
                  //     $this->util->json_response(FALSE,STATUS_REPEATED_POST,$error);
                  //     break;
                  // case ERROR_FALTA_ITEM:
                  //     $error['error_msj'] = "Falta(n) item(s) de la guia. El alumno no fue guardado en la base de datos";
                  //     $this->util->json_response(FALSE,STATUS_INVALID_PARAM,$error);
                  //     break;
                  // case ERROR_NO_INSERT_EXAM:
                  //     $error['error_msj'] = "El alumno no pudo ser archivado en la base de datos";
                  //     $this->util->json_response(FALSE,STATUS_NO_INSERT,$error);
                  //     break;
                  default:
                      $error['error_msj'] = "El alumno no fue eliminado de la base de datos";
                      $this->util->json_response(FALSE,STATUS_UNKNOWN_ERROR,$error);
                      break;
              }
          }

           redirect('alumnos/lista_alumnos');
            
    }

    /**
     * Controlador de la accion de modificar un alumno
     *  
     * En GET (parametro) se recibe solo el id del alumno
     *
     *
     * 
     * @access  public
     * @param   $id int leg_doc del alumno
     */
    public function modificar_alumno($id)
    {
          $alumno = $this->alumnos_model->get_alumno($id);
                          //$this->util->json_response(TRUE,STATUS_OK,$id); //no mandar el JSON tal cual la BD por seguridad??
                          
           if(!$alumno)   //chequea que $id esté y sea sólo numeros
            {
                $this->session->set_flashdata('error', 'Leg de alumno inexistente');
                redirect('alumnos/lista_alumnos');
            }

          $this->view_data['alumno'] = $alumno;
          
          $this->view_data['title'] = "Administrar Estudiantes  - Departamento de Ciencias de la Salud";          
          $this->load->view('template/header', $this->view_data);

        $this->usuario->set_actividad_actual('nuevo_alumno');

        //Mensaje de error: flashdata en la sesion
        $error = $this->session->flashdata('error');
        if($error)
            $this->view_data['error'] = $error;
        
        $this->view_data['docente'] = $this->nom_doc." ".$this->apellido_doc;
        $this->view_data['privilegio_user'] =  $this->privilegio;
        $this->view_data['modificar'] = true;
        $this->load->view('content/alumnos/modificar_alumno', $this->view_data);

        $this->load->view('template/footer');
    }

    /**
     * Controlador de la pagina de creacion de un nuevo usuario
     *  
     * En POST se reciben las opciones seleccionadas:
     * 
     * 
     * @access  public
     */
    public function actualizar($id)
    {
        if(!$this->input->post()) 
        {
            $this->session->set_flashdata('error', 'Acceso inválido a la creación de un nuevo alumno');
            redirect('alumnos/lista_alumnos');
        }

        $this->load->library('form_validation');
        // $this->form_validation->set_rules('legajo', 'Legajo', 'trim|integer');
        $this->form_validation->set_rules('apellido', 'Apellido', 'required');
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('dni', 'Dni', 'integer');

      // if($this->form_validation->run() == TRUE){
       if (!$this->form_validation->run())  //si no verifica inputs
        {
            $this->session->set_flashdata('error', validation_errors());
            redirect('alumnos/lista_alumnos');
        }

        // $leg = $this->input->post('legajo'); 
        $apellido = $this->input->post('apellido');
        $nom = $this->input->post('nombre');
        $dni = $this->input->post('dni');
        
         try {
                         $alumno_act = $this->alumnos_model->actualizar_alumno($id,$apellido,$nom,$dni);
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
           redirect('alumnos/lista_alumnos');
      
    }
/**
     * Controlador para listar todos los exámenes evaluados por el alumno
     *  
     * En POST recibe los filtros para la lista //TODO
     *
     * Carga vista de la lista de examenes
     * 
     * @access  public
     */
    public function lista_alumnos()
    {
       $this->view_data['title'] = "Administrar Estudiantes  - Departamento de Ciencias de la Salud";          
        $this->load->view('template/header', $this->view_data);

        $this->usuario->set_actividad_actual('administrar_alumnos');

        //Mensaje de error: flashdata en la sesion
        $error = $this->session->flashdata('error');
        if($error)
            $this->view_data['error'] = $error;
        
        //FECHA ACTUAL
        $this->view_data['fecha'] = date('d/m/Y'); 

       
        $this->view_data['docente'] = $this->nom_doc." ".$this->apellido_doc;
       // $this->view_data['nuevo'] = true;

       $tabla= $this->mostrar_tabla_alumnos();
       
        //$this->view_data['crud'] = $output;
        //$this->view_data['arreglo'] = $alumnos;
        $this->view_data['tabla'] = $tabla;
        //$this->view_data['docente'] = $this->nom_doc." ".$this->apellido_doc;
      //  $this->view_data['mostrar'] = true;
        //-------------------------------------------------------------------

        // $this->nuevo_usuario();
        // $this->lista_alumnos();
        $this->view_data['privilegio_user'] =  $this->privilegio;
        $this->load->view('content/alumnos/lista_alumnos', $this->view_data);

        $this->load->view('template/footer');
    } 

    

 }