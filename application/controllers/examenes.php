<?php 

/**
 * Controlador Examenes. Encargado de la vista y administración de los examenes archivados
 *
 *@package      controllers
 *@author       Fernando Andrés Prieto
 *@author       Diego Martín Schwindt
 *@copyright    Mayo, 2014 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Examenes extends CI_Controller {

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

            $this->load->model(array('examenes_model'));
                
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
     * Controlador para listar todos los exámenes evaluados por el usuario
     *  
     * En POST recibe los filtros para la lista //TODO
     *
     * Carga vista de la lista de examenes
     * 
     * @access  public
     */
    public function lista_docente()
    {
        /*
        GROCERY CRUD
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('examenes');
        //$crud->set_theme('twitter-bootstrap');
        $crud->set_theme('datatables');
        $output = $crud->render();
        */

        $this->load->model('examenes_model');

        $examenes = $this->examenes_model->get_examenes_docente($this->legajo);
        //usar date helper

        $this->load->library('table');
        
        $this->table->set_heading('Fecha', 'Estudiante', 'Guía', 'Cátedra','Calificación','Link','PDF');
        foreach ($examenes as $exam) {
            $fecha_hora = explode(" ", $exam['fecha']);
            $fecha = $this->util->YMDtoDMY($fecha_hora[0])." ".$fecha_hora[1];
            $this->table->add_row($fecha,$exam['apellido_alu'].", ".$exam['nom_alu']." (LU: ".$exam['lu_alu'].")",
                                ") ".$exam['tit_guia'],$exam['nom_cat']." (".$exam['cod_cat'].")",
                                $exam['calificacion'],site_url('examen/ver/'.$exam['id_exam']),site_url('examen/pdf/'.$exam['id_exam']));
        }
        // sprintf('%02u',$exam['nro_guia']).
        $template= array ('table_open'  => '<table id="lista_examenes" class="display" cellspacing="0" width="100%">');
        $this->table->set_template($template);
        $tabla= $this->table->generate();

        $this->view_data['title'] = "Lista de Examen Evaluados por ".$this->nom_doc." ".$this->apellido_doc." - Departamento de Ciencias de la Salud";          
        $this->load->view('template/header', $this->view_data);

        //$this->view_data['crud'] = $output;
        $this->view_data['arreglo'] = $examenes;
        $this->view_data['tabla'] = $tabla;
        $this->view_data['docente'] = $this->nom_doc." ".$this->apellido_doc;
        $this->load->view('content/examenes/lista_docente', $this->view_data);

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
    public function admin()
    {
        /*
        GROCERY CRUD
        $this->load->library('grocery_CRUD');
        $crud = new grocery_CRUD();

        $crud->set_table('examenes');
        //$crud->set_theme('twitter-bootstrap');
        $crud->set_theme('datatables');
        $output = $crud->render();
        */

        $this->load->model('examenes_model');

        $examenes = $this->examenes_model->get_examenes_docente($this->legajo);
        //usar date helper

        $this->load->library('table');
        
        $this->table->set_heading('Fecha', 'Estudiante', 'Guía', 'Cátedra','Calificación','Link','PDF');
        foreach ($examenes as $exam) {
            $fecha_hora = explode(" ", $exam['fecha']);
            $fecha = $this->util->YMDtoDMY($fecha_hora[0])." ".$fecha_hora[1];
            $this->table->add_row($fecha,$exam['apellido_alu'].", ".$exam['nom_alu']." (LU: ".$exam['lu_alu'].")",
                                ") ".$exam['tit_guia'],$exam['nom_cat']." (".$exam['cod_cat'].")",
                                $exam['calificacion'],site_url('examen/ver/'.$exam['id_exam']),site_url('examen/pdf/'.$exam['id_exam']));
        }
        // sprintf('%02u',$exam['nro_guia']).
        $template= array ('table_open'  => '<table id="lista_examenes" class="display" cellspacing="0" width="100%">');
        $this->table->set_template($template);
        $tabla= $this->table->generate();

        $this->view_data['title'] = "Lista de Examen Evaluados por ".$this->nom_doc." ".$this->apellido_doc." - Departamento de Ciencias de la Salud";          
        $this->load->view('template/header', $this->view_data);

        //$this->view_data['crud'] = $output;
        $this->view_data['arreglo'] = $examenes;
        $this->view_data['tabla'] = $tabla;
        $this->view_data['docente'] = $this->nom_doc." ".$this->apellido_doc;
        $this->load->view('content/examenes/lista_docente', $this->view_data);

        $this->load->view('template/footer');
    }

}

