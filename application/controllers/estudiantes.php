<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Estudiantes extends CI_Controller {

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

           $this->load->model('estudiantes_model','estudiantes');
                
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
 
    public function index()
    {
        // $this->load->helper('url');
        // $this->load->view('content/estudiantes/estudiantes_view');
         $this->load->helper('url');


       $this->view_data['title'] = "Administrar Estudiantes  - Departamento de Ciencias de la Salud";          
        $this->load->view('template/header', $this->view_data);

        $this->usuario->set_actividad_actual('administrar_estudiantes');

        //Mensaje de error: flashdata en la sesion
        $error = $this->session->flashdata('error');
        if($error)
            $this->view_data['error'] = $error;
        
        //FECHA ACTUAL
        $this->view_data['fecha'] = date('d/m/Y'); 

       
        $this->view_data['docente'] = $this->nom_doc." ".$this->apellido_doc;
        $this->view_data['nuevo'] = true;

       // $tabla= $this->mostrar_tabla_estudiantes();
       
        // $this->view_data['crud'] = $output;
        //$this->view_data['arreglo'] = $estudiantes;
        // $this->view_data['tabla'] = $tabla;
        $this->view_data['docente'] = $this->nom_doc." ".$this->apellido_doc;
        $this->view_data['mostrar'] = true;
        //-------------------------------------------------------------------

        // $this->nuevo_usuario();
        // $this->lista_estudiantes();
         $this->view_data['privilegio_user'] =  $this->privilegio;
        $this->load->view('content/estudiantes/lista_estudiantes', $this->view_data);

        $this->load->view('template/footer');
    }
 
    public function ajax_list()
    {
        $list = $this->estudiantes->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $estudiantes) {
            $no++;
            $row = array();
            $row[] = $estudiantes->lu_alu;
            $row[] = $estudiantes->apellido_alu;
            $row[] = $estudiantes->nom_alu;
            
            // $row[] = $estudiantes->address;
            // $row[] = $estudiantes->dob;
 
            //add html for action
            $row[] = '<a class="btn btn-sm btn btn-success" href="javascript:void()" title="Modificar" onclick="edit_estudiantes('."'".$estudiantes->lu_alu."'".')"><i class="glyphicon glyphicon-pencil"></i> </a>
                  <a class="btn btn-sm btn-danger" href="javascript:void()" title="Eliminar" onclick="delete_estudiantes('."'".$estudiantes->lu_alu."'".')"><i class="glyphicon glyphicon-trash"></i> </a>';
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->estudiantes->count_all(),
                        "recordsFiltered" => $this->estudiantes->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
 
    public function ajax_edit($lu_alu)
    {
        $data = $this->estudiantes->get_by_lu_alu($lu_alu);
        echo json_encode($data);
    }
 
    public function ajax_add()
    {
        $data = array(
                'apellido_alu' => $this->input->post('apellido_alu'),
                'nom_alu' => $this->input->post('nom_alu'),
                'lu_alu' => $this->input->post('lu_alu')
                // 'address' => $this->input->post('address'),
                // 'dob' => $this->input->post('dob'),
            );
        $insert = $this->estudiantes->save($data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_update()
    {
        $data = array(
                'apellido_alu' => $this->input->post('apellido_alu'),
                'nom_alu' => $this->input->post('nom_alu'),
                'lu_alu' => $this->input->post('lu_alu')
                // 'address' => $this->input->post('address'),
                // 'dob' => $this->input->post('dob'),
            );
        $this->estudiantes->update(array('lu_alu' => $this->input->post('lu_alu')), $data);
        echo json_encode(array("status" => TRUE));
    }
 
    public function ajax_delete($lu_alu)
    {
        $this->estudiantes->delete_by_lu_alu($lu_alu);
        echo json_encode(array("status" => TRUE));
    }
}

?>