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
     private $redirected = false;  //si redirecciona via AJAX, no hace nada en los metodos

    
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
                                  //site_url(),//
                                   site_url('guias/modificar_guia/'.$guia['id_guia']),

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

/**
     * Controlador de la pagina de muestra de la guia para evaluar
     *  
     * En POST se reciben las opciones seleccionadas:
     * carrera (codigo), catedra (codigo), guia (id), alumno (lu), fecha (timestamp)
     * 
     * @param $seleccion array - Arreglo con las opciones seleccionadas (ej: $seleccion['carrera'] = codigo)
     * @access  public
     */
    public function modificar_guia($id_guia)
    {
        
        $guia = $this->guias_model->get_guia($id_guia);
        if(!$guia)
        {
            $this->session->set_flashdata('error', 'Guía inválida');
            redirect('examen/generar');
        }
        else
        {
            $this->view_data['guia'] = $guia;
            //id, nro, titulo, subtitulo. Los items y descripciones se agregan a continuacion
        }


       
        //ITEMS_GUIA
        $this->view_data['guia']['items'] = $this->_itemsguiamodif($id_guia,FALSE); 

        //DESCRIPCION DE LA GUIA (pide al modelo en base al id)
        //Pasa a la vista en $guia['desc']
        $descripcion = $this->guias_model->get_descripciones($id_guia);
        $this->view_data['guia']['desc'] = $descripcion;

        // //ITEMS DEL ESTUDIANTE DE LA GUIA (pide al modelo en base al id)
        // //Pasa a la vista en $guia['itemsestudiante']
        // $itemsestudiante = $this->guias_model->get_itemsestudiante($id_guia);
        // $this->view_data['guia']['itemsestudiante'] = $itemsestudiante;

        // $this->view_data['adq'] = $this->ponderacion_model->get_max_min(2);
        // $this->view_data['med_adq'] = $this->ponderacion_model->get_max_min(1);

        $this->view_data['title'] = "Modificar Guía - Departamento de Ciencias de la Salud";          
        $this->load->view('template/header', $this->view_data);

        $this->view_data['evaluar'] = TRUE;
        $this->load->view('content/guias/modificar_guia', $this->view_data);

        $this->load->view('template/footer'); 
    }

/**
     * Controlador de la accion archivar examen
     *  
     * En POST se reciben los datos del examen:
     * catedra (cod), guia (id), alumno (lu), fecha (string), examen-calif (int), examen-obs (text, opcional), examen-porc (float, opcional)
     * Arreglos: item-id[], item-estado[], item-obs[]
     *
     * Responde con JSON los datos del examen (o mensaje de error)
     * 
     * @access  public
     */
    public function guardar_modificaciones()
    {
        if(!$this->redirected)  //si no se envio respoesta AJAX para redireccionar
        {
            $this->load->model('guias_model');
            
            //var_dump($this->input->post());

            if(!$this->input->post()) 
            {
                $error['error_msj'] = "Acceso inválido a la archivación de examen";
                $this->util->json_response(FALSE,STATUS_EMPTY_POST,$error);
            }
            else 
            {
                $this->load->library('form_validation');
             //    $this->form_validation->set_rules('catedra', 'catedra', 'required|integer');
                $this->form_validation->set_rules('guia', 'guia', 'required|integer');
             //    $this->form_validation->set_rules('alumno', 'alumno', 'required|integer');
             //    $this->form_validation->set_rules('fecha', 'fecha', 'required');
             //    $this->form_validation->set_rules('examen-calif', 'examen-calif', 'required');
             //    $this->form_validation->set_rules('examen-pond', 'examen-pond', 'required');
             // // $this->form_validation->set_rules('examen-nota', 'examen-nota', 'numeric');
             // $this->form_validation->set_rules('item-pond', 'item-pond', 'numeric');
              $this->form_validation->set_rules('item-pos[]', 'item-pos[]', 'numeric');
                // $this->form_validation->set_rules('item-id', 'item-id', 'required');
                $this->form_validation->set_rules('item-id[]', 'item-id[]', 'required|integer');
                // $this->form_validation->set_rules('item-estado', 'item-estado', 'required');
                $this->form_validation->set_rules('item-text[]', 'item-text[]', 'required|integer');
                // $this->form_validation->set_rules('item-obs', 'item-obs', 'required');

                if (!$this->form_validation->run())  //si no verifica inputs requeridos
                {
                    $errors = $this->form_validation->error_array();
                    $msj = '';
                    foreach ($errors as $error) {
                        $msj = $msj . $error . " "; 
                    }
                    $errors['error_msj'] = $msj;
                    $this->util->json_response(FALSE,STATUS_INVALID_POST,$errors);

                }
                else //están los inputs, los valido 
                {
                    $valid = TRUE;
                    $input_errors = array(); 
                    
                    //GUIA (chequea que sea valido, y de la catedra)
                    $id_guia = $this->input->post('guia');
                    if(!$id_guia || $id_guia==NO_SELECTED)
                    {
                        $valid = false;
                        $input_errors['guia']='Guia invalida';
                    }
                    
                    //ITEMS: chequea que el array de id, estado y obs items no sea vacio, y tengan el mismo tamaño
                    $items_id = $this->input->post('item-id');
                    if(!$items_id || empty($items_id)) 
                    {
                        $valid = false;
                        $input_errors['item-id']='Arreglo item-id vacio';
                    }
                    $items_text = $this->input->post('item-text'); //text de las ponderaciones
                    if(!$items_text || empty($items_text)) 
                    {
                        $valid = false;
                        $input_errors['item-text']='Arreglo item-estado vacio'; 
                    }
                     $items_pos = $this->input->post('item-pos'); //text de las ponderaciones
                    if(!$items_pos || empty($items_pos)) 
                    {
                        $valid = false;
                        $input_errors['item-pos']='Arreglo item-estado vacio'; 
                    }
                   
                    if (!( count($items_id)==count($items_text) ) ) 
                    {
                        $valid = false;
                        $input_errors['items']='Arreglos item-id, item-text de distinto tamaño';
                    }
                    
                   
                    if (!$valid)    //si no pasa mi validacion
                    {
                        $msj = '';
                        foreach ($input_errors as $error) {
                            $msj = $msj . $error . ". "; 
                        }
                        $input_errors['error_msj'] = $msj;
                        $this->util->json_response(FALSE,STATUS_INVALID_POST,$input_errors);
                    }
                    else
                    {
                      try {
                        //Armo items
                        // $items = array();
                        for($i = 0; $i < count($items_id); $i++)
                        {
                            // $items[$i]['id'] = $items_id[$i];
                            // $items[$i]['pon'] = $items_text[$i];
                            // $items[$i]['estado'] = $items_estado[$i];
                            // $items[$i]['obs'] = $items_obs[$i];
                          
                          $guiam = $this->guias_model->actualizar_ponderacion_item_guia($items_id[$i],$id_guia,$items_text[$i],$items_pos[$i]);
                           
                        } 
                        $this->util->json_response(TRUE,STATUS_OK,$id_guia); //no mandar el JSON tal cual la BD por seguridad??
                     
                            }catch (Exception $e) {
                            switch ($e->getMessage()) {
                                case ERROR_REPETIDO:
                                    $id = $e->getCode();
                                    $error['error_msj'] = "El examen del alumno {$lu_alu} sobre la guía {$id_guia}, ya ha sido guardado en la base de datos hace menos de 3 minutos, con id: {$id}";
                                    $error['id_exam'] = $id;
                                    $this->util->json_response(FALSE,STATUS_REPEATED_POST,$error);
                                    break;
                                case ERROR_FALTA_ITEM:
                                    $error['error_msj'] = "Falta(n) item(s) de la guia. El examen no fue guardado en la base de datos";
                                    $this->util->json_response(FALSE,STATUS_INVALID_PARAM,$error);
                                    break;
                                case ERROR_NO_INSERT_EXAM:
                                    $error['error_msj'] = "El examen no pudo ser archivado en la base de datos";
                                    $this->util->json_response(FALSE,STATUS_NO_INSERT,$error);
                                    break;
                                case ERROR_NO_INSERT_ITEMEXAM:
                                    $error['error_msj'] = "Uno o más items no pudieron ser archivados en la base de datos. El examen no fue guardado";
                                    $this->util->json_response(FALSE,STATUS_NO_INSERT2,$error);
                                    break;

                                default:
                                    $error['error_msj'] = "El examen no fue guardado en la base de datos";
                                    $this->util->json_response(FALSE,STATUS_UNKNOWN_ERROR,$error);
                                    break;
                            }
                          } //errores al intentar guardar examen
                        // } //for
                        
                        //Guardo el examen y sus items mediante el modelo (operacion atomica, si falla, lanza excepcion)
                        // try {
                        //     $examen = $this->examenes_model->guardar_examen($id_guia,$cod_cat,$lu_alu,$this->legajo,$timestamp,$calif_exam,$obs_exam,$items,$pond_exam); //,$pond_exam
                        //     //$examen['id_exam'] = $id_exam;
                            // $this->util->json_response(TRUE,STATUS_OK,$examen); //no mandar el JSON tal cual la BD por seguridad??



                        
                    } //validacion_propia ok

                } //form_validation ok

            } //no empty_post

        } //no redirecciona    

    }
  

 /**
     * Devuelve arreglo con los items de la guia especificada  con la siguiente estructura:
     *
     * ITEMS DE LA GUIA (ARREGLO, AGRUPADOS POR SECCION Y GROUP_ITEM). 
     * Pide al modelo, en base al id.
     * Arma arreglo para pasar a la en la vista en $guia['items'], agrupados en subarreglos así:
     * $guia( [[datos]], [items] => 
     *                  ([pos] =>([tipo]=> seccion-grupoitem-item, [nro], [nom],
     *                              (si tipo es item):[id],[solo_texto],
     *                              (si tipo es seccion o grupo):[items] => 
     *                    ([pos] => ([tipo]=>grupoitem-item, [nro], [nom],
     *                                  (si tipo es item):[id],[solo_texto],
     *                                  (si tipo es grupo):[items] => 
     *                      ([pos] => ([tipo]=>item,[nro],[nom],[id],[solo_texto])) )) )) )
     * @param   $id_guia int id guia 
     * @access  private
     * @return  array 
     */
    function _itemsguiamodif($id) 
    {
        // if($examen)
        //     $lista_items = $this->examenes_model->get_items($id);
        // else
        //    
         $lista_items = $this->guias_model->get_items($id);
        
        $lista = array();
        $k = 0;
        for ($i=0; $i < count($lista_items); $i++)
        { 
            $item_completo = $lista_items[$i];
            if($item_completo['nom_sec'])  // si el item está dentro de una sección
            {
                //inserto seccion
                $nro_seccion = $item_completo['nro_sec'];
                $lista[$k] = array('tipo' => 'seccion',
                                    'nro' => $nro_seccion,
                                    'nom' => $item_completo['nom_sec']);
                                    //'items' => array(...) se agrega desp de recorrer los items del grupo
                //lista de items dentro de la seccion. 
                $j = 0; $items = array(); 
                $avanzo = true;
                while ($avanzo)
                {
                    if ($item_completo['nom_grupoitem']) //si el item esta dentro de un grupoitem dentro de una seccion
                    {
                        //inserto grupoitem dentro de la seccion
                        $nro_grupo = $item_completo['nro_grupoitem'];
                        $items[$j] = array('tipo' => 'grupoitem',
                                    'nro' => $nro_seccion.'.'.$nro_grupo,
                                    'nom' => $item_completo['nom_grupoitem']);
                                    //'items' => array(...) se agrega desp de recorrer los items del grupo

                        //lista de items dentro del grupo dentro de la seccion. 
                        $j2 = 0; $items2 = array(); 
                        $avanzo2 = true;
                        while ($avanzo2)
                        {
                            $items2[$j2] = array('tipo' => 'item',
                                            'nro' => $nro_seccion.'.'.$nro_grupo.'.'.$item_completo['nro_item'],
                                            'nom' => $item_completo['nom_item'],
                                            'id' => $item_completo['id_item'],
                                            'pon' => $item_completo['pon_item'],
                                            'pos' => $item_completo['pos_item'],
                                            'solo_texto' => $item_completo['solo_texto']);
                            // if($examen) 
                            // {    
                            //     $items2[$j2]['estado'] = $item_completo['estado_item'];
                            //     $items2[$j2]['obs'] = $item_completo['obs_item'];
                            // }
                            $avanzo2 = $i+1 < count($lista_items) && $lista_items[$i+1]['nro_grupoitem'] == $nro_grupo && $lista_items[$i+1]['nro_sec'] == $nro_seccion;
                            if($avanzo2)
                            {
                                $i++;
                                $item_completo = $lista_items[$i];
                                $j2++;
                            }                        
                        }
                        $items[$j]['items'] = $items2;
                        $j++;
                    }
                    else //item suelto dentro de la seccion (sin grupo item)
                    {
                        $items[$j] = array('tipo' => 'item',
                                    'nro' => $nro_seccion.'.'.$item_completo['nro_item'],
                                    'nom' => $item_completo['nom_item'],
                                    'id' => $item_completo['id_item'],
                                    'pon' => $item_completo['pon_item'],
                                     'pos' => $item_completo['pos_item'],
                                    'solo_texto' => $item_completo['solo_texto']);  
                        // if($examen) 
                        // {    
                        //     $items[$j]['estado'] = $item_completo['estado_item'];
                        //     $items[$j]['obs'] = $item_completo['obs_item'];
                        // }       
                    }
                    $avanzo = $i+1 < count($lista_items) && $lista_items[$i+1]['nro_sec'] == $nro_seccion;
                    if($avanzo)
                    {
                        $i++;
                        $item_completo = $lista_items[$i];
                        $j++;
                    }     

                            
                }
                                
                $lista[$k]['items'] = $items;
                $k++;
            }
            elseif ($item_completo['nom_grupoitem']) //si el item esta dentro de un grupoitem
            {
                //inserto grupoitem
                $nro_grupo = $item_completo['nro_grupoitem'];
                $lista[$k] = array('tipo' => 'grupoitem',
                                    'nro' => $nro_grupo,
                                    'nom' => $item_completo['nom_grupoitem']);
                                    //'items' => array(...) se agrega desp de recorrer los items del grupo
                //lista de items dentro del grupo. 
                $j = 0; $items = array(); 
                $avanzo = true;
                while ($avanzo)
                {
                    $items[$j] = array('tipo' => 'item',
                                    'nro' => $nro_grupo.'.'.$item_completo['nro_item'],
                                    'nom' => $item_completo['nom_item'],
                                    'id' => $item_completo['id_item'],
                                    'pon' => $item_completo['pon_item'],
                                     'pos' => $item_completo['pos_item'],
                                    'solo_texto' => $item_completo['solo_texto']);
                    // if($examen) 
                    // {    
                    //     $items[$j]['estado'] = $item_completo['estado_item'];
                    //     $items[$j]['obs'] = $item_completo['obs_item'];
                    // }
                    $avanzo = $i+1 < count($lista_items) && $lista_items[$i+1]['nro_grupoitem'] == $nro_grupo;
                    if($avanzo)
                    {
                        $i++;
                        $item_completo = $lista_items[$i];
                        $j++;
                    }                        
                }
                                
                $lista[$k]['items'] = $items;
                $k++;
            }
            else //si el ítem está suelto (sin sección ni grupo)
            {
                //inserto item directamente
                $lista[$k] = array('tipo' => 'item',
                                    'nro' => $item_completo['nro_item'],
                                    'nom' => $item_completo['nom_item'],
                                    'id' => $item_completo['id_item'],
                                    'pon' => $item_completo['pon_item'],
                                     'pos' => $item_completo['pos_item'],
                                    'solo_texto' => $item_completo['solo_texto']);
                // if($examen) 
                // {    
                //     $lista[$k]['estado'] = $item_completo['estado_item'];
                //     $lista[$k]['obs'] = $item_completo['obs_item'];
                // }
                $k++;
            }
        }
        return $lista;

    }






  }