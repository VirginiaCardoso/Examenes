<?php 

/**
 * Controlador Examen. Encargado de la generación de un examen (armado de listas de catedras, guias y alumnos),
 * evaluación, almacenamiento en la BD, y vista de uno examen guardado
 *
 *@package      controllers
 *@author       Fernando Andrés Prieto
 *@author       Diego Martín Schwindt
 *@copyright    Marzo, 2014 - Departamento de Ciencias e Ingeniería de la Computación - UNIVERSIDAD NACIONAL DEL SUR 
*/

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Examen extends CI_Controller {

    private $view_data;
    private $legajo;
    private $privilegio;
    private $redirected = false;  //si redirecciona via AJAX, no hace nada en los metodos
    
	public function __construct()
    {
        parent::__construct();

    
        if($this->usuario->acceso_permitido(PRIVILEGIO_DOCENTE)) 
   		{
            $this->view_data['navbar']['nombre'] = $this->usuario->get_info_sesion_usuario('nom_doc'); 
            $this->view_data['navbar']['apellido'] = $this->usuario->get_info_sesion_usuario('apellido_doc');
            $this->view_data['activo'] = $this->usuario->activo(); 

            $this->legajo = $this->usuario->get_info_sesion_usuario('leg_doc');
            $this->privilegio = $this->usuario->get_info_sesion_usuario('privilegio'); 

            $this->load->model(array('carreras_model','catedras_model','guias_model', 'alumnos_model'));

                
        }
        else if($this->usuario->logueado()) //no tiene privilegio, pero esta logueado
        { 
            if($this->input->is_ajax_request())
            {
                $error['error_msj'] = "No tiene permiso para realizar esta acción";
                $this->load->helper('url');
                $error['redirect'] = site_url('home/index/error_privilegio');
                $this->util->json_response(FALSE,STATUS_REDIRECT,$error);
                $this->redirected = true;
            }   
            else
            {
                $this->session->set_flashdata('error', 'No tiene permiso para realizar esta acción');
                redirect('home/index/error_privilegio');
            }

        }
        else
        {
            if($this->input->is_ajax_request())
            {
                $error['error_msj'] = "Sesión caducada. Vuelva a iniciar sesión";
                $this->load->helper('url');
                $error['redirect'] = site_url('login');
                $this->util->json_response(FALSE,STATUS_SESSION_EXPIRED,$error);
                $this->redirected = true;
            }
            else
            {
                $this->session->set_flashdata('error', 'Sesión caducada. Vuelva a iniciar sesión');
                redirect('login');
            }
        }
    }


	/**
     * Redirecciona al controlador correspondiente a la actividad actual del usuario
     *
     * @access  public
     */
    public function index()
    {
        $actividad_actual = $this->usuario->get_actividad_actual();
        //if($actividad_actual == FALSE || $actividad_actual=='generar_examen' )
            redirect('examen/generar');
        //else
        //    redirect(....)
    }

    /**
     * Controlador de la pagina de seleccion de catedra-guia-alumno
     *  
     * En POST se pueden mandar selecciones default: carrera (codigo), catedra (codigo), guia (id), alumno (lu)
     * 
     * @param $selects array - Arreglo con las opciones seleccionadas por defecto (ej: $selects['carrera'] = codigo)
     * @access  public
     */
    public function generar($selects = NULL)
    {
        $this->view_data['title'] = "Generar Examen - Departamento de Ciencias de la Salud";          
        $this->load->view('template/header', $this->view_data);

        $this->usuario->set_actividad_actual('generar_examen');

        //Mensaje de error: flashdata en la sesion
        $error = $this->session->flashdata('error');
        if($error)
            $this->view_data['error'] = $error;
        
        //FECHA ACTUAL
        $this->view_data['fecha'] = date('d/m/Y'); 
        
        //LISTA CARRERAS
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

                //LISTA CATEDRAS DE LA CARRERA
                $catedras = $this->_catedras($carrera['cod_carr']); 
                //DEBUG
                //echo 'Catedras del docente de '.$carrera['nom_carr'].':<br/>';
                //foreach ($catedras as $fila)
                //    var_dump($fila); echo '<br/>';
                
        
                if(count($catedras)>0)  //si no hay catedras no manda datos a la view
                {
                    $this->view_data['catedras']['list'] = $catedras;  //en la view: $catedras['list'][indice]['cod_cat'].
                    $index_catedra = 0; //Por defecto, primera catedra

                    //Busco en post si hay catedra seleccionada por default, y actualiza el index seleccionado de la lista
                    $cod_cat_default = $this->input->post('catedra') ;
                    if($cod_cat_default)
                    {
                        $index_catedra = $this->util->buscar_indice($catedras,'cod_cat',$cod_cat_default);
                    }
                    
                    $this->view_data['catedras']['selected'] = $index_catedra;

                    //Si no hay catedra seleccionada, las demas listas están vacías.
                    if($index_catedra >= 0 && isset($catedras[$index_carrera]))
                    {
                        $catedra= $catedras[$index_catedra];   //Catedra seleccionada

                        //LISTA GUIAS DE LA CATEDRA
                        $guias = $this->_guias($catedra['cod_cat']);
                        
                        //DEBUG
                        //echo 'Guias de la catedra '.$catedra['nom_cat'].':<br/>';
                        //foreach ($guias as $fila) 
                        //   var_dump($fila); echo '<br/>';
                        
                    
                        if(count($guias)>0)  //si no hay guias no manda datos a la view
                        {
                            $this->view_data['guias']['list'] = $guias;  //en la view: $guias['list'][indice]['id_guia'].
                            $index_guia = NO_SELECTED; //Por defecto, no seleccionada

                            //Busco en post si hay guia seleccionada por default, y actualiza el index seleccionado de la lista
                            $id_guia_default = $this->input->post('guia') ;
                            if($id_guia_default) 
                            {
                                $index_guia = $this->util->buscar_indice($guias,'id_guia',$id_guia_default);
                            }
                            $this->view_data['guias']['selected'] = $index_guia;

                        } //hay guias

                        //LISTA ALUMNOS DE LA CATEDRA
                        $alumnos = $this->_alumnos($catedra['cod_cat']);
                        //DEBUG
                        //echo 'alumnos de la catedra '.$catedra['nom_cat'].':<br/>';
                        //foreach ($alumnos as $fila) 
                        //    var_dump($fila); echo '<br/>';
                        
                      
                        if(count($alumnos)>0)  //si no hay guias no manda datos a la view
                        {
                            $this->view_data['alumnos']['list'] = $alumnos;  //en la view: $alumnos['list'][indice]['lu_alu'].
                            $index_alumno = NO_SELECTED; //Por defecto, no seleccionado

                            //Busco en post si hay guia seleccionada por default, y actualiza el index seleccionado de la lista
                            $lu_alu_default = $this->input->post('alumno') ;
                            if($lu_alu_default) 
                            {
                                $index_alumno = $this->util->buscar_indice($alumnos,'lu_alu',$lu_alu_default);
                            }
                            $this->view_data['alumnos']['selected'] = $index_alumno;

                        } //hay alumnos

                    } //hay catedra seleccionada
                }//hay catedras
            }// hay carrera seleccionada
        }//hay carreras
        
        $this->load->view('content/examen/generar', $this->view_data);

        $this->load->view('template/footer');  
    }

    /**
     * Devuelve arreglo con las carreras correspondientes al usuario
     *
     * @access  private
     * @return  array  - lista de carreras del usuario
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
     * Devuelve arreglo con las catedras correspondientes al usuario y la carrera elegida
     *
     * @param   $cod_carr int codigo carrera 
     * @access  private
     * @return  array  - lista de catedras del usuario y la carrera
     */
    function _catedras($cod_carr) 
    {
        if($this->privilegio>=PRIVILEGIO_ADMIN)  //si es admin muestra todas las catedras de la carrera
            $catedras = $this->catedras_model->get_catedras_carrera($cod_carr);
        else
            $catedras = $this->catedras_model->get_catedras_docente_carrera($this->legajo,$cod_carr);
        return $catedras;
    }


    /**
     * Devuelve arreglo con las guias correspondientes a la catedra elegida
     *
     * @param   $cod_cat int codigo catedra
     * @access  private
     * @return  array  - lista de guias de la catedra elegida
     */
    function _guias($cod_cat) 
    {
        return $this->guias_model->get_guias_catedra($cod_cat);
    }

    /**
     * Devuelve arreglo con los alumnos correspondientes a la catedra elegida
     *
     * @param   $cod_cat int codigo catedra
     * @access  private
     * @return  array  - lista de alumnos de la catedra elegida
     */
    function _alumnos($cod_cat) 
    {
        return $this->alumnos_model->get_alumnos_catedra($cod_cat);
    }

    /**
     * Controlador de la lista de catedras (accedido mediante AJAX). Retorna JSON
     *  
     * En POST se envia parametro: carrera (codigo)
     * 
     * @access  public
     */
    public function get_catedras()
    {
        if(!$this->redirected)
        {
            $cod_carr = $this->input->post('carrera') ;
            if($cod_carr)
            {
                $catedras = $this->_catedras($cod_carr); 
                if(count($catedras)>0)
                    $this->util->json_response(TRUE,STATUS_OK,$catedras);    
                else
                    $this->util->json_response(FALSE,STATUS_INVALID_PARAM,""); 
            }
            else
                $this->util->json_response(FALSE,STATUS_EMPTY_POST,"");
        }
    }


    /**
     * Controlador de la lista de guias y alumnos (accedido mediante AJAX). Retorna JSON
     *  
     * En POST se envia parametro: catedra (codigo)
     * 
     * @access  public
     */
    public function get_guias_alumnos()
    {
        if(!$this->redirected)
        {
            $cod_cat = $this->input->post('catedra') ;
            if($cod_cat)
            {
                $guias = $this->_guias($cod_cat); 
                $alumnos = $this->_alumnos($cod_cat); 
                
                $this->util->json_response(TRUE,STATUS_OK,array('guias' => $guias,'alumnos' => $alumnos));    
                
            }
            else
                $this->util->json_response(FALSE,STATUS_EMPTY_POST,"");
        }
    }

    /**
     * Devuelve arreglo con los items de la guia especificada (y el estado si es examen), con la siguiente estructura:
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
     * @param   $examen bool agregar datos examen 
     * @access  private
     * @return  array 
     */
    function _itemsguia($id,$examen) 
    {
        if($examen)
            $lista_items = $this->examenes_model->get_items($id);
        else
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
                                            'solo_texto' => $item_completo['solo_texto']);
                            if($examen) 
                            {    
                                $items2[$j2]['estado'] = $item_completo['estado_item'];
                                $items2[$j2]['obs'] = $item_completo['obs_item'];
                            }
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
                                    'solo_texto' => $item_completo['solo_texto']);  
                        if($examen) 
                        {    
                            $items[$j]['estado'] = $item_completo['estado_item'];
                            $items[$j]['obs'] = $item_completo['obs_item'];
                        }       
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
                                    'solo_texto' => $item_completo['solo_texto']);
                    if($examen) 
                    {    
                        $items[$j]['estado'] = $item_completo['estado_item'];
                        $items[$j]['obs'] = $item_completo['obs_item'];
                    }
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
                                    'solo_texto' => $item_completo['solo_texto']);
                if($examen) 
                {    
                    $lista[$k]['estado'] = $item_completo['estado_item'];
                    $lista[$k]['obs'] = $item_completo['obs_item'];
                }
                $k++;
            }
        }
        return $lista;

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
    public function evaluar($seleccion = NULL)
    {
        if(!$this->input->post()) 
        {
            $this->session->set_flashdata('error', 'Acceso inválido a la evaluación de un examen');
            redirect('examen/generar');
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules('carrera', 'carrera', 'required|integer');
        $this->form_validation->set_rules('catedra', 'catedra', 'required|integer');
        $this->form_validation->set_rules('guia', 'guia', 'required|integer');
        $this->form_validation->set_rules('alumno', 'alumno', 'required|integer');
        $this->form_validation->set_rules('fecha', 'fecha', 'required');

        if (!$this->form_validation->run())  //si no verifica inputs
        {
            $this->session->set_flashdata('error', validation_errors());
            redirect('examen/generar');
        }

        //FECHA pasada por POST
        //Redirecciona si no es valida
        $fecha = $this->input->post('fecha');
        if(!$fecha || !$this->util->validar_fecha_DMY($fecha))
        {
            $this->session->set_flashdata('error', 'Fecha inválida');
            redirect('examen/generar');
        }
        $this->view_data['fecha'] = $fecha;

        //CARRERA (pide los datos al modelo a partir del codigo pasado por POST)
        //Redirecciona si no es valida
        $cod_carr = $this->input->post('carrera');
        if(!$cod_carr || $cod_carr==NO_SELECTED)
        {
            $this->session->set_flashdata('error', 'Carrera inválida');
            redirect('examen/generar');
        }
        if($this->privilegio>=PRIVILEGIO_ADMIN)  
            $carrera = $this->carreras_model->get_carrera($cod_carr);
        else
            $carrera = $this->carreras_model->get_carrera_docente($cod_carr,$this->legajo);
        if(!$carrera)
        {
            $this->session->set_flashdata('error', 'Carrera inválida');
            redirect('examen/generar');
        }
        else
        {
            $this->view_data['carrera'] = $carrera;
        }

        //CATEDRA (pide los datos al modelo a partir del codigo pasado por POST, verificando que sea de la carrera)
        //Redirecciona si no es valida
        $cod_cat = $this->input->post('catedra');
        if(!$cod_cat || $cod_cat==NO_SELECTED)
        {
            $this->session->set_flashdata('error', 'Cátedra inválida');
            redirect('examen/generar');
        }
        if($this->privilegio>=PRIVILEGIO_ADMIN)  
            $catedra = $this->catedras_model->get_catedra_carrera($cod_cat,$cod_carr);
        else
            $catedra = $this->catedras_model->get_catedra_docente_carrera($cod_cat,$this->legajo,$cod_carr);
        if(!$catedra)
        {
            $this->session->set_flashdata('error', 'Cátedra inválida');
            redirect('examen/generar');
        }
        else
        {
            $this->view_data['catedra'] = $catedra;
        }
        if(!$this->privilegio>=PRIVILEGIO_ADMIN) 
        { 
            if(!$this->catedras_model->check_catedra_docente_permiso($cod_cat,$this->legajo,PERMISO_EVALUAR))
            {
                $this->session->set_flashdata('error', 'Usuario sin permiso para tomar examen en la cátedra '.$catedra['nom_cat']);
                redirect('examen/generar');
            }
        }

        //ALUMNO (pide los datos al modelo a partir del lu pasado por POST, verificando que sea de la catedra)
        //Redirecciona si no es valida
        $lu_alu = $this->input->post('alumno');
        if(!$lu_alu || $lu_alu==NO_SELECTED)
        {
            $this->session->set_flashdata('error', 'Estudiante inválido');
            redirect('examen/generar');
        }
        $alumno = $this->alumnos_model->get_alumno_catedra($lu_alu,$cod_cat);
        if(!$alumno)
        {
            $this->session->set_flashdata('error', 'Estudiante inválido');
            redirect('examen/generar');
        }
        else
        {
            $this->view_data['alumno'] = $alumno;
        }

        //GUIA (pide los datos al modelo a partir del id pasado por POST, verificando que sea de la catedra)
        //Redirecciona si no es valida
        $id_guia = $this->input->post('guia');
        if(!$id_guia || $id_guia==NO_SELECTED)
        {
            $this->session->set_flashdata('error', 'Guía inválida');
            redirect('examen/generar');
        }
        $guia = $this->guias_model->get_guia_catedra($id_guia,$cod_cat);
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
        $this->view_data['guia']['items'] = $this->_itemsguia($id_guia,FALSE); //boolean: no busca examen

        //DESCRIPCION DE LA GUIA (pide al modelo en base al id)
        //Pasa a la vista en $guia['desc']
        $descripcion = $this->guias_model->get_descripciones($id_guia);
        $this->view_data['guia']['desc'] = $descripcion;

        //ITEMS DEL ESTUDIANTE DE LA GUIA (pide al modelo en base al id)
        //Pasa a la vista en $guia['itemsestudiante']
        $itemsestudiante = $this->guias_model->get_itemsestudiante($id_guia);
        $this->view_data['guia']['itemsestudiante'] = $itemsestudiante;

        $this->view_data['title'] = "Evaluar Guía - Departamento de Ciencias de la Salud";          
        $this->load->view('template/header', $this->view_data);

        $this->view_data['evaluar'] = TRUE;
        $this->load->view('content/examen/examen', $this->view_data);

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
    public function archivar()
    {
        if(!$this->redirected)  //si no se envio respoesta AJAX para redireccionar
        {
            $this->load->model('examenes_model');
            
            //var_dump($this->input->post());

            if(!$this->input->post()) 
            {
                $error['error_msj'] = "Acceso inválido a la archivación de examen";
                $this->util->json_response(FALSE,STATUS_EMPTY_POST,$error);
            }
            else 
            {
                $this->load->library('form_validation');
                $this->form_validation->set_rules('catedra', 'catedra', 'required|integer');
                $this->form_validation->set_rules('guia', 'guia', 'required|integer');
                $this->form_validation->set_rules('alumno', 'alumno', 'required|integer');
                $this->form_validation->set_rules('fecha', 'fecha', 'required');
                $this->form_validation->set_rules('examen-calif', 'examen-calif', 'required|integer');
                $this->form_validation->set_rules('examen-porc', 'examen-porc', 'numeric');
             // $this->form_validation->set_rules('examen-nota', 'examen-nota', 'numeric');
             // $this->form_validation->set_rules('item-pond', 'item-pond', 'numeric');
             // $this->form_validation->set_rules('item-pond[]', 'item-pond[]', 'numeric');
                $this->form_validation->set_rules('item-id', 'item-id', 'required');
                $this->form_validation->set_rules('item-id[]', 'item-id[]', 'required|integer');
                $this->form_validation->set_rules('item-estado', 'item-estado', 'required');
                $this->form_validation->set_rules('item-estado[]', 'item-estado[]', 'required|integer');
                $this->form_validation->set_rules('item-obs', 'item-obs', 'required');

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
                    //FECHA (verifica si es válida)
                    $fecha = $this->input->post('fecha');

                    if(!$fecha || !$this->util->validar_fecha_DMY($fecha))
                    {
                        $valid = false;
                        $input_errors['fecha']='Fecha invalida';
                    }
                    else
                    {
                        $fecha = $this->util->DMYtoYMD($fecha);
                        $fecha_array = date_parse_from_format('Y-m-d',$fecha);
                        
                        $timestamp = date('Y-m-d H:i:s', mktime(date('H'),date('i'),date('s'),
                                $fecha_array['month'],$fecha_array['day'],$fecha_array['year'])); 
                    }

                    //CATEDRA (chequea que sea válida y asociada al docente)
                    $cod_cat = $this->input->post('catedra');
                    if(!$cod_cat || $cod_cat==NO_SELECTED)
                    {
                        $valid = false;
                        $input_errors['catedra']='Catedra invalida';
                    }
                    if(!$this->privilegio>=PRIVILEGIO_ADMIN) 
                    { 
                        if(!$this->catedras_model->check_catedra_docente_permiso($cod_cat,$this->legajo,PERMISO_EVALUAR))
                        //catedra no perteneciente al docente (o no existe)
                        {
                            $valid = false;
                            $input_errors['catedra']='Usuario sin permiso para tomar examen en la cátedra '.$catedra['nom_cat'];
                        }
                    }

                    //ALUMNO (chequea que sea valido, y asociado a la catedra)
                    $lu_alu = $this->input->post('alumno');
                    if(!$lu_alu || $lu_alu==NO_SELECTED)
                    {
                        $valid = false;
                        $input_errors['alumno']='Estudiante invalido';
                    }
                    if(!$this->alumnos_model->check_alumno_catedra($lu_alu,$cod_cat))
                    {
                        //alumno no asociado a catedra (o no existe)
                        $valid = false;
                        $input_errors['alumno']='Estudiante no asociado a la catedra';
                    }
                    //GUIA (chequea que sea valido, y de la catedra)
                    $id_guia = $this->input->post('guia');
                    if(!$id_guia || $id_guia==NO_SELECTED)
                    {
                        $valid = false;
                        $input_errors['guia']='Guia invalida';
                    }
                    if(!$this->guias_model->check_guia_catedra($id_guia,$cod_cat))
                    {
                        //guia no es de la catedra (o no existe)
                        $valid = false;
                        $input_errors['guia']='Guia no asociada a la catedra';
                    }

                    //ITEMS: chequea que el array de id, estado y obs items no sea vacio, y tengan el mismo tamaño
                    $items_id = $this->input->post('item-id');
                    if(!$items_id || empty($items_id)) 
                    {
                        $valid = false;
                        $input_errors['item-id']='Arreglo item-id vacio';
                    }
                    $items_estado = $this->input->post('item-estado');
                    if(!$items_estado || empty($items_estado)) 
                    {
                        $valid = false;
                        $input_errors['item-estado']='Arreglo item-estado vacio'; 
                    }
                    $items_obs = $this->input->post('item-obs');
                    if(!$items_obs || empty($items_obs)) 
                    {
                        $valid = false;
                        $input_errors['item-obs']='Arreglo item-obs vacio'; 
                    }
                    if (!( count($items_id)==count($items_estado) && count($items_id)==count($items_obs) ) ) 
                    {
                        $valid = false;
                        $input_errors['items']='Arreglos item-id, item-estado, item-obs de distinto tamaño';
                    }
                    
                    //OBSERVACIÓN GENERAL (no es requerido)
                    $obs_exam = $this->input->post('examen-obs');

                    //PORCENTAJE (no es requerido, validado en form_validation)
                    $porc_exam = $this->input->post('examen-porc');
                    //VALIDAR QUE SEA ENTRE 0 Y 100??

                     //PONDERACION (no es requerido, validado en form_validation)
                    // $pond_exam = $this->input->post('examen-pond');

                    //CALIFICACION GENERAL (requerida, valor int, validado en form_validation)
                    $calif_exam = $this->input->post('examen-calif');
                    //VALIDAR QUE SEA ENTRE 0 Y 2??

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
                        //Armo items
                        $items = array();
                        for($i = 0; $i < count($items_id); $i++)
                        {
                            $items[$i]['id'] = $items_id[$i];
                            // $items[$i]['pon'] = $items_pon[$i];
                            $items[$i]['estado'] = $items_estado[$i];
                            $items[$i]['obs'] = $items_obs[$i];
                        }
                        
                        //Guardo el examen y sus items mediante el modelo (operacion atomica, si falla, lanza excepcion)
                        try {
                            $examen = $this->examenes_model->guardar_examen($id_guia,$cod_cat,$lu_alu,$this->legajo,$timestamp,$calif_exam,$obs_exam,$items,$porc_exam); //,$pond_exam
                            //$examen['id_exam'] = $id_exam;
                            $this->util->json_response(TRUE,STATUS_OK,$examen); //no mandar el JSON tal cual la BD por seguridad??


                        } catch (Exception $e) {
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

                        
                    } //validacion_propia ok

                } //form_validation ok

            } //no empty_post

        } //no redirecciona    

    }


    /**
     * Controlador de la accion ver un examen guardado
     *  
     * En GET (parametro) se recibe solo el id del examen
     *
     * Carga vista del examen
     * 
     * @access  public
     * @param   $id int id del examen deseado
     */
    public function ver($id)
    {
        $this->_cargar_datos_examen($id);    

        $this->load->view('template/header', $this->view_data);

        $this->load->view('content/examen/examen', $this->view_data);

        $this->load->view('template/footer');
    }

    /**
     * Controlador de la accion generar un archivo PDF a partir un examen guardado
     *  
     * En GET (parametro) se recibe solo el id del examen
     *
     * Genera el archivo PDF
     * 
     * @access  public
     * @param   $id int id del examen deseado
     */
    public function pdf($id)
    {
        $this->load->helper(array('dompdf', 'file'));

        $this->_cargar_datos_examen($id);
    
        $html = $this->load->view('content/examen/examen_pdf', $this->view_data, true);


        $file_name = 'ex_'.$id.'_'.$this->view_data['catedra']['cod_cat'].'_'.$this->view_data['docente']['leg_doc'].'_'.$this->view_data['alumno']['lu_alu'];

        pdf_create($html, $file_name);

    }

    /**
     * Carga todos los datos de un examen
     *
     * En GET (parametro) se recibe solo el id del examen
     *
     * @access  private
     * @param   $id int id del examen deseado
     */
    function _cargar_datos_examen($id)
    {
        if(!isset($id) || !$id || !ctype_digit($id))   //chequea que $id esté y sea sólo numeros
        {
            $this->session->set_flashdata('error', 'Acceso inválido a Ver Examen');
            redirect('home');
        }
        $this->load->model('examenes_model');

        $examen = $this->examenes_model->get_examen_id($id);
        if(!$examen)   //chequea que $id esté y sea sólo numeros
        {
            $this->session->set_flashdata('error', 'ID de examen inexistente');
            redirect('home');
        }
        
        //CARRERA
        $carrera['cod_carr'] = $examen['cod_carr'];
        $carrera['nom_carr'] = $examen['nom_carr'];
        $this->view_data['carrera'] = $carrera;

        //CATEDRA 
        $catedra['cod_cat'] = $examen['cod_cat'];
        $catedra['nom_cat'] = $examen['nom_cat'];
        $this->view_data['catedra'] = $catedra;

        //check permiso para ver catedra
        if(!$this->privilegio>=PRIVILEGIO_ADMIN)  
        {
            if(!$this->catedras_model->check_catedra_docente_permiso($catedra['cod_cat'],$this->legajo,PERMISO_VER))
            {
                $this->session->set_flashdata('error', 'Usuario sin permiso para ver exámenes en la cátedra '.$catedra['nom_cat']);
                redirect('home');
            }
        }

        //DOCENTE 
        $docente['leg_doc'] = $examen['leg_doc'];
        $docente['apellido_doc'] = $examen['apellido_doc'];
        $docente['nom_doc'] = $examen['nom_doc'];
        $this->view_data['docente'] = $docente;
        
        //ALUMNO 
        $alumno['lu_alu'] = $examen['lu_alu'];
        $alumno['apellido_alu'] = $examen['apellido_alu'];
        $alumno['nom_alu'] = $examen['nom_alu'];
        $this->view_data['alumno'] = $alumno;

        //GUIA 
        $guia['id_guia'] = $examen['id_guia'];
        $guia['nro_guia'] = $examen['nro_guia'];
        $guia['tit_guia'] = $examen['tit_guia'];
        $guia['subtit_guia'] = $examen['subtit_guia'];
        $this->view_data['guia'] = $guia;

        //FECHA
        $this->view_data['fecha'] = $examen['fecha'];

        //EXAMEN
        $exam['id_exam'] = $examen['id_exam'];
        $exam['calificacion'] = $examen['calificacion'];
        $exam['porcentaje_exam'] = $examen['porcentaje_exam'];
        $exam['obs_exam'] = $examen['obs_exam'];
        $this->view_data['examen'] = $exam;
        
        //ITEMS DE LA GUIA CON EL ESTADO Y OBS DEL EXAMEN
        $this->view_data['guia']['items'] = $this->_itemsguia($examen['id_exam'],TRUE); //boolean: examen

        //DESCRIPCION DE LA GUIA (pide al modelo en base al id)
        $descripcion = $this->guias_model->get_descripciones($guia['id_guia']);
        $this->view_data['guia']['desc'] = $descripcion;

        //ITEMS DEL ESTUDIANTE DE LA GUIA (pide al modelo en base al id)
        $itemsestudiante = $this->guias_model->get_itemsestudiante($guia['id_guia']);
        $this->view_data['guia']['itemsestudiante'] = $itemsestudiante;


        $this->view_data['title'] = "Ver Examen Archivado - Departamento de Ciencias de la Salud";          
        $this->view_data['evaluar'] = FALSE;
    } 

}    

/* Fin del archivo examen.php */
/* Ubicación: ./application/controllers/examen.php */