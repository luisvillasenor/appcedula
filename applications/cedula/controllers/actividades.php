<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Actividades extends CI_Controller {
	public function __construct(){ /* Esta funcion debe de ir en cada controlador para verificar si la sesion y el usuario siguen conectados */
		session_start();
		parent::__construct();
        $this->load->library('email');
        $this->load->model('ubicaciones_model');
        $this->load->model('municipios_model');
        $this->load->model('sedes_model');
        $this->load->model('fc_model');
        $this->load->model('subactividades_model');
		if ( !isset($_SESSION['username'])){
			redirect(base_url('admin/logout')); // Redirecciona la controlador "admin/logout"
		}
        $date = new DateTime();
        $anioActual = $date->format('Y'); // Calcula en año actual
        define('anioActual', $anioActual);
	}

    public function index(){
        // Defini variables de la session
        $e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $data['grupo'] = $grupo;
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $edicion;
        $data['title']= 'Mis Cédulas';
		$data['onlyusername'] = strstr($e_mail,'@',true);
		
        // Carga los modulos a utilizar en la vista inicial
        $this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('categorias_model');
        $this->load->model('coordinadores_model');
        $this->load->model('comentarios_model');
        
        // Obtiene el Costo Secture Total de todas las cedulas del usuario y año de trabajo
        $data['get_total_cedulas'] = $this->actividades_model->get_total_cedulas($e_mail,$edicion);

        // Cuenta el numero de registros de las necesidades del presupuesto por cada cedula
        $data['get_registros'] = $this->necesidades_model->get_registros();

        // Carga listado de Categorias segun el Grupo y Id Coordinador del usuario
        $data['get_categorias'] = $this->categorias_model->get_categorias($id_coord,$grupo);

        // Carga listado de todas las categorias
        $data['get_all_cats'] = $this->categorias_model->get_all_cats();

        // Carga listado de todas las ediciones de trabajo
        $data['get_fc'] = $this->fc_model->get_fc();
        // Obtiene los registros de los años de cada edicion
        
        // Obtiene los años de cada edicion
        $edicionesTrabajo = array();
        $idsfcTrabajo = array();
        $fcTrabajo = false;
        foreach ($data['get_fc'] as $anio) {
            array_push($edicionesTrabajo, $anio->anio);
            array_push($idsfcTrabajo, $anio->id_fc);
            if ( ($fcTrabajo == false) && ($anio->anio == anioActual) ) {
                $fcTrabajo = $anio->id_fc ;
            }
        }
        // Busca el anioActual dentro del arrey $edicionesTrabajo, devuelve false sino existe dentro.
        $anioTrabajo = in_array(anioActual, $edicionesTrabajo);
        $idfcTrabajo = in_array($fcTrabajo, $idsfcTrabajo);

        $data['anioTrabajo'] = $anioTrabajo;
        $data['idfcTrabajo'] = $idfcTrabajo;
        $data['fcTrabajo']   = $fcTrabajo;


        // Carga listado de todos los coordinadores
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();

        foreach ($data['get_all_coords'] as $coords ) {
            if($id_coord == $coords->id_coord) {
                // Define la Coordinacion que pertenece el usuario
                $data['miCoordinacion']= $coords->coordinacion;
            }
        }
        // Obtiene todas las actividades del usuario, de su grupo, de su coordinacion y año de trabajo        
		$data['get_all_actividades'] = $this->actividades_model->get_all_actividades($e_mail,$grupo,$id_coord,$edicion);

        // ***********************
        $data['get_resp'] = $this->actividades_model->get_resp($e_mail,$grupo,$id_coord,$edicion);
        $data['get_reg'] = $this->actividades_model->get_reg($e_mail,$id_coord,$edicion);

        // Por cada cedula
        // Calcula
        $pres_aut = 0;
        $costo_secture = 0;
        $pres_eje = 0;
        $fuera_pres = 0;

            if ( ! empty($data['get_all_actividades']) ) {
                foreach ($data['get_all_actividades'] as $key => $value) {
                    if ($value->status_act != 6) { // Fuera de Presupuesto
                        $pres_aut = $pres_aut + $value->pres_aut;
                        $costo_secture = $costo_secture + $value->costo_secture;
                        $pres_eje = $pres_eje + $value->pres_eje;               
                    }else{
                        $fuera_pres = $fuera_pres + $value->costo_secture;
                    }
                }
            }
        // Se guardan los calculos para usarse en la Vista
        $data['suma_pres_aut']      = $pres_aut;
        $data['suma_costo_secture'] = $costo_secture;
        $data['suma_pres_eje']      = $pres_eje;
        $data['suma_fuera_pres']    = $fuera_pres;
                
		$this->load->view('header_view',$data); 
        $this->load->view('actividades_view',$data);
        $this->load->view('footer_view',$data); 
	}
    public function resumen(){
        
        $e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $data['grupo'] = $grupo;
        $id_coord = $_SESSION['id_coord'];
        $data['title']= 'Mis Cédulas';
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('categorias_model');
        $this->load->model('coordinadores_model');
        $this->load->model('comentarios_model');
        //$this->load->model('responsables_model');                
        $data['get_total_cedulas'] = $this->actividades_model->get_total_cedulas($e_mail,$edicion);
        $data['get_registros'] = $this->necesidades_model->get_registros();
        $data['get_categorias'] = $this->categorias_model->get_categorias($id_coord,$grupo);
        $data['get_all_cats'] = $this->categorias_model->get_all_cats();
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
        //$data['get_total_act'] = $this->necesidades_model->get_total_act($id_act);
        
		$data['get_all_actividades'] = $this->actividades_model->get_all_actividades($e_mail,$grupo,$id_coord,$edicion);
        $data['get_resp'] = $this->actividades_model->get_resp($e_mail,$grupo,$id_coord);
        // Numero de Registros Totales
        $data['get_reg'] = $this->actividades_model->get_reg($e_mail,$id_coord);
        foreach ($data['get_reg'] as $regs ) {
            $data['num_regs']= $regs->tot;                        
        }
        // Numero de Registros Pendientes
        $data['get_regs_pendientes'] = $this->actividades_model->get_regs_pendientes($e_mail,$id_coord);
        foreach ($data['get_regs_pendientes'] as $regs_p ) {
            $data['num_regs_p']= $regs_p->tot;                        
        }
        // Numero de Registros Aprobados
        $data['get_regs_aprobados'] = $this->actividades_model->get_regs_aprobados($e_mail,$id_coord);
        foreach ($data['get_regs_aprobados'] as $regs_a ) {
            $data['num_regs_a']= $regs_a->tot;                        
        }
        // Numero de Registros No Aprobados
        $data['get_regs_Noaprobados'] = $this->actividades_model->get_regs_Noaprobados($e_mail,$id_coord);
        foreach ($data['get_regs_Noaprobados'] as $regs_Noa ) {
            $data['num_regs_Noa']= $regs_Noa->tot;                        
        }
                
		$this->load->view('header_view',$data); 
        $this->load->view('resumen_view',$data);
        $this->load->view('footer_view',$data); 
	}
    /***** FUNCIONES PARA EL FILTRO DE CÉDULAS *****/
    public function ordenar_id_asc(){ 
		$e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $data['grupo'] = $grupo;
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
        $data['title']= 'Mis Cédulas';
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('categorias_model');
        $this->load->model('coordinadores_model');
        $this->load->model('comentarios_model');
        //$this->load->model('responsables_model');                
        $data['get_total_cedulas'] = $this->actividades_model->get_total_cedulas($e_mail,$edicion);
        $data['get_registros'] = $this->necesidades_model->get_registros();
        $data['get_categorias'] = $this->categorias_model->get_categorias($id_coord,$grupo);
        $data['get_all_cats'] = $this->categorias_model->get_all_cats();
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {    
            if($id_coord == $coords->id_coord) {                
                $data['miCoordinacion']= $coords->coordinacion;
            }
        }


        // Obtiene los años de cada edicion
        $edicionesTrabajo = array();
        $idsfcTrabajo = array();
        $fcTrabajo = false;
        foreach ($data['get_fc'] as $anio) {
            array_push($edicionesTrabajo, $anio->anio);
            array_push($idsfcTrabajo, $anio->id_fc);
            if ( ($fcTrabajo == false) && ($anio->anio == anioActual) ) {
                $fcTrabajo = $anio->id_fc ;
            }
        }
        // Busca el anioActual dentro del arrey $edicionesTrabajo, devuelve false sino existe dentro.
        $anioTrabajo = in_array(anioActual, $edicionesTrabajo);
        $idfcTrabajo = in_array($fcTrabajo, $idsfcTrabajo);

        $data['anioTrabajo'] = $anioTrabajo;
        $data['idfcTrabajo'] = $idfcTrabajo;
        $data['fcTrabajo']   = $fcTrabajo;


        
		$data['get_all_orderbyID_asc'] = $this->actividades_model->get_all_orderbyID_asc($e_mail,$grupo,$id_coord,$edicion);
        $data['get_all_actividades'] = $this->actividades_model->get_all_actividades($e_mail,$grupo,$id_coord,$edicion);
        $data['get_resp'] = $this->actividades_model->get_resp($e_mail,$grupo,$id_coord);
        $data['get_reg'] = $this->actividades_model->get_reg($e_mail,$id_coord,$edicion);

        $pres_aut = 0;
        $costo_secture = 0;
        $pres_eje = 0;

        if ( ! empty($data['get_all_orderbyID_asc']) ) {
            foreach ($data['get_all_orderbyID_asc'] as $key => $value) {            
                $pres_aut = $pres_aut + $value->pres_aut;
                $costo_secture = $costo_secture + $value->costo_secture;
                $pres_eje = $pres_eje + $value->pres_eje;            
            }
        }
        
        $data['suma_pres_aut']      = $pres_aut;
        $data['suma_costo_secture'] = $costo_secture;
        $data['suma_pres_eje']      = $pres_eje;
        
		$this->load->view('header_view',$data); 
        $this->load->view('actividades_order_id_asc_view',$data);        
        $this->load->view('footer_view',$data); 
	}
    public function ordenar_id_desc(){
		$e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $data['grupo'] = $grupo;
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
        $data['title']= 'Mis Cédulas';
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('categorias_model');
        $this->load->model('coordinadores_model');
        $this->load->model('comentarios_model');
        //$this->load->model('responsables_model');                
        $data['get_total_cedulas'] = $this->actividades_model->get_total_cedulas($e_mail,$edicion);
        $data['get_registros'] = $this->necesidades_model->get_registros();
        $data['get_categorias'] = $this->categorias_model->get_categorias($id_coord,$grupo);
        $data['get_all_cats'] = $this->categorias_model->get_all_cats();
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }


        // Obtiene los años de cada edicion
        $edicionesTrabajo = array();
        $idsfcTrabajo = array();
        $fcTrabajo = false;
        foreach ($data['get_fc'] as $anio) {
            array_push($edicionesTrabajo, $anio->anio);
            array_push($idsfcTrabajo, $anio->id_fc);
            if ( ($fcTrabajo == false) && ($anio->anio == anioActual) ) {
                $fcTrabajo = $anio->id_fc ;
            }
        }
        // Busca el anioActual dentro del arrey $edicionesTrabajo, devuelve false sino existe dentro.
        $anioTrabajo = in_array(anioActual, $edicionesTrabajo);
        $idfcTrabajo = in_array($fcTrabajo, $idsfcTrabajo);

        $data['anioTrabajo'] = $anioTrabajo;
        $data['idfcTrabajo'] = $idfcTrabajo;
        $data['fcTrabajo']   = $fcTrabajo;


        
		$data['get_all_orderbyID_desc'] = $this->actividades_model->get_all_orderbyID_desc($e_mail,$grupo,$id_coord,$edicion);
        $data['get_all_actividades'] = $this->actividades_model->get_all_actividades($e_mail,$grupo,$id_coord,$edicion);
        $data['get_resp'] = $this->actividades_model->get_resp($e_mail,$grupo,$id_coord);
        $data['get_reg'] = $this->actividades_model->get_reg($e_mail,$id_coord,$edicion);

        $pres_aut = 0;
        $costo_secture = 0;
        $pres_eje = 0;

        if ( ! empty($data['get_all_orderbyID_desc']) ) {
            foreach ($data['get_all_orderbyID_desc'] as $key => $value) {            
                $pres_aut = $pres_aut + $value->pres_aut;
                $costo_secture = $costo_secture + $value->costo_secture;
                $pres_eje = $pres_eje + $value->pres_eje;            
            }
        }
        
        $data['suma_pres_aut']      = $pres_aut;
        $data['suma_costo_secture'] = $costo_secture;
        $data['suma_pres_eje']      = $pres_eje;
        
		$this->load->view('header_view',$data); 
        $this->load->view('actividades_order_id_desc_view',$data);        
        $this->load->view('footer_view',$data); 
	}
    public function ordenar_act_asc(){
		$e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $data['grupo'] = $grupo;
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
        $data['title']= 'Mis Cédulas';
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('categorias_model');
        $this->load->model('coordinadores_model');
        $this->load->model('comentarios_model');
        //$this->load->model('responsables_model');                
        $data['get_total_cedulas'] = $this->actividades_model->get_total_cedulas($e_mail,$edicion,$edicion);
        $data['get_registros'] = $this->necesidades_model->get_registros();
        $data['get_categorias'] = $this->categorias_model->get_categorias($id_coord,$grupo);
        $data['get_all_cats'] = $this->categorias_model->get_all_cats();
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }

        // Obtiene los años de cada edicion
        $edicionesTrabajo = array();
        $idsfcTrabajo = array();
        $fcTrabajo = false;
        foreach ($data['get_fc'] as $anio) {
            array_push($edicionesTrabajo, $anio->anio);
            array_push($idsfcTrabajo, $anio->id_fc);
            if ( ($fcTrabajo == false) && ($anio->anio == anioActual) ) {
                $fcTrabajo = $anio->id_fc ;
            }
        }
        // Busca el anioActual dentro del arrey $edicionesTrabajo, devuelve false sino existe dentro.
        $anioTrabajo = in_array(anioActual, $edicionesTrabajo);
        $idfcTrabajo = in_array($fcTrabajo, $idsfcTrabajo);

        $data['anioTrabajo'] = $anioTrabajo;
        $data['idfcTrabajo'] = $idfcTrabajo;
        $data['fcTrabajo']   = $fcTrabajo;


        
		$data['get_all_orderbyACT_asc'] = $this->actividades_model->get_all_orderbyACT_asc($e_mail,$grupo,$id_coord,$edicion);
        $data['get_all_actividades'] = $this->actividades_model->get_all_actividades($e_mail,$grupo,$id_coord,$edicion);
        $data['get_resp'] = $this->actividades_model->get_resp($e_mail,$grupo,$id_coord);
        $data['get_reg'] = $this->actividades_model->get_reg($e_mail,$id_coord,$edicion);

        $pres_aut = 0;
        $costo_secture = 0;
        $pres_eje = 0;

        if ( ! empty($data['get_all_orderbyACT_asc']) ) {
            foreach ($data['get_all_orderbyACT_asc'] as $key => $value) {            
                $pres_aut = $pres_aut + $value->pres_aut;
                $costo_secture = $costo_secture + $value->costo_secture;
                $pres_eje = $pres_eje + $value->pres_eje;            
            }
        }
        
        $data['suma_pres_aut']      = $pres_aut;
        $data['suma_costo_secture'] = $costo_secture;
        $data['suma_pres_eje']      = $pres_eje;
        
		$this->load->view('header_view',$data); 
        $this->load->view('actividades_order_act_asc_view',$data);        
        $this->load->view('footer_view',$data); 
	}
    public function ordenar_act_desc(){
		$e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $data['grupo'] = $grupo;
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
        $data['title']= 'Mis Cédulas';
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('categorias_model');
        $this->load->model('coordinadores_model');
        $this->load->model('comentarios_model');
        //$this->load->model('responsables_model');                
        $data['get_total_cedulas'] = $this->actividades_model->get_total_cedulas($e_mail,$edicion);
        $data['get_registros'] = $this->necesidades_model->get_registros();
        $data['get_categorias'] = $this->categorias_model->get_categorias($id_coord,$grupo);
        $data['get_all_cats'] = $this->categorias_model->get_all_cats();
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }

        // Obtiene los años de cada edicion
        $edicionesTrabajo = array();
        $idsfcTrabajo = array();
        $fcTrabajo = false;
        foreach ($data['get_fc'] as $anio) {
            array_push($edicionesTrabajo, $anio->anio);
            array_push($idsfcTrabajo, $anio->id_fc);
            if ( ($fcTrabajo == false) && ($anio->anio == anioActual) ) {
                $fcTrabajo = $anio->id_fc ;
            }
        }
        // Busca el anioActual dentro del arrey $edicionesTrabajo, devuelve false sino existe dentro.
        $anioTrabajo = in_array(anioActual, $edicionesTrabajo);
        $idfcTrabajo = in_array($fcTrabajo, $idsfcTrabajo);

        $data['anioTrabajo'] = $anioTrabajo;
        $data['idfcTrabajo'] = $idfcTrabajo;
        $data['fcTrabajo']   = $fcTrabajo;


        
		$data['get_all_orderbyACT_desc'] = $this->actividades_model->get_all_orderbyACT_desc($e_mail,$grupo,$id_coord,$edicion);
        $data['get_all_actividades'] = $this->actividades_model->get_all_actividades($e_mail,$grupo,$id_coord,$edicion);
        $data['get_resp'] = $this->actividades_model->get_resp($e_mail,$grupo,$id_coord);
        $data['get_reg'] = $this->actividades_model->get_reg($e_mail,$id_coord,$edicion);

        $pres_aut = 0;
        $costo_secture = 0;
        $pres_eje = 0;

        if ( ! empty($data['get_all_orderbyACT_desc']) ) {
            foreach ($data['get_all_orderbyACT_desc'] as $key => $value) {            
                $pres_aut = $pres_aut + $value->pres_aut;
                $costo_secture = $costo_secture + $value->costo_secture;
                $pres_eje = $pres_eje + $value->pres_eje;            
            }
        }
        
        $data['suma_pres_aut']      = $pres_aut;
        $data['suma_costo_secture'] = $costo_secture;
        $data['suma_pres_eje']      = $pres_eje;
        
		$this->load->view('header_view',$data);
        $this->load->view('actividades_order_act_desc_view',$data);        
        $this->load->view('footer_view',$data); 
	}
    public function filtrar_status($status){ 
		/* Variables de SESSION */
        $e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $data['grupo'] = $grupo;
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
        /* Variables de la Página */
        $data['title']= 'Mis Cédulas';
		$data['onlyusername'] = strstr($e_mail,'@',true);
		/* Cargar Módulos */
        $this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('categorias_model');
        $this->load->model('coordinadores_model');
        $this->load->model('comentarios_model');
        /* Variables tipo Array para almacenar las consultas a la base de datos */
        $data['get_total_cedulas'] = $this->actividades_model->get_total_cedulas($e_mail,$edicion);
        $data['get_registros'] = $this->necesidades_model->get_registros();
        $data['get_categorias'] = $this->categorias_model->get_categorias($id_coord,$grupo);
        $data['get_all_cats'] = $this->categorias_model->get_all_cats();
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();        
        $data['get_all_actividades'] = $this->actividades_model->get_all_actividades($e_mail,$grupo,$id_coord,$edicion);
        $data['get_resp'] = $this->actividades_model->get_resp($e_mail,$grupo,$id_coord);
        $data['get_reg'] = $this->actividades_model->get_reg($e_mail,$id_coord,$edicion);
        $data['get_all_status'] = $this->actividades_model->get_all_status($e_mail,$grupo,$id_coord,$status,$edicion);
        /* Reglas del Negocio */
        foreach ($data['get_all_coords'] as $coords ) {    
            if($id_coord == $coords->id_coord) {                
                $data['miCoordinacion']= $coords->coordinacion;
            }
        }

        // Obtiene los años de cada edicion
        $edicionesTrabajo = array();
        $idsfcTrabajo = array();
        $fcTrabajo = false;
        foreach ($data['get_fc'] as $anio) {
            array_push($edicionesTrabajo, $anio->anio);
            array_push($idsfcTrabajo, $anio->id_fc);
            if ( ($fcTrabajo == false) && ($anio->anio == anioActual) ) {
                $fcTrabajo = $anio->id_fc ;
            }
        }
        // Busca el anioActual dentro del arrey $edicionesTrabajo, devuelve false sino existe dentro.
        $anioTrabajo = in_array(anioActual, $edicionesTrabajo);
        $idfcTrabajo = in_array($fcTrabajo, $idsfcTrabajo);

        $data['anioTrabajo'] = $anioTrabajo;
        $data['idfcTrabajo'] = $idfcTrabajo;
        $data['fcTrabajo']   = $fcTrabajo;


/*
        $pres_aut = 0;
        $costo_secture = 0;
        $pres_eje = 0;

        if ( ! empty($data['get_all_status']) ) {
            foreach ($data['get_all_status'] as $key => $value) {            
                $pres_aut = $pres_aut + $value->pres_aut;
                $costo_secture = $costo_secture + $value->costo_secture;
                $pres_eje = $pres_eje + $value->pres_eje;            
            }
        }
        
        $data['suma_pres_aut']      = $pres_aut;
        $data['suma_costo_secture'] = $costo_secture;
        $data['suma_pres_eje']      = $pres_eje;
*/

        /*******************************************************/
        $pres_aut = 0;
        $costo_secture = 0;
        $pres_eje = 0;
        $fuera_pres = 0;

            if ( ! empty($data['get_all_status']) ) {
                foreach ($data['get_all_status'] as $key => $value) {
                    if ($value->status_act != 6) { // Fuera de Presupuesto
                        $pres_aut = $pres_aut + $value->pres_aut;
                        $costo_secture = $costo_secture + $value->costo_secture;
                        $pres_eje = $pres_eje + $value->pres_eje;               
                    }else{                        
                        $fuera_pres = $fuera_pres + $value->costo_secture;
                    }
                }
            }
        
        $data['suma_pres_aut']      = $pres_aut;
        $data['suma_costo_secture'] = $costo_secture;
        $data['suma_pres_eje']      = $pres_eje;
        $data['suma_fuera_pres']    = $fuera_pres;
        /**********************************************************/


        /* Cargar Vistas para el Usuario */        
		$this->load->view('header_view',$data); 
        $this->load->view('filtrar_status_view',$data);        
        $this->load->view('footer_view',$data); 
	}
    
    
    //************************************//
    //*    VISTA: AGREGAR NUEVA CEDULA   *//
    
	public function agregar_act(){
		
        $e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $data['grupo'] = $grupo;
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $edicion;
        $data['onlyusername'] = strstr($e_mail,'@',true);
        $this->load->model('categorias_model');// LISTADO DE CATEGORIAS PARA QUE EL USUARIO SELECCIONE UNA OPCION
        $this->load->model('coordinadores_model');
            
        $data['get_fc'] = $this->fc_model->get_fc();
        $data['get_categorias'] = $this->categorias_model->get_categorias($id_coord,$grupo);
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }

        // Obtiene los años de cada edicion
        $edicionesTrabajo = array();
        $idsfcTrabajo = array();
        $fcTrabajo = false;
        foreach ($data['get_fc'] as $anio) {
            array_push($edicionesTrabajo, $anio->anio);
            array_push($idsfcTrabajo, $anio->id_fc);
            if ( ($fcTrabajo == false) && ($anio->anio == anioActual) ) {
                $fcTrabajo = $anio->id_fc ;
            }
        }
        // Busca el anioActual dentro del arrey $edicionesTrabajo, devuelve false sino existe dentro.
        $anioTrabajo = in_array(anioActual, $edicionesTrabajo);
        $idfcTrabajo = in_array($fcTrabajo, $idsfcTrabajo);

        $data['anioTrabajo'] = $anioTrabajo;
        $data['idfcTrabajo'] = $idfcTrabajo;
        $data['fcTrabajo']   = $fcTrabajo;


        
        // VALIDACION DEL FORMULARIO Y REGLAS
        $this->form_validation->set_rules('actividad', 'Actividad', 'required');
        $this->form_validation->set_rules('descripcion', 'Descripcion', 'required');
		
        
        if ($this->form_validation->run() == FALSE)
		{
            echo validation_errors();
			$this->load->view('actividades_agregar_view',$data);
		}
		else
		{
			$this->load->view('formsuccess');
		}
        
		
	}
    
    //************************************//
    
    public function insert_act(){
		$e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $data['grupo'] = $grupo;
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
		$data['onlyusername'] = strstr($e_mail,'@',true);
        $this->load->model('actividades_model');
        $this->load->model('coordinadores_model');
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
            try {
                $this->actividades_model->insert_entry($e_mail);
            } catch (Exception $e) { die();
            
        }
        
        redirect('actividades/');
	}
	public function buscar_act(){

		$e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $data['grupo'] = $grupo;
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $edicion;
        $data['get_fc'] = $this->fc_model->get_fc();
        $data['title']= 'Mis Cédulas';
		$data['onlyusername'] = strstr($e_mail,'@',true);

		$this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('categorias_model');
        $this->load->model('coordinadores_model');
        $this->load->model('comentarios_model');
        //$this->load->model('responsables_model');                
        $data['get_total_cedulas'] = $this->actividades_model->get_total_cedulas($e_mail,$edicion);
        $data['get_registros'] = $this->necesidades_model->get_registros();
        $data['get_categorias'] = $this->categorias_model->get_categorias($id_coord,$grupo);
        $data['get_all_cats'] = $this->categorias_model->get_all_cats();
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
        		
		$txt = $this->input->post('txt');
		$data['get_one_act'] = $this->actividades_model->get_one_act($txt,$e_mail,$id_coord,$edicion);
        $data['get_all_actividades'] = $this->actividades_model->get_all_actividades($e_mail,$grupo,$id_coord,$edicion);
        $data['get_resp'] = $this->actividades_model->get_resp($e_mail,$grupo,$id_coord);
        $data['get_reg'] = $this->actividades_model->get_reg($e_mail,$id_coord,$edicion);

                
        // Obtiene los años de cada edicion
        $edicionesTrabajo = array();
        $idsfcTrabajo = array();
        $fcTrabajo = false;
        foreach ($data['get_fc'] as $anio) {
            array_push($edicionesTrabajo, $anio->anio);
            array_push($idsfcTrabajo, $anio->id_fc);
            if ( ($fcTrabajo == false) && ($anio->anio == anioActual) ) {
                $fcTrabajo = $anio->id_fc ;
            }
        }
        // Busca el anioActual dentro del arrey $edicionesTrabajo, devuelve false sino existe dentro.
        $anioTrabajo = in_array(anioActual, $edicionesTrabajo);
        $idfcTrabajo = in_array($fcTrabajo, $idsfcTrabajo);

        $data['anioTrabajo'] = $anioTrabajo;
        $data['idfcTrabajo'] = $idfcTrabajo;
        $data['fcTrabajo']   = $fcTrabajo;



        /*******************************************************/
        $pres_aut = 0;
        $costo_secture = 0;
        $pres_eje = 0;
        $fuera_pres = 0;

            if ( ! empty($data['get_one_act']) ) {
                foreach ($data['get_one_act'] as $key => $value) {
                    if ($value->status_act != 6) { // Fuera de Presupuesto
                        $pres_aut = $pres_aut + $value->pres_aut;
                        $costo_secture = $costo_secture + $value->costo_secture;
                        $pres_eje = $pres_eje + $value->pres_eje;               
                    }else{                        
                        $fuera_pres = $fuera_pres + $value->costo_secture;
                    }
                }
            }
        
        $data['suma_pres_aut']      = $pres_aut;
        $data['suma_costo_secture'] = $costo_secture;
        $data['suma_pres_eje']      = $pres_eje;
        $data['suma_fuera_pres']    = $fuera_pres;
        /**********************************************************/

        
        $this->load->view('header_view',$data);
        $this->load->view('actividades_one_view',$data);
        $this->load->view('footer_view',$data);
		
	}
    public function filtrar_resp(){

        $e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $data['grupo'] = $grupo;
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $edicion;
        $data['get_fc'] = $this->fc_model->get_fc();
        $data['title']= 'Mis Cédulas';
		$data['onlyusername'] = strstr($e_mail,'@',true);

		$this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('categorias_model');
        $this->load->model('coordinadores_model');
        $this->load->model('comentarios_model');
        //$this->load->model('responsables_model');                
        $data['get_total_cedulas'] = $this->actividades_model->get_total_cedulas($e_mail,$edicion);
        $data['get_registros'] = $this->necesidades_model->get_registros();
        $data['get_categorias'] = $this->categorias_model->get_categorias($id_coord,$grupo);
        $data['get_all_cats'] = $this->categorias_model->get_all_cats();
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }

        // Obtiene los años de cada edicion
        $edicionesTrabajo = array();
        $idsfcTrabajo = array();
        $fcTrabajo = false;
        foreach ($data['get_fc'] as $anio) {
            array_push($edicionesTrabajo, $anio->anio);
            array_push($idsfcTrabajo, $anio->id_fc);
            if ( ($fcTrabajo == false) && ($anio->anio == anioActual) ) {
                $fcTrabajo = $anio->id_fc ;
            }
        }
        // Busca el anioActual dentro del arrey $edicionesTrabajo, devuelve false sino existe dentro.
        $anioTrabajo = in_array(anioActual, $edicionesTrabajo);
        $idfcTrabajo = in_array($fcTrabajo, $idsfcTrabajo);

        $data['anioTrabajo'] = $anioTrabajo;
        $data['idfcTrabajo'] = $idfcTrabajo;
        $data['fcTrabajo']   = $fcTrabajo;

        $status = '4'; 		
		$txt = $this->input->post('email');
        $data['get_all_actividades'] = $this->actividades_model->get_all_actividades($e_mail,$grupo,$id_coord,$edicion);
        $data['get_resp'] = $this->actividades_model->get_resp($e_mail,$grupo,$id_coord);
        $data['get_reg'] = $this->actividades_model->get_reg($e_mail,$id_coord,$edicion);
		$data['get_filtro_por_resp'] = $this->actividades_model->get_filtro_por_resp($txt,$grupo,$id_coord,$edicion);

        
        /*******************************************************/
        $pres_aut = 0;
        $costo_secture = 0;
        $pres_eje = 0;
        $fuera_pres = 0;

            if ( ! empty($data['get_filtro_por_resp']) ) {
                foreach ($data['get_filtro_por_resp'] as $key => $value) {
                    if ($value->status_act != 6) { // Fuera de Presupuesto
                        $pres_aut = $pres_aut + $value->pres_aut;
                        $costo_secture = $costo_secture + $value->costo_secture;
                        $pres_eje = $pres_eje + $value->pres_eje;               
                    }else{                        
                        $fuera_pres = $fuera_pres + $value->costo_secture;
                    }
                }
            }
        
        $data['suma_pres_aut']      = $pres_aut;
        $data['suma_costo_secture'] = $costo_secture;
        $data['suma_pres_eje']      = $pres_eje;
        $data['suma_fuera_pres']    = $fuera_pres;
        /**********************************************************/
        
        $this->load->view('header_view',$data);
        $this->load->view('filtrar_resp_view',$data);
        $this->load->view('footer_view',$data);
		
	}
    public function filtrar_resp_pres(){

        $e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $data['grupo'] = $grupo;
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $edicion;
        $data['get_fc'] = $this->fc_model->get_fc();
        $data['title']= 'Mis Cédulas';
        $data['onlyusername'] = strstr($e_mail,'@',true);

        $this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('categorias_model');
        $this->load->model('coordinadores_model');
        $this->load->model('comentarios_model');
        //$this->load->model('responsables_model');                
        $data['get_total_cedulas'] = $this->actividades_model->get_total_cedulas($e_mail,$edicion);
        $data['get_registros'] = $this->necesidades_model->get_registros();
        $data['get_categorias'] = $this->categorias_model->get_categorias($id_coord,$grupo);
        $data['get_all_cats'] = $this->categorias_model->get_all_cats();
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }

        // Obtiene los años de cada edicion
        $edicionesTrabajo = array();
        $idsfcTrabajo = array();
        $fcTrabajo = false;
        foreach ($data['get_fc'] as $anio) {
            array_push($edicionesTrabajo, $anio->anio);
            array_push($idsfcTrabajo, $anio->id_fc);
            if ( ($fcTrabajo == false) && ($anio->anio == anioActual) ) {
                $fcTrabajo = $anio->id_fc ;
            }
        }
        // Busca el anioActual dentro del arrey $edicionesTrabajo, devuelve false sino existe dentro.
        $anioTrabajo = in_array(anioActual, $edicionesTrabajo);
        $idfcTrabajo = in_array($fcTrabajo, $idsfcTrabajo);

        $data['anioTrabajo'] = $anioTrabajo;
        $data['idfcTrabajo'] = $idfcTrabajo;
        $data['fcTrabajo']   = $fcTrabajo;

        $status = '4';       
        $txt = $this->input->post('email');
        $data['get_all_actividades'] = $this->actividades_model->get_all_actividades($e_mail,$grupo,$id_coord,$edicion);
        $data['get_resp'] = $this->actividades_model->get_resp($e_mail,$grupo,$id_coord);
        $data['get_reg'] = $this->actividades_model->get_reg_filtro($txt,$e_mail,$id_coord,$edicion);
        $data['get_filtro_por_resp'] = $this->actividades_model->get_filtro_por_resp($txt,$grupo,$id_coord,$edicion);

        
        /*******************************************************/
        $pres_aut = 0;
        $pres_gas = 0;
        $costo_secture = 0;
        $pres_eje = 0;
        $fuera_pres = 0;
        $resultadoPresupuesto = 0;

            if ( ! empty($data['get_filtro_por_resp']) ) {
                foreach ($data['get_filtro_por_resp'] as $key => $value) {
                    if ($value->status_act != 6) { // Fuera de Presupuesto
                        $pres_aut = $pres_aut + $value->pres_aut;
                        $costo_secture = $costo_secture + $value->costo_secture;
                        $pres_eje = $pres_eje + $value->pres_eje;               
                        $pres_gas = $pres_gas + $value->pres_gas; 
                    }else{                        
                        $fuera_pres = $fuera_pres + $value->costo_secture;
                    }
                }
            }

        $resultadoPresupuesto = $pres_aut - $pres_gas ;
        
        $data['suma_pres_aut']      = $pres_aut;
        $data['suma_pres_gas']      = $pres_gas;
        $data['suma_costo_secture'] = $costo_secture;
        $data['suma_pres_eje']      = $pres_eje;
        $data['suma_fuera_pres']    = $fuera_pres;
        $data['suma_resultadoPresupuesto']    = $resultadoPresupuesto;
        /**********************************************************/
        
        $this->load->view('header_view',$data);
        $this->load->view('filtrar_resp_pres_view',$data);
        $this->load->view('footer_view',$data);
        
    }
    public function filtrar_cedula(){
		$e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $data['grupo'] = $grupo;
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
        $data['title']= 'Mis Cédulas';
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('categorias_model');
        $this->load->model('coordinadores_model');
        $this->load->model('comentarios_model');
        //$this->load->model('responsables_model');                
        $data['get_total_cedulas'] = $this->actividades_model->get_total_cedulas($e_mail,$edicion);
        $data['get_registros'] = $this->necesidades_model->get_registros();
        $data['get_categorias'] = $this->categorias_model->get_categorias($id_coord,$grupo);
        $data['get_all_cats'] = $this->categorias_model->get_all_cats();
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }

        // Obtiene los años de cada edicion
        $edicionesTrabajo = array();
        $idsfcTrabajo = array();
        $fcTrabajo = false;
        foreach ($data['get_fc'] as $anio) {
            array_push($edicionesTrabajo, $anio->anio);
            array_push($idsfcTrabajo, $anio->id_fc);
            if ( ($fcTrabajo == false) && ($anio->anio == anioActual) ) {
                $fcTrabajo = $anio->id_fc ;
            }
        }
        // Busca el anioActual dentro del arrey $edicionesTrabajo, devuelve false sino existe dentro.
        $anioTrabajo = in_array(anioActual, $edicionesTrabajo);
        $idfcTrabajo = in_array($fcTrabajo, $idsfcTrabajo);

        $data['anioTrabajo'] = $anioTrabajo;
        $data['idfcTrabajo'] = $idfcTrabajo;
        $data['fcTrabajo']   = $fcTrabajo;

        		
		$id_act = $this->input->post('id_act');
        $data['get_all_actividades'] = $this->actividades_model->get_all_actividades($e_mail,$grupo,$id_coord,$edicion);
        $data['get_resp'] = $this->actividades_model->get_resp($e_mail,$grupo,$id_coord);
        $data['get_reg'] = $this->actividades_model->get_reg($e_mail,$id_coord,$edicion);
		$data['get_filtro_por_ced'] = $this->actividades_model->get_filtro_por_ced($id_act,$grupo,$id_coord,$edicion);

       

        /*******************************************************/
        $pres_aut = 0;
        $costo_secture = 0;
        $pres_eje = 0;
        $fuera_pres = 0;

            if ( ! empty($data['get_filtro_por_ced']) ) {
                foreach ($data['get_filtro_por_ced'] as $key => $value) {
                    if ($value->status_act != 6) { // Fuera de Presupuesto
                        $pres_aut = $pres_aut + $value->pres_aut;
                        $costo_secture = $costo_secture + $value->costo_secture;
                        $pres_eje = $pres_eje + $value->pres_eje;               
                    }else{                        
                        $fuera_pres = $fuera_pres + $value->costo_secture;
                    }
                }
            }
        
        $data['suma_pres_aut']      = $pres_aut;
        $data['suma_costo_secture'] = $costo_secture;
        $data['suma_pres_eje']      = $pres_eje;
        $data['suma_fuera_pres']    = $fuera_pres;
        /**********************************************************/
        
        $this->load->view('header_view',$data);
        $this->load->view('filtrar_cedula_view',$data);
        $this->load->view('footer_view',$data);
		
	}

    public function filtrar_coords(){
        $e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $data['grupo'] = $grupo;
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
        $data['title']= 'Mis Cédulas';
        $data['onlyusername'] = strstr($e_mail,'@',true);
        $this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('categorias_model');
        $this->load->model('coordinadores_model');
        $this->load->model('comentarios_model');
        //$this->load->model('responsables_model');                
        $data['get_total_cedulas'] = $this->actividades_model->get_total_cedulas($e_mail,$edicion);
        $data['get_registros'] = $this->necesidades_model->get_registros();
        $data['get_categorias'] = $this->categorias_model->get_categorias($id_coord,$grupo);
        $data['get_all_cats'] = $this->categorias_model->get_all_cats();
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }

        // Obtiene los años de cada edicion
        $edicionesTrabajo = array();
        $idsfcTrabajo = array();
        $fcTrabajo = false;
        foreach ($data['get_fc'] as $anio) {
            array_push($edicionesTrabajo, $anio->anio);
            array_push($idsfcTrabajo, $anio->id_fc);
            if ( ($fcTrabajo == false) && ($anio->anio == anioActual) ) {
                $fcTrabajo = $anio->id_fc ;
            }
        }
        // Busca el anioActual dentro del arrey $edicionesTrabajo, devuelve false sino existe dentro.
        $anioTrabajo = in_array(anioActual, $edicionesTrabajo);
        $idfcTrabajo = in_array($fcTrabajo, $idsfcTrabajo);

        $data['anioTrabajo'] = $anioTrabajo;
        $data['idfcTrabajo'] = $idfcTrabajo;
        $data['fcTrabajo']   = $fcTrabajo;

                
        $coord = $this->input->post('id_coord');
        $data['get_all_actividades'] = $this->actividades_model->get_all_actividades($e_mail,$grupo,$id_coord,$edicion);
        $data['get_resp'] = $this->actividades_model->get_resp($e_mail,$grupo,$id_coord);
        $data['get_reg'] = $this->actividades_model->get_reg($e_mail,$id_coord,$edicion);
        $data['get_filtro_por_coord'] = $this->actividades_model->get_filtro_por_coord($grupo,$coord,$edicion);

        $pres_aut = 0;
        $costo_secture = 0;
        $pres_eje = 0;

        if ( ! empty($data['get_filtro_por_coord']) ) {
            foreach ($data['get_filtro_por_coord'] as $key => $value) {            
                $pres_aut = $pres_aut + $value->pres_aut;
                $costo_secture = $costo_secture + $value->costo_secture;
                $pres_eje = $pres_eje + $value->pres_eje;            
            }
        }
        
        $data['suma_pres_aut']      = $pres_aut;
        $data['suma_costo_secture'] = $costo_secture;
        $data['suma_pres_eje']      = $pres_eje;
        
        $this->load->view('header_view',$data);
        $this->load->view('filtrar_coords_view',$data);
        $this->load->view('footer_view',$data);
        
    }

    public function filtrar_resumen_cedula(){
		$e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $data['grupo'] = $grupo;
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
        $data['title']= 'Mis Cédulas';
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('categorias_model');
        $this->load->model('coordinadores_model');
        $this->load->model('comentarios_model');
        //$this->load->model('responsables_model');                
        $data['get_total_cedulas'] = $this->actividades_model->get_total_cedulas($e_mail,$edicion);
        $data['get_registros'] = $this->necesidades_model->get_registros();
        $data['get_categorias'] = $this->categorias_model->get_categorias($id_coord,$grupo);
        $data['get_all_cats'] = $this->categorias_model->get_all_cats();
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }

        // Obtiene los años de cada edicion
        $edicionesTrabajo = array();
        $idsfcTrabajo = array();
        $fcTrabajo = false;
        foreach ($data['get_fc'] as $anio) {
            array_push($edicionesTrabajo, $anio->anio);
            array_push($idsfcTrabajo, $anio->id_fc);
            if ( ($fcTrabajo == false) && ($anio->anio == anioActual) ) {
                $fcTrabajo = $anio->id_fc ;
            }
        }
        // Busca el anioActual dentro del arrey $edicionesTrabajo, devuelve false sino existe dentro.
        $anioTrabajo = in_array(anioActual, $edicionesTrabajo);
        $idfcTrabajo = in_array($fcTrabajo, $idsfcTrabajo);

        $data['anioTrabajo'] = $anioTrabajo;
        $data['idfcTrabajo'] = $idfcTrabajo;
        $data['fcTrabajo']   = $fcTrabajo;

        		
		$id_act = $this->input->post('id_act');
        $data['get_all_actividades'] = $this->actividades_model->get_all_actividades($e_mail,$grupo,$id_coord,$edicion);
        $data['get_resp'] = $this->actividades_model->get_resp($e_mail,$grupo,$id_coord);
        $data['get_reg'] = $this->actividades_model->get_reg($e_mail,$id_coord);
        foreach ($data['get_reg'] as $regs ) {
            $data['num_regs']= $regs->tot;                        
        }
        // Numero de Registros Pendientes
        $data['get_regs_pendientes'] = $this->actividades_model->get_regs_pendientes($e_mail,$id_coord);
        foreach ($data['get_regs_pendientes'] as $regs_p ) {
            $data['num_regs_p']= $regs_p->tot;                        
        }
        // Numero de Registros Aprobados
        $data['get_regs_aprobados'] = $this->actividades_model->get_regs_aprobados($e_mail,$id_coord);
        foreach ($data['get_regs_aprobados'] as $regs_a ) {
            $data['num_regs_a']= $regs_a->tot;                        
        }
        // Numero de Registros No Aprobados
        $data['get_regs_Noaprobados'] = $this->actividades_model->get_regs_Noaprobados($e_mail,$id_coord);
        foreach ($data['get_regs_Noaprobados'] as $regs_Noa ) {
            $data['num_regs_Noa']= $regs_Noa->tot;                        
        }
		$data['get_filtro_res_ced'] = $this->actividades_model->get_filtro_res_ced($id_act,$grupo,$id_coord);
        
        $this->load->view('header_view',$data);
        $this->load->view('filtrar_resumen_cedula_view',$data);
        $this->load->view('footer_view',$data);
		
	}
    public function filtrar_master_plan_coord(){
		$e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $data['grupo'] = $grupo;
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
        $data['title']= 'Mis Cédulas';
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('categorias_model');
        $this->load->model('coordinadores_model');
        $this->load->model('comentarios_model');
        //$this->load->model('responsables_model');                
        $data['get_all_cats'] = $this->categorias_model->get_all_cats();
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }

        // Obtiene los años de cada edicion
        $edicionesTrabajo = array();
        $idsfcTrabajo = array();
        $fcTrabajo = false;
        foreach ($data['get_fc'] as $anio) {
            array_push($edicionesTrabajo, $anio->anio);
            array_push($idsfcTrabajo, $anio->id_fc);
            if ( ($fcTrabajo == false) && ($anio->anio == anioActual) ) {
                $fcTrabajo = $anio->id_fc ;
            }
        }
        // Busca el anioActual dentro del arrey $edicionesTrabajo, devuelve false sino existe dentro.
        $anioTrabajo = in_array(anioActual, $edicionesTrabajo);
        $idfcTrabajo = in_array($fcTrabajo, $idsfcTrabajo);

        $data['anioTrabajo'] = $anioTrabajo;
        $data['idfcTrabajo'] = $idfcTrabajo;
        $data['fcTrabajo']   = $fcTrabajo;

        		
		$id_coord = $this->input->post('id_coord');
        $data['get_master_plan_coord'] = $this->actividades_model->get_master_plan_coord($id_coord,$edicion);
        $data['get_master_plan'] = $this->actividades_model->get_master_plan($edicion);
        $data['get_all'] = $this->necesidades_model->get_all();
		
        
        $this->load->view('header_view',$data);
        $this->load->view('filtrar_master_plan_coord_view',$data);
        $this->load->view('footer_view',$data);
		
	}
    public function filtrar_master_plan_categoria(){
		$e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $data['grupo'] = $grupo;
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
        $data['title']= 'Mis Cédulas';
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('categorias_model');
        $this->load->model('coordinadores_model');
        $this->load->model('comentarios_model');
        //$this->load->model('responsables_model');                
        $data['get_all_cats'] = $this->categorias_model->get_all_cats();
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }

        // Obtiene los años de cada edicion
        $edicionesTrabajo = array();
        $idsfcTrabajo = array();
        $fcTrabajo = false;
        foreach ($data['get_fc'] as $anio) {
            array_push($edicionesTrabajo, $anio->anio);
            array_push($idsfcTrabajo, $anio->id_fc);
            if ( ($fcTrabajo == false) && ($anio->anio == anioActual) ) {
                $fcTrabajo = $anio->id_fc ;
            }
        }
        // Busca el anioActual dentro del arrey $edicionesTrabajo, devuelve false sino existe dentro.
        $anioTrabajo = in_array(anioActual, $edicionesTrabajo);
        $idfcTrabajo = in_array($fcTrabajo, $idsfcTrabajo);

        $data['anioTrabajo'] = $anioTrabajo;
        $data['idfcTrabajo'] = $idfcTrabajo;
        $data['fcTrabajo']   = $fcTrabajo;

        		
		$id_categoria = $this->input->post('id_categoria');
        $data['get_master_plan_categoria'] = $this->actividades_model->get_master_plan_categoria($id_categoria,$edicion);
        $data['get_master_plan'] = $this->actividades_model->get_master_plan($edicion);
        $data['get_all'] = $this->necesidades_model->get_all();
		
        
        $this->load->view('header_view',$data);
        $this->load->view('filtrar_master_plan_categoria_view',$data);
        $this->load->view('footer_view',$data);
		
	}
    public function filtrar_master_plan_cedula(){
		$e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $data['grupo'] = $grupo;
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
        $data['title']= 'Mis Cédulas';
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('categorias_model');
        $this->load->model('coordinadores_model');
        $this->load->model('comentarios_model');
        //$this->load->model('responsables_model');                
        $data['get_all_cats'] = $this->categorias_model->get_all_cats();
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
        
        // Obtiene los años de cada edicion
        $edicionesTrabajo = array();
        $idsfcTrabajo = array();
        $fcTrabajo = false;
        foreach ($data['get_fc'] as $anio) {
            array_push($edicionesTrabajo, $anio->anio);
            array_push($idsfcTrabajo, $anio->id_fc);
            if ( ($fcTrabajo == false) && ($anio->anio == anioActual) ) {
                $fcTrabajo = $anio->id_fc ;
            }
        }
        // Busca el anioActual dentro del arrey $edicionesTrabajo, devuelve false sino existe dentro.
        $anioTrabajo = in_array(anioActual, $edicionesTrabajo);
        $idfcTrabajo = in_array($fcTrabajo, $idsfcTrabajo);

        $data['anioTrabajo'] = $anioTrabajo;
        $data['idfcTrabajo'] = $idfcTrabajo;
        $data['fcTrabajo']   = $fcTrabajo;

        		
		$id_act = $this->input->post('id_act');
        $data['get_master_plan_cedula'] = $this->actividades_model->get_master_plan_cedula($id_act,$edicion);
        $data['get_master_plan'] = $this->actividades_model->get_master_plan($edicion);
        $data['get_all'] = $this->necesidades_model->get_all();
		
        
        $this->load->view('header_view',$data);
        $this->load->view('filtrar_master_plan_cedula_view',$data);
        $this->load->view('footer_view',$data);
		
	}
	
    public function editar_actividad($id_act){
		$e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $data['grupo'] = $grupo;
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $edicion;
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('actividades_model');
        $this->load->model('categorias_model');
        $this->load->model('coordinadores_model');
        // LISTADO DE CATEGORIAS PARA QUE EL USUARIO SELECCIONE UNA OPCION
        $data['get_fc'] = $this->fc_model->get_fc();
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
		$data['get_categorias'] = $this->categorias_model->get_categorias($id_coord,$grupo);
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }

        // Obtiene los años de cada edicion
        $edicionesTrabajo = array();
        $idsfcTrabajo = array();
        $fcTrabajo = false;
        foreach ($data['get_fc'] as $anio) {
            array_push($edicionesTrabajo, $anio->anio);
            array_push($idsfcTrabajo, $anio->id_fc);
            if ( ($fcTrabajo == false) && ($anio->anio == anioActual) ) {
                $fcTrabajo = $anio->id_fc ;
            }
        }
        // Busca el anioActual dentro del arrey $edicionesTrabajo, devuelve false sino existe dentro.
        $anioTrabajo = in_array(anioActual, $edicionesTrabajo);
        $idfcTrabajo = in_array($fcTrabajo, $idsfcTrabajo);

        $data['anioTrabajo'] = $anioTrabajo;
        $data['idfcTrabajo'] = $idfcTrabajo;
        $data['fcTrabajo']   = $fcTrabajo;


        
		$data['get_one_act_edit'] = $this->actividades_model->get_one_act_edit($id_act,$e_mail,$grupo,$id_coord,$edicion);
		$this->load->view('actividades_editar_view',$data);
	}
    public function editar_fechas_act($id_act){
		$e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $data['grupo'] = $grupo;
        $data['id_act'] = $id_act;
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('actividades_model');
        $this->load->model('categorias_model');
        $this->load->model('horarios_model');
        $this->load->model('coordinadores_model');

        $data['show_municipios'] = $this->municipios_model->show();
        $data['show_sedes'] = $this->sedes_model->show();
        $data['show_ubicaciones'] = $this->ubicaciones_model->show();
        $data['show_subactividades'] = $this->subactividades_model->show($id_act);
        
        // LISTADO DE CATEGORIAS PARA QUE EL USUARIO SELECCIONE UNA OPCION
		$data['get_categorias'] = $this->categorias_model->get_categorias($id_coord,$grupo);
        $data['get_horarios'] = $this->horarios_model->get_horarios();
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }

        // Obtiene los años de cada edicion
        $edicionesTrabajo = array();
        $idsfcTrabajo = array();
        $fcTrabajo = false;
        foreach ($data['get_fc'] as $anio) {
            array_push($edicionesTrabajo, $anio->anio);
            array_push($idsfcTrabajo, $anio->id_fc);
            if ( ($fcTrabajo == false) && ($anio->anio == anioActual) ) {
                $fcTrabajo = $anio->id_fc ;
            }
        }
        // Busca el anioActual dentro del arrey $edicionesTrabajo, false sino existe dentro.
        //$anioTrabajo = in_array(anioActual, $edicionesTrabajo);
        $anioTrabajo = (in_array(anioActual, $edicionesTrabajo)) ? anioActual : false ;
        $idfcTrabajo = in_array($fcTrabajo, $idsfcTrabajo);

        $data['anioTrabajo'] = $anioTrabajo;
        $data['idfcTrabajo'] = $idfcTrabajo;
        $data['fcTrabajo']   = $fcTrabajo;
        
		$data['get_one_act_edit'] = $this->actividades_model->get_one_act_edit($id_act,$e_mail,$grupo,$id_coord,$edicion);
		$this->load->view('fechas_editar_view',$data);
	}
	public function actualizar_act(){
		$e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $data['grupo'] = $grupo;
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $edicion;
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('actividades_model');
        $this->load->model('coordinadores_model');
        
        $id_act = $this->input->post('id_act');
        $id_fc = $this->input->post('id_fc');

        $data['get_fc'] = $this->fc_model->get_fc();
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
		
        $is_ok = $this->actividades_model->update_entry($e_mail,$edicion = $id_fc);
        if($is_ok){
            $data['get_one_act_edit'] = $this->actividades_model->get_one_act_edit($id_act,$e_mail,$grupo,$id_coord,$edicion);
            $this->load->view('is_Nok_view',$data);
        }else{
            $data['get_one_act_edit'] = $this->actividades_model->get_one_act_edit($id_act,$e_mail,$grupo,$id_coord,$edicion);
            $this->load->view('is_ok_view',$data);
        }
        
        redirect('actividades/');
		
	}
    public function actualizar_tot_act($id_act){
		$e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $data['grupo'] = $grupo;
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('coordinadores_model');
        $data['get_total_act'] = $this->necesidades_model->get_total_act($id_act);
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
		$is_ok = $this->actividades_model->update_tot_act();
		if($is_ok){
            $data['get_one_act_edit'] = $this->actividades_model->get_one_act_edit($id_act,$e_mail,$grupo,$id_coord,$edicion);
            $this->load->view('is_Nok_view',$data);
        }else{
            $data['get_one_act_edit'] = $this->actividades_model->get_one_act_edit($id_act,$e_mail,$grupo,$id_coord,$edicion);
            $this->load->view('is_ok_view',$data);
        }
        redirect('actividades/');
        
	}
    public function necesidades_act($id_act){
		$e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $data['grupo'] = $grupo;
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $edicion;
        $data['get_fc'] = $this->fc_model->get_fc();
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('coordinadores_model');
        $data['get_one_act_edit'] = $this->actividades_model->get_one_act_edit($id_act,$e_mail,$grupo,$id_coord,$edicion);
        $data['get_all_nec_act'] = $this->necesidades_model->get_all_nec_act($id_act);
        $data['get_total_act'] = $this->necesidades_model->get_total_act($id_act);
        $data['get_total_cedulas'] = $this->actividades_model->get_total_cedulas($e_mail,$edicion);
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }

        // Obtiene los años de cada edicion
        $edicionesTrabajo = array();
        $idsfcTrabajo = array();
        $fcTrabajo = false;
        foreach ($data['get_fc'] as $anio) {
            array_push($edicionesTrabajo, $anio->anio);
            array_push($idsfcTrabajo, $anio->id_fc);
            if ( ($fcTrabajo == false) && ($anio->anio == anioActual) ) {
                $fcTrabajo = $anio->id_fc ;
            }
        }
        // Busca el anioActual dentro del arrey $edicionesTrabajo, devuelve false sino existe dentro.
        $anioTrabajo = in_array(anioActual, $edicionesTrabajo);
        $idfcTrabajo = in_array($fcTrabajo, $idsfcTrabajo);

        $data['anioTrabajo'] = $anioTrabajo;
        $data['idfcTrabajo'] = $idfcTrabajo;
        $data['fcTrabajo']   = $fcTrabajo;


		$this->load->view('necesidades_view',$data);
	}
    public function compras_act($id_act){
        $e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $data['grupo'] = $grupo;
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
        $data['onlyusername'] = strstr($e_mail,'@',true);
        $this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('coordinadores_model');
        $data['get_one_act_edit'] = $this->actividades_model->get_one_act_edit($id_act,$e_mail,$grupo,$id_coord,$edicion);
        $data['get_all_nec_act'] = $this->necesidades_model->get_all_nec_act($id_act);
        $data['get_total_act'] = $this->necesidades_model->get_total_act($id_act);
        $data['get_total_cedulas'] = $this->actividades_model->get_total_cedulas($e_mail,$edicion);
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
        $this->load->view('header_view',$data); 
        $this->load->view('compras_view',$data);
        $this->load->view('footer_view',$data);
        
    }    
    public function comentarios_act($id_act){
		$e_mail = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $data['grupo'] = $grupo;
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
		$data['onlyusername'] = strstr($e_mail,'@',true);
        
		$this->load->model('actividades_model');
        $this->load->model('comentarios_model');
        $this->load->model('coordinadores_model');
        
        $data['get_one_act_edit'] = $this->actividades_model->get_one_act_edit($id_act,$e_mail,$grupo,$id_coord,$edicion);
        $data['get_all_com_act'] = $this->comentarios_model->get_all_com_act($id_act,$e_mail,$grupo,$id_coord);
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }

        // Obtiene los años de cada edicion
        $edicionesTrabajo = array();
        $idsfcTrabajo = array();
        $fcTrabajo = false;
        foreach ($data['get_fc'] as $anio) {
            array_push($edicionesTrabajo, $anio->anio);
            array_push($idsfcTrabajo, $anio->id_fc);
            if ( ($fcTrabajo == false) && ($anio->anio == anioActual) ) {
                $fcTrabajo = $anio->id_fc ;
            }
        }
        // Busca el anioActual dentro del arrey $edicionesTrabajo, devuelve false sino existe dentro.
        $anioTrabajo = in_array(anioActual, $edicionesTrabajo);
        $idfcTrabajo = in_array($fcTrabajo, $idsfcTrabajo);

        $data['anioTrabajo'] = $anioTrabajo;
        $data['idfcTrabajo'] = $idfcTrabajo;
        $data['fcTrabajo']   = $fcTrabajo;


        
		$this->load->view('comentarios_view',$data);
	}
    public function order_by_encargado_asc(){
		$e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $data['grupo'] = $grupo;
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$id_act = $this->input->post('id_act');
        $this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('coordinadores_model');
        $data['get_one_act_edit'] = $this->actividades_model->get_one_act_edit($id_act,$e_mail,$grupo,$id_coord,$edicion);
        $data['get_all_nec_act'] = $this->necesidades_model->get_all_nec_act($id_act);
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
		$this->load->view('necesidades_view',$data);
	}
    public function mis_cotizaciones($year = null, $month = null){
		$e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $data['grupo'] = $grupo;
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
		$data['onlyusername'] = strstr($e_mail,'@',true);
        $this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('coordinadores_model');
        
        $data['get_total_cedulas'] = $this->actividades_model->get_total_cedulas($e_mail,$edicion);
        $data['get_registros'] = $this->necesidades_model->get_registros();
        
		$data['get_all_actividades'] = $this->actividades_model->get_all_actividades($e_mail);
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
		$this->load->view('endesarrollo_view',$data);		
	}
    public function cotizaciones_act($id_act){
		$e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $data['grupo'] = $grupo;
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('coordinadores_model');
        $data['get_one_act_edit'] = $this->actividades_model->get_one_act_edit($id_act,$e_mail,$grupo,$id_coord,$edicion);
        $data['get_all_nec_act'] = $this->necesidades_model->get_all_nec_act($id_act);
        $data['get_total_act'] = $this->necesidades_model->get_total_act($id_act);
        $data['get_total_cedulas'] = $this->actividades_model->get_total_cedulas($e_mail,$edicion);
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
		$this->load->view('cotizaciones_view',$data);
	}
    public function calendario_act()
    {
    	$e_mail = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $data['grupo'] = $grupo;
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('actividades_model');
        $this->load->model('coordinadores_model');
        $data['get_cal_act'] = $this->actividades_model->get_cal_act($e_mail,$grupo,$id_coord,$edicion);
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }// Obtiene los años de cada edicion
        $edicionesTrabajo = array();
        $idsfcTrabajo = array();
        $fcTrabajo = false;
        foreach ($data['get_fc'] as $anio) {
            array_push($edicionesTrabajo, $anio->anio);
            array_push($idsfcTrabajo, $anio->id_fc);
            if ( ($fcTrabajo == false) && ($anio->anio == anioActual) ) {
                $fcTrabajo = $anio->id_fc ;
            }
        }
        // Busca el anioActual dentro del arrey $edicionesTrabajo, false sino existe dentro.
        //$anioTrabajo = in_array(anioActual, $edicionesTrabajo);
        $anioTrabajo = (in_array(anioActual, $edicionesTrabajo)) ? anioActual : false ;
        $idfcTrabajo = in_array($fcTrabajo, $idsfcTrabajo);

        $data['anioTrabajo'] = $anioTrabajo;
        $data['idfcTrabajo'] = $idfcTrabajo;
        $data['fcTrabajo']   = $fcTrabajo;


        $this->load->view('cal_act_view',$data);        
    }
    public function tree_file_view()
    {
        $e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $data['grupo'] = $grupo;
        $id_coord = $_SESSION['id_coord'];
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->view('tree_file_view',$data);        
    }
    public function vista_previa($id_act){
		$e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $data['grupo'] = $grupo;
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('categorias_model');
        $this->load->model('comentarios_model');
        $this->load->model('coordinadores_model');
        $this->load->model('movimientos_model');
        $data['get_one_act_edit'] = $this->actividades_model->get_one_act_edit($id_act,$e_mail,$grupo,$id_coord,$edicion);
        $data['get_all_nec_act'] = $this->necesidades_model->get_all_nec_act($id_act);
        $data['get_all_movs'] = $this->movimientos_model->get_all_movs($id_act);
        $data['get_total_act'] = $this->necesidades_model->get_total_act($id_act);
        $data['get_total_cedulas'] = $this->actividades_model->get_total_cedulas($e_mail,$edicion);
        $data['get_categorias'] = $this->categorias_model->get_categorias($id_coord,$grupo);
        $data['get_cal_id_act'] = $this->actividades_model->get_cal_id_act($id_act);
        $data['get_all_com_act'] = $this->comentarios_model->get_all_com_act($id_act,$e_mail,$grupo,$id_coord);
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
        // Obtiene los años de cada edicion
        $edicionesTrabajo = array();
        $idsfcTrabajo = array();
        $fcTrabajo = false;
        foreach ($data['get_fc'] as $anio) {
            array_push($edicionesTrabajo, $anio->anio);
            array_push($idsfcTrabajo, $anio->id_fc);
            if ( ($fcTrabajo == false) && ($anio->anio == anioActual) ) {
                $fcTrabajo = $anio->id_fc ;
            }
        }

        $this->load->view('vista_previa_view',$data);	
	}

    public function vista_previa_presupuesto($id_act){
        $e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $data['grupo'] = $grupo;
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
        $data['onlyusername'] = strstr($e_mail,'@',true);
        $data['id_act']  = $id_act;
        $this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('categorias_model');
        $this->load->model('comentarios_model');
        $this->load->model('coordinadores_model');
        $this->load->model('movimientos_model');
        $this->load->model('consolidados_model');
        $data['get_one_act_edit'] = $this->actividades_model->get_one_act_edit($id_act,$e_mail,$grupo,$id_coord,$edicion);
        $data['get_all_nec_act'] = $this->necesidades_model->get_all_nec_act($id_act);
        $data['get_all_movs'] = $this->movimientos_model->get_all_movs($id_act);
        $data['get_total_act'] = $this->necesidades_model->get_total_act($id_act);
        $data['get_total_act_cons'] = $this->consolidados_model->get_total_act_cons($id_act);
        $data['get_total_cedulas'] = $this->actividades_model->get_total_cedulas($e_mail,$edicion);
        $data['get_categorias'] = $this->categorias_model->get_categorias($id_coord,$grupo);
        $data['get_cal_id_act'] = $this->actividades_model->get_cal_id_act($id_act);
        $data['get_all_com_act'] = $this->comentarios_model->get_all_com_act($id_act,$e_mail,$grupo,$id_coord);
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {    
            if($id_coord == $coords->id_coord) {                            
                $data['miCoordinacion']= $coords->coordinacion;
            }
        }
        //
        // NECESIDADES DE LA CEDULA /////////////////////////////////////////////////////////////////////////////////
        $res = $this->necesidades_model->get_all_nec_act($id_act);
        $total = '';
        if (is_array($res) === TRUE) {
            $data['get_all_nec_act'] = $this->necesidades_model->get_all_nec_act($id_act);
            foreach ($data['get_total_act'] as $tot ) : 
                $total += $tot->total_act; 
            endforeach;        
            //$this->actividades_model->update_costo_secture($id_act,$total);            
        }else{echo "NO ES UN ARRAY";}
        //
        // CONSOLIDADO /////////////////////////////////////////////////////////////////////////////////////////////
        $cons = $this->consolidados_model->get_all_cons_act($id_act);
        $total_gas = 0; // Total Gastado o Ejecutado
        if (is_array($cons) === TRUE) {
            $data['get_all_cons_act'] = $this->consolidados_model->get_all_cons_act($id_act);
            foreach ($data['get_total_act_cons'] as $tot ) : 
                $total_gas += $tot->tot_tot; 
            endforeach;
            $this->actividades_model->update_pres_gas($id_act,$total_gas);
            // Actualiza el campo "pres_gas" de la cédula con base en el total de lo Gastado            
        }else{echo "NO ES UN ARRAY";}


        $this->load->view('header_view',$data); 
        $this->load->view('vista_previa_presupuesto_view',$data);   
        $this->load->view('footer_view',$data);        
    }

    public function master_plan(){
		$e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $data['grupo'] = $grupo;
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
		$data['onlyusername'] = strstr($e_mail,'@',true);
        $data['title']= 'Master Plan del Festival de Calaveras';
        
		$this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('categorias_model');
        $this->load->model('coordinadores_model');
        
        // Código que pone en el encabezado de la página la Coordinación del Usuario.
        /////////////////////////////////////////////////////////////////////////////
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }

        // Obtiene los años de cada edicion
        $edicionesTrabajo = array();
        $idsfcTrabajo = array();
        $fcTrabajo = false;
        foreach ($data['get_fc'] as $anio) {
            array_push($edicionesTrabajo, $anio->anio);
            array_push($idsfcTrabajo, $anio->id_fc);
            if ( ($fcTrabajo == false) && ($anio->anio == anioActual) ) {
                $fcTrabajo = $anio->id_fc ;
            }
        }
        /////////////////////////////////////////////////////////////////////////////
        
        $data['get_master_plan'] = $this->actividades_model->get_master_plan($edicion);
        $data['get_all_cats'] = $this->categorias_model->get_all_cats();
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        $data['get_all'] = $this->necesidades_model->get_all();
                
        $this->load->view('header_view',$data);
        $this->load->view('master_plan_view',$data);
        $this->load->view('footer_view',$data);
	}
    
    
    
    
    
    
    
    public function is_borrar_act($id_act)
    {
        $e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $data['grupo'] = $grupo;
        $id_coord = $_SESSION['id_coord'];
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('actividades_model');  
        $this->load->model('coordinadores_model');
        $data['get_one_act_edit'] = $this->actividades_model->get_one_act_edit($id_act,$e_mail,$grupo,$id_coord,$edicion);
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
		$this->load->view('is_actividad_view',$data);
    }
    public function borrar_act($id_act)
    {
        $this->load->model('actividades_model');
        $this->actividades_model->delete($id_act);
        redirect('actividades/');
    }
    public function en_desarrollo()
    {
        $e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $data['grupo'] = $grupo;
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('coordinadores_model');
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
        $this->load->view('endesarrollo_view',$data);	
    }
    
    public function tutorial()
    {
        $e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $data['grupo'] = $grupo;
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('coordinadores_model');
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
        $this->load->view('header_view',$data); 
        $this->load->view('tutorial_view',$data);
        $this->load->view('footer_view',$data);
        
    }
    
    public function padron_proveedores(){
		$e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $data['grupo'] = $grupo;
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
		$data['onlyusername'] = strstr($e_mail,'@',true);
        $data['title']= 'Padrón Único de Proveedores del Estado de Aguascalientes';
        $this->load->model('coordinadores_model');
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }

        // Obtiene los años de cada edicion
        $edicionesTrabajo = array();
        $idsfcTrabajo = array();
        $fcTrabajo = false;
        foreach ($data['get_fc'] as $anio) {
            array_push($edicionesTrabajo, $anio->anio);
            array_push($idsfcTrabajo, $anio->id_fc);
            if ( ($fcTrabajo == false) && ($anio->anio == anioActual) ) {
                $fcTrabajo = $anio->id_fc ;
            }
        }
        // Busca el anioActual dentro del arrey $edicionesTrabajo, devuelve false sino existe dentro.
        $anioTrabajo = in_array(anioActual, $edicionesTrabajo);
        $idfcTrabajo = in_array($fcTrabajo, $idsfcTrabajo);

        $data['anioTrabajo'] = $anioTrabajo;
        $data['idfcTrabajo'] = $idfcTrabajo;
        $data['fcTrabajo']   = $fcTrabajo;


		$this->load->view('header_view',$data); 
        $this->load->view('padron_proveedores_view',$data);
        $this->load->view('footer_view',$data);
        
	}
    
    ////////////////////////////////////////////////////
    ////////////////////////////////////////////////////
    ////////////////////////////////////////////////////
    //////////////// NOTIFICAR POR EMAIL ///////////////
    
    function notificar_msg($last_id = '',$e_mail = '')
	{

    $config['protocol']    = 'smtp';
    $config['smtp_host']    = 'autodiscover.aguascalientes.gob.mx';
    $config['smtp_port']    = '25';
    $config['smtp_timeout'] = '7';
    $config['smtp_user']    = 'GOBAGS/luis.villasenor';
    $config['smtp_pass']    = 'lgvA6773';
    $config['charset']    = 'utf-8';
    $config['newline']    = "\r\n";
    $config['mailtype'] = 'text'; // or html
    $config['validation'] = TRUE; // bool whether to validate email or not      

    $this->email->initialize($config);

    $this->email->from('AdminWebApp@app.com', 'Sistema Control de Cédulas');
    $this->email->to('rabindranath.garcia@aguascalientes.gob.mx, luis.villasenor@aguascalientes.gob.mx'); 

    $this->email->subject('ACTIVACIÓN de Nueva Cédula');
    $this->email->message('El usuario '.$e_mail.' Activó la cédula No. '.$last_id.' para la Edición '.anioActual);  

    $this->email->send();

    //echo $this->email->print_debugger();

	}
    
    
    
    public function si_autorizar(){
        
        $e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $data['grupo'] = $grupo;
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
        $data['title']= 'Si Autorizar';
		$data['onlyusername'] = strstr($e_mail,'@',true);
        
        $succes  = $this->input->post('succes');
        $id_act  = $this->input->post('id_act');
        $acti  = $this->input->post('actividad');
        $usuario = $this->input->post('usuario');// Autor de la Cédula (e_mail de la tabla actividades)
                
		$this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('categorias_model');
        $this->load->model('coordinadores_model');
        $this->load->model('comentarios_model');
        $this->load->model('users_model');
        
        $data['get_total_cedulas'] = $this->actividades_model->get_total_cedulas($e_mail,$edicion);
        $data['get_registros'] = $this->necesidades_model->get_registros();
        $data['get_categorias'] = $this->categorias_model->get_categorias($id_coord,$grupo);
        $data['get_all_cats'] = $this->categorias_model->get_all_cats();
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
            if($id_coord == $coords->id_coord) {             
                $data['miCoordinacion']= $coords->coordinacion;
            }
        }
        
		$data['get_all_actividades'] = $this->actividades_model->get_all_actividades($e_mail,$grupo,$id_coord,$edicion);
        $data['get_resp'] = $this->actividades_model->get_resp($e_mail,$grupo,$id_coord);
        $data['get_reg'] = $this->actividades_model->get_reg($e_mail,$id_coord);
        foreach ($data['get_reg'] as $regs ) {
            $data['num_regs']= $regs->tot;                        
        }
        
        $this->actividades_model->si_autorizar($id_act,$succes);
        
        $data['get_all_users'] = $this->users_model->get_all_users();
        foreach ($data['get_all_users'] as $usrs ) {
            if($usuario == $usrs->email_address) {                
                $autor = $usrs->email_notify;
            }
        }
        
        $this->notificar_aprobacion($id_act,$e_mail,$autor,$acti);
                
		redirect('actividades/vista_previa/'.$id_act);
	}
    public function si_integrado(){
        
        $e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $data['grupo'] = $grupo;
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
        $data['title']= 'Si Autorizar';
		$data['onlyusername'] = strstr($e_mail,'@',true);
        
        $integrado  = $this->input->post('integrado');
        $id_act  = $this->input->post('id_act');
        $acti  = $this->input->post('actividad');
        $usuario = $this->input->post('usuario');// Autor de la Cédula (e_mail de la tabla actividades)
                
		$this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('categorias_model');
        $this->load->model('coordinadores_model');
        $this->load->model('comentarios_model');
        $this->load->model('users_model');
        
        $data['get_total_cedulas'] = $this->actividades_model->get_total_cedulas($e_mail,$edicion);
        $data['get_registros'] = $this->necesidades_model->get_registros();
        $data['get_categorias'] = $this->categorias_model->get_categorias($id_coord,$grupo);
        $data['get_all_cats'] = $this->categorias_model->get_all_cats();
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
            if($id_coord == $coords->id_coord) {             
                $data['miCoordinacion']= $coords->coordinacion;
            }
        }
        
		$data['get_all_actividades'] = $this->actividades_model->get_all_actividades($e_mail,$grupo,$id_coord,$edicion);
        $data['get_resp'] = $this->actividades_model->get_resp($e_mail,$grupo,$id_coord);
        $data['get_reg'] = $this->actividades_model->get_reg($e_mail,$id_coord);
        foreach ($data['get_reg'] as $regs ) {
            $data['num_regs']= $regs->tot;                        
        }
        
        $this->actividades_model->integrado($id_act,$integrado);
        
        $data['get_all_users'] = $this->users_model->get_all_users();
        foreach ($data['get_all_users'] as $usrs ) {
            if($usuario == $usrs->email_address) {                
                $autor = $usrs->email_notify;
            }
        }
        
        $this->notificar_integrado($id_act,$e_mail,$autor,$acti);
                
		redirect('actividades/vista_previa/'.$id_act);
	}
    public function si_presupuestado(){  
        
        $e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $data['grupo'] = $grupo;
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
        $data['title']= 'Si Autorizar';
		$data['onlyusername'] = strstr($e_mail,'@',true);
        
        $presupuestado  = $this->input->post('presupuestado');
        $id_act  = $this->input->post('id_act');
        $acti  = $this->input->post('actividad');
        $usuario = $this->input->post('usuario');// Autor de la Cédula (e_mail de la tabla actividades)
                
		$this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('categorias_model');
        $this->load->model('coordinadores_model');
        $this->load->model('comentarios_model');
        $this->load->model('users_model');
        
        $data['get_total_cedulas'] = $this->actividades_model->get_total_cedulas($e_mail,$edicion);
        $data['get_registros'] = $this->necesidades_model->get_registros();
        $data['get_categorias'] = $this->categorias_model->get_categorias($id_coord,$grupo);
        $data['get_all_cats'] = $this->categorias_model->get_all_cats();
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
            if($id_coord == $coords->id_coord) {             
                $data['miCoordinacion']= $coords->coordinacion;
            }
        }
        
		$data['get_all_actividades'] = $this->actividades_model->get_all_actividades($e_mail,$grupo,$id_coord,$edicion);
        $data['get_resp'] = $this->actividades_model->get_resp($e_mail,$grupo,$id_coord);
        $data['get_reg'] = $this->actividades_model->get_reg($e_mail,$id_coord);
        foreach ($data['get_reg'] as $regs ) {
            $data['num_regs']= $regs->tot;                        
        }
        
        $this->actividades_model->presupuestado($id_act,$presupuestado);
        
        $data['get_all_users'] = $this->users_model->get_all_users();
        foreach ($data['get_all_users'] as $usrs ) {
            if($usuario == $usrs->email_address) {                
                $autor = $usrs->email_notify;
            }
        }
        
        $this->notificar_presupuestado($id_act,$e_mail,$autor,$acti);
                
		redirect('actividades/vista_previa/'.$id_act);
	}
    public function no_autorizar(){
        
        $e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $data['grupo'] = $grupo;
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
        $data['title']= 'No Autorizar';
		$data['onlyusername'] = strstr($e_mail,'@',true);
        
        $fail = $this->input->post('fail');
        $id_act = $this->input->post('id_act');
        
		$this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('categorias_model');
        $this->load->model('coordinadores_model');
        $this->load->model('comentarios_model');
        
        $data['get_total_cedulas'] = $this->actividades_model->get_total_cedulas($e_mail,$edicion);
        $data['get_registros'] = $this->necesidades_model->get_registros();
        $data['get_categorias'] = $this->categorias_model->get_categorias($id_coord,$grupo);
        $data['get_all_cats'] = $this->categorias_model->get_all_cats();
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
            if($id_coord == $coords->id_coord) {
             
                $data['miCoordinacion']= $coords->coordinacion;
            }
        }
        
		$data['get_all_actividades'] = $this->actividades_model->get_all_actividades($e_mail,$grupo,$id_coord,$edicion);
        $data['get_resp'] = $this->actividades_model->get_resp($e_mail,$grupo,$id_coord);
        $data['get_reg'] = $this->actividades_model->get_reg($e_mail,$id_coord);
        foreach ($data['get_reg'] as $regs ) {
            $data['num_regs']= $regs->tot;                        
        }
        
        $this->actividades_model->no_autorizar($id_act,$fail);
                
		redirect('actividades/vista_previa/'.$id_act);
	}
    public function pendiente(){
        
        $e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $data['grupo'] = $grupo;
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
        $data['title']= 'No Autorizar';
		$data['onlyusername'] = strstr($e_mail,'@',true);
        
        $pend = $this->input->post('pend');
        $id_act = $this->input->post('id_act');
        
		$this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('categorias_model');
        $this->load->model('coordinadores_model');
        $this->load->model('comentarios_model');
        
        $data['get_total_cedulas'] = $this->actividades_model->get_total_cedulas($e_mail,$edicion);
        $data['get_registros'] = $this->necesidades_model->get_registros();
        $data['get_categorias'] = $this->categorias_model->get_categorias($id_coord,$grupo);
        $data['get_all_cats'] = $this->categorias_model->get_all_cats();
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
            if($id_coord == $coords->id_coord) {
             
                $data['miCoordinacion']= $coords->coordinacion;
            }
        }
        
		$data['get_all_actividades'] = $this->actividades_model->get_all_actividades($e_mail,$grupo,$id_coord,$edicion);
        $data['get_resp'] = $this->actividades_model->get_resp($e_mail,$grupo,$id_coord);
        $data['get_reg'] = $this->actividades_model->get_reg($e_mail,$id_coord);
        foreach ($data['get_reg'] as $regs ) {
            $data['num_regs']= $regs->tot;                        
        }
        
        $this->actividades_model->pendiente($id_act,$pend);
                
		redirect('actividades/vista_previa/'.$id_act);
	}
    public function fuera_presupuesto(){
        
        $e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $data['grupo'] = $grupo;
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
        $data['title']= 'Fuera de Presupuesto';
        $data['onlyusername'] = strstr($e_mail,'@',true);
        
        $out = $this->input->post('out');
        $id_act = $this->input->post('id_act');
        
        $this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('categorias_model');
        $this->load->model('coordinadores_model');
        $this->load->model('comentarios_model');
        
        $data['get_total_cedulas'] = $this->actividades_model->get_total_cedulas($e_mail,$edicion);
        $data['get_registros'] = $this->necesidades_model->get_registros();
        $data['get_categorias'] = $this->categorias_model->get_categorias($id_coord,$grupo);
        $data['get_all_cats'] = $this->categorias_model->get_all_cats();
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
            if($id_coord == $coords->id_coord) {
             
                $data['miCoordinacion']= $coords->coordinacion;
            }
        }
        
        $data['get_all_actividades'] = $this->actividades_model->get_all_actividades($e_mail,$grupo,$id_coord,$edicion);
        $data['get_resp'] = $this->actividades_model->get_resp($e_mail,$grupo,$id_coord);
        $data['get_reg'] = $this->actividades_model->get_reg($e_mail,$id_coord);
        foreach ($data['get_reg'] as $regs ) {
            $data['num_regs']= $regs->tot;                        
        }
        
        $this->actividades_model->fuera_presupuesto($id_act,$out);
                
        redirect('actividades/vista_previa/'.$id_act);
    }

    public function cerrar_presupuesto($id_act){
        
        $this->load->model('actividades_model');
                
        $this->actividades_model->cerrar_presupuesto($id_act);
                
        redirect('actividades/dashboard_actividades/');
    }

    /* NOTIFICA POR MAIL LA APROBACION CONCEPTUAL DE LA CEDULA */
    function notificar_aprobacion($id_act,$e_mail,$autor,$acti)
	{
        
    $config['protocol']    = 'smtp';
    $config['smtp_host']    = 'autodiscover.aguascalientes.gob.mx';
    $config['smtp_port']    = '25';
    $config['smtp_timeout'] = '7';
    $config['smtp_user']    = 'GOBAGS/luis.villasenor';
    $config['smtp_pass']    = 'lgvA6773';
    $config['charset']    = 'utf-8';
    $config['newline']    = "\r\n";
    $config['mailtype'] = 'html'; // or html
    $config['validation'] = TRUE; // bool whether to validate email or not      

    $this->email->initialize($config);

    $this->email->from($e_mail, 'APROBACIÓN CONCEPTUAL');
    $this->email->to($autor); 
    $this->email->cc('rabindranath.garcia@aguascalientes.gob.mx, luis.villasenor@aguascalientes.gob.mx'); 
    

    $this->email->subject('APROBACIÓN CONCEPTUAL DE LA CEDULA NO. '.$id_act.' - '.$acti);
    $this->email->message('
    
            <!DOCTYPE html>
            <html>
            <head>
            <meta charset="utf-8">
            <style>
            table, th, td
            {
            border-collapse:collapse;
            border:1px solid black;
            }
            th, td
            {
            padding:5px;
            }
            h3
            { color: red; }
            
            </style>
            </head>
            <body>
            
            <table>
            <tr>
              <th>STATUS</th>
              <td><h3>APROBADO CONCEPTUAL</h3></td>
            </tr>
            <tr>
              <th>CEDULA No.</th>
              <td>'.$id_act.'</td>
            </tr>
            <tr>
              <th>ACTIVIDAD</th>
              <td>'.$acti.'</td>
            </tr>
            <tr>
              <th>Aprobado Por:</th>
              <td>'.$e_mail.'</td>
            </tr>
            <tr>
              <th>Enviado a:</th>
              <td>'.$autor.'</td>
            </tr>            
            </table>
            
            <p>Para ver su Cédula debe accesar a link http://10.1.17.10/appcedula</p>
            
            <p><small>No responda a este mail, se envía desde un buzón no-supervisado y con copia para los Coordinadores Generales del Festival de Calaveras</small></p>
            
            <p><small>Para mayor información sobre este mail solicite ayuda técnica a la extensión 4336 ó levante una Orden de Servicio al Departamento de Informática aquí <a href="https://sites.google.com/site/informaticasecture/genera-tu-solicitud" target="_blank">Ordenes de Servicio</a></small></p>
            
            </body>
            </html>
            
            ');
    $this->email->send();
    //echo $this->email->print_debugger();
	}
    
    /* NOTIFICA POR MAIL LA INTEGRACION AL PROGRAMA GENERAL DEL FESTIVAL DE CALAVERAS */
    function notificar_integrado($id_act,$e_mail,$autor,$acti)
	{
        
    $config['protocol']    = 'smtp';
    $config['smtp_host']    = 'autodiscover.aguascalientes.gob.mx';
    $config['smtp_port']    = '25';
    $config['smtp_timeout'] = '7';
    $config['smtp_user']    = 'GOBAGS/luis.villasenor';
    $config['smtp_pass']    = 'lgvA6773';
    $config['charset']    = 'utf-8';
    $config['newline']    = "\r\n";
    $config['mailtype'] = 'html'; // or html
    $config['validation'] = TRUE; // bool whether to validate email or not      

    $this->email->initialize($config);

    $this->email->from($e_mail, 'INTEGRACION AL PROGRAMA GENERAL DEL FESTIVAL DE CALAVERAS');
    $this->email->to($autor); 
    $this->email->cc('rabindranath.garcia@aguascalientes.gob.mx, luis.villasenor@aguascalientes.gob.mx'); 
    

    $this->email->subject('INTEGRADO AL PROGRAMA GENERAL LA CEDULA NO. '.$id_act.' - '.$acti);
    $this->email->message('
    
            <!DOCTYPE html>
            <html>
            <head>
            <meta charset="utf-8">
            <style>
            table, th, td
            {
            border-collapse:collapse;
            border:1px solid black;
            }
            th, td
            {
            padding:5px;
            }
            h3
            { color: red; }
            
            </style>
            </head>
            <body>
            
            <table>
            <tr>
              <th>STATUS</th>
              <td><h3>INTEGRADO AL PROGRAMA GENERAL</h3></td>
            </tr>
            <tr>
              <th>CEDULA No.</th>
              <td>'.$id_act.'</td>
            </tr>
            <tr>
              <th>ACTIVIDAD</th>
              <td>'.$acti.'</td>
            </tr>
            <tr>
              <th>Aprobado Por:</th>
              <td>'.$e_mail.'</td>
            </tr>
            <tr>
              <th>Enviado a:</th>
              <td>'.$autor.'</td>
            </tr>            
            </table>
            
            <p>Para ver su Cédula debe accesar a link http://10.1.17.10/appcedula</p>
            
            <p><small>No responda a este mail, se envía desde un buzón no-supervisado y con copia para los Coordinadores Generales del Festival de Calaveras</small></p>
            
            <p><small>Para mayor información sobre este mail solicite ayuda técnica a la extensión 4336 ó levante una Orden de Servicio al Departamento de Informática aquí <a href="https://sites.google.com/site/informaticasecture/genera-tu-solicitud" target="_blank">Ordenes de Servicio</a></small></p>
            
            </body>
            </html>
            
            ');
    $this->email->send();
    //echo $this->email->print_debugger();
	}
     
    /* NOTIFICA POR MAIL LA AUTORIZACION DEL PRESUPUESTO DE LA CEDULA  */
    function notificar_presupuestado($id_act,$e_mail,$autor,$acti)
	{
        
    $config['protocol']    = 'smtp';
    $config['smtp_host']    = 'autodiscover.aguascalientes.gob.mx';
    $config['smtp_port']    = '25';
    $config['smtp_timeout'] = '7';
    $config['smtp_user']    = 'GOBAGS/luis.villasenor';
    $config['smtp_pass']    = 'lgvA6773';
    $config['charset']    = 'utf-8';
    $config['newline']    = "\r\n";
    $config['mailtype'] = 'html'; // or html
    $config['validation'] = TRUE; // bool whether to validate email or not      

    $this->email->initialize($config);

    $this->email->from($e_mail, 'PRESUPUESTO AUTORIZADO DE SU CEDULA');
    $this->email->to($autor); 
    $this->email->cc('luis.villasenor@aguascalientes.gob.mx,blanca.martinez@aguascalientes.gob.mx,oscar.morales@aguascalientes.gob.mx'); 

    $this->email->subject('PRESUPUESTO AUTORIZADO CEDULA NO. '.$id_act.' - '.$acti);
    $this->email->message('
    
            <!DOCTYPE html>
            <html>
            <head>
            <meta charset="utf-8">
            <style>
            table, th, td
            {
            border-collapse:collapse;
            border:1px solid black;
            }
            th, td
            {
            padding:5px;
            }
            h3
            { color: red; }
            
            </style>
            </head>
            <body>
            
            <table>
            <tr>
              <th>STATUS</th>
              <td><h3>PRESUPUESTO AUTORIZADO</h3></td>
            </tr>
            <tr>
              <th>CEDULA No.</th>
              <td>'.$id_act.'</td>
            </tr>
            <tr>
              <th>ACTIVIDAD</th>
              <td>'.$acti.'</td>
            </tr>
            <tr>
              <th>Aprobado Por:</th>
              <td>'.$e_mail.'</td>
            </tr>
            <tr>
              <th>Enviado a:</th>
              <td>'.$autor.'</td>
            </tr>            
            </table>
            
            <p>Para ver su Cédula debe accesar a link http://10.1.17.10/appcedula</p>
            
            <p><small>No responda a este mail, se envia desde un buzon no supervisado y con copia para los Coordinadores Generales del Festival de Calaveras</small></p>
            
            <p><small>Para mayor información sobre este mail solicite ayuda técnica a la extensión 4336 ó levante una <a href="https://sites.google.com/site/informaticasecture/genera-tu-solicitud" target="_blank">Orden de Servicio</a> al Departamento de Informática.</small></p>
            
            </body>
            </html>
            
            ');
    $this->email->send();
    //echo $this->email->print_debugger();
	}
    
    
    public function actualizar_pres(){
		$e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $data['grupo'] = $grupo;
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('actividades_model');
        $this->load->model('coordinadores_model');
        $this->load->model('necesidades_model');

        
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
            if($id_coord == $coords->id_coord) {                
                $data['miCoordinacion']= $coords->coordinacion;
            }
        }
        
        $id_act = $this->input->post('id_act');
        $pres_ant =  $this->input->post('pres_ant');
        $pres_soli = $this->input->post('pres_soli');
        $pres_aut =  $this->input->post('pres_aut');
        $pres_eje =  $this->input->post('pres_eje');

        $get_total_act = $this->necesidades_model->get_total_act($id_act);
        foreach ($get_total_act as $tot ) : 
            $pres_soli = $tot->tot_tot;
        endforeach;        

        $pres_eje = ( $pres_aut - $pres_soli );

        
        $is_ok = $this->actividades_model->act_pres_ant($id_act,$pres_ant,$pres_soli,$pres_aut,$pres_eje);

        if($is_ok){
            $data['get_one_act_edit'] = $this->actividades_model->get_one_act_edit($id_act,$e_mail,$grupo,$id_coord,$edicion);            
		    $this->load->view('is_Nok_view',$data);
        }else{
            $data['get_one_act_edit'] = $this->actividades_model->get_one_act_edit($id_act,$e_mail,$grupo,$id_coord,$edicion);            
            $this->load->view('is_ok_view',$data);
        }
        
        $this->vista_previa($id_act);        
        //redirect(base_url('actividades/vista_previa_presupuesto/'.$id_act));
        
	}

    public function actualizar_pres_aut(){
        $e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $data['grupo'] = $grupo;
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
        $data['onlyusername'] = strstr($e_mail,'@',true);
        $this->load->model('actividades_model');
        $this->load->model('coordinadores_model');
        $this->load->model('necesidades_model');
        
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
            if($id_coord == $coords->id_coord) {                
                $data['miCoordinacion']= $coords->coordinacion;
            }
        }
        $status = 4; // Presupuesto Autorizado        
        $get_all_status = $this->actividades_model->get_all_status($e_mail,$grupo,$id_coord,$status,$edicion);
        foreach ($get_all_status as $key => $value) {
            
            echo "id_act => ";
            echo $value->id_act;
            
            $get_total_act = $this->necesidades_model->get_total_act($value->id_act);
                foreach ($get_total_act as $tot ) : 
                    $pres_soli = $tot->tot_tot;
                endforeach;        
                $pres_eje = ( $value->pres_aut - $pres_soli );

            echo "pres_soli => ";
            echo $pres_soli;
            echo "pres_aut => ";
            echo $value->pres_aut;
            echo "pres_eje => ";
            echo $pres_eje;
            echo "<br>";
        }

        
        
  /*      $is_ok = $this->actividades_model->act_pres_ant($id_act,$pres_ant,$pres_soli,$pres_aut,$pres_eje);
        $this->vista_previa($id_act);        
  */      
    }
    
    public function actualizar_movs(){
		$e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $data['grupo'] = $grupo;
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
		$data['onlyusername'] = strstr($e_mail,'@',true);
		$this->load->model('actividades_model');
        $this->load->model('coordinadores_model');
        $this->load->model('movimientos_model');
        
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
        
        $id_act = $this->input->post('id_act');
        $pres_soli = $this->input->post('pres_soli');
                
        $data['get_all_movs'] = $this->movimientos_model->get_all_movs($id_act);
                
        $this->vista_previa($id_act);        
        
	}


    
    

///////////// COPIAR Y PEGAR UN REGISTRO //////////
    public function copiar($id_act)
    {
        $e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $data['grupo'] = $grupo;
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
        $data['onlyusername'] = strstr($e_mail,'@',true);
        $this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $total = '';
        $bloq = '5';// Una vez copiado el registro, este se bloquea.
        
        // Obtiene los años de cada edicion
        $edicionesTrabajo = array();
        $idsfcTrabajo = array();
        $fcTrabajo = false;
        foreach ($data['get_fc'] as $anio) {
            array_push($edicionesTrabajo, $anio->anio);
            array_push($idsfcTrabajo, $anio->id_fc);
            if ( ($fcTrabajo == false) && ($anio->anio == anioActual) ) {
                $fcTrabajo = $anio->id_fc ;
            }
        }
        // Busca el anioActual dentro del arrey $edicionesTrabajo, devuelve false sino existe dentro.
        $anioTrabajo = in_array(anioActual, $edicionesTrabajo);
        $idfcTrabajo = in_array($fcTrabajo, $idsfcTrabajo);
        //var_dump($anioTrabajo);
        //var_dump($idfcTrabajo);
        //die();
        // Si anioActual existe dentro de las edicionesTrabajo, adelante sino bye.
        if ( $anioTrabajo && $idfcTrabajo ) {
            
            // Arreglo que contiene el registro completo a copiar.
            $reg = $this->actividades_model->get_one_to_copi($id_act);
            if (is_array($reg) === TRUE) {
                $last_id = $this->actividades_model->paste($reg,$ed = $fcTrabajo);
                echo $last_id;
                echo "<br>";
                $this->actividades_model->bloqueo($id_act,$bloq);
                // Copia Pega el detalle de necesidades de la cédula
                $nec = $this->necesidades_model->get_all_nec_act($id_act);
                if (is_array($nec) === TRUE) {
                    $this->necesidades_model->paste($nec,$last_id);
                    $data['get_total_act'] = $this->necesidades_model->get_total_act($id_act = $last_id);
                    foreach ($data['get_total_act'] as $tot ) : 
                        $total += $tot->total_act; 
                    endforeach;        
                    $this->actividades_model->update_costo_secture($id_act,$total);
                    $this->notificar_msg($last_id,$e_mail);
                }else{echo "NO ES UN ARRAY";die();}
            }else{echo "NO ES UN ARRAY";die();}
        }else{echo "LA EDICION ".anioActual." NO ES VALIDA o NO ESTA ACTIVA";die();}
        redirect(base_url('actividades/index'));
    }
///////////////////////////////////////////////////
///////////////// DASHBOARD ///////////////////////

    public function dashboard(){
        
        $e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $data['grupo'] = $grupo;
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $edicion;
        $data['title']= 'Dashboard';
        $data['onlyusername'] = strstr($e_mail,'@',true);
        
        $this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('categorias_model');
        $this->load->model('coordinadores_model');
        $this->load->model('comentarios_model');
        
        
        $data['get_total_cedulas'] = $this->actividades_model->get_total_cedulas($e_mail,$edicion);
        $data['get_registros'] = $this->necesidades_model->get_registros();
        $data['get_categorias'] = $this->categorias_model->get_categorias($id_coord,$grupo);
        $data['get_all_cats'] = $this->categorias_model->get_all_cats();
        $data['get_fc'] = $this->fc_model->get_fc();
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
                
        $data['get_all_actividades'] = $this->actividades_model->get_all_actividades($e_mail,$grupo,$id_coord,$edicion);
        $data['get_resp'] = $this->actividades_model->get_resp($e_mail,$grupo,$id_coord,$edicion);
        $data['get_reg'] = $this->actividades_model->get_reg($e_mail,$id_coord,$edicion);

        /*******************************************************/
        $pres_aut = 0;
        $pres_gas = 0; // Presupuesto Gastado y Pagado a Proveedor
        $costo_secture = 0; // Presupuesto Planeado por el Area Responsable
        $pres_eje = 0;
        $fuera_pres = 0;
        $resultadoPresupuesto = 0; // Variable que almacena la diferencia entre Presupuesto Autorizado y Ejercido

            if ( ! empty($data['get_all_actividades']) ) {
                foreach ($data['get_all_actividades'] as $key => $value) {
                    if ($value->status_act != 6) { // Fuera de Presupuesto
                        $pres_aut = $pres_aut + $value->pres_aut;
                        $costo_secture = $costo_secture + $value->costo_secture;
                        $pres_eje = $pres_eje + $value->pres_eje;
                        $pres_gas = $pres_gas + $value->pres_gas;               
                    }else{                        
                        $fuera_pres = $fuera_pres + $value->costo_secture;
                    }
                }
            }

        $resultadoPresupuesto = ( $pres_aut - $pres_gas );
        
        $data['suma_pres_aut']      = $pres_aut;
        $data['suma_costo_secture'] = $costo_secture;
        $data['suma_pres_eje']      = $pres_eje;
        $data['suma_pres_gas']      = $pres_gas;
        $data['suma_fuera_pres']    = $fuera_pres;
        $data['suma_resultadoPresupuesto']    = $resultadoPresupuesto;
        /**********************************************************/
                
        $this->load->view('header_view',$data); 
        $this->load->view('dashboard_view',$data);
        $this->load->view('footer_view',$data); 
    }

    public function dashboard_actividades(){
        
        $e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $data['grupo'] = $grupo;
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $edicion;
        $data['title']= 'Dashboard';
        $data['onlyusername'] = strstr($e_mail,'@',true);
        
        $this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('categorias_model');
        $this->load->model('coordinadores_model');
        $this->load->model('comentarios_model');
        
        
        $data['get_total_cedulas'] = $this->actividades_model->get_total_cedulas($e_mail,$edicion);
        $data['get_registros'] = $this->necesidades_model->get_registros();
        $data['get_categorias'] = $this->categorias_model->get_categorias($id_coord,$grupo);
        $data['get_all_cats'] = $this->categorias_model->get_all_cats();
        $data['get_fc'] = $this->fc_model->get_fc();
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
        $status = '4'; // Status de Presupuesto Autorizado
        $data['get_all_actividades'] = $this->actividades_model->get_all_status($e_mail,$grupo,$id_coord,$status,$edicion);
        $data['get_resp'] = $this->actividades_model->get_resp($e_mail,$grupo,$id_coord,$edicion);
        $data['get_reg'] = $this->actividades_model->get_reg($e_mail,$id_coord,$edicion);

        
        /*******************************************************/
        $pres_aut = 0;
        $pres_gas = 0; // Presupuesto Gastado y Pagado a Proveedor
        $costo_secture = 0; // Presupuesto Planeado por el Area Responsable
        $pres_eje = 0;
        $fuera_pres = 0;
        $resultadoPresupuesto = 0; // Variable que almacena la diferencia entre Presupuesto Autorizado y Ejercido

            if ( ! empty($data['get_all_actividades']) ) {
                foreach ($data['get_all_actividades'] as $key => $value) {
                    if ($value->status_act != 6) { // Fuera de Presupuesto
                        $pres_aut = $pres_aut + $value->pres_aut;
                        $costo_secture = $costo_secture + $value->costo_secture;
                        $pres_eje = $pres_eje + $value->pres_eje;
                        $pres_gas = $pres_gas + $value->pres_gas;               
                    }else{                        
                        $fuera_pres = $fuera_pres + $value->costo_secture;
                    }
                }
            }

        $resultadoPresupuesto = ( $pres_aut - $pres_gas );
        
        $data['suma_pres_aut']      = $pres_aut;
        $data['suma_costo_secture'] = $costo_secture;
        $data['suma_pres_eje']      = $pres_eje;
        $data['suma_pres_gas']      = $pres_gas;
        $data['suma_fuera_pres']    = $fuera_pres;
        $data['suma_resultadoPresupuesto']    = $resultadoPresupuesto;
        /**********************************************************/
                
        $this->load->view('header_view',$data); 
        $this->load->view('dashboard_actividades_view',$data);
        $this->load->view('footer_view',$data); 
    }

    public function dashboard_consolidados($tipo = '',$clasificacion = 'todo'){
        
        $e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $data['grupo'] = $grupo;
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $edicion;
        $data['title']= 'Dashboard';
        $data['onlyusername'] = strstr($e_mail,'@',true);
        
        $this->load->model('actividades_model');
        $this->load->model('categorias_model');
        $this->load->model('coordinadores_model');
        $this->load->model('consolidados_model');
        
        
        $data['get_total_cedulas'] = $this->actividades_model->get_total_cedulas($e_mail,$edicion);
        $data['get_categorias'] = $this->categorias_model->get_categorias($id_coord,$grupo);
        $data['get_all_cats'] = $this->categorias_model->get_all_cats();
        $data['get_fc'] = $this->fc_model->get_fc();
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {    
            if($id_coord == $coords->id_coord) {                            
                $data['miCoordinacion']= $coords->coordinacion;
            }
        }
                
        $data['get_groupby_clasificacion'] = $this->consolidados_model->get_groupby_clasificacion();
        $data['get_all_cons_act'] = $this->consolidados_model->get_all_cons_tipo($tipo,$clasificacion);
        $data['get_resp'] = $this->actividades_model->get_resp($e_mail,$grupo,$id_coord,$edicion);
        $data['get_reg'] = $this->actividades_model->get_reg($e_mail,$id_coord,$edicion);

        
        /*******************************************************/
        $pres_aut = 0;
        $costo_secture = 0;
        $pres_eje = 0;
        $fuera_pres = 0;

            if ( ! empty($data['get_all_actividades']) ) {
                foreach ($data['get_all_actividades'] as $key => $value) {
                    if ($value->status_act != 6) { // Fuera de Presupuesto
                        $pres_aut = $pres_aut + $value->pres_aut;
                        $costo_secture = $costo_secture + $value->costo_secture;
                        $pres_eje = $pres_eje + $value->pres_eje;               
                    }else{                        
                        $fuera_pres = $fuera_pres + $value->costo_secture;
                    }
                }
            }
        
        $data['suma_pres_aut']      = $pres_aut;
        $data['suma_costo_secture'] = $costo_secture;
        $data['suma_pres_eje']      = $pres_eje;
        $data['suma_fuera_pres']    = $fuera_pres;
        /**********************************************************/
                
        $this->load->view('header_view',$data); 
        $this->load->view('dashboard_consolidados_view',$data);
        $this->load->view('footer_view',$data); 
    }

    public function dashboard_presupuestos(){
        
        $e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $data['grupo'] = $grupo;
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $edicion;
        $data['title']= 'Dashboard';
        $data['onlyusername'] = strstr($e_mail,'@',true);
        
        $this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('categorias_model');
        $this->load->model('comentarios_model');
        $this->load->model('coordinadores_model');
        $this->load->model('movimientos_model');
        //$data['get_one_act_edit'] = $this->actividades_model->get_one_act_edit($id_act,$e_mail,$grupo,$id_coord,$edicion);
        //$data['get_all_nec_act'] = $this->necesidades_model->get_all_nec_act($id_act);
        //$data['get_all_movs'] = $this->movimientos_model->get_all_movs($id_act);
        //$data['get_total_act'] = $this->necesidades_model->get_total_act($id_act);
        //$data['get_total_cedulas'] = $this->actividades_model->get_total_cedulas($e_mail,$edicion);
        //$data['get_categorias'] = $this->categorias_model->get_categorias($id_coord,$grupo);
        //$data['get_cal_id_act'] = $this->actividades_model->get_cal_id_act($id_act);
        $data['get_fc'] = $this->fc_model->get_fc();
        //$data['get_all_com_act'] = $this->comentarios_model->get_all_com_act($id_act,$e_mail,$grupo,$id_coord);
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
                
        $data['get_all_actividades'] = $this->actividades_model->get_all_actividades($e_mail,$grupo,$id_coord,$edicion);
        $data['get_resp'] = $this->actividades_model->get_resp($e_mail,$grupo,$id_coord,$edicion);
        $data['get_reg'] = $this->actividades_model->get_reg($e_mail,$id_coord,$edicion);

        $pres_aut = 0;
        $costo_secture = 0;
        $pres_eje = 0;

        if ( ! empty($data['get_all_actividades']) ) {
            foreach ($data['get_all_actividades'] as $key => $value) {            
                $pres_aut = $pres_aut + $value->pres_aut;
                $costo_secture = $costo_secture + $value->costo_secture;
                $pres_eje = $pres_eje + $value->pres_eje;            
            }
        }
        
        $data['suma_pres_aut']      = $pres_aut;
        $data['suma_costo_secture'] = $costo_secture;
        $data['suma_pres_eje']      = $pres_eje;
                
        $this->load->view('header_view',$data); 
        $this->load->view('dashboard_presupuesto_view',$data);
        $this->load->view('footer_view',$data); 
    }

    public function dashboard_gastos(){
        
        $e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $data['grupo'] = $grupo;
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $edicion;
        $data['title']= 'Dashboard Gastos';
        $data['onlyusername'] = strstr($e_mail,'@',true);
        
        $this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('categorias_model');
        $this->load->model('comentarios_model');
        $this->load->model('coordinadores_model');
        $this->load->model('movimientos_model');
        //$data['get_one_act_edit'] = $this->actividades_model->get_one_act_edit($id_act,$e_mail,$grupo,$id_coord,$edicion);
        //$data['get_all_nec_act'] = $this->necesidades_model->get_all_nec_act($id_act);
        //$data['get_all_movs'] = $this->movimientos_model->get_all_movs($id_act);
        //$data['get_total_act'] = $this->necesidades_model->get_total_act($id_act);
        //$data['get_total_cedulas'] = $this->actividades_model->get_total_cedulas($e_mail,$edicion);
        //$data['get_categorias'] = $this->categorias_model->get_categorias($id_coord,$grupo);
        //$data['get_cal_id_act'] = $this->actividades_model->get_cal_id_act($id_act);
        $data['get_fc'] = $this->fc_model->get_fc();
        //$data['get_all_com_act'] = $this->comentarios_model->get_all_com_act($id_act,$e_mail,$grupo,$id_coord);
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
                
        $data['get_all_actividades'] = $this->actividades_model->get_all_actividades($e_mail,$grupo,$id_coord,$edicion);
        $data['get_resp'] = $this->actividades_model->get_resp($e_mail,$grupo,$id_coord,$edicion);
        $data['get_reg'] = $this->actividades_model->get_reg($e_mail,$id_coord,$edicion);

        $pres_aut = 0;
        $costo_secture = 0;
        $pres_eje = 0;

        if ( ! empty($data['get_all_actividades']) ) {
            foreach ($data['get_all_actividades'] as $key => $value) {            
                $pres_aut = $pres_aut + $value->pres_aut;
                $costo_secture = $costo_secture + $value->costo_secture;
                $pres_eje = $pres_eje + $value->pres_eje;            
            }
        }
        
        $data['suma_pres_aut']      = $pres_aut;
        $data['suma_costo_secture'] = $costo_secture;
        $data['suma_pres_eje']      = $pres_eje;
                
        $this->load->view('header_view',$data); 
        $this->load->view('dashboard_gasto_view',$data);
        $this->load->view('footer_view',$data); 
    }

    public function dashboard_propuesto(){
        
        $e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $data['grupo'] = $grupo;
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $edicion;
        $data['title']= 'Dashboard';
        $data['onlyusername'] = strstr($e_mail,'@',true);
        
        $this->load->model('actividades_model');
        $this->load->model('necesidades_model');
        $this->load->model('categorias_model');
        $this->load->model('comentarios_model');
        $this->load->model('coordinadores_model');
        $this->load->model('movimientos_model');
        //$data['get_one_act_edit'] = $this->actividades_model->get_one_act_edit($id_act,$e_mail,$grupo,$id_coord,$edicion);
        //$data['get_all_nec_act'] = $this->necesidades_model->get_all_nec_act($id_act);
        //$data['get_all_movs'] = $this->movimientos_model->get_all_movs($id_act);
        //$data['get_total_act'] = $this->necesidades_model->get_total_act($id_act);
        //$data['get_total_cedulas'] = $this->actividades_model->get_total_cedulas($e_mail,$edicion);
        //$data['get_categorias'] = $this->categorias_model->get_categorias($id_coord,$grupo);
        //$data['get_cal_id_act'] = $this->actividades_model->get_cal_id_act($id_act);
        $data['get_fc'] = $this->fc_model->get_fc();
        //$data['get_all_com_act'] = $this->comentarios_model->get_all_com_act($id_act,$e_mail,$grupo,$id_coord);
        $data['get_all_coords'] = $this->coordinadores_model->get_all_coords();
        foreach ($data['get_all_coords'] as $coords ) {
    
                        if($id_coord == $coords->id_coord) {
                            
                            $data['miCoordinacion']= $coords->coordinacion;
                        }
        }
                
        $data['get_all_actividades'] = $this->actividades_model->get_all_actividades($e_mail,$grupo,$id_coord,$edicion);
        $data['get_resp'] = $this->actividades_model->get_resp($e_mail,$grupo,$id_coord,$edicion);
        $data['get_reg'] = $this->actividades_model->get_reg($e_mail,$id_coord,$edicion);

        $pres_aut = 0;
        $costo_secture = 0;
        $pres_eje = 0;

        if ( ! empty($data['get_all_actividades']) ) {
            foreach ($data['get_all_actividades'] as $key => $value) {            
                $pres_aut = $pres_aut + $value->pres_aut;
                $costo_secture = $costo_secture + $value->costo_secture;
                $pres_eje = $pres_eje + $value->pres_eje;            
            }
        }
        
        $data['suma_pres_aut']      = $pres_aut;
        $data['suma_costo_secture'] = $costo_secture;
        $data['suma_pres_eje']      = $pres_eje;
                
        $this->load->view('header_view',$data); 
        $this->load->view('dashboard_propuesto_view',$data);
        $this->load->view('footer_view',$data); 
    }

///////////// COPIAR Y PEGAR UN REGISTRO //////////
    public function consolidar() {

        $e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $data['grupo'] = $grupo;
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
        $data['onlyusername'] = strstr($e_mail,'@',true);
        $this->load->model('actividades_model');
        $this->load->model('consolidados_model');
        $this->load->model('necesidades_model');
        $total = '';
        $bloq = '5';// Una vez copiado el registro, quita el boton de Clasificar.

        $id_act = $this->input->post('id_act');
        $id_nec = $this->input->post('id_nec');
        //$status_necs = $this->input->post('status_necs');
        $tipo = $this->input->post('tipo');
        $clasificacion = strtoupper(url_title($this->input->post('clasificacion'),'dash',TRUE));
        $proveedor = $this->input->post('proveedor');
        $concepto = $this->input->post('concepto');
        $cantidad = $this->input->post('cantidad');
        $precio_unitario = $this->input->post('precio_unitario');
        $quien_modifica = $e_mail;
        $status_cons = 0;
        $status_necs = 1 ;

        $last_id = $this->consolidados_model->insert_entry($id_act,$id_nec,$tipo,$clasificacion,$proveedor,$concepto,$cantidad,$precio_unitario,$quien_modifica,$status_cons);

        $this->necesidades_model->update_consolidado($id_nec,$status_necs,$e_mail);

        
        
        //$reg = $this->actividades_model->get_one_to_copi($id_act);
/*
        if ($edicion != 5) { 
            if (is_array($reg) === TRUE) {
                $last_id = $this->actividades_model->paste($reg,$ed = 5);
                echo $last_id;
                echo "<br>";
                $this->actividades_model->bloqueo($id_act,$bloq);
            }else{echo "NO ES UN ARRAY";}            
        }else{echo "EDICION NO VALIDA";}

        $nec = $this->necesidades_model->get_all_nec_act($id_act);
        if (is_array($nec) === TRUE) {
            $this->necesidades_model->paste($nec,$last_id);
            $data['get_total_act'] = $this->necesidades_model->get_total_act($id_act = $last_id);
            foreach ($data['get_total_act'] as $tot ) : 
                $total += $tot->total_act; 
            endforeach;        
            $this->actividades_model->update_costo_secture($id_act,$total);
            $this->notificar_msg($last_id,$e_mail);
        }else{echo "NO ES UN ARRAY";}
*/
        //redirect(base_url('actividades/vista_previa_presupuesto/'.$id_act));
        redirect(base_url('actividades/vista_previa_presupuesto/'.$id_act));
        //$this->vista_previa_presupuesto($id_act);
        
    }

    public function actualizar_cons() {

        $e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $data['grupo'] = $grupo;
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
        $data['onlyusername'] = strstr($e_mail,'@',true);
        $this->load->model('consolidados_model');
        
        $id_con = $this->input->post('id_con');
        $id_nec = $this->input->post('id_nec');
        $id_act = $this->input->post('id_act');
        $tipo = $this->input->post('tipo');
        $clasificacion = $this->input->post('clasificacion');
        $proveedor = $this->input->post('proveedor');
        $concepto = $this->input->post('concepto');
        $cantidad = $this->input->post('cantidad');
        $precio_unitario = $this->input->post('precio_unitario');
        $quien_modifica = $e_mail;
        $status_cons = 0;
        $fecha = $this->input->post('fecha');

        $last_id = $this->consolidados_model->update_entry($id_con,$id_nec,$id_act,$tipo,$clasificacion,$proveedor,$concepto,$cantidad,$precio_unitario,$quien_modifica,$status_cons,$fecha);
        redirect(base_url('actividades/vista_previa_presupuesto/'.$id_act));
        //$this->vista_previa_presupuesto($id_act);
        
    }    

    public function eliminar_cons($id_con,$id_act) {

        $e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $data['grupo'] = $grupo;
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $status_necs = 0 ;
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
        $data['onlyusername'] = strstr($e_mail,'@',true);
        $this->load->model('consolidados_model');
        $this->load->model('necesidades_model');

        $get_one_nec_edit = $this->consolidados_model->get_one_nec_edit($id_con);
        foreach ($get_one_nec_edit as $item) {
            $id_nec = $item->id_nec;
        }

        $this->necesidades_model->update_consolidado($id_nec,$status_necs,$e_mail);

        $last_id = $this->consolidados_model->delete($id_con);
        redirect(base_url('actividades/vista_previa_presupuesto/'.$id_act));
        //print_r($id_nec);
        
    }    

    public function agregar_con() {

        $e_mail   = $_SESSION['username'];
        $grupo    = $_SESSION['grupo'];
        $data['grupo'] = $grupo;
        $id_coord = $_SESSION['id_coord'];
        $edicion  = $_SESSION['fc'];
        $data['edicion']  = $_SESSION['fc'];
        $data['get_fc'] = $this->fc_model->get_fc();
        $data['onlyusername'] = strstr($e_mail,'@',true);
        
        $this->load->model('actividades_model');
        $this->load->model('consolidados_model');
        
        $id_act = $this->input->post('id_act');
        $id_nec = 0;
        $tipo = $this->input->post('tipo');
        $clasificacion = strtoupper(url_title($this->input->post('clasificacion'),'dash',TRUE));
        $proveedor = $this->input->post('proveedor');
        $concepto = $this->input->post('concepto');
        $cantidad = $this->input->post('cantidad');
        $precio_unitario = $this->input->post('precio_unitario');
        $quien_modifica = $e_mail;
        $status_cons = 0;
        
        $last_id = $this->consolidados_model->insert_entry($id_act,$id_nec,$tipo,$clasificacion,$proveedor,$concepto,$cantidad,$precio_unitario,$quien_modifica,$status_cons);

        redirect(base_url('actividades/vista_previa_presupuesto/'.$id_act));
        
    }



///////////////////////////////////////////////////


function test_ajax(){
    $this->load->model('consolidados_model');
    $output_string = $this->consolidados_model->get_all();
    echo json_encode($output_string);
}

    public function get_all_users(){
 
        $query = $this->db->get('consolidados');
        if($query->num_rows > 0){
            $header = false;
            $output_string = '';
            $output_string .=  "<table border='1'>\n";
            foreach ($query->result() as $row){
                $output_string .= "<tr>\n";
                $output_string .= "<th>{$row['clasificacion']}</th>\n"; 
                $output_string .= "</tr>\n";
            }                   
            $output_string .= "</table>\n";
        }
        else{
            $output_string = "No hay resultados";
        }
         
        echo json_encode($output_string);
    }
///////////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////////
}

/* End of file solicitud.php */
/* Location: ./application/controllers/solicitud.php */