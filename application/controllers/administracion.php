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

class Administracion extends CI_Controller {

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

            $this->load->model(array('docentes_model'));
                
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
    public function admin()
    {
        
        $this->view_data['title'] = "Administracion  - Departamento de Ciencias de la Salud";          
        $this->load->view('template/header', $this->view_data);

        $this->view_data['docente'] = $this->nom_doc." ".$this->apellido_doc;
        $this->view_data['privilegio_user'] =  $this->privilegio;
        $this->load->view('content/administracion/admin', $this->view_data);

        $this->load->view('template/footer');
    }

      /**
     * Controlador para la pagina para ingresar nuevos usuarios al sistema
     *  
     * En POST recibe los filtros para la lista //TODO
     *
     * Carga vista de la lista de examenes
     * 
     * @access  public
     */
    public function usuarios()
    {
       

       
        //Mensaje de error: flashdata en la sesion
        $error = $this->session->flashdata('error');
        if($error)
            $this->view_data['error'] = $error;
        
        //FECHA ACTUAL
        $this->view_data['fecha'] = date('d/m/Y'); 

       
        $this->view_data['docente'] = $this->nom_doc." ".$this->apellido_doc;
       // $this->view_data['nuevo'] = true;

       $tabla= $this->mostrar_tabla_usuarios();
       
        //$this->view_data['crud'] = $output;
        //$this->view_data['arreglo'] = $usuarios;
        $this->view_data['tabla'] = $tabla;
        //$this->view_data['docente'] = $this->nom_doc." ".$this->apellido_doc;
      //  $this->view_data['mostrar'] = true;
        //-------------------------------------------------------------------

        // $this->nuevo_usuario();
        // $this->lista_usuarios();
         $this->view_data['title'] = "Administrar Usuarios  - Departamento de Ciencias de la Salud";          
        $this->load->view('template/header', $this->view_data);

        $this->usuario->set_actividad_actual('administrar_usuarios');

        $this->view_data['privilegio_user'] =  $this->privilegio;
        $this->load->view('content/administracion/lista_usuarios', $this->view_data);

        $this->load->view('template/footer');
    }

    public function nuevo_usuario(){



       $this->view_data['title'] = "Administrar Usuarios  - Departamento de Ciencias de la Salud";          
        $this->load->view('template/header', $this->view_data);

        $this->usuario->set_actividad_actual('nuevo_usuario');

        //Mensaje de error: flashdata en la sesion
        $error = $this->session->flashdata('error');
        if($error)
            $this->view_data['error'] = $error;
        
        $this->view_data['docente'] = $this->nom_doc." ".$this->apellido_doc;
        $this->view_data['privilegio_user'] =  $this->privilegio;
        $this->view_data['nuevo'] = true;
        $this->load->view('content/administracion/nuevo_usuario', $this->view_data);

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
    public function nuevo()
    {
        if(!$this->input->post()) 
        {
            $this->session->set_flashdata('error', 'Acceso inválido a la creación de un nuevo usuario');
            redirect('administracion/usuarios');
        }

        $this->load->library('form_validation');
        $this->form_validation->set_rules('legajo', 'Legajo', 'trim|required|integer');
        $this->form_validation->set_rules('pass', 'Contraseña', 'trim|required|min_length[8]|matches[passconf]|md5');
        $this->form_validation->set_rules('passconf', 'Confirmar Contraseña', 'trim|required|min_length[8]');
        $this->form_validation->set_rules('apellido', 'Apellido', 'required');
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('dni', 'Dni', 'integer');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('tel', 'Telefono', 'required');
        $this->form_validation->set_rules('privilegio', 'Privilegio', 'required');

      // if($this->form_validation->run() == TRUE){
       if (!$this->form_validation->run())  //si no verifica inputs
        {
            $this->session->set_flashdata('error', validation_errors());
            redirect('administracion/nuevo_usuario');
        }

        $leg = $this->input->post('legajo'); 
        $pass = $this->input->post('pass');
        $apellido = $this->input->post('apellido');
        $nom = $this->input->post('nombre');
        $dni = $this->input->post('dni');
        $email = $this->input->post('email');
        $tel = $this->input->post('tel');

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
                            $docente_nuevo = $this->docentes_model->guardar_docente($leg,$pass, $apellido,$nom,$dni,$email,$tel,$priv);
                            //$examen['id_exam'] = $id_exam;
                            $this->util->json_response(TRUE,STATUS_OK,$docente_nuevo); //no mandar el JSON tal cual la BD por seguridad??


          } catch (Exception $e) {
              switch ($e->getMessage()) {
                      case ERROR_REPETIDO:
                      //$ld = $e->getCode();
                      $error['error_msj'] = "El usuario con ese legajo {$leg} ya ha sido guardado en la base de datos ";
                     //$error['leg_doc'] = $ld;
                      $this->util->json_response(FALSE,STATUS_REPEATED_POST,$error);
                      break;
                  case ERROR_FALTA_ITEM:
                      $error['error_msj'] = "Falta(n) item(s) de la guia. El usuario no fue guardado en la base de datos";
                      $this->util->json_response(FALSE,STATUS_INVALID_PARAM,$error);
                      break;
                  case ERROR_NO_INSERT_EXAM:
                      $error['error_msj'] = "El usuario no pudo ser archivado en la base de datos";
                      $this->util->json_response(FALSE,STATUS_NO_INSERT,$error);
                      break;
                  default:
                      $error['error_msj'] = "El usuario no fue guardado en la base de datos";
                      $this->util->json_response(FALSE,STATUS_UNKNOWN_ERROR,$error);
                      break;
              }
          } 

      
          redirect('administracion/usuarios');
      
    }

private function mostrar_tabla_usuarios(){
       $this->load->model('docentes_model');

        $usuarios = $this->docentes_model->get_usuarios();
        //usar date helper

        $this->load->library('table');
        
        $this->table->set_heading('Legajo', 'Apellido', 'Nombre', 'Dni','Email','Telefono','Privilegio', 'Acción','Modificar', 'Contraseña','Eliminar');
        foreach ($usuarios as $user) {
            switch ($user['privilegio']) {
              case PRIVILEGIO_DOCENTE:
                $priv_nombre = "Docente";
                break;
              case PRIVILEGIO_ADMIN:
                $priv_nombre = "Administrador";
                break;
              case PRIVILEGIO_SUPERADMIN:
                $priv_nombre = "Super Administrador";
                break;
              default:
                $priv_nombre = "Docente";
                break;
            }
            $this->table->add_row($user['leg_doc'], 
                                  $user['apellido_doc'], 
                                  $user['nom_doc'], 
                                  $user['dni_doc'], 
                                  $user['email_doc'],
                                  $user['tel_doc'],
                                  $priv_nombre,
                                  " ",
                                  // "<a class='btn btn-danger btn-xs' 
                                  //     href=".site_url('administracion/eliminar_usuario/'.$user['leg_doc'])." >
                                  //     <span class='glyphicon glyphicon-trash' aria-hidden='true'></span>
                                  //  </a> <a class='btn btn-warning btn-xs' 
                                  //     href=".site_url('administracion/modificar_usuario/'.$user['leg_doc'])." >
                                  //     <span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>
                                  //   </a>");
                                  site_url('administracion/modificar_usuario/'.$user['leg_doc']),
                                  site_url('administracion/modificarC_usuario/'.$user['leg_doc']),
                                  site_url('administracion/eliminar_usuario/'.$user['leg_doc'])
                                  );


        }
        $template= array ('table_open'  => '<table id="lista_usuarios" class="table table-striped table-bordered  table-condensed" cellspacing="5" width="100%">');
        $this->table->set_template($template);
        $tabla= $this->table->generate();
        return $tabla;

    }

     /**
     * Controlador de la accion eliminar un usuario
     *  
     * En GET (parametro) se recibe solo el id del usuario
     *
     *
     * 
     * @access  public
     * @param   $id int id leg_doc del usuario
     */
    public function eliminar_usuario($id)
    {
      try {
                            $this->docentes_model->eliminar_docente($id);
                            //$examen['id_exam'] = $id_exam;
                            $this->util->json_response(TRUE,STATUS_OK,$id); //no mandar el JSON tal cual la BD por seguridad??


          } catch (Exception $e) {
              switch ($e->getMessage()) {
                  //     case ERROR_REPETIDO:
                  //     //$ld = $e->getCode();
                  //     $error['error_msj'] = "El usuario con ese legajo {$leg} ya ha sido guardado en la base de datos ";
                  //    //$error['leg_doc'] = $ld;
                  //     $this->util->json_response(FALSE,STATUS_REPEATED_POST,$error);
                  //     break;
                  // case ERROR_FALTA_ITEM:
                  //     $error['error_msj'] = "Falta(n) item(s) de la guia. El usuario no fue guardado en la base de datos";
                  //     $this->util->json_response(FALSE,STATUS_INVALID_PARAM,$error);
                  //     break;
                  // case ERROR_NO_INSERT_EXAM:
                  //     $error['error_msj'] = "El usuario no pudo ser archivado en la base de datos";
                  //     $this->util->json_response(FALSE,STATUS_NO_INSERT,$error);
                  //     break;
                  default:
                      $error['error_msj'] = "El usuario no fue eliminado de la base de datos";
                      $this->util->json_response(FALSE,STATUS_UNKNOWN_ERROR,$error);
                      break;
              }
          }

           redirect('administracion/usuarios');
            
    }

    /**
     * Controlador de la accion de modificar un usuario
     *  
     * En GET (parametro) se recibe solo el id del usuario
     *
     *
     * 
     * @access  public
     * @param   $id int leg_doc del usuario
     */
    public function modificar_usuario($id)
    {
          $usuario = $this->docentes_model->get_docente($id);
                          //$this->util->json_response(TRUE,STATUS_OK,$id); //no mandar el JSON tal cual la BD por seguridad??
                          
           if(!$usuario)   //chequea que $id esté y sea sólo numeros
            {
                $this->session->set_flashdata('error', 'Leg de docente inexistente');
                redirect('administracion/usuarios');
            }

          $this->view_data['usuario'] = $usuario;
          
          $this->view_data['title'] = "Administrar Usuarios  - Departamento de Ciencias de la Salud";          
        $this->load->view('template/header', $this->view_data);

        $this->usuario->set_actividad_actual('nuevo_usuario');

        //Mensaje de error: flashdata en la sesion
        $error = $this->session->flashdata('error');
        if($error)
            $this->view_data['error'] = $error;
        
        $this->view_data['docente'] = $this->nom_doc." ".$this->apellido_doc;
        $this->view_data['privilegio_user'] =  $this->privilegio;
        $this->view_data['modificar'] = true;
        $this->load->view('content/administracion/modificar_usuario', $this->view_data);

        $this->load->view('template/footer');
    }
    /**
     * Controlador de la accion de modificar un usuario
     *  
     * En GET (parametro) se recibe solo el id del usuario
     *
     *
     * 
     * @access  public
     * @param   $id int leg_doc del usuario
     */
    public function modificarC_usuario($id)
    {
          $usuario = $this->docentes_model->get_docente($id);
                          //$this->util->json_response(TRUE,STATUS_OK,$id); //no mandar el JSON tal cual la BD por seguridad??
                          
           if(!$usuario)   //chequea que $id esté y sea sólo numeros
            {
                $this->session->set_flashdata('error', 'Leg de docente inexistente');
                redirect('administracion/usuarios');
            }

          $this->view_data['usuario'] = $usuario;
          
          $this->view_data['title'] = "Administrar Usuarios  - Departamento de Ciencias de la Salud";          
        $this->load->view('template/header', $this->view_data);

        $this->usuario->set_actividad_actual('nuevo_usuario');

        //Mensaje de error: flashdata en la sesion
        $error = $this->session->flashdata('error');
        if($error)
            $this->view_data['error'] = $error;
        
        $this->view_data['docente'] = $this->nom_doc." ".$this->apellido_doc;
        $this->view_data['privilegio_user'] =  $this->privilegio;
        $this->view_data['modificar'] = true;
        $this->load->view('content/administracion/modificarC_usuario', $this->view_data);

        $this->load->view('template/footer');
    }
    /**
     * Controlador de la pagina de modificar un  usuario
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
            $this->session->set_flashdata('error', 'Acceso inválido a la modificación del usuario');
            redirect('administracion/usuarios');
        }

        $this->load->library('form_validation');
        // $this->form_validation->set_rules('legajo', 'Legajo', 'trim|integer');
        // $this->form_validation->set_rules('pass', 'Contraseña', 'trim|required|matches[passconf]|md5');
        // $this->form_validation->set_rules('passconf', 'Confirmar Contraseña', 'trim|required');
        $this->form_validation->set_rules('apellido', 'Apellido', 'required');
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('dni', 'Dni', 'required');
        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email');
        $this->form_validation->set_rules('tel', 'Telefono', 'required');
        $this->form_validation->set_rules('privilegio', 'Privilegio', 'required');

      // if($this->form_validation->run() == TRUE){
       if (!$this->form_validation->run())  //si no verifica inputs
        {
            $this->session->set_flashdata('error', validation_errors());
            redirect('administracion/usuarios');
        }

        // $leg = $this->input->post('legajo'); 
        // $pass = $this->input->post('pass');
        $apellido = $this->input->post('apellido');
        $nom = $this->input->post('nombre');
        $dni = $this->input->post('dni');
        $email = $this->input->post('email');
        $tel = $this->input->post('tel');

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
                         // $docente_act = 
                            $this->docentes_model->actualizar_docente($id,$apellido,$nom,$dni,$email,$tel,$priv);
                            //$examen['id_exam'] = $id_exam;
                            // $this->util->json_response(TRUE,STATUS_OK,$docente_act); //no mandar el JSON tal cual la BD por seguridad??
                              $this->util->json_response(TRUE,STATUS_OK);

          } catch (Exception $e) {
              switch ($e->getMessage()) {
                      case ERROR_REPETIDO:
                      //$ld = $e->getCode();
                      $error['error_msj'] = "El usuario con ese legajo {$id} ya ha sido guardado en la base de datos ";
                     //$error['leg_doc'] = $ld;
                      $this->util->json_response(FALSE,STATUS_REPEATED_POST,$error);
                      break;
                  // case ERROR_FALTA_ITEM:
                  //     $error['error_msj'] = "Falta(n) item(s) de la guia. El usuario no fue guardado en la base de datos";
                  //     $this->util->json_response(FALSE,STATUS_INVALID_PARAM,$error);
                  //     break;
                  // case ERROR_NO_INSERT_EXAM:
                  //     $error['error_msj'] = "El usuario no pudo ser archivado en la base de datos";
                  //     $this->util->json_response(FALSE,STATUS_NO_INSERT,$error);
                  //     break;
                   default:
                      $error['error_msj'] = "El usuario no fue guardado en la base de datos";
                      $this->util->json_response(FALSE,STATUS_UNKNOWN_ERROR,$error);
                      break;
              }
          } 

      
        // $this->view_data['title'] = "Administrar Usuarios  - Departamento de Ciencias de la Salud";          
        // $this->load->view('template/header', $this->view_data);

        // $this->usuario->set_actividad_actual('lista_usuario');

        // //Mensaje de error: flashdata en la sesion
        // $error = $this->session->flashdata('error');
        // if($error)
        //     $this->view_data['error'] = $error;
        
        // $this->view_data['docente'] = $this->nom_doc." ".$this->apellido_doc;
        // $this->view_data['privilegio_user'] =  $this->privilegio;
        // $this->view_data['nuevo'] = true;
        // $this->load->view('content/administracion/lista_usuarios', $this->view_data);

        // $this->load->view('template/footer');
           $this->view_data['modificar'] = FALSE;
          redirect('administracion/usuarios');
      
    }

    /**
     * Controlador de la pagina de modificar contraseña de un usuario
     *  
     * En POST se reciben las opciones seleccionadas:
     * 
     * 
     * @access  public
     */
    public function actualizarC($id)
    {
        if(!$this->input->post()) 
        {
            $this->session->set_flashdata('error', 'Acceso inválido a la modificación del usuario');
            redirect('administracion/usuarios');
        }

        $this->load->library('form_validation');
         $this->form_validation->set_rules('pass', 'Contraseña', 'trim|required|min_length[8]|matches[passconf]|md5');
         $this->form_validation->set_rules('passconf', 'Confirmar Contraseña', 'trim|required|min_length[8]');

      // if($this->form_validation->run() == TRUE){
       if (!$this->form_validation->run())  //si no verifica inputs
        {
            $this->session->set_flashdata('error', validation_errors());
            redirect('administracion/usuarios');
        }

        // $leg = $this->input->post('legajo'); 
        $pass = $this->input->post('pass');
        
         try {
                         // $docente_act = 
                            $this->docentes_model->actualizarC_docente($id,$pass);
                            //$examen['id_exam'] = $id_exam;
                            // $this->util->json_response(TRUE,STATUS_OK,$docente_act); //no mandar el JSON tal cual la BD por seguridad??
                              $this->util->json_response(TRUE,STATUS_OK);

          } catch (Exception $e) {
              switch ($e->getMessage()) {
                      case ERROR_REPETIDO:
                      //$ld = $e->getCode();
                      $error['error_msj'] = "El usuario con ese legajo {$id} ya ha sido guardado en la base de datos ";
                     //$error['leg_doc'] = $ld;
                      $this->util->json_response(FALSE,STATUS_REPEATED_POST,$error);
                      break;
                  // case ERROR_FALTA_ITEM:
                  //     $error['error_msj'] = "Falta(n) item(s) de la guia. El usuario no fue guardado en la base de datos";
                  //     $this->util->json_response(FALSE,STATUS_INVALID_PARAM,$error);
                  //     break;
                  // case ERROR_NO_INSERT_EXAM:
                  //     $error['error_msj'] = "El usuario no pudo ser archivado en la base de datos";
                  //     $this->util->json_response(FALSE,STATUS_NO_INSERT,$error);
                  //     break;
                   default:
                      $error['error_msj'] = "El usuario no fue guardado en la base de datos";
                      $this->util->json_response(FALSE,STATUS_UNKNOWN_ERROR,$error);
                      break;
              }
          } 

      
        // $this->view_data['title'] = "Administrar Usuarios  - Departamento de Ciencias de la Salud";          
        // $this->load->view('template/header', $this->view_data);

        // $this->usuario->set_actividad_actual('lista_usuario');

        // //Mensaje de error: flashdata en la sesion
        // $error = $this->session->flashdata('error');
        // if($error)
        //     $this->view_data['error'] = $error;
        
        // $this->view_data['docente'] = $this->nom_doc." ".$this->apellido_doc;
        // $this->view_data['privilegio_user'] =  $this->privilegio;
        // $this->view_data['nuevo'] = true;
        // $this->load->view('content/administracion/lista_usuarios', $this->view_data);

        // $this->load->view('template/footer');
           $this->view_data['modificar'] = FALSE;
          redirect('administracion/usuarios');
      
    }

  }