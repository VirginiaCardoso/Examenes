<?php 

/**
 * Controlador Catedras. Encargado de la vista y administración de las catedras 
 *
 *@package      controllers
 *@author       Cardoso Virginia
 *@author       Matias Marzullo
 *@copyright    Septiembre, 2015 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Catedras extends CI_Controller {

    private $view_data;
    private $nombre, $codigo, $carrera, $legajo, $nom_doc, $apellido_doc;
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

            $this->load->model(array('carreras_model','catedras_model','estudiantes_model','docentes_model'));
                
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
     * Controlador para listar todas las catedras
     *  
     * En POST recibe los filtros para la lista //TODO
     *
     * Carga vista de la lista de catedras
     * 
     * @access  public
     */
    public function lista_catedras()
    {
        $this->load->model('catedras_model');

        $catedras = $this->catedras_model->get_catedras();
        
        $this->load->library('table');  
        
        $this->table->set_heading('Código', 'Nombre', ' Carrera ','Acción', 'Modificar', 'Eliminar');
        foreach ($catedras as $catedra) {
            $this->table->add_row($catedra['cod_cat'],
                                  $catedra['nom_cat'],
                                  $catedra['nom_carr'].' ('.$catedra['cod_carr'].')',
                                  "",
                                  site_url('catedras/estudiantes_catedra/'.$catedra['cod_cat']),
                                  site_url('catedras/docentes_catedra/'.$catedra['cod_cat']),
                                  site_url('catedras/modificar_catedra/'.$catedra['cod_cat']),
                                  site_url('catedras/eliminar_catedra/'.$catedra['cod_cat'])
                                  );

        }
        $template= array ('table_open'  => '<table id="lista_catedras" class="table table-striped table-bordered  table-condensed" cellspacing="5" width="100%" >');
        $this->table->set_template($template);
        $tabla= $this->table->generate();

        $carreras = $this->_carreras();

        $this->view_data['title'] = "Lista de cátedras - Departamento de Ciencias de la Salud";          
        $this->load->view('template/header', $this->view_data);

        //$this->view_data['crud'] = $output;
        $this->view_data['arreglo'] = $catedras;
        $this->view_data['carreras'] = $carreras;

        $this->view_data['tabla'] = $tabla;
        $this->view_data['docente'] = $this->nom_doc." ".$this->apellido_doc;
        $this->load->view('content/catedras/lista_catedras', $this->view_data);

        $this->load->view('template/footer');
    } 

    /**
     * Devuelve arreglo con las carreras correspondientes al catedra
     *
     * @access  private
     * @return  array  - lista de carreras del catedra
     */
    function _carreras() 
    {
        if($this->privilegio>=PRIVILEGIO_ADMIN)  //si es admin muestra todas las carreras
            $carreras = $this->carreras_model->get_carreras();
        else
            $carreras = $this->carreras_model->get_carreras_docente($this->legajo);
        return $carreras;
    }

    /**
     * Devuelve arreglo con los docentes
     *
     * @access  private
     * @return  array  - lista de docentes
     */
    function _docentes() 
    {
        // if($this->privilegio>=PRIVILEGIO_ADMIN)  //si es admin muestra todas las docentes
        $docentes = $this->docentes_model->get_usuarios();
        // else
        //     $docentes = $this->docentes_model->get_docentes_docente($this->legajo);
        return $docentes;
    }

    /**
     * Devuelve arreglo con los estudiantes
     *
     * @access  private
     * @return  array  - lista de estudiantes
     */
    function _estudiantes() 
    {
        // if($this->privilegio>=PRIVILEGIO_ADMIN)  //si es admin muestra todas las estudiantes
        $estudiantes = $this->estudiantes_model->get_estudiantes();
        // else
        //     $estudiantes = $this->estudiantes_model->get_estudiantes_docente($this->legajo);
        return $estudiantes;
    }

    function _estudiantesNoCatedra($cod_catedra){
          $estudiantes = $this->estudiantes_model->get_estudiantes_not_catedra($cod_catedra);
          return $estudiantes;
    }
    function _docentesNoCatedra($cod_catedra){
          $estudiantes = $this->catedras_model->get_docentes_not_catedra($cod_catedra);
          return $estudiantes;
    }

    /**
     * Controlador de la pagina de creacion de un nuevo catedra
     *
     * @access  public
     */
     public function nueva_catedra($selects = NULL){



       $this->view_data['title'] = "Administrar Catedras  - Departamento de Ciencias de la Salud";          
        $this->load->view('template/header', $this->view_data);

        $this->usuario->set_actividad_actual('nueva_catedra');

        //Mensaje de error: flashdata en la sesion
        $error = $this->session->flashdata('error');
        if($error)
            $this->view_data['error'] = $error;
        
        

        $carreras = $this->_carreras();
        //DEBUG
        //echo 'Carreras del docente:<br/>';
        //foreach ($carreras as $fila)
        //    var_dump($fila); echo '<br/>';

        if(count($carreras)>0)  //si no hay carreras no manda datos a la view
        {
            $this->view_data['carreras']['list'] = $carreras;  //en la view: $carreras['list'][indice]['cod_carr'].
            $index_carrera = 0; //Por defecto, primer carrera

            //Busco en post si hay carrera seleccionada por default, y actualiza el index seleccionado de la lista
            $cod_carr_default = $this->input->post('carrera') ;
            
            if($cod_carr_default)
            {
                $index_carrera = $this->util->buscar_indice($carreras,'cod_carr',$cod_carr_default);
                //Si el codigo es erroneo, queda no_selected
            }
                
            $this->view_data['carreras']['selected'] = $index_carrera;

            //Si no hay carrera seleccionada, las demas listas están vacías.
            if($index_carrera >= 0 && isset($carreras[$index_carrera]))
            {
                $carrera = $carreras[$index_carrera];   //Carrera seleccionada
     
            }// hay carrera seleccionada
        }//hay carreras

        $this->view_data['docente'] = $this->nom_doc." ".$this->apellido_doc;
        $this->view_data['privilegio_user'] =  $this->privilegio;
        $this->view_data['nueva_catedra'] = true;
        $this->load->view('content/catedras/nueva_catedra', $this->view_data);

        $this->load->view('template/footer');

    }

    /**
     * Controlador de la acción de crear una catedra    
     *
     * @access  public
     */
     public function nueva()
    {
        if(!$this->input->post()) 
        {
            $this->session->set_flashdata('error', 'Acceso inválido a la creación de un nueva cátedra');
            redirect('catedras/lista_catedras');
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('codigo', 'Código', 'required|integer');
        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');
        $this->form_validation->set_rules('carrera', 'Carrera', 'required|integer');
        if (!$this->form_validation->run())  //si no verifica inputs
        {
            $this->session->set_flashdata('error', validation_errors());
            redirect('catedras/nueva_catedra');
        }

        $cod_cat = $this->input->post('codigo');
        $nombre_cat = $this->input->post('nombre');
        $cod_carr = $this->input->post('carrera');

        try {
                             $this->catedras_model->insertar_catedra($cod_cat, $nombre_cat, $cod_carr);
                             $this->util->json_response(TRUE,STATUS_OK); //no mandar el JSON tal cual la BD por seguridad??


          } catch (Exception $e) {
              switch ($e->getMessage()) {
                      case ERROR_REPETIDO:
                      //$ld = $e->getCode();
                      $error['error_msj'] = "El catedra con ese legajo {$leg} ya ha sido guardado en la base de datos ";
                     //$error['leg_doc'] = $ld;
                      $this->util->json_response(FALSE,STATUS_REPEATED_POST,$error);
                      break;
                  case ERROR_FALTA_ITEM:
                      $error['error_msj'] = "Falta(n) item(s) de la guia. El catedra no fue guardado en la base de datos";
                      $this->util->json_response(FALSE,STATUS_INVALID_PARAM,$error);
                      break;
                  case ERROR_NO_INSERT_EXAM:
                      $error['error_msj'] = "El catedra no pudo ser archivado en la base de datos";
                      $this->util->json_response(FALSE,STATUS_NO_INSERT,$error);
                      break;
                  default:
                      $error['error_msj'] = "El catedra no fue guardado en la base de datos";
                      $this->util->json_response(FALSE,STATUS_UNKNOWN_ERROR,$error);
                      break;
              }
          } //errores al intentar guardar el catedra

          redirect('catedras/lista_catedras');

    }


     /**
     * Controlador de la acción eliminar un catedra
     *  
     * En GET (parametro) se recibe solo el id de la catedra
     *
     *
     * 
     * @access  public
     * @param   $cod_cat de catedra
     */
    public function eliminar_catedra($cod_cat)
    {
      try {
                            $this->catedras_model->eliminar_catedra($cod_cat);
                            //$examen['cod_cat_exam'] = $cod_cat_exam;
                            $this->util->json_response(TRUE,STATUS_OK,$cod_cat); //no mandar el JSON tal cual la BD por seguridad??


          } catch (Exception $e) {
              switch ($e->getMessage()) {
                  //     case ERROR_REPETIDO:
                  //     //$ld = $e->getCode();
                  //     $error['error_msj'] = "El catedra con ese legajo {$leg} ya ha sido guardado en la base de datos ";
                  //    //$error['leg_doc'] = $ld;
                  //     $this->util->json_response(FALSE,STATUS_REPEATED_POST,$error);
                  //     break;
                  // case ERROR_FALTA_ITEM:
                  //     $error['error_msj'] = "Falta(n) item(s) de la guia. El catedra no fue guardado en la base de datos";
                  //     $this->util->json_response(FALSE,STATUS_INVALID_PARAM,$error);
                  //     break;
                  // case ERROR_NO_INSERT_EXAM:
                  //     $error['error_msj'] = "El catedra no pudo ser archivado en la base de datos";
                  //     $this->util->json_response(FALSE,STATUS_NO_INSERT,$error);
                  //     break;
                  default:
                      $error['error_msj'] = "El catedra no fue eliminado de la base de datos";
                      $this->util->json_response(FALSE,STATUS_UNKNOWN_ERROR,$error);
                      break;
              }
          }

           redirect('catedras/lista_catedras');
            
    }

    /**
     * Controlador de la pagina de modificación de una catedra
     *  
     * En GET (parametro) se recibe solo el cod de la catedra
     *
     *
     * 
     * @access  public
     * @param   $id int leg_doc del catedra
     */
    public function modificar_catedra($cod_cat)
    {
        $catedra = $this->catedras_model->get_catedra($cod_cat);
        
        if(!$catedra)   //chequea que $id esté y sea sólo numeros
            {
                $this->session->set_flashdata('error', 'Código de catedra inexistente');
                redirect('catedras/modificar_catedras');
            }
        $this->view_data['catedra'] = $catedra;
        $carreras = $this->_carreras();
       
        if(count($carreras)>0)  //si no hay carreras no manda datos a la view
        {
            $this->view_data['carreras']['list'] = $carreras;  //en la view: $carreras['list'][indice]['cod_carr'].
            $index_carrera = 0; //Por defecto, primer carrera

            //Busco en post si hay carrera seleccionada por default, y actualiza el index seleccionado de la lista
            $cod_carr_default = $this->input->post('carrera') ;
            
            if($cod_carr_default)
            {
                $index_carrera = $this->util->buscar_indice($carreras,'cod_carr',$cod_carr_default);
                //Si el codigo es erroneo, queda no_selected
            }
                
            $this->view_data['carreras']['selected'] = $index_carrera;

            //Si no hay carrera seleccionada, las demas listas están vacías.
            if($index_carrera >= 0 && isset($carreras[$index_carrera]))
            {
                $carrera = $carreras[$index_carrera];   //Carrera seleccionada               
            }// hay carrera seleccionada
        }

        $this->view_data['title'] = "Administrar catedras  - Departamento de Ciencias de la Salud";          
        $this->load->view('template/header', $this->view_data);

        $this->usuario->set_actividad_actual('nueva_catedra');

        //Mensaje de error: flashdata en la sesion
        $error = $this->session->flashdata('error');
        if($error)
            $this->view_data['error'] = $error;
        
        $this->view_data['docente'] = $this->nom_doc." ".$this->apellido_doc;
        $this->view_data['privilegio_user'] =  $this->privilegio;
        $this->view_data['modificar'] = true;
        $this->load->view('content/catedras/modificar_catedra', $this->view_data);

        $this->load->view('template/footer');
    }

    /**
     * Controlador de la acción de modificar una catedra
     *  
     * En POST se reciben las opciones seleccionadas:
     * 
     * 
     * @access  public
     */
    public function actualizar($cod_cat)
    {
        if(!$this->input->post()) 
        {
            $this->session->set_flashdata('error', 'Acceso inválido a la creación de una nueva cátedra');
            redirect('catedras/lista_catedras');
        }

        $this->load->library('form_validation');
        // $this->form_validation->set_rules('codigo', 'Código', 'required|integer');
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('carrera', 'Carrera', 'required|integer');

      // if($this->form_validation->run() == TRUE){
       if (!$this->form_validation->run())  //si no verifica inputs
        {
            $this->session->set_flashdata('error', validation_errors());
            redirect('catedras/lista_catedras');
        }

        // $cod = $this->input->post('codigo'); 
        $nom = $this->input->post('nombre');
        $carr = $this->input->post('carrera');
        
         try {
                            $cat_actual =$this->catedras_model->actualizar_catedra($cod_cat,$nom,$carr);
                            $this->util->json_response(TRUE,STATUS_OK,$cat_actual);

          } catch (Exception $e) {
              switch ($e->getMessage()) {
                      case ERROR_REPETIDO:
                      //$ld = $e->getCode();
                      $error['error_msj'] = "La cátedra con el código {$cod} ya ha sido guardado en la base de datos ";
                     //$error['leg_doc'] = $ld;
                      $this->util->json_response(FALSE,STATUS_REPEATED_POST,$error);
                      break;
                  case ERROR_FALTA_ITEM:
                      $error['error_msj'] = "Falta(n) item(s) de la guia. La cátedra no fue guardado en la base de datos";
                      $this->util->json_response(FALSE,STATUS_INVALID_PARAM,$error);
                      break;
                  case ERROR_NO_INSERT_EXAM:
                      $error['error_msj'] = "La cátedra no pudo ser archivado en la base de datos";
                      $this->util->json_response(FALSE,STATUS_NO_INSERT,$error);
                      break;
                  default:
                      $error['error_msj'] = "La cátedra no fue guardado en la base de datos";
                      $this->util->json_response(FALSE,STATUS_UNKNOWN_ERROR,$error);
                      break;
              }
          } 

           $this->view_data['modificar'] = FALSE;
          redirect('catedras/lista_catedras');      
    }

    /**
     * Controlador de la pagina de agregar estudiantes a una catedra
     *  
     * 
     * 
     * @access  public
     */
         public function estudiantes_catedra($cod_cat)
    {
        

        $catedra = $this->catedras_model->get_catedra($cod_cat);
        
        if(!$catedra)   //chequea que $id esté y sea sólo numeros
            {
                $this->session->set_flashdata('error', 'Código de catedra inexistente');
                redirect('catedras/lista_catedras');
            }
        $this->view_data['catedra'] = $catedra;

        // PARTE 1 MUESTRA SELECT DE estudiantes PARA LA CÁTEDRA

       //$estudiantes = $this->_estudiantes();
       $estudiantes = $this->_estudiantesNoCatedra($cod_cat);
        
                        if(count($estudiantes)>0)  //si no hay guias no manda datos a la view
                        {
                            $this->view_data['estudiantes']['list'] = $estudiantes;  //en la view: $estudiantes['list'][indice]['lu_alu'].
                            $index_alumno = NO_SELECTED; //Por defecto, no seleccionado

                            //Busco en post si hay guia seleccionada por default, y actualiza el index seleccionado de la lista
                            $lu_alu_default = $this->input->post('alumno') ;
                            if($lu_alu_default) 
                            {
                                $index_alumno = $this->util->buscar_indice($estudiantes,'lu_alu',$lu_alu_default);
                            }
                            $this->view_data['estudiantes']['selected'] = $index_alumno;

                        } //hay estudiantes

        // PARTE 2 MUESTRA TABLA DE estudiantes DE LA CÁTEDRA
        $this->load->model('estudiantes_model');
        $alu_cat = $this->estudiantes_model->get_estudiantes_catedra($cod_cat);

        $this->load->library('table');
        
        $this->table->set_heading('Período', 'Nombre','Nro Libreta', 'Dni','Acción', 'Eliminar');
        foreach ($alu_cat as $alu) {   
            $this->table->add_row($alu['year_alu_cat'].' - '.$alu['periodo_alu_cat'],
                                  $alu['apellido_alu'].', '.$alu['nom_alu'], 
                                  $alu['lu_alu'],    
                                  // $alu['dni_alu'], 
                                  " ",
                                  site_url('catedras/eliminar_alu_cat/'.$alu['lu_alu'].'/'.$cod_cat)
                                  );
        }
        $template= array ('table_open'  => '<table id="lista_alu_cat" class="table table-striped table-bordered  table-condensed" cellspacing="5" width="100%">');
        $this->table->set_template($template);
        $tabla= $this->table->generate();
        // return $tabla;
        $this->view_data['tabla'] = $tabla;

        $this->view_data['title'] = "Administrar catedras  - Departamento de Ciencias de la Salud";          
        $this->load->view('template/header', $this->view_data);

        $this->usuario->set_actividad_actual('nueva_catedra');

        //Mensaje de error: flashdata en la sesion
        $error = $this->session->flashdata('error');
        if($error)
            $this->view_data['error'] = $error;
        
        $this->view_data['docente'] = $this->nom_doc." ".$this->apellido_doc;
        $this->view_data['privilegio_user'] =  $this->privilegio;
        $this->view_data['modificar'] = true;
        $this->load->view('content/estudiantes_catedra/estudiantes_catedra', $this->view_data);

        $this->load->view('template/footer');
    }


    /**
     * Vincula
     *
     * @access  public
     */
     public function agregar_alu_cat($cod_cat)
     {

      // $cat = $this->catedras_model->get_catedra($cod_cat);
      // $cod_cat = $this->input->post('catedra');
      // @param   $alu int alu referencia al lU del alumno
      $lu_alu = $this->input->post('alumno');
      $anio_alu_cat = $this->input->post('year');
      $per_alu_cat = $this->input->post('periodo');
      $alumno = $this->estudiantes_model->vincular_alumno_catedra($lu_alu, $anio_alu_cat, $per_alu_cat, $cod_cat);
        if(!$lu_alu || $lu_alu==NO_SELECTED)
        {
            $this->session->set_flashdata('error', 'Estudiante inválido');
            redirect('catedras/estudiantes_catedra');
        }

                // $catedra = $this->catedras_model->get_catedra($cod_cat);

        // $this->load->view('content/estudiantes_catedra/estudiantes_catedra', $cod_cat);
        // $this->load->view('content/estudiantes_catedra/estudiantes_catedra', $this->view_data);

        // site_url('catedras/estudiantes_catedra/'.$catedra['cod_cat']),
                   redirect('catedras/estudiantes_catedra/'.$cod_cat);
   


          //        try {
          //                   $this->estudiantes_model->vincular_alumno_catedra($lu_alu, $cod_cat);
          //                   $this->util->json_response(TRUE,STATUS_OK);

          // } catch (Exception $e) {
          //     switch ($e->getMessage()) {
          //             case ERROR_REPETIDO:
          //             //$ld = $e->getCode();
          //             $error['error_msj'] = "La cátedra con el código {$cod} ya ha sido guardado en la base de datos ";
          //            //$error['leg_doc'] = $ld;
          //             $this->util->json_response(FALSE,STATUS_REPEATED_POST,$error);
          //             break;
          //         case ERROR_FALTA_ITEM:
          //             $error['error_msj'] = "Falta(n) item(s) de la guia. La cátedra no fue guardado en la base de datos";
          //             $this->util->json_response(FALSE,STATUS_INVALID_PARAM,$error);
          //             break;
          //         case ERROR_NO_INSERT_EXAM:
          //             $error['error_msj'] = "La cátedra no pudo ser archivado en la base de datos";
          //             $this->util->json_response(FALSE,STATUS_NO_INSERT,$error);
          //             break;
          //         default:
          //             $error['error_msj'] = "La cátedra no fue guardado en la base de datos";
          //             $this->util->json_response(FALSE,STATUS_UNKNOWN_ERROR,$error);
          //             break;
          //     }
          // } 

          //  $this->view_data['modificar'] = FALSE;
          // redirect('catedras/estudiantes_catedra');   
    }

     /**
     * Controlador de la acción eliminar un catedra
     *  
     * En GET (parametro) se recibe solo el id de la catedra
     *
     *
     * 
     * @access  public
     * @param   $id int id leg_doc de catedra
     */
    public function eliminar_alu_cat($lu_alu, $cod_cat)
    {

        if(!$lu_alu)   //chequea que $id esté y sea sólo numeros
            {
                $this->session->set_flashdata('error', 'Lu de Estudiante inexistente');
                redirect('catedras/lista_catedras');
            }
      if(!$cod_cat)   //chequea que $id esté y sea sólo numeros
            {
                $this->session->set_flashdata('error', 'Código de cátedra inexistente');
                redirect('catedras/lista_catedras');
            }
      try {
                            $this->estudiantes_model->eliminar_alumno_catedra($lu_alu, $cod_cat);
                            //$examen['cod_cat_exam'] = $cod_cat_exam;
                            $this->util->json_response(TRUE,STATUS_OK,$lu_alu, $cod_cat); //no mandar el JSON tal cual la BD por seguridad??


          } catch (Exception $e) {
              switch ($e->getMessage()) {
                  //     case ERROR_REPETIDO:
                  //     //$ld = $e->getCode();
                  //     $error['error_msj'] = "El catedra con ese legajo {$leg} ya ha sido guardado en la base de datos ";
                  //    //$error['leg_doc'] = $ld;
                  //     $this->util->json_response(FALSE,STATUS_REPEATED_POST,$error);
                  //     break;
                  // case ERROR_FALTA_ITEM:
                  //     $error['error_msj'] = "Falta(n) item(s) de la guia. El catedra no fue guardado en la base de datos";
                  //     $this->util->json_response(FALSE,STATUS_INVALID_PARAM,$error);
                  //     break;
                  // case ERROR_NO_INSERT_EXAM:
                  //     $error['error_msj'] = "El catedra no pudo ser archivado en la base de datos";
                  //     $this->util->json_response(FALSE,STATUS_NO_INSERT,$error);
                  //     break;
                  default:
                      $error['error_msj'] = "El catedra no fue eliminado de la base de datos";
                      $this->util->json_response(FALSE,STATUS_UNKNOWN_ERROR,$error);
                      break;
              }
          }

           redirect('catedras/estudiantes_catedra/'.$cod_cat);
            
    }

/**
     * Controlador de la pagina de agregar docentes a una catedra
     *  
     * 
     * 
     * @access  public
     */
         public function docentes_catedra($cod_cat)
    {
        

        $catedra = $this->catedras_model->get_catedra($cod_cat);
        
        if(!$catedra)   //chequea que $id esté y sea sólo numeros
            {
                $this->session->set_flashdata('error', 'Código de catedra inexistente');
                redirect('catedras/lista_catedras');
            }
        $this->view_data['catedra'] = $catedra;

        // PARTE 1 MUESTRA SELECT DE DOCENTES PARA LA CÁTEDRA

        $docentes = $this->_docentesNoCatedra($cod_cat);
       
        
                        if(count($docentes)>0)  //si no hay guias no manda datos a la view
                        {
                            $this->view_data['docentes']['list'] = $docentes;  //en la view: $docentes['list'][indice]['leg_doc'].
                            $index_docente = NO_SELECTED; //Por defecto, no seleccionado

                            //Busco en post si hay guia seleccionada por default, y actualiza el index seleccionado de la lista
                            $leg_doc_default = $this->input->post('docente') ;
                            if($leg_doc_default) 
                            {
                                $index_docente = $this->util->buscar_indice($docentes,'leg_doc',$leg_doc_default);
                            }
                            $this->view_data['docentes']['selected'] = $index_docente;

                        } //hay docentes

        // PARTE 2 MUESTRA TABLA DE DOCENTES DE LA CÁTEDRA
        $this->load->model('catedras_model');
        $doc_cat = $this->catedras_model->get_docentes_catedra($cod_cat);

        $this->load->library('table');
        
        $this->table->set_heading('Nro Libreta', 'Apellido', 'Nombre', 'Dni','Acción', 'Eliminar');
        foreach ($doc_cat as $doc) {   
            $this->table->add_row($doc['leg_doc'], 
                                  $doc['apellido_doc'], 
                                  $doc['nom_doc'], 
                                  $doc['dni_doc'], 
                                  " ",
                                  site_url('catedras/eliminar_doc_cat/'.$doc['leg_doc'].'/'.$cod_cat)
                                  );
        }
        $template= array ('table_open'  => '<table id="lista_doc_cat" class="table table-striped table-bordered  table-condensed" cellspacing="5" width="100%">');
        $this->table->set_template($template);
        $tabla= $this->table->generate();
        // return $tabla;
        $this->view_data['tabla'] = $tabla;

        $this->view_data['title'] = "Administrar catedras  - Departamento de Ciencias de la Salud";          
        $this->load->view('template/header', $this->view_data);

        $this->usuario->set_actividad_actual('nueva_catedra');

        //Mensaje de error: flashdata en la sesion
        $error = $this->session->flashdata('error');
        if($error)
            $this->view_data['error'] = $error;
        
        $this->view_data['docente'] = $this->nom_doc." ".$this->apellido_doc;
        $this->view_data['privilegio_user'] =  $this->privilegio;
        $this->view_data['modificar'] = true;
        $this->load->view('content/docentes_catedra/docentes_catedra', $this->view_data);

        $this->load->view('template/footer');
    }


    /**
     * Vincula
     *
     * @access  public
     */
     public function agregar_doc_cat($cod_cat)
     {

      // $cat = $this->catedras_model->get_catedra($cod_cat);
      // $cod_cat = $this->input->post('catedra');
      // @param   $doc int doc referencia al lU del docente
      $leg_doc = $this->input->post('docente');
      $docente = $this->catedras_model->vincular_docente_catedra($leg_doc, $cod_cat);
        if(!$leg_doc || $leg_doc==NO_SELECTED)
        {
            $this->session->set_flashdata('error', 'Estudiante inválido');
            redirect('catedras/docentes_catedra');
        }

                // $catedra = $this->catedras_model->get_catedra($cod_cat);

        // $this->load->view('content/docentes_catedra/docentes_catedra', $cod_cat);
        // $this->load->view('content/docentes_catedra/docentes_catedra', $this->view_data);

        // site_url('catedras/docentes_catedra/'.$catedra['cod_cat']),
                   redirect('catedras/docentes_catedra/'.$cod_cat);
   


          //        try {
          //                   $this->catedras_model->vincular_docente_catedra($leg_doc, $cod_cat);
          //                   $this->util->json_response(TRUE,STATUS_OK);

          // } catch (Exception $e) {
          //     switch ($e->getMessage()) {
          //             case ERROR_REPETIDO:
          //             //$ld = $e->getCode();
          //             $error['error_msj'] = "La cátedra con el código {$cod} ya ha sido guardado en la base de datos ";
          //            //$error['leg_doc'] = $ld;
          //             $this->util->json_response(FALSE,STATUS_REPEATED_POST,$error);
          //             break;
          //         case ERROR_FALTA_ITEM:
          //             $error['error_msj'] = "Falta(n) item(s) de la guia. La cátedra no fue guardado en la base de datos";
          //             $this->util->json_response(FALSE,STATUS_INVALID_PARAM,$error);
          //             break;
          //         case ERROR_NO_INSERT_EXAM:
          //             $error['error_msj'] = "La cátedra no pudo ser archivado en la base de datos";
          //             $this->util->json_response(FALSE,STATUS_NO_INSERT,$error);
          //             break;
          //         default:
          //             $error['error_msj'] = "La cátedra no fue guardado en la base de datos";
          //             $this->util->json_response(FALSE,STATUS_UNKNOWN_ERROR,$error);
          //             break;
          //     }
          // } 

          //  $this->view_data['modificar'] = FALSE;
          // redirect('catedras/docentes_catedra');   
    }

     /**
     * Controlador de la acción eliminar un catedra
     *  
     * En GET (parametro) se recibe solo el id de la catedra
     *
     *
     * 
     * @access  public
     * @param   $id int id leg_doc de catedra
     */
    public function eliminar_doc_cat($leg_doc, $cod_cat)
    {

        if(!$leg_doc)   //chequea que $id esté y sea sólo numeros
            {
                $this->session->set_flashdata('error', 'Lu de Estudiante inexistente');
                redirect('catedras/lista_catedras');
            }
      if(!$cod_cat)   //chequea que $id esté y sea sólo numeros
            {
                $this->session->set_flashdata('error', 'Código de cátedra inexistente');
                redirect('catedras/lista_catedras');
            }
      try {
                            $this->catedras_model->eliminar_docente_catedra($leg_doc, $cod_cat);
                            //$examen['cod_cat_exam'] = $cod_cat_exam;
                            $this->util->json_response(TRUE,STATUS_OK,$leg_doc, $cod_cat); //no mandar el JSON tal cual la BD por seguridad??


          } catch (Exception $e) {
              switch ($e->getMessage()) {
                  //     case ERROR_REPETIDO:
                  //     //$ld = $e->getCode();
                  //     $error['error_msj'] = "El catedra con ese legajo {$leg} ya ha sido guardado en la base de datos ";
                  //    //$error['leg_doc'] = $ld;
                  //     $this->util->json_response(FALSE,STATUS_REPEATED_POST,$error);
                  //     break;
                  // case ERROR_FALTA_ITEM:
                  //     $error['error_msj'] = "Falta(n) item(s) de la guia. El catedra no fue guardado en la base de datos";
                  //     $this->util->json_response(FALSE,STATUS_INVALID_PARAM,$error);
                  //     break;
                  // case ERROR_NO_INSERT_EXAM:
                  //     $error['error_msj'] = "El catedra no pudo ser archivado en la base de datos";
                  //     $this->util->json_response(FALSE,STATUS_NO_INSERT,$error);
                  //     break;
                  default:
                      $error['error_msj'] = "El catedra no fue eliminado de la base de datos";
                      $this->util->json_response(FALSE,STATUS_UNKNOWN_ERROR,$error);
                      break;
              }
          }

           redirect('catedras/docentes_catedra/'.$cod_cat);
            
    }

}

