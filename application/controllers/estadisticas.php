<?php 

/**
 * Controlador Estadisticas
 *
 *@package      controllers
 *@author       Cardoso Virginia
 *@author       Marzullo Matias
 *@copyright    Noviembre, 2015 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Estadisticas extends CI_Controller {

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

            $this->load->model(array('catedras_model','alumnos_model','docentes_model'));
            
                
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
    public function menu()
    {
        
        $this->view_data['title'] = "Estadísticas  - Departamento de Ciencias de la Salud";          
        $this->load->view('template/header', $this->view_data);

        $this->view_data['docente'] = $this->nom_doc." ".$this->apellido_doc;
        $this->view_data['privilegio_user'] =  $this->privilegio;
        $this->load->view('content/estadisticas/menu_estadisticas', $this->view_data);

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
    public function estadisticas_view($opc) {   
       
        $this->view_data['docente'] = $this->nom_doc." ".$this->apellido_doc;
        $this->view_data['privilegio_user'] =  $this->privilegio;

        if ($opc==1){

            $alumnos = $this->_alumnos();
        
            if(count($alumnos)>0)  //si no hay guias no manda datos a la view
            {
                $this->view_data['alumnos']['list'] = $alumnos;  //en la view: $alumnos['list'][indice]['lu_alu'].
            }                
           $this->view_data['title'] = "Estadísticas Estudiantes  - Departamento de Ciencias de la Salud"; 
            $this->load->view('template/header', $this->view_data);
 
           $this->view_data['mostrar'] = 1;
           $this->load->view('content/estadisticas/estadisticas_view', $this->view_data);  
        }
        else {
            $catedras = $this->_catedras();
        
            if(count($catedras)>0)  //si no hay guias no manda datos a la view
            {
                $this->view_data['catedras']['list'] = $catedras;  //en la view: $alumnos['list'][indice]['lu_alu'].
            }  
            $this->view_data['title'] = "Estadísticas Cátedras  - Departamento de Ciencias de la Salud"; 
             $this->load->view('template/header', $this->view_data);
 
            $this->view_data['mostrar'] = 2;
           $this->load->view('content/estadisticas/estadisticas_view', $this->view_data); 
        }
               
        $this->load->view('template/footer');
    }

     /**
     * Devuelve arreglo con los alumnos
     *
     * @access  private
     * @return  array  - lista de alumnos
     */
    function _alumnos() 
    {
        // if($this->privilegio>=PRIVILEGIO_ADMIN)  //si es admin muestra todas las alumnos
        $alumnos = $this->alumnos_model->get_alumnos();
        // else
        //     $alumnos = $this->alumnos_model->get_alumnos_docente($this->legajo);
        return $alumnos;
    }

    /**
     * Devuelve arreglo con los alumnos
     *
     * @access  private
     * @return  array  - lista de alumnos
     */
    function _catedras() 
    {
        // if($this->privilegio>=PRIVILEGIO_ADMIN)  //si es admin muestra todas las alumnos
        $catedras = $this->catedras_model->get_catedras();
        // else
        //     $alumnos = $this->alumnos_model->get_alumnos_docente($this->legajo);
        return $catedras;
    }











}





    ?>