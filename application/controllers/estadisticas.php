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

            $this->load->model(array('catedras_model','estudiantes_model','docentes_model', 'guias_model'));
            
                
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

            $estudiantes = $this->_estudiantes();
        
            if(count($estudiantes)>0)  //si no hay guias no manda datos a la view
            {
                $this->view_data['estudiantes']['list'] = $estudiantes;  //en la view: $estudiantes['list'][indice]['lu_alu'].
            }                
           $this->view_data['title'] = "Estadísticas Estudiantes  - Departamento de Ciencias de la Salud"; 
            $this->load->view('template/header', $this->view_data);
 
           $this->view_data['mostrar'] = 1;
           $this->load->view('content/estadisticas/estadisticas_view', $this->view_data);  
        }
        else {
            $guias = $this->_guias();
        
            if(count($guias)>0)  //si no hay guias no manda datos a la view
            {
                $this->view_data['guias']['list'] = $guias;  //en la view: $estudiantes['list'][indice]['lu_alu'].
            }  
            $this->view_data['title'] = "Estadísticas Guías  - Departamento de Ciencias de la Salud"; 
             $this->load->view('template/header', $this->view_data);
 
            $this->view_data['mostrar'] = 2;
           $this->load->view('content/estadisticas/estadisticas_view', $this->view_data); 
        }
               
        $this->load->view('template/footer');
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

     /**
     * Devuelve el alumno
     *
     * @access  private
     * @return  alumno
     */
    function _alumno($lu) 
    {
        // if($this->privilegio>=PRIVILEGIO_ADMIN)  //si es admin muestra todas las estudiantes
        $alumno = $this->estudiantes_model->get_alumno($lu);
        // else
        //     $estudiantes = $this->estudiantes_model->get_estudiantes_docente($this->legajo);
        return $alumno;
    }

    /**
     * Devuelve arreglo con los estudiantes
     *
     * @access  private
     * @return  array  - lista de estudiantes
     */
    function _guias() 
    {
        // if($this->privilegio>=PRIVILEGIO_ADMIN)  //si es admin muestra todas las estudiantes
        $guias = $this->guias_model->get_guias();
        // else
        //     $estudiantes = $this->estudiantes_model->get_estudiantes_docente($this->legajo);
        return $guias;
    }


function mostrar_examenes_alu($lu){

     $this->view_data['docente'] = $this->nom_doc." ".$this->apellido_doc;
        $this->view_data['privilegio_user'] =  $this->privilegio;

          $this->view_data['lu'] = $lu;  //en la view: $estudiantes['list'][indice]['lu_alu'].

          $alum = $this->_alumno($lu);
          $this->view_data['apellido'] = $alum['apellido_alu'];
          $this->view_data['nombre'] = $alum['nom_alu'];
                          
           $this->view_data['title'] = "Exámenes estudiante - Departamento de Ciencias de la Salud"; 
            $this->load->view('template/header', $this->view_data);

            $guias_est = $this->_guias_estudiante($lu);
            if(count($guias_est)>0)  //si no hay guias no manda datos a la view
            {
                $this->view_data['guias_est']['list'] = $guias_est;  //en la view: $estudiantes['list'][indice]['lu_alu'].
            } 

           // $this->view_data['mostrar'] = 1;
           $this->load->view('content/estadisticas/estadisticas_estudiante', $this->view_data);
            $this->load->view('template/footer');

}

/**
     * Devuelve arreglo con los estudiantes
     *
     * @access  private
     * @return  array  - lista de estudiantes
     */
    function _guias_estudiante($lu) 
    {
        // if($this->privilegio>=PRIVILEGIO_ADMIN)  //si es admin muestra todas las estudiantes
        $guias_est = $this->estudiantes_model->get_examenes_alumno($lu);
        // else
        //     $estudiantes = $this->estudiantes_model->get_estudiantes_docente($this->legajo);
        return $guias_est;
    }




}





    ?>