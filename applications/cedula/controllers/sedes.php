<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sedes extends CI_Controller {
	
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
        $this->load->model('sedes_model');
        $this->load->model('municipios_model');
        $this->load->model('fc_model');

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
        $data['title']   = 'Mis Cédulas';
        $e_mail          = $_SESSION['username'];
		$data['onlyusername'] = strstr($e_mail,'@',true);
        
        /**
        * LOGICA 
        *
        */
		#$data['get_sedes'] = $this->sedes_model->get();
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
		$this->load->view('sedes_view',$data);
        $this->load->view('footer_view',$data);    
    }

    // Lista y Filtra Sedes, Todas, por Municipio ó por ID, por URL
	public function show($id_sede = null,$id_mun = null) {
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

        $data['show_municipios'] = $this->municipios_model->show();

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
        $id_mun = $this->input->post('id_mun');

        /**
        * LOGICA 
        *
        */
        if ( isset($id_sede) OR !empty($id_mun) ) {
            // Get only one row con parametro
            $data['show_sedes'] = $this->sedes_model->show($id_sede,$id_mun);
            $data['numero_registros'] = count($data['show_sedes']);
        }
            else {
                // Gel all rows sin parametro
                $data['show_sedes'] = $this->sedes_model->show();
                $data['numero_registros'] = count($data['show_sedes']);
            }
        /**
        * Carga las Vistas para el Usuario
        */
        $this->load->view('header_view',$data);
        $this->load->view('sedes_list',$data);
        $this->load->view('footer_view',$data);
    }

    // Vista: Formulario para Agregar nueva Sede
    public function new_sede() {
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
        $data['show_municipios'] = $this->municipios_model->show();

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
        $this->load->view('sedes_new_view',$data);
        $this->load->view('footer_view',$data);    
    }

    // Agregar Sede a la BD, por POST
    public function add() {
		$e_mail = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $edicion;
        $data['title']= 'Mis Cédulas';
        $data['onlyusername'] = strstr($e_mail,'@',true);
        $data['get_fc'] = $this->fc_model->get_fc();
        
        $data['show_municipios'] = $this->municipios_model->show();

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

        $sede = array(
            'sede' => $this->input->post('sede'),
            'id_mun' => $this->input->post('id_mun')
        );

        $id_sede = $this->sedes_model->insert($sede);
        if ( isset($id_sede) ) {
            /**
            * Carga las Vistas para el Usuario
            */
            $this->show($id_sede);            
        }
            else {
                /**
                * Carga las Vistas para el Usuario
                */
                $this->show();                
            }
	}

    // Vista: Formulario para Editar una Sede, por URL
    public function edit_sede($id_sede = null) {
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
        $data['show_municipios'] = $this->municipios_model->show();

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

        if ( isset($id_sede) ) {
            // Get only one row con parametro
            $show_sedes = $this->sedes_model->show($id_sede);
            foreach ($show_sedes as $sede) {
                $data['id_sede'] = $sede->id_sede;
                $data['sede'] = $sede->sede;
                $data['id_mun'] = $sede->id_mun;
            }
        }
            else {
                // Gel all rows sin parametro
                echo "error";
            }

        /**
        * Carga las Vistas para el Usuario
        */
        $this->load->view('header_view',$data);
        $this->load->view('sedes_edit_view',$data);
        $this->load->view('footer_view',$data);    
    }

    // Actualizar datos de una Sede, por POST
    public function update() {
        $e_mail = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $edicion;
        $data['title']= 'Mis Cédulas';
        $data['onlyusername'] = strstr($e_mail,'@',true);
        $data['get_fc'] = $this->fc_model->get_fc();
        
        $data['show_municipios'] = $this->municipios_model->show();

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

        $sede = array(
            'id_sede' => $this->input->post('id_sede'),
            'sede' => $this->input->post('sede'),
            'id_mun' => $this->input->post('id_mun')
        );

        $id_sede = $this->sedes_model->update($sede);
        if ( isset($id_sede) ) {
            /**
            * Carga las Vistas para el Usuario
            */
            $this->show($id_sede);            
        }
            else {
                /**
                * Carga las Vistas para el Usuario
                */
                $this->show();                
            }
    }
    

}

/* End of file sedes.php */
/* Location: ./application/controllers/sedes.php */