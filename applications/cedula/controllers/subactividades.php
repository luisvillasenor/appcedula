<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Subactividades extends CI_Controller {
	
    public function __construct(){ 
		
        session_start();
		
        parent::__construct();
		
        if ( !isset($_SESSION['username'])){
			redirect(base_url()); // Redirecciona la controlador "admin/index"
		}//var_dump(session_get_cookie_params()); //Muestra el valor de la variable

        /**
        * LOAD MODELS
        *
        */ 
        $this->load->model('subactividades_model');
        $this->load->model('ubicaciones_model');
        $this->load->model('municipios_model');
        $this->load->model('sedes_model');
        $this->load->model('horarios_model');
        $this->load->model('fc_model');
        $this->load->model('actividades_model');

        /**
        * DEFINE AÑO ACTUAL
        * 
        */
        $date = new DateTime();
        $anioActual = $date->format('Y');
        define('anioActual', $anioActual);
	}
    
    // Vista de Bienvenida
    public function index() {
        /** 
        * INICIALIZA VARIABLES LOCALES Y DE SESSION
        *
        */
        $grupo           = $_SESSION['grupo'];
        $data['grupo']   = $grupo;
        $id_coord        = $_SESSION['id_coord'];
        $edicion         = $_SESSION['fc'];
        $data['edicion'] = $edicion;
        $data['title']   = 'Actividades y/o Talleres';
        $e_mail          = $_SESSION['username'];
		$data['onlyusername'] = strstr($e_mail,'@',true);
        
        /**
        * LOGICA 
        *
        */
		#$data['get_ubicaciones'] = $this->ubicaciones_model->get();
        #$data['get_municipios'] = $this->municipios_model->get();
        $data['get_fc'] = $this->fc_model->get_fc();

        # Obtiene los años de cada edicion
        $edicionesTrabajo = array();
        $idsfcTrabajo = array();
        $fcTrabajo = false;
        foreach ($data['get_fc'] as $anio) {
            /** Se crea un arreglo de los Años de las Ediciones del FC */ 
            array_push($edicionesTrabajo, $anio->anio);
            /** Se crea un arreglo de los IDs de las Ediciones del FC */ 
            array_push($idsfcTrabajo, $anio->id_fc);
            /** Si el año Actual existe en la base de datos, obtengo su ID de la Edicion */ 
            if ( ($fcTrabajo == false) && ($anio->anio == anioActual) ) {
                $fcTrabajo = $anio->id_fc ;
            }
        }
        // Busca el anioActual dentro del arrey $edicionesTrabajo, devuelve el año Actual sino Falso.
        $anioTrabajo = (in_array(anioActual, $edicionesTrabajo)) ? anioActual : false ;
        $idfcTrabajo = (in_array($fcTrabajo, $idsfcTrabajo)) ? $fcTrabajo : false ;
        //$idfcTrabajo = in_array($fcTrabajo, $idsfcTrabajo);

        /**
        * Prepara las VARIABLES en un Arreglo para pasarlo como Parametro a la(s) vista(s)
        */
        $data['anioTrabajo'] = $anioTrabajo;
        $data['idfcTrabajo'] = $idfcTrabajo;
        $data['fcTrabajo']   = $fcTrabajo;

        /**
        * Carga las Vistas para el Usuario
        */
        $this->load->view('header_view',$data);
		$this->load->view('subactividades_view',$data);
        $this->load->view('footer_view',$data);    
    }

    // Lista y Filtra
	public function show($id_subact = null,$id_act = null) {
        /** 
        * INICIALIZA VARIABLES LOCALES Y DE SESSION
        *
        */
        $grupo           = $_SESSION['grupo'];
        $data['grupo']   = $grupo;
        $id_coord        = $_SESSION['id_coord'];
        $edicion         = $_SESSION['fc'];
        $data['edicion'] = $edicion;
        $data['title']   = 'Mis Cédulas';
        $e_mail          = $_SESSION['username'];
        $data['onlyusername'] = strstr($e_mail,'@',true);

        $data['show_ubicaciones'] = $this->ubicaciones_model->show();
        $data['show_municipios'] = $this->municipios_model->show();
        $data['show_sedes'] = $this->sedes_model->show();
        $data['get_horarios'] = $this->horarios_model->get_horarios();

        $data['get_fc'] = $this->fc_model->get_fc();
        # Obtiene los años de cada edicion
        $edicionesTrabajo = array();
        $idsfcTrabajo = array();
        $fcTrabajo = false;
        foreach ($data['get_fc'] as $anio) {
            /** Se crea un arreglo de los Años de las Ediciones del FC */ 
            array_push($edicionesTrabajo, $anio->anio);
            /** Se crea un arreglo de los IDs de las Ediciones del FC */ 
            array_push($idsfcTrabajo, $anio->id_fc);
            /** Si el año Actual existe en la base de datos, obtengo su ID de la Edicion */ 
            if ( ($fcTrabajo == false) && ($anio->anio == anioActual) ) {
                $fcTrabajo = $anio->id_fc ;
            }
        }
        // Busca el anioActual dentro del arrey $edicionesTrabajo, devuelve el año Actual sino Falso.
        $anioTrabajo = (in_array(anioActual, $edicionesTrabajo)) ? anioActual : false ;
        $idfcTrabajo = (in_array($fcTrabajo, $idsfcTrabajo)) ? $fcTrabajo : false ;
        //$idfcTrabajo = in_array($fcTrabajo, $idsfcTrabajo);
        /**
        * Prepara las VARIABLES en un Arreglo para pasarlo como Parametro a la(s) vista(s)
        */
        $data['anioTrabajo'] = $anioTrabajo;
        $data['idfcTrabajo'] = $idfcTrabajo;
        $data['fcTrabajo']   = $fcTrabajo;
        
        $id_act        = ($this->input->post('id_act')) ? $this->input->post('id_act') : null ;
        $subactividad  = ($this->input->post('subactividad')) ? $this->input->post('subactividad') : null ;
        $fecha_taller  = ($this->input->post('fecha_taller')) ? $this->input->post('fecha_taller') : null ;
        $sede          = ($this->input->post('sede')) ? $this->input->post('sede') : null ;
        $ubicacion     = ($this->input->post('ubicacion')) ? $this->input->post('ubicacion') : null ;
        $hora_ini      = ($this->input->post('hora_ini')) ? $this->input->post('hora_ini') : null ;
        $hora_fin      = ($this->input->post('hora_fin')) ? $this->input->post('hora_fin') : null ;
        $status_subact = ($this->input->post('status_subact')) ? $this->input->post('status_subact') : null ;
        

        # Parametro que llega por Formulario
        $filtros = array(
            'id_act' => $id_act,
            'subactividad' => $subactividad,
            'fecha_taller' => $fecha_taller,
            'hora_ini' => $hora_ini,
            'hora_fin' => $hora_fin,
            'status_subact' => $status_subact,
            'sede' => $sede,
            'ubicacion' => $ubicacion
        );
        

        /**
        * LOGICA 
        *
        */
        if ( isset($id_subact) && isset($id_act) ) {
            // Get only one row con parametro
            $data['show_subactividades'] = $this->subactividades_model->show($id_subact,$id_act);
            $data['numero_registros'] = count($data['show_subactividades']);
        }
            else {
                // Gel all rows sin parametro
                $data['show_subactividades'] = $this->subactividades_model->show();
                $data['numero_registros'] = count($data['show_subactividades']);
            }
        /**
        * Carga las Vistas para el Usuario
        */
        $this->load->view('header_view',$data);
        $this->load->view('subactividades_list',$data);
        $this->load->view('footer_view',$data);
    }

    // Vista: Formulario para Agregar nueva ubicacion
    public function new_subact() {
        /** 
        * INICIALIZA VARIABLES LOCALES Y DE SESSION
        *
        */
        $grupo           = $_SESSION['grupo'];
        $data['grupo']   = $grupo;
        $id_coord        = $_SESSION['id_coord'];
        $edicion         = $_SESSION['fc'];
        $data['edicion'] = $edicion;
        $data['title']   = 'Mis Cédulas';
        $e_mail          = $_SESSION['username'];
        $data['onlyusername'] = strstr($e_mail,'@',true);
        
        $data['show_ubicaciones'] = $this->ubicaciones_model->show();
        $data['show_sedes'] = $this->sedes_model->show();
        $data['get_horarios'] = $this->horarios_model->get_horarios();

        $data['get_fc'] = $this->fc_model->get_fc();
        # Obtiene los años de cada edicion
        $edicionesTrabajo = array();
        $idsfcTrabajo = array();
        $fcTrabajo = false;
        foreach ($data['get_fc'] as $anio) {
            /** Se crea un arreglo de los Años de las Ediciones del FC */ 
            array_push($edicionesTrabajo, $anio->anio);
            /** Se crea un arreglo de los IDs de las Ediciones del FC */ 
            array_push($idsfcTrabajo, $anio->id_fc);
            /** Si el año Actual existe en la base de datos, obtengo su ID de la Edicion */ 
            if ( ($fcTrabajo == false) && ($anio->anio == anioActual) ) {
                $fcTrabajo = $anio->id_fc ;
            }
        }
        // Busca el anioActual dentro del arrey $edicionesTrabajo, devuelve el año Actual sino Falso.
        $anioTrabajo = (in_array(anioActual, $edicionesTrabajo)) ? anioActual : false ;
        $idfcTrabajo = (in_array($fcTrabajo, $idsfcTrabajo)) ? $fcTrabajo : false ;
        //$idfcTrabajo = in_array($fcTrabajo, $idsfcTrabajo);
        /**
        * Prepara las VARIABLES en un Arreglo para pasarlo como Parametro a la(s) vista(s)
        */
        $data['anioTrabajo'] = $anioTrabajo;
        $data['idfcTrabajo'] = $idfcTrabajo;
        $data['fcTrabajo']   = $fcTrabajo;

        /**
        * Carga las Vistas para el Usuario
        */
        $this->load->view('header_view',$data);
        $this->load->view('subactividades_new_view',$data);
        $this->load->view('footer_view',$data);    
    }

    // Agregar ubicacion a la BD, por POST
    public function add() {
		$e_mail = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $edicion;
        $data['title']= 'Mis Cédulas';
        $data['onlyusername'] = strstr($e_mail,'@',true);
        $data['get_fc'] = $this->fc_model->get_fc();
        
        $data['show_municipios'] = $this->ubicaciones_model->show();
        $data['show_ubicaciones'] = $this->municipios_model->show();
        $data['show_sedes'] = $this->sedes_model->show();
        $data['get_horarios'] = $this->horarios_model->get_horarios();

        $data['get_fc'] = $this->fc_model->get_fc();
        # Obtiene los años de cada edicion
        $edicionesTrabajo = array();
        $idsfcTrabajo = array();
        $fcTrabajo = false;
        foreach ($data['get_fc'] as $anio) {
            /** Se crea un arreglo de los Años de las Ediciones del FC */ 
            array_push($edicionesTrabajo, $anio->anio);
            /** Se crea un arreglo de los IDs de las Ediciones del FC */ 
            array_push($idsfcTrabajo, $anio->id_fc);
            /** Si el año Actual existe en la base de datos, obtengo su ID de la Edicion */ 
            if ( ($fcTrabajo == false) && ($anio->anio == anioActual) ) {
                $fcTrabajo = $anio->id_fc ;
            }
        }
        // Busca el anioActual dentro del arrey $edicionesTrabajo, devuelve el año Actual sino Falso.
        $anioTrabajo = (in_array(anioActual, $edicionesTrabajo)) ? anioActual : false ;
        $idfcTrabajo = (in_array($fcTrabajo, $idsfcTrabajo)) ? $fcTrabajo : false ;
        //$idfcTrabajo = in_array($fcTrabajo, $idsfcTrabajo);
        /**
        * Prepara las VARIABLES en un Arreglo para pasarlo como Parametro a la(s) vista(s)
        */
        $data['anioTrabajo'] = $anioTrabajo;
        $data['idfcTrabajo'] = $idfcTrabajo;
        $data['fcTrabajo']   = $fcTrabajo;

        $subactividad = array(
            'id_act' => $this->input->post('id_act'),
            'subactividad' => $this->input->post('subactividad'),
            'fecha_taller' => $this->input->post('fecha_taller'),            
            'sede' => $this->input->post('sede'),
            'ubicacion' => $this->input->post('ubicacion'),
            'hora_ini' => $this->input->post('hora_ini'),
            'hora_fin' => $this->input->post('hora_fin'),
            'status_subact' => $this->input->post('status_subact')            
        );

        // Controller que solcitó
        $objeto = $this->input->post('objeto');
        
        $agregado = $this->subactividades_model->insert($subactividad);

        if ( isset($agregado) || !empty($agregado) || $agregado == true ) {
            if ( isset($objeto) || !empty($objeto) ) {
                switch ($objeto) {
                    case 'actividades':
                        redirect(base_url('actividades/editar_fechas_act')."/".$subactividad['id_act']);
                        break;
                    case 'subactividades':
                        redirect(base_url('subactividades/show'));
                        break;
                }
            }
        }
        
	}

    // Vista: Formulario para Editar una ubicacion, por URL
    public function edit($id_subact = null) {
        /** 
        * INICIALIZA VARIABLES LOCALES Y DE SESSION
        *
        */
        $grupo           = $_SESSION['grupo'];
        $data['grupo']   = $grupo;
        $id_coord        = $_SESSION['id_coord'];
        $edicion         = $_SESSION['fc'];
        $data['edicion'] = $edicion;
        $data['title']   = 'Mis Cédulas';
        $e_mail          = $_SESSION['username'];
        $data['onlyusername'] = strstr($e_mail,'@',true);
        
        $data['show_municipios'] = $this->ubicaciones_model->show();
        $data['show_ubicaciones'] = $this->municipios_model->show();
        $data['show_sedes'] = $this->sedes_model->show();
        $data['get_horarios'] = $this->horarios_model->get_horarios();

        $data['get_fc'] = $this->fc_model->get_fc();
        # Obtiene los años de cada edicion
        $edicionesTrabajo = array();
        $idsfcTrabajo = array();
        $fcTrabajo = false;
        foreach ($data['get_fc'] as $anio) {
            /** Se crea un arreglo de los Años de las Ediciones del FC */ 
            array_push($edicionesTrabajo, $anio->anio);
            /** Se crea un arreglo de los IDs de las Ediciones del FC */ 
            array_push($idsfcTrabajo, $anio->id_fc);
            /** Si el año Actual existe en la base de datos, obtengo su ID de la Edicion */ 
            if ( ($fcTrabajo == false) && ($anio->anio == anioActual) ) {
                $fcTrabajo = $anio->id_fc ;
            }
        }
        // Busca el anioActual dentro del arrey $edicionesTrabajo, devuelve el año Actual sino Falso.
        $anioTrabajo = (in_array(anioActual, $edicionesTrabajo)) ? anioActual : false ;
        $idfcTrabajo = (in_array($fcTrabajo, $idsfcTrabajo)) ? $fcTrabajo : false ;
        //$idfcTrabajo = in_array($fcTrabajo, $idsfcTrabajo);
        /**
        * Prepara las VARIABLES en un Arreglo para pasarlo como Parametro a la(s) vista(s)
        */
        $data['anioTrabajo'] = $anioTrabajo;
        $data['idfcTrabajo'] = $idfcTrabajo;
        $data['fcTrabajo']   = $fcTrabajo;

        if ( isset($id_subact) ) {
            // Get only one row con parametro
            $show_subactividades = $this->subactividades_model->show($id_subact);
            foreach ($show_subactividades as $subact) {
                $data['id_subact'] = $subact->id_subact;
                $data['subactividad'] = $subact->subactividad;
                $data['id_act'] = $subact->id_act;
                $data['sede'] = $subact->sede;
                $data['ubicacion'] = $subact->ubicacion;
                $data['fecha_taller'] = $subact->fecha_taller;
                $data['hora_ini'] = $subact->hora_ini;
                $data['hora_fin'] = $subact->hora_fin;
                $data['status_subact'] = $subact->status_subact;
            }
        }

        /**
        * Carga las Vistas para el Usuario
        */
        $this->load->view('header_view',$data);
        $this->load->view('subactividades_edit_view',$data);
        $this->load->view('footer_view',$data);    
    }

    // Actualizar datos de una ubicacion, por POST
    public function update() {
        $e_mail = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $edicion;
        $data['title']= 'Mis Cédulas';
        $data['onlyusername'] = strstr($e_mail,'@',true);
        $data['get_fc'] = $this->fc_model->get_fc();
        
        $data['show_municipios'] = $this->ubicaciones_model->show();
        $data['show_ubicaciones'] = $this->municipios_model->show();
        $data['show_sedes'] = $this->sedes_model->show();
        $data['get_horarios'] = $this->horarios_model->get_horarios();

        $data['get_fc'] = $this->fc_model->get_fc();
        # Obtiene los años de cada edicion
        $edicionesTrabajo = array();
        $idsfcTrabajo = array();
        $fcTrabajo = false;
        foreach ($data['get_fc'] as $anio) {
            /** Se crea un arreglo de los Años de las Ediciones del FC */ 
            array_push($edicionesTrabajo, $anio->anio);
            /** Se crea un arreglo de los IDs de las Ediciones del FC */ 
            array_push($idsfcTrabajo, $anio->id_fc);
            /** Si el año Actual existe en la base de datos, obtengo su ID de la Edicion */ 
            if ( ($fcTrabajo == false) && ($anio->anio == anioActual) ) {
                $fcTrabajo = $anio->id_fc ;
            }
        }
        // Busca el anioActual dentro del arrey $edicionesTrabajo, devuelve el año Actual sino Falso.
        $anioTrabajo = (in_array(anioActual, $edicionesTrabajo)) ? anioActual : false ;
        $idfcTrabajo = (in_array($fcTrabajo, $idsfcTrabajo)) ? $fcTrabajo : false ;
        //$idfcTrabajo = in_array($fcTrabajo, $idsfcTrabajo);
        /**
        * Prepara las VARIABLES en un Arreglo para pasarlo como Parametro a la(s) vista(s)
        */
        $data['anioTrabajo'] = $anioTrabajo;
        $data['idfcTrabajo'] = $idfcTrabajo;
        $data['fcTrabajo']   = $fcTrabajo;

        $subactividad = array(
            'id_subact'     => $this->input->post('id_subact'),
            'id_act'        => $this->input->post('id_act'),
            'subactividad'  => $this->input->post('subactividad'),
            'fecha_taller'  => $this->input->post('fecha_taller'),
            'sede'          => $this->input->post('sede'),
            'ubicacion'     => $this->input->post('ubicacion'),
            'hora_ini'      => $this->input->post('hora_ini'),
            'hora_fin'      => $this->input->post('hora_fin'),
            'status_subact' => $this->input->post('status_subact')
        );

        // Controller que solcitó
        $objeto = $this->input->post('objeto');

        $updated = $this->subactividades_model->update($subactividad);

        if ( isset($updated) || !empty($updated) || $updated == true ) {
            if ( isset($objeto) || !empty($objeto) ) {
                switch ($objeto) {
                    case 'actividades':
                        // Redirecciona al Calendario y Programa Detallado
                        redirect(base_url('actividades/editar_fechas_act')."/".$subactividad['id_act']);
                        break;
                    case 'subactividades':
                        // Redirecciona al Módulo de Subactividades
                        redirect(base_url('subactividades/show'));
                        break;
                    case 'mastercontenido':
                        // Redirecciona al Módulo de Subactividades
                        redirect(base_url('actividades/master_contenidos'));
                        break;
                }
            }
        }
    }

    // Actualizar datos de una ubicacion, por POST
    public function delete($id_subact = null, $id_act = null, $objeto = null) {
        $e_mail = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        
        $data['edicion']  = $edicion;
        $data['title']= 'Mis Cédulas';
        $data['onlyusername'] = strstr($e_mail,'@',true);
        $data['get_fc'] = $this->fc_model->get_fc();
        
        $data['show_municipios'] = $this->ubicaciones_model->show();
        $data['show_ubicaciones'] = $this->municipios_model->show();
        $data['show_sedes'] = $this->sedes_model->show();

        $data['get_fc'] = $this->fc_model->get_fc();
        # Obtiene los años de cada edicion
        $edicionesTrabajo = array();
        $idsfcTrabajo = array();
        $fcTrabajo = false;
        foreach ($data['get_fc'] as $anio) {
            /** Se crea un arreglo de los Años de las Ediciones del FC */ 
            array_push($edicionesTrabajo, $anio->anio);
            /** Se crea un arreglo de los IDs de las Ediciones del FC */ 
            array_push($idsfcTrabajo, $anio->id_fc);
            /** Si el año Actual existe en la base de datos, obtengo su ID de la Edicion */ 
            if ( ($fcTrabajo == false) && ($anio->anio == anioActual) ) {
                $fcTrabajo = $anio->id_fc ;
            }
        }
        // Busca el anioActual dentro del arrey $edicionesTrabajo, devuelve el año Actual sino Falso.
        $anioTrabajo = (in_array(anioActual, $edicionesTrabajo)) ? anioActual : false ;
        $idfcTrabajo = (in_array($fcTrabajo, $idsfcTrabajo)) ? $fcTrabajo : false ;
        //$idfcTrabajo = in_array($fcTrabajo, $idsfcTrabajo);
        /**
        * Prepara las VARIABLES en un Arreglo para pasarlo como Parametro a la(s) vista(s)
        */
        $data['anioTrabajo'] = $anioTrabajo;
        $data['idfcTrabajo'] = $idfcTrabajo;
        $data['fcTrabajo']   = $fcTrabajo;

        $deleted = $this->subactividades_model->delete($id_subact);

        if ( isset($deleted) || !empty($deleted) || $deleted == true ) {
            if ( isset($objeto) || !empty($objeto) ) {
                switch ($objeto) {
                    case 'actividades':
                        redirect(base_url('actividades/editar_fechas_act')."/".$id_act);
                        break;
                    case 'subactividades':
                        redirect(base_url('subactividades/show'));
                        break;
                }
            }
        }        
    }

    function repetir($id_subact = null, $objeto = null){

        if ( isset($id_subact) AND isset($objeto) ) {

            // Get only one row con parametro
            $subacti = $this->subactividades_model->show($id_subact);
            foreach ($subacti as $key => $value) {
                
                $subactividad = array(
                    'id_act'        => $value->id_act,
                    'subactividad'  => $value->subactividad,
                    'fecha_taller'  => $value->fecha_taller,
                    'sede'          => $value->sede,
                    'ubicacion'     => $value->ubicacion,
                    'hora_ini'      => $value->hora_ini,
                    'hora_fin'      => $value->hora_fin,
                    'status_subact' => $value->status_subact
                );
            }
            
            $agregado = $this->subactividades_model->insert($subactividad);

            if ( isset($agregado) AND !empty($agregado) AND $agregado == true ) {
                if ( isset($objeto) AND !empty($objeto) ) {
                    switch ($objeto) {
                        case 'actividades':
                            redirect(base_url('actividades/editar_fechas_act')."/".$subactividad['id_act']);
                            break;
                        case 'subactividades':
                            redirect(base_url('subactividades/show'));
                            break;
                    }
                }
            }
                #var_dump($subactividad['subactividad']);
                #redirect('ups.html');            
        }         
    }

    // Actualizar datos 
    public function ortografia() {
        $e_mail = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $edicion;
        $data['title']= 'Mis Cédulas';
        $data['onlyusername'] = strstr($e_mail,'@',true);
        $data['get_fc'] = $this->fc_model->get_fc();
        
        $ortografia = array(
            'id_subact'         => $this->input->post('id_subact'),
            'id_act'            => $this->input->post('id_act'),
            'status_ortografia' => $this->input->post('status_ortografia')
        );

        #var_dump($ortografia['status_ortografia']); die();

        $updated = $this->subactividades_model->update_status($ortografia);

        if (isset($updated) AND $updated == true) {
            print($updated);
        } else {
            print("ERROR, NO SE ACTUALIZO STATUS");
        }        
    }

    // Actualizar datos de una ubicacion, por POST
    public function autoriza_contenido() {
        $e_mail = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $edicion;
        $data['title']= 'Mis Cédulas';
        $data['onlyusername'] = strstr($e_mail,'@',true);
        $data['get_fc'] = $this->fc_model->get_fc();
        
        $contenido = array(
            'id_subact'         => $this->input->post('id_subact'),
            'id_act'            => $this->input->post('id_act'),
            'status_contenido'  => $this->input->post('status_contenido')#{0 = pendiente, 1 = autorizado}
        );

        $id_act = $contenido['id_act'];

        $updated = $this->subactividades_model->update_status_contenido($contenido);

        # Numero de registros "Pendientes"
        $status_contenido = 0;
        $registros_pendientes = $this->subactividades_model->num_registros($status_contenido,$id_act);

        if (isset($updated) AND $updated == true) {

                    # code... PENDIENTE
                    if ($registros_pendientes > 0) {
                        # code...
                        $this->actividades_model->pendiente($id_act,$pend = 0);
                    }
                    #redirect(base_url('actividades/editar_fechas_act')."/".$status_contenido['id_act']);
            
                    # code... APROBADO CONCEPTUAL
                    if ($registros_pendientes <= 0) {
                        # code...
                        $this->actividades_model->si_autorizar($id_act,$succes = 2);
                    }                    
                    #redirect(base_url('actividades/editar_fechas_act')."/".$status_contenido['id_act']);
            

        } else {
                print("ERROR, NO SE ACTUALIZO STATUS DE LA SUBACTIVIDAD");
            }

    }
    
    public function num_registros(){
        
        $id_act            = $this->input->post('id_act');
        $status_contenido  = $this->input->post('status_contenido');#{0 = pendiente, 2 = autorizado}
        
        $registros_pendientes = $this->subactividades_model->num_registros($status_contenido,$id_act);
        return print $registros_pendientes;
    }


}

/* End of file subactividades.php */
/* Location: ./application/controllers/subactividades.php */